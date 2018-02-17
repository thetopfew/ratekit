<?php
/**
* 5-Star Topic RateKit. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2017 https://thetopfew.com
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
**/

namespace thetopfew\ratekit\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Extension Event listener.
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;
	
	/** @var \phpbb\config\config */
	protected $config;
	
	/** @var \phpbb\config\db_text */
	protected $config_text;
	
	/** @var \phpbb\template\template */
	protected $template;
	
	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\auth\auth						$auth
	* @param \phpbb\config\config					$config
	* @param \phpbb\config\db_text					$config_text
	* @param \phpbb\template\template				$template
	* @param \phpbb\user							$user
	**/
	public function __construct(
		\phpbb\auth\auth $auth,
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\template\template $template,
		\phpbb\user $user)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'								=> 'ratekit_startup',
			'core.permissions'								=> 'add_permissions',
			'core.search_modify_tpl_ary'					=> 'search_modify_tpl_ary',
			'core.viewforum_modify_topicrow'				=> 'viewforum_modify_topicrow',
			'core.viewtopic_assign_template_vars_before'    => 'viewtopic_assign_template_vars_before',
		);
	}
	
   	/**
	* Event to load language files and modify user data on every page
	*
	* @param object $event The event object
	* @return null
	* @access public
	* @use phpbb/user.php
	* @arguments: lang_set, lang_set_ext, style_id, user_data, user_date_format, user_lang_name, user_timezone
	*/
	public function ratekit_startup($event)
	{
		$this->user->add_lang_ext('thetopfew/ratekit', 'common');
	}
	
	/**
	* Allows to specify additional permission categories, types and permissions 
	*
	* @param object $event The event object
	* @return null
	* @access public
	* @use phpbb/permissions.php
	* @arguments: categories, permissions, types
	*/
	public function add_permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['u_use_ratekit'] = array('u_use_ratekit', 'cat' => 'post');
		$event['permissions'] = $permissions;
	}	
	
	/**
	* Modify the topic data before it is assigned to the search template
	*
	* @param object $event The event object
	* @return null
	* @access public
	* @use search.php 
	* @arguments: attachments, folder_alt, folder_img, posts_unapproved, replies, row, show_results, topic_deleted, topic_title,
	*			  topic_type, topic_unapproved, tpl_ary, u_mcp_queue, unread_topic, view_topic_url, zebra
	*/
	public function search_modify_tpl_ary($event)
	{
		$row = $event['row'];
		$tpl_ary = $event['tpl_ary'];

		// Display in this forum?
		if ( ($this->user->data['is_bot'] == false) && (!in_array($row['forum_id'], $this->get_excluded_forums())) && (!in_array($row['topic_type'], $this->excluded_topic_types())) )
		{			
			$tpl_ary['SHOW_RATEKIT'] = true;
			// Show on locked topics?
			if ($this->show_on_locked($row))
			{
				$tpl_ary['SHOW_RATEKIT'] = false;
			}
		}
		
		$event['row'] = $row;
		$event['tpl_ary'] = $tpl_ary;
	}
	
	/**
	* Modify the topic data before it is assigned to the template
	*
	* @param object $event The event object
	* @return null
	* @access public
	* @use viewforum.php
	* @arguments: row, s_type_switch, s_type_switch_test, topic_row
	*/
	public function viewforum_modify_topicrow($event)
	{
		$row = $event['row'];
		$topic_row = $event['topic_row'];
		
		// Display in this forum and on which topic type?
		if ( ($this->user->data['is_bot'] == false) && (!in_array($row['forum_id'], $this->get_excluded_forums())) && (!in_array($row['topic_type'], $this->excluded_topic_types())) )
		{
			$topic_row['SHOW_RATEKIT'] = true;
			// Show on locked topics?
			if ($this->show_on_locked($row))
			{
				$topic_row['SHOW_RATEKIT'] = false;
			}
		}
		
		$event['row'] = $row;
		$event['topic_row'] = $topic_row;
	}
	
	/**
	* Event to modify data before template variables are being assigned
	*
	* @param object $event The event object
	* @return null
	* @access public
	* @use viewtopic.php
	* @arguments: base_url, forum_id, post_id, quickmod_array, start, topic_data, topic_id, topic_tracking_info, total_posts, viewtopic_url
	*/
	public function viewtopic_assign_template_vars_before($event)
	{
		$topic_data = $event['topic_data'];
		
		// Display in this forum and on which topic type?
		if ( ($this->user->data['is_bot'] == false) && (!in_array($topic_data['forum_id'], $this->get_excluded_forums())) && (!in_array((int)$topic_data['topic_type'], $this->excluded_topic_types())) )
		{
			$this->template->assign_vars(array(
				'SHOW_RATEKIT'		=> true,
			));
			
			// Show on locked topics?
			if ($this->show_on_locked($topic_data))
			{
				$this->template->assign_vars(array(
					'SHOW_RATEKIT'		=> false,
				));
			}
			
			// Does user got permission to rate topics?
			if ($this->auth->acl_get('u_use_ratekit'))
			{
				$this->template->assign_var('USE_RATEKIT', true);
			}
		}

		$event['topic_data'] = $topic_data;
	}
	
	/**
	* Retrieve list of disabled 'forums' selected in ACP module
	*
	* @param null
	* @return array(ratekit_excluded)
	* @access private
	*/
	private function get_excluded_forums()
	{
		return (($this->config_text->get('ratekit_excluded')) ? explode(',', $this->config_text->get('ratekit_excluded')) : array());
	}
	
	/**
	* Retrieve list of disabled 'topic types' selected in ACP module
	*
	* @param null
	* @return array(ratekit_excluded_t_types)
	* @access private
	*/
	private function excluded_topic_types()
	{
		return (($this->config_text->get('ratekit_excluded_t_types')) ? explode(',', $this->config_text->get('ratekit_excluded_t_types')) : array());
	}
	
	/**
	* Check settings if disabled for 'locked topics' in ACP module
	*
	* @param Object $arg
	* @return true or false
	* @access private
	*/
	private function show_on_locked($arg)
	{
		return ($arg['topic_status'] == 1) && (in_array(9, explode(',', $this->config_text->get('ratekit_excluded_t_types')))) ? true : false;
	}

}