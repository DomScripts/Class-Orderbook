# Class-Orderbook

This project was created for my Database Systems Design and Management course, where the requirement was to build a locally hosted website that uses PHP to connect to a relational database and display data through a browser interface.

To make the project unique, I build a orderbook aggregator to display 5 levels of the bid/ask spread on the webpage. 

# Setup

1. Drag and drop the repository into the `htdocs` folder within XAMPP. 
> Path at `/Applications/XAMPP/xamppfiles/htdocs` on MacOS.

2. Run the `setup.sql` file in order to load the required tabled.
> File found at `Class-Orderbook/sql/setup.sql`.

3. Run the `load.sql` file in order to load the static data.
> File found at `Class-Orderbook/sql/load.sql`.

4. Modify the `.env` file in the `data_injestor` in order to connect to your desired database.
> Setup as local host by default.
