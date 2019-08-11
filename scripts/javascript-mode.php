<?php

	// Copyright (C) 2014-2019 Jacob Barkdull
	//
	//	This program is free software: you can redistribute it and/or modify
	//	it under the terms of the GNU Affero General Public License as
	//	published by the Free Software Foundation, either version 3 of the
	//	License, or (at your option) any later version.
	//
	//	This program is distributed in the hope that it will be useful,
	//	but WITHOUT ANY WARRANTY; without even the implied warranty of
	//	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	//	GNU Affero General Public License for more details.
	//
	//	You should have received a copy of the GNU Affero General Public License
	//	along with this program.  If not, see <http://www.gnu.org/licenses/>.


	// Tell browser output is JavaScript
	header ('Content-Type: application/javascript');

	// Disable browser cache
	header ('Expires: Wed, 08 May 1991 12:00:00 GMT');
	header ('Last-Modified: ' . gmdate ('D, d M Y H:i:s') . ' GMT');
	header ('Cache-Control: no-store, no-cache, must-revalidate');
	header ('Cache-Control: post-check=0, pre-check=0', false);
	header ('Pragma: no-cache');

?>
// @licstart  The following is the entire license notice for the
//  JavaScript code in this page.
//
// Copyright (C) 2014-2017 Jacob Barkdull
//
//	This program is free software: you can redistribute it and/or modify
//	it under the terms of the GNU Affero General Public License as
//	published by the Free Software Foundation, either version 3 of the
//	License, or (at your option) any later version.
//
//	This program is distributed in the hope that it will be useful,
//	but WITHOUT ANY WARRANTY; without even the implied warranty of
//	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//	GNU Affero General Public License for more details.
//
//	You should have received a copy of the GNU Affero General Public License
//	along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
// @licend  The above is the entire license notice for the
//  JavaScript code in this page.
//
//--------------------
//
// Source Code and Installation Instructions:
//	http://<?php echo $domain . $_SERVER['PHP_SELF'] . "?source\n"; ?>


// Default form settings
if (rows	== undefined) { var rows	=  '<?php echo $rows; ?>'; }
if (name_on	== undefined) { var name_on	=  'yes'; }
if (email_on	== undefined) { var email_on	=  'yes'; }
if (sites_on	== undefined) { var sites_on	=  'yes'; }
if (passwd_on	== undefined) { var passwd_on	=  'yes'; }

// Add comment stylesheet to page header
var head = document.getElementsByTagName('head')[0];
var links = document.getElementsByTagName('link');

if (document.querySelector('link[href="<?php echo $root_dir; ?>comments.css"]') == null) {
	link = document.createElement('link');
	link.rel = 'stylesheet';
	link.href = '<?php echo $root_dir; ?>comments.css';
	link.type = 'text/css';
	head.appendChild(link);
}

// Add comment RSS feed to page header
link = document.createElement('link');
link.rel = 'alternate';
link.href = '<?php echo $root_dir; ?>comments.php?rss=' + location.href.replace(/#.*$/g, '') + "&title=<?php echo (isset($_GET['pagetitle'])) ? $_GET['pagetitle'] . '"' : '" + document.title'; ?>;
link.type = 'application/rss+xml';
link.title = 'Comments';
head.appendChild(link);

// Put number of comments into "cmtcount" identified HTML element
if (document.getElementById('cmtcount') != null) {
	if (<?php echo $total_count - 1; ?> != 0) {
		document.getElementById('cmtcount').innerHTML = '<?php echo $total_count - 1; ?>';
	}
}

// Displays reply form
function reply(r, f) {
	var form_html = '\n<span class="optionbuttons" style="float: right;">\n';

	if (name_on == 'yes' || email_on == 'yes' || passwd_on == 'yes' || sites_on == 'yes') {
		form_html += '<?php echo (isset($_COOKIE['name']) and !empty($_COOKIE['name'])) ? '<input type="button" value="&#x25BC; ' . $text['options'] . '" onClick="options(' . "\''+r+'\'" . '); this.value = (this.value == \\\'&#x25BC; ' . $text['options'] . '\\\') ? \\\'&#x25B2; ' . $text['options'] . '\\\' : \\\'&#x25BC; ' . $text['options'] . '\\\'; return false;">' : ''; ?>\n';
	}

	form_html += '<input type="button" value="<?php echo $text['cancel']; ?>" onClick="cancelform(\''+r+'\'); return false;">\n\
	</span>\n\
	<b class="cmtfont"><?php echo $text['reply_to_cmt']; ?></b>\n\
	<span<?php echo (isset($_COOKIE['name']) and !empty($_COOKIE['name'])) ? ' style="max-height: 0px;"' : ''; ?> class="options" id="options-'+r+'"><hr style="clear: both;">\n\
	<table width="100%" cellpadding="0" cellspacing="0" align="center">\n\
	<tbody>\n<tr>\n';

<?php if ($icons == 'yes') { ?>
	if (name_on == 'yes') {
		form_html += '<td width="1%" rowspan="2">\n<?php echo $avatar_image; ?>\n</td>\n';
	}
<?php }?>

	if (name_on == 'yes') {
		form_html += '<td align="right">\n<input type="text" name="name" title="<?php echo $text['nickname_tip']; ?>" value="<?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : ''; ?>" maxlength="30" class="opt-name" placeholder="<?php echo $text['nickname']; ?>">\n</td>\n';
	}

	if (passwd_on == 'yes') {
		form_html += '<td align="right">\n<input type="password" name="password" title="<?php echo $text['password_tip']; ?>" class="opt-password" placeholder="<?php echo $text['password']; ?>">\n</td>\n';
	}
	<?php if ($is_mobile == 'yes') echo 'form_html += \'</tr>\n<tr>\n\';'; ?>

	if (email_on == 'yes') {
		form_html += '<td align="right">\n<input type="text" name="email" title="<?php echo $text['email']; ?>" value="<?php echo (isset($_COOKIE['email'])) ? $_COOKIE['email'] : ''; ?>" class="opt-email" placeholder="<?php echo $text['email']; ?>">\n</td>\n';
	}

	if (sites_on == 'yes') {
		form_html += '<td align="right">\n<input type="text" name="website" title="<?php echo $text['website']; ?>" value="<?php echo (isset($_COOKIE['website'])) ? $_COOKIE['website'] : ''; ?>" class="opt-website" placeholder="<?php echo $text['website']; ?>">\n</td>\n';
	}

	form_html += '</tr>\n\
	</tbody>\n</table>\n</span>\n\
	<center>\n\
	<textarea rows="6" cols="62" name="comment" placeholder="<?php echo $text['reply_form']; ?>" style="width: 100%;" title="<?php echo $text['cmt_tip']; ?>"></textarea><br>\n\
	<input class="post_cmt" type="submit" value="<?php echo $text['post_reply']; ?>" style="width: 100%;" onClick="return noemailreply(\''+r+'\');" onsubmit="return noemailreply(\''+r+'\');">\n\<?php
	echo (isset($_GET['canon_url']) or isset($canon_url)) ? "\n\t" . '<input type="hidden" name="canon_url" value="' . $page_url . '">\n\\' . PHP_EOL : PHP_EOL; ?>
	<input type="hidden" name="cmtfile" value="' + f + '">\n\
	<input type="hidden" name="reply_to" value="'+f+'">\n\
	</center>\n';

	document.getElementById('cmtopts-' + r).style.display = 'none';
	document.getElementById('cmtforms-' + r).innerHTML = form_html;
	document.getElementById('reply_form-' + r).comment.focus ();
	return false;
}

// Displays edit form
function editcmt(e, f, s) {
	var cmtdata = document.getElementById('cmtdata-' + e).innerHTML.replace(/<br>/gi, '\n').replace(/<\/?a(\s+.*?>|>)/gi, '').replace(/<img.*?title="(.*?)".*?>/gi, '[img]$1[/img]').replace(/^\s+|\s+$/g, '').replace('<code style="white-space: pre;">', '<code>');
	var website = (document.getElementById('opt-website-' + e) != undefined) ? document.getElementById('opt-website-' + e).href : '';
	document.getElementById('cmtopts-' + e).style.display = 'none';

	document.getElementById('cmtforms-' + e).innerHTML = '\n<span class="optionbuttons" style="float: right;">\n\
	<input type="submit" name="edit" value="." style="display: none;">\
	<input type="submit" name="delete" class="delete" value="<?php echo $text['delete']; ?>" onClick="return delwarn();">\n\
	<label for="notify" title="<?php echo $text['subscribe_tip']; ?>">\n\
	<input type="checkbox"' + ((s != '0') ? ' checked="true"' : '') + ' id="notify" name="notify"> <?php echo $text['subscribe']; ?>\n\
	</label>\n\
	<input type="button" value="<?php echo $text['cancel']; ?>" onClick="cancelform(\''+e+'\'); return false;">\n\
	</span>\n\
	<b class="cmtfont"><?php echo $text['edit_cmt']; ?></b>\n\
	<span class="options"><hr style="clear: both;">\n\
	<table width="100%" cellpadding="0" cellspacing="0" align="center">\n\
	<tbody>\n<tr>\n\
<?php if ($icons == 'yes') { ?>
	<td width="1%" rowspan="2">\n\
	<?php echo $avatar_image; ?>\n\
	</td>\n\
<?php } ?>
	<td align="right">\n\
	<input type="text" name="name" title="<?php echo $text['nickname_tip']; ?>" value="' + document.getElementById('opt-name-' + e).innerHTML.replace(/<.*?>(.*?)<.*?>/gi, '$1') + '" maxlength="30" class="opt-name" placeholder="<?php echo $text['nickname']; ?>">\n\
	</td>\n\
	<td align="right">\n\
	<input type="password" name="password" title="<?php echo $text['password_tip']; ?>" class="opt-password" placeholder="<?php echo $text['password']; ?>">\n\
	</td>\n\
<?php if ($is_mobile == 'yes') echo "\t" . '</tr>\n<tr>\n\\'; ?>
	<td align="right">\n\
	<input type="text" name="email" title="<?php echo $text['email']; ?>" value="<?php echo (isset($_COOKIE['email'])) ? $_COOKIE['email'] : ''; ?>" class="opt-email" placeholder="<?php echo $text['email']; ?>">\n\
	</td>\n\
	<td align="right">\n\
	<input type="text" name="website" title="<?php echo $text['website']; ?>" value="' + website + '" class="opt-website" placeholder="<?php echo $text['website']; ?>">\n\
	</td>\n\
	</tr>\n\
	</tbody>\n</table>\n</span>\n\
	<center>\n\
	<textarea rows="10" cols="62" name="comment" style="width: 100%;" title="<?php echo $text['cmt_tip']; ?>">' + cmtdata + '</textarea><br>\n\
	<input class="post_cmt" type="submit" name="edit" value="<?php echo $text['save_edit']; ?>" style="width: 100%;">\n\
	<input type="hidden" name="cmtfile" value="' + f + '">\n\<?php
	echo (isset($_GET['canon_url']) or isset($canon_url)) ? "\n\t" . '<input type="hidden" name="canon_url" value="' . $page_url . '">\n\\' . PHP_EOL : PHP_EOL; ?>
	</center>\n';

	document.getElementById('reply_form-' + e).comment.focus ();
	return false
}

// Function to cancel reply and edit forms
function cancelform(f) {
	document.getElementById('cmtopts-' + f).style.display = '';
	document.getElementById('cmtforms-' + f).innerHTML = '';
	return false;
}

// Function to like a comment
function like(c, f) {
	// Load "like.php"
	var like = new XMLHttpRequest();
	like.open('GET', '<?php echo $root_dir . 'scripts/like.php?like=' . $ref_path; ?>/' + f);
	like.send();

	// Get number of likes
	if (document.getElementById('likes-' + c).innerHTML != '') {
		var likes = parseInt(document.getElementById('likes-' + c).innerHTML.replace(/[^0-9]/g, ''));
	} else {
		var likes = parseInt(0);
	}

	// Change "Like" button title and class; Increase likes
	if (document.getElementById('like-' + c).className == 'like') {
		document.getElementById('like-' + c).className = 'liked';
		document.getElementById('like-' + c).title = '<?php echo addcslashes($text['liked_cmt'], "'"); ?>';
		likes++;
	} else {
		document.getElementById('like-' + c).className = 'like';
		document.getElementById('like-' + c).title = '<?php echo addcslashes($text['like_cmt'], "'"); ?>';
		likes--;
	}

	// Change number of likes
	var like_count = (likes != 1) ? likes + ' Likes' : likes + ' Like';
	document.getElementById('likes-' + c).innerHTML = (likes > 0) ? '<b>' + like_count + '</b>' : '';
}

// Displays options
function options(r) {
	if (name_on == 'yes' || email_on == 'yes' || passwd_on == 'yes' || sites_on == 'yes') {
		if (document.getElementById('options-' + r).style.maxHeight != '200px') {
			document.getElementById('options-' + r).style.maxHeight = '200px';
		} else {
			document.getElementById('options-' + r).style.maxHeight = '0px';
		}
	}

	return false;
}

// Displays a "blank email address" warning
function noemail() {
	if (email_on == 'yes' && (document.comment_form.email.value == '')) {
		var answer = confirm('<?php echo $text['no_email_warn']; ?>');

		if (answer == false) {
			document.comment_form.email.focus();
			return false;
		}
	}
}

// Displays a "blank email address" warning when replying
function noemailreply(f) {
	if (email_on == 'yes' && (document.getElementById('reply_form-' + f).email.value == '')) {
		var answer = confirm('<?php echo $text['no_email_warn']; ?>');

		if (answer == false) {
			document.getElementById('options-' + f).style.display = '';
			document.getElementById('reply_form-' + f).email.focus();
			return false;
		}
	}
}

// Displays confirmation dialog for deletion
function delwarn() {
	var answer = confirm('<?php echo $text['delete_cmt']; ?>');

	if (answer == false) {
		return false;
	}
}

// Get page title
if (document.title != '') {
	var pagetitle = ' on "'+document.title+'"';
} else {
	var pagetitle = '';
}

var show_cmt = '';

function parse_template(object, sort, method) {
	var indent = (sort == false || method == 'ascending') ? object['indent'] : '16px 0px 12px 0px';

	if (!object['deletion_notice']) {
		var 
			root_dir = '<?php echo addcslashes($root_dir, "'"); ?>',
			permalink = object['permalink'],
			cmtclass = (sort == false || method == 'ascending') ? object['cmtclass'] : 'cmtdiv',
			avatar = object['avatar'],
			name = object['name'],
			thread = (object['thread']) ? object['thread'] : '',
			date = object['date'],
			likes = (object['likes']) ? object['likes'] : '',
			like_link = (object['like_link']) ? object['like_link'] : '',
			edit_link = (object['edit_link']) ? object['edit_link'] : '',
			reply_link = object['reply_link'],
			comment = object['comment'],
			form = '',
			cmtopts_style = ''
		;

<?php
		// Load HTML template
		$html_template = file_get_contents('html-templates/' . $template . '.html');

		// Convert HTML template line endings to system style
		$newline_search = array("\r\n", "\r", "\n");
		$newline_replace = array("\n", "\n", PHP_EOL);
		$html_template = str_replace($newline_search, $newline_replace, $html_template);

		// Break HTML template into individual lines
		$template_lines = explode(PHP_EOL, $html_template);

		// Echo each line as JavaScript variable addition
		for ($line = 0, $line_length = count($template_lines); $line < $line_length; $line++) {
			echo "\t\t" . 'show_cmt += \'' . $template_lines[$line] . '\n\';' . PHP_EOL;
		}
?>
	} else {
		show_cmt += '<a name="' + object['permalink'] + '"></a>\n';
		show_cmt += '<div style="margin: ' + indent + '; clear: both;" class="' + object['cmtclass'] + '">\n';
		show_cmt += object['deletion_notice'] + '\n';
		show_cmt += '</div>\n';
	}
}

function sort_comments(method) {
	var methods = {
		ascending: function() {
			for (var comment in comments) {
				parse_template(comments[comment], true, method);
			}
		},

		descending: function() {
			for (var comment = (comments.length - 1); comment >= 0; comment--) {
				parse_template(comments[comment], true, method);
			}
		},

		byname: function() {
			var tmpSortArray = comments.slice(0).sort(function(a, b) {
				if(a.sort_name < b.sort_name) return -1;
				if(a.sort_name > b.sort_name) return 1;
			})

			for (var comment in tmpSortArray) {
				parse_template(tmpSortArray[comment], true, method);
			}
		},

		bydate: function() {
			var tmpSortArray = comments.slice(0).sort(function(a, b) {
				return b.sort_date - a.sort_date;
			})

			for (var comment in tmpSortArray) {
				parse_template(tmpSortArray[comment], true, method);
			}
		},

		bylikes: function() {
			var tmpSortArray = comments.slice(0).sort(function(a, b) {
				return b.sort_likes - a.sort_likes;
			})

			for (var comment in tmpSortArray) {
				parse_template(tmpSortArray[comment], true, method);
			}
		}
	}

	show_cmt = '';
	document.getElementById('sort_div').innerHTML = 'Loading...' + '\n';
	methods[method]();
	document.getElementById('sort_div').innerHTML = show_cmt + '\n';
}
<?php

	if ($page_title == 'yes') {
		$js_title = "'+pagetitle+'";
		$js_title = (isset($_GET['pagetitle'])) ? ' on "' . $_GET['pagetitle'] . '"' : $js_title;
	} else {
		$js_title = '';
	}

	echo '// Place "hashover" DIV' . PHP_EOL;
	echo 'if (document.getElementById("hashover") == null) {' . PHP_EOL;
	echo "\t" . 'document.write("<div id=\"hashover\"></div>\n");' . PHP_EOL;
	echo '}' . PHP_EOL . PHP_EOL;

	echo jsAddSlashes('<a name="comments"></a><br><b class="cmtfont">' . $text['post_cmt'] . $js_title . ':</b>');

	if (isset($_COOKIE['message']) and !empty($_COOKIE['message'])) {
		echo jsAddSlashes('<b id="message" class="cmtfont">' . $_COOKIE['message'] . '</b><br><br>\n');
	} else {
		echo jsAddSlashes('<br><br>\n');
	}

	echo jsAddSlashes('<form id="comment_form" name="comment_form" action="' . $root_dir . 'comments.php" method="post">\n');

	if ($icons == 'yes') {
		echo jsAddSlashes('<span class="cmtnumber">' . $avatar_image . '</span>\n');
	} else {
		echo jsAddSlashes('<span class="cmtnumber"><a rel="nofollow" href="#comments">#' . $total_count . '</a></span>\n');
	}

	echo jsAddSlashes('<div class="cmtbox" align="center">\n');
	echo jsAddSlashes('<table width="100%" cellpadding="0" cellspacing="0">\n<tbody>\n<tr>\n'), PHP_EOL;

	// Display name input tag if told to
	echo "if (name_on == 'yes') {\n";
	echo "\t" . jsAddSlashes('<td align="right">\n');
	echo "\t" . jsAddSlashes('<input type="text" name="name" title="' . $text['nickname_tip'] . '"' . (isset($_COOKIE['name']) ? ' value="' . $_COOKIE['name'] . '"' : '') . ' maxlength="30" class="opt-name" placeholder="' . $text['nickname'] . '">\n');
	echo "\t" . jsAddSlashes('</td>\n');
	echo "}\n\n";

	// Display password input tag if told to
	echo "if (passwd_on == 'yes') {\n";
	echo "\t" . jsAddSlashes('<td align="right">\n');
	echo "\t" . jsAddSlashes('<input type="password" name="password" title="' . $text['password_tip'] . '"' . (isset($_COOKIE['password']) ? ' value="' . $_COOKIE['password'] . '"' : '') . ' class="opt-password" placeholder="' . $text['password'] . '">\n');
	echo "\t" . jsAddSlashes('</td>\n');
	echo "}\n\n";

	// Add second table row on mobile devices
	if ($is_mobile == 'yes') {
		echo "if (name_on == 'yes' && passwd_on == 'yes') {\n";
		echo "\t" . jsAddSlashes('<td width="1%" align="right">\n');
		echo "\t" . jsAddSlashes('<input name="login" title="Login (optional)" class="opt-login" type="submit" value="">\n');
		echo "\t" . jsAddSlashes('</td>\n');
		echo "}\n\n";
		echo jsAddSlashes('</tr>\n<tr>\n');
	}

	// Display email input tag if told to
	echo "if (email_on == 'yes') {\n";
	echo "\t" . jsAddSlashes('<td align="right">\n');
	echo "\t" . jsAddSlashes('<input type="text" name="email" title="' . $text['email'] . '"' . (isset($_COOKIE['email']) ? ' value="' . $_COOKIE['email'] . '"' : '') . ' class="opt-email" placeholder="' . $text['email'] . '">\n');
	echo "\t" . jsAddSlashes('</td>\n');
	echo "}\n\n";

	// Display website input tag if told to
	echo "if (sites_on == 'yes') {\n";
	echo "\t" . jsAddSlashes('<td' . (($is_mobile == 'yes') ? ' colspan="2"' : '') . ' align="right">\n');
	echo "\t" . jsAddSlashes('<input type="text" name="website" title="' . $text['website'] . '"' . (isset($_COOKIE['website']) ? ' value="' . $_COOKIE['website'] . '"' : '') . ' class="opt-website" placeholder="' . $text['website'] . '">\n');
	echo "\t" . jsAddSlashes('</td>\n');
	echo "}\n\n";

	if ($is_mobile != 'yes') {
		echo "if (name_on == 'yes' && passwd_on == 'yes') {\n";
		echo "\t" . jsAddSlashes('<td width="1%" align="right">\n');
		echo "\t" . jsAddSlashes('<input name="login" title="Login (optional)" class="opt-login" type="submit" value="">\n');
		echo "\t" . jsAddSlashes('</td>\n');
		echo "}\n\n";
	}
	echo jsAddSlashes('</tr>\n</tbody>\n</table>\n') . PHP_EOL;

	echo jsAddSlashes('<div id="requiredFields" style="display: none;">\n');
	echo jsAddSlashes('<input type="text" name="summary" value="" placeholder="Summary">\n');
	echo jsAddSlashes('<input type="hidden" name="middlename" value="" placeholder="Middle Name">\n');
	echo jsAddSlashes('<input type="text" name="lastname" value="" placeholder="Last Name">\n');
	echo jsAddSlashes('<input type="text" name="address" value="" placeholder="Address">\n');
	echo jsAddSlashes('<input type="hidden" name="zip" value="" placeholder="Last Name">\n');
	echo jsAddSlashes('</div>\n') . PHP_EOL;

	$rows = "'+rows+'";
	$replyborder = (isset($_COOKIE['success']) and $_COOKIE['success'] == "no") ? ' border: 2px solid #FF0000 !important; -moz-border-radius: 5px 5px 0px 0px; border-radius: 5px 5px 0px 0px;' : '';

	echo jsAddSlashes('<textarea rows="' . $rows . '" cols="63" name="comment" placeholder="' . $text['comment_form'] . '" style="width: 100%;' . $replyborder . '" title="' . $text['cmt_tip'] . '"></textarea><br>\n');
	echo jsAddSlashes('<input class="post_cmt" type="submit" value="' . $text['post_button'] . '" style="width: 100%;" onClick="return noemail();" onsubmit="return noemail();"><br>\n');
	echo (isset($_GET['canon_url']) or isset($canon_url)) ? jsAddSlashes('<input type="hidden" name="canon_url" value="' . $page_url . '">\n') : '';
	echo (isset($_COOKIE['replied'])) ? jsAddSlashes('<input type="hidden" name="reply_to" value="' . $_COOKIE['replied'] . '">\n') : '';
	echo jsAddSlashes('</div>\n</form><br>\n'). PHP_EOL;

	// Display three most popular comments
	if (!empty($top_likes)) {
		echo jsAddSlashes('<br><b class="cmtfont">' . $text['popular_cmts'] . ' Comment' . ((count($top_likes) != '1') ? 's' : '') . ':</b>\n') . PHP_EOL;
		echo 'var popComments = [' . PHP_EOL;

		for ($p = 1; $p <= count($top_likes) and $p <= $top_cmts; $p++) {
			if (!empty($top_likes)) {
				echo parse_comments(array_shift($top_likes), '', 'no');
			}
		}

		echo '];' . PHP_EOL . PHP_EOL;
		echo 'for (var comment in popComments) {' . PHP_EOL;
		echo "\t" . 'parse_template(popComments[comment], false);' . PHP_EOL;
		echo '}' . PHP_EOL . PHP_EOL;
	}

	if (!empty($show_cmt)) {
		echo 'var comments = [' . PHP_EOL;
		echo $show_cmt;
		echo '];' . PHP_EOL . PHP_EOL;
	}

	// Display comment count
	echo jsAddSlashes('<br><b class="cmtfont">' . $text['showing_cmts'] . ' ' . (($cmt_count == "1") ? '0 Comments:' : display_count()) . '</b>\n') . PHP_EOL;

	// Display comments, if there are no comments display a note
	if (!empty($show_cmt)) {
		echo jsAddSlashes('<span style="float: right;">\n' . $text['sort'] . ': <select name="sort" size="1" onChange="sort_comments(this.value); return false;">\n');
		echo jsAddSlashes('<option value="ascending">' . $text['sort_ascend'] . '</option>\n');
		echo jsAddSlashes('<option value="descending">' . $text['sort_descend'] . '</option>\n');
		echo jsAddSlashes('<option value="byname">' . $text['sort_byname'] . '</option>\n');
		echo jsAddSlashes('<option value="bydate">' . $text['sort_bydate'] . '</option>\n');
		echo jsAddSlashes('<option value="bylikes">' . $text['sort_bylikes'] . '</option>\n');
		echo jsAddSlashes('</select>\n</span>\n') . PHP_EOL;

		echo jsAddSlashes('<div id="sort_div">\n'). PHP_EOL;
		echo 'for (var comment in comments) {' . PHP_EOL;
		echo "\t" . 'parse_template(comments[comment], false);' . PHP_EOL;
		echo '}' . PHP_EOL . PHP_EOL;
		echo jsAddSlashes('</div>\n') . PHP_EOL;
	} else {
		echo jsAddSlashes('<div style="margin: 16px 0px 12px 0px;" class="cmtdiv">\n');
		echo jsAddSlashes('<span class="cmtnumber"><img width="' . $icon_size . '" height="' . $icon_size . '" src="' . $root_dir . 'images/first-comment.png"></span>\n');
		echo jsAddSlashes('<div style="height: ' . $icon_size . 'px;" class="cmtbubble">\n');
		echo jsAddSlashes('<b class="cmtnote cmtfont" style="color: #000000;">Be the first to comment!</b>\n</div>');
	}

	echo jsAddSlashes('</div><br>\n') . PHP_EOL;
	echo jsAddSlashes('<center>\n');
	echo jsAddSlashes('HashOver Comments &middot;\n');
	if (!empty($show_cmt)) echo jsAddSlashes('<a rel="nofollow" href="http://' . $domain . $root_dir . 'comments.php?rss=' . $page_url . '" target="_blank">RSS Feed</a> &middot;\n');
	echo jsAddSlashes('<a rel="nofollow" href="http://' . $domain . $root_dir . 'hashover.zip" target="_blank">Source Code</a> &middot;\n');
	echo jsAddSlashes('<a rel="nofollow" href="http://' . $domain . $root_dir . 'comments.php" target="_blank">JavaScript</a> &middot;\n');
	echo jsAddSlashes('<a rel="nofollow" href="http://tildehash.com/hashover/changelog.txt" target="_blank">ChangeLog</a> &middot;\n');
	echo jsAddSlashes('<a rel="nofollow" href="http://tildehash.com/hashover/archives/" target="_blank">Archives</a><br>\n');
	echo jsAddSlashes('</center>\n');

	// Script execution ending time
	$exec_time = explode(' ', microtime());
	$exec_end = $exec_time[1] + $exec_time[0];
	$exec_time = ($exec_end - $exec_start);

	echo PHP_EOL . '// Place all content on page' . PHP_EOL;
	echo 'document.getElementById("hashover").innerHTML = show_cmt;' . PHP_EOL . PHP_EOL;
	echo '// Script Execution Time: ' . round($exec_time, 5) . ' Seconds';

?>
