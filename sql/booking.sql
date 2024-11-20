-- Booking Status
CREATE TABLE IF NOT EXISTS car_booking_status(
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_status VARCHAR(40) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Booking
CREATE TABLE IF NOT EXISTS car_bookings(
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_id INT NOT NULL,
    customer_id INT NOT NULL,
    booking_status_id INT NOT NULL,
    booking_date TIMESTAMP NOT NULL,
    journey_start_date TIMESTAMP NOT NULL,
    journey_end_date TIMESTAMP NOT NULL,
    pick_up_location VARCHAR(255) NOT NULL,
    drop_off_location VARCHAR(255) NOT NULL,
    rent_amount DECIMAL(10,2) NOT NULL,
    final_amount_after_discount DECIMAL(10,2) NOT NULL,
    paid_amount DECIMAL(15,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Booking Payments Table
CREATE TABLE IF NOT EXISTS car_payments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    customer_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50),
    payment_status_id VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Booking Status
CREATE TABLE IF NOT EXISTS car_payment_status(
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_status VARCHAR(40) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);