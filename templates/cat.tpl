{include file="header.tpl"}
<div class="content">
<div id="tree">{$tree}</div>

<div id="title">{$met|upper}{if isset($subtitle)}: $subtitle {$smarty.config.$subtitlecd}{/if}</div>

{include file="cats/$method.tpl"}

</div>
{include file="menu.tpl"}
{include file="footer.tpl"}