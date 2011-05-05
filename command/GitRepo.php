<?php
class GitRepo {
	protected $key;
	protected $absolutePath;
	protected $branches;
	protected $parentGitPath;
	protected $remotes;
	protected $selectedBranch = 'master';
	protected $type;

	public function __construct($key, $absolutePath, $parentGitPath) {
		$this->key = $key;
		$this->parentGitPath = $parentGitPath;
		$this->absolutePath = $absolutePath;
	}
	
	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param field_type $type
	 */
	public function setType($type) {
		$this->type = $type;
	}
	
	/**
	 * @return the $key
	 */
	public function getKey() {
		return $this->key;
	}
	/**
	 * @return the $absolutePath
	 */
	public function getAbsolutePath() {
		return $this->absolutePath;
	}

	/**
	 * @return the $branches
	 */
	public function getBranches() {
		return $this->branches;
	}

	/**
	 * @param field_type $branches
	 */
	public function setBranches($branches) {
		$this->branches = $branches;
	}

	/**
	 * @return the $parentGitPath
	 */
	public function getParentGitPath() {
		return $this->parentGitPath;
	}

	/**
	 * @return the $remotes
	 */
	public function getRemotes() {
		return $this->remotes;
	}
	
	public function getRemote($key) {
		return $this->remotes[$key];
	}
	
	public function addRemote($key, $url) {
		$this->remotes[$key] = $url;
	}

	/**
	 * @param field_type $remotes
	 */
	public function setRemotes($remotes) {
		$this->remotes = $remotes;
	}

	/**
	 * @return the $selectedBranch
	 */
	public function getSelectedBranch() {
		return $this->selectedBranch;
	}

	/**
	 * @param field_type $selectedBranch
	 */
	public function setSelectedBranch($selectedBranch) {
		$this->selectedBranch = $selectedBranch;
	}

	public function update()
	{
		chdir($this->absolutePath);

		// Make sure the target url is still the same.
		echo "path: " . getcwd() . "\n";
		echo print_shell_exec("git remote rm origin");
		echo print_shell_exec("git remote add origin {$this->remotes['origin']}");

		if (isset($this->remotes['upstream']))
		{
			echo print_shell_exec("git remote rm upstream");
			echo print_shell_exec("git remote add upstream {$this->remotes['upstream']}");
			echo print_shell_exec("git fetch upstream");
			echo print_shell_exec("git pull --rebase upstream master");
		}
		else
		{
			echo print_shell_exec("git fetch origin");
			echo print_shell_exec("git pull --rebase origin master");
		}
		
		echo "---------- End Upgrade: {$this->key} ----------\n\n";
	}
	
	public function install()
	{
		if ($this->isInstalled())
		{
			echo "{$this->key} is already installed.";
			echo "---------- End Upgrade: {$key} ----------\n\n";
			return;
		}
		
		echo print_shell_exec("git clone {$this->remotes['origin']} {$this->absolutePath}");

	}
	
	public function isInstalled()
	{
		return is_dir($this->absolutePath . '/.git');
	}
}