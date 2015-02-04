<html>
<head>
  <meta charset="utf-8">
  <title>Edit User</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <style type="text/css">
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

    .form
    {
      border: 2px solid black;
      padding: 15px;
    }

    h2
    {
      margin: 0px 0px 20px 0px;
    }

    .error
    {
      color: red;
    }

    .success
    {
      color: green;
    }
  </style>
</head>
<body>
  <?php
    if($this->session->userdata('logged')){
      $this->load->view('/partials/navbar_logged');
    }
    else
    {
      $this->load->view('/partials/navbar_default');
    }
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h2>Edit User #<?= $edit_id;?></h2>
      </div>
      <div class="col-md-5"></div>
      <a class="btn btn-primary col-md-2" href="/dashboard/">Return to Dashboard</a>
    </div> <!-- row -->
    <?php 
      if($this->session->flashdata('errors'))
      {
        echo $this->session->flashdata('errors');
      }
      else if($this->session->flashdata('success'))
      {
        echo $this->session->flashdata('success');
      }
    ?>
    <div class="row">
      <div class="col-md-6 form">
        <p>Edit Information</p>
        <form action="/users/admin_edit_info/<?= $edit_id; ?>" method="post">
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="{email_address of the user}">
          </div>
          <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="{first_name of the user}">
          </div>
          <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="{last_name of the user}">
          </div>
          <div class="form-group">
            <label for="user_level">User Level:</label>
            <select name="user_level" id="user_level" class="form-control">
              <option value="Normal">Normal</option>
              <option value="Admin">Admin</option>
            </select>
          </div>
          <input class="btn btn-success" type="submit" value="Save">
          <input type="hidden" name="action" value="edit_user">
          <input type="hidden" name="edit_id" value="<?= $edit_id; ?>">
        </form>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 form">
        <form action="/users/admin_edit_password/<?= $edit_id; ?>" method="post">
          <p>Change Password</p>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="{new password}">
          </div>
          <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="text" class="form-control" id="password_confirmation" name="confirm_password" placeholder="{new password}">
          </div>
          <input class="btn btn-success" type="submit" value="Update Password">
          <input type="hidden" name="action" value="edit_password">
          <input type="hidden" name="edit_id" value="<?= $edit_id; ?>">
        </form>
      </div>
    </div> <!-- row -->
  </div> <!-- container -->
</body>
</html>