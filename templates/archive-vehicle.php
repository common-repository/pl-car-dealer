<?php

/* Template Name: archive vehicle */

get_header();

cde_scripts_styles(); /* include the necessary scripts and styles */
?>

<div class="cde_container">
<?php $style_width = '';

    ?>
    <div class="cde_row">
    <?php
  $order = "&order=ASC";
   $cde_select = "";
   $cde_ord="";

  if (isset($_POST['cde_select'] )) {
    $order = "&orderby=_cde_".$_POST['cde_select'];
    $cde_select = $_POST['cde_select'];
  }



  if (isset($_POST['cde_order'])) { 
    $order .= "&order=".$_POST['cde_order']; 
    $cde_ord=$_POST['cde_order'];
  }

?>
 


<form method="post" id="order">
  <?php _e( 'Sort vehicles by:','cde_pgl' ) ?>
  <select name="cde_select" onchange='this.form.submit()'>
    <option value="price"<?php selected( $cde_select,'price', 1 ); ?>><?php _e( 'price','cde_pgl' ) ?></option>
    <option value="year"<?php selected( $cde_select,'year', 1 ); ?>><?php _e( 'year','cde_pgl' ) ?></option>
    <option value="mileage"<?php selected( $cde_select,'mileage', 1 ); ?>><?php _e( 'mileage','cde_pgl' ) ?></option>

  </select>

  <select name="cde_order" onchange='this.form.submit()'>
    <option value="ASC"<?php selected( $cde_ord,'ASC', 1 ); ?>><?php _e( 'ASC','cde_pgl' ) ?></option>
    <option value="DESC"<?php selected( $cde_ord,'DESC', 1 ); ?>><?php _e( 'DESC','cde_pgl' ) ?></option>
  

  </select>
</form>
 

      <!-- navigation holder -->
      <div class="holder">
      </div>

<div id="cde_jpag">
        
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
          <div class="cde_col-sm-4 cde_col-md-4 ">
          <div class="cde_thumbnail cde_grid">
              <?php if ( has_post_thumbnail()) { 
//Get the Thumbnail URL
                $src_orig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
                $src_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'cde_size', false, '' );

                ?>
                <figure>
                  <a href="<?php echo $src_orig[0]; ?>" rel="gallery" class="thumb"><img src="<?php echo $src_thumb[0]; ?>" /></a>
                  <?php } else { ?>
                  <div style="background:url(<?php echo plugins_url( '/car-dealer/images/pattern-1.png' ) ?>);width:<?php echo get_option('cde_thumb_size_w', '303'); ?>px;height:<?php echo get_option('cde_thumb_size_h', '210'); ?>px" title="<?php _e( 'No Image', 'cde_pgl' ); ?>"></div>
                  <?php } ?>
                  <figcaption>
                    <h4><?php 
                $prefix = '_cde_';
                     $mileage = get_post_meta( get_the_ID(), $prefix.'mileage', true );
                     $year = get_post_meta( get_the_ID(), $prefix.'year', true );
                     $price = get_post_meta( get_the_ID(), $prefix.'price', true );
                    if ($price!='0,00') echo $cde_mon_sym." ".$price;
                  ?></h4><br />
                    <span><?php printf( __( '<strong>Year: </strong> %s', "cde_pgl" ), $year );
                    echo "<br>";
                      printf( __( '<strong>'.$cde_mil_abb.': </strong> %s', "cde_pgl" ), $mileage )  ?></span>
                    <a href="<?php the_permalink(); ?>"><?php _e("Take a look", "cde_pgl") ?></a>
                  </figcaption>
                </figure>
                <div class="caption">
                  <h3>        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                  <p><?php the_excerpt(); ?></p>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
</div>
        </div>




      <?php else: ?>

        <article id="post-0" class="post no-results not-found">
          <header class="entry-header">
           <h1 class="entry-title"><?php _e( 'Nothing Found', 'cde_pgl' ); ?></h1>
         </header>

         <div class="entry-content">
           <p><?php _e( 'Apologies, but no results were found. ', 'cde_pgl' ); ?></p>
           <?php get_search_form(); ?>
         </div><!-- .entry-content -->
       </article><!-- #post-0 -->

     <?php endif; ?>


   </div>


 <?php get_footer(); ?>