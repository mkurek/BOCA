<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="zbll, fridrich, coll, rubik's, cube, rubik, cf, zzll, zbf2l, f2l, speedcubing, algs, oll, pll, permutacja, orientacja" />
<meta name="Description" content="Rubik's Cube'" />
<meta name="Author" content="Matthew" />
{config_load file="$lang.conf"}
<meta http-equiv="Content-Language" content="{#language#}" />
<title>{#title#}{if $site_title != ''}: {$site_title}{/if}</title>
{if $mode == 'print'}
<link rel="stylesheet" type="text/css" href="css/print.css" />
</head>
<body>
<div class="all">
{else}
<link rel="stylesheet" type="text/css" href="css/menu2.css" />

{literal}
<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->
{/literal}

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="css/jqueryslidemenu.js"></script>
<link rel="stylesheet" type="text/css" href="css/style2.css" />

{literal}
<script type="text/javascript">
function checkAlg()
{
  	var alg = document.check_algs.alg.value;
  	var size = document.check_algs.cube_size.value;
  	var size2;
  	if(size == '2x2x2') size2 = 2;
  	else size2 = 1;

  	WinObj = window.open("preview.php?data="+alg+"&cube="+size2, "algPreview", "width=700,height=200");
  
}


function zmien()
{
{/literal}
	{$var_imgcats}
	{$var_catname}
	{literal}
	var alg = document.getElementById('alg').value;

	for(var cos in imgcats)
	{
	  	document.getElementById(imgcats[cos]).src = "scig/scig.php?desc=portal/"+catname+"/"+imgcats[cos]+"&data="+alg;
	}
	
}


</script>

{/literal}
</head>

<body>

<div class='all'>
<div class='banner'>
<img  src="images/top.png" />
</div>

<div id="myslidemenu" class="jqueryslidemenu">
<ul id="menu">
  	 <li><a href="index.php?l={$lang}">{#Home#}</a></li>
  	 <li><a href="#">2x2x2</a>
		<ul>
            		<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=eg">EG</a>
            			<ul>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=eg&ch=n">.n</a></li>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=eg&ch=s">.s</a></li>
  					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=eg&ch=d">.d</a></li>
            			</ul>
    			</li>
    			
      	  		<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=eg&ch=n">CLL</a></li>
      	  		
      	  		<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss">SS</a>
            			<ul>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=m">.m</a></li>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=p">.p</a></li>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=o">.o</a></li>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=i">.i</a></li>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=im">.im</a></li>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=c">.c</a></li>
            			</ul>
	 		</li>
	 		
	 		<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ortega">Ortega</a>
            			<ul>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ortega&ch=co">CO</a></li>
            			 	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ortega&ch=cp">CP</a></li>
            			</ul>
    			</li>
  		</ul>
    	</li>
  	 
  	<li><a href="#">3x3x3</a>
		<ul>
  			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich">Fridrich</a>
  				<ul>
			  		<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=f2l">F2L</a></li>
      	  				<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=oll">OLL</a></li>
		  			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=pll">PLL</a></li> 
  				</ul>
			</li>
			
			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb">ZB</a>
			 	<ul> 
	 				<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbf2l">ZBF2L</a></li>
					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll">ZBLL</a>
						<ul>
							{section name="i" loop=$or}
    								<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll&o={$smarty.section.i.index_next}">{$or[i]} Orientation</a>
    									<ul>
    			 							{if $or[i] == 'H'}
     			 								{section name='j' loop="$permh"}
		  										<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll&o={$smarty.section.i.index_next}&p={$smarty.section.j.index_next}">.{$permh[j]}</a></li>
		  									{/section}
   		  			
		     								{else}
	     		  								{section name='j' loop="$perm"}
					  							<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll&o={$smarty.section.i.index_next}&p={$smarty.section.j.index_next}">.{$perm[j]}</a></li>
		  									{/section}
     					     		  
    										{/if}			 
		  							</ul>
		  						</li>
     							{/section}
						</ul>
					</li>
				</ul>
			</li>
		
		  	<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz">ZZ</a>
			 	<ul> 
	 				<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll">{#ZZa#}</a>
					 	<ul>
							{section name="i" loop=$or}
    								<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll&o={$smarty.section.i.index_next}">{$or[i]} Orientation</a>
    									<ul>
    			 							{if $or[i] == 'H'}
     			 								{section name='j' loop="$permh"}
		  										<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll&o={$smarty.section.i.index_next}&p={$smarty.section.j.index_next}">.{$permh[j]}</a></li>
		  									{/section}
   		  			
		     								{else}
	     		  								{section name='j' loop="$perm"}
					  							<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll&o={$smarty.section.i.index_next}&p={$smarty.section.j.index_next}">.{$perm[j]}</a></li>
		  									{/section}
     					     		  
    										{/if}			 
		  							</ul>
		  						</li>
     							{/section}
						</ul>
				 	</li>
				 	
					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=b">{#ZZb#}</a>
						<ul>
							{section name="i" loop=$or}
    								<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=b&o={$smarty.section.i.index_next}">{$or[i]} Orientation</a>
    									<ul>
    			 							{if $or[i] == 'H'}
     			 								{section name='j' loop="$permh"}
		  										<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=b&o={$smarty.section.i.index_next}&p={$smarty.section.j.index_next}">.{$permh[j]}</a></li>
		  									{/section}
   		  			
		     								{else}
	     		  								{section name='j' loop="$perm"}
					  							<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=b&o={$smarty.section.i.index_next}&p={$smarty.section.j.index_next}">.{$perm[j]}</a></li>
		  									{/section}
     					     		  
    										{/if}			 
		  							</ul>
		  						</li>
     							{/section}
						</ul>
					</li>
					
					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=d">{#ZZd#}</a>
						<ul>
							{section name="i" loop=$or}
    								<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=d&o={$smarty.section.i.index_next}&p={if $smarty.section.i.index_next == 7}4{else}6{/if}">{$or[i]} Orientation</a></li>
     							{/section}
						</ul>
					</li>
					
				</ul>
			</li>
			
			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls">MGLS</a>
				<ul> 
					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=els">ELS</a></li>
					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls">CLS</a>
						<ul> 
							<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls&sch=m">.m</a></li>
            			 			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls&sch=p">.p</a></li>
            			 			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls&sch=o">.o</a></li>
            			 			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls&sch=i">.i</a></li>
            			 			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls&sch=im">.im</a></li>
            			 			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls&sch=c">.c</a></li>	
						</ul> 
					</li>
				</ul>	
			</li>
			
			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=coll">COLL</a>
				<ul> 
					{section name="i" loop=$or}
						<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=coll&o={$smarty.section.i.index_next}">{$or[i]} Orientation</a></li>
					{/section}
					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=coll_r">{#COLL_recognition#}</a></li>
				</ul> 
			</li> 
			
			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=cll">CLL</a>
				<ul> 
					{section name="i" loop=$or}
						<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=cll&o={$smarty.section.i.index_next}">{$or[i]} Orientation</a></li>
					{/section}
				</ul> 
			</li>
			
			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell">ELL</a>
				<ul> 
					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=p">.p</a></li>
    	  				<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=h">.h</a></li>
    	  				<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=z">.z</a></li>
    	  				<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=u1">.u1</a></li>
    	  				<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=u2">.u2</a></li>
				</ul> 
			</li> 
			
			<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll">F2LL</a>
				<ul> 
			 		<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll&ch=3">.3</a></li>
 					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll&ch=2">.2</a></li>
 					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll&ch=1">.1</a></li>
 					<li><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll&ch=4">.0</a></li>
				</ul> 
			</li> 
		
		</ul>		  
  	 </li>
		
		
    	<li><a href="#">{#Rest#}</a></li>
    
    	<li><a href="faq.php?l={$lang}">FAQ</a></li>
    
    	{if $log_status == 1}
    		<li><a href="login.php?l={$lang}&act=logout">{#Logout#}</a></li>
    		<li><a href="ucp.php?l={$lang}">{#User_cp#}</a></li>
	{else}
		<li><a href="login.php?l={$lang}">{#Login#}</a></li>
    		<li><a href="register.php?l={$lang}">{#Register#}</a></li>
  	{/if}
    
</ul>
</div>
{/if}
