<?php /* Smarty version 2.6.18, created on 2009-07-16 01:30:10
         compiled from add_algs.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="content">
<?php if ($this->_tpl_vars['what'] == 'show_form'): ?>
<?php if ($this->_tpl_vars['use_js']): ?>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
// Localized messages
var msg_send = '<?php echo $this->_config[0]['vars']['Send']; ?>
';
var msg_processing = '<?php echo $this->_config[0]['vars']['PYD']; ?>
';
var msg_connecting = '<?php echo $this->_config[0]['vars']['UYA']; ?>
';
var msg_error = '<?php echo $this->_config[0]['vars']['add_error']; ?>
.';
var msg_parsing = '<?php echo $this->_config[0]['vars']['PSO']; ?>
';
var msg_finished = '<?php echo $this->_config[0]['vars']['finished']; ?>
';

<?php echo '
$(document).ajaxError(function(){
   if (window.console && window.console.error) {
       console.error(arguments);
   }
});
'; ?>


var msg_thanks = (<r><![CDATA[
<div id="text">
<?php echo $this->_config[0]['vars']['Thank_you']; ?>

</div>
]]></r>).toString();
var report_html = (<r><![CDATA[
<div id="report">
<div id="cell2"><?php echo $this->_config[0]['vars']['total']; ?>
: <span id="total_algs"><?php echo $this->_config[0]['vars']['processing']; ?>
...</span></div>
<div id="cell2"><?php echo $this->_config[0]['vars']['added_algs']; ?>
: <span id="good_algs">0</span></div>
<div id="cell2"><?php echo $this->_config[0]['vars']['no_added_algs']; ?>
: <span id="bad_algs">0</span></div>
<div id="cell2"><?php echo $this->_config[0]['vars']['TSPT']; ?>
: <span id="server_time">0</span></div>
<div id="cell2"><?php echo $this->_config[0]['vars']['LPT']; ?>
: <span id="local_time">0</span></div>
<div id="cell2"><?php echo $this->_config[0]['vars']['progress']; ?>
: <span id="progress_percentage">0</span>% (<span id="progress_done">0</span>/<span id="progress_total">0</span>)</div>
<div id="cell2">Status: <span id="report_status">...</span></div>
//<div id="cell2"><?php echo $this->_config[0]['vars']['bad_algs']; ?>
: <span id="bads_algs"> </span></div>
</div>
]]></r>).toString();

// <?php echo '
const cycle_length = 50;
var algs = [];
var good = 0;
var bad = 0;
//var bads = [];
var server_time = 0.0;
var start_time = new Date().getTime();
var track_time = true;
var cycle_timeout = 1000;
var error_count = 0;

function parse_time(time)
{
	var secs = time % 60;
	time = parseInt(parseInt(time)/60);
	var mins = time % 60;
	time = parseInt(parseInt(time)/60);
	var hrs = time % 60;

	ret = [];
	if(hrs)
		ret.push(\'\' + hrs + \' hrs\');
	if(mins)
		ret.push(\'\' + mins + \' min\');
	
	if(ret.length)
		secs = parseInt(secs);

	ret.push(\'\' + secs + \' sec\');

	return ret.join(\' \');
}

function update_time()
{
	var time = new Date().getTime() - start_time;
	$(\'#local_time\').html(parse_time((time/1000).toFixed(2)));
	if(track_time)
		setTimeout(update_time, 200);
}

function update_progress(good, bad, total, server_time)
{
	$(\'#total_algs\').html(total);
	$(\'#progress_total\').html(total);
	$(\'#good_algs\').html(good);
	$(\'#bad_algs\').html(bad);
	$(\'#server_time\').html(parse_time(server_time.toFixed(2)));
	$(\'#progress_percentage\').html(((good+bad)*100/total).toFixed(2));
	$(\'#progress_done\').html(good+bad);
}

function update_status(status)
{
	$(\'#report_status\').html(status);
}

function on_data_received_factory(idx)
{
	return function(data)
	{
		error_count = 0;

		update_status(msg_parsing);
		good += parseInt(data[\'good\']);
		bad += parseInt(data[\'bad\']);
		//if(parseInt(data[\'bad\']) != 0) bads[] = 
		server_time += parseFloat(data[\'time\']);
		update_progress(good, bad, algs.length, server_time);
		setTimeout(function() {cycle(idx);}, cycle_timeout);
	};
}

function on_error_factory(idx)
{
	return function(a, b, c, d)
	{
		error_count += 1;
		setTimeout(function() {cycle(idx, msg_error + \' (\' + error_count.toString() + \')\');}, cycle_timeout);
	}
}

function cycle_end()
{
	track_time = false;
	update_status(msg_finished);
	$(\'#real_form_area\').html($(\'#real_form_area\').html() + msg_thanks);
}

function cycle(idx, message)
{
	if(idx == algs.length)
	{
		cycle_end();
		return;
	}
	var end = idx + cycle_length;
	if(end > algs.length)
		end = algs.length;

	if(message)
		update_status(message);
	else
		update_status(msg_connecting)

	var data = algs.slice(idx, end);
	jQuery.ajax({
			\'type\': \'POST\',
			\'url\': \'add_algs.php\',
			\'data\': {\'algs\': data.join(\'\\n\'), \'if_ma\': if_ma, \'output\': \'json\'},
			\'cache\': false,
			\'dataType\': \'json\',
			\'success\': on_data_received_factory(end),
			//\'error\': on_error_factory(idx),
	});
}

$(document).ready(function()
{
	$(\'#form_send\').html(\'<button id="submit">\' + msg_send + \'</button>\');
	$(\'#submit\').click(function()
	{
		algs_input = $(\'#algs_input\').val();
		if_ma = $(\'#if_ma\').val();
		$(\'#real_form_area\').html(report_html);
		update_status(msg_processing);
		algs = jQuery.grep(algs_input.split(/(\\<br \\/\\>)|[\\n\\,\\;]/i),function(x, i){return jQuery.trim(x) != \'\';});
		start_time = new Date().getTime();
		track_time = true;
		update_time();
		cycle(0);

	});
});

// '; ?>

</script>
<?php endif; ?>
<div id="title"><?php echo $this->_config[0]['vars']['add_algs_mess']; ?>
</div>

<?php if ($this->_tpl_vars['error'] != ''): ?><div id="message"><?php echo $this->_config[0]['vars'][$this->_tpl_vars['error']]; ?>
</div><?php endif; ?>
<div id="real_form_area">
<form name="addalgs" method="post" action="add_algs.php?l=<?php echo $this->_tpl_vars['lang']; ?>
">

<div class="form_area">
<textarea id="algs_input" name="algs" cols="60" rows="20"></textarea>
</div>

<div id="clear"> </div>

<?php if ($this->_tpl_vars['log_status'] == 1): ?>
<div id="bold"><input type="checkbox" checked="chcecked" name="if_ma" id="if_ma" /><?php echo $this->_config[0]['vars']['Add_with_MA']; ?>
</div>
<?php else: ?>
<div id="captcha"><img src="includes/captcha.php" /><input type="text" name="captcha" /></div>
<?php endif; ?>

<div id="form_send"><input type="submit" value="<?php echo $this->_config[0]['vars']['Send']; ?>
" /></div>
</form>
</div>

<?php else: ?>
<div id="title"><?php echo $this->_config[0]['vars']['Add_algs_raport']; ?>
</div>

<div id="add_part" class="bold">
<?php echo $this->_config[0]['vars']['added_algs']; ?>
 <?php echo $this->_tpl_vars['ok']; ?>

</div>

<div id="add_part" class="bold">
<?php echo $this->_config[0]['vars']['no_added_algs']; ?>
 <?php echo $this->_tpl_vars['bad']; ?>

</div>

<div id="message"><?php echo $this->_config[0]['vars']['Thank_you']; ?>
</div>

<?php endif; ?>
<div id="content_foot"><a href="index.php?l=<?php echo $this->_tpl_vars['lang']; ?>
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