from fetch_orderbook import fetch_binance_orderbook
from db import overwrite_orderbook
import time

ASSETS = {
    1: "BTCUSDT",
    2: "ETHUSDT",
    3: "SOLUSDT"
}

def main():
    while True:
        for asset_id, symbol in ASSETS.items():
            print(f"Fetching {symbol}...")
            levels = fetch_binance_orderbook(symbol)
            overwrite_orderbook(asset_id, levels)
            print(f"Stored top 5 levels for {symbol}.")

        time.sleep(3)  # update frequency

if __name__ == "__main__":
    main()
