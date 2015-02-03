<?php 

class Validation extends CI_MODEL
{
  function __construct()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
  }
  function validate_regis($post)
  {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|min_length[2]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|min_length[2]');
    $this->form_validation->set_rules('password', "Password", 'required|alpha_numeric|min_length[6]|match[confirm_password]');
    $this->form_validation->set_rules('confirm_password', "Confirm Password", 'required');
    if($this->form_validation->run() === FALSE)
    {
      $this->session->set_userdata('errors', validation_errors());
      return false;
    }
    else
    {
      if($this->users_exist())
      {
        $query = "INSERT INTO users (email, first_name, last_name, password, description, user_level_id, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?)";
        $values = array($post['email'], $post['first_name'], $post['last_name'], md5($post['password']), NULL, 2, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
        $this->db->query($query, $values);
      }
      else
      {
        $query = "INSERT INTO users (email, first_name, last_name, password, description, user_level_id, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?)";
        $values = array($post['email'], $post['first_name'], $post['last_name'], md5($post['password']), NULL, 1, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
        $this->db->query($query, $values);
      }
      $this->session->set_userdata('id', $this->db->insert_id());
      $this->session->set_userdata('logged', true);
      $this->session->set_userdata('email', $post['email']);
      return true;
    }
  }

  function users_exist()
  {
    $query = "SELECT * FROM users";
    $users = $this->db->query($query)->result_array();
    if($users)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  function validate_sign_in($post)
  {
    // var_dump($post);
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if($this->form_validation->run() == false)
    {
      $this->session->set_flashdata('errors', validation_errors());
      return false;
    }
    else if($this->password_match($post) == false)
    {
      $this->session->set_flashdata('errors', "<p class='errors'>Email and password do not match!</p>");
      return false;
    }
    else if($this->password_match($post) == true)
    {
      return $this->password_match($post);
    }
  }

  function password_match($post)
  {
    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $values = array($post['email'], md5($post['password']));
    $user = $this->db->query($query, $values)->row_array();
    if($user)
    {
      return $user;
    }
    else
    {
      return false;
    }
  }
  ///----------------------Admin Functionality-------------------------///
  function admin_add_new($post)
  {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|min_length[2]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|min_length[2]');
    $this->form_validation->set_rules('password', "Password", 'required|alpha_numeric|min_length[6]|match[confirm_password]');
    $this->form_validation->set_rules('confirm_password', "Confirm Password", 'required');
    if($this->form_validation->run() === FALSE)
    {
      $this->session->set_flashdata('errors', validation_errors());
    }
    else
    {
      $query = "INSERT INTO users (email, first_name, last_name, password, description, user_level_id, created_at, updated_at) VALUES(?,?,?,?,?,?,?,?)";
      $values = array($post['email'], $post['first_name'], $post['last_name'], md5($post['password']), NULL, 2, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
      $this->db->query($query, $values);
      $this->session->set_flashdata('success', "<p class='success'>Successfully added user</p>");
      return true;
    }
  }
  function admin_edit_info($post)
  {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|min_length[2]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|min_length[2]');
    if($this->form_validation->run() === FALSE)
    {
      $this->session->set_flashdata('errors', validation_errors());
      redirect("/users/edit/{$post['edit_id']}",  array("edit_id"=> $post['edit_id']));
    }
    else
    {
      $query = "UPDATE users
                SET email = ?, first_name = ?, last_name = ?, user_level_id = ?, updated_at = NOW()
                WHERE id = ?";
      if($post['user_level'] == "Normal")
      {
        $values = array($post['email'], $post['first_name'], $post['last_name'], 2, $post['edit_id']);
      }
      else if($post['user_level'] == "Admin")
      {
        $values = array($post['email'], $post['first_name'], $post['last_name'], 1, $post['edit_id']);
      }
      $this->db->query($query, $values);
      $this->session->set_flashdata('success', "<p class='success'>Successfully updated user info</p>");
    }
  }
  function admin_edit_password($post)
  {
    $this->form_validation->set_rules('password', "Password", 'required|alpha_numeric|min_length[6]|match[confirm_password]');
    $this->form_validation->set_rules('confirm_password', "Confirm Password", 'required');
    if($this->form_validation->run() === FALSE)
    {
      $this->session->set_flashdata('errors', validation_errors());
      redirect("/users/edit/{$post['edit_id']}",  array("edit_id"=> $post['edit_id']));
    }
    else
    {
      $query = "UPDATE users
          SET password = ?, updated_at = NOW()
          WHERE id = ?";
      $values = array(md5($post['password']), $post['edit_id']);
      $this->db->query($query, $values);
      $this->session->set_flashdata('success', "<p class='success'>Successfully updated password</p>");
    }
  }
  function validate_edit_info($post)
  {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha|min_length[2]');
    $this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha|min_length[2]');
    if($this->form_validation->run() === FALSE)
    {
      $this->session->set_flashdata('errors', validation_errors());
      return false;
    }
    else
    {
      $query = "UPDATE users
                SET email = ?, first_name = ?, last_name = ?, updated_at = NOW()
                WHERE id = ?";
      $values = array($post['email'], $post['first_name'], $post['last_name'], $post['edit_id']);
      $this->db->query($query, $values);
      $this->session->set_flashdata('success', "<p class='success'>Successfully updated user info</p>");
    }
  }
  function validate_edit_password($post)
  {
    $this->form_validation->set_rules('password', "Password", 'required|alpha_numeric|min_length[6]|match[confirm_password]');
    $this->form_validation->set_rules('confirm_password', "Confirm Password", 'required');
    if($this->form_validation->run() === FALSE)
    {
      $this->session->set_flashdata('errors', validation_errors());
      return false;
    }
    else
    {
      $query = "UPDATE users
          SET password = ?, updated_at = NOW()
          WHERE id = ?";
      $values = array(md5($post['password']), $post['edit_id']);
      $this->db->query($query, $values);
      $this->session->set_flashdata('success', "<p class='success'>Successfully updated password</p>");
    }
  }
  function validate_edit_description($post)
  {
    $this->form_validation->set_rules('description', "Description", 'required');
    if($this->form_validation->run() === FALSE)
    {
      $this->session->set_flashdata('errors', validation_errors());
      redirect("/users/edit/{$post['edit_id']}",  array("edit_id"=> $post['edit_id']));
    }
    else
    {
      $query = "UPDATE users
          SET description = ?, updated_at = NOW()
          WHERE id = ?";
      $values = array($post['description'], $post['edit_id']);
      $this->db->query($query, $values);
      $this->session->set_flashdata('success', "<p class='success'>Successfully updated description</p>");
    }
  }
}
?>