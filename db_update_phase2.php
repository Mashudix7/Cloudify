<?php
// Database Update Script for Phase 2
$dsn = 'mysql:host=localhost;dbname=cloudify_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Create notifications table
    $sql1 = "CREATE TABLE IF NOT EXISTS `notifications` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `message` text NOT NULL,
      `type` enum('info','success','warning','danger') DEFAULT 'info',
      `is_read` tinyint(1) DEFAULT 0,
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $pdo->exec($sql1);
    echo "Table 'notifications' created or already exists.\n";

    // 2. Create article_reactions table
    $sql2 = "CREATE TABLE IF NOT EXISTS `article_reactions` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `article_id` int(11) NOT NULL,
      `reaction_type` enum('smile','laugh','love','sad') NOT NULL,
      `ip_address` varchar(45) NOT NULL,
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      KEY `article_id` (`article_id`),
      CONSTRAINT `fk_reaction_article` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    $pdo->exec($sql2);
    echo "Table 'article_reactions' created or already exists.\n";

    echo "\nDatabase update completed successfully!\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
