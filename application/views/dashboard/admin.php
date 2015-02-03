<html>
<head>
  <meta charset="utf-8">
  <title>User Dashboard</title>
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

    .navbar
    {
      margin-bottom: 40px;
    }

    a
    {
      display: inline-block;
      vertical-align: top;
      margin-right: 10px;
      text-align: left;
    }

    h2
    {
      display: inline-block;
      vertical-align: top;
      margin: 0px;
    }

    .top-buffer
    {
      margin-top: 20px;
    }

    .success 
    {
      color: green;
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function()
    {
      $(".remove").click(function(){
        var remove = confirm("Are you sure?");
        if(remove === false)
        {
          return false;
        }
      });
    });
  </script>
</head>
<body>
  <?php $this->load->view('partials/navbar_logged') ?>
  <?php var_dump($this->session->all_userdata()); ?>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Manage Users</h2>
      </div>
      <div class="col-md-5">
      </div>
      <div class="col-md-1">
        <a class="btn btn-primary" href="/users/new">Add New</a>
      </div>
    </div>
    <?php 
        if($this->session->userdata('success'))
        {
          echo $this->session->userdata('success');
          $this->session->unset_userdata('success');
        }
    ?>
    <div class="row">
      <div class="table-responsive">
        <table class="table table-bordered table-striped top-buffer">
          <thead>
            <tr>
              <th>
                ID
              </th>
              <th>
                Name
              </th>
              <th>
                email
              </th>
              <th>
                created_at
              </th>
              <th>
                user_level
              </th>
              <th>
                actions
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($users as $user)
              {
                echo "<tr>";
                echo "<td>{$user['id']}</td>";
                echo "<td><a href='/users/show/{$user['id']}'>{$user['name']}</a></td>";
                echo "<td>{$user['email']}</td>";
                echo "<td>{$user['created_at']}</td>";
                echo "<td>{$user['user_level']}</td>";
                echo "<td><a href='/users/edit/{$user['id']}'>Edit</a><a class='remove' href='/users/remove/{$user['id']}'>Remove</a></td>";
                echo "</tr>";
              }
            ?>
          </tbody>
        </table>
      </div> <!-- Resposive Table -->
    </div> <!-- Row -->
  </div>
</body>
</html>