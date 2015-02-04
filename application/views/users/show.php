<?php 

function time_display($str)
{
  $sec = intval($str);
  if($sec < 60)
  {
    return $sec . " seconds ago";
  }
  else if($sec < 3600)
  {
    $time = round($sec / 60);
    return $time . " minutes";
  }
  else if($sec < 86400)
  {
    $time = round($sec / 3600);
    return $time . " hours ago";
  }
  else 
  {
    $time = round($sec / 86400);
    return $time_display . " days ago";
  }
}

// function get_comments($mess_id)
// {
//   $query = "SELECT text, concat_ws(' ', first_name, last_name) AS name, TIMESTAMPDIFF(SECOND,comments.created_at, NOW()) AS time
//             FROM comments
//             LEFT JOIN users ON users.id = comments.user_id
//             WHERE message.id = ?
//             ORDER BY comments.id DESC";
//   return $this->db->query($query, $mess_id)->result_array();
// }

?>

<html>
<head>
  <meta charset="utf-8">
  <title>User Information</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <style>
    * 
    {
      vertical-align: baseline;
      font-weight: inherit;
      font-family: inherit;
      font-size: 100%;
      padding: 0;
      margin: 0;
      border: 0 none;
      outline: 0;
    }
    form 
    {
      margin-bottom: 20px;
    }
    textarea
    {
      margin-bottom: 15px;
    }
    .push-right
    {
      text-align: right;
    }
    .message
    {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding-bottom: 30px;
      margin-bottom: 15px;
    }
    .comment
    {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }

    a 
    {
      display: inline-block;
    }
  </style>
</head>
<body>
  <?php $this->load->view('/partials/navbar_logged') ?>
  <div class="container">
    <h4><?= $user['first_name'] . " " . $user['last_name']; ?></h4>
    <div class="row">
      <p class="col-md-2">Registered at:</p>
      <p class="col-md-3"><?= $user['created_at']; ?></p>
    </div><!-- row -->
    <div class="row">
      <p class="col-md-2">User ID:</p>
      <p class="col-md-3"><?= $user['id']; ?></p>
    </div><!-- row -->
    <div class="row">
      <p class="col-md-2">Email:</p>
      <p class="col-md-3"><?= $user['email']; ?></p>
    </div><!-- row -->
    <div class="row">
      <p class="col-md-2">Description:</p>
      <p class="col-md-3"><?= $user['description']; ?></p>
    </div><!-- row -->
    <!-- Post Form -->
    <h4>Leave a message for <?= $user['first_name']; ?></h4>
    <form action="/users/post_message" method="post">
      <div class="row">
        <div class="col-md-12">
          <textarea name="message" class="form-control"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-11"></div>
        <div class="col-md-1">
          <input class="btn btn-success button" type="submit" value="Post">
          <input type="hidden" name="current_user_id" value="<?= $current_user_id; ?>">
          <input type="hidden" name="recipient_id" value="<?= $user['id']; ?>">
          <input type="hidden" name="action" value="message">
        </div>
      </div>
    </form>
    <!-- Beginning of Messages -->
<?php
        // var_dump($messages);
        for($i = 0; $i < count($messages); $i++)
        { 
          $message_time = time_display($messages[$i]['time_1']);
          if($i == 0)
          { 
?>
            <div class="row">
              <div class="col-md-6"><a href="<?= $messages[$i]['user1_id']; ?>"><?= $messages[$i]['user1_name']; ?></a> wrote:</div>
              <div class="col-md-6 push-right"><?= $message_time; ?></div>
            </div>
            <div class="row message">
              <div class="col-md-12"><?= $messages[$i]['message_text']; ?></div>
            </div>
<?php       if($messages[$i]['user2_id'] != null)
            { 
              $comment_time = time_display($messages[$i]['time_2']);
?>
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-6"><a href="/users/show/<?= $messages[$i]['user2_id']; ?>"><?= $messages[$i]['user2_name'];?></a> wrote:</div>
                <div class="col-md-5 push-right"><?= $comment_time; ?></div>
              </div>
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-11 comment">
                  <p><?= $messages[$i]['comment_text']; ?></p>
                </div>
              </div>        
<?php       }
          }
          else if($i > 0 && $messages[$i]['user2_id'] && $messages[$i]['message_id'] == $messages[$i - 1]['message_id'])
          { 
            $comment_time = time_display($messages[$i]['time_2']);
?>
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-6"><a href="/users/show/<?= $messages[$i]['user2_id']; ?>"><?= $messages[$i]['user2_name'];?></a> wrote:</div>
              <div class="col-md-5 push-right"><?= $comment_time; ?></div>
            </div>
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-11 comment">
                <p><?= $messages[$i]['comment_text']; ?></p>
              </div>
            </div>
<?php
          }
          else 
          { 
?>
            <div class="row">
              <div class="col-md-6"><a href=""><?= $messages[$i]['user1_name']; ?></a> wrote</div>
              <div class="col-md-6 push-right"><?= $message_time; ?></div>
            </div>
            <div class="row message">
              <div class="col-md-12"><?= $messages[$i]['message_text']; ?></div>
            </div>
<?php       if($messages[$i]['user2_id'] != null)
            { 
              $comment_time = time_display($messages[$i]['time_2']);
              // echo "<h1>HERE</h1>";
?>            
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-6"><a href="/users/show/<?= $messages[$i]['user2_id']; ?>"><?= $messages[$i]['user2_name'];?></a> wrote:</div>
                <div class="col-md-5 push-right"><?= $comment_time; ?></div>
              </div>
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-11 comment">
                  <p><?= $messages[$i]['comment_text']; ?></p>
                </div>
              </div>
<?php
            }
          }
          if($i == count($messages) - 1)
          { 
            ?>
            <div class="row">
              <form action="/users/post_comment" method="post">
                <textarea name="comment" class="form-control" placeholder="Leave a message"></textarea>
                  <div class="col-md-11"></div>
                  <div class="col-md-1">
                    <input class="btn btn-success button" type="submit" value="Post">
                    <input type="hidden" name="current_user_id" value="<?= $current_user_id; ?>">
                    <input type="hidden" name="message_id" value="<?= $messages[$i]['message_id']; ?>">
                    <input type="hidden" name="message_id" value="<?= $messages[$i]['message_id']; ?>">
                    <input type="hidden" name="this_page_id" value="<?= $user['id']; ?>">
                    <input type="hidden" name="action" value="comment">
                  </div>
              </form>
            </div>  
<?php     }
          else if($messages[$i]['message_id'] != $messages[$i + 1]['message_id'])
          { ?>
            <div class="row">
              <form action="/users/post_comment" method="post">
                <textarea name="comment" class="form-control" placeholder="Leave a message"></textarea>
                  <div class="col-md-11"></div>
                  <div class="col-md-1">
                    <input class="btn btn-success button" type="submit" value="Post">
                    <input type="hidden" name="current_user_id" value="<?= $current_user_id; ?>">
                    <input type="hidden" name="message_id" value="<?= $messages[$i]['message_id']; ?>">
                    <input type="hidden" name="message_id" value="<?= $messages[$i]['message_id']; ?>">
                    <input type="hidden" name="this_page_id" value="<?= $user['id']; ?>">
                    <input type="hidden" name="action" value="comment">
                  </div>
              </form>
            </div>
<?php     }
        } 
?>
  </div>
</body>
</html>