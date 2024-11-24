-- Staff Table
CREATE TABLE IF NOT EXISTS car_staff(
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(80) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    national_id VARCHAR(30) NOT NULL UNIQUE,
    image VARCHAR(100) NOT NULL,
    house_no VARCHAR(20) NOT NULL,
    road_no VARCHAR(20) NOT NULL,
    postal_code VARCHAR(10) NOT NULL,
    state VARCHAR(50) NOT NULL,
    city VARCHAR(10) NOT NULL,
    country VARCHAR(10) NOT NULL,
    designation_id INT NOT NULL,
    date_of_hire DATE NOT NULL,
    salary DECIMAL(15,2) DEFAULT(10000.00),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Staff Designation
CREATE TABLE IF NOT EXISTS car_staff_designations(
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Staff Salary
CREATE TABLE IF NOT EXISTS car_staff_salary(
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NOT NULL,
    salary_date DATE NOT NULL,
    basic_salary DECIMAL(15,2) NOT NULL,
    allowance DECIMAL(10,2),
    deduction DECIMAL(10,2),
    net_salary DECIMAL(15,2) NOT NULL,
    salary_status_id VARCHAR(30),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--Salary Status Table
CREATE TABLE IF NOT EXISTS car_salary_status(
    id INT AUTO_INCREMENT PRIMARY KEY,
    salary_status_name VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Task Status
CREATE TABLE IF NOT EXISTS car_task_status(
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_status_name VARCHAR(40) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Staff Task Table
CREATE TABLE IF NOT EXISTS car_staff_task(
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_assign_by_staff_id INT NOT NULL,
    task_assign_to_staff_id INT NOT NULL,
    vehicle_id INT NOT NULL,
    task_status_id INT NOT NULL,
    task_description VARCHAR(255) NOT NULL,
    task_assign_date DATE NOT NULL,
    task_completion_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);