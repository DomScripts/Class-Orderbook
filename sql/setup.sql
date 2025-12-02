CREATE DATABASE IF NOT EXISTS class_orderbook;
USE class_orderbook;

CREATE TABLE IF NOT EXISTS Trader (
    TraderID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL
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

CREATE TABLE IF NOT EXISTS Portfolio (
    PortfolioID INT PRIMARY KEY AUTO_INCREMENT,
    AssetID INT NOT NULL,
    QuantityHeld DECIMAL(10, 2) NOT NULL,
    AverageCost DECIMAL(10, 2) NOT NULL,
    UNIQUE(AssetID),
    FOREIGN KEY (AssetID) REFERENCES Asset(AssetID)
);
