<?php

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

include "helloo/cpt.php";
include "helloo/ads.php";
include "helloo/i18n.php";

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style('listingpr-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('listingpr-parent-script', get_stylesheet_directory_uri() . '/assets/script.js', [], '0.12', true);
}


add_action('wp_head', function () {
    ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158944313-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-158944313-1');
    </script>
    <?php
});
include "shortcodes.php";

function create_post_type()
{
    register_post_type(
        'partner_reviews',
        array(
            'labels' => array(
                'name' => __('Partner Reviews'),
                'singular_name' => __('Partner Review')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')

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
    'Search' => 'Փնտրել',
    "Near Me" => "Իմ Մոտակայքում",
    "Click To GET" => "Սեղմեք դիտարկելու համար",
    "Best Match" => "Լավագույն արդյունքները",
    "Click To See Your Best Match" => "Սեղմեք Տեսնելու Համար Լավագույն արդյունքները",
    'Sort By' => 'Դասավորել Ըստ։',
    'Most Reviewed' => 'Ամենաշատ Քննարկումների',
    'Most Viewed' => 'Ամենաշատ Դիտումների',
    'Highest Rated' => 'Բարձր Գնահատականների',
    'Add a Review ' => 'Ավելացնել կարծիք',
    'Where' => 'Որտեղ',
    'Title' => 'Վերնագիր',
    'Review' => 'Կարծիք',
    'Submit Review' => 'Հրապարակել Կարծիքը',
    'Example: It was an awesome experience to be there' => 'Օրինակ։ Հրաշալի ծառայություններ են մատուցում հաճախորդներին',
    'Your review recommended to be at least 140 characters long :)' => 'Ցանկալի է որ Ձեր կարծիքը պարունակի ոչ պակաս քան 140 սիմվոլ․',
    'Signup & Submit Review ' => 'Մուտք գործել և մեկնաբանել',
    'No Results' => 'Որոնման արդյունքներ չեն գտնվել',
    'Visit Here' => 'Գնալ առաջին էջ',
    'Sorry! You have not selected any list as favorite.' => 'Դուք չունեք ոչ մի նախընտրելի կազմակերպություն․',
    'Go and select lists as favorite' => 'Ընտրել կազմակերպթյուններ որպես նախընտրելի',
    'More results for ' => 'Որոնման արդյունքներ։ ',
    'What' => 'Ինչ',
    'Be the first to review' => 'Եղիր առաջինը և գրիր քո կարծիքը',
    'Contact with business owner' => 'Առաջարկությունների և անճշտությունների համար կապվեք մեզ հետ',
    'Name:' => 'Անուն։',
    'Expand'=>'Բացել',
    'Sign In'=>'Մուտք Գործել',
    'Sign in'=>'Մուտք Գործել',
    'Not a member? Sign up'=>'Մասնակից չե՞ք, գրանցվել հիմա․',
    'Already have an account? Sign in'=>'Մասնակից ե՞ք, Մուտք գործեք համակարգ․',
    'Forgot Password'=>'Մոռացել եմ գաղտնաբառը',
    'Username *'=>'Օգտատիրոջ անվանումը *',
    'Password will be e-mailed to you.'=>'Գաղտնաբառը կստանաք նամակի միջոցով։',
    'Register'=>'Գրանցվել',
    'Username or Email Address *'=>'Օգտատիրոջ անվանումը կամ Էլ․Փոստը *',
    'Password *'=>'Գաղտնաբառ *',
    'Keep me signed in'=>'Պահել ինձ համակարգում',
    'Sign Up'=>'Գրանցվել',
    'Email Address *'=>'Էլեկտրոնային փոստ *',
    'Email:' => 'Էլ․փոստ։',
    'Phone' => 'Հեռախոս։',
    'Message:' => 'Նամակ։',
    'I Agree' => 'Ես համաձայն եմ',
    'Send' => 'Ուղարկել',
    'Write a review' => 'Գրել կարծիք',
    'Your Rating' => 'Ձեր գնահատականը',
    'Select Images' => 'Ընտրել նկարներ',
    'Browse' => 'Դիտարկել',
    'Save' => 'Պահպանել',
    'Share' => 'Կիսվել',
    'Get Directions' => 'Նշել Ուղին',
    'Day Off!' => 'Ավարտված աշխատանքային օր',
    'Today' => 'Այսօր',
    'Additional Details' => 'Հավելյալ Տեղեկություններ',
    'Own or work here?' => 'Սեփականատե՞րն եք։',
    'Claim Now!' => "Հայտնել մեզ",
    'User Name' => "Օգտատերի անունը",
    'Email' => "Էլ․ Փոստ",
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