<div id="tabela">
	  
	  <div id="left">
	  		 {section name=m loop=$cats step=2}
 				 <div id="cell">
				 		<a href='cat.php?l={$lang}&cat={$cat_s}&m={$cats[m]}'>
			  			{$cats[m]|upper}
			  			</a>
				</div>	 
	  		 {/section}
	  </div>
	  
	  <div id="right">
	  		 {section name=m loop=$cats start=1 step=2}
 				 <div id="cell">
				 		<a href='cat.php?l={$lang}&cat={$cat_s}&m={$cats[m]}'>
			  			{$cats[m]|upper}
			  			</a>
				</div>	 
	  		 {/section}
	  </div>
	  
</div>