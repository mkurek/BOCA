{assign var="emka" value=$smarty.section.m.index+$n+1}
{assign var="licz" value=$smarty.section.m.index+$smarty.section.n.index}
{assign var='nast' value=$licz+2}

{assign var='pattern_licz' value=$patterns[$licz]}
{assign var='pattern_nast' value=$patterns[$nast]}


{if $sids_table[$licz] == 0}
<td> 
</td>
{else}

<td title='nad' {if $licz%$column==0}class="lewa"{elseif $licz%$column==2 && $column != 2}class="prawa"{/if}>
	<a href="case.php?lang={$lang}&cat={$cat_s}&sid={$sids_table[$licz]}">	
	<table id="table_cell">
	{if $titles_cell[$licz] != ''}<tr><td colspan="{$colspan}" id="title_cell">{if $titles_cell_before == true}{$smarty.config.$titles_cell_text} {/if}{$titles_cell[$licz]}{if $titles_cell_before == false} {$smarty.config.$titles_cell_text}{/if}</td></tr>{/if}
		<tr>
			{section name="k" loop=$img_cats}
			<th>{if $img_cats[k] == 'down'}{#down#}{/if}{if $method == 'ortega' && $chapter == 'cp' && $img_cats[k] == 'top_pll'}{#top#}{/if}</th>
			{/section}
		</tr>

		<tr>	 
		   	 
			{section name="j" loop=$img_cats}
			<td><img src ="scig/scig.php?desc=portal/print/{$image_cat}/{$img_cats[j]}&data={$pattern_licz}" /></td>
			{/section}
		</tr>
		
		<tr>
			<td colspan="{$colspan}" id="cell_with_alg">
			{$algs[$licz][$alg]} ({$algs[$licz][$htm]}, {$algs[$licz][$qtm]}, {$algs[$licz][$stm]})
			</td>
		</tr>
		{*
		<tr> 
		<td colspan=2>emka: {$emka}; $licz: {$licz}; $nast: {$nast}; $m: {$smarty.section.m.index}; $n: {$smarty.section.n.index};</td>
		</tr> 
		*}
	</table>
	</a>
</td>	 
{/if}
{if $title_big[$nast] != ''}

	</tr>
	</table>
		
	{* dla EG*}
	
	{if $top_imgs != '' && ($nast == 41 || $nast == 81)}
		<div id="cell_special">
	  		<table id="table_top">
	   			<tr><th>{#down#}</th></tr>
	   			<tr><td><img src ="scig/scig.php?desc=portal/eg/down&data={$pattern_nast}" /></td></tr>
			</table>
		</div>
	{/if}

	<table id="print_table">
	<tr>
	<td colspan="{$colspan}" id="title_big">{$title_big[$nast]}</td>
	</tr>
	<tr id="main_tr">
	
	
{/if}

{if $title_little[$nast] != ''}
	</tr>
	<tr>
	<td colspan="{$colspan}" id="title_little">{$title_little[$nast]}<div class="border70"></td>
	</tr> 
	<tr id="main_tr">
{/if}
