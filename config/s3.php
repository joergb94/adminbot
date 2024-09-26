<?php

    return  [
            'aws_live'               => env('AWS_LIVE', null),
            'aws_endpoint'           => env('AWS_ENDPOINT', null),
            'aws_default_region'     => env('AWS_DEFAULT_REGION', null),
            'aws_access_key_id'      => env('AWS_ACCESS_KEY_ID', null),
            'aws_secret_access_key'  => env('AWS_SECRET_ACCESS_KEY', null),

            'aws_public_bucket'      => env('AWS_PUBLIC_BUCKET', null),
            'aws_public_bucket_cdn'  => env('AWS_PUBLIC_BUCKET_CDN', null),

            'aws_private_bucket'     => env('AWS_PRIVATE_BUCKET', null),
            'aws_private_bucket_cdn' => env('AWS_PRIVATE_BUCKET_CDN', null),
        ];