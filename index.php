<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome - WellnessConnect</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(-20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .fade-in {
      animation: fadeIn 1s ease-out;
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .wave-bg {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      overflow: hidden;
      line-height: 0;
    }
    .wave-bg svg {
      position: relative;
      display: block;
      width: calc(100% + 1.3px);
      height: 150px;
    }
    .wave-bg .shape-fill {
      fill: rgba(16, 185, 129, 0.1);
    }
    .quote-transition {
      transition: opacity 0.5s ease-in-out;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-teal-50 to-yellow-50 min-h-screen relative overflow-x-hidden">

  <!-- Navigation -->
  <nav class="bg-white bg-opacity-80 backdrop-blur-sm shadow-sm py-4 px-8 sticky top-0 z-10">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex items-center space-x-2">
        <i class="fas fa-heartbeat text-teal-600 text-2xl"></i>
        <span class="text-xl font-bold text-teal-700">WellnessConnect</span>
      </div>
      <div class="flex items-center space-x-4">
        <span class="text-teal-700 hidden md:inline">Welcome, <?php echo htmlspecialchars($user['username']); ?></span>
        <span class="px-3 py-1 bg-teal-100 text-teal-800 rounded-full text-sm"><?php echo $user['role']; ?></span>
        <a href="../auth/logout.php" class="px-4 py-2 text-teal-700 hover:text-teal-900 transition-colors">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="container mx-auto px-8 py-12 text-center relative z-0">
    <div class="max-w-3xl mx-auto">
      <h1 class="text-5xl md:text-6xl font-extrabold text-teal-700 mb-6 fade-in">
        Welcome back, <span class="text-teal-600"><?php echo htmlspecialchars($user['username']); ?>!</span>
      </h1>
      <p class="text-xl text-teal-600 mb-8 leading-relaxed">
        Your journey to better well-being starts here. Explore our resources to enhance your mental and physical health.
      </p>
    </div>
  </div>

  <!-- Features Grid -->
  <div class="container mx-auto px-8 pb-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Awareness Card -->
      <a href="../feature/awareness.php" class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
        <div class="h-48 bg-gradient-to-r from-teal-100 to-teal-200 flex items-center justify-center">
          <i class="fas fa-lightbulb text-5xl text-teal-700"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-teal-800 mb-2">Awareness</h3>
          <p class="text-teal-600">Learn about mental health and wellness through our curated resources.</p>
          <div class="mt-4 text-teal-600 flex items-center">
            <span>Explore now</span>
            <i class="fas fa-arrow-right ml-2"></i>
          </div>
        </div>
      </a>
      
      <!-- Tips Card -->
      <a href="../feature/tracker.php" class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
        <div class="h-48 bg-gradient-to-r from-teal-100 to-teal-200 flex items-center justify-center">
          <i class="fas fa-spa text-5xl text-teal-700"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-teal-800 mb-2">Well-being Tracker</h3>
          <p class="text-teal-600">Practical advice and strategies to improve your daily wellness routine.</p>
          <div class="mt-4 text-teal-600 flex items-center">
            <span>Discover tips</span>
            <i class="fas fa-arrow-right ml-2"></i>
          </div>
        </div>
      </a>
      
      <!-- Community Card -->
      <a href="../feature/community.php" class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
        <div class="h-48 bg-gradient-to-r from-teal-100 to-teal-200 flex items-center justify-center">
          <i class="fas fa-users text-5xl text-teal-700"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-teal-800 mb-2">Community</h3>
          <p class="text-teal-600">Connect with others who share your wellness journey and goals.</p>
          <div class="mt-4 text-teal-600 flex items-center">
            <span>Join community</span>
            <i class="fas fa-arrow-right ml-2"></i>
          </div>
        </div>
      </a>
    </div>
  </div>

  <!-- Stats Section -->
  <div class="bg-teal-700 text-white py-12">
    <div class="container mx-auto px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div>
          <div class="text-4xl font-bold mb-2">10K+</div>
          <div class="text-teal-100">Community Members</div>
        </div>
        <div>
          <div class="text-4xl font-bold mb-2">500+</div>
          <div class="text-teal-100">Wellness Resources</div>
        </div>
        <div>
          <div class="text-4xl font-bold mb-2">24/7</div>
          <div class="text-teal-100">Support Available</div>
        </div>
        <div>
          <div class="text-4xl font-bold mb-2">100%</div>
          <div class="text-teal-100">Confidential</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Daily Tip with Rotating Quotes -->
  <div class="container mx-auto px-8 py-16">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-4xl mx-auto">
      <div class="flex items-center mb-4">
        <div class="bg-teal-100 p-3 rounded-full mr-4">
          <i class="fas fa-quote-left text-teal-700 text-xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-teal-800">Daily Wellness Tip</h2>
      </div>
      <div class="pl-16">
        <div id="quote-container" class="min-h-24">
          <p class="text-lg text-teal-700 mb-4 quote-transition" id="current-quote">
            "Start your day with 5 minutes of mindful breathing. Find a quiet space, close your eyes, and focus on your breath. This simple practice can reduce stress and improve focus throughout your day."
          </p>
        </div>
        <div class="flex justify-end">
          <a href="/feature/tracker.php" class="px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition-all duration-300">
            More Tips <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Wave Background -->
  <div class="wave-bg">
    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
    </svg>
  </div>

  <!-- Footer -->
  <footer class="bg-teal-800 text-teal-100 py-8 relative z-10">
    <div class="container mx-auto px-8">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
          <div class="flex items-center space-x-2">
            <i class="fas fa-heartbeat text-2xl"></i>
            <span class="text-xl font-bold">WellnessConnect</span>
          </div>
          <p class="mt-2 text-teal-200">Your partner in health and wellness</p>
        </div>
        <div class="flex space-x-6">
          <a href="#" class="text-teal-200 hover:text-white transition-colors">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="text-teal-200 hover:text-white transition-colors">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-teal-200 hover:text-white transition-colors">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>
      <div class="mt-8 pt-6 border-t border-teal-700 text-center text-sm text-teal-300">
        &copy; <?php echo date("Y"); ?> WellnessConnect. All rights reserved.
      </div>
    </div>
  </footer>

  <script>
    // Array of wellness quotes
    const wellnessQuotes = [
      '"Start your day with 5 minutes of mindful breathing. Find a quiet space, close your eyes, and focus on your breath. This simple practice can reduce stress and improve focus throughout your day."',
      '"Regular physical activity is one of the most important things you can do for your health. Aim for at least 30 minutes of moderate exercise most days of the week."',
      '"Quality sleep is essential for mental and physical recovery. Establish a consistent sleep schedule and create a relaxing bedtime routine."',
      '"Stay hydrated throughout the day. Even mild dehydration can affect your mood, energy levels, and cognitive function."',
      '"Practice gratitude daily. Taking time to appreciate the positive aspects of your life can significantly improve your overall well-being."',
      '"Social connections are vital for mental health. Make time to connect with friends, family, or community members regularly."',
      '"Take short breaks throughout your workday. Just 5 minutes of stretching or walking can refresh your mind and body."',
      '"Limit screen time before bed. The blue light from devices can interfere with your natural sleep cycle."',
      '"Incorporate more whole foods into your diet. Fruits, vegetables, and whole grains provide essential nutrients for both body and mind."',
      '"Learn to say no when needed. Setting healthy boundaries is crucial for maintaining balance and reducing stress."'
    ];

    // Function to rotate quotes
    function rotateQuote() {
      const quoteElement = document.getElementById('current-quote');
      let currentIndex = 0;
      
      // Set interval to change quote every 2 minutes (120000 milliseconds)
      setInterval(() => {
        // Fade out
        quoteElement.style.opacity = 0;
        
        // After fade out completes, change quote and fade in
        setTimeout(() => {
          currentIndex = (currentIndex + 1) % wellnessQuotes.length;
          quoteElement.textContent = wellnessQuotes[currentIndex];
          quoteElement.style.opacity = 1;
        }, 500); // Matches the CSS transition duration
      }, 120000);
    }

    // Initialize quote rotation when page loads
    document.addEventListener('DOMContentLoaded', rotateQuote);
  </script>

</body>
</html>