<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => 'Kaikki',
        'yes' => 'Kyllä',
        'no' => 'Ei',
        'copyright' => 'Tekijänoikeus',
        'custom' => 'Kustomoitu',
        'actions' => 'Toiminnot',
        'active' => 'Aktiivinen',
        'buttons' => [
            'save' => 'Tallenna',
            'update' => 'Päivitä',
        ],
        'hide' => 'Piilota',
        'inactive' => 'Inaktiivinen',
        'none' => 'Ei yhtään',
        'show' => 'Näytä',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new' => 'Luo Uusi',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more' => 'More',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Luo Rooli',
                'edit' => 'Muokkaa Roolia',
                'management' => 'Roolien hallinta',

                'table' => [
                    'number_of_users' => 'Käyttäjämäärä',
                    'permissions' => 'Käyttöoikeudet',
                    'role' => 'Rooli',
                    'sort' => 'Suodata',
                    'total' => 'role total|roles total',
                ],
            ],

            'users' => [
                'active' => 'Aktiiviset käyttäjät',
                'all_permissions' => 'Kaikki käyttöoikeudet',
                'change_password' => 'Vaihda salasana',
                'change_password_for' => 'Vaihda salasana käyttäjälle :user',
                'create' => 'Luo käyttäjä',
                'deactivated' => 'Deaktivoidut käyttäjät',
                'deleted' => 'Poistetut käyttäjät',
                'edit' => 'Muokkaa käyttäjää',
                'management' => 'Käyttäjien hallinta',
                'rights' => 'käyttöoikeudet',
                'no_permissions' => 'Ei käyttöoikeuksia',
                'no_roles' => 'Ei rooleja asetettavaksi.',
                'permissions' => 'Käyttöoikeudet',
                'user_actions' => 'Käyttäjän toiminnot',

                'table' => [
                    'confirmed' => 'Vahvistettu',
                    'created' => 'Luotu',
                    'email' => 'Sähköposti',
                    'id' => 'ID',
                    'last_updated' => 'Viimeksi päivitetty',
                    'name' => 'Nimi',
                    'first_name' => 'Etunimi',
                    'last_name' => 'Sukunimi',
                    'no_deactivated' => 'Ei deaktivoituja käyttäjiä',
                    'no_deleted' => 'Ei poistettuja käyttäjiä',
                    'other_permissions' => 'Muut käyttöoikeudet',
                    'permissions' => 'Käyttöoikeudet',
                    'abilities' => 'Kyvyt',
                    'roles' => 'Roolit',
                    'social' => 'Sosiaalinen',
                    'total' => 'käyttäjä|käyttäjiä yhteensä',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Yleiskatsaus',
                        'history' => 'Historia',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Vahvistettu',
                            'created_at' => 'Luotu paikassa',
                            'deleted_at' => 'Poistettu paikassa',
                            'email' => 'E-mail',
                            'last_login_at' => 'Viimeinen kirjautuminen',
                            'last_login_ip' => 'Viimeisin kirjautumis IP',
                            'last_updated' => 'Viimeksi päivitetty',
                            'name' => 'Name',
                            'first_name' => 'Etunimi',
                            'last_name' => 'Sukunimi',
                            'status' => 'Tila',
                            'timezone' => 'Aikavyöhyke',
                        ],
                    ],
                ],

                'view' => 'Katso käyttäjää',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'Kirjaudu',
            'login_button' => 'Kirjaudu',
            'login_with' => 'Kirjaudu tilillä :social_media',
            'register_box_title' => 'Rekisteröidy',
            'register_button' => 'Rekisteröidy',
            'remember_me' => 'Muista minut',
        ],

        'contact' => [
            'box_title' => 'Ota yhteyttä',
            'button' => 'Lähetä tietoja',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Salasanasi on vanhentunut.',
            'forgot_password' => 'Unohtuiko salasana?',
            'reset_password_box_title' => 'Vaihda salasana',
            'reset_password_button' => 'Vaihda salasana',
            'update_password_button' => 'Päivitä salasana',
            'send_password_reset_link_button' => 'Lähetä salasanan vaihtolinkki',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Vaihda salasana',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'created_at' => 'Luotu (pvm)',
                'edit_information' => 'Muokkaa tietoja',
                'email' => 'Sähköposti',
                'last_updated' => 'Päivitetty (pvm)',
                'name' => 'Nimi',
                'first_name' => 'Etunimi',
                'last_name' => 'Sukunimi',
                'update_information' => 'Päivitä tietoja',
            ],
        ],
    ],
];
