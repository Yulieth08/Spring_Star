<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/Marca.php');

use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Array

if(!empty($_GET['action'])){
    MarcaController::main($_GET['action']);
}else{
}
class Marcacontroller
{


    static function main($action)
    {
        if ($action == "crear") {
            MarcaController::crear();
        } else if ($action == "editar") {
            MarcaController::editar();
        } else if ($action == "buscarID") {
            MarcaController::buscarID($_REQUEST['Id_Marca']);
        }else if ($action == "ActivarMarca") {
            MarcaController::ActivarMarca();
        } else if ($action == "InactivarMarca") {
            MarcaController::InactivarMarca();
        }
    }

    static public function crear()
    {

        try {
            $arrayMarca = array();
            $arrayMarca['Nombre_Marca'] = $_POST['Nombre_Marca'];
            $arrayMarca['Estado'] = 'Activo';
            $Marca = new Marca($arrayMarca);
            if ($Marca->insertar()) {
                header("Location: ../Vista/modules/marca/manager.php");
            } else {
                echo "Error al insertar";

            }
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ");
        }
    }


    public static function MarcaIsArray($IdMarca, $ArrayMarca)
    {
        if (count($ArrayMarca) > 0) {
            foreach ($ArrayMarca as $Marca) {
                if ($Marca->getIdMarca() == $IdMarca) {
                    return true;
                }
            }
        }
        return false;
    }

    static public function editar()
    {
        try {
            $arrayMarca = array();
            $arrayMarca['Nombre_Marca'] = $_POST['Nombre_Marca'];
            $arrayMarca['Id_Marca'] = $_POST['Id_Marca'];
            $arrayMarca['Estado'] = $_POST['Estado'];
            $Marca = new Marca ($arrayMarca);
            $Marca->editar();
            header("Location: ../Vista/modules/marca/view.php?id=".$Marca->getIdMarca()."");
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    static public function buscarID($id)
    {
        try {

            return Marca::buscarforId($id);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/marca/manager.php?respuesta=error");
        }
    }


    static public function selectMarca ($isMultiple=false,
                                        $isRequired=true,
                                        $id="Id_Marca",
                                        $nombre="Id_Marca",
                                        $defaultValue="",
                                        $class="",
                                        $where="",
                                        $arrExcluir = array()){
        $arrMarca = array();
        if($where != ""){
            $base = "SELECT * FROM marca WHERE ";
            $arrMarca = marca::buscar($base.$where);
        }else{
            $arrMarca = marca::getAll();
        }
        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        if(count($arrMarca) > 0){
            foreach ($arrMarca as $Marca){
                if (!Marcacontroller::MarcaIsArray($Marca->getIdMarca(),$arrExcluir))
                    $htmlSelect .= "<option ".(($defaultValue != "") ? (($defaultValue == $Marca->getIdMarca()) ? "selected" : "" ) : "")." value='".$Marca->getIdMarca()."'>".$Marca->getNombreMarca()."</option>";
            }
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    static public function ActivarMarca(){
        try{
            $ObjMarca = Marca::buscarForId($_GET['Id_Marca']);
            header("Location: ../Vista/modules/marca/manager.php");
            $ObjMarca->setEstado("Activo");
            $ObjMarca->editar();
        }catch (Exception $e){
            var_dump($e);
        }
    }
    static public function InactivarMarca (){
        try {
            $ObjMarca = Marca::buscarForId($_GET['Id_Marca']);
            $ObjMarca->setEstado("Inactivo");
            $ObjMarca->editar();
            header("Location: ../Vista/modules/marca/manager.php");
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }



}
