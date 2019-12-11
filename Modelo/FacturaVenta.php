<?php

require_once('Conexion.php');
require_once ("Producto.php");
require_once ("Persona.php");
require_once ("Proveedor.php");

class FacturaVenta  extends Conexion
{

    private $Id_Factura_venta;
    private $N_Factura_venta;
    private $Fecha_factura;
    private $Id_cliente;
    private $Id_vendedor;


    public function __construct($FacturaVenta = array())
    {
        parent::__construct();
        if (count($FacturaVenta) > 1) {
            foreach ($FacturaVenta as $campo => $valor) {
                $this->$campo = $valor;

                if($campo == 'Id_cliente'){
                        $this->Id_cliente=Persona::buscarForId($valor);
                }

                if( $campo == 'Id_vendedor'){
                    $this->Id_vendedor = Persona::buscarForId($valor);
                }


            }
        } else {
            $this-> Id_Factura_venta= "";
            $this->N_Factura_venta="";
            $this-> Fecha_factura = "";
            $this-> Id_cliente = new Persona();
            $this-> Id_vendedor = new Persona() ;


        }
    }

    /**
     * @return string
     */
    public function getIdFacturaVenta()
    {
        return $this->Id_Factura_venta;
    }

    /**
     * @param string $Id_Factura_venta
     */
    public function setIdFacturaVenta($Id_Factura_venta)
    {
        $this->Id_Factura_venta = $Id_Factura_venta;
    }

    /**
     * @return string
     */
    public function getNFacturaVenta()
    {
        return $this->N_Factura_venta;
    }

    /**
     * @param string $N_Factura_Venta
     */
    public function setNFacturaVenta($N_Factura_venta)
    {
        $this->N_Factura_venta = $N_Factura_venta;
    }

    /**
     * @return string
     */
    public function getFechaFactura()
    {
        return $this->Fecha_factura;
    }

    /**
     * @param string $Fecha_factura
     */
    public function setFechaFactura($Fecha_factura)
    {
        $this->Fecha_factura = $Fecha_factura;
    }

    /**
     * @return Persona
     */
    public function getIdCliente()
    {
        return $this->Id_cliente;
    }

    /**
     * @param Persona $Id_cliente
     */
    public function setIdCliente($Id_cliente)
    {
        $this->Id_cliente = $Id_cliente;
    }

    /**
     * @return Persona
     */
    public function getIdVendedor()
    {
        return $this->Id_vendedor;
    }

    /**
     * @param Persona $Id_vendedor
     */
    public function setIdVendedor($Id_vendedor)
    {
        $this->Id_vendedor = $Id_vendedor;
    }


    public static function buscarForId($id)
    {
        $FacturaVenta = new FacturaVenta();
        if ($id > 0) {
            $getrow = $FacturaVenta->getRow("SELECT * FROM factura_venta WHERE Id_Factura_venta =?", array($id));;
            $FacturaVenta->Id_Factura_venta = $getrow['Id_factura_venta'];
            $FacturaVenta->N_Factura_venta=$getrow['N_Factura_venta'];
            $FacturaVenta->Fecha_factura = $getrow['Fecha_venta'];
            $FacturaVenta->Id_cliente = Persona::buscarForId($getrow['Id_cliente']);
            $FacturaVenta->Id_vendedor = Persona::buscarForId($getrow['Id_vendedor']);

            $FacturaVenta->Disconnect();
            return $FacturaVenta;
            return NULL;
        }
    }

    public static function buscar($query){
        $arrFacturaVenta = array();
        $tmp = new  FacturaVenta();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor){
            $FacturaVenta = new FacturaVenta();
            $FacturaVenta-> Id_Factura_venta= $valor['Id_Factura_venta'];
            $FacturaVenta->N_Factura_Venta=$valor['N_Factura_venta'];
            $FacturaVenta-> Fecha_factura= $valor['Fecha_factura'];
            $FacturaVenta->Id_cliente = Persona::buscarForId($valor['Id_cliente']);
            $FacturaVenta->Id_vendedor = Persona::buscarForId($valor['Id_vendedor']);
            $FacturaVenta->Disconnect();
            array_push($arrFacturaVenta, $FacturaVenta);
        }
        $tmp->Disconnect();
        return $arrFacturaVenta;
    }


    public static function getAll()
    {
        return FacturaVenta::buscar("SELECT * FROM factura_venta");
    }


    public function insertar()
    {
        $this->insertRow("INSERT INTO factura_venta VALUES (NULL, ?, ?, ?,?)", array(
                $this->N_Factura_venta,
                $this->Fecha_factura,
                $this->Id_cliente->getIdPersona(),
                $this->Id_vendedor->getIdPersona(),
            )
        );
        $id=$this->getLastId();
        $this->Disconnect();
        return $id;
    }

    public function editar()
    {
        $this->updateRow("UPDATE factura_venta SET  N_Factura_Venta= ?, Fecha_factura = ?, Id_cliente = ? , Id_vendedor = ? WHERE Id_Factura_venta= ?", array(
            $this->N_Factura_Venta,
            $this->Fecha_factura,
            $this->Id_cliente->getIdPersona(),
            $this->Id_vendedor->getIdPersona(),
            $this->Id_Factura_venta
        ));
        $this->Disconnect();
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }







}

