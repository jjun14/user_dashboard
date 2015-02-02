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
    form div
    {
      margin-bottom: 15px;
    }
    .error
    {
      color: red;
    }
  </style>
</head>
<body>
  <?php $this->load->view('partials/navbar_default') ?>
  <div class="container">
    <div class="row">
      <h4 class="col-lg-3">Register</h4>
      <?php 
        if($this->session->userdata('errors'))
        {
          echo $this->session->userdata('errors');
          $this->session->unset_userdata('errors');
        }
      ?>
    </div>
    <div class="row">
        <form action="/main/register" method="post">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Email Address</span>
            <input type="text" class="form-control" name="email" placeholder="Email Address" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">First Name</span>
            <input type="text" class="form-control" name="first_name" placeholder="First Name" aria-describedby="basic-addon1">
          </div>          
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Last Name</span>
            <input type="text" class="form-control" name="last_name" placeholder="Last Name" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Password</span>
            <input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Password Confirmation</span>
            <input type="password" class="form-control" name="confirm_password" placeholder="Password Confirmation" aria-describedby="basic-addon1">
          </div>
          <input class="btn btn-success" type="submit" value="Register">
          <input type="hidden" name="action" value="register">
        </form>
      </div>
      <div class="row">
        <a href="/main/signin_page">Already have an account? Sign In!</a>
      </div>
    </div>
  </div><!-- container -->
</body>
</html>