<?php

require_once('Conexion.php');
require_once ("Producto.php");
require_once ("Persona.php");
require_once ("FacturaCompra.php");


class ProductosComprados  extends Conexion
{

    private $Id_Productos_Comprados;
    private $Cantidad_Inicial;
    private $Cantidad_productos;
    private $Precio_compra;
    private $Precio_venta;
    private $Color;
    private $Talla;
    private $Id_factura_compra;
    private $Id_producto;


    public function __construct($Productos_Comprados = array())
    {
        parent::__construct();
        if (count($Productos_Comprados) > 1) {
            foreach ($Productos_Comprados as $campo => $valor) {
                $this->$campo = $valor;
                if( $campo == 'Id_producto'){
                    $arrproducto=Producto::buscar("SELECT * FROM producto WHERE Codigo_producto='$valor'");
                    foreach ($arrproducto as $Producto){
                        $this->Id_producto = $Producto;
                    }

                }
            }
        } else {
            $this->Id_Productos_Comprados = "";
            $this->Cantidad_Inicial = "";
            $this->Cantidad_productos = "";
            $this->Precio_compra  = "";
            $this->Precio_venta  = "";
            $this-> Color = "";
            $this-> Talla = "";
            $this->Id_factura_compra  = new FacturaCompra();
            $this->Id_producto  = new Producto() ;


        }
    }

    /**
     * @return string
     */
    public function getIdProductosComprados()
    {
        return $this->Id_Productos_Comprados;
    }

    /**
     * @param string $Id_Productos_Comprados
     */
    public function setIdProductosComprados($Id_Productos_Comprados)
    {
        $this->Id_Productos_Comprados = $Id_Productos_Comprados;
    }

    /**
     * @return string
     */
    public function getCantidadInicial()
    {
        return $this->Cantidad_Inicial;
    }

    /**
     * @param string $Cantidad_Incial
     */
    public function setCantidadInicial($Cantidad_Inicial)
    {
        $this->Cantidad_Inicial = $Cantidad_Inicial;
    }

    /**
     * @return string
     */
    public function getCantidadProductos()
    {
        return $this->Cantidad_productos;
    }

    /**
     * @param string $Cantidad_productos
     */
    public function setCantidadProductos($Cantidad_productos)
    {
        $this->Cantidad_productos = $Cantidad_productos;
    }

    /**
     * @return string
     */
    public function getPrecioCompra()
    {
        return $this->Precio_compra;
    }

    /**
     * @param string $Precio_compra
     */
    public function setPrecioCompra($Precio_compra)
    {
        $this->Precio_compra = $Precio_compra;
    }

    /**
     * @return string
     */
    public function getPrecioVenta()
    {
        return $this->Precio_venta;
    }

    /**
     * @param string $Precio_venta
     */
    public function setPrecioVenta($Precio_venta)
    {
        $this->Precio_venta = $Precio_venta;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->Color;
    }

    /**
     * @param string $Color
     */
    public function setColor($Color)
    {
        $this->Color = $Color;
    }

    /**
     * @return string
     */
    public function getTalla()
    {
        return $this->Talla;
    }

    /**
     * @param string $Talla
     */
    public function setTalla($Talla)
    {
        $this->Talla = $Talla;
    }

    /**
     * @return FacturaCompra
     */
    public function getIdFacturaCompra()
    {
        return $this->Id_factura_compra;
    }

    /**
     * @param FacturaCompra $Id_factura_compra
     */
    public function setIdFacturaCompra($Id_factura_compra)
    {
        $this->Id_factura_compra = $Id_factura_compra;
    }

    /**
     * @return Producto
     */
    public function getIdProducto()
    {
        return $this->Id_producto;
    }

    /**
     * @param Producto $Id_producto
     */
    public function setIdProducto($Id_producto)
    {
        $this->Id_producto = $Id_producto;
    }


    public static function buscarForId($id)
    {


        $Productos_Comprados = new Productos_Comprados();
        if ($id > 0) {
            $getrow = $Productos_Comprados->getRow("SELECT * FROM productos_comprados WHERE Id_Productos_Comprados =?", array($id));;
            $Productos_Comprados->Id_Productos_Comprados = $getrow['Id_Productos_Comprados'];
            $Productos_Comprados-> Cantidad_Inicial= $getrow['Cantidad_Inicial'];
            $Productos_Comprados->Cantidad_productos = $getrow['Cantidad_productos'];
            $Productos_Comprados->Precio_compra = $getrow['Precio_compra'];
            $Productos_Comprados->Precio_venta = $getrow['Precio_venta'];
            $Productos_Comprados->Color = $getrow['Color'];
            $Productos_Comprados->Talla = $getrow['Talla'];
            $Productos_Comprados->Id_factura_compra = FacturaCompra::buscarForId($getrow['Id_factura_compra']);
            $Productos_Comprados->Id_producto = Producto::buscarForId($getrow['Id_producto']);

            $Productos_Comprados->Disconnect();
            return $Productos_Comprados;
            return NULL;
        }
    }

    public static function buscar($query){
        $arrProductosComprados = array();
        $tmp = new  ProductosComprados();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor){
            $ProductosComprados = new ProductosComprados();
            $ProductosComprados-> Id_Productos_Comprados= $valor['Id_Productos_Comprados'];
            $ProductosComprados-> Cantidad_Inicial= $valor['Cantidad_Inicial'];
            $ProductosComprados-> Cantidad_productos= $valor['Cantidad_productos'];
            $ProductosComprados-> Precio_compra= $valor['Precio_compra'];
            $ProductosComprados-> Precio_venta= $valor['Precio_venta'];
            $ProductosComprados-> Color= $valor['Color'];
            $ProductosComprados-> Talla= $valor['Talla'];
            $ProductosComprados->Id_factura_compra = FacturaCompra::buscarForId($valor['Id_factura_compra']);
            $ProductosComprados->Id_producto = Producto::buscarForId($valor['Id_producto']);

            $ProductosComprados->Disconnect();
            array_push($arrProductosComprados, $ProductosComprados);
        }
        $tmp->Disconnect();
        return $arrProductosComprados;
    }


    public static function getAll()
    {
        return Productos_Comprados::buscar("SELECT * FROM productos_comprados");
    }


    public function insertar()
    {
        $result = $this->insertRow("INSERT INTO productos_comprados VALUES (NULL, ?, ?, ?,?,?,?,?,?)", array(
                $this->Cantidad_Inicial,
                $this->Cantidad_productos,
                $this->Precio_compra,
                $this->Precio_venta,
                $this->Color,
                $this->Talla,
                $this->Id_factura_compra,
                $this->Id_producto->getIdProducto(),
            )
        );
        $this->Disconnect();
        return $result;
    }

    public function editar()
    {
        $this->updateRow("UPDATE productos_comprados SET  Cantidad_Inicial= ?, Cantidad_productos = ?, Precio_compra = ?,Precio_venta=? ,Color=?, Talla=?,Id_factura_compra=?,Id_producto=? WHERE Id_Productos_Comprados= ?", array(
            $this->Cantidad_Inicial,
            $this->Cantidad_productos,
            $this->Precio_compra,
            $this->Precio_venta,
            $this->Color,
            $this->Talla,
            $this->Id_factura_compra->getIdFacturaCompra(),
            $this->Id_producto->getIdProducto(),
            $this->Id_Productos_Comprados
        ));
        $this->Disconnect();
    }

    protected function eliminar($id)
    {
        // TODO: Implement eliminar() method.
    }





}
