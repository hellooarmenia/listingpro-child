<div class="lp-listing-top-header-slider">
        
<?php
	$header_images = get_field('header_images');
	$header_images_ids = array();  
	foreach($header_images as $header_image){
       $header_images_ids[] = $header_image['id'];
    }
    $ids = implode(',', $header_images_ids);
    echo do_shortcode('[rev_slider alias="listing_header"][gallery ids="'.$ids.'"][/rev_slider]');
?>
</div>