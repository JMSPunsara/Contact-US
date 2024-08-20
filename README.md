# Contact Form with AJAX, PHP, and MySQL

This project implements a dynamic contact form using **HTML**, **CSS**, **JavaScript (AJAX)**, and **PHP** to handle form submissions, interact with a MySQL database, and provide real-time user feedback.

## Overview

- **Frontend (HTML/CSS)**: A contact form that collects user information (name, email, inquiry, contact number) with `submit` and `reset` buttons.
- **Backend (PHP)**: Processes form data and stores it in a MySQL database.
- **AJAX (JavaScript)**: Handles form submission without reloading the page and displays success/error messages.

<img src="https://lh3.googleusercontent.com/pw/AP1GczMKOZmvSRATA8eMdjHGoB1xndyRwuKAfyT3dI_BfnyjwTop72Z0K1bRcHev_YUZs8KRlGarhSLZA4NyT2NZRnxUbmcGm4uD3nAnL2K9kX_r0IpOgEAzfrfB4AbdoM3SLajX4VSMDTpnxAf1Hri7ykgu=w1815-h869-s-no-gm?authuser=0" alt="Logo" width="1900" height="500">

## File Structure

## 📁 project-root
- ├── **contactform.html** # The frontend HTML form.
- ├── **scripts.js** # The backend JavaScript for AJAX.
- ├── **process.php** # PHP script to process form data and interact with MySQL.
- ├── **styles.css** # CSS file to style the form (not included in this guide).
- └── **README.md** # Documentation.

## SQL Query: (Create the Database and Table)

```CREATE DATABASE contact_form;

USE contact_form;

CREATE TABLE contacts (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    inquiry TEXT NOT NULL,
    contact VARCHAR(15) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```

---

## <img src="https://img2.gratispng.com/20180802/tpl/kisspng-logo-html5-brand-clip-art-%E6%9D%89-%E5%B1%B1-%E8%89%AF-%E9%9B%84-5b62be01b565d5.334247781533197825743.jpg" alt="Logo" width="50" height="60">

**contactform.html**

```<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <form id="contactForm" action="process.php" method="POST" onsubmit="return validateForm()">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
                        
            <label for="contact">Contact Number:</label>
            <input type="text" id="contact" name="contact" required>

            <label for="inquiry">Inquiry:</label>
            <textarea id="inquiry" name="inquiry" required></textarea>

            
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
    </div>

    <script src="scripts.js"></script>
</body>
</html>`

```

---

## <img src="https://cdn.freebiesupply.com/logos/large/2x/css3-logo-png-transparent.png" alt="Logo" width="50" height="60">

**styles.css**
```/* Importing fonts and effects */
@import url('https://fonts.googleapis.com/css2?family=Raleway:wght@300;900&display=swap');

/* Global Styles */
body {
    font-family: 'Raleway', sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    background-size: 400% 400%;
    animation: bgShift 10s infinite ease-in-out;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
    perspective: 1200px;
    color: #fff;
}

/* Background Shift Animation */
@keyframes bgShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* 3D Container with Neon Glow */
.container {
    position: relative;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 40px;
    width: 450px;
    box-shadow: 0 0 50px rgba(0, 255, 255, 0.7), inset 0 0 30px rgba(0, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.2);
    transform-style: preserve-3d;
    transform: rotateY(25deg) rotateX(10deg);
    transition: transform 0.8s ease;
}

.container:hover {
    transform: rotateY(0deg) rotateX(0deg);
}

/* Parallax Shapes */
.container::before {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle at center, rgba(0, 255, 255, 0.6), transparent);
    border-radius: 50%;
    top: -250px;
    left: -300px;
    z-index: -1;
    animation: parallax 15s linear infinite;
}

@keyframes parallax {
    from { transform: translate(0, 0) rotate(0deg); }
    to { transform: translate(-50px, 50px) rotate(360deg); }
}

/* Glowing Title */
h2 {
    font-size: 36px;
    text-align: center;
    background: linear-gradient(135deg, #00c9ff, #92fe9d);
    background-clip: text;
    color: transparent;
    text-shadow: 0 0 10px rgba(0, 255, 255, 0.6);
    letter-spacing: 4px;
    animation: glow 3s ease-in-out infinite alternate;
}

@keyframes glow {
    0% { text-shadow: 0 0 10px rgba(0, 255, 255, 0.6), 0 0 20px rgba(0, 255, 255, 0.4); }
    100% { text-shadow: 0 0 30px rgba(0, 255, 255, 1), 0 0 50px rgba(0, 255, 255, 0.8); }
}

/* Inputs with Ripple Effects */
input, textarea {
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 255, 255, 0.4);
    color: #fff;
    font-size: 18px;
    outline: none;
    position: relative;
    overflow: hidden;
    transition: box-shadow 0.5s ease;
}

input:focus, textarea:focus {
    box-shadow: 0 0 30px rgba(0, 255, 255, 0.7);
}

input:hover, textarea:hover {
    background: rgba(255, 255, 255, 0.2);
}

/* Ripple Effect */
input:focus::after, textarea:focus::after {
    content: '';
    position: absolute;
    width: 300%;
    height: 300%;
    top: -150%;
    left: -150%;
    background: rgba(0, 255, 255, 0.6);
    border-radius: 50%;
    animation: rippleEffect 1s ease-out;
    pointer-events: none;
}

@keyframes rippleEffect {
    from { transform: scale(0); opacity: 1; }
    to { transform: scale(1); opacity: 0; }
}

/* Neon Buttons */
button {
    width: 48%;
    padding: 15px;
    background: linear-gradient(135deg, #00c9ff, #92fe9d);
    color: white;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    font-size: 18px;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.7);
    position: relative;
    transition: all 0.4s ease;
}

button:hover {
    box-shadow: 0 0 40px rgba(0, 255, 255, 1);
    transform: translateY(-5px);
}

button:active {
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.7);
    transform: translateY(2px);
}

/* Responsive Design */
@media (max-width: 600px) {
    .container {
        width: 95%;
        padding: 30px;
    }

    h2 {
        font-size: 28px;
    }

    input, textarea {
        font-size: 16px;
    }

    button {
        font-size: 16px;
        padding: 12px;
    }
}
```

---

## <img src="https://th.bing.com/th/id/OIP.YsuaCftVk7UEvYkW1deYUAHaKY?cb=13&w=1371&h=1922&rs=1&pid=ImgDetMain" alt="Logo" width="50" height="60">

**scripts.js**
```function validateForm() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const contact = document.getElementById("contact").value;

    if (name === "" || email === "" || contact === "") {
        alert("All fields must be filled out!");
        return false;
    }

    const phonePattern = /^[0-9]{10}$/;
    if (!phonePattern.test(contact)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    return true;
}
```

---

## <img src="https://th.bing.com/th/id/R.adbac78231c9a2ff5c21aaa32dd4e1e4?rik=jWTUkOKwKIk7jg&riu=http%3a%2f%2flofrev.net%2fwp-content%2fphotos%2f2017%2f05%2fphp_emblem.png&ehk=gbX0plW%2fbqAeSR4cWmkL44R%2bUWxCpG3CL%2b2V4KHQlpQ%3d&risl=&pid=ImgRaw&r=0" alt="Logo" width="80" height="35">


**process.php**
```<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $inquiry = $_POST['inquiry'];
    $contact = $_POST['contact'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, inquiry, contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $inquiry, $contact);

    // Execute and provide feedback
    if ($stmt->execute()) {
        echo "<script>
        alert('New record created successfully. We will contact you immediately.');
        window.location.href = 'contactform.html';
      </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
```

---
## Thank You 😊
