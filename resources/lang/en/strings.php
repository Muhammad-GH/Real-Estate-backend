<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => 'Are you sure you want to delete this user permanently? Anywhere in the application that references this user\'s id will most likely error. Proceed at your own risk. This can not be un-done.',
                'if_confirmed_off' => '(If confirmed is off)',
                'no_deactivated' => 'There are no deactivated users.',
                'no_deleted' => 'There are no deleted users.',
                'restore_user_confirm' => 'Restore this user to its original state?',
            ],
        ],

        'dashboard' => [
            'title' => 'Dashboard',
            'welcome' => 'Welcome',
        ],

        'general' => [
            'all_rights_reserved' => 'All Rights Reserved.',
            'are_you_sure' => 'Are you sure you want to do this?',
            'are_you_sure_to_unblish' => 'Are you sure you want to unpublish this?',
            'boilerplate_link' => 'Flipkoti',
            'continue' => 'Continue',
            'member_since' => 'Member since',
            'minutes' => ' minutes',
            'search_placeholder' => 'Search...',
            'timeout' => 'You were automatically logged out for security reasons since you had no activity in ',

            'see_all' => [
                'messages' => 'See all messages',
                'notifications' => 'View all',
                'tasks' => 'View all tasks',
            ],

            'status' => [
                'online' => 'Online',
                'offline' => 'Offline',
            ],

            'you_have' => [
                'messages' => '{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications' => '{0} You don\'t have notifications|{1} You have 1 notification|[2,Inf] You have :number notifications',
                'tasks' => '{0} You don\'t have tasks|{1} You have 1 task|[2,Inf] You have :number tasks',
            ],
        ],

        'search' => [
            'empty' => 'Please enter a search term.',
            'incomplete' => 'You must write your own search logic for this system.',
            'title' => 'Search Results',
            'results' => 'Search Results for :query',
        ],

        'welcome' => 'Welcome to the Dashboard',
    ],

    'emails' => [
        'auth' => [
            'account_confirmed' => 'Your account has been confirmed.',
            'error' => 'Whoops!',
            'greeting' => 'Hello!',
            'regards' => 'Regards,',
            'trouble_clicking_button' => 'If you’re having trouble clicking the ":action_text" button, copy and paste the URL below into your web browser:',
            'thank_you_for_using_app' => 'Thank you for using our application!',

            'password_reset_subject' => 'Reset Password',
            'password_cause_of_email' => 'You are receiving this email because we received a password reset request for your account.',
            'password_if_not_requested' => 'If you did not request a password reset, no further action is required.',
            'reset_password' => 'Click here to reset your password',

            'click_to_confirm' => 'Click here to confirm your account:',
        ],

        'contact' => [
            'email_body_title' => 'You have a new contact form request: Below are the details:',
            'subject' => 'A new :app_name contact form submission!',
        ],
    ],

    'frontend' => [
        'test' => 'Test',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role' => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles' => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not' => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => 'Using Access Helper with Permission Name',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works' => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because' => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'general' => [
            'joined' => 'Joined',
        ],

        'user' => [
            'change_email_notice' => 'If you change your e-mail you will be logged out until you confirm your new e-mail address.',
            'email_changed_notice' => 'You must confirm your new e-mail address before you can log in again.',
            'profile_updated' => 'Profile successfully updated.',
            'password_updated' => 'Password successfully updated.',
        ],

        'welcome_to' => 'Welcome to :place',
        'footer' => [
            'about_us' => 'About us',
            'sale' => 'Sale',
            'sell' => 'Sell',
            'stationing' => 'stationing',
        ],
        'home' => [
            'know_value' => 'Know the value of your apartment',
            'buying_n_sell' => 'Buying or selling - we help',
            'get_offer' => 'Get the Offer',
            'free_quote' => 'Get a free quote',
            'sale' => 'Sale',
            'canmpt_find_apartment_text' => 'Can\'t find an apartment that meets your wishes?',
            'home_text_1' => 'The home you deserve. A home that fulfills your expectations',
            'home_text_2' => 'We will help you, make it <br>a new way and make it <br>easy for you',
            'home_text_3' => 'The home you deserve. A home that fulfills your expectations',
            'sell' => 'Sell',
            'home_text_4' => 'Services for different needs at low cost, in one place',
            'home_text_5' => 'The apartment is often <br> The biggest investment.',
            'value_home' => 'Know the value of your home',
            'are_you' => 'Are you?',
            'homeowner' => 'Homeowner',
            'lorem_ipsum' => 'Lorem ipsum dolor sit amet, consectetur adipiscing Elit. Vestibulum Mattis, most vel ornare dictum,',
            'appellant' => 'Appellant',
            'sell_home' => 'Sell your home',
            'flipkoti' => 'Flipkoti',
            'home_text_6' => 'Want a quick and hassle-free sale of your home?',
            'buy_apartment' => 'We buy apartments',
            'helsinki' => 'Helsinki',
            'jarvenpaa' => 'Jarvenpaa',
            'bay' => 'Bay',
            'tampere' => 'Tampere',
            'vantaa' => 'Vantaa',
            'porvoo' => 'Porvoo',
            'Hyvinkaa' => 'Hyvinkää',
            'vaasa' => 'Vaasa',
            'espoo' => 'Espoo',
            'turku' => 'Turku',
            'jyvaskyla' => 'Jyväskylä',
            'rauma' => 'Rauma',
            'housing_investor' => 'housing Investor',
            'home_text_7' => 'A new and carefree way to invest in housing',
            'home_text_8' => 'Great return on your capital, in a new way.',
            'check_solution' => 'Check out our solution',
            'join_network' => 'Join our network',
            'home_text_9' => 'Through our services we sell, buy and invest a home.',
            'photography' => 'Photography',
            'profit_analysis' => 'Profitability Analysis',
            'home_text_10' => 'Increasing the value of the dwelling',
            'home_text_11' => 'Material selection and tendering',
            'interior_design' => 'Interior Design',
            'styling' => 'Styling',
            'pictures' => 'Ground Pictures',
            'kilpailutus' => 'The contractor Kilpailutus',
            '3D_images' => '3D images',
            'virtual_tours' => 'Virtual Tours',
            'renovated_apartment' => 'Renovated apartment',
            'agents' => 'Agents',
            'home_text_12' => 'Home renovation and sale without own risk',
            'sell_and_rent' => 'Sell and rent',
            'contractors' => 'Contractors',
        ],
        'sell'=>[
             'sell_text_1' => 'Sell your apartment easily renovated <br> or as it is.',
            'sell_text_2' => 'Couldn’t you find apartment<br> from with right specification <br>from right area?',
            'sell_text_3' => 'Have you find apartment from<br> your searched are but it is awful<br> or done with wrong style ?',
            'sell_text_4' => 'Sell your apartment for two prices. Or flip home before selling. It\'s easy and profitable with us.',
            'sell_text_5' => '1. Provide information about your apartment, including a picture of each room.',
            'sell_text_6' => '2. Get Impressive 3D Plans for a Renovated and Styled Home (Fast)',
            'sell_text_7' => '3. Get a pre-contracted renovation plan by a professional and pre-compete. Including renovation description, competitive and reliable contractors and cost effective and impressive materials. Give the apartment a flip price. (Easy)',
            'sell_text_8' => '4. Carry out repairs as planned if you wish to carry out repairs before sale. You will receive our support through the project.',
            'sell_text_9' => '5. Keys to a flip home.',
            'sell_text_10' => '6. You decide how you want to sell your home. By ourselves, with our help, or by our network of top brokers.',
            'sell_text_11' => 'Sell your home to us',
            'sell_text_12' => 'No commission fees, no form filling, no customer searching.',
            'sell_text_13' => 'To know more',
            'sell_text_14' => 'Maximize the value of your home. We will help you.',
            'sell_text_15' => 'Agent',
            'sell_text_16' => 'Consumer',
            'sell_text_17' => 'Three levels of service, select the one you want',
            'sell_text_18' => 'Fast',
            'sell_text_19' => '7€/m2',
            'sell_text_20' => 'Get a plan with 3d renders (visulise a potential in BUY/Sell situation)',
            'sell_text_21' => 'SELECT',
            'sell_text_22' => 'Easy',
            'sell_text_23' => '10€/m2',
            'sell_text_24' => '3d rendering',
            'sell_text_25' => 'Renovation plan with timetable',
            'sell_text_26' => 'Contractor bidding + recommendation',
            'sell_text_27' => 'Agreement with contractor',
            'sell_text_28' => 'Material bidding and delivery',
            'sell_text_29' => 'Turnkey',
            'sell_text_30' => '12€/m2',
            'sell_text_31' => 'No own money needed if don’t want, you earn- we take a risk',
            'sell_text_32' => 'OR',
            'sell_text_33' => '50% of value increase- costs (in selling situation)',
            'sell_text_34' => 'Extra Service',
            'sell_text_35' => 'Choose plan according to your need',
            'sell_text_36' => 'Financing with no costs/interest',
            'sell_text_37' => 'Interior design and furnitures',
            'sell_text_38' => 'All you need to sell home by yourself with or without broker',
            'sell_text_39' => 'All you need to sell<br>home by yourself with<br>or without broker',
            'sell_text_40' => 'CHOOSE DESIGN',
            'sell_text_41' => 'Broker back up - 100€/40min',
            'sell_text_42' => 'Layer back up 150€/h',
            'sell_text_43' => 'Documentation for selling home / 50 € (Template, Bid template)',
            'sell_text_44' => '3D tour and pictures /photography',
            'sell_text_45' => 'Drone photography',
            'sell_text_46' => 'If we fail to deliver on our promise within the promised time, you will pay only 70% of the actual cost of the renovation and you will be able to enjoy your renovated home. We bear the financial risk.',
            'sell_text_47' => '* Includes exclusive package',
        ],
        'stationing'=>[
            'station_text_1'=>'How to Invest in a Flip Home',
            'station_text_2'=>'You can now become a home equity investor with low capital, diversified risk, no worries and hassle about renting or developing value.',
            'station_text_3'=>'Flipkoti helps smaller and bigger players invest in a new way to maximize returns.',
            'station_text_4'=>'Acquisition of dwellings',
            'browse_homes'=>'Browse homes',
            'investing'=>'Investing',
            'increase_profits'=>'Increase your profits',
            'increase_investment'=>'Increase your investment',
            'station_text_5'=>'Flipkod experts and the network are looking for homes around Finland and in the future also internationally. We only invest if we invest. This way we want to make sure and show that all apartments and investments are carefully analyzed and we only invest when we know what we are buying and what the investment will do.',
            'station_text_6'=>'Flipkoti also receives bids from both private and major players.',
            'station_text_7'=>'When making the acquisition decision, Flipkoti analyzes the investment technically and economically. Taking into account regional development as well as technical risks. Once the technical and financial risks have been analyzed and the item has been found to meet the criteria, we will take the item from scratch. We publish the item to our investors using calculations and plans. We make the investment once the target investors have been found.',
            'station_text_8'=>'The Flipkoti team searches internationally to provide you with some of the most competitive off market opportunities that are typically not available to the general public. All assets are carefully screened and evaluated internally prior to listing on the platform. In addition, people, institutions and legal entities are welcome to submit applications to sell or part of their property or properties. All applicants will be contacted personally by a member of the Flipkoti team. Alternatively, real estate owners will be notified if their property is not suitable for the platform.',
            'station_text_9'=>'An easy way to invest and outsource risk',
            'station_text_10'=>'DepotHouse (Stage 2)',
            'residential'=>'Residential',
            'station_text_11'=>'Shipping 25c, 0 Tallinn, Estonia',
            'station_text_12'=>'Stable passive income guaranteed for the first 24 months.',
            'invested'=>'Invested',
            'target'=>'Target',
            'invest_now'=>'Invest now',
            'station_text_13'=>'Check out our portfolio or subscribe to our free weekly newsletter by email.',
            'station_text_14'=>'CHECK ALL PROPERTY',
            'station_text_15'=>'How does investing work?',
            'station_text_16'=>'We analyze items on the market and offered to us',
            'station_text_17'=>'We show investors who have passed the profitability and risk analysis.',
            'station_text_18'=>'We are buying a high-yield item together with investors.',
            'station_text_19'=>'We renovate the apartment cost-effectively with reliable partners.',
            'station_text_20'=>'We sell or rent the property.',
            'station_text_21'=>'You get a return on your capital.',
            'station_text_22'=>'We promise a 5% annual return. The target is to achieve + 10% annual return. We carry the risk with our network, and you get a guaranteed return on your money.',
            'station_text_23'=>'Join the investor list',
        ],
        'about_us'=>[
            'lorem_ipsum_short'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris rhoncus, arcu sit amet feugiat interdum, lorem mi commodo nisl, vel volutpat erat tortor sed odio. Vestibulum',
            'lorem_ipsum_long'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris rhoncus, arcu sit amet feugiat interdum, lorem mi commodo nisl, vel volutpat erat tortor sed odio. Vestibulum sit amet massa commodo, vehicula felis nec, elementum ligula. Fusce euismod, lacus nec porttitor rhoncus, tortor urna semper nisl, sed euismod libero magna porttitor mi. Duis enim arcu, pharetra non lectus sit amet, tincidunt lacinia justo. Nunc dignissim viverra velit sed pretium. Nullam scelerisque consequat magna,'
        ]
    ],
];
