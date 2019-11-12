<?php

require_once('Conexion.php');
require_once ("Marca.php");


class Producto extends Conexion
{

    private $Id_producto;
    private $Codigo_producto;
    private $Tipo_producto;
    private $Estado;
    private $Id_Marca;


    public function __construct($Producto_data = array())
    {
        parent::__construct();
        if (count($Producto_data) > 1) {
            foreach ($Producto_data as $campo => $valor) {
                $this->$campo = $valor;
                if($campo == 'Id_Marca'){
                    $this->Id_Marca = Marca::buscarForId($valor);
                }
            }
        } else {
            $this-> Id_producto = "";
            $this-> Codigo_producto = "";
            $this-> Tipo_producto= "";
            $this->Estado = "";
            $this->Id_Marca = new Marca();

        }
    }

    /**
     * @return string
     */
    public function getIdProducto()
    {
        return $this->Id_producto;
    }

    /**
     * @param string $Id_producto
     */
    public function setIdProducto($Id_producto)
    {
        $this->Id_producto = $Id_producto;
    }

    /**
     * @return string
     */
    public function getCodigoProducto()
    {
        return $this->Codigo_producto;
    }

    /**
     * @param string $Codigo_producto
     */
    public function setCodigoProducto($Codigo_producto)
    {
        $this->Codigo_producto = $Codigo_producto;
    }

    /**
     * @return string
     */
    public function getTipoProducto()
    {
        return $this->Tipo_producto;
    }

    /**
     * @param string $Tipo_producto
     */
    public function setTipoProducto($Tipo_producto)
    {
        $this->Tipo_producto = $Tipo_producto;
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
     * @return Marca
     */
    public function getIdMarca()
    {
        return $this->Id_Marca;
    }

    /**
     * @param Marca $Id_Marca
     */
    public function setIdMarca($Id_Marca)
    {
        $this->Id_Marca = $Id_Marca;
    }






    public static function buscarForId($id)
    {


        $Producto = new Producto();
        if ($id > 0) {
            $getrow = $Producto->getRow("SELECT * FROM producto WHERE Id_producto =?", array($id));;
            $Producto->Id_producto = $getrow['Id_producto'];
            $Producto-> Codigo_producto= $getrow['Codigo_producto'];
            $Producto->Tipo_producto = $getrow['Tipo_producto'];
            $Producto->Estado = $getrow['Estado'];
            $Producto->Id_Marca = Marca::buscarForId($getrow['Id_Marca']);

            $Producto->Disconnect();
            return $Producto;
            return NULL;
        }
    }

    public static function buscar($query){
        $arrproducto = array();
        $tmp = new  Producto();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor){
            $Producto = new Producto();
            $Producto-> Id_producto= $valor['Id_producto'];
            $Producto-> Codigo_producto= $valor['Codigo_producto'];
            $Producto-> Tipo_producto= $valor['Tipo_producto'];
            $Producto->Estado = $valor['Estado'];
            $Producto->Id_Marca = Marca::buscarForId($valor['Id_Marca']);

            $Producto->Disconnect();
            array_push($arrproducto, $Producto);
        }
        $tmp->Disconnect();
        return $arrproducto;
    }


    public static function getAll()
    {
        return Producto::buscar("SELECT * FROM producto");
    }


    public function insertar()
    {
        $result = $this->insertRow("INSERT INTO producto VALUES (NULL, ?, ?, ?, ?)", array(
                $this->Codigo_producto,
                $this->Tipo_producto,
                $this->Estado,
                $this->Id_Marca->getIdMarca(),
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function editar()
    {
        $this->updateRow("UPDATE producto SET  Codigo_producto= ?, Tipo_producto = ?, Estado = ?, Id_Marca = ? WHERE Id_producto = ?", array(
            $this->Codigo_producto,
            $this->Tipo_producto,
            $this->Estado,
            $this->Id_Marca->getIdMarca(),
            $this->Id_producto
        ));
        $this->Disconnect();
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }





}
