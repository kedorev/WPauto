<?php
/**
 * Template Name: Base template
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 18/01/2017
 * Time: 15:32
 */

get_header();
do_action('skeleton_before_content');
get_template_part( 'pagecontent' );
do_action('skeleton_after_content');
get_sidebar('page');
get_footer();