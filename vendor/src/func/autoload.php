<?php
function __autoload( $className ) {
	$className = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\', '/', $className).'.php';
    if(is_file($className)) {
		require_once $className;
	}
}