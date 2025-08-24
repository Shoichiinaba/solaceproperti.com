<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_properti_populer')) {
    function get_properti_populer()
    {
        $CI = &get_instance();
        $CI->load->config('api');
        $api_key = $CI->config->item('api_key');

        // API URL
        $api_url = 'https://admin.kanpa.co.id/Api/properti';

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $api_url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $api_key
        ));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            echo "cURL Error: $error_msg";
            return false;
        } else {
            $properti_populer = json_decode($response, true);

            curl_close($ch);

            return $properti_populer;
        }
    }
}