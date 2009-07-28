<?php /* Smarty version 2.6.18, created on 2009-07-09 19:01:53
         compiled from cat_new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'cat_new.tpl', 9, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="content">


<div id="title">
<?php if ($this->_tpl_vars['level'] == 'method_choose'): ?>
<?php echo $this->_config[0]['vars']['method_choose']; ?>

<?php else: ?>
<?php if ($this->_config[0]['vars'][$this->_tpl_vars['method']] != ''): ?><?php echo ((is_array($_tmp=$this->_config[0]['vars'][$this->_tpl_vars['method']])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['method'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['chapter'] ) && $this->_tpl_vars['chapter'] != ''): ?> >> <?php echo ((is_array($_tmp=$this->_tpl_vars['chapter'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
<?php endif; ?>
<?php if (isset ( $this->_tpl_vars['subchapter'] ) && $this->_tpl_vars['subchapter'] != ''): ?> >> <?php echo ((is_array($_tmp=$this->_tpl_vars['subchapter'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
<?php endif; ?>

<?php endif; ?>
</div>



<div id="tree"><span id="part"><?php echo $this->_tpl_vars['tree'][0]; ?>
</span>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tree']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)1;
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
 >> <span id="part"><?php echo $this->_tpl_vars['tree'][$this->_sections['i']['index']]; ?>
</span>
<?php endfor; endif; ?>
</div>

<?php if ($this->_tpl_vars['level'] == 'method_choose'): ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cats/cats.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php elseif ($this->_tpl_vars['level'] == 'choose_zz_cat'): ?>
    	 <div id="cell"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll"><?php echo $this->_config[0]['vars']['zz_method_a']; ?>
</a></div>
	 <div id="cell"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=b"><?php echo $this->_config[0]['vars']['zz_method_b']; ?>
</a></div>
	 <div id="cell"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=d"><?php echo $this->_config[0]['vars']['zz_method_d']; ?>
</a></div>
	 
<?php elseif ($this->_tpl_vars['level'] == 'choose_mgls_cat'): ?>
    	 <div id="cell"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=els"><?php echo $this->_config[0]['vars']['mgls_els']; ?>
</a></div>
	 <div id="cell"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls"><?php echo $this->_config[0]['vars']['mgls_cls']; ?>
</a></div>
	 
<?php elseif ($this->_tpl_vars['level'] == 'choose_fridrich_cat'): ?>
	 <div id="cell"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=f2l"><img src ="scig/scig.php?desc=portal/f2l/cube&data=" /></a></div>	  	 
	 <div id="cell"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=oll"><img src ="scig/scig.php?desc=portal/oll/cube_oll&data=" /></a></div>
	 <div id="cell"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=pll"><img src ="scig/scig.php?desc=portal/pll/cube&data=" /></a></div>
	 
<?php elseif ($this->_tpl_vars['level'] == 'choose_ortega_cat'): ?>
	<div id="cell">
 		<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ortega&ch=co">
		 	<img src="scig/scig.php?desc=portal/ortega/cube_oll&data=<?php echo $this->_tpl_vars['algs'][1]; ?>
" />
 		</a>
	</div>
		  
 	<div id="cell">
 		<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ortega&ch=cp">
	 		<img src="scig/scig.php?desc=portal/ortega/cube&data=<?php echo $this->_tpl_vars['algs'][0]; ?>
" />
	 	</a>
   	</div>

<?php elseif ($this->_tpl_vars['level'] == 'choose_zb_cat'): ?>

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

	

	 
<?php else: ?>
<span id="printbuttons">
		<div id="printbutton"><a href='cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=th&m=<?php echo $this->_tpl_vars['method']; ?>
<?php if ($this->_tpl_vars['if_chapter'] == true && $this->_tpl_vars['what_in_section'] != 'chapter'): ?>&ch=<?php echo $this->_tpl_vars['chapter']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_subchapter'] == true && $this->_tpl_vars['what_in_section'] != 'subchapter'): ?>&sch=<?php echo $this->_tpl_vars['subchapter']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_orientation'] == true && $this->_tpl_vars['what_in_section'] != 'orientation'): ?>&o=<?php echo $this->_tpl_vars['orientation']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_permutation'] == true && $this->_tpl_vars['what_in_section'] != 'permutation'): ?>&p=<?php echo $this->_tpl_vars['permutation']; ?>
<?php endif; ?>&mode=print'><img src="images/printbutton.gif" alt="print" />TH</a></div>
		
		<div id="printbutton"><a href='cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=oh&m=<?php echo $this->_tpl_vars['method']; ?>
<?php if ($this->_tpl_vars['if_chapter'] == true && $this->_tpl_vars['what_in_section'] != 'chapter'): ?>&ch=<?php echo $this->_tpl_vars['chapter']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_subchapter'] == true && $this->_tpl_vars['what_in_section'] != 'subchapter'): ?>&sch=<?php echo $this->_tpl_vars['subchapter']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_orientation'] == true && $this->_tpl_vars['what_in_section'] != 'orientation'): ?>&o=<?php echo $this->_tpl_vars['orientation']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_permutation'] == true && $this->_tpl_vars['what_in_section'] != 'permutation'): ?>&p=<?php echo $this->_tpl_vars['permutation']; ?>
<?php endif; ?>&mode=print'><img src="images/printbutton.gif" alt="print" />OH</a></div>
		
		<div id="printbutton"><a href='cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=fm&m=<?php echo $this->_tpl_vars['method']; ?>
<?php if ($this->_tpl_vars['if_chapter'] == true && $this->_tpl_vars['what_in_section'] != 'chapter'): ?>&ch=<?php echo $this->_tpl_vars['chapter']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_subchapter'] == true && $this->_tpl_vars['what_in_section'] != 'subchapter'): ?>&sch=<?php echo $this->_tpl_vars['subchapter']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_orientation'] == true && $this->_tpl_vars['what_in_section'] != 'orientation'): ?>&o=<?php echo $this->_tpl_vars['orientation']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['if_permutation'] == true && $this->_tpl_vars['what_in_section'] != 'permutation'): ?>&p=<?php echo $this->_tpl_vars['permutation']; ?>
<?php endif; ?>&mode=print'><img src="images/printbutton.gif" alt="print" />FM</a></div>
</span>		

<div  id="clear"> </div>
		<?php if ($this->_tpl_vars['img_main'] == true): ?>
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
			 		</tr><tr>
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
					</tr></table>
		    </div>
		<?php endif; ?>


		<?php if ($this->_tpl_vars['step'] == 4): ?>
	 		 <?php $this->assign('start2', '2'); ?>
	   <?php else: ?>
 			 <?php $this->assign('start2', '1'); ?>
	   <?php endif; ?>

      <div id="left">
	  		  <?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['patterns']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['step'] = ((int)$this->_tpl_vars['step']) == 0 ? 1 : (int)$this->_tpl_vars['step'];
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
  			    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cat_section.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		     <?php endfor; endif; ?>
      </div>



		<div id="right">
	       <?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['patterns']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['start'] = (int)$this->_tpl_vars['start2'];
$this->_sections['m']['step'] = ((int)$this->_tpl_vars['step']) == 0 ? 1 : (int)$this->_tpl_vars['step'];
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
if ($this->_sections['m']['start'] < 0)
    $this->_sections['m']['start'] = max($this->_sections['m']['step'] > 0 ? 0 : -1, $this->_sections['m']['loop'] + $this->_sections['m']['start']);
else
    $this->_sections['m']['start'] = min($this->_sections['m']['start'], $this->_sections['m']['step'] > 0 ? $this->_sections['m']['loop'] : $this->_sections['m']['loop']-1);
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
  			    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cat_section.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		     <?php endfor; endif; ?>
	   </div>



	<div  id="clear">
	 </div>
	

	<div  id="avg">
		<b><?php echo $this->_config[0]['vars']['avg']; ?>
: </b> htm: <?php echo $this->_tpl_vars['htm_avg']; ?>
, qtm: <?php echo $this->_tpl_vars['qtm_avg']; ?>
, stm: <?php echo $this->_tpl_vars['stm_avg']; ?>
;
	</div>


<?php endif; ?>

</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>