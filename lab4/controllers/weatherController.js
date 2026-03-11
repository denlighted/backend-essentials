const axios = require('axios');
require('dotenv').config();


const API_KEY = process.env.LAB_KEY;

const cities = [
  { name: 'Львів', path: 'Lviv' },
  { name: 'Тернопіль', path: 'Ternopil' },
  { name: 'Одеса', path: 'Odesa' },
  { name: 'Київ', path: 'Kyiv' },
  { name: 'Черкаси', path: 'Cherkasy' },
  { name: 'Обухів', path: 'Obukhiv' }
];

const getLocationWeather = (req, res) => {
  res.render('index', {
    weather: null,
    cities: cities,
    error: null
  });
};

const getCityWeather = async (req, res) => {
  let city = req.params.city;
  if (city === 'local') {
    try {
      const geoResponse = await axios.get('http://ip-api.com/json/');
      city = geoResponse.data.city || 'Kyiv';
    } catch (error) {
      city = 'Kyiv';
    }
  }

  const weatherUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${API_KEY}&units=metric&lang=ua`;

  try {
    const response = await axios.get(weatherUrl);
    res.render('index', {
      weather: response.data,
      cities: cities,
      error: null
    });
  } catch (error) {
    console.error(error);
    res.render('index', {
      weather: null,
      cities: cities,
      error: `City "${city}" not found or an error occurred.`
    });
  }
};

module.exports = {
  getLocationWeather,
  getCityWeather
};