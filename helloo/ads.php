<?php


add_action('init','add_ads_in_lst');

function add_ads_in_lst()
{
    $ads = get_posts(array(
        'post_type' => 'helloo_ads',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'taxonomy-name',
                'field' => 'term_id',
                'terms' => 1, /// Where term_id of Term 1 is "1".
                'include_children' => false
            )
        )
    ));
}