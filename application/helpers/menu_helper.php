<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function gambar($idMenu)
{
	$CI = &get_instance();

	$CI->db->where('idMenu', $idMenu);

	$CI->db->order_by('gambar', 'RANDOM');
	$data = $CI->db->get('gambar')->row();

	return $data->gambar;
}
