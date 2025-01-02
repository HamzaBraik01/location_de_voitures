<?php
require_once 'class/DatabaseConnection.php';
require_once 'class/Auth.Class.php';

$auth = new Auth();

// Test Database Connection
try {
    $db = new Database();
    $pdo = $db->getConnection();
    echo "Database connected successfully.<br>";
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

$testName = "Test User";
$testEmail = "test@example.com";
$testPassword = "password123";

if ($auth->register($testName, $testEmail, $testPassword)) {
    echo "User registered successfully.<br>";
} else {
    echo "Registration failed. Email might already exist.<br>";
}
if ($auth->login($testEmail, $testPassword)) {
    echo "Login successful.<br>";
} else {
    echo "Login failed. Incorrect email or password.<br>";
}
$auth->logout();
echo "User logged out.<br>";
?>

