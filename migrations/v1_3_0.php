<?php
/**
* 5-Star Topic RateKit. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 https://thetopfew.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
**/

namespace thetopfew\ratekit\migrations;

class v1_3_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['ratekit_version']) && version_compare($this->config['ratekit_version'], '1.3.0', '>=');
	}
	
	static public function depends_on()
	{
		return array('\thetopfew\ratekit\migrations\v_init',);
	}

	public function update_data()
	{
		// Remove prosilver to support all styles now.
		$dirname = $this->phpbb_root_path . 'ext/thetopfew/ratekit/styles/prosilver/';
		$this->remove_prosilver($dirname);
		
		return array(
			// Current version
			array('config.update', array('ratekit_version', '1.3.0')),
			
			// Select topic type to display, option enable with default
			array('config_text.add', array('ratekit_excluded_t_types', '')),
		);
	}
	
	// Recursively remove a directory and all contents
	public function remove_prosilver($dirname)
	{
		if (is_dir($dirname))
			$dir_handle = opendir($dirname);
			if (!$dir_handle)
			return false;
		
			while($file = readdir($dir_handle)) 
			{
				if ($file != "." && $file != "..") 
				{
					if (!is_dir($dirname."/".$file))
						unlink($dirname."/".$file);
					else
						$this->remove_prosilver($dirname.'/'.$file);
				}
			}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}
}
