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
  </style>
</head>
<body>
  <?php $this->load->view('partials/navbar_default') ?>
  <div class="container">
    <div class="row">
      <h4 class="col-lg-3">Sign In</h4>
      <?php 
        if($this->session->flashdata('errors'))
        {
          echo $this->session->flashdata('errors');
        }
      ?>
    </div>
    <div class="row">
        <form action="/main/sign_in" method="post">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Email Address</span>
            <input type="text" class="form-control" name="email" placeholder="Email Address" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Password</span>
            <input type="password" class="form-control" name="password" placeholder="Username" aria-describedby="basic-addon1">
          </div>
          <input class="btn btn-success" type="submit" value="Sign In">
          <input type="hidden" name="action" value="sign_in">
        </form>
      </div>
      <div class="row">
        <a href="/main/registration_page">Don't have an account? Register!</a>
      </div>
    </div>
  </div><!-- container -->
</body>
</html>