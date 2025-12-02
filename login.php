<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: ../dashboard/index.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>


<body class="bg-gradient-to-br from-teal-100 to-yellow-50 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md">
  <h2 class="text-2xl font-bold text-center text-teal-700 mb-6">Login to WellnessConnect</h2>

  <?php if (!empty($error)): ?>
    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
      <?= htmlspecialchars($error) ?>
    </div>
  <?php endif; ?>

  <form method="POST" class="space-y-4">
    <input type="email" name="email" required placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-400">
    
    <input type="password" name="password" required placeholder="Password" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-teal-400">
    
    <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded hover:bg-teal-700 transition">Login</button>
  </form>

  <p class="mt-4 text-sm text-center">
    Don't have an account?
    <a href="register.php" class="text-teal-600 font-semibold hover:underline">Register here</a>
  </p>
</div>

</body>
</html>
