<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Name:  Pegawai Controller
*
* Author:  Heru Sulistiono
* 		   mildlaser3@gmail.com
*
* Location: https://herusulistiono.net/
* Created:  12.09.2017
* Requirements: PHP5
*
*/
class Pegawai extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('pegawai_m','bagian_m'));
	}
	public function index()
	{
		if (isset($this->session->userdata['sess_peg'])===TRUE){
			$data['title']='Data Pegawai';
			$this->themes->display('pegawai/tampil_data',$data);
		}else{
			redirect('welcome','refresh');
		}
	}
	public function data_pegawai()
	{
		$pegawai=$this->pegawai_m->data_pegawai();
		$data=array();
		$no=1;
		foreach ($pegawai as $rows) {
			array_push($data,
				array(
					$no++,
					anchor('pegawai/detail/'.$rows['id_peg'], $rows['nip']),
					$rows['nm_lengkap'],
					$rows['jabatan'],
					$rows['nama_bagian'],
					$rows['kelamin'],
					$rows['telp'],
					$rows['status'],
					anchor('pegawai/ubah/'.$rows['id_peg'],'<i class="glyphicon glyphicon-edit"></i>', array('class'=>'btn btn-info btn-sm')).'
					<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="hapus('."'".$rows['id_peg']."'".')"><i class="glyphicon glyphicon-trash"></i></a>'
				)
			);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$data)));
	}
	public function detail($id_peg)
	{
		if (isset($this->session->userdata['sess_peg'])===TRUE){
			$data['title']='Detail Pegawai';
			$pegawai=$this->pegawai_m->detail_pegawai($id_peg);
			$data['bagian']=$this->bagian_m->data_bagian();
			$data['id_peg']=$pegawai->id_peg;
			$data['nip']=$pegawai->nip;
			$data['nm_lengkap']=$pegawai->nm_lengkap;
			$data['jabatan']=$pegawai->jabatan;
			$data['nama_bagian']=$pegawai->nama_bagian;
			$data['ktp']=$pegawai->ktp;
			$data['kelamin']=$pegawai->kelamin;
			$data['agama']=$pegawai->agama;
			$data['lahir']=$pegawai->lahir;
			$data['tgl_lahir']=$pegawai->tgl_lahir;
			$data['telp']=$pegawai->telp;
			$data['alamat']=$pegawai->alamat;
			$data['foto']=$pegawai->foto;
			$data['status']=$pegawai->status;
			$this->themes->display('pegawai/detail_data',$data);
		}else{
			redirect('welcome','refresh');
		}
	}
	public function tambah()
	{
		if (isset($this->session->userdata['sess_peg'])===TRUE){
			$data['title']='Tambah Data Pegawai';
			$data['bagian']=$this->bagian_m->data_bagian();
			$this->themes->display('pegawai/tambah_data',$data);
		}else{
			redirect('welcome','refresh');
		}
	}
	public function simpan()
	{
		$validate = array(
			array('field'=>'txtNip','label'=>'NIP','rules'=>'required|numeric'),
			array('field'=>'txtNama','label'=>'Nama Pegawai','rules'=>'required'),
			array('field'=>'txtJabatan','label'=>'Jabatan','rules'=>'required'),
			array('field'=>'txtKtp','label'=>'KTP','rules'=>'required|numeric'),
			array('field'=>'txtKelamin','label'=>'Kelamin','rules'=>'required'),
			array('field'=>'txtAgama','label'=>'Agama','rules'=>'required'),
		);
		$this->form_validation->set_rules($validate);
		if ($this->form_validation->run()===TRUE) {
			$path_dir='./foto';
			if (!is_dir($path_dir)) {
				mkdir($path_dir, 0775);
				chmod($path_dir, 0777);
			}
			$config = array(
	            'upload_path' => $path_dir,
	            'allowed_types' => 'jpg',
	            'file_name' => $this->input->post('txtNip'),
	            'overwrite'=> TRUE
	        );
      		$this->load->library('upload', $config);
      		if (!$this->upload->do_upload('txtFoto')) {
				$info['success'] = FALSE;
				$info['errors'] = $this->upload->display_errors();
			}else{
				$file = $this->upload->data();
				$data =array(
					'nip'=>$this->input->post('txtNip'),
					'nm_lengkap'=>$this->input->post('txtNama'),
					'jabatan'=>$this->input->post('txtJabatan'),
					'id_bag'=>$this->input->post('txtIdBag'),
					'ktp'=>$this->input->post('txtKtp'),
					'lahir'=>$this->input->post('txtLahir'),
					'tgl_lahir'=>date('Y-m-d',strtotime($this->input->post('txtTgl_lahir'))),
					'kelamin' =>$this->input->post('txtKelamin'),
					'telp'=>$this->input->post('txtTelp'),
					'agama'=>$this->input->post('txtAgama'),
					'alamat'=>$this->input->post('txtAlamat'),
					'foto'=>$file['file_name']
				);
				$this->pegawai_m->insert($data);
				$info['success']=TRUE;
				$info['message']='Berhasil Tersimpan';
			}
		}else{
			$info['success']= FALSE;
			$info['errors'] = validation_errors();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function ubah($id_peg)
	{
		if (isset($this->session->userdata['sess_peg'])===TRUE){
			$data['title']='Ubah Data Pegawai';
			$pegawai=$this->pegawai_m->get_id($id_peg);
			$data['bagian']=$this->bagian_m->data_bagian();
			$data['id_peg']=$pegawai->id_peg;
			$data['nip']=$pegawai->nip;
			$data['nm_lengkap']=$pegawai->nm_lengkap;
			$data['jabatan']=$pegawai->jabatan;
			$data['id_bag']=$pegawai->id_bag;
			$data['ktp']=$pegawai->ktp;
			$data['kelamin']=$pegawai->kelamin;
			$data['agama']=$pegawai->agama;
			$data['lahir']=$pegawai->lahir;
			$data['tgl_lahir']=$pegawai->tgl_lahir;
			$data['telp']=$pegawai->telp;
			$data['alamat']=$pegawai->alamat;
			$data['status']=$pegawai->status;
			$this->themes->display('pegawai/ubah_data',$data);
		}else{
			redirect('welcome','refresh');
		}
	}
	public function simpan_ubah()
	{
		$validate = array(
			array('field'=>'txtNip','label'=>'NIP','rules'=>'required|numeric'),
			array('field'=>'txtNama','label'=>'Nama Pegawai','rules'=>'required'),
			array('field'=>'txtJabatan','label'=>'Jabatan','rules'=>'required'),
			array('field'=>'txtKtp','label'=>'KTP','rules'=>'required|numeric'),
			array('field'=>'txtKelamin','label'=>'Kelamin','rules'=>'required'),
			array('field'=>'txtAgama','label'=>'Agama','rules'=>'required'),
		);
		$this->form_validation->set_rules($validate);

		if ($this->form_validation->run()===TRUE) {
			$path_dir='./foto';
			if (!is_dir($path_dir)) {
				mkdir($path_dir, 0775);
				chmod($path_dir, 0777);
			}
			$config = array(
	            'upload_path' => $path_dir,
	            'allowed_types' => 'jpg',
	            'file_name' => $this->input->post('txtNip'),
	            'overwrite'=> TRUE
	        );
      		$this->load->library('upload', $config);
      		if ($this->upload->do_upload('txtFoto')) {
				$file = $this->upload->data();
				$data =array(
					'id_peg'=>$this->input->post('txtIdpeg'),
					'nip'=>$this->input->post('txtNip'),
					'nm_lengkap'=>$this->input->post('txtNama'),
					'jabatan'=>$this->input->post('txtJabatan'),
					'id_bag'=>$this->input->post('txtIdBag'),
					'ktp'=>$this->input->post('txtKtp'),
					'lahir'=>$this->input->post('txtLahir'),
					'tgl_lahir'=>date('Y-m-d',strtotime($this->input->post('txtTgl_lahir'))),
					'kelamin' =>$this->input->post('txtKelamin'),
					'telp'=>$this->input->post('txtTelp'),
					'agama'=>$this->input->post('txtAgama'),
					'alamat'=>$this->input->post('txtAlamat'),
					'foto'=>$file['file_name'],
					'status'=>$this->input->post('txtStatus')
				);
				$this->pegawai_m->update($data);
				$info['success']=TRUE;
				$info['message']='Berhasil Diubah';
			}else{
				$data =array(
					'id_peg'=>$this->input->post('txtIdpeg'),
					'nip'=>$this->input->post('txtNip'),
					'nm_lengkap'=>$this->input->post('txtNama'),
					'jabatan'=>$this->input->post('txtJabatan'),
					'id_bag'=>$this->input->post('txtIdBag'),
					'ktp'=>$this->input->post('txtKtp'),
					'lahir'=>$this->input->post('txtLahir'),
					'tgl_lahir'=>date('Y-m-d',strtotime($this->input->post('txtTgl_lahir'))),
					'kelamin' =>$this->input->post('txtKelamin'),
					'telp'=>$this->input->post('txtTelp'),
					'agama'=>$this->input->post('txtAgama'),
					'alamat'=>$this->input->post('txtAlamat'),
					'status'=>$this->input->post('txtStatus')
				);
				$this->pegawai_m->update($data);
				$info['success']=TRUE;
				$info['message']='Berhasil Diubah';
			}
		}else{
			$info['success']= FALSE;
			$info['errors'] = validation_errors();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function hapus()
	{
		$this->form_validation->set_rules('id_peg', 'ID', 'required');
		if ($this->form_validation->run()===TRUE) {
			$info['success']=TRUE;
			$id_peg=$this->input->post('id_peg');
			$this->pegawai_m->delete($id_peg);
			$info['message']='Berhasil Terhapus';
		}else{
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
	public function pdf()
	{
		$this->data['pegawai']  = $this->pegawai_m->exp_pdf()->result();
		$this->data['title'] = 'Data Pegawai';
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->set_option('isRemoteEnabled', true);

		$this->pdf->filename = "Pegawai.pdf";
		$this->pdf->load_view('pegawai/lap_pegawai', $this->data);
	}
	public function excel()
	{
		$this->load->library('PHPExcel');
		require_once './application/libraries/PHPExcel/IOFactory.php';

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		$default_border = array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000'),
		);

		$acc_default_border = array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => 'c7c7c7'),
		);
		$outlet_style_header = array(
			'font' => array(
				'color' => array('rgb' => '000000'),
				'size' => 10,
				'name' => 'Arial',
				'bold' => true,
			),
		);
		$top_header_style = array(
			'borders' => array(
				'bottom' => $default_border,
				'left' => $default_border,
				'top' => $default_border,
				'right' => $default_border,
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'abcdef'),
			),
			'font' => array(
				'color' => array('rgb' => '000000'),
				'size' => 15,
				'name' => 'Arial',
				'bold' => true,
			),
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
		);
		$style_header = array(
			'borders' => array(
				'bottom' => $default_border,
				'left' => $default_border,
				'top' => $default_border,
				'right' => $default_border,
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'abcdef'),
			),
			'font' => array(
				'color' => array('rgb' => '000000'),
				'size' => 12,
				'name' => 'Arial',
				'bold' => true,
			),
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
		);
		$account_value_style_header = array(
			'borders' => array(
				'bottom' => $default_border,
				'left' => $default_border,
				'top' => $default_border,
				'right' => $default_border,
			),
			'font' => array(
				'color' => array('rgb' => '000000'),
				'size' => 12,
				'name' => 'Arial',
			),
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
		);
		$text_align_style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'borders' => array(
				'bottom' => $default_border,
				'left' => $default_border,
				'top' => $default_border,
				'right' => $default_border,
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'abcdef'),
			),
			'font' => array(
				'color' => array('rgb' => '000000'),
				'size' => 12,
				'name' => 'Arial',
				'bold' => true,
			),
		);

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:L1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Data Anggota');

		$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($top_header_style);
		$objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($top_header_style);


		$objPHPExcel->getActiveSheet()->setCellValue('A2', 'NIP');
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Nama Pegawai');
		$objPHPExcel->getActiveSheet()->setCellValue('C2', 'Jabatan');
		$objPHPExcel->getActiveSheet()->setCellValue('D2', 'Bagian');
		$objPHPExcel->getActiveSheet()->setCellValue('E2', 'KTP');
		$objPHPExcel->getActiveSheet()->setCellValue('F2', 'Lahir');
		$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Tgl Lahir');
		$objPHPExcel->getActiveSheet()->setCellValue('H2', 'Kelamin');
		$objPHPExcel->getActiveSheet()->setCellValue('I2', 'Telp');
		$objPHPExcel->getActiveSheet()->setCellValue('J2', 'Agama');
		$objPHPExcel->getActiveSheet()->setCellValue('K2', 'Alamat');
		$objPHPExcel->getActiveSheet()->setCellValue('L2', 'Status');


		$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('H2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('I2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('J2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('K2')->applyFromArray($style_header);
		$objPHPExcel->getActiveSheet()->getStyle('L2')->applyFromArray($style_header);


		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

		$row = 3;
		//$angkatan=$this->input->post('angkatan');
		$DataPegawai  = $this->pegawai_m->exp_excel();
		foreach ($DataPegawai as $cols)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$cols->nip);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$cols->nm_lengkap);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$cols->jabatan);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$cols->nama_bagian);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$cols->ktp);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$cols->lahir);
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row,date('Y-m-d',strtotime($cols->tgl_lahir)));
			$objPHPExcel->getActiveSheet()->setCellValue('H'.$row,$cols->kelamin);
			$objPHPExcel->getActiveSheet()->setCellValue('I'.$row,$cols->telp);
			$objPHPExcel->getActiveSheet()->setCellValue('J'.$row,$cols->agama);
			$objPHPExcel->getActiveSheet()->setCellValue('K'.$row,$cols->alamat);
			$objPHPExcel->getActiveSheet()->setCellValue('L'.$row,$cols->status);
			$row++;
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data_Pegawai.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */