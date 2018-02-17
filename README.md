# 5-Star Topic RateKit 1.3.0
# phpBB extension for >=3.2.x
# License [GPLv2](license.txt)

## Credits
[![RateKit](styles/all/theme/img/ratekit-logo.gif)](https://ratekit.com/)

#!#!#!#!#!#IMPORTANT!#!#!#!#!#!#!#!#!#!#!#!#!IMPORTANT!#!#!#!#!#!#!#!#!#!#!#!#!IMPORTANT#!#!#!#!#!#

This extension stores topic rating data in a file. If this is NOT your first install, and you are updating from a previous version, DO THIS FIRST:

	- Thru FTP, Go to the extensions' (thetopfew/ratekit/) and BACKUP the entire /data/ folder. Save it to your desktop for instance. THEN, after updating the extension,
	re-upload your backup /data/ folder, overwriting the new one that comes with this package. OR, simply remove this packages /data/ folder before uploading the update.
		You get the picture.

The 'data' folder is where your current star ratings are if you have this extension installed already! You do not want to over-write them do you and start over, or do you?

#!#!#!#!#!#IMPORTANT!#!#!#!#!#!#!#!#!#!#!#!#!IMPORTANT!#!#!#!#!#!#!#!#!#!#!#!#!IMPORTANT#!#!#!#!#!#

## Introduction
RateKit is a simple PHP / jQuery plugin that adds ratings stars to an existing site. **Converted specifically for phpBB forums software in this extension!**


## What it does
On loading RateKit transforms any input with class "rating" into a group of ratings stars. The plugin stores ratings in a local SQLIte database: when it loads RateKit
checks the existing rating for each input and displays it. When a user clicks to leave a rating, RateKit checks their IP address. If they've tried to rate that item 
before within a set period (5-years by default), the new rating isn't registered. Instead, it displays their existing rating, then switches back to the overall  rating and
disables the input. (You can set the period for this check by changing `THROTTLE_TIME` in `config.php`.) If the user hasn't rated that item before, RateKit adds their rating
to the overall score and displays the updated star rating.


## Description
Allows every visitor to leave a 5-star rating per topic! RateKit is an easy-to-use, ultra low maintenance PHP and jQuery plugin. NO creating/altering phpBB database tables.
Instead, tracks by visitors' by IP address and stores ratings in a local SQLIte database file: when it loads, it checks the existing rating for each topic, whether or not IP
has rated before, and displays an average rating.
	- NEW in version 1.1.0, rating now displays in viewforum per topic overall rating, AND an average & total reviews in viewtopic!
	- NEW in version 1.2.0, ACP module added, admins may set permissions per users and forums.
	- NEW in version 1.3.0, ACP option added, admins may choose to not display Ratekit in Global, Announement, Sticky or Locked topics.


## Installation
Pre. If updating this extension, FIRST: Look for `5-Star Topic RateKit` under the Enabled Extensions list, and click its `Disable` link. Continue on.
(FYI: deleting data will do nothing for this extension, remember your saved data is in the /data/ folder!!)
1. Download the latest release.
2. Unzip the downloaded release locally on your desktop.
3. Copy the `thetopfew` folder to `phpBB/ext/` (if done correctly, you'll have the main extension class at (your forum root)/ext/thetopfew/ratekit/composer.json).
4. Navigate in the ACP to `Customise tab -> Manage Extensions`.
5. Look for `5-Star Topic RateKit` under the Disabled Extensions list, and click its `Enable` link.
6. Navigate in the ACP to 'Extensions tab -> RateKit 'Settings', to disable star ratings per each forum.
7. Customize your star's title, size and/or color by simply editing the extensions/language/en/common.php file (instructions inside).


## Uninstall
1. Navigate in the ACP to `Customise tab -> Manage Extensions`.
2. Look for `5-Star Topic RateKit` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/thetopfew/ratekit` folder.


#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!##!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!##!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#!#

## Acknowledgements
The RateKit front end includes parts of Kartik Visweswaran's splendid [Bootstrap Star Rating](http://plugins.krajee.com/star-rating) jQuery plugin. Thank you Kartik!

## Enjoy RateKit?
Please consider a small donation to help me maintain RateKit and create other useful stuff.

[![Paypal](/styles/all/theme/img/paypal.png)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5UB6RWJJHYPLS)
