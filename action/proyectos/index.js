
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

function modal_edit(value)
{
    $('#proyectos_edit_id').val(value['pk_cliente']);
    $('#proyectos_edit_nombres').val(value['nombres']);
    $('#proyectos_edit_dni').val(value['dni']);
    $('#proyectos_edit_birthdate').val(value['birth_date']);
    $('#proyectos_edit_telefono').val(value['telefono']);
    $('#proyectos_edit_email').val(value['email']);
}