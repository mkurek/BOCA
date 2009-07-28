<?php /* Smarty version 2.6.18, created on 2009-07-14 21:55:29
         compiled from preview.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="content">
	
	<?php if ($this->_tpl_vars['ok'] == 1): ?>
	
	<img src="scig/scig.php?desc=portal/<?php echo $this->_tpl_vars['size']; ?>
all&data=<?php echo $this->_tpl_vars['alg']; ?>
" />
	<br /><br />
	<a href="preview.php?data=<?php echo $this->_tpl_vars['alg']; ?>
&cube=<?php if ($this->_tpl_vars['cube_size'] == 1): ?>2<?php else: ?>1<?php endif; ?>"><?php echo $this->_config[0]['vars']['change_cube_size']; ?>
</a>
	<br /><br />
	<?php else: ?>
	
	<div id="content_title">
		<div id="errors"><?php echo $this->_config[0]['vars']['uncorrect_alg']; ?>
</div>
	</div>
	<?php endif; ?>
 	<a href="#" onClick="window.close()"><?php echo $this->_config[0]['vars']['close']; ?>
</a>  

</div>