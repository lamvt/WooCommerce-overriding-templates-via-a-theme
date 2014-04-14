<?php

/* Register Sidebars */

add_action('widgets_init', 'd4j_register_sidebars');

function d4j_register_sidebars()
{
    register_sidebar(array(
        'id' => 'sidebar',
        'name' => 'Sidebar Widget',
        'before_widget' => '<div class="widget %2$s"><div class="widget_cotent">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="wg_title">',
        'after_title' => '</h3>'
    ));
	
}

?>