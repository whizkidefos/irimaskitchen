<?php
/**
 * Sidebar Template
 * 
 * @package IrimasKitchen
 */

if (!is_active_sidebar('blog-sidebar')) {
    return;
}
?>

<aside class="blog-sidebar space-y-8">
    <?php dynamic_sidebar('blog-sidebar'); ?>
</aside>
