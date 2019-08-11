HashOver 1.0.3rc4
========
**HashOver** is a PHP comment system intended as a replacement for services like Disqus. HashOver is free and open source software, under the [GNU Affero General Public License](http://www.gnu.org/licenses/agpl.html). HashOver adds a "comment section" to any website, by placing a few simple lines of JavaScript or PHP to the source code of any webpage. HashOver is a self-hosted system and allows completely anonymous comments to be posted, the only required information is the comment itself.

Notice
---
This is the current stable version of HashOver, it is not actively developed, instead work on the next version is done on the "hashover-next" repository. Code contributions ("Pull Requests") to/of this repository that add new functionality will be rejected. Please submit issues, clone and commit changes to the following repository instead: https://github.com/jacobwb/hashover-next

Notable Features
---
<table cellpadding="2" cellspacing="2" width="100%">
	<tbody>
		<tr>
			<td width="39%">
				<ul>
					<li>Restricted use of HTML tags</li>
					<li>Display externally hosted images</li>
					<li>Five comment sorting methods</li>
					<li>Multiple languages</li>
					<li>Spam filtering</li>
					<li>IP address blocking</li>
					<li>Notification emails</li>
				</ul>
			</td>
			<td width="33%">
				<ul>
					<li>Threaded replies</li>
					<li>Avatar icons</li>
					<li>Comment editing &amp; deletion</li>
					<li>Comment RSS feeds</li>
					<li>Likes</li>
					<li>Popular comments</li>
					<li>Comment layout templates</li>
				</ul>
			</td>
			<td valign="top" width="28%">
				<ul>
					<li>Administration</li>
					<li>Automatic URL links</li>
					<li>Customizable HTML</li>
					<li>Customizable CSS</li>
					<li>Referrer checking</li>
					<li>Permalinks</li>
				</ul>
			</td>
		</tr>
	</tbody>
</table>

Documentation
===

**Prerequisites**

There are two methods of using HashOver, both methods require doing the following first:

1. Download this file: https://github.com/jacobwb/hashover/archive/master.zip.
2. Extract the files under "hashover-master" at or upload them to your website's document root.
3. Give (chmod) all the files permissions "0644" (readable by all and writable by owner).
4. Give directories and PHP files permissions "0755" (readable by all, writable by owner, executable by all).
5. Give "hashover/pages" directory permission "0777" (readable, writable and executable by all).

> It is not recommended that permissions "0777" ever be used. For security reasons, the "hashover/pages" directory should be "given" (chown) to the user that the server is configured to execute PHP scripts as, for example "www-data". And then simply give the "hashover/pages" directory permissions "0755".**

**Required Setup**

**The following actions are required before using HashOver.**

Edit the file `hashover/scripts/secrets.php` and make the following changes.
Set a UNIQUE 8 to 32 character value for the `$encryption_key` variable.
Set the `$notification_email` variable to any valid e-mail address.
Set a UNIQUE value for the `$admin_nickname` variable.
Set a UNIQUE value for the `$admin_password` variable.

**Using HashOver**

Once the files have successfully been downloaded, extracted, proper permissions set, and setup, all you need to do is copy the code to one of the two following implementation methods and paste it into your webpage(s):

**JavaScript method (recommended)**

```
<div id="hashover"></div>
<script type="text/javascript" src="/hashover/comments.php"></script>
<noscript>You must have JavaScript enabled to use the comments.</noscript>
```

**PHP method**

```
<?php $mode = 'php'; include('hashover/comments.php'); ?> 
```

**Optional**

The following JavaScript tag may be used with any or all of the following variables to disable specific input fields, by placing it before the `<script>` tag mentioned above:

```
<script type="text/javascript">
        var rows="4";        // Sets "Comments" field height
        var name_on="no";    // Disables "Name" field
        var passwd_on="no";  // Disables "Password" field
        var email_on="no";   // Disables "E-mail" field
        var sites_on="no";   // Disables "Website" field
</script>
```

In the file `hashover/scripts/php-mode.php` a list of variables nearly identical to the ones mentioned above will be found that allow specific input fields to be disabled.

You may set the "count_link" query to display only a comment count linking to a specified page's comments. For example the following code will display "9 Comments (11 counting replies)".

```
<script src="/hashover/comments.php?count_link=http://tildehash.com/%3Farticle=firefoxs-inspector-tool-as-3d-modeler-seriously"></script>
```

Identify an HTML element as "cmtcount" `<span id="cmtcount"></span>` for example, and that element will display a comment count. This is useful in creating comment "widgets" / "buttons" that display the comment count and link to the comment section. The following code displays a link similar to the previous code:

```
<a href="#comments"><span id="cmtcount"></span> Comments</a>
```

You may defer loading the comment's JavaScript with this code:

```
<div id="hashover"></div>
<script type="text/javascript" src="/hashover/comments.php" defer="defer"></script>
```

Or load the comment's JavaScript asynchronously:

```
<div id="hashover"></div>
<script type="text/javascript">(function() { var s = document.createElement('script'), t = document.getElementsByTagName('script')[0]; s.type = 'text/javascript'; s.async = true; s.src = "/hashover/comments.php"; t.parentNode.insertBefore(s, t); })();</script>
```

**Optional Settings**

In the file `hashover/scripts/settings.php` settings for things such as language, default name, HTML design template, avatar icons, "Popular Comments", spam checking, default timezone, and more may be adjusted. 

**Styling the Comments**

To change how the comments look, use a [Cascading Style Sheet](http://en.wikipedia.org/wiki/Cascading_Style_Sheets)
(CSS.) HashOver comes with a default style sheet named "comments.css" under the "hashover" directory.

Using the JavaScript method this style sheet is automatically placed in the page when the comments are displayed. This is not true for the PHP method. However, in both methods it is recommended that the following `<link>` element be placed in the `<head>` element of your website's webpage(s):

```
<link href="/hashover/comments.css" rel="stylesheet" type="text/css">
```

Alternatively, the following may be placed at the top of an existing style sheet:

```
@import url('/hashover/comments.css');
```

**Need more control over how the comments look?**

Editing the file `hashover/html-templates/default.html` allows you to move around the HTML elements of each comment, meaning you may change where each commenter's avatar icon and name appears, as well as where the date/permalinks, "Reply", "Edit", "Like" and "Top of Thread" links appear.

However, rather than editing the `hashover/html-templates/default.html` file, it is recommended you edit a copy of that file, and then merely change the `$template` variable in the `hashover/scripts/settings.php` file. This way your changes won't be lost when you upgrade HashOver, and you will have a working fallback just in case.

**HTML in comments**

Users may post comments with a limited number of allowed HTML tags. These tags include `<b>`, `<u>`, `<i>`, `<s>`, `<pre>`, `<code>`, `<ul>`, `<ol>`, `<li>`, and `<blockquote>`. A user may also include an image in their posts using `[img]http://example.com/image.jpg[/img]`.

The hyperlink tag `<a>` is not allowed in comments, instead users can post URLs as-is and they will become links. This is done to help protect users against scams and SPAM, since links can't say something different than where they actually link to, thereby preventing phishing, for example.

**Use a canonical URL**

A canonical URL uses the [canonical link element](http://en.wikipedia.org/wiki/Canonical_link_element) in the `<head>` section of a webpage to prevent the creation of multiple separate comment directories for multiple page URLs that present the same content. For example, `http://example.com/page.html` and `http://example.com/page.html?parameter=1` will have separate comment threads because the URLs are different, even if both URLs return the same content.

The following JavaScript will automatically use the URL in the canonical link element:

```
<script>var canon_url = (document.querySelector('link[rel="canonical"]') != null) ? '?canon_url=' + encodeURIComponent(document.querySelector('link[rel="canonical"]').getAttribute('href')) : ''; document.write('<script src="/hashover/comments.php' + canon_url + '"><\/script>');</script>
```

In PHP adding a `$canon_url` variable before the include function will trigger the canonical URL behavior:

```
<?php
        $mode = 'php';
        $canon_url = 'http://example.com/page.html';
        include('hashover/comments.php');
?>
```

**Need more control than a canonical URL offers?**

If you need more fine tuned control over URL parsing, particularly what URL queries should be ignored, add unwanted URL queries, one per line, to a file named "ignore_queries.txt" under the "hashover" directory.

Adding a query name without a value will remove the query from comment directory names no matter what its value is. Adding a query name with a value (name=value) will only remove that specific query with that specific value from comment directory names. For example, add "lang" to the "ignore_queries.txt" file and the URLs `http://example.com/page.html?lang=en` and `http://example.com/page.html?lang=jp` will be treated as being the same page and thus display the same comment thread.

**Need to block an IP address?**

If the `$ip_addrs` variable in the `hashover/scripts/settings.php` file is set to "yes", user IP addresses will be stored in their respective comment file(s). Those IP addresses can be used to block spamming, abusive, and/or obstructive users from posting and interacting with the comments all together. Simply add them, one per line, to a file named "blocklist.txt" in the "hashover" directory.

In addition to that, if the variable `$spam_IP_check` is set to 'php', 'javascript', or 'both' HashOver will check whether or not a visitor's IP address is in the database of spam server IP addresses maintained at [stopforumspam.com](http://stopforumspam.com/). If a visitor's IP address is in the database the visitor is most likely a spam server, and the script will exit with a message saying "<b>HashOver:</b> You are blocked!" while disallowing the visitor any interaction with the comments, and thus successfully preventing spam.

The value of `$spam_IP_check` determines in which mode(s) visitor IP address spam checking will be enabled. Generally, JavaScript mode is somewhat naturally protected against some forms of spam attacks, such as basic automated form filing, while PHP mode is not. If one is using PHP mode, they should also set `$spam_IP_check` to "php". Likewise, when using JavaScript mode `$spam_IP_check` should be set to "javascript", however, this isn't necessary if spam isn't an issue in JavaScript mode. Setting `$spam_IP_check` to "both" will enable spam checking in both modes, for those who make use of both modes.

**Tutorials**

[Implementing the HashOver open source commenting system within Pelican](http://moparx.com/2014/03/implementing-the-hashover-open-source-commenting-system-within-pelican/)
