<html>
<head>
  <meta charset="utf-8">
  <title>Signin Page</title>
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
    form 
    {
      margin-top: 30px;
    }
    form div
    {
      margin-bottom: 15px;
    }

    a
    {
      margin-top: 20px
    }

    h2
    {
      vertical-align: top;
      margin: 0px;
    }
  </style>
</head>
<body>
  <?php $this->load->view('partials/navbar_logged') ?>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <h2>Add a new user</h2>
      </div>
      <div class="col-md-5"></div>
      <a class="btn btn-primary col-md-2" href="">Return to Dashboard</a>
    </div>
    <div class="row">
        <form action="" method="post">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Email Address</span>
            <input type="text" class="form-control" placeholder="Email Address" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">First Name</span>
            <input type="text" class="form-control" placeholder="First Name" aria-describedby="basic-addon1">
          </div>          
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Last Name</span>
            <input type="text" class="form-control" placeholder="Last Name" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Password</span>
            <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Password Confirmation</span>
            <input type="password" class="form-control" placeholder="Password Confirmation" aria-describedby="basic-addon1">
          </div>
          <input class="btn btn-success" type="submit" value="Register">
          <input type="hidden" name="action" value="register">
        </form>
    </div><!-- row -->
  </div><!-- container -->
</body>
</html>