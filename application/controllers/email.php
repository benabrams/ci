<?php

class Email extends CI_Controller
{
	function __construct()
	{
		parent::__construct(); // was parent::Controller(); 
		
	}
	
	function index()
	{
	//	$this->load->view('newsletter'); //'newsletter'
	//}
	
	//function send()
	//{
	
		$this->load->library('email');//'form_validation'
		
		//$this->form_validation->set_rules('name','Name','trim|required');
		//$this->form_validation->set_rules('email','Email Address','trim|required|valid_email');
		
		//$this->load->library('email');
		/*if($this->form_validation->run() == FALSE)
		{
			$this->load->view('newsletter');
		}
		else
		{
			// validation has passed. Now send the email
			//$name = $this->input->post('name');
			//$email = $this->input->post('email');*/
		
		$config = array( //"Array" changed to "array" 1/15/15
		
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465, //465
			'smtp_user' => 'ben38abrams@gmail.com',
			'smtp_pass' => 'gmail@fb38'
			//'mailtype' => 'text',
     		//'charset' => 'iso-8859-1',
     		//'wordwrap' => TRUE
		);
		$this->email->initialize($config); // added on 1/16
		//$this->load->library($config); //$config, 'email' removed, coomented out 1/16
		
		//$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('ben38abrams@gmail.com','Ben Abrams'); //changed from ben@benabrams.com on 1/16
		$this->email->to('ben38abrams@gmail.com' , 'ben@benabrams.com');
		$this->email->subject('This is an email test.');
		$this->email->message('It is working.');
		//$path = $this->config->item('server_root');
		//echo $path; die();
		//$this->email->send(); // uncommented 1/16/15
	
		$path = $this->config->item('server_root');
		$file = $path.'/ci/attachments/yourinfo.txt';
		$this->email->attach($file); //$file //'C:/Documents/htdocs/ci/attachments/yourinfo.txt'
		$this->email->send();
		
		if($this->email->send())
		{
			echo 'Your email was sent';
			//$this->load->view('signup_confirmation_view');
		}
		else
		{
			show_error($this->email->print_debugger());
		}
		
	}
}