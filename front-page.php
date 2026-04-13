<?php
get_header();

$smart_slider_shortcode = get_field('smart_slider_shortcode');
$show_smart_slider_section = get_field('show_smart_slider_section');

if ($show_smart_slider_section && !empty($smart_slider_shortcode)) {
    echo do_shortcode($smart_slider_shortcode);
}

// sekcije
get_template_part('template-parts/front-page/about-brand-section');
get_template_part('template-parts/front-page/newsletter-section');
get_template_part('template-parts/front-page/highlights-section');
get_template_part('template-parts/front-page/values-section');
get_template_part('template-parts/front-page/testimonials-section');
get_template_part('template-parts/front-page/blog-section');
get_template_part('template-parts/front-page/instagram-section');

get_footer();
