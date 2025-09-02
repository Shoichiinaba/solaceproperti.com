<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_artikel')) {
    function get_artikel()
    {
        $CI = &get_instance();
        $CI->load->config('api');
        $api_key = $CI->config->item('api_key');

        $api_url = 'https://admin.solaceproperti.com/Api/article';
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['X-API-KEY: ' . $api_key],
        ]);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // echo "cURL Error: " . curl_error($ch); // optional debug
            curl_close($ch);
            return [];
        }
        curl_close($ch);

        $decoded = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) return [];

        // Normalisasi berbagai bentuk respons
        $list = [];
        if (isset($decoded['data']) && is_array($decoded['data'])) {
            $list = $decoded['data'];
        } elseif (isset($decoded[1]) && is_array($decoded[1])) {
            $list = $decoded[1];
        } elseif (is_array($decoded) && isset($decoded[0]) && is_array($decoded[0])) {
            // fallback: mungkin langsung array artikel
            $list = $decoded;
        }

        // HANYA ambil item yang benar-benar artikel
        $list = array_values(array_filter($list, function ($row) {
            return is_array($row) && isset($row['id_berita']);
        }));

        // Sort descending by id_berita (aman walau string)
        if (!empty($list)) {
            usort($list, function ($a, $b) {
                return (int)$b['id_berita'] <=> (int)$a['id_berita'];
            });
        }

        return $list;
    }
}

// mengambil data artikel
if (!function_exists('get_data_artikel')) {
    function get_data_artikel()
    {
        $CI = &get_instance();
        $CI->load->config('api');
        $api_key = $CI->config->item('api_key');

        $api_url = 'https://admin.solaceproperti.com/Api/data_article';
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['X-API-KEY: ' . $api_key],
        ]);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // echo "cURL Error: " . curl_error($ch); // optional debug
            curl_close($ch);
            return [];
        }
        curl_close($ch);

        $decoded = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) return [];

        $list = [];
        if (isset($decoded['data']) && is_array($decoded['data'])) {
            $list = $decoded['data'];
        } elseif (isset($decoded[1]) && is_array($decoded[1])) {
            $list = $decoded[1];
        } elseif (is_array($decoded) && isset($decoded[0]) && is_array($decoded[0])) {
            $list = $decoded;
        }

        // Filter hanya item valid
        $list = array_values(array_filter($list, function ($row) {
            return is_array($row) && isset($row['id_berita']);
        }));

        return $list;
    }

    // untuk menjalankan PUT agar data viewer bisa bertambah

    if (!function_exists('update_view_artikel')) {
    function update_view_artikel($id_berita)
    {
        $CI = &get_instance();
        $CI->load->config('api');
        $api_key = $CI->config->item('api_key');

        $api_url = 'https://admin.solaceproperti.com/Api/article';

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $api_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => [
                'X-API-KEY: ' . $api_key,
                'Content-Type: application/x-www-form-urlencoded'
            ],
            CURLOPT_POSTFIELDS => http_build_query([
                'id_berita' => $id_berita
            ])
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return ['status' => 'fail', 'message' => curl_error($ch)];
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}

}