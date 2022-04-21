<?php
    session_start();
?>
<!DOCTYPE html>
    <html>
    <head>
        <title>Connection Survey</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <br />
        <div class="container">
        <h2 align="center">Create Your Own Connection Tree</h2>
        <br />
        <div class="col-md-6" style="margin:0 auto; float:none;">
        <form action="survey.php" method = "post">
            <h3 align="center">Basic Information</h3>
            <br />
            <div class="form-group">
            <label>Enter Name</label>
            <input type="text" name="input_name" placeholder="Enter Name" class="form-control" />
            </div>
            <div class="form-group">
            <label>Enter Email</label>
            <input type="text" name="input_email" class="form-control" placeholder="Enter Email" />
            </div>

            <div class="form-group" align="center">
            <input type="submit" name="continue" value="Continue">
            
            </div>
        </form>
   </div>
  </div>
 </body>
</html>