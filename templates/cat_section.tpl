{assign var="sid" value=$situations_id[m]}
{assign var="in_s" value=$in_section[m]}
{assign var="emka" value=$smarty.section.m.index+1}
{assign var="img_cat" value="$image_cat"}

{if $what_in_section == 'orientation' && $if_permutation==true }
	 {if $smarty.section.m.index == 6} {assign var="permutation" value=4}
	 {else}		  {assign var="permutation" value=6}
	 {/if}
{/if}

<div id="cell">
<a href='{$file}.php?l={$lang}&cat={$cat_s}
	{if $file=='cat'}&m={$method}
		{if $if_chapter == true}{if $what_in_section == 'chapter'}&ch={$in_s}{else}&ch={$chapter}{/if}{/if}
		{if $if_subchapter == true}{if $what_in_section == 'subchapter'}&sch={$in_s}{else}&sch={$subchapter}{/if}{/if}
		{if $if_orientation == true}{if $what_in_section == 'orientation'}&o={$in_s}{else}&o={$orientation}{/if}{/if}
		{if $if_permutation == true}{if $what_in_section == 'permutation'}&p={$in_s}{else}&p={$permutation}{/if}{/if}
	{/if}
	{if $file=='case'}&sid={$sid}{/if}'>

<table id="table_cell">
<tr>
{section name="k" loop=$img_cats}
<th>{if $img_cats[k] == 'down'}{#down#}{/if}{if $method == 'ortega' && $chapter == 'cp' && $img_cats[k] == 'top_pll'}{#top#}{/if}</th>
{/section}
</tr>
<tr>	 		   	 
{section name="j" loop=$img_cats}
			<td><img src ="scig/scig.php?desc=portal/{$img_cat}/{$img_cats[j]}&data={$patterns[m]}" /></td>
			{if $level=='choose_zbf2l_cat' && $smarty.section.m.index != 36}<td><img src ="scig/scig.php?desc=portal/{$img_cat}/{$img_cats[j]}&data={$patterns[$emka]}" alt="{$img_cats[j]}"/></td>{/if}
{/section}
</tr>
</table>
</a>
</div>	 
