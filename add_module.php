<?php 
include('config.php');
include('crud.php');
$crud = new Crud();
$project_data = $crud->get_all_project($conn); //
$error = array();
    if(isset($_POST['save']))
    {
      
        $module_name = mysqli_real_escape_string($conn,$_POST['mname']);
        $pname = mysqli_real_escape_string($conn,$_POST['pname']);
        $mpercent   =   mysqli_real_escape_string($conn,$_POST['mpercent']);

        $data= array('mname'=>$module_name,'pname'=>$pname,'mpercent'=>$mpercent);
    
        if(isset($_GET['medit_id']))
        {      $id = mysqli_real_escape_string($conn,$_GET['medit_id']);

             $sum_percent = $crud->get_modulepercent_sum($conn,$pname,$id);
             $totalpercent = $mpercent+$sum_percent;

             if($totalpercent <=  100.00)
                  {
                     $crud->update_module($data,$conn,$id); 
                 }else
                $error[] = "You can not add Percent more than current Percent";

               
        }else
        {
           $sum_percent  = $crud->get_modulepercent_sum($conn,$pname,0);
             $totalpercent = $mpercent+$sum_percent;
               if($totalpercent <=  100.00)
                  {
                      $crud->insert_module($data,$conn);     
                 }else
                $error[] = "You can not add module to add change existing module percent";
              
        }
       
         
    }

if(isset($_GET['medit_id']))
{
    $m_id = mysqli_real_escape_string($conn,$_GET['medit_id']);
  
    
    $result = $crud->find_module_id($m_id,$conn);
    
    
    $project_id =  $result['p_id'];
    
    
    $module_name = $result['module_name'];
  
    $mpercent   =   $result['module_percent'];

    
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
                    <?php echo (isset($m_id)) ? "<h2>Update Module Detail</h2>":"<h2>Add Module</h2>" ?>
                    <div class="col-lg-12">
                    <form name="f1" method="post" action="<?PHP $_PHP_SELF ?>">
                         <?php if(count($error) > 0) {  if(isset($m_id)) { ?>
                        <div class="alert alert-danger">
                         <strong>Error!</strong><?php echo $error[0]; ?>.</div> 
                         <?php } else { ?>
                          <div class="alert alert-danger">
                         <strong>Error!</strong><?php echo $error[0]; ?>.</div> 
                         <?php } }?>
                        <div class="form-group">
                            <label for="name">Select Project to assign :</label>
                            <select class="form-control" name="pname" id="mpname">
                                <option value="0">select</option>
                                <?php foreach($project_data as $key => $value) {?>
                                <option value='<?php echo @$value['p_id']; ?>'<?php echo (@$project_id == $value['p_id']) ? 'selected="selected"' : " "; ?>><?php echo @$value['p_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Module Name:</label>
                            <input type="text" name="mname" id="mname" class="form-control" value="<?php echo @$module_name;?>">
                        </div>
                      
                        <div class="form-group">
                           <label for="submpercent">Module Percent :</label>
                              <select class="form-control" name="mpercent" id="mpercent">
                                <option value="0">select</option>
                                 <option value="10" <?php echo (@$mpercent == "10.00") ? 'selected="selected"' : " " ?>>10</option>
                                 <option value="20"  <?php echo (@$mpercent == "20.00") ? 'selected="selected"' : " " ?>>20</option>
                                 <option value="30"  <?php echo (@$mpercent == "30.00") ? 'selected="selected"' : " " ?>>30</option>
                                 <option value="40"  <?php echo (@$mpercent == "40.00") ? 'selected="selected"' : " "?>>40</option>
                                <option value="50"  <?php echo (@$mpercent == "50.00") ? 'selected="selected"' : " "?>>50</option>
                                 <option value="60"  <?php echo (@$mpercent == "60.00") ? 'selected="selected"' : " " ?>>60</option>
                                <option value="70"  <?php echo (@$mpercent == "70.00") ? 'selected="selected"'  : " "?>>70</option>
                                 <option value="80"  <?php echo (@$mpercent == "80.00") ? 'selected="selected"' : " " ?>>80</option>
                                  <option value="90"  <?php echo (@$mpercent == "90.00") ? 'selected="selected"' : " " ?>>90</option>
                                 <option value="100"  <?php echo (@$mpercent == "100.00") ? 'selected="selected"' : " " ?>>100</option>

                            </select>
                            
                        </div>
                      
                        

                        <input type ="hidden" name="save" value="0">
                        <input type="submit" name="send"  class="form-control btn btn-primary" onclick="return module_validation()">
                           
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