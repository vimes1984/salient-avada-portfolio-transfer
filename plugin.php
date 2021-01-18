<?php
/*
Plugin Name: My First Add-On
Description: A super awesome add-on for WP All Import!
Version: 1.0
Author: WP All Import
*/
include "rapid-addon.php";

final class my_first_add_on {

    protected static $instance;

    protected $add_on;

    static public function get_instance() {
        if ( self::$instance == NULL ) {
            self::$instance = new self();
        }
        return self::$instance;
	}
	protected function __construct() {
        
		// Define the add-on
		$this->add_on = new RapidAddon( 'My First Add-On', 'my_first_addon' );
		$this->add_on->add_field('property_location', 'NOT IN USE', 'text'); 

		$this->add_on->import_images( 'my_first_addon', 'Portfolio Images', 'images', [ $this, 'portfolio_images' ]);


		add_action( 'admin_init', [ $this, 'init' ] );
	}

	public function init() {

		//$this->add_on->run( array( "themes" => array("Twenty Fourteen", "Twenty Fifteen") ) );
		$this->add_on->run();


	
	}


	
	public function portfolio_images( $post_id, $attachment_id, $image_filepath, $import_options ) {
		//stop the first one from duping 
		$thumbnailID = get_post_thumbnail_id($post_id);

		if($thumbnailID === $attachment_id){
			return;
		}
		//Check to see if Fusion is set or not
		$checkfusion = get_post_meta( $post_id, '_fusion', true );
		if(empty($checkfusion) ){
			$setarray = array(
				"kd_featured-image-2_avada_portfolio_id" => "",
				"kd_featured-image-3_avada_portfolio_id" => "",
				"kd_featured-image-4_avada_portfolio_id" => "",
				"kd_featured-image-5_avada_portfolio_id" => "",
				"kd_featured-image-6_avada_portfolio_id" => "",
				"kd_featured-image-7_avada_portfolio_id" => "",
				"kd_featured-image-8_avada_portfolio_id" => "",
				"kd_featured-image-9_avada_portfolio_id" => "",
				"kd_featured-image-10_avada_portfolio_id" => "",
				"kd_featured-image-11_avada_portfolio_id" => "",
				"kd_featured-image-12_avada_portfolio_id" => "",
				"kd_featured-image-13_avada_portfolio_id" => "",
				"kd_featured-image-14_avada_portfolio_id" => "",
				"kd_featured-image-15_avada_portfolio_id" => "",
				"kd_featured-image-16_avada_portfolio_id" => "",
				"kd_featured-image-17_avada_portfolio_id" => "",
				"kd_featured-image-18_avada_portfolio_id" => "",
				"kd_featured-image-19_avada_portfolio_id" => "",
				"kd_featured-image-20_avada_portfolio_id" => "",
				"kd_featured-image-21_avada_portfolio_id" => "",
				"kd_featured-image-22_avada_portfolio_id" => "",
				"kd_featured-image-23_avada_portfolio_id" => "",
				"kd_featured-image-24_avada_portfolio_id" => "",
				"kd_featured-image-25_avada_portfolio_id" => "",
				"kd_featured-image-26_avada_portfolio_id" => "",
				"kd_featured-image-27_avada_portfolio_id" => "",
				"kd_featured-image-28_avada_portfolio_id" => "",
				"kd_featured-image-29_avada_portfolio_id" => "",
				"kd_featured-image-30_avada_portfolio_id" => "",
				"fimg" => array("width" => "", "height" => ""),
				"bg_full" => "no",
				"display_header" => "yes",
				"header_bg_full" => "no",
				"main_padding" =>array("top" => "",  "bottom" => ""),
				"content_bg_full" =>"no",
				"image_rollover_icons" => "default",
				"bg_repeat" => "default",
				"header_bg_repeat" => "repeat",
				"displayed_menu" => "default",
				"slider_type" => "no",
				"wooslider" => "0",
				"page_title_bar" =>"default",
				"content_bg_repeat" => "default",
				"portfolio_sidebar" => "default_sidebar",
				"portfolio_sidebar_2" => "default_sidebar",
				"sidebar_sticky" => "default"
			);
			update_post_meta( $post_id, "_fusion", $setarray);
		}
		$postmeta 			= get_post_meta($post_id);
		$unserialized 	=  unserialize($postmeta['_fusion'][0]);
		foreach ($unserialized as $key => $value) {
			//check to make sure wer are only updating the featured images
					
			if (strpos($key, 'kd_featured-image') !== false) {
				if($value === ""){
					$unserialized[$key] = $attachment_id;
					break;
				}
			}
				# code...
		}
		update_post_meta( $post_id, "_fusion", $unserialized);
			
		/*
		// Retrieve previously stored image references.
		$this->add_on->log("CUSTOM LOG 1:");
		$this->add_on->log(var_dump($postmeta));
		$i = 3;



		//$this->add_on->log("CUSTOM LOG:");
		//$this->add_on->log(print_r($array));
		echo "<pre>";
			var_dump($array);
		echo "</pre>";
		*/
		//die();

			// Save the updated list of attachment IDs.
		
	}

}
my_first_add_on::get_instance();
