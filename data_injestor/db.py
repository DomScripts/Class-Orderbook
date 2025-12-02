import mysql.connector
from config import DB_CONFIG

def get_connection():
    return mysql.connector.connect(**DB_CONFIG)

def overwrite_orderbook(asset_id, levels):
    conn = get_connection()
    cursor = conn.cursor()

    cursor.execute("DELETE FROM MarketData WHERE AssetID = %s", (asset_id,))

    sql = """
        INSERT INTO MarketData 
        (AssetID, timestamp, bid_price, bid_qty, ask_price, ask_qty)
        VALUES (%s, %s, %s, %s, %s, %s)
    """

    data = [
        (
            asset_id,
            lvl["timestamp"],
            lvl["bid_price"],
            lvl["bid_qty"],
            lvl["ask_price"],
            lvl["ask_qty"]
        )
        for lvl in levels
    ]

    cursor.executemany(sql, data)
    conn.commit()
    cursor.close()
    conn.close()
