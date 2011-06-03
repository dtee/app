<?php
ini_set('xdebug.var_display_max_depth', 5);
date_default_timezone_set('America/Los_Angeles');

// Check to see if it running from console
if (!defined('STDIN'))
{
	ini_set('html_errors', 'On');
}
else
{
	ini_set('xdebug.var_display_max_depth', 2);
	ini_set('html_errors', 'Off');
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest')
{
	ini_set('html_errors', 'Off');
}


if (!function_exists('v'))
{
	function v($arg, $showTrace = true)
	{
		if ($showTrace)
		{
			$traces = debug_backtrace();
			foreach ($traces as $index => $trace)
			{
				if ($index <= 0 && !isset($trace['file']))
				{
					var_dump("{$trace['file']} (line {$trace['line']})");
					continue;
				}
				else
				{
					var_dump("{$trace['file']} (line {$trace['line']})");
					break;
				}
			}
		}

		var_dump($arg);
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
}

if (!function_exists('startswith'))
{
	function startsWith($haystack,$needle,$case=true) {
	    if($case){return (strcmp(substr($haystack, 0, strlen($needle)),$needle)===0);}
	    return (strcasecmp(substr($haystack, 0, strlen($needle)),$needle)===0);
	}
}

if (!function_exists('endsWith'))
{
	function endsWith($haystack,$needle,$case=true) {
	    if($case){return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);}
	    return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
	}
}
