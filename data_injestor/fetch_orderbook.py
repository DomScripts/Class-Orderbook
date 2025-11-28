import requests
from datetime import datetime

def fetch_binance_orderbook(symbol="BTCUSDT"):
    url = f"https://api.binance.us/api/v3/depth?symbol=BTCUSDT&limit=5"
    r = requests.get(url, timeout=5)
    r.raise_for_status()
    data = r.json()

    timestamp = datetime.utcnow()

    bids = data["bids"]  # [[price, qty], ...]
    asks = data["asks"]

    orderbook = []

    for i in range(5):
        bid_price, bid_qty = bids[i]
        ask_price, ask_qty = asks[i]
        orderbook.append(
            {
                "timestamp": timestamp,
                "bid_price": float(bid_price),
                "bid_qty": float(bid_qty),
                "ask_price": float(ask_price),
                "ask_qty": float(ask_qty),
            }
        )

    return orderbook
