#!/usr/bin/env php

<?php
require_once __DIR__ . "ServiceCommandLine.php";
require_once __DIR__ . "GitRepo.php";
require_once 'git.php';

$command = new ServiceCommandLine();

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
	
	$git->addRemote('upstream', $info['url']);
	if (isset($info['main_url']))
	{
		$git->addRemote('upstream', $info['main_url']);
	}
	
	$gits[] = $git;
}

// add a global option to make the program verbose

// run the parser
try {
    $result = $command->parse();
    if ($result->command_name) {
        if ($result->command_name == 'update') 
        {
            echo "Updating modules: $st\n";
            print_r($result->command);
        } 
        else if ($result->command_name == 'install') 
        {
            echo "Installing...\n";
        } 
        else if ($result->command_name == 'list') 
        {
            echo "Installable modules:\n\n";
            ksort($gitRepositories);
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
    	
    }
} catch (Exception $exc) {
    $command->displayError($exc->getMessage());
}

exit();
