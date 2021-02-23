<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main1 extends CI_Controller {

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

	public function trexam()
	{
		$this->load->view('trexam');

	}
	
	
//work from Arun Sir

	
	public function reg()
	{
		$this->load->view('reg');
	}

	public function regi()
	{
		//$this->load->helper(array('form', 'url'));
		$this->load->library("form_validation");
		$this->form_validation->set_rules("fname","name",array('required', 'max_length[25]'));
		$this->form_validation->set_rules("lname","last name",'required');
		$this->form_validation->set_rules("phno","phone number",'required');
		$this->form_validation->set_rules("email","email",'required');
		$this->form_validation->set_rules("uname","user name",'required');
		$this->form_validation->set_rules("password","password",'required');
		if($this->form_validation->run() == TRUE)
		{
			$this->load->model('mainmodel1');	
		$pass=$this->input->post("password");
		$encpass=$this->mainmodel1->encpswd($pass);
		$a=array("fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"phno"=>$this->input->post("phno"),
				"email"=>$this->input->post("email"),
				"uname"=>$this->input->post("uname"),
				"password"=>$encpass,'status'=>'0','utype'=>'0');
		// $b=array("uname"=>$this->input->post("uname"),
		// 		"password"=>$encpass,'status'=>'0','utype'=>'0');
		$this->mainmodel1->regi($a);
		redirect(base_url().'main1/reg');
		}
		// else
		// {
		// 	$this->load->view('myform');

		// }

		
	}
	public function myform()
	{
		$this->load->view('myform');
	}

	public function viewregap()
	{
		$this->load->model('mainmodel1');
		$data['n']=$this->mainmodel1->viewt();
		$this->load->view('viewregap',$data);

	}
	public function approve()
	{

		$this->load->model('mainmodel1');
		$id=$this->uri->segment(3);
		$this->mainmodel1->approve($id);
		redirect('main1/viewregap','refresh');
		
	}
	public function reject()
	{

		$this->load->model('mainmodel1');
		$id=$this->uri->segment(3);
		$this->mainmodel1->reject($id);
		redirect('main1/viewregap','refresh');
		
	}
	public function log()
	{
		$this->load->view('log');

	}

	public function logi()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("uname","uname",'required');
		$this->form_validation->set_rules("password","password",'required');
		if($this->form_validation->run())
		{
		
			$this->load->model('mainmodel1');	
			$uname=$this->input->post("uname");
			$password=$this->input->post("password");
			$a=$this->mainmodel1->logi($uname,$password);
			if($a)
			{
			$id=$this->mainmodel1->getuserid($uname);
			$user=$this->mainmodel1->getuser($id);
			$this->load->library(array('session'));
			$this->session->set_userdata(array('id'=>(int)$user->id,
				'status'=>$user->status,'utype'=>$user->utype));
			if($_SESSION['status']=='1' && $_SESSION['utype']=='0')
			{
				redirect(base_url().'main1/trexam');
			}
			
			else
			{
				echo "waiting for approval";
			}
		}
		else
		{
			echo "invalid user";
		}
	}
	else
	{
		redirect(base_url().'main/logi');	
	}
}




}