<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agent extends CI_Controller
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

        $data['_title'] = 'Agent';
        $data['_script'] = 'agent/agent_js';
        $data['_view'] = 'agent/agent';
        $this->load->view('layout/index', $data);
    }

    
}
