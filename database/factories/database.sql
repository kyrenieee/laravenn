create database CinemaBooking;

use CinemaBooking;

-- 1. USERS TABLE
-- Stores login info and role (admin or customer)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Store hashed passwords, not plain text
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT
);

CREATE TABLE movies (
    movie_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    genre VARCHAR(50),
    duration_minutes INT, -- Useful for calculating when a show ends
    poster_url VARCHAR(255), -- Path to the image file
    release_date DATE
);

CREATE TABLE theaters (
    theater_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL, -- e.g., "Screen 1", "IMAX Hall"
    capacity INT NOT NULL -- Total number of seats available
);


CREATE TABLE showtimes (
    showtime_id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT NOT NULL,
    theater_id INT NOT NULL,
    start_time DATETIME NOT NULL, -- "YYYY-MM-DD HH:MM:SS"
    price DECIMAL(10, 2) NOT NULL, -- Ticket price for this specific showing
    
    -- Foreign Keys
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id) ON DELETE CASCADE,
    FOREIGN KEY (theater_id) REFERENCES theaters(theater_id) ON DELETE CASCADE
);

CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    showtime_id INT NOT NULL,
    seat_number VARCHAR(10) NOT NULL, -- e.g., "A1", "C4"
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('confirmed', 'cancelled') DEFAULT 'confirmed',
    
    -- Foreign Keys
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (showtime_id) REFERENCES showtimes(showtime_id) ON DELETE CASCADE,
    
    -- unique constraint to prevent double booking the same seat
    UNIQUE(showtime_id, seat_number) 
);
DELETE FROM bookings;
DELETE FROM showtimes;
DELETE FROM movies;
DELETE FROM users;
-- =================================================================
-- 1. USERS (5 total: 1 admin, 4 customers)
-- All users have the password 'password123'
-- =================================================================
INSERT INTO `users` (`username`, `email`, `password`, `role`) VALUES
('admin', 'admin@cinemaworld.com', '$2y$10$Ifa.FqVLCpE53xlzL273a.WqJ5u2vC/fI5AlhQJ0ylg/I2.Gz/C/G', 'admin'),
('john_doe', 'john.d@email.com', '$2y$10$Ifa.FqVLCpE53xlzL273a.WqJ5u2vC/fI5AlhQJ0ylg/I2.Gz/C/G', 'customer'),
('jane_smith', 'jane.s@email.com', '$2y$10$Ifa.FqVLCpE53xlzL273a.WqJ5u2vC/fI5AlhQJ0ylg/I2.Gz/C/G', 'customer'),
('peter_jones', 'peter.j@email.com', '$2y$10$Ifa.FqVLCpE53xlzL273a.WqJ5u2vC/fI5AlhQJ0ylg/I2.Gz/C/G', 'customer'),
('susan_baker', 'susan.b@email.com', '$2y$10$Ifa.FqVLCpE53xlzL273a.WqJ5u2vC/fI5AlhQJ0ylg/I2.Gz/C/G', 'customer');

-- =================================================================
-- 2. THEATERS 
-- =================================================================
INSERT INTO `theaters` (`name`, `capacity`) VALUES
('Hall A', 120),
('Hall B', 80),
('IMAX 3D', 250);

-- =================================================================
-- 3. MOVIES 
-- =================================================================
INSERT INTO `movies` (`title`, `description`, `genre`, `duration_minutes`, `release_date`, `poster_url`) VALUES
('Inception', 'A thief who steals corporate secrets through the use of dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O., but his tragic past may doom the project and his team to disaster.', 'Sci-Fi', 148, '2010-07-16', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmaTHAbTa2MTEGM_PwqBU61jEzjEcQfx-Zb39fyctMdZheq2Uj'),
('The Notebook', 'A poor yet passionate young man falls in love with a rich young woman, giving her a sense of freedom, but they are soon separated because of their social differences.', 'Romance', 124, '2004-06-25', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTKL9v0OGNq0YPwwmI3R13WT-5hc_aR6KwCqkyQud4ColwkoTJz'),
('Happy Gilmore', 'A rejected hockey player puts his skills to the golf course to save his grandmother''s house. He develops a violent and hot-tempered approach to golf that makes him a popular but controversial star.', 'Comedy', 92, '1996-02-16', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSuyfRCIDfrbxfvnDPdyqGsK3CV0LBlKA1_1KXsztV1eer2i6WK'),
('Avengers: Endgame', 'Adrift in space with no food or water, Tony Stark sends a message to Pepper Potts as his oxygen supply starts to dwindle. Meanwhile, the remaining Avengers -- Thor, Black Widow, Captain America and Bruce Banner -- must figure out a way to bring back their vanquished allies for an epic showdown with Thanos.', 'Action', 181, '2019-04-26', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQV7h99odQBTqcKqAZFXGkeCjYG3rqFQD-EOqTe06RMooutDbRP'),
('The Conjuring: The Devil Made Me Do It', 'Paranormal investigators Ed and Lorraine Warren take on one of the most sensational cases of their careers after a cop stumbles upon a dazed and bloodied young man walking down the road. Accused of murder, the suspect claims demonic possession as his defense, forcing the Warrens into a supernatural inquiry unlike anything they''ve ever seen before.', 'Horror', 112, '2021-06-04', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTOpsfBLMRdOZg4ccC2IMNPjc87uLcNiBKZZOGWYRmdzQeSKrkw');

-- =================================================================
-- 4. SHOWTIMES 
-- =================================================================
INSERT INTO `showtimes` (`movie_id`, `theater_id`, `start_time`, `price`) VALUES
(1, 1, DATE_ADD(NOW(), INTERVAL 1 DAY), 350.00), 
(1, 3, DATE_ADD(NOW(), INTERVAL 2 DAY), 550.00),
(4, 3, DATE_ADD(NOW(), INTERVAL 1 DAY), 550.00), 
(5, 2, DATE_ADD(NOW(), INTERVAL 3 DAY), 320.00);


INSERT INTO `bookings` (`user_id`, `showtime_id`, `seat_number`, `status`, `booking_date`) VALUES
(2, 1, 'F5', 'confirmed', NOW());


INSERT INTO `bookings` (`user_id`, `showtime_id`, `seat_number`, `status`, `booking_date`) VALUES
(3, 3, 'G10', 'cancelled', DATE_SUB(NOW(), INTERVAL 1 DAY));