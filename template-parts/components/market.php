<?php
    $highlightText = get_sub_field('highlight_text');
    $headline = get_sub_field('headline');
    $text = get_sub_field('text');
    $backgroundColor = get_sub_field('background_color');
    $textColor = get_sub_field('text_color');
    $fullHeight = get_sub_field('full_height');
?>
<section class="market<?php if($fullHeight === 'Yes'):?> full-height<?php endif;?>" style="
    <?php if ($textColor): ?> color: <?= $textColor; ?>; <?php endif; ?>
    <?php if ($backgroundColor): ?> background: <?= $backgroundColor; ?>; <?php endif; ?>
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
    { name: 'Bitcoin', symbol: 'BTC', imageUrl: 'https://www.cryptocompare.com/media/37746251/btc.png', circulatingSupply: 19000000 },
    { name: 'Ethereum', symbol: 'ETH', imageUrl: 'https://www.cryptocompare.com/media/37746238/eth.png', circulatingSupply: 120000000 },
    { name: 'Solana', symbol: 'SOL', imageUrl: 'https://www.cryptocompare.com/media/37747734/sol.png', circulatingSupply: 550000000 },
    { name: 'Dogecoin', symbol: 'DOGE', imageUrl: 'https://www.cryptocompare.com/media/37746339/doge.png', circulatingSupply: 140000000000 },
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
    container.innerHTML = '';  // Clear previous content

    cryptos.forEach((crypto, index) => {
        const cryptoRow = `
            <tr class="market-value ${index >= itemsPerPage ? 'hidden' : ''}">
                <td id="${crypto.symbol.toLowerCase()}-name">
                    <div class="currency">
                        <div class="image">
                            <img id="${crypto.symbol.toLowerCase()}-icon" src="${crypto.imageUrl}" alt="${crypto.name}" style="width: 24px; height: 24px; vertical-align: middle;"> 
                        </div>
                        <div class="name">
                            <h3>${crypto.name}</h3> 
                            <span>${crypto.symbol}</span>
                        </div>
                    </div>
                </td>
                <td id="${crypto.symbol.toLowerCase()}-volume">...</td>
                <td id="${crypto.symbol.toLowerCase()}-marketcap">...</td>
                <td><div id="${crypto.symbol.toLowerCase()}-price" class="price">...</div></td>
            </tr>
        `;
        container.innerHTML += cryptoRow;
    });
}

// Fetch historical data for the selected timeframe
// Fetch historical data for the selected timeframe with retries
async function fetchHistoricalData(symbol, currency, timeframe, retries = 3) {
    let url;

    switch (timeframe) {
        case "daily":
            url = `https://min-api.cryptocompare.com/data/v2/histoday?fsym=${symbol}&tsym=${currency}&limit=1`;
            break;
        case "weekly":
            url = `https://min-api.cryptocompare.com/data/v2/histoday?fsym=${symbol}&tsym=${currency}&limit=7`;
            break;
        case "monthly":
            url = `https://min-api.cryptocompare.com/data/v2/histoday?fsym=${symbol}&tsym=${currency}&limit=30`;
            break;
        case "yearly":
            url = `https://min-api.cryptocompare.com/data/v2/histoday?fsym=${symbol}&tsym=${currency}&limit=365`;
            break;
        case "all-time":
            url = `https://min-api.cryptocompare.com/data/v2/histoday?fsym=${symbol}&tsym=${currency}&limit=2000`; // Example for a long history
            break;
        default:
            url = `https://min-api.cryptocompare.com/data/v2/histoday?fsym=${symbol}&tsym=${currency}&limit=1`;
    }

    for (let attempt = 0; attempt < retries; attempt++) {
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();
            if (data && data.Data && data.Data.Data.length > 0) {
                return data.Data.Data[0].close;  // Returns the closing price for the earliest date in the timeframe
            } else {
                console.warn(`No historical data available for ${symbol} on attempt ${attempt + 1}`);
                return null;  // Return null if no data
            }
        } catch (error) {
            console.error(`Error fetching historical data for ${symbol} on attempt ${attempt + 1}:`, error);
            await new Promise(res => setTimeout(res, 1000)); // Wait before retrying
        }
    }

    return null; // Return null if all attempts fail
}


// Fetch data from CryptoCompare API
function fetchMarketData(currency, timeframe) {
    const symbols = cryptos.map(crypto => crypto.symbol).join(',');
    const url = `https://min-api.cryptocompare.com/data/pricemultifull?fsyms=${symbols}&tsyms=${currency}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            updateCryptoData(data.RAW, currency, timeframe);
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Update crypto data in the DOM with price change based on timeframe
async function updateCryptoData(data, currency, timeframe) {
    for (const crypto of cryptos) {
        const cryptoData = data[crypto.symbol][currency];
        const price = cryptoData.PRICE;
        const volume = cryptoData.TOTALVOLUME24HTO;
        const marketCap = cryptoData.MKTCAP;

        // Show "..." while fetching historical data
        document.getElementById(`${crypto.symbol.toLowerCase()}-price`).textContent = "...";
        document.getElementById(`${crypto.symbol.toLowerCase()}-volume`).textContent = "...";
        document.getElementById(`${crypto.symbol.toLowerCase()}-marketcap`).textContent = "...";

        try {
            const previousPrice = await fetchHistoricalData(crypto.symbol, currency, timeframe);
            if (previousPrice !== 0 && previousPrice !== undefined) {
                const priceChange = price - previousPrice;
                const priceChangePercentage = ((priceChange / previousPrice) * 100).toFixed(2);
                
                const changeSymbol = priceChange > 0 ? '▲' : '▼';
                const changeColor = priceChange > 0 ? 'green' : 'red';

                document.getElementById(`${crypto.symbol.toLowerCase()}-price`).innerHTML = `
                    ${formatCurrency(price, currency)}
                    <span class="change-indicator" style="color: ${changeColor};">
                        ${changeSymbol} ${priceChangePercentage}%
                    </span>
                `;
            } else {
                document.getElementById(`${crypto.symbol.toLowerCase()}-price`).innerHTML = `
                    ${formatCurrency(price, currency)}
                    <span class="change-indicator" style="color: red;">
                        No historical data available
                    </span>
                `;
            }
        } catch (error) {
            console.error(`Error fetching historical data for ${crypto.symbol}:`, error);
            document.getElementById(`${crypto.symbol.toLowerCase()}-price`).innerHTML = `
                ${formatCurrency(price, currency)}
                <span  class="change-indicator" style="color: red;">
                    Error fetching data. Please try again.
                </span>
            `;
        }

        // Set the volume and market cap after fetching
        document.getElementById(`${crypto.symbol.toLowerCase()}-volume`).textContent = abbreviateNumber(volume);
        document.getElementById(`${crypto.symbol.toLowerCase()}-marketcap`).textContent = abbreviateNumber(marketCap);
    }
}



// Format currency output
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

// Abbreviate large numbers
function abbreviateNumber(value) {
    if (value >= 1e12) {
        return (value / 1e12).toFixed(2) + 'T'; // Trillion
    } else if (value >= 1e9) {
        return (value / 1e9).toFixed(2) + 'B'; // Billion
    } else if (value >= 1e6) {
        return (value / 1e6).toFixed(2) + 'M'; // Million
    } else {
        return value.toFixed(2);
    }
}

// Pagination logic for 'Show More' button
document.getElementById('show-more-button').addEventListener('click', function() {
    currentPage++;
    const allMarketValues = document.querySelectorAll('.market-value');
    const startIndex = currentPage * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    allMarketValues.forEach((element, index) => {
        if (index >= startIndex && index < endIndex) {
            element.classList.remove('hidden');
        }
    });

    if (endIndex >= allMarketValues.length) {
        this.style.display = 'none';  // Hide button when all items are shown
    }
});

// Timeframe change event listener
document.getElementById('timeframe').addEventListener('change', function () {
    currentTimeframe = this.value;
    fetchMarketData(currentCurrency, currentTimeframe);
});

// Change currency event listener
document.getElementById('currency').addEventListener('change', function() {
    currentCurrency = this.value;
    fetchMarketData(currentCurrency);
});

// Initialize
generateMarketValuesHTML();
fetchMarketData(currentCurrency);

</script>
