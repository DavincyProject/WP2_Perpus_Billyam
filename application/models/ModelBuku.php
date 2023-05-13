<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelBuku extends CI_Model
{

    //manajemen buku
    public function tampil($where = null)
    {
        return $this->db->get_where('buku', $where);
    }

    public function getBuku()
    {
        return $this->db->get('buku');
    }

    public function bukuWhere($where)
    {
        return $this->db->get_where('buku', $where);
    }

    public function simpanBuku($data = null)
    {
        $this->db->insert('buku', $data);
    }

    public function updateBuku($data = null, $where = null)
    {
        $this->db->update('buku', $data, $where);
    }

    public function hapusBuku($where = null)
    {
        $this->db->delete('buku', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('buku');
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    // Add a new kategori
    public function tambahKategori()
    {
        $data = [
            'kategori' => $this->input->post('kategori', true)
        ];
        $this->db->insert('kategori', $data);
    }

    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($id = null)
    {
        $this->db->where('id', $id);
        $this->db->delete('kategori');
    }

    // Update a kategori
    public function updateKategori($id)
    {
        $data = [
            'kategori' => $this->input->post('kategori', true)
        ];
        $this->db->where('id', $id);
        $this->db->update('kategori', $data);
    }

    // Get a kategori by id
    public function getKategoriById($id)
    {
        return $this->db->get_where('kategori', ['id' => $id])->row_array();
    }

    public function ubahKategori($id)
    {
        $data['judul'] = 'Ubah Kategori';
        $data['kategori'] = $this->ModelBuku->getKategoriById($id);

        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim', [
            'required' => 'Nama kategori harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/aute_header', $data);
            $this->load->view('buku/ubah_kategori', $data);
            $this->load->view('templates/aute_footer');
        } else {
            $kategori = $this->input->post('kategori');
            $this->ModelBuku->ubahKategori($id, $kategori);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil diubah!</div>');
            redirect('buku/kategori');
        }
    }


    //join
    public function joinKategoriBuku($where)
    {
        $this->db->select('buku.id_kategori,kategori.kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id = buku.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
}
