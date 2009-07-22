<div  id="title">{#user_img#}</div>

<div id="img_cats">
<form name="img_cats" method="POST" action="ucp.php?ch=img_cats&act=send">
{foreach item="subcat" key="cat" from=$imgcats}
	<div id="cat">
		<div id="cat_title">{$cat}</div>
		<table id="cats">
			<tr>
				{foreach item="temp" key="key" from=$subcat}
				<td>
					{$key}<input type="checkbox" name="{$cat}_{$key}" id=name="{$cat}_{$key}" {if $temp==1} checked="checked" {/if} />
				</td>
				{/foreach}
			</tr>
		</table>
	</div>
			
{/foreach}
<input type="submit" value="{#Send#}" />
</form>
</div>
