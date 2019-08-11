<?php

	// Copyright (C) 2014-2019 Jacob Barkdull
	//
	//	I, Jacob Barkdull, hereby release this work into the public domain. 
	//	This applies worldwide. If this is not legally possible, I grant any 
	//	entity the right to use this work for any purpose, without any 
	//	conditions, unless such conditions are required by law.


	$top_likes	= array();	// For sorting top comments
	$subfile_count	= array();	// Individual comment thread count
	$cmt_count	= '1';		// Comment count excluding replies
	$total_count	= '1';		// Comment count including replies
	$deleted_cmt	= '0';		// Deleted comment count excluding replies
	$deleted_total	= '0';		// Deleted comment count including replies
	$show_cmt	= '';		// Will contain all comments
	$deleted_files	= array();	// Deleted files

	// Characters to be removed from name, email, and website fields
	$search = array('<', '>', "\n", "\r", "\t", '&nbsp;', '&lt;', '&gt;', '"', "'", '\\');
	$replace = array('', '', '', '', '', '', '', '', '&quot;', '&#39;', '');

?>
