<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Pengguna Controller
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Pengguna extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('pengguna_m'));
	}
	public function index()
	{
		if (isset($this->session->userdata['sess_peg'])===TRUE){
			$data['title']='Data Pengguna';
			$this->themes->display('pengguna/tampil_data',$data);
		}else{
			redirect('welcome','refresh');
		}
	}
	public function data_pengguna()
	{
		$pengguna=$this->pengguna_m->data_pengguna();
		$data = array();
		$no=1;
		foreach ($pengguna as $rows) {
			array_push($data, array(
				$no++,
				$rows['username'],
				$rows['level'],
				'<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="data_ubah('."'".$rows['id']."'".')"><i class="glyphicon glyphicon-edit"></i></a>'
			));
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function simpan()
	{
		$validate=array(
			array('field'=>'txtNama','label'=>'Username','rules'=>'required'),
			array('field'=>'txtPass','label'=>'Password','rules'=>'required'),
			array('field'=>'txtLevel','label'=>'Level','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$data = array(
				'username'=>$this->input->post('txtNama'),
				'password'=>sha1($this->input->post('txtPass')),
				'level'=>$this->input->post('txtLevel')
			);
			$status=$this->pengguna_m->insert($data);
			$info['success'] = TRUE;
			$info['message'] = 'Berhasil Tersimpan';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function ubah()
	{
		$id=$this->input->post('id');
		$data = $this->pengguna_m->get_id($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function simpan_ubah()
	{
		$validate=array(
			array('field'=>'txtId','label'=>'ID Bagian','rules'=>'required'),
			array('field'=>'txtNama','label'=>'Nama','rules'=>'required'),
			array('field'=>'txtPass','label'=>'Password','rules'=>'required'),
			array('field'=>'txtLevel','label'=>'Level','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$data = array(
				'id'=>$this->input->post('txtId'),
				'username'=>$this->input->post('txtNama'),
				'password'=>sha1($this->input->post('txtPass')),
				'level'=>$this->input->post('txtLevel')
			);
			$status=$this->pengguna_m->update($data);
			$info['success'] = TRUE;
			$info['message'] = 'Berhasil Diganti';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */