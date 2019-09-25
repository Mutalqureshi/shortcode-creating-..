<?php 
	require_once get_template_directory() .'/inc/posttype.php';
	require_once get_template_directory() .'/inc/widgets.php';
	function header_scripts(){
	wp_enqueue_style( 'lss-style', get_stylesheet_uri() );
// main style 
	wp_enqueue_style( 'lss-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, '4', 'all' );
	wp_enqueue_style( 'lss-fontawesome', get_template_directory_uri() . '/css/all.min.css', false, '5.2.0', 'all' );

	wp_enqueue_style( 'lss-slider', get_template_directory_uri() . '/css/slick.css', false, '5.2.0', 'all' );
	wp_enqueue_style( 'lss-theme', get_template_directory_uri() . '/css/slick-theme.css', false, '5.2.0', 'all' );

	// wp_enqueue_style( 'lss-fonts', get_template_directory_uri() . '/css/fonts.css', false, '5.2.0', 'all' );
	wp_enqueue_style( 'lss-custom', get_template_directory_uri() . '/css/custom.css', false, '5.2.0', 'all' );
	// style end script start
	wp_enqueue_script( 'lss-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), time(), true );
	wp_enqueue_script( 'lss-slick-js', get_template_directory_uri() . '/js/slick.js', array(), time(), true );
	wp_enqueue_script( 'lss-custom-js', get_template_directory_uri() . '/js/custom.js', array(), time(), true );
	
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
	add_action( 'wp_enqueue_scripts', 'header_scripts');
// header scrip all 

	//--------//
/**
 * Load redux file.
 */// header scrip all --enc
if ( file_exists( get_template_directory() . '/inc/admin-folder/admin-init.php' ) ) {
	require get_template_directory() . '/inc/admin-folder/admin-init.php';

	function infloway_customize_css() {
		global $fdata;
		echo '<style type="text/css">';
		if(isset($fdata['opt-ace-editor-css'])) {
			echo $fdata['opt-ace-editor-css'];
		}
		echo '</style>';
	}
	add_action( 'wp_head', 'infloway_customize_css', 100);
	
	function infloway_customize_js() {
		global $fdata;
		if(isset($fdata['opt-ace-editor-js'])) {
			echo '<script>
			'.$fdata['opt-ace-editor-js'].'
			</script>
			';
		}
	}
	add_action( 'wp_footer', 'infloway_customize_js', 100);
}


	function lss(){
		register_nav_menus( array(
		'menu-1' => esc_html__( 'Main Menu', 'lss' ),
		'menu-2' => esc_html__( 'Sec Menu', 'lss' ),
		'menu-3' => esc_html__( 'copy-right Menu', 'lss' ),
		) );

		// menu
		add_theme_support( 'post-thumbnails' );
		// image

		add_theme_support( 'customize-selective-refresh-widgets' );
		// theme support
		// $logo_dimensions = $fdata['logo_dimensions'];
		// $logo_dimensions = preg_replace( '/[^0-9]/', '', $logo_dimensions);
		// add_image_size( 'custom-logo-size', $logo_dimensions['width'], $logo_dimensions['height'] );
	}
	add_action('after_setup_theme', 'lss');

// pagination checking
// Numbered Pagination


####################################################
# short-code
####################################################

// function phone_num(){
//     global $fdata;
//           $html='';
//             if($fdata['phone']){
//                     $html = $fdata['phone'];
//                 }
//     return $html;
// }
// add_shortcode("phone","phone_num");

// function email_txt(){
//     global $fdata;
//           $html='';
//             if($fdata['email']){
//             $html = $fdata['email'];
//         }
//     return $html;
// }
// add_shortcode("email" ,"email_txt");
####################################################
// testimonial
function testimonials_list() 
{
	$args = array(
		// 'posts_per_page' => 6,
		'post_type' => 'testimonial',
		'order' => 'ASC',
	); 
	$loop = new WP_Query($args); // The Loop

	// $html .= '<section class="testimonial-sec">';
	// $html .= '<h2>Testimonials</h2>';
	$html .='<div id="testimonial-slider" class="multiple-items" >';
		while ( $loop->have_posts() ) : $loop->the_post();
				{ 
					$post_id = get_the_ID();
					$html .='<div class="row-flex testimonial-div">';

						$html .= "<div class='left-sec test_img'>". get_the_post_thumbnail()
						.'</div>';
						$html .= '<div class="right-sec">';
							
						$image = get_field('5_star');
						$size = 'full'; // (thumbnail, medium, large, full or custom size)
						$html .= '<h2 class="5-star">'.get_the_title().' <img src="'.$image['url'].'" /> </h2>';


						// $html .= '<img src="'.$image['url'].'" />';
						$html .= '<p>'.get_the_content().'</p>';
						$html .= '</div>';
					// $html .= '<p><strong>-'.get_the_title().','.get_field("name").'</strong><br>'.get_field("test_location").'</p>';					
					$html .='</div>';
					
				} 
		endwhile;
	$html .='</div>';
	// $html .= '</section>';
	return $html;
}
add_shortcode("testimonials-list","testimonials_list");

// testimonial end 

// blog post

function latest_posts(){
	$html .='<section class="blog-section">';
	$html .='<div class="container">';
	$html .='<div class="row">';
	                        // WP_Query arguments
    $args = array(
        'post_type' => array( 'post' ),
        'tax_query' => array(
                            'taxonomy' => 'category',//taxonomy ka name ayga category ka nhi
                            'field'    => 'recent-post',//category slug call hoga
                            'terms'    => array( '5' ),// yeah hmare url_bar me 
                        ),
        'post_status' => array( 'publish' ),
        'posts_per_page' => 10,
    );

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();



?>
	<?php 
	$html .='<div class="col-md-4 post-single-home">';
				
				$html .='<div class="blog-col">';
				$post_id = get_the_ID();
				$html .='<div class="blog-post-img">';
				$html .='<a class="image-link" href="'.get_the_permalink().'">'.get_the_post_thumbnail( $post_id, 'recent-posts-image', array('class' => 'img-fluid') ).'</a>';

				$html .='<div class="date-details">';
					$html .='<strong class="date">'.get_the_date("d M Y").'</strong>';
				$html .='</div>';

				$html .='</div>';

				$html .='<div class="post-content no-pad-left">';
				$html .='<h2><a href='.get_the_permalink().' target="_blank">'.get_the_title().'</a></h2>';
				
				$html .='<p>'.get_the_excerpt().'</p>';
				$html .='<div class="read-more"><a class="read-more" href='.get_the_permalink().'>Read more...</a></div>';
				$html .='</div>';
				$html .='</div>';
				$html .= '</div>';
	 ?>

	
	<?php 
} }

	$html .='</div>';
	$html .='</div">';
	$html .='</section">';
	
	return $html;
}
add_shortcode("latestblogs","latest_posts");