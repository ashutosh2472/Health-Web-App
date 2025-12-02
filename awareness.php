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
  <title>Health Awareness - WellnessConnect</title>
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
    .health-topic {
      scroll-margin-top: 100px;
    }
    .progress-bar {
      height: 8px;
      background-color: #e5e7eb;
      border-radius: 4px;
      overflow: hidden;
    }
    .progress-fill {
      height: 100%;
      background-color: #0d9488;
      transition: width 0.5s ease;
    }
    .accordion-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
    }
    .accordion-content.open {
      max-height: 1000px;
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
    <div class="max-w-4xl mx-auto">
      <h1 class="text-5xl md:text-6xl font-extrabold text-teal-700 mb-6 fade-in">
        Health Awareness Center
      </h1>
      <p class="text-xl text-teal-600 mb-8 leading-relaxed">
        Empowering you with knowledge to make informed decisions about your health and well-being.
      </p>
      <div class="relative max-w-2xl mx-auto">
        <input type="text" placeholder="Search health topics..." class="w-full px-6 py-3 rounded-full border border-teal-300 focus:outline-none focus:ring-2 focus:ring-teal-500">
        <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-teal-600 text-white p-2 rounded-full hover:bg-teal-700 transition-colors">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Quick Navigation -->
  <div class="container mx-auto px-8 py-6">
    <div class="flex overflow-x-auto space-x-4 pb-4 scrollbar-hide">
      <a href="#mental-health" class="whitespace-nowrap px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition-colors">
        <i class="fas fa-brain mr-2"></i> Mental Health
      </a>
      <a href="#nutrition" class="whitespace-nowrap px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition-colors">
        <i class="fas fa-utensils mr-2"></i> Nutrition
      </a>
      <a href="#fitness" class="whitespace-nowrap px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition-colors">
        <i class="fas fa-running mr-2"></i> Fitness
      </a>
      <a href="#preventive-care" class="whitespace-nowrap px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition-colors">
        <i class="fas fa-shield-virus mr-2"></i> Preventive Care
      </a>
      <a href="#chronic-conditions" class="whitespace-nowrap px-6 py-2 bg-teal-600 text-white rounded-full hover:bg-teal-700 transition-colors">
        <i class="fas fa-heartbeat mr-2"></i> Chronic Conditions
      </a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="container mx-auto px-8 py-8 grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Sidebar -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-xl shadow-md p-6 sticky top-32">
        <h3 class="text-xl font-bold text-teal-800 mb-4">Health Topics</h3>
        <ul class="space-y-3">
          <li><a href="#mental-health" class="text-teal-600 hover:text-teal-800 flex items-center"><i class="fas fa-chevron-right mr-2 text-sm"></i> Mental Health</a></li>
          <li><a href="#stress-management" class="text-teal-600 hover:text-teal-800 flex items-center"><i class="fas fa-chevron-right mr-2 text-sm"></i> Stress Management</a></li>
          <li><a href="#nutrition" class="text-teal-600 hover:text-teal-800 flex items-center"><i class="fas fa-chevron-right mr-2 text-sm"></i> Nutrition & Diet</a></li>
          <li><a href="#fitness" class="text-teal-600 hover:text-teal-800 flex items-center"><i class="fas fa-chevron-right mr-2 text-sm"></i> Physical Activity</a></li>
          <li><a href="#sleep" class="text-teal-600 hover:text-teal-800 flex items-center"><i class="fas fa-chevron-right mr-2 text-sm"></i> Sleep Hygiene</a></li>
          <li><a href="#preventive-care" class="text-teal-600 hover:text-teal-800 flex items-center"><i class="fas fa-chevron-right mr-2 text-sm"></i> Preventive Care</a></li>
          <li><a href="#chronic-conditions" class="text-teal-600 hover:text-teal-800 flex items-center"><i class="fas fa-chevron-right mr-2 text-sm"></i> Chronic Conditions</a></li>
        </ul>
        
        <div class="mt-8">
          <h3 class="text-xl font-bold text-teal-800 mb-4">Your Health Tracker</h3>
          <div class="space-y-4">
            <div>
              <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-teal-700">Weekly Activity</span>
                <span class="text-sm text-teal-600">60%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 60%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-teal-700">Water Intake</span>
                <span class="text-sm text-teal-600">80%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 80%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between mb-1">
                <span class="text-sm font-medium text-teal-700">Sleep Quality</span>
                <span class="text-sm text-teal-600">45%</span>
              </div>
              <div class="progress-bar">
                <div class="progress-fill" style="width: 45%"></div>
              </div>
            </div>
          </div>
          <button class="mt-4 w-full px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
            Track Your Progress
          </button>
        </div>
      </div>
    </div>

    <!-- Content Area -->
    <div class="lg:col-span-3 space-y-12">
      <!-- Mental Health Section -->
      <section id="mental-health" class="health-topic bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-teal-100 to-teal-200 p-6">
          <div class="flex items-center">
            <div class="bg-teal-600 text-white p-3 rounded-full mr-4">
              <i class="fas fa-brain text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-teal-800">Mental Health Awareness</h2>
          </div>
        </div>
        <div class="p-6">
          <p class="text-teal-700 mb-6">Mental health is a state of well-being in which an individual realizes their own abilities, can cope with the normal stresses of life, can work productively, and is able to make a contribution to their community.</p>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-teal-50 rounded-lg p-4">
              <h3 class="font-bold text-teal-800 mb-2 flex items-center">
                <i class="fas fa-lightbulb text-teal-600 mr-2"></i> Did You Know?
              </h3>
              <p class="text-teal-700">1 in 5 adults experiences mental illness each year. Less than half receive treatment.</p>
            </div>
            <div class="bg-teal-50 rounded-lg p-4">
              <h3 class="font-bold text-teal-800 mb-2 flex items-center">
                <i class="fas fa-heart text-teal-600 mr-2"></i> Quick Fact
              </h3>
              <p class="text-teal-700">Mental health conditions are treatable, and recovery is possible with proper care and support.</p>
            </div>
          </div>

          <h3 class="text-xl font-bold text-teal-800 mb-4">Common Mental Health Conditions</h3>
          
          <div class="space-y-4 mb-8">
            <div class="accordion-item border border-teal-200 rounded-lg overflow-hidden">
              <button class="accordion-header w-full text-left p-4 bg-teal-50 hover:bg-teal-100 transition-colors flex justify-between items-center">
                <span class="font-medium text-teal-800">Anxiety Disorders</span>
                <i class="fas fa-chevron-down text-teal-600 transition-transform"></i>
              </button>
              <div class="accordion-content">
                <div class="p-4 text-teal-700">
                  <p>Anxiety disorders are the most common mental health concern, affecting over 40 million adults in the U.S. alone. Symptoms include excessive fear or worry, restlessness, and physical symptoms like increased heart rate.</p>
                  <div class="mt-4">
                    <h4 class="font-bold text-teal-800 mb-2">Coping Strategies:</h4>
                    <ul class="list-disc pl-5 space-y-1">
                      <li>Practice deep breathing exercises</li>
                      <li>Limit caffeine and alcohol intake</li>
                      <li>Establish a regular sleep routine</li>
                      <li>Try mindfulness meditation</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item border border-teal-200 rounded-lg overflow-hidden">
              <button class="accordion-header w-full text-left p-4 bg-teal-50 hover:bg-teal-100 transition-colors flex justify-between items-center">
                <span class="font-medium text-teal-800">Depression</span>
                <i class="fas fa-chevron-down text-teal-600 transition-transform"></i>
              </button>
              <div class="accordion-content">
                <div class="p-4 text-teal-700">
                  <p>Depression is more than just feeling sad—it's a serious medical condition that affects how you feel, think, and handle daily activities. Symptoms must last at least two weeks for a diagnosis.</p>
                  <div class="mt-4">
                    <h4 class="font-bold text-teal-800 mb-2">Support Strategies:</h4>
                    <ul class="list-disc pl-5 space-y-1">
                      <li>Maintain social connections</li>
                      <li>Engage in regular physical activity</li>
                      <li>Consider professional therapy</li>
                      <li>Practice self-compassion</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-teal-600 text-white rounded-lg p-6">
            <h3 class="text-xl font-bold mb-4">When to Seek Help</h3>
            <p class="mb-4">If you or someone you know is struggling with mental health concerns, don't hesitate to reach out for help. Early intervention can make a significant difference in recovery.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <a href="#" class="px-4 py-2 bg-white text-teal-700 rounded-lg font-medium text-center hover:bg-teal-50 transition-colors">
                Find a Therapist
              </a>
              <a href="#" class="px-4 py-2 bg-teal-800 text-white rounded-lg font-medium text-center hover:bg-teal-900 transition-colors">
                Crisis Hotline
              </a>
            </div>
          </div>
        </div>
      </section>

      <!-- Nutrition Section -->
      <section id="nutrition" class="health-topic bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-teal-100 to-teal-200 p-6">
          <div class="flex items-center">
            <div class="bg-teal-600 text-white p-3 rounded-full mr-4">
              <i class="fas fa-utensils text-2xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-teal-800">Nutrition & Healthy Eating</h2>
          </div>
        </div>
        <div class="p-6">
          <p class="text-teal-700 mb-6">Good nutrition is about more than just calories—it's about getting the right nutrients to fuel your body and mind. A balanced diet can help prevent disease, boost energy, and improve mental clarity.</p>
          
          <div class="mb-8">
            <h3 class="text-xl font-bold text-teal-800 mb-4">The Healthy Plate Model</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div class="bg-teal-50 rounded-lg p-4 text-center">
                <div class="bg-teal-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                  <i class="fas fa-apple-alt text-teal-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-teal-800 mb-2">50% Fruits & Vegetables</h4>
                <p class="text-teal-700 text-sm">Aim for variety and color—different colors provide different nutrients.</p>
              </div>
              <div class="bg-teal-50 rounded-lg p-4 text-center">
                <div class="bg-teal-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                  <i class="fas fa-bread-slice text-teal-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-teal-800 mb-2">25% Whole Grains</h4>
                <p class="text-teal-700 text-sm">Choose whole grains over refined grains for better nutrition and fiber.</p>
              </div>
              <div class="bg-teal-50 rounded-lg p-4 text-center">
                <div class="bg-teal-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                  <i class="fas fa-drumstick-bite text-teal-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-teal-800 mb-2">25% Lean Protein</h4>
                <p class="text-teal-700 text-sm">Include plant-based proteins like beans and lentils along with animal proteins.</p>
              </div>
            </div>
          </div>

          <div class="mb-8">
            <h3 class="text-xl font-bold text-teal-800 mb-4">Nutrition Tips</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="flex items-start">
                <div class="bg-teal-100 p-2 rounded-full mr-4 flex-shrink-0">
                  <i class="fas fa-check text-teal-600"></i>
                </div>
                <div>
                  <h4 class="font-bold text-teal-800 mb-1">Stay Hydrated</h4>
                  <p class="text-teal-700">Drink at least 8 glasses of water daily. Limit sugary drinks and excessive caffeine.</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="bg-teal-100 p-2 rounded-full mr-4 flex-shrink-0">
                  <i class="fas fa-check text-teal-600"></i>
                </div>
                <div>
                  <h4 class="font-bold text-teal-800 mb-1">Read Labels</h4>
                  <p class="text-teal-700">Be aware of added sugars, sodium, and unhealthy fats in packaged foods.</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="bg-teal-100 p-2 rounded-full mr-4 flex-shrink-0">
                  <i class="fas fa-check text-teal-600"></i>
                </div>
                <div>
                  <h4 class="font-bold text-teal-800 mb-1">Portion Control</h4>
                  <p class="text-teal-700">Use smaller plates and be mindful of serving sizes to avoid overeating.</p>
                </div>
              </div>
              <div class="flex items-start">
                <div class="bg-teal-100 p-2 rounded-full mr-4 flex-shrink-0">
                  <i class="fas fa-check text-teal-600"></i>
                </div>
                <div>
                  <h4 class="font-bold text-teal-800 mb-1">Plan Meals</h4>
                  <p class="text-teal-700">Prepare healthy meals in advance to avoid last-minute unhealthy choices.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
            <div class="flex">
              <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-yellow-500 text-xl mr-3 mt-1"></i>
              </div>
              <div>
                <h4 class="font-bold text-yellow-800 mb-1">Special Dietary Needs</h4>
                <p class="text-yellow-700">If you have specific health conditions (diabetes, hypertension, etc.), consult a registered dietitian for personalized nutrition advice.</p>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white border border-teal-200 rounded-lg p-6 shadow-sm">
              <h3 class="text-lg font-bold text-teal-800 mb-3">Healthy Recipes</h3>
              <p class="text-teal-700 mb-4">Discover delicious, nutritious recipes to support your wellness journey.</p>
              <a href="#" class="inline-flex items-center text-teal-600 hover:text-teal-800 font-medium">
                Explore Recipes <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
            <div class="bg-white border border-teal-200 rounded-lg p-6 shadow-sm">
              <h3 class="text-lg font-bold text-teal-800 mb-3">Meal Planning</h3>
              <p class="text-teal-700 mb-4">Get weekly meal plans and shopping lists to make healthy eating easy.</p>
              <a href="#" class="inline-flex items-center text-teal-600 hover:text-teal-800 font-medium">
                Start Planning <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-teal-800 text-teal-100 py-8 relative z-10 mt-12">
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
    // Accordion functionality
    document.querySelectorAll('.accordion-header').forEach(header => {
      header.addEventListener('click', () => {
        const accordionItem = header.parentElement;
        const accordionContent = header.nextElementSibling;
        const icon = header.querySelector('i');
        
        // Toggle the open class on the content
        accordionContent.classList.toggle('open');
        
        // Rotate the icon
        icon.classList.toggle('rotate-180');
        
        // Close other accordion items
        document.querySelectorAll('.accordion-item').forEach(item => {
          if (item !== accordionItem) {
            item.querySelector('.accordion-content').classList.remove('open');
            item.querySelector('.accordion-header i').classList.remove('rotate-180');
          }
        });
      });
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
          targetElement.scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });
  </script>

</body>
</html>