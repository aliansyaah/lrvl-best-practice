<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Pipeline
    |--------------------------------------------------------------------------
    |
    | The pipeline for the feature to travel through.
    |
    */

    /* 
        Dengan memilih gateway seperti di bawah, kita memberi tahu pipeline untuk melihat database terlebih dahulu kemudian file .features.php sebagai backup 
    */
    'pipeline' => ['database', 'in_memory'],
    // 'pipeline' => ['database'],

    /*
    |--------------------------------------------------------------------------
    | Gateways
    |--------------------------------------------------------------------------
    |
    | Configures the different gateway options
    |
    */

    'gateways' => [
        'in_memory' => [
            'file' => env('FEATURE_FLAG_IN_MEMORY_FILE', '.features.php'),
            'driver' => 'in_memory',
            'caching' => [
                'ttl' => 300,
            ],
        ],
        'database' => [
            'driver' => 'database',
            'cache' => [
                /* 
                    'ttl' adalah waktu cache menyimpan data dalam satuan waktu detik.
                    Jadi jika suatu fitur diakses beberapa kali dalam jangka waktu tersebut, hasil yang sama akan dikembalikan. Misalkan setting ttl = 120. Dalam waktu 120 detik, walaupun kita ubah flag jadi on/off, hasilnya akan sama (karena setting flag disimpan pada cache utk menghemat pembacaan query ke database).

                    Jika ingin mengubah dgn segera, bisa dengan cara setting ttl dgn waktu yang tidak terlalu lama atau clear cache.
                */
                // 'ttl' => 600,   // 600 seconds
                'ttl' => 15,
            ],
            'connection' => env('FEATURE_FLAG_DATABASE_CONNECTION'),
            'table' => env('FEATURE_FLAG_DATABASE_TABLE', 'features'),
        ],
        'gate' => [
            'driver' => 'gate',
            'gate' => env('FEATURE_FLAG_GATE_GATE', 'feature'),
            'guard' => env('FEATURE_FLAG_GATE_GUARD'),
            'cache' => [
                'ttl' => 600,
            ],
        ],
        'redis' => [
            'driver' => 'redis',
            'prefix' => env('FEATURE_FLAG_REDIS_PREFIX', 'features'),
            'connection' => env('FEATURE_FLAG_REDIS_CONNECTION', 'default'),
        ],
    ],
];
