
    <script type="text/javascript">
        
       
        function project_validation()
        {
            
            var name = $('#pname').val();
          
            var sdesc = $('#sdesc').val();
            
            var pm = $('#projectm').val();
           
         
            
            
            if(name == '')
                {
                    alert('please enter Project name');
                    $('#pname').focus();
                    return false;
                }
           
            if(sdesc == '')
                {
                    alert('please enter Project description');
                    $('#sdesc').focus();
                    return false;
                }
            


            if(pm == '0')
                {
                    alert('please select the status');
                    $('#projectm').focus();
                    return false;
                }
            
           
            return true;
           
        }
        
        function module_validation()
        {
            
            
           
            var mname = $('#mname').val();
            
            var pname = $('#mpname').val();
            
            var mpercent = $('#mpercent').val();
            
            //var remain_percent = $('#remain').text();
            var val = $('#remain').text();

            var num = val.replace(/[^0-9]+/gi, '');
            num = num.replace(/(\d{2})(\d*)/, '$1.$2');
            
            if(pname == '0')
                {
                alert('please select project name');
                $('#mpname').focus();
                return false;
                }

           
            if(mname == '')
                {
                    alert('please enter Module name');
                    $('#mname').focus();
                    return false;
                } 
            
            if(mpercent == '0')
                {
                    alert('please enter percentage');
                    $('#mpercent').focus();
                    return false;
                }
            
           
            return true;
           
        }
        function selectedproject(){
            alert("hi");
        }
        
       
        function sub_module_validation()
        {
            
            
            var module_name = $('#module_name').val();
            
            var submname = $('#sub_module').val();
            
            var subpercent = $("#submpercent").val();

            if(module_name == '0')
                {
                    alert('please select  Module name');
                    $('#module_name').focus();
                    return false;
                }
           
            if(submname == '')
                {
                    alert('please enter sub Module name');
                    $('#sub_module').focus();
                    return false;
                }
            
            if(subpercent == '0')
            {
                alert('please select percentage to assign');
                $("#submpercent").focus();
                return false;

            }    
            return true;
          
            
           
        }
            
            
     
        
        
    </script>