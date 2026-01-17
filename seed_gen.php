<?php
// Script to seed database with correct password hash
$password = 'admin123';
$hash = password_hash($password, PASSWORD_BCRYPT);
echo "INSERT INTO admins (name, email, password, role) VALUES ('Super Admin', 'admin@cloudify.com', '$hash', 'Super Admin') ON DUPLICATE KEY UPDATE password='$hash';";
?>
