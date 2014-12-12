<?php

function intro_2($atts, $content = null) {
   return '
   	<div id="intro-2">
		<h1>' . do_shortcode($content) . '</h1>
	</div>
   	';
}
add_shortcode('intro_2', 'intro_2');

?>