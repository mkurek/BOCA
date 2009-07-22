<div  id="title">{#profile#}</div>

{if $message != ''}
<div id="message">{$smarty.config.$message}</div>
{/if}

<div id='content_content'>

{if $errors != ''}
<div id="errors">
	  {foreach key="klucz" item="blad" from=$errors}{$smarty.config.$blad}<br />{/foreach}
</div>{/if}

<div id="cat_title" class="margin_top_20">{#change_pass#}</div>

<form name="pass" method="POST" action="ucp.php?ch=profile&act=send">
	<table id="register_form">
		<tr>
			<td>{#old_pass#}</td><td><input type="password" name="old_pass" id="old_pass" /></td> 
		</tr> 
		<tr>
			<td>{#Password#}</td><td><input type="password" name="pass1" id="pass1" /></td> 
		</tr>
		<tr>
			<td>{#Confirm_password#}</td><td><input type="password" name="pass2" id="pass2" /></td> 
		</tr>
	</table>				
<input type="submit" value="{#Send#}" />



<div id="cat_title" class="margin_top_20">{#change_lang#}</div>

<select name="lang" id="lang">
 	<option {if $ln=='pl'}selected="selected"{/if} value="pl">Polski</option>
	<option {if $ln=='en'}selected="selected"{/if} value="en">English</option> 
</select><br /><br />				
<input type="submit" value="{#Send#}" />

</form>

</div>
