<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; 
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    $sql = "INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $phone, $password);

    if ($stmt->execute()) {
         echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        /* Estilos generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        /* Contenedor del formulario */
        .register-container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .register-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }
        
        /* Título */
        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: #2D3748;
            font-size: 2rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: #6B73FF;
            border-radius: 3px;
        }
        
        /* Formulario */
        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        /* Grupos de entrada */
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        label {
            font-size: 0.95rem;
            color: #4A5568;
            font-weight: 500;
            margin-left: 5px;
        }
        
        input {
            padding: 14px 16px;
            border: 2px solid #E2E8F0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: #6B73FF;
            box-shadow: 0 0 0 3px rgba(107, 115, 255, 0.2);
        }
        
        /* Botón */
        button {
            background: linear-gradient(to right, #6B73FF, #000DFF);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            letter-spacing: 0.5px;
        }
        
        button:hover {
            background: linear-gradient(to right, #5A67D8, #0008CC);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(107, 115, 255, 0.4);
        }
        
        /* Efecto activo del botón */
        button:active {
            transform: translateY(0);
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .register-container {
                padding: 2rem 1.5rem;
            }
            
            h2 {
                font-size: 1.7rem;
                margin-bottom: 1.5rem;
            }
            
            input {
                padding: 12px 14px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registro</h2>
        <form method="POST">
            <div class="input-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="input-group">
                <label for="phone">Teléfono:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            
            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>
</html>