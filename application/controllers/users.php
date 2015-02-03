<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->output->enable_profiler();
    $this->load->model('Validation');
    $this->load->model('User');
    $this->load->model('Message');
  }

  public function home()
  {
    // $this->session->sess_destroy();
    $this->load->view('main/home');
  }

  public function add_user()
  {
    $this->load->view('users/add_user');
  }

  public function add()
  {
    $post = $this->input->post();
    $this->Validation->admin_add_new($post);
    redirect('/users/add_user');
  }

  public function profile()
  {
    $this->load->view('/users/profile', array('user'=>$this->session->userdata));
  }

  public function edit($id)
  {
    $this->load->view('users/edit_admin', array("edit_id"=>$id));
  }

  public function admin_edit_info($id)
  {
    $post = $this->input->post();
    // var_dump($post);
    // die();
    $this->Validation->admin_edit_info($post);
    if($this->User->user_access($this->session->userdata('id')) === "admin")
    {
      redirect("/users/edit/{$id}");
    }
    else if($this->User->user_access($this->session->userdata('id')) === "normal")
    {
      redirect('/main/log_off');
    }
  }

  public function admin_edit_password($id)
  {
    $post = $this->input->post();
    $this->Validation->admin_edit_password($post);
    if($this->User->user_access($this->session->userdata('id')) === "admin")
    {
      redirect("/users/edit/{$id}");
    }
    else if($this->User->user_access($this->session->userdata('id')) === "normal")
    {
      redirect('/users/profile');
    }
  }

  public function edit_info()
  {
    $post = $this->input->post();
    // var_dump($post);
    // die();
    $this->Validation->validate_edit_info($post);
    redirect('/users/profile');
  }

  public function edit_password()
  {
    $post = $this->input->post();
    $this->Validation->validate_edit_password($post);
    redirect('/users/profile');
  }

  public function edit_description()
  {
    $post = $this->input->post();
    $this->Validation->validate_edit_description($post);
    redirect('users/profile');
  }

  public function remove($id)
  {
    $this->load->model('User');
    $this->User->delete_user($id);
    redirect('/dashboard/admin');
  }

  public function show($id)
  {
    $user = $this->User->get_user($id);
    $messages = $this->Message->get_messages_comments($id);
    // var_dump($messages);
    // die();
    $this->load->view('/users/show', array('user'=>$user, 'current_user_id'=>$this->session->userdata('id'), 'messages'=>$messages));
  }

  public function post_message()
  {
    $post = $this->input->post();
    // var_dump($post);
    // die();
    $this->Message->add_message($post);
    redirect("/users/show/{$post['recipient_id']}");
  }

  public function post_comment()
  {
    $post = $this->input->post();
    // var_dump($post);
    // die();
    $this->Message->add_comment($post);
    redirect("/users/show/{$post['this_page_id']}");
  }
}

//end of users controller