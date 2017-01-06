<?php


class Crud
{
    
    
    
    
    
    
    public function insert_module($data,$conn)
    {
         $sql = "insert into module(p_id,module_name,percent_remain_to_complete) values('".$data['pname']."','".$data['mname']."','".$data['module_percent']."')";
        
        if(mysqli_query($conn,$sql))
        {
            return '<div class="alert alert-success">
            <strong>Success!</strong>Inserted succefully.</div>';
        }else
            echo "Eror".mysqli_error($conn);
    }
    
    public function insert_sub_module($data,$conn)
    {
         $sql = "insert into sub_module(module_id,sub_module_name,submodule_percent) values('".$data['module_id']."','".$data['submodule']."','".$data['submodule_percent']."')";
        
        if(mysqli_query($conn,$sql))
        {
            return '<div class="alert alert-success">
            <strong>Success!</strong>Inserted succefully.</div>';
        }else
            echo "Eror".mysqli_error($conn);
    }
    
    public function insert_task($data,$conn)
    {
        $timestamp = date("Y-m-d H:i:s");
        
      $sql = "insert into task(p_id,module_id,submodule_id,task_name,task_type,task_assign_to,deadline,created_at,task_percent) values('".$data['pname']."','".$data['module_name']."','".$data['submodule']."','".$data['task_name']."','".$data['task_type']."','".$data['task_assign_to']."','".$data['date']."','".$timestamp."','".$data['taskpercent']."')";
     
        if(mysqli_query($conn,$sql))
        {
        echo '<div class="alert alert-success">
            <strong>Success!</strong>Inserted succefully.</div>';
        }else
            echo "Error".mysqli_error($conn);
        
    }
    
    
    public function insert_user($data,$conn)
    {
       $timestamp = date("Y-m-d H:i:s");
       
        
        $sql = "insert into user_details(full_name,email_id,phone_no,status,password,role_assign,created_at) values('".$data['name']."','".$data['email']."','".$data['phone']."','".$data['status']."',
        '".$data['password']."','".$data['role']."','".$timestamp."')";
        
        if(mysqli_query($conn,$sql))
        {
            echo "<div class='alert alert-success'><strong>Success!</strong>Inserted succefully</div>";
        }else
            echo "Error".mysqli_error($conn);
            
    }
    
    public function insert_project($data,$conn)
    {
       $timestamp = date("Y-m-d H:i:s");
       
        
        $sql = "insert into project_details(u_id,pname,s_desc,created_at) values('".$data['project_mgr_id']."','".$data['name']."','".$data['sdesc']."','".$timestamp."')";
        
        if(mysqli_query($conn,$sql))
        {
            return '<div class="alert alert-success">
            <strong>Success!</strong>Inserted succefully.</div>';
        }else
            echo "Eror".mysqli_error($conn);
            
    }
    
    public function update_project($data,$conn,$id)
    {
         $timestamp = date("Y-m-d H:i:s");
       
         $sql = "update project_details set pname ='".$data['name']."',s_desc = '".$data['sdesc']."',u_id='".$data['project_mgr_id']."',modified_at = '".$timestamp."' where p_id='".$id."' ";
        if(mysqli_query($conn,$sql))
        {
            echo '<div class="alert alert-success">
            <strong>Success!</strong>Updated succefully.</div>';
        }else
            echo "Error".mysql_error($conn);
        
    }
    
    public function update_module($data,$conn,$id)
    {
        
         $sql = "update module set p_id ='".$data['pname']."',module_name = '".$data['mname']."',percent_remain_to_complete  = '".$data['module_percent']."' where module_id='".$id."' ";
        if(mysqli_query($conn,$sql))
        {
            echo '<div class="alert alert-success">
            <strong>Success!</strong>Updated succefully.</div>';
        }else
            echo "Error".mysqli_error($conn);
            
    }
    public function update_task($data,$conn,$id)
    {
          $timestamp = date("Y-m-d H:i:s");
      /*  (p_id,module_id,submodule_id,task_name,task_type,task_assign_to,deadline,created_at) values('".$data['pname']."','".$data['module_name']."','".$data['submodule']."','".$data['task_name']."','".$data['task_type']."','".$data['task_assign_to']."','".$data['date']."','".$timestamp."')";
        $timestamp = date("Y-m-d H:i:s");*/
 
        $sql = "update task set p_id ='".$data['pname']."',module_id ='".$data['module_name']."', submodule_id='".$data['submodule']."',task_name='".$data['task_name']."',
        task_type='".$data['task_type']."',task_assign_to='".$data['task_assign_to']."',deadline='".$data['date']."',modified_at = '".$timestamp."',task_percent='".$data['taskpercent']."'  where t_id='".$id."' ";
         echo $sql;
        if(mysqli_query($conn,$sql))
        {
            echo '<div class="alert alert-success">
            <strong>Success!</strong>Updated succefully.</div>';
        }else
            echo "Error".mysqli_error($conn);
    }
    

    public function update_task_percent($conn,$t_id,$task_percent,$t_sid)
    {
        $sql = "update task set  task_percent ='".$task_percent."' where t_id = {$t_id} ";

        if(mysqli_query($conn,$sql))
        {
           return '1';
        }else
        echo "Error".mysqli_error($conn);


    }
    public function update_submodule_percent($conn,$sub_mod_id,$percent)
    {

        $sql = "update sub_module set submodule_percent = {$percent} where sub_mod_id = {$sub_mod_id}";

        if(mysqli_query($conn,$sql))
        {
            return '1';
        }else
            echo 'Error'.mysqli_error($conn);


    }

    public function update_module_percent($conn,$module_id,$percent)
    {
        $sql = "update module set percent_remain_to_complete = {$percent} where module_id = {$module_id}";

        if(mysqli_query($conn,$sql))
        {
            return '1';
        }else
            echo 'Error'.mysqli_error($conn);
    }

      public function update_remove_task_percent($conn,$t_id,$task_percent)
    {
        
        $sql = "update task set  task_percent ='".$task_percent."' where t_id = {$t_id}";

        if(mysqli_query($conn,$sql))
        {
           return 1;
        }else
        echo "Error".mysqli_error($conn);


    }


    public function update_sub_module($data,$conn,$id){
            
         $sql = "update sub_module set module_id ='".$data['module_id']."',sub_module_name = '".$data['submodule']."',submodule_percent = '".$data['submodule_percent']."' where sub_mod_id='".$id."' ";
       
        if(mysqli_query($conn,$sql))
        {
            echo '<div class="alert alert-success alert-dismissible">
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong>Updated succefully.</div>';
        }else
            echo "Error".mysqli_error($conn);
    }
    
    public function get_module_list($conn)
    {
          $sql = "SELECT * FROM module";
             $result = mysqli_query($conn,$sql);  
            if(mysqli_num_rows($result) > 0)
            {   
                $i=0;
                while($mrow = mysqli_fetch_array($result))
                {
                    $i++;
                    $data[$i]['module_id'] =  $mrow['module_id'];
                    $data[$i]['module_name'] = $mrow['module_name'];
                    
                }  
                return $data;
            }
        
    }
    
    
    public function get_submodule_list($conn)
    {
         $sql = "SELECT * FROM sub_module";
             $result = mysqli_query($conn,$sql);  
            if(mysqli_num_rows($result) > 0)
            {   
                $i=0;
                while($mrow = mysqli_fetch_array($result))
                {
                    $i++;
                    $data[$i]['sub_mod_id'] =  $mrow['sub_mod_id'];
                    $data[$i]['sub_module_name'] = $mrow['sub_module_name'];
                    
                }  
                return $data;
            }
        
    }
    
    public function view_project($conn){
        
         $sql = "SELECT * FROM project_details";
        echo '<table class="table-bordered">';
        echo '<thead><tr>
        <th>Project Name</th><th>Short description</th><th>Manager Name</th><th>Created At</th><th>Action</th>
        </tr></thead>';
        echo '<tbody>'; 
        $result = mysqli_query($conn,$sql);  
        if(mysqli_num_rows($result) > 0)
        {
            while($prow = mysqli_fetch_array($result))
            {
               $data = $this->find_userdetail_id($prow['u_id'],$conn);
                echo '<tr><td>'.$prow['pname'].'</td><td>'.$prow['s_desc'].'</td><td>'.$data['full_name'].'</td><td>'.$prow['created_at'].'</td>
                <td><a href="add_project.php?pedit_id='.$prow['p_id'].'">Edit</a></td></tr>';
            }
        }
        echo '</tbody>';
    }
    
    public function find_modules_of_project($id,$conn)
    {
        $sql = "SELECT * FROM task where p_id={$id}";
        $result = mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
               
                 $data[$i]['module_id'] = $row['module_id'];
                 $data[$i]['submodule_id'] = $row['submodule_id'];
                 $data[$i]['task_name'] = $row['task_name'];
                 $i++;
            }
            return $data;
        }
    }
    
   /* public function find_submodules_of_project($id,$conn)
    {
        $sql = "SELECT * FROM task where p_id={$id}";
        $result = mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
                $i++;
                $result[$i]['submodule_id'] = $row['submodule_id'];
                
            }
            return $result;
        }
    }
    
   
    */
  
    public function view_module($conn)
    {
        $sql = "SELECT * FROM module";
        $res = mysqli_query($conn,$sql);
        $data = array();
         echo '<table class="table-bordered">';
        echo '<thead><tr>
        <th>Module ID</th><th>Project Name</th><th>Module Name</th><th>ACTION</th>
        </tr></thead>';
        echo '<tbody>'; 
        while($row = mysqli_fetch_array($res))
        {
            
            $project_name = $this->find_project_detail_id($row['p_id'],$conn);
            $data['project_name']   =   $project_name['pname'];
           
            echo '<tr><td>'.$row['module_id'].'</td><td>'.$data['project_name'].'</td><td>'.$row['module_name'].'</td><td><a href="add_module.php?medit_id='.$row['module_id'].'">Edit</a></td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
        
    }
    
    
    public function view_submodule($conn){
         $sql = "SELECT * FROM sub_module where sub_mod_id > 1";
        $res = mysqli_query($conn,$sql);
        $data = array();
         echo '<table class="table-bordered">';
        echo '<thead><tr>
        <th>SubModule ID</th><th>Module Name</th><th>Submodule Name</th><th>ACTION</th>
        </tr></thead>';
        echo '<tbody>'; 
        while($row = mysqli_fetch_array($res))
        {
            
           
            $module_data            =  $this->find_module_id($row['module_id'],$conn);
            $data['module_name']     =  $module_data['module_name'];    
            
            echo '<tr><td>'.$row['sub_mod_id'].'</td><td>'.$data['module_name'].'</td><td>'.$row['sub_module_name'].'</td><td><a href="add_submodule.php?smedit_id='.$row['sub_mod_id'].'">Edit</a></td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
        
    }
    
    public function view_task($p_id,$conn){
        
       
        $sql = "SELECT p.p_id,m.module_id,s.sub_mod_id,t.task_name,t.task_assign_to,t.created_at,t.deadline FROM project_details p,module m,sub_module s,task t WHERE p.p_id=t.p_id AND m.module_id=t.module_id AND s.sub_mod_id=t.submodule_id order by p.p_id ASC";
        $res =  mysqli_query($conn,$sql); 
        $dt = array();
        $i =0;
        
  
        //print_r($data);
        
        while($prow = mysqli_fetch_assoc($res)){
            
            $dt[$i]['p_id'] = $prow['p_id'];
            $project_name = $this->find_project_detail_id($dt[$i]['p_id'],$conn);
            $dt[$i]['pname'] = $project_name['pname'];
            
            $dt[$i]['module_id'] = $prow['module_id'];
            $module_data = $this->find_module_id($prow['module_id'],$conn);
            $dt[$i]['module_name'] = $module_data['module_name'];
            $dt[$i]['sub_mod_id'] = $prow['sub_mod_id'];
            $submodule_data = $this->find_submodule_id($prow['sub_mod_id'],$conn);
            $dt[$i]['submodule_name'] =  $submodule_data['sub_module_name'];
            $dt[$i]['task_name'] = $prow['task_name'];
            $user  = $this->find_userdetail_id($prow['task_assign_to'],$conn);
            
            $dt[$i]['task_assign_to'] = $user['full_name'];
            $dt[$i]['created_at'] = $prow['created_at'];
            $dt[$i]['deadline'] = $prow['deadline'];
            $i++;
        }
            echo '<pre>';
         //print_r($dt);
        //$data = $this->get_all_project($conn);
       
        $p_id = $this->find_project_detail_id($p_id,$conn);
      
            $i=0;
           for($y = 0 ; $y< count($dt); $y++){
                
                if($p_id['p_id'] == $dt[$y]['p_id']){
                    $i++;
                    
                    $project_wise[$p_id['p_id']][$i]['p_id'] = $dt[$y]['p_id'];
                    $project_wise[$p_id['p_id']][$i]['pname'] = $dt[$y]['pname'];
                    $project_wise[$p_id['p_id']][$i]['module_id'] = $dt[$y]['module_id'];
                    $project_wise[$p_id['p_id']][$i]['module_name'] = $dt[$y]['module_name'];
                    $project_wise[$p_id['p_id']][$i]['sub_mod_id'] = $dt[$y]['sub_mod_id'];
                    $project_wise[$p_id['p_id']][$i]['submodule_name'] = $dt[$y]['submodule_name'];   
                    $project_wise[$p_id['p_id']][$i]['task_name'] = $dt[$y]['task_name'];
                    $project_wise[$p_id['p_id']][$i]['task_assign_to'] = $dt[$y]['task_assign_to'];
                    
                    $project_wise[$p_id['p_id']][$i]['created_at'] = $dt[$y]['created_at']; 
                    $project_wise[$p_id['p_id']][$i]['deadline'] = $dt[$y]['deadline']; 
                 /*  echo "PID:".$dt[$y]['p_id']."<br>";
                    echo "PNAME:".$dt[$y]['pname']."<br>";
                    echo "MID:".$dt[$y]['module_id']."<br>";
                    echo "SMID:".$dt[$y]['sub_mod_id']."<br>";
                    echo "TNAME:".$dt[$y]['task_name']."<br>";*/
                }
          
             } 
            
     
      
        return $project_wise;
      
    
        
    }
    

    
    public function find_task_by_id($id,$conn)
    {
        $sql = "SELECT * FROM task where t_id={$id}";
        
         $result = mysqli_query($conn,$sql);
        
        $row = mysqli_fetch_array($result);
        
        return $row;
        
    }
    public function find_userdetail_id($id,$conn)
    {
        $sql = "select * from user_details where id={$id}";
        
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        return $row;
        
        
    }
    public function find_project_detail_id($id,$conn)
    {
         $sql = "select * from project_details where p_id={$id}";
        
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        return $row;
        
        
    }
    
    
    
    public function find_module_id($id,$conn){
    
         $sql = "select * from module where module_id={$id}";
        
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        return $row;
        
    }
    public function find_module_by_pid($id,$conn)
    {
        $sql = "select * from module where p_id={$id}";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
                $data[$i]['module_id'] = $row['module_id'];
                $data[$i]['module_name'] = $row['module_name'];
                $data[$i]['percent'] = $row['percent_remain_to_complete'];
                $data[$i]['percent_const'] = $row['percent_need_to_completed'];
                
                $i++;
            }
            return $data;
        }
        else
            return '0';
    }
    
    public function find_submodule_by_mid($id,$conn)
    {
         $sql = "select * from sub_module where module_id={$id}";
        
        $result = mysqli_query($conn,$sql);
         if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
                $data[$i]['submodule_id'] = $row['sub_mod_id'];
                $data[$i]['submodule_name'] = $row['sub_module_name'];
               
                $i++;
            }
            return $data;
        }
        else
            return '0';
      
    }
    
    public function find_all_task_by_pm($p_id,$m_id,$conn)
    {
            
           $sql = "select * from task where p_id={$p_id} AND module_id={$m_id} AND submodule_id=1";
       
            $result = mysqli_query($conn,$sql);
            
        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
            $dt[$i]['p_id'] = $row['p_id'];
            $dt[$i]['t_id'] = $row['t_id'];
            $project_name = $this->find_project_detail_id($dt[$i]['p_id'],$conn);
            $dt[$i]['pname'] = $project_name['pname'];
            
            $dt[$i]['module_id'] = $row['module_id'];
            $module_data = $this->find_module_id($row['module_id'],$conn);
            $dt[$i]['module_name'] = $module_data['module_name'];
            $submodule_data = $this->find_submodule_id($row['submodule_id'],$conn);
          //  $dt[$i]['submodule_name'] =  $submodule_data['sub_module_name'];
            $dt[$i]['submodule_percent'] =   $submodule_data['submodule_percent'];  
            $dt[$i]['percentage'] = $module_data['percent_remain_to_complete'];    
            $dt[$i]['status'] = $row['status'];    
            $dt[$i]['task_name'] = $row['task_name'];
            $user  = $this->find_userdetail_id($row['task_assign_to'],$conn);
            
            $dt[$i]['task_assign_to'] = $user['full_name'];
            $dt[$i]['created_at'] = $row['created_at'];
            $dt[$i]['deadline'] = $row['deadline'];
                $i++;
            }
            return $dt;
        }else
            return '0';
       
    }
    
    
    
    
    public function find_all_task_by_pms($p_id,$m_id,$s_id,$conn)
    {   
       /* echo $p_id;
        echo $m_id;
        echo $s_id;*/
        
        $sql = "select * from task where p_id={$p_id} AND module_id={$m_id} AND submodule_id={$s_id}";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while($row = mysqli_fetch_array($result))
            {
            $dt[$i]['p_id'] = $row['p_id'];
            $project_name = $this->find_project_detail_id($dt[$i]['p_id'],$conn);
            $dt[$i]['pname'] = $project_name['pname'];
            $dt[$i]['t_id'] = $row['t_id'];
            $dt[$i]['task_percent'] = $row['task_percent'];
            $dt[$i]['module_id'] = $row['module_id'];
            $module_data = $this->find_module_id($row['module_id'],$conn);
            $dt[$i]['module_name'] = $module_data['module_name'];
            $dt[$i]['percentage'] = $module_data['percent_remain_to_complete'];    
            $dt[$i]['status'] = $row['status'];    
          
            $dt[$i]['sub_mod_id'] = $row['submodule_id'];
            $submodule_data = $this->find_submodule_id($row['submodule_id'],$conn);
            $dt[$i]['submodule_name'] =  $submodule_data['sub_module_name'];
            $dt[$i]['submodule_percent'] =   $submodule_data['submodule_percent'];  
            $dt[$i]['task_name'] = $row['task_name'];
            $user  = $this->find_userdetail_id($row['task_assign_to'],$conn);
            
            $dt[$i]['task_assign_to'] = $user['full_name'];
            $dt[$i]['created_at'] = $row['created_at'];
            $dt[$i]['deadline'] = $row['deadline'];
                $i++;
            
            }
            return $dt;
           
        }
        else
            return '0';
        
    }
    
    
    public function find_submodule_id($id,$conn)
    {
        $sql = "select * from sub_module where sub_mod_id={$id}";
        
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        return $row;
        
    }
    
  
    
    
    public function get_project_manager($conn)
    {
        $sql = "select * from user_details where role_assign=2";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {   $i=0;
            while($row = mysqli_fetch_array($result))
            {
            
                $data[$i]['u_id'] = $row['id'];
                $data[$i]['full_name']  = $row['full_name'];
                    $i++;
            }
                
            return $data;
        }
    }
    
    
    
    public function get_project_developer_nd_mgr($conn)
    {
        $sql = "select * from user_details where role_assign IN(2,3)";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {   $i=0;
            while($row = mysqli_fetch_array($result))
            { 
                $data[$i]['u_id'] = $row['id'];
                $data[$i]['full_name'] = $row['full_name'];
                  $i++;
            }
                
            return $data;
        }
    }
    public function get_all_project($conn)
    {
        $sql = "select * from project_details";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $i=0;
            while($row = mysqli_fetch_array($result))
            {   
                $data[$i]['p_id'] =  $row['p_id'];
                $data[$i]['p_name'] = $row['pname'];
                $data[$i]['percent'] = $row['percent_completed'];
                $i++;
            }
            return $data;
        }
    }
    
    public function view($conn)
    {
        
        $sql = "SELECT * FROM user_details";
        echo '<table class="table-bordered">';
        echo '<thead><tr>
        <th>FULL NAME</th><th>EMAIL ID</th><th>PHONE NO</th><th>STATUS</th><th>ROLE</th><th>ACTION</th>
        </tr></thead>';
        echo '<tbody>'; 
        $result = mysqli_query($conn,$sql);  
        if(mysqli_num_rows($result) > 0)
        {
            while($urow = mysqli_fetch_array($result))
            {
           
            
             $selected = 'selected="selected"';
            echo '<tr><td>'.$urow['full_name'].'</td><td>'.$urow['email_id'].'</td><td>'.$urow['phone_no'].'</td>';
                      
            echo'<td><select id="status" ><option value="0" "'.($urow['status'] == '0').'"  ? '.$selected.' : " ">Inactive</option><option value="1"  "'.($urow['status'] == '1').'" ? selected : " ">Active</option></select>               </td>';
          echo '<td>
            <select id="role">
            <option value="1" "'.($urow['role_assign'] == '1').'" ? '.$selected.' : " ">Admin</option>
            <option value="2" "'.($urow['role_assign'] == '2').'" ? '.$selected.' : " ">Project Manager</option>
            <option value="3" "'.($urow['role_assign'] == '3' ).'" ? '.$selected.' : " ">Project Developer</option>
            </select>
            
            </td><td><button type="button" onclick="call_ajax('.$urow['id'].');" id="update" disabled="true" class="btn btn-primary">Update</button></td></tr>';      
            }
           
        }else
            echo "No Record";
        
        echo '</tbody>';
        echo '</table>';
        
    }
    
    public function get_task_status($t_id,$coubt,$conn)
    {
        $sql = "select count from task where t_id={$t_id}";
         $result =    mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                    $row = mysqli_fetch_array($result);
                    return $row['status'];
            }


    }
    public function update_task_status($t_id,$status,$conn)
    {
         
        $sql = "update task set status=".$status.",  where t_id = {$t_id}";
    
            if(mysqli_query($conn,$sql))
            {
            return '<div class="alert alert-success">
            <strong>Success!</strong>Updated succefully.</div>';
            }else
            return  "Error".mysqli_error($conn);   
        
    }
    
    
    // --------percentage calculation 
    
    
    public function get_all_pms_count( $p_id,$m_id,$s_id,$conn)
    {
        
         
        $sql = "select COUNT(*) as total from task where p_id={$p_id} AND module_id={$m_id} AND submodule_id={$s_id} AND status=1";
        
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);
            return $row['total'];
        
        }else
            return 0;
    }
    
    
    public function get_all_task_count_by_module_and_project($p_id,$m_id,$conn)
    {
        $sql = "select COUNT(*) as total from task where module_id={$m_id} AND p_id={$p_id} AND STATUS=1";
        
        $result = mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);
            
            return $row['total'];
        }
        return 0;
        
    }
    
    
    public function update_percentage_of_module($conn,$m_id,$changes_percent_of_m1)
    {
        
        
        $sql = "update module set percent_remain_to_complete='".$changes_percent_of_m1."' where module_id={$m_id}";
        
        $result = mysqli_query($conn,$sql);
        
            if($result)
            {
                echo "updated succefully";
            }
        
    }

    public function update_percentage_of_submodule($conn,$s_id,$s_percent,$t_percent,$status)
    {
        if($status == '1')
        {
              $calculation = $s_percent+$t_percent;
        }else
        $calculation = $s_percent-$t_percent;
        
        $sql = "update sub_module set submodule_remaining_per='".$calculation."' where sub_mod_id={$s_id}";
        
        $result = mysqli_query($conn,$sql);
        
            if($result)
            {
                echo "updated succefully";
            }

    }

    
    public function update_percentage_of_project($conn,$p_id,$changes_percent_of_m1)
    {
            $data = $this->find_module_by_pid($p_id,$conn);
                $remaining_percent = 0.00;
                $percent_completed = 100.00;
                foreach($data as $key=>$value)
                {
                    $remaining_percent = $remaining_percent+$value['percent'];
                }
        
        $percent_completed = $percent_completed-$remaining_percent;
        $sql = "update project_details set percent_completed='".$percent_completed."' where p_id={$p_id}";
        
        $result = mysqli_query($conn,$sql);
        
            if($result)
            {
                echo "updated succefully";
            }
    }
    
    
    public function getpm_taskpercent_sum($conn,$p_id,$m_id,$t_id)
    {
           
           if($t_id == 0)  // FOR INSERTION 
           {
            $sql= "SELECT SUM(`task_percent`) as taskpercent FROM `task` WHERE p_id = {$p_id} AND `module_id` ={$m_id}";

           }
           else  // FOR UPDATION
           {
            $sql = "SELECT SUM(`task_percent`) as taskpercent FROM `task` WHERE p_id = {$p_id} AND `module_id` ={$m_id} AND `t_id` != {$t_id}";
            echo $sql;exit;
           }
            
           $result  =  mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_array($result);

                echo  $row['taskpercent'];
            }else
            {
                return 0.00;
            }
           // echo "Eror".mysqli_error($conn);

    }

    public function getsub_percent($conn,$m_id,$s_id)
    {

        if($s_id == 0)
        {
            $sql= "SELECT SUM(`submodule_percent`) as submodule_percent FROM `sub_module` WHERE module_id = {$m_id} ";
        }else
        {
            $sql = "SELECT SUM(`submodule_percent`) as submodule_percent FROM `sub_module` WHERE module_id = {$m_id} AND sub_mod_id != {$s_id}";       
        }
        $result  =  mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_array($result);

                return  $row['submodule_percent'];
            }else
                 return 0.00;


    }

    public  function getmodule_percent($conn,$p_id,$m_id)
    {
        if($m_id == 0)
        {
         $sql= "SELECT SUM(`percent_remain_to_complete`) as module_percent FROM `module` WHERE p_id = {$p_id} ";
        }else
        {
            $sql = "SELECT SUM(`percent_remain_to_complete`) as module_percent FROM `module` WHERE p_id = {$p_id} AND module_id != {$m_id}";       
        }
         $result  =  mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_array($result);

                return  $row['module_percent'];
            }else
                 return 0.00;

        
    }
    public function getpms_taskpercent_sum($conn,$p_id,$m_id,$s_id,$t_id)
    {
            
            if($t_id == 0)
            {
                 $sql= "SELECT SUM(`task_percent`) as taskpercent FROM `task` WHERE p_id = {$p_id} AND `module_id` ={$m_id} AND `submodule_id` = {$s_id}";
               
            }
           else
           {
                $sql = "SELECT SUM(`task_percent`) as taskpercent FROM `task` WHERE p_id = {$p_id} AND `module_id` ={$m_id} AND `submodule_id` = {$s_id} AND `t_id` != {$t_id}";

           }

           $result  =  mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_array($result);

                return  $row['taskpercent'];
            }else
                 return 0.00;

           
    }

    
    public function subm_count()
    {
        $sql = "SELECT MAX(`sub_mod_id`) as SID FROM sub_module";

        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);
            return $row['SID'];
        } else
            return 0;

    }
    public function module_count()
    {

         $sql = "SELECT MAX(`module_id`) as MID FROM module";

        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_array($result);
            return $row['MID'];
        } else
            return 0;
    }
    
    
    
}


?>