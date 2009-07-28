<?php /* Smarty version 2.6.18, created on 2009-01-27 12:15:05
         compiled from cats/cats.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'upper', 'cats/cats.tpl', 7, false),)), $this); ?>
<div id="tabela">
	  
	  <div id="left">
	  		 <?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['step'] = ((int)2) == 0 ? 1 : (int)2;
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
 				 <div id="cell">
				 		<a href='cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=<?php echo $this->_tpl_vars['cats'][$this->_sections['m']['index']]; ?>
'>
			  			<?php echo ((is_array($_tmp=$this->_tpl_vars['cats'][$this->_sections['m']['index']])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

			  			</a>
				</div>	 
	  		 <?php endfor; endif; ?>
	  </div>
	  
	  <div id="right">
	  		 <?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['start'] = (int)1;
$this->_sections['m']['step'] = ((int)2) == 0 ? 1 : (int)2;
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
 				 <div id="cell">
				 		<a href='cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=<?php echo $this->_tpl_vars['cats'][$this->_sections['m']['index']]; ?>
'>
			  			<?php echo ((is_array($_tmp=$this->_tpl_vars['cats'][$this->_sections['m']['index']])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>

			  			</a>
				</div>	 
	  		 <?php endfor; endif; ?>
	  </div>
	  
</div>