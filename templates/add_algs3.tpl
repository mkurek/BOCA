{include file="header.tpl"}
<div class="content">
{if $what == 'show_form'}
{if $use_js}
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
// Localized messages
var msg_send = '{#Send#} (with Javascript)';
var msg_processing = 'Processing your data.';
var msg_connecting = 'Uploading your algorithms.';
var msg_error = 'An error occured. Trying again.';
var msg_parsing = 'Parsing server output.';
var msg_finished = 'Finished!';

{literal}
$(document).ajaxError(function(){
   if (window.console && window.console.error) {
       console.error(arguments);
   }
});
{/literal}

var msg_thanks = (<r><![CDATA[
<div id="text">
{#Thank_you#}
</div>
]]></r>).toString();
var report_html = (<r><![CDATA[
<div id="report">
Total: <span id="total_algs">Processing...</span><br />
{#added_algs#}: <span id="good_algs">0</span><br />
{#no_added_algs#}: <span id="bad_algs">0</span><br />
Total server processing time: <span id="server_time">0</span><br />
Local processing time: <span id="local_time">0</span><br />
Progress: <span id="progress_percentage">0</span>% (<span id="progress_done">0</span>/<span id="progress_total">0</span>)<br />
Status: <span id="report_status">...</span><br />
</div>
]]></r>).toString();

// {literal}
const cycle_length = 50;
var algs = [];
var good = 0;
var bad = 0;
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
		ret.push('' + hrs + ' hrs');
	if(mins)
		ret.push('' + mins + ' min');
	
	if(ret.length)
		secs = parseInt(secs);

	ret.push('' + secs + ' sec');

	return ret.join(' ');
}

function update_time()
{
	var time = new Date().getTime() - start_time;
	$('#local_time').html(parse_time((time/1000).toFixed(2)));
	if(track_time)
		setTimeout(update_time, 200);
}

function update_progress(good, bad, total, server_time)
{
	$('#total_algs').html(total);
	$('#progress_total').html(total);
	$('#good_algs').html(good);
	$('#bad_algs').html(bad);
	$('#server_time').html(parse_time(server_time.toFixed(2)));
	$('#progress_percentage').html(((good+bad)*100/total).toFixed(2));
	$('#progress_done').html(good+bad);
}

function update_status(status)
{
	$('#report_status').html(status);
}

function on_data_received_factory(idx)
{
	return function(data)
	{
		error_count = 0;

		update_status(msg_parsing);
		good += parseInt(data['good']);
		bad += parseInt(data['bad']);
		server_time += parseFloat(data['time']);
		update_progress(good, bad, algs.length, server_time);
		setTimeout(function() {cycle(idx);}, cycle_timeout);
	};
}

function on_error_factory(idx)
{
	return function(a, b, c, d)
	{
		error_count += 1;
		//alert(a.toString());
		//alert(b.toString());
		//alert(c.toString());
		//alert(d.toString());
		setTimeout(function() {cycle(idx, msg_error + ' (' + error_count.toString() + ')');}, cycle_timeout);
	}
}

function cycle_end()
{
	track_time = false;
	update_status(msg_finished);
	$('#real_form_area').html($('#real_form_area').html() + msg_thanks);
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
			'type': 'POST',
			'url': 'add_algs.php',
			'data': {'algs': data.join('\n'), 'output': 'json'},
			'cache': false,
			'dataType': 'json',
			'success': on_data_received_factory(end),
			//'error': on_error_factory(idx),
	});
}

$(document).ready(function()
{
	$('#form_send').html('<button id="submit">' + msg_send + '</button>');
	$('#submit').click(function()
	{
		algs_input = $('#algs_input').val();
		$('#real_form_area').html(report_html);
		update_status(msg_processing);
		algs = jQuery.grep(algs_input.split(/(\<br \/\>)|[\n\,\;]/i),function(x, i){return jQuery.trim(x) != '';});
		start_time = new Date().getTime();
		track_time = true;
		update_time();
		cycle(0);

	});
});

// {/literal}
</script>
{/if}
<div id="title">{#add_algs_mess#}</div>

{if $error != ''}<div id="message">{$smarty.config.$error}</div>{/if}
<div id="real_form_area">
<form name="addalgs" method="post" action="add_algs.php?l={$lang}">
{* <input  type='hidden' name='output' value='json' /> *}
<div class="form_area">
<textarea id="algs_input" name="algs" cols="60" rows="20"></textarea>
</div>

<div id="clear"> </div>

{if $log_status == 1}
<div id="bold"><input type="checkbox" checked="chcecked" name="if_ma" />{#Add_with_MA#}</div>
{else}
<div id="captcha"><img src="includes/captcha.php" /><input type="text" name="captcha" /></div>
{/if}

<div id="form_send"><input type="submit" value="{#Send#}" /></div>
</form>
</div>

{else}
<div id="title">{#Add_algs_raport#}</div>

<div id="add_part" class="bold">
{#added_algs#} {$ok}
</div>

<div id="add_part" class="bold">
{#no_added_algs#} {$bad}
</div>

<div id="text">{#Thank_you#}</div>

{/if}
<div id="content_foot"><a href="index.php?l={$lang}">{#back_to_main_site#}</a></div>
</div>
{include file="menu.tpl"}
{include file="footer.tpl"}
