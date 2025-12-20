<?php
/**
 * Dynamic XML Sitemap Generator
 * 
 * @package MyQrcodeTool
 */

// Load WordPress
require_once(dirname(dirname(__FILE__)) . '/wp-load.php');

// Set header to XML
header('Content-Type: application/xml; charset=UTF-8');
header('Cache-Control: public, max-age=3600');

// Start XML
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
echo '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";

// Homepage
$homepage = home_url('/');
echo '  <url>' . "\n";
echo '    <loc>' . esc_url($homepage) . '</loc>' . "\n";
echo '    <lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
echo '    <changefreq>weekly</changefreq>' . "\n";
echo '    <priority>1.0</priority>' . "\n";
echo '  </url>' . "\n";

// Get all QR pages
$qr_pages = get_posts(array(
    'post_type'      => 'page',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'modified',
    'order'          => 'DESC'
));

foreach ($qr_pages as $page) {
    echo '  <url>' . "\n";
    echo '    <loc>' . esc_url(get_permalink($page->ID)) . '</loc>' . "\n";
    echo '    <lastmod>' . get_the_modified_time('Y-m-d', $page->ID) . '</lastmod>' . "\n";
    echo '    <changefreq>monthly</changefreq>' . "\n";
    
    // Add priority based on page slug
    $slug = $page->post_name;
    if (in_array($slug, array('url-to-qr', 'text-to-qr', 'wifi-to-qr'))) {
        echo '    <priority>0.9</priority>' . "\n";
    } elseif (in_array($slug, array('faq', 'scanner'))) {
        echo '    <priority>0.8</priority>' . "\n";
    } else {
        echo '    <priority>0.7</priority>' . "\n";
    }
    
    echo '  </url>' . "\n";
}

echo '</urlset>';
die;
