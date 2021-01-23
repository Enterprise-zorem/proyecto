  
$(document).ready(function () {
    $("#form_perfil_update").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form_perfil_update"));
        
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

    $("#form-edit-job").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-edit-job"));
        
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

    $("#form-delete-job").bind("submit", function (e) {
        e.preventDefault();
        // Capturamnos el formulario
        var formData = new FormData(document.getElementById("form-delete-job"));
        
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
