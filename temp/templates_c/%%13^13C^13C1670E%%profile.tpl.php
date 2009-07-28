<?php /* Smarty version 2.6.18, created on 2009-07-09 22:12:04
         compiled from ucp/profile.tpl */ ?>
<div  id="title"><?php echo $this->_config[0]['vars']['profile']; ?>
</div>

<?php if ($this->_tpl_vars['message'] != ''): ?>
<div id="message"><?php echo $this->_config[0]['vars'][$this->_tpl_vars['message']]; ?>
</div>
<?php endif; ?>

<div id='content_content'>

<?php if ($this->_tpl_vars['errors'] != ''): ?>
<div id="errors">
	  <?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['klucz'] => $this->_tpl_vars['blad']):
?><?php echo $this->_config[0]['vars'][$this->_tpl_vars['blad']]; ?>
<br /><?php endforeach; endif; unset($_from); ?>
</div><?php endif; ?>

<div id="cat_title" class="margin_top_20"><?php echo $this->_config[0]['vars']['change_pass']; ?>
</div>

<form name="pass" method="POST" action="ucp.php?ch=profile&act=send">
	<table id="register_form">
		<tr>
			<td><?php echo $this->_config[0]['vars']['old_pass']; ?>
</td><td><input type="password" name="old_pass" id="old_pass" /></td> 
		</tr> 
		<tr>
			<td><?php echo $this->_config[0]['vars']['Password']; ?>
</td><td><input type="password" name="pass1" id="pass1" /></td> 
		</tr>
		<tr>
			<td><?php echo $this->_config[0]['vars']['Confirm_password']; ?>
</td><td><input type="password" name="pass2" id="pass2" /></td> 
		</tr>
	</table>				
<input type="submit" value="<?php echo $this->_config[0]['vars']['Send']; ?>
" />



<div id="cat_title" class="margin_top_20"><?php echo $this->_config[0]['vars']['change_lang']; ?>
</div>

<select name="lang" id="lang">
 	<option <?php if ($this->_tpl_vars['ln'] == 'pl'): ?>selected="selected"<?php endif; ?> value="pl">Polski</option>
	<option <?php if ($this->_tpl_vars['ln'] == 'en'): ?>selected="selected"<?php endif; ?> value="en">English</option> 
</select><br /><br />				
<input type="submit" value="<?php echo $this->_config[0]['vars']['Send']; ?>
" />

</form>

</div>