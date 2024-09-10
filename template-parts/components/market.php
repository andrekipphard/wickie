<?php
    $highlightText = get_sub_field('highlight_text');
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
?>
<section class="market">
    <div class="container">
        <div class="content-wrapper">
            <div class="subline">
            <span class="highlight">
                <?= $highlightText; ?>
            </span>
            </div>
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
            <div class="market-values">
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/bitcoin.png'?>">
                        </div>
                        <div class="name">
                            <h3>Bitcoin</h3>
                            <span>BTC</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="btc-price">...</span> USD</span>
                        <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/green-small-chart.svg'?>">
                    </div>
                </div>
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/ethereum.png'?>">
                        </div>
                        <div class="name">
                            <h3>Ethereum</h3>
                            <span>ETH</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="eth-price">...</span> USD</span>
                        <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/green-small-chart.svg'?>">
                    </div>
                </div>
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/solana.png'?>">
                        </div>
                        <div class="name">
                            <h3>Solana</h3>
                            <span>SOL</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="sol-price">...</span> USD</span>
                        <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/green-small-chart.svg'?>">
                    </div>
                </div>
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/dogecoin.png'?>">
                        </div>
                        <div class="name">
                            <h3>Dogecoin</h3>
                            <span>DOGE</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="doge-price">...</span> USD</span>
                        <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/green-small-chart.svg'?>">
                    </div>
                </div>
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/xrp-symbol-white-128.png'?>">
                        </div>
                        <div class="name">
                            <h3>Ripple</h3>
                            <span>XRP</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="xrp-price">...</span> USD</span>
                        <img loading="lazy" decoding="async" src="<?= get_template_directory_uri(). '/assets/images/market/green-small-chart.svg'?>">
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
<script>
// Kraken WebSocket connection
const krakenSocket = new WebSocket('wss://ws.kraken.com');

// Subscription messages for each cryptocurrency pair
const subscribeMessages = {
    BTC: { event: "subscribe", pair: ["XBT/USD"], subscription: { name: "ticker" } },
    ETH: { event: "subscribe", pair: ["ETH/USD"], subscription: { name: "ticker" } },
    SOL: { event: "subscribe", pair: ["SOL/USD"], subscription: { name: "ticker" } },
    DOGE: { event: "subscribe", pair: ["XDG/USD"], subscription: { name: "ticker" } },
    XRP: { event: "subscribe", pair: ["XRP/USD"], subscription: { name: "ticker" } }
};

// Send subscription messages when the connection opens
krakenSocket.onopen = function() {
    krakenSocket.send(JSON.stringify(subscribeMessages.BTC));
    krakenSocket.send(JSON.stringify(subscribeMessages.ETH));
    krakenSocket.send(JSON.stringify(subscribeMessages.SOL));
    krakenSocket.send(JSON.stringify(subscribeMessages.DOGE));
    krakenSocket.send(JSON.stringify(subscribeMessages.XRP));
};

// Update corresponding price element when a message is received
krakenSocket.onmessage = function(event) {
    const data = JSON.parse(event.data);
    if (data[1] && data[1].c) { // 'c' is for the close price
        const price = parseFloat(data[1].c[0]).toFixed(2);
        
        // Check which cryptocurrency the data belongs to by checking the pair
        if (data[3] === "XBT/USD") {
            document.getElementById('btc-price').innerText = price;
        } else if (data[3] === "ETH/USD") {
            document.getElementById('eth-price').innerText = price;
        } else if (data[3] === "SOL/USD") {
            document.getElementById('sol-price').innerText = price;
        } else if (data[3] === "XDG/USD") {
            document.getElementById('doge-price').innerText = price;
        } else if (data[3] === "XRP/USD") {
            document.getElementById('xrp-price').innerText = price;
        }
    }
};

</script>

<section class="market">
    <div class="container">
        <div class="content-wrapper">
            <div class="subline">
            <span class="highlight">
                <?= $highlightText; ?>
            </span>
            </div>
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
            <?php if( have_rows('market_value')):?>
                <div class="market-values">
                    <?php while( have_rows('market_value') ): the_row();
                    $name = get_sub_field('name');
                    $currency = get_sub_field('currency');
                    $value = get_sub_field('value');
                    $chartImage = get_sub_field('chart_image');
                    $currencyImage = get_sub_field('currency_image');?>
                        <div class="market-value">
                            <div class="currency">
                                <div class="image">
                                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($currencyImage, 'large');?>">
                                </div>
                                <div class="name">
                                    <h3><?= $name; ?></h3>
                                    <span><?= $currency; ?></span>
                                </div>
                            </div>
                            <div class="value">
                                <span><?= $value; ?></span>
                                <img loading="lazy" decoding="async" src="<?= wp_get_attachment_image_url($chartImage, 'large');?>">
                            </div>
                        </div>
                    <?php endwhile;?>
                    <div class="market-value btc">
                    <script src="https://widgets.coingecko.com/gecko-coin-price-chart-widget.js"></script>
<gecko-coin-price-chart-widget locale="en" initial-currency="usd" style="width: 100%"></gecko-coin-price-chart-widget>
                    </div>
                    <div class="market-value eth">
                    <script src="https://widgets.coingecko.com/gecko-coin-price-chart-widget.js"></script>
<gecko-coin-price-chart-widget locale="en" initial-currency="usd" style="width: 100%" coin-id="ethereum"></gecko-coin-price-chart-widget>
                    </div>
                    <div class="market-value dogecoin">
                    <script src="https://widgets.coingecko.com/gecko-coin-price-chart-widget.js"></script>
<gecko-coin-price-chart-widget locale="en" initial-currency="usd" style="width: 100%" coin-id="dogecoin"></gecko-coin-price-chart-widget>
                    </div>
                    <div class="market-value cardano">
                    <script src="https://widgets.coingecko.com/gecko-coin-price-chart-widget.js"></script>
<gecko-coin-price-chart-widget locale="en" initial-currency="usd" style="width: 100%" coin-id="solana"></gecko-coin-price-chart-widget>
                    </div>
                    <script src="https://widgets.coingecko.com/gecko-coin-list-widget.js"></script>
<gecko-coin-list-widget locale="en" coin-ids="bitcoin,ethereum,dogecoin,cardano,solana,ripple" initial-currency="usd" style="width: 100%"></gecko-coin-list-widget>
                </div>
            <?php endif;?>
        </div>
    </div>

</section>
<script>
document.querySelectorAll('gecko-coin-price-chart-widget').forEach(widgetChart => {
    const shadowRootChart = widgetChart.shadowRoot;
    const styleChart = document.createElement('style');
    styleChart.textContent = `
    .gecko-widget {
        margin-top: 40px;
        flex-wrap: wrap;
        img {
        height: 50px!important;
        margin-right: 20px;
    }
    .gecko-price {
        font-size: 16px!important;
        font-weight: 400;
    }
    .gecko-text-dark {
        font-size: 1.75rem;
    }
    .gecko-text-light {
        font-size: 16px;
        margin-top: 20px;
    }
    .gecko-coin-details, .gecko-chart {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-basis: calc(50% - 20px);
        justify-content: space-between;
        padding: 0;
    }
    .gecko-watermark, .gecko-chart {
        display: none;
    }
    `;
    shadowRootChart.appendChild(styleChart);
});

// Styling for the gecko-coin-list-widget
const widget = document.querySelector('gecko-coin-list-widget');
const shadowRoot = widget.shadowRoot;
const style = document.createElement('style');
style.textContent = `
.gecko-widget {
    margin-top: 40px;
    display: flex;
    flex-direction: row;
    gap: 40px;
    flex-wrap: wrap;
    img {
        height: 50px!important;
        margin-right: 20px;
    }
    font-size: 1.75rem;
}
.gecko-list-item {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-basis: calc(50% - 20px);
    justify-content: space-between;
    padding: 0;
}
.gecko-divider, .gecko-dropdown, .gecko-text-light {
    display: none;
}
.gecko-price {
    font-size: 16px;
}
.gecko-widget img {
    height: 50px !important;
    margin-right: 20px;
}
.gecko-divider + div {
    width: 100%;
}
`;
shadowRoot.appendChild(style);
</script>

