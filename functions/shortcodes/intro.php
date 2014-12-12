<?php

function intro($atts, $content = null) {
   return '
   	<div id="intro" style="width:960px">
		<div class="intro-left"></div>
		<div class="intro-content" style="width:899px">
			<h1>' . do_shortcode($content) . '</h1>
		</div>
		<div class="intro-right"></div>
	</div>
   	';
}
add_shortcode('intro', 'intro');

?>