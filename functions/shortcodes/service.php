<?php

function service($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#','icon' => 'K', 'title' => 'Default Service'), $atts));
   return '<a href="'.$link.'"><div class="sv-icon">
				<p>'.$icon.'</p>
			</div>
			<div class="sv-content">
				<h4 class="sv-main">'.$title.'</h4>
				<p class="sv-sub">
				'. do_shortcode($content) . '	
				</p>
			</div></a>';
}
add_shortcode('service', 'service');

?>