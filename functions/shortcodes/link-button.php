<?php

function link_button($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#', 'target' => '_self'), $atts));
   return '<a class="button" href="'.$link.'" target="'.$target.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('link_button', 'link_button');

?>