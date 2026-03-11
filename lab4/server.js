const express = require('express');
const weatherRoutes = require('./routes/weatherRoutes');

const app = express();
const PORT = 3000;

app.set('view engine', 'ejs');

app.use('/weather', weatherRoutes);

app.get('/', (req, res) => {
    res.redirect('/weather');
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});