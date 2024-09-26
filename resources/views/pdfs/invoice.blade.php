<!doctype html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    *{
        font-family: 'Courier New', Courier, monospace;
        font-size: 9px;
        letter-spacing: -0.05em;
        font-weight: normal;
    }
    @page { margin-top:40px; margin-left:4px;  margin-right:4px;}
    body{
        margin: 1pt;
    }
    .w-full {
        width: 100%;
    }
    .table_data{
        border-collapse: separate;
    }
    .table_data td{
        border:thin solid #ccc;
        padding-left: 1px;
    }
    .text-xx-10 {
        font-size: 11px;
    }
    .font-700{
        font-weight: 700;
    }
    .font-bold{
        font-weight: bold;
    }
    .text-white{
        color: #FFF;
    }
    .bg-cyan-700 {
        background-color: #0168E5;
    }
    .text-gray-400 {
        color: rgb(156 163 175)
    }
    .text-center {
        text-align: center;
    }
    .logo{
        width: 150px;
    }
    .w-24 {
        width: 120px;
    }
    .basis-24 {
        width: 70px;
    }
    .basis-36 {
        width: 90px;
    }
    .pl-5 {
        padding-left: 1.25rem;
    }
    .h-3 {
        height: 9px;
    }
    .pt-1{
        padding-top: 4px;
    }
    .pt-5{
        padding-top: 10px;
    }

    table td{
        /* height: 11px; */
        padding-top: 3px;
        padding-bottom: 3px;
    }

    table tr:last-child td:last-child {
        border-bottom-right-radius:4px;
    }
    
    table tr:last-child td:first-child {
        border-bottom-left-radius:4px;
    }

    table tr:first-child th:first-child,
    table tr:first-child td:first-child {
        border-top-left-radius:4px;
    }

    table tr:first-child th:last-child,
    table tr:first-child td:last-child {
        border-top-right-radius:4px;
    }

    .border-collapse{
        border-collapse: collapse;
    }

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<body>
    <?php 

        $paymentMethod = [
            'PUE' => 'PAGO EN UNA SOLA EXHIBICIÓN',
            'PPD' => 'PAGO EN PARCIALIDADES O DIFERIDO'
        ];

        $max              = 6;
        $titleCellStyle   = 'bg-cyan-700 text-white font-700';
        // $address          = addressStringSubtitution( $entity_receiver['address']->street );
        $address          = addressStringSubtitution(
                                                        $entity_receiver['address']->street.
                                                        ( !empty(trim($entity_receiver['address']->ext)) ? ' NO '.$entity_receiver['address']->ext : ''   ).
                                                        ( !empty(trim($entity_receiver['address']->int)) ? ' INT '.$entity_receiver['address']->int : ''   ).
                                                        ' CP. '.$entity_receiver['address']->postal_code.' COL. '.$entity_receiver['address']->neighbourhood->name.
                                                        ', '.$entity_receiver['address']->municipality->name.' '.$entity_receiver['address']->state->name.', '.$entity_receiver['address']->country->name
                                                    );

        $productsDetail   = 1;
    ?>
    <table class="border-collapse">
        <!-- LEVEL ONE -->
        <tr>
            <td style="width:280px;">
                <table class="w-full">
                    <tr>
                        <td>
                            <img width="250px" style="border:none;"  src="https://cdn.daytech.mx/daytec_logo_full.png">
                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: top;  width:280px;">
                <table class="w-full">
                    <tr><td class="text-xx-10 font-bold text-center">RDCR DAYTECH</td></tr>
                    <tr><td class="text-xx-10 font-bold text-center">RFC: RDA201112V34</td></tr>
                    <tr><td class="text-xx-10 font-bold text-center">626 - REGIMEN SIMPLIFICADO DE CONFIANZA</td></tr>
                    <tr><td class="text-xx-10 font-bold text-center">AV. HIDALGO 255-A, COL. ZAPOPAN CENTRO</td></tr>
                    <tr><td class="text-xx-10 font-bold text-center">C.P. 45100, ZAPOPAN JALISCO</td></tr>
                    <tr><td class="text-xx-10 font-bold text-center">https://daytech.com.mx</td></tr>
                </table>
            </td>
            <td style="vertical-align: top;  width:280px;">
                <table class="table_data w-full">
                    <tr>
                        <td class="{{$titleCellStyle}} text-center text-xx-10" colspan="2">
                            <span class="font-bold">F A C T U R A</span><span class="pl-5 font-bold">V. 4.0</span>
                        </td>
                    </tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">FOLIO</td><td>{{ str_pad($folio, 6, 0, STR_PAD_LEFT)}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">SERIE</td><td>{{$serie}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">FECHA COMPROBANTE</td><td>{{$created_at}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">LUGAR EXPEDICION</td><td>{{$entity_receiver['address']->postal_code}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">TIPO COMPROBANTE</td><td>I - INGRESO</td></tr>
                </table>
            </td>
        </tr>
        <!-- LEVEL TWO -->
        <tr>
            <td colspan="2" style="vertical-align: top;  width:560px;">
                <table class="table_data w-full">
                    <tr><td class="{{$titleCellStyle}}" colspan="2">INFORMACION FISCAL DEL CLIENTE</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-24">RFC</td><td>{{mb_strtoupper($entity_receiver['rfc'])}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-24">RAZON SOCIAL</td><td>{{mb_strtoupper($entity_receiver['business_name'])}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-24">REGIMEN FISCAL</td><td>{{mb_strtoupper($entity_receiver['tax_regime']->name)}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-24">USO CFDI</td><td>{{ mb_strtoupper($cfdi->cfdi_use_code['name']) }}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-24">DIRECCION</td><td>{{ $address }}</td></tr>
                </table>
            </td>
            <td style="vertical-align: top; width:280px;">
                <table class="table_data w-full">
                    <tr><td class="{{$titleCellStyle}} basis-36">FECHA TIMBRADO</td><td>{{$cfdi->stamped_at}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">NO CERTIFICADO</td><td>{{$cfdi->certificate_number}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">NO CERTIFICADO SAT</td><td>{{$cfdi->certificate_number_sat}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">FOLIO FISCAL</td><td>{{mb_strtoupper($cfdi->uuid)}}</td></tr>
                    <tr><td class="{{$titleCellStyle}} basis-36">REFERENCIA</td><td>{{$mkpOrder['purchase_order']}}</td></tr>
                    <!-- <tr><td class="{{$titleCellStyle}} basis-36">NO. SERIE CERT. CFDI</td><td>{{$cfdi->certificate_number}}</td></tr> -->
                </table>
            </td>
        </tr>
        <!-- LEVEL THREE -->
        <tr>
            <td colspan="3" style="width:840px;" class="pt-5">
                <!-- DETAILS -->
                <table class="table_data w-full border-collapse">
                    <tbody class="">
                    <tr>
                        <td colspan="7" class="{{$titleCellStyle}}">
                            DETALLE DE LA FACTURA
                        </td>
                    </tr>
                    <tr>
                        <td class="{{$titleCellStyle}} text-center">IDENTIFICACION</td>
                        <td class="{{$titleCellStyle}}">DESCRIPCION</td>
                        <td class="{{$titleCellStyle}} text-center">CANTIDAD</td>
                        <td class="{{$titleCellStyle}} text-center">PRECIO</td>
                        <td class="{{$titleCellStyle}} text-center">SUBTOTAL</td>
                        <td class="{{$titleCellStyle}} text-center">IVA</td>
                        <td class="{{$titleCellStyle}} text-center">TOTAL</td>
                    </tr>
                    @foreach($mkpOrder['products'] as $product)
                        <tr>
                            <td class="text-center">{{$product->upc}}</td>
                            <td>
                                NOMBRE: {{mb_strtoupper($product->name).' MARCA :'.mb_strtoupper($product->brand)}}
                                <br/>UNIDA:PZ, 
                                <br/>CLAVE DE UNIDAD: H87, 
                                <br/>CLAVE DE PRODUCTO DE SERVICIO: {{$product->sat_code}}
                            </td>
                            <td class="text-center">{{$product->qty}}</td>
                            <td class="text-center">$ {{number_format($product->price, 2, '.', ',')}}</td>
                            <td class="text-center">$ {{number_format($product->subtotal, 2, '.', ',')}}</td>
                            <td class="text-center">$ {{number_format($product->tax, 2, '.', ',')}}</td>
                            <td class="text-center">$ {{number_format($product->amount, 2, '.', ',')}}</td>
                        </tr>
                    @endforeach
                    @for ($i = 0; $i < ( $max - count($mkpOrder['products']) ); $i++)
                    <tr class="text-gray-400">
                        <td class="text-center">. . . . . . .</td>
                        <td>
                            . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                            <br/>. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                            <br/>. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                            <br/>. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                        </td>
                        <td class="text-center">. . . . . .</td>
                        <td class="text-center">. . . . . .</td>
                        <td class="text-center">. . . . . .</td>
                        <td class="text-center">. . . . . .</td>
                        <td class="text-center">. . . . . .</td>    
                    </tr>
                    @endfor
                    </tbody>
                </table>
            </td>
        </tr>
        <!-- LEVEL FOUR -->
        <tr>
            <td class="pt-5">
                <img class="w-24" src="{{$cfdi->url_qr_file}}">
            </td>
            <td class="pt-5" style="vertical-align: top;">
                <table class="table_data" align="center" style="width:270px;">
                    <tr>
                        <td class="{{$titleCellStyle}}">METODO DE PAGO</td>
                        <td colspan="2">{{ $cfdi->cfdi_payment_method['name'] }} </td>
                    </tr>
                    <tr>
                        <td class="{{$titleCellStyle}}">FORMA DE PAGO</td>
                        <td colspan="2">{{$cfdi->cfdi_payment_way['name']}}</td>
                    </tr>
                    <tr>
                        <td class="{{$titleCellStyle}}">MONEDA</td>
                        <td colspan="2">MXN</td>
                    </tr>
                </table>
            </td>
            <td class="pt-5" style="vertical-align: top;">
                <table class="table_data" align="right" style="width:220px;">
                    <tr>
                        <td class="{{$titleCellStyle}}">IMPUESTOS TRASLADADOS</td>
                        <td>16.00 %</td>
                    </tr>
                    <tr>
                        <td class="{{$titleCellStyle}}">DESCUENTO</td>
                        <td>$ 0.00</td>
                    </tr>
                    <tr>
                        <td class="{{$titleCellStyle}}">SUBTOTAL</td>
                        <td>$ {{number_format($subtotal, 2, '.', ',')}}</td>
                    </tr>
                    <tr>
                        <td class="{{$titleCellStyle}}">IVA</td>
                        <td>$ {{number_format($tax, 2, '.', ',')}}</td>
                    </tr>
                    <tr>
                        <td class="{{$titleCellStyle}}">TOTAL</td>
                        <td>$ {{number_format($amount, 2, '.', ',')}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- LEVEL FIVE -->
        <tr>
            <td colspan="3">
                <table class="w-full table_data">
                <tr><td class="font-bold">RFC DEL PROVEEDOR DE CERTIFICACION: {{$cfdi->rfc_certification_provider}}</td></tr>
                <tr><td class="{{$titleCellStyle}}">IMPORTE CON LETRA</td></tr>
                <tr><td>
                    {{$amount_to_words}} PESOS / 100  MXN
                </td></tr>
                </table>
        </td>
        <!-- LEVEL SIX -->
        <tr>
            <td colspan="3">
                <table class="w-full table_data">
                <tr><td class="{{$titleCellStyle}}">SELLO DIGITAL DEL CFDI</td></tr>
                <tr><td>
                        {{
                            wordwrap($cfdi->original_string_stamp,
                            160, 
                            " ", 
                            true);
                        }}
                </td></tr>
                </table>
            </td>
        </tr>
        <!-- LEVEL SEVEN -->
        <tr>
            <td colspan="3">
                <table class="w-full table_data">
                    <tr><td class="{{$titleCellStyle}}">SELLO DIGITAL DEL SAT</td></tr>
                    <tr><td>
                        {{
                            wordwrap($cfdi->stamp_sat,
                            160, 
                            " ", 
                            true);
                        }}
                    </td></tr>
                </table>
            </td>
        </tr>
        <!-- LEVEL EIGTH -->
        <tr>
            <td colspan="3">
                <table class="w-full table_data">
                    <tr><td class="{{$titleCellStyle}}">CADENA ORIGINAL DEL COMPLEMENTO DE CERTIFICACIÓN DIGITAL DEL SAT</td></tr>
                    <tr><td>
                        {{
                            wordwrap($cfdi->original_string_signed,
                            160, 
                            " ",
                            true);
                        }}
                    </td></tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>