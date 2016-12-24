<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Identitas_model extends CI_Model
{

    public $table = 'identitas';
    public $id = 'id_identitas';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id_identitas', $keyword);
	$this->db->or_like('nama_website', $keyword);
	$this->db->or_like('meta_deskripsi', $keyword);
	$this->db->or_like('meta_keyword', $keyword);
	$this->db->or_like('favicon', $keyword);
	$this->db->or_like('email', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_identitas', $keyword);
	$this->db->or_like('nama_website', $keyword);
	$this->db->or_like('meta_deskripsi', $keyword);
	$this->db->or_like('meta_keyword', $keyword);
	$this->db->or_like('favicon', $keyword);
	$this->db->or_like('email', $keyword);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Identitas_model.php */
/* Location: ./application/models/Identitas_model.php */