<?php /* Smarty version 2.6.18, created on 2009-07-09 20:24:52
         compiled from ucp/img_cats.tpl */ ?>
<div  id="title"><?php echo $this->_config[0]['vars']['user_img']; ?>
</div>

<div id="img_cats">
<form name="img_cats" method="POST" action="ucp.php?ch=img_cats&act=send">
<?php $_from = $this->_tpl_vars['imgcats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat'] => $this->_tpl_vars['subcat']):
?>
	<div id="cat">
		<div id="cat_title"><?php echo $this->_tpl_vars['cat']; ?>
</div>
		<table id="cats">
			<tr>
				<?php $_from = $this->_tpl_vars['subcat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['temp']):
?>
				<td>
					<?php echo $this->_tpl_vars['key']; ?>
<input type="checkbox" name="<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" id=name="<?php echo $this->_tpl_vars['cat']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['temp'] == 1): ?> checked="checked" <?php endif; ?> />
				</td>
				<?php endforeach; endif; unset($_from); ?>
			</tr>
		</table>
	</div>
			
<?php endforeach; endif; unset($_from); ?>
<input type="submit" value="<?php echo $this->_config[0]['vars']['Send']; ?>
" />
</form>
</div>