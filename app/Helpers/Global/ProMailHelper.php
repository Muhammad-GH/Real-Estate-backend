<?php

use App\Models\Email;
use App\Models\Languages;

if (!function_exists('send_pro_email')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function send_pro_email($data)
    {
        $mail_data = array();
        if (isset($data['email_id'])) {
            $mail_data = get_email_template($data['email_id'], $data['langcode'], $data['replace_var_subject'], $data['replace_var_body']);
        }
        //print_r($mail_data['send_to']);die;
        if ($mail_data) {
            $body = array('name' => $data['send_from'], 'body' => htmlspecialchars($mail_data['body']));
            Mail::send('mails/mail', $body, function ($message) use ($data, $mail_data) {
                $message->to($data['send_to'], 'Flipkoti')->subject($mail_data['subject']);
                $message->from(env('MAIL_USERNAME'), 'Flipkoti');
                if ($data['file_path'] != '') {
                    $message->attach($data['file_path']);
                }
            });
        }
    }
}


if (!function_exists('get_email_template')) {
    /**
     * Helper to grab the json template
     *
     * @return mixed
     */
    function get_email_template($email_id, $langcode = '', $replace_var_subject = '', $replace_var_body = '')
    {
        $subject = '';
        $body = '';
        $langcode = Session::get('locale');
        if ($langcode == '') {
            $langcode = 'fi';
        }


        $fileName = preg_replace('/\s+/', '_', $email_id . '.json');
        $path = storage_path("app/$langcode/$fileName");

        if (is_file($path)) {
            $json = json_decode(file_get_contents($path), true);

            if (is_array($replace_var_subject)) {
                $subject = $json['subject'];

                foreach ($replace_var_subject as $key => $val) {
                    $subject = str_replace($key, $val, $subject);
                }
            } else {
                $subject = $json['subject'];
            }
            if (is_array($replace_var_body)) {
                $body = $json['intro'];
                foreach ($replace_var_body as $key => $val) {
                    $body = str_replace($key, $val, $body);
                }
            } else {
                $body = $json['intro'];
            }
        } else {
            //if file not exist check DB for backup
            $email_data = Email::where('email_for', $email_id)->where('language', $langcode)->first();
            if ($email_data) {
                $subject = str_replace('{{company_name}}', '', $email_data->subject);
                $body = str_replace("{{name}}", "Nishant", $email_data->intro);
            }
        }


        $data = array("subject" => $subject, "body" => $body);


        return $data;
    }
}
