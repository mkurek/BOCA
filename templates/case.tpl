{include file="header.tpl"}
{assign var="max_pages" value=2000000}
<div class="content">
	  
  	{if $if_message==true}<div id="message">{$message}</div>{/if}

	<div id="left" class="top_button">{if $prev != '' && $prev != 0}<a href="case.php?l={$lang}&cat={$cat_s}&sid={$prev}">{/if}poprzedni<<{if $prev != ''}</a>{/if}</div>
	<div id="right" class="top_button">{if $next != '' && $next != 0}<a href="case.php?l={$lang}&cat={$cat_s}&sid={$next}">{/if}>>następny{if $next != ''}</a>{/if}</div>
	<div id="clear"> </div>
	  
	<div id="title">Case {$sid} -> {$cat}</div>
	  
	<div id="tree"><span id="part">{$tree[0]}</span>
 		{section name="i" loop=$tree start=1}
 	 		>> <span id="part">{$tree[i]}</span>
 		{/section}
	</div>
	  
 	<div id="scig2">
  		<table id="scig_table">
	  	<tr>
	  		{section name="i" loop=$images max=$max}
	  			{assign var="zmienna" value=$images[i]}
	 			<td>{$smarty.config.$zmienna}</td>
         	 	{/section}
	  
	  	</tr>
	  	<tr>
	  		{section name="i" loop=$images max=$max}			 
			 	<td><img src="scig/scig.php?desc=portal/{if $cat_name == 'zz'}zbll{else}{$cat_name}{/if}/{$images[i]}&data={$pattern}"/></td>
	  		{/section}
	  	</tr>
	  	</table>
  	</div>
	  
  	{if $if_next}
		<div id="scig2">
 			<table id="scig_table">
			<tr>
	  			{section name="i" loop=$images start=$max}
		 			{assign var="zmienna" value=$images[i]}
		 			<td>{$smarty.config.$zmienna}</td>
				{/section}
	  		</tr>
	  		<tr>
	  			{section name="i" loop=$images start=$max}			 
					   <td><img src="scig/scig.php?desc=portal/{if $cat_name == 'zz'}zbll{else}{$cat_name}{/if}/{$images[i]}&data={$pattern}"/></td>
		   		{/section}
	  		</tr>
	  		</table>
  		</div>
  	{/if}
	  
	  
	  
	  
  	<div id="case_cats">
	 	<div id="title2">{#Cats#}:</div>
 		<div id="cat"><a href="case.php?l={$lang}&sid={$sid}&cat=th">{if $cat|lower == 'th' || $cat == ''}<b>{/if}TH{if $cat|lower == 'th'}</b>{/if}</a></div>
 		<div id="cat"><a href="case.php?l={$lang}&sid={$sid}&cat=oh">{if $cat|lower == 'oh'}<b>{/if}OH{if $cat|lower == 'oh'}</b>{/if}</a></div>
	 	<div id="cat"><a href="case.php?l={$lang}&sid={$sid}&cat=fm">{if $cat|lower == 'fm'}<b>{/if}FM{if $cat|lower == 'fm'}</b>{/if}</a></div>
	</div>

	<div id="algs">
		{assign var="alg" value='alg'}
		{assign var="htm" value='htm'}
		{assign var="qtm" value='qtm'}
		{assign var="stm" value='stm'}
		{assign var="id" value='id'}
		{assign var="can_vote2" value='can_vote'}
		{assign var="username" value='user'}
		{assign var="votes" value='votes'}
			
	 	{section name="i" loop=$algs}
		 	<div id="alg">
	 			<div id="row">
		  			{if $my_alg == 'yes' && $smarty.section.i.first}<div id="alg_ma"><img src='images/{$lang}/ma.gif' /></div>{/if}
  					<div id="alg_main">{$algs[i][$alg]}</div>
		 	  		<div id="alg_moves">({$algs[i][$htm]} htm, {$algs[i][$qtm]} qtm, {$algs[i][$stm]} stm)</div>
    				</div>
	   
				<div id="clear"> </div>
	   
	   	 		<div id="row2"> 
	   	 			{if $can_vote == 'yes' && $algs[i][$can_vote2] == 1 && $can_choose_my_alg == 'yes' && (!$smarty.section.i.first || $my_alg == 'no')}{assign var="info_id" value="alg_info30"}{assign var="ma_id" value="my_alg30"}{assign var="vote_id" value="vote30"}
				        {elseif $can_vote == 'yes' && $algs[i][$can_vote2] == 1}{assign var="info_id" value="alg_info50"}{assign var="vote_id" value="vote50"}
				        {elseif $can_choose_my_alg == 'yes' && (!$smarty.section.i.first || $my_alg == 'no')}{assign var="info_id" value="alg_info50"}{assign var="ma_id" value="my_alg50"}
  	 			  	{else}{assign var="info_id" value="alg_info100"}
   	 			  	{/if}
	   	 		
 	  				{if $can_choose_my_alg == 'yes' && (!$smarty.section.i.first || $my_alg == 'no')}
		 	  			<div id="{$ma_id}"><a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&act=v3&id={$algs[i][$id]}">{#My_alg#}</a></div>
    			  		{/if}
					 
		 	  		<div id="{$info_id}">
					   <div id="pole1">{#Add#}: {$algs[i][$username]}</div>
					   <div id="pole2">{#Votes#}: {$algs[i][$votes]}</div>
			   		</div>
			 		
					 {if $can_vote == 'yes' && $algs[i][$can_vote2] == 1}
					 	<div id="{$vote_id}"><a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&act=v1&id={$algs[i][$id]}">+</a> / <a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&act=v2&id={$algs[i][$id]}">-</a>
						 {if $can_choose_my_alg == 'yes' && (!$smarty.section.i.first || $my_alg == 'no')}
						 	<a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&act=v4&id={$algs[i][$id]}"> / **</a>
						 {/if}
						 </div>
					 {/if}
			      	</div>
			      
			      	{if $can_edit == 'yes'}
			      	<div id="clear"> </div>
			      	<div id="row3"> 
			      		<a href="edit.php?l={$lang}&cat={$cat|lower}&sid={$sid}&id={$algs[i][$id]}">{#Edit#}</a>
			      	</div>
			      {/if}
				
 			 </div>
			 <div id="clear_bor"></div>
		{/section}

     	</div>

	<div  id="pages">
		{if $pages > 1 && $act_page != 1}
			{assign var="prev" value=$act_page-1}
			<a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&page={$prev}">{#Previous#}</a>
		{elseif $act_page == 1}{#Previous#}
		{/if}
		{if $act_page == 1}<span id="act_page">1</span>
		{else}<a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&page=1">1</a>
		{/if}
		
		{if $pages_start > 2}...{/if}
	 	{section name="i" loop=$pages_tab start=$pages_start max=$pages_end}
	 		{if $pages_tab[i] == $act_page}<span id="act_page">{/if}
			 <a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&page={$pages_tab[i]}">{$pages_tab[i]}</a>
			 {if $pages_tab[i] == $act_page}</span>{/if}
	 	{/section}
	 	
	 	{if $pages_end < $pages-1}...{/if}
	 	
	 	{if $pages > 1}
	 	{if $act_page == $pages}<span id="act_page">{/if}
		 <a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&page={$pages}">{$pages}</a>
	 	{if $act_page == $pages}</span>{/if}
	 	{/if}
	 	
		 {if $act_page < $pages}
		 	{assign var="next" value=$act_page+1}
			<a href="case.php?l={$lang}&cat={$cat|lower}&sid={$sid}&page={$next}">{#Next#}</a>
		{elseif $act_page == $pages}{#Next#}
		{/if}
	</div>

<div id="content_foot"><a href="index.php">{#back_to_main_site#}</a></div>

</div>

{include file="menu.tpl"}
{include file="footer.tpl"}
