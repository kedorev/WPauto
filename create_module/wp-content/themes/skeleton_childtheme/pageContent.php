<?php
/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with pageContent.php.
 *
 * @package Skeleton WordPress Theme
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <?php echo "<H1>".get_field("contact_title")."</H1>" ?>
    <?php echo get_field("contact_content") ?>
    <?php //var_dump(get_fields());?>

<?php endwhile; // end of the loop. ?>