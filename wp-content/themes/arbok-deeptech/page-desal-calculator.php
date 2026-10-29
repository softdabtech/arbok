<?php
/**
 * Template Name: Arbok-Desal Calculator
 */
get_header();
?>
<section class="page-hero page-hero--compact desal-calculator-hero">
    <div class="shell">
        <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span>/</span><span>Calculator</span></nav>
        <p class="eyebrow">ARBOK desalination planning tool</p>
        <h1>Model a zero-liquid-discharge water system.</h1>
        <p class="lede">Configure source-water conditions, drinking-water demand and regional operating assumptions to compare an indicative ARBOK system with conventional reverse osmosis.</p>
        <div class="desal-calculator-hero__facts" aria-label="Calculator scope">
            <span>Drinking water output</span><span>Dry technical salt recovery</span><span>ARBOK vs RO comparison</span>
        </div>
    </div>
</section>

<main id="arbok-desal-calculator" class="section desal-calc">
    <div class="shell">
        <div class="desal-calc__intro">
            <div><p class="eyebrow dark">Interactive estimate</p><h2>Set the project conditions.</h2><p>Choose a reference water source or enter laboratory values, then adjust demand and operating economics. All results update instantly.</p></div>
            <div class="desal-calc__toggles">
                <div class="desal-calc__seg" aria-label="Region"><button id="rEU" type="button" aria-pressed="true">Europe</button><button id="rUS" type="button" aria-pressed="false">USA</button></div>
                <div class="desal-calc__seg" aria-label="Units"><button id="uM" type="button" aria-pressed="true">Metric</button><button id="uU" type="button" aria-pressed="false">US units</button></div>
            </div>
        </div>

        <form id="desal-f" class="desal-calc__grid">
            <section class="desal-calc__panel desal-calc__panel--inputs" aria-labelledby="calc-inputs-title">
                <header><h3 id="calc-inputs-title">Project inputs</h3><span>Editable</span></header>
                <div class="desal-calc__form">
                    <div class="desal-calc__row desal-calc__sources"><div><span>Source-water preset</span><small>Select a reference profile, then fine-tune the values below.</small></div><div id="src" class="desal-calc__seg"><button type="button" data-tds="18" data-rho="1014" data-nacl="78" aria-pressed="false">Baltic Sea</button><button type="button" data-tds="35" data-rho="1025" data-nacl="86" aria-pressed="true">Open ocean</button><button type="button" data-tds="42" data-rho="1030" data-nacl="88" aria-pressed="false">Red Sea</button></div></div>
                    <div class="desal-calc__row"><label for="tds">Total dissolved solids<small>Source-water salinity</small></label><div class="desal-calc__units"><input id="tds" type="number" min="0" step="0.1" value="35"><span class="u-tds">g/L</span></div></div>
                    <div class="desal-calc__row"><label for="rho">Water density<small>At project operating conditions</small></label><div class="desal-calc__units"><input id="rho" type="number" min="1" step="0.1" value="1025"><span class="u-rho">kg/m³</span></div></div>
                    <div class="desal-calc__row"><label for="nacl">NaCl share in recovered salts<small>Indicative composition</small></label><div class="desal-calc__units"><input id="nacl" type="number" min="0" max="100" step="1" value="86"><span>%</span></div></div>
                    <div class="desal-calc__row"><label for="q">Drinking water required<small>WHO-quality target output per day</small></label><div class="desal-calc__units"><input id="q" type="number" min="10000" step="1000" value="10000"><span class="u-vol">m³</span></div></div>
                    <div class="desal-calc__row"><label for="price">Electricity price<small>Regional operating assumption</small></label><div class="desal-calc__units"><input id="price" type="number" min="0" step="0.001" value="0.21"><span>$/kWh</span></div></div>
                    <div class="desal-calc__row"><label for="saltp">Technical salt value<small>Potential recovered-product value</small></label><div class="desal-calc__units"><input id="saltp" type="number" min="0" step="1" value="137"><span>$/t</span></div></div>
                    <div class="desal-calc__row"><label for="fee">Brine disposal fee<small>Applied to the RO comparison</small></label><div class="desal-calc__units"><input id="fee" type="number" min="0" step="0.01" value="0.65"><span>$/m³</span></div></div>
                    <div class="desal-calc__row"><label for="days">Operating days<small>Annual operating schedule</small></label><div class="desal-calc__units"><input id="days" type="number" min="1" max="365" step="1" value="350"><span>days</span></div></div>
                </div>
            </section>

            <div>
                <section class="desal-calc__panel desal-calc__panel--results" aria-labelledby="calc-results-title">
                    <div class="desal-calc__head"><h3 id="calc-results-title">ARBOK system estimate</h3><span id="regPill" class="desal-calc__pill">Europe</span></div>
                    <div class="desal-calc__outputs">
                        <div class="desal-calc__box"><span>Source-water intake / day</span><div class="desal-calc__output-value"><strong id="inV">—</strong><small class="u-vol">m³</small></div></div>
                        <div class="desal-calc__box out-water"><span>Drinking water / day</span><div class="desal-calc__output-value"><strong id="outW">—</strong><small class="u-vol">m³</small></div></div>
                        <div class="desal-calc__box out-salt"><span>Dry salt / day</span><div class="desal-calc__output-value"><strong id="outS">—</strong><small class="u-mass">t</small></div></div>
                    </div>
                    <div class="desal-calc__tablewrap"><table><thead><tr><th>Recovered product</th><th class="num">Daily</th><th class="num">Annual</th><th class="num">Annual value, $</th></tr></thead><tbody id="comp"></tbody></table></div>
                    <div class="desal-calc__kpis">
                        <div class="desal-calc__kpi"><span>ARBOK modules</span><strong id="units">—</strong><small>200 m³/day per module</small></div>
                        <div class="desal-calc__kpi"><span>Installed power</span><strong class="desal-calc__value"><b id="kw">—</b><em>kW</em></strong><small>Continuous system load</small></div>
                        <div class="desal-calc__kpi desal-calc__kpi--accent"><span>Annual saving vs RO</span><strong class="desal-calc__value"><em>$</em><b id="kSave">—</b></strong><small>OPEX and recovered salt value</small></div>
                    </div>
                </section>

                <section class="desal-calc__panel" style="margin-top:22px" aria-labelledby="calc-comparison-title">
                    <div class="desal-calc__head"><h3 id="calc-comparison-title">Performance comparison</h3><div class="desal-calc__legend"><span class="is-arbok">ARBOK</span><span class="is-ro">Conventional RO</span></div></div>
                    <div class="desal-calc__comparison">
                        <div class="desal-calc__bars">
                            <div class="desal-calc__bar"><header><span>Energy per day</span><span><span id="kA">—</span> vs <span id="kR">—</span> <span class="u-eunit">kWh/m³</span></span></header><div class="desal-calc__track"><div id="bE1" class="desal-calc__fill is-arbok"></div></div><div class="desal-calc__track" style="margin-top:4px"><div id="bE2" class="desal-calc__fill is-ro"></div></div><div class="desal-calc__bar-values"><span>ARBOK <b id="vE1">—</b></span><span>RO <b id="vE2">—</b></span></div></div>
                            <div class="desal-calc__bar"><header><span>Source-water intake</span><span>Recovery: <span id="recA">—</span></span></header><div class="desal-calc__track"><div id="bI1" class="desal-calc__fill is-arbok"></div></div><div class="desal-calc__track" style="margin-top:4px"><div id="bI2" class="desal-calc__fill is-ro"></div></div><div class="desal-calc__bar-values"><span>ARBOK <b id="vI1">—</b></span><span>RO <b id="vI2">—</b></span></div></div>
                            <div class="desal-calc__bar"><header><span>Liquid brine discharge</span><span>ARBOK: zero</span></header><div class="desal-calc__track"><div id="bB1" class="desal-calc__fill is-arbok"></div></div><div class="desal-calc__track" style="margin-top:4px"><div id="bB2" class="desal-calc__fill is-ro"></div></div><div class="desal-calc__bar-values"><span>ARBOK <b>0</b></span><span>RO <b id="vB2">—</b></span></div></div>
                            <div class="desal-calc__bar"><header><span>Net water cost</span><span>Including salt value</span></header><div class="desal-calc__track"><div id="bC1" class="desal-calc__fill is-arbok"></div></div><div class="desal-calc__track" style="margin-top:4px"><div id="bC2" class="desal-calc__fill is-ro"></div></div><div class="desal-calc__bar-values"><span>ARBOK <b id="vC1">—</b></span><span>RO <b id="vC2">—</b></span></div></div>
                        </div>
                    </div>
                    <div class="desal-calc__table-label"><span>Technical balance</span><small>Daily operating comparison</small></div>
                    <div class="desal-calc__tablewrap"><table><thead><tr><th>Operating metric</th><th class="num">ARBOK</th><th class="num">RO</th></tr></thead><tbody>
                        <tr><td>Energy use, kWh/day</td><td id="eA" class="num good">—</td><td id="eR" class="num">—</td></tr>
                        <tr><td>Intake, <span class="u-vol">m³</span>/day</td><td id="iA" class="num good">—</td><td id="iR" class="num">—</td></tr>
                        <tr><td>Brine, <span class="u-vol">m³</span>/day</td><td class="num good">0</td><td id="bR" class="num bad">—</td></tr>
                        <tr><td>RO brine salinity, <span class="u-tds">g/L</span></td><td class="num">—</td><td id="bS" class="num">—</td></tr>
                        <tr><td>Recovered dry salt, <span class="u-mass">t</span>/day</td><td id="sA" class="num good">—</td><td class="num">0</td></tr>
                        <tr><td>CO₂, t/day</td><td id="co2A" class="num good">—</td><td id="co2R" class="num">—</td></tr>
                    </tbody></table></div>
                    <div class="desal-calc__table-label"><span>Annual economics</span><small>Indicative values in USD</small></div>
                    <div class="desal-calc__tablewrap"><table><thead><tr><th>Cost or value</th><th class="num">ARBOK</th><th class="num">RO</th></tr></thead><tbody>
                        <tr><td>Electricity</td><td id="oEA" class="num">—</td><td id="oER" class="num">—</td></tr><tr><td>Maintenance</td><td id="oMA" class="num">—</td><td id="oMR" class="num">—</td></tr><tr><td>Chemicals</td><td class="num">0</td><td id="oCR" class="num">—</td></tr><tr><td>Brine disposal</td><td class="num">0</td><td id="oBR" class="num">—</td></tr><tr><td>Gross OPEX</td><td id="oTA" class="num">—</td><td id="oTR" class="num">—</td></tr><tr><td>Recovered salt value</td><td id="oSA" class="num good">—</td><td class="num">0</td></tr><tr><td>Net annual cost</td><td id="oNA" class="num good">—</td><td id="oNR" class="num">—</td></tr><tr><td>Net cost per output unit</td><td id="pmA" class="num good">—</td><td id="pmR" class="num">—</td></tr>
                    </tbody></table></div>
                    <span id="kN" hidden></span><span id="kRP" hidden></span><span id="yW" hidden></span><span id="yS" hidden></span><span id="yE" hidden></span><span id="kSalt" hidden></span>
                </section>
            </div>
        </form>

        <section class="desal-calc__request" aria-labelledby="proposal-title">
            <div class="desal-calc__request-grid"><div class="desal-calc__request-form"><p class="eyebrow dark">Project follow-up</p><h3 id="proposal-title">Request an engineering review.</h3><p>Enter your contact details to prepare a concise project summary for the ARBOK team.</p><div class="desal-calc__row"><label for="nm">Name</label><input id="nm" type="text"></div><div class="desal-calc__row"><label for="co">Company and country</label><input id="co" type="text"></div><div class="desal-calc__row"><label for="em">Email</label><input id="em" type="email"></div><div class="desal-calc__row"><label for="ph">Phone</label><input id="ph" type="tel"></div><button id="mk" class="desal-calc__button desal-calc__button--prepare" type="button">Prepare request</button></div>
            <div id="req" class="desal-calc__summary" hidden><label for="txt"><strong>Project summary</strong></label><textarea id="txt" readonly></textarea><div class="desal-calc__buttons"><a id="mailto" class="desal-calc__button" href="mailto:info@arbok.tech">Send by email</a><button id="cp" class="desal-calc__button is-ghost" type="button">Copy summary</button></div></div></div>
        </section>
        <p class="desal-calc__method">This calculator provides an indicative pre-feasibility comparison based on user-supplied assumptions and standard reference coefficients. It is not a binding technical proposal, performance guarantee or investment recommendation. Final system configuration requires water analysis and ARBOK engineering review.</p>
    </div>
</main>
<?php get_footer(); ?>
