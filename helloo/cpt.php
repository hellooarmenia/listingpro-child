<?php

function cptui_register_my_cpts()
{

    /**
     * Post Type: Գովազդներ.
     */

    $labels = [
        "name" => __("Գովազդներ", "listingpro"),
        "singular_name" => __("Գովազդ", "listingpro"),
        "all_items" => __("Բոլոր գովազդները", "listingpro"),
    ];

    $args = [
        "label" => __("Գովազդներ", "listingpro"),
        "labels" => $labels,
        "description" => "",
        "public" => false,
        "publicly_queryable" => false,
        "show_ui" => true,
        "show_in_rest" => false,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => true,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => ["slug" => "helloo_ads", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "custom-fields", "editor", "thumbnail"],
    ];

    register_post_type("helloo_ads", $args);
}

add_action('init', 'cptui_register_my_cpts');

function cptui_register_my_taxes()
{

    /**
     * Taxonomy: Groups.
     */

    $labels = [
        "name" => __("Groups", "listingpro"),
        "singular_name" => __("Group", "listingpro"),
    ];

    $args = [
        "label" => __("Groups", "listingpro"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'group', 'with_front' => true,],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "rest_base" => "group",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
    ];
    register_taxonomy("group", ["listing"], $args);

    /**
     * Taxonomy: Տեսակներ.
     */

    $labels = [
        "name" => __("Տեսակներ", "listingpro"),
        "singular_name" => __("Տեսակ", "listingpro"),
    ];

    $args = [
        "label" => __("Տեսակներ", "listingpro"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'helloo_ad_types', 'with_front' => true,],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "rest_base" => "helloo_ad_types",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
    ];
    register_taxonomy("helloo_ad_types", ["helloo_ads"], $args);
}

add_action('init', 'cptui_register_my_taxes');
