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


add_shortcode('lp_search_form', 'lp_search_form');

function lp_search_form($atts)
{
    global $listingpro_options;
    $search_placeholder     = $listingpro_options['search_placeholder'];
    $template_dir_url       = get_template_directory_uri();
    $more_results_for_label = __('More results for', 'listingpro');
    $value = isset($_GET['select']) ? $_GET['select'] : '';
    $html                   = <<<html
<form method="get" action="/">
<input autocomplete="off" type="text" 
    class="lp-suggested-search js-typeahead-input lp-search-input form-control ui-autocomplete-input dropdown_fields"
    name="select" placeholder="{$search_placeholder}"
    data-prev-value='0'
    value="{$value}"
    data-noresult="{$more_results_for_label}">
<input type="hidden" name="s" value="home">
<input type="hidden" name="post_type" value="listing">
<input type="submit" value="submit" style="position:absolute;visibility: hidden;">
</form>
html;


    return $html;
}

