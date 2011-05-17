#!/usr/bin/env php

<?php
require_once __DIR__ . "/command/ServiceCommandLine.php";
require_once __DIR__ . "/command/GitRepo.php";
require_once __DIR__ . "/command/git.php";

$command = new ServiceCommandLine();

function print_shell_exec($cmd) {
	echo $cmd . "\n";
	echo shell_exec($cmd);
}

$gits = array();
$parentGitPath = $installPath =  __DIR__ . '/';
foreach ($gitRepositories as $key => $info)
{
	$branch = 'HEAD';
	if (isset($info['branch']))
	{
		$branch = $info['branch'];
	}
	
	if (isset($info['path']))
	{
		$absolutePath = $parentGitPath . $info['path'];
	}
	else
	{
		$absolutePath = $parentGitPath  . 'vendor/' . $key;
	}
	
	$git = new GitRepo($key, $absolutePath, $parentGitPath);
	$git->setSelectedBranch($branch);
	
	$git->addRemote('origin', $info['url']);
	if (isset($info['main_url']))
	{
		$git->addRemote('upstream', $info['main_url']);
	}
	
	if (isset($info['type']))
	{
		$git->setType($info['type']);
	}
	else
	{
		$git->setType('external');
	}
	
	if (isset($info['submodule'])) {
		$git->setSubModule($info['submodule']);
	}
	
	$gits[$key] = $git;
}
ksort($gits);

// add a global option to make the program verbose

// run the parser
try {
    $result = $command->parse();
    if ($result->command_name) {
        if ($result->command_name == 'update') 
        {
        	$repos = $result->command->options['repos'];
        	if ($repos)
        	{
        		$toUpdate = explode(',', $repos);
        	}
        	else
        	{
        		$toUpdate = array_keys($gits);
        		$repos = implode(',', $toUpdate);
        	}
        	
            echo "Updating modules: {$repos}\n";
            foreach ($toUpdate as $key)
            {
            	if (isset($gits[$key]))
            	{
            		$gits[$key]->update();
            	}
            }
        } 
        else if ($result->command_name == 'install') 
        {
        	$repos = $result->command->options['repos'];
        	if ($repos)
        	{
        		$toInstall = explode(',', $repos);
        	}
        	else
        	{
        		$toInstall = array_keys($gits);
        		$repos = implode(',', $toInstall);
        	}
        	
            echo "Installing modules: {$repos}\n";
            foreach ($toInstall as $key)
            {
            	if (isset($gits[$key]))
            	{
            		$gits[$key]->install();
            	}
            }
        } 
        else if ($result->command_name == 'list') 
        {
            echo "Installable modules:\n\n";
            foreach ($gits as $key => $git)
            {
            	printf("%-32s %-50s\n", $key, $git->getRemote('origin'));
            }
        } 
        else if ($result->command_name == 'clean') 
        {
            echo "Removing everything\n";
        } 
        else if ($result->command_name == 'zip') 
        {
            echo "Zipping up everything!\n";
        }
    }
    else
    {
    	$command->displayUsage();
    }
} catch (Exception $exc) {
    $command->displayError($exc->getMessage());
}
