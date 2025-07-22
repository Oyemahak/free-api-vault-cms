-- Step 1: Create the database
CREATE DATABASE IF NOT EXISTS free_api_vault;
USE free_api_vault;

-- Step 2: Create categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Step 3: Create apis table
CREATE TABLE IF NOT EXISTS apis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category_id INT,
    base_url VARCHAR(255) NOT NULL,
    auth_type ENUM('None', 'API Key', 'OAuth') DEFAULT 'None',
    docs_url VARCHAR(255),
    sample_endpoint VARCHAR(255),
    logo_url VARCHAR(255),
    notes TEXT,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Insert API categories
INSERT INTO categories (name) VALUES 
('Weather'),
('Finance'),
('Geolocation');

-- Insert API records
INSERT INTO apis (name, category_id, base_url, auth_type, docs_url, sample_endpoint, logo_url, notes)
VALUES
(
  'OpenWeatherMap API',
  1, -- Weather
  'https://api.openweathermap.org',
  'API Key',
  'https://openweathermap.org/api',
  '/data/2.5/weather?q=Toronto&appid=YOUR_API_KEY',
  '',
  'Provides real-time weather data for any city. Supports temperature, humidity, wind, and weather icons.'
),
(
  'ExchangeRate.host API',
  2, -- Finance
  'https://api.exchangerate.host',
  'None',
  'https://exchangerate.host/#/',
  '/convert?from=USD&to=EUR',
  '',
  'Offers real-time currency exchange rates. No API key needed. Supports historical and symbol-based conversion.'
),
(
  'GeoDB Cities API',
  3, -- Geolocation
  'https://wft-geo-db.p.rapidapi.com',
  'API Key',
  'https://rapidapi.com/wirefreethought/api/geodb-cities/',
  '/v1/geo/cities?namePrefix=Toronto',
  '',
  'Fetches city data including population, time zone, country, coordinates, and local time. Requires RapidAPI key.'
);