<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activation extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('api_helper');
    }

    function index()
    {
        $data['_script'] = 'aktivasi/index_js';
        $this->load->view('aktivasi/index', $data);
    }
}