<?php

/**
 * If we have a large hash, let's shorten it.
 */
function shorten_hash($hash, $len=20){
	if(strlen($hash) > $len){
		$hash = substr($hash, 0, $len) . "...";
	}
	return $hash;	
}

/**
 * If we have a large nick, push back
 * smaller version.
 */
function shorten_nick($nick, $len=20){
	if(strlen($nick) > $len){
		$nick = substr($nick, 0, $len) . "...";
	}
	return $nick;
}

/**
 * Auto link hyperlinks in text.
 */
function auto_link_text($text){

	$text= preg_replace(
		'/((http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?)/', 
		'<a href="\1" target="blank_">\1</a>',
		$text
	);

	return $text;
}

function e_html($text){
	echo html($text);
}

function html($text){
	return htmlentities($text);
}

?>