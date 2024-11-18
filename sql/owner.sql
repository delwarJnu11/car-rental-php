-- vehicle Owner Table
CREATE TABLE IF NOT EXISTS car_vehicle_owner(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    user_id INT NOT NULL,
    commission_rate DECIMAL(15,2) NOT NULL,
    commission_type VARCHAR(30) ENUM("fixed","percentage"),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- vehicle Owner Table
CREATE TABLE IF NOT EXISTS car_vehicle_owner_revenue(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    user_id INT NOT NULL,
    total_revenue DECIMAL(15,2) NOT NULL,
    total_expense DECIMAL(15,2) NOT NULL,
    net_revenue DECIMAL(15,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
