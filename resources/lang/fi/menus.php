<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Access',

            'roles' => [
                'all' => 'Kaikki roolit',
                'create' => 'Luo rooli',
                'edit' => 'Muokkaa roolia',
                'management' => 'Roolien hallinta',
                'main' => 'Roolit',
            ],

            'users' => [
                'all' => 'Kaikki käyttäjä',
                'change-password' => 'Vaihda salasana',
                'create' => 'Luo käyttäjä',
                'deactivated' => 'Deaktivoi käyttäjiä',
                'deleted' => 'Poistetut käyttäjät',
                'edit' => 'Muokkaa käyttäjää',
                'main' => 'Käyttäjät',
                'view' => 'Katso käyttäjää',
            ],
        ],

        'log-viewer' => [
            'main' => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs' => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'general' => 'General',
            'history' => 'History',
            'system' => 'System',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => 'Arabic',
            'az' => 'Azerbaijan',
            'zh' => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da' => 'Danish',
            'de' => 'German',
            'el' => 'Greek',
            'en' => 'English',
            'es' => 'Spanish',
            'fa' => 'Persian',
            'fr' => 'French',
            'fi' => 'Finnish',
            'he' => 'Hebrew',
            'id' => 'Indonesian',
            'it' => 'Italian',
            'ja' => 'Japanese',
            'nl' => 'Dutch',
            'no' => 'Norwegian',
            'pt_BR' => 'Brazilian Portuguese',
            'ru' => 'Russian',
            'sv' => 'Swedish',
            'th' => 'Thai',
            'tr' => 'Turkish',
            'uk' => 'Ukrainian',
        ],
    ],
];
