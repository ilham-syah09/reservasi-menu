<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Login extends CI_Model
{
    function cek($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        $data = $query->row();

        if ($data) {
            if (password_verify($password, $data->password)) {
                if ($data->role == 1) {
                    $role = 'admin';
                } else if ($data->role == 2) {
                    $role = 'user';
                }
                $login        =    array(
                    'is_logged_in'    => true,
                    'email'           => $email,
                    'id'              => $data->id,
                    'is_active'       => $data->is_active,
                    'role'            => $role
                );
                if ($login['is_active'] == 1) {
                    $this->session->set_userdata('log_' . $role, $login);
                    $this->session->set_userdata($login);
                    return $role;
                } else {
                    return 'Akun belum di aktivasi!';
                }
            } else {
                return 'Email atau Password Salah!!';
            }
        } else {
            return 'Email atau Password Salah!!';
        }
    }
}

/* End of file M_Login.php */