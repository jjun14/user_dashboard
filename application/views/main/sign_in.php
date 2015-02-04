<html>
<head>
  <meta charset="utf-8">
  <title>Signin Page</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <style type="text/css">
    form div
    {
      margin-bottom: 15px;
    }

    .button
    {
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <?php $this->load->view('partials/navbar_default') ?>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-md-offset-4">
        <h4>Sign In</h4>
        <?php 
          if($this->session->flashdata('errors'))
          {
            echo $this->session->flashdata('errors');
          }
        ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-md-offset-4">
        <form action="/main/sign_in" method="post">
          <div class="input-group">
            <label for="email">Email Address:</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
          </div>
          <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Username">
          </div>
          <input class="btn btn-success button" type="submit" value="Sign In">
          <input type="hidden" name="action" value="sign_in">
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-md-offset-4">
        <a href="/main/registration_page">Don't have an account? Register!</a>
      </div>
    </div>
  </div><!-- container -->
</body>
</html>