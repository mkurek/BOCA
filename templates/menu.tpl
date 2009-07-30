<div class="menu_r">

	<div id="menu_part">
 		<div id="menu_header">
 			<img  src="images/{$lang}/profile.png" />
 		</div>
 		{if $log_status == 1}		 
			<div id="menu_content">
				<div><a href="login.php?l={$lang}&act=logout">{#Logout#}[{$login}]</a></div>
		 		<div><a href="ucp.php?l={$lang}">{#User_cp#}</a></div>
	 	 		<div>{#Last_visit#}{$last_visit}</div>
			</div>
				
		{elseif $log_status == 2}
			<div id="menu_content2">
	          		<form name="login_form" action="login.php?l={$lang}&act=login" method="POST">
				 	<table id="login_table">
				 		<tr>
					 		<th>{#Login#}</th>
						 	<td id="inp"><input type="text" name="login" id="login" value="Login" size="15" onfocus="if(this.value=='Login')this.value='' " /></td>
					 	</tr>
				 		<tr>
						 	<th>{#Pass#}</th>
						 	<td id="inp"><input type="password" name="pass" id="pass" value="Password" size="15" onfocus="if(this.value=='Password')this.value='' " /></td>
					 	</tr>
				 		<tr>
						 	<td colspan="2">{#Autologin#}&nbsp;&nbsp;&nbsp;<input type="checkbox" name="autologin" id="autologin" checked="checked"/></td> 
					 	</tr>
				 		<tr>
						 	<td colspan="2"><input type="submit" value="{#Send#}" /></td>
					 	</tr>
				 	</table>
	 			</form>
			</div>		
		{/if}
					   
  	</div>

	<div id="menu_part">
 		<div id="menu_header"><img  src="images/{$lang}/addalgs.png" /></div>
 		<div id="menu_content">
		 	<div class="bold"><a href="add_algs.php">{#Add_algs#}</a></div>
 		</div>
 	</div>
 	
 	<div id="menu_part">
 		<div id="menu_header"><img src="images/{$lang}/algpreview.png" /></div>
 		<div id="menu_content">
		 	<form name='check_algs'>
		 		<table>
		 		<tr> 
		 		<td> 
		 	 	<input type='text' name='alg' id='alg_input' />
		 	 	</td> 
		 	 	</tr>
			   	<tr> 
		 		<td> 
		 	 	{#Cube_size#}
				  <select name="cube_size">
					<option>2x2x2</option>
					<option selected="selected">3x3x3</option>
				</select>
		 	 	</td> 
		 	 	</tr>
		 	 	<tr> 
		 	 	<td> 
		 	 	<button type="button" onClick='checkAlg();'>GO!</button>
		 	 	</td>
		 	 	</tr> 
		 	 	</table>
		 	</form>
 		</div>
 	</div>

	{* METODY *}
	<div id="menu_part">
 		<div id="menu_header"><img  src="images/{$lang}/methods.png" /></div>
 		<div id="menu_content">
			<div{if $method=="fridrich"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich">Fridrich</a></div>
	          	<div{if $method=="zb"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=zb">ZB</a></div>
	          	<div{if $method=="zz"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=zz">ZZ</a></div>
	          	<div{if $method=="coll"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=coll">COLL</a></div>
	          	<div{if $method=="mgls"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls">MGLS</a></div>
	          	<div{if $method=="eg"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=eg">EG</a></div>
	          	<div{if $method=="ortega"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=ortega">Ortega</a></div>
	          	<div{if $method=="ss"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=ss">SS</a></div>
	          	<div{if $method=="cll"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=cll">CLL</a></div>
	          	<div{if $method=="ell"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=ell">ELL</a></div>
	          	<div{if $method=="f2ll"} id="active"{/if}>	<a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll">F2LL</a></div>
		</div>
  	</div>
	

	{* KATEGORIE *}
	{if $method !='' && $method != 'coll' && $method != 'cll'}
	<div id="menu_part">
 		<div id="menu_header"><img  src="images/{$method}.png" /></div>
	  	<div id="menu_content">
			{if $method == 'fridrich'}
 				<div{if $chapter=='f2l'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=f2l">F2L</a></div>
	 	  		<div{if $chapter=='oll'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=oll">OLL</a></div>
			  	<div{if $chapter=='pll'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=pll">PLL</a></div>
		 	{/if}
				 
		 	{if $method == 'zb'}
 	  			<div{if $chapter=='zbll'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll">ZBLL</a></div>
 	  			<div{if $chapter=='zbf2l'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbf2l">ZBF2L</a></div>
		 	{/if}
				 
		 	{if $method == 'eg'}
 	  			<div{if $chapter=='n'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=eg&ch=n">.n</a></div>
 	  			<div{if $chapter=='s'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=eg&ch=s">.s</a></div>
 	  			<div{if $chapter=='d'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=eg&ch=d">.d</a></div>
    			{/if}
			    
    			{if $method == 'zz'}
    	  			<div{if $chapter=='zbll'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll">{#ZZ_a#}</a></div>
    	  			<div{if $chapter=='b'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=b">{#ZZ_b#}</a></div>
    	  			<div{if $chapter=='d'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=d">{#ZZ_d#}</a></div>
			    {/if}
			    
    			{if $method == 'ortega'}
    	  			<div{if $chapter=='co'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ortega&ch=co">CO</a></div>
    	  			<div{if $chapter=='cp'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ortega&ch=cp">CP</a></div>
 	          	{/if}
 	          	
 	          	{if $method == 'mgls'}
 	          		<div{if $chapter=='els'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=els">ELS</a></div>
    	  			<div{if $chapter=='cls'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls">CLS</a></div>
 	          	{/if}
			   
			{if $method == 'ss'}
 	          		<div{if $chapter=='m'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=m">.m</a></div>
    	  			<div{if $chapter=='p'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=p">.p</a></div>
    	  			<div{if $chapter=='o'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=o">.o</a></div>
    	  			<div{if $chapter=='i'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=i">.i</a></div>
    	  			<div{if $chapter=='im'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=im">.im</a></div>
    	  			<div{if $chapter=='c'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ss&ch=c">.c</a></div>
 	          	{/if}
			   
			{if $method == 'ell'}	
				<div{if $chapter=='p'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=p">.p</a></div>
    	  			<div{if $chapter=='h'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=h">.h</a></div>
    	  			<div{if $chapter=='z'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=z">.z</a></div>
    	  			<div{if $chapter=='u1'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=u1">.u1</a></div>
    	  			<div{if $chapter=='u2'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=ell&ch=u2">.u2</a></div>
 			{/if}	
 			
 			{if $method == 'f2ll'}
 				<div{if $chapter=='3'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll&ch=3">.3</a></div>
 				<div{if $chapter=='2'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll&ch=2">.2</a></div>
 				<div{if $chapter=='1'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll&ch=1">.1</a></div>
 				<div{if $chapter=='4'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=f2ll&ch=4">.4</a></div>
 			{/if}
          	</div>
	</div>
	
	{/if}
	
	{ * SUBCHAPTER *}

	{if $subchapter != '' || $what_in_section == 'subchapter'}
	<div id="menu_part">
 		{if $method == 'fridrich' && $chapter == 'oll'}
	 	  	<div id="menu_header"><img  src="images/oll.png" /></div>
	  		<div id="menu_content">	   
	   			<div{if $subchapter=='d'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=oll&sch=d">.d</a></div>
	 	  		<div{if $subchapter=='l'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=oll&sch=l">.l</a></div>
	 	  		<div{if $subchapter=='b'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=oll&sch=b">.b</a></div>
		     		<div{if $subchapter=='c'} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=oll&sch=c">.c</a></div>
 	  		 </div>
   		{/if}
	</div>
	{/if}  
	  
	
	{if $orientation != '' || $what_in_section == 'orientation'}  
	<div id="menu_part">
		  <div id="menu_header"><img  src="images/{$lang}/orientation.png" /></div>
		  <div id="menu_content">
 		 	{if $method=='coll' || ($method == 'zb' && $chapter == 'zbll') || $method == 'zz' || $method == 'eg' || $method == 'cll'}
	 	  		{section name="i" loop=$or}
  			  		<div{if $orientation==$smarty.section.i.iteration && $orientation != ''} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m={$method}{if $method=='zb'}&ch=zbll{/if}{if $method == 'zz' || $method == 'eg'}&ch={$chapter}{/if}&o={$smarty.section.i.iteration}{if $chapter=='d' && $method != 'eg'}&p=6{/if}">{if $lang=='pl'}{#Orientation#} {$or[i]}{else}{$or[i]} {#Orientation#}{/if}</a></div>
 		 	  	{/section}
	 		{/if}
	 		{if $method == 'cll'}
	 		<div{if $orientation==8} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m={$method}&o=8">{#permutation#}</a></div>
		  	{/if}
		  </div>
	</div> 
	{/if}
	
	{if $permutation != '' || $what_in_section == 'permutation'}
	<div id="menu_part">
		  <div id="menu_header"><img  src="images/{$lang}/permutation.png" /></div>
		  <div id="menu_content">
 		 	{if $chapter == 'zbll' || $method=='zz'}
	 	  		{if $orientation == 7} {assign var="looop" value=$permh}
			  	{else} {assign var="looop" value=$perm}
	     			{/if}
					   
			  	{if $chapter != 'd'} 
		 	  		{section name="i" loop=$looop}
	  			  		<div{if $permutation==$smarty.section.i.iteration && $permutation != ''} id="active"{/if}><a href="cat.php?l={$lang}&cat={$cat_s}&m={$method}&ch={$chapter}&o={$orientation}&p={$smarty.section.i.iteration}">{if $lang=='pl'}{#permutation#} {$looop[i]}{else}{$looop[i]} {#permutation#}{/if}</a></div>
  		 	  		{/section}
		  		 	  
  		 	  	{else}
	  		 	  	<div id="active"><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=d&o={$orientation}&p={$permutation}">{if $lang=='pl'}{#permutation#} n{else}n {#permutation#}{/if}</a></div>
  		 	  	{/if}
  		 	{/if}
		  </div>
	</div> 
	{/if}  
	  
	  
	{if $method == 'fridrich' && $chapter == 'pll'}
 		<div id="menu_part">
 			<div id="menu_header"><img  src="images/{$lang}/permutation.png" /></div>
			<div id="menu_content">
	  			{section name="i" loop=$pll_titles}
 			  		{assign var="licz" value=`$smarty.section.i.iteration+872`}
 					<div{if $pll==$smarty.section.i.iteration && $pll != ''} id="active"{/if}><a href="case.php?l={$lang}&cat={$cat_s}&sid={$licz}">PLL {$pll_titles[i]}</a></div> 
				{/section} 
			</div>
	   	</div> 
	{/if} 
	  
	  
 	<div id="menu_part">
	 	<div id="menu_header"><img  src="images/{$lang}/stats.png" /></div>
	 	<div id="menu_content">
   		<div>{#Users_count#}: {$users}</div>
	 	<div>{#Algs_count#}: {$algs_inb}</div>
	 	{if $log_status == 1}
		 	<div>{#Visits#}: {$visits}</div>
	 		<div>{#Your_algs#}: {$your_algs}</div>
	 	{/if}
	 	</div>
  	</div>
	  
  	{*
  	<div id='banners'>
	  
	  
	  
  	</div>
  	*}
</div>
