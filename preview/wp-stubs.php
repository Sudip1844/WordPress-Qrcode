<?php
define('THEME_DIR', __DIR__ . '/theme');
define('THEME_URI', '/theme');

function language_attributes() {
    echo 'lang="en-US"';
}

function bloginfo($show) {
    $info = array(
        'name' => 'My QRcode Tool',
        'description' => 'Free QR Code Generator',
        'charset' => 'UTF-8',
        'url' => '',
        'stylesheet_url' => THEME_URI . '/style.css',
        'template_url' => THEME_URI,
    );
    echo isset($info[$show]) ? $info[$show] : '';
}

function get_bloginfo($show) {
    ob_start();
    bloginfo($show);
    return ob_get_clean();
}

function get_template_directory_uri() {
    return THEME_URI;
}

function get_stylesheet_directory_uri() {
    return THEME_URI;
}

function get_template_directory() {
    return THEME_DIR;
}

function get_theme_mod($name, $default = '') {
    $mods = array(
        'gtm_id' => 'GTM-MJRZ7GJ6',
        'benefits_title' => 'Benefits',
        'use_cases_title' => 'Use Cases',
        'use_cases_text' => 'Perfect for businesses, events, restaurants, education, marketing campaigns, product packaging, social media, business cards, menus, contact information sharing, and promotional materials.',
        'benefits_list' => array(
            'Generate professional QR codes in seconds - no design skills needed',
            'Customize colors, add logos, and choose from multiple frame styles',
            'Support for 15+ QR code types: URLs, emails, WiFi, vCard, and more',
            'High-quality export options - PNG, SVG, PDF with custom sizes',
            'Track QR code scans and analytics with URL shorteners',
            'Completely free - no registration or watermarks required'
        )
    );
    return isset($mods[$name]) ? $mods[$name] : $default;
}

function esc_html($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function esc_attr($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function esc_js($text) {
    return addslashes($text);
}

function esc_url($url) {
    return filter_var($url, FILTER_SANITIZE_URL);
}

function wp_head() {
    echo '<link rel="stylesheet" href="' . THEME_URI . '/assets/css/main.css" />' . "\n";
    echo '<link rel="stylesheet" href="' . THEME_URI . '/style.css" />' . "\n";
}

function wp_footer() {
    echo '<script type="module" defer src="' . THEME_URI . '/assets/js/vendor-CMjGaeKf.js"></script>' . "\n";
    echo '<script type="module" defer src="' . THEME_URI . '/assets/js/index-B65U0c70.js"></script>' . "\n";
}

function wp_body_open() {
}

function body_class($class = '') {
    echo 'class="home front-page ' . esc_attr($class) . '"';
}

function have_posts() {
    static $called = false;
    if (!$called) {
        $called = true;
        return true;
    }
    return false;
}

function the_post() {
}

function the_content() {
}

function get_header($name = null) {
    include THEME_DIR . '/header.php';
}

function get_footer($name = null) {
    include THEME_DIR . '/footer.php';
}

function get_sidebar($name = null) {
}

function is_front_page() {
    return true;
}

function is_home() {
    return true;
}

function home_url($path = '') {
    return '/' . ltrim($path, '/');
}

function site_url($path = '') {
    return '/' . ltrim($path, '/');
}

function wp_enqueue_style() {}
function wp_enqueue_script() {}
function wp_register_style() {}
function wp_register_script() {}
function add_action() {}
function add_filter() {}
function do_action() {}
function apply_filters($tag, $value) { return $value; }

function myqrcodetool_get_random_qr_pages($count = 4) {
    $all_qr_pages = array(
        'url-to-qr' => 'URL to QR Code',
        'text-to-qr' => 'Text to QR Code',
        'wifi-to-qr' => 'WiFi QR Code',
        'whatsapp-to-qr' => 'WhatsApp QR Code',
        'email-to-qr' => 'Email QR Code',
        'phone-to-qr' => 'Phone QR Code',
        'sms-to-qr' => 'SMS QR Code',
        'contact-to-qr' => 'Contact QR Code',
        'v-card-to-qr' => 'vCard QR Code',
        'event-to-qr' => 'Event QR Code',
        'image-to-qr' => 'Image QR Code',
        'paypal-to-qr' => 'PayPal QR Code',
        'zoom-to-qr' => 'Zoom QR Code',
        'scanner' => 'QR Code Scanner',
    );
    
    $keys = array_keys($all_qr_pages);
    shuffle($keys);
    $random_keys = array_slice($keys, 0, $count);
    
    $result = array();
    foreach ($random_keys as $key) {
        $result[$key] = $all_qr_pages[$key];
    }
    
    return $result;
}
