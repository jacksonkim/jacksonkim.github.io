const express = require('express');
const app = express();
const path = require('path');
const port = 3000;

//process.env.PORT

// Use express.urlencoded middleware to parse form data
app.use(express.urlencoded({ extended: true }));

// Serve static files from the root folder
app.use(express.static(path.join(__dirname)));

//to load the form as requested
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'contactform.html')); // Serve the contact form
});

//on-click for the submit button
app.post('/submit', (req, res) => {
    const { custName, custEmail, custSub, custComment, custState, items, agree } = req.body;

    // Process the form data (e.g., save to database, send email, etc.)
    console.log('Form data received:', {
        custName,
        custEmail,
        custSub,
        custComment,
        custState,
        items,
        agree
    });

    //this has to be coded using backticks
    res.redirect(`/formthanks?custName=${encodeURIComponent(custName)}`)
});

app.get('/formthanks', (req, res) => {
    const { custName } = req.query;
    
    res.sendFile(path.join(__dirname, 'formthanks.html')); // send HTML file on GET request
});

app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
});

//https://jacksonkim.github.io/