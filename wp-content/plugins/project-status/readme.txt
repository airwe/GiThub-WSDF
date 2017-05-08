=== Plugin Name ===
Contributors: 3pointross
Tags: project management, pm, basecamp, pms, projects, project, management, tracking, client
Requires at least: 3.3
Tested up to: 3.8.1
Stable tag: 1

The original Project Status. Replaced by Project Panorama Lite Plugin. A responsive visual project tracker which shows percentage of completion, major milestones, current tasks and holds and project dates.

== Description ==

Project Status is a simply way to keep clients informed. Most project management systems are created for internal use and communication. When it comes to giving your client a high level picture of progress most systems are overkill. 

Clients don't want to be bogged down by to-do lists, milestones and calendars. They want to know how far a project is from completion and what they are responsible for.

This plugin is a simply way to give clients that information while providing you with a high level overview of open projects and their standpoint. The plugin gives you the ability to: 

* Create and manage unlimited projects
* Track levels of completion
* Track current tasks
* Identify client responsibilities and project holds
* Identify four major milestones (20%/40%/60%/80%)
* Send clients to a page containing the above information

Projects are displayed in a responsive template so clients can access and monitor their project from any device.   

Read more about the plugin at [the Project Panorama Website](http://projectpanorama.com "the Project Panorama Website").

*Changelog*

1.6 Improved shortcode output (now outputs where shortcode is placed). Fixed styling issues. 
1.5.1 Fixed shortcode progress bar
1.5 Added a widget thanks to [Marcin Trycz](http://trycz.com) and incorporated [Enrico Battocchi's Duplicate Post](http://wordpress.org/extend/plugins/duplicate-post/)
1.4.1 + 1.4.1.2 Fixed some broken images (Argh SVN)
1.4 Added slider as the progress bar
1.3 Added short code for displaying project status with in pages, fixed some bugs with rendering if your WordPress install is not at the root directory
1.2 Added short code for front end viewing (thanks Sean). Added comments support (thanks Ricky).
1.1 Fixed wrong description under the 75% completed title. 
	Fixes autosaving clearing descriptions by accident.

*Planned Changes*

The idea of this plugin has been rolled into Project Panorama, which is a more expansive, updated and full featured plugin. 

I have received a lot of requests for feature additions. Some of them are good ideas but beyond what I ever intend this plugin to do, others are great suggestions. The progress of this plugin is greatly hindered by my lack of time (I teach at two colleges and run an agency.) If anyone is up for helping evolve this plugin please contact me. In the meantime, I do plan on adding the following:

1. Ability to e-mail clients the status of their project. - I have been working on this and for something so simple it's really not going well. Anyone want to help?
2. Ability to add attachments.

== Installation ==

Installation is simple.

1. Upload to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. A "My Projects" tab will be added to the WordPress menu
4. Create a new project, filling out all important information
5. Fill in the project title, enter in a description, pick starting / ending dates and outline the project milestones
6. View the project to get the URL and send it to your client
7. If you want to display your projects on a page, you can use the short code [project_list]
8. If you want to display a specific project on a page you can use the short code [project id=X] where X is the ID of the project / post. This is displayed on your individual projects for copying / pasting. 

== Screenshots ==

1. Create projects and customize the milestones, description, tasks and holds
2. Each project has their own responsive page, giving clients a project overview
3. Pages are responsive so clients can access their project status from mobile or desktop devices
4. Browsing through the "My Projects" section gives you a high level overview of open projects and their progress

== F.A.Q. ==

Q. My project information is not being saved.
A. This seems to be an issue with running an older version of WordPress. Please upgrade and try again.

Q. The rendering/display of project lists or specific projects looks off in my theme!
A. I did a fair amount of testing and tried to namespace the styling as best I could. Some themes will cause the projects to look better than others. You may have to do some CSS modification to improve the output.