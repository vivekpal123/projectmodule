<?php 
include('config.php');
include('crud.php');
$crud = new Crud();
$module_data = $crud->get_module_list($conn);
$error = array();
    if(isset($_POST['save']))
    {
      
        $module_name = mysqli_real_escape_string($conn,$_POST['module_name']);
        $sub_module_name = mysqli_real_escape_string($conn,$_POST['submodule']);
        $submpercent = mysqli_real_escape_string($conn,$_POST['submpercent']);

        $data = array('module_id'=>$module_name,'submodule'=>$sub_module_name,'submpercent'=>$submpercent);
    
        if(isset($_GET['smedit_id']))
        {   
            $id = mysqli_real_escape_string($conn,$_GET['smedit_id']);

            $sum_percent  = $crud->get_submodulepercent_sum($conn,$module_name,$id);
            $totalpercent = $submpercent+$sum_percent;
                if($totalpercent <=  100.00)
                  {
                    $crud->update_sub_module($data,$conn,$id);    
                }else
                $error[] = "You can not add Percent more than current Percent";
         
        }else
        {
        $sum_percent  = $crud->get_submodulepercent_sum($conn,$module_name,0);
            $totalpercent = $submpercent+$sum_percent;
            echo $totalpercent;
                if($totalpercent <=  100.00)
                  {
                      $crud->insert_sub_module($data,$conn);        
                    //  $crud->update_submodule_percent($conn,$submodule_name,$totalpercent);
                  }else
                    $error[] = "You can not add subtask";
            
        }
       
         
    }

    if(isset($_GET['smedit_id']))
    {
        $sm_id = mysqli_real_escape_string($conn,$_GET['smedit_id']);
        
        $result = $crud->find_submodule_id($sm_id,$conn);
                    
        $module_id = $result['module_id'];
        $sub_module_name = $result['sub_module_name'];
        $submpercent = $result['submodule_percent'];
        
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
                    <?php if(count($error) > 0) {  if(isset($sm_id)) { ?>
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
                            <label for="submpercent">Task Percent :</label>
                              <select class="form-control" name="submpercent" id="submpercent">
                                <option value="0">select</option>
                                 <option value="10" <?php echo (@$submpercent == "10.00") ? 'selected="selected"' : " " ?>>10</option>
                                 <option value="20"  <?php echo (@$submpercent == "20.00") ? 'selected="selected"' : " " ?>>20</option>
                                 <option value="30"  <?php echo (@$submpercent == "30.00") ? 'selected="selected"' : " " ?>>30</option>
                                 <option value="40"  <?php echo (@$submpercent == "40.00") ? 'selected="selected"' : " "?>>40</option>
                                <option value="50"  <?php echo (@$submpercent == "50.00") ? 'selected="selected"' : " "?>>50</option>
                                 <option value="60"  <?php echo (@$submpercent == "60.00") ? 'selected="selected"' : " " ?>>60</option>
                                <option value="70"  <?php echo (@$submpercent == "70.00") ? 'selected="selected"'  : " "?>>70</option>
                                 <option value="80"  <?php echo (@$submpercent == "80.00") ? 'selected="selected"' : " " ?>>80</option>
                                  <option value="90"  <?php echo (@$submpercent == "90.00") ? 'selected="selected"' : " " ?>>90</option>
                                 <option value="100"  <?php echo (@$submpercent == "100.00") ? 'selected="selected"' : " " ?>>100</option>

                            </select>  
                            
                           
                        </div>

                       
                       <!-- <div class="form-group">
                            <label>Sub Module:</label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio"> YES
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="optradio">NO
                            </label>
                        </div>-->
                        

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