<?php

add_filter(
    'get_post_metadata',
    static function ($val, $id, $meta_key) {
        if ($meta_key === 'helloo_lp_listing_email') {
            $data = get_post_meta($id, 'lp_listingpro_options', true);
            $val = isset($data['email']) ? $data['email'] : get_bloginfo('admin_email');
        }
        return $val;
    },
    10,
    3
);
