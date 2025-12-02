INSERT INTO Asset (AssetID, Symbol, Name, AssetType, Exchange) VALUES
(1, 'BTCUSDT', 'Bitcoin', 'Crypto', 'BinanceUS'),
(2, 'ETHUSDT', 'Ethereum', 'Crypto', 'BinanceUS'),
(3, 'SOLUSDT', 'Solana', 'Crypto', 'BinanceUS');

INSERT INTO Portfolio (PortfolioID, AssetID, QuantityHeld, AverageCost) VALUES
(1, 1, 10.0, 86777.81),
(2, 2, 150.0, 2806.95),
(3, 3, 400.0, 127.84);
