CREATE DATABASE IF NOT EXISTS class_orderbook;
USE class_orderbook;

CREATE TABLE IF NOT EXISTS Trader (
    TraderID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Strategy (
    StrategyID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Description TEXT,
    RiskLevel ENUM('Low', 'Medium', 'High') NOT NULL
);

CREATE TABLE IF NOT EXISTS Asset (
    AssetId INT PRIMARY KEY AUTO_INCREMENT,
    Symbol VARCHAR(14) NOT NULL UNIQUE,     -- Largest possible symbol name for a stock is 14 on FINRA, crypto has no standard :\ 
    Name VARCHAR(100),
    AssetType ENUM('Stock', 'Crypto') NOT NULL,
    Exchange VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS MarketData (
    DataID INT PRIMARY KEY AUTO_INCREMENT,
    AssetID INT NOT NULL,
    Timestamp DATETIME NOT NULL,
    bid_price DECIMAL(18, 8),
    bid_qty DECIMAL(18, 8),
    ask_price DECIMAL(18, 8),
    ask_qty DECIMAL(18, 8),
    UNIQUE(TimeStamp),     
    FOREIGN KEY (AssetID) REFERENCES Asset(AssetID)
);

CREATE TABLE IF NOT EXISTS Trade (
    TradeID INT PRIMARY KEY AUTO_INCREMENT,
    TraderID INT NOT NULL,
    StrategyID INT NOT NULL,
    AssetID INT NOT NULL,
    Quantity DECIMAL(10, 2) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Side ENUM('BUY', 'SELL') NOT NULL,
    Timestamp DATETIME NOT NULL,
    FOREIGN KEY (TraderID) REFERENCES Trader(TraderID),
    FOREIGN KEY (StrategyID) REFERENCES Strategy(StrategyID),
    FOREIGN KEY (AssetID) REFERENCES Asset(AssetID)
);

CREATE TABLE IF NOT EXISTS Portfolio (
    PortfolioID INT PRIMARY KEY AUTO_INCREMENT,
    TraderID INT NOT NULL,
    AssetID INT NOT NULL,
    QuantityHeld DECIMAL(10, 2) NOT NULL,
    AverageCost DECIMAL(10, 2) NOT NULL,
    UNIQUE(TraderID, AssetID),
    FOREIGN KEY (TraderID) REFERENCES Trader(TraderID),
    FOREIGN KEY (AssetID) REFERENCES Asset(AssetID)
);

INSERT INT Asset (Symbol, Name, AssetType, Exchange) VALUES (BTCUSDT, Bitcoin, Crypto, Binance US);

INSERT INTO Asset (AssetId, Symbol, Name, AssetType, Exchange) VALUES
(1, 'BTCUSDT', 'Bitcoin', 'Crypto', 'BinanceUS'),
(2, 'ETHUSDT', 'Ethereum', 'Crypto', 'BinanceUS'),
(3, 'SOLUSDT', 'Solana', 'Crypto', 'BinanceUS');
