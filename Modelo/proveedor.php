<?php

require ('Conexion.php');

class Proveedor extends Conexion{
    private $Id_proveedor;
    private $Nit_proveedor;
    private $Nombre_Proveedor;
    private $Telefono_Proveedor;
    private $Direccion_Proveedor;

    /**
     * @return bool
     */
    public function isConnected()
    {
        return $this->isConnected;
    }

    /**
     * @param bool $isConnected
     */
    public function setIsConnected($isConnected)
    {
        $this->isConnected = $isConnected;
    }

    /**
     * @return string
     */
    public function getIdProveedor()
    {
        return $this->Id_proveedor;
    }

    /**
     * @param string $Id_proveedor
     */
    public function setIdProveedor($Id_proveedor)
    {
        $this->Id_proveedor = $Id_proveedor;
    }

    /**
     * @return string
     */
    public function getNitProveedor()
    {
        return $this->Nit_proveedor;
    }

    /**
     * @param string $Nit_proveedor
     */
    public function setNitProveedor($Nit_proveedor)
    {
        $this->Nit_proveedor = $Nit_proveedor;
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


    public function __construct($Prove_data = array())
    {
        parent::__construct();
        if (count($Prove_data) > 1) {
            foreach ($Prove_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->Id_proveedor = "";
            $this->Nit_proveedor = "";
            $this->Nombre_Proveedor = "";
            $this->Telefono_Proveedor = "";
            $this->Direccion_Proveedor = "";

        }
    }


    public static function buscarForId($id)
    {

        $Prove = new Proveedor();

        if ($id > 0){
            $getrow = $Prove->getRow("SELECT * FROM proveedor WHERE Id_Proveedor = ?", array($id));
            $Prove->Id_proveedor = $getrow['Id_proveedor'];
            $Prove->Nit_proveedor = $getrow['Nit_proveedor'];
            $Prove->Nombre_Proveedor = $getrow['Nombre_Proveedor'];
            $Prove->Telefono_Proveedor = $getrow['Telefono_Proveedor'];
            $Prove->Direccion_Proveedor = $getrow['Direccion_Proveedor'];
            var_dump($Prove);
            die();
        }
        return $Prove;
    }

    public static function buscar($query)

        {
            $arrProve = array();
            $tmp = new  Proveedor();
            $getrows = $tmp->getRows($query);
            foreach ($getrows as $valor) {
                $Prove = new Proveedor();
                $Prove->Id_Proveedor = $valor['Id_proveedor'];
                $Prove->Nit_proveedor = $valor['Nit_proveedor'];
                $Prove->Nombre_proveedor = $valor['Nombre_Proveedor'];
                $Prove->Telefono_proveedor = $valor['Telefono_Proveedor'];
                $Prove->Direccion_Proveedor = $valor['Direccion_Proveedor'];
                $Prove->Disconnect();
                array_push($arrProve, $Prove);
            }
            $tmp->Disconnect();
            return $arrProve;
        }


    public static function getAll()
    {
        return Proveedor::buscar("SELECT * FROM proveedor");
    }

    public function insertar()
    {
        $result = $this->insertRow("INSERT INTO proveedor VALUES (NULL, ?, ?, ?, ?)", array(
            $this->Nit_proveedor,
            $this->Nombre_proveedor,
            $this->Telefono_proveedor,
            $this->Direccion_Proveedor,

        ));
        $this->Disconnect();
        return $result;

    }



    public function editar()
    {
        $this->updateRow("UPDATE proveedor SET Nit_proveedor= ?, Nombre_proveedor= ?, Telefono_proveedor= ? WHERE Id_Proveedor = ?", array(
            $this->Nit_proveedor,
            $this->Nombre_proveedor,
            $this->Telefono_proveedor,
            $this->Direccion_Proveedor,
            $this->Id_Proveedor

        ));
        $this->Disconnect();
    }

    public function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }


}