    
         <!-- Project  Modal -->
  <div class="modal fade" id="project_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
           <form name="f1" method="post" action="" id="project_form">
                        <div class="form-group">
                            <label for="name">Project Name:</label>
                            <input type="text" name="pname" id="pname" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="name">Short Description:</label>
                           <textarea class="form-control" rows="5" id="sdesc" name = "sdesc" maxlength="140"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Project Manager:</label>
                            <select class="form-control" name="projectm" id="projectm">
                                <option value="0">select</option>
                                <?php foreach($project_manager as $key=> $value) {?>
                                <option value='<?php echo $value['u_id']; ?>' ><?php echo $value['full_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>

                        
                        

                       
                        
                           
            </form>    
        </div>
        <div class="modal-footer">
       <!-- <input type="button" name="sendform" id="sendform" class="form-control btn btn-primary" onclick="return project_validation()">-->
        <button type="button" id="submitprojectForm" class="btn btn-default" >Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Project  Modal -->

        <!-- Module  Modal -->
  <div class="modal fade" id="module_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Module Header</h4>
        </div>
        <div class="modal-body">
           <form name="f1" method="post" action="" id="module_form">
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
                      
                        


                        
                        

                       
                        
                           
            </form>    
        </div>
        <div class="modal-footer">
       <!-- <input type="button" name="sendform" id="sendform" class="form-control btn btn-primary" onclick="return project_validation()">-->
        <button type="button" id="submitmodalForm" class="btn btn-default" >Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

   <!-- SubModule  Modal -->
<div class="modal fade" id="submodule_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Module Header</h4>
        </div>
        <div class="modal-body">
           <form name="f1" method="post" action="" id="submodule_form">
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
                            <input type="text" name="submodule" id="sub_module" class="form-control" value="<?php echo @$sub_module_name; ?>">
                        </div>
                      
                        


                        
                        

                       
                        
                           
            </form>    
        </div>
        <div class="modal-footer">
       <!-- <input type="button" name="sendform" id="sendform" class="form-control btn btn-primary" onclick="return project_validation()">-->
        <button type="button" id="submitsubmodalForm" class="btn btn-default" >Send</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


    