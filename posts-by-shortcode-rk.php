<?php
/**
* Plugin Name: Posts By Shortcode
* Plugin URI: https://wordpress.org/plugins/posts-by-shortcode
* Description: You can use shortcodes to display wordpress posts
* Version: 1.2
* Author: Rounak Kumar
* Author URI: https://learn-wordpress-by-rk.blogspot.com/
**/
function pbs_rk_post_by_shortcode_admin_menu() {
    add_menu_page('Post By Shortcode', ' Post By Shortcode', 'manage_options', 'post_by_shortcode-rk', 'pbs_rk_post_by_shortcode_function'); 
}	
add_action('admin_menu', 'pbs_rk_post_by_shortcode_admin_menu');
function pbs_rk_post_by_shortcode_function(){
	$plugin_url = plugin_dir_url( __FILE__ );
?>
	<h1>Post By Shortcode</h1>
	<p>Use the following shortcodes to display posts:</p>
	
	<h3>1) Default with Layout One</h3>
	<p><code>[show_posts_pbs_rk layout="1"]</code></p>
	<p><b>Preview:</b></p>
	<img src="<?php echo esc_url($plugin_url).'/assets/screenshot-1.png'; ?>" style="width: 90%;height: auto;" />
	<br/>
	<hr style="margin-top: 25px;margin-bottom: 25px;" />
	
	<h3>2) Default with Layout Two</h3>
	<p><code>[show_posts_pbs_rk layout="2"]</code></p>	
	<p><b>Preview:</b></p>
	<img src="<?php echo esc_url($plugin_url).'/assets/screenshot-2.png'; ?>" style="width: 90%;height: auto;" />
	<br/>
	<hr style="margin-top: 25px;margin-bottom: 25px;" />
	
	<h3>3) Default with Layout Three</h3>
	<p><code>[show_posts_pbs_rk layout="3"]</code></p>
	<p><b>Preview:</b></p>
	<img src="<?php echo esc_url($plugin_url).'/assets/screenshot-3.png'; ?>" style="width: 90%;height: auto;" />
	<br/>
	<hr style="margin-top: 25px;margin-bottom: 25px;" />
	
	<h3>4) Default with Layout Four</h3>
	<p><code>[show_posts_pbs_rk layout="4"]</code></p>
	<p><b>Preview:</b></p>
	<img src="<?php echo esc_url($plugin_url).'/assets/screenshot-4.png'; ?>" style="width: 90%;height: auto;" />
	<br/>
	<hr style="margin-top: 25px;margin-bottom: 25px;" />
	
	<h3>5) Default with Layout Five</h3>
	<p><code>[show_posts_pbs_rk layout="5"]</code></p>
	<p><b>Preview:</b></p>
	<img src="<?php echo esc_url($plugin_url).'/assets/screenshot-5.png'; ?>" style="width: 90%;height: auto;" />
	<br/>
	<hr style="margin-top: 25px;margin-bottom: 25px;" />
	
	<h3>6) Default with Layout Six</h3>
	<p><code>[show_posts_pbs_rk layout="6"]</code></p>
	<p><b>Preview:</b></p>
	<img src="<?php echo esc_url($plugin_url).'/assets/screenshot-6.png'; ?>" style="width: 90%;height: auto;" />
	<br/>
	<hr style="margin-top: 25px;margin-bottom: 25px;" />
	
	<h3>Additional Attributes to Default shortcode</h3>
	<p>You can use multiple attributes in single shortcode. Below is just an example for understanding. You can also use these attributes for layout 2, 3, 4, 5 and 6.</p>
	<p><code>[show_posts_pbs_rk layout="1" no_of_post="6"]</code> <br><i style="background: #f4f4d4;">Set Number of Posts you want to show. Use no_of_post="-1" to display all posts. Default value is 10.</i></p>
	<p><code>[show_posts_pbs_rk layout="1" hide_category="yes"]</code> <br><i style="background: #f4f4d4;">Hide category label from posts.</i></p>
	<p><code>[show_posts_pbs_rk layout="1" desc_length="200"]</code> <br><i style="background: #f4f4d4;">Set number of characters to show in post description.</i></p>
	<p><code>[show_posts_pbs_rk layout="1" category_id="1"]</code> or multiple category ids <code>[show_posts_pbs_rk layout="1" category_id="1,2,3"]</code><br><i style="background: #f4f4d4;">Show posts by category id.</i></p>
	<p><code>[show_posts_pbs_rk layout="1" exclude_cat="1"]</code> or multiple category ids <code>[show_posts_pbs_rk layout="1" exclude_cat="1,2,3"]</code><br><i style="background: #f4f4d4;">Show All posts excluded by category id.</i></p>
	<p><code>[show_posts_pbs_rk layout="1" pagination="yes"]</code> <br><i style="background: #f4f4d4;">Show posts pagination.</i></p>
	<p><code>[show_posts_pbs_rk layout="1" read_more_lebel="Continue Reading >"]</code> <br><i style="background: #f4f4d4;">Set Custom Label for Read More Button.</i></p>
	<p><code>[show_posts_pbs_rk layout="1" show_author="yes"]</code> <br><i style="background: #f4f4d4;">Show author name in posts.</i></p>
	<p><code>[show_posts_pbs_rk layout="1" post_id="52"]</code> <br><i style="background: #f4f4d4;">Show single post by post id.</i></p>
<?php
}
add_action( 'wp_enqueue_scripts', 'pbs_rk_posts_css_fun' );
function pbs_rk_posts_css_fun() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'style',  esc_url($plugin_url) . "/css/style.css");
}

add_shortcode( 'show_posts_pbs_rk', 'pbs_rk_show_posts_func' );
function pbs_rk_show_posts_func( $atts ) {
	
	/* Set Number of Posts to display */
	if($atts['no_of_post']){$post_per_page = $atts['no_of_post'];}else{$post_per_page = 10;}
	
	/* Hide Category from Posts layout */
	if($atts['hide_category']){$hide_category = $atts['hide_category'];}else{$hide_category = 'no';}
	
	/* Set Numbers of character to show in posts description */
	if($atts['desc_length']){$desc_length = $atts['desc_length'];}else{$desc_length = 150;}
	
	/* Show specific category posts */
	if($atts['category_id']){$category_id = $atts['category_id'];}else{$category_id = 0;}
	
	/* Set offset for pagination */
	if($_GET['offset'] && $_GET['offset'] > 1){$offset = ($_GET['offset'] - 1)*$post_per_page;}else{$offset = 0;}
	
	/* Show Pagination */
	if($atts['pagination']){$pagination_attr = $atts['pagination'];}else{$pagination_attr = 'no';}
	
	/* Read More Button Label text */
	if($atts['read_more_lebel']){$read_more_lebel = $atts['read_more_lebel'];}else{$read_more_lebel = 'Read More >';}
	
	/* Show Author in Posts layout */
	if($atts['show_author']){$show_author = $atts['show_author'];}else{$show_author = 'no';}
	
	/* Show Single Post by ID */
	if($atts['post_id']){$show_post_by_id = $atts['post_id'];}else{$show_post_by_id = '0';}
	
	/* Exclude category IDs from posts */
	if($atts['exclude_cat']){$exclude_cat = $atts['exclude_cat'];}else{$exclude_cat = '0';}
	
	/* Get Posts Arguments */
	if($show_post_by_id > 0){
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'p' => $show_post_by_id,
		);
	}else{
		$args = array(
			'post_type'		 => 'post',
			'orderby'	     => 'ID',
			'cat'		     => $category_id,
			'post_status'	 => 'publish',
			'order'   		 => 'DESC',
			'category__not_in'	 => array($exclude_cat),
			'posts_per_page' => $post_per_page,
			'offset'         => $offset
		);
	}
	
	/* Get Posts from Arguments */
	$result = new WP_Query( $args );
	
	$content = '';
	
	if($atts['layout'] == 1){
		include('templates/pbs_rk_layout_1.php');
	}
	if($atts['layout'] == 2){
		include('templates/pbs_rk_layout_2.php');
	}
	if($atts['layout'] == 3){
		include('templates/pbs_rk_layout_3.php');
	}
	if($atts['layout'] == 4){
		include('templates/pbs_rk_layout_4.php');
	}
	if($atts['layout'] == 5){
		include('templates/pbs_rk_layout_5.php');
	}
	if($atts['layout'] == 6){
		include('templates/pbs_rk_layout_6.php');
	}
	
	wp_reset_postdata();
	
	/* Show Pagination */
	if($pagination_attr == 'yes'){
		
		/* Calculate Pagination */
		if($category_id != 0 || $exclude_cat != 0){
			$args = array(
			  'cat' => $category_id,
			  'post_type' => 'post',
			  'category__not_in'	 => array($exclude_cat),
			  'post_status'	 => 'publish'
			);
			
			$the_query = new WP_Query( $args );
			$total_posts = $the_query->found_posts;
		}else{		
			$total_posts = wp_count_posts()->publish;
		}
		
		$total_page = ceil($total_posts/$post_per_page);
			
		if($total_posts > $post_per_page){
			$content .= '<div class="pbs_rk_pagination">';
			$content .= '<ul>';
			
			for($count = 1;$count<=$total_page;$count++){
				if($_GET['offset'] == $count || (empty($_GET['offset']) && $count == 1)){
					$content .='<li class="active"><a href="?offset='.$count.'">'.$count.'</a></li>';
				}else{
					$content .='<li class=""><a href="?offset='.$count.'">'.$count.'</a></li>';
				}
			}
			
			$content .= '</ul>';
			$content .= '</div>';
		}
	}
	
	/* Return Post Layout Html */
	return $content;
}
?>