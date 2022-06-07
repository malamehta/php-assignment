<?php 
if(isset($_POST['regis'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $name=$_POST['name'];
    $age=$_POST['age'];
    $city=$_POST['city'];
    $gender=$_POST['r1'];
    $tmp=$_FILES['att']['tmp_name'];
    $fname=$_FILES['att']['name'];
    $ext=pathinfo($fname,PATHINFO_EXTENSION);
    if(empty($email) || empty($pass) || empty($name || empty($age) || empty($city) || empty($gender) || empty($tmp))){
        $errMsg="Please fill blank fields";
    }
    else {
        if($ext=="jpg" || $ext=="png" || $ext=="gif" || $ext=="jpeg")
        {
           if(is_dir("users/$email"))
           {
               $errMsg="Email already registerd";
           }
           else {
            mkdir("users/$email");
               if(move_uploaded_file($tmp,"users/$email/$email".".jpg"))
               {
              
               file_put_contents("users/$email/details.txt","$name\n$pass\n$age\n$city\n$gender");
               header("location:dashboard.php?uid=$email");
               }
               else {
                   $errMsg="Uploading error";
               }
           }
        }
        else {
            $errMsg="Only jpg | png | gif supported";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  display:flex;
  justify-content:center;
}

* {
  box-sizing: border-box;
}

.container {
  width:600px;
  padding:0 16px 16px 16px;
  background-color: white;
  border:3px solid black;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 10px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 10px;
}

.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 10px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

a {
  color: dodgerblue;
}

.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>
   <?php
       if(isset($errMsg))
            {
                 ?>
            <div><?= $errMsg;?></div>
                 <?php 
             }
     ?>

<form method="post" enctype="multipart/form-data">
  <div class="container">
    <h1 style="text-align:center">Register</h1>
    <!-- <p>Please fill in this form to create an account.</p> -->
    <hr>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" >

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="psw" >

    <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" >

    <label for="age"><b>Age</b></label>
    <input type="text" placeholder="Enter Age" name="age"  >

    <label for="city"><b>City</b></label>
    <input type="text" placeholder="Enter City" name="city" >

    <label for="gender"><b>Gender</b></label>
    <input type="radio"  name="r1"  value="male" >Male
    <input type="radio"  name="r1" value="female" >Female<br><br>

    <label for="image"><b>Upload Image</b></label>
    <input type="file"  name="att"  >
    

    <hr>

    <button type="submit" class="registerbtn" name="regis">Register</button>
  </div>
  
</form>

</body>
</html>
