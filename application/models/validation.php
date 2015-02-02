<?php 

class Validation extends CI_MODEL
{
  function validate_regis($post)
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
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
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if($this->form_validation->run() === false)
    {
      $this->session->set_flashdata('errors', validation_errors());
      return false;
    }
    else if($this->password_match($post) === false)
    {
      $this->session->set_flashdata('errors', "<p class='errors'>Email and password do not match!</p>");
      return false;
    }
    else
    {
      $this->session->set_userdata('logged', true);
      $this->session->set_userdata('email', $post['email']);
      return true;
    }
  }

  function password_match($post)
  {
    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $values = array($post['email'], md5($post['password']));
    $user = $this->db->query($query, $values)->row_array();
    if($user)
    {
      return true;
    }
    else
    {
      return false;
    }
  }





  // function add_order($info)
  // {
  //   $query = "INSERT INTO orders (billing_id, amount, created_at, updated_at) VALUES (?,?,?,?)";
  //   $values = array($info['billing_id'], $info['amount'], date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));
  //   return $this->db->query($query, $values);
  // }
  // function get_order()
  // {
  //   $query = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 1";
  //   return $this->db->query($query)->row_array();
  // }
  // function add_item($info)
  // {
  //   $query ="INSERT INTO orders_have_products (order_id, product_id, quantity) VALUES (?,?,?)";
  //   $values = array($info['order_id'], $info['product_id'], $info['quantity']);
  //   // var_dump($values);
  //   // echo "hi";
  //   // echo $values[0];
  //   // die();
  //   return $this->db->query($query, $values);
  // }
  // function order_items($info)
  // {
  //   // echo "arguemnent";
  //   // var_dump($info);
  //   if($info['shirt_count'] > 0)
  //   {
  //     $item_info = array('order_id'=>$info['order_id'], 'product_id'=>1, 'quantity'=>$info['shirt_count']);
  //     // echo "item info";
  //     // var_dump($item_info);
  //     // die();
  //     $this->add_item($item_info);
  //   }
  //   if($info['cup_count'] > 0)
  //   {
  //     $item_info = array('order_id'=>$info['order_id'], 'product_id'=>2, 'quantity'=>$info['cup_count']);
  //     // echo "item info";
  //     // var_dump($item_info);
  //     // die();
  //     $this->add_item($item_info);
  //   }
  // }
}


?>