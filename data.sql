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

-- Insert expanded API categories
INSERT INTO categories (name) VALUES 
('Weather'),
('Finance'),
('Geolocation'),
('Sports'),
('Entertainment'),
('Government'),
('Health'),
('Education'),
('News'),
('Social Media'),
('Artificial Intelligence'),
('Games');

-- Insert expanded API records
INSERT INTO apis (name, category_id, base_url, auth_type, docs_url, sample_endpoint, logo_url, notes)
VALUES
-- Weather APIs
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
  'WeatherAPI',
  1,
  'https://api.weatherapi.com',
  'API Key',
  'https://www.weatherapi.com/docs/',
  '/v1/current.json?key=YOUR_API_KEY&q=London',
  '',
  'Provides current weather, forecasts, and historical data with astronomy information.'
),
(
  'AccuWeather API',
  1,
  'https://developer.accuweather.com',
  'API Key',
  'https://developer.accuweather.com/apis',
  '/forecasts/v1/daily/1day/12345?apikey=YOUR_API_KEY',
  '',
  'Offers minute-by-minute forecasts, severe weather alerts, and historical data.'
),

-- Finance APIs
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
  'Alpha Vantage',
  2,
  'https://www.alphavantage.co',
  'API Key',
  'https://www.alphavantage.co/documentation/',
  '/query?function=TIME_SERIES_INTRADAY&symbol=IBM&interval=5min&apikey=YOUR_API_KEY',
  '',
  'Provides real-time and historical stock data, forex, and cryptocurrency prices.'
),
(
  'Yahoo Finance API',
  2,
  'https://yfapi.net',
  'API Key',
  'https://www.yahoofinanceapi.com/',
  '/v6/finance/quote?symbols=AAPL',
  '',
  'Offers stock quotes, historical data, and market analysis.'
),

-- Geolocation APIs
(
  'GeoDB Cities API',
  3, -- Geolocation
  'https://wft-geo-db.p.rapidapi.com',
  'API Key',
  'https://rapidapi.com/wirefreethought/api/geodb-cities/',
  '/v1/geo/cities?namePrefix=Toronto',
  '',
  'Fetches city data including population, time zone, country, coordinates, and local time. Requires RapidAPI key.'
),
(
  'IP Geolocation API',
  3,
  'https://ipgeolocation.io',
  'API Key',
  'https://ipgeolocation.io/documentation.html',
  '/ipgeo?apiKey=YOUR_API_KEY&ip=8.8.8.8',
  '',
  'Provides geolocation data from IP addresses including country, city, ISP, and timezone.'
),
(
  'OpenCage Geocoder',
  3,
  'https://api.opencagedata.com',
  'API Key',
  'https://opencagedata.com/api',
  '/geocode/v1/json?q=Toronto&key=YOUR_API_KEY',
  '',
  'Forward and reverse geocoding with support for over 40 languages.'
),

-- Sports APIs
(
  'The Sports DB',
  4, -- Sports
  'https://www.thesportsdb.com',
  'None',
  'https://www.thesportsdb.com/api.php',
  '/api/v1/json/1/searchteams.php?t=Arsenal',
  '',
  'Comprehensive sports database covering teams, players, events, and statistics.'
),
(
  'NBA API',
  4,
  'https://www.balldontlie.io',
  'None',
  'https://www.balldontlie.io/home.html#introduction',
  '/api/v1/players?search=james',
  '',
  'Free NBA statistics API with player data, game results, and team information.'
),

-- Entertainment APIs
(
  'TVMaze API',
  5, -- Entertainment
  'https://api.tvmaze.com',
  'None',
  'https://www.tvmaze.com/api',
  '/shows/1?embed=cast',
  '',
  'TV show information including episodes, cast, crew, and air times.'
),
(
  'Movie Database Alternative',
  5,
  'https://moviesdatabase.p.rapidapi.com',
  'API Key',
  'https://rapidapi.com/SAdrian/api/moviesdatabase/',
  '/titles/x/upcoming',
  '',
  'Comprehensive movie database with details on films, actors, and ratings.'
),

-- Government APIs
(
  'Data.gov API',
  6, -- Government
  'https://api.data.gov',
  'API Key',
  'https://api.data.gov/docs/',
  '/nrel/alt-fuel-stations/v1/nearest.json?api_key=YOUR_API_KEY&location=Denver+CO',
  '',
  'US government open data portal with thousands of datasets across various agencies.'
),
(
  'UK Police API',
  6,
  'https://data.police.uk',
  'None',
  'https://data.police.uk/docs/',
  '/api/crimes-street/all-crime?lat=52.629729&lng=-1.131592&date=2023-01',
  '',
  'Provides access to UK police crime data and neighborhood information.'
),

-- Health APIs
(
  'COVID-19 API',
  7, -- Health
  'https://disease.sh',
  'None',
  'https://disease.sh/docs/',
  '/v3/covid-19/all',
  '',
  'Global COVID-19 statistics including cases, deaths, and vaccination data.'
),
(
  'Nutritionix API',
  7,
  'https://trackapi.nutritionix.com',
  'API Key',
  'https://developer.nutritionix.com/docs/v2',
  '/v2/natural/nutrients',
  '',
  'Nutrition database with food items, calories, and nutritional information.'
),

-- Education APIs
(
  'Open Library API',
  8, -- Education
  'https://openlibrary.org',
  'None',
  'https://openlibrary.org/developers/api',
  '/api/books?bibkeys=ISBN:0451526538&format=json',
  '',
  'Massive book database with author information, covers, and availability.'
),
(
  'College Scorecard API',
  8,
  'https://api.data.gov/ed/collegescorecard',
  'API Key',
  'https://collegescorecard.ed.gov/data/documentation/',
  '/v1/schools?api_key=YOUR_API_KEY&school.name=Harvard',
  '',
  'US Department of Education data on colleges including costs and outcomes.'
),

-- News APIs
(
  'News API',
  9, -- News
  'https://newsapi.org',
  'API Key',
  'https://newsapi.org/docs',
  '/v2/top-headlines?country=us&apiKey=YOUR_API_KEY',
  '',
  'Global news headlines from over 30,000 sources in 50+ languages.'
),
(
  'New York Times API',
  9,
  'https://api.nytimes.com',
  'API Key',
  'https://developer.nytimes.com/apis',
  '/svc/topstories/v2/home.json?api-key=YOUR_API_KEY',
  '',
  'Access to NYT articles, book reviews, and best seller lists.'
),

-- Social Media APIs
(
  'Twitter API v2',
  10, -- Social Media
  'https://api.twitter.com',
  'OAuth',
  'https://developer.twitter.com/en/docs/twitter-api',
  '/2/tweets/search/recent?query=OpenAI',
  '',
  'Access to Twitter data including tweets, users, and trends.'
),
(
  'Reddit API',
  10,
  'https://www.reddit.com/dev/api',
  'OAuth',
  'https://www.reddit.com/dev/api/',
  '/r/programming/top.json?limit=5',
  '',
  'Access to Reddit posts, comments, and user information.'
),

-- AI APIs
(
  'OpenAI API',
  11, -- Artificial Intelligence
  'https://api.openai.com',
  'API Key',
  'https://platform.openai.com/docs/api-reference',
  '/v1/chat/completions',
  '',
  'Access to GPT models for natural language processing tasks.'
),
(
  'Hugging Face API',
  11,
  'https://api-inference.huggingface.co',
  'API Key',
  'https://huggingface.co/docs/api-inference/index',
  '/models/bert-base-uncased',
  '',
  'Access to thousands of machine learning models for NLP and computer vision.'
),

-- Games APIs
(
  'RAWG Video Games Database',
  12, -- Games
  'https://api.rawg.io',
  'API Key',
  'https://rawg.io/apidocs',
  '/api/games?key=YOUR_API_KEY&search=witcher',
  '',
  'Comprehensive video game database with details on platforms, developers, and ratings.'
),
(
  'PokéAPI',
  12,
  'https://pokeapi.co',
  'None',
  'https://pokeapi.co/docs/v2',
  '/api/v2/pokemon/ditto',
  '',
  'Pokémon database with information on species, moves, abilities, and items.'
);