<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->output->enable_profiler();
  }

  public function home()
  {
    $this->load->view('home');
  }

  public function sign_in()
  {
    $this->load->view('sign_in');
  }

  public function register()
  {
    $this->load->view('register');
  }
}

//end of users controller