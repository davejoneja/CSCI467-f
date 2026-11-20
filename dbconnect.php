<?php
// Prefer the two original course databases. If they are unavailable (for
// example, off the NIU network), transparently use the seeded local demo DB.
$databaseMode = strtolower(getenv('PROJECT_DB_MODE') ?: 'auto');
if ($databaseMode !== 'local') {
    try {
        $mysqlOptions = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 3,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $pdoLegacy = new PDO(
            'mysql:host=blitz.cs.niu.edu;dbname=csci467',
            'student',
            'student',
            $mysqlOptions
        );
        $pdoInventory = new PDO(
            'mysql:host=65.38.96.193;dbname=InventoryOrders',
            'tux',
            '123',
            $mysqlOptions
        );
        return;
    } catch (PDOException $remoteDatabaseError) {
        if ($databaseMode === 'remote') {
            throw $remoteDatabaseError;
        }
    }
}

// Self-contained fallback for the archived project. Both original handles
// remain available, but point at one local SQLite database.
$dataDirectory = __DIR__ . DIRECTORY_SEPARATOR . 'data';
if (!is_dir($dataDirectory)) {
    mkdir($dataDirectory, 0777, true);
}

$databasePath = $dataDirectory . DIRECTORY_SEPARATOR . '467project.sqlite';
$isNewDatabase = !file_exists($databasePath);
$pdoInventory = new PDO('sqlite:' . $databasePath);
$pdoInventory->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdoInventory->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdoInventory->exec('PRAGMA foreign_keys = ON');
$pdoLegacy = $pdoInventory;

if ($isNewDatabase) {
    $pdoInventory->exec(<<<'SQL'
        CREATE TABLE parts (number INTEGER PRIMARY KEY, description TEXT NOT NULL,
            price REAL NOT NULL, weight REAL NOT NULL, pictureURL TEXT NOT NULL);
        CREATE TABLE Customer (customerID INTEGER PRIMARY KEY AUTOINCREMENT,
            customerName TEXT, email TEXT, addr TEXT, City TEXT, State TEXT, Zip TEXT);
        CREATE TABLE Orders (orderID INTEGER PRIMARY KEY AUTOINCREMENT,
            customerID INTEGER, orderDate TEXT, orderStatus TEXT, amount REAL DEFAULT 0,
            ShippingCost REAL DEFAULT 0,
            FOREIGN KEY (customerID) REFERENCES Customer(customerID));
        CREATE TABLE Product (productID INTEGER PRIMARY KEY, productName TEXT,
            quantity INTEGER NOT NULL DEFAULT 0);
        CREATE TABLE OrderProduct (orderID INTEGER, productID INTEGER, qty INTEGER,
            Price REAL, PRIMARY KEY (orderID, productID),
            FOREIGN KEY (orderID) REFERENCES Orders(orderID),
            FOREIGN KEY (productID) REFERENCES Product(productID));
        CREATE TABLE weightBrackets (LeftBound INTEGER, RightBound INTEGER, Price REAL,
            PRIMARY KEY (LeftBound, RightBound));
    SQL);

    $parts = [
        [1, 'windshield w/ polymer', 89.99, 18.5, 'assets/products/windshield-v2.jpg'],
        [2, 'wiper blade pair', 24.99, 2.1, 'assets/wip.jpg'],
        [3, 'starter solenoid', 39.50, 1.4, 'assets/products/solenoid.jpg'],
        [4, 'all-season tire', 129.99, 22.0, 'assets/products/tire.jpg'],
        [5, 'bucket seat pair', 299.99, 48.0, 'assets/products/bucket-seats.jpg'],
        [6, 'five point harness', 74.95, 4.2, 'assets/products/harness.jpg'],
        [7, 'turbo intake valve', 119.00, 3.8, 'assets/products/turbocharger.jpg'],
        [8, 'supercharger', 849.99, 42.0, 'assets/products/supercharger.jpg'],
        [9, 'intercooler kit', 249.99, 16.5, 'assets/products/intercooler.jpg'],
        [10, 'chrome gas cap', 34.99, 0.8, 'assets/products/gas-cap.jpg'],
        [11, 'chrome pedal kit - manual', 49.99, 1.9, 'assets/products/manual-pedals.jpg'],
        [12, 'chrome pedal kit - automatic', 44.99, 1.7, 'assets/products/automatic-pedals.jpg']
    ];
    $insertPart = $pdoInventory->prepare(
        'INSERT INTO parts (number, description, price, weight, pictureURL) VALUES (?, ?, ?, ?, ?)'
    );
    $insertProduct = $pdoInventory->prepare(
        'INSERT INTO Product (productID, productName, quantity) VALUES (?, ?, 100)'
    );
    foreach ($parts as $part) {
        $insertPart->execute($part);
        $insertProduct->execute([$part[0], $part[1]]);
    }

    $pdoInventory->exec("INSERT INTO weightBrackets VALUES
        (0, 5, 5.99), (5, 20, 10.99), (20, 50, 19.99), (50, 100000, 34.99)");
    $pdoInventory->exec("INSERT INTO Customer
        (customerName, email, addr, City, State, Zip)
        VALUES ('Demo Customer', 'demo@example.com', '1425 W Lincoln Hwy', 'DeKalb', 'IL', '60115')");
    $customerId = $pdoInventory->lastInsertId();
    $pdoInventory->exec("INSERT INTO Orders
        (customerID, orderDate, orderStatus, amount, ShippingCost)
        VALUES ($customerId, date('now'), 'Authorized', 114.98, 10.99)");
    $orderId = $pdoInventory->lastInsertId();
    $pdoInventory->exec("INSERT INTO OrderProduct (orderID, productID, qty, Price)
        VALUES ($orderId, 1, 1, 89.99), ($orderId, 2, 1, 24.99)");
}

// Apply image updates to an existing local demo database as well as new ones.
$productImages = [
    1 => 'assets/products/windshield-v2.jpg',
    2 => 'assets/wip.jpg',
    3 => 'assets/products/solenoid.jpg',
    4 => 'assets/products/tire.jpg',
    5 => 'assets/products/bucket-seats.jpg',
    6 => 'assets/products/harness.jpg',
    7 => 'assets/products/turbocharger.jpg',
    8 => 'assets/products/supercharger.jpg',
    9 => 'assets/products/intercooler.jpg',
    10 => 'assets/products/gas-cap.jpg',
    11 => 'assets/products/manual-pedals.jpg',
    12 => 'assets/products/automatic-pedals.jpg',
];
$updateImage = $pdoInventory->prepare('UPDATE parts SET pictureURL = :image WHERE number = :id');
foreach ($productImages as $productId => $imagePath) {
    $updateImage->execute(['image' => $imagePath, 'id' => $productId]);
}
?>
