const AWS = require('aws-sdk');
const config = require('./config.js'); // Assuming config.js is in the same directory

// Configure AWS SDK
AWS.config.update({ region: config.aws.region });

document.getElementById('registerButton').addEventListener('click', async function(event) {
    event.preventDefault();
    
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    
    const userData = {
        username: username,
        email: email,
        password: password
    };
    
    try {
        const response = await fetch(config.backendUrl + '/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': config.userPoolId // Pass the User Pool ID as Authorization header
            },
            body: JSON.stringify(userData)
        });
        
        if (!response.ok) {
            throw new Error('Registration failed');
        }
        
        alert('Registration successful! Please check your email to verify your account.');
        // Optionally, redirect the user to another page after successful registration
        // window.location.href = '/success.html';
        
        // Clear the form fields
        document.getElementById('username').value = '';
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
    } catch (error) {
        console.error('Error:', error);
        alert('Registration failed. Please try again later.');
    }
});
