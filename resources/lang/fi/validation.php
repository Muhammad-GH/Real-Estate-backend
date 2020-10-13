<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' :syötteen tulee olla hyväksytty.',
    'active_url' => ' :syöte ei ole kelvollinen URL.',
    'after' => 'The :päivämäärä tulee olla jälkeen :päivämäärän.',
    'after_or_equal' => ' :päivämäärän tulee olla sama tai jälkeen :päivämäärän.',
    'alpha' => ' :voi sisältää vain kirjaimia',
    'alpha_dash' => ' :syöte voi sisältää vain kirjaimia, numeroita, ajatusviivoja ja alaviivoja.',
    'alpha_num' => ' :syöte voi sisältää vain kirjaimia, numeroita.',
    'array' => ' :syötteen tulee olla ryhmä.',
    'before' => ' :syötteen tulee olla päivämäärä ennen :päivämäärää.',
    'before_or_equal' => ' :päivämäärän tulee olla ennen tai sama kuin :päivämäärä.',
    'between' => [
        'numeric' => ' :syötteen tulee olla välillä :min ja :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => 'Associated Roles',
                    'dependencies' => 'Riippuvuudet',
                    'display_name' => 'Näytä nimi',
                    'group' => 'Ryhmä',
                    'group_sort' => 'Group Sort',

                    'groups' => [
                        'name' => 'Ryhmän nimi',
                    ],

                    'name' => 'Nimi',
                    'first_name' => 'Etunimi',
                    'last_name' => 'Sukunimi',
                    'system' => 'Järjestelmä',
                ],

                'roles' => [
                    'associated_permissions' => 'Associated Permissions',
                    'name' => 'Nimi',
                    'sort' => 'Sort',
                ],

                'users' => [
                    'active' => 'Aktiivinen',
                    'associated_roles' => 'Liitetyt roolit',
                    'confirmed' => 'Vahvistettu',
                    'email' => 'Sähköpostiosoite',
                    'name' => 'Nimi',
                    'last_name' => 'Sukunimi',
                    'first_name' => 'Etunimi',
                    'other_permissions' => 'Muut käyttöoikeudet',
                    'password' => 'Salasana',
                    'password_confirmation' => 'Salasana uudelleen',
                    'send_confirmation_email' => 'Lähetä vahvistusviesti',
                    'timezone' => 'Aikavyöhyke',
                    'language' => 'Kieli',
                ],
            ],
        ],

        'frontend' => [
            'avatar' => 'Avatar Location',
            'email' => 'Sähköpostiosoite',
            'first_name' => 'Etunimi',
            'last_name' => 'Sukunimi',
            'name' => 'Koko nimi',
            'password' => 'Uusi salasana',
            'password_confirmation' => 'Vahvista salasana',
            'phone' => 'Puhelin',
            'message' => 'Viesti',
            'new_password' => 'Uusi salasana',
            'new_password_confirmation' => 'Uusi salasana uudelleen',
            'old_password' => 'Vanha salasana',
            'timezone' => 'Aikavyöhyke',
            'language' => 'Kieli',
        ],
    ],
];

