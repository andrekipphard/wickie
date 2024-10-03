<?php
    $highlightText = get_sub_field('highlight_text');
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="market" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
    <?php if ($fullHeight === 'Yes'): ?>
        height: 100vh;
        display: flex; align-items: center; padding-top:0; padding-bottom:0;
    <?php endif; ?>
    ">
    <div class="container">
        <div class="content-wrapper">
            <div class="subline">
                <span class="highlight"><?= $highlightText; ?></span>
            </div>
            <h2><?= $headline; ?></h2>
            <span><?= $text; ?></span>
            <div class="market-table">
                <table id="market-values-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Volume</th>
                            <th>Market Cap</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody id="market-values-container"></tbody>
                </table>
            </div>
            <div class="controls">
                <div class="selectors">
                    <div class="currency-selector">
                        <select id="currency">
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                    <div class="timeframe-selector">
                        <select id="timeframe">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                            <option value="all-time">All Time</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-link" id="show-more-button">Show More</button>
            </div>
        </div>
    </div> 
</section>


<script>
const cryptos = [
    { name: 'Bitcoin', symbol: 'XBT', imageUrl: 'https://www.cryptocompare.com/media/37746251/btc.png', circulatingSupply: 19000000 },
    { name: 'Ethereum', symbol: 'ETH', imageUrl: 'https://www.cryptocompare.com/media/37746238/eth.png', circulatingSupply: 120000000 },
    { name: 'Solana', symbol: 'SOL', imageUrl: 'https://www.cryptocompare.com/media/37747734/sol.png', circulatingSupply: 550000000 },
    { name: 'Dogecoin', symbol: 'XDG', imageUrl: 'https://www.cryptocompare.com/media/37746339/doge.png', circulatingSupply: 140000000000 },
    { name: 'Ripple', symbol: 'XRP', imageUrl: 'https://www.cryptocompare.com/media/38553096/xrp.png', circulatingSupply: 50000000000 },
    { name: 'Cardano', symbol: 'ADA', imageUrl: 'https://www.cryptocompare.com/media/37746235/ada.png', circulatingSupply: 35000000000 },
    { name: 'ApeCoin', symbol: 'APE', imageUrl: 'https://www.cryptocompare.com/media/39838302/ape.png', circulatingSupply: 370000000 },
    { name: 'Avalanche', symbol: 'AVAX', imageUrl: 'https://www.cryptocompare.com/media/43977160/avax.png', circulatingSupply: 300000000 },
    { name: 'Bitcoin Cash', symbol: 'BCH', imageUrl: 'https://www.cryptocompare.com/media/37746245/bch.png', circulatingSupply: 19000000 },
    { name: 'Polkadot', symbol: 'DOT', imageUrl: 'https://www.cryptocompare.com/media/39334571/dot.png', circulatingSupply: 1200000000 },
    { name: 'EOS', symbol: 'EOS', imageUrl: 'https://www.cryptocompare.com/media/40485146/eos.png', circulatingSupply: 1000000000 },
    { name: 'Chainlink', symbol: 'LINK', imageUrl: 'https://www.cryptocompare.com/media/37746242/link.png', circulatingSupply: 500000000 },
    { name: 'Litecoin', symbol: 'LTC', imageUrl: 'https://www.cryptocompare.com/media/37746243/ltc.png', circulatingSupply: 70000000 },
    { name: 'Polygon', symbol: 'MATIC', imageUrl: 'https://www.cryptocompare.com/media/37746047/matic.png', circulatingSupply: 10000000000 },
    { name: 'TRON', symbol: 'TRX', imageUrl: 'https://www.cryptocompare.com/media/37746879/trx.png', circulatingSupply: 100000000000 },
    { name: 'Uniswap', symbol: 'UNI', imageUrl: 'https://www.cryptocompare.com/media/37746885/uni.png', circulatingSupply: 1000000000 },
    { name: 'USD Coin', symbol: 'USDC', imageUrl: 'https://www.cryptocompare.com/media/34835941/usdc.png', circulatingSupply: 45000000000 },
    { name: 'Tether', symbol: 'USDT', imageUrl: 'https://www.cryptocompare.com/media/37746338/usdt.png', circulatingSupply: 83000000000 },
    { name: 'Stellar', symbol: 'XLM', imageUrl: 'https://www.cryptocompare.com/media/37746346/xlm.png', circulatingSupply: 25000000000 },
    { name: 'Tezos', symbol: 'XTZ', imageUrl: 'https://www.cryptocompare.com/media/37747535/xtz.png', circulatingSupply: 900000000 },
    { name: 'DASH', symbol: 'DASH', imageUrl: 'https://www.cryptocompare.com/media/37746893/dash.png', circulatingSupply: 10000000 },
    { name: 'DAI', symbol: 'DAI', imageUrl: 'https://www.cryptocompare.com/media/37747610/dai.png', circulatingSupply: 8000000000 }
];

const itemsPerPage = 6;
let currentPage = 0;
let currentCurrency = "USD";  // Default currency

function generateMarketValuesHTML() {
    const container = document.getElementById('market-values-container');

    cryptos.forEach((crypto, index) => {
        const cryptoRow = `
            <tr class="market-value ${index >= itemsPerPage ? 'hidden' : ''}">
                <td id="${crypto.symbol.toLowerCase()}-name" class="currency">
                    <div class="image">
                        <img id="${crypto.symbol.toLowerCase()}-icon" src="${crypto.imageUrl}" alt="${crypto.name}" style="width: 24px; height: 24px; vertical-align: middle;"> 
                    </div>
                    <div class="name">
                        <h3>${crypto.name}</h3> 
                        <span>${crypto.symbol}</span>
                    </div>
                </td>
                <td id="${crypto.symbol.toLowerCase()}-volume">...</td>
                <td id="${crypto.symbol.toLowerCase()}-marketcap">...</td>
                <td id="${crypto.symbol.toLowerCase()}-price" class="price">...</td>
            </tr>
        `;
        container.innerHTML += cryptoRow;
    });
}

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

    if (endIndex >= allMarketValues.length) {
        this.style.display = 'none';
    }
});

const krakenSocket = new WebSocket('wss://ws.kraken.com');

function subscribeToCryptoPrices(currency) {
    const messages = getSubscribeMessages(currency);

    Object.keys(messages).forEach(key => {
        krakenSocket.send(JSON.stringify({ event: "unsubscribe", pair: [`${key}/${currentCurrency}`], subscription: { name: "ticker" } }));
    });

    Object.keys(messages).forEach(key => {
        krakenSocket.send(JSON.stringify(messages[key]));
    });

    currentCurrency = currency;
}

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

function updateCryptoData(data) {
    if (data[1] && data[1].c) {
        cryptos.forEach(crypto => {
            if (data[3] === `${crypto.symbol}/${currentCurrency}`) {
                const price = data[1].c[0];
                const volume = data[1].v[1];
                const marketCap = price * crypto.circulatingSupply;

                const priceChange = data[1].p[1] - data[1].p[0]; // 24h Price Change
                const priceChangePercentage = ((priceChange / data[1].p[0]) * 100).toFixed(2);

                const changeSymbol = priceChangePercentage > 0 ? '▲' : '▼'; // Price up or down indicator
                const changeColor = priceChangePercentage > 0 ? 'green' : 'red';

                // Hier werden die Werte für Preis, Volumen und Marktkapitalisierung abgekürzt
                document.getElementById(`${crypto.symbol.toLowerCase()}-price`).innerHTML = `
                    ${formatCurrency(price, currentCurrency)}
                    <span style="color: ${changeColor}; font-size: 0.9rem; margin-left: 8px;">${changeSymbol} ${priceChangePercentage}%</span>
                `;
                document.getElementById(`${crypto.symbol.toLowerCase()}-volume`).innerText = abbreviateNumber(volume);
                document.getElementById(`${crypto.symbol.toLowerCase()}-marketcap`).innerText = abbreviateNumber(marketCap);
            }
        });
    }
}


function formatCurrency(value, currency) {
    let formattedValue;

    if (currency === "USD") {
        // Format for USD: $1,234.56
        formattedValue = parseFloat(value).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        return `$${formattedValue}`; // USD currency symbol before value
    } else if (currency === "EUR") {
        // Format for EUR: 1.234,56€
        formattedValue = parseFloat(value).toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        return `${formattedValue}€`; // EUR currency symbol after value
    } else {
        return value; // Default for other currencies
    }
}

krakenSocket.onopen = function() {
    subscribeToCryptoPrices(currentCurrency);
};

krakenSocket.onmessage = function(event) {
    try {
        const data = JSON.parse(event.data);
        updateCryptoData(data);
    } catch (error) {
        // Handle error (e.g., log it to an external monitoring service)
    }
};

document.getElementById('currency').addEventListener('change', function() {
    const selectedCurrency = this.value;
    subscribeToCryptoPrices(selectedCurrency);
});
function abbreviateNumber(value) {
    if (value >= 1e12) {
        return (value / 1e12).toFixed(2) + 'T'; // Trillion (Billion in German)
    } else if (value >= 1e9) {
        return (value / 1e9).toFixed(2) + 'B'; // Billion (Milliarde in German)
    } else if (value >= 1e6) {
        return (value / 1e6).toFixed(2) + 'M'; // Million
    } else {
        return parseFloat(value.toFixed(2)).toLocaleString(); // Auf 2 Nachkommastellen runden und formatieren
    }
}


</script>
