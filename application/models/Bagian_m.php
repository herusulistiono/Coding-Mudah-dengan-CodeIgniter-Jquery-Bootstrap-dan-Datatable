<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Bagian_m Models
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Bagian_m extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function data_bagian()
	{
		$query=$this->db->get('bagian');
		return $query->result_array();
	}
	public function insert($data)
	{
		$this->db->insert('bagian', $data);
		return TRUE;
	}
	public function get_id($id_bag)
	{
		$this->db->select('*');
		$this->db->from('bagian');
		$this->db->where('id_bag',$id_bag);
		$q=$this->db->get();
		return $q->row();
	}
	public function update($data)
	{
		$this->db->where(array('id_bag'=>$data['id_bag']));
		$this->db->update('bagian', $data);
		return TRUE;
	}
}

/* End of file Bagian_m.php */
/* Location: ./application/models/Bagian_m.php */