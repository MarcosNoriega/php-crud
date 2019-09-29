cargarTareas();

const tablaBody = document.getElementById('tabla-contenido');
const formTareas = document.getElementById('formTareas');
var modoEdit = false;

function ajax(url, type, cb, data) {
    const http = new XMLHttpRequest();

    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200) {
            cb(this.responseText);
        }
    }

    http.open(type, url);
    if (data){
        http.setRequestHeader("Content-type", "application/json");
        http.send(JSON.stringify(data));
    }else {
        http.setRequestHeader("Content-type", "application/json");
        http.send();
    }
}

function cargarTareas() {
    ajax('api/apiTareas.php', 'GET', function(res) {
        var tareas = JSON.parse(res);
        var html = '';
        for(let tarea of tareas) {
            html += `<tr>
                        <td>${tarea.nombre}</td>
                        <td>${tarea.description}</td>
                        <td>${tarea.fecha}</td>
                        <td>
                            <a class="btn btn-danger" id=${tarea.Id} onclick=deleteTarea(this)>Eliminar</a>
                            <a class="btn btn-warning" id=${tarea.Id} onclick=editTarea(this)>Editar</a>
                        </td>
                    </tr>`
        }
    
        tablaBody.innerHTML = html;
    });
}

formTareas.addEventListener('submit', function(e) {
    e.preventDefault();
    url = formTareas.getAttribute('action');
    var data = {}
    data.nombre = formTareas.nombre.value;
    data.description = formTareas.descripcion.value;
    if (!modoEdit){
        ajax(url, 'POST', function(res) {
            cargarTareas();
        }, data);

    } else {
        data.id = formTareas.id.value;
        ajax(url, 'PUT', function(res) {
            cargarTareas();
            modoEdit = false;
        }, data);
    }
    clearForm();
});

function deleteTarea(button) {
    let id = button.getAttribute('id');
    let fila = button.parentElement.parentElement;

    ajax('api/apiTareas.php', 'DELETE', function(res){
        fila.className = 'animated fedeOut';
        setTimeout(function() {
            fila.remove();
        }, 900)
    }, {id});
}

function editTarea(button) {
    let id = button.getAttribute('id');
    ajax('api/apiTareas.php', 'GET', function(res) {
        var tareas = JSON.parse(res);
        tareas = tareas.filter(tarea => tarea.Id == id);   //revisar 
        
        formTareas.id.value = tareas[0].Id;
        formTareas.nombre.value = tareas[0].nombre;
        formTareas.descripcion.value = tareas[0].description;
        modoEdit = true;
    }, {id});

}

function clearForm() {
    formTareas.id.value = null;
    formTareas.nombre.value = null;
    formTareas.descripcion.value = null;
}








