<?php
get_header();
$directions = [
    ['water-security', '01', 'Water Security', 'Desalination, brine utilization, purification, groundwater recovery and distributed drinking-water production.', 'WaterOutput'],
    ['energy-systems', '02', 'Energy Systems', 'Hydrogen, heavy water, thermal systems and energy applications for demanding operating environments.', 'Dynamix'],
    ['environmental-remediation', '03', 'Environmental Remediation', 'Oil-spill recovery, oily-water treatment, waste processing and contaminated-water remediation.', 'Oil Spill Cleanup'],
    ['industrial-resilience', '04', 'Industrial Resilience', 'Cooling, liquid transport, crystallization and modular process systems for infrastructure and industry.', 'ARBOK Tech Features 02'],
];
?>
<section class="page-hero page-hero--compact"><div class="shell"><?php arbok_breadcrumbs(); ?><p class="eyebrow">ARBOK strategic directions</p><h1>Four connected infrastructure priorities</h1><p class="lede">ARBOK organizes its technology portfolio around water security, energy systems, environmental remediation and industrial resilience.</p></div></section>
<section class="section"><div class="shell direction-grid"><?php foreach ($directions as [$slug, $index, $title, $summary, $image_title]) : $image = arbok_media_url($image_title); ?><a class="direction-card" href="<?php echo esc_url(home_url('/directions/' . $slug . '/')); ?>"><?php if ($image) : ?><img src="<?php echo esc_url($image); ?>" alt="" loading="lazy"><?php endif; ?><span class="direction-card__shade"></span><span class="direction-card__content"><small><?php echo esc_html($index); ?> · Strategic direction</small><strong><?php echo esc_html($title); ?></strong><span><?php echo esc_html($summary); ?></span><b>Explore direction ↗</b></span></a><?php endforeach; ?></div></section>
<?php get_footer(); ?>
