<?php if( have_rows('branches') ): ?>
    <h4 class="lp-detail-section-title"><?php echo esc_html__( 'Branches', 'listingpro' ); ?></h4>
    <div class="lp-branches-view">

        <div class="lp-branches-list col-md-4 nopadding">
            <?php while ( have_rows('branches') ) : the_row();

                $location = get_sub_field('location');

                $logo_id = get_sub_field('logo') ? get_sub_field('logo') : get_field('branches_default_logo');

                $logo = wp_get_attachment_image_src($logo_id, 'thumbnail', true );

                ?>
                <div class="lp-marker-label">
                    <div class="lp-marker-label-logo">
                        <img width="30px" src="<?php echo $logo[0];?>"/>
                    </div>

                    <h4><?php the_sub_field('title'); ?></h4>
                    <p class="address"><?php echo $location['address']; ?></p>

                </div>
            <?php endwhile; ?>
        </div>
        <div class="branches-map col-md-8 nopadding">
            <?php
            $default_marker_icon_id = get_field('branches_marker_default_icon');

            while ( have_rows('branches') ) : the_row();

                $location = get_sub_field('location');
                $listing_marker_icon_id = get_sub_field('marker_icon');
                $marker_icon_src = "";
                if($listing_marker_icon_id){
                    $marker_icon_id = $marker_icon_id;
                } elseif($default_marker_icon_id){
                    $marker_icon_id = $default_marker_icon_id;
                }
                if($marker_icon_id){
                    $marker_icon_src = wp_get_attachment_image_src($marker_icon_id, 'thumbnail', true );
                }
                ?>
                <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-icon="<?php echo $marker_icon_src[0];?>">
                    <h4><?php the_sub_field('title'); ?></h4>
                    <p class="address"><?php echo $location['address']; ?></p>
                    <p><?php the_sub_field('description'); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

    </div>
<?php endif; ?>

<script type="text/javascript">
    (function($) {



        function new_map( $el ) {
            // var
            var $markers = $el.find('.marker');


            // vars
            var args = {
                zoom		: 16,
                center		: new google.maps.LatLng(0, 0),
                mapTypeId	: google.maps.MapTypeId.ROADMAP
            };


            // create map
            var map = new google.maps.Map( $el[0], args);


            // add a markers reference
            map.markers = [];


            // add markers
            $markers.each(function(){

                add_marker( $(this), map );

            });


            // center map
            center_map( map );


            // return
            return map;

        }

        function add_marker( $marker, map ) {

            // var
            var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

            var icon = $marker.attr('data-icon');

            // create marker
            var marker = new google.maps.Marker({
                position	: latlng,
                map			: map,
                icon		: icon
            });

            // add to array
            map.markers.push( marker );

            // if marker contains HTML, add it to an infoWindow
            if( $marker.html() )
            {

                // create info window
                var infowindow = new google.maps.InfoWindow({
                    content		: $marker.html()
                });

                // show info window when marker is clicked
                google.maps.event.addListener(marker, 'click', function() {

                    infowindow.open( map, marker );
                });
            }

        }

        function center_map( map ) {

            // vars
            var bounds = new google.maps.LatLngBounds();

            // loop through all markers and create bounds
            $.each( map.markers, function( i, marker ){

                var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

                bounds.extend( latlng );

            });

            // only 1 marker?
            if( map.markers.length == 1 )
            {
                // set center of map
                map.setCenter( bounds.getCenter() );
                map.setZoom( 16 );
            }
            else
            {
                // fit to bounds
                map.fitBounds( bounds );
            }

        }

        /*
        *  document ready
        *
        *  This function will render each map when the document is ready (page has loaded)
        *
        *  @type	function
        *  @date	8/11/2013
        *  @since	5.0.0
        *
        *  @param	n/a
        *  @return	n/a
        */
// global var
        var map = null;

        $(document).ready(function(){

            $('.branches-map').each(function(){

                // create map
                map = new_map( $(this) );
                $('.lp-marker-label').each(function(i){
                    $(this).click(function(){
                        google.maps.event.trigger(map.markers[i], 'click');
                    })
                })
            });

        });

    })(jQuery);
</script>