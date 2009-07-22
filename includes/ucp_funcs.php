<?php
include 'arrays.php';

function is_no_empty($key)
{
	global $imagecats;
	
	$check = false;
			 
			 foreach($imagecats[$key] as $key2=>$value)
 			{
 				$x = $key.'_'.$key2; 			
 				if($_POST[$x] == 'on' || $_POST[$x] == 1) {$check = true;} 
	      }

return $check;
}

function checkPasswords($password1, $password2)
{
  	$errors = array();
  
	if(strlen($password1) <5) $errors['password_to_short'] = 'password_to_short';
	if($password1 != $password2) $errors['passwords_not_same'] = 'passwords_not_same';

	return $errors;	
}




?>
