<?php

function one_third( $atts, $content = null ) {
	
   return '<div class="one_third">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_third', 'one_third' );


function one_third_last( $atts, $content = null ) {
	
   return '<div class="one_third last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_third_last', 'one_third_last' );


function two_third( $atts, $content = null ) {
	
   return '<div class="two_third">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'two_third', 'two_third' );


function two_third_last( $atts, $content = null ) {
	
   return '<div class="two_third last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'two_third_last', 'two_third_last' );


function one_half( $atts, $content = null ) {
	
   return '<div class="one_half">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_half', 'one_half' );


function one_half_last( $atts, $content = null ) {
	
   return '<div class="one_half last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_half_last', 'one_half_last' );


function one_fourth( $atts, $content = null ) {
	
   return '<div class="one_fourth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_fourth', 'one_fourth' );


function one_fourth_last( $atts, $content = null ) {
	
   return '<div class="one_fourth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_fourth_last', 'one_fourth_last' );


function three_fourth( $atts, $content = null ) {
	
   return '<div class="three_fourth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'three_fourth', 'three_fourth' );


function three_fourth_last( $atts, $content = null ) {
	
   return '<div class="three_fourth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'three_fourth_last', 'three_fourth_last' );

function one_fifth( $atts, $content = null ) {
	
   return '<div class="one_fifth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_fifth', 'one_fifth' );


function one_fifth_last( $atts, $content = null ) {
	
   return '<div class="one_fifth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_fifth_last', 'one_fifth_last' );


function two_fifth( $atts, $content = null ) {
	
   return '<div class="two_fifth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'two_fifth', 'two_fifth' );


function two_fifth_last( $atts, $content = null ) {
	
   return '<div class="two_fifth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'two_fifth_last', 'two_fifth_last' );


function three_fifth( $atts, $content = null ) {
	
   return '<div class="three_fifth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'three_fifth', 'three_fifth' );


function three_fifth_last( $atts, $content = null ) {
	
   return '<div class="three_fifth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'three_fifth_last', 'three_fifth_last' );


function four_fifth( $atts, $content = null ) {
	
   return '<div class="four_fifth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'four_fifth', 'four_fifth' );


function four_fifth_last( $atts, $content = null ) {
	
   return '<div class="four_fifth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'four_fifth_last', 'four_fifth_last' );


function one_sixth( $atts, $content = null ) {
	
   return '<div class="one_sixth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_sixth', 'one_sixth' );


function one_sixth_last( $atts, $content = null ) {
	
   return '<div class="one_sixth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_sixth_last', 'one_sixth_last' );


function five_sixth( $atts, $content = null ) {
	
   return '<div class="five_sixth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'five_sixth', 'five_sixth' );


function five_sixth_last( $atts, $content = null ) {
	
   return '<div class="five_sixth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'five_sixth_last', 'five_sixth_last' );


/* The following function takes care of that by disabling WordPress’s auto-formating filters so that the column shortcode is parsed 
 * without being run through them, then reapplying the content filters after the column shortcode has been parsed. The result is that 
 * all of the column shortcodes will validate.
 */
function formatter( $content ) {
	
  $new_content = '';

  /* Matches the contents and the open and closing tags */
  $pattern_full = '{(\[raw\].*?\[/raw\])}is';

  /* Matches just the contents */
  $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

  /* Divide content into pieces */
  $pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

  /* Loop over pieces */
  foreach ( $pieces as $piece ) {
    /* Look for presence of the shortcode */
    if (preg_match( $pattern_contents, $piece, $matches ) ) {

      /* Append to content (no formatting) */
      $new_content .= $matches[1];
    } else {

      /* Format and append to content */
      $new_content .= wptexturize( wpautop( $piece ) );
    }
  }

  return $new_content;
  
}

// Remove the 2 main auto-formatters
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );

// Before displaying for viewing, apply this function
add_filter( 'the_content', 'formatter', 99 );
add_filter( 'widget_text', 'formatter', 99 );

?>
