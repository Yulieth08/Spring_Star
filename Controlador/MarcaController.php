CONTROLADOR
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
        }
    }

    static public function crear()
    {

        try {
            $arrayMarca = array();
            $arrayMarca['Nombre_Marca'] = $_POST['Nombre_Marca'];
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



<<<<<<< HEAD
}
=======
}

>>>>>>> origin/master
