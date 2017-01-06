<?php 
include('config.php');
include('crud.php');
$crud = new Crud();
$module_data = $crud->get_module_list($conn);

    if(isset($_POST['save']))
    {
      
        $module_name = mysqli_real_escape_string($conn,$_POST['module_name']);
        $sub_module_name = mysqli_real_escape_string($conn,$_POST['submodule']);
        $subpercent =  mysqli_real_escape_string($conn,$_POST['subpercent']);

        $data = array('module_id'=>$module_name,'submodule'=>$sub_module_name,'submodule_percent'=>$subpercent);
    
        if(isset($_GET['smedit_id']))
        {    
            $id = mysqli_real_escape_string($conn,$_GET['smedit_id']);
            
            $sum_percent =  $crud->getsub_percent($conn,$module_name,$id); 
            $totalpercent = $subpercent+$sum_percent; 
            if($totalpercent <=  100.00)
                {
                   $crud->update_sub_module($data,$conn,$id);   
                   //$crud->update_submodule_percent($conn,$id,$totalpercent);
                }else
                {
                    $error[] = "please assign percent less than current assign";
                } 
         
        }else
        {

            $sum_percent =  $crud->getsub_percent($conn,$module_name,0); 
            $totalpercent = $subpercent+$sum_percent;
            if($totalpercent <=  100.00)
                  {
                      $crud->insert_sub_module($data,$conn);
                      $last_s_id = $crud->subm_count();

                      $crud->update_submodule_percent($conn,$last_s_id,$totalpercent);

                  }else
                    $error[] = "You can not add task ";
           
        }
       
         
    }

    if(isset($_GET['smedit_id']))
    {
        $sm_id = mysqli_real_escape_string($conn,$_GET['smedit_id']);
        
        $result = $crud->find_submodule_id($sm_id,$conn);
                    
        $module_id = $result['module_id'];
        $sub_module_name = $result['sub_module_name'];
        
        
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
                    <?php echo (isset($sm_id)) ? "<h2>Update Project Detail</h2>":"<h2>Add SubModule</h2>" ?>
                    <div class="col-lg-12">
                     <?php if(count(@$error) > 0) {  if(isset($sm_id)) { ?>
                        <div class="alert alert-danger">
                         <strong>Error!</strong><?php echo $error[0]; ?>.</div> 
                         <?php } else { ?>
                          <div class="alert alert-danger">
                         <strong>Error!</strong><?php echo $error[0]; ?>.</div> 
                         <?php } }?>
                    <form name="f1" method="post" action="<?PHP $_PHP_SELF ?>">
                        <div class="form-group">
                            <label for="name">Select Module :</label>
                            <select class="form-control" name="module_name" id="module_name">
                                <option value="0">select</option>
                                <?php foreach($module_data as $key => $value) {?>
                                <option value='<?php echo @$value['module_id']; ?>' <?php echo (@$module_id == $value['module_id']) ? 'selected="selected"': " " ?>><?php echo @$value['module_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Sub Module Name:</label>
                            <input type="text" name="submodule" id="submodule" class="form-control" value="<?php echo @$sub_module_name; ?>">
                        </div>
                       
                    
                        <div class="form-group">
                            <label for="name">Assign Percentage:</label><span id="remain"></span>
                            <input type="text" min="1" name="subpercent" id="subpercent" class="form-control" value="">
                        </div>

                        <input type ="hidden" name="save" value="0">
                        <input type="submit" name="send" class="form-control btn btn-primary" onclick="return sub_module_validation()">
                           
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