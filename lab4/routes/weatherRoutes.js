const express = require('express');
const router = express.Router();
const weatherController = require('../controllers/weatherController');

router.get('/', weatherController.getLocationWeather);

router.get('/:city', weatherController.getCityWeather);

module.exports = router;