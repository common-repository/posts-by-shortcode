<?php
$content .= '<div class="pbs_rk_post_row_l6">';
		
		if ( $result-> have_posts() ) :
		
			while ( $result->have_posts() ) : $result->the_post();
				$category_detail=get_the_category();
				foreach($category_detail as $cd){
					$cat_id = $cd->term_id;
					$cat_name = $cd->name;
				}
				
				$post_image = wp_get_attachment_url( get_post_thumbnail_id() );
				if(empty($post_image)){
					$plugin_url = plugin_dir_url( __FILE__ );
					$post_image = $plugin_url.'/images/blog-default.jpg';
				}
				
				$author_id = get_the_author_meta( 'ID' );
				
				$content .= '<div class="pbs_rk_post_col_l6" style="background-image:url('.$post_image.');">';
				$content .= '<div class="pbs_rk_post_inner_l6">';
				if($hide_category == 'no')
					$content .= '<span class="pbs_rk_post_meta_category"><a href="'. get_category_link( $cat_id ) .'">'. $cat_name .'</a></span>';
				$content .= '<a href="'. get_the_permalink() .'" rel="bookmark" class="pbs_rk_post_title">';
				$content .= '<h2>'. get_the_title() .'</h2>';
				$content .= '</a>';
				$content .= '<p class="pbs_rk_post_meta">';
				$content .= '<span class="pbs_rk_post_meta_date">'. get_the_date( 'F j, Y' ) .'</span>';
				
				if($show_author == 'yes')
					$content .= '<span class="pbs_rk_post_meta_slash">|</span><span class="pbs_rk_post_meta_author"><a href="'. get_author_posts_url( $author_id ) .'">'. get_the_author_meta( 'display_name', $author_id ) .'</a></span>';
				
				$content .= '</p>';
				$content .= '</div>';
				$content .= '</div>';
				
			endwhile;
			
		endif; 
		
		$content .= '</div>';