<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jules Crafting Corner</title>
    <style>
        body {
            background-color: #ffd9e3;
            /* Pink background color */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #ff80b3;
            /* Darker pink for header */
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            text-align: center;
            padding: 10px;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
        }

        section {
            padding: 20px;
            text-align: center;
        }

        footer {
            background-color: #ff80b3;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <img src="C:\Users\palme\OneDrive\Desktop\Mp.html\01DEC706-3183-4853-8AB2-EBCCD27D8118.jpg" alt="Jules Crafting Corner Logo" height="120" width="120">
        <h1>Jules Crafting Corner</h1>
    </header>

    <nav>
        <a href="Homepage.php">Home</a>
        <a href="gallery.php">Gallery</a>
        <a href="products.php">Product Listing</a>
        <a href="cart.php">Shopping Cart</a>
    </nav>

    <section>
        <h2>Registration</h2>
        <div>
        <form method="post" action="process_registration.php">
            <input type="text" name="first_name" placeholder="First Name">
            <input type="text" name="last_name" placeholder="Last Name">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" value="Register">
        </form>
    </div>
    </section>

    <footer>
        <p>&copy; 2024 Jules Crafting Corner</p>
    </footer>
</body>

</html>