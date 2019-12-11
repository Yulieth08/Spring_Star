<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/ProductoVendido.php');
require_once (__DIR__.'/../Modelo/Persona.php');
require_once (__DIR__.'/../Modelo/Producto.php');

use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Arra

if(!empty($_GET['action'])){
    ProductoVendidoController::main($_GET['action']);
}else{
}

class ProductoVendidoController
{

    static function main($action)
    {
        if ($action == "crear") {
        ProductoVendidoController::crear();
        }else if ($action == "editar") {
            ProductoVendidoController::editar();
        } else if ($action == "buscarID") {
            ProductoVendidoController::buscarID($_REQUEST['Id_persona']);
        } else if ($action == "ActivarProducto") {
            ProductoVendidoController::ActivarProducto();
        } else if ($action == "InactivarProducto") {
            ProductoVendidoController::InactivarProducto();
        }else if($action =="NumeroFactura"){
            ProductoVendidoController::obtenerNumero();
        }else if($action =="obtenerPrecio"){
            ProductoVendidoController::obtenerPrecio();
        }else if($action =="validarCantidad"){
            ProductoVendidoController::validarCantidad();
        }else if($action =="descontarStock"){
            ProductoVendidoController::descontarStock();
        }




    }

    static public function crear()
    {

        try {
            $arrProductoVendido = array();
            $arrProductoVendido['Cantidad_producto'] = $_POST['Cantidad_producto'];
            $arrProductoVendido['Precio_Total'] = $_POST['Precio_Total'];
            $arrProductoVendido['Id_Factura_venta'] =$_POST['Id_Factura_venta'];
            $arrProductoVendido['Id_ProductoComprados'] =$_POST['Id_ProductoComprados'];
            $ProductoVendido = new ProductoVendido($arrProductoVendido);
            if($ProductoVendido->insertar()){
                echo "bien";
            }else{
                echo "mal";
            }

        } catch (Exception $e) {
            var_dump($e);

        }

    }

    public static function productoVendidoIsArray($Id_producto, $arrproducto){
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
            $arrproductoVendido = array();
            $arrproductoVendido['Cantidad_producto'] = $_POST['Cantidad_producto'];
            $arrproductoVendido['Precio_Total'] = $_POST['Precio_Total'];
            $arrproductoVendido['Id_Factura_venta'] = $_POST['Id_Factura_venta'];
            $arrproductoVendido['Id_ProductoComprados'] = $_POST['Id_ProductoComprados'];
            $ProductoVendido = new ProductoVendido( $arrproductoVendido);
            $ProductoVendido->editar();
            header("Location: ../Vista/modules/producto/view.php?id=".$ProductoVendido->getIdProductoVendido()."");
        }catch (Exception $e){
            var_dump($e);

        }
    }

    static public function buscarID ($id){
        try {
            return ProductoVendido::buscarForId($id);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/producto/manager.php?respuesta=error");
        }
    }




}