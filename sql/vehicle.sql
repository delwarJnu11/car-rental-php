CREATE TABLE IF NOT EXISTS vehicles(
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
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
    vehicle_review_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vechicle Types Table
CREATE TABLE IF NOT EXISTS vehicle_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_type_name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vechicle Engine Types Table
CREATE TABLE IF NOT EXISTS vehicle_engine_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_engine_type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vechicle Status Table
CREATE TABLE IF NOT EXISTS vehicle_status(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);