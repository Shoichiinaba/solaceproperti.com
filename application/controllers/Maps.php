<?php
defined('BASEPATH') or exit('No direct script access allowed');

// use GuzzleHttp\Client;

class Maps extends CI_Controller
{
    var $template = 'template/index';
    private $api_key;

    public function __construct()
    {
        parent::__construct();
        // $this->load->config('api');
        // $this->api_key = $this->config->item('api_key');
        $this->load->helper('map_helper');
    }

    public function index()
    {
        $map_data = map_data();

        if (isset($map_data['error_message'])) {
            $data['error_message'] = $map_data['error_message'];
            $data['map_prov'] = [];
        } else {
            $data['map_prov'] = $map_data;
        }
        $data['_script']        = 'map/map_js';
        $data['_view']         = 'map/map';
        $this->load->view('layout/index', $data);
    }

    public function get_map()
    {
        $id = $this->input->post('id');

        // Load the helper
        $this->load->helper('api_helper');

        // Call the helper function
        $result = fetch_svg_map($id);

        if ($result['status'] == 'success') {
            echo json_encode(['svg_map' => $result['svg_map']]);
        } else {
            $this->session->set_flashdata('error_message', $result['message']);
            echo json_encode(['error' => $result['message']]);
        }
    }

    public function allColor()
    {
        // Load the helper
        $this->load->helper('api_helper');

        // Call the helper function to fetch map color data
        $result = fetch_mapcolor_data();

        if ($result['status'] == 'success') {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'message' => '',
                    'results' => $result['data'],
                ]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'message' => $result['message'],
                    'results' => [],
                ]));
        }
    }
}
