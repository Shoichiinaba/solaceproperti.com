<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cache_hook
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    public function cache_output()
    {
        // Memuat pustaka cache
        $this->CI->load->driver('cache');

        // Mengatur opsi cache
        $cache_key = md5($this->CI->uri->uri_string());
        $cache_time = 604800; // Waktu cache dalam detik (1 jam)

        // Memeriksa apakah halaman sudah ada di cache
        if (!$this->CI->input->is_ajax_request() && $output = $this->CI->cache->file->get($cache_key)) {
            // Menampilkan halaman dari cache
            echo $output;
            exit;
        }

        // Mengatur output buffering
        ob_start();
    }

    public function update_cache()
    {
        // Mengambil output yang telah di-buffer
        $output = ob_get_contents();

        // Membersihkan output buffering
        ob_end_flush();

        // Menyimpan halaman ke cache
        $this->CI->cache->file->save(md5($this->CI->uri->uri_string()), $output, 604800);

        // var_dump('Cache updated!');
    }
}