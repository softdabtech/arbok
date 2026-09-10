<?php
if (!defined('ABSPATH')) {
    exit;
}

function arbok_water_solution_pages(): array {
    return [
        'true-zero-liquid-discharge' => [
            'title' => 'True Zero-Liquid Discharge',
            'label' => 'ZLD desalination',
            'image' => 'true-zld-summary',
            'summary' => 'ARBOK’s patented True Zero-Liquid Discharge process converts saline, brine and complex water streams into drinkable water and dry technical salt or minerals without a liquid waste stream.',
            'points' => [
                'Designed for 100% water recovery by volume where the feed stream is transformed into purified water and solid residuals.',
                'Deep vacuum evaporation at ambient temperature, reducing dependence on high-pressure membrane systems.',
                'No brine discharge, no chemical dosing, no membrane consumables and no greenhouse-gas emitting combustion process inside the treatment unit.',
                'Net energy consumption target: up to 2 kWh per cubic meter depending on integration and operating conditions.',
            ],
            'applications' => ['Seawater desalination', 'Reverse-osmosis brine recovery', 'Industrial wastewater', 'Ballast water', 'Brackish and well water', 'Radioactively contaminated water'],
        ],
        'v12-system-operation' => [
            'title' => 'ARBOK V12 System & Operation',
            'label' => 'System architecture',
            'image' => 'system-components',
            'summary' => 'The ARBOK V12 unit is a modular vertical system for continuous water treatment, automatic salt extraction, remote monitoring and scalable capacity planning.',
            'points' => [
                'One vertical V12 unit is designed for approximately 200 m³/day production capacity.',
                'Compact industrial footprint: approximately 7 m² for a 20-foot vertical tank configuration with around 6.5 m height.',
                'Operation phases include intake, controlled flow, deep vacuum evaporation, condensation, purified water collection and automated salt discharge.',
                'The system is planned for continuous 24/7/365 operation with automated monitoring, water quality control and emergency shutdown logic.',
            ],
            'applications' => ['New modular plants', 'Containerized water production', 'Remote infrastructure', 'Industrial sites', 'Emergency water capacity', 'Distributed municipal systems'],
        ],
        'deployment-scenarios' => [
            'title' => 'Greenfield & Brownfield Deployment',
            'label' => 'Project models',
            'image' => 'deployment-scenarios',
            'summary' => 'ARBOK water technologies can be deployed as new desalination capacity or integrated into existing reverse-osmosis plants to recover brine and increase freshwater output.',
            'points' => [
                'Greenfield: ARBOK-Desalination System for new plants producing drinkable water and dry technical salt.',
                'Brownfield: ARBOK-Brine Utilization System for existing RO assets with brine residue or effluent streams.',
                'Brownfield integration can more than double freshwater production by recovering and recirculating brine output.',
                'Deployment can reduce land demand, lower waste-disposal complexity and create additional mineral or technical salt value streams.',
            ],
            'applications' => ['Existing RO plants', 'Coastal desalination hubs', 'Industrial parks', 'Water-stressed municipalities', 'Island infrastructure', 'Utility partnerships'],
        ],
        'wastewater-industrial-reuse' => [
            'title' => 'Wastewater & Industrial Reuse',
            'label' => 'Circular water',
            'image' => 'technology-applications',
            'summary' => 'ARBOK’s water platform extends beyond desalination into wastewater purification, difficult industrial streams and circular water reuse where discharge must be minimized.',
            'points' => [
                'Target streams include domestic wastewater, industrial wastewater, contaminated process water, oil-contaminated water and difficult underground or chemical effluents.',
                'The approach supports water reuse by returning treated water to municipal, industrial or agricultural applications.',
                'The technology is positioned for facilities where brine, contaminated residuals or liquid discharge create regulatory and operating risk.',
                'The same Zero Waste Discharge ideology supports water recovery, pollutant isolation and resource recovery from complex streams.',
            ],
            'applications' => ['Municipal wastewater', 'Industrial reuse', 'Oil and gas water', 'Mining and critical materials', 'Agriculture runoff', 'Environmental remediation'],
        ],
        'validation-performance' => [
            'title' => 'Validation & Performance Evidence',
            'label' => 'Testing evidence',
            'image' => 'validation-performance',
            'summary' => 'ARBOK maintains a validation-oriented evidence base covering independent testing, SGS reports, water-quality measurements, energy-performance data and EU water-quality review.',
            'points' => [
                'Referenced validation includes SGS Test Reports from 2021 and 2023 covering system performance indicators.',
                'Water-quality tests are referenced for 2020 and 2023, including analysis of salt and recovered water quality.',
                'An EU Quality Test dated November 2023 is referenced against EU water directives, including Water Framework Directive 2000/60/EC and Drinking Water Directive 98/83/EC.',
                'The validation section is structured for investor diligence: energy, recovered water quality, solid by-products, standards and operating assumptions are separated for review.',
            ],
            'applications' => ['Investor diligence', 'Government review', 'Utility procurement', 'Engineering validation', 'Pilot planning', 'Regulatory discussions'],
        ],
    ];
}

function arbok_water_solution_image_data(string $name): string {
    $path = get_template_directory() . '/assets/images/water-solutions/' . $name . '.jpg';
    if (!is_readable($path)) {
        return '';
    }
    return 'data:image/jpeg;base64,' . base64_encode((string) file_get_contents($path));
}

$pages = arbok_water_solution_pages();
$slug = function_exists('arbok_water_solution_slug') ? arbok_water_solution_slug() : '';
$current = $slug !== '' && isset($pages[$slug]) ? $pages[$slug] : null;
$is_hub = $current === null;

get_header();
?>

<?php if ($is_hub): ?>
<section class="water-hero">
    <div class="shell water-hero__grid">
        <div>
            <p class="eyebrow">ARBOK WATER SOLUTIONS</p>
            <h1>From scarcity to security through Zero-Liquid Discharge water systems.</h1>
            <p class="lede">ARBOK develops modular technologies for desalination, brine conversion, wastewater reuse and industrial water resilience. The portfolio is designed to produce clean water, recover minerals and eliminate liquid waste streams.</p>
            <div class="button-row">
                <a class="button button-primary" href="<?php echo esc_url(home_url('/water-solutions/true-zero-liquid-discharge/')); ?>">Explore True ZLD</a>
                <a class="button button-secondary" href="<?php echo esc_url(home_url('/contact/#inquiry')); ?>">Contact us</a>
            </div>
        </div>
    </div>
</section>

<section class="section water-market">
    <div class="shell">
        <div class="section-heading">
            <div>
                <p class="eyebrow">MARKET CONTEXT</p>
                <h2>Water stress is becoming an infrastructure, industrial and security problem.</h2>
            </div>
        </div>
        <div class="water-stat-grid">
            <article><strong>40%</strong><span>Projected global freshwater demand/supply gap by 2030.</span></article>
            <article><strong>$1.3T+</strong><span>Water treatment industry scale referenced for 2030.</span></article>
            <article><strong>$36.98B</strong><span>Projected desalination market by 2032 at 9.61% CAGR.</span></article>
        </div>
        <div class="water-market-panel">
            <div>
                <h3>The growing water crisis</h3>
                <ul>
                    <li><strong>Rising demand:</strong> population growth, urbanization and climate change are increasing pressure on freshwater resources.</li>
                    <li><strong>Projected shortages:</strong> by 2030, global freshwater demand is projected to exceed available supply by approximately 40%.</li>
                    <li><strong>Regional scarcity:</strong> water-stressed regions increasingly depend on desalination, reuse and non-traditional water sources.</li>
                </ul>
            </div>
            <div>
                <h3>Market and infrastructure opportunity</h3>
                <ul>
                    <li><strong>Market scale:</strong> the water treatment industry is projected to surpass $1.3 trillion by 2030.</li>
                    <li><strong>Desalination growth:</strong> the desalination market is expected to reach $36.98 billion by 2032, growing at 9.61% CAGR.</li>
                    <li><strong>Investment trend:</strong> demand is driving innovation in desalination, wastewater treatment and groundwater management.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section water-capabilities">
    <div class="shell">
        <div class="section-heading">
            <div>
                <p class="eyebrow">WATER TECHNOLOGY PORTFOLIO</p>
                <h2>Focused directions for desalination, reuse, brine conversion and performance validation.</h2>
            </div>
        </div>
        <div class="water-card-grid">
            <?php foreach ($pages as $page_slug => $page): ?>
                <a class="water-card" href="<?php echo esc_url(home_url('/water-solutions/' . $page_slug . '/')); ?>">
                    <span><?php echo esc_html($page['label']); ?></span>
                    <strong><?php echo esc_html($page['title']); ?></strong>
                    <p><?php echo esc_html($page['summary']); ?></p>
                    <b>Read page ↗</b>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section water-breakthroughs">
    <div class="shell water-two-col">
        <div>
            <p class="eyebrow">TECHNOLOGY BREAKTHROUGHS</p>
            <h2>Low net energy, zero liquid waste and modular capacity.</h2>
            <p>The ARBOK water platform is built around a True Zero-Liquid Discharge desalination process: clean water production, dry technical salt by-product, no liquid brine discharge, no chemical consumables, no membranes and a compact scalable unit architecture.</p>
            <ul class="water-check-list">
                <li>Up to 2 kWh/m³ net energy target depending on project integration.</li>
                <li>100% water desalination by volume and conversion of brine to water and salt.</li>
                <li>No pre-treatment or post-treatment requirement in the stated design concept.</li>
                <li>Modular units can be scaled by adding V12 modules.</li>
            </ul>
        </div>
        <div class="water-performance-panel">
            <article><strong>Up to 2 kWh/m³</strong><span>Target net energy consumption depending on integration.</span></article>
            <article><strong>100% recovery goal</strong><span>Water recovery by volume with dry solid residuals.</span></article>
            <article><strong>No liquid brine</strong><span>Designed to remove wastewater discharge from the process.</span></article>
            <article><strong>Modular scale</strong><span>Capacity expands by adding V12 units.</span></article>
        </div>
    </div>
</section>

<section class="section dark-section water-ai-section">
    <div class="shell">
        <p class="eyebrow">TECHNICAL SUMMARY</p>
        <h2>Key facts for engineering review, partnership evaluation and investor diligence.</h2>
        <div class="water-ai-grid">
            <article><strong>Problem</strong><p>Water scarcity, brine disposal, industrial wastewater, aging infrastructure, freshwater demand growth and policy pressure are increasing the need for circular water systems.</p></article>
            <article><strong>Solution</strong><p>ARBOK proposes modular Zero-Liquid Discharge systems that recover water and isolate solid salts or minerals instead of discharging brine.</p></article>
            <article><strong>Deployment</strong><p>The portfolio supports both greenfield plants and brownfield integration into existing reverse-osmosis desalination infrastructure.</p></article>
            <article><strong>Evidence</strong><p>The validation pathway includes SGS reports, water-quality testing and EU quality review materials for technical diligence.</p></article>
        </div>
    </div>
</section>

<?php else: ?>
<section class="water-detail-hero">
    <div class="shell water-detail-hero__grid">
        <div>
            <p class="eyebrow">ARBOK WATER SOLUTIONS</p>
            <h1><?php echo esc_html($current['title']); ?></h1>
            <p class="lede"><?php echo esc_html($current['summary']); ?></p>
            <div class="button-row">
                <a class="button button-primary" href="<?php echo esc_url(home_url('/contact/#inquiry')); ?>">Contact us</a>
                <a class="button button-secondary" href="<?php echo esc_url(home_url('/water-solutions/')); ?>">Water Solutions hub</a>
            </div>
        </div>
    </div>
</section>

<section class="section water-detail-body">
    <div class="shell water-detail-layout">
        <aside class="water-side-nav">
            <a href="#overview">Overview</a>
            <a href="#capabilities">Capabilities</a>
            <a href="#applications">Applications</a>
            <a href="#related">Related pages</a>
        </aside>
        <main>
            <section id="overview" class="water-content-block">
                <p class="eyebrow">OVERVIEW</p>
                <h2><?php echo esc_html($current['title']); ?></h2>
                <p><?php echo esc_html($current['summary']); ?></p>
            </section>
            <section id="capabilities" class="water-content-block">
                <p class="eyebrow">CAPABILITIES</p>
                <h2>What this direction covers</h2>
                <div class="water-points">
                    <?php foreach ($current['points'] as $point): ?>
                        <article><?php echo esc_html($point); ?></article>
                    <?php endforeach; ?>
                </div>
            </section>
            <section id="applications" class="water-content-block">
                <p class="eyebrow">APPLICATIONS</p>
                <h2>Where it can be used</h2>
                <div class="water-pill-grid">
                    <?php foreach ($current['applications'] as $application): ?>
                        <span><?php echo esc_html($application); ?></span>
                    <?php endforeach; ?>
                </div>
            </section>
            <section id="related" class="water-content-block">
                <p class="eyebrow">RELATED WATER PAGES</p>
                <h2>Connected ARBOK water directions</h2>
                <div class="water-related-grid">
                    <?php foreach ($pages as $related_slug => $page): ?>
                        <?php if ($related_slug === $slug) { continue; } ?>
                        <a href="<?php echo esc_url(home_url('/water-solutions/' . $related_slug . '/')); ?>">
                            <span><?php echo esc_html($page['label']); ?></span>
                            <strong><?php echo esc_html($page['title']); ?></strong>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>
    </div>
</section>
<?php endif; ?>

<?php
get_footer();
