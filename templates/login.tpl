{include file="header.tpl"}
<div class="content">
<div id="title">LOGOWANIE</div>

{if $display_inf == true}

<div id="error">{$smarty.config.$inf} {if $inf== 'already_logged'}{$login}{/if}</div>

{/if}


		 {if $login_step == 'ok'}
			 <div id="message">{#Logged#}: {$login}</div>
 		 {/if}
 		 
		  {if $errors != ''}
			 		 <div id="error">{$smarty.config.$errors}</div>
	     {/if}

{if $display_form == true}
		
				<div id="content_content">
				 <form name="login_form" method="post" action="login.php?l={$lang}&act=login">
				 <table>
				 <tr><td>{#Login#}</td><td><input type="text" name="login" id="login" value="Login" onfocus="if(this.value=='Login')this.value='' " /></td></tr>
				 <tr><td>{#Pass#}</td><td><input type="password" name="pass" id="pass" value="Password" onfocus="if(this.value=='Password')this.value='' " /></td></tr>
				 <tr><td colspan="2">{#Autologin#}<input type="checkbox" name="autologin" id="autologin" checked="checked"/> 
				 <tr><td colspan="2"><input type="submit" value="{#Send#}" /></td></tr>
				 </table>
				 </form> 

				 <div id="side_txt">
				 <a href='login.php?act=drtp'>{#DRTP#}</a>
				 </div>

				 <div id="side_txt">
				 <a href='register.php'>{#YDHTA#}</a>
				 </div>
          </div>
      
{/if}

<div id="side_text"><a href="index.php?l={$lang}">{#back_to_main_site#}</a></div>

</div>
{include file="menu.tpl"}
{include file="footer.tpl"}
