<?php 

class Message extends CI_MODEL
{
  public function __construct()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
  }

  public function get_messages_comments($id)
  {
    $query = "SELECT messages.id AS message_id, messages.user_id as user1_id, messages.text AS message_text, concat_ws(' ', user1.first_name, user1.last_name) AS user1_name, TIMESTAMPDIFF(SECOND,messages.created_at, NOW()) AS time_1, comments.id, comments.user_id as user2_id, comments.text AS comment_text, concat_ws(' ', user2.first_name, user2.last_name) as user2_name, TIMESTAMPDIFF(SECOND,comments.created_at, NOW()) AS time_2
              FROM messages
              LEFT JOIN users AS user1 ON user1.id = messages.user_id
              LEFT JOIN comments ON messages.id = comments.message_id
              LEFT JOIN users AS user2 ON comments.user_id = user2.id
              WHERE recipient_id = ?
              ORDER BY messages.id DESC";
    $messages_comments = $this->db->query($query, $id)->result_array();
    return $messages_comments;
    // var_dump($message_comments);
    // die();
    // $message_query = "SELECT recipient_id, messages.id, user_id, text, concat_ws(' ', first_name, last_name) AS name, TIMESTAMPDIFF(SECOND,messages.created_at, NOW()) AS time
    //           FROM messages
    //           LEFT JOIN users ON users.id = messages.user_id
    //           WHERE recipient_id = ?
    //           ORDER BY messages.id DESC";
    // $messages = $this->db->query($message_query, $id)->result_array();
    // $messages_comments = array();
    // foreach($messages as $message)
    // {
    //   $messages_comments[$message['id']] = $message;
    //   $query = "SELECT user_id, concat_ws(' ', first_name, last_name) AS name, text, TIMESTAMPDIFF(SECOND,messages.created_at, NOW()) AS time
    //             FROM messages
    //             JOIN users ON user_id = users.id
    //             WHERE parent_id = ?";
    //   $comments = $this->db->query($query, $message['id'])->result_array();
    //   if(!empty($comments))
    //   {
    //     $messages_comments[$message['id']]['comments'] = $comments;
    //   }
    // }
    // echo "messages and comments";
    // var_dump($messages_comments);
    // die();
    // return $messages_comments;
  }
  public function add_message($post)
  {
    $this->form_validation->set_rules('message', 'Message', 'required');
    if($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('errors', validation_errors());
      return false;
    }
    else
    {
      $query = ("INSERT INTO messages(text, user_id, recipient_id, created_at, updated_at) VALUES (?,?,?,NOW(),NOW())");
      $values = array($post['message'], $post['current_user_id'], $post['recipient_id']);
      return $this->db->query($query, $values);
    }
  }
  public function add_comment($post)
  {
    $this->form_validation->set_rules('comment', 'Comment', 'required');
    if($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('errors', validation_errors());
      return false;
    }
    else
    {
      // echo "hi";
      $query = "INSERT INTO comments (text, user_id, message_id, created_at, updated_at) VALUES (?,?,?,NOW(),NOW())";
      $values = array($post['comment'], $post['current_user_id'],  $post['message_id']);
      return $this->db->query($query, $values);
    }
  }
}


?>