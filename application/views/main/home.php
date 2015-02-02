<html>
<head>
  <meta charset="utf-8">
  <title>Home Page</title>
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
    .hero-unit
    {
      background-color: darkgray;
      border: 3px solid gray;
      padding: 0px 30px;
      margin-bottom: 30px;
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
    <div class="hero-unit">
      <h1>Welcome to the Test</h1>
      <p>We're going to build a cool application using a MVC framework! This application was built with the Village 88 folks!</p>
      <p>
        <a class="btn btn-primary btn-large" href="/main/signin_page">
          Start
        </a>
      </p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h5>Manage Users</h5>
        <p>Using this application, you'll learn how to add, remove, and edit users for the application</p>
      </div>
      <div class="col-md-4">
        <h5>Leave Messages</h5>
        <p>Users will be able to leave a message to another user using this application</p>
      </div>
      <div class="col-md-4">
        <h5>Edit User Information</h5>
        <p>Admins will be able to edit another user's information (email address, first name, last name, etc)</p>
      </div>      
    </div>
  </div>
</body>
</html>