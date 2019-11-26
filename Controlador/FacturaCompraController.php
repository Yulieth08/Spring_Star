<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/FacturaCompra.php');
require_once (__DIR__.'/../Modelo/Proveedor.php');
require_once (__DIR__.'/../Modelo/Persona.php');



use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Arra

if(!empty($_GET['action'])){
    FacturaCompraController::main($_GET['action']);
}else{
}

class FacturaCompraController
{

    static function main($action)
    {
        if ($action == "crear") {
            FacturaCompraController::crear();
        } else if ($action == "editar") {
            FacturaCompraController::editar();
        } else if ($action == "buscarID") {
            FacturaCompraController::buscarID($_REQUEST['Id_persona']);
        } else if ($action == "ActivarProducto") {
            FacturaCompraController::ActivarProducto();
        } else if ($action == "InactivarProducto") {
            FacturaCompraController::InactivarProducto();
        }else if($action =="NumeroFactura"){
            FacturaCompraController::obtenerNumero();
        }
    }

    static public function crear()
    {

        try {



            $arrFacturaCompra = array();
            $arrFacturaCompra['N_Factura_Compra'] = $_POST['N_Factura_Compra'];
            $arrFacturaCompra['Fecha_compra'] = $_POST['Fecha_compra'];
            $arrFacturaCompra['Id_Proveedor'] =$_POST['Nit_Proveedor'];
            $arrFacturaCompra['Id_persona'] =$_POST['Id_persona'];
            $FacturaCompra = new FacturaCompra($arrFacturaCompra);
            if ($FacturaCompra->insertar()){
                echo "Bien";
            }else{
                echo "Error al insertar";
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




}