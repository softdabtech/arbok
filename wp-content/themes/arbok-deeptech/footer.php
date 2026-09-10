</main>
<footer class="site-footer">
    <div class="shell footer-grid">
        <div>
            <a class="brand brand-footer" href="<?php echo esc_url(home_url('/')); ?>"><?php arbok_logo('footer'); ?></a>
            <p>Restoring natural equilibrium through Zero Waste Discharge technologies for water, waste, energy, climate and materials systems.</p>
        </div>
        <div><h2>Explore</h2><ul class="footer-links"><li><a href="<?php echo esc_url(get_post_type_archive_link('technology')); ?>">Technologies</a></li><li><a href="<?php echo esc_url(home_url('/water-solutions/')); ?>">Water solutions</a></li><li><a href="<?php echo esc_url(home_url('/directions/')); ?>">Strategic directions</a></li><li><a href="<?php echo esc_url(get_post_type_archive_link('sector')); ?>">Detailed sectors</a></li><li><a href="<?php echo esc_url(get_post_type_archive_link('team_member')); ?>">Team</a></li><li><a href="<?php echo esc_url(get_post_type_archive_link('update')); ?>">Blog</a></li></ul></div>
        <div><h2>International contact</h2><p><a href="mailto:info@arbok.tech">info@arbok.tech</a><br><a href="tel:+19292351625">+1 (929) 235-1625</a><br>STRATEGIC RESEARCH INSTITUTE ARBOK<br>United States</p><a class="footer-contact-link" href="<?php echo esc_url(home_url('/contact/')); ?>">Contact ARBOK ↗</a></div>
    </div>
    <div class="shell footer-bottom"><span>© <?php echo esc_html(wp_date('Y')); ?> STRATEGIC RESEARCH INSTITUTE ARBOK</span><span><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy</a> · <a href="<?php echo esc_url(home_url('/terms-of-use/')); ?>">Terms</a></span></div>
</footer>
<button class="back-to-top" type="button" aria-label="Back to top">↑</button>
<?php wp_footer(); ?>
</body>
</html>
