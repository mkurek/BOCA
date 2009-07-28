<?php /* Smarty version 2.6.18, created on 2009-07-10 14:48:44
         compiled from case.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'case.tpl', 59, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('max_pages', 2000000); ?>
<div class="content">
	  
  	<?php if ($this->_tpl_vars['if_message'] == true): ?><div id="message"><?php echo $this->_tpl_vars['message']; ?>
</div><?php endif; ?>

	<div id="left" class="top_button"><?php if ($this->_tpl_vars['prev'] != '' && $this->_tpl_vars['prev'] != 0): ?><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&sid=<?php echo $this->_tpl_vars['prev']; ?>
"><?php endif; ?>poprzedni<<<?php if ($this->_tpl_vars['prev'] != ''): ?></a><?php endif; ?></div>
	<div id="right" class="top_button"><?php if ($this->_tpl_vars['next'] != '' && $this->_tpl_vars['next'] != 0): ?><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&sid=<?php echo $this->_tpl_vars['next']; ?>
"><?php endif; ?>>>następny<?php if ($this->_tpl_vars['next'] != ''): ?></a><?php endif; ?></div>
	<div id="clear"> </div>
	  
	<div id="title">Case <?php echo $this->_tpl_vars['sid']; ?>
 -> <?php echo $this->_tpl_vars['cat']; ?>
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
	  
 	<div id="scig2">
  		<table id="scig_table">
	  	<tr>
	  		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['max'] = (int)$this->_tpl_vars['max'];
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
    $this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
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
	  			<?php $this->assign('zmienna', $this->_tpl_vars['images'][$this->_sections['i']['index']]); ?>
	 			<td><?php echo $this->_config[0]['vars'][$this->_tpl_vars['zmienna']]; ?>
</td>
         	 	<?php endfor; endif; ?>
	  
	  	</tr>
	  	<tr>
	  		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['max'] = (int)$this->_tpl_vars['max'];
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
    $this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
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
			 	<td><img src="scig/scig.php?desc=portal/<?php if ($this->_tpl_vars['cat_name'] == 'zz'): ?>zbll<?php else: ?><?php echo $this->_tpl_vars['cat_name']; ?>
<?php endif; ?>/<?php echo $this->_tpl_vars['images'][$this->_sections['i']['index']]; ?>
&data=<?php echo $this->_tpl_vars['pattern']; ?>
"/></td>
	  		<?php endfor; endif; ?>
	  	</tr>
	  	</table>
  	</div>
	  
  	<?php if ($this->_tpl_vars['if_next']): ?>
		<div id="scig2">
 			<table id="scig_table">
			<tr>
	  			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)$this->_tpl_vars['max'];
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
		 			<?php $this->assign('zmienna', $this->_tpl_vars['images'][$this->_sections['i']['index']]); ?>
		 			<td><?php echo $this->_config[0]['vars'][$this->_tpl_vars['zmienna']]; ?>
</td>
				<?php endfor; endif; ?>
	  		</tr>
	  		<tr>
	  			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)$this->_tpl_vars['max'];
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
					   <td><img src="scig/scig.php?desc=portal/<?php if ($this->_tpl_vars['cat_name'] == 'zz'): ?>zbll<?php else: ?><?php echo $this->_tpl_vars['cat_name']; ?>
<?php endif; ?>/<?php echo $this->_tpl_vars['images'][$this->_sections['i']['index']]; ?>
&data=<?php echo $this->_tpl_vars['pattern']; ?>
"/></td>
		   		<?php endfor; endif; ?>
	  		</tr>
	  		</table>
  		</div>
  	<?php endif; ?>
	  
	  
	  
	  
  	<div id="case_cats">
	 	<div id="title2"><?php echo $this->_config[0]['vars']['Cats']; ?>
:</div>
 		<div id="cat"><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&cat=th"><?php if (((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'th' || $this->_tpl_vars['cat'] == ''): ?><b><?php endif; ?>TH<?php if (((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'th'): ?></b><?php endif; ?></a></div>
 		<div id="cat"><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&cat=oh"><?php if (((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'oh'): ?><b><?php endif; ?>OH<?php if (((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'oh'): ?></b><?php endif; ?></a></div>
	 	<div id="cat"><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&cat=fm"><?php if (((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'fm'): ?><b><?php endif; ?>FM<?php if (((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'fm'): ?></b><?php endif; ?></a></div>
	</div>

	<div id="algs">
		<?php $this->assign('alg', 'alg'); ?>
		<?php $this->assign('htm', 'htm'); ?>
		<?php $this->assign('qtm', 'qtm'); ?>
		<?php $this->assign('stm', 'stm'); ?>
		<?php $this->assign('id', 'id'); ?>
		<?php $this->assign('can_vote2', 'can_vote'); ?>
		<?php $this->assign('username', 'user'); ?>
		<?php $this->assign('votes', 'votes'); ?>
			
	 	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['algs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
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
		 	<div id="alg">
	 			<div id="row">
		  			<?php if ($this->_tpl_vars['my_alg'] == 'yes' && $this->_sections['i']['first']): ?><div id="alg_ma"><img src='images/<?php echo $this->_tpl_vars['lang']; ?>
/ma.gif' /></div><?php endif; ?>
  					<div id="alg_main"><?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['alg']]; ?>
</div>
		 	  		<div id="alg_moves">(<?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['htm']]; ?>
 htm, <?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['qtm']]; ?>
 qtm, <?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['stm']]; ?>
 stm)</div>
    				</div>
	   
				<div id="clear"> </div>
	   
	   	 		<div id="row2"> 
	   	 			<?php if ($this->_tpl_vars['can_vote'] == 'yes' && $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['can_vote2']] == 1 && $this->_tpl_vars['can_choose_my_alg'] == 'yes' && ( ! $this->_sections['i']['first'] || $this->_tpl_vars['my_alg'] == 'no' )): ?><?php $this->assign('info_id', 'alg_info30'); ?><?php $this->assign('ma_id', 'my_alg30'); ?><?php $this->assign('vote_id', 'vote30'); ?>
				        <?php elseif ($this->_tpl_vars['can_vote'] == 'yes' && $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['can_vote2']] == 1): ?><?php $this->assign('info_id', 'alg_info50'); ?><?php $this->assign('vote_id', 'vote50'); ?>
				        <?php elseif ($this->_tpl_vars['can_choose_my_alg'] == 'yes' && ( ! $this->_sections['i']['first'] || $this->_tpl_vars['my_alg'] == 'no' )): ?><?php $this->assign('info_id', 'alg_info50'); ?><?php $this->assign('ma_id', 'my_alg50'); ?>
  	 			  	<?php else: ?><?php $this->assign('info_id', 'alg_info100'); ?>
   	 			  	<?php endif; ?>
	   	 		
 	  				<?php if ($this->_tpl_vars['can_choose_my_alg'] == 'yes' && ( ! $this->_sections['i']['first'] || $this->_tpl_vars['my_alg'] == 'no' )): ?>
		 	  			<div id="<?php echo $this->_tpl_vars['ma_id']; ?>
"><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&act=v3&id=<?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
"><?php echo $this->_config[0]['vars']['My_alg']; ?>
</a></div>
    			  		<?php endif; ?>
					 
		 	  		<div id="<?php echo $this->_tpl_vars['info_id']; ?>
">
					   <div id="pole1"><?php echo $this->_config[0]['vars']['Add']; ?>
: <?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['username']]; ?>
</div>
					   <div id="pole2"><?php echo $this->_config[0]['vars']['Votes']; ?>
: <?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['votes']]; ?>
</div>
			   		</div>
			 		
					 <?php if ($this->_tpl_vars['can_vote'] == 'yes' && $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['can_vote2']] == 1): ?>
					 	<div id="<?php echo $this->_tpl_vars['vote_id']; ?>
"><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&act=v1&id=<?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
">+</a> / <a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&act=v2&id=<?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
">-</a>
						 <?php if ($this->_tpl_vars['can_choose_my_alg'] == 'yes' && ( ! $this->_sections['i']['first'] || $this->_tpl_vars['my_alg'] == 'no' )): ?>
						 	<a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&act=v4&id=<?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
"> / **</a>
						 <?php endif; ?>
						 </div>
					 <?php endif; ?>
			      	</div>
			      
			      	<?php if ($this->_tpl_vars['can_edit'] == 'yes'): ?>
			      	<div id="clear"> </div>
			      	<div id="row3"> 
			      		<a href="edit.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&id=<?php echo $this->_tpl_vars['algs'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
"><?php echo $this->_config[0]['vars']['Edit']; ?>
</a>
			      	</div>
			      <?php endif; ?>
				
 			 </div>
			 <div id="clear_bor"></div>
		<?php endfor; endif; ?>

     	</div>

	<div  id="pages">
		<?php if ($this->_tpl_vars['pages'] > 1 && $this->_tpl_vars['act_page'] != 1): ?>
			<?php $this->assign('prev', $this->_tpl_vars['act_page']-1); ?>
			<a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&page=<?php echo $this->_tpl_vars['prev']; ?>
"><?php echo $this->_config[0]['vars']['Previous']; ?>
</a>
		<?php elseif ($this->_tpl_vars['act_page'] == 1): ?><?php echo $this->_config[0]['vars']['Previous']; ?>

		<?php endif; ?>
		<?php if ($this->_tpl_vars['act_page'] == 1): ?><span id="act_page">1</span>
		<?php else: ?><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&page=1">1</a>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['pages_start'] > 2): ?>...<?php endif; ?>
	 	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pages_tab']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['start'] = (int)$this->_tpl_vars['pages_start'];
$this->_sections['i']['max'] = (int)$this->_tpl_vars['pages_end'];
$this->_sections['i']['show'] = true;
if ($this->_sections['i']['max'] < 0)
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
	 		<?php if ($this->_tpl_vars['pages_tab'][$this->_sections['i']['index']] == $this->_tpl_vars['act_page']): ?><span id="act_page"><?php endif; ?>
			 <a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&page=<?php echo $this->_tpl_vars['pages_tab'][$this->_sections['i']['index']]; ?>
"><?php echo $this->_tpl_vars['pages_tab'][$this->_sections['i']['index']]; ?>
</a>
			 <?php if ($this->_tpl_vars['pages_tab'][$this->_sections['i']['index']] == $this->_tpl_vars['act_page']): ?></span><?php endif; ?>
	 	<?php endfor; endif; ?>
	 	
	 	<?php if ($this->_tpl_vars['pages_end'] < $this->_tpl_vars['pages']-1): ?>...<?php endif; ?>
	 	
	 	<?php if ($this->_tpl_vars['pages'] > 1): ?>
	 	<?php if ($this->_tpl_vars['act_page'] == $this->_tpl_vars['pages']): ?><span id="act_page"><?php endif; ?>
		 <a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&page=<?php echo $this->_tpl_vars['pages']; ?>
"><?php echo $this->_tpl_vars['pages']; ?>
</a>
	 	<?php if ($this->_tpl_vars['act_page'] == $this->_tpl_vars['pages']): ?></span><?php endif; ?>
	 	<?php endif; ?>
	 	
		 <?php if ($this->_tpl_vars['act_page'] < $this->_tpl_vars['pages']): ?>
		 	<?php $this->assign('next', $this->_tpl_vars['act_page']+1); ?>
			<a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['sid']; ?>
&page=<?php echo $this->_tpl_vars['next']; ?>
"><?php echo $this->_config[0]['vars']['Next']; ?>
</a>
		<?php elseif ($this->_tpl_vars['act_page'] == $this->_tpl_vars['pages']): ?><?php echo $this->_config[0]['vars']['Next']; ?>

		<?php endif; ?>
	</div>

<div id="content_foot"><a href="index.php"><?php echo $this->_config[0]['vars']['back_to_main_site']; ?>
</a></div>

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