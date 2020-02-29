<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "Super.php";
class Mutabaah extends CI_Controller  {

    // function index(){
    //     echo base_url();
    // }
    public function index(){
		if ($this->session->userdata('sesAdmin') == true){
			redirect(base_url('AdmMutabaah_dashboard'));
		}
		else{
			$this->login();
		}
	}
	public function login(){
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		if ($this->form_validation->run() == TRUE){
			$user = $this->database->login('user',$this->input->post('username'),$this->input->post('password'));
			//var_dump($user);
			print_r($user);
			if(count($user)>=1){
				$this->session->set_userdata('sesAdmin', array('id' => $user[0]['adm_idadm'], 'username' => $user[0]['adm_username']));
				redirect(base_url('AdmMutabaah_dashboard'));
			}
		}
		$this->load->view('adm_mutabaah/login.php');		
	}
	public function logout(){
		$this->session->sess_destroy(); 
		redirect(base_url());
	}
}

?>