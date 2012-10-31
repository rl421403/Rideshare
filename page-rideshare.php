<?php
/*
Template Name: Rideshare Page Template
*/
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">

					<div id="rideshare" class="twelvecol first clearfix" role="main">

						<h1 class="page-title">Rideshare</h1>

						<!-- start counter -->
						<?php $c = 0; ?>
						<!-- set post type & # of posts per page -->
						<?php $args = array( 'post_type' => 'rideshare', 'posts_per_page' => '6' ); ?>
						<?php $wp_query = new WP_Query( $args ); ?>
						<!-- start loop -->
						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<!-- increase count -->
						<?php $c++; ?>

						<?php if ($c == 1) {  //if first post
							$col_class = 'first'; //set column class to first
							echo '<div class="twelvecol first clearfix">'; //start row wrapper
						}
							elseif ($c == 3) { //if 3rd/last post
								$col_class = 'last'; //set column class to last
							}
							else { //if 2nd/middle post
								$col_class = ''; //set column class to nothing
							}
						?>

						<!-- start column wrapper -->
						<div class="fourcol <?php echo $col_class ?> clearfix"> 

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							
							    <header class="article-header">

							    	<!-- get post date & time -->
									<p class="byline vcard"><?php _e('On', 'bonestheme'); ?> <time class="updated" datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time>,</p>

									<!-- get post title -->
								    <h2 class="h3"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

							    </header> <!-- end article header -->
						
							    <section class="entry-content clearfix">

							    	<!-- all the meta data you want to call goes here -->
							    	<p>
								    <?php 
										$seats = get_post_meta($post->ID, 'seats', true);
										// check if the custum field has a value
										if($seats != '') {
										  echo 'Seats Available: ' . $seats;
										}
									?>
									</p>
									<p>
								    <?php 
										$location = get_post_meta($post->ID, 'location', true);
										// check if the custum field has a value
										if($location != '') {
										  echo 'Location: ' . $location;
										}
									?>
									</p>
									<p>
								    <?php 
										$departure = get_post_meta($post->ID, 'departure', true);
										// check if the custum field has a value
										if($departure != '') {
										  echo 'Departure: ' . $departure;
										}
									?>
									</p>
									<p>
								    <?php 
										$return = get_post_meta($post->ID, 'return', true);
										// check if the custum field has a value
										if($return != '') {
										  echo 'Return: ' . $return;
										}
									?>
									</p>
									<p>
								    <?php 
										$phone = get_post_meta($post->ID, 'phone', true);
										// check if the custum field has a value
										if($phone != '') {
										  echo 'Phone: ' . $phone;
										}
									?>
									</p>
									<p>
								    <?php 
										$email = get_post_meta($post->ID, 'email', true);
										// check if the custum field has a value
										if($email != '') {
										  echo 'Email: ' . $email;
										}
									?>
									</p>
									<p>
								    <?php 
										$additionalinfo = get_post_meta($post->ID, 'additionalinfo', true);
										// check if the custum field has a value
										if($additionalinfo != '') {
										  echo 'Additional Info: ' . $additionalinfo;
										}
									?>
									</p>
									<!-- end meta data -->
						
							    </section> <!-- end article section -->
							
							    <footer class="article-footer">

							    	<!-- display taxonomies(custom categories) and setup the Delete link -->
								    <p class="byline vcard"><?php _e('Filed under', 'bonestheme'); ?> <?php the_taxonomies(', '); ?> <a class="delete-link" href="#" title="Delete Rideshare Post">Delete</a></p>

								    <!-- form to delete Rideshare posts -->
								    <div class="delete-form">
								    	<!-- insert Rideshare Edit form -->
								    	<?php echo do_shortcode('[contact-form-7 id="187" title="Rideshare Edit"]'); ?>
								    </div>

							    </footer> <!-- end article footer -->

							    <hr />
						
						    </article> <!-- end article -->

						</div> <!-- end column wrapper -->

						<?php if ($c == 3) { //if 3rd or last post
							echo '</div>'; //end row wrapper
							$c = 0; //reset counter
						} ?>

						<?php endwhile; ?>

					<div class="twelvecol first clearfix">
						<?php if (function_exists('bones_page_navi')) { // if experimental feature is active ?>
						
						        <?php bones_page_navi(); // use the page navi function ?>
						
					        <?php } else { // if it is disabled, display regular wp prev & next links ?>
						        <nav class="wp-prev-next">
							        <ul class="clearfix">
								        <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', 'bonestheme')) ?></li>
								        <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', 'bonestheme')) ?></li>
							        </ul>
						        </nav>
					        <?php } ?>
					</div>

						<?php wp_reset_query(); ?>

					</div>
			
					<!-- this calls the normal page content where the shorcode for the Rideshare Form is -->
					<!-- you could also just insert a "<?php //echo do_shortcode('[]'); ?>" wherever you want -->
				    <div id="form" class="twelvecol first clearfix">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						    <header class="article-header">
																				
						    </header> <!-- end article header -->
					
						    <section class="entry-content">
							    <?php the_content(); ?>
						    </section> <!-- end article section -->
						
						    <footer class="article-footer">
										
						    </footer> <!-- end article footer -->
					
					    </article> <!-- end article -->
					
					    <?php endwhile; ?>	
					
					    <?php else : ?>
					
        					<article id="post-not-found" class="hentry clearfix">
        					    <header class="article-header">
        						    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
        						</header>
        					    <section class="entry-content">
        						    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
        						</section>
        						<footer class="article-footer">
        						    <p><?php _e("This is the error message in the page-custom.php template.", "bonestheme"); ?></p>
        						</footer>
        					</article>
					
					    <?php endif; ?>
			
				    </div> <!-- end #form -->
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>