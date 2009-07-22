{include file="header.tpl"}
<div class="content">
	
	{if $ok == 1}
	
	<img src="scig/scig.php?desc=portal/{$size}all&data={$alg}" />
	<br /><br />
	<a href="preview.php?data={$alg}&cube={if $cube_size==1}2{else}1{/if}">{#change_cube_size#}</a>
	<br /><br />
	{else}
	
	<div id="content_title">
		<div id="errors">{#uncorrect_alg#}</div>
	</div>
	{/if}
 	<a href="#" onClick="window.close()">{#close#}</a>  

</div>
