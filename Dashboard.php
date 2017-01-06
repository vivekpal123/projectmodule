<?php
include('config.php');
include('crud.php');
 $crud = new Crud();

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
    <link href="css/jquery.circliful.css" rel="stylesheet">
    

</head>

<body>
    <div id="wrapper">

      <?php include('sidebar.php');?>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                  
                <div class="col-lg-2">
                  
                    <?php   $data = $crud->get_all_project($conn);
                    foreach($data as $key => $value) { ?>
    
                    <p><?php echo $value['p_name'];?></p>
                <div id="test-circle<?php echo $value['p_id']; ?>" data-toggle="collapse" data-target="#demo" data-percent="<?php echo $value['percent']; ?>"></div>
                <?php  $module_data =   $crud->find_module_by_pid($value['p_id'],$conn);  ?>
                    
                       <div id="demo" class="collapse">
                            
                        <?php   foreach($module_data as $mkey => $mvalue) { 
                           
                                $percent = $mvalue['percent_const']-$mvalue['percent'];
                           ?>
                            
                            <div id="module-circle<?php echo $mvalue['module_id']?>" data-percent="<?php echo @$percent; ?>">
                                       
                            </div>
                        <?php } ?>  
                           
                        </div>
                <?php } ?>
                </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.circliful.min.js"></script>
    
    <script>
        $( document ).ready(function() {
      <?php  foreach($data as $key => $value) {   ?>    
        $("#test-circle<?php echo $value['p_id']; ?>").circliful({
        animationStep: 5,
        textColor:	'#00FF00',
        foregroundBorderWidth: 5,
        backgroundBorderWidth: 15,
       targetPercent: 100,
    });
    <?php } ?>
            
    });
        
   
        
       
    </script>
</body>