<?php
include('config.php');
include('crud.php');
require 'PHPMailer-master/PHPMailerAutoload.php';

    $crud = new Crud();
 // 't_id='+t_id+'&status='+status+'&total='+total+'&m_percent='+m_percent+'&m_id='+m_id+'&pcalc='+p_id,    



if(!empty($_POST['task_id']) && !empty($_POST['stat']))
{
    $status = mysqli_real_escape_string($conn,$_POST['stat']);
    $t_id = mysqli_real_escape_string($conn,$_POST['task_id']);
    
     $updated_response = $crud->update_task_status($t_id,$status,$conn);
   echo $updated_response;
        
    
}

    
    // call after  status change 
if(!empty($_POST['status']) && !empty($_POST['t_id']) && !empty($_POST['total']) && !empty($_POST['t_percent']) && !empty($_POST['m_percent']) && !empty($_POST['s_percent']) && !empty($_POST['m_id'])  && !empty($_POST['s_id'])  && !empty($_POST['pcalc'])  && !empty($_POST['count']))
{
  
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $t_id = mysqli_real_escape_string($conn,$_POST['t_id']);
    $totalcount = mysqli_real_escape_string($conn,$_POST['total']);
    $task_percent = mysqli_real_escape_string($conn,$_POST['t_percent']);
    $m_percent = mysqli_real_escape_string($conn,$_POST['m_percent']);
    $s_percent = mysqli_real_escape_string($conn,$_POST['s_percent']);
    
    $m_id = mysqli_real_escape_string($conn,$_POST['m_id']);
    $s_id = mysqli_real_escape_string($conn,$_POST['s_id']);
    $p_id = mysqli_real_escape_string($conn,$_POST['pcalc']);
   


    if($status == '1')
    {
     $count = 1;
     $updated_response = $crud->update_task_status($t_id,$status,$conn);
    $crud->update_percentage_of_submodule($conn,$s_id,$s_percent,$t_percent,$status);
      $per =  round((1/$totalcount)*100,2);
        echo $per;
       // $data =  $crud->calculate_percentage($conn);
        $per = round(($m_percent/100)*$per,2);
        
        $calculated_percent_m1 = ($m_percent+$per);     
     

    $crud->update_percentage_of_module($conn,$m_id,$calculated_percent_m1);
    $crud->update_percentage_of_project($conn,$p_id,$changes_percent_of_m1);
    }else
    {
       $updated_response = $crud->update_task_status($t_id,$status,$conn);
        
       $per =  round((1/$totalcount)*100,2);
        echo $per;
       // $data =  $crud->calculate_percentage($conn);
        $per = round(($m_percent/100)*$per,2);
        
        $calculated_percent_m1 = ($m_percent-$per);     
           
        $crud->update_percentage_of_module($conn,$m_id,$calculated_percent_m1);
        $crud->update_percentage_of_submodule($conn,$s_id,$s_percent,$task_percent,$status);
        $crud->update_percentage_of_project($conn,$p_id,$changes_percent_of_m1);
    
    }
     
    echo $calculated_percent_m1;
        
    
    $response = array('msg'=>$updated_response,'percentage'=>$calculated_percent_m1);
    //header('Content-type: application/json');  
      //echo json_encode($response);
   
}



//onchange of task_percent excuted  after edit

if(!empty($_POST['t_sid']) && !empty($_POST['t_tid'])  && !empty($_POST['task_percent']))
{

        $tid =  mysqli_real_escape_string($conn,$_POST['t_tid']); 
        $tpercent = mysqli_real_escape_string($conn,$_POST['task_percent']);
        $t_sid  = mysqli_real_escape_string($conn,$_POST['t_sid']);
        echo $crud->update_task_percent($conn,$tid,$tpercent,$t_sid);


}


//project modal data

if(isset($_POST['get_all_project']))
{
    
    $project_data = $crud->get_all_project($conn);
       echo '<option value="0">select</option>';
        foreach($project_data as $key => $value)
        {       
       echo  '<option value="'.$value['p_id'].'" >'.$value['p_name'].'</option>';
        }
}
// project modal data
if(isset($_POST['get_all_modal']))
{
    $pid = $_POST['get_all_modal'];
    $project_data = $crud->find_module_by_pid($pid,$conn);
      if($project_data == '0')
        {
        echo '0';
        }
        else{
        echo '<option value="0">select</option>';   
        foreach($project_data as $key=>$value)
        {
            echo '<option value='.$value['module_id'].'>'.$value['module_name'].'</option>';

        }
     
      }
}

if(isset($_POST['get_all_submodal']))
{
    $mid = $_POST['get_all_submodal'];
    $project_data = $crud->find_submodule_by_mid($mid,$conn);
    
    if($project_data == '0')
        {
        echo '0';
        }
        else{
            echo '<option value="0">select</option>';   
            foreach($project_data as $key=>$value)
            {
                echo '<option value='.$value['submodule_id'].'>'.$value['submodule_name'].'</option>';

            }

        }
}


//module submodal submt


if(isset($_POST['submodule_modal']))
{
    $mid =      $_POST['mid'];
    $submname =     $_POST['submname'];
    $data = array('module_id'=>$mid,'submodule'=>$submname);
    
     $response_of_insert = $crud->insert_sub_module($data,$conn);
  
        $response = array('msg'=>$response_of_insert,'mid'=>$mid);
       header('Content-type: application/json');  
      echo json_encode($response);
    
}

//module modal submit

if(isset($_POST['module_modal']))
{
    $pname = $_POST['pname'];
    $mname = $_POST['mname'];
    $data = array('pname'=>$pname,'mname'=>$mname);
    
    $response_of_insert = $crud->insert_module($data,$conn);
  
    $response = array('msg'=>$response_of_insert,'pid'=>$pname);
    
 header('Content-type: application/json');
    echo json_encode($response);
}


//project  modal submit
if(isset($_POST['project_modal']))
{
    $pname = $_POST['pname'];
    $sdesc = $_POST['sdesc'];
    $project_manager = $_POST['project_manager'];
    $data = array();
    $data = array('project_mgr_id'=>$project_manager,'name'=>$pname,'sdesc'=>$sdesc);
  
    $response_of_insert = $crud->insert_project($data,$conn);
    $project_data = $crud->get_all_project($conn);
    
        $store = "";
        
      
        $store .= '<option value="0">select</option>';
        foreach($project_data as $key => $value)
        {       
        $store .= '<option value="'.$value['p_id'].'" >'.$value['p_name'].'</option>';
        }
       
    $response = array('msg'=>$response_of_insert,'res'=>$store);
        
    header('Content-type: application/json');
echo json_encode( $response );
}

if(isset($_POST['pr_id']))
{
    
     $p_id = $_POST['pr_id'];
   
    $data = $crud->find_module_by_pid($p_id,$conn);
    if($data == '0')
    {
        echo '0';
    }else{
      echo '<option value="0">select</option>';   
    foreach($data as $key=>$value)
    {
        echo '<option value="'.$value['module_id'].'">'.$value['module_name'].'</option>';
        
    }
       
    }
}

if(!empty($_POST['p_id_for_per']))
{
    
    $p_id = mysqli_real_escape_string($conn,$_POST['p_id_for_per']);
    $data = $crud->find_module_by_pid($p_id,$conn);
       
        $result = 0.00;
    if($data == 0)           //if no module for percent than maunally assign 100
    {
        echo  100.00;
    }else{
        
        foreach($data as $key => $value)
        {
            $result = $result + $value['percent'];
            
        }
        $remain_percent = 100.00-$result;
        echo $remain_percent;
    }
}


if(isset($_POST['module_id']))
{
    
     $module_id = $_POST['module_id'];
    
    $data = $crud->find_submodule_by_mid($module_id,$conn);
    if($data == '0')
    {
        echo '0';
    }else{
         echo '<option value="0">select</option>';   
    foreach($data as $key=>$value)
    {
        echo '<option value='.$value['submodule_id'].' >'.$value['submodule_name'].'</option>';
        
    }
       
    }
}


if(isset($_POST['pp_id']))
{
    $p_id = $_POST['pp_id'];
    
    $data = $crud->find_module_by_pid($p_id,$conn);
     
    echo '<table class="table ">';
    echo  '<thead>';
     echo  '<th>Module ID</th><th>Module Name</th>';
       echo  '</thead>';
        echo    '<tbody>';
    if($data == '0')
    {
            echo '<tr><td colspan="2" style="text-align:center;">No Module for this Project</td></tr>';
    }else
    {
        foreach($data as $key=>$value)
        {
        echo '<tr><td>'.$value['module_id'].'</td><td><a href="javascript:void(0)" onclick="call_module_ajax('.$p_id.','.$value['module_id'].')">'.$value['module_name'].'</a></td></tr>';
        }   
    
    }
    
    echo     '</tbody>';
        echo '</table>';
    
    
}

if(isset($_POST['p_id']))
{
    $id = $_POST['p_id'];
     $data =  $crud->view_project_wise($id,$conn);  // get all task from project id;
      
    $value = count($data[$id]);   // count the number of element inside key;
    foreach($data as $key=>$value1)
    {
        echo '<h2>'.$value1[$id]['module_name'].'</h2>';
    }   
    
    echo '<table class="table ">';
    echo  '<thead>';
     echo  '<th>SubModule Name</th><th>Task Name</th><th>Asign To</th><th>DeadLine</th><th>Created At</th>';
       echo  '</thead>';
        echo    '<tbody>';
    for($i=1; $i<=$value; $i++)
    {
      //  echo $data[$id][$i]['task_name'].'<br>';
        echo '<tr><td>'.$data[$id][$i]['submodule_name'].'</td><td>'.$data[$id][$i]['task_name'].'</td><td>'.$data[$id][$i]['task_assign_to'].'</td><td>'.$data[$id][$i]['created_at'].'</td><td>'.$data[$id][$i]['deadline'].'</td></tr>';
    }

    echo     '</tbody>';
        echo '</table>';
    
    
}

// fectch module    
if(!empty($_POST['project_id']) && !empty($_POST['m_id']))
{
    $p_id  =  $_POST['project_id'];
    $m_id = $_POST['m_id'];
    
    
    $total_count = $crud->get_all_task_count_by_module_and_project($p_id,$m_id,$conn);
    
    $module_row = $crud->find_module_id($m_id,$conn);
    echo '<h2>'.$module_row['module_name'].'</h2>';
    echo '<table class="table" id="'.$module_row['module_name'].'">';
   echo  '<thead>';
     echo  '<th>SubModule Name</th>';
        echo '<th>Status</th>';
        echo '<th>Action</th>';
       echo  '</thead>';
   
        echo    '<tbody>';
    $s_id = $crud->find_submodule_by_mid($m_id,$conn);
    if($s_id == '0')
    {       
            
            echo '<tr><td colspan="5" style="text-align:center;">No SubModule for this Project</td></tr>';
        
            $pmdata = $crud->find_all_task_by_pm($p_id,$m_id,$conn);
       
            if($pmdata == '0')
            {
                echo '<tr><td colspan="2" style="text-align:center;">No tasks for this module</td></tr>';
            }else
                {   
            
                    foreach($pmdata as $key=>$value)
                    {
                    
                        echo '<tr><form name="f1" method="post" action="project_completed.php"><td>'.$value['module_name'].'</td><td>'.$value['task_name'].'</td><td>'.$value['task_assign_to'].'</td><td>'.$value['created_at'].'</td><td>'.$value['deadline'].'</td><td><a href="add_task.php?tedit_id='.$value['t_id'].'">Edit</a></td>';
                        echo '<td>';
                        echo '<select name="task_status" id="task_status" ><option value="1">Pending</option>';
                        echo '<option value="2"', ($value['status'] == '2') ? 'selected':'' ,'>Approved</option>';
                        echo '</select>
                        </td><td><input type="submit" value="change status" onclick="project_completed('.$value['t_id'].','.$total_count.','.$value['percentage'].','.$value['module_id'].'
                    ,'.$value['p_id'].')"></td></form></tr>';
                    }
                }
    }
    else
    {
        foreach($s_id as $key=>$value)
        {    
        
        echo '<tr><td><a href="#" onclick="call_for_submodule_task('.$p_id.','.$m_id.','.$value['submodule_id'].')">'.$value['submodule_name'].'</a></td></tr>';
                
        }
            
    }
         echo '</tbody>';
    
 }
    
    
if(!empty($_POST['project_id']) && !empty($_POST['m_id'] && !empty($_POST['sub_mod_id'])))
{
    $p_id  =  $_POST['project_id'];
    $m_id = $_POST['m_id'];
    $sub_mod_id = $_POST['sub_mod_id'];
    
    
  
    
    $total_count = $crud->get_all_task_count_by_module_and_project($p_id,$m_id,$conn);
    
   
   
    
     $data = $crud->find_all_task_by_pms($p_id,$m_id,$sub_mod_id,$conn);

    
     echo '<table class="table">';
   echo  '<thead>';
     echo  '<th>SubModule Name</th><th>Task Name</th><th>Asign To</th><th>DeadLine</th><th>Created At</th><th>ACtion</th><th>Status</th>';
       echo  '</thead>';
   
        echo    '<tbody>';
        
            if($data == '0')
            {
                echo '<tr><td colspan="2" style="text-align:center;">No tasks for this Project</td></tr>';
            }else
                {   
            $selected = 'selected="selected"';
                foreach($data as $key=>$value)
                {
                    echo '<tr><form name="f1" method="post" action="project_completed.php"><td>'.$value['submodule_name'].'</td><td>'.$value['task_name'].'</td><td>'.$value['task_assign_to'].'</td><td>'.$value['created_at'].'</td><td>'.$value['deadline'].'</td><td><a href="add_task.php?tedit_id='.$value['t_id'].'">Edit</a></td>
                    <td>';
                    echo '<select name="task_status" id="task_status" ><option value="1">Pending</option>';
                    echo '<option value="2"', ($value['status'] == '2') ? 'selected':'' ,'>Approved</option>';
                    echo '</select>
                    <input type="submit" value="change status" name="send_status" onclick="project_completed('.$value['t_id'].','.$total_count.','.$value['task_percent'].','.$value['percentage'].','.$value['submodule_percent'].','.$value['module_id'].'
                    ,'.$value['sub_mod_id'].','.$value['p_id'].')">
                    </td>';
                    echo '</form>
                    </tr>';
                }
            }
     echo '</tbody>';
}
 


if(isset($_POST['id']))
{
  $timestamp = date("Y-m-d H:i:s");
    $role = $_POST['role'];
    
    $status = $_POST['stat'];
    $id = $_POST['id'];

  
    /*$data = $crud->find_userdetail_id($id,$conn);

   
            if($data['role_assign'] == '1')
            {
                $role = 'Admin';
            }
            if($data['role_assign'] == '2')
            {
                $role = 'Project Manager';
            }
            if($data['role_assign'] == '3')
            {
                $role = 'Project Developer';
            }*/
    $sql = "update user_details set status ='".$status."',role_assign = '".$role."',modified_at = '".$timestamp."' where id='".$id."' ";
    if(mysqli_query($conn,$sql))
    {
        //PHPMailer Object
            $mail = new PHPMailer;
            //Enable SMTP debugging. 
            $mail->SMTPDebug = 3;                               
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();            
            //Set SMTP host name                          
            $mail->Host = "smtp.gmail.com";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;                          
            //Provide username and password     
            $mail->Username = "palvivek92@gmail.com";                 
            $mail->Password = "vivek@#5408";                           
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";                           
            //Set TCP port to connect to 
            $mail->Port = 587;                                   
            
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //From email address and name
            $mail->From = "palvivek92@gmail.com";
            $mail->FromName = "Vivek Pal";

            //To address and name
            $mail->addAddress($data['email_id'], "Recepient Name");
            //$mail->addAddress("recepient1@example.com"); //Recipient name is optional

            //Address to which recipient will reply
            $mail->addReplyTo("reply@yourdomain.com", "Reply");

            //CC and BCC
            $mail->addCC("cc@example.com");
            $mail->addBCC("bcc@example.com");

            //Send HTML or Plain Text email
            $mail->isHTML(true);

            $mail->Subject = "Changes in Role";
            $mail->Body = "<i>Your Role is {$role}</i>";
            $mail->AltBody = "This is the plain text version for non HTML email Content";

            if(!$mail->send()) 
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } 
            else 
            {
                echo "Message has been sent successfully";
            }    
        
    }else
        echo mysqli_error($conn);
}




?>

