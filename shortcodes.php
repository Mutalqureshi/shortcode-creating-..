<?php 
/***custom short codes* */
/* Footer Widget Contact */
add_shortcode("footer-widget-contact","footer_widget_contact");
function footer_widget_contact(){
	global $fdata;
	$html='
	<div class="contact-details tbl">
<div class="tbl-row">
<div class="tbl-cell "><i class="fa fa-phone"></i></div>
<div class="tbl-cell">'.$fdata[contactnumber].'</div>
</div>
<div class="tbl-row">
<div class="tbl-cell "><i class="fa fa-envelope-o"></i></div>
<div class="tbl-cell"><a href="mailto:'.$fdata[email].'" >'.$fdata[email].'</a></div>
</div>
<div class="tbl-row">
<div class="tbl-cell "><i class="fa fa-map-marker"></i></div>
<div class="tbl-cell">'.$fdata[address].'</div>
</div>
</div>';
	return $html;
}
/* Footer Widget Contact End */
/* Footer Bottom Social Links */
add_shortcode("footerbottomsocial","footer_bottom_social");
function footer_bottom_social(){
	global $fdata;
	if($fdata['linkedin']){
    	$html .='<a href='.$fdata[linkedin].'><i class="fa fa-linkedin"></i></a>';
	}
	if($fdata['facebook']){
    	$html .='<a href='.$fdata[facebook].'><i class="fa fa-facebook"></i></a>';
	}
	if($fdata['twitter']){
    	$html .='<a href='.$fdata[twitter].'><i class="fa fa-twitter"></i></a>';
	}
	if($fdata['gplus']){
    	$html .='<a href='.$fdata[gplus].'><i class="fa fa-google-plus-square"></i></a>';
	}
	return $html;
}
/* Footer Bottom Social Links End */
/* Service List Shortcode */

add_shortcode("service-list","service_list");
function service_list() 
{
	$args = array(
		'posts_per_page' => 3,
		'post_type' => 'services',
		'order' => 'ASC',
	); 
	$html .='<div class="container">';
		$html .='<div class="row">';
	$loop = new WP_Query($args); // The Loop
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			{ 
				$html .='<div class="col-md-4 service-single">';
				$html .='<div class="service-col">';
				$post_id = get_the_ID();
				$html .='<i class="fa '.get_field( "fontawesome" ).'"></i>';
				$html .='<h3 class="service-title">'.get_the_title($post_id).'</h3>';
				$html .='<p class="home-excerpt">'.get_the_excerpt($post_id).'</p>';
				$html .='<p><a href='.get_the_permalink($post_id).'>View Details</a></p>';
				$html .='</div>';
				$html .= '</div>';
			} 
			endwhile;
		}
		$html .='</div>';
		$html .='</div>';
	return $html;
}
/* Service List Shortcode End */
/* Service List Shortcode */

add_shortcode("all-service-list","all_service_list");
function all_service_list() 
{
	$args = array(
		'posts_per_page' => 50,
		'post_type' => 'services',
		'order' => 'ASC',
	); 
	$html .='<div class="container">';
		$html .='<div class="row">';
	$loop = new WP_Query($args); // The Loop
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			{ 
				$html .='<div class="col-md-4 service-single">';
				$html .='<div class="service-col">';
				$post_id = get_the_ID();
				$html .='<i class="fa '.get_field( "fontawesome" ).'"></i>';
				$html .='<h3 class="service-title">'.get_the_title($post_id).'</h3>';
				$html .='<p class="excerpt">'.get_the_excerpt($post_id).'</p>';
				$html .='<p><a href='.get_the_permalink($post_id).'>View Details</a></p>';
				$html .='</div>';
				$html .= '</div>';
			} 
			endwhile;
		}
		$html .='</div>';
		$html .='</div>';
	return $html;
}
/* Service List Shortcode End */



/* Work List Shortcode */

add_shortcode("gallery-list","gallery_list");
function gallery_list() 
{
	$args = array(
		'posts_per_page' => 6,
		'post_type' => 'portfolio',
		'order' => 'ASC',
	); 
	$loop = new WP_Query($args); // The Loop
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			{ 
				$html .='<div class="col-sm-4 gallery-single">';
				$html .='<div class="work-col">';
				$post_id = get_the_ID();
				if (has_post_thumbnail( $post_id ) ){
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'gallery' );
					$html .='<img src="'.$image[0].'" class="img-responnsive">';
				}
				$html .='<div class="hoverdiv">';
				$html .='<a href='.get_the_post_thumbnail_url($post_id).' class=group1 title='.get_the_title($post_id).'><i class="fa fa-search"></i></a>';
				$html .='</div>';
				$html .='</div>';
				$html .= '</div>';
			} 
			endwhile;
		}
	return $html;
}
/* Work List Shortcode End */

/* Testimonials List Shortcode */

add_shortcode("testimonials-list","testimonials_list");
function testimonials_list() 
{
	$args = array(
		'posts_per_page' => 6,
		'post_type' => 'testimonials',
		'order' => 'ASC',
	); 
	$loop = new WP_Query($args); // The Loop
	$html .= '<section class="testimonial-sec">';
	$html .= '<h2>Testimonials</h2>';
	$html .='<div id="testimonial-slider" class="owl-carousel owl-theme theme-owl-dot">';
		while ( $loop->have_posts() ) : $loop->the_post();
				{ 
					$post_id = get_the_ID();
					$html .='<div class="testimonial-block">';
					//$html .= '<h2>'.get_the_title().'</h2>';
					$html .= '<p>'.get_the_content().'</p>';
					$html .= '<p><strong>-'.get_the_title().','.get_field("name").'</strong><br>'.get_field("test_location").'</p>';					
					$html .='</div>';
					
				} 
		endwhile;
	$html .='</div>';
	$html .= '</section>';
	return $html;
}
/* Testimonials List Shortcode End */

/* Team List Shortcode */

add_shortcode("team-list","team_list");
function team_list() 
{
	$args = array(
		'posts_per_page' => 6,
		'post_type' => 'team',
		'order' => 'ASC',
	); 
	$loop = new WP_Query($args); // The Loop
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			{ 
				$html .='<div class="col-sm-4 team-single">';
				$html .='<div class="team-col">';
				$post_id = get_the_ID();
				if (has_post_thumbnail( $post_id ) ){
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'gallery' );
					$html .='<img src="'.$image[0].'" class="img-responnsive">';
				}
				$html .='<div class="hoverdiv">';
				$html .='<h2>'.get_the_title().'</h2>';
				$html .='<h4>'.get_field( "designation" ).'</h4>';
				$html .='<p>'.get_the_excerpt().'</p>';
				$html .='<div class="share-icons">';
				
				 $fb=get_field( "facebook_link" );
				if($fb !=''){
					$html .='<a href="'.$fb.'"><i class="fa fa-facebook-square"></i></a>';
				}
				$tw=get_field( "twitter_link" );
				if($tw !=''){
					$html .='<a href="'.$tw.'"><i class="fa fa-twitter-square"></i></a>';
				}
				$yt=get_field( "youtube_link" );
				if($yt !=''){
					$html .='<a href="'.$yt.'"><i class="fa fa-youtube-square"></i></a>';
				}
				$insta=get_field( "instagram_link" );
				if($insta !=''){
					$html .='<a href="'.$insta.'"><i class="fa fa-instagram"></i></a>';
				}
				$gplus=get_field( "google_plus_link" );
				if($gplus !=''){
					$html .='<a href="'.$gplus.'"><i class="fa fa-google-plus-square"></i></a>';
				}
				$linkedin=get_field( "linkedin_link" );
				if($linkedin !=''){
					$html .='<a href="'.$linkedin.'"><i class="fa fa-linkedin-square"></i></a>';
				}
				$pinterest=get_field( "pinterest_link" );
				if($pinterest !=''){
					$html .='<a href="'.$pinterest.'"><i class="fa fa-pinterest-square"></i></a>';
				}
				$html .= '</div>';
				
				$html .='</div>';
				$html .='</div>';
				$html .= '</div>';
			} 
			endwhile;
		}
	return $html;
}
/* Team List Shortcode End */
/* Latest Posts Shortcode */

add_shortcode("latestblogs","latest_posts");
function latest_posts() 
{
	$html .='<section class="blog-section">';
	$html .='<div class="container">';

	global $fdata;
	if($fdata['show-latest-blogs']==1){
	$html .='<div class="row">';
	$html .='<div class="col-sm-12">';
		if($fdata['b_head']){
			$html .='<h2 class="section-heading">'.$fdata['b_head'].'</h2>';
		}
		
		
		if($fdata['b_para']){
			$contnet_b=apply_filters('the_content', $fdata['b_para']);
			$html .='<p class="lastest-blogs-para">'.$contnet_b.'</p>';
		}
	$html .='</div>';
	$html .='</div>';
	
	$html .='<div class="row">';
	$args = array(
		'posts_per_page' => 3,
		'post_type' => 'post',
		'order' => 'ASC',
	); 
	
	$loop = new WP_Query($args); // The Loop
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
			{ 
				$html .='<div class="col-md-4 post-single-home">';
				$html .='<div class="blog-col">';
				$post_id = get_the_ID();
				$html .='<div class=" img">';
				$html .='<a class="image-link" href="'.get_the_permalink().'">'.get_the_post_thumbnail( $post_id, 'recent-posts-image', array( 'class' => 'img-size-359x269' ) ).'</a>';
				$html .='</div>';
				$html .='<div class="details">';
				$html .='<div class="date-details">';
				$html .='<strong class="date">'.get_the_date(d).'</strong> <strong class="month">'.get_the_date(M).'</strong>';
				$html .='</div>';
				$html .='<div class="post-content no-pad-left">';
				$html .='<h2><a href='.get_the_permalink().' target="_blank">'.get_the_title().'</a></h2>';
				$html .='<div class="posted-by">
                            <p>'.get_the_date('j F, Y').' by '.get_the_author().' in '.get_the_category_list($post_id).' <br/>2 Comments</p>
                        </div>';
				$html .='<p>'.get_the_excerpt().'</p>';
				$html .='<div class="read-more"><a class="read-more" href='.get_the_permalink().'>READ MORE</a></div>';
				$html .='</div>';
				$html .='</div>';

				$html .='</div>';
				$html .= '</div>';
			} 
			endwhile;
		}
	$html .='</div>';
	$html .='</div">';
	$html .='</section">';
	
	return $html;
	}
}
/* Latest Posts Shortcode End */
/*-----------------------*/
add_shortcode("contact-page-contacts","contact_page_contacts");
function contact_page_contacts() 
{	
	global $fdata;
	if($fdata['address']){
				$html .='<p class="contact-page icon">'.$fdata['address'].'</p>';
	}
	 $html .= '<p class="contact-page icon email">';
	if($fdata['email']){
				$html .='<a href="mailto:'.$fdata['email'].'">'.$fdata['email'].'</a>';
	}
	if($fdata['email2']){
				$html .='<a href="mailto:'.$fdata['email2'].'">'.$fdata['email2'].'</a>';
	}
	$html .= '</p>';
	$html .= '<p class="contact-page icon phone">';
	if($fdata['contactnumber']){
				$html .='<a href="tel:'.$fdata['contactnumber'].'">'.$fdata['contactnumber'].'</a>';
	}
	if($fdata['contactnumber2']){
				$html .='<a href="tel:'.$fdata['contactnumber2'].'">'.$fdata['contactnumber2'].'</a>';
	}
	$html .='</p>';	
	return $html;
	}
/*--------------*/
/*------my-google-map---------*/
		function my_google_map($atts) {
			$a = shortcode_atts( array(
				'height' => '450px',
				'width' => '100%',
			), $atts );
			global $fdata;
			$output = '';
			$output .= '<!-- google map code start -->';
				
			if($fdata['address']){
				$address=$fdata['address'];
			}
			else{
				$address="please set the address in theme settings";
			}
			if($fdata['contactnumber']){
				$phone=$fdata['contactnumber'];
			}
			else{
				$phone=" ";
			}
			if($fdata['email']){
				$email=$fdata['email'];
			}
			else{
				$email=" ";
			}
			$address;
			$phone;
			$fax;
			$email;
			if ( isset($address) ) {
				$output .= '
					<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCRJEorG2FepiXFICMQ_QRCft_WtR632EA"></script>
					<script>
					var geocoder;
					var map;
					function initialize() {  
					  geocoder = new google.maps.Geocoder();
					  var address = "'.preg_replace('/^\s+|\n|\r|\s+$/m', ' ', strip_tags($address) ).'";//III Lincoln Centre 5430 LBJ Freeway, Suite 1200 Dallas, Texas 75240, United States
					  geocoder.geocode( { "address": address}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							
							map.setCenter(results[0].geometry.location);
						  
							//creating marker
							var marker = new google.maps.Marker({
							  map: map,
							  position: results[0].geometry.location,
							  title: "Our Location: "+address
							});
						  
							//binding info windowon marker click
							google.maps.event.addListener(marker, "click", function() {
								infowindow.open(map,marker);
							});
							google.maps.event.addListener(marker, "mouseover", function() {
								//infowindow.open(map,marker);
							});
							google.maps.event.addListener(marker, "mouseout", function() {
								//infowindow.close(map,marker);
							});
					  
						} else {
						  alert("Geocode was not successful for the following reason: " + status);
						}
					  });
					  var myLatlng = new google.maps.LatLng(0,0);//-25.363882,131.044922
					  var mapOptions = {
						zoom: 17,
						center: myLatlng
					  };
					  var map = new google.maps.Map(document.getElementById("google_map"), mapOptions);
				';
					  
				/*
					  var contentString = '<div id="content">'+
						  '<h1 id="firstHeading" class="firstHeading">'.bloginfo('name').'</h1>'+
						  '<div id="bodyContent">'+
						  '<p>Address: <?php echo preg_replace('/^\s+|\n|\r|\s+$/m', ' ', strip_tags($address) ); ?>'+
						  
						  <?php if( $phone ) {?>
								'<p>Phone: <?=$phone?>'+
							<?php } ?>
						  
						  <?php if( $fax) {?>
								'<p>Fax: <?=$fax?>'+
							<?php } ?>
							
						  <?php if( $email ) {?>
								'<p>Email: <?=$email?>'+
							<?php } ?>
						  '</div>'+
						  '</div>';
					  var infowindow = new google.maps.InfoWindow({
						  content: contentString
					  });
					  */
				$output .= '
					}
					google.maps.event.addDomListener(window, "load", initialize);
				
					</script>
					<div id="google_map" width="'.$a['width'].'" height="500px"  style="height: '.$a['height'].'; border: 1px solid #ccc;" class="google_map"></div>
				';
				
				/* return "height = {$a['height']}"." width = {$a['width']}"; */
				
            }
		
	return $output;
	
		}
	add_shortcode('my-google-map', 'my_google_map');
	
	
/*----------------*/
/*----short-code-with-parameters--------*/
/*  function maparea( $atts ) {
    $a = shortcode_atts( array(
        'height' => '100px',
        'width' => '100%',
    ), $atts );
    return "height = {$a['height']}"." width = {$a['width']}";
}
add_shortcode( 'maparea-to-add', 'maparea');  */
/*----short-code-with-parameters-Ended-------*/