<?php
/**
* 5-Star Topic RateKit. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 https://thetopfew.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
**/

namespace thetopfew\ratekit\acp;

class functions_module
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerInterface */
	protected $phpbb_container;

	/** @var string */
	public $u_action;

	
	function main($id, $mode)
	{
		global $config, $request, $template, $user, $phpbb_container;
		
		$this->config = $config;
		$this->config_text = $phpbb_container->get('config_text');
		$this->log = $phpbb_container->get('log');
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;

		switch ($mode)
		{
			case 'settings':
			// no break
			default:
				$this->tpl_name = 'acp_settings';
				$this->page_title = 'ACP_RATEKIT_SETTINGS';
				add_form_key('acp_ratekit_excluded_forums');
		}
		
		if ($this->request->is_set_post('submit'))
			{
				if (!check_form_key('acp_ratekit_excluded_forums'))
				{
					trigger_error($this->user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
				
				$this->config_text->set('ratekit_excluded', implode(',', $this->request->variable('ratekit_excluded', array(0))));
				$this->config_text->set('ratekit_excluded_t_types', implode(',', $this->request->variable('ratekit_excluded_t_types', array(0))));
							
				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'ACP_RATEKIT_SETTINGS_SAVED');
				trigger_error($this->user->lang['ACP_RATEKIT_SETTINGS_SAVED'] . adm_back_link($this->u_action));
			}
			
			$this->template->assign_vars(array(
				'RATEKIT_VERSION'			=> sprintf($this->user->lang['RATEKIT_VERSION'], '<strong>' . $this->config['ratekit_version'] . '</strong>'),
				'RATEKIT_EXCLUDED_FORUMS'	=> make_forum_select(explode(',', $this->config_text->get('ratekit_excluded')), false, false, true),
				'RATEKIT_EXCLUDE_LOCKED'	=> (in_array(9, explode(',', $this->config_text->get('ratekit_excluded_t_types')))) ? true : false,
				'RATEKIT_EXCLUDE_GLOBAL'	=> (in_array(3, explode(',', $this->config_text->get('ratekit_excluded_t_types')))) ? true : false,
				'RATEKIT_EXCLUDE_ANNOUNCE'	=> (in_array(2, explode(',', $this->config_text->get('ratekit_excluded_t_types')))) ? true : false,
				'RATEKIT_EXCLUDE_STICKY'	=> (in_array(1, explode(',', $this->config_text->get('ratekit_excluded_t_types')))) ? true : false,
			));
	}
}
