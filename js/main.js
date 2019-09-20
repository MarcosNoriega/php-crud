const tablaBody = document.getElementById('tabla-contenido');

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

ajax('api/apiTareas.php', 'GET', function(res) {
    var tareas = JSON.parse(res);
    var html = '';
    for(let tarea of tareas) {
        html += `<tr>
                    <td>${tarea.nombre}</td>
                    <td>${tarea.description}</td>
                    <td>${tarea.fecha}</td>
                    <td>
                        <a class="btn btn-danger delete">Eliminar</a>
                        <a class="btn btn-warning edit">Editar</a>
                    </td>
                </tr>`
    }

    tablaBody.innerHTML = html;
});



