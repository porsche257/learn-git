-- Create Database
CREATE DATABASE IF NOT EXISTS gametopup_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE gametopup_db;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0,
    points INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    order_id VARCHAR(50) PRIMARY KEY,
    user_id INT,
    game_name VARCHAR(100) NOT NULL,
    game_uid VARCHAR(100) NOT NULL,
    server VARCHAR(50),
    package_name VARCHAR(100) NOT NULL,
    package_amount VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_slip VARCHAR(255),
    status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Games Table
CREATE TABLE IF NOT EXISTS games (
    game_id INT PRIMARY KEY AUTO_INCREMENT,
    game_name VARCHAR(100) NOT NULL,
    game_code VARCHAR(50) UNIQUE NOT NULL,
    icon VARCHAR(10),
    description TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Packages Table
CREATE TABLE IF NOT EXISTS packages (
    package_id INT PRIMARY KEY AUTO_INCREMENT,
    game_id INT NOT NULL,
    package_name VARCHAR(100) NOT NULL,
    amount VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    discount VARCHAR(10),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (game_id) REFERENCES games(game_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contact Messages Table
CREATE TABLE IF NOT EXISTS contact_messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Promotions Table
CREATE TABLE IF NOT EXISTS promotions (
    promo_id INT PRIMARY KEY AUTO_INCREMENT,
    promo_code VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    discount_type ENUM('percentage', 'fixed') NOT NULL,
    discount_value DECIMAL(10,2) NOT NULL,
    min_purchase DECIMAL(10,2) DEFAULT 0,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    usage_limit INT DEFAULT 0,
    used_count INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Transactions Table
CREATE TABLE IF NOT EXISTS transactions (
    transaction_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id VARCHAR(50) NOT NULL,
    user_id INT,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    transaction_status ENUM('pending', 'success', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Sample Games
INSERT INTO games (game_name, game_code, icon, description) VALUES
('Free Fire', 'freefire', '🔥', 'เพชร Free Fire'),
('ROV', 'rov', '⚔️', 'คูปอง ROV'),
('PUBG Mobile', 'pubg', '🎯', 'UC PUBG'),
('Genshin Impact', 'genshin', '🌟', 'Genesis Crystal'),
('Mobile Legends', 'mobilelegends', '💰', 'Diamond ML'),
('Ragnarok M', 'ragnarok', '🎮', 'Big Cat Coin'),
('Call of Duty Mobile', 'codm', '🔫', 'CP COD Mobile'),
('Honkai Star Rail', 'honkai', '⭐', 'Oneiric Shard'),
('Valorant', 'valorant', '💎', 'Valorant Points'),
('Lineage M', 'lineagem', '🗡️', 'Red Diamond');

-- Insert Sample Packages for Free Fire
INSERT INTO packages (game_id, package_name, amount, price, discount) VALUES
(1, '50 เพชร', '50 เพชร', 20.00, NULL),
(1, '100 เพชร', '100 เพชร', 40.00, '10%'),
(1, '310 เพชร', '310 เพชร', 120.00, '15%'),
(1, '520 เพชร', '520 เพชร', 200.00, '20%'),
(1, '1060 เพชร', '1060 เพชร', 400.00, '25%'),
(1, '2180 เพชร', '2180 เพชร', 800.00, '30%');

-- Insert Sample Admin User (password: admin123)
INSERT INTO users (name, email, phone, password, is_admin) VALUES
('Admin', 'admin@gametopup.com', '0812345678', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- Create Indexes for better performance
CREATE INDEX idx_orders_user ON orders(user_id);
CREATE INDEX idx_orders_status ON orders(status);
CREATE INDEX idx_orders_created ON orders(created_at);
CREATE INDEX idx_transactions_order ON transactions(order_id);
CREATE INDEX idx_packages_game ON packages(game_id);