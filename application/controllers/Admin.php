<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
    function cek_login()
    {
        $ci = get_instance();
        if (!$ci->session->userdata('email')) {
            $ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!! </div>');
            redirect('autentifikasi');
        } else {
            $role_id = $ci->session->userdata('role_id');
        }
    }
    public function index()
    {
        $data['judul'] = 'Dashboard';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getUserLimit()->result_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
}
