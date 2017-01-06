<?php 
include('config.php');
include('crud.php');
$crud = new Crud();
$project_data = $crud->get_all_project($conn); // get project name

$module_data = $crud->get_module_list($conn);
$error = array();
$project_developer = $crud->get_project_developer_nd_mgr($conn);
$project_manager = $crud->get_project_manager($conn); // to display in dropdown
 if(isset($_POST['save']))
    {
      
        $project_name = mysqli_real_escape_string($conn,$_POST['pname']);
        $module_name = mysqli_real_escape_string($conn,$_POST['modulename']);
        $submodule_name = mysqli_real_escape_string($conn,$_POST['submodule']);
        $task_name      =  mysqli_real_escape_string($conn,$_POST['task_name']);
        $task_type  = mysqli_real_escape_string($conn,$_POST['tasktype']);
        $task_assign_to = mysqli_real_escape_string($conn,$_POST['task_assign']);
        $date = mysqli_real_escape_string($conn,$_POST['deadline']);
        $taskpercent = mysqli_real_escape_string($conn,$_POST['taskpercent']);
        //$submodule_present = 'Y';
        
            if($submodule_name == 0)
            {
               
                $submodule_name = 1;
          
            }
     
        $data= array('pname'=>$project_name,'module_name'=>$module_name,'submodule'=>$submodule_name,'task_name'=>$task_name,'task_type'=>$task_type
                    ,'task_assign_to'=>$task_assign_to,'date'=>$date,'taskpercent'=>$taskpercent);
       
        if(isset($_GET['tedit_id']))
        {     
            $id = mysqli_real_escape_string($conn,$_GET['tedit_id']);
             
            if($submodule_name == 1)
            {     


                  $sum_percent = $crud->getpm_taskpercent_sum($conn,$project_name,$module_name,$id); 
                    $totalpercent = $taskpercent+$sum_percent;
                
                  if($totalpercent <=  (int)100.00)
                  {
                      $crud->update_task($data,$conn,$id);  
                      $crud->update_submodule_percent($conn,$submodule_name,$totalpercent);
                  }else
                    {
                      $error[] = "please assign percent less than current assign";
                    }

            }else{

                
               
                 
                  $sum_percent  = $crud->getpms_taskpercent_sum($conn,$project_name,$module_name,$submodule_name,$id);
                  $totalpercent = $taskpercent+$sum_percent;
                  
                  if($totalpercent <=  (int)100.00)
                  {
                     $crud->update_task($data,$conn,$id);  
                     $crud->update_submodule_percent($conn,$submodule_name,$totalpercent);

                  }else
                    {
                      $error[] = "please assign percent less than current assign ";
                    }
              
            }
              



        }else
        {
            
            if($submodule_name == 1)
            {
                  $sum_percent = $crud->getpm_taskpercent_sum($conn,$project_name,$module_name,0); 
                   $totalpercent = $taskpercent+$sum_percent;
                  if($totalpercent <=  100.00)
                  {
                      $crud->insert_task($data,$conn);
                      $crud->update_submodule_percent($conn,$submodule_name,$totalpercent);

                  }else
                    $error[] = "You can not add task ";

            }else{

                  $sum_percent  = $crud->getpms_taskpercent_sum($conn,$project_name,$module_name,$submodule_name,0);
                  $totalpercent = $taskpercent+$sum_percent;
                  if($totalpercent <=  100.00)
                  {
                      $crud->insert_task($data,$conn);
                      $crud->update_submodule_percent($conn,$submodule_name,$totalpercent);
                  }else
                    $error[] = "You can not add task ";
              
            }
           

            
        }
       
         
    }


if(isset($_GET['tedit_id']))
{
 $t_id = mysqli_real_escape_string($conn,$_GET['tedit_id']);
  
    
    $result = $crud->find_task_by_id($t_id,$conn);
   
   // $t_id =  $result['t_id'];
    
    $p_id = $result['p_id'];
    
    
    
    $m_id =  $result['module_id'];
    
    $s_m_id = $result['submodule_id'];
    $task_name =  $result['task_name'];
    
    $task_type = $result['task_type'];
    
    $task_assig_to =  $result['task_assign_to'];
    
    $deadline = $result['deadline'];

    $taskpercent = $result['task_percent'];

    $module_data = $crud->find_module_by_pid($p_id,$conn); // get module name;
    $submodule_data = $crud->find_submodule_by_mid($m_id,$conn); //get submodule name;
    
    
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
    <link href="css/jquery-ui.min.css" rel="stylesheet">
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
                    <?php echo (isset($t_id)) ? "<h2>Update Task Detail</h2>":"<h2>Add Tasks</h2>" ?>
                    <div class="col-lg-12">
                        <?php if(count($error) > 0) {  if(isset($t_id)) { ?>
                        <div class="alert alert-danger">
                         <strong>Error!</strong><?php echo $error[0]; ?>.</div> 
                         <?php } else { ?>
                          <div class="alert alert-danger">
                         <strong>Error!</strong><?php echo $error[0]; ?>.</div> 
                         <?php } }?>
                    <form name="f1" method="post" action="<?PHP $_PHP_SELF ?>">
                        
                        <div class="form-group">

                            <label for="name">Select Project to assign :</label>
                        <a  href="#" id="add_p_m" class="btn btn-info btn-md" data-toggle="modal" data-target="#project_modal">Add New Project</a>
                               
                            <select class="form-control" name="pname" id="p_name" >
                                <option value="0">select</option>
                                <?php foreach($project_data as $key => $value) {?>
                                <option value='<?php echo $value['p_id']; ?>' <?php echo (@$p_id == $value['p_id']) ? 'selected="selected"' : " " ?>><?php echo $value['p_name']; ?></option>
                                <?php } ?>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="name">Select Module </label>
                        <a  href="#" id="add_m" class="btn btn-info btn-md" data-toggle="modal" data-target="#module_modal">Add New Module</a>
                             <select class="form-control" name="modulename" id="modulename">
                                <option value="0">select</option>
                                <?php if(isset($t_id)) {   foreach($module_data as $key=> $value) { ?>
                                 <option value="<?php echo $value['module_id']?>" <?php echo (@$m_id == $value['module_id']) ? 'selected="selected"' : " " ?>><?php echo $value['module_name'];?></option>
                                 <?php }} ?>
                            </select>
                        </div>
                          
                       <div class="form-group">
                            <label>Sub Module:</label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio" id="yes" > YES
                            </label>
                            <label class="radio-inline">
                              <input type="radio" name="optradio" id="no">NO
                            </label>
                        </div>
                        
                        <div class="form-group sub_module" style="display:none">
                            <label for="name">Select Sub Module </label>
                     <a  href="#" id="add_s_m" class="btn btn-info btn-md" data-toggle="modal" data-target="#submodule_modal">Add New SubModule</a>

                             <select class="form-control" name="submodule" id="submodule">
                                <option value="0">select</option>
                                <?php if(isset($t_id)) {   foreach($submodule_data as $key=> $value) { ?>
                                 <option value="<?php echo $value['submodule_id']?>" <?php echo (@$s_m_id == $value['submodule_id']) ? 'selected="selected"' : " " ?>><?php echo $value['submodule_name'];?></option>
                                 <?php }} ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Task Name:</label>
                            <input type="text" name="task_name" id="task_name" class="form-control" value="<?php echo @$task_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Task Type: </label>
                             <select class="form-control" name="tasktype" id="tasktype">
                                <option value="0">select</option>
                                <option value="Backend" <?php echo (@$task_type == 'Backend') ? 'selected="selected"':" "?>>Backend</option>
                                <option value="UI" <?php echo (@$task_type == 'UI') ? 'selected="selected"':" "?>>UI</option>
                                <option value="UX" <?php echo (@$task_type == 'UX') ? 'selected="selected"':" "?>>UX</option>
                                 <option value="DB" <?php echo (@$task_type == 'DB') ? 'selected="selected"':" "?>>DB</option>
                            
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="name">Task Assign To: </label>
                             <select class="form-control" name="task_assign" id="task_assign">
                                <option value="0">select</option>
                                <?php foreach($project_developer as $key => $value) { ?>
                                 <option value="<?php echo @$value['u_id']?>" <?php echo (@$task_assig_to == @$value['u_id']) ? 'selected="selected"': ""?>><?php echo @$value['full_name'];?></option>
                                 <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="name">DeadLine:</label>
                           
            
                            <input type="text" name="deadline" id="deadline" class="form-control" placeholder="yyyy/mm/dd" value="<?php echo @$deadline; ?>" >
                        </div>
                        
                         <div class="form-group">
                            <label for="taskpercent">Task Percent :</label>
                              <select class="form-control" name="taskpercent" id="taskpercent">
                                <option value="0">select</option>
                                 <option value="10" <?php echo ($taskpercent == "10.00") ? 'selected="selected"' : " " ?>>10</option>
                                 <option value="20"  <?php echo ($taskpercent == "20.00") ? 'selected="selected"' : " " ?>>20</option>
                                 <option value="30"  <?php echo ($taskpercent == "30.00") ? 'selected="selected"' : " " ?>>30</option>
                                 <option value="40"  <?php echo ($taskpercent == "40.00") ? 'selected="selected"' : " "?>>40</option>
                                <option value="50"  <?php echo ($taskpercent == "50.00") ? 'selected="selected"' : " "?>>50</option>
                                 <option value="60"  <?php echo ($taskpercent == "60.00") ? 'selected="selected"' : " " ?>>60</option>
                                <option value="70"  <?php echo ($taskpercent == "70.00") ? 'selected="selected"'  : " "?>>70</option>
                                 <option value="80"  <?php echo ($taskpercent == "80.00") ? 'selected="selected"' : " " ?>>80</option>
                                  <option value="90"  <?php echo ($taskpercent == "90.00") ? 'selected="selected"' : " " ?>>90</option>
                                 <option value="100"  <?php echo ($taskpercent == "100.00") ? 'selected="selected"' : " " ?>>100</option>

                            </select>  
                            
                           
                        </div>
                        
                         <input type ="hidden" name="save" value="0">
                        <input type="submit" name="send" class="form-control btn btn-primary" onclick="return validation()">
                    </form>
                    </div>
                </div>
            </div>
        </div>    
</div>
        
        
<?php include('modal.php'); ?>        
        
        
          <!-- jQuery -->
    <script src="js/jquery.js"></script>
  <script src="js/jquery-ui.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
       
    <?php include 'validation.php'; ?>    
       
    <script type="text/javascript">
      
        //on click of edit task data loaded on modal 
      <?php if(isset($_GET['tedit_id'])) 
        {  ?>
        var pid = '<?php echo $p_id; ?>';
        var mid = '<?php echo $m_id; ?>';
        
     $('#mpname option[value='+pid+']').attr("selected", "selected");  
     $('#module_name option[value='+mid+']').attr("selected", "selected"); 
      /*  
    $("#taskpercent").on("change",function(){
 

       
        var t_sid = '<?php echo $s_m_id; ?>';
        var t_tid = '<?php echo $t_id; ?>';

        var task_percent = $("#taskpercent option:selected" ).text();
              $.ajax({
            url: 'ajax_function.php',
            type: "POST",
            data: 't_sid='+t_sid+'&t_tid='+t_tid+'&task_percent='+task_percent,
            datatype: "json",
            success: function(data) {
              alert(data);
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });*/

    })
      
        
    <?php  } ?>
        // for projectmodal 
        
        $("#submitprojectForm").on('click', function() {
            if(project_validation()){
               
                $("#project_form").submit();        
            }
        
        });  //change modal header on click
       $("#add_p_m").click(function(){
            
            $('#project_modal .modal-header .modal-title').html("<div class='message success'>Add New Project</div>");  
        });
        
        
        $("#project_form").on("submit", function(e) {
           
        var pname = $('#pname').val();
        
        var sdesc = $('#sdesc').val();
            
        var pm = $('#projectm').val();
            
        var project_modal = 0;   
           
        $.ajax({
            url: 'ajax_function.php',
            type: "POST",
            data: 'project_modal='+project_modal+'&pname='+pname+'&sdesc='+sdesc+'&project_manager='+pm,
            datatype: "json",
            success: function(data) {
                $('#project_modal .modal-header .modal-title').html(data.msg);
              
                 $("#p_name option").remove();  
                $('#p_name').append(data.res);
                load_project_on_modal_submit();
                setTimeout(function(){
                
                $('#project_modal').modal('hide');                
            }, 2000);  

                 $("#project_form")[0].reset();
               // $('#project_modal .modal-body').html(data);
              
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });
        //close of project modal
        
        //for module modal
        
        $("#add_m").click(function(){
              $('#module_modal .modal-header .modal-title').html("Add New Module");
              
        })
        
        $("#submitmodalForm").on('click',function(){
            if(module_validation()){
               
                $("#module_form").submit();        
            }
        });
        
         $("#module_form").on("submit", function(e) {
             
             var pname = $('#mpname').val();
        
             var mname = $('#mname').val();
            
             var module_modal = 0;   
             
              $.ajax({
            url: 'ajax_function.php',
            type: "POST",
            data: 'module_modal='+module_modal+'&pname='+pname+'&mname='+mname,
            datatype: "json",
            success: function(data) {
               
                $('#module_modal .modal-header .modal-title').html(data.msg);
               
                var selected_id = $("#p_name option:selected").val();
              
                if(selected_id == data.pid){
                    load_module_on_modal_submit(data.pid);                
                }  // check for selected option of project than only load that select option value
                setTimeout(function(){
                
                $('#module_modal').modal('hide');                
            }, 2000);  

                 $("#module_form")[0].reset();
               // $('#project_modal .modal-body').html(data);
              
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });
        
        // for submodule modal
         $("#add_s_m").click(function(){
              $('#submodule_modal .modal-header .modal-title').html("Add New SubModule");
              
        })
        
        $("#submitsubmodalForm").on('click',function(){
            if(sub_module_validation()){
               
                $("#submodule_form").submit();        
            }
        });
        
         $("#submodule_form").on("submit", function(e) {
             
             var mid = $('#module_name').val();
        
             var submname = $('#sub_module').val();
            
             var submodule_modal = 0;   
          
              $.ajax({
            url: 'ajax_function.php',
            type: "POST",
            data: 'submodule_modal='+submodule_modal+'&mid='+mid+'&submname='+submname,
            datatype: "json",
            success: function(data) {
               
                $('#submodule_modal .modal-header .modal-title').html(data.msg);
               
                var selected_id = $("#modulename option:selected").val();
               
                if(selected_id == data.mid){
                    load_submodule_on_modal_submit(data.mid);                
                }  // check for selected option of project than only load that select option value
                setTimeout(function(){
                
                $('#submodule_modal').modal('hide');                
            }, 2000);  

                 $("#submodule_form")[0].reset();
               // $('#project_modal .modal-body').html(data);
              
            },
            error: function(jqXHR, status, error) {
                console.log(status + ": " + error);
            }
        });
        e.preventDefault();
    });
        
        
        <?php if(isset($_GET['tedit_id'])) { if($s_m_id == 1) { ?>
        $('#no').trigger('click');
             
        <?php } else { ?>
             $('#yes').trigger('click');
            $('.sub_module').css('display','');
           
        <?php } }?>
         var flag='';
       
        $('#yes').on('click',function(){
            $('.sub_module').css('display','');
            flag = true;
            add_option_on_yes();
        })
        $('#no').on('click',function(){
            $('.sub_module').css('display','none');
            remove_option_on_no();
            flag =false;
        })
        
        $('#deadline').datepicker({
            
           dateFormat: 'yy-mm-dd',
            minDate: 0
            
        });
    
        
       $("#p_name").on('change',function(){
           
          
           var id = $(this).val();
           alert(id);
            if(id!= 0)
               {        
                    $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'pr_id='+id,    
                    datatype: "json",
                    success: function (data) {
                          alert(data);
                        if(data == 0)
                        {
                           var selectList = $("#modulename");
            //selectList.find('option').not(':first').remove();
               selectList.find("option:gt(0)").remove();
                          
                        $('#mpname option[value='+id+']').attr("selected", "selected");    
                        }else{
                            
                             $('#modulename').html(data);
                           var value  = $('#modulename').find('option').eq(1).val();
                           on_load_of_module(value); //get submodule of selected module
                           $('#mpname option[value='+id+']').attr("selected", "selected");   // project is selected inside modal
                            
                        }
                       
                    
                    }})
                        
                  
               
                
            } })
       
       // this function executed after submit of new project  under modal
       function load_project_on_modal_submit()
        {
            var test = 0;
             $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'get_all_project='+test,    
                   
                    success: function (data) {
                       $("#mpname option").remove();
                       $("#mpname").html(data);
                    
                    }})
        }
        
        // this function excuted after submit of new module  under modal
        function load_module_on_modal_submit(id){
           
             $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'get_all_modal='+id,    
                   
                    success: function (data) {
                        
                        
                        if(data == 0)
                            {
                                
                            }
                        else{
                            $("#modulename option").remove();
                            $("#modulename").html(data);
        
                        }
                                        
                    }})
        }
        
        // this function excuted after submit of new submodule under modal
        function load_submodule_on_modal_submit(id)
        {
             $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'get_all_submodal='+id,    
                   
                    success: function (data) {
                        
                        
                        if(data == 0)
                            {
                                
                            }
                        else{
                            $("#submodule option").remove();
                            $("#submodule").html(data);
        
                        }
                                        
                    }})
            
        }
       // get first module_id
       function on_load_of_module(id)
        {
             $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'module_id='+id,    
                    datatype: "json",
                    success: function (data) {
                      
                        if(data == 0)
                        {
                            
                         //
                        //alert($("#pname").find('option').eq(1).val());       
                        }else{
                            
                             $('#submodule').html(data);
                        }
                       
                    
                    }})
        }
        
        function remove_option_on_no()
        {
            var selectList = $("#submodule");
            //selectList.find('option').not(':first').remove();
               selectList.find("option:gt(0)").remove();
        }
        
        function add_option_on_yes()
        {
            var select_id = $("#modulename option:selected").val();
              $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'module_id='+select_id,    
                    datatype: "json",
                    success: function (data) {
                        
                        if(data == 0)
                        {
                                     
                        }else{
                            
                             $('#submodule').html(data);
                        }
                       
                    
                    }})
                       
        }
        
        $("#modulename").on('change',function(){
              var id = $(this).val();
            
              if(id >= 0)
               {        
                    $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'module_id='+id,    
                    datatype: "json",
                    success: function (data) {
                        
                        if(data == 0)
                        {
                    var selectList = $("#submodule");
                     selectList.find("option:gt(0)").remove();
                     $('#module_name option[value='+id+']').attr("selected", "selected");  //make option selected inside modal after selecting form modulename
                                     
                        }else{
                            
                             $('#submodule').html(data);
                             $('#module_name option[value='+id+']').attr("selected", "selected");  //make option selected inside modal after selecting form modulename
                            
                        }
                       
                    
                    }})
               }
        })
        
        function validation()
        {
            
            var reg=  /^(\d{4})-(\d{1,2})-(\d{1,2})$/;
           
            var pname = $('#p_name').val();
            var mname = $('#modulename').val();
            var submodule = $('#submodule').val();
            var task_name = $('#task_name').val();
            var date = $('#deadline').val();
            var taskpercent = $('#taskpercent').val();
            
             if(pname == '0')
                {
                    alert('please select project name');
                    $('#p_name').focus();
                    
                    return false;
                }       
           
           
            if(mname == '0')
                {
                    alert('please select Module name');
                    $('#modulename').focus();
                    return false;
                }
            
            if (!$("input[name='optradio']").is(':checked')) {
                alert('please check your option for subModule!');
                return false;
                }
            
           if(flag == true)
            {
               
                if(submodule == '0')
                    {
                    alert('please select SubModule name');
                    $('#submodule').focus();
                    return false;   
                    }
            }
            
            if(task_name == '')
            {
                alert("please enter task name");
                $('#task_name').focus();
                return false;
            }
            
            
            if(taskpercent == '0')
            {
            alert("please enter task percent");
            $('#taskpercent').focus();
            return false;
            }
  
        }
    </script>
    </body>
</html>
