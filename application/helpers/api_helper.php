<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_properti_populer')) {

    function get_properti_populer()
    {
        $CI = &get_instance();
        $CI->load->config('api');
        $api_key = $CI->config->item('api_key');

        // API URL
        $api_url = 'https://admin.solaceproperti.com/Api/properti';

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL and headers
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $api_key
        ));

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
            log_message('error', "cURL Error: $error_msg");
            curl_close($ch);
            return false;
        }

        // Get HTTP response code
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Handle HTTP response codes
        if ($http_code == 403 || $http_code == 401) { // API key verification failed
            log_message('error', "API Key Verification failed, Redirecting to Activation Page.");
            curl_close($ch);
            redirect('http://localhost:8080/solaceproperti.com/Activation');
            exit;
        }

        // Decode JSON response
        $properti_populer = json_decode($response, true);

        // Handle API-specific status checks
        if (isset($properti_populer['status']) && $properti_populer['status'] === 'inactive') {
            log_message('error', "API Key is inactive, Redirecting to Activation Page.");
            curl_close($ch);
            redirect('http://localhost:8080/solaceproperti.com/Activation');
            exit;
        }

        // Close cURL session
        curl_close($ch);

        // Return the decoded response
        return $properti_populer;
    }
}

if (!function_exists('update_viewer_properti')) {
    function update_viewer_properti($id_properti)
    {
        $CI = &get_instance();
        $CI->load->config('api');
        $api_key = $CI->config->item('api_key');

        $api_url = 'https://admin.solaceproperti.com/Api/properti/' . $id_properti;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $api_key,
            'Content-Type: application/json'
        ));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            log_message('error', 'cURL Error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }

        curl_close($ch);
        return json_decode($response, true);
    }
}