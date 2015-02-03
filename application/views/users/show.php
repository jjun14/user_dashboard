<?php 

function time_display($str)
{
  $sec = intval($str);
  if($sec < 60)
  {
    echo "<div class='col-md-2 push-right'>{$sec} seconds ago</div>";
  }
  else if($sec < 3600)
  {
    $time = round($sec / 60);
    echo "<div class='col-md-2 push-right'>{$time} minutes ago</div>";
  }
  else if($sec < 86400)
  {
    $time = round($sec / 3600);
    echo "<div class='col-md-2 push-right'>{$time} hours ago</div>";
  }
  else 
  {
    $time = round($sec / 86400);
    echo "<div class='col-md-2 push-right'>{$time} days ago</div>";
  }
}

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
      <textarea name="text" class="form-control"></textarea>
      <div class="row">
        <div class="col-md-11"></div>
        <div class="col-md-1">
          <input class="btn btn-success button" type="submit" value="Post">
          <input type="hidden" name="action" value="message">
          <input type="hidden" name="recipient" value="<?= $user['id']; ?>">
          <input type="hidden" name="current_user_id" value="<?= $current_user_id; ?>">
        </div>
      </div>
    </form>
    <!-- Beginning of Message -->
    <?php 
      foreach($messages as $message)
      {
        echo "<div class='row'>";
        echo "<p class='col-md-3'><a href=''>{$message['name']}</a> wrote</p>";
        echo "<div class='col-md-7'></div>";
        time_display($message['time']);
        echo "</div>";
        echo "<div class='row message'>";
        echo "<p class='col-md-12'>{$message['text']}</p>";
        echo "</div>";
      }
    ?>
    <div class="row">
      <p class="col-md-3"><a href="">Mark Gullen</a> wrote</p>
      <div class="col-md-7"></div>
      <p class="col-md-2 push-right">7 hours ago</p>
    </div>
    <div class="row message">
      <p class="col-md-12">Hi Michael! I'm having fun building BoomYEAH!</p>
    </div>
    <!-- End of Message -->
    <!-- Start of comment -->
    <div class="row">
      <div class="col-md-1"></div>
      <p class="col-md-3"><a href="">Diana Manlulu</a> wrote</p>
      <p class="col-md-8 push-right">23 minutes ago</p>
    </div>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-11 comment">
        <p>Awesome!</p>
      </div>
    </div>
    <!-- End of comment -->
    <!-- Start comment form -->
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-11">
        <form action="" method="post">
          <textarea name="" class="form-control" placeholder="write a message"></textarea>
          <input class="btn btn-success button" type="button" value="Post">
        </form>
      </div>
    </div>
    <!-- End comment form -->
  </div>
</body>
</html>