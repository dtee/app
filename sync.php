#!/usr/bin/env php

<?php
require_once(__DIR__ . '/command/git.php');

$yumInstall = array(
	'open-ssl-devel', 	// Node.js
);

function print_shell_exec($cmd) {
	echo $cmd . "\n";
	echo shell_exec($cmd);
}

$installPath =  __DIR__ . '/';
foreach ($gitRepositories as $key => $info)
{
	$version = 'HEAD';
	if (isset($info['version']))
		$version = $info['version'];

	if (isset($info['path']))
	{
		$directoryPath = $installPath . $info['path'];
	}
	else
	{
		$directoryPath = $installPath . 'vendor/' . $key;
	}

	echo "Target: " . $directoryPath . "\n";
	if (is_dir($directoryPath))
	{
		chdir($directoryPath);
		// Do we upgrade??
		echo "Target exists...\n";
		//$command = "git pull";
		//echo print_shell_exec($command);

		// Make sure the target url is still the same.
		echo "path: " . getcwd() . "\n";
		echo print_shell_exec("git remote rm origin");
		echo print_shell_exec("git remote rm upstream");
		echo print_shell_exec("git remote add origin {$info['url']}");

		echo print_shell_exec("git config branch.master.remote origin");
		echo print_shell_exec("git config branch.master.merge refs/heads/master");
		
		if (isset($info['main_url']))
		{
			echo print_shell_exec("git remote add upstream {$info['main_url']}");
			echo print_shell_exec("git fetch upstream");
		}
		else
		{
			echo print_shell_exec("git fetch origin");
			echo print_shell_exec("git pull --rebase origin master");
		}

		//echo print_shell_exec("git reset --hard {$version}");
	}
	else
	{
		echo print_shell_exec("git clone {$info['url']} {$directoryPath}");

		if ($version)
		{
			chdir($directoryPath);
			echo print_shell_exec("cd {$directoryPath}");
			echo print_shell_exec("git reset --hard {$version}");
		}
	}

	echo "---------- End {$key} ----------\n\n";
	chdir($installPath);
}