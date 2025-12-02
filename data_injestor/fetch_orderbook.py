import requests
from datetime import datetime

BASE_URL = "https://api.binance.us/api/v3/depth"

def fetch_binance_orderbook(symbol: str):
    url = f"{BASE_URL}?symbol={symbol}&limit=5"
    r = requests.get(url)
    r.raise_for_status()
    data = r.json()

    bids = data["bids"]
    asks = data["asks"]
    timestamp = datetime.utcnow().strftime("%Y-%m-%d %H:%M:%S")

    levels = []
    for i in range(5):
        levels.append({
            "timestamp": timestamp,
            "bid_price": float(bids[i][0]),
            "bid_qty": float(bids[i][1]),
            "ask_price": float(asks[i][0]),
            "ask_qty": float(asks[i][1])
        })

    return levels
