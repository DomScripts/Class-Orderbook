import time
from fetch_orderbook import fetch_binance_orderbook
from db import overwrite_orderbook

def main():
    print("Starting orderbook ingestion (overwrite mode)...")

    while True:
        try:
            ASSET_ID = 1

            levels = fetch_binance_orderbook("BTCUSDT")
            overwrite_orderbook(levels, asset_id=ASSET_ID)
            print("Updated current top 5 bids/asks.")
        except Exception as e:
            print("Error:", e)

        time.sleep(2)  # update every 2 seconds

if __name__ == "__main__":
    main()
