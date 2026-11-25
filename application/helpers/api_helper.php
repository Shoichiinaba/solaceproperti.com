<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * =====================================================
 * FUNGSI REQUEST API
 * =====================================================
 */
if (!function_exists('call_api')) {

    function call_api($url, $method = 'GET', $data = [])
    {
        $CI = &get_instance();
        $CI->load->config('api');
        $api_key = $CI->config->item('api_key');

        $ch = curl_init();

        // GET
        if ($method == 'GET') {

            if (!empty($data)) {
                $url .= '?' . http_build_query($data);
            }

            curl_setopt($ch, CURLOPT_URL, $url);
        }
        // POST / PUT / DELETE
        else {

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

            if (!empty($data)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            }
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-API-KEY: ' . $api_key,
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($ch);

        // CURL ERROR
        if (curl_errno($ch)) {

            log_message('error', curl_error($ch));

            curl_close($ch);

            redirect('Activation');
            exit;
        }

        // HTTP CODE
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        // API KEY SALAH
        if ($http_code == 401 || $http_code == 403) {

            log_message('error', 'API KEY INVALID');

            redirect('Activation');
            exit;
        }

        $result = json_decode($response, true);

        /**
         * ============================================
         * CEK STATUS API KEY
         * Sesuaikan dengan response API Anda
         * ============================================
         */

        if (isset($result['status'])) {

            // jika status berupa string
            if ($result['status'] === 'inactive') {

                log_message('error', 'API KEY INACTIVE');

                redirect('Activation');
                exit;
            }

            // jika status boolean false
            if ($result['status'] === false) {

                if (
                    isset($result['message']) &&
                    (
                        stripos($result['message'], 'inactive') !== false ||
                        stripos($result['message'], 'tidak aktif') !== false
                    )
                ) {

                    redirect('Activation');
                    exit;
                }
            }
        }

        return $result;
    }
}


/**
 * =====================================================
 * GET PROPERTI POPULER
 * =====================================================
 */

if (!function_exists('get_properti_populer')) {

    function get_properti_populer()
    {
        return call_api('https://admin.solaceproperti.com/Api/properti');
    }

}


/**
 * =====================================================
 * UPDATE VIEWER
 * =====================================================
 */

if (!function_exists('update_viewer_properti')) {

    function update_viewer_properti($id_properti)
    {

        return call_api(
            'https://admin.solaceproperti.com/Api/properti',
            'PUT',
            [
                'id_properti' => $id_properti
            ]
        );

    }

}