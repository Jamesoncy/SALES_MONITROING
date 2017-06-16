<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Base_model", "base");
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->view("login");
	}
	
	public function validate(){
		$username = $this->input->post("username");
		$password = md5($this->input->post("password"));
		$credentials = array(
			"user_name" => $username,
			"user_password" => $password
		);
		$result = $this->base->select_table("hs_hr_users", "payroll", $this->select_users, $credentials);
		if($result) { 
			$this->session->set_userdata("user", $result);
			redirect(base_url("dashboard"));
		}
		else redirect(base_url()); 
	}

	public function logout(){
		$this->session->unset_userdata("user", $result);
		$this->login();
	}

	
}
