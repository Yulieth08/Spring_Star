<?php

require('Conexion.php');

class Persona extends Conexion
{

    private $Id_persona;
    private $Nombre_persona;
    private $Apellidos_persona;
    private $Tipo_Documento;
    private $Documento_Persona;
    private $Email_persona;
    private $Contraseña;
    private $Rol;
    private $Telefono_Persona;
    private $Direccion_Persona;
    private $Estado;

    public function __construct($persona_data = array())
    {
        parent::__construct();
        if (count($persona_data) > 1) {
            foreach ($persona_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->Id_persona = "";
            $this-> Nombre_persona= "";
            $this-> Apellidos_persona= "";
            $this->Tipo_Documento = "";
            $this->Documento_Persona = "";
            $this->Email_persona = "";
            $this->Contraseña = "";
            $this->Rol = "";
            $this->Estado = "";
            $this->Telefono_Persona = "";
            $this-> Direccion_Persona= "";
        }
    }

    /**
     * @return string
     */
    public function getIdPersona()
    {
        return $this->Id_persona;
    }

    /**
     * @param string $Id_persona
     */
    public function setIdPersona($Id_persona)
    {
        $this->Id_persona = $Id_persona;
    }

    /**
     * @return string
     */
    public function getNombrePersona()
    {
        return $this->Nombre_persona;
    }

    /**
     * @param string $Nombre_persona
     */
    public function setNombrePersona($Nombre_persona)
    {
        $this->Nombre_persona = $Nombre_persona;
    }

    /**
     * @return string
     */
    public function getApellidosPersona()
    {
        return $this->Apellidos_persona;
    }

    /**
     * @param string $Apellidos_persona
     */
    public function setApellidosPersona($Apellidos_persona)
    {
        $this->Apellidos_persona = $Apellidos_persona;
    }

    /**
     * @return string
     */
    public function getTipoDocumento()
    {
        return $this->Tipo_Documento;
    }

    /**
     * @param string $Tipo_Documento
     */
    public function setTipoDocumento($Tipo_Documento)
    {
        $this->Tipo_Documento = $Tipo_Documento;
    }

    /**
     * @return string
     */
    public function getDocumentoPersona()
    {
        return $this->Documento_Persona;
    }

    /**
     * @param string $Documento_Persona
     */
    public function setDocumentoPersona($Documento_Persona)
    {
        $this->Documento_Persona = $Documento_Persona;
    }

    /**
     * @return string
     */
    public function getEmailPersona()
    {
        return $this->Email_persona;
    }

    /**
     * @param string $Email_persona
     */
    public function setEmailPersona($Email_persona)
    {
        $this->Email_persona = $Email_persona;
    }

    /**
     * @return string
     */
    public function getContraseña()
    {
        return $this->Contraseña;
    }

    /**
     * @param string $Contraseña
     */
    public function setContraseña($Contraseña)
    {
        $this->Contraseña = $Contraseña;
    }


    /**
     * @return string
     */
    public function getRol()
    {
        return $this->Rol;
    }

    /**
     * @param string $Rol
     */
    public function setRol($Rol)
    {
        $this->Rol = $Rol;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param string $Estado
     */
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    /**
     * @return string
     */
    public function getTelefonoPersona()
    {
        return $this->Telefono_Persona;
    }

    /**
     * @param string $Telefono_Persona
     */
    public function setTelefonoPersona($Telefono_Persona)
    {
        $this->Telefono_Persona = $Telefono_Persona;
    }

    /**
     * @return string
     */
    public function getDireccionPersona()
    {
        return $this->Direccion_Persona;
    }

    /**
     * @param string $Direccion_Persona
     */
    public function setDireccionPersona($Direccion_Persona)
    {
        $this->Direccion_Persona = $Direccion_Persona;
    }



    public static function buscarForId($id)
    {
        $Persona = new Persona();
        if ($id > 0){
            $getrow = $Persona->getRow("SELECT * FROM persona WHERE Id_persona = ?", array($id));
            $Persona->Id_persona = $getrow['Id_persona'];
            $Persona->Nombre_persona = $getrow['Nombre_persona'];
            $Persona->Apellidos_persona = $getrow['Apellidos_persona'];
            $Persona->Tipo_Documento= $getrow['Tipo_Documento'];
            $Persona->Documento_Persona = $getrow['Documento_Persona'];
            $Persona->Email_persona = $getrow['Email_persona'];
            $Persona->Contraseña = $getrow['Contraseña'];
            $Persona->Rol = $getrow['Rol'];
            $Persona->Estado = $getrow['Estado'];
            $Persona->Telefono_Persona = $getrow['Telefono_Persona'];
            $Persona->Direccion_Persona = $getrow['Direccion_Persona'];
        }
        return $Persona;
    }

    public static function buscar($query){
        $arrPersona = array();
        $tmp = new  Persona();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor){
            $Persona = new Persona();
            $Persona-> Id_persona= $valor['Id_persona'];
            $Persona-> Nombre_persona= $valor['Nombre_persona'];
            $Persona-> Apellidos_persona= $valor['Apellidos_persona'];
            $Persona-> Tipo_Documento= $valor['Tipo_Documento'];
            $Persona-> Documento_Persona= $valor['Documento_Persona'];
            $Persona-> Email_persona= $valor['Email_persona'];
            $Persona-> Contraseña= $valor['Contraseña'];
            $Persona-> Rol= $valor['Rol'];
            $Persona->Estado = $valor['Estado'];
            $Persona-> Telefono_Persona= $valor['Telefono_Persona'];
            $Persona-> Direccion_Persona= $valor['Direccion_Persona'];
            $Persona->Disconnect();
            array_push($arrPersona, $Persona);
        }
        $tmp->Disconnect();
        return $arrPersona;
    }

    public static function getAll()
    {
        return Persona::buscar("SELECT * FROM persona");
    }

    public function insertar()
    {
        $result = $this->insertRow("INSERT INTO persona VALUES (NULL, ?, ?, ?, ?, ?, ?, ?,?,?,?)", array(
                $this->Nombre_persona,
                $this->Apellidos_persona,
                $this->Tipo_Documento,
                $this->Documento_Persona,
                $this->Email_persona,
                $this->Contraseña,
                $this->Rol,
                $this->Estado,
                $this->Telefono_Persona,
                $this->Direccion_Persona,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public function editar()
    {
        $this->updateRow("UPDATE persona SET Nombre_persona = ?, Apellidos_persona = ?, Tipo_Documento = ?, Documento_Persona = ?,  Email_persona= ?,Contraseña  = ?, Rol= ?,  Estado = ?,Telefono_Persona = ? , Direccion_Persona = ? WHERE Id_persona = ?", array(
            $this->Nombre_persona,
            $this->Apellidos_persona,
            $this->Tipo_Documento,
            $this->Documento_Persona,
            $this->Email_persona,
            $this->Contraseña,
            $this->Rol,
            $this->Estado,
            $this->Telefono_Persona,
            $this->Direccion_Persona,
            $this->Id_persona
        ));
        $this->Disconnect();
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }



    public function Login($Email_persona, $Contraseña){
        $tmp = new Persona();
        $resultPersonas = $tmp->getRows("SELECT * FROM persona WHERE Email_persona = '$Email_persona'");
        if(count($resultPersonas) >= 1){
            $getrows = $tmp->getRows("SELECT * FROM persona WHERE Email_persona = '$Email_persona' AND Contraseña = '$Contraseña'");
            if(count($getrows) >= 1){
                foreach ($getrows as $valor) {
                    $resultPersonas = new Persona($valor);
                    return $resultPersonas;
                }
            }else{
                return "Contraseña Incorrecta";
            }
        }else{
            return "Usuario Incorrecto";
        }
        $tmp->Disconnect();
        return null;
    }

}