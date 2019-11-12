<?php

require('Conexion.php');

class Proveedor extends Conexion
{

    private $Id_Proveedor;
    private $Nit_Proveedor;
    private $Nombre_Proveedor;
    private $Telefono_Proveedor;
    private $Direccion_Proveedor;
    private $Estado;

    public function __construct($proveedor_data = array())
    {
        parent::__construct();
        if (count($proveedor_data) > 1) {
            foreach ($proveedor_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->Id_Proveedor = "";
            $this-> Nit_Proveedor= "";
            $this->Nombre_Proveedor = "";
            $this->Telefono_Proveedor = "";
            $this->Direccion_Proveedor = "";
            $this->Estado = "";
        }
    }

    /**
     * @return string
     */
    public function getIdProveedor()
    {
        return $this->Id_Proveedor;
    }

    /**
     * @param string $Id_Proveedor
     */
    public function setIdProveedor($Id_Proveedor)
    {
        $this->Id_Proveedor = $Id_Proveedor;
    }

    /**
     * @return string
     */
    public function getNitProveedor()
    {
        return $this->Nit_Proveedor;
    }

    /**
     * @param string $Nit_Proveedor
     */
    public function setNitProveedor($Nit_Proveedor)
    {
        $this->Nit_Proveedor = $Nit_Proveedor;
    }

    /**
     * @return string
     */
    public function getNombreProveedor()
    {
        return $this->Nombre_Proveedor;
    }

    /**
     * @param string $Nombre_Proveedor
     */
    public function setNombreProveedor($Nombre_Proveedor)
    {
        $this->Nombre_Proveedor = $Nombre_Proveedor;
    }

    /**
     * @return string
     */
    public function getTelefonoProveedor()
    {
        return $this->Telefono_Proveedor;
    }

    /**
     * @param string $Telefono_Proveedor
     */
    public function setTelefonoProveedor($Telefono_Proveedor)
    {
        $this->Telefono_Proveedor = $Telefono_Proveedor;
    }

    /**
     * @return string
     */
    public function getDireccionProveedor()
    {
        return $this->Direccion_Proveedor;
    }

    /**
     * @param string $Direccion_Proveedor
     */
    public function setDireccionProveedor($Direccion_Proveedor)
    {
        $this->Direccion_Proveedor = $Direccion_Proveedor;
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



    public static function buscarForId($id)
    {
        $Proveedor = new Proveedor();
        if ($id > 0){
            $getrow = $Proveedor->getRow("SELECT * FROM proveedor WHERE Id_Proveedor = ?", array($id));
            $Proveedor->Id_Proveedor = $getrow['Id_Proveedor'];
            $Proveedor->Nit_Proveedor = $getrow['Nit_Proveedor'];
            $Proveedor->Nombre_Proveedor = $getrow['Nombre_Proveedor'];
            $Proveedor->Telefono_Proveedor= $getrow['Telefono_Proveedor'];
            $Proveedor->Direccion_Proveedor = $getrow['Direccion_Proveedor'];
            $Proveedor->Estado = $getrow['Estado'];
        }
        return $Proveedor;
    }

    public static function buscar($query){
        $arrProveedor = array();
        $tmp = new  Proveedor();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor){
            $Proveedor = new Proveedor();
            $Proveedor-> Id_Proveedor= $valor['Id_Proveedor'];
            $Proveedor-> Nit_Proveedor= $valor['Nit_Proveedor'];
            $Proveedor-> Nombre_Proveedor= $valor['Nombre_Proveedor'];
            $Proveedor-> Telefono_Proveedor= $valor['Telefono_Proveedor'];
            $Proveedor-> Direccion_Proveedor= $valor['Direccion_Proveedor'];
            $Proveedor->Estado = $valor['Estado'];
            $Proveedor->Disconnect();
            array_push($arrProveedor, $Proveedor);
        }
        $tmp->Disconnect();
        return $arrProveedor;
    }

    public static function getAll()
    {
        return Proveedor::buscar("SELECT * FROM proveedor");
    }

    public function insertar()
    {
        $result = $this->insertRow("INSERT INTO proveedor VALUES (NULL, ?, ?, ?, ?, ?)", array(
                $this->Nit_Proveedor,
                $this->Nombre_Proveedor,
                $this->Telefono_Proveedor,
                $this->Direccion_Proveedor,
                $this->Estado,
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function editar()
    {
        $this->updateRow("UPDATE proveedor SET Nit_Proveedor = ?, Nombre_Proveedor = ?, Telefono_Proveedor = ?, Direccion_Proveedor = ?,  Estado = ? WHERE Id_Proveedor = ?", array(
            $this->Nit_Proveedor,
            $this->Nombre_Proveedor,
            $this->Telefono_Proveedor,
            $this->Direccion_Proveedor,
            $this->Estado,
            $this->Id_Proveedor
        ));
        $this->Disconnect();
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }





}