{include file="header.tpl"}

<div class="content">

{if $message == true}<div id="message">ZAPISANO!</div>{/if}

<div id="sciaga">
<code>
<1,472> - ZBLL<br />
<473,774> - ZBF2L<br />
<775,795> - PLL<br />
<796,852> - OLL<br />
<853,858> - Ortega (etap 3)<br />
<859,984> - EG (<859,900> - CLL)<br />
<985, > - SS<br /><br />
</code>
</div>

<div id="title">Case {$name} -> ALG_ID: {$id}</div>

<div id="scig">
	  {section name="i" loop=$images}
					 <div id="left"><img src="scig/scig.php?desc=portal/{$cat_name}/{$images[i]}&data={$alg}" id="{$images[i]}" /></div>
	  {/section}
</div>
	  
<div id="clear"></div>
	  
<div id="message">JACube: {$jac}</div>

<form name="edit" action="edit.php?l={$lang}&cat={$cat|lower}&sid={$name[0]}{if $name[1] != $name[0]},{$name[1]}{/if}&id={$id}&act=st2" method="POST">

<input type="text" value="{$alg|sslash}" size="50" id="alg" name="alg" />

<button type='button' name='change' onclick="zmien()" >Jadziem!</button>
<br /><br />
<input type="submit" value="GO!" />

</form>

<div id="message"><a href="case.php?l={$lang}&cat={$cat|lower}&sid={$name[0]}{if $name[1] != $name[0]},{$name[1]}{/if}">{#back#}</a></div>

</div>

{include file="menu.tpl"}
{include file="footer.tpl"}