
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
                  <div class="show_msg"></div>
         <table class="table-bordered">
        <thead><tr>
        <th>FULL NAME</th><th>EMAIL ID</th><th>PHONE NO</th><th>STATUS</th><th>ROLE</th><th>ACTION</th>
        </tr></thead>
        <tbody> 
             <?php   $sql = "SELECT * FROM user_details";
                $result = mysqli_query($conn,$sql);  
                if(mysqli_num_rows($result) > 0)
                { 
            while($urow = mysqli_fetch_array($result))
            {
           ?>
            
            
            <tr><td><?php echo $urow['full_name']  ?></td><td><?php echo $urow['email_id'] ?></td><td><?php echo $urow['phone_no'] ?></td>
                      
            <td><select class="status<?php echo $urow['id']; ?>" ><option value="2" <?php echo ($urow['status'] == '2') ? 'selected="selected"' : " "; ?>>Inactive</option><option value="1"  <?php  echo ($urow['status'] == '1') ? 'selected="selected"' : " "; ?>>Active</option></select>               </td>
          <td>
            <select class="role<?php echo $urow['id']; ?>">
            <option value="1" <?php echo ($urow['role_assign'] == '1') ? 'selected="selected"' : " "; ?>>Admin</option>
            <option value="2" <?php echo ($urow['role_assign'] == '2') ? 'selected="selected"' : " "; ?>>Project Manager</option>
            <option value="3" <?php echo ($urow['role_assign'] == '3' ) ?  'selected="selected"' : " "; ?>>Project Developer</option>
            </select>
            
            </td><td><button type="button" onclick="call_ajax(<?php echo $urow['id']; ?>);" class="update"  class="btn btn-primary">Update</button></td></tr>    
        <?php  }}   else { ?>
                
            <tr><td colspan="5">No Record</td></tr>
            <?php } ?>
        </tbody>
        </table>
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
                
                var role_selected = $('.role'+id+' option:selected').val();
              
                var status_selected = $('.status'+id+' option:selected').val();
             
              
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
               
               
               
        </script>
           
    </body>
</html>