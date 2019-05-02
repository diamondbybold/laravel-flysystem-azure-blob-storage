<?php

return [

    'disks' => [

        'azure'  => [
            'driver' => 'azure',
            'account' => [
                'name' => env('AZURE_ACCOUNT_NAME'),
                'key' => env('AZURE_ACCOUNT_KEY'),
            ],
            'endpoint-suffix' => env('AZURE_ENDPOINT_SUFFIX', 'core.windows.net'),
            'container' => env('AZURE_CONTAINER', 'public')
        ]

    ],

];
