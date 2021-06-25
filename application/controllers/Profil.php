<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Profil Controller
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Profil extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('pengguna_m'));
	}
	public function index($id)
	{
		if (isset($this->session->userdata['sess_peg'])===TRUE){
			$data['title']='Profil';
			$user=$this->pengguna_m->get_id($id);
			$data['username']=$user->username;

			$this->themes->display('pengguna/profil',$data);
		}else{
			redirect('welcome','refresh');
		}
	}
	public function ganti()
	{
		$validate=array(
			array('field'=>'txtId','label'=>'ID Bagian','rules'=>'required'),
			array('field'=>'txtUname','label'=>'Username','rules'=>'required'),
			array('field'=>'txtPass','label'=>'Password','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$data = array(
				'id'=>$this->input->post('txtId'),
				'username'=>$this->input->post('txtUname'),
				'password'=>sha1($this->input->post('txtPass')),
			);
			$status=$this->pengguna_m->update($data);
			$info['success'] = TRUE;
			$info['message'] = 'Berhasil Diganti';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
}

/* End of file Profil.php */
/* Location: ./application/controllers/Profil.php */