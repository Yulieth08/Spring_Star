<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/Proveedor.php');

use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Array

if(!empty($_GET['action'])){
    ProveedorController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
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
            ProveedorController::buscarID($_REQUEST['Id_Proveedor']);
            }
    }

    static public function crear()
    {

        try {
            $arrayProve = array();
            $arrayProve['Nit_proveedor'] = $_POST['Nit_proveedor'];
            $arrayProve['Nombre_proveedor'] = $_POST['Nombre_proveedor'];
            $arrayProve['Telefono_proveedor'] = $_POST['Telefono_proveedor'];
            $arrayProve['Direccion_Proveedor'] = $_POST['Direccion_Proveedor'];
            $Prove = new Proveedor($arrayProve);
            if ($Prove->insertar()){
                header("Location: ../Vista/modules/Proveedor/manager.php?respuesta=correcto");
            }else{
                echo "Error al insertar";
            }
        } catch (Exception $e) {
            var_dump($e);
            header("Location: ../Vista/modules/proveedor/manager.php");
        }

    }

    public static function ProveIsArray($Id_Proveedor, $arrayProve){
        if (count($arrayProve) > 0) {
            foreach ($arrayProve as $Prove) {
                if ($Prove->getIdProveedor() == $Id_Proveedor) {
                    return true;
                }
            }
        }
        return false;
    }

    static public  function editar(){
        try{
            $arrayProve = array();
            $arrayProve['Nit_proveedor'] = $_POST['Nit_proveedor'];
            $arrayProve['Nombre_proveedor'] = $_POST['Nombre_proveedor'];
            $arrayProve['Telefono_proveedor'] = $_POST['Telefono_proveedor'];
            $arrayProve['Direccion_Proveedor'] = $_POST['Direccion_Proveedor'];
            $Prove = new Proveedor($arrayProve);
            $Prove->editar();
            header("Location: ../Vista/modules/Proveedor/view.php?id=".$Prove->getId_Proveedor()."");
        }catch (Exception $e){
            var_dump($e);
        }
    }

    static public function buscarID ($id){
        try {

            return Proveedor::buscarForId($id);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/Proveedor/manager.php?respuesta=error");
        }
    }

    }

