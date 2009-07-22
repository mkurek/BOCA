{include file="header.tpl"}

{config_load file="$lang.conf"}
<div class="content">
	  <div id='content_title'>
	  {if $register == 'register_form'}{#Register_form_title#}{elseif $register == 'send'}{#Register_send_title#}{elseif $register == 'activate'}{#Register_activate_title#}{/if}</div>
	  
	  {if $errors != '' && $register == "register_form"}<div id="errors">
	  {$smarty.config.$errors_type}
	  {foreach key="klucz" item="blad" from=$errors}{$smarty.config.$blad}<br />{/foreach}
	  </div>{/if}
	  
	  
	  <div id='content_content'>
	  		  {if $register == 'register_form'}
				 <form name="register_form" method="post" action="register.php?action=reg">
			  	
				  <table id="register_form">
			 	<tr>
			   <td>{#Username#}: </td>
	         <td><input name='username' type='text' id='username' {if $errors != ''}value="{$username}"{/if} /></td>
			  	</tr>
			  	
			  	<tr>
			   <td>{#Email#}: </td>
	         <td><input name='mail' type='text' id='mail' {if $errors != ''}value="{$mail}"{/if} /></td>
			  	</tr>
	         
	         <tr>
			   <td>{#Confirm_Email#}: </td>
	         <td><input name='mail2' type='text' id='mail2' {if $errors != ''}value="{$mail2}"{/if} /></td>
			  	</tr>
	         
	         <tr>
			   <td>{#Password#}: </td>
	         <td><input name='password' type='password' id='password' {if $errors != ''}value="{$password}"{/if} /></td>
			  	</tr>
	         
	         <tr>
  		      <td>{#Confirm_password#}: </td>
	         <td><input name='password2' type='password' id='password2' {if $errors != ''}value="{$password2}"{/if} /></td>
			  	</tr>
				 
				 <tr>
				 <td>{#Language#}: </td>
	         <td>{html_radios name="language" options=$languages selected=$language separator="<br />"}</td>
			  	</tr>
				
				<tr>
				<td><img src="includes/captcha.php" /></td><td><input type="text" name="captcha" id="captcha" /></td>
				</tr> 
				
				<tr>
			 	<td><input type='submit' value='{#Send#}' /></td>
			  	</tr>
			  	</table>
				</form>	  

	  			{elseif $register == '404'} <div id="message">{#error_404#}	</div>
	  			
				{elseif $register == 'send'} <div id="message">{#YANR#}</div>	
	  				
	  			{/if}
	  				  
	  
	  </div>
</div>

{include file="menu.tpl"}

{include file="footer.tpl"}