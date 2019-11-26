<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/Proveedor.php');

use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Arra

if(!empty($_GET['action'])){
    ProveedorController::main($_GET['action']);
}else{
}


class ProveedorController
{

    static function main($action)
    {
        if ($action == "crear") {
            ProveedorController::crear();
        } else if ($action == "editar") {
            ProveedorController::editar();
        } else if ($action == "buscarID") {
            ProveedorController::buscarID($_REQUEST['Id_persona']);
        } else if ($action == "ActivarProveedor") {
            ProveedorController::ActivarProveedor();
        } else if ($action == "InactivarProveedor") {
            ProveedorController::InactivarProveedor();
        }else if ($action == "ValidarNit") {
            ProveedorController::ValidarNit();
        }else if ($action == "validarProveedor") {
            ProveedorController::validarProveedor();
        }
    }

    static public function crear()
    {

        try {
            $arrayProveedor = array();
            $arrayProveedor['Nit_Proveedor'] = $_POST['Nit_Proveedor'];
            $arrayProveedor['Nombre_Proveedor'] = $_POST['Nombre_Proveedor'];
            $arrayProveedor['Telefono_Proveedor'] = $_POST['Telefono_Proveedor'];
            $arrayProveedor['Direccion_Proveedor'] = $_POST['Direccion_Proveedor'];
            $arrayProveedor['Estado'] = 'Activo';
            $Proveedor = new Proveedor ($arrayProveedor);
            if ($Proveedor->insertar()){
                header("Location: ../Vista/modules/proveedor/manager.php");
            }else{
                echo "Error al insertar";
            }
        } catch (Exception $e) {
            //var_dump($e);
            header("Location: ");
        }

    }

    public static function proveedorIsArray($Id_Proveedor, $arrayProveedor){
        if (count($arrayProveedor) > 0) {
            foreach ($arrayProveedor as $Proveedor) {
                if ($Proveedor->getIdProveedor() == $Id_Proveedor) {
                    return true;
                }
            }
        }
        return false;
    }

    static public  function editar(){
        try{
            $arrayProveedor = array();
            $arrayProveedor['Nit_Proveedor'] = $_POST['Nit_Proveedor'];
            $arrayProveedor['Nombre_Proveedor'] = $_POST['Nombre_Proveedor'];
            $arrayProveedor['Telefono_Proveedor'] = $_POST['Telefono_Proveedor'];
            $arrayProveedor['Direccion_Proveedor'] = $_POST['Direccion_Proveedor'];
            $arrayProveedor['Estado'] = "Activo";
            $arrayProveedor['Id_Proveedor'] = $_POST['Id_Proveedor'];
            $Proveedor = new Proveedor($arrayProveedor);
            $Proveedor->editar();
            header("Location: ../Vista/modules/proveedor/view.php?id=".$Proveedor->getIdProveedor()."");
        }catch (Exception $e){
            var_dump($e);
        }
    }

    static public function buscarID ($id){
        try {
            return Proveedor::buscarForId($id);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/proveedor/manager.php?respuesta=error");
        }
    }

    static public function ActivarProveedor(){
        try{
            $ObjProveedor = Proveedor::buscarForId($_GET['Id_Proveedor']);
            header("Location: ../Vista/modules/proveedor/manager.php");
            $ObjProveedor->setEstado("Activo");
            $ObjProveedor->editar();
        }catch (Exception $e){
            var_dump($e);
        }
    }

    static public function InactivarProveedor (){
        try {
            $ObjProveedor = Proveedor::buscarForId($_GET['Id_Proveedor']);
            $ObjProveedor->setEstado("Inactivo");
            $ObjProveedor->editar();
            header("Location: ../Vista/modules/proveedor/manager.php");
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }


    static public function ValidarNit (){
        $doc=$_POST['Nit'];
        $ObjProveedor = Proveedor::buscar("SELECT * FROM proveedor WHERE Nit_Proveedor='$doc'");
        if($ObjProveedor==null){
            echo 'Disponible';
        }else{
            echo 'No disponible';
        }
    }
    static public function validarProveedor(){
        $doc=$_POST['Nit'];
        $info="";
        if($doc!=""){
            $ObjProveedor = Proveedor::buscar("SELECT * FROM proveedor WHERE Nit_Proveedor='$doc'");
            if($ObjProveedor!=""){
                foreach ($ObjProveedor as $Proveedor) {

                    $info=$Proveedor->getNombreProveedor().','.$Proveedor->getTelefonoProveedor();
                }
            }
        }
        echo $info;

    }
}
























