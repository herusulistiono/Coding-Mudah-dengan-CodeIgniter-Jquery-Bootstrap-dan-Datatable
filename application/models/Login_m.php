<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Login_m Models
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Login_m extends CI_Model {	
	public function __construct()
	{
		parent::__construct();
	}
	public function cek($data)
	{
		$this->db->select('id,username,password');
		$this->db->from('users');
		$this->db->where(
			array(
				'username'=>$data['username'],
				'password'=>$data['password']
				)
			);
		$this->db->limit(1);
		$query=$this->db->get();
		if ($query->num_rows()===1) {
			return true;
		}else{
			return false;
		}
	}
	public function get_login($data)
	{
		$this->db->select('id,username,password,level');
		$this->db->from('users');
		$this->db->where(array('username'=>$data['username']));
		$this->db->limit(1);
		$query=$this->db->get();
		if ($query->num_rows()===1) {
			return $query->result();
		}else{
			return false;
		}
	}
}

/* End of file Login_m.php */
/* Location: ./application/models/Login_m.php */