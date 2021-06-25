<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Pegawai_m Models
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Pegawai_m extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	public function data_pegawai()
	{
		$this->db->select('p.*, b.nama_bagian');
		$this->db->from('pegawai p');
		$this->db->join('bagian b', 'p.id_bag=b.id_bag','INNER');
		$this->db->order_by('id_peg','asc');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function insert($data)
	{
		$this->db->insert('pegawai', $data);
		return TRUE;
	}
	public function detail_pegawai($id_peg)
	{
		$this->db->select('p.*, b.nama_bagian');
		$this->db->from('pegawai p');
		$this->db->join('bagian b', 'p.id_bag=b.id_bag','INNER');
		$this->db->where('id_peg',$id_peg);
		$query=$this->db->get();
		return $query->row();
	}
	public function get_id($id_peg)
	{
		$this->db->where('id_peg',$id_peg);
		$query=$this->db->get('pegawai');
		return $query->row();
	}
	public function update($data)
	{
		$this->db->where(array('id_peg'=>$data['id_peg']));
		$this->db->update('pegawai', $data);
		return TRUE;
	}
	public function delete($id_peg)
	{
		$this->db->where('id_peg',$id_peg);
		$this->db->delete('pegawai');
	}
	public function exp_pdf()
	{
		$this->db->select('p.*, b.nama_bagian');
		$this->db->from('pegawai p');
		$this->db->join('bagian b', 'p.id_bag=b.id_bag','INNER');
		$this->db->group_by('nama_bagian');
		return $this->db->get();
	}
	public function exp_excel()
	{
		$this->db->select('p.*, b.nama_bagian');
		$this->db->from('pegawai p');
		$this->db->join('bagian b', 'p.id_bag=b.id_bag','INNER');
		$this->db->order_by('id_peg','asc');
		$query=$this->db->get();
		return $query->result();
	}
}

/* End of file Pegawai_m.php */
/* Location: ./application/models/Pegawai_m.php */