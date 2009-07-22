{include file="header.tpl"}
<div class="content">
{if $what == 'show_form'}
<div id="title">{#add_algs_mess#}</div>

{if $error != ''}<div id="message">{$smarty.config.$error}</div>{/if}
<form name="addalgs" method="post" action="add_algs.php?l={$lang}&act=send">

<div class="form_area">
<textarea name="algs" cols="60" rows="20"> </textarea>
</div>
<div id="clear"> </div>

{if $log_status == 1}<div id="bold"><input type="checkbox" checked="chcecked" name="if_ma" />{#Add_with_MA#}</div>{/if}
{if $log_status != 1}<div id="captcha"><img src="includes/captcha.php" /><input type="text" name="captcha" /></div>{/if}
<div id="form_send"><input type="submit" value="{#Send#}" /></div>

</form>


{else}
<div id="title">{#Add_algs_raport#}</div>

<div id="add_part" class="bold">
{#added_algs#} {$ok}
</div>

<div id="add_part" class="bold">
{#no_added_algs#} {$bad}
</div>

{if $errors != ''}

<div id="content_content">
<div id="add_part" class="bold">
	      {#algs_with_mistakes#}
	      <table id="errors">
			{section name="i" loop=$errors}
						{assign var="mistake" value=$errors[i][0]}
			<tr>
			<td id='miastake'>{$smarty.config.$mistake}</td>
			<td id='mistake_alg'>
				{$errors[i][1]}
				{if $mistake=='cloned'}	
					{section name="j" loop=$cloned[$smarty.section.i.index]}
						<a  href="case.php?l={$lang}&cat={$cat_s}&sid={$cloned[i][j]}" style="color: red;">({$cloned[i][j]})</a>{if !$smarty.section.j.last}, {/if}
						
					{/section}
				{/if}
			</td>
			</tr>
			{/section}
			</table>
</div>
</div>
{/if}

<div id="text">{#Thank_you#}</div>

{/if}
<div id="content_foot"><a href="index.php?l={$lang}">{#back_to_main_site#}</a></div>
</div>
{include file="menu.tpl"}
{include file="footer.tpl"}
