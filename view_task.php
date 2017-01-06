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
                <?php  $data = $crud->get_all_project($conn); ?>
                  <table class="table">
                    <thead>
                        <th>Project Name</th>
                    </thead>
                    <tbody>
                        <?php foreach($data as $key=> $value) { ?>
                        <tr><td><a href="javascript:void(0)" onclick="call_ajax(<?php echo $value['p_id'];?>)"><?php echo $value['p_name']; ?></a></td>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <div class="show_table">
                    
                </div>
                
            </div>
        </div>
        </div>
        <!-- /#page-content-wrapper -->

  
    
     
       <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>      
      
        <script type="text/javascript">
        
    
            function call_module_ajax(project_id,module_id)
            {   
                var p_id = project_id;
                var m_id = module_id;
          
                  
                    $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'project_id='+p_id+'&m_id='+m_id,    
                    datatype: "json",
                    success: function (data) {
                        $('.show_table').html(data);
                    
                    }})
                        
                           
            }
            
            
            function call_for_submodule_task(pid,mid,sid)
            {
                
            $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'project_id='+pid+'&m_id='+mid+'&sub_mod_id='+sid,    
                    datatype: "json",
                    success: function (data) {
                        
                        if(data == 0)
                        {
                                     
                        }else{
                            
                             $('.show_table').html(data);
                        }
                       
                    
                    }})
        
            }
    
</script>
        
        <script type="text/javascript">
              
            
            function call_ajax(id)
            {   
               var pp_id = id;
                   
                    $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'pp_id='+pp_id,    
                    datatype: "json",
                    success: function (data) {
                        $('.show_table').html(data);
                    
                    }})
                        
                  
               
                
            }
            
            
           function project_completed(t_id,total,t_percent,m_percent,s_percent,m_id,s_id,p_id,count)
            {
                
                    alert(t_id);
                                    alert(status);                    alert("total"+total);
                                    alert("task_per"+t_percent); 
                 var selected_id = $("#task_status option:selected").val();
               
               if(total == '0')
                {
                    update_task_status(t_id,selected_id);
                }
                else{
                 $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 't_id='+t_id+'&status='+selected_id+'&total='+total+'&t_percent='+t_percent+'&m_percent='+m_percent+'&s_percent='+s_percent+'&m_id='+m_id+'&s_id='+s_id+'&pcalc='+p_id+'&count='+count,    
                    //datatype: "json",
                    success: function (data) {
                        alert(data); 
                        window.location.reload();


                        //$('.show_msg').html(data.msg);
                       // $('.show_msg').html(data.percentage);
                        
                        
                        
                        
                    }})                
                
                }   
            }
            
            
            function update_task_status(t_id,status)
            {
                 $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'task_id='+t_id+'&stat='+status,    
                   
                    success: function (data) {
                          alert(data);
                          alert("Updated succefully");  
                       // $('.show_msg').html(data.percentage);
                        
                        
                        
                        
                    }})             
            }
                 
          /*  function call_ajax(id)
            {   
               var p_id = id;
               
                
              
                   
                    $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 'p_id='+id,    
                    datatype: "json",
                    success: function (data) {
                        $('.show_table').html(data);
                    
                    }})
                        
                  
               
                
            }*/
            
        </script>
       
           
    </body>
</html>