<?php

require_once('Conexion.php');
require_once ("Producto.php");
require_once ("Persona.php");
require_once ("Proveedor.php");

class FacturaCompra  extends Conexion
{

    private $Id_factura_compra;
    private $N_Factura_Compra;
    private $Fecha_compra;
    private $Id_Proveedor;
    private $Id_persona;


    public function __construct($FacturaCompra = array())
    {
        parent::__construct();
        if (count($FacturaCompra) > 1) {
            foreach ($FacturaCompra as $campo => $valor) {
                $this->$campo = $valor;
                if($campo == 'Id_Proveedor'){
                    $arrProveedor = Proveedor::buscar("SELECT * FROM proveedor WHERE Nit_Proveedor='$valor'");
                    foreach ($arrProveedor as $Proveedor){
                        $this->Id_Proveedor=$Proveedor;
                    }

                }
                if( $campo == 'Id_persona'){
                    $this->Id_persona = Persona::buscarForId($valor);
                }
            }
        } else {
            $this-> Id_factura_compra= "";
            $this->N_Factura_Compra="";
            $this-> Fecha_compra = "";
            $this-> Id_Proveedor = new Proveedor();
            $this-> Id_persona = new Persona() ;


        }
    }

    /**
     * @return string
     */
    public function getNFacturaCompra()
    {
        return $this->N_Factura_Compra;
    }

    /**
     * @param string $N_Factura_Compra
     */
    public function setNFacturaCompra($N_Factura_Compra)
    {
        $this->N_Factura_Compra = $N_Factura_Compra;
    }



    /**
     * @return string
     */
    public function getIdFacturaCompra()
    {
        return $this->Id_factura_compra;
    }

    /**
     * @param string $Id_factura_compra
     */
    public function setIdFacturaCompra($Id_factura_compra)
    {
        $this->Id_factura_compra = $Id_factura_compra;
    }

    /**
     * @return string
     */
    public function getFechaCompra()
    {
        return $this->Fecha_compra;
    }

    /**
     * @param string $Fecha_compra
     */
    public function setFechaCompra($Fecha_compra)
    {
        $this->Fecha_compra = $Fecha_compra;
    }

    /**
     * @return Proveedor
     */
    public function getIdProveedor()
    {
        return $this->Id_Proveedor;
    }

    /**
     * @param Proveedor $Id_Proveedor
     */
    public function setIdProveedor($Id_Proveedor)
    {
        $this->Id_Proveedor = $Id_Proveedor;
    }

    /**
     * @return Persona
     */
    public function getIdPersona()
    {
        return $this->Id_persona;
    }

    /**
     * @param Persona $Id_persona
     */
    public function setIdPersona($Id_persona)
    {
        $this->Id_persona = $Id_persona;
    }





    public static function buscarForId($id)
    {


        $FacturaCompra = new FacturaCompra();
        if ($id > 0) {
            $getrow = $FacturaCompra->getRow("SELECT * FROM factura_compra WHERE Id_factura_compra =?", array($id));;
            $FacturaCompra->Id_factura_compra = $getrow['Id_factura_compra'];
            $FacturaCompra->N_Factura_Compra=$getrow['N_Factura_Compra'];
            $FacturaCompra->Fecha_compra = $getrow['Fecha_compra'];
            $FacturaCompra->Id_Proveedor = Proveedor::buscarForId($getrow['Id_Proveedor']);
            $FacturaCompra->Id_persona = Persona::buscarForId($getrow['Id_persona']);

            $FacturaCompra->Disconnect();
            return $FacturaCompra;
            return NULL;
        }
    }

    public static function buscar($query){
        $arrFacturaCompra = array();
        $tmp = new  FacturaCompra();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor){
            $FacturaCompra = new FacturaCompra();
            $FacturaCompra-> Id_factura_compra= $valor['Id_factura_compra'];
            $FacturaCompra->N_Factura_Compra=$valor['N_Factura_Compra'];
            $FacturaCompra-> Fecha_compra= $valor['Fecha_compra'];
            $FacturaCompra->Id_Proveedor = Proveedor::buscarForId($valor['Id_Proveedor']);
            $FacturaCompra->Id_persona = Persona::buscarForId($valor['Id_persona']);

            $FacturaCompra->Disconnect();
            array_push($arrFacturaCompra, $FacturaCompra);
        }
        $tmp->Disconnect();
        return $arrFacturaCompra;
    }


    public static function getAll()
    {
        return FacturaCompra::buscar("SELECT * FROM factura_compra");
    }


    public function insertar()
    {
        $this->insertRow("INSERT INTO factura_compra VALUES (NULL, ?, ?, ?,?)", array(
                $this->N_Factura_Compra,
                $this->Fecha_compra,
                $this->Id_Proveedor->getIdProveedor(),
                $this->Id_persona->getIdPersona(),
            )
        );
        $id=$this->getLastId();
        $this->Disconnect();
        return $id;
    }

    public function editar()
    {
        $this->updateRow("UPDATE factura_compra SET  Fecha_compra= ?, Id_Proveedor = ?, Id_persona = ? WHERE Id_factura_compra= ?", array(
            $this->Fecha_compra,
            $this->Id_Proveedor->getIdProveedor(),
            $this->Id_persona->getIdPersona(),
            $this->Id_factura_compra
        ));
        $this->Disconnect();
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }







}
