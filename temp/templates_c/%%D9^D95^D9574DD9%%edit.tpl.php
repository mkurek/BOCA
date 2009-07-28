<?php /* Smarty version 2.6.18, created on 2009-01-27 12:39:00
         compiled from edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'edit.tpl', 31, false),array('modifier', 'sslash', 'edit.tpl', 33, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="content">

<?php if ($this->_tpl_vars['message'] == true): ?><div id="message">ZAPISANO!</div><?php endif; ?>

<div id="sciaga">
<code>
<1,472> - ZBLL<br />
<473,774> - ZBF2L<br />
<775,795> - PLL<br />
<796,852> - OLL<br />
<853,858> - Ortega (etap 3)<br />
<859,984> - EG (<859,900> - CLL)<br />
<985, > - SS<br /><br />
</code>
</div>

<div id="title">Case <?php echo $this->_tpl_vars['name']; ?>
 -> ALG_ID: <?php echo $this->_tpl_vars['id']; ?>
</div>

<div id="scig">
	  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					 <div id="left"><img src="scig/scig.php?desc=portal/<?php echo $this->_tpl_vars['cat_name']; ?>
/<?php echo $this->_tpl_vars['images'][$this->_sections['i']['index']]; ?>
&data=<?php echo $this->_tpl_vars['alg']; ?>
" id="<?php echo $this->_tpl_vars['images'][$this->_sections['i']['index']]; ?>
" /></div>
	  <?php endfor; endif; ?>
</div>
	  
<div id="clear"></div>
	  
<div id="message">JACube: <?php echo $this->_tpl_vars['jac']; ?>
</div>

<form name="edit" action="edit.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['name'][0]; ?>
<?php if ($this->_tpl_vars['name'][1] != $this->_tpl_vars['name'][0]): ?>,<?php echo $this->_tpl_vars['name'][1]; ?>
<?php endif; ?>&id=<?php echo $this->_tpl_vars['id']; ?>
&act=st2" method="POST">

<input type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['alg'])) ? $this->_run_mod_handler('sslash', true, $_tmp) : stripslashes($_tmp)); ?>
" size="50" id="alg" name="alg" />

<button type='button' name='change' onclick="zmien()" >Jadziem!</button>
<br /><br />
<input type="submit" value="GO!" />

</form>

<div id="message"><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo ((is_array($_tmp=$this->_tpl_vars['cat'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
&sid=<?php echo $this->_tpl_vars['name'][0]; ?>
<?php if ($this->_tpl_vars['name'][1] != $this->_tpl_vars['name'][0]): ?>,<?php echo $this->_tpl_vars['name'][1]; ?>
<?php endif; ?>"><?php echo $this->_config[0]['vars']['back']; ?>
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