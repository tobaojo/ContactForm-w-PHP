<?php

//message vars
$msg ='';
$msgClass='';
 //check  for submit

 if(filter_has_var(INPUT_POST, 'submit')){
     //get form data
     $name = $_POST['name'];
     $email = $_POST['email'];
     $password =$_POST['password'];
     $message = $_POST['message'];

     //check fields are not empty

     if(!empty($name)&& !empty($email)&& !empty($password)&& !empty($message)){
        //passed
        //check email
        if(filter_var($email,FILTER_VALIDATE_EMAIL)=== false){
            $msg = 'please use a valid email';
         $msgClass = 'danger';
        }else{
            //pass 2
            //email to me
            $toEmail = 'toba_ojo@hotmail.com';
            $subject = 'Contact form from '.$name;
            $body = '<h2>Contact Request</h2>
            <h4>Name:</h4><p>'.$name.'</p>
            <h4>Email:</h4><p>'.$email.'</p>
            <h4>Message:</h4><p>'.$message.'</p>';

            //Email headers
            $headers = "MIME-VERSION: 1.0:"."\r\n";
            $headers.= "Content-type:text/html;charset=UTF-8"."\r\n";

            //additional headers 
            $headers.= "from".$name."<".$email.">"."\r\n";

            if(mail($toEmail, $subject, $body, $headers)){
                    //email sent
                    $msg = 'Success! We have received your email!';
                    $msgClass = 'success';
            } else{
                $msg = 'your email didn\'t send';
                $msgClass = 'danger';
            }



            
        } 
     } else{
         //failed
         $msg = 'please fill in all fields';
         $msgClass = 'danger';
     }

 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
    <title>Contact Form</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Contact Us</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Separated link</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <!-- <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button> -->
    </form>
  </div>
</nav>
<?php if($msg!='');?>
    
    <div class="p-4 alert alert-dismissable alert-<?php echo $msgClass;?>"><?php echo $msg;?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" class="p-4">
  <fieldset>
    <legend>Please fill out the below: </legend>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Name</label>
      <input name="name" type="text" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Enter name" value="<?php echo isset($_POST['name'])? $name : ''?>">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input name= "email"  type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo isset($_POST['email'])? $email : ''?>">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value="<?php echo isset($_POST['password'])? $password : ''?>">
    </div>
    <div class="form-group">
      <label for="exampleTextarea"> Message:</label>
      <textarea name="message" class="form-control" id="exampleTextarea" rows="3" value="<?php echo isset($_POST['name'])? $name : ''?>"></textarea>
    </div>
    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>
</body>
</html>