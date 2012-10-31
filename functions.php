<?php
/*
Author: Bryan Hyshka
URL: htp://hyshka.com/
*/

/************* Rideshare Custom Post Type ***********/
require_once('rideshare-post-type.php'); // change this to your location

/************* RideShare Form *****************/
//Attribute: IAMRONEN (http://www.odharma.com/2011/01/how-to-create-data-entry-forms-for-wordpress-with-contactform7/)
function rideshare_wpcf7_save($cfdata) {
 
    //Skip Mailing
    $cfdata->skip_mail = true; 

    // grab data from submitted form
    $formtitle = $cfdata->title;
    $formdata = $cfdata->posted_data;
 
    // If Rideshare Submit Form
    if ( $formtitle == 'Rideshare Form') {
 
        // setup array for new post
        $newpost = array( 'post_title' => implode(" - ", array($formdata['name'],$formdata['type']) ), //set the post title to "Name - Type"
                      'post_status' => 'publish', //to automatically publish
                      'post_type' => 'rideshare' //the post type
                      );
 
        // insert array into new post and call the ID
        $newpostid = wp_insert_post($newpost);

        // set the taxonomy(custom category) for the post (ID, 'input from form', 'custom_category')
        wp_set_object_terms($newpostid, $formdata['event'], 'rideshare_events');
 
        // add meta data for the new post (ID, 'post_meta name', 'input from form')
        add_post_meta($newpostid, 'location', $formdata['location']);
        add_post_meta($newpostid, 'seats', $formdata['seats']);
        add_post_meta($newpostid, 'departure', $formdata['departure']);
        add_post_meta($newpostid, 'return', $formdata['return']);
        add_post_meta($newpostid, 'phone', $formdata['phone']);
        add_post_meta($newpostid, 'email', $formdata['email']);
        add_post_meta($newpostid, 'additionalinfo', $formdata['additionalinfo']);
        add_post_meta($newpostid, 'key', $formdata['key']);
    }

    // If Rideshare Edit Form
    if ( $formtitle == 'Rideshare Edit' ) {

        //get id of rideshare post
        $postid = wpcf7_special_mail_tag_for_post_data( $output, '_post_id' ); 

        //get meta data for key
        $post_key = get_post_meta($postid, 'key', true);

        //get form data for key
        $form_key = $formdata['key']; 

        //if they match, do this
        if ( $form_key == $post_key ) { 

            // set update post variables
            $updatepost = array(); //set up array
            $updatepost['ID'] = $postid; //set ID
            $updatepost['post_status'] = 'draft'; //set post status

            wp_update_post($updatepost); //plug variables in
        }
    }
}
add_action('wpcf7_before_send_mail', 'rideshare_wpcf7_save',1); //Hook into Contact Form 7 function

/************* Hide Meta Boxes for Rideshare Post Type *****************/
function my_remove_meta_boxes() {
    remove_meta_box('slugdiv', 'rideshare', 'normal');
    remove_meta_box('postimagediv', 'rideshare', 'normal');
    remove_meta_box('tagsdiv-post_tag', 'rideshare', 'normal');
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );

?>