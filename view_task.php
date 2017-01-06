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
        <script type="text/javascript" src="js/jquery.cookie.js"></script>>
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

            function getvalue(val)
            {
               var value = val.value;
               
               $.cookie('tas',value);
            }
        
           function project_completed(t_id,t_percent,m_percent,s_percent,m_id,s_id,p_id,status)
            {
                   var onchange =  $.cookie('tas');
                  
                    alert(onchange);
                    alert('t_id'+t_id);
                    alert('status'+status);
                    alert('t_percent'+t_percent);
                    alert('m_percent'+m_percent);
                    alert('s_percent'+s_percent);
                     alert('s_id'+s_id);
                     alert('m_id'+m_id);              
                 //var selected_id = $("#task_status option:selected").val();
               if(s_id == 1)      //check task is from module 
               {
                var s_percent = 1.00;
               }
               
               if(status == onchange)  
                {
                    alert("mathch");
                }
                else{

                    if(status == 0)  // executed after delete task button click
                    {
                        var r = confirm("Are you sure want to delete");
                      
                            if(r)
                            {
                                $.ajax ({
                                type: 'POST',        
                                url: 'ajax_function.php',
                                data: 't_id='+t_id+'&status='+onchange+'&t_percent='+t_percent+'&m_percent='+m_percent+'&s_percent='+s_percent+'&m_id='+m_id+'&s_id='+s_id+'&pcalc='+p_id,    
                                datatype: "json",
                                success: function (data) {
                                    alert(data); 
                                   // window.location.reload();
                                 }})
                            }
                    }else{
                    $.ajax ({
                    type: 'POST',        
                    url: 'ajax_function.php',
                    data: 't_id='+t_id+'&status='+onchange+'&t_percent='+t_percent+'&m_percent='+m_percent+'&s_percent='+s_percent+'&m_id='+m_id+'&s_id='+s_id+'&pcalc='+p_id,    
                    //datatype: "json",
                    success: function (data) {
                        alert(data); 
                       // window.location.reload();


                        
                        
                    }})
                    }                
                
                }   
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