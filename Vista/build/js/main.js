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
/*============= MOSTRAR NUMERO FACTURA  ====================      */
function nFactura() {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {

            var respuesta=xhttp.responseText;

            $('#numero_factura_compra').val(respuesta);

        }
    };
    xhttp.open("POST", "../../../Controlador/FacturaCompraController.php?action=NumeroFactura", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send();
}
/*============= VALIDAR UN PROVEEDOR FACTURA COMPRA  ====================      */
$(document).ready(function () {

    $("#Id_Proveedor").keyup(validarProveedor);
});
function validarProveedor() {

    var nit = document.getElementById('Id_Proveedor').value;
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {

            var respuesta=xhttp.responseText;
            var respues=respuesta.split(",");
            var btnCrear = document.getElementById('crearFactura');

            if(respuesta!=""){
                $('#Nombre_Proveedor').val(respues[0]);
                $('#Telefono_Proveedor').val(respues[1]);

                document.getElementById("nit_validado").innerHTML = "<div class='alert alert-success'><i class='fa fa-check'></i>Datos Correctos</div>";

                btnCrear.disabled=false;
            }else{
                document.getElementById("nit_validado").innerHTML = "<div class='alert alert-danger'><i class='fa fa-close'></i>Nit No Encontrado</div>";
                btnCrear.disabled=true;
            }

        }
    };
    xhttp.open("POST", "../../../Controlador/ProveedorController.php?action=validarProveedor", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("Nit="+nit);
}
/*============= REGISTRAR DATOS FACTURA COMPRA  ====================      */
function registrarFacturaCompra() {
    var N_Factura_Compra=document.getElementById('numero_factura_compra').value;
    var Fecha_compra=document.getElementById('Fecha_compra').value;
    var Nit_Proveedor=document.getElementById('Id_Proveedor').value;
    var Id_persona = $('#Id_persona').val();
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta=xhttp.responseText;
            if(respuesta=="Bien"){
                $(".productos").show();
                document.getElementById("codigo_producto").setAttribute("required","");
                document.getElementById("cantidad_producto").setAttribute("required","");
                document.getElementById("precio_producto").setAttribute("required","");
                document.getElementById("talla").setAttribute("required","");
                document.getElementById("color").setAttribute("required","");
                bloquearCamposCompra();
            }



        }
    };
    xhttp.open("POST", "../../../Controlador/FacturaCompraController.php?action=crear", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("N_Factura_Compra="+N_Factura_Compra+"&Fecha_compra="+Fecha_compra+"&Nit_Proveedor="+Nit_Proveedor+"&Id_persona="+Id_persona+"");
}

/*============= BLOQUEAR CAMPOS FACTURA COMPRA  ====================      */
function bloquearCamposCompra() {
    document.getElementById('numero_factura_compra').setAttribute("disabled","true");;
    document.getElementById('Fecha_compra').setAttribute("disabled","true");;
    document.getElementById('Id_Proveedor').setAttribute("disabled","true");
    document.getElementById('Nombre_Proveedor').setAttribute("disabled","true");
    document.getElementById('Id_persona').setAttribute("disabled","true");
    document.getElementById('Telefono_Proveedor').setAttribute("disabled","true");
}
/*============= VERIFICAR CODIGO PRODUCTO  ====================      */
$(document).ready(function () {

    $("#codigo_producto").keyup(validarProductoCom);
});

function validarProductoCom() {
    var codigo=document.getElementById("codigo_producto").value;
    var xhttp = new XMLHttpRequest();

    alert("entrada1");

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta=xhttp.responseText;
            alert("entrada2");
            if(respuesta!="Disponible"){
                alert("bien");
                alert("entrada3");
            }
        }
    };
    xhttp.open("POST", "../../../Controlador/ProductoController.php?action=ValidarProducto", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("Codigo="+codigo);

}
