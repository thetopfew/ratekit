<?php
/**
* 5-Star Topic RateKit. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 https://thetopfew.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
**/

namespace thetopfew\ratekit\acp;

class functions_info
{
	public function module()
	{
		return array(
			'filename'	=> '\thetopfew\ratekit\acp\functions_module',
			'title'		=> 'RATEKIT_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title' => 'ACP_RATEKIT_SETTINGS',
					'auth' => 'ext_thetopfew/ratekit && acl_a_board',
					'cat' => array('RATEKIT_TITLE')
			)),
		);
	}
}