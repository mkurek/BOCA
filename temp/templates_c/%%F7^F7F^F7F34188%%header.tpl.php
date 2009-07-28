<?php /* Smarty version 2.6.18, created on 2009-07-14 23:34:35
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'header.tpl', 9, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="zbll, fridrich, coll, rubik's, cube, rubik, cf, zzll, zbf2l, f2l, speedcubing, algs, oll, pll, permutacja, orientacja" />
<meta name="Description" content="Rubik's Cube'" />
<meta name="Author" content="Matthew" />
<?php echo smarty_function_config_load(array('file' => ($this->_tpl_vars['lang']).".conf"), $this);?>

<meta http-equiv="Content-Language" content="<?php echo $this->_config[0]['vars']['language']; ?>
" />
<title><?php echo $this->_config[0]['vars']['title']; ?>
<?php if ($this->_tpl_vars['site_title'] != ''): ?>: <?php echo $this->_tpl_vars['site_title']; ?>
<?php endif; ?></title>
<?php if ($this->_tpl_vars['mode'] == 'print'): ?>
<link rel="stylesheet" type="text/css" href="css/print.css" />
</head>
<body>
<div class="all">
<?php else: ?>
<link rel="stylesheet" type="text/css" href="css/menu2.css" />

<?php echo '
<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->
'; ?>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="css/jqueryslidemenu.js"></script>
<link rel="stylesheet" type="text/css" href="css/style2.css" />

<?php echo '
<script type="text/javascript">
function checkAlg()
{
  	var alg = document.check_algs.alg.value;
  	var size = document.check_algs.cube_size.value;
  	var size2;
  	if(size == \'2x2x2\') size2 = 2;
  	else size2 = 1;

  	WinObj = window.open("preview.php?data="+alg+"&cube="+size2, "algPreview", "width=700,height=200");
  
}


function zmien()
{
'; ?>

	<?php echo $this->_tpl_vars['var_imgcats']; ?>

	<?php echo $this->_tpl_vars['var_catname']; ?>

	<?php echo '
	var alg = document.getElementById(\'alg\').value;

	for(var cos in imgcats)
	{
	  	document.getElementById(imgcats[cos]).src = "scig/scig.php?desc=portal/"+catname+"/"+imgcats[cos]+"&data="+alg;
	}
	
}


</script>

'; ?>

</head>

<body>

<div class='all'>
<div class='banner'>
<img  src="images/top.png" />
</div>

<div id="myslidemenu" class="jqueryslidemenu">
<ul id="menu">
  	 <li><a href="index.php?l=<?php echo $this->_tpl_vars['lang']; ?>
"><?php echo $this->_config[0]['vars']['Home']; ?>
</a></li>
  	 <li><a href="#">2x2x2</a>
		<ul>
            		<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg">EG</a>
            			<ul>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg&ch=n">.n</a></li>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg&ch=s">.s</a></li>
  					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg&ch=d">.d</a></li>
            			</ul>
    			</li>
    			
      	  		<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=eg&ch=n">CLL</a></li>
      	  		
      	  		<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss">SS</a>
            			<ul>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=m">.m</a></li>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=p">.p</a></li>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=o">.o</a></li>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=i">.i</a></li>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=im">.im</a></li>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ss&ch=c">.c</a></li>
            			</ul>
	 		</li>
	 		
	 		<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ortega">Ortega</a>
            			<ul>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ortega&ch=co">CO</a></li>
            			 	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ortega&ch=cp">CP</a></li>
            			</ul>
    			</li>
  		</ul>
    	</li>
  	 
  	<li><a href="#">3x3x3</a>
		<ul>
  			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich">Fridrich</a>
  				<ul>
			  		<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=f2l">F2L</a></li>
      	  				<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=oll">OLL</a></li>
		  			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=fridrich&ch=pll">PLL</a></li> 
  				</ul>
			</li>
			
			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb">ZB</a>
			 	<ul> 
	 				<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbf2l">ZBF2L</a></li>
					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll">ZBLL</a>
						<ul>
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
    								<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll&o=<?php echo $this->_sections['i']['index_next']; ?>
"><?php echo $this->_tpl_vars['or'][$this->_sections['i']['index']]; ?>
 Orientation</a>
    									<ul>
    			 							<?php if ($this->_tpl_vars['or'][$this->_sections['i']['index']] == 'H'): ?>
     			 								<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=($this->_tpl_vars['permh'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		  										<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll&o=<?php echo $this->_sections['i']['index_next']; ?>
&p=<?php echo $this->_sections['j']['index_next']; ?>
">.<?php echo $this->_tpl_vars['permh'][$this->_sections['j']['index']]; ?>
</a></li>
		  									<?php endfor; endif; ?>
   		  			
		     								<?php else: ?>
	     		  								<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=($this->_tpl_vars['perm'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					  							<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll&o=<?php echo $this->_sections['i']['index_next']; ?>
&p=<?php echo $this->_sections['j']['index_next']; ?>
">.<?php echo $this->_tpl_vars['perm'][$this->_sections['j']['index']]; ?>
</a></li>
		  									<?php endfor; endif; ?>
     					     		  
    										<?php endif; ?>			 
		  							</ul>
		  						</li>
     							<?php endfor; endif; ?>
						</ul>
					</li>
				</ul>
			</li>
		
		  	<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz">ZZ</a>
			 	<ul> 
	 				<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll"><?php echo $this->_config[0]['vars']['ZZa']; ?>
</a>
					 	<ul>
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
    								<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll&o=<?php echo $this->_sections['i']['index_next']; ?>
"><?php echo $this->_tpl_vars['or'][$this->_sections['i']['index']]; ?>
 Orientation</a>
    									<ul>
    			 							<?php if ($this->_tpl_vars['or'][$this->_sections['i']['index']] == 'H'): ?>
     			 								<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=($this->_tpl_vars['permh'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		  										<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll&o=<?php echo $this->_sections['i']['index_next']; ?>
&p=<?php echo $this->_sections['j']['index_next']; ?>
">.<?php echo $this->_tpl_vars['permh'][$this->_sections['j']['index']]; ?>
</a></li>
		  									<?php endfor; endif; ?>
   		  			
		     								<?php else: ?>
	     		  								<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=($this->_tpl_vars['perm'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					  							<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zb&ch=zbll&o=<?php echo $this->_sections['i']['index_next']; ?>
&p=<?php echo $this->_sections['j']['index_next']; ?>
">.<?php echo $this->_tpl_vars['perm'][$this->_sections['j']['index']]; ?>
</a></li>
		  									<?php endfor; endif; ?>
     					     		  
    										<?php endif; ?>			 
		  							</ul>
		  						</li>
     							<?php endfor; endif; ?>
						</ul>
				 	</li>
				 	
					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=b"><?php echo $this->_config[0]['vars']['ZZb']; ?>
</a>
						<ul>
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
    								<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=b&o=<?php echo $this->_sections['i']['index_next']; ?>
"><?php echo $this->_tpl_vars['or'][$this->_sections['i']['index']]; ?>
 Orientation</a>
    									<ul>
    			 							<?php if ($this->_tpl_vars['or'][$this->_sections['i']['index']] == 'H'): ?>
     			 								<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=($this->_tpl_vars['permh'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		  										<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=b&o=<?php echo $this->_sections['i']['index_next']; ?>
&p=<?php echo $this->_sections['j']['index_next']; ?>
">.<?php echo $this->_tpl_vars['permh'][$this->_sections['j']['index']]; ?>
</a></li>
		  									<?php endfor; endif; ?>
   		  			
		     								<?php else: ?>
	     		  								<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=($this->_tpl_vars['perm'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					  							<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=b&o=<?php echo $this->_sections['i']['index_next']; ?>
&p=<?php echo $this->_sections['j']['index_next']; ?>
">.<?php echo $this->_tpl_vars['perm'][$this->_sections['j']['index']]; ?>
</a></li>
		  									<?php endfor; endif; ?>
     					     		  
    										<?php endif; ?>			 
		  							</ul>
		  						</li>
     							<?php endfor; endif; ?>
						</ul>
					</li>
					
					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=d"><?php echo $this->_config[0]['vars']['ZZd']; ?>
</a>
						<ul>
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
    								<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=zz&ch=d&o=<?php echo $this->_sections['i']['index_next']; ?>
&p=<?php if ($this->_sections['i']['index_next'] == 7): ?>4<?php else: ?>6<?php endif; ?>"><?php echo $this->_tpl_vars['or'][$this->_sections['i']['index']]; ?>
 Orientation</a></li>
     							<?php endfor; endif; ?>
						</ul>
					</li>
					
				</ul>
			</li>
			
			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls">MGLS</a>
				<ul> 
					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=els">ELS</a></li>
					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls">CLS</a>
						<ul> 
							<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls&sch=m">.m</a></li>
            			 			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls&sch=p">.p</a></li>
            			 			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls&sch=o">.o</a></li>
            			 			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls&sch=i">.i</a></li>
            			 			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls&sch=im">.im</a></li>
            			 			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=mgls&ch=cls&sch=c">.c</a></li>	
						</ul> 
					</li>
				</ul>	
			</li>
			
			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=coll">COLL</a>
				<ul> 
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
						<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=coll&o=<?php echo $this->_sections['i']['index_next']; ?>
"><?php echo $this->_tpl_vars['or'][$this->_sections['i']['index']]; ?>
 Orientation</a></li>
					<?php endfor; endif; ?>
					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=coll_r"><?php echo $this->_config[0]['vars']['COLL_recognition']; ?>
</a></li>
				</ul> 
			</li> 
			
			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=cll">CLL</a>
				<ul> 
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
						<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=cll&o=<?php echo $this->_sections['i']['index_next']; ?>
"><?php echo $this->_tpl_vars['or'][$this->_sections['i']['index']]; ?>
 Orientation</a></li>
					<?php endfor; endif; ?>
				</ul> 
			</li>
			
			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell">ELL</a>
				<ul> 
					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=p">.p</a></li>
    	  				<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=h">.h</a></li>
    	  				<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=z">.z</a></li>
    	  				<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=u1">.u1</a></li>
    	  				<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=ell&ch=u2">.u2</a></li>
				</ul> 
			</li> 
			
			<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll">F2LL</a>
				<ul> 
			 		<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll&ch=3">.3</a></li>
 					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll&ch=2">.2</a></li>
 					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll&ch=1">.1</a></li>
 					<li><a href="cat.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&cat=<?php echo $this->_tpl_vars['cat_s']; ?>
&m=f2ll&ch=4">.0</a></li>
				</ul> 
			</li> 
		
		</ul>		  
  	 </li>
		
		
    	<li><a href="#"><?php echo $this->_config[0]['vars']['Rest']; ?>
</a></li>
    
    	<li><a href="faq.php?l=<?php echo $this->_tpl_vars['lang']; ?>
">FAQ</a></li>
    
    	<?php if ($this->_tpl_vars['log_status'] == 1): ?>
    		<li><a href="login.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&act=logout"><?php echo $this->_config[0]['vars']['Logout']; ?>
</a></li>
    		<li><a href="ucp.php?l=<?php echo $this->_tpl_vars['lang']; ?>
"><?php echo $this->_config[0]['vars']['User_cp']; ?>
</a></li>
	<?php else: ?>
		<li><a href="login.php?l=<?php echo $this->_tpl_vars['lang']; ?>
"><?php echo $this->_config[0]['vars']['Login']; ?>
</a></li>
    		<li><a href="register.php?l=<?php echo $this->_tpl_vars['lang']; ?>
"><?php echo $this->_config[0]['vars']['Register']; ?>
</a></li>
  	<?php endif; ?>
    
</ul>
</div>
<?php endif; ?>