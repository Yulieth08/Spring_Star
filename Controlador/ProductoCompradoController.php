<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/ProductosComprados.php');
require_once (__DIR__.'/../Modelo/Proveedor.php');
require_once (__DIR__.'/../Modelo/Persona.php');
require_once (__DIR__.'/../Modelo/Producto.php');


use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Arra

if(!empty($_GET['action'])){
    ProductoCompradoController::main($_GET['action']);
}else{
}

class ProductoCompradoController
{

    static function main($action)
    {
        if ($action == "crear") {
            ProductoCompradoController::crear();
        } else if ($action == "editar") {
            ProductoCompradoController::editar();
        } else if ($action == "buscarID") {
            ProductoCompradoController::buscarID($_REQUEST['Id_persona']);
        } else if ($action == "ActivarProducto") {
            ProductoCompradoController::ActivarProducto();
        } else if ($action == "InactivarProducto") {
            ProductoCompradoController::InactivarProducto();
        }else if($action =="NumeroFactura"){
            ProductoCompradoController::obtenerNumero();
        }else if($action =="obtenerPrecio"){
            ProductoCompradoController::obtenerPrecio();
        }else if($action =="validarCantidad"){
            ProductoCompradoController::validarCantidad();
        }else if($action =="descontarStock"){
            ProductoCompradoController::descontarStock();
        }

    }

    static public function crear()
    {
        try {

            $arrProductoComprado = array();
            $arrProductoComprado['Cantidad_Inicial'] = $_POST['cantidad'];
            $arrProductoComprado['Cantidad_productos'] = $_POST['cantidad'];
            $arrProductoComprado['Precio_compra'] =$_POST['precio'];
            $incremento=floatval($_POST['precio'])*0.2;
            $arrProductoComprado['Precio_venta'] =floatval($_POST['precio'])+$incremento;
            $arrProductoComprado['Color'] =$_POST['color'];
            $arrProductoComprado['Talla'] =$_POST['talla'];
            $arrProductoComprado['Id_factura_compra'] =$_POST['Id_factura_compra'];
            $arrProductoComprado['Id_producto'] =$_POST['codigo'];
            $ProductosComprados = new ProductosComprados($arrProductoComprado);
            if($ProductosComprados->insertar()){
                echo "bien";
            }else{
                echo "mal";
            }

        } catch (Exception $e) {
            var_dump($e);

        }

    }

    public static function productoIsArray($Id_producto, $arrproducto){
        if (count($arrproducto) > 0) {
            foreach ($arrproducto as $Producto) {
                if ($Producto->getIdProducto() == $Id_producto) {
                    return true;
                }
            }
        }
        return false;
    }

    static public  function editar(){
        try{
            $arrproducto = array();
            $arrproducto['Codigo_producto'] = $_POST['Codigo_producto'];
            $arrproducto['Tipo_producto'] = $_POST['Tipo_producto'];
            $arrproducto['Estado'] = "Activo";
            $arrproducto['Id_producto'] = $_POST['Id_producto'];
            $arrproducto['Id_Marca'] = $_POST['Id_Marca'];
            $Producto = new Producto( $arrproducto);
            $Producto->editar();
            header("Location: ../Vista/modules/producto/view.php?id=".$Producto->getIdProducto()."");
        }catch (Exception $e){
            var_dump($e);

        }
    }

    static public function buscarID ($id){
        try {
            return Producto::buscarForId($id);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/producto/manager.php?respuesta=error");
        }
    }

    static public function ActivarProducto(){
        try{
            $ObjProducto = Producto::buscarForId($_GET['Id_producto']);
            header("Location: ../Vista/modules/producto/manager.php");
            $ObjProducto->setEstado("Activo");
            $ObjProducto->editar();
        }catch (Exception $e){
            var_dump($e);
        }
    }

    static public function InactivarProducto (){
        try {
            $ObjProducto = Producto::buscarForId($_GET['Id_producto']);
            $ObjProducto->setEstado("Inactivo");
            $ObjProducto->editar();
            header("Location: ../Vista/modules/producto/manager.php");
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/producto/manager.php?respuesta=error");
        }
    }



    static public function obtenerNumero(){
        $arrayFacturaCompra=FacturaCompra::getAll();
        $ultimoRegistro=end($arrayFacturaCompra);
        $nfactura="";
        if($ultimoRegistro!=""){
            $nfactura="FC-00";
            $ultimoId=$ultimoRegistro->getIdFacturaCompra();
            $ultimoId=$ultimoId+1;
            $nfactura.=$ultimoId;
        }else{
            $nfactura="FC-001";
        }
        echo $nfactura;
    }
    static public function obtenerPrecio(){
            $Id_producto=$_POST['Id_producto'];
        $ProductoCom= ProductosComprados::buscar("SELECT * FROM productos_comprados WHERE Id_producto='$Id_producto'");
        foreach ($ProductoCom as $ProductoComprado){
            if($ProductoComprado->getCantidadProductos()>0){
                echo $ProductoComprado->getPrecioVenta();
                break;
            }
        }


    }

    static public function validarCantidad()
    {
        try {
            $Codigo_producto = $_POST['Codigo_producto'];
            $Talla = $_POST['Talla'];
            $Color = $_POST['Color'];
            $ObjProducto = Producto::buscar("SELECT * FROM producto WHERE Codigo_producto='$Codigo_producto'");
            if ($ObjProducto != null) {
                $Id_producto = "";
                foreach ($ObjProducto as $Producto) {
                    $Id_producto = $Producto->getIdProducto();
                }
                $ObjProductoCom = ProductosComprados::buscar("SELECT * FROM productos_comprados WHERE Id_producto='$Id_producto' AND Talla='$Talla' AND Color='$Color'");
                if ($ObjProductoCom != null) {
                    $cantidadTotal = 0;
                    foreach ($ObjProductoCom as $ProductoComprado) {
                        $cantidadTotal += $ProductoComprado->getCantidadProductos();
                    }
                    echo $cantidadTotal;

                }

            }

        } catch (Error $e) {

        }
    }


    static public function descontarStock(){

        try {
            $Codigo_producto = $_POST['Codigo_producto'];
            $Talla = $_POST['Talla'];
            $Color = $_POST['Color'];
            $Cantidad = $_POST['Cantidad'];

            $ObjProducto = Producto::buscar("SELECT * FROM producto WHERE Codigo_producto='$Codigo_producto'");
            $Id_Producto="";
            $respuesta="";

            if ($ObjProducto != null) {

                foreach ($ObjProducto as $Producto) {
                    $Id_producto = $Producto->getIdProducto();
                }
                $ObjProductoCom = ProductosComprados::buscar("SELECT * FROM productos_comprados WHERE Id_producto='$Id_producto' AND Talla='$Talla' AND Color='$Color' AND Cantidad_productos>0");
                if ($ObjProductoCom != null) {

                    foreach ($ObjProductoCom as $ProductoComprado) {
                        $CantidadProductos = $ProductoComprado->getCantidadProductos();
                        $res = $Cantidad - $CantidadProductos;
                        $id_producto_com=$ProductoComprado->getIdProductosComprados();
                        if ($res > 0) {
                            $Cantidad = $res;
                            $ProductoComprado->setCantidadProductos(0);
                            $ProductoComprado->editar();
                            $respuesta.=$id_producto_com."-".$CantidadProductos.",";
                        } else {
                            $res = $CantidadProductos - $Cantidad;
                            $ProductoComprado->setCantidadProductos($res);
                            $ProductoComprado->editar();
                            $respuesta.=$id_producto_com."-".$Cantidad.",";
                            $Cantidad = 0;
                            break;
                        }
                    }
                    echo $respuesta;

                }

            }
        } catch (Exception $e) {
            echo $e;
        }


    }

}