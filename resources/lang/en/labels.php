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
        'all' => 'All',
        'yes' => 'Yes',
        'no' => 'No',
        'copyright' => 'Copyright',
        'custom' => 'Custom',
        'actions' => 'Actions',
        'active' => 'Active',
        'buttons' => [
            'save' => 'Save',
            'update' => 'Update',
        ],
        'hide' => 'Hide',
        'inactive' => 'Inactive',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new' => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more' => 'More',
        'select' => 'Select',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions' => 'Permissions',
                    'role' => 'Role',
                    'sort' => 'Sort',
                    'total' => 'role total|roles total',
                ],
            ],

            'users' => [
                'active' => 'Active Users',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'management' => 'User Management',
                'email' => 'Email Management',
                'email_cre' => 'Create Content',
                'pro' => 'Pro Users',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',
                'user_actions' => 'User Actions',
                'general' => 'General Settings',
                'case' => 'Case Settings',

                'table' => [
                    'confirmed' => 'Confirmed',
                    'created' => 'Created',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Name',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted' => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'rights' => 'Rights',
                    'permissions' => 'Permissions',
                    'abilities' => 'Abilities',
                    'roles' => 'Roles',
                    'social' => 'Social',
                    'total' => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history' => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Confirmed',
                            'created_at' => 'Created At',
                            'deleted_at' => 'Deleted At',
                            'email' => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'name' => 'Name',
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'status' => 'Status',
                            'timezone' => 'Timezone',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
            
            
        ],

        'category' => [
            'create' => 'Create Category',
            'edit' => 'Edit Category',
            'update' => 'Update Category',
            'management' => 'Category Management',

            'table' => [
                'name' => 'Category Name',
                'parent' => 'Parent Category',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        'materialcategory' => [
            'create' => 'Create Material Category',
            'edit' => 'Edit Material Category',
            'update' => 'Update Material Category',
            'management' => 'Material Category Management',

            'table' => [
                'name' => 'Material Category Name',
                'parent' => 'Parent Category',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        'workcategory' => [
            'create' => 'Create Work Category',
            'edit' => 'Edit Work Category',
            'update' => 'Update Work Category',
            'management' => 'Work Category Management',

            'table' => [
                'name' => 'Work Category Name',
                'parent' => 'Parent Category',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        'tender' => [
            'create' => 'Create Tender',
       
            'create_material_offer' => 'Create material offer',
            'create_material_request' => 'Create material request',
            'create_work_offer' => 'Create work offer',
            'create_work_request' => 'Create work request',
            'edit' => 'Edit Tender',
            'update' => 'Update Tender',
            'management' => 'Marketplace/Tender Management',
            'search' => 'Search Tender By Name',
            'table' => [
                'name' => 'Tender Name',
                'title' => 'Title',
                'type' => 'Type',
                'category_type' => 'Type',
                'category' => 'Category',
                'tender_expire'=>'Expire In',
                'created' => 'Created',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        'configuration' => [
            'create' => 'Create Configuration',
            'edit' => 'Edit Configuration',
            'update' => 'Update Configuration',
            'management' => 'Global Configurations',

            'table' => [
                'admin_email' => 'Admin Email',
                'pagination' => 'Default Pagination',
                'language' => 'Default Language (Admin)',
                'language_pro' => 'Default Language (Pro)',
                'language_consumer' => 'Default Language (Consumer)',
                'date_format' => 'Date Format',
                'time_format' => 'Time Format',
                'datepicker_date_format'=>'Datepicker Date Format',
                'datepicker_time_format' => 'Datepicker Time Format', 
                'default_country' => 'Default Country',
                'site_mode' => 'Site Mode',
                'site_mode_consumer' => 'Consumer Site Mode',  
                'site_save_mailerlight' => 'Save Form Data To Mailerlight',  
                'site_service_fee' => 'Service Fee %',  
                'total' => 'total records',
                'header_tag' =>'Add data above head tag',
                'body_tag' =>'Add data after body tag',
                'left_currency_symbol' =>'Left Currency Symbol',
                'right_currency_symbol' =>'Right Currency Symbol',
                'pro_site_url' =>'Pro Base Url'
            ],
        ],
        'country' => [
            'title' => 'Country',
            'create' => 'Create Country',
            'edit' => 'Edit Country',
            'update' => 'Update Country',
            'management' => 'Country Management',
            'search' => 'Search Country By Name',
            'country_english' => 'Country English',
            'country_finnish' => 'Country Finnish',
            'create_country_language' => 'Create Country By Language',
            'create_country' => 'Create Country',
            'table' => [
                'name' => 'Country Name',
                'code' => 'Country Code',
                'language' => 'Language',
                 
                'created' => 'Created',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        'state' => [
            'title' => 'State',
            'create' => 'Create State',
            'edit' => 'Edit State',
            'update' => 'Update State',
            'management' => 'State Management',
            'search' => 'Search State By Name',
            'state_english' => 'State English',
            'state_finnish' => 'State Finnish',
            'create_state_language' => 'Create State By Language',
            'create_state' => 'Create State',

            'table' => [
                'name' => 'State Name',
                'code' => 'State Code',
                'language' => 'Language',
                 
                'country' => 'Country',
                'created' => 'Created',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        'city' => [
            'title' => 'City',
            'create' => 'Create City',
            'edit' => 'Edit City',
            'update' => 'Update City',
            'management' => 'City Management',
            'search' => 'Search City By Name',
            'city_english' => 'City English',
            'city_finnish' => 'City Finnish',
            'create_city_language' => 'Create City By Language',
            'create_city' => 'Create City',
            'select_state' => 'Select State',
            'select_country' => 'Create Country',

            'table' => [
                'name' => 'City Name',
                'code' => 'City Code',
                'language' => 'Language',
                 
                'country' => 'Country',
                'state' => 'State',
                'created' => 'Created',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        'workarea' => [
            'title' => 'Workarea',
            'create' => 'Create Workarea',
            'edit' => 'Edit Workarea',
            'update' => 'Update Workarea',
            'management' => 'Workarea Management',
            'search' => 'Search Workarea By Name',
            'workarea_english' => 'Workarea English',
            'workarea_finnish' => 'Workarea Finnish',
            'create_workarea_language' => 'Create Workarea By Language',
            'create_workarea' => 'Create Workarea',
            'table' => [
                'name' => 'Workarea Name',
                'code' => 'Workarea Code',
                'language' => 'Language',
                 
                'created' => 'Created',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        'workphase' => [
            'title' => 'Workphase',
            'create' => 'Create Workphase',
            'edit' => 'Edit Workphase',
            'update' => 'Update Workphase',
            'management' => 'Workphase Management',
            'search' => 'Search Workphase By Name',
            'workphase_english' => 'Workphase English',
            'workphase_finnish' => 'Workphase Finnish',
            'create_workphase_language' => 'Create Workphase By Language',
            'create_workphase' => 'Create Workphase',

            'table' => [
                'name' => 'Workphase Name',
                'code' => 'Workphase Identifier',
                'language' => 'Language',
                 
                'workarea' => 'Workarea',
                'created' => 'Created',
                'sort' => 'Sort', 
                'last_updated' => 'Last Updated',
                'total' => 'total records',
            ],
        ],
        
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'Login',
            'login_button' => 'Login',
            'login_with' => 'Login with :social_media',
            'register_box_title' => 'Register',
            'pro_login' => 'Pro Login',
            'register_button' => 'Register',
            'remember_me' => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password' => 'Forgot Your Password?',
            'reset_password_box_title' => 'Reset Password',
            'reset_password_button' => 'Reset Password',
            'update_password_button' => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'created_at' => 'Created At',
                'edit_information' => 'Edit Information',
                'email' => 'E-mail',
                'last_updated' => 'Last Updated',
                'name' => 'Name',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],
    ],
];
