/*============= VALIDACIÓN DOCUMENTO PERSONA  ====================      */

$(document).ready(function () {

    $("#Documento_Persona").keyup(validarDocumento);
});

function validarDocumento() {
    var documento = document.getElementById('Documento_Persona').value;
    if(documento.length>9){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {

            if (xhttp.readyState == 4 && xhttp.status == 200) {

                var respuesta = xhttp.responseText;
                if (respuesta == "Disponible") {
                    document.getElementById("doc_validado").innerHTML = "<div class='alert alert-success'><i class='fa fa-close'></i>Disponible</div>";
                }else{
                    document.getElementById("doc_validado").innerHTML = "<div class='alert alert-danger'><i class='fa fa-close'></i>No Disponible</div>";
                }

            }

        };
        xhttp.open("POST", "../../../Controlador/PersonaController.php?action=ValidarDocumento", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
        xhttp.send("documento=" + documento);
    }else{
        document.getElementById("doc_validado").innerHTML = "<div id='doc_validado'></div>";
    }



}

function nFactura() {
    alert("hola");
}