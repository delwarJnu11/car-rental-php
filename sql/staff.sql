-- Staff Table
CREATE TABLE IF NOT EXISTS staff(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    designation VARCHAR(50) NOT NULL,
    date_of_hire DATE NOT NULL,
    salary DECIMAL(15,2) DEFAULT(10000.00),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- staff user
CREATE TABLE IF NOT EXISTS users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    role_id INT NOT NULL,
);

-- Staff Salary
CREATE TABLE IF NOT EXISTS staff_salar(
    id INT AUTO_INCREMENT PRIMARY KEY,
    staff_id INT NOT NULL,
    salary_date DATE NOT NULL,
    basic_salary DECIMAL(15,2) NOT NULL,
    allowance DECIMAL(10,2),
    deduction DECIMAL(10,2),
    net_salary DECIMAL(15,2) NOT NULL,
    salary_status VARCHAR(30) ENUM("PAID", "UNPAID"),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);