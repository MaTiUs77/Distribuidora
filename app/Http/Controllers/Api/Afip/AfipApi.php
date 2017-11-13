<?php

namespace App\Http\Controllers\Api\Afip;

use App\Http\Controllers\Afip\AfipWs;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class AfipApi extends Controller
{
    private $client;
    private $afip;

    public function __construct()
    {
        $this->client = new  Client(['base_uri' => 'https://soa.afip.gob.ar/']);

        // CUIL DE LA EMPRESA QUE FACTURA
        $this->afip = new AfipWs(['CUIT' => 23314005309]);
    }

    public function persona($cuil) {
        return $this->client->get("sr-padron/v2/persona/$cuil");
    }

    public function actividades() {
        return $this->client->get("parametros/v1/actividades");
    }

    public function categoriasAutonomo() {
        return $this->client->get("parametros/v1/categoriasAutonomo");
    }

    public function categoriasMonotributo() {
        return $this->client->get("parametros/v1/categoriasMonotributo");
    }

    public function provincias(){
       return $this->client->get('parametros/v1/provincias');
    }

    /*
     * FACTUACION ELECTRONICA
     */
    public function comprobante($pto_venta,$tipo_comprobante,$nro_comprobante)
    {
        $result = [];

        // Devuelve la información del
        // comprobante 1 para el
        // punto de venta 1 y el
        // tipo de comprobante 6 (Factura B) 11 (Factura C)
        $voucher_info = $this->afip->GetVoucherInfo($nro_comprobante,$pto_venta,$tipo_comprobante);

        if($voucher_info === NULL) {
            $result['error'] = 'El comprobante no existe';
        } else {
            $result = $voucher_info;
        }

        return compact('result');
    }

    public function generar($pto_venta,$tipo_comprobante)
    {
        // Hay que pasarle todas estas variables al metodo
        $data = array(
            'CantReg' 		=> 1, // Cantidad de comprobantes a registrar
            'PtoVta' 		=> $pto_venta, // Punto de venta
            'CbteTipo' 		=> $tipo_comprobante, // Tipo de comprobante (ver tipos disponibles)
            'Concepto' 		=> 1, // Concepto del Comprobante: (1)Productos, (2)Servicios, (3)Productos y Servicios
            'DocTipo' 		=> 80, // Tipo de documento del comprador (ver tipos disponibles)
            'DocNro' 		=> 20111111112, // Numero de documento del comprador
            'CbteDesde' 		=> 2, // Numero de comprobante o numero del primer comprobante en caso de ser mas de uno
            'CbteHasta' 		=> 2, // Numero de comprobante o numero del ultimo comprobante en caso de ser mas de uno
            'CbteFch' 		=> intval(date('Ymd')), // (Opcional) Fecha del comprobante (yyyymmdd) o fecha actual si es nulo
            'ImpTotal' 		=> 1000, // Importe total del comprobante
            'ImpTotConc' 		=> 0, // Importe neto no gravado
            'ImpNeto' 		=> 1000, // Importe neto gravado
            'ImpOpEx' 		=> 0, // Importe exento de IVA
            'ImpIVA' 		=> 0, //Importe total de IVA
            'ImpTrib' 		=> 0, //Importe total de tributos
            'FchServDesde' 	=> NULL, // (Opcional) Fecha de inicio del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchServHasta' 	=> NULL, // (Opcional) Fecha de fin del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'FchVtoPago' 	=> NULL, // (Opcional) Fecha de vencimiento del servicio (yyyymmdd), obligatorio para Concepto 2 y 3
            'MonId' 		=> 'PES', //Tipo de moneda usada en el comprobante (ver tipos disponibles)('PES' para pesos argentinos)
            'MonCotiz' 		=> 1, // Cotización de la moneda usada (1 para pesos argentinos)
        );

        $response = null;
        try {
            $response = $this->afip->CreateNextVoucher($data);
        } catch (\Exception $ex)
        {
            $response['error'] = $ex->getMessage();
        }
        return compact('response');
    }

    public function forms() {
        $voucher_types = $this->afip->GetVoucherTypes();
        $concept_types = $this->afip->GetConceptTypes();
        $document_types = $this->afip->GetDocumentTypes();
        $aliquot_types = $this->afip->GetAliquotTypes();
        $currencies_types = $this->afip->GetCurrenciesTypes();
        $option_types = $this->afip->GetOptionsTypes();
        $tax_types = $this->afip->GetTaxTypes();

        return compact('voucher_types','concept_types','document_types','aliquot_types','currencies_types','option_types','tax_types');
    }

    public function custom()
    {
        //Ejecuta la operación FEParamGetCotizacion del wsfe
        $response = $this->afip->ExecuteRequest('wsfe',
            'FEParamGetCotizacion', array('MonId' => 'DOL')
        );

        $response =  $response->ResultGet;
        return compact('response');
    }
}