<?php 
include_once 'psl_config.php';
//generate contents in relation to what is choosen
print <<<HTML
<script src="../js/functions.js"></script>
HTML;

function getContent($mysqli){

if(isset($_POST["contentType"])){
	//print content type as header
	print "<h1>{$_POST["contentType"]}</h1>";
	switch ($_POST["contentType"]) {

		case "Admin Tools":
			print <<<HTML
			<form id="formAdminOptions">
			    <div class="form-group row">
			      <label for="inputEmail3" class="col-sm-2 col-form-label">Users</label>
			      <div class="col-sm-10">
HTML;
    $prep_stmt = "SELECT user_id,username FROM `users`";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id,$username);
        $users = array();
                while ($stmt->fetch()) {
                        // Get all the user roles to the array members
                        $users[] = array(
			            "user_id" => $user_id,
			            "username" => $username);
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 29</p>';
                $stmt->close();
        }

    if (empty($error_msg)) {
    	print "<select name='usersSelect' class='form-control' onchange=\"getSessionParameters('{$_SESSION["flags"]}','userCurrentFlags')\"><option value=''></option>";
 		foreach($users as $key => $value)
		{
			//echo var_dump($value);
print <<< HTML
            <option value="{$value['user_id']}">{$value['username']}</option>
HTML;
		}
		print "</select>";
    }    	
print <<<HTML
    <span id="userCurrentFlags"></span>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Roles</label>
      <div class="col-sm-10">
HTML;

$prep_stmt = "SELECT flag_id,name FROM `flags`";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($flag_id,$name);
        $flags = array();
                while ($stmt->fetch()) {
                        // Get all the user roles to the array members
                        $flags[] = array(
			            "flag_id" => $flag_id,
			            "name" => $name);
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 29</p>';
                $stmt->close();
        }

    if (empty($error_msg)) {
    	print "<select name='rolesSelect' class='form-control' id='option_role'><option value=''></option>";
 		foreach($flags as $key => $value)
		{
print <<<HTML
            <option value="{$value['flag_id']}">{$value['name']}</option>
HTML;
		}
		print "</select>";
    }

print <<<HTML
		</div>
	  </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
      	<span id="assignConfirm"></span><br>
        <button type="button"  onclick="ajaxCall('assignRoles','assignConfirm','formAdminOptions')"class="btn btn-primary">Assign</button>
        
      </div>
    </div>
    </form>
    <input type="hidden" value="{$_POST['contentType']}" name="contentType">
    <input type="hidden" value="Asign Role" name="function">
HTML;
			break;

/*Invoice Option*/
		case "Invoice":
print <<<HTML
<form>
<div class="row">
  <div class="form-group col-md-2 offset-md-6">
    <label for="formGroupExampleInput">Date</label>
    <input type="date" class="form-control" id="formGroupExampleInput" placeholder="">
    <label for="formGroupExampleInput">Invoice #</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
  </div>
  <div class="form-group col-md-3"">
    <label for="formGroupExampleInput">Bill To</label>
    <textarea class="form-control" style="resize: none;" rows="6" ></textarea>
  </div>
</div>
<div class="row">
    <div class="col-md-2">
        <button  type="button" class="btn btn-primary" onclick="addNewRow('tableItems')">Add New Item</button>
    </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <table class="table table-striped table-bordered table-hover table-sm" id="tableItems">
        <thead class="thead">
            <tr>
                <th class="text-center">Quantity</th>
                <th>Description</th>
                <th class="text-center">Action</th>
            </tr>    
        </thead>
        <tbody>
            <tr>
                <td style="width: 10%"><input type="number" class="form-control text-center"></td>
                <td style="width: 70%"><textarea class="form-control"  onkeyup="textAreaAdjust(this)" style="overflow:hidden;resize: none;" rows="1"></textarea></td>
                <td style="width: 20%" class="text-center">
                    <button type="button" class="btn btn-info">
                            <span class="fa fa-pencil"></span>
                   </button>
                    <button type="button" class="btn btn-danger" onclick="deleteRow()">
                            <span class="fa fa-remove"></span>
                   </button>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
</div>
</form>
<script>
  function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (5+o.scrollHeight)+"px";
}  
</script>
HTML;
            break;
	
		default:
			# code...
			break;
	}

}else{
	print "no hay nada de contenido";
}
}
 ?>