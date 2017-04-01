<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    |--------------------------------------------------------------------------
    | These assets are registered on the asset manager
    */
    'ask-partial-assets'          => [
        'vue.min.js'                     => ['module' => 'ask:js/vue/vue.min.js'],
        'vue-resource.min.js'            => ['module' => 'ask:js/vue/vue-resource.min.js'],
        'jasny-bootstrap.min.css'        => ['module' => 'ask:css/jasny-bootstrap.min.css'],
        'jasny-bootstrap.min.js'         => ['module' => 'ask:js/jasny-bootstrap.min.js'],
        'loadingoverlay.min.js'          => ['module' => 'ask:js/loadingoverlay.min.js'],
        'loadingoverlay_progress.min.js' => ['module' => 'ask:js/loadingoverlay_progress.min.js'],
        'ask.js'                         => ['module' => 'ask:js/ask.js']
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in your pages
    | through the asset pipeline
    |--------------------------------------------------------------------------
    */
    'ask-partial-required-assets' => [
        'css' => [
            'jasny-bootstrap.min.css'
        ],
        'js'  => [
            'vue.min.js',
            'vue-resource.min.js',
            'jasny-bootstrap.min.js',
            'loadingoverlay.min.js',
            'loadingoverlay_progress.min.js',
            'guestbook.js'
        ],
    ],
];
