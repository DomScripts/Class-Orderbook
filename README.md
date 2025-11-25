# Class-Orderbook

This project was created for my Database Systems Design and Management course, where the requirement was to build a locally hosted website that uses PHP to connect to a relational database and display data through a browser interface.

To make the project unique, I build a system around QuantumEdge Markets, a fictional high-frequency trading (HFT) firm. HFT systems rely on extremely low-latency infrastructure, and even small delays can impact profitability. This project simulates that environment by storing mock trading data, strategy performance, execution latencies, and portfolio analytics in a MySQL database, then rendering it through a PHP-based dashboard.

If given enough time before the due date, I would expand this project by integrating live market data from an exhange's API instead of relying soley on mock data. My goal would be to build a small C++ data ingestion engine capable of requesting, parsing, and processing real-time market feeds. I would benchmark the full pipeline from API retrieval, to C++ parsing, to MySQL storage, to PHP-based display in order to evaluate how each layer contributes to total latency. This would simulate a simplified version of a real high-frequency trading data stack and allow me to measure the performance impace of using MySQL and PHP in time-sensitive environments.
