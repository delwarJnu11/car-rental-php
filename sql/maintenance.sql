-- maintenance parts
CREATE TABLE IF NOT EXISTS car_parts(
    id INT AUTO_INCREMENT PRIMARY KEY,
    parts_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(15,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- vehicles expense for maintenance table
CREATE TABLE IF NOT EXISTS car_expenses(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    parts_id INT NOT NULL,
    maintenance_type_id INT NOT NULL,
    maintenance_date TIMESTAMP NOT NULL,
    amount DECIMAL(15,2) NOT NULL,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);