<?php
class My_Mega_Menu_Walker extends Walker_Nav_Menu {

    public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
        $classes = empty( $item->classes ) ? [] : (array) $item->classes;

        // Global toggle from Options Page
        $show_mega_menu = get_field( 'show_mega_menu', 'option' );

        // Add `menu-item-has-children` if mega menu is enabled + has rows
        if ( $show_mega_menu && $depth === 0 && have_rows( 'mega_menu_list', $item ) ) {
            $classes[] = 'menu-item-has-children';
        }

        $class_names = join( ' ', array_filter( $classes ) );

        $output .= '<li class="' . esc_attr( $class_names ) . '">';

        // Menu link
        $output .= '<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';

        // Mega menu wrapper (only if option is enabled)
        if ( $show_mega_menu && $depth === 0 && have_rows( 'mega_menu_list', $item ) ) {
            $output .= '<div class="mega-menu">';
            $output .= '<div class="container">';
            $output .= '<div class="mega-menu__inner">';

            // Loop columns
            while ( have_rows( 'mega_menu_list', $item ) ) {
                the_row();

                $menu_title = get_sub_field( 'menu_title' );

                $output .= '<div class="mega-column">';

                if ( $menu_title ) {
                    $output .= '<h4>' . esc_html( $menu_title ) . '</h4>';
                }

                if ( have_rows( 'menu_links' ) ) {
                    $output .= '<ul>';
                    while ( have_rows( 'menu_links' ) ) {
                        the_row();
                        $link = get_sub_field( 'link' );

                        if ( $link ) {
                            $output .= '<li><a href="' . esc_url( $link['url'] ) . '" target="' . esc_attr( $link['target'] ) . '">' . esc_html( $link['title'] ) . '</a></li>';
                        }
                    }
                    $output .= '</ul>';
                }

                $output .= '</div>'; // .mega-column
            }

            $output .= '</div>'; // .mega-menu_inner
            $output .= '</div>'; // .container
            $output .= '</div>'; // .mega-menu
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = [] ) {
        $output .= '</li>';
    }
}