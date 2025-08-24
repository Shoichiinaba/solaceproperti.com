<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CAri_agent extends CI_Controller
{
    public $load;
    public $m_marketing;
    public $input;
    public $upload;
    public $image_lib;
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_marketing');
    }

    function index()
    {

        $data['_title'] = 'Cari Agent';
        $data['_script'] = 'cari_agent/cari_agent_js';
        $data['_view'] = 'cari_agent/cari_agent';
        $this->load->view('layout/index', $data);
    }
}
