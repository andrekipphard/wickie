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
            <div id="market-values-container" class="market-values"></div>

            <button class="btn btn-primary" id="show-more-button">Show More</button>

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
const cryptos = [
    { name: 'Bitcoin', symbol: 'XBT', id: 'bitcoin', imageUrl: 'https://www.cryptocompare.com/media/37746251/btc.png' },
    { name: 'Ethereum', symbol: 'ETH', id: 'ethereum', imageUrl: 'https://www.cryptocompare.com/media/37746238/eth.png' },
    { name: 'Solana', symbol: 'SOL', id: 'solana', imageUrl: 'https://www.cryptocompare.com/media/37747734/sol.png' },
    { name: 'Dogecoin', symbol: 'XDG', id: 'dogecoin', imageUrl: 'https://www.cryptocompare.com/media/37746339/doge.png' },
    { name: 'Ripple', symbol: 'XRP', id: 'ripple', imageUrl: 'https://www.cryptocompare.com/media/38553096/xrp.png' },
    { name: 'ApeCoin', symbol: 'APE', id: 'apecoin', imageUrl: 'https://www.cryptocompare.com/media/39838302/ape.png' },
    { name: 'Avalanche', symbol: 'AVAX', id: 'avalanche', imageUrl: 'https://www.cryptocompare.com/media/43977160/avax.png' },
    { name: 'Bitcoin Cash', symbol: 'BCH', id: 'bitcoincash', imageUrl: 'https://www.cryptocompare.com/media/37746245/bch.png' },
    { name: 'Cardano', symbol: 'ADA', id: 'cardano', imageUrl: 'https://www.cryptocompare.com/media/37746235/ada.png' },
    { name: 'Polkadot', symbol: 'DOT', id: 'polkadot', imageUrl: 'https://www.cryptocompare.com/media/39334571/dot.png' },
    { name: 'EOS', symbol: 'EOS', id: 'eos', imageUrl: 'https://www.cryptocompare.com/media/40485146/eos.png' },
    { name: 'Chainlink', symbol: 'LINK', id: 'chainlink', imageUrl: 'https://www.cryptocompare.com/media/37746242/link.png' },
    { name: 'Litecoin', symbol: 'LTC', id: 'litecoin', imageUrl: 'https://www.cryptocompare.com/media/37746243/ltc.png' },
    { name: 'Polygon', symbol: 'MATIC', id: 'matic', imageUrl: 'https://www.cryptocompare.com/media/37746047/matic.png' },
    { name: 'TRON', symbol: 'TRX', id: 'tron', imageUrl: 'https://www.cryptocompare.com/media/37746879/trx.png' },
    { name: 'Uniswap', symbol: 'UNI', id: 'uniswap', imageUrl: 'https://www.cryptocompare.com/media/37746885/uni.png' },
    { name: 'USD Coin', symbol: 'USDC', id: 'usd-coin', imageUrl: 'https://www.cryptocompare.com/media/34835941/usdc.png' },
    { name: 'Tether', symbol: 'USDT', id: 'tether', imageUrl: 'https://www.cryptocompare.com/media/37746338/usdt.png' },
    { name: 'Stellar', symbol: 'XLM', id: 'stellar', imageUrl: 'https://www.cryptocompare.com/media/37746346/xlm.png' },
    { name: 'Tezos', symbol: 'XTZ', id: 'tezos', imageUrl: 'https://www.cryptocompare.com/media/37747535/xtz.png' },
    { name: 'DASH', symbol: 'DASH', id: 'dash', imageUrl: 'https://www.cryptocompare.com/media/37746893/dash.png' },
    { name: 'DAI', symbol: 'DAI', id: 'dai', imageUrl: 'https://www.cryptocompare.com/media/37747610/dai.png' }
];

const itemsPerPage = 6;
let currentPage = 0;

// Function to dynamically generate HTML for crypto listings
function generateMarketValuesHTML() {
    const container = document.getElementById('market-values-container');

    cryptos.forEach((crypto, index) => {
        const cryptoHTML = `
            <div class="market-value ${index >= itemsPerPage ? 'hidden' : ''}">
                <div class="currency">
                    <div class="image">
                        <img id="${crypto.symbol.toLowerCase()}-icon" loading="lazy" decoding="async" src="${crypto.imageUrl}" alt="${crypto.name}">
                    </div>
                    <div class="name">
                        <h3>${crypto.name}</h3>
                        <span>${crypto.symbol}</span>
                    </div>
                </div>
                <div class="value">
                    <span><span id="${crypto.symbol.toLowerCase()}-price">...</span> <span class="currency-label">USD</span></span>
                </div>
            </div>
        `;
        container.innerHTML += cryptoHTML;
    });
}

// Call the function to generate the HTML when page loads
generateMarketValuesHTML();

document.getElementById('show-more-button').addEventListener('click', function() {
    const allMarketValues = document.querySelectorAll('.market-value');
    currentPage++;
    const startIndex = currentPage * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    allMarketValues.forEach((element, index) => {
        if (index >= startIndex && index < endIndex) {
            element.classList.remove('hidden');
        }
    });

    // Hide button if no more items to show
    if (endIndex >= allMarketValues.length) {
        this.style.display = 'none';
    }
});

const cryptoCompareApiUrl = 'https://min-api.cryptocompare.com/data/all/coinlist';

// Function to fetch and cache crypto icons from CryptoCompare (now using static URLs)
async function fetchAndCacheCryptoIcons() {
    // No need to fetch, using static URLs directly
    const cache = {};

    cryptos.forEach(crypto => {
        cache[crypto.symbol] = crypto.imageUrl;
    });

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
    return cryptos.reduce((messages, crypto) => {
        messages[crypto.symbol] = {
            event: "subscribe",
            pair: [`${crypto.symbol}/${currency}`],
            subscription: { name: "ticker" }
        };
        return messages;
    }, {});
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
        cryptos.forEach(crypto => {
            if (data[3] === `${crypto.symbol}/${currentCurrency}`) {
                document.getElementById(`${crypto.symbol.toLowerCase()}-price`).innerText = price;
            }
        });
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
</script>
