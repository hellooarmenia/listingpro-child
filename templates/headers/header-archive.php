<?php
global $listingpro_options;

$lparchiveBGCLass = '';
$emptyFIlter = '';

$searchfilter = $listingpro_options['enable_search_filter'];
if( $searchfilter != '1' ){
	$emptyFIlter = 'empty-filter';
}


$meteKey_cat = get_term_meta($term_id, 'lp_category_banner', true );
$meteKey_loc = get_term_meta($term_id, 'lp_location_image', true );

if(isset($meteKey_cat) && !empty($meteKey_cat)){
    $lp_archive_bg= $meteKey_cat;
}elseif (isset($meteKey_loc) && !empty($meteKey_loc)) {
    $lp_archive_bg =  $meteKey_loc;
}
elseif( isset($listingpro_options['lp_archive_bg']['url']) && !empty( $listingpro_options['lp_archive_bg']['url'] ) ) {
    $lp_archive_bg = $listingpro_options['lp_archive_bg']['url'];
}else{
    $lp_archive_bg  =   get_template_directory_uri().'/assets/images/home-banner.jpg';
}

if( isset( $lp_archive_bg ) && !empty( $lp_archive_bg ) )
{
    $lparchiveBGCLass = 'colorWhite';
}
?>
<div class="lp-archive-banner <?php echo $emptyFIlter; ?>" style="background-image: url(<?php echo $lp_archive_bg; ?>);background-size:
cover; background-position: center; ">
	<?php if(!empty($lp_archive_bg)){ ?>
    <div class="lp-header-overlay"></div>
	<?php } ?>
</div>
