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


	// Set Canonical URL
	if (!isset($canon_url) and isset($script_query)) {
		if (isset($_POST['canon_url']) and !empty($_POST['canon_url'])) {
			$canon_url = (preg_match('/([http|https]):\/\//i', $_POST['canon_url'])) ? $_POST['canon_url'] : 'http://' . $_POST['canon_url'];
		} else if (isset($_GET['canon_url']) and !empty($_GET['canon_url'])) {
			$canon_url = (preg_match('/([http|https]):\/\//i', $_GET['canon_url'])) ? $_GET['canon_url'] : 'http://' . $_GET['canon_url'];
		}
	}

	// Get full page URL or Canonical URL
	if ($mode == 'javascript') {
		if (isset($_SERVER['HTTP_REFERER']) and !isset($_GET['rss'])) {
			$url_parts = parse_url($_SERVER['HTTP_REFERER']);
			$url_host = '';

			// Construct host URL
			if (!empty($url_parts['host'])) {
				$url_host .= $url_parts['host'];

				// Add optional port to URL
				if (!empty($url_parts['port'])) {
					$url_host .= ':' . $url_parts['port'];
				}
			}

			// Check if the script was requested by this server
			if (!preg_match('/' . $domain . '/i', $url_host)) {
				exit(jsAddSlashes('<b>HashOver - Error:</b> External use not allowed.', 'single'));
			}

			$page_url = (empty($canon_url)) ? $_SERVER['HTTP_REFERER'] : $canon_url;
		} else {
			if (!isset($_GET['rss'])) {
				exit(jsAddSlashes('<b>HashOver - Error:</b> No way to get page URL, HTTP referrer not set.', 'single'));
			} else {
				$page_url = $_GET['rss'];
			}
		}
	} else {
		if (empty($canon_url)) {
			$page_url = 'http://' . $domain . $_SERVER['REQUEST_URI'];
		} else {
			$page_url = $canon_url;

			if (!empty($_GET['hashover_reply']) or !empty($_GET['hashover_edit'])) {
				$page_url .= (!empty($_GET['hashover_reply'])) ? '?hashover_reply=' . $_GET['hashover_reply'] : '?hashover_edit=' . $_GET['hashover_edit'];
			}
		}
	}

	// Set URL to "count_link" query value
	if (isset($script_query)) {
		if (isset($_GET['count_link']) and !empty($_GET['count_link'])) {
			$page_url = $_GET['count_link'];
		}
	}

	// Characters that aren't allowed in directory names
	$reserved_characters = array(
		'<',
		'>',
		':',
		'"',
		'/',
		'\\',
		'|',
		'?',
		'&',
		'!',
		'*',
		'.',
		'=',
		'_',
		'+',
		' '
	);

	// Clean URL for comment thread directory name
	$parse_url = parse_url($page_url); // Turn page URL into array
	$ref_path  = ($parse_url['path'] == '/') ? 'index' : str_replace($reserved_characters, '-', substr($parse_url['path'], 1));
	$ref_queries = (isset($parse_url['query'])) ? explode('&', $parse_url['query']) : array();
	$ignore_queries = array('hashover_reply', 'hashover_edit');
	$parse_url['query'] = '';

	// Remove unwanted URL queries
	if (file_exists('./ignore_queries.txt') and isset($parse_url['query'])) {
		$ignore_queries = array_merge($ignore_queries, explode(PHP_EOL, file_get_contents('ignore_queries.txt')));
	}

	for ($q = 0; $q <= (count($ref_queries) - 1); $q++) {
		if (!in_array($ref_queries[$q], $ignore_queries) and !empty($ref_queries[$q])) {
			$ref_parts = explode('=', $ref_queries[$q]);

			if (!in_array(basename($ref_queries[$q], '=' . end($ref_parts)), $ignore_queries)) {
				$parse_url['query'] .= ($q > 0 and !empty($parse_url['query'])) ? '&' . $ref_queries[$q] : $ref_queries[$q];
			}
		}
	}

	// Append URL query to path
	if (!empty($parse_url['query'])) {
		$ref_path .= '-' . str_replace($reserved_characters, '-', $parse_url['query']);
	}

	// Remove multiple dashes
	if (mb_strpos($ref_path, '--') !== false) {
		$ref_path = preg_replace('/-{2,}/', '-', $ref_path);
	}

	// Remove leading and trailing dashes
	$ref_path = trim($ref_path, '-');

	// Page comments directory
	if ($ref_path != 'hashover-php') {
		$dir = 'pages/' . $ref_path;
	} else {
		exit(jsAddSlashes('<b>HashOver - Error:</b> Failure setting comment directory name'));
	}

?>
