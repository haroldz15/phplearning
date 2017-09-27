<?php 
include_once 'psl_config.php';
//generate contents in relation to what is choosen
print <<<HTML
<script type="text/JavaScript" src="../js/functions.js"></script>
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
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input" >
  </div>
  <div class="form-group col-md-3"">
  <label for="formGroupExampleInput">Bill To</label>
    <textarea class="form-control" style="resize: none;" ></textarea>
  </div>
  </div>
</form>
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