<?php
include('config.php');
include('crud.php');
 $crud = new Crud();

$project_name=$short_desc=$project_mgr='';
    if(isset($_POST['save']))
    {
      
        $name = mysqli_real_escape_string($conn,$_POST['pname']);
        $s_desc = mysqli_real_escape_string($conn,$_POST['sdesc']);
      
        $project_mgr_name = mysqli_real_escape_string($conn,$_POST['projectm']);
        
        
        $data= array('project_mgr_id'=>$project_mgr_name,'name'=>$name,'sdesc'=>$s_desc);
    
        if(isset($_GET['pedit_id']))
        {   $id = mysqli_real_escape_string($conn,$_GET['pedit_id']);
      
            $crud->update_project($data,$conn,$id);    
        }else
        {
          
            $crud->insert_project($data,$conn);        
        }
       
         
    }

$project_manager = $crud->get_project_manager($conn); // to display in dropdown

if(isset($_GET['pedit_id']))
{
 $id = mysqli_real_escape_string($conn,$_GET['pedit_id']);
  
    
    $result = $crud->find_project_detail_id($id,$conn);
    
    $project_name =  $result['pname'];
    
    $short_desc = $result['s_desc'];
  
    
    $user_id = $result['u_id'];
    
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
                    <?php echo (isset($id)) ? "<h2>Update Project Detail</h2>":"<h2>Add New Project</h2>" ?>
                    <div class="col-lg-12">
                    <form name="f1" method="post" action="<?PHP $_PHP_SELF ?>">
                        <div class="form-group">
                            <label for="name">Project Name:</label>
                            <input type="text" name="pname" id="pname" class="form-control" value="<?php echo $project_name;?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Short Description:</label>
                           <textarea class="form-control" rows="5" id="sdesc" name = "sdesc" maxlength="140"><?php echo $short_desc; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Project Manager:</label>
                            <select class="form-control" name="projectm" id="projectm">
                                <option value="0">select</option>
                                <?php foreach($project_manager as $key=> $value) {?>
                                <option value='<?php echo $value['u_id']; ?>' <?php echo (@$user_id == $value['u_id']) ? 'selected="selected"' : " "; ?>><?php echo $value['full_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>

                        
                        

                        <input type ="hidden" name="save" value="0">
                        <input type="submit" name="send" class="form-control btn btn-primary" onclick="return project_validation()">
                           
                     </form>    
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- / -->
     <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <?php include 'validation.php'; ?>
    
</body>
</html>    