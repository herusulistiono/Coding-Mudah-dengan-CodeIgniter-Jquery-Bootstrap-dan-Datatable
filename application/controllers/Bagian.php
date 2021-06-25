<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Bagian Controller
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Bagian extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('bagian_m'));
	}
	public function index()
	{
		if (isset($this->session->userdata['sess_peg'])===TRUE){
			$data['title']='Bagian';
			$this->themes->display('bagian/tampil_data',$data);
		}else{
			redirect('welcome','refresh');
		}
	}
	public function data_bagian()
	{
		$bagian=$this->bagian_m->data_bagian();
		$data = array();
		$no=1;
		foreach ($bagian as $rows) {
			array_push($data, array(
				$no++,
				$rows['nama_bagian'],
				'<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="data_ubah('."'".$rows['id_bag']."'".')"><i class="glyphicon glyphicon-edit"></i></a>'
			));
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function simpan()
	{
		$validate=array(array('field'=>'txtNama','label'=>'Nama Bagian','rules'=>'required'));
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$data = array(
				'nama_bagian'=>$this->input->post('txtNama')
			);
			$status=$this->bagian_m->insert($data);
			$info['success'] = TRUE;
			$info['message'] = 'Berhasil Tersimpan';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function ubah()
	{
		$id_bag=$this->input->post('id_bag');
		$data = $this->bagian_m->get_id($id_bag);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function simpan_ubah()
	{
		$validate=array(
			array('field'=>'txtId','label'=>'ID Bagian','rules'=>'required'),
			array('field'=>'txtNama','label'=>'Nama Bagian','rules'=>'required')
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===FALSE) {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}else{
			$data = array(
				'id_bag'=>$this->input->post('txtId'),
				'nama_bagian'=>$this->input->post('txtNama')
			);
			$status=$this->bagian_m->update($data);
			$info['success'] = TRUE;
			$info['message'] = 'Berhasil Diganti';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}

}

/* End of file Bagian.php */
/* Location: ./application/controllers/Bagian.php */