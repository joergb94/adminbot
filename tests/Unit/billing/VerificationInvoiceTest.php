<?php

namespace Tests\Unit\billing;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class VerificationInvoiceTest extends TestCase
{

    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(); // This also disables CSRF protection
        $array = [
            "entity" => [
                "id" => 208,
                "business_name" => "Ventas Publico General",
                "rfc" => "XAXX010101000",
                "email" => "administracion@daytech.com.mx",
                "tax_regime" => [
                    "id" => 13,
                    "code" => "616",
                    "name" => "616: Sin Obligaciones Fiscales"
                ],
                "first_phone" => "3385262665",
                "second_phone" => "",
                "address" => [
                    "id" => 4,
                    "street" => "AV. HIDALGO",
                    "postal_code" => "45100",
                    "ext" => "255",
                    "int" => "A",
                    "neighbourhood" => [
                        "id" => 145793,
                        "name" => "Zapopan Centro"
                    ],
                    "neighbourhoods" => [
                        [
                            "id" => 145793,
                            "name" => "Zapopan Centro"
                        ],
                        [
                            "id" => 145794,
                            "name" => "La Villa"
                        ]
                    ],
                    "state" => [
                        "id" => 14,
                        "name" => "Jalisco"
                    ],
                    "municipality" => [
                        "id" => 1415,
                        "name" => "Zapopan"
                    ],
                    "country" => [
                        "id" => 142,
                        "name" => "Mexico"
                    ],
                    "elected" => false,
                    "reference" => "..."
                ],
                "updated_at" => "2023-11-29 11:45:35",
                "tax_regime_options" => [
                    [
                        "id" => 1,
                        "code" => "601",
                        "name" => "601: General De Ley Personas Morales"
                    ],
                    [
                        "id" => 2,
                        "code" => "603",
                        "name" => "603: Personas Morales Con Fines No Lucrativos"
                    ],
                    [
                        "id" => 3,
                        "code" => "605",
                        "name" => "605: Sueldos Y Salarios E Ingresos Asimilados A Salarios"
                    ],
                    [
                        "id" => 4,
                        "code" => "606",
                        "name" => "606: Arrendamiento"
                    ],
                    [
                        "id" => 5,
                        "code" => "607",
                        "name" => "607: Régimen De Enajenación O Adquisición De Bienes"
                    ],
                    [
                        "id" => 6,
                        "code" => "608",
                        "name" => "608: Demás Ingresos"
                    ],
                    [
                        "id" => 7,
                        "code" => "609",
                        "name" => "609: Consolidación"
                    ],
                    [
                        "id" => 8,
                        "code" => "610",
                        "name" => "610: Residentes En El Extranjero Sin Establecimiento Permanente En México"
                    ],
                    [
                        "id" => 9,
                        "code" => "611",
                        "name" => "611: Ingresos Por Dividendos (socios Y Accionistas)"
                    ],
                    [
                        "id" => 10,
                        "code" => "612",
                        "name" => "612: Personas Físicas Con Actividades Empresariales Y Profesionales"
                    ],
                    [
                        "id" => 11,
                        "code" => "614",
                        "name" => "614: Ingresos Por Intereses"
                    ],
                    [
                        "id" => 12,
                        "code" => "615",
                        "name" => "615: Régimen De Los Ingresos Por Obtención De Premios"
                    ],
                    [
                        "id" => 13,
                        "code" => "616",
                        "name" => "616: Sin Obligaciones Fiscales"
                    ],
                    [
                        "id" => 14,
                        "code" => "620",
                        "name" => "620: Sociedades Cooperativas De Producción Que Optan Por Diferir Sus Ingresos"
                    ],
                    [
                        "id" => 15,
                        "code" => "621",
                        "name" => "621: Incorporación Fiscal"
                    ],
                    [
                        "id" => 16,
                        "code" => "622",
                        "name" => "622: Actividades Agrícolas, Ganaderas, Silvícolas Y Pesqueras"
                    ],
                    [
                        "id" => 17,
                        "code" => "623",
                        "name" => "623: Opcional Para Grupos De Sociedades"
                    ],
                    [
                        "id" => 18,
                        "code" => "624",
                        "name" => "624: Coordinados"
                    ],
                    [
                        "id" => 19,
                        "code" => "625",
                        "name" => "625: Régimen De Las Actividades Empresariales Con Ingresos A Través De Plataformas Tecnológicas"
                    ],
                    [
                        "id" => 20,
                        "code" => "626",
                        "name" => "626: Régimen Simplificado De Confianza"
                    ],
                    [
                        "id" => 21,
                        "code" => "628",
                        "name" => "628: Hidrocarburos"
                    ],
                    [
                        "id" => 22,
                        "code" => "629",
                        "name" => "629: De Los Regímenes Fiscales Preferentes Y De Las Empresas Multinacionales"
                    ],
                    [
                        "id" => 23,
                        "code" => "630",
                        "name" => "630: Enajenación De Acciones En Bolsa De Valores"
                    ]
                ],
                "cfdi_use_options" => [
                    [
                        "id" => 1,
                        "code" => "S01",
                        "name" => "S01: Sin Efectos Fiscales"
                    ]
                ]
            ],
            "orderToBill" => [
                "id" => 6,
                "customer_order_id" => 6,
                "customer_id" => 2,
                "store_id" => 1,
                "purchase_order" => "2000002700361107",
                "mkp_order_status_id" => 11,
                "mkp_order_courier_id" => 7,
                "subtotal" => "2625.000",
                "tax" => 420,
                "amount" => 3045,
                "shipping_cost" => "62.50",
                "commission" => "304.50",
                "created_by_id" => 5,
                "updated_by_id" => null,
                "deleted_by_id" => null,
                "created_at" => "2021-08-18 11:40:42",
                "updated_at" => "2021-08-18 17:11:49",
                "deleted_at" => null,
                "reference_currency_code" => "MXN",
                "reference_currency_exchange_rate" => "1.000",
                "payment_method_id" => null,
                "transaction_id" => null,
                "order_type" => "MKPORDER",
                "details" => [
                    [
                        "id" => 6,
                        "mkp_order_id" => 6,
                        "product_id" => 434,
                        "qty" => 1,
                        "price" => "2625.000",
                        "subtotal" => "2625.000",
                        "tax" => 420,
                        "name" => "Procesador Amd Ryzen 3 3200g C Graficos 4core 4ghz 65w Socket Am4 Yd320gc5fibox",
                        "amount" => 3045,
                        "created_by_id" => null,
                        "updated_by_id" => null,
                        "deleted_by_id" => null,
                        "created_at" => "2021-08-18 11:40:42",
                        "updated_at" => "2021-08-18T16:40:42.000000Z",
                        "deleted_at" => null,
                        "tax_percentage" => "00000000",
                        "current_cost" => null,
                        "current_cost_currency_id" => null
                    ]
                ],
                "store" => [
                    "id" => 1,
                    "name" => "Zapopan",
                    "type" => 1,
                    "enabled" => true,
                    "created_by_id" => null,
                    "updated_by_id" => null,
                    "deleted_by_id" => null,
                    "created_at" => null,
                    "updated_at" => null,
                    "deleted_at" => null
                ],
                "customer" => [
                    "id" => 2,
                    "name" => "Mercadolibre",
                    "password" => "$2y$10$9jvIc0GjWJf4kjKIPrJ8kOlFZhiDYC5whL7QLWRfIXPKj1fFCA8Mu",
                    "enabled" => true,
                    "customer_type_id" => 4,
                    "api_token_way" => false,
                    "api_token" => null,
                ]
            ]
                ];
        
    }

    public function testBillingToMKPOrder(): void
    {
        Auth::loginUsingId(32);

        // Generate a CSRF token
        $csrfToken = csrf_token();

        $result  = $this->postJson('cliente/facturacion', [
            "csrf-token" => $csrfToken,
            'order_type'=> 'MKPORDER',
            "order_id"=>19856,
            "rfc"=>"XAXX010101000",
            "receiver_id"=>208,
            "tax_regime" => ["id"=>13,"code"=>"616","name"=>"sin obligaciones fiscales"],
            "cfdi_use" => ["id"=>1,"code"=>"S01","name"=>"Sin Efectos Fiscales"],
            "payment_way" => ["id"=>1,"name"=>"intermediario de pagos","code"=>"31"],
            "payment_method" => ["id"=>1,"name"=>"Pago En Una Sola Exhibicion","code"=>"PUE"],
            "tax_regime_name" => ["General De Ley Personas Morales"],
            "customer" => ["id"=>2,"name"=>"Mercadolibre"]
        ]);
        dd($result);
        $result->assertStatus(200);
    }

    public function testBillingToCPOrder(): void
    {
        Auth::loginUsingId(32);

        // Generate a CSRF token
        $csrfToken = csrf_token();

        $result  = $this->postJson('cliente/facturacion', [
            "csrf-token" => $csrfToken,
            'order_type'=> 'CPORDER',
            "order_id"=>30,
            "rfc"=>"XAXX010101000",
            "receiver_id"=>208,
            "tax_regime" => ["id"=>13,"code"=>"616","name"=>"sin obligaciones fiscales"],
            "cfdi_use" => ["id"=>1,"code"=>"S01","name"=>"Sin Efectos Fiscales"],
            "payment_way" => ["id"=>1,"name"=>"intermediario de pagos","code"=>"31"],
            "payment_method" => ["id"=>1,"name"=>"Pago En Una Sola Exhibicion","code"=>"PUE"],
            "tax_regime_name" => ["General De Ley Personas Morales"],
        ]);
        dd($result); 
        $result->assertStatus(200);
    }
}
