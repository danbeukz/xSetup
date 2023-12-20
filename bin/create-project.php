<?php
// bin/create-project.php

$projectRoot = getcwd(); // Get the current working directory

$databaseConfig = [
    "host" => 'localhost',
    "username" => 'root',
    "password" => '',
    "database" => 'my_database',
];

$directories = [
    'assets/css',
    'assets/img',
    'assets/js',
    'config',
    'pages',
    'core',
];

foreach ($directories as $dir) {
    $path = $projectRoot . DIRECTORY_SEPARATOR . $dir;

    if (!is_dir($path)) {
        mkdir($path, 0755, true);
        echo "Created directory: $path\n";
    }
}

// Create example files
$templateFiles = [
    'assets/css/style.css' => '/* Add your styles here */',
    'assets/js/app.js' => '// Add your JavaScript code here',
    'index.php' => '',
    'config/database.php' => '<?php
$host = \'' . $databaseConfig["host"] . '\';
$dbname = \'' . $databaseConfig["database"] . '\';
$username = \'' . $databaseConfig["username"] . '\';
$password = \'' . $databaseConfig["password"] . '\';

try {
    // Establish a PDO connection
    $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Additional options (optional)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // You can use $pdo for your database operations
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>',
    'config/data.php' => '<?php return [];',
];

foreach ($templateFiles as $file => $content) {
    $filePath = $projectRoot . DIRECTORY_SEPARATOR . $file;

    if (!file_exists($filePath)) {
        file_put_contents($filePath, $content);
        echo "Created file: $filePath\n";
    } else {
        echo "File already exists: $filePath\n";
    }
}

echo "Project setup completed!\n";
