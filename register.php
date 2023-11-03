<?php
session_start();

include 'db_connection.php';

$errors = []; // Array to hold validation errors
$message = ''; // Variable to hold our success message

function validateFormData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = validateFormData($_POST['name']);
    $email = validateFormData($_POST['email']);
    $password = validateFormData($_POST['password']);

    // Name validation
    if (empty($name)) {
        $errors['name'] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]{2,100}$/", $name)) { // Adjust the regex as needed
        $errors['name'] = "Only letters and white space allowed in Name, and it must be between 2 and 100 characters.";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Password validation: Updated to include various checks
    if (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $errors['password'] .= " Password must include at least one uppercase letter.";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $errors['password'] .= " Password must include at least one lowercase letter.";
    } elseif (!preg_match('/\d/', $password)) {
        $errors['password'] .= " Password must include at least one number.";
    } elseif (!preg_match('/[\W_]/', $password)) {
        $errors['password'] .= " Password must include at least one special character.";
    } elseif (preg_match('/\s/', $password)) {
        $errors['password'] .= " Password must not contain spaces.";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT Email FROM Users WHERE Email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $errors['email'] = "Email already registered!";
        } else {
            // Hash the password and insert the new user into the database
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO Users (Name, Email, Password) VALUES (?, ?, ?)");
            if ($stmt->execute([$name, $email, $passwordHash])) {
                // Registration success
                $message = 'Registration successful!';
                // Redirect to login page
                header('Location: login.php?registered=1');
                exit;
            } else {
                // Registration failed
                $message = 'Registration failed!';
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Lato, sans-serif;
            background-color: #F8E4E4;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    
    <?php if($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <header>
        <div class="logo">
            <img src="Assets/logo.png" alt="Your Logo">
        </div>
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="outlets.php">Outlets</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li class="cart-icon">
                <?php 
                if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] === false): ?>
                    <li><a href="login.php" class="nav-item login">Login</a></li>
                    <li><a href="register.php" class="nav-item register">Register</a></li>
                <?php else: ?>
                    <li><a href="logout.php" class="nav-item logout">Logout</a></li>
                <?php endif; ?>
                <a href="cart.php">
                    <img src="Assets/cart-icon.png" alt="Cart" class="cart-img"> 
                    <!-- Displaying the count of items in the cart -->
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <span class="cart-count"><?= count($_SESSION['cart']) ?></span>
                    <?php endif; ?>
                </a>
                </li>
            </ul>
        </div>
    </header>
    
    <div class="login-container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Register</h2>
        <div class="form-group">
            <input type="text" name="name" placeholder="Name" value="<?php echo isset($name) ? $name : ''; ?>">
            <?php if(isset($errors['name'])): ?><p class="error"><?php echo $errors['name']; ?></p><?php endif; ?>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : ''; ?>">
            <?php if(isset($errors['email'])): ?><p class="error"><?php echo $errors['email']; ?></p><?php endif; ?>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password">
            <?php if(isset($errors['password'])): ?><p class="error"><?php echo $errors['password']; ?></p><?php endif; ?>
        </div>
        <input type="submit" value="Register">
    </form>
    </div>
</body>
</html>