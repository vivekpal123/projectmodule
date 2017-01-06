<?php
include('config.php');
include('crud.php');
 $crud = new Crud();



if(isset($_POST['send_status']))
{
   
    
    $status = mysqli_real_escape_string($conn,$_POST['task_status']);
    $t_id = mysqli_real_escape_string($conn,$_POST['t_id']);
    $totalcount = mysqli_real_escape_string($conn,$_POST['total']);
    $m_percent = mysqli_real_escape_string($conn,$_POST['m_percent']);
    $m_id = mysqli_real_escape_string($conn,$_POST['m_id']);
    $p_id = mysqli_real_escape_string($conn,$_POST['p_id']);
    $updated_response = $crud->update_task_status($t_id,$status,$conn);
   
        
       $per =  round((1/$totalcount)*100,2);
        echo $per;
       // $data =  $crud->calculate_percentage($conn);
        $per = round(($m_percent/100)*$per,2);
        
        $calculated_percent_m1 = ($m_percent-$per);     
           
        $crud->update_percentage_of_module($conn,$m_id,$calculated_percent_m1);
        $crud->update_percentage_of_project($conn,$p_id,$changes_percent_of_m1);
    echo $calculated_percent_m1;
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
                    <div class="show_msg"></div>
                   <table class="table">
                       <thead><tr><th>module_id</th><th>percentage_assign</th><th>submodule_id</th><th>Total count</th><th>status</th></tr></thead>
                        <tbody>
                       <?php 
                            $datassub = $crud->find_submodule_by_mid(1,$conn);
                            $sub_mod_count = count($datassub);
                            
                            $data = $crud->find_all_task_by_pms(1,1,2,$conn);
                           
                            $task_count = $crud->get_all_pms_count(1,1,2,$conn);
                            if($task_count >= 1)
                            {
                                $total = $task_count+$sub_mod_count;    
                            }
                            else
                            {
                                  $total = $sub_mod_count;
                            }
                              
                           
                           
                            echo "total count for module one:-".$total;
                            foreach($data as $key=> $value)
                            {  ?>
                                
                         <tr><form name="f1" method="post" action="<?PHP $_PHP_SELF; ?>"><td><?php echo $value['module_id'] ?></td><td><?php echo $value['percentage']; ?></td><td><?php echo $value['sub_mod_id']?></td><td><?php echo $task_count; ?></td>
                             <td>
                             <select name='task_status' id='task_status' data-tid=<?php echo $value['t_id'] ?> >
                               
                             <option value='1'>Pending</option>
                             <option value='2' <?php echo ($value['status'] == 'Approved') ? 'selected="selected"' : " " ?>>Approved</option></select>
                             </td><td>
                            <input type="hidden" name="p_id" value="<?php echo $value['p_id']; ?>">

                             <input type="hidden" name="total" value="<?php echo $total; ?>">
                             <input type="hidden" name="m_percent" value="<?php echo $value['percentage']; ?>">
                             <input type="hidden" name="m_id" value="<?php echo $value['module_id']; ?>">
                             <input type="hidden" name="t_id" value="<?php echo $value['t_id']; ?>"><input type="submit" value="change status" name="send_status"></td></form></tr>";
                            
                        <?php }
                        ?>
                       </tbody>
                    </table>
                </div>
            </div>
        </div>
    
</div>

<script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
        <script>
            
            /*
            $("#task_status").on('change',function(){
            
                var status = this.value;
                var t_id  = $(this).data('tid');
                var total = <?php echo $total; ?>         
                    $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'status='+status+'&t_id='+t_id+'&total='+total,    
                    datatype: "json",
                    success: function (data) {
                        $('.show_msg').html(data);
                        //$('.show_msg').html(data.msg);
                       // $('.show_msg').html(data.percentage);
                        
                        
                        
                        
                    }})                
                
            })
     */
        </script>    
</body>
</html>

    