<?php
/**
 * WordPress URL Fixer
 * Run this script once to fix database URLs
 * Access: http://localhost/cricket/fix-urls.php
 */

// Database configuration
$db_host = 'localhost';
$db_name = 'cricket';
$db_user = 'root';
$db_pass = '';

try {
    // Connect to database
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2>WordPress URL Fixer</h2>";

    // Check current URLs
    echo "<h3>Current Settings:</h3>";
    $stmt = $conn->query("SELECT option_name, option_value FROM wp_options WHERE option_name IN ('siteurl', 'home')");
    $current = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Option</th><th>Current Value</th></tr>";
    foreach ($current as $row) {
        echo "<tr><td>{$row['option_name']}</td><td>{$row['option_value']}</td></tr>";
    }
    echo "</table><br>";

    // Update URLs
    $new_url = 'http://localhost/cricket';

    $stmt = $conn->prepare("UPDATE wp_options SET option_value = :url WHERE option_name = 'siteurl'");
    $stmt->execute([':url' => $new_url]);

    $stmt = $conn->prepare("UPDATE wp_options SET option_value = :url WHERE option_name = 'home'");
    $stmt->execute([':url' => $new_url]);

    echo "<h3>✅ URLs Updated Successfully!</h3>";

    // Verify updates
    echo "<h3>New Settings:</h3>";
    $stmt = $conn->query("SELECT option_name, option_value FROM wp_options WHERE option_name IN ('siteurl', 'home')");
    $updated = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>Option</th><th>New Value</th></tr>";
    foreach ($updated as $row) {
        echo "<tr><td>{$row['option_name']}</td><td>{$row['option_value']}</td></tr>";
    }
    echo "</table><br>";

    echo "<p><strong>Next Steps:</strong></p>";
    echo "<ol>";
    echo "<li>Delete this file (fix-urls.php) for security</li>";
    echo "<li>Clear your browser cache and cookies</li>";
    echo "<li>Visit: <a href='http://localhost/cricket'>http://localhost/cricket</a></li>";
    echo "<li>Login at: <a href='http://localhost/cricket/wp-login.php'>http://localhost/cricket/wp-login.php</a></li>";
    echo "</ol>";

} catch(PDOException $e) {
    echo "<h3 style='color: red;'>❌ Error: " . $e->getMessage() . "</h3>";
    echo "<p>Make sure XAMPP MySQL is running and the database 'cricket' exists.</p>";
}
?>
