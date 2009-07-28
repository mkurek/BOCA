<?php /* Smarty version 2.6.18, created on 2009-07-09 20:57:59
         compiled from register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'register.tpl', 3, false),array('function', 'html_radios', 'register.tpl', 46, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo smarty_function_config_load(array('file' => ($this->_tpl_vars['lang']).".conf"), $this);?>

<div class="content">
	  <div id='content_title'>
	  <?php if ($this->_tpl_vars['register'] == 'register_form'): ?><?php echo $this->_config[0]['vars']['Register_form_title']; ?>
<?php elseif ($this->_tpl_vars['register'] == 'send'): ?><?php echo $this->_config[0]['vars']['Register_send_title']; ?>
<?php elseif ($this->_tpl_vars['register'] == 'activate'): ?><?php echo $this->_config[0]['vars']['Register_activate_title']; ?>
<?php endif; ?></div>
	  
	  <?php if ($this->_tpl_vars['errors'] != '' && $this->_tpl_vars['register'] == 'register_form'): ?><div id="errors">
	  <?php echo $this->_config[0]['vars'][$this->_tpl_vars['errors_type']]; ?>

	  <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['klucz'] => $this->_tpl_vars['blad']):
?><?php echo $this->_config[0]['vars'][$this->_tpl_vars['blad']]; ?>
<br /><?php endforeach; endif; unset($_from); ?>
	  </div><?php endif; ?>
	  
	  
	  <div id='content_content'>
	  		  <?php if ($this->_tpl_vars['register'] == 'register_form'): ?>
				 <form name="register_form" method="post" action="register.php?action=reg">
			  	
				  <table id="register_form">
			 	<tr>
			   <td><?php echo $this->_config[0]['vars']['Username']; ?>
: </td>
	         <td><input name='username' type='text' id='username' <?php if ($this->_tpl_vars['errors'] != ''): ?>value="<?php echo $this->_tpl_vars['username']; ?>
"<?php endif; ?> /></td>
			  	</tr>
			  	
			  	<tr>
			   <td><?php echo $this->_config[0]['vars']['Email']; ?>
: </td>
	         <td><input name='mail' type='text' id='mail' <?php if ($this->_tpl_vars['errors'] != ''): ?>value="<?php echo $this->_tpl_vars['mail']; ?>
"<?php endif; ?> /></td>
			  	</tr>
	         
	         <tr>
			   <td><?php echo $this->_config[0]['vars']['Confirm_Email']; ?>
: </td>
	         <td><input name='mail2' type='text' id='mail2' <?php if ($this->_tpl_vars['errors'] != ''): ?>value="<?php echo $this->_tpl_vars['mail2']; ?>
"<?php endif; ?> /></td>
			  	</tr>
	         
	         <tr>
			   <td><?php echo $this->_config[0]['vars']['Password']; ?>
: </td>
	         <td><input name='password' type='password' id='password' <?php if ($this->_tpl_vars['errors'] != ''): ?>value="<?php echo $this->_tpl_vars['password']; ?>
"<?php endif; ?> /></td>
			  	</tr>
	         
	         <tr>
  		      <td><?php echo $this->_config[0]['vars']['Confirm_password']; ?>
: </td>
	         <td><input name='password2' type='password' id='password2' <?php if ($this->_tpl_vars['errors'] != ''): ?>value="<?php echo $this->_tpl_vars['password2']; ?>
"<?php endif; ?> /></td>
			  	</tr>
				 
				 <tr>
				 <td><?php echo $this->_config[0]['vars']['Language']; ?>
: </td>
	         <td><?php echo smarty_function_html_radios(array('name' => 'language','options' => $this->_tpl_vars['languages'],'selected' => $this->_tpl_vars['language'],'separator' => "<br />"), $this);?>
</td>
			  	</tr>
				
				<tr>
				<td><img src="includes/captcha.php" /></td><td><input type="text" name="captcha" id="captcha" /></td>
				</tr> 
				
				<tr>
			 	<td><input type='submit' value='<?php echo $this->_config[0]['vars']['Send']; ?>
' /></td>
			  	</tr>
			  	</table>
				</form>	  

	  			<?php elseif ($this->_tpl_vars['register'] == '404'): ?> <div id="message"><?php echo $this->_config[0]['vars']['error_404']; ?>
	</div>
	  			
				<?php elseif ($this->_tpl_vars['register'] == 'send'): ?> <div id="message"><?php echo $this->_config[0]['vars']['YANR']; ?>
</div>	
	  				
	  			<?php endif; ?>
	  				  
	  
	  </div>
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