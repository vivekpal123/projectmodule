<?php
include('config.php');
include('crud.php');
/*
function isuniqe($em,$conn)
{
  $sel_email="select * from user_details where email='".$em."'";
  $query=mysqli_query($conn,$sel_email);

  if(mysqli_num_rows($query) > 0)
  {
    return false;
  }
  else
    return true;

}*/
    if(isset($_POST['save']))
    {
      
        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $phone = mysqli_real_escape_string($conn,$_POST['phone_no']);
        $status = mysqli_real_escape_string($conn,$_POST['status']);
        $password = mysqli_real_escape_string($conn,$_POST['pwd']);
        $role = mysqli_real_escape_string($conn,$_POST['role']);
        
        
        $data= array('name'=>$name,'email'=>$email,'phone'=>$phone,'status'=>$status,'password'=>$password,'role'=>$role);
    
        
        $crud = new Crud();
        $crud->insert($data,$conn);
         
    }

?>






<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    

</head>

<body>

    <div id="wrapper">

      <?php include('sidebar.php');?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h2>Register New User</h2>
                    <div class="col-lg-12">
                    <form name="f1" method="post" action="<?PHP ECHO $_SERVER['PHP_SELF'] ?>" id="newUser">
                        <div class="form-group">
                            <label for="name">Full Name:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Email ID:</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Phone No:</label>
                            <input type="number" name="phone_no" id="phone_no" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Status:</label>
                            <select class="form-control" name="status" id="status">
                                <option value="0">select</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" name="pwd" id="pwd" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" name="role" id="role">
                                <option value="0">select</option>
                                <option value="1">Admin</option>
                                <option value="2">Project Manager</option>
                                <option value="3">Project Developer</option>

                            </select>
                        </div>

                        <input type ="hidden" name="save" value="0">
                        <input type="submit" name="send" class="form-control btn btn-primary" onclick="return validation()">
                           
                     </form>    
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    
    <script type="text/javascript">
        
        /*$( "#newUser" ).validate( {
				rules: {
					name: 
                    {
                    required: true,
                    minlength: 2
                    }
				
					
					password: {
						required: true,
						minlength: 5
					},
					confirm_password: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true
					},
					agree: "required"
				},
				messages: {
					name: "Please enter your firstname",
					lastname: "Please enter your lastname",
					username: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 2 characters"
					},
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 5 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: "Please enter a valid email address",
					agree: "Please accept our policy"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			} );*/

        function validation()
        {
            
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone_no').val();
            var status = $('#status').val();
            var pwd = $('#pwd').val();
            var role = $('#role').val();
            var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            
            
            if(name == '')
                {
                    alert('please enter your name');
                    $('#name').focus();
                    return false;
                }
            if(email == '')
                {
                    alert('please enter your email');
                    $('#email').focus();
                    return false;
                }
            
            if(!pattern.test(email))
                {
                    alert('Invalid email address');
                    $('#email').focus();
                    return false;
                }
            
            if(phone == '')
                {
                    alert('please enter your phone number');
                    $('#phone').focus();
                    return false;
                }
             if(phone.length < 8 || phone.length>10)
                {
                    alert('please enter valid phone number');
                    $('#phone_no').focus();
                    return false;
                }
            if(status == '0')
                {
                    alert('please select the status');
                    $('#status').focus();
                    return false;
                }
            
           
            if(pwd == '')
                {
                    alert('please enter your password');
                    $('#pwd').focus();
                    return false;
                }
            if(pwd.length < 6)
                {
                    alert('password length should be greater than 6');
                    $('#pwd').focus();
                    return false;
                }
            if(role == '0')
                {
                    alert('please select your role');
                    $('#role').focus();
                    return false;
                }
           
        }
    
    </script>
    

</body>

</html>
