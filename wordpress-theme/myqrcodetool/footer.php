    </div><!-- #root -->
    
    <!-- Dynamic Random QR Links Section -->
    <?php if (get_theme_mod('show_random_qr_links', true)) : ?>
    <div style="padding: 2rem 1rem; background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%); color: white;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem; text-align: center;">
                Explore More QR Code Generators
            </h2>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 0.75rem;">
                <?php
                $link_count = get_theme_mod('random_qr_links_count', 4);
                $random_pages = myqrcodetool_get_random_qr_pages($link_count);
                foreach ($random_pages as $slug => $title) :
                ?>
                <a href="<?php echo esc_url(home_url('/' . $slug . '/')); ?>" 
                   style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 9999px; color: white; text-decoration: none; font-size: 0.875rem; transition: background 0.2s;"
                   onmouseover="this.style.background='rgba(255,255,255,0.3)'" 
                   onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                    <?php echo esc_html($title); ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <div style="padding: 2rem 1rem; background: #f9fafb;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">
                <?php echo esc_html(get_theme_mod('benefits_title', 'Benefits')); ?>
            </h2>
            <ul style="list-style: disc; padding-left: 2rem;">
                <?php
                $benefits_text = get_theme_mod('footer_benefits_text', "Generate professional QR codes in seconds - no design skills needed\nCustomize colors, add logos, and choose from multiple frame styles\nSupport for 15+ QR code types: URLs, emails, WiFi, vCard, and more\nHigh-quality export options - PNG, SVG, PDF with custom sizes\nTrack QR code scans and analytics with URL shorteners\nCompletely free - no registration or watermarks required");
                
                $benefits = array_filter(array_map('trim', explode("\n", $benefits_text)));
                
                foreach ($benefits as $benefit) {
                    if (!empty($benefit)) {
                        echo '<li>' . esc_html($benefit) . '</li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    
    <div style="padding: 2rem 1rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">
                <?php echo esc_html(get_theme_mod('use_cases_title', 'Use Cases')); ?>
            </h2>
            <p><?php echo esc_html(get_theme_mod('use_cases_text', 'Perfect for businesses, events, restaurants, education, marketing campaigns, product packaging, social media, business cards, menus, contact information sharing, and promotional materials.')); ?></p>
        </div>
    </div>
    
    <!-- Footer Credits -->
    <footer style="padding: 1.5rem 1rem; background: #1f2937; color: #9ca3af; text-align: center; font-size: 0.875rem;">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Free QR Code Generator - No Registration Required.</p>
    </footer>
    
    <?php wp_footer(); ?>
</body>
</html>
