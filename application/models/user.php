<?php 

class User extends CI_MODEL
{
  function get_all_users()
  {
    return $this->db->query("SELECT users.id, concat_ws(' ', first_name, last_name) AS name, email, DATE_FORMAT(created_at, '%b %D %Y') AS created_at, user_level  
                            FROM users
                            JOIN user_levels ON users.user_level_id = user_levels.id
                            ORDER BY id ASC")->result_array();
  }

  function user_access($email)
  {
    $query = "SELECT user_level FROM users
              JOIN user_levels ON users.user_level_id = user_levels.id
              WHERE email = ?";
    $user_level = $this->db->query($query, $email)->row_array();
    return $user_level['user_level'];
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