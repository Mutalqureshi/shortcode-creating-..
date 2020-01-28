function shortcode_mostra_produtos( $atts ) {
        // global $fdata,
        //     $post;
        $atts = shortcode_atts( array(
            'line' => ''
        ), $atts );
        $loop = new WP_Query( array(
            'posts_per_page'    => -1,
            'post_type'         => 'testimonials',
            'tax_query'         => array( array(
                'taxonomy'  => 'testimonail_tax',
                // 'field'     => 'pros',
                'terms'     => array( sanitize_title( $atts['line'] ) ),
            ) )
        ) );
        $html .='<div class="testimonial">';
        $html .='<div class="row">';
        while ( $loop->have_posts() ) { $loop->the_post(); 
            $post_id = get_the_ID();
                $html .= '<div class="col-md-6">';
                $html .= '<p>'.get_the_content().'</p>';
                $html .= '<div class="figcaption">';
                $html .= '<h2 class="testimonial-tilte">'.get_the_title().' </h2>';
                $html .= '<h4><strong>-'.get_field("city").'</strong>'.get_field("year").','.get_field("college").'</h4>';
                $html .= '</div>';  
                $html .= '</div>';          
               
            
         
      
    }
                $html .= '</div>';  
                $html .= '</div>';  
    return $html;
        wp_reset_postdata();
    }
        add_shortcode("hhh","shortcode_mostra_produtos");


Message Muhammad Ali Asghar
