<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Themes {
	protected $_ci;
	function __construct(){
		$this->_ci=&get_instance();
	}
	function display($set, $data=null){
		$data['_content']=$this->_ci->load->view($set,$data,true);
		$this->_ci->load->view('template.php',$data);
	}
}

/* End of file Themes.php */
/* Location: ./application/libraries/Themes.php */