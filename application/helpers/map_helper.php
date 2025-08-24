<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

if (!function_exists('get_map_data')) {
    function map_data()
    {
        // Load CodeIgniter instance to access the config
        $CI = &get_instance();
        // Load the API config (if it's not auto-loaded)
        $CI->load->config('api');
        // Get the API key from the config file
        $api_key = $CI->config->item('api_key'); // Assuming it's stored in the config
        // API URL
        $api_url = 'https://admin.kanpa.co.id/Api/mapdata';

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

    function fetch_svg_map($id)
    {
        // Load the CodeIgniter instance
        $CI = &get_instance();

        $CI->load->config('api');
        // Load the API key from config
        $api_key = $CI->config->item('api_key');
        $client = new Client();
        $api_url = 'https://admin.kanpa.co.id/Api/map?id=' . $id;

        try {
            $response = $client->request('GET', $api_url, [
                'headers' => [
                    'X-API-KEY' => $api_key
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $map_data = json_decode($response->getBody());

                if (isset($map_data->data[0]->svg_map)) {
                    return [
                        'status' => 'success',
                        'svg_map' => trim($map_data->data[0]->svg_map)
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'Data svg_map tidak ditemukan dalam respons API'
                    ];
                }
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Gagal menghubungi API: ' . $response->getStatusCode()
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Gagal menghubungi API: ' . $e->getMessage()
            ];
        }
    }

    function fetch_mapcolor_data()
    {
        // Load the CodeIgniter instance
        $CI = &get_instance();

        $CI->load->config('api');
        // Load the API key from config
        $api_key = $CI->config->item('api_key');
        $client = new Client();
        $api_url = 'https://admin.kanpa.co.id/Api/mapcolor';

        try {
            $response = $client->request('GET', $api_url, [
                'headers' => [
                    'X-API-KEY' => $api_key
                ]
            ]);

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                if (isset($data['data']) && is_array($data['data'])) {
                    return [
                        'status' => 'success',
                        'data' => $data['data']
                    ];
                } else {
                    return [
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan dalam respons API'
                    ];
                }
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Gagal menghubungi API, status code: ' . $response->getStatusCode()
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
        }
    }
}
