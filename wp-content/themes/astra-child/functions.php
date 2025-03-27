<?php

use ElementorPro\Plugin;

/**
* This file modifies or improves the function.php file in the parent theme
*/


function astraChild_load_styles_before() {
    wp_register_style('astraChild_styles', get_stylesheet_uri());

    wp_enqueue_style('astraChild_styles');
}

function astraChild_load_styles_after() {

    wp_register_style('frontend-lite.min3ab2', plugins_url('elementor/assets/css/frontend-lite.min3ab2.css'), array(), '2.16');

    wp_register_style('post-49497', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-49497.css', array(), '2.16');

    wp_register_style('post-477b0f6', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-477b0f6.css', array(), '2.16');

    wp_register_style('post-867e1fa', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-867e1fa.css', array(), '2.16');

    wp_register_style('post-3629dd5', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-3629dd5.css', array(), '2.16');

    wp_register_style('post-122574f8', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-122574f8.css', array(), '2.16');

    wp_register_style('post-104945e2', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-104945e2.css', array(), '2.16');

    wp_register_style('main.min9a99', get_stylesheet_directory_uri() . '/assets/css/minified/main.min9a99.css', array(), '2.16');

    wp_register_style('post-133345e2', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-133345e2.css', array(), '2.16');

    wp_register_style('post-285688d0', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-285688d0.css', array(), '2.16');

    wp_register_style('post-387057fd', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-387057fd.css', array(), '2.16');

    wp_register_style('post-1403801c', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-1403801c.css', array(), '2.16');

    wp_register_style('post-1407801c', wp_upload_dir()['baseurl'] . '/elementor-copy/css/post-1407801c.css', array(), '2.16');

    wp_register_style('general', get_stylesheet_directory_uri() . '/assets/css/general.css', array(), '2.16');

    wp_register_style('public6b25', plugins_url('jet-menu/assets/public/css/public6b25.css'), array(), '2.16');

    wp_register_style('style6b25', plugins_url('jet-menu/integration/themes/astra/assets/css/style6b25.css'), array(), '2.16');

    wp_register_style('frontend.mind537', plugins_url('powerpack-elements/assets/css/min/frontend.mind537.css'), array(), '2.16');

    wp_register_style('pp-woocommerce.mind537', plugins_url('powerpack-elements/assets/css/min/pp-woocommerce.mind537.css'), array(), '2.16');

    wp_register_style('animations.min3ab2', plugins_url('elementor-copy/assets/lib/animations/animations.min3ab2.css'), array(), '2.16');


    wp_enqueue_style('style6b25');
    wp_enqueue_style('main.min9a99');
    wp_enqueue_style('post-1407801c');
    wp_enqueue_style('frontend-lite.min3ab2');
    wp_enqueue_style('post-49497');
    wp_enqueue_style('post-477b0f6');
    wp_enqueue_style('post-867e1fa');
    wp_enqueue_style('post-122574f8');
    wp_enqueue_style('post-104945e2');
    wp_enqueue_style('post-122574f8');
    wp_enqueue_style('post-133345e2');
    wp_enqueue_style('post-285688d0');
    wp_enqueue_style('post-387057fd');
    wp_enqueue_style('post-1403801c');
    wp_enqueue_style('post-3629dd5');
    wp_enqueue_style('public6b25');
    wp_enqueue_style('frontend.mind537');
    wp_enqueue_style('pp-woocommerce.mind537');
    wp_enqueue_style('animations.min3ab2');

    wp_enqueue_style('general');

    if (is_page('build-kit')) {

        wp_register_style('3Dstyle', get_stylesheet_directory_uri() . '/build-kit/css/3Dstyle.css', array(), '2.17');

        wp_enqueue_style('3Dstyle');
    }

}

add_action('elementor/frontend/before_enqueue_styles', 'astraChild_load_styles_before');
add_action('elementor/frontend/after_enqueue_styles', 'astraChild_load_styles_after', 99);


//function add_navbar() {

//}

function add_header_shortcode($atts) {
    get_template_part('template-parts/nav/nav', 'elementor');
    get_template_part('template-parts/header/header','elementor');
}

function add_footer_shortcode($atts) {
    get_template_part('template-parts/footer/footer', 'elementor');
}

function add_scripts_to_foot() {
    get_template_part('template-parts/scripts/scripts', 'elementor');
    wp_register_script('AstraChild', get_stylesheet_directory_uri() . '/assets/js/astraChild.js', array('jquery-core'), '2.16');

    wp_enqueue_script('AstraChild');
}

function add_scripts_to_foot_via_wp_head() {

    if (is_page('build-kit')) {
        wp_register_script('three-works', get_stylesheet_directory_uri() . '/build-kit/js/build/three-works.js', array(), '2.16');

        wp_register_script('OrbitControls', get_stylesheet_directory_uri() . '/build-kit/js/controls/OrbitControls.js', array(), '2.16');

        wp_register_script('GLTFLoader', get_stylesheet_directory_uri() . '/build-kit/js/loaders/GLTFLoader.js', array(), '2.16');

        wp_register_script('3Dscript', get_stylesheet_directory_uri() . '/build-kit/js/3Dscript.js', array(), '2.16');

        wp_enqueue_script('three-works');
        wp_enqueue_script('OrbitControls');
        wp_enqueue_script('GLTFLoader');
        wp_enqueue_script('3Dscript');

        wp_add_inline_script('3Dscript', 'var ABSURL = ' . '"' . get_stylesheet_directory_uri() . '"' . ';', 'before');
    }
}

function add_scripts_and_styles_to_head() {
    get_template_part('template-parts/styles/styles', 'elementor');
}

function add_home_content_shortcode($atts) {
    get_template_part('template-parts/contents/home/home');
}

function add_build_kit_shortcode($atts) {
    get_template_part('build-kit/buildkit');
}

function add_club_shop_content_shortcode($atts) {
    get_template_part('template-parts/contents/club-shop/club-shop');
}


//add_action('astra_body_top', 'add_navbar');
add_shortcode('my_elementor_header_output', 'add_header_shortcode');
add_shortcode('my_elementor_footer_output', 'add_footer_shortcode');
add_action('wp_head', 'add_scripts_and_styles_to_head', 99);
add_action('wp_footer', 'add_scripts_to_foot');
add_action('wp_head', 'add_scripts_to_foot_via_wp_head');


add_shortcode('home_content', 'add_home_content_shortcode');
add_shortcode('build_kit', 'add_build_kit_shortcode');
add_shortcode('club_content', 'add_club_shop_content_shortcode');