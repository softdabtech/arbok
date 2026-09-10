<?php
/*
Template Name: ARBOK Strategic Direction
*/
get_header();
while (have_posts()) : the_post();
$slug = get_post_field('post_name');
$directions = [
    'water-security' => [
        'index' => '01', 'label' => 'Water Security',
        'headline' => 'Recover more usable water from difficult sources.',
        'intro' => 'ARBOK water technologies address seawater desalination, reverse-osmosis brine, contaminated water, brackish groundwater, radioactive water and distributed drinking-water production.',
        'problem' => 'Water scarcity is intensified by energy-intensive treatment, difficult waste streams and infrastructure that discards part of the feedwater as concentrated brine.',
        'approach' => 'The portfolio combines low-temperature separation, purification, brine recovery and modular production concepts. Individual performance claims remain subject to technical verification and project-specific diligence.',
        'markets' => ['Municipal and regional water authorities', 'Industrial water users', 'Desalination and treatment operators', 'Remote and humanitarian water programs'],
        'technologies' => ['arbok-desalination','arbok-brine','arbok-purification','arbok-oasis','arbok-nuke','arbok-newro','arbok-sotarix','arbok-space','arbok-bottling'],
        'image' => 'WaterOutput',
    ],
    'energy-systems' => [
        'index' => '02', 'label' => 'Energy Systems',
        'headline' => 'Develop energy pathways for constrained environments.',
        'intro' => 'ARBOK energy concepts include hydrogen production, heavy-water processing and thermal systems intended for locations where conventional energy or fuel access is limited.',
        'problem' => 'Remote, extreme and industrial environments require energy systems that reduce dependence on complex fuel logistics and high-consumption legacy processes.',
        'approach' => 'ARBOK applies thermodynamic and water-based process concepts to hydrogen, heavy-water and heating applications. Claimed outputs and readiness require independent validation before commercial reliance.',
        'markets' => ['Hydrogen and industrial gas programs', 'Research and isotope-processing facilities', 'Remote and extreme-environment infrastructure', 'Strategic energy-development partners'],
        'technologies' => ['arbok-dynamix','arbok-deuterium','arbok-arctic'],
        'image' => 'Dynamix',
    ],
    'environmental-remediation' => [
        'index' => '03', 'label' => 'Environmental Remediation',
        'headline' => 'Convert difficult waste streams into manageable outputs.',
        'intro' => 'ARBOK remediation technologies target oil spills, oily water, contaminated industrial water, rubber and polymer waste, and organic-resource recovery.',
        'problem' => 'Oil, chemical and polymer waste streams are costly to separate, transport and dispose of, particularly when pollutants are mixed with water or difficult terrain.',
        'approach' => 'The portfolio combines thermodynamic separation, sorbent systems and compact treatment concepts for recovery and waste reduction. Application-specific testing is required.',
        'markets' => ['Oil and gas operators', 'Ports, shipping and tanker services', 'Environmental response organizations', 'Waste-processing and remediation contractors'],
        'technologies' => ['arbok-teg','arbok-blacksand','arbok-oily','arbok-desulph','arbok-sapropel'],
        'image' => 'Oil Spill Cleanup',
    ],
    'industrial-resilience' => [
        'index' => '04', 'label' => 'Industrial Resilience',
        'headline' => 'Strengthen essential process and infrastructure systems.',
        'intro' => 'ARBOK industrial technologies cover cooling, atmospheric control, liquid transportation and solid-liquid separation for infrastructure and process applications.',
        'problem' => 'Industrial operations face rising energy costs, aging infrastructure, process inefficiency and climate-related operating constraints.',
        'approach' => 'ARBOK proposes modular thermodynamic, transport and crystallization systems that can be evaluated as standalone equipment or as additions to existing infrastructure.',
        'markets' => ['Industrial process operators', 'Mining and chemical processing', 'Water and petroleum transport infrastructure', 'Cooling and climate-control applications'],
        'technologies' => ['arbok-air','arbok-skymanager','arbok-peak','arbok-crystallizer'],
        'image' => 'ARBOK Tech Features 02',
    ],
];
$data = $directions[$slug] ?? $directions['water-security'];
$hero_image = arbok_media_url($data['image']);
?>
<section class="page-hero page-hero--compact direction-hero"><div class="shell"><?php arbok_breadcrumbs(); ?><div class="inner-hero-grid"><div><p class="eyebrow"><?php echo esc_html($data['index']); ?> · Strategic direction</p><h1><?php echo esc_html($data['headline']); ?></h1><p class="lede"><?php echo esc_html($data['intro']); ?></p><div class="button-row"><a class="button" href="#direction-portfolio">Explore technologies</a><a class="button button-ghost" href="<?php echo esc_url(home_url('/contact/?subject=direction&direction=' . rawurlencode($data['label']))); ?>">Discuss application</a></div></div><?php if ($hero_image) : ?><div class="inner-hero-media"><img src="<?php echo esc_url($hero_image); ?>" alt="<?php echo esc_attr($data['label']); ?>"></div><?php endif; ?></div></div></section>
<section class="section"><div class="shell two-column"><div><p class="eyebrow dark">Market challenge</p><h2><?php echo esc_html($data['label']); ?></h2><p><?php echo esc_html($data['problem']); ?></p></div><div><p class="eyebrow dark">ARBOK approach</p><h2>Portfolio-level response</h2><p><?php echo esc_html($data['approach']); ?></p><div class="source-note">Technical performance, readiness and IP status are confirmed during qualified diligence.</div></div></div></section>
<section class="section section-soft"><div class="shell"><p class="eyebrow dark">Application landscape</p><h2>Potential operating contexts</h2><div class="direction-market-grid"><?php foreach ($data['markets'] as $i => $market) : ?><article><span><?php echo esc_html(str_pad((string) $i + 1, 2, '0', STR_PAD_LEFT)); ?></span><h3><?php echo esc_html($market); ?></h3></article><?php endforeach; ?></div></div></section>
<section id="direction-portfolio" class="section"><div class="shell"><div class="section-heading"><div><p class="eyebrow dark">Related portfolio</p><h2>Technologies in <?php echo esc_html($data['label']); ?></h2></div><a class="text-link" href="<?php echo esc_url(get_post_type_archive_link('technology')); ?>">View complete portfolio ↗</a></div><div class="grid technology-grid"><?php $portfolio = new WP_Query(['post_type' => 'technology', 'posts_per_page' => -1, 'post_name__in' => $data['technologies'], 'orderby' => 'post_name__in']); while ($portfolio->have_posts()) : $portfolio->the_post(); arbok_technology_card(); endwhile; wp_reset_postdata(); ?></div></div></section>
<?php endwhile; get_footer(); ?>
