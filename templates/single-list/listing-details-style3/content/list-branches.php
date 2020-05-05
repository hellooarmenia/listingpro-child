<?php if (have_rows('branches')): ?>

    <?php
    $branches_title = apply_filters('lp_branches_title', __('Branches', 'listingpro'));
    $view_on_map_title = apply_filters('lp_branches_view_on_map_link_text', __('View on map', 'listingpro'));

    ?>

    <h4 class="lp-detail-section-title"><?php echo $branches_title; ?></h4>

    <div class="lp-branches-link-view">

        <?php while (have_rows('branches')) : the_row();

            $location = get_sub_field('location');

            $description = get_sub_field('description');

            $logo_id = get_sub_field('logo') ? get_sub_field('logo') : get_field('branches_default_logo');

            $logo = wp_get_attachment_image_src($logo_id, 'thumbnail', true);

            $url = sprintf('https://www.google.com/maps?q=%s,%s', $location['lat'], $location['lng']);
            $url = sprintf('https://www.google.com/maps/search/?api=1&query=%s', $location['address']);
            ?>
            <div class="lp-branches-link-view-row">

                <div class="lp-branches-link-view-image-container">
                    <img src="<?php echo $logo[0]; ?>"/>
                </div>

                <div class="lp-branches-link-view-content-container">

                    <h4><?php the_sub_field('title'); ?></h4>

                    <p class="description"><?php echo $description; ?></p>
                    
                    <p class="address"><?php echo $location['address']; ?></p>

                    <a target="_blank" href="<?php echo $url; ?>"><?php echo $view_on_map_title; ?></a>

                </div>

            </div>

        <?php endwhile; ?>

    </div>
<?php endif; ?>