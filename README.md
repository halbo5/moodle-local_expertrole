moodle-local_expertrole
============================

[![Build Status](https://travis-ci.org/halbo5/moodle-local_expertrole.svg?branch=master)](https://travis-ci.org/halbo5/moodle-local_expertrole)

Moodle plugin to manage two roles on courses creation (simple and expert role)


Requirements
------------

This plugin requires Moodle 3.3+ (not tested on older version)


Motivation for this plugin
--------------------------

This plugin is used in a global project to simplify moodle. Basicly, we have two types of users : teacher that have a very basic use of moodle and geeks that want to test most of moodle functionalities.

By default, when a user creates a course, he has the "editing teacher" role. This is the "complete" role. We created a second role and removed some capacities for this role to make use of moodle more simple (less activities available). This is the "simple" role. We affected this new role for the default role when creating a course. In his preferences, the user can choose if he wants this simple or the complete role. If yes, each time he creates a course, the simple role will be removed and the complete added to the user and he will have the complete functionnalities.

With this plugin, the user can choose if he wants a simple or a complete interface.


Installation
------------

Install the plugin like any other plugin to folder
/local/expertrole

See http://docs.moodle.org/en/Installing_plugins for details on installing Moodle plugins


Usage & Settings
----------------

### 1. Settings

After installing local_expertrole, the plugin does not do anything to Moodle yet.

To configure the plugin and its behaviour, please visit:
Site administration -> Users -> Expert Role.

There, you find only one section:

__Interface choice__

You have two settings : select a role for the simple interface and a role for the complete interface.

### 2. Strategy

Our strategy was to not modify the editing teacher role.  We created a "simple role". Then change the default role when a course is created and assign the "simple role". The plugin will add the editing teacher role and remove the simple role if the user chooses it.

### 3. User preference

In his preferences, the user has a new choice : complete interface. If he wants all the teacher's functionnalities, he has to select this setting.

This setting his only visible for users that have the course:create capacity in the system context.


How this plugin works
---------------------

This plugin listens to moodle's events : "role assigned" and "interface updated". It adds the "complete role" when a course is created or in all the user's courses when he changes the "interface" preference.


Plugin repositories
-------------------

This plugin has not yet been tested on production server. When it will be done, it will be published and regularly updated in the Moodle plugins repository.


The latest development version can be found on Github:
https://github.com/halbo5/moodle-local_expertrole


Bug and problem reports / Support requests
------------------------------------------

This plugin is carefully developed and thoroughly tested, but bugs and problems can always appear.

Please report bugs and problems on Github:
https://github.com/halbo5/moodle-local_expertrole/issues

We will do our best to solve your problems, but please note that due to limited resources we can't always provide per-case support.


Feature proposals
-----------------

Due to limited resources, the functionality of this plugin is primarily implemented for our own local needs and published as-is to the community. We are aware that members of the community will have other needs and would love to see them solved by this plugin.

Please issue feature proposals on Github:
https://github.com/halbo5/moodle-local_expertrole/issues

Please create pull requests on Github:
https://github.com/halbo5/moodle-local_expertrole/pulls

We are always interested to read about your feature proposals or even get a pull request from you, but please accept that we can handle your issues only as feature _proposals_ and not as feature _requests_.


Moodle release support
----------------------

Due to limited resources, this plugin is only maintained for the most recent major release of Moodle. However, previous versions of this plugin which work in legacy major releases of Moodle are still available as-is without any further updates in the Moodle Plugins repository.

There may be several weeks after a new major release of Moodle has been published until we can do a compatibility check and fix problems if necessary. If you encounter problems with a new major release of Moodle - or can confirm that this plugin still works with a new major relase - please let us know on Github.

If you are running a legacy version of Moodle, but want or need to run the latest version of this plugin, you can get the latest version of the plugin, remove the line starting with $plugin->requires from version.php and use this latest plugin version then on your legacy Moodle. However, please note that you will run this setup completely at your own risk. We can't support this approach in any way and there is a undeniable risk for erratic behavior.


Right-to-left support
---------------------

This plugin has not been tested with Moodle's support for right-to-left (RTL) languages.
If you want to use this plugin with a RTL language and it doesn't work as-is, you are free to send us a pull request on Github with modifications.


Copyright
---------

Alain Bolli

