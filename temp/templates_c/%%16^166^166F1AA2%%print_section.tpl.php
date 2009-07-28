<?php /* Smarty version 2.6.18, created on 2009-07-10 23:34:47
         compiled from print_section.tpl */ ?>
<?php $this->assign('emka', $this->_sections['m']['index']+$this->_tpl_vars['n']+1); ?>
<?php $this->assign('licz', $this->_sections['m']['index']+$this->_sections['n']['index']); ?>
<?php $this->assign('nast', $this->_tpl_vars['licz']+2); ?>

<?php $this->assign('pattern_licz', $this->_tpl_vars['patterns'][$this->_tpl_vars['licz']]); ?>
<?php $this->assign('pattern_nast', $this->_tpl_vars['patterns'][$this->_tpl_vars['nast']]); ?>


<?php if ($this->_tpl_vars['sids_table'][$this->_tpl_vars['licz']] == 0): ?>
<td> 
</td>
<?php else: ?>

<td title='nad' <?php if ($this->_tpl_vars['licz']%$this->_tpl_vars['column'] == 0): ?>class="lewa"<?php elseif ($this->_tpl_vars['licz']%$this->_tpl_vars['column'] == 2 && $this->_tpl_vars['column'] != 2): ?>class="prawa"<?php endif; ?>>
	<a href="case.php?lang=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&sid=<?php echo $this->_tpl_vars['sids_table'][$this->_tpl_vars['licz']]; ?>
">	
	<table id="table_cell">
	<?php if ($this->_tpl_vars['titles_cell'][$this->_tpl_vars['licz']] != ''): ?><tr><td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" id="title_cell"><?php if ($this->_tpl_vars['titles_cell_before'] == true): ?><?php echo $this->_config[0]['vars'][$this->_tpl_vars['titles_cell_text']]; ?>
 <?php endif; ?><?php echo $this->_tpl_vars['titles_cell'][$this->_tpl_vars['licz']]; ?>
<?php if ($this->_tpl_vars['titles_cell_before'] == false): ?> <?php echo $this->_config[0]['vars'][$this->_tpl_vars['titles_cell_text']]; ?>
<?php endif; ?></td></tr><?php endif; ?>
		<tr>
			<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['img_cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
			<th><?php if ($this->_tpl_vars['img_cats'][$this->_sections['k']['index']] == 'down'): ?><?php echo $this->_config[0]['vars']['down']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['method'] == 'ortega' && $this->_tpl_vars['chapter'] == 'cp' && $this->_tpl_vars['img_cats'][$this->_sections['k']['index']] == 'top_pll'): ?><?php echo $this->_config[0]['vars']['top']; ?>
<?php endif; ?></th>
			<?php endfor; endif; ?>
		</tr>

		<tr>	 
		   	 
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['img_cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
			<td><img src ="scig/scig.php?desc=portal/print/<?php echo $this->_tpl_vars['image_cat']; ?>
/<?php echo $this->_tpl_vars['img_cats'][$this->_sections['j']['index']]; ?>
&data=<?php echo $this->_tpl_vars['pattern_licz']; ?>
" /></td>
			<?php endfor; endif; ?>
		</tr>
		
		<tr>
			<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" id="cell_with_alg">
			<?php echo $this->_tpl_vars['algs'][$this->_tpl_vars['licz']][$this->_tpl_vars['alg']]; ?>
 (<?php echo $this->_tpl_vars['algs'][$this->_tpl_vars['licz']][$this->_tpl_vars['htm']]; ?>
, <?php echo $this->_tpl_vars['algs'][$this->_tpl_vars['licz']][$this->_tpl_vars['qtm']]; ?>
, <?php echo $this->_tpl_vars['algs'][$this->_tpl_vars['licz']][$this->_tpl_vars['stm']]; ?>
)
			</td>
		</tr>
		
		<tr> 
		<td colspan=2>emka: <?php echo $this->_tpl_vars['emka']; ?>
; $licz: <?php echo $this->_tpl_vars['licz']; ?>
; $nast: <?php echo $this->_tpl_vars['nast']; ?>
; $m: <?php echo $this->_sections['m']['index']; ?>
; $n: <?php echo $this->_sections['n']['index']; ?>
;</td>
		</tr> 
		
	</table>
	</a>
</td>	 
<?php endif; ?>
<?php if ($this->_tpl_vars['title_big'][$this->_tpl_vars['nast']] != ''): ?>

	</tr>
	</table>
		
		
	<?php if ($this->_tpl_vars['top_imgs'] != '' && ( $this->_tpl_vars['nast'] == 41 || $this->_tpl_vars['nast'] == 81 )): ?>
		<div id="cell_special">
	  		<table id="table_top">
	   			<tr><th><?php echo $this->_config[0]['vars']['down']; ?>
</th></tr>
	   			<tr><td><img src ="scig/scig.php?desc=portal/eg/down&data=<?php echo $this->_tpl_vars['pattern_nast']; ?>
" /></td></tr>
			</table>
		</div>
	<?php endif; ?>

	<table id="print_table">
	<tr>
	<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" id="title_big"><?php echo $this->_tpl_vars['title_big'][$this->_tpl_vars['nast']]; ?>
</td>
	</tr>
	<tr id="main_tr">
	
	
<?php endif; ?>

<?php if ($this->_tpl_vars['title_little'][$this->_tpl_vars['nast']] != ''): ?>
	</tr>
	<tr>
	<td colspan="<?php echo $this->_tpl_vars['colspan']; ?>
" id="title_little"><?php echo $this->_tpl_vars['title_little'][$this->_tpl_vars['nast']]; ?>
<div class="border70"></td>
	</tr> 
	<tr id="main_tr">
<?php endif; ?>