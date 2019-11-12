<?php
if(session_status() == PHP_SESSION_NONE){ //Si la session no ha iniciado
    session_start();
}
require (__DIR__.'/../vendor/autoload.php'); //Requerido para convertir un objeto en Array
require_once (__DIR__.'/../Modelo/Persona.php');

use Zend\Hydrator\ReflectionHydrator; //Requerido para convertir un objeto en Arra

if(!empty($_GET['action'])){
    PersonaController::main($_GET['action']);
}else{
}


class PersonaController
{

    static function main($action)
    {
        if ($action == "crear") {
            PersonaController::crear();
        } else if ($action == "editar") {
            PersonaController::editar();
        } else if ($action == "buscarID") {
            PersonaController::buscarID($_REQUEST['Id_persona']);
        } else if ($action == "ActivarPersona") {
            PersonaController::ActivarPersona();
        } else if ($action == "InactivarPersona") {
            PersonaController::InactivarPersona();
        }
    }

    static public function crear()
    {

        try {
            $arrayPersona = array();
            $arrayPersona['Nombre_persona'] = $_POST['Nombre_persona'];
            $arrayPersona['Apellidos_persona'] = $_POST['Apellidos_persona'];
            $arrayPersona['Tipo_Documento'] = $_POST['Tipo_Documento'];
            $arrayPersona['Documento_Persona'] = $_POST['Documento_Persona'];
            $arrayPersona['Email_persona'] = $_POST['Email_persona'];
            $arrayPersona['Contraseña'] = $_POST['Contraseña'];
            $arrayPersona['Rol'] = $_POST['Rol'];
            $arrayPersona['Estado'] = 'Activo';
            $Persona = new Persona($arrayPersona);
            if ($Persona->insertar()){
                header("Location: ../Vista/modules/persona/manager.php");
            }else{
                echo "Error al insertar";
            }
        } catch (Exception $e) {
            //var_dump($e);
            header("Location: ");
        }

    }

    public static function personaIsArray($Id_persona, $ArrayPersona){
        if (count($ArrayPersona) > 0) {
            foreach ($ArrayPersona as $Persona) {
                if ($Persona->getIdPersona() == $Id_persona) {
                    return true;
                }
            }
        }
        return false;
    }

    static public  function editar(){
        try{
            $arrayPersona = array();
            $arrayPersona['Nombre_persona'] = $_POST['Nombre_persona'];
            $arrayPersona['Apellidos_persona'] = $_POST['Apellidos_persona'];
            $arrayPersona['Tipo_Documento'] = $_POST['Tipo_Documento'];
            $arrayPersona['Documento_Persona'] = $_POST['Documento_Persona'];
            $arrayPersona['Email_persona'] = $_POST['Email_persona'];
            $arrayPersona['Contraseña'] = $_POST['Contraseña'];
            $arrayPersona['Rol'] = $_POST['Rol'];
             $arrayPersona['Estado'] = "Activo";
            $arrayPersona['Id_persona'] = $_POST['Id_persona'];
            $persona = new Persona($arrayPersona);
            $persona->editar();
           header("Location: ../Vista/modules/persona/view.php?id=".$persona->getIdPersona()."");
        }catch (Exception $e){
            var_dump($e);
        }
    }

    static public function buscarID ($id){
        try {
            return Persona::buscarForId($id);
        } catch (Exception $e) {
            header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

    static public function ActivarPersona(){
        try{
            $ObjPersona = Persona::buscarForId($_GET['Id_persona']);
            header("Location: ../Vista/modules/persona/manager.php");
            $ObjPersona->setEstado("Activo");
            $ObjPersona->editar();
        }catch (Exception $e){
            var_dump($e);
        }
    }

    static public function InactivarPersona (){
        try {
            $ObjPersona = Persona::buscarForId($_GET['Id_persona']);
            $ObjPersona->setEstado("Inactivo");
            $ObjPersona->editar();
            header("Location: ../Vista/modules/persona/manager.php");
        } catch (Exception $e) {
            var_dump($e);
            //header("Location: ../Vista/modules/persona/manager.php?respuesta=error");
        }
    }

}
























