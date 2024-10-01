<?php 

/* Add Nav Menu in custom theme */
if ( has_nav_menu( 'primary' ) ) : 
wp_nav_menu( array(
      'menu' => '',
      'menu_id'         => '',
      'menu_class'      => '',
      'container'       => '', 
      'container_class' => '', 
      'container_id'    => '', 
      'echo'                 => true,
      'depth'                => 0,
      'items_wrap'           => '<ul id="%1$s" class="clear">%3$s</ul>',
      'item_spacing'         => 'preserve',
      'fallback_cb'       => 'wp_page_menu',
      'theme_location' => ''
     ) );
endif; 

 
wp_nav_menu( array(
    'container' => false,
    'add_li_class' => 'nav--item',
    'link_before' => '<span></span>',
    'items_wrap'     => '<ul class="nav--items"><li id="item-id"></li>%3$s</ul>'
), );

 
if ( has_nav_menu( 'secondary' ) ) : 
  wp_nav_menu( array(
      'container' => false,
      'theme_location'=>'secondary',
      'items_wrap'     => '<ul class="nav navbar-nav"><li id="item-id"></li>%3$s</ul>'
  ), );
endif; 
            
 
                           

/* Menu Active */
/* Add code in Function file */
function roots_wp_nav_menu($text) {
  $replace = array(
    'current-menu-item'     => 'active',
    'current-menu-parent'   => 'active',
    'menu-item-type-post_type' => '',
    'menu-item-object-page' => '',
  );
  $text = str_replace(array_keys($replace), $replace, $text);
  return $text;
}
add_filter('wp_nav_menu', 'roots_wp_nav_menu');

/* Active Menu */
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}



/* Sub menu class change */
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub__menu\">\n";
  }
}
/* Sub menu class change */
class My_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu\">\n";
  }
}


/* A tag add class */
add_filter( 'nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 3 );
function wpse156165_menu_add_class( $atts, $item, $args ) {
    $class = 'nav-link'; // or something based on $item
    $atts['class'] = $class;
    return $atts;
}
function add_menuclass($ulclass) {
   return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');


/* WP Nav Menu Li add class */
function wpdocs_special_nav_class( $classes, $item, $args ) {
     if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter( 'nav_menu_css_class' , 'wpdocs_special_nav_class' , 1, 3 );



?>
