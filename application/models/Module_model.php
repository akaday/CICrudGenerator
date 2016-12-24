<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module_model extends CI_Model
{

    public $table = 'module';
    public $id = 'id_main';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by('parrent', $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    function get_parrent()
    {
        $this->db->where("parrent = 0");
        return $this->db->get($this->table)->result();
    }

    function total_get_parrent_rows()
    {   
        $this->db->where("parrent = 0");
        $this->db->from($this->table);
        return $this->db->count_all_results();
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
        $this->db->like('id_main', $keyword);
	$this->db->or_like('nama_menu', $keyword);
	$this->db->or_like('link', $keyword);
	$this->db->or_like('jabatan', $keyword);
	$this->db->or_like('parrent', $keyword);
	$this->db->or_like('urutan', $keyword);
	$this->db->or_like('icon', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_main', $keyword);
	$this->db->or_like('nama_menu', $keyword);
	$this->db->or_like('link', $keyword);
	$this->db->or_like('jabatan', $keyword);
	$this->db->or_like('parrent', $keyword);
	$this->db->or_like('urutan', $keyword);
	$this->db->or_like('icon', $keyword);
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

/* End of file Sistem_module_model.php */
/* Location: ./application/models/Sistem_module_model.php */