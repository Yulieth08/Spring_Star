<?php

require_once('Conexion.php');

class Marca extends Conexion
{

    private $Id_Marca;
    private $Nombre_Marca;
    private $Estado;


    public function __construct($Marca_data = array())
    {
        parent::__construct();
        if (count($Marca_data) >= 1) {
            foreach ($Marca_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->Id_Marca = "";
            $this->Nombre_Marca = "";
            $this->Estado = "";

        }
    }

    /**
     * @return string
     */
    public function getIdMarca()
    {
        return $this->Id_Marca;
    }

    /**
     * @param string $Id_Marca
     */
    public function setIdMarca($Id_Marca)
    {
        $this->Id_Marca = $Id_Marca;
    }

    /**
     * @return string
     */
    public function getNombreMarca()
    {
        return $this->Nombre_Marca;
    }

    /**
     * @param string $Nombre_Marca
     */
    public function setNombreMarca($Nombre_Marca)
    {
        $this->Nombre_Marca = $Nombre_Marca;
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
        $Marca = new Marca();
        if ($id > 0) {
            $getrow = $Marca->getRow("SELECT * FROM marca WHERE Id_Marca = ?", array($id));
            $Marca->Id_Marca = $getrow['Id_Marca'];
            $Marca->Nombre_Marca = $getrow['Nombre_Marca'];
            $Marca->Estado = $getrow['Estado'];


        }
        return $Marca;
    }

    public  static function buscar($query)
    {
        $arrayMarca = array();
        $tmp = new  Marca();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Marca= new Marca();
            $Marca->Id_Marca = $valor['Id_Marca'];
            $Marca->Nombre_Marca = $valor['Nombre_Marca'];
            $Marca->Estado = $valor['Estado'];


            $Marca->Disconnect();
            array_push($arrayMarca, $Marca);
        }
        $tmp-> Disconnect();

        return $arrayMarca;
    }

    public    static function getAll()
    {
        return Marca::buscar("SELECT * FROM marca");
    }

    public   function insertar()
    {
        $result = $this->insertRow("INSERT INTO marca VALUES (NULL, ?,?)", array(
                $this->Nombre_Marca,
                $this->Estado,

            )
        );
        $this->Disconnect();
        return $result;
    }

    public  function editar()
    {
        $this->updateRow("UPDATE marca SET  Nombre_Marca = ? , Estado=? WHERE Id_Marca = ?", array(
            $this->Nombre_Marca,
            $this->Estado,
            $this->Id_Marca
        ));
        $this->Disconnect();
    }

    protected
    function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }

}



