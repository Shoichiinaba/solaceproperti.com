<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom404 extends CI_Controller {

    public function index() {
        // Redirect to the new domain when a 404 error occurs
        $segment1 = $this->uri->segment(1);
		if ($this->uri->segment(2) == '') {
			$segment2 = '';
		} else {
			$segment2 = '/' . $this->uri->segment(2);
		}
		if ($this->uri->segment(3) == '') {
			$segment3 = '';
		} else {
			$segment3 = '/' . $this->uri->segment(3);
		}
		if ($this->uri->segment(4) == '') {
			$segment4 = '';
		} else {
			$segment4 = '/' . $this->uri->segment(4);
		}
		if ($this->uri->segment(5) == '') {
			$segment5 = '';
		} else {
			$segment5 = '/' . $this->uri->segment(5);
		}
		if ($this->uri->segment(6) == '') {
			$segment6 = '';
		} else {
			$segment6 = '/' . $this->uri->segment(5);
		}
		if ($this->uri->segment(7) == '') {
			$segment7 = '';
		} else {
			$segment7 = '/' . $this->uri->segment(5);
		}
		if ($this->uri->segment(8) == '') {
			$segment8 = '';
		} else {
			$segment8 = '/' . $this->uri->segment(5);
		}
		if ($this->uri->segment(9) == '') {
			$segment9 = '';
		} else {
			$segment9 = '/' . $this->uri->segment(5);
		}
		redirect('https://kanzupermaiabadi.co.id/' . $segment1 . $segment2 . $segment3 . $segment4 . $segment5 . $segment6 . $segment7 . $segment8 . $segment9, 'location', 301);
   }
}
