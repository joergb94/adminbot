<?php

return [

    'TRUE'            => true,
    'STOCK_ZERO'      => 0,
    'STATUS_ENABLED'  => 1,
    'STATUS_DISABLED' => 0,
    'ENABLED'         => true,
    'TAX_RATE'        => 16,
    'RATE_NET_PRICE'  => 1 + (config('constants.TAX_RATE') / 100),
    'EXCHANGE_MXN'    => 1,
    'EXCHANGE_USD'    => 2,
    'MAX_ADDRESS_BY_ENTITY' => env('MAX_ADDRESS_BY_ENTITY', null),
    'ORDER_ID_OLDIE_TO_INVOICE' => env('ORDER_ID_OLDIE_TO_INVOICE', null),
    'PRICE_NUMBER_ONE'      => 1,
    'PRICE_NUMBER_TWO'      => 2,
    'PRICE_NUMBER_THREE'    => 3,
    'PRICE_NUMBER_FOUR'     => 4,
    'PRICE_NUMBER_FIVE'     => 5,
    'PRICE_NUMBER_SIX'     => 6,
    'DAYTECH_ENTITY_ID'     => 1,
    'DAYTECH_USER_ID'       => 1,

    'CUSTOMER_PROVIDER_ORDER_NEW_ORDER' => 1,
    'CUSTOMER_PROVIDER_ORDER_EDITED_ORDER' => 2,
    'CUSTOMER_PROVIDER_ORDER_CONFIRMED' => 3,
    'CUSTOMER_PROVIDER_ORDER_CANCELED' => 4,
    'CUSTOMER_PROVIDER_ORDER_ORDERED' => 5,
    'CUSTOMER_PROVIDER_ORDER_COURIER_ASSIGNED' => 6,
    'CUSTOMER_PROVIDER_ORDER_COURIER_SENT' => 7,
    'CUSTOMER_PROVIDER_ORDER_INFORMED' => 8,
    'CUSTOMER_PROVIDER_ORDER_BILLED_BY_PROVIDER' => 9,
    'CUSTOMER_PROVIDER_ORDER_BILLED' => 10,
    'CUSTOMER_PROVIDER_ORDER_CANCELED_BILLED' => 11,

    'NEW_ORDER'                  => 1,
    'EDITED_ORDER'               => 2,
    'CONFIRMED'                  => 3,
    'CANCELED'                   => 4,
    'REQUEST_TO_REJECT'          => 5,
    'REJECTED'                   => 6,
    'REQUEST_TO_REJECT_DECLINED' => 7,
    'WITH_TRACKING_CODE'         => 8,
    'PACKED'                     => 9,
    'IN_COLLECTION_LIST'         => 10,
    'DELIVERED'                  => 11,
    'BILLED'                     => 12,
    'CANCELED_BILLED'            => 30,

    'SINGLE_STORE'               => 1,
    'VIRTUAL_STORE'              => 2,
    'WAREHOUSE_STORE'            => 3,
    'FIRST_ORDERS_ML_STORE'      => 10,

    'CUSTOMER_TYPE_GENERAL'  => 1,
    'CUSTOMER_TYPE_PROVIDER'  => 2,
    'CUSTOMER_TYPE_INTERNAL_EXTERNAL'  => 3,
    'CUSTOMER_TYPE_MERCADOLIBRE'       => 4,
    'CUSTOMER_TYPE_MARKETPLACE'        => 5,
    'CUSTOMER_TYPE_MARKETPLACE_USD' => 6,

    'CYBERPUERTA_ID'             => 1,
    'MERCADOLIBRE_ID'            => 2,
    'WEB_ID'                     => 3,
    'VENTA_INTERNA_ID'           => 4,
    'VENTA_EXTERNA_ID'           => 5,
    'AMAZON_ID'                  => 6,

    'PURCHASE_ORDER_NEW'                  => 1,
    'PURCHASE_ORDER_CANCELLED'            => 2,
    'PURCHASE_ORDER_REJECTED'             => 3,
    'PURCHASE_ORDER_NOT_AUTHORIZED'       => 4,
    'PURCHASE_ORDER_AUTHORIZED'           => 5,
    'PURCHASE_ORDER_IN_PAYMENT_PROGRESS'  => 6,
    'PURCHASE_ORDER_PARTIALLY_PAID'       => 7,
    'PURCHASE_ORDER_PAID'                 => 8,
    'PURCHASE_ORDER_IN_RECEPTION'         => 9,
    'PURCHASE_ORDER_INGRESS'              => 10,
    'PURCHASE_ORDER_CREDIT_PAID'          => 11,
    'PURCHASE_ORDER_CREATED_BY_PLATFORM'  => 12,
    'PURCHASE_ORDER_EDITED'               => 13,

    'PS_ORDER_NEW'                  => 1,
    'PS_ORDER_PAYMENT_ACCEPTED'     => 2,
    'PS_ORDER_SHIPPED'              => 3,
    'PS_ORDER_DELIVERED'            => 4,
    'PS_ORDER_CANCELLED'            => 5,



    'MOVEMENT_TYPE_STOCK_IN'      => 1,
    'MOVEMENT_TYPE_STOCK_OUT'     => 2,

    'MOVEMENT_OF_PURCHASE_ORDER'  => 1,
    'MOVEMENT_OF_ADJUSTMENT'      => 2,
    'MOVEMENT_OF_MKP_ORDER'       => 3,
    'MOVEMENT_OF_PURCHASE_ORDER_RECEPTION' => 4,

    'STOCK_SECLUDED_NEW'          => 1,
    'STOCK_SECLUDED_MODIFIED'     => 2,
    'STOCK_SECLUDED_CANCELLED'    => 3,
    'STOCK_SECLUDED_RESERVED'     => 4,
    'STOCK_SECLUDED_AVAILABLE'    => 5,
    'STOCK_SECLUDED_CLOSED'       => 6,

    'RECENT_PACKED'               => 1,
    'NEW_SHIPPING'                => 2,
    'SENT_SHIPPING'               => 3,

    'LOCAL_SHIPPING'              => 8,

    'IS_WEBP'            => 'image/webp',

    'CLASSIFICATION_PRODUCT_TYPE' => 1,
    'CLASSIFICATION_VARIANT' => 2,
    'CLASSIFICATION_MODEL' => 3,
    'CLASSIFICATION_CHARACTERISTIC_1' => 4,
    'CLASSIFICATION_CHARACTERISTIC_2' => 5,
    'CLASSIFICATION_CHARACTERISTIC_3' => 6,
    'CLASSIFICATION_CHARACTERISTIC_4' => 7,
    'CLASSIFICATION_COMPATIBILITIES' => 8,
    'CLASSIFICATION_INCLUDE' => 9,
    'CLASSIFICATION_NO_INCLUDE' => 10,

    'DAYTECH_ENTITY_ID' => 1,
    'CYBERPUERTA_ENTITY_ID' => 2,
    'GENERAL_PEOPLE_ENTITY_ID' => 208,

    'CFDI_USE_CODE_ID_S01' => 1,
    'CFDI_USE_CODE_ID_G01' => 2,

    'PAYMENT_WAY_CODE_ID_99' => 22,
    'PAYMENT_WAY_CODE_ID_31' => 21,

    'PAYMENT_METHOD_CODE_ID_PUE' => 1,
    'PAYMENT_METHOD_CODE_ID_PPD' => 2,

    'FIXED_PRICE_TRUE' => TRUE,

    'GENERIC_BRAND_ID' => 74,


    'ADJUSTMENT_INCOMING' => 1,
    'ADJUSTMENT_OUTGOING' => 2,

    'SUPPLIER_INVOICE_PENDING' => 1,
    'SUPPLIER_INVOICE_CANCELLED' => 2,
    'SUPPLIER_INVOICE_PAID' => 3,
    'SUPPLIER_INVOICE_PARTIALLY_PAID' => 4,
    'SUPPLIER_INVOICE_INGRESS' => 5,
    'SUPPLIER_INVOICE_IN_RECEPTION' => 6,
    'SUPPLIER_INVOICE_CREDIT_PAID' => 7,


    'CREDIT_BANK_ACCOUNT' => 2,
    'PROVIDER_ID_TECHSMART' => 1,

    'TECHSMART'=>1,

    'ORDER_TYPE_MPK'=>1,
    'ORDER_TYPE_CP'=>2,
    
];
