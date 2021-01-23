
$(document).ready(function () {
    $("#form-insert-tarea").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-insert-tarea"));
        
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

    $("#form-edit-tarea").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-edit-tarea"));
        
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

    $("#form-delete-tarea").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-delete-tarea"));
        
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
    $('#tarea_delete_id').val(id);
}

function modal_edit(value)
{
    
    axios.post(RUTA+'process.php/proyectos/tarea/getAllById', {id: value}).then((response)=>{
            var task = response.data;
            var duracion = parseInt(task['duration']);
            var d = new Date(task['start_date']);
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

            $('#tarea_edit_pk_tarea').val(task['pk_task']);
            $('#tarea_edit_id').val(task['fk_proyecto']);
            $('#tarea_edit_name').val(task['name']);
            $('#tarea_edit_start_date').val(task['start_date']);
            $('#tarea_edit_end_date').val(end_date);
            $('#tarea_edit_descripcion').html(task['descripcion']);
    });
}

