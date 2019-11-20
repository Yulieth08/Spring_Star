/*============= VALIDACIÓN DOCUMENTO PERSONA  ====================      */

$(document).ready(function () {

    $("#Documento_Persona").keyup(validarDocumento);
});

function validarDocumento() {
    var documento = document.getElementById('Documento_Persona').value;
    if(documento.length>8){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {

            if (xhttp.readyState == 4 && xhttp.status == 200) {

                var respuesta = xhttp.responseText;
                if (respuesta == "Disponible") {
                    document.getElementById("doc_validado").innerHTML = "<div class='alert alert-success'><i class='fa fa-check'></i>Documento Disponible</div>";
                }else{
                    document.getElementById("doc_validado").innerHTML = "<div class='alert alert-danger'><i class='fa fa-close'></i>Documento No Disponible</div>";
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


/*============= VALIDACIÓN REFERENCIA PRODUCTO  ====================      */

$(document).ready(function () {

    $("#Codigo_producto").keyup(ValidarProducto);
});

function ValidarProducto() {
    var referencia = document.getElementById('Codigo_producto').value;
    if(referencia.length>0){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {

            if (xhttp.readyState == 4 && xhttp.status == 200) {

                var respuesta = xhttp.responseText;
                if (respuesta == "Disponible") {
                    document.getElementById("prod_validado").innerHTML = "<div class='alert alert-success'><i class='fa fa-check'></i>Codigo Producto Disponible</div>";
                }else{
                    document.getElementById("prod_validado").innerHTML = "<div class='alert alert-danger'><i class='fa fa-close'></i> Codigo Producto No Disponible</div>";
                }

            }

        };
        xhttp.open("POST", "../../../Controlador/ProductoController.php.?action=ValidarProducto", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
        xhttp.send("referencia=" + referencia);
    }else{
        document.getElementById("prod_validado").innerHTML = "<div id='prod_validado'></div>";
    }
}



/*============= VALIDACIÓN NIT PROVEEDOR  ====================      */

$(document).ready(function () {

    $("#Nit_Proveedor").keyup(ValidarNit);
});

function ValidarNit() {
    var Nit = document.getElementById('Nit_Proveedor').value;
    if(Nit.length>0){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {

            if (xhttp.readyState == 4 && xhttp.status == 200) {

                var respuesta = xhttp.responseText;
                if (respuesta == "Disponible") {
                    document.getElementById("prove_validado").innerHTML = "<div class='alert alert-success'><i class='fa fa-check'></i>Nit Proveedor Disponible</div>";
                }else{
                    document.getElementById("prove_validado").innerHTML = "<div class='alert alert-danger'><i class='fa fa-close'></i>Nit Proveedor No Disponible</div>";
                }

            }

        };
        xhttp.open("POST", "../../../Controlador/ProveedorController.php.?action=ValidarNit", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
        xhttp.send("Nit=" + Nit);
    }else{
        document.getElementById("prove_validado").innerHTML = "<div id='prove_validado'></div>";
    }
}



/*============= MOSTRAR CAMPOS DATOS CUENTA  ====================      */

$(document).ready(function () {
    $('#Rol').on('change',function () {
        var selectValor = $(this).val();
        if(selectValor=='Administrador' || selectValor=='Vendedor'){
            $(".datos-cuenta").show();
            document.getElementById("Email_persona").setAttribute("required","");
            document.getElementById("Contraseña").setAttribute("required","");
        }else{
            $(".datos-cuenta").hide();

                    }

    });

});
