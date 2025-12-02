<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        echo "<div class='bg-teal-100 text-teal-700 px-4 py-2 rounded mb-4 text-center'>Registration successful. <a href='login.php' class='text-teal-600 font-semibold hover:underline'>Login here</a></div>";
    } else {
        echo "<div class='bg-red-100 text-red-700 px-4 py-2 rounded mb-4 text-center'>Error: " . $stmt->error . "</div>";
    }
}
?>

<body class="bg-gradient-to-br from-teal-100 to-yellow-50 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">
  <h2 class="text-2xl font-bold text-center text-teal-700 mb-6">Create Your Account</h2>

  <form method="POST" class="space-y-4">
    <input type="text" name="username" required placeholder="Username" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-400">
    
    <input type="email" name="email" required placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-400">
    
    <input type="password" name="password" required placeholder="Password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-400">
    
    <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded hover:bg-teal-700 transition">Register</button>
  </form>

  <p class="mt-4 text-sm text-center">
    Already have an account? 
    <a href="login.php" class="text-teal-600 font-semibold hover:underline">Login here</a>
  </p>
</div>

</body>
</html>
