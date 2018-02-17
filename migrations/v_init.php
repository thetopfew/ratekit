<?php
/**
* 5-Star Topic RateKit. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 https://thetopfew.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
**/

namespace thetopfew\ratekit\migrations;

class v_init extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['ratekit_version']) && version_compare($this->config['ratekit_version'], '1.2.0', '>=');
	}
	
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\dev');
	}

	public function update_data()
	{
		global $user;
		// even tho info_ lang files load auto, they don't during migration. this is required for lang in admin logs on add module
		$user->add_lang_ext('thetopfew/ratekit', 'acp/info_acp_ratekit');
		
		return array(
			// Current version
			array('config.add', array('ratekit_version', '1.2.0')),

			// Add permissions
			array('permission.add', array('u_use_ratekit')),
			array('permission.permission_set', array('ROLE_USER_FULL', 'u_use_ratekit')),
			array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_use_ratekit')),

			array('config_text.add', array('ratekit_excluded', '')),

			// Add ACP modules
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'RATEKIT_TITLE')),
			array('module.add', array('acp', 'RATEKIT_TITLE', array(
					'module_basename'	=> '\thetopfew\ratekit\acp\functions_module',
					'module_auth'		=> 'ext_thetopfew/ratekit && acl_a_board',
					'module_mode'		=> 'settings',
				))
			),
		);
	}
}
