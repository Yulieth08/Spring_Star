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
                if (respuesta =="") {
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
                if (respuesta == "") {
                    document.getElementById("prod_validado").innerHTML = "<div class='alert alert-success'><i class='fa fa-check'></i>Codigo Producto Disponible</div>";
                }else{
                    document.getElementById("prod_validado").innerHTML = "<div class='alert alert-danger'><i class='fa fa-close'></i> Codigo Producto No Disponible</div>";
                }

            }

        };
        xhttp.open("POST", "../../../Controlador/ProductoController.php.?action=ValidarProducto", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
        xhttp.send("Codigo=" + referencia);
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

/*============= MOSTRAR NUMERO FACTURA COMPRA  ====================      */
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

var ultimo_id=0;


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
            ultimo_id=respuesta;
            if(respuesta>0){
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
    document.getElementById('numero_factura_compra').setAttribute("disabled","true");
    document.getElementById('Fecha_compra').setAttribute("disabled","true");
    document.getElementById('Id_Proveedor').setAttribute("disabled","true");
    document.getElementById('Nombre_Proveedor').setAttribute("disabled","true");
    document.getElementById('Id_persona').setAttribute("disabled","true");
    document.getElementById('Telefono_Proveedor').setAttribute("disabled","true");
    document.getElementById('crearFactura').setAttribute("disabled","true");
}
/*============= VERIFICAR CODIGO PRODUCTO  ====================      */
$(document).ready(function () {

    $("#codigo_producto").keyup(validarProductoCom);
});

function validarProductoCom() {
    var codigo=document.getElementById("codigo_producto").value;
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta=xhttp.responseText;
            var res=respuesta.split(",");
            var btnAgregarP=document.getElementById('agregarProducto');
            if(respuesta!="Disponible"){
                btnAgregarP.disabled=false;
                $('#nom_producto').val(res[0]);
            }else{
                btnAgregarP.disabled=true;
                $('#nom_producto').val("");
            }

        }
    };
    xhttp.open("POST", "../../../Controlador/ProductoController.php?action=ValidarProducto", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("Codigo="+codigo);

}

/*============= AGREGAR PRODUCTO COMPRADO A LA TABLA ====================      */
var cont=0;
function eliminarProCom(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    cont--;
}

function agregarProCom() {

    var btnCompra = document.getElementById('btn_compra');
    if(btnCompra.disabled==true){
        btnCompra.disabled=false;
    }


    var cod_pro= document.getElementById('codigo_producto').value;
    var can_pro= document.getElementById('cantidad_producto').value;
    var pre_pro= document.getElementById('precio_producto').value;
    var pre_total=parseInt(pre_pro,10)*parseInt(can_pro,10);
    var talla_pro = $('#talla').val();
    var color_pro = $('#color').val();

    cont++;
    var fila = '<tr> <td>' + cont + '</td><td>' + cod_pro + '</td><td>' + talla_pro + '</td><td>' + color_pro + '</td><td>' + can_pro + '</td><td>' + pre_pro + '</td><td>' + pre_total + '</td><td>'  + '</td><td><button class="btn docs-tooltip btn-danger btn-sm" onclick="eliminarProCom(this)"><i class="fas fa-eraser"></i></button></td></tr>';
    $('#tabla_productos').append(fila);


    $('#codigo_producto').val("");
    $('#nom_producto').val("");
    $('#cantidad_producto').val("");
    $('#precio_producto').val("");

}

/*============= AGREGAR TODOS LOS PRODUCTOS DE LA TABLA A LA BASE DE DATOS ====================      */
function recorrerTabla() {
    var n = 0;
    $("tr").each(function () {
        if (n > 0) {
            var Cells = $(this).find("td");
            enviarProductoC(Cells);
        }
        n++;

    });

}



function enviarProductoC(array) {
    var codigo=array[1].innerText;
    var talla=array[2].innerText;
    var color=array[3].innerText;
    var cantidad=array[4].innerText;
    var precio=array[5].innerText;



    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta=xhttp.responseText;
            if(respuesta="bien"){

            }
           alert("Bien");

        }
    };
    xhttp.open("POST", "../../../Controlador/ProductoCompradoController.php?action=crear", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("codigo="+codigo+"&talla="+talla+"&color="+color+"&cantidad="+cantidad+"&precio="+precio+"&Id_factura_compra="+ultimo_id);


}

/*=========================================== FACTURA VENTA  ====================================      */
/*===============================================================================================      */

/*============= MOSTRAR NUMERO FACTURA VENTA  ====================      */
function nFacturaVen() {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {

            var respuesta = xhttp.responseText;
            $('#N_Factura_venta').val(respuesta);

        }
    };
    xhttp.open("POST", "../../../Controlador/FacturaVentaController.php?action=NumeroFactura", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send();
}
/*============= LLENAR CAMPOS CLIENTE  ====================      */

$(document).ready(function () {
    $('#Id_cliente_v').on('change', function () {
        var select=document.getElementById('Id_cliente_v');
        var selectCli=this.options[select.selectedIndex];
        var documento=selectCli.text;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var respuesta = xhttp.responseText;
                var datos=respuesta.split(",");
                $('#Nombre_Cliente').val(datos[0]);
                $('#Telefono_Cliente').val(datos[1]);
                $('#Direccion_Cliente').val(datos[2]);

            }
        };
        xhttp.open("POST", "../../../Controlador/PersonaController.php?action=ValidarDocumento", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
        xhttp.send("documento="+documento);
    });
});


/*============= REGISTRAR DATOS FACTURA VENTA  ====================      */
var ultimo_id_v;
function registrarFacturaVenta() {

    var N_Factura_venta=document.getElementById('N_Factura_venta').value;
    var Fecha_factura=document.getElementById('Fecha_factura').value;
    var Id_cliente=$('#Id_cliente_v').val();
    var Id_vendedor = $('#Id_vendedor').val();

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {

        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta=xhttp.responseText;
            ultimo_id_v=parseInt(respuesta,10);
            alert(respuesta);
            if(respuesta>0){
                bloquearCamposVenta();
            }
        }
    };
    xhttp.open("POST", "../../../Controlador/FacturaVentaController.php?action=crear", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("N_Factura_venta="+N_Factura_venta+"&Fecha_factura="+Fecha_factura+"&Id_cliente="+Id_cliente+"&Id_vendedor="+Id_vendedor+"");
}
/*============= BLOQUEAR CAMPOS FACTURA VENTA  ====================      */
function bloquearCamposVenta() {
    document.getElementById('N_Factura_venta').setAttribute("disabled","true");
    document.getElementById('Fecha_factura').setAttribute("disabled","true");
    document.getElementById('Id_cliente_v').setAttribute("disabled","true");
    document.getElementById('Id_vendedor').setAttribute("disabled","true");
    document.getElementById('Direccion_Cliente').setAttribute("disabled","true");
    document.getElementById('Nombre_Cliente').setAttribute("disabled","true");
    document.getElementById('Telefono_Cliente').setAttribute("disabled","true");
    document.getElementById('CrearFactura').setAttribute("disabled","true");
}

/*============= VERIFICAR CODIGO PRODUCTO  ====================      */
$(document).ready(function () {

    $("#codigo_producto_v").keyup(validarProductoVen);
});

function validarProductoVen() {
    var codigo=document.getElementById("codigo_producto_v").value;
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respues=xhttp.responseText;

            var btnAgregarP=document.getElementById('agregarProductoV');
            if(respues!=null){
                var respuesta=respues.split(",");
                btnAgregarP.disabled=false;
                $('#nom_producto_v').val(respuesta[0]);
                obtenerPrecio(respuesta[1]);
            }else{
                btnAgregarP.disabled=true;
                $('#nom_producto_v').val("");
            }

        }
    };
    xhttp.open("POST", "../../../Controlador/ProductoController.php?action=ValidarProducto", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("Codigo="+codigo);

}

function obtenerPrecio(Id_producto) {
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta=xhttp.responseText;

            if(respuesta!=null){
                $('#precio_producto_v').val(respuesta);
            }else{
                $('#precio_producto_v').val("");
            }

        }
    };
    xhttp.open("POST", "../../../Controlador/ProductoCompradoController.php?action=obtenerPrecio", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("Id_producto="+Id_producto);
}

/*============= AGREGAR PRODUCTO VENDIDO A LA TABLA ====================      */
var contV=0;
function eliminarProVen(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    contV--;
}

function agregarProVen() {
    var btnVenta = document.getElementById('btn_venta');
    if(btnVenta.disabled==true){
        btnVenta.disabled=false;
    }


    var cod_pro= document.getElementById('codigo_producto_v').value;
    var can_pro= document.getElementById('cantidad_producto_v').value;
    var pre_pro= document.getElementById('precio_producto_v').value;
    var pre_total=parseInt(pre_pro,10)*parseInt(can_pro,10);
    var talla_pro = $('#talla_v').val();
    var color_pro = $('#color_v').val();

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta = xhttp.responseText;
            if (respuesta>=parseInt(can_pro,10)) {

                contV++;
                var fila = '<tr> <td>' + contV + '</td><td>' + cod_pro + '</td><td>' + talla_pro + '</td><td>' + color_pro + '</td><td>' + can_pro + '</td><td>' + pre_pro + '</td><td>' + pre_total + '</td><td>'  + '</td><td><button class="btn docs-tooltip btn-danger btn-sm" onclick="eliminarProCom(this)"><i class="fas fa-eraser"></i></button></td></tr>';
                $('#tabla_productos_v').append(fila);
                $('#codigo_producto_v').val("");
                $('#nom_producto_v').val("");
                $('#cantidad_producto_v').val("");
                $('#precio_producto_v').val("");

            }else{
                alert("Cantidad insuficiente. La cantidad existente en bodega es de: "+respuesta);
            }

        }
    };
    xhttp.open("POST", "../../../Controlador/ProductoCompradoController.php?action=validarCantidad", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("Codigo_producto=" + cod_pro+"&Talla="+talla_pro+"&Color="+color_pro+"");



}

/*============= AGREGAR TODOS LOS PRODUCTOS DE LA TABLA A LA BASE DE DATOS ====================      */
function recorrerTablaV() {
    var n = 0;
    $("tr").each(function () {
        if (n > 0) {
            var Cells = $(this).find("td");
            enviarProductoV(Cells);
        }
        n++;

    });
    document.getElementById("validar_facv").style.display = 'none';
    location.href = "../../modules/factura_venta/create.php?respuesta=correcto";
}

function enviarProductoV(array) {
    var codigo_v = array[1].innerText;
    var talla_v = array[2].innerText;
    var color_v = array[3].innerText;
    var cantidad_v = array[4].innerText;
    var precio_v = array[5].innerText;
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta = xhttp.responseText;
            var respues1=respuesta.split(",");
            for (var i=0;i<respues1.length;i++){
                if(respues1[i]!=""){
                    var respues2=respues1[i].split("-");
                    var Precio_Total=precio_v*parseInt(respues2[1]);
                    insertarProductov(respues2[0],respues2[1],Precio_Total);
                }
            }
            alert(respues1.length);
        }
    };
    xhttp.open("POST", "../../../Controlador/ProductoCompradoController.php?action=descontarStock", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("Codigo_producto=" + codigo_v + "&Talla=" + talla_v + "&Color=" + color_v + "&Cantidad=" + cantidad_v +"");
}
function insertarProductov(Id_ProductoComprados,Cantidad_producto,Precio_Total) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var respuesta=xhttp.responseText;
            alert(respuesta);
        }
    };
    xhttp.open("POST", "../../../Controlador/ProductoVendidoController.php?action=crear", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");//no modificar nunca
    xhttp.send("Id_ProductoComprados=" + Id_ProductoComprados + "&Cantidad_producto=" + Cantidad_producto + "&Precio_Total=" + Precio_Total + "&Id_Factura_venta=" + ultimo_id_v +"");
}


