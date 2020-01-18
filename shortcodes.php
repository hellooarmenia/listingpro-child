<?php

add_shortcode('lp_categories_list', 'lp_categories_list');

function lp_categories_list($atts)
{

    $atts = shortcode_atts(array(
        'ids' => ''
    ), $atts);

    $ids = explode(",", $atts['ids']);

    $html = '<div class="lp_categories_list col-md-12">';

    foreach ($ids as $id) {

        $term  = get_term_by('id', $id, 'listing-category');
        $image = listingpro_get_term_meta($term->term_id, 'lp_category_image');
        $url   = get_term_link($term);
        $html  .= sprintf(
            '<div onclick="%s" class="col-lg-3 col-md-3 col-sm-4 col-xs-12"><div class="col-xs-4"><a href="%s"><img src="%s"></a></div><div class="col-xs-8"><a href="%s">%s</a></div></div>',
            "window.location = this.querySelector('a').getAttribute('href');",
            $url, $image, $url, $term->name);

    }

    $html .= "</div>";

    return $html;
}