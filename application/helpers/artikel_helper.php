<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_artikel')) {
    function get_artikel()
    {
        // Load CodeIgniter instance to access the config
        $CI = &get_instance();
        // Load the API config (if it's not auto-loaded)
        $CI->load->config('api');
        // Get the API key from the config file
        $api_key = $CI->config->item('api_key'); // Assuming it's stored in the config

        // API URL
        $api_url = 'https://admin.solaceproperti.com/Api/article';

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
            $artikel = json_decode($response, true);

            // Close cURL session
            curl_close($ch);

            // Sort the articles by 'id_berita' in descending order
            if (!empty($artikel) && is_array($artikel)) {
                usort($artikel, function ($a, $b) {
                    return $b['id_berita'] <=> $a['id_berita'];
                });
            }

            return $artikel;
        }
    }
}
if (!function_exists('get_data_artikel')) {
    function get_data_artikel()
    {
        // Load CodeIgniter instance to access the config
        $CI = &get_instance();
        // Load the API config (if it's not auto-loaded)
        $CI->load->config('api');
        // Get the API key from the config file
        $api_key = $CI->config->item('api_key'); // Assuming it's stored in the config

        // API URL
        $api_url = 'https://admin.solaceproperti.com/Api/data_article';

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
            $data_artikel = json_decode($response, true);

            // Close cURL session
            curl_close($ch);

            // Sort the articles by 'id_berita' in descending order
            // if (!empty($data_artikel) && is_array($data_artikel)) {
            //     usort($data_artikel, function ($a, $b) {
            //         return $b['id_berita'] <=> $a['id_berita'];
            //     });
            // }

            return $data_artikel;
        }
    }
}