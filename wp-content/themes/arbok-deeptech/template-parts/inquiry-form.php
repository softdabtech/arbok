<?php $type = $args['type'] ?? 'General inquiry'; $requested_subject = sanitize_text_field($_GET['subject'] ?? ''); ?>
<?php if (isset($_GET['contact']) && $_GET['contact'] === 'received') : ?><div class="form-success" role="status"><strong>Inquiry received.</strong><span>This local test site recorded the interaction. Configure SMTP before production email delivery.</span></div><?php endif; ?>
<?php if (isset($_GET['contact']) && $_GET['contact'] === 'error') : ?><div class="form-error" role="alert"><strong>Unable to submit.</strong><span>Please check the required fields and try again.</span></div><?php endif; ?>
<form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="arbok_contact"><?php wp_nonce_field('arbok_contact', 'arbok_contact_nonce'); ?>
    <?php if (function_exists('arbok_contact_spam_fields')) { arbok_contact_spam_fields(); } ?>
    <input type="hidden" name="inquiry_context" value="<?php echo esc_attr($type); ?>">
    <label class="form-honeypot" aria-hidden="true"><span>Website</span><input type="text" name="website" tabindex="-1" autocomplete="off"></label>
    <label><span>Name</span><input type="text" name="name" autocomplete="name" required></label>
    <label><span>Work email</span><input type="email" name="email" autocomplete="email" required></label>
    <label><span>Organization</span><input type="text" name="organization" autocomplete="organization"></label>
    <label><span>Inquiry type</span><select name="subject"><option <?php selected($requested_subject, 'technology'); ?>>Technology partnership</option><option <?php selected($requested_subject, 'pilot'); ?>>Pilot project</option><option <?php selected($requested_subject, 'licensing'); ?>>Licensing</option><option>Government / humanitarian program</option><option>Technical inquiry</option><option>Media / other</option></select></label>
    <label class="full"><span>Message</span><textarea name="message" rows="6" placeholder="Briefly describe your organization, application, location and technical need." required></textarea></label>
    <label class="full consent"><input type="checkbox" name="consent" value="1" required><span>I agree that ARBOK may use this information to respond to my inquiry. See the <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">privacy policy</a>.</span></label>
    <div class="full form-footer"><button class="button button-dark" type="submit">Send inquiry</button></div>
</form>
