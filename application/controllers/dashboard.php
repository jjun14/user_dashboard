<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->output->enable_profiler();
    $this->load->model('User');
  }

  function index()
  {
    $user_level = $this->User->user_access($this->session->userdata('id'));
    $users = $this->User->get_all_users();
    if($user_level == "normal")
    {
      $this->load->view('/dashboard/normal', array("users"=>$users));
    }
    else if($user_level == "admin")
    {
      redirect('/dashboard/admin');
    }
  }
  function admin()
  {
    $users = $this->User->get_all_users();
    $this->load->view('/dashboard/admin', array("users"=>$users));
  }
}

//end of dashboards controller