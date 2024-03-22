// Función que valida los formularios.
function validateForm(e) {
    let form = $(e.target);
    let valid = false;

    form.find("input, select, textarea").each(function (i, element) {
        if (element.type != "hidden" && $(element).val() != "") {
            valid = true;
        }
    });
    if ($(e.target).attr("id") != "") {
        $(
            "input[form=" +
                $(e.target).attr("id") +
                "], select[form=" +
                $(e.target).attr("id") +
                "], textarea[form=" +
                $(e.target).attr("id") +
                "]"
        ).each(function (i, element) {
            if (element.type != "hidden" && $(element).val() != "") {
                valid = true;
            }
        });
    }

    return valid;
}
window.validateForm = validateForm;

// Función que activa o desactiva el botón del formulario.
$("form, input, select, textarea").on("change", function (e) {
    // Buscamos el elemento que a echo saltar el cambio
    // Inicializamos el botón en null
    let btn = null;
    // Buscamos si esta dentro de un formulario
    let form = $(e.target).parents("form")[0];

    if (form == undefined) {
        // Si no esta dentro de un formulario damos por echo que tiene el atributo form, en el que contiene el id del formulario al que pertenece.
        form = $("#" + $(e.target).attr("form"));
    }

    // Buscamos dentro del formulario el botón submit y lo declaramos al la variable btn.
    $(form)
        .find('button[type="submit"]')
        .each(function () {
            btn = this;
        });
    // Comprobamos que el elemento no este vació.
    if ($(e.target).val() === "") {
        // Si esta vació le añadimos la clase disabled. y deshabilitamos el botón.
        $(btn).addClass("disabled");
    } else {
        // Si no esta vació le borramos la clase disabled. y habilitamos el botón.
        $(btn).removeClass("disabled");
    }
    // Comprobamos que haya algún elemento que no este vació para dejar habilitado el botón.
    $(form)
        .find("input, select, textarea")
        .each(function () {
            if (this.type != "hidden" && $(this).val() != "") {
                $(btn).removeClass("disabled");
                return false;
            }
        });

});

// Funcion para visualizar una imagen antes de guardarla.
function previewImage(event, querySelector, queryPreview) {
    //Recuperamos el input que desencadeno la acción
    const input = event.target;

    //Recuperamos las etiquetas img donde cargaremos la imagen
    let imgPreview = document.querySelector(querySelector);
    let preview = document.querySelector(queryPreview);

    // Escondemos la imagen vista por la nueva
    $(preview).addClass("d-none");
    $(imgPreview).removeClass("d-none");

    // Verificamos si existe una imagen seleccionada
    if (!input.files.length) return;

    //Recuperamos el archivo subido
    let file = input.files[0];

    //Creamos la url
    let objectURL = URL.createObjectURL(file);

    //Modificamos el atributo src de la etiqueta img
    imgPreview.src = objectURL;
}
window.previewImage = previewImage;
