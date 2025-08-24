<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_banner_properti')) {
    function get_banner_properti()
    {
        // Load CodeIgniter instance to access the config
        $CI = &get_instance();
        // Load the API config (if it's not auto-loaded)
        $CI->load->config('api');
        // Get the API key from the config file
        $api_key = $CI->config->item('api_key'); // Assuming it's stored in the config
        // API URL
        $api_url = 'https://admin.solaceproperti.com//Api/banner';

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL
        curl_setopt($ch, CURLOPT_URL, $api_url);

        // Return the transfer as a string instead of outputting it directly
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Add the API key header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $api_key
        ));

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            // Handle error
            $error_msg = curl_error($ch);
            echo "cURL Error: $error_msg";
            return false;
        } else {
            // Decode the JSON response into an associative array
            $banner_properti = json_decode($response, true);

            // Close cURL session
            curl_close($ch);

            return $banner_properti;
        }
    }
}