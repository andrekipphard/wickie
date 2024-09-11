<?php
    $highlightText = get_sub_field('highlight_text');
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
?>
<section class="market">
    <div class="container">
        <div class="content-wrapper">
            <div class="subline">
                <span class="highlight"><?= $highlightText; ?></span>
            </div>
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
            <div class="market-values">
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img id="btc-icon" loading="lazy" decoding="async" src="" alt="Bitcoin">
                        </div>
                        <div class="name">
                            <h3>Bitcoin</h3>
                            <span>BTC</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="btc-price">...</span> <span class="currency-label">USD</span></span>
                        <canvas id="btc-chart" width="100" height="50"></canvas>
                    </div>
                </div>
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img id="eth-icon" loading="lazy" decoding="async" src="" alt="Ethereum">
                        </div>
                        <div class="name">
                            <h3>Ethereum</h3>
                            <span>ETH</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="eth-price">...</span> <span class="currency-label">USD</span></span>
                        <canvas id="eth-chart" width="100" height="50"></canvas>
                    </div>
                </div>
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img id="sol-icon" loading="lazy" decoding="async" src="" alt="Solana">
                        </div>
                        <div class="name">
                            <h3>Solana</h3>
                            <span>SOL</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="sol-price">...</span> <span class="currency-label">USD</span></span>
                        <canvas id="sol-chart" width="100" height="50"></canvas>
                    </div>
                </div>
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img id="doge-icon" loading="lazy" decoding="async" src="" alt="Dogecoin">
                        </div>
                        <div class="name">
                            <h3>Dogecoin</h3>
                            <span>DOGE</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="doge-price">...</span> <span class="currency-label">USD</span></span>
                        <canvas id="doge-chart" width="100" height="50"></canvas>
                    </div>
                </div>
                <div class="market-value">
                    <div class="currency">
                        <div class="image">
                            <img id="xrp-icon" loading="lazy" decoding="async" src="" alt="Ripple">
                        </div>
                        <div class="name">
                            <h3>Ripple</h3>
                            <span>XRP</span>
                        </div>
                    </div>
                    <div class="value">
                        <span><span id="xrp-price">...</span> <span class="currency-label">USD</span></span>
                        <canvas id="xrp-chart" width="100" height="50"></canvas>
                    </div>
                </div>
            </div>
            <div class="currency-selector">
                <select id="currency">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                </select>
            </div>
        </div>
    </div> 
</section>


<script>
const coingeckoApiUrl = 'https://api.coingecko.com/api/v3/coins/';

// Function to fetch and cache crypto icons from CoinGecko
async function fetchAndCacheCryptoIcons() {
    const cryptoSymbols = {
        BTC: 'bitcoin',
        ETH: 'ethereum',
        SOL: 'solana',
        DOGE: 'dogecoin',
        XRP: 'ripple'
    };

    const cache = {};

    for (const [symbol, id] of Object.entries(cryptoSymbols)) {
        const cachedIcon = localStorage.getItem(id);
        if (cachedIcon) {
            cache[symbol] = cachedIcon;
        } else {
            try {
                const response = await fetch(`${coingeckoApiUrl}${id}`);
                const data = await response.json();
                const imageUrl = data.image.large;
                localStorage.setItem(id, imageUrl);
                cache[symbol] = imageUrl;
            } catch (error) {
                console.error(`Error fetching icon for ${symbol}:`, error);
            }
        }
    }

    return cache;
}

async function updateCryptoIcons() {
    const icons = await fetchAndCacheCryptoIcons();

    Object.keys(icons).forEach(symbol => {
        const imageUrl = icons[symbol];
        const imgElement = document.querySelector(`#${symbol.toLowerCase()}-icon`);
        if (imgElement) {
            imgElement.src = imageUrl;
        }
    });
}

// Call this function when initializing or updating
updateCryptoIcons();

async function fetchWithRetry(url, retries = 5, delay = 1000) {
    try {
        const response = await fetch(url);
        if (response.status === 429) {
            throw new Error('Rate limit exceeded');
        }
        return await response.json();
    } catch (error) {
        if (retries > 0 && error.message === 'Rate limit exceeded') {
            await new Promise(res => setTimeout(res, delay));
            return fetchWithRetry(url, retries - 1, delay * 2);
        } else {
            throw error;
        }
    }
}

let krakenSocket = new WebSocket('wss://ws.kraken.com');
let currentCurrency = "USD";

function getSubscribeMessages(currency) {
    return {
        BTC: { event: "subscribe", pair: [`XBT/${currency}`], subscription: { name: "ticker" } },
        ETH: { event: "subscribe", pair: [`ETH/${currency}`], subscription: { name: "ticker" } },
        SOL: { event: "subscribe", pair: [`SOL/${currency}`], subscription: { name: "ticker" } },
        DOGE: { event: "subscribe", pair: [`XDG/${currency}`], subscription: { name: "ticker" } },
        XRP: { event: "subscribe", pair: [`XRP/${currency}`], subscription: { name: "ticker" } }
    };
}

function subscribeToCryptoPrices(currency) {
    const messages = getSubscribeMessages(currency);

    Object.keys(messages).forEach(key => {
        krakenSocket.send(JSON.stringify({ event: "unsubscribe", pair: [`${key}/${currentCurrency}`], subscription: { name: "ticker" } }));
    });

    Object.keys(messages).forEach(key => {
        krakenSocket.send(JSON.stringify(messages[key]));
    });

    updateCurrencyLabels(currency);
    currentCurrency = currency;
}

krakenSocket.onopen = function() {
    subscribeToCryptoPrices(currentCurrency);
};

krakenSocket.onmessage = function(event) {
    const data = JSON.parse(event.data);
    if (data[1] && data[1].c) {
        const price = parseFloat(data[1].c[0]).toFixed(2);

        if (data[3] === `XBT/${currentCurrency}`) {
            document.getElementById('btc-price').innerText = price;
        } else if (data[3] === `ETH/${currentCurrency}`) {
            document.getElementById('eth-price').innerText = price;
        } else if (data[3] === `SOL/${currentCurrency}`) {
            document.getElementById('sol-price').innerText = price;
        } else if (data[3] === `XDG/${currentCurrency}`) {
            document.getElementById('doge-price').innerText = price;
        } else if (data[3] === `XRP/${currentCurrency}`) {
            document.getElementById('xrp-price').innerText = price;
        }
    }
};

document.getElementById('currency').addEventListener('change', function() {
    const selectedCurrency = this.value;
    subscribeToCryptoPrices(selectedCurrency);
});

function updateCurrencyLabels(currency) {
    const labels = document.querySelectorAll('.currency-label');
    labels.forEach(function(label) {
        label.innerText = currency;
    });
}

async function fetchHistoricalData(cryptoId, currency, days) {
    const url = `https://api.kraken.com/0/public/OHLC?pair=${cryptoId}&interval=1440`;
    const data = await fetchWithRetry(url);

    if (data.result) {
        // Adjust the structure based on actual data
        const pairs = Object.keys(data.result);
        if (pairs.length > 0) {
            const prices = data.result[pairs[0]].map(item => [item[0] * 1000, parseFloat(item[4])]);
            return prices;
        }
    }
    throw new Error('Unexpected data structure');
}



// Function to initialize a chart
async function initCustomDecimalChart(cryptoId, canvasId, currency, days) {
    try {
        const prices = await fetchHistoricalData(cryptoId, currency, days);
        
        // Extract timestamps and prices
        const timestamps = prices.map(price => new Date(price[0]).toLocaleDateString());
        const priceData = prices.map(price => price[1]);

        // Create Chart.js chart
        const ctx = document.getElementById(canvasId).getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: timestamps,
                datasets: [{
                    label: `${cryptoId} Price`,
                    data: priceData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: '#4caf50',
                    borderWidth: 1,
                    tension: 0.4
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                scales: {
                    x: { 
                        display: false,
                        grid: { display: false }
                    },
                    y: { 
                        display: false,
                        grid: { display: false },
                        ticks: {
                            callback: function(value) {
                                return value.toFixed(8);
                            }
                        }
                    }
                },
                elements: {
                    point: { radius: 0 },
                    line: { borderWidth: 2 }
                }
            }
        });
    } catch (error) {
        console.error(`Error initializing chart for ${cryptoId}:`, error);
    }
}

// Initialize charts with historical data
initCustomDecimalChart('XBTUSD', 'btc-chart', 'usd', 7);
initCustomDecimalChart('ETHUSD', 'eth-chart', 'usd', 7);
initCustomDecimalChart('SOLUSD', 'sol-chart', 'usd', 7);
initCustomDecimalChart('XDGUSD', 'doge-chart', 'usd', 7);
initCustomDecimalChart('XRPUSD', 'xrp-chart', 'usd', 7);

</script>
