<?php
require_once 'Console/CommandLine.php';

class ServiceCommandLine 
	extends Console_CommandLine
{
	public function __construct()
	{	
		parent::__construct(array(
    		'description' => 'Assits with setting up git repo!',
		    'version'     => '1.0'
		));
		
		$this->addOption('verbose', array(
		    'short_name'  => '-v',
		    'long_name'   => '--verbose',
		    'action'      => 'StoreTrue',
		    'description' => 'turn on verbose output'
		));
		
		// add the foo subcommand
		$installCommand = $this->addCommand('install', array(
		    'description' => 'Install git hub repositories'
		));
		
		$this->addCommand('update', array(
		    'description' => 'Update git hub repositories'
		))->addOption('repos', array(
		    'short_name'  => '-r',
		    'long_name'   => '--repos',
		    'action'      => 'StoreString',
		    'description' => 'list of repos to update'
		));
		
		$this->addCommand('list', array(
		    'description' => 'Update git hub repositories'
		));
				
	}
}