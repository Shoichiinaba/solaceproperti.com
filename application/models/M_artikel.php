<?php
class M_artikel extends CI_Model
{
    function m_data_tag()
    {

        $this->db->select('*');
        $this->db->from('berita');
        $this->db->group_by('tag_berita');
        $this->db->order_by('tag_berita', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function m_data_berita_tag($start, $limit, $tag_berita)
    {
        $this->db->select("*");
        $this->db->where('tag_berita', $tag_berita);
        $this->db->limit($limit, $start);
        $query = $this->db->get('berita');
        return $query;
    }

    function m_data_berita_left()
    {
        $this->db->select('*');
        $this->db->from('berita');
        // $this->db->ORDER_BY('id_berita', 'desc');
        $this->db->ORDER_BY('id_berita', 'RANDOM');
        $this->db->LIMIT(2);
        $query = $this->db->get();
        return $query->result();
    }
    function m_data_berita_right()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->ORDER_BY('id_berita', 'RANDOM');
        $query = $this->db->get();
        return $query->result();
    }
    function m_data_berita_center()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->ORDER_BY('id_berita', 'desc');
        // $this->db->ORDER_BY('id_berita', 'RANDOM');
        $this->db->LIMIT(1);
        $query = $this->db->get();
        return $query->result();
    }

    // untuk menampilkan berita menggunakan infinity scroll mencoba pull request baru
    function m_data_berita_infinity($limit, $start)
    {
        $this->db->select("*");
        // $this->db->order_by('id_berita', 'RANDOM');
        $this->db->ORDER_BY('id_berita', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('berita');
        return $query;
    }

    function m_data_berita_detail($judul_berita)
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->where('judul_berita', $judul_berita);
        // $this->db->ORDER_BY('id_berita', 'RANDOM');
        // $this->db->LIMIT(1);
        $query = $this->db->get();
        return $query->result();
    }
    function m_data_artikel_berita()
    {
        $this->db->select('*');
        $this->db->from('data_berita');
        // $this->db->join('foto_berita', 'foto_berita.data_berita_id = data_berita.id_data_berita');
        // $this->db->GROUP_BY('data_berita_id');
        $query = $this->db->get();
        return $query->result();
    }
    function m_data_foto_berita()
    {
        $this->db->select('*');
        $this->db->from('foto_berita');
        // $this->db->where('data_berita_id', $id_berita);
        // $this->db->order_by('id_data_berita', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function m_data_perum()
    {
        $this->db->select('*');
        $this->db->from('perum');
        $this->db->where('status_perum', 'Direkomendasikan');
        // $this->db->ORDER_BY('order_perum', 'asc');
        $this->db->ORDER_BY('id_perum', 'RANDOM');
        $this->db->LIMIT(2);
        $query = $this->db->get();
        return $query->result();
    }
    function m_data_tipe()
    {
        $this->db->select('*');
        $this->db->from('tipe');
        $this->db->ORDER_BY('luas_bangunan', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
}
