<?php
 /*Template Name: single-vehicle
 */
 
 get_header(); 
 cde_scripts_styles();



        $prefix = '_cde_';

 while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <div class="cde_container">
                        <div class="row">
                            <!-- Display featured image in right-aligned floating div -->
                            <div class="cde_col-sm-5">
                                <div class="cde_bigim"><?php the_post_thumbnail( 'large' ); ?></div>
                            </div>
                            <div class="cde_col-sm-7">
                                <!-- Display Title and Author Name -->
                                <h1><?php the_title(); ?></h1><br />
                                <strong><?php _e( 'Make', 'cde_pgl' ) ?>: </strong>
                                <?php 
                                $mk=get_post_meta( get_the_ID(), $prefix.'make', true );
                                $mk = wp_get_post_terms(get_the_ID(), 'cde_category_makes', array("fields" => "names"));
                                echo esc_html( $mk[0] ); ?>
                                <br /><br />

                                <strong><?php _e( 'Model', 'cde_pgl' ) ?>: </strong>
                                <?php echo esc_html( get_post_meta( get_the_ID(), $prefix.'model', true ) ); ?>
                                <br /><br />


                                <strong><?php _e( 'Mileage', 'cde_pgl' ) ?>: </strong>
                                <?php echo esc_html( $cde_mil_abb.' '.get_post_meta( get_the_ID(), $prefix.'mileage', true ) ); ?>
                                <br /><br />
                                <?php $price=get_post_meta( get_the_ID(), $prefix.'price', true );
                               if ($price!='0,00') { ?>
                                  <strong><?php _e( 'Price', 'cde_pgl' ) ?>: </strong>
                             
                               <?php echo esc_html($cde_mon_sym.' '.$price ); ?>
                                <br />   <br />
                                <?php   } ?>
                            </div>    
                        </div><br /><br />
                                     <!-- Display movie review contents -->
              <div class="entry-content"><?php the_content(); ?></div>

                        <?php
                        $check_imgs = get_post_meta( get_the_ID(), $prefix.'photos', true);

                        if( !empty( $check_imgs) ) {
                            //if(get_post_meta($post->ID, $prefix.'photos', true) ){
                           ?>
                           <div class="row">
                                <div class="cde_col-sm-12"><br /><br /><strong><?php _e('Photos',"cde_pgl") ?></strong><hr></div>

                            <?php
                            $files = get_post_meta( get_the_ID(),$prefix.'photos', 1 );


                            foreach ( (array) $files as $attachment_id => $attachment_url ) {
                                $url = $attachment_url; ?>
                                <div class="cde_col-sm-3">
                                  <div class="cde_thumbnail">
                            <a href="<?php echo $url ?>" rel="gallery" class="thumb"><?php echo wp_get_attachment_image( $attachment_id, 'cde_size' ) ?></a>
  
                              </div>
                          </div>  
                          <?php
                                }
                                 
                           } ?>
                     </div>
                  </div>
              </header>

 
          </article>

      <?php endwhile; ?>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>