<?php

function highlight_link($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#', 'target' => '_self'), $atts));
   return '<a class="highlight" href="'.$link.'" target="'.$target.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('highlight_link', 'highlight_link');

?>