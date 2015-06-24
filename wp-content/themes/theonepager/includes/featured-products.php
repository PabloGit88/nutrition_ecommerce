<?php
/**
 * Homepage Shop Panel
 */
 	
	/**
 	* The Variables
 	*
 	* Setup default variables, overriding them if the "Theme Options" have been saved.
 	*/
	
	global $woocommerce, $post;
	
	$settings = array(
					'homepage_number_of_products' => 4,
					'homepage_products_area_heading' => '', 
					'homepage_products_area_title' => '', 
					'homepage_featured_products_columns' => 4
					);
					
	$settings = woo_get_dynamic_values( $settings );
	
?>
<section id="home-shop-2" class="widget_woo_component woocommerce-columns-3 fix">

	<div class="col-full">		
		<h2 class="widget-title">Especiales de la semana</h2>		
				
		<ul class="products">
			<li class="post-283 product type-product status-publish has-post-thumbnail first featured shipping-taxable purchasable product-type-simple instock">	
			<a href="http://54.186.192.219/product/paquete-promocional-power-30-30-comidas-surtidas/">
				<img width="150" height="150" src="http://54.186.192.219/wp-content/uploads/2015/06/Power-30-150x150.png" class="attachment-shop_catalog wp-post-image" alt="Power-30" />
				<h3>Paquete Promocional  &#8220;Power 30&#8243;    30 comidas surtidas</h3>
				<span class="price"><span class="amount">&#36;150.00</span></span>
			</a>
			<a href="/?add-to-cart=283" rel="nofollow" data-product_id="283" data-product_sku="" data-quantity="1" class="button add_to_cart_button product_type_simple">Add to cart</a>
			</li>	
									
			<li class="post-281 product type-product status-publish has-post-thumbnail featured shipping-taxable purchasable product-type-simple instock">	
				<a href="http://54.186.192.219/product/paquete-promocional-fixed-20-20-comidas-surtidas/">
					<img width="150" height="150" src="http://54.186.192.219/wp-content/uploads/2015/06/fixed-20-150x150.png" class="attachment-shop_catalog wp-post-image" alt="fixed-20" />
					<h3>Paquete Promocional  &#8220;Fixed 20&#8243;    20 comidas surtidas</h3>
					<span class="price"><span class="amount">&#36;103.00</span></span>
				</a>
				<a href="/?add-to-cart=281" rel="nofollow" data-product_id="281" data-product_sku="" data-quantity="1" class="button add_to_cart_button product_type_simple">Add to cart</a>
			</li>	
							
				<li class="post-274 product type-product status-publish has-post-thumbnail featured shipping-taxable purchasable product-type-simple instock">	
				<a href="http://54.186.192.219/product/paquete-promocional-quick-10/">
					<img width="150" height="150" src="http://54.186.192.219/wp-content/uploads/2015/05/quick-10-150x150.png" class="attachment-shop_catalog wp-post-image" alt="quick-10" />
					<h3>Paquete Promocional  &#8220;Quick 10&#8243;    10 comidas surtidas</h3>
					<span class="price"><span class="amount">&#36;53.55</span></span>
				</a>
				<a href="/?add-to-cart=274" rel="nofollow" data-product_id="274" data-product_sku="" data-quantity="1" class="button add_to_cart_button product_type_simple">Add to cart</a>
			</li>	
				
	</div><!-- /.col-full -->		    			    		
</section>

<section id="home-shop" class="widget_woo_component woocommerce-columns-<?php echo esc_attr( intval( $settings['homepage_featured_products_columns'] ) ); ?> fix">

	<div class="col-full">
	
		<?php if ( '' != $settings['homepage_products_area_heading'] ) { ?><span class="heading"><?php echo $settings['homepage_products_area_heading']; ?></span><?php } ?>

		<?php if ( '' != $settings['homepage_products_area_title'] ) { ?><h2 class="widget-title"><?php echo esc_html( $settings['homepage_products_area_title'] ); ?></h2><?php } ?>
		
		<?php do_action( 'woocommerce_before_shop_loop' ); ?>
		
		<ul class="products">
	<?php
			$number_of_products = $settings['homepage_number_of_products'];
			$args = array( 
				'post_type' => 'product', 
				'posts_per_page' => intval( $number_of_products ), 
				'meta_query' => array(
									'relation' => 'AND', 
									array(
										'key' => '_visibility',
										'value' => array( 'catalog', 'visible' ),
										'compare' => 'IN'
									), 
									array(
										'key' => '_featured',
										'value' => array( 'yes' )
									)
								) 
			);
	
			$first_or_last = 'first';
			$loop = new WP_Query( $args );
			$query_count = $loop->post_count;
			$count = 0;
	
			while ( $loop->have_posts() ) : $loop->the_post(); $count++;
	
			if ( function_exists( 'get_product' ) ) {
				$_product = get_product( $loop->post->ID );
			} else { 
				$_product = new WC_Product( $loop->post->ID );
			}
	?>
			
					<?php woocommerce_get_template_part( 'content', 'product' ); ?>
	
			<?php endwhile; ?>
		</ul><!--/ul.recent-->	
		
		<?php do_action('woocommerce_after_shop_loop'); ?>
	
	</div><!-- /.col-full -->
		    			    		
</section>

<?php wp_reset_postdata(); ?>