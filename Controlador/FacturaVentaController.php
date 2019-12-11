
<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/FacturaVenta.php');
require_once (__DIR__.'/../Modelo/Proveedor.php');
require_once (__DIR__.'/../Modelo/Persona.php');



use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Arra

if(!empty($_GET['action'])){
    FacturaVentaController::main($_GET['action']);
}else{
}

class FacturaVentaController
{
    static function main($action)
    {
        if ($action == "crear") {
            FacturaVentaController::crear();
        } else if ($action == "editar") {
            FacturaVentaController::editar();
        } else if ($action == "buscarID") {
            FacturaVentaController::buscarID($_REQUEST['Id_persona']);
        } else if ($action == "ActivarProducto") {
            FacturaVentaController::ActivarProducto();
        } else if ($action == "InactivarProducto") {
            FacturaVentaController::InactivarProducto();
        }else if($action =="NumeroFactura"){
            FacturaVentaController::obtenerNumero();
        }
    }

    static public function crear()
    {

        try {

            $arrFacturaVenta = array();
            $arrFacturaVenta['N_Factura_venta'] = $_POST['N_Factura_venta'];
            $arrFacturaVenta['Fecha_factura'] = $_POST['Fecha_factura'];
            $arrFacturaVenta['Id_cliente'] =$_POST['Id_cliente'];
            $arrFacturaVenta['Id_vendedor'] =$_POST['Id_vendedor'];
            $FacturaVenta = new FacturaVenta($arrFacturaVenta);
            $idFacturaCom=$FacturaVenta->insertar();
            echo $idFacturaCom;
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
        $arrayFacturaVenta=FacturaVenta::getAll();
        $ultimoRegistro=end($arrayFacturaVenta);
        $nfactura="";
        if($ultimoRegistro!=""){
            $nfactura="FV-00";
            $ultimoId=$ultimoRegistro->getIdFacturaVenta();
            $ultimoId=$ultimoId+1;
            $nfactura.=$ultimoId;
        }else{
            $nfactura="FV-001";
        }
        echo $nfactura;
    }




}