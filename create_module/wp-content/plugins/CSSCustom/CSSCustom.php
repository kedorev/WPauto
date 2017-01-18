<?php


/*
 * Plugin Name: CSSCustom
 * Plugin URL: http://google.fr
 * Description: Add a custom css
 * Version: 0.1.0
 * Author: LERBRET Maxime
 * Author URI: http://www.maxime-lerbret.com
 * License: GPLv2 or later
 */

function addCustomFile()
{
    wp_register_style('customStyle',plugin_dir_url(__FILE__).'/custom.css');
    wp_enqueue_style('customStyle');

    wp_register_script('CSSCustom-customJS',plugin_dir_url(__FILE__).'/custom.js', array('jquery'));
    wp_enqueue_script('CSSCustom-customJS');

}


function getTitleWithAuthor($titre)
{
    if(get_the_author() != null and get_the_author() != "")
    {
        //return $titre." by : ". get_the_author();
        return $titre;
    }
    else
    {

        return $titre;
    }

}


function avertissementReturn( $atts )
{
    $a = shortcode_atts(array(
        'content' => '',
        'status' => 0,
    ), $atts);
    if($a['status'] == 0)
    {
        return "<span>".$a['content']."</span>";
    }
}

add_shortcode('avertissement','avertissementReturn');

add_action('wp_enqueue_scripts','addCustomFile');
add_filter('the_title','getTitleWithAuthor');