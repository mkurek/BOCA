<?php /* Smarty version 2.6.18, created on 2009-07-14 21:37:51
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="content">
<div id="title">LOGOWANIE</div>

<?php if ($this->_tpl_vars['display_inf'] == true): ?>

<div id="error"><?php echo $this->_config[0]['vars'][$this->_tpl_vars['inf']]; ?>
 <?php if ($this->_tpl_vars['inf'] == 'already_logged'): ?><?php echo $this->_tpl_vars['login']; ?>
<?php endif; ?></div>

<?php endif; ?>


		 <?php if ($this->_tpl_vars['login_step'] == 'ok'): ?>
			 <div id="message"><?php echo $this->_config[0]['vars']['Logged']; ?>
: <?php echo $this->_tpl_vars['login']; ?>
</div>
 		 <?php endif; ?>
 		 
		  <?php if ($this->_tpl_vars['errors'] != ''): ?>
			 		 <div id="error"><?php echo $this->_config[0]['vars'][$this->_tpl_vars['errors']]; ?>
</div>
	     <?php endif; ?>

<?php if ($this->_tpl_vars['display_form'] == true): ?>
		
				<div id="content_content">
				 <form name="login_form" method="post" action="login.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&act=login">
				 <table>
				 <tr><td><?php echo $this->_config[0]['vars']['Login']; ?>
</td><td><input type="text" name="login" id="login" value="Login" onfocus="if(this.value=='Login')this.value='' " /></td></tr>
				 <tr><td><?php echo $this->_config[0]['vars']['Pass']; ?>
</td><td><input type="password" name="pass" id="pass" value="Password" onfocus="if(this.value=='Password')this.value='' " /></td></tr>
				 <tr><td colspan="2"><?php echo $this->_config[0]['vars']['Autologin']; ?>
<input type="checkbox" name="autologin" id="autologin" checked="checked"/> 
				 <tr><td colspan="2"><input type="submit" value="<?php echo $this->_config[0]['vars']['Send']; ?>
" /></td></tr>
				 </table>
				 </form> 

				 <div id="side_txt">
				 <a href='login.php?act=drtp'><?php echo $this->_config[0]['vars']['DRTP']; ?>
</a>
				 </div>

				 <div id="side_txt">
				 <a href='register.php'><?php echo $this->_config[0]['vars']['YDHTA']; ?>
</a>
				 </div>
          </div>
      
<?php endif; ?>

<div id="side_text"><a href="index.php?l=<?php echo $this->_tpl_vars['lang']; ?>
"><?php echo $this->_config[0]['vars']['back_to_main_site']; ?>
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