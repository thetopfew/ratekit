<?php
/**
* 5-Star Topic RateKit. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 https://thetopfew.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
**/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(

	// ACP Modules
	'RATEKIT_TITLE'					=> 'RateKit',
	'RATEKIT_VERSION'				=> 'Installed Version: %s. <a style="font-weight: bold;" href="https://forums.thetopfew.com/viewforum.php?f=53" onclick="window.open(this.href);return false;">Visit Forum</a>.',
	'ACP_RATEKIT_SETTINGS'			=> 'Settings',
	
	'ACP_RATEKIT_FORUM_EXCLUDED'			=> 'Exclude selected forums',
	'ACP_RATEKIT_FORUM_EXCLUDED_EXPLAIN'	=> 'Forums selected will be excluded from displaying RateKit.<br /><strong>Attention:</strong> Categories and forums without topics are excluded by default.<br />To de-select, hold Ctrl + click.',
	'ACP_RATEKIT_SETTINGS_SAVED'			=> '<strong>Updated RateKit Settings</strong>',
	'ACP_RATEKIT_EXCLUDED_T_TYPES'			=> 'Exclude selected topic types',
	'ACP_RATEKIT_EXCLUDED_T_TYPES_EXPLAIN'	=> 'Will be excluded from displaying RateKit.<br />To de-select, hold Ctrl + click.',
	
	// ACP Permissions
	'ACL_U_USE_RATEKIT'				=> 'RateKit - Can rate topics via stars',
));
