<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->output->enable_profiler();
  }

  public function home()
  {
    $this->load->view('main/home');
  }

  public function sign_in()
  {
    $this->load->view('main/sign_in');
  }

  public function register()
  {
    $this->load->view('main/register');
  }

  public function remove($id)
  {
    $this->load->model('User');
    $this->User->delete_user($id);
    redirect('/dashboard/admin');
  }
}

//end of users controller