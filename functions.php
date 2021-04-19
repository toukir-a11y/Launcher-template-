<?php

function launcher_theme_support(){
    load_default_textdomain("launcher");
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");
}

add_action ("after_setup_theme", "launcher_theme_support");


function launcher_assets(){

    
    wp_enqueue_style("animate-css",get_theme_file_uri("/assets/css/animate.css"));
    wp_enqueue_style("icomoon-css",get_theme_file_uri("/assets/css/icomoon.css"));
    wp_enqueue_style("bootstrap-css",get_theme_file_uri("/assets/css/bootstrap.css"));
    wp_enqueue_style("style-css",get_theme_file_uri("/assets/css/style.css"));
    wp_enqueue_style("launcher",get_stylesheet_uri()); 

    wp_enqueue_script("easing-jquery-js",get_theme_file_uri("/assets/js/jquery.easing.1.3.js"),array("jquery"),null,true);
    wp_enqueue_script("bootstrap-jquery-js",get_theme_file_uri("/assets/js/bootstrap.min.js"),array("jquery"),null,true);
    wp_enqueue_script("waypoints-jquery-js",get_theme_file_uri("/assets/js/jquery.waypoints.min.js"),array("jquery"),null,true);
    wp_enqueue_script("simplyCountdown-jquery-js",get_theme_file_uri("/assets/js/simplyCountdown.js"),array("jquery"),null,true);
    wp_enqueue_script("main-jquery-js",get_theme_file_uri("/assets/js/main.js"),array("jquery"),time(),true);
    
    $launcher_year  = get_post_meta(get_the_ID(), "year",  true );
    $launcher_month = get_post_meta(get_the_ID(), "month", true);
    $launcher_day   = get_post_meta(get_the_ID(), "date",   true);

    wp_localize_script( "main-jquery-js", "countdown", 
    
        array(

            "year" => $launcher_year,
            "month"=> $launcher_month,
            "date"  => $launcher_day,
    ) );

}
add_action ("wp_enqueue_scripts","launcher_assets");


function launcher_sidebar(){
    register_sidebar(
        array(
               'name'          =>  __( 'Footer-left','launcher' ),
	           'id'            => 'left-sidebar',
	           'description'   =>  __('left-sidebar','launcher'),
	           'before_widget' => '<li id="%1$s" class="widget %2$s">',
	           'after_widget'  => "</li>",
	           'before_title'  => '<h2 class="widgettitle">',
	           'after_title'   => "</h2>",
        )
    );

    register_sidebar(
        array(
               'name'          =>  __( 'Footer-right','launcher' ),
	           'id'            => 'right-sidebar',
	           'description'   =>  __('right-sidebar','launcher'),
	           'before_widget' => '<li id="%1$s" class="widget %2$s">',
	           'after_widget'  => "</li>",
	           'before_title'  => '<h2 class="widgettitle">',
	           'after_title'   => "</h2>",
        )
    );
}

add_action ("widgets_init","launcher_sidebar");



    function launcher_style(){
        if(is_page()){

            $thumbnails_url=get_the_post_thumbnail_url(null,"large");
             ?>

                 <style>

                 .forimage{
                    background-image: url(<?php echo $thumbnails_url?>);
            }
            
            
        </style>

        <?php 
    }
}
 

add_action("wp_head","launcher_style")
?>