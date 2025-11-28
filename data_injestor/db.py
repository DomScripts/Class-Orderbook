import mysql.connector
from config import DB_CONFIG

def get_connection():
    return mysql.connector.connect(**DB_CONFIG)

def overwrite_orderbook(levels, asset_id=1):
    """
    levels: list of 5 dicts with:
        timestamp, bid_price, bid_qty, ask_price, ask_qty
    asset_id: integer referring to Asset table
    """
    conn = get_connection()
    cursor = conn.cursor()

    # Clear previous state for this asset
    cursor.execute("DELETE FROM MarketData WHERE AssetId = %s", (asset_id,))

    sql = """
        INSERT INTO MarketData 
        (timestamp, bid_price, bid_qty, ask_price, ask_qty, AssetId)
        VALUES (%s, %s, %s, %s, %s, %s)
    """

    data = [
        (
            lvl["timestamp"],
            lvl["bid_price"],
            lvl["bid_qty"],
            lvl["ask_price"],
            lvl["ask_qty"],
            asset_id
        )
        for lvl in levels
    ]

    cursor.executemany(sql, data)
    conn.commit()
    cursor.close()
    conn.close()
