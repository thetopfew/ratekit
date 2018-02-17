# 5-Star Topic RateKit ChangeLog
# phpBB extension, by kaspir@thetopfew.com
# License [GPLv2](license.txt)


## RateKit v1.3.0 (01-20-2018)
	* Fixed: Bug reported that sometimes topics were not opening.
	* Added: ACP option for disabling Ratekit on Locked, Global, Announcement and/or Sticky topics.
	* Moved: Top display in viewtopic from after title, to before post buttons. 
	* Changed: Templates for all styles. Migration removes /prosilver/ from this extension and /all/ folder in this package.
	* Tweaked: CSS to reflect some template changes and to float the 'Overall' to the right in view topic, plus other enhancements.

	
## RateKit v1.2.0 (12-16-2017)
	* Added: ACP RateKit Module -> Settings tab, admins may now disable in selected forums.
	* Added: User role permissions -> Post tab, admins may now control who may use RateKit.
	* Added: An on-hover pop up notification for users without permissions to rate topics.
	* Moved: 'Overall Rating' text in viewforum to a on-hover pop up, to conserve space. (idea by clight77)
	* Changed: Removed 'Overall' stars from Global, Announcement and Sticky topics using basic template vars.


## RateKit v1.1.1 (09-04-2017)
	* Fixed: Now displays properly on search topic rows.


## RateKit v1.1.0 (08-31-2017)
	* Added: andfinally updated script to present the "Average and total reviews"
	* Added: Each topics' "overall star rating" in viewforum.php (idea by clight77)
	* Added: phpBB version_compare for >3.2, ext.php
	* Changed: Some of the original bootstrap, 'pop-up' text.


## RateKit v1.0.1 (08-14-2017)
	* Added: Protection from bots rating topics.
    * Fixed: Rating data stored as official topic id now, no longer the post id.
    * Moved: Star rating from within the first post, to above and below the post buttons.
	
	
## RateKit v1.0.0 (07-31-2017)
	* FIRST RELEASE