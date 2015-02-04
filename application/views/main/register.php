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
      <div class="col-md-3 col-md-offset-4">
        <h4>Register</h4>
        <?php 
          if($this->session->userdata('errors'))
          {
            echo $this->session->userdata('errors');
            $this->session->unset_userdata('errors');
          }
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-md-offset-4">
          <form action="/main/register" method="post">
            <div class="input-group">
              <label for="email">Email Address:</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
            </div>
            <div class="input-group">
              <label for="first_name">First Name:</label>
              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
            </div>          
            <div class="input-group">
              <label for="last_name">Last Name:</label>
              <input type="text" class="form-control" name="last_name" id ="last_name" placeholder="Last Name">
            </div>
            <div class="input-group">
              <label for="password">Password:</label>            
              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
            </div>
            <div class="input-group">
              <label for="confirm_password">Confirm Password:</label>              
              <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Password Confirmation">
            </div>
            <input class="btn btn-success" type="submit" value="Register">
            <input type="hidden" name="action" value="register">
          </form>
        </div>
      </div>
    </div>
      <div class="row">
        <div class="col-md-3 col-md-offset-4">
          <a href="/main/signin_page">Already have an account? Sign In!</a>          
        </div>
      </div>
    </div>
  </div><!-- container -->
</body>
</html>