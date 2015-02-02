<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

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

  // public function sign_in()
  // {
  //   $this->load->view('main/sign_in');
  // }

  // public function register()
  // {
  //   $this->load->view('main/register');
  // }
  public function add_user()
  {
    $this->load->view('users/add_user');
    // echo "got here";
    // die();
  }

  public function add()
  {
    $post = $this->input->post();
    $this->Validation->validate_add_new($post);
    redirect('/users/add_user');
  }

  public function edit($id)
  {
    $this->load->view('users/edit_admin', array("edit_id"=>$id));
  }

  public function edit_in_db()
  {
    $this->load->model('Validation');
    $post = $this->input->post();
    $this->Validation->validate_edit_user($post);
    redirect('/dashboard/admin');
  }

  public function remove($id)
  {
    $this->load->model('User');
    $this->User->delete_user($id);
    redirect('/dashboard/admin');
  }
}

//end of users controller