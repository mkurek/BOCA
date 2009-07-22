{include file="header.tpl"}
<div class="content">


<div id="title">
{if $level == 'method_choose'}
{#method_choose#}
{else}
{if $smarty.config.$method != ''}{$smarty.config.$method|upper}{else}{$method|upper}{/if}
{if isset($chapter) && $chapter != ''} >> {$chapter|upper}{/if}
{if isset($subchapter) && $subchapter != ''} >> {$subchapter|upper}{/if}

{/if}
</div>



<div id="tree"><span id="part">{$tree[0]}</span>
{section name="i" loop=$tree start=1}
 >> <span id="part">{$tree[i]}</span>
{/section}
</div>

{if $level == 'method_choose'} {include file="cats/cats.tpl"}

{elseif $level == 'choose_zz_cat'}
    	 <div id="cell"><a href="cat.php?l={$lang}&cat={$cat_s}&m=zb&ch=zbll">{#zz_method_a#}</a></div>
	 <div id="cell"><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=b">{#zz_method_b#}</a></div>
	 <div id="cell"><a href="cat.php?l={$lang}&cat={$cat_s}&m=zz&ch=d">{#zz_method_d#}</a></div>
	 
{elseif $level == 'choose_mgls_cat'}
    	 <div id="cell"><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=els">{#mgls_els#}</a></div>
	 <div id="cell"><a href="cat.php?l={$lang}&cat={$cat_s}&m=mgls&ch=cls">{#mgls_cls#}</a></div>
	 
{elseif $level == 'choose_fridrich_cat'}
	 <div id="cell"><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=f2l"><img src ="scig/scig.php?desc=portal/f2l/cube&data=" /></a></div>	  	 
	 <div id="cell"><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=oll"><img src ="scig/scig.php?desc=portal/oll/cube_oll&data=" /></a></div>
	 <div id="cell"><a href="cat.php?l={$lang}&cat={$cat_s}&m=fridrich&ch=pll"><img src ="scig/scig.php?desc=portal/pll/cube&data=" /></a></div>
	 
{elseif $level == 'choose_ortega_cat'}
	<div id="cell">
 		<a href="cat.php?l={$lang}&cat={$cat_s}&m=ortega&ch=co">
		 	<img src="scig/scig.php?desc=portal/ortega/cube_oll&data={$algs[1]}" />
 		</a>
	</div>
		  
 	<div id="cell">
 		<a href="cat.php?l={$lang}&cat={$cat_s}&m=ortega&ch=cp">
	 		<img src="scig/scig.php?desc=portal/ortega/cube&data={$algs[0]}" />
	 	</a>
   	</div>

{elseif $level == 'choose_zb_cat'}

		 <div id="cell">
			<a href='cat.php?l=pl&cat=th&m=zb&ch=zbf2l'>
				<img src ="scig/scig.php?desc=portal/zbf2l/cube&data=" />
			</a>
		</div>

		<div id="cell">
			<a href='cat.php?l=pl&cat=th&m=zb&ch=zbll'>
				<img src ="scig/scig.php?desc=portal/zbll/cube&data=" />
			</a>
		</div>

	

	 
{else}
<span id="printbuttons">
		<div id="printbutton"><a href='cat.php?l={$lang}&cat=th&m={$method}{if $if_chapter == true && $what_in_section != 'chapter'}&ch={$chapter}{/if}{if $if_subchapter == true && $what_in_section != 'subchapter'}&sch={$subchapter}{/if}{if $if_orientation == true && $what_in_section != 'orientation'}&o={$orientation}{/if}{if $if_permutation == true && $what_in_section != 'permutation'}&p={$permutation}{/if}&mode=print'><img src="images/printbutton.gif" alt="print" />TH</a></div>
		
		<div id="printbutton"><a href='cat.php?l={$lang}&cat=oh&m={$method}{if $if_chapter == true && $what_in_section != 'chapter'}&ch={$chapter}{/if}{if $if_subchapter == true && $what_in_section != 'subchapter'}&sch={$subchapter}{/if}{if $if_orientation == true && $what_in_section != 'orientation'}&o={$orientation}{/if}{if $if_permutation == true && $what_in_section != 'permutation'}&p={$permutation}{/if}&mode=print'><img src="images/printbutton.gif" alt="print" />OH</a></div>
		
		<div id="printbutton"><a href='cat.php?l={$lang}&cat=fm&m={$method}{if $if_chapter == true && $what_in_section != 'chapter'}&ch={$chapter}{/if}{if $if_subchapter == true && $what_in_section != 'subchapter'}&sch={$subchapter}{/if}{if $if_orientation == true && $what_in_section != 'orientation'}&o={$orientation}{/if}{if $if_permutation == true && $what_in_section != 'permutation'}&p={$permutation}{/if}&mode=print'><img src="images/printbutton.gif" alt="print" />FM</a></div>
</span>		

<div  id="clear"> </div>
		{if $img_main == true}
			 <div id="top">
			 		<table id="table_top">
			 		<tr>
			 		{section name="j" loop=$top_img_cats}
			 					<th>{if $top_img_cats[j] == 'down'}{#down#}{/if}</th>
			 		{/section}
			 		</tr><tr>
	  		 		{section name="j" loop=$top_img_cats}
						  <td><img src ="scig/scig.php?desc=portal/{$top_img_cat}/{$top_img_cats[j]}&data={$patterns[0]}" /></td>
					{/section}
					</tr></table>
		    </div>
		{/if}


		{if $step == 4}
	 		 {assign var='start2' value='2'}
	   {else}
 			 {assign var='start2' value='1'}
	   {/if}

      <div id="left">
	  		  {section name="m" loop=$patterns step=$step}
  			    {include file="cat_section.tpl"}
		     {/section}
      </div>



		<div id="right">
	       {section name="m" loop=$patterns start=$start2 step=$step}
  			    {include file="cat_section.tpl"}
		     {/section}
	   </div>



	<div  id="clear">
	 </div>
	

	<div  id="avg">
		<b>{#avg#}: </b> htm: {$htm_avg}, qtm: {$qtm_avg}, stm: {$stm_avg};
	</div>


{/if}

</div>
{include file="menu.tpl"}
{include file="footer.tpl"}
