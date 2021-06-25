<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Pengguna_m Models
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Pengguna_m extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function data_pengguna()
	{
		$query=$this->db->get('users');
		return $query->result_array();
	}
	public function insert($data)
	{
		$this->db->insert('users', $data);
		return TRUE;
	}
	public function get_id($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$q=$this->db->get();
		return $q->row();
	}
	public function update($data)
	{
		$this->db->where(array('id'=>$data['id']));
		$this->db->update('users', $data);
		return TRUE;
	}
}

/* End of file Pengguna_m.php */
/* Location: ./application/models/Pengguna_m.php */