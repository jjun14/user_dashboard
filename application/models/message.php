<?php 

class Message extends CI_MODEL
{
  function get_messages($id)
  {
    $query = "SELECT text, concat_ws(' ', first_name, last_name) AS name, TIMESTAMPDIFF(SECOND,messages.created_at, NOW()) AS time
              FROM messages
              LEFT JOIN users ON users.id = messages.user_id
              WHERE recipient_id = ?
              ORDER BY messages.id DESC";
    $time = date("Y-h-d h:i:s");
    $values = array($id);
    return $this->db->query($query, $values)->result_array();
  }
  function add_message($post)
  {
    $query = ("INSERT INTO messages(text, user_id, recipient_id, created_at, updated_at) VALUES (?,?,?,NOW(),NOW())");
    $values = array($post['text'], $post['current_user_id'], $post['recipient']);
    return $this->db->query($query, $values);
  }
}


?>