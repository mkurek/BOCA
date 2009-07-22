<?php

$orientacja_lower = array("t", 'u', 'l', 'pi', 'sune', 'antiSune', 'h');

$orientacja_upper = array('T', 'U', 'L', 'Pi', 'Sune', 'Anti-Sune', 'H');

$permutacja = array('r', 'l', 'b', 'f', 's', 'n');
$permutacjah = array('r', 'b', 's', 'n');

$errors_array = array('to_short_username', 'to_long_username', 'username_already_occupied', 'passwords_not_same', 'password_to_short', 'mail_incorrect');

$languages = array('0' => 'English', '1' => 'Polish');

$orient = array(1 => 'T', 'U', 'L', 'Pi', 'Sune', 'Anti-Sune', 'H');

$perm = array(1 => 'R', 'L', 'B', 'F', 'S', 'N');
$permh = array(1 => 'R', 'B', 'S', 'N');

$imagecats = array(
	'zbll' => array
	(
		'cube' => 1,
		'cube_oll' => 0,
		'top_recognition' => 0,
		'top_pll' => 1,
		'top_oll' => 0,
		'arrows' => 0
	),

	'f2l' => array
	(
		'cube' => 1,
	),
     			 
	'zbf2l' => array
	(
		'cube' => 1,
	),

	'pll' => array
	(
		'cube' => 0,
		'top_recognition' => 1,
 		'top_pll' => 1,
 		'arrows' => 0
	),

	'oll' => array
 	(
  		'cube_oll' => 1,
  		'top_oll' => 1
  	),

	'coll' => array
	(
		'cube' => 1,
		'cube_oll' => 0,
		'top_recognition' => 0,
		'top_pll' => 1,
		'top_oll' => 0,
		'arrows' => 0
	),

	'eg' => array
	(
		'cube' => 1,
		'cube_oll' => 0,
		'top_recognition' => 0,
 		'top_pll' => 1,
		'top_oll' => 0,
		'arrows' => 0,
 		'down' => 1
	),

	'ss' => array
 	(
	 	'cube' => 0,
	 	'cube_oll' => 1,
	 	'top_oll' => 1,
	 	'down' => 1
 	),
     		 
     	'ortega_cp' => array
  	(
   		'cube' => 1,
	    	'top_pll' => 1,
	    	'arrows' => 0,
	 	'down' => 1,
	 	'top_recognition' => 0
   	), 
  		    
     	'ortega_co' => array
  	(
	  	'cube_oll' => 1,
  		'top_oll' => 1,
	  	'top_recognition' => 0
  	),
  	
     	'els' => array
	(
 		'cube' => 1      
	),
	       		
     	'cls' => array
	(
 		'cube' => 1,
	  	'cube_oll' => 1,
	  	'top_oll' => 1	         
    	),
    	
    	'cll' => array
    	(
	    	'cube' => 1,
		'cube_oll' => 0,
		'top_recognition' => 0,
		'top_pll' => 1,
		'top_oll' => 0,
		'arrows' => 0
    	),
    	
    	'ell' => array
    	(
		'cube' => 1,
		'cube_oll' => 0,
		'top_recognition' => 0,
		'top_pll' => 1,
		'top_oll' => 0,
		'arrows' => 0    
  	),
  	
  	'f2ll' => array
  	(
	  	'cube' => 1,
		'cube_oll' => 0,
		'top_oll' => 1
  	)
);


$zb_title_big = array(1=>'OLL T', 73=>'OLL U', 145=>'OLL L', 217=>'OLL Pi', 289=>'OLL Sune', 361=>'OLL Anti-Sune', 433=>'OLL H');

$zb_title_little = array(1=>'r', 13=>'l', 25=>'b', 37=>'f', 49=>'s', 61=>'n');
$zb_title_little_h = array(1=>'r', 13=>'b', 25=>'s', 33=>'n');

$zz_d_title_big = array(1=>'OLL T', 13=>'OLL U', 25=>'OLL L', 37=>'OLL Pi', 49=>'OLL Sune', 61=>'OLL Anti-Sune', 73=>'OLL H');
$zz_d_title_little = array(1=>'n');
$zz_d_full_title_little = array(1=>'n', 13=>'n', 25=>'n', 37=>'n', 49=>'n', 61=>'n', 73=>'n');

$zz_b_title_big = array(1=>'OLL T', 25=>'OLL U', 49=>'OLL L', 73=>'OLL Pi', 97=>'OLL Sune', 121=>'OLL Anti-Sune', 145=>'OLL H');
$zz_b_title_little = array(1=>'r', 5=>'l', 9=>'b', 13=>'f', 17=>'s', 21=>'n');
$zz_b_title_little_h = array(1=>'r', 5=>'b', 9=>'s', 13=>'n');

$colls_title = array(1=>'OLL T', 7=>'OLL U', 13=>'OLL L', 19=>'OLL Pi', 25=>'OLL Sune', 31=>'OLL Anti-Sune', 37=>'OLL H');
$clls_title = array(1=>'OLL T', 7=>'OLL U', 13=>'OLL L', 19=>'OLL Pi', 25=>'OLL Sune', 31=>'OLL Anti-Sune', 37=>'OLL H', 41=>"Permutation");

$pll_titles = array('U.a', 'U.b', 'H', 'Z', 'A.a', 'A.b', 'E', 'J.a', 'J.b', 'R.a', 'R.b', 'G.a', 'G.b', 'G.c', 'G.d', 'N.a', 'N.b', 'T', 'Y', 'F', 'V');

$ell_titles = array(1=>"p", 4=>"h", 9=>"z", 15=>"u1", 23=>"u2");
$cls_titles = array(1=>"m", 28=>"p", 56=>"o", 84=>"i", 93=>"im", 101=>"c");
$cls_titles2 = array(1=>"m", 28=>"p", 56=>"o", 84=>"i", 93=>"im", 101=>"c");
$ss_titles = array(1=>"m", 28=>"p", 56=>"o", 84=>"i", 93=>"im", 101=>"c");
$ss_titles2 = array(1=>"m", 28=>"p", 56=>"o", 84=>"i", 93=>"im", 101=>"c");
?> 
