-- ===================================================
-- Database: cloudify_db
-- Cloudify - Weather Insight Platform for DKI Jakarta
-- ===================================================

CREATE DATABASE IF NOT EXISTS cloudify_db;
USE cloudify_db;

-- ===================================================
-- Table: admins
-- ===================================================
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('Super Admin', 'Editor', 'Viewer') DEFAULT 'Viewer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===================================================
-- Table: articles
-- ===================================================
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    thumbnail VARCHAR(255),
    content TEXT,
    tags VARCHAR(255),
    status ENUM('draft', 'published') DEFAULT 'draft',
    author_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES admins(id) ON DELETE SET NULL
);

-- ===================================================
-- Table: notifications
-- ===================================================
CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    type ENUM('info', 'success', 'warning', 'danger') DEFAULT 'info',
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===================================================
-- Table: article_reactions
-- ===================================================
CREATE TABLE IF NOT EXISTS article_reactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    reaction_type ENUM('smile', 'laugh', 'love', 'sad') NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE
);

-- ===================================================
-- Table: jakarta_cities (5 Kota DKI Jakarta)
-- ===================================================
CREATE TABLE IF NOT EXISTS jakarta_cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city_code VARCHAR(50) NOT NULL UNIQUE,
    city_name VARCHAR(100) NOT NULL,
    latitude DECIMAL(10, 6) NOT NULL,
    longitude DECIMAL(10, 6) NOT NULL,
    bmkg_id VARCHAR(20),
    icon VARCHAR(50) DEFAULT 'location_city',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ===================================================
-- Table: weather_data (Data Cuaca per Kota)
-- ===================================================
CREATE TABLE IF NOT EXISTS weather_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city_id INT NOT NULL,
    temperature DECIMAL(5, 2),
    humidity INT,
    wind_speed DECIMAL(5, 2),
    rain_precipitation DECIMAL(5, 2) DEFAULT 0,
    weather_desc VARCHAR(100),
    weather_icon VARCHAR(50),
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (city_id) REFERENCES jakarta_cities(id) ON DELETE CASCADE
);

-- ===================================================
-- Table: weather_hourly (Prakiraan Per Jam)
-- ===================================================
CREATE TABLE IF NOT EXISTS weather_hourly (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city_id INT NOT NULL,
    forecast_time DATETIME NOT NULL,
    temperature DECIMAL(5, 2),
    humidity INT,
    weather_desc VARCHAR(100),
    weather_icon VARCHAR(50),
    rain_precipitation DECIMAL(5, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (city_id) REFERENCES jakarta_cities(id) ON DELETE CASCADE
);

-- ===================================================
-- SEED DATA: 5 Kota DKI Jakarta
-- ===================================================
INSERT INTO jakarta_cities (city_code, city_name, latitude, longitude, bmkg_id, icon) VALUES
('jakarta-pusat', 'Jakarta Pusat', -6.186200, 106.834000, '31.71', 'location_city'),
('jakarta-utara', 'Jakarta Utara', -6.138400, 106.863300, '31.72', 'sailing'),
('jakarta-barat', 'Jakarta Barat', -6.167600, 106.763700, '31.73', 'factory'),
('jakarta-selatan', 'Jakarta Selatan', -6.261500, 106.810600, '31.74', 'park'),
('jakarta-timur', 'Jakarta Timur', -6.225000, 106.900400, '31.75', 'apartment');

-- ===================================================
-- SEED DATA: Demo Weather Data
-- ===================================================
INSERT INTO weather_data (city_id, temperature, humidity, wind_speed, rain_precipitation, weather_desc, weather_icon) VALUES
(1, 32, 65, 12, 0, 'Cerah Berawan', 'partly_cloudy_day'),
(2, 31, 70, 15, 0, 'Berawan', 'cloud'),
(3, 30, 80, 10, 5, 'Hujan Ringan', 'rainy'),
(4, 29, 85, 18, 15, 'Hujan Lebat', 'thunderstorm'),
(5, 31, 60, 8, 0, 'Cerah', 'wb_sunny');

-- ===================================================
-- SEED DATA: Super Admin
-- Default: admin@cloudify.com / admin123
-- ===================================================
-- INSERT INTO admins (name, email, password, role) VALUES 
-- ('Admin', 'admin@cloudify.com', '$2y$10$YOUR_BCRYPT_HASH_HERE', 'Super Admin');
-- 
-- To generate password hash, run: php seed_gen.php

-- ===================================================
-- NOTES
-- ===================================================
-- 1. Aplikasi Cloudify fokus pada 5 kota di DKI Jakarta:
--    - Jakarta Pusat
--    - Jakarta Utara  
--    - Jakarta Barat
--    - Jakarta Selatan
--    - Jakarta Timur
--
-- 2. Data cuaca pada tabel weather_data adalah demo.
--    Untuk produksi, integrasikan dengan API BMKG.
--
-- 3. Untuk membuat Super Admin, jalankan:
--    php seed_gen.php
