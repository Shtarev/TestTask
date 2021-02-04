<?php
/** PHP-Programmierung by AndreyShtarev © www.shtarev.com
* Drop array, objects, variable or scripting code.
* In this script it was used a Open Source - theme code-prettify.
*/
echo '<html>';
require (__DIR__.'/config.php');

function dd($var, $die=false){
	if(is_array($var) || is_object($var)){
		if($die==false){
			echo ("<pre class=\"prettyprint\" id=\"quine\">".print_r($var, true)."</pre>");
		} 
		else {
			die ("<pre class=\"prettyprint\" id=\"quine\">".print_r($var, true)."</pre>");
		}
	}
	else{
		$var = htmlspecialchars($var);
		if($die==false){
			echo "<pre class=\"prettyprint\" id=\"quine\">".$var."</pre>";
		}
		else{
			die ("<pre class=\"prettyprint\" id=\"quine\">".$var."</pre>");
		}
	}
}
echo '</html>';
?>