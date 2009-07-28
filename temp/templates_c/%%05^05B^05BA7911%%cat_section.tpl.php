<?php /* Smarty version 2.6.18, created on 2009-02-26 14:30:31
         compiled from cat_section.tpl */ ?>
<?php $this->assign('sid', $this->_tpl_vars['situations_id'][$this->_sections['m']['index']]); ?>
<?php $this->assign('in_s', $this->_tpl_vars['in_section'][$this->_sections['m']['index']]); ?>
<?php $this->assign('emka', $this->_sections['m']['index']+1); ?>
<?php $this->assign('img_cat', ($this->_tpl_vars['image_cat'])); ?>

<?php if ($this->_tpl_vars['what_in_section'] == 'orientation' && $this->_tpl_vars['if_permutation'] == true): ?>
	 <?php if ($this->_sections['m']['index'] == 6): ?> <?php $this->assign('permutation', 4); ?>
	 <?php else: ?>		  <?php $this->assign('permutation', 6); ?>
	 <?php endif; ?>
<?php endif; ?>

<div id="cell">
<a href='<?php echo $this->_tpl_vars['file']; ?>
.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>

	<?php if ($this->_tpl_vars['file'] == 'cat'): ?>&m=<?php echo $this->_tpl_vars['method']; ?>

		<?php if ($this->_tpl_vars['if_chapter'] == true): ?><?php if ($this->_tpl_vars['what_in_section'] == 'chapter'): ?>&ch=<?php echo $this->_tpl_vars['in_s']; ?>
<?php else: ?>&ch=<?php echo $this->_tpl_vars['chapter']; ?>
<?php endif; ?><?php endif; ?>
		<?php if ($this->_tpl_vars['if_subchapter'] == true): ?><?php if ($this->_tpl_vars['what_in_section'] == 'subchapter'): ?>&sch=<?php echo $this->_tpl_vars['in_s']; ?>
<?php else: ?>&sch=<?php echo $this->_tpl_vars['subchapter']; ?>
<?php endif; ?><?php endif; ?>
		<?php if ($this->_tpl_vars['if_orientation'] == true): ?><?php if ($this->_tpl_vars['what_in_section'] == 'orientation'): ?>&o=<?php echo $this->_tpl_vars['in_s']; ?>
<?php else: ?>&o=<?php echo $this->_tpl_vars['orientation']; ?>
<?php endif; ?><?php endif; ?>
		<?php if ($this->_tpl_vars['if_permutation'] == true): ?><?php if ($this->_tpl_vars['what_in_section'] == 'permutation'): ?>&p=<?php echo $this->_tpl_vars['in_s']; ?>
<?php else: ?>&p=<?php echo $this->_tpl_vars['permutation']; ?>
<?php endif; ?><?php endif; ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['file'] == 'case'): ?>&sid=<?php echo $this->_tpl_vars['sid']; ?>
<?php endif; ?>'>

<table id="table_cell">
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
			<td><img src ="scig/scig.php?desc=portal/<?php echo $this->_tpl_vars['img_cat']; ?>
/<?php echo $this->_tpl_vars['img_cats'][$this->_sections['j']['index']]; ?>
&data=<?php echo $this->_tpl_vars['patterns'][$this->_sections['m']['index']]; ?>
" /></td>
			<?php if ($this->_tpl_vars['level'] == 'choose_zbf2l_cat' && $this->_sections['m']['index'] != 36): ?><td><img src ="scig/scig.php?desc=portal/<?php echo $this->_tpl_vars['img_cat']; ?>
/<?php echo $this->_tpl_vars['img_cats'][$this->_sections['j']['index']]; ?>
&data=<?php echo $this->_tpl_vars['patterns'][$this->_tpl_vars['emka']]; ?>
" alt="<?php echo $this->_tpl_vars['img_cats'][$this->_sections['j']['index']]; ?>
"/></td><?php endif; ?>
<?php endfor; endif; ?>
</tr>
</table>
</a>
</div>	 