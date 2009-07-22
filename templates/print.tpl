{include file="header.tpl"}
<div class="content">

{assign var="alg" value='alg'}
{assign var="htm" value='htm'}
{assign var="qtm" value='qtm'}
{assign var="stm" value='stm'}

<div id="title_top">{if $smarty.config.$method != ''}{$smarty.config.$method|upper}{else}{$method|upper}{/if}{if isset($chapter) && $chapter != ''}: {$chapter|upper}{/if}</div>

	  	{if $top_imgs != ''}
			<div id="cell_special">
 				<table id="table_top">
 		   			<tr><th>{#down#}</th></tr>
		   			<tr><td><img src ="scig/scig.php?desc=portal/eg/down&data={$patterns[0]}" /></td></tr>
				</table>
		    	</div>
      		{/if}


		{if $title_big[1] != ''}<div id="title_big">{$title_big[1]}</div>{/if}
     		{if $title_little[1] != ''}<div id="title_little" class="border70">{$title_little[1]}</div>{/if}
		
		
		{if $img_main == true && $top_imgs == ''}
	 		<div id="top">
				<table id="table_top">
			 		<tr>
			 		{section name="j" loop=$top_img_cats}
			 					<th>{if $top_img_cats[j] == 'down'}{#down#}{/if}</th>
			 		{/section}
			 		</tr>
					 <tr>
	  		 		{section name="j" loop=$top_img_cats}
						  <td><img src ="scig/scig.php?desc=portal/{$top_img_cat}/{$top_img_cats[j]}&data={$patterns[0]}" /></td>
					{/section}
					</tr>
				</table>
		    	</div>
		{/if}

		
		{if $column == 3}
	 		 {assign var='start2' value='2'}
	 		 {assign var='left_id' value="left30"}
	 		 {assign var="right_id" value="right30"}
	   	{else}
 			 {assign var='start2' value='1'}
 			 {assign var='left_id' value="left50"}
	 		 {assign var="right_id" value="right50"}
	   	{/if}
		
		

     <table id="print_table">
		{section name="m" loop=$algs step=$column}
  			{assign var='temp' value=$smarty.section.m.index+3}
  			{if $temp<=$size} {assign var='max' value=$column}
     			{else}{assign var='max' value=$size-$smarty.section.m.index}
     			{/if}
  			<tr id="main_tr">
     				{section name="n" loop=$algs start=$m max=$max}
  	 			 	{include file="print_section.tpl"}
     				{/section}
     			</tr>
           	{/section}
					  									  
     </table>



{*
		{if $column == 3}
		<div id="sr30">
			  {section name="m" loop=$algs step=$column start=1}
  			    {include file="print_section.tpl"}
		     {/section}
		</div>
		{/if}
		
		
		<div id="{$right_id}">
	       {section name="m" loop=$algs start=$start2 step=$column}
  			    {include file="print_section.tpl"}
		     {/section}
	   </div>

<div id="clear_bor"> </div>
*}

<div  id="avg">
		<b>Avg: </b> htm: {$htm_avg}, qtm: {$qtm_avg}, stm: {$stm_avg};
	</div>

<div id="content_foot"><a href='{$file}.php?l={$lang}&cat={$cat_s}&m={$method}{if $if_chapter == true && $what_in_section != 'chapter'}&ch={$chapter}{/if}{if $if_subchapter == true && $what_in_section != 'subchapter'}&sch={$subchapter}{/if}{if $if_orientation == true && $what_in_section != 'orientation'}&o={$orientation}{/if}{if $if_permutation == true && $what_in_section != 'permutation'}&p={$permutation}{/if}'>{#back#}</a></div>
</div>
