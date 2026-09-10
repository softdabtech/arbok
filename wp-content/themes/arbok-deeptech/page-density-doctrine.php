<?php
get_header();
$doctrine_hero_file = get_template_directory() . '/assets/images/density-doctrine-hero.jpg';
$doctrine_hero_data = is_readable($doctrine_hero_file) ? 'data:image/jpeg;base64,' . base64_encode((string) file_get_contents($doctrine_hero_file)) : '';
$doctrine_sections = [
    [
        'heading' => '0. Premise: What We Count as Progress',
        'paragraphs' => [
            'The Dyson sphere is treated as the mark of a higher civilisation — a shell around a star, harvesting all of its radiation. In truth it reflects the narrow view of our own era: a faith in gigantism and extensive growth, progress defined as more panels, more acreage, more nameplate.',
            'The real mark of an advanced civilisation is the invisibility of its technology. It does not build shells around stars, and it does not drain oceans.',
            'We abandoned the petrol engine at roughly 40 % efficiency and moved en masse to electric cars charged from power plants averaging 30 %. Fuel consumption rose by 10 %. Pollution rose by 10 % as well. By that logic, to drive to the supermarket we ought to ship solar panels 156 000 000 km toward the Sun — rather than solve the problem locally and intelligently.',
            'We are not building a Dyson sphere. We know it is a dead end — which is precisely why the official doors are closed to us.',
            'The Kardashev scale proposes to measure a civilisation by how much energy it consumes: Type I commands all the energy of its planet, Type II all the energy of its star, Type III that of a galaxy. A Dyson sphere is, in this logic, simply Type II. Humanity currently sits at roughly 0.73 on that ladder and climbs diligently.',
            'We consider the ladder itself to be the error. Not because energy will run short, but because every kilowatt-hour ends its journey as heat — and a planet sheds heat only by radiating it. The arithmetic of the limit is simple: at the present rate of growth in consumption we meet the solar flux striking the Earth within a few centuries, and we meet the thermal ceiling considerably sooner, regardless of where the energy came from.',
            'So “how do we get more” is the wrong question. The right one is how much useful work is extracted per kilowatt-hour and per square metre. A civilisation is measured not by what it burned, but by what it turned out not to need.',
            'A genuinely advanced civilisation does not blot out the light of its star. It arranges for that light to reach everyone.',
        ],
    ],
    [
        'heading' => '1. The Core',
        'paragraphs' => [
            'It is said that the energy transition failed for want of money, will, or technology. Not quite. It failed because it was the first transition in history to move downward in power density. Wood, coal, oil, the atom — each successive step drew more energy from a square metre, from a kilogram, from an hour. Transition 1.0 was the first to run the other way, and it paid the difference in subsidy. The subsidy ran out before physics gave ground.',
            'Transition 2.0 will reproduce the result, because it reproduces the error squared: to low-density generation it adds low-density storage.',
            'The ARBOK Institute proposes to change the unit of measurement. Not “what replaces the fuel”, but “how much energy is consumed per unit of useful work” — and “what is to be done with everything already extracted, spilled, buried and stockpiled”.',
        ],
    ],
    [
        'heading' => '2. Diagnosis: Six Limits',
        'paragraphs' => [
            '2.1. Power density. This is how many megawatts of installed capacity sit on a hectare of occupied land — counting all infrastructure, access roads, substations and exclusion zones, not merely the equipment itself.',
            'An ARBOK LONGBATTERY module rated at 1 MW occupies about 14 m². Scaled to a hectare, that is roughly 700 MW. The figure describes not a single plant of that rating but a density of siting — how much capacity physically fits on a plot. On the same hectare: nuclear, about 50 MW; onshore wind, 0.13; solar, 0.04, and 0.02 once dust settles on the glass.',
            'Nuclear appears here for a reason. It is the highest industrial density humanity has ever achieved. Wind stands 385 times below it; solar, 1250 times. Transition 1.0 proposed replacing the densest source with the most diffuse one and called that progress. This is not an engineering lag. It is the number of watts falling on a square metre of the planet.',
            'The practical arithmetic: to secure a firm 200 MW from wind you need 207–276 km² of land, 50–300 km from the consumer, 5–10 years for grid connection, and $0.8–2.8 billion without subsidy.',
            '2.2. Nameplate capacity is not capacity. The capacity factor is the share of nameplate rating a source actually delivers over a year. A 3 MW turbine at a 33 % capacity factor yields, across the year, what a 1 MW machine running without pause would yield.',
            'In practice: solar about 24 %, wind in the United States 33.5 %, nuclear 92–93 %. To guarantee 1000 MW, therefore, you must build roughly three times the nameplate in wind — our internal figures say 3.5 — four times in solar, and 8 % above nameplate in nuclear. The working life of a turbine is 10–15 years, not the 25 that were promised. The gap between the prospectus and the fact was paid for over 20 years by the consumer, who was not told.',
            '2.3. Storage is not generation. A battery produces nothing. It returns someone else’s kilowatt-hour, having kept 10–15 % in the charge-discharge cycle itself — physical loss, not a fee. The FCR market (Frequency Containment Reserve) is where the system operator pays for the readiness to support grid frequency instantly; it is the most lucrative market a battery can reach. Even there: 1 MW / 1 MWh earns about $105 000 a year against CAPEX of $450 000 per MWh and three replacements over 20 years — another $1.8 million in replacements alone. Twenty years of operation to break even on equipment you yourself threw away.',
            '2.4. The material ceiling. Take the scenario of a global storage requirement of 326 TWh: $32.6–37.5 trillion in lithium-ion batteries; 52.16 million tonnes of lithium metal, which is 1.7 times every proven reserve on Earth; 217 years of current mining; 326 years of current world battery production; 48–120 kg of CO₂-equivalent per kWh, meaning 15.6–39.1 Gt across the scenario; 28–67 litres of water per kWh. This is not “expensive”. It is impossible. Transition 2.0 has no material foundation — irrespective of who announces it, or with what expression on their face.',
            '2.5. You cannot repeal physics by decree. The world mines over 9 billion tonnes of coal and some 4.2 trillion m³ of gas, and consumes about 105 million barrels of oil a day. Global generation runs at roughly 33 trillion kWh a year: coal 34 %, gas 22 %, hydro 14 %, nuclear 9 %, wind 8 %, solar 7 %. Coal holds 23 % of installed capacity but delivers 34 % of output. Solar holds 20 % of capacity and delivers 7 %.',
            'To replace coal alone — 11 trillion kWh — you would need 8000–10 000 GW of solar, panels covering 160 000 km², two Austrias; 3300–3600 GW of wind, close to a million turbines; 1435 GW of nuclear, meaning 1300 new reactors against today’s 415, with uranium mining rising from 60 000 to 230 000 tonnes a year; an additional 2 trillion m³ of gas a year, forty trunk lines the size of Central Asia–China; or 2670 GW of hydro, roughly 120 dams the size of the largest on Earth. Panels and turbines alone come to $12–15 trillion; the full bill, $25–40 trillion.',
            'Proven world coal reserves stand at about 1.1 trillion tonnes — over a century of mining at today’s rate. Coal will not be abolished. It will either be burned as it was in the nineteenth century, or taken apart into molecules.',
        ],
    ],
    [
        'heading' => '2.6. And the tail — everyone has one.',
        'paragraphs' => [
            'Wind. Composite blades are not recycled: 3 million tonnes a year by 2050, 43 million tonnes accumulated. A 300 MW wind farm produces 3200 tonnes of lubricant over 15 years, at $6–13 million to dispose of. Diesel blade heating in cold climates costs $9–27 million over 15 years across 120 turbines.',
            'Solar. On IRENA and IEA-PVPS estimates, up to 78 million tonnes of end-of-life photovoltaic panels will have accumulated by 2050 — nearly twice the blade figure, at a 25-year service life against 15. Ivanpah: $2.2 billion, about $5600 per kW, boilers lit with gas every morning, output down to 40 % of contract after 10 years, 13 km² of cleared desert.',
            'Nuclear. On IAEA figures (June 2026), about 494 000 tonnes of spent fuel are held worldwide, and final disposal is unresolved in every major grid. There is a tail here too — but compare the orders of magnitude: 494 thousand tonnes across 70 years of nuclear power, against 78 million tonnes of panels across a single replacement cycle. A factor of 158. That factor is precisely what density buys.',
            'The grid. Spain, April 2025: roughly 60 million people without power, on a deficit of synchronous inertia.',
            'Biogas. The one branch with honest physics produces 800–950 kg of digestate per tonne of feedstock: a 1 MW plant generates 25 000 tonnes a year of an unsolved tail, and without subsidy runs at a loss of $440–770 thousand.',
            'Not one of these six limits moves with the size of the cheque. Which is why ten trillion dollars did not shift them by a metre.',
        ],
    ],
    [
        'heading' => '3. Three Refusals',
        'paragraphs' => [
            'ARBOK does not propose Transition 3.0. The word “transition” means substituting one source for another against a calendar. The calendar is the thing that has now failed twice.',
            'ARBOK does not build its strategy on the climate argument. No model in the portfolio requires a carbon tax, a green tariff, or a belief in climate sensitivity to CO₂. Returns are counted in water, fuel, salts, metals and heat. The distinction is this: a wind farm earns not from electricity but from a tariff and a quota — repeal them by government decision and the asset stops paying for itself, having changed nothing in its physics. An ARBOK unit earns from a product people buy regardless of politics. If the climate agenda vanished tomorrow, our economics would not move by a single per cent.',
            'ARBOK does not sell a promise. Every figure in this document has a source file and a readiness level. Where a figure has not yet been confirmed by an external laboratory, it does not enter a commercial proposal. An institute that criticises unverifiable claims is obliged to begin with its own.',
        ],
    ],
    [
        'heading' => '4. Four Principles',
        'paragraphs' => [
            '4.1. Density, not acreage. A project is judged not by the megawatts printed on its nameplate but by how much land and how much energy it consumes per unit of result: megawatts per hectare, kilowatt-hours per tonne. A technology that demands hectares is rejected at the door, whatever its rating.',
            '4.2. Vacuum instead of heat. The physical core: under space-grade vacuum inside the unit, phase separation proceeds at ambient temperature. ARBOK units operate at 6–40 °C and 1 kWh per tonne, with recuperation up to 98 %, no catalysts, no membranes, no consumables; CO₂ below 0.1 kg/t, SOₓ zero, NOₓ below 0.05 kg/t; water recovery up to 99.98 %; a 20-foot container. For aqueous streams, ZWD runs at 0.72 kWh/m³ against 15–150 for conventional ZLD, at 100 % water recovery and in one stage instead of six to eight.',
            '4.3. Waste is raw material nobody has taken apart. ARBOK works with waste others pay to dispose of, and which for ARBOK is feedstock: acid tars, digestate, mine and produced water, phosphogypsum, tailings ponds, peat, harbour sludge, saline groundwater, chemical effluent — in principle anything that qualifies as liquid waste. The technology delivers a double economy: a gate fee on the way in, a commodity on the way out. One tonne of pyrolysis liquid through ARBOK-VC yields roughly 400 kg of gasoline (sulphur below 10 ppm, 92–95 octane), 310 kg of kerosene, 180 kg of diesel, 100 kg of paraffins, 10 kg of sulphur and 50 kg of bitumen — about $1200. A 10 t/day unit produces revenue of roughly $4 million a year.',
            '4.4. Payback instead of mandate. From the Manifesto: “When a person sees technology, they doubt. When a person sees money, the doubt disappears.” Transition 1.0 lived exactly as long as its mandate lived. A unit that returns its capital in a standard 5–7 years depends on no election, no summit, and no shift in the editorial line at Bloomberg.',
        ],
    ],
    [
        'heading' => '5. Three Answers',
        'paragraphs' => [
            'A diagnosis without an answer is journalism. A doctrine is obliged to state what is proposed instead.',
        ],
    ],
    [
        'heading' => '5.1. Generation by density, storage by iron.',
        'paragraphs' => [
            'The lithium route to 326 TWh of global reserve is impossible, as shown above. But the reserve is needed. The answer is iron. The same volume calls for 1.1–1.3 billion tonnes of iron against world steel output exceeding 1.8 billion tonnes a year: roughly one year of global metallurgy, not 326 years of waiting. Iron contributes $15–20 per kWh to storage cost; raw material for the entire scenario runs to $5–6.5 trillion against $32.6 trillion for lithium. Five to six times cheaper — and, unlike lithium, physically in existence.',
            'Storage, however, does not solve the grid’s second problem: dispatchable generation. That is closed by the containerised module — 20 feet, about 14 m² of footprint, a capacity factor near 90 %, and 15.5–15.8 million kWh a year. CAPEX around $2.5 million, or roughly $1250 per installed kW, against $10 000–11 000 for a small modular reactor. OPEX of $5–10 per MWh and a delivered price of $0.03–0.05 per kWh. As by-products: about 444 kg of oxygen an hour and about 185 kW of heat for every MW of electrical output.',
        ],
    ],
    [
        'heading' => '5.2. Water is cheaper than the absence of water.',
        'paragraphs' => [
            'Three billion people lack sound access to clean drinking water. Ten million die each year of related disease. More than 80 % of them live within 25 km of water — salt water.',
            'Reverse osmosis does not solve this and will not. The full RO chain with brine finishing runs 15–25 kWh/m³ across four stages, recovers 30–40 %, costs $2.0–2.5 per m³, and pays back in “fifteen years or never”. Saudi Arabia alone desalinates 16 million m³ a day and discharges 24 million m³ of brine. Salinity in the Persian Gulf has risen from 3.5 to 5.2 % in 20 years. We are salting the sea in order to drink.',
            'ARBOK: one stage, 0.72 kWh/m³ — the figure confirmed by SGS — 100 % recovery, no brine at all, boron at 0.03 mg/l against 0.5–1.0 for RO, and operation at feed salinity above 350 000 ppm against 70–90 thousand for membranes. Water cost is about $0.20 per m³. And the decisive point: once revenue from dry salt is counted, the cost of the water turns negative. From 100 tonnes of seawater — 100 tonnes of drinking water and 3.5 tonnes of marketable salt. A desalination vessel rated at 10 000 t/day yields 520 tonnes of salt a day, about $11 million a year from a single hull.',
            'Reverse osmosis is not an evolution. It is patching holes. ARBOK does not compete with it. It renders it logically redundant.',
        ],
    ],
    [
        'heading' => '5.3. The atom, released from geography.',
        'paragraphs' => [
            'Nuclear is the highest density humanity has achieved. And it is tied to water. On 13 July 2026 France cut 6.4 GW of nuclear generation — about 14 % of demand — because its rivers ran too warm. Switzerland shut both units of a plant when the Aare reached 25 °C. In the United States, individual units drop to 50 % output while the river stays above 32 °C.',
            'A 1.3 GW unit is a $13 billion machine. A week at half output in a heatwave means losing over 100 000 MWh — €20–40 million at peak prices. The most expensive asset on the grid earns nothing in precisely the week when electricity is worth the most.',
            'The solution is a closed loop. Water is charged once and circulates: no dependence on river level, no dependence on river temperature, no discharge, no make-up, no open contact with air. The physics is the same — phase transition under vacuum, with up to 98 % of the heat returned to cycle. Modules of 20–200 MW thermal, 50–2000+ MW in aggregate. Make-up runs at about 0.02 % a year against 380–870 m³/h for a conventional cooling tower — that is $4.56–10.44 million a year in water, reduced to zero. CAPEX $4–6 million against $10 million for the conventional route, with payback in 0.7–1.2 years. A conventional tower throws an aerosol plume 300 m and drifts droplets up to 12 km; here there is neither.',
            'And the hotter the inlet, the more energy the vapour carries and the deeper the cooling. The delta works for us, not against us. As always with ARBOK, a minus becomes a plus.',
            'The consequence outweighs the saving: a nuclear plant is no longer obliged to stand on a river or a coast. The principal geographic constraint on the densest energy humanity possesses is removed. The annual market for thermal and nuclear plant cooling and water treatment exceeds $50 billion — China about $15 billion, the United States about $7–8 billion across 60 once-through reactors, France about $2 billion.',
        ],
    ],
    [
        'heading' => '6. Scale: What This Means for the Planet',
        'paragraphs' => [
            'World generation in 2025 stands at roughly 31 500 TWh. Calculated on the containerised module, the whole of it comes to about 2 million containers. Combined footprint: about 10 km². Combined CAPEX: on the order of $5 trillion — that is 1.5–2 years of current global energy investment.',
            'The planet’s entire power sector, on the footprint of a mid-sized European airport, for two years of the budget the industry already spends every year.',
            'Even 5–10 % of the world balance removes peak deficits and halts tariff growth. Each 1 MW module displaces 1.6–2.46 million m³ of natural gas a year; a 1 GW cluster, €160–740 million annually. For reference: conflicts over oil, gas, deposits and routes cost humanity up to $1 billion a day.',
            'This is a calculated scenario, not a commercial offer. It shows the order of magnitude and the boundary of the possible — and for that very reason it requires external measurement before it requires a public statement.',
        ],
    ],
    [
        'heading' => '7. We Have No Tail of Our Own',
        'paragraphs' => [
            'Every solution of Transition 1.0 created a residue nobody cared to discuss: 43 million tonnes of blades, 78 million tonnes of panels, lithium recycled at 5 %.',
            'Test any technology in our portfolio against that criterion. Vacuum separation has no consumables — no catalysts, no membranes, no reagents. Water recovery reaches 99.98 %; there is no liquid tail. Salt, metals, sulphur, bitumen — everything that used to be waste leaves as dry product. The closed cooling loop neither evaporates water nor discharges it. Iron in storage returns to the metallurgy it came from.',
            'This is not an environmental posture. It is an engineering requirement: a technology that leaves a tail is unfinished. It has merely handed the problem to whoever comes next.',
        ],
    ],
    [
        'heading' => '8. Portfolio: A Ladder, Not a Bet',
        'paragraphs' => [
            'Transition 1.0 was a single ten-trillion-dollar bet on two technologies. ARBOK proposes a ladder of dozens of independent positions, in which the upper rungs are financed by the earnings of the lower ones.',
            'And rapid payback is not even the cherry on the cake. Where a state participates in the project, ARBOK can apply the BOOM model — Build, Own, Operate, Maintain: the institute builds, owns, runs and services the plant itself — under which the client pays only for waste disposal and invests not a dollar of its own capital. In the process the client may find itself holding an additional commodity in strong demand: clean water, rare earth metals, salt and the like.',
            'Asymmetry matters more than any single figure. A generation or waste-processing facility built from dozens of modules carries far greater survivability: a failure or a strike on any one of them stops a single container, not the programme, and does not bring down a grid. The failure of one bet cost ten trillion dollars and removed the subject from the agenda for a generation. The difference is not in the return. The difference is in what happens when you are wrong.',
        ],
    ],
    [
        'heading' => '9. Stage of Readiness',
        'paragraphs' => [
            'New and practically unbounded sources of energy — sources that make the consumer wholly independent of the political situation, of exchange prices for fuel, of climatic extremes, of grid availability and transmission charges, and of specially trained and expensive personnel — are all the product of a different physics. Not an alternative physics: one known for the better part of two centuries, looked at from a different angle.',
            'And what already works in the laboratory has to be brought into industry. The decisive moment has arrived: building the industrial units, putting them into series production, certification, deployment.',
        ],
    ],
    [
        'heading' => '10. Closing',
        'paragraphs' => [
            'Bloomberg is right on one count: a “classical” transition takes decades. Bloomberg is wrong that the false narrative was authored by the opponents of renewable energy. The demand for a sharp reduction is written into the Paris Agreement itself: 26 % in ten years, 41 % in fifteen. Emissions rose 8 % instead. This is not a distortion by other hands. It is an unmet obligation now being rewritten after the fact, in the hope that nobody checks it against the original.',
            'We propose not to argue. We propose to change the unit of measurement: to stop counting progress in installed gigawatts and start counting it in kilowatt-hours per tonne and megawatts per hectare.',
            'The first transition that actually happens will not be a transition to another fuel. It will be a transition to another density — and it will begin not at a summit, but with a container on a slab of asphalt. Not with a shell around a star, but with arranging for that star’s light to reach everyone.',
        ],
    ],
    [
        'heading' => '— Note to Section 0. The thermal limit on growth in energy consumption follows Tom Murphy, University of California San Diego, “Galactic-Scale Energy” (2011): at a sustained growth rate of 2.3 % a year, consumption meets the solar flux striking the Earth in roughly 400 years, with the habitability threshold reached earlier. Humanity’s position on the continuous Kardashev scale follows Sagan, K = (log₁₀P − 6)/10.',
        'paragraphs' => [
        ],
    ],
];
?>

<section class="doctrine-hero">
    <div class="doctrine-hero__image" aria-hidden="true"<?php if ($doctrine_hero_data !== '') : ?> style="background-image:linear-gradient(90deg,rgba(2,12,22,.92) 0%,rgba(2,12,22,.66) 38%,rgba(2,12,22,.28) 72%,rgba(2,12,22,.76) 100%),linear-gradient(0deg,rgba(2,12,22,.82) 0%,rgba(2,12,22,.08) 48%),url('<?php echo esc_attr($doctrine_hero_data); ?>')"<?php endif; ?>></div>
    <div class="shell doctrine-hero__inner">
        <p class="eyebrow">ARBOK doctrine</p>
        <h1>THE DENSITY DOCTRINE</h1>
        <p class="doctrine-hero__subtitle">A Strategic Proposition of the ARBOK Strategic Research Institute</p>
        <p class="doctrine-hero__intro">A foundational text on density, useful work, Zero Waste Discharge and the engineering logic behind ARBOK’s technology portfolio.</p>
        <div class="button-row"><a class="button" href="#doctrine-text">Read the doctrine</a><a class="button button-ghost" href="<?php echo esc_url(home_url('/contact/#inquiry')); ?>">Contact ARBOK</a></div>
    </div>
</section>
<section class="section doctrine-intro">
    <div class="shell doctrine-intro__grid">
        <div><p class="eyebrow dark">Section overview</p><h2>Progress measured by density, not acreage.</h2></div>
        <div><p>The Density Doctrine reframes technological progress around energy density, material reality, water resilience and useful work per unit of land, energy and infrastructure.</p><p>It is written as a strategic proposition: a diagnosis of the limits of low-density transition models and a statement of ARBOK’s alternative engineering principles.</p></div>
    </div>
</section>
<section id="doctrine-text" class="section doctrine-body">
    <div class="shell doctrine-layout">
        <aside class="doctrine-toc" aria-label="Doctrine sections">
            <p class="eyebrow dark">Contents</p>
            <ol>
                <?php foreach ($doctrine_sections as $index => $section) : ?>
                    <li><a href="#doctrine-section-<?php echo esc_attr((string) $index); ?>"><?php echo esc_html($section['heading']); ?></a></li>
                <?php endforeach; ?>
            </ol>
        </aside>
        <article class="doctrine-content">
            <?php foreach ($doctrine_sections as $index => $section) : ?>
                <section id="doctrine-section-<?php echo esc_attr((string) $index); ?>" class="doctrine-section">
                    <?php $tag = preg_match('/^[0-9]+\.[0-9]+\./', $section['heading']) || strpos($section['heading'], '— Note') === 0 ? 'h3' : 'h2'; ?>
                    <<?php echo esc_attr($tag); ?>><?php echo esc_html($section['heading']); ?></<?php echo esc_attr($tag); ?>>
                    <?php foreach ($section['paragraphs'] as $paragraph) : ?>
                        <p><?php echo esc_html($paragraph); ?></p>
                        <?php if (strpos($paragraph, 'ARBOK-VC yields') !== false) : ?>
                            <figure class="doctrine-video-block">
                                <div class="doctrine-video-shell">
                                    <video controls preload="metadata" playsinline aria-label="ARBOK Vacuum Cracking animation">
                                        <source src="<?php echo esc_url(get_template_directory_uri() . '/assets/videos/vacuum-cracking-animation.mp4'); ?>" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <figcaption>
                                    <strong>Vacuum Cracking animation</strong>
                                    <span>Animated visualization of the ARBOK-VC concept for processing pyrolysis liquid into useful petroleum fractions and recovered by-products.</span>
                                </figcaption>
                            </figure>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </section>
            <?php endforeach; ?>
        </article>
    </div>
</section>
<section class="section doctrine-cta">
    <div class="shell doctrine-cta__inner">
        <div><p class="eyebrow">Strategic inquiry</p><h2>Discuss the doctrine with ARBOK.</h2><p>For institutional, government, industrial or research conversations, contact the ARBOK team directly.</p></div>
        <a class="button" href="<?php echo esc_url(home_url('/contact/#inquiry')); ?>">Contact ARBOK</a>
    </div>
</section>
<?php get_footer(); ?>
