<?php
add_action('admin_menu', 'thefirst_sliders_add_box');
function thefirst_sliders_add_box() {
    global $thefirst_sliders_meta_box;
    
    add_meta_box($thefirst_sliders_meta_box['id'], $thefirst_sliders_meta_box['title'], 'thefirst_sliders_show_box', $thefirst_sliders_meta_box['page'], $thefirst_sliders_meta_box['context'], $thefirst_sliders_meta_box['priority']);
}

// Callback function to show fields in meta box
function thefirst_sliders_show_box() {
    global $thefirst_sliders_meta_box, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="thefirst_sliders_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table">';

    foreach ($thefirst_sliders_meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />', '
', $field['desc'];
                break; 
			case 'upload':
                echo '<input type="text" class="thefirst_sliders_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="35" style="width:70%" /><input class="upload_image_button" type="button" value="Upload Image" id="button_' . $field['id'] . '" />', '
', $field['desc'];
                break; 
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '
', $field['desc'];
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '<td>',
            '</tr>';
    }
    
    echo '</table>';
}
add_action('save_post', 'thefirst_sliders_save_data');

// Save data from meta box
function thefirst_sliders_save_data($post_id) {
    global $thefirst_sliders_meta_box;
    
    // verify nonce
    if (!wp_verify_nonce($_POST['thefirst_sliders_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    foreach ($thefirst_sliders_meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];
        
        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
// sliders Options

/*
$sliders_prefix = 'sliders_';
$thefirst_sliders_meta_box = array(
    'id' => 'sliders-meta',
    'title' => 'Slider Options',
    'page' => 'sliders',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => 'URL',
            'desc' => 'Enter a URL to link this slide to.',
            'id' => $sliders_prefix . 'url',
            'type' => 'text',
            'std' => ''
        ),
    ));
*/
 
?>