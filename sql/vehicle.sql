CREATE TABLE IF NOT EXISTS car_vehicles(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_name VARCHAR(255) NOT NULL,
    model VARCHAR(100) NOT NULL,
    year VARCHAR(20) NOT NULL,
    door VARCHAR(10) NOT NULL,
    seats VARCHAR(10) NOT NULL,
    capacity VARCHAR(10),
    luggage_capacity VARCHAR(10),
    description TEXT(500) NOT NULL,
    price_per_hour INT NOT NULL,
    price_per_day INT NOT NULL,
    price_per_week INT NOT NULL,
    discount_price INT,
    image VARCHAR(255) NOT NULL,
    vehicle_documents VARCHAR(255) NOT NULL,
    is_ac BOOLEAN,
    vehicle_owner_id INT NOT NULL,
    vehicle_type_id INT NOT NULL,
    vehicle_status_id INT NOT NULL,
    vehicle_engine_type_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vechicle Types Table
CREATE TABLE IF NOT EXISTS car_vehicle_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_type_name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vechicle Engine Types Table
CREATE TABLE IF NOT EXISTS car_vehicle_engine_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_engine_type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vechicle Status Table
CREATE TABLE IF NOT EXISTS car_vehicle_status(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vehicle Maintenance
CREATE TABLE IF NOT EXISTS car_maintenance(
    id INT AUTO_INCREMENT PRIMARY KEY,
    maintenance_type_id INT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cost DECIMAL(10,2) DEFAULT(0.00),
    description TEXT(1000),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vehicle Maintenance TYpe
CREATE TABLE IF NOT EXISTS car_maintenance_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    maintenance_type_name VARCHAR(30),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vehicle Fuel Tracking
CREATE TABLE IF NOT EXISTS car_fuel_tracking(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fuel_quantity DECIMAL(5,2) NOT NULL,
    total_cost DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vehicle Review
CREATE TABLE IF NOT EXISTS car_reviews(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    review_text TEXT(1000) NOT NULL,
    rating INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -- Vehicle  Insurance
-- CREATE TABLE IF NOT EXISTS car_insurance(
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     vehicle_id INT NOT NULL,
--     expiry_date TIMESTAMP NOT NULL,
--     insurance_provider VARCHAR(100) NOT NULL,
--     document VARCHAR(100) NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );