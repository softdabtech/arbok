<?php
/**
 * Plugin Name: ARBOK Core
 * Description: Portfolio content types, taxonomies, metadata, and ACF definitions for the ARBOK local rebuild.
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

function arbok_register_content_types(): void {
    $types = [
        'technology' => ['Technologies', 'Technology', 'dashicons-lightbulb', 'technologies'],
        'sector' => ['Sectors', 'Sector', 'dashicons-networking', 'sectors'],
        'team_member' => ['Team Members', 'Team Member', 'dashicons-groups', 'team'],
        'investor_material' => ['Investor Materials', 'Investor Material', 'dashicons-media-document', 'investor-materials'],
        'update' => ['News / Updates', 'Update', 'dashicons-megaphone', 'updates'],
    ];

    foreach ($types as $slug => [$plural, $singular, $icon, $rewrite_slug]) {
        register_post_type($slug, [
            'labels' => ['name' => $plural, 'singular_name' => $singular],
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'menu_icon' => $icon,
            'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes'],
            'rewrite' => ['slug' => $rewrite_slug],
        ]);
    }
    register_post_type('arbok_inquiry', [
        'labels' => ['name' => 'Contact Inquiries', 'singular_name' => 'Contact Inquiry'],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-email-alt',
        'supports' => ['title', 'editor', 'custom-fields'],
        'capability_type' => 'post',
    ]);

    register_taxonomy('technology_sector', ['technology'], [
        'labels' => ['name' => 'Technology Sectors', 'singular_name' => 'Technology Sector'],
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'technology-sector'],
    ]);

    register_taxonomy('readiness_stage', ['technology'], [
        'labels' => ['name' => 'Readiness Stages', 'singular_name' => 'Readiness Stage'],
        'public' => true,
        'show_in_rest' => true,
        'hierarchical' => false,
        'rewrite' => ['slug' => 'readiness-stage'],
    ]);
}
add_action('init', 'arbok_register_content_types');

function arbok_field(string $name, $post_id = false, $default = '') {
    if (function_exists('get_field')) {
        $value = get_field($name, $post_id);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }
    $value = get_post_meta($post_id ?: get_the_ID(), $name, true);
    return $value !== '' ? $value : $default;
}

function arbok_register_acf_fields(): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $text = fn(string $key, string $label, string $name) => [
        'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'text',
    ];
    $textarea = fn(string $key, string $label, string $name) => [
        'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'textarea', 'rows' => 4,
    ];
    $wysiwyg = fn(string $key, string $label, string $name) => [
        'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'full',
    ];

    acf_add_local_field_group([
        'key' => 'group_arbok_technology',
        'title' => 'Technology Profile',
        'fields' => [
            $text('field_arbok_name', 'Technology name', 'technology_name'),
            ['key' => 'field_arbok_sector', 'label' => 'Sector', 'name' => 'sector', 'type' => 'taxonomy', 'taxonomy' => 'technology_sector', 'field_type' => 'select', 'return_format' => 'object', 'add_term' => 1, 'save_terms' => 1, 'load_terms' => 1],
            $textarea('field_arbok_short', 'Short description', 'short_description'),
            $wysiwyg('field_arbok_full', 'Full description', 'full_description'),
            $wysiwyg('field_arbok_problem', 'Problem', 'problem'),
            $wysiwyg('field_arbok_solution', 'Solution', 'solution'),
            $wysiwyg('field_arbok_market', 'Market opportunity', 'market_opportunity'),
            $wysiwyg('field_arbok_uses', 'Use cases', 'use_cases'),
            ['key' => 'field_arbok_trl', 'label' => 'Technology readiness level', 'name' => 'technology_readiness_level', 'type' => 'select', 'choices' => array_combine(range(1, 9), array_map(fn($n) => "TRL $n", range(1, 9))), 'allow_null' => 1],
            $textarea('field_arbok_ip', 'IP / patent status', 'ip_patent_status'),
            $text('field_arbok_stage', 'Current stage', 'current_stage'),
            $textarea('field_arbok_verification', 'Verification status / evidence note', 'verification_status'),
            ['key' => 'field_arbok_images', 'label' => 'Images', 'name' => 'images', 'type' => 'gallery', 'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_arbok_diagrams', 'label' => 'Diagrams', 'name' => 'diagrams', 'type' => 'gallery', 'return_format' => 'array', 'preview_size' => 'medium'],
            ['key' => 'field_arbok_docs', 'label' => 'Documents', 'name' => 'documents', 'type' => 'repeater', 'button_label' => 'Add document', 'sub_fields' => [
                ['key' => 'field_arbok_doc_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'],
                ['key' => 'field_arbok_doc_file', 'label' => 'File', 'name' => 'file', 'type' => 'file', 'return_format' => 'array'],
            ]],
            ['key' => 'field_arbok_video', 'label' => 'Videos / animations', 'name' => 'videos_animations', 'type' => 'repeater', 'button_label' => 'Add media', 'sub_fields' => [
                ['key' => 'field_arbok_video_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'],
                ['key' => 'field_arbok_video_file', 'label' => 'File or URL', 'name' => 'media', 'type' => 'url'],
            ]],
            ['key' => 'field_arbok_contact', 'label' => 'Contact person', 'name' => 'contact_person', 'type' => 'post_object', 'post_type' => ['team_member'], 'return_format' => 'object', 'allow_null' => 1],
            $text('field_arbok_investor', 'Partnership status', 'investor_status'),
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'technology']]],
        'position' => 'normal',
        'style' => 'seamless',
        'show_in_rest' => 1,
    ]);
    acf_add_local_field_group([
        'key' => 'group_arbok_team',
        'title' => 'Team Profile',
        'fields' => [
            $text('field_arbok_team_role', 'Role', 'role'),
            $text('field_arbok_team_group', 'Leadership group', 'team_group'),
            ['key' => 'field_arbok_team_linkedin', 'label' => 'LinkedIn URL', 'name' => 'linkedin_url', 'type' => 'url'],
            $textarea('field_arbok_team_verification', 'Profile verification note', 'profile_verification'),
        ],
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'team_member']]],
        'position' => 'normal',
        'show_in_rest' => 1,
    ]);
}
add_action('acf/init', 'arbok_register_acf_fields');
