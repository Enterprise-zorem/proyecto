
$(document).ready(function () {
    $("#form-insert-clientes").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-insert-clientes"));
        
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

    $("#form-edit-clientes").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-edit-clientes"));
        
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

    $("#form-delete-clientes").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-delete-clientes"));
        
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
    $('#clientes_delete_id').val(id);
}

function modal_edit(value)
{
    $('#clientes_edit_id').val(value['pk_cliente']);
    $('#clientes_edit_nombres').val(value['nombres']);
    $('#clientes_edit_dni').val(value['dni']);
    $('#clientes_edit_birthdate').val(value['birth_date']);
    $('#clientes_edit_telefono').val(value['telefono']);
    $('#clientes_edit_email').val(value['email']);
}