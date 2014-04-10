<?php
    /*
    Plugin Name: GET Different Front Page
    Plugin URI: http://www.wp-plugin-dev.com
    Description: Used to have different Homepage by $_GET Parameter
    Version: 0.1
    Author: wp-plugin-dev.com
    Author URI: http://www.wp-plugin-dev.com
    
    I once thought I need different home page for different viewers.
    In best case those users have a GET paramter which decides which menu has to be shown.
    
    For Example: 
    You go into WordPress and add a menu with a name of your choice. I choosed "music".
    Now if you want somebody view the music page as start page you have the parameter http://www.example.com/?view=music.
    You can do this with every page you you have.
    
    In case you leave it empty nothing happen at all.
    
    
    */
    
    
    function GET_Different_Page_on_front_parameter() {
    if (!session_id()) {
            session_start();
        }

    }
    
   add_action( 'init', 'GET_Different_Page_on_front_parameter');
   /* The fucntion GET_Different_Page_on_front_parameter() simply starts a session,
   so that one viewer gets the same homepage every time */
    
    
    add_filter( 'template_redirect', 'redirect_another_homepage_gdfp');
    
    function redirect_another_homepage_gdfp(){
    
    if(!($_SESSION['start'])){
    		$_SESSION['start']=$_GET['view'];
    	}
    	else{} // this if is capturing the GET parameter of the start
    
    $front_page_slug=$_SESSION['start'];
    $front_page_id=get_page_by_path($front_page_slug);
    
    $perma=get_permalink( $front_page_id);
    if(is_front_page()){ // I still not know why is_home is not working here

		 wp_redirect( $perma);
		 exit();

    }else{}
   
    
    }

    ?>