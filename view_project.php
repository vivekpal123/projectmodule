<?php
include('config.php');
include('crud.php');

$crud = new Crud();
?>

<html>
    <head>
      
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
                 
               <?php $crud->view_project($conn);?>
            </div>
        </div>
        </div>
        <!-- /#page-content-wrapper -->

  
    
     
       <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>      
       
           <script>
              
            function call_ajax(id)
            {   
               var id = id;
                var role_selected = $('#role option:selected').val();
                var status_selected = $('#status option:selected').val();
               
               alert(role_selected);
                var msg =confirm("Are you sure to update record");
                    if(msg == true)
                    {   
                    $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'id='+id+'&role='+role_selected+'&stat='+status_selected,    
                    datatype: "json",
                    success: function (e) {
                        $('.show_msg').html('<span>Updated succfully</span>');
                    alert('success');
                    }})
                        
                    }
               
                
            }
               
               
            $('#role, #status').on('change',function(){
            
              $('#update').prop('disabled',false);
            })       
        </script>
           
    </body>
</html>