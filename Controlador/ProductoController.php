<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/Producto.php');
require_once (__DIR__.'/../Modelo/Marca.php');


use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Arra

if(!empty($_GET['action'])){
    ProductoController::main($_GET['action']);
}else{
}


class ProductoController
{

    static function main($action)
    {
        if ($action == "crear") {
            ProductoController::crear();
        } else if ($action == "editar") {
            ProductoController::editar();
        } else if ($action == "buscarID") {
            ProductoController::buscarID($_REQUEST['Id_persona']);
        } else if ($action == "ActivarProducto") {
            ProductoController::ActivarProducto();
        } else if ($action == "InactivarProducto") {
            ProductoController::InactivarProducto();
        }else if($action =="NumeroFactura"){
            ProductoController::obtenerNumero();
        }else if ($action == "ValidarProducto") {
            ProductoController::ValidarProducto();
        }
    }

    static public function crear()
    {

        try {
            $arrproducto = array();
            $arrproducto['Codigo_producto'] = $_POST['Codigo_producto'];
            $arrproducto['Tipo_producto'] = $_POST['Tipo_producto'];
            $arrproducto['Id_Marca'] = $_POST['Id_Marca'];
            $arrproducto['Estado'] = 'Activo';
            $Producto = new producto($arrproducto);
            if ($Producto->insertar()){
                header("Location: ../Vista/modules/producto/manager.php");
            }else{
                echo "Error al insertar";
            }
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ");
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
        if($ultimoRegistro!=null){
            $nfactura="FC-00";
            $ultimoId=$ultimoRegistro->getIdFacturaCompra();
            $ultimoId=$ultimoId+1;
            $nfactura.=$ultimoId;
        }
        return $nfactura;
    }


    static public function ValidarProducto (){
        $cod=$_POST['Codigo'];
        $ObjProducto = Producto::buscar("SELECT * FROM producto WHERE Codigo_producto='$cod'");
        if($ObjProducto==""){
            echo 'Disponible';
        }else{
            echo 'No disponible';
        }

    }

}