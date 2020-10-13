<?php

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('home_route')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                session()->put('locale', 'en');
                return 'admin.dashboard';
            }
            session()->put('locale', 'fi');
            return 'frontend.user.dashboard';
        }

        return 'frontend.index';
    }
}

if (! function_exists('datetimeDiff')) {

    function datetimeDiff($datetime){
        $now = time();
        $t2 = strtotime($datetime);
        $datediff = $t2 - $now;
        $days = round($datediff / (60 * 60 * 24));
        $hours = round( $datediff % (60 * 60 * 24) / ( 60 * 60 ) );
        return ['day'=>$days, 'hour'=>$hours];
    }
}

if (! function_exists('budgetTypeFormat')) {

    function budgetTypeFormat($budgetType){
        $budget = '';
        switch ($budgetType) {
            case 'Hourly':
                $budget = '/h';
                break;
            case 'per_m2':
                $budget = '/m <sup>2</sup>';
                break;
            case 'Unit':
                $budget = '/huoneisto';
                break;    
            default:
                $budget = 'Fixed';
                break;
        }

        return $budget;
    }
}

if (! function_exists('budgetGetPriceVariable')) {

    function budgetGetPriceVariable($appartment_size, $price_range){
        $price = 0;
        $unsrange = unserialize($price_range);
        foreach($unsrange as $urange){
            switch($urange['rule']){
                case 'lessthan':
                    if($appartment_size < (int)$urange['value'])
                        $price = (int)$urange['price'];
                    break;
                case 'between':
                    $sze = explode("-",$urange['value']);
                    if($appartment_size > (int)$sze[0] && $appartment_size < (int)$sze[1])
                        $price = (int)$urange['price'];
                    break;
                case 'greaterthan':
                    if($appartment_size > (int)$urange['value'])
                        $price = (int)$urange['price'];
                    break;
            }
        }
        return $price;
    }
}

if (! function_exists('dateDisplay')) {

    function dateDisplay($date, $format){
       return date($format, strtotime($date));
    }
}

if (! function_exists('translateText')) {
    
    function translateText($langtextarr,$text){
        return $text;
        $langtextarr = Session::get('langtext');
        foreach($langtextarr as $key => $value){

            if(in_array($text, $value)){
                
                if(Session::get('locale') == 'en'){
                    return $langtextarr[$key][1];
                }
                else{
                    return $langtextarr[$key][0];    
                }
                break;
            }
        } 
    }
}

if (! function_exists('formatNumber')){
    function formatNumber($num)
    {
        if(strpos($num, '.') !== false){
            $numarr = explode('.' , $num);
            if($numarr[1]>0){
                return $num;
            }
            else{
                return $numarr[0];
            }
        }
        else{
            return $num;
        }
    }
}

if (! function_exists('mailerLiteApi')){
    function mailerLiteApi($group,$name,$email,$phone)
    {
        $site_save_mailerlight =  config('global_configurations.admin.site_save_mailerlight');
        if($site_save_mailerlight == 'Yes'){
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.mailerlite.com/api/v2/groups/$group/subscribers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"email\":\"$email\", \"name\": \"$name\", \"fields\": {\"phone\": \"$phone\"}}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "x-mailerlite-apikey: 7aa0ea63dd121acb7599c52575bc3071"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            // if ($err) {
            // echo "cURL Error #:" . $err;
            // } else {
            // echo $response;
            // }
        }
    }
}