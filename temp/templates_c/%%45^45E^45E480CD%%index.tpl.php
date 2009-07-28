<?php /* Smarty version 2.6.18, created on 2009-07-14 23:34:39
         compiled from index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="content">
<?php $this->assign('title', 'Tytul'); ?>
<?php $this->assign('content', 'Tresc'); ?>
<?php $this->assign('author', 'Dodal'); ?>
<?php $this->assign('date', 'Data'); ?>
<?php $this->assign('comments', 'kom'); ?>
<?php $this->assign('id', 'ID'); ?>


<?php if ($this->_tpl_vars['what'] == 'newses_display'): ?>
	<div id="main_title"><?php echo $this->_config[0]['vars']['Welcome']; ?>
</div>
	<div id="subtitle"><?php echo $this->_config[0]['vars']['Algs_in_our_base']; ?>
<?php echo $this->_tpl_vars['algs_inb']; ?>
<?php echo $this->_config[0]['vars']['Algs_in_our_base_cd']; ?>
</div>
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['news']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<div id = "news_cell">
				<div id='news_added'><?php echo $this->_config[0]['vars']['added']; ?>
: <?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['date']]; ?>
</div> 
				<div id="news_title"><a href="index.php?lang=<?php echo $this->_tpl_vars['lang']; ?>
&news_id=<?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
"><?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['title']]; ?>
</a></div> 
				
				<div id="news_content">
				<?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['content']]; ?>
... <a href="index.php?lang=<?php echo $this->_tpl_vars['lang']; ?>
&news_id=<?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
">[<?php echo $this->_config[0]['vars']['more']; ?>
]</a>
				</div> 
				
				
				<div id='news_foot'><?php echo $this->_config[0]['vars']['author']; ?>
: <?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['author']]; ?>
 || <a href="index.php?lang=<?php echo $this->_tpl_vars['lang']; ?>
&news_id=<?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
#comments"><?php echo $this->_config[0]['vars']['comments']; ?>
: <?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['comments']]; ?>
</a></div> 
			</div>
	<?php endfor; endif; ?>

	
<?php else: ?>
	<div id = "news_cell">
		<div id='news_added'><?php echo $this->_config[0]['vars']['added']; ?>
: <?php echo $this->_tpl_vars['news'][$this->_tpl_vars['date']]; ?>
</div> 
		<div id="news_title"><?php echo $this->_tpl_vars['news'][$this->_tpl_vars['title']]; ?>
</div> 
				
		<div id="news_content">
			<?php echo $this->_tpl_vars['news'][$this->_tpl_vars['content']]; ?>

		</div> 
				
		<div id='news_foot'><?php echo $this->_config[0]['vars']['author']; ?>
: <?php echo $this->_tpl_vars['news'][$this->_tpl_vars['author']]; ?>
 || <a href="index.php?lang=<?php echo $this->_tpl_vars['lang']; ?>
&news_id=<?php echo $this->_tpl_vars['news'][$this->_sections['i']['index']][$this->_tpl_vars['id']]; ?>
#comments"><?php echo $this->_config[0]['vars']['comments']; ?>
: <?php echo $this->_tpl_vars['news'][$this->_tpl_vars['comments']]; ?>
</a></div> 
	</div>
	
	<div id="news_comments">	
		<a name="comments"><div  id="news_comments_title"><?php echo $this->_config[0]['vars']['comments']; ?>
</div></a>
		
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['kom']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<div id="comment_cell">
				<div id="comment_top"><?php echo $this->_config[0]['vars']['author']; ?>
: <?php echo $this->_tpl_vars['kom'][$this->_sections['i']['index']][$this->_tpl_vars['author']]; ?>
</div>
				<div id='comment_added'><?php echo $this->_config[0]['vars']['added']; ?>
: <?php echo $this->_tpl_vars['kom'][$this->_sections['i']['index']][$this->_tpl_vars['date']]; ?>
</div> 
				<div id="comment_content">
				<?php echo $this->_tpl_vars['kom'][$this->_sections['i']['index']][$this->_tpl_vars['content']]; ?>

				</div> 
			</div>
		<?php endfor; endif; ?>
	</div>
	
	<?php if ($this->_tpl_vars['log_status'] == 1): ?>
	<div id="add_comment">
		<div id="news_title"><?php echo $this->_config[0]['vars']['add_comment']; ?>
</div>
		<form name="comment_add" id="comment_add" method="POST" action="index.php?lang=<?php echo $this->_tpl_vars['lang']; ?>
&page=<?php echo $this->_tpl_vars['act_page']; ?>
&news_id=<?php echo $this->_tpl_vars['news'][$this->_tpl_vars['id']]; ?>
&act=send">
		<textarea cols=60 rows=7 name="comment"></textarea> <br />
		<input type="submit" value="<?php echo $this->_config[0]['vars']['Send']; ?>
" />
		</form>
	</div>
	
	<?php else: ?>
	
	<div id="message_small"><?php echo $this->_config[0]['vars']['Login_to_write_comment']; ?>
</div>
	<?php endif; ?>
<?php endif; ?>

<div  id="pages">
		<?php if ($this->_tpl_vars['pages'] > 1 && $this->_tpl_vars['act_page'] != 1): ?>
			<?php $this->assign('prev', $this->_tpl_vars['act_page']-1); ?>
			<a href="index.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&page=<?php echo $this->_tpl_vars['prev']; ?>
<?php if ($this->_tpl_vars['what'] == 'news_display'): ?>&news_id=<?php echo $this->_tpl_vars['news'][$this->_tpl_vars['id']]; ?>
#comments<?php endif; ?>"><?php echo $this->_config[0]['vars']['Previous']; ?>
</a>
		<?php elseif ($this->_tpl_vars['act_page'] == 1): ?><?php echo $this->_config[0]['vars']['Previous']; ?>

		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['act_page'] == 1): ?><span id="act_page">1</span>
		<?php else: ?><a href="index.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&page=1<?php if ($this->_tpl_vars['what'] == 'news_display'): ?>&news_id=<?php echo $this->_tpl_vars['news'][$this->_tpl_vars['id']]; ?>
#comments<?php endif; ?>">1</a>
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
			 <a href="index.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&page=<?php echo $this->_tpl_vars['pages_tab'][$this->_sections['i']['index']]; ?>
<?php if ($this->_tpl_vars['what'] == 'news_display'): ?>&news_id=<?php echo $this->_tpl_vars['news'][$this->_tpl_vars['id']]; ?>
#comments<?php endif; ?>"><?php echo $this->_tpl_vars['pages_tab'][$this->_sections['i']['index']]; ?>
</a>
			 <?php if ($this->_tpl_vars['pages_tab'][$this->_sections['i']['index']] == $this->_tpl_vars['act_page']): ?></span><?php endif; ?>
	 	<?php endfor; endif; ?>
	 	
	 	<?php if ($this->_tpl_vars['pages_end'] < $this->_tpl_vars['pages']-1): ?>...<?php endif; ?>
	 	
	 	<?php if ($this->_tpl_vars['pages'] > 1): ?>
	 	<?php if ($this->_tpl_vars['act_page'] == $this->_tpl_vars['pages']): ?><span id="act_page"><?php endif; ?>
		 <a href="index.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&page=<?php echo $this->_tpl_vars['pages']; ?>
<?php if ($this->_tpl_vars['what'] == 'news_display'): ?>&news_id=<?php echo $this->_tpl_vars['news'][$this->_tpl_vars['id']]; ?>
#comments<?php endif; ?>"><?php echo $this->_tpl_vars['pages']; ?>
</a>
	 	<?php if ($this->_tpl_vars['act_page'] == $this->_tpl_vars['pages']): ?></span><?php endif; ?>
	 	<?php endif; ?>
	 	
		 <?php if ($this->_tpl_vars['act_page'] < $this->_tpl_vars['pages']): ?>
		 	<?php $this->assign('next', $this->_tpl_vars['act_page']+1); ?>
			<a href="index.php?l=<?php echo $this->_tpl_vars['lang']; ?>
&page=<?php echo $this->_tpl_vars['next']; ?>
<?php if ($this->_tpl_vars['what'] == 'news_display'): ?>&news_id=<?php echo $this->_tpl_vars['news'][$this->_tpl_vars['id']]; ?>
#comments<?php endif; ?>"><?php echo $this->_config[0]['vars']['Next']; ?>
</a>
		<?php else: ?><?php echo $this->_config[0]['vars']['Next']; ?>

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