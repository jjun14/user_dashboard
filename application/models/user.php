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
  function get_user($id)
  {
    $query = "SELECT id, first_name, last_name, email, DATE_FORMAT(created_at, '%b %D %Y') AS created_at, description
              FROM users
              WHERE id = ?";
    return $this->db->query($query, $id)->row_array();
  }
  function user_access($id)
  {
    $query = "SELECT user_level FROM users
              JOIN user_levels ON users.user_level_id = user_levels.id
              WHERE users.id = ?";
    $user_level = $this->db->query($query, $id)->row_array();
    return $user_level['user_level'];
  }
  function delete_user($id)
  {
    $query = "DELETE FROM users WHERE users.id = ?";
    return $this->db->query($query, $id);
  }
}


?>