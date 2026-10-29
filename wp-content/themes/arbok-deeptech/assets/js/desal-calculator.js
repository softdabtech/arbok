document.addEventListener('DOMContentLoaded', () => {
  const root = document.getElementById('arbok-desal-calculator');
  if (!root) return;

  const E_A = 2.5;
  const E_NET = 0.72;
  const E_R = 7;
  const E_RP = 4;
  const E_RP_LO = 3.5;
  const RO_REC = 0.45;
  const MOD = 200;
  const M_A = 0.05;
  const M_R = 0.20;
  const CH_R = 0.15;
  const REG = {
    EU: { price: 0.21, salt: 137, fee: 0.65, co2: 0.25, name: 'Europe' },
    US: { price: 0.092, salt: 112, fee: 0, co2: 0.37, name: 'USA' },
  };
  const GAL = 0.003785411784;
  const STON = 0.90718474;
  const LBFT3 = 0.0624279606;
  let useUS = false;
  let region = 'EU';
  const el = (id) => root.querySelector(`#${id}`);
  const up = (n) => {
    if (!Number.isFinite(n) || n <= 0) return 0;
    const p = Math.pow(10, Math.floor(Math.log10(n)) - 2);
    return Math.ceil(n / p - 1e-9) * p;
  };
  const down = (n) => {
    if (!Number.isFinite(n) || n <= 0) return 0;
    const p = Math.pow(10, Math.floor(Math.log10(n)) - 2);
    return Math.floor(n / p + 1e-9) * p;
  };
  const show = (value) => value.toLocaleString('en-US', { maximumFractionDigits: value < 1 ? 3 : value < 10 ? 2 : value < 100 ? 1 : 0 });
  const format = (n) => show(up(n));
  const formatDown = (n) => show(down(n));
  const volume = (m3) => useUS ? m3 / GAL : m3;
  const mass = (tonnes) => useUS ? tonnes / STON : tonnes;
  const tdsDisplay = (gl) => useUS ? gl * 1000 : gl;
  const densityDisplay = (rho) => useUS ? rho * LBFT3 : rho;
  const inputTds = () => useUS ? (+el('tds').value || 0) / 1000 : (+el('tds').value || 0);
  const inputDensity = () => useUS ? (+el('rho').value || 0) / LBFT3 : (+el('rho').value || 0);
  const inputOutput = () => useUS ? (+el('q').value || 0) * GAL : (+el('q').value || 0);

  const setBar = (id, value, max) => {
    el(id).style.width = `${max > 0 ? Math.max(value / max * 100, 0) : 0}%`;
  };

  function calculate() {
    const tds = Math.max(inputTds(), 0);
    const rho = Math.max(inputDensity(), tds + 1);
    const q = Math.max(inputOutput(), 10000);
    const powerPrice = Math.max(+el('price').value || 0, 0);
    const saltPrice = Math.max(+el('saltp').value || 0, 0);
    const brineFee = Math.max(+el('fee').value || 0, 0);
    const days = Math.min(Math.max(+el('days').value || 0, 0), 365);
    const nacl = Math.min(Math.max(+el('nacl').value || 0, 0), 100);
    const intake = q * 1000 / (rho - tds);
    const salt = intake * tds / 1000;
    const roIntake = q / RO_REC;
    const roBrine = roIntake - q;
    const roBrineSalinity = tds * roIntake / roBrine;
    const arbokEnergy = q * E_A;
    const roEnergy = q * E_R;
    const energyUnit = useUS ? 1000 * GAL : 1;
    const volumeUnit = useUS ? ' gal' : ' m³';

    el('inV').textContent = formatDown(volume(intake));
    el('outW').textContent = format(volume(q));
    el('outS').textContent = format(mass(salt));
    el('comp').innerHTML = `<tr><td>Dry salt, NaCl ${show(nacl)}%</td><td class="num">${format(mass(salt))}</td><td class="num">${format(mass(salt * days))}</td><td class="num good">${format(salt * saltPrice * days)}</td></tr>`;
    const modules = Math.max(1, Math.ceil(q / MOD - 1e-4));
    el('units').textContent = show(modules);
    el('kw').textContent = formatDown(arbokEnergy / 24);
    el('yW').textContent = format(volume(q * days));
    el('yS').textContent = format(mass(salt * days));
    el('yE').textContent = formatDown(arbokEnergy * days);
    el('kA').textContent = formatDown(E_A * energyUnit);
    el('kN').textContent = formatDown(E_NET * energyUnit);
    el('kRP').textContent = `${show(+(E_RP_LO * energyUnit).toFixed(1))}–${show(+(E_RP * energyUnit).toFixed(1))}`;
    el('kR').textContent = `from ${show(+(E_R * energyUnit).toFixed(1))}`;
    el('eA').textContent = formatDown(arbokEnergy);
    el('eR').textContent = format(roEnergy);
    el('iA').textContent = formatDown(volume(intake));
    el('iR').textContent = format(volume(roIntake));
    el('recA').textContent = `${format(q / intake * 100)}%`;
    el('bR').textContent = format(volume(roBrine));
    el('bS').textContent = format(tdsDisplay(roBrineSalinity));
    el('sA').textContent = format(mass(salt));
    el('co2A').textContent = formatDown(arbokEnergy * REG[region].co2 / 1000);
    el('co2R').textContent = format(roEnergy * REG[region].co2 / 1000);

    const arbokEnergyCost = arbokEnergy * powerPrice * days;
    const roEnergyCost = roEnergy * powerPrice * days;
    const arbokMaintenance = q * M_A * days;
    const roMaintenance = q * M_R * days;
    const roChemicals = q * CH_R * days;
    const roBrineCost = roBrine * brineFee * days;
    const saltRevenue = salt * saltPrice * days;
    const arbokTotal = arbokEnergyCost + arbokMaintenance;
    const roTotal = roEnergyCost + roMaintenance + roChemicals + roBrineCost;
    const arbokNet = arbokTotal - saltRevenue;
    const waterYear = q * days;
    const perUnit = useUS ? 1000 * GAL : 1;
    const arbokPer = arbokNet / waterYear * perUnit;
    const roPer = roTotal / waterYear * perUnit;

    el('oEA').textContent = formatDown(arbokEnergyCost);
    el('oER').textContent = format(roEnergyCost);
    el('oMA').textContent = formatDown(arbokMaintenance);
    el('oMR').textContent = format(roMaintenance);
    el('oCR').textContent = format(roChemicals);
    el('oBR').textContent = format(roBrineCost);
    el('oTA').textContent = formatDown(arbokTotal);
    el('oTR').textContent = format(roTotal);
    el('oSA').textContent = format(saltRevenue);
    el('oNA').textContent = arbokNet < 0 ? `+${format(-arbokNet)} profit` : formatDown(arbokNet);
    el('oNR').textContent = format(roTotal);
    el('pmA').textContent = arbokPer < 0 ? `+${format(-arbokPer)} profit` : formatDown(arbokPer);
    el('pmR').textContent = format(roPer);
    el('kSave').textContent = format(roTotal - arbokTotal + saltRevenue);
    el('kSalt').textContent = format(saltRevenue);
    setBar('bE1', arbokEnergy, roEnergy); setBar('bE2', roEnergy, roEnergy);
    setBar('bI1', intake, roIntake); setBar('bI2', roIntake, roIntake);
    setBar('bB1', 0, roBrine); setBar('bB2', roBrine, roBrine);
    setBar('bC1', Math.max(arbokPer, 0), roPer); setBar('bC2', roPer, roPer);
    el('vE1').textContent = `${formatDown(arbokEnergy)} kWh`;
    el('vE2').textContent = `${format(roEnergy)} kWh`;
    el('vI1').textContent = `${formatDown(volume(intake))}${volumeUnit}`;
    el('vI2').textContent = `${format(volume(roIntake))}${volumeUnit}`;
    el('vB2').textContent = `${format(volume(roBrine))}${volumeUnit}`;
    el('vC1').textContent = arbokPer < 0 ? 'profit' : `$${formatDown(arbokPer)}`;
    el('vC2').textContent = `$${format(roPer)}`;
    return { q, days, nacl, salt, intake, arbokEnergy, modules, roTotal, arbokTotal, saltRevenue, powerPrice };
  }

  function setUnits(us) {
    const tds = inputTds(); const rho = inputDensity(); const q = inputOutput();
    useUS = us;
    el('uM').setAttribute('aria-pressed', String(!us)); el('uU').setAttribute('aria-pressed', String(us));
    root.querySelectorAll('.u-vol').forEach((node) => { node.textContent = us ? 'gal' : 'm³'; });
    root.querySelectorAll('.u-vol1').forEach((node) => { node.textContent = us ? '1,000 gal' : 'm³'; });
    root.querySelectorAll('.u-mass').forEach((node) => { node.textContent = us ? 'short tons' : 't'; });
    root.querySelectorAll('.u-tds').forEach((node) => { node.textContent = us ? 'ppm' : 'g/L'; });
    root.querySelectorAll('.u-rho').forEach((node) => { node.textContent = us ? 'lb/ft³' : 'kg/m³'; });
    root.querySelectorAll('.u-eunit').forEach((node) => { node.textContent = us ? 'kWh/1,000 gal' : 'kWh/m³'; });
    el('q').min = us ? Math.round(10000 / GAL) : 10000;
    el('tds').value = +tdsDisplay(tds).toFixed(us ? 0 : 2);
    el('rho').value = +densityDisplay(rho).toFixed(2);
    el('q').value = +volume(q).toFixed(0);
    calculate();
  }

  function setRegion(nextRegion) {
    region = nextRegion;
    el('rEU').setAttribute('aria-pressed', String(nextRegion === 'EU'));
    el('rUS').setAttribute('aria-pressed', String(nextRegion === 'US'));
    el('price').value = REG[nextRegion].price; el('saltp').value = REG[nextRegion].salt; el('fee').value = REG[nextRegion].fee;
    el('regPill').textContent = REG[nextRegion].name;
    if ((nextRegion === 'US') !== useUS) setUnits(nextRegion === 'US'); else calculate();
  }

  root.querySelectorAll('#src button').forEach((button) => button.addEventListener('click', () => {
    root.querySelectorAll('#src button').forEach((item) => item.setAttribute('aria-pressed', 'false'));
    button.setAttribute('aria-pressed', 'true');
    el('tds').value = +tdsDisplay(+button.dataset.tds).toFixed(useUS ? 0 : 2);
    el('rho').value = +densityDisplay(+button.dataset.rho).toFixed(2);
    el('nacl').value = button.dataset.nacl;
    calculate();
  }));
  ['tds', 'rho'].forEach((id) => el(id).addEventListener('input', () => root.querySelectorAll('#src button').forEach((item) => item.setAttribute('aria-pressed', 'false'))));
  el('uM').addEventListener('click', () => useUS && setUnits(false));
  el('uU').addEventListener('click', () => !useUS && setUnits(true));
  el('rEU').addEventListener('click', () => region !== 'EU' && setRegion('EU'));
  el('rUS').addEventListener('click', () => region !== 'US' && setRegion('US'));
  el('desal-f').addEventListener('input', calculate);
  el('desal-f').addEventListener('submit', (event) => event.preventDefault());
  el('mk').addEventListener('click', () => {
    const result = calculate();
    const volumeUnit = useUS ? 'gal' : 'm3';
    const massUnit = useUS ? 'short tons' : 't';
    const body = `Arbok-Desal proposal request (seawater, drinking water WHO)\nName: ${el('nm').value || '—'}\nCompany, country: ${el('co').value || '—'}\nEmail: ${el('em').value || '—'}\nPhone: ${el('ph').value || '—'}\nRegion: ${REG[region].name}\nSalinity: ${el('tds').value} ${useUS ? 'ppm' : 'g/L'}, density ${el('rho').value} ${useUS ? 'lb/ft3' : 'kg/m3'}, NaCl ${result.nacl}%\nDrinking water needed: ${format(volume(result.q))} ${volumeUnit}/day, ${result.days} days/year\nElectricity $${result.powerPrice}/kWh, technical salt $${el('saltp').value}/t\nEstimate: ${result.modules} Arbok-Desal units, ${formatDown(result.arbokEnergy / 24)} kW, dry salt ${format(mass(result.salt))} ${massUnit}/day, saving vs RO $${format(result.roTotal - result.arbokTotal + result.saltRevenue)}/year`;
    el('txt').value = body;
    el('mailto').href = `mailto:info@arbok.tech?subject=${encodeURIComponent(`Arbok-Desal proposal request — ${el('co').value || 'new client'}`)}&body=${encodeURIComponent(body)}`;
    el('req').hidden = false;
    el('req').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  });
  el('cp').addEventListener('click', () => {
    const text = el('txt');
    if (navigator.clipboard) navigator.clipboard.writeText(text.value).then(() => { el('cp').textContent = 'Copied'; }, () => text.select());
    else text.select();
  });
  calculate();
});
