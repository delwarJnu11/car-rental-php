-- vehicle Owner Table
CREATE TABLE IF NOT EXISTS car_vehicle_owner(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    user_id INT NOT NULL,
    commission_rate DECIMAL(15,2) NOT NULL,
    commission_type_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vehicle Commission Type
CREATE TABLE IF NOT EXISTS car_maintenance_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    commission_type_name VARCHAR(30),
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
