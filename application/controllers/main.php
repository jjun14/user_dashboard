<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
    $this->load->model('Validation');
	}

	public function home()
	{
    $this->load->view('main/home');
	}

  public function registration_page()
  {
    $this->load->view('/main/register');
  }

  public function register()
  {
    // var_dump($this->input->post());
    $is_valid = $this->Validation->validate_regis($this->input->post());
    if($is_valid)
    {
      redirect('/dashboard');
    }
    else
    {
      redirect('/main/registration_page');
    }
    die();
  }

  public function signin_page()
  {
    $this->load->view('main/sign_in');
  }

  public function sign_in()
  {
    $post = $this->input->post();
    $is_valid = $this->Validation->validate_sign_in($post);
    if($is_valid === false)
    {
      redirect('/main/signin_page');
    }
    else if($is_valid === true)
    {
      redirect('/dashboard');
    }
  }

  public function log_off()
  {
    $this->session->sess_destroy();
    redirect('/main/home');
  }
}

//end of main controller