=== Quick Code ===
Contributors: gwycon
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=4053495
Tags: code, test, quick, php, css, html, javascript
Requires at least: 2.6
Tested up to: 2.7.1
Stable tag: 1.0

Allows admin users to test code such as HTML, CSS, PHP, and MySQL, in the admin area. Output is displayed directly above the entered code.

== Description ==

A very useful utility that allows blog administrators to quickly test code fragments (HTML, CSS, PHP, MySQL). There has been many times that I needed to test bits of code to see exactly what the output would be. For instance, whilst developing a WordPress Plugin, you may need to know what a certain database call will return, or want to know the effect of using a PHP or WordPress function, constant, or object. Simply enter in the required code and the output is displayed!

Usually this meant I had to set-up test 'echo' statements and risk this being visible on the main site pages by visitors (which is undersirable on a live site). Now there is a way to quickly test code which is only displayed in the admin area of your blog.

This Plugin can also be used as a simple WYSIWYG HTML/CSS editor, the results of the code are displayed directly above the code input box.

But, that is not all! There are three external files that are automatically included when the Plugin page renders. Two of these are a JavaScript, and CSS file, which are included in the admin head section when the Plugin page loads. This enables you to set-up JavaScript functions, and Style sheets just as you would normally.

You can then copy and paste the code into your own external files (when developing your own Plugins, or creating web pages). The third file contains PHP code that is designed to store PHP functions. This is then automatically included directly before the main code file, so functions can be called directly from the main edit box.

See our <a href="http://wordpress.org/extend/plugins/profile/gwycon">other Plugins here</a>.

== Installation ==

Instructions for installing the Output Report Plugin.

1. Download and extract the Plugin zip file.
2. Upload the folder containing the Plugin files to your WordPress Plugins folder (usually '../wp-content/plugins/').
3. Activate the Plugin via the 'Plugins' menu in WordPress.
4. Once activated, go to the Plugin page under the 'Tools' menu.

== Screenshots ==

1. Top of Plugin page, showing code output.
2. Main edit box where code can be entered.
3. 'Include' files can be edited, such as JavaScript, CSS, and PHP.