<?php
/**
 * @package New_Facebook_Popup_Like_Box_responsive
 */
/*
Plugin Name: New Facebook Popup Like Box (Responsive)
Plugin URI: http://www.cstweaks.com/wordpress-plugin/
Description: A latest responsive facebook pop up Like-box for Wordpress . Which shows a Responsive PopUp layout facebook likebox on your pages @ after your given time Interval.
Version: 1.00
Author: Krishna Sharma (DoNotTraceME)
Author URI: https://www.facebook.com/DoNotTraceMe	
            http://www.cstweaks.com
			http://www.hackingtruth.org
License: GNU GPLv2 or later
*/

/*  Copyright 2014  Krishna Sharma  (email : donottraceme007@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//adding actual codes to the bottom
function facebookpopup_footer() {
   
    //$footer = file_get_contents(dirname(__FILE__).'/facebookpopup_footer.php');
    include(dirname(__FILE__).'/fb_footer.php');
    $footer = $fb_footer;
    $footer = str_replace('__URL__', get_option('facebookpopup_fburl'), $footer);
    $footer = str_replace('__DELAY__', get_option('facebookpopup_delay')*1000, $footer);
    echo $footer;
}
add_action('wp_footer', 'facebookpopup_footer');

//add default options

function facebookpopup_set_up_options() {
    add_option('facebookpopup_fburl', 'UnofficialMechanical');
    add_option('facebookpopup_delay', 10);
    
    register_setting( 'facebookpopup_settings_group', 'facebookpopup_fburl' );
    register_setting( 'facebookpopup_settings_group', 'facebookpopup_delay' );
}

//adding FB scripts

function frontend_scripts() {
    wp_enqueue_script( 'facebookpopup_script', plugins_url( 'javascripts/facebookpopup.js' , __FILE__ ), array('jquery'));
    wp_enqueue_style( 'facebookpopup_style', plugins_url( 'cssfiles/style.css' , __FILE__ ));
}

add_action( 'wp_enqueue_scripts', 'frontend_scripts');


//Adding settings link 
function facebook_settings_link( $links ) {
    $settings_link = '<a href="'.admin_url( 'admin.php?page=facebookpopup_settings' ).'">Settings</a>';
  	array_push( $links, $settings_link );
  	return $links;
}

$plugin = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$plugin", 'facebook_settings_link' );


//adding a dummy page
function facebookpopup_settings_menu() {
    add_submenu_page( 
          null          
        , 'Facebook Popup settings'   
        , 'Facebook Popup settings'  
        , 'administrator' 
        , 'facebookpopup_settings'   
        , 'facebookpopup_display_settings' 
    );
    add_action('admin_init', 'facebookpopup_set_up_options');
    
}


add_action('admin_menu', 'facebookpopup_settings_menu');




function facebookpopup_display_settings() {
    
    
?>
<div class="wrap" style="float:left; width:70%">
<h2>Facebook Popup settings </h2>

<form method="post" action="options.php">
    <?php settings_fields( 'facebookpopup_settings_group' ); ?>
    <?php do_settings_sections( 'facebookpopup_settings_group' ); ?>
       <table class="form-table">
        <tr valign="top">
        <th scope="row">Facebook Page URL</th>
        <td>http://www.facebook.com/<input type="text" name="facebookpopup_fburl" value="<?php echo get_option('facebookpopup_fburl'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Delay in showing popup</th>
        <td><input type="text" name="facebookpopup_delay" value="<?php echo get_option('facebookpopup_delay'); ?>" /> secs</td>
        </tr>
        
    </table>
    
    <?php submit_button(); ?>

</form>

</div>
<div >
    <br>
    <a style="text-decoration:underline" target="_blank" href="http://www.CsTweaks.com" rel="dofollow">Visit Us for More Plugins</a>
                  
    <br>Features:<br>
                    <ul>
                    <li>- Best Support Inclusive Phone Call . </li>
</ul>
                        </div>

<?php } ?>
