<?php
get_header();
$book_image = get_template_directory_uri() . '/assets/images/book/critical-metals-book.svg';
$amazon_url = 'https://www.amazon.com/dp/B0HJ5S55Q8';
?>
<section class="book-hero">
    <div class="book-hero__bg" aria-hidden="true"></div>
    <div class="shell book-hero__grid">
        <div class="book-hero__copy">
            <?php arbok_breadcrumbs(); ?>
            <p class="eyebrow">New book from ARBOK Institute</p>
            <h1>Critical Metals: A New Strategic Approach</h1>
            <p class="book-hero__lede">52 critical elements — from lithium and vanadium to rhenium and the rare earths — examined through one strategic question: where is the metal already dissolved, who is already paying to bury it, and what is that stream worth once the metal comes out of it?</p>
            <div class="book-facts" aria-label="Book facts">
                <div><strong>52</strong><span>critical elements</span></div>
                <div><strong>34</strong><span>Kindle chapters</span></div>
                <div><strong>2035</strong><span>strategic horizon</span></div>
            </div>
            <div class="button-row">
                <a class="button book-buy-button" href="<?php echo esc_url($amazon_url); ?>" target="_blank" rel="noopener sponsored">Buy Kindle edition on Amazon <span>↗</span></a>
                <a class="button button-ghost" href="#book-thesis">Read the thesis</a>
            </div>
        </div>
        <figure class="book-hero__visual">
            <img src="<?php echo esc_url($book_image); ?>" alt="Critical Metals: A New Strategic Approach by Michael Vischmidt" fetchpriority="high">
        </figure>
    </div>
</section>

<section id="book-thesis" class="section book-thesis">
    <div class="shell book-thesis__grid">
        <div>
            <p class="eyebrow dark">Strategic thesis</p>
            <h2>The critical metals gap does not close underground.</h2>
        </div>
        <div class="prose">
            <p>By 2035 the world needs roughly <strong>$400 billion</strong> of critical metals. About <strong>$30 billion</strong> is committed to new mines. That gap does not close underground.</p>
            <p>The book reframes the search for critical minerals around streams that already exist at the surface: mine waters, brines, residues, industrial effluents and waste flows that companies and municipalities are already paying to manage.</p>
            <p>For each element, the same diligence logic applies: where is it already dissolved, who owns or pays for that stream, and what value can be recovered when the metal is separated from it?</p>
        </div>
    </div>
</section>

<section class="section book-market">
    <div class="shell">
        <div class="section-heading">
            <div><p class="eyebrow dark">Why this matters</p><h2>A surface-resource strategy for a metals-constrained decade.</h2></div>
        </div>
        <div class="book-market-grid">
            <article><span>01</span><h3>Critical materials demand</h3><p>Energy systems, electrification, electronics, defense, advanced industry and infrastructure all require a broader and more secure critical-metals base.</p></article>
            <article><span>02</span><h3>Mine finance gap</h3><p>New mines alone cannot meet the capital, timing, permitting and geopolitical requirements implied by the 2035 demand horizon.</p></article>
            <article><span>03</span><h3>Dissolved resources</h3><p>Many valuable elements are already present in liquid and semi-liquid streams that are treated as liabilities rather than recoverable resource flows.</p></article>
            <article><span>04</span><h3>ARBOK relevance</h3><p>The institute’s Zero Waste Discharge logic aligns with the book’s core premise: waste streams can become strategic material supply channels.</p></article>
        </div>
    </div>
</section>

<section class="section book-author">
    <div class="shell book-author__grid">
        <div class="book-author__card">
            <p class="eyebrow">Author</p>
            <h2>Michael Vischmidt</h2>
            <p>Strategic Research Institute ARBOK</p>
        </div>
        <div class="prose">
            <h2>For readers focused on materials strategy, recovery economics and industrial resilience.</h2>
            <p><em>Critical Metals: A New Strategic Approach</em> is written for readers evaluating how the next critical-minerals cycle can be supplied without depending only on new mining capacity.</p>
            <p>The Kindle edition is available on Amazon.</p>
            <a class="button button-dark" href="<?php echo esc_url($amazon_url); ?>" target="_blank" rel="noopener sponsored">Open on Amazon <span>↗</span></a>
        </div>
    </div>
</section>

<section class="section book-cta">
    <div class="shell book-cta__inner">
        <div><p class="eyebrow">Kindle edition</p><h2>Read the ARBOK Institute book on critical metals.</h2></div>
        <a class="button" href="<?php echo esc_url($amazon_url); ?>" target="_blank" rel="noopener sponsored">Buy on Amazon <span>↗</span></a>
    </div>
</section>
<?php get_footer(); ?>
