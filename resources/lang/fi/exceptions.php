<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists' => 'Rooli on jo olemassa. Valitse toinen nimi, ole hyvä.',
                'cant_delete_admin' => 'Et voi poistaa pääkäyttäjää.',
                'create_error' => 'Ongelma luotaessa roolia. Yritä uudelleen.',
                'delete_error' => 'Ongelma poistettaessa roolia. Yritä uudelleen.',
                'has_users' => 'Et voi poistaa roolia liitetyillä käyttäjillä.',
                'needs_permission' => 'Sinun täytyy valita ainakin yksi käyttöoikeus tälle roolille.',
                'not_found' => 'Roolia ei löydy',
                'update_error' => 'Ongelma päivitettäessä roolia. Yritä uudelleen.',
            ],

            'users' => [
                'already_confirmed' => 'Käyttäjä on jo vahvistetty',
                'cant_confirm' => 'Ongelma vahvistettaessa käyttäjää',
                'cant_deactivate_self' => 'Et voi tehdä tätä itsellesi.',
                'cant_delete_admin' => 'Et voi poistaa pääkäyttäjää.',
                'cant_delete_self' => 'Et voi poistaa itseäsi.',
                'cant_delete_own_session' => 'Et voi poistaa omaa sessiotasi.',
                'cant_restore' => 'Tätä käyttäjää ei ole poistettu, joten sitä ei voida palauttaa',
                'cant_unconfirm_admin' => 'You can not un-confirm the super administrator.',
                'cant_unconfirm_self' => 'You can not un-confirm yourself.',
                'create_error' => 'Ongelma luotaessa käyttäjää. Yritä uudelleen.',
                'delete_error' => 'Ongelma poistettaessa käyttäjää. Yritä uudelleen.',
                'delete_first' => 'Tämä käyttäjä täytyy poistaa, ennen kuin se voidaan tuhota pysyvästi.',
                'email_error' => 'Tämä sähköposti kuuluu toiselle käyttäjälle.',
                'mark_error' => 'Ongelma päivitettäessä käyttäjää. Yritä uudelleen.',
                'not_confirmed' => 'Käyttäjää ei ole vahvistettu.',
                'not_found' => 'Käyttäjää ei ole olemassa.',
                'restore_error' => 'There was a problem restoring this user. Please try again.',
                'role_needed_create' => 'Sinun täytyy valita ainakin yksi rooli',
                'role_needed' => 'Sinun täytyy valita ainakin yksi rooli',
                'social_delete_error' => 'Ongelma poistettaessa sometiliä.',
                'update_error' => 'Ongelma päivtettäessä käyttäjää.',
                'update_password_error' => 'Ongelma vaihdettaessa käyttäjän salasanaa.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Tilisi on jo vahvistettu',
                'confirm' => 'Vahvista käyttäjätilisi!',
                'created_confirm' => 'Sinut on onnistuneesti rekisteröity Flipkotiin. Lähetimme sinulle vahvistusviestin sähköpostiisi, Vahvista ja kirjaudu linkistä. Kiitos.',
                'created_pending' => 'Käyttäjätilisi on onnistuneesti hyväksytty ja odottaa hyväksyntää. Saat sähköpostin, kun tilisi on hyväksytty.',
                'mismatch' => 'Vahvistuskoodi ei täsmää.',
                'not_found' => 'Tätä vahvistuskoodia ei ole olemassa.',
                'pending' => 'Käyttäjätilisi odottaa hyväksyntää',
                'resend' => 'Käyttäjätiliäsi ei ole hyväksytty. Ole hyvä ja klikkaa linkkiä sähköpostissasi, tai <a href=":url">paina tästä</a> uudelleen lähttääksesi vahvistusviestin.',
                'success' => 'Tilisi on onnistuneesti vahvistettu!',
                'resent' => 'Uusi vahvistussähköposti on lähetetty.',
            ],

            'deactivated' => 'Tilisi on deaktivoitu',
            'email_taken' => 'Tämä sähköposti on jo käytössä',

            'password' => [
                'change_mismatch' => 'Tämä ei ole vanha salasanasi',
                'reset_problem' => 'Ongelma vaihdettaessa salasanaa. Ole hyvä ja lähetä salasananvaihtosähköposti uudelleen.',
            ],

            'registration_disabled' => 'Rekisteröinti on juuri nyt suljettu.',
        ],
    ],
];
