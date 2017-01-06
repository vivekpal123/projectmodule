<?php 
include('config.php');
include('crud.php');
$crud = new Crud();
$project_data = $crud->get_all_project($conn); //
    if(isset($_POST['save']))
    {
      
        $module_name = mysqli_real_escape_string($conn,$_POST['mname']);
        $pname = mysqli_real_escape_string($conn,$_POST['pname']);
        $mpercent = mysqli_real_escape_string($conn,$_POST['mpercent']);
        $data= array('mname'=>$module_name,'pname'=>$pname,'module_percent'=>$mpercent);
    
        if(isset($_GET['medit_id']))
        {      
            $id = mysqli_real_escape_string($conn,$_GET['medit_id']);
            
            $sum_percent =  $crud->getmodule_percent($conn,$pname,$id); 
          
            $totalpercent = $mpercent+$sum_percent; 
            if($totalpercent <=  100.00)
                {
                   $crud->update_module($data,$conn,$id); 
                   //$crud->update_submodule_percent($conn,$id,$totalpercent);
                }else
                {
                    $error[] = "please assign percent less than current assign";
                } 
               
        }else
        {
            $sum_percent =  $crud->getmodule_percent($conn,$pname,0); 
            $totalpercent = $mpercent+$sum_percent;
            if($totalpercent <=  100.00)
                  {
                      $crud->insert_module($data,$conn);  
                      $last_m_id = $crud->module_count();

                  
                      $crud->update_module_percent($conn,$last_m_id,$totalpercent);

                  }else
                    $error[] = "You can not add task ";
          
                
        }
       
         
    }

if(isset($_GET['medit_id']))
{
    $m_id = mysqli_real_escape_string($conn,$_GET['medit_id']);
  
    
    $result = $crud->find_module_id($m_id,$conn);
    
    
    $project_id =  $result['p_id'];
    
    
    $module_name = $result['module_name'];
  
    $module_percent = $result['percent_remain_to_complete'];

    
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
                     <?php if(count(@$error) > 0) {  if(isset($sm_id)) { ?>
                        <div class="alert alert-danger">
                         <strong>Error!</strong><?php echo $error[0]; ?>.</div> 
                         <?php } else { ?>
                          <div class="alert alert-danger">
                         <strong>Error!</strong><?php echo $error[0]; ?>.</div> 
                         <?php } }?>
                    <form name="f1" method="post" action="<?PHP $_PHP_SELF ?>">
                        
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
                            <label for="name">Assign Percentage:</label>
                            <input type="text" min="1" name="mpercent" id="mpercent" class="form-control" value="<?php echo  @$module_percent;?>" >
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
      
        
    
    <script>
        var remain_percent='';
     
    $("#mpname").on('change',function(){
        
        var val = $(this).val();
        if(val == 0)
        {
            
        }else{
            
        
         $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'p_id_for_per='+val, 
                   
                    success: function (data) {
                       
                        $('#remain').html("remaining percent:"+data+'%');
                         if(data == 0)
                             {
                                 alert("you cannot add module to this project ");
                               
                                 $('input:text').prop("disabled",true);
                                 $( "input[name='send']" ).prop("disabled",true);
                                  $('#mpercent').prop("disabled",true);
                                 
                             }
                         
                    }})    
        }
        
    })
    
    
    if(remain_percent != '')
    {
        
       
    }
        
    </script>
</body>
</html>   