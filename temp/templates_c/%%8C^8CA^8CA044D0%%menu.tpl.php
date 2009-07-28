<?php /* Smarty version 2.6.18, created on 2009-07-12 23:21:59
         compiled from menu.tpl */ ?>
<div class="menu_r">

	<div id="menu_part">
 		<div id="menu_header">
 			<img  src="images/<?php echo $this->_tpl_vars['lang']; ?>
/profile.png" />
 		</div>
 		<?php if ($this->_tpl_vars['log_status'] == 1): ?>		 
			<div id="menu_content">
				<div><a href="login.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&act=logout"><?php echo $this->_config[0]['vars']['Logout']; ?>
[<?php echo $this->_tpl_vars['login']; ?>
]</a></div>
		 		<div><a href="ucp.php?l=<?php echo $this->_tpl_vars['lang']; ?>
"><?php echo $this->_config[0]['vars']['User_cp']; ?>
</a></div>
	 	 		<div><?php echo $this->_config[0]['vars']['Last_visit']; ?>
<?php echo $this->_tpl_vars['last_visit']; ?>
</div>
			</div>
				
		<?php elseif ($this->_tpl_vars['log_status'] == 2): ?>
			<div id="menu_content2">
	          		<form name="login_form" action="login.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&act=login" method="POST">
				 	<table id="login_table">
				 		<tr>
					 		<th><?php echo $this->_config[0]['vars']['Login']; ?>
</th>
						 	<td id="inp"><input type="text" name="login" id="login" value="Login" size="15" onfocus="if(this.value=='Login')this.value='' " /></td>
					 	</tr>
				 		<tr>
						 	<th><?php echo $this->_config[0]['vars']['Pass']; ?>
</th>
						 	<td id="inp"><input type="password" name="pass" id="pass" value="Password" size="15" onfocus="if(this.value=='Password')this.value='' " /></td>
					 	</tr>
				 		<tr>
						 	<td colspan="2"><?php echo $this->_config[0]['vars']['Autologin']; ?>
&nbsp;&nbsp;&nbsp;<input type="checkbox" name="autologin" id="autologin" checked="checked"/></td> 
					 	</tr>
				 		<tr>
						 	<td colspan="2"><input type="submit" value="<?php echo $this->_config[0]['vars']['Send']; ?>
" /></td>
					 	</tr>
				 	</table>
	 			</form>
			</div>		
		<?php endif; ?>
					   
  	</div>

	<div id="menu_part">
 		<div id="menu_header"><img  src="images/<?php echo $this->_tpl_vars['lang']; ?>
/addalgs.png" /></div>
 		<div id="menu_content">
		 	<div class="bold"><a href="add_algs.php"><?php echo $this->_config[0]['vars']['Add_algs']; ?>
</a></div>
 		</div>
 	</div>
 	
 	<div id="menu_part">
 		<div id="menu_header"><img src="images/<?php echo $this->_tpl_vars['lang']; ?>
/addalgs.png" /></div>
 		<div id="menu_content">
		 	<form name='check_algs'>
		 		<table>
		 		<tr> 
		 		<td> 
		 	 	<input type='text' name='alg' id='alg_input' />
		 	 	</td> 
		 	 	</tr>
			   	<tr> 
		 		<td> 
		 	 	<?php echo $this->_config[0]['vars']['Cube_size']; ?>

				  <select name="cube_size">
					<option>2x2x2</option>
					<option selected="selected">3x3x3</option>
				</select>
		 	 	</td> 
		 	 	</tr>
		 	 	<tr> 
		 	 	<td> 
		 	 	<button type="button" onClick='checkAlg();'>GO!</button>
		 	 	</td>
		 	 	</tr> 
		 	 	</table>
		 	</form>
 		</div>
 	</div>

		<div id="menu_part">
 		<div id="menu_header"><img  src="images/<?php echo $this->_tpl_vars['lang']; ?>
/methods.png" /></div>
 		<div id="menu_content">
			<div<?php if ($this->_tpl_vars['method'] == 'fridrich'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich">Fridrich</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'zb'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb">ZB</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'zz'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz">ZZ</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'coll'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=coll">COLL</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'mgls'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls">MGLS</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'eg'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg">EG</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'ortega'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ortega">Ortega</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'ss'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss">SS</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'cll'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=cll">CLL</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'ell'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell">ELL</a></div>
	          	<div<?php if ($this->_tpl_vars['method'] == 'f2ll'): ?> id="active"<?php endif; ?>>	<a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll">F2LL</a></div>
		</div>
  	</div>
	

		<?php if ($this->_tpl_vars['method'] != '' && $this->_tpl_vars['method'] != 'coll' && $this->_tpl_vars['method'] != 'cll'): ?>
	<div id="menu_part">
 		<div id="menu_header"><img  src="images/<?php echo $this->_tpl_vars['method']; ?>
.png" /></div>
	  	<div id="menu_content">
			<?php if ($this->_tpl_vars['method'] == 'fridrich'): ?>
 				<div<?php if ($this->_tpl_vars['chapter'] == 'f2l'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=f2l">F2L</a></div>
	 	  		<div<?php if ($this->_tpl_vars['chapter'] == 'oll'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=oll">OLL</a></div>
			  	<div<?php if ($this->_tpl_vars['chapter'] == 'pll'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=pll">PLL</a></div>
		 	<?php endif; ?>
				 
		 	<?php if ($this->_tpl_vars['method'] == 'zb'): ?>
 	  			<div<?php if ($this->_tpl_vars['chapter'] == 'zbll'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll">ZBLL</a></div>
 	  			<div<?php if ($this->_tpl_vars['chapter'] == 'zbf2l'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbf2l">ZBF2L</a></div>
		 	<?php endif; ?>
				 
		 	<?php if ($this->_tpl_vars['method'] == 'eg'): ?>
 	  			<div<?php if ($this->_tpl_vars['chapter'] == 'n'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg&ch=n">.n</a></div>
 	  			<div<?php if ($this->_tpl_vars['chapter'] == 's'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg&ch=s">.s</a></div>
 	  			<div<?php if ($this->_tpl_vars['chapter'] == 'd'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg&ch=d">.d</a></div>
    			<?php endif; ?>
			    
    			<?php if ($this->_tpl_vars['method'] == 'zz'): ?>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'zbll'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll"><?php echo $this->_config[0]['vars']['ZZ_a']; ?>
</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'b'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=b"><?php echo $this->_config[0]['vars']['ZZ_b']; ?>
</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'd'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=d"><?php echo $this->_config[0]['vars']['ZZ_d']; ?>
</a></div>
			    <?php endif; ?>
			    
    			<?php if ($this->_tpl_vars['method'] == 'ortega'): ?>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'co'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ortega&ch=co">CO</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'cp'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ortega&ch=cp">CP</a></div>
 	          	<?php endif; ?>
 	          	
 	          	<?php if ($this->_tpl_vars['method'] == 'mgls'): ?>
 	          		<div<?php if ($this->_tpl_vars['chapter'] == 'els'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=els">ELS</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'cls'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls">CLS</a></div>
 	          	<?php endif; ?>
			   
			<?php if ($this->_tpl_vars['method'] == 'ss'): ?>
 	          		<div<?php if ($this->_tpl_vars['chapter'] == 'm'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=m">.m</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'p'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=p">.p</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'o'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=o">.o</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'i'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=i">.i</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'im'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=im">.im</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'c'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=c">.c</a></div>
 	          	<?php endif; ?>
			   
			<?php if ($this->_tpl_vars['method'] == 'ell'): ?>	
				<div<?php if ($this->_tpl_vars['chapter'] == 'p'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=p">.p</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'h'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=h">.h</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'z'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=z">.z</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'u1'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=u1">.u1</a></div>
    	  			<div<?php if ($this->_tpl_vars['chapter'] == 'u2'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=u2">.u2</a></div>
 			<?php endif; ?>	
 			
 			<?php if ($this->_tpl_vars['method'] == 'f2ll'): ?>
 				<div<?php if ($this->_tpl_vars['chapter'] == '3'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll&ch=3">.3</a></div>
 				<div<?php if ($this->_tpl_vars['chapter'] == '2'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll&ch=2">.2</a></div>
 				<div<?php if ($this->_tpl_vars['chapter'] == '1'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll&ch=1">.1</a></div>
 				<div<?php if ($this->_tpl_vars['chapter'] == '4'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll&ch=4">.4</a></div>
 			<?php endif; ?>
          	</div>
	</div>
	
	<?php endif; ?>
	
	
	<?php if ($this->_tpl_vars['subchapter'] != '' || $this->_tpl_vars['what_in_section'] == 'subchapter'): ?>
	<div id="menu_part">
 		<?php if ($this->_tpl_vars['method'] == 'fridrich' && $this->_tpl_vars['chapter'] == 'oll'): ?>
	 	  	<div id="menu_header"><img  src="images/oll.png" /></div>
	  		<div id="menu_content">	   
	   			<div<?php if ($this->_tpl_vars['subchapter'] == 'd'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=oll&sch=d">.d</a></div>
	 	  		<div<?php if ($this->_tpl_vars['subchapter'] == 'l'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=oll&sch=l">.l</a></div>
	 	  		<div<?php if ($this->_tpl_vars['subchapter'] == 'b'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=oll&sch=b">.b</a></div>
		     		<div<?php if ($this->_tpl_vars['subchapter'] == 'c'): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=oll&sch=c">.c</a></div>
 	  		 </div>
   		<?php endif; ?>
	</div>
	<?php endif; ?>  
	  
	
	<?php if ($this->_tpl_vars['orientation'] != '' || $this->_tpl_vars['what_in_section'] == 'orientation'): ?>  
	<div id="menu_part">
		  <div id="menu_header"><img  src="images/<?php echo $this->_tpl_vars['lang']; ?>
/orientation.png" /></div>
		  <div id="menu_content">
 		 	<?php if ($this->_tpl_vars['method'] == 'coll' || ( $this->_tpl_vars['method'] == 'zb' && $this->_tpl_vars['chapter'] == 'zbll' ) || $this->_tpl_vars['method'] == 'zz' || $this->_tpl_vars['method'] == 'eg' || $this->_tpl_vars['method'] == 'cll'): ?>
	 	  		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['or']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  			  		<div<?php if ($this->_tpl_vars['orientation'] == $this->_sections['i']['iteration'] && $this->_tpl_vars['orientation'] != ''): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=<?php echo $this->_tpl_vars['method']; ?>
<?php if ($this->_tpl_vars['method'] == 'zb'): ?>&ch=zbll<?php endif; ?><?php if ($this->_tpl_vars['method'] == 'zz' || $this->_tpl_vars['method'] == 'eg'): ?>&ch=<?php echo $this->_tpl_vars['chapter']; ?>
<?php endif; ?>&o=<?php echo $this->_sections['i']['iteration']; ?>
<?php if ($this->_tpl_vars['chapter'] == 'd' && $this->_tpl_vars['method'] != 'eg'): ?>&p=6<?php endif; ?>"><?php if ($this->_tpl_vars['lang'] == 'pl'): ?><?php echo $this->_config[0]['vars']['Orientation']; ?>
 <?php echo $this->_tpl_vars['or'][$this->_sections['i']['index']]; ?>
<?php else: ?><?php echo $this->_tpl_vars['or'][$this->_sections['i']['index']]; ?>
 <?php echo $this->_config[0]['vars']['Orientation']; ?>
<?php endif; ?></a></div>
 		 	  	<?php endfor; endif; ?>
	 		<?php endif; ?>
	 		<?php if ($this->_tpl_vars['method'] == 'cll'): ?>
	 		<div<?php if ($this->_tpl_vars['orientation'] == 8): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=<?php echo $this->_tpl_vars['method']; ?>
&o=8"><?php echo $this->_config[0]['vars']['permutation']; ?>
</a></div>
		  	<?php endif; ?>
		  </div>
	</div> 
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['permutation'] != '' || $this->_tpl_vars['what_in_section'] == 'permutation'): ?>
	<div id="menu_part">
		  <div id="menu_header"><img  src="images/<?php echo $this->_tpl_vars['lang']; ?>
/permutation.png" /></div>
		  <div id="menu_content">
 		 	<?php if ($this->_tpl_vars['chapter'] == 'zbll' || $this->_tpl_vars['method'] == 'zz'): ?>
	 	  		<?php if ($this->_tpl_vars['orientation'] == 7): ?> <?php $this->assign('looop', $this->_tpl_vars['permh']); ?>
			  	<?php else: ?> <?php $this->assign('looop', $this->_tpl_vars['perm']); ?>
	     			<?php endif; ?>
					   
			  	<?php if ($this->_tpl_vars['chapter'] != 'd'): ?> 
		 	  		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['looop']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	  			  		<div<?php if ($this->_tpl_vars['permutation'] == $this->_sections['i']['iteration'] && $this->_tpl_vars['permutation'] != ''): ?> id="active"<?php endif; ?>><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=<?php echo $this->_tpl_vars['method']; ?>
&ch=<?php echo $this->_tpl_vars['chapter']; ?>
&o=<?php echo $this->_tpl_vars['orientation']; ?>
&p=<?php echo $this->_sections['i']['iteration']; ?>
"><?php if ($this->_tpl_vars['lang'] == 'pl'): ?><?php echo $this->_config[0]['vars']['permutation']; ?>
 <?php echo $this->_tpl_vars['looop'][$this->_sections['i']['index']]; ?>
<?php else: ?><?php echo $this->_tpl_vars['looop'][$this->_sections['i']['index']]; ?>
 <?php echo $this->_config[0]['vars']['permutation']; ?>
<?php endif; ?></a></div>
  		 	  		<?php endfor; endif; ?>
		  		 	  
  		 	  	<?php else: ?>
	  		 	  	<div id="active"><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=d&o=<?php echo $this->_tpl_vars['orientation']; ?>
&p=<?php echo $this->_tpl_vars['permutation']; ?>
"><?php if ($this->_tpl_vars['lang'] == 'pl'): ?><?php echo $this->_config[0]['vars']['permutation']; ?>
 n<?php else: ?>n <?php echo $this->_config[0]['vars']['permutation']; ?>
<?php endif; ?></a></div>
  		 	  	<?php endif; ?>
  		 	<?php endif; ?>
		  </div>
	</div> 
	<?php endif; ?>  
	  
	  
	<?php if ($this->_tpl_vars['method'] == 'fridrich' && $this->_tpl_vars['chapter'] == 'pll'): ?>
 		<div id="menu_part">
 			<div id="menu_header"><img  src="images/<?php echo $this->_tpl_vars['lang']; ?>
/permutation.png" /></div>
			<div id="menu_content">
	  			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pll_titles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 			  		<?php $this->assign('licz', ($this->_sections['i']['iteration']+872)); ?>
 					<div<?php if ($this->_tpl_vars['pll'] == $this->_sections['i']['iteration'] && $this->_tpl_vars['pll'] != ''): ?> id="active"<?php endif; ?>><a href="case.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&sid=<?php echo $this->_tpl_vars['licz']; ?>
">PLL <?php echo $this->_tpl_vars['pll_titles'][$this->_sections['i']['index']]; ?>
</a></div> 
				<?php endfor; endif; ?> 
			</div>
	   	</div> 
	<?php endif; ?> 
	  
	  
 	<div id="menu_part">
	 	<div id="menu_header"><img  src="images/<?php echo $this->_tpl_vars['lang']; ?>
/stats.png" /></div>
	 	<div id="menu_content">
   		<div><?php echo $this->_config[0]['vars']['Users_count']; ?>
: <?php echo $this->_tpl_vars['users']; ?>
</div>
	 	<div><?php echo $this->_config[0]['vars']['Algs_count']; ?>
: <?php echo $this->_tpl_vars['algs_inb']; ?>
</div>
	 	<?php if ($this->_tpl_vars['log_status'] == 1): ?>
		 	<div><?php echo $this->_config[0]['vars']['Visits']; ?>
: <?php echo $this->_tpl_vars['visits']; ?>
</div>
	 		<div><?php echo $this->_config[0]['vars']['Your_algs']; ?>
: <?php echo $this->_tpl_vars['your_algs']; ?>
</div>
	 	<?php endif; ?>
	 	</div>
  	</div>
	  
  	</div>