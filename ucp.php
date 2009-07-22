<?php
ob_start();
session_start();

include "includes/headers.php";
include "includes/ucp_funcs.php";

if($_SESSION['login'] == 0)
{
	include "login.php";
}

else
{
	$uid = $_SESSION['uid'];
	$ch = $_GET['ch'];
	if($ch == '') $ch = 'main';
	
	$act = $_GET['act'];
	
	
	
	if($ch == 'img_cats')
	{
		$smarty -> assign('what', 'img_cats');
			
		$img_cats = array('cube', 'cube_oll', 'top_recognition', 'top_pll', 'top_oll', 'arrows');
		$smarty ->assign('img_cats', $img_cats);
		
		$tab = $imagecats;
		
		$query = "SELECT `cat_name`, `subcat_name`, `value` FROM `portal_users_imgcats` WHERE `user_id`=$uid";
		$result = query($query);	
		while($row = mysql_fetch_row($result))
		{
			$tab[$row[0]][$row[1]] = $row[2];
		}	
			

		// jeśli wysyłanie wyników
		if($act == 'send')
		{
			foreach($tab as $key=>$value)
			{
				 foreach($value as $key2=>$value2)
				       {
				       	$x = $key.'_'.$key2;
				       	
							 if($_POST[$x] == 'on') $wart = 1;
							 else $wart = 0;
							 							 	
				       	 	if($tab[$key][$key2] != $wart) 
				          	{
      	 							$tab[$key][$key2] = $wart;
				         			$query = "SELECT ID FROM `portal_users_imgcats` WHERE `cat_name`='$key' AND `subcat_name`='$key2' AND `user_id`=$uid;";
				         			$result = query($query);
				         			if(mysql_num_rows($result) == 0) $query = "INSERT INTO `portal_users_imgcats` VALUES(NULL, $uid, '$key', '$key2', $wart)";
				         			else $query = "UPDATE `portal_users_imgcats` SET `value`=$wart WHERE `user_id`=$uid AND `cat_name`='$key' AND `subcat_name`='$key2';";
				         	
				         	$result = query($query);
				         	
			         	 	}	 						  
						  }
				
				
				// sprawdzanie czy nie zostały odznaczone wszystkie opcje
				$check = is_no_empty($key);		  
						  
				if(!$check)
 		 		{
 		 					 		
		           if(isSet($tab[$key]['cube'])) $subcat = 'cube';
					  else $subcat = 'cube_oll';		  			  	  	 
		           		 	
		           $query = "UPDATE `portal_users_imgcats` SET `value`=1 WHERE `user_id`=$uid AND `cat_name`='$key' AND `subcat_name`='$subcat';";	 	
		           $result = query($query);		 	
	           	  $tab[$key][$subcat] = 1;	 	
			   }		  				       
			
			}	 					 	
		
		$smarty -> assign("message", "img_cats_sended");		 					 	
	
		}	
	
		$smarty -> assign('imgcats', $tab);
	}
	
	
	else if($ch=='profile')
	{
   
   		$smarty -> assign('what', 'profile');
   
   		$query = "SELECT * FROM portal_users WHERE ID={$_SESSION['uid']}";
   		$result = query($query);
   		$row = mysql_fetch_assoc($result);
   		
   		$ln = $row['lang'];
   
   		$errors = array();
   
   		if($act == 'send')
   		{
   		  
   		  	
   		  
   		  	// zmiana hasla
   		  
       			if($_POST['pass1'] != '')
       			{
	           		if($row['pass'] != md5(sha1(md5($_POST['old_pass'])))) $errors['bad_old_pass'] = 'bad_old_pass';
				$errors = array_merge($errors, checkPasswords($_POST['pass1'], $_POST['pass2']));
				
				if(count($errors) == 0)
				{
				  	$new_pass = md5(sha1(md5($_POST['pass1'])));
		    			$query = "UPDATE portal_users SET pass='$new_pass' WHERE ID={$_SESSION['uid']}";
		    			$res = query($query);
		  		}
		  		
		  		else $smarty -> assign('errors', $errors);
		  		
		  		
				
		 	}
       
       			$lan = $_POST['lang'];
       			$smarty -> assign('lang', $_POST['lang']);
       			$query = "UPDATE portal_users SET lang='$lan' WHERE ID={$_SESSION['uid']}";
       			$res = query($query);
   
       			if(count($errors) == 0) $smarty -> assign("message", "profile_updated");
     		}
   
   		
		$smarty -> assign('ln', $ln);
 	}
 	
 	
	
	else $smarty -> assign('what', 'nothing');
	
	
	$smarty -> display('ucp.tpl');	
}

?>
