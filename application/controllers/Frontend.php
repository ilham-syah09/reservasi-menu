<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{

    public function index()
    {
        $data = [
            'title'     => 'Citra Bakery',

        ];

        $this->load->view('frontend/index', $data);
    }
}

/* End of file Frontend.php */
