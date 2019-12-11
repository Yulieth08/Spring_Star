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
        else if ($action == "ValidarDocumento") {
            PersonaController::ValidarDocumento();
        }
        else if ($action == "login"){
            PersonaController::login();
        }else if($action == "cerrarSession"){
            PersonaController::cerrarSession();
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
            $arrayPersona['Telefono_Persona'] = $_POST['Telefono_Persona'];
            $arrayPersona['Direccion_Persona'] = $_POST['Direccion_Persona'];
            $arrayPersona['Rol'] = $_POST['Rol'];
            $arrayPersona['Email_persona'] = $_POST['Email_persona'];
            $arrayPersona['Contraseña'] = $_POST['Contraseña'];
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
            $arrayPersona['Telefono_Persona'] = $_POST['Telefono_Persona'];
            $arrayPersona['Direccion_Persona'] = $_POST['Direccion_Persona'];
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

    static public function selectPersona ($isMultiple=false,
                                        $isRequired=true,
                                        $id="Id_persona",
                                        $nombre="Id_persona",
                                        $defaultValue="",
                                        $class="",
                                        $where="",
                                        $arrExcluir = array()){
        $arrayPersona = array();
        if($where != ""){
            $base = "SELECT * FROM persona WHERE ";
            $arrayPersona = Persona::buscar($base.$where);
        }else{
            $arrayPersona = Persona::getAll();
        }
        $htmlSelect = "<select ".(($isMultiple) ? "multiple" : "")." ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect.="<option selected disabled>Seleccionar</option>";
        if(count($arrayPersona) > 0){
            foreach ($arrayPersona as $Persona){
                if (!PersonaController::personaIsArray($Persona->getIdPersona(),$arrExcluir))
                    $htmlSelect .= "<option ".(($defaultValue != "") ? (($defaultValue == $Persona->getIdPersona()) ? "selected" : "" ) : "")." value='".$Persona->getIdPersona()."'>".$Persona->getDocumentoPersona()."</option>";
            }
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
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

    static public function ValidarDocumento (){
        $datos="";
        $doc=$_POST['documento'];
        $ObjPersona = Persona::buscar("SELECT * FROM persona WHERE Documento_Persona='$doc'");
        $datos="";
        if($ObjPersona!=null){

            foreach ($ObjPersona as $Persona){
                $nombre=$Persona->getNombrePersona();
                $telefono=$Persona->getTelefonoPersona();
                $direccion=$Persona->getDireccionPersona();
                $datos=$nombre.','.$telefono.','.$direccion;
            }
        }

        echo $datos;

    }

    public static function login (){
        try {
            if(!empty($_POST['Email_persona']) && !empty($_POST['Contraseña'])){
                $tmpPerson = new Persona();
                $respuesta = $tmpPerson->Login($_POST['Email_persona'], $_POST['Contraseña']);
                if (is_a($respuesta,"Persona")) {
                    $hydrator = new ReflectionHydrator(); //Instancia de la clase para convertir objetos
                    $ArrDataPersona = $hydrator->extract($respuesta); //Convertimos el objeto persona en un array
                    unset($ArrDataPersona["datab"],$ArrDataPersona["isConnected"],$ArrDataPersona["relEspecialidades"]); //Limpiamos Campos no Necesarios
                    $_SESSION['UserInSession'] = $ArrDataPersona;
                    header("Location: ../Vista/modules/persona/manager.php");

                }else{

                    header("Location: ../Vista/modules/persona/login.php?respuesta=error");

                }
                return $respuesta; //Si la llamada es por funcion
            }else{
                header('Location: ');
                return "Datos Vacios"; //Si la llamada es por funcion
            }
        } catch (Exception $e) {
            var_dump($e);
            header("Location: ../login.php?respuesta=error");
        }
    }

    public static function cerrarSession (){
        session_unset();
        session_destroy();
        header("Location: ../Vista/modules/persona/login.php");
    }



}
























