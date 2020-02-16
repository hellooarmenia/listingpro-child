<?php

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

include "helloo/cpt.php";
include "helloo/ads.php";

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style('listingpr-parent-style', get_template_directory_uri() . '/style.css');
}

include "shortcodes.php";

function create_post_type()
{
    register_post_type(
        'partner_reviews',
        array(
            'labels'      => array(
                'name'          => __('Partner Reviews'),
                'singular_name' => __('Partner Review')
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'editor', 'thumbnail', 'custom-fields')

        )
    );
}

add_action('init', 'create_post_type');


function my_acf_google_map_api($api)
{
    $api['key'] = 'AIzaSyAIaUmTbL4f-4mEpSdQF_E7Owfk4vb2myo';

    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

add_filter(
    'the_content',
    function ($content) {
        if (is_single() && get_post_type() == 'listing') {
            $field_names = [
                'legal_name',
                'owner_name',
                'company_type',
                'owned_type',
                'workers_count',
                'foundation_date',
                'postal_code'
            ];


            foreach ($field_names as $field) {
                $field = get_field_object($field);

                if ($field) {
                    $value = $field['value'];

                    if (is_array($value)) {
                        $value = $value['label'];
                    }

                    if ($value) {
                        $content .= "<p>" . $field['label'] . ' - ' . $value . "</p>";
                    }
                }
            }
        }

        return $content;
    }
);

add_filter(
    'lp_branches_title',
    function ($title) {
        return "Մասնաճյուղեր";
    }
);


add_filter(
    'lp_branches_view_on_map_link_text',
    function ($title) {
        return "Բացել քարտեզը";
    }
);

add_filter('wp_nav_menu_items', 'do_shortcode');

add_action(
    'wp_footer',
    function () {
        ?>

        <h3 style="text-align: center;margin-top:20px;margin-bottom:20px"><span class="_5yl5" style="color: #999999;">ԿԱՅՔԸ ՆԱԽՆԱԿԱՆ ԳՈՐԾԱՐԿՄԱՆ ՓՈՒԼՈՒՄ Է</span>
        </h3>

        <?php
    }
);

global $helloo_labels;
$helloo_labels = [
    'Search'                      => 'Փնտրել',
    'Where'                       => 'Որտեղ',
    'What'                        => 'Ինչ',
    'Be the first to review'      => 'Եղիր առաջինը և գրիր քո կարծիքը',
    'Contact with business owner' => 'Կապվել կազմակերպության հետ',
    'Name:'                       => 'Անուն։',
    'Email:'                      => 'Էլ․փոստ։',
    'Phone'                       => 'Հեռախոս։',
    'Message:'                    => 'Նամակ։',
    'I Agree'                     => 'Ես համաձայն եմ',
    'Send'                        => 'Ուղարկել',
    'Write a review'              => 'Գրել կարծիք',
    'Your Rating'                 => 'Ձեր գնահատականը',
    'Select Images'               => 'Ընտրել նկարներ',
    'Browse'                      => 'Դիտարկել',
    'Save'                        => 'Պահպանել',
    'Share'                       => 'Կիսվել'
];

add_filter(
    'gettext',
    function ($translation, $text) {
        global $helloo_labels;
        return $helloo_labels[$text] ?? $translation;
    },
    10,
    2
);