
$(document).ready(function () {
    $("#form-insert-proyectos").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-insert-proyectos"));
        
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "HTML",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                Swal.fire({
                    title: 'Procesando'
                });
                Swal.showLoading();
            },
        }).done(function (result) {
            Swal.close();
            if (result == "defaultValue") {
                Swal.fire({
                    title: 'Registrado!',
                    text: "Correctamente!",
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        location.href = " ";
    
                    } else {
                        location.href = " ";
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: result
                });
            }
        });
    });

    $("#form-edit-proyectos").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-edit-proyectos"));
        
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "HTML",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                Swal.fire({
                    title: 'Procesando'
                });
                Swal.showLoading();
            },
        }).done(function (result) {
            Swal.close();
            if (result == "defaultValue") {
                Swal.fire({
                    title: 'Modificado!',
                    text: "Correctamente!",
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        location.href = " ";
    
                    } else {
                        location.href = " ";
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: result
                });
            }
        });
    });

    $("#form-delete-proyectos").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-delete-proyectos"));
        
        $.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            dataType: "HTML",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                Swal.fire({
                    title: 'Procesando'
                });
                Swal.showLoading();
            },
        }).done(function (result) {
            Swal.close();
            if (result == "defaultValue") {
                Swal.fire({
                    title: 'Eliminado!',
                    text: "Correctamente!",
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok!'
                }).then((result) => {
                    if (result.value) {
                        location.href = " ";
    
                    } else {
                        location.href = " ";
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: result
                });
            }
        });
    });

});

function eliminar(id)
{
    $('#proyectos_delete_id').val(id);
}

function editar(value)
{
    axios.post(RUTA + 'process.php/proyectos/listar', {id: value}).then(function(response){
       console.log(response.data);
        var project = response.data;
       var duracion = parseInt(project['duration']);
       var d = new Date(project['start_date']);
       function sumar(fecha, dias){
           fecha.setDate(fecha.getDate() + (dias + 1));
           return fecha;
       }
       var end_date = sumar(d, duracion);
       
       end_date = new Date(end_date).toLocaleString('zh-Hans-CN', {
           year: 'numeric',
           month: '2-digit',
           day: '2-digit',
         })
         .replace(/\//g, '-');
    $('#proyecto_edit_pk_proyecto').val(project['pk_proyecto']);
    $('#proyectos_edit_nombres').val(project['name']);
    $('#proyectos_edit_fk_cliente').val(project['fk_cliente']);
    $('#proyecto_edit_start_date').val(project['start_date']);
    $('#proyecto_edit_end_date').val(end_date);
    $('#proyecto_edit_presupuesto').val(project['presupuesto']);   
    $('#proyecto_edit_descripcion').val(project['descripcion']);
    });
}