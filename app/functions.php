<?php
ini_set('xdebug.var_display_max_depth', 5);
date_default_timezone_set('America/Los_Angeles');

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
{
	ini_set('html_errors', 'Off');
}

function v($arg, $showTrace = true)
{
	if ($showTrace)
	{
		$traces = debug_backtrace();
		foreach ($traces as $index => $trace)
		{
			if ($index != 0 || !isset($trace['file']))
			{
				continue;
			}
			else
			{
				var_dump("{$trace['file']} (line {$trace['line']})");
				break;
			}
		}
	}

	xdebug_var_dump($arg);
}

function ve($arg)
{
	v($arg);exit();
}

function f($message)
{
	xdebug_print_function_stack($message);
}

function fe($message)
{
	xdebug_print_function_stack($message);
	exit();
}


/*
function startsWith($haystack,$needle,$case=true) {
    if($case){return (strcmp(substr($haystack, 0, strlen($needle)),$needle)===0);}
    return (strcasecmp(substr($haystack, 0, strlen($needle)),$needle)===0);
}*/

function endsWith($haystack,$needle,$case=true) {
    if($case){return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
    return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
}
