{include file="header.tpl"}
<div class="content">
{assign var='title' value='Tytul'}
{assign var='content' value='Tresc'}
{assign var='author' value='Dodal'}
{assign var='date' value='Data'}
{assign var='comments' value='kom'}
{assign var='id' value='ID'}


{if $what == 'newses_display'}
	<div id="main_title">{#Welcome#}</div>
	<div id="subtitle">{#Algs_in_our_base#}{$algs_inb}{#Algs_in_our_base_cd#}</div>
	{section name=i loop=$news}
			<div id = "news_cell">
				<div id='news_added'>{#added#}: {$news[i][$date]}</div> 
				<div id="news_title"><a href="index.php?lang={$lang}&news_id={$news[i][$id]}">{$news[i][$title]}</a></div> 
				
				<div id="news_content">
				{$news[i][$content]}... <a href="index.php?lang={$lang}&news_id={$news[i][$id]}">[{#more#}]</a>
				</div> 
				
				
				<div id='news_foot'>{#author#}: {$news[i][$author]} || <a href="index.php?lang={$lang}&news_id={$news[i][$id]}#comments">{#comments#}: {$news[i][$comments]}</a></div> 
			</div>
	{/section}

	
{else}
	<div id = "news_cell">
		<div id='news_added'>{#added#}: {$news[$date]}</div> 
		<div id="news_title">{$news[$title]}</div> 
				
		<div id="news_content">
			{$news[$content]}
		</div> 
				
		<div id='news_foot'>{#author#}: {$news[$author]} || <a href="index.php?lang={$lang}&news_id={$news[i][$id]}#comments">{#comments#}: {$news[$comments]}</a></div> 
	</div>
	
	<div id="news_comments">	
		<a name="comments"><div  id="news_comments_title">{#comments#}</div></a>
		
		{section name=i loop=$kom}
			<div id="comment_cell">
				<div id="comment_top">{#author#}: {$kom[i][$author]}</div>
				<div id='comment_added'>{#added#}: {$kom[i][$date]}</div> 
				<div id="comment_content">
				{$kom[i][$content]}
				</div> 
			</div>
		{/section}
	</div>
	
	{if $log_status==1}
	<div id="add_comment">
		<div id="news_title">{#add_comment#}</div>
		<form name="comment_add" id="comment_add" method="POST" action="index.php?lang={$lang}&page={$act_page}&news_id={$news[$id]}&act=send">
		<textarea cols=60 rows=7 name="comment"></textarea> <br />
		<input type="submit" value="{#Send#}" />
		</form>
	</div>
	
	{else}
	
	<div id="message_small">{#Login_to_write_comment#}</div>
	{/if}
{/if}

<div  id="pages">
		{if $pages > 1 && $act_page != 1}
			{assign var="prev" value=$act_page-1}
			<a href="index.php?l={$lang}&page={$prev}{if $what=='news_display'}&news_id={$news[$id]}#comments{/if}">{#Previous#}</a>
		{elseif $act_page == 1}{#Previous#}
		{/if}
		
		{if $act_page == 1}<span id="act_page">1</span>
		{else}<a href="index.php?l={$lang}&page=1{if $what=='news_display'}&news_id={$news[$id]}#comments{/if}">1</a>
		{/if}
		
		{if $pages_start > 2}...{/if}
	 	{section name="i" loop=$pages_tab start=$pages_start max=$pages_end}
	 		{if $pages_tab[i] == $act_page}<span id="act_page">{/if}
			 <a href="index.php?l={$lang}&page={$pages_tab[i]}{if $what=='news_display'}&news_id={$news[$id]}#comments{/if}">{$pages_tab[i]}</a>
			 {if $pages_tab[i] == $act_page}</span>{/if}
	 	{/section}
	 	
	 	{if $pages_end < $pages-1}...{/if}
	 	
	 	{if $pages > 1}
	 	{if $act_page == $pages}<span id="act_page">{/if}
		 <a href="index.php?l={$lang}&page={$pages}{if $what=='news_display'}&news_id={$news[$id]}#comments{/if}">{$pages}</a>
	 	{if $act_page == $pages}</span>{/if}
	 	{/if}
	 	
		 {if $act_page < $pages}
		 	{assign var="next" value=$act_page+1}
			<a href="index.php?l={$lang}&page={$next}{if $what=='news_display'}&news_id={$news[$id]}#comments{/if}">{#Next#}</a>
		{else}{#Next#}
		{/if}
	</div>


{*
<div id="text2">{#how_to_start#}</div>

<div id="scig_cats">
<table>
<tr>
<td>cube</td><td>cube_oll</td><td>top_pll</td>
</tr>
<tr>
<td><img src="scig/scig.php?desc=portal/print/zbll/cube&data=(U') F R F' r U R' U' r'" /></td>
<td><img src="scig/scig.php?desc=portal/print/zbll/cube_oll&data=(U') F R F' r U R' U' r'" /></td>
<td><img src="scig/scig.php?desc=portal/print/zbll/top_pll&data=(U') F R F' r U R' U' r'"/></td>
</tr>

<tr>
<td>top_oll</td><td>top_recognition</td><td>arrows</td>
</tr>
<tr>
<td><img src="scig/scig.php?desc=portal/print/zbll/top_oll&data=(U') F R F' r U R' U' r'" /></td>
<td><img src="scig/scig.php?desc=portal/print/zbll/top_recognition&data=(U') F R F' r U R' U' r'" /></td>
<td><img src="scig/scig.php?desc=portal/print/zbll/arrows&data=(U') F R F' r U R' U' r'" /></td>
</tr>

<tr>
<td colspan="3">down</td>
</tr>
<tr>
<td colspan="3"><img src="scig/scig.php?desc=portal/print/eg/down&data=F U' F L F L' U' L2 F2 (U)" /></td>
</tr>
</table>
</div>
*}
</div>
{include file="menu.tpl"}
{include file="footer.tpl"}
