<?php /* Smarty version 2.6.18, created on 2009-07-10 16:12:36
         compiled from print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'print.tpl', 9, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="content">

<?php $this->assign('alg', 'alg'); ?>
<?php $this->assign('htm', 'htm'); ?>
<?php $this->assign('qtm', 'qtm'); ?>
<?php $this->assign('stm', 'stm'); ?>

<div id="title_top"><?php if ($this->_config[0]['vars'][$this->_tpl_vars['method']] != ''): ?><?php echo ((is_array($_tmp=$this->_config[0]['vars'][$this->_tpl_vars['method']])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['method'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
<?php endif; ?><?php if (isset ( $this->_tpl_vars['chapter'] ) && $this->_tpl_vars['chapter'] != ''): ?>: <?php echo ((is_array($_tmp=$this->_tpl_vars['chapter'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
<?php endif; ?></div>

	  	<?php if ($this->_tpl_vars['top_imgs'] != ''): ?>
			<div id="cell_special">
 				<table id="table_top">
 		   			<tr><th><?php echo $this->_config[0]['vars']['down']; ?>
</th></tr>
		   			<tr><td><img src ="scig/scig.php?desc=portal/eg/down&data=<?php echo $this->_tpl_vars['patterns'][0]; ?>
" /></td></tr>
				</table>
		    	</div>
      		<?php endif; ?>


		<?php if ($this->_tpl_vars['title_big'][1] != ''): ?><div id="title_big"><?php echo $this->_tpl_vars['title_big'][1]; ?>
</div><?php endif; ?>
     		<?php if ($this->_tpl_vars['title_little'][1] != ''): ?><div id="title_little" class="border70"><?php echo $this->_tpl_vars['title_little'][1]; ?>
</div><?php endif; ?>
		
		
		<?php if ($this->_tpl_vars['img_main'] == true && $this->_tpl_vars['top_imgs'] == ''): ?>
	 		<div id="top">
				<table id="table_top">
			 		<tr>
			 		<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['top_img_cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			 					<th><?php if ($this->_tpl_vars['top_img_cats'][$this->_sections['j']['index']] == 'down'): ?><?php echo $this->_config[0]['vars']['down']; ?>
<?php endif; ?></th>
			 		<?php endfor; endif; ?>
			 		</tr>
					 <tr>
	  		 		<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['top_img_cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						  <td><img src ="scig/scig.php?desc=portal/<?php echo $this->_tpl_vars['top_img_cat']; ?>
/<?php echo $this->_tpl_vars['top_img_cats'][$this->_sections['j']['index']]; ?>
&data=<?php echo $this->_tpl_vars['patterns'][0]; ?>
" /></td>
					<?php endfor; endif; ?>
					</tr>
				</table>
		    	</div>
		<?php endif; ?>

		
		<?php if ($this->_tpl_vars['column'] == 3): ?>
	 		 <?php $this->assign('start2', '2'); ?>
	 		 <?php $this->assign('left_id', 'left30'); ?>
	 		 <?php $this->assign('right_id', 'right30'); ?>
	   	<?php else: ?>
 			 <?php $this->assign('start2', '1'); ?>
 			 <?php $this->assign('left_id', 'left50'); ?>
	 		 <?php $this->assign('right_id', 'right50'); ?>
	   	<?php endif; ?>
		
		

     <table id="print_table">
		<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['algs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['step'] = ((int)$this->_tpl_vars['column']) == 0 ? 1 : (int)$this->_tpl_vars['column'];
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = min(ceil(($this->_sections['m']['step'] > 0 ? $this->_sections['m']['loop'] - $this->_sections['m']['start'] : $this->_sections['m']['start']+1)/abs($this->_sections['m']['step'])), $this->_sections['m']['max']);
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
  			<?php $this->assign('temp', $this->_sections['m']['index']+3); ?>
  			<?php if ($this->_tpl_vars['temp'] <= $this->_tpl_vars['size']): ?> <?php $this->assign('max', $this->_tpl_vars['column']); ?>
     			<?php else: ?><?php $this->assign('max', $this->_tpl_vars['size']-$this->_sections['m']['index']); ?>
     			<?php endif; ?>
  			<tr id="main_tr">
     				<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['algs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['start'] = (int)$this->_tpl_vars['m'];
$this->_sections['n']['max'] = (int)$this->_tpl_vars['max'];
$this->_sections['n']['show'] = true;
if ($this->_sections['n']['max'] < 0)
    $this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
if ($this->_sections['n']['start'] < 0)
    $this->_sections['n']['start'] = max($this->_sections['n']['step'] > 0 ? 0 : -1, $this->_sections['n']['loop'] + $this->_sections['n']['start']);
else
    $this->_sections['n']['start'] = min($this->_sections['n']['start'], $this->_sections['n']['step'] > 0 ? $this->_sections['n']['loop'] : $this->_sections['n']['loop']-1);
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = min(ceil(($this->_sections['n']['step'] > 0 ? $this->_sections['n']['loop'] - $this->_sections['n']['start'] : $this->_sections['n']['start']+1)/abs($this->_sections['n']['step'])), $this->_sections['n']['max']);
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
  	 			 	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "print_section.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
     				<?php endfor; endif; ?>
     			</tr>
           	<?php endfor; endif; ?>
					  									  
     </table>




<div  id="avg">
		<b>Avg: </b> htm: <?php echo $this->_tpl_vars['htm_avg']; ?>
, qtm: <?php echo $this->_tpl_vars['qtm_avg']; ?>
, stm: <?php echo $this->_tpl_vars['stm_avg']; ?>
;
	</div>

<div id="content_foot"><a href='<?php echo $this->_tpl_vars['file']; ?>
.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=<?php echo $this->_tpl_vars['method']; ?>
<?php if ($this->_tpl_vars['if_chapter'] == true && $this->_tpl_vars['what_in_section'] != 'chapter'): ?>&ch=<?php echo $this->_tpl_vars['chapter']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_subchapter'] == true && $this->_tpl_vars['what_in_section'] != 'subchapter'): ?>&sch=<?php echo $this->_tpl_vars['subchapter']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_orientation'] == true && $this->_tpl_vars['what_in_section'] != 'orientation'): ?>&o=<?php echo $this->_tpl_vars['orientation']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_permutation'] == true && $this->_tpl_vars['what_in_section'] != 'permutation'): ?>&p=<?php echo $this->_tpl_vars['permutation']; ?>
<?php endif; ?>'><?php echo $this->_config[0]['vars']['back']; ?>
</a></div>
</div>