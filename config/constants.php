<?php

return [
    'STOREMAN' => [
        'CODE' => env('STORMAN_FACILITY_CODE'),
        'TOKEN' => env('STORMAN_TOKEN'),
        'URL' => rtrim(env('STORMAN_BASE_URL'), '/').'/',
    ]
];
