{include file="header.tpl"}
<div class="content">
{if $what == 'show_form'}
{if $use_js}
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
// Localized messages
var msg_send = '{#Send#}';
var msg_processing = '{#PYD#}';
var msg_connecting = '{#UYA#}';
var msg_error = '{#add_error#}.';
var msg_parsing = '{#PSO#}';
var msg_finished = '{#finished#}';

{literal}
$(document).ajaxError(function(){
   if (window.console && window.console.error) {
       console.error(arguments);
   }
});
{/literal}

// Displayed during the process
var progress_html = (<r><![CDATA[
<div id="progress">
    <div id="cell2">{#total#}: <span id="total_algs">{#processing#}...</span></div>
    <div id="cell2">{#added_algs#}: <span id="good_algs">0</span></div>
    <div id="cell2">{#no_added_algs#}: <span id="bad_algs">0</span></div>
    <div id="cell2">{#TSPT#}: <span id="server_time">0</span></div>
    <div id="cell2">{#LPT#}: <span id="local_time">0</span></div>
    <div id="cell2">{#progress#}: <span id="progress_percentage">0</span>% (<span id="progress_done">0</span>/<span id="progress_total">0</span>)</div>
    <div id="cell2">Status: <span id="report_status">...</span></div>
</div>
]]></r>).toString();

// Displayed at the end
var report_html = (<r><![CDATA[
<div id="report">
    <div>Processed algorithms: <span id="total_algs"></span></div>
    <div>Successfully added: <span id="success"></span></div>
    <div>Duplicates: <span id="duplicate_num"></span></div>
    <div>Unrecognized: <span id="unrecognized_num"></span></div>
    <ul id="duplicate"></ul>
    <ul id="unrecognized"></ul>
</div>
]]></r>).toString();

// {literal}
const cycle_length = 50; // number of algs uploaded per cycle
var good = 0; // number of successfully processed algorithms
var bad = 0; // number of errrors
var server_time = 0.0; // total server processing time
var start_time = new Date().getTime(); // start of the local processing time
var track_time = true; // whether local time callback should work

var cycle_pause = 1000; // wait time, in ms, between the subsequent cycles;
var error_count = 0; // number of failed requests in a row

var algs = [];
var unrecognized_algs = []; 
var cloned_algs = [];

/*************
 * GLOBAL PROCESS HANDLING
 *************/

function begin_process()
{
    algs_input = $('#algs_input').val();

    create_progress();
    draw_status(msg_processing);

    algs = jQuery.grep(algs_input.split(/(\<br \/\>)|[\n\,\;]/i),function(x, i){return jQuery.trim(x) != '';});

    start_updating_time();

    cycle(0);
}

function end_process()
{
    stop_updating_time();

    create_final_report();
}

/*************
 * TIMER
 *************/

function start_updating_time()
{
    start_time = new Date().getTime();
    track_time = true;

    update_time_callback();    
}

function stop_updating_time()
{
    track_time = false;
}

function update_time_callback()
{
    var time = new Date().getTime() - start_time;
    draw_time(parse_time((time/1000).toFixed(2)));
    if(track_time)
        setTimeout(update_time_callback, 200);
}

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

/*************
 * DRAWING
 *************/

function create_final_report()
{
    $('#real_form_area').html(report_html);

    $('#total_algs_num').html(algs.length);
    $('#success_num').html(good);
    $('#duplicate_num').html(cloned_algs.length);
    $('#unrecognized_num').html(unrecognized_algs.length);

    for(var i = 0; i < unrecognized_algs.length; i++)
        $('<li></li>').html(unrecognized_algs[i]).appendTo('#unrecognized');

    for(var i = 0; i < cloned_algs.length; i++)
        $('<li></li>').html(cloned_algs[i]).appendTo($('#duplicate'));
}

function create_progress()
{
    $('#real_form_area').html(progress_html);
}

function draw_progress()
{
    $('#total_algs').html(algs.length);
    $('#progress_total').html(algs.length);
    $('#good_algs').html(good);
    $('#bad_algs').html(bad);
    $('#server_time').html(parse_time(server_time.toFixed(2)));
    $('#progress_percentage').html(((good+bad)*100/algs.length).toFixed(2));
    $('#progress_done').html(good+bad);
}

function draw_time(time)
{
    $('#local_time').html(time);
}

function draw_status(status)
{
    $('#report_status').html(status);
}

/*************
 * REQUEST CYCLE
 *************/

function on_data_received_factory(idx)
{
    return function(data)
    {
        error_count = 0;

        draw_status(msg_parsing);

        good += parseInt(data['good']);
        bad += parseInt(data['bad']);

        cloned_algs = cloned_algs.concat(data['cloned']);
        unrecognized_algs = unrecognized_algs.concat(data['unrecognized']);

        server_time += parseFloat(data['time']);

        draw_progress();

        setTimeout(function() {cycle(idx);}, cycle_pause);
    };
}

function on_error_factory(idx)
{
    return function(a, b, c, d)
    {
        error_count += 1;

        setTimeout(function() {cycle(idx, msg_error + ' (' + error_count.toString() + ')');}, cycle_pause);
    }
}

function cycle(idx, message)
{
    if(idx == algs.length)
    {
        end_process();
        return;
    }

    var end = idx + cycle_length;

    if(end > algs.length)
        end = algs.length;

    if(message)
        draw_status(message);
    else
        draw_status(msg_connecting)

    var data = algs.slice(idx, end);

    jQuery.ajax({
            'type': 'POST',
            'url': 'add_algs.php',
            'data': {'algs': data.join('\n'), 'output': 'json'},
            'cache': false,
            'dataType': 'json',
            'success': on_data_received_factory(end),
            'error': on_error_factory(idx),
    });
}

$(document).ready(function()
{
    $('#form_send').html('<button id="submit">' + msg_send + '</button>');
    $('#submit').click(function()
    {
        begin_process();
    });
});

// {/literal}
</script>
{/if}
<div id="title">{#add_algs_mess#}</div>

{if $error != ''}<div id="message">{$smarty.config.$error}</div>{/if}
<div id="real_form_area">
<form name="addalgs" method="post" action="add_algs.php?l={$lang}">

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
