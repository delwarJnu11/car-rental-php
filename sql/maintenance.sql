CREATE TABLE car_maintenance(
    id INT AUTO_INCREMENT PRIMARY KEY, 
    vehicle_id INT NOT NULL,                       
    driver_id INT NOT NULL,
    maintenance_status_id INT NOT NULL,
    description varchar(255),
    cost DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
);

-- Expense Table
CREATE TABLE car_expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    maintenance_id INT
    fuel_tracking_id INT,
    expense_type NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    description varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Fuel Tracking Table
CREATE TABLE car_fuel_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    vehicle_id INT NOT NULL,
    driver_id INT NOT NULL,
    fuel_type_id INT NOT NULL,
    quantity DECIMAL(10, 2) NOT NULL,
    cost_per_unit DECIMAL(10, 2) NOT NULL,
    total_cost DECIMAL(10, 2) NOT NULL,
    filling_station_name VARCHAR(255) NOT NULL,
    location VARCHAR(255),
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Fuel Type Table
CREATE TABLE car_fuel_type (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


