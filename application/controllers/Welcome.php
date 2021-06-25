<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Welcome Controller
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_m');
	}
	public function index()
	{
		if (isset($this->session->userdata['sess_peg'])===TRUE){
			redirect('pegawai/index','refresh');
		}else{
			$data['title']='Login';
			$this->load->view('login',$data);
		}
	}
	public function cek_data()
	{
		$validate = array(
			array('field'=>'username','label'=>'Username','rules'=>'required'),
			array('field'=>'password','label'=>'Password','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$data = array(
				'username'=>$this->input->post('username'),
				'password'=>sha1($this->input->post('password'))
			);
			$status=$this->login_m->cek($data);
			if ($status===TRUE) {
				$info['success'] = TRUE;
				$r = $this->login_m->get_login($data);
				$sess = array(
					'id' => $r[0]->id,
					'username' => $r[0]->username,
					'password' => $r[0]->password,
					'level'=>$r[0]->level
				);
				$this->session->set_userdata('sess_peg',$sess);
				$info['message'] = 'Berhasil Login';
			}else{
				$info['success']=FALSE;
				$info['errors']='Mohon isi data yang valid';
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function keluar()
	{
		$out = array('username' => '');
		$this->session->unset_userdata['sess_peg'];
		$this->session->sess_destroy($out);
		redirect('welcome');
	}
}
