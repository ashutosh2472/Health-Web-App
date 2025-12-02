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
  <title>Health Tracker - WellnessConnect</title>
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
    .tracker-card {
      transition: all 0.3s ease;
    }
    .tracker-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .progress-ring__circle {
      transition: stroke-dashoffset 0.5s ease;
      transform: rotate(-90deg);
      transform-origin: 50% 50%;
    }
    .habit-day {
      transition: all 0.2s ease;
    }
    .habit-day.active {
      transform: scale(1.1);
    }
    .water-cup {
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .water-cup:hover {
      transform: scale(1.05);
    }
    .water-cup.filled {
      background-color: #0d9488;
      color: white;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-teal-50 to-yellow-50 min-h-screen">

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

  <!-- Main Content -->
  <div class="container mx-auto px-8 py-8">
    <div class="flex flex-col md:flex-row gap-8">
      <!-- Main Tracker Area -->
      <div class="md:w-2/3">
        <h1 class="text-4xl font-bold text-teal-800 mb-6">Health Tracker</h1>
        
        <!-- Daily Summary -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
              <h2 class="text-2xl font-bold text-teal-800">Today's Summary</h2>
              <p class="text-teal-600"><?php echo date('l, F j, Y'); ?></p>
            </div>
            <div class="mt-4 md:mt-0">
              <div class="flex items-center">
                <div class="relative w-20 h-20 mr-4">
                  <svg class="w-full h-full" viewBox="0 0 36 36">
                    <path
                      d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                      fill="none"
                      stroke="#e5e7eb"
                      stroke-width="3"
                    />
                    <path
                      class="progress-ring__circle"
                      d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                      fill="none"
                      stroke="#0d9488"
                      stroke-width="3"
                      stroke-dasharray="100, 100"
                      stroke-dashoffset="<?php echo 100 - 65; ?>"
                    />
                  </svg>
                  <div class="absolute inset-0 flex items-center justify-center text-lg font-bold text-teal-700">
                    65%
                  </div>
                </div>
                <div>
                  <p class="text-sm text-teal-600">Daily Goal Completion</p>
                  <button class="mt-1 px-4 py-1 bg-teal-600 text-white text-sm rounded-full hover:bg-teal-700 transition-colors">
                    View Details
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Water Tracker -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 tracker-card">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div class="flex items-center">
              <div class="bg-teal-600 text-white p-3 rounded-full mr-4">
                <i class="fas fa-glass-water text-xl"></i>
              </div>
              <div>
                <h2 class="text-xl font-bold text-teal-800">Water Intake</h2>
                <p class="text-teal-600">Stay hydrated throughout the day</p>
              </div>
            </div>
            <div class="mt-4 md:mt-0">
              <span class="text-2xl font-bold text-teal-800"><span id="water-consumed">4</span>/<span id="water-goal">8</span> cups</span>
            </div>
          </div>
          
          <div class="mb-4">
            <div class="flex justify-between mb-1">
              <span class="text-sm font-medium text-teal-700">Today's progress</span>
              <span class="text-sm font-medium text-teal-700"><span id="water-percentage">50</span>%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div id="water-progress-bar" class="bg-teal-600 h-2.5 rounded-full" style="width: 50%"></div>
            </div>
          </div>
          
          <div class="grid grid-cols-4 sm:grid-cols-8 gap-3">
            <?php for ($i = 1; $i <= 8; $i++): ?>
              <div class="water-cup text-center p-3 rounded-lg border-2 border-teal-300 <?php echo $i <= 4 ? 'filled' : ''; ?>" data-cup="<?php echo $i; ?>">
                <i class="fas fa-glass-water text-xl mb-1"></i>
                <p class="text-xs font-medium"><?php echo 250 * $i; ?>ml</p>
              </div>
            <?php endfor; ?>
          </div>
          
          <div class="mt-6 flex justify-between">
            <button id="water-minus" class="px-4 py-2 bg-teal-100 text-teal-800 rounded-lg hover:bg-teal-200 transition-colors">
              <i class="fas fa-minus"></i> Remove Cup
            </button>
            <button id="water-plus" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
              <i class="fas fa-plus"></i> Add Cup
            </button>
          </div>
        </div>
        
        <!-- Exercise Tracker -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 tracker-card">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div class="flex items-center">
              <div class="bg-teal-600 text-white p-3 rounded-full mr-4">
                <i class="fas fa-running text-xl"></i>
              </div>
              <div>
                <h2 class="text-xl font-bold text-teal-800">Exercise</h2>
                <p class="text-teal-600">Track your physical activity</p>
              </div>
            </div>
            <div class="mt-4 md:mt-0">
              <span class="text-2xl font-bold text-teal-800"><span id="exercise-minutes">30</span>/<span id="exercise-goal">60</span> mins</span>
            </div>
          </div>
          
          <div class="mb-4">
            <div class="flex justify-between mb-1">
              <span class="text-sm font-medium text-teal-700">Today's activity</span>
              <span class="text-sm font-medium text-teal-700"><span id="exercise-percentage">50</span>%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div id="exercise-progress-bar" class="bg-teal-600 h-2.5 rounded-full" style="width: 50%"></div>
            </div>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-teal-50 rounded-lg p-4">
              <h3 class="font-bold text-teal-800 mb-2">Activity Type</h3>
              <select class="w-full p-2 border border-teal-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                <option>Walking</option>
                <option>Running</option>
                <option>Cycling</option>
                <option>Swimming</option>
                <option>Yoga</option>
                <option>Strength Training</option>
                <option>Other</option>
              </select>
            </div>
            <div class="bg-teal-50 rounded-lg p-4">
              <h3 class="font-bold text-teal-800 mb-2">Duration (minutes)</h3>
              <input type="number" value="15" min="1" max="240" class="w-full p-2 border border-teal-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
            </div>
          </div>
          
          <div class="flex justify-between">
            <button class="px-4 py-2 bg-teal-100 text-teal-800 rounded-lg hover:bg-teal-200 transition-colors">
              <i class="fas fa-history"></i> View History
            </button>
            <button id="add-exercise" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
              <i class="fas fa-plus"></i> Add Exercise
            </button>
          </div>
        </div>
        
        <!-- Sleep Tracker -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 tracker-card">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div class="flex items-center">
              <div class="bg-teal-600 text-white p-3 rounded-full mr-4">
                <i class="fas fa-moon text-xl"></i>
              </div>
              <div>
                <h2 class="text-xl font-bold text-teal-800">Sleep</h2>
                <p class="text-teal-600">Track your sleep quality and duration</p>
              </div>
            </div>
            <div class="mt-4 md:mt-0">
              <span class="text-2xl font-bold text-teal-800"><span id="sleep-hours">6.5</span>/<span id="sleep-goal">8</span> hours</span>
            </div>
          </div>
          
          <div class="mb-4">
            <div class="flex justify-between mb-1">
              <span class="text-sm font-medium text-teal-700">Last night's sleep</span>
              <span class="text-sm font-medium text-teal-700"><span id="sleep-percentage">81</span>%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
              <div id="sleep-progress-bar" class="bg-teal-600 h-2.5 rounded-full" style="width: 81%"></div>
            </div>
          </div>
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-teal-50 rounded-lg p-4">
              <h3 class="font-bold text-teal-800 mb-2">Bedtime</h3>
              <input type="time" value="22:30" class="w-full p-2 border border-teal-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
            </div>
            <div class="bg-teal-50 rounded-lg p-4">
              <h3 class="font-bold text-teal-800 mb-2">Wake-up Time</h3>
              <input type="time" value="06:30" class="w-full p-2 border border-teal-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
            </div>
          </div>
          
          <div class="mb-6">
            <h3 class="font-bold text-teal-800 mb-2">Sleep Quality</h3>
            <div class="flex justify-between">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <button class="sleep-quality-btn p-2 rounded-full <?php echo $i <= 4 ? 'bg-teal-100 text-teal-800' : 'bg-gray-200 text-gray-500'; ?> hover:bg-teal-200 transition-colors" data-rating="<?php echo $i; ?>">
                  <?php if ($i == 1): ?>
                    <i class="fas fa-frown text-xl"></i>
                  <?php elseif ($i == 3): ?>
                    <i class="fas fa-meh text-xl"></i>
                  <?php elseif ($i == 5): ?>
                    <i class="fas fa-grin-stars text-xl"></i>
                  <?php else: ?>
                    <i class="fas fa-smile text-xl"></i>
                  <?php endif; ?>
                </button>
              <?php endfor; ?>
            </div>
          </div>
          
          <div class="flex justify-between">
            <button class="px-4 py-2 bg-teal-100 text-teal-800 rounded-lg hover:bg-teal-200 transition-colors">
              <i class="fas fa-chart-line"></i> View Trends
            </button>
            <button id="save-sleep" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
              <i class="fas fa-save"></i> Save Sleep Data
            </button>
          </div>
        </div>
      </div>
      
      <!-- Sidebar -->
      <div class="md:w-1/3">
        <!-- Weekly Habit Tracker -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 sticky top-32">
          <h2 class="text-xl font-bold text-teal-800 mb-6">Weekly Habit Tracker</h2>
          
          <div class="space-y-4">
            <!-- Water Habit -->
            <div>
              <div class="flex items-center mb-2">
                <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                  <i class="fas fa-glass-water text-teal-600"></i>
                </div>
                <h3 class="font-medium text-teal-800">8 glasses daily</h3>
              </div>
              <div class="flex justify-between">
                <?php 
                $days = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
                $today = date('w'); // 0-6 (Sun-Sat)
                ?>
                <?php foreach ($days as $index => $day): ?>
                  <div class="habit-day text-center <?php echo ($index == $today) ? 'active' : ''; ?>">
                    <div class="w-8 h-8 rounded-full <?php echo ($index < $today && $index % 2 == 0) ? 'bg-teal-500 text-white' : 'bg-gray-200'; ?> flex items-center justify-center mx-auto mb-1">
                      <?php if ($index < $today && $index % 2 == 0): ?>
                        <i class="fas fa-check text-xs"></i>
                      <?php endif; ?>
                    </div>
                    <span class="text-xs font-medium <?php echo ($index == $today) ? 'text-teal-600 font-bold' : 'text-gray-500'; ?>"><?php echo $day; ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            
            <!-- Exercise Habit -->
            <div>
              <div class="flex items-center mb-2">
                <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                  <i class="fas fa-running text-teal-600"></i>
                </div>
                <h3 class="font-medium text-teal-800">30 mins exercise</h3>
              </div>
              <div class="flex justify-between">
                <?php foreach ($days as $index => $day): ?>
                  <div class="habit-day text-center <?php echo ($index == $today) ? 'active' : ''; ?>">
                    <div class="w-8 h-8 rounded-full <?php echo ($index < $today && $index % 3 != 0) ? 'bg-teal-500 text-white' : 'bg-gray-200'; ?> flex items-center justify-center mx-auto mb-1">
                      <?php if ($index < $today && $index % 3 != 0): ?>
                        <i class="fas fa-check text-xs"></i>
                      <?php endif; ?>
                    </div>
                    <span class="text-xs font-medium <?php echo ($index == $today) ? 'text-teal-600 font-bold' : 'text-gray-500'; ?>"><?php echo $day; ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            
            <!-- Sleep Habit -->
            <div>
              <div class="flex items-center mb-2">
                <div class="w-8 h-8 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                  <i class="fas fa-moon text-teal-600"></i>
                </div>
                <h3 class="font-medium text-teal-800">7+ hours sleep</h3>
              </div>
              <div class="flex justify-between">
                <?php foreach ($days as $index => $day): ?>
                  <div class="habit-day text-center <?php echo ($index == $today) ? 'active' : ''; ?>">
                    <div class="w-8 h-8 rounded-full <?php echo ($index < $today && $index % 4 != 0) ? 'bg-teal-500 text-white' : 'bg-gray-200'; ?> flex items-center justify-center mx-auto mb-1">
                      <?php if ($index < $today && $index % 4 != 0): ?>
                        <i class="fas fa-check text-xs"></i>
                      <?php endif; ?>
                    </div>
                    <span class="text-xs font-medium <?php echo ($index == $today) ? 'text-teal-600 font-bold' : 'text-gray-500'; ?>"><?php echo $day; ?></span>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          
          <button class="mt-6 w-full px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
            <i class="fas fa-plus mr-2"></i> Add New Habit
          </button>
        </div>
        
        <!-- Quick Stats -->
        <div class="bg-white rounded-xl shadow-md p-6">
          <h2 class="text-xl font-bold text-teal-800 mb-6">Your Stats</h2>
          
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                  <i class="fas fa-glass-water text-teal-600"></i>
                </div>
                <div>
                  <p class="text-sm text-teal-600">Avg. Water</p>
                  <p class="font-bold text-teal-800">6.2 cups/day</p>
                </div>
              </div>
              <div class="text-right">
                <p class="text-sm <?php echo 6.2 >= 6 ? 'text-teal-600' : 'text-yellow-600'; ?>">
                  <?php echo 6.2 >= 6 ? 'On track' : 'Needs improvement'; ?>
                </p>
                <p class="text-xs text-gray-500">+0.8 from last week</p>
              </div>
            </div>
            
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                  <i class="fas fa-running text-teal-600"></i>
                </div>
                <div>
                  <p class="text-sm text-teal-600">Avg. Exercise</p>
                  <p class="font-bold text-teal-800">28 mins/day</p>
                </div>
              </div>
              <div class="text-right">
                <p class="text-sm <?php echo 28 >= 30 ? 'text-teal-600' : 'text-yellow-600'; ?>">
                  <?php echo 28 >= 30 ? 'On track' : 'Almost there'; ?>
                </p>
                <p class="text-xs text-gray-500">+12 from last week</p>
              </div>
            </div>
            
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                  <i class="fas fa-moon text-teal-600"></i>
                </div>
                <div>
                  <p class="text-sm text-teal-600">Avg. Sleep</p>
                  <p class="font-bold text-teal-800">7.1 hours</p>
                </div>
              </div>
              <div class="text-right">
                <p class="text-sm <?php echo 7.1 >= 7 ? 'text-teal-600' : 'text-yellow-600'; ?>">
                  <?php echo 7.1 >= 7 ? 'Good' : 'Could improve'; ?>
                </p>
                <p class="text-xs text-gray-500">+0.3 from last week</p>
              </div>
            </div>
          </div>
          
          <button class="mt-6 w-full px-4 py-2 bg-teal-100 text-teal-800 rounded-lg hover:bg-teal-200 transition-colors">
            <i class="fas fa-chart-pie mr-2"></i> View Detailed Stats
          </button>
        </div>
      </div>
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
    // Water Tracker Functionality
    const waterCups = document.querySelectorAll('.water-cup');
    const waterConsumedEl = document.getElementById('water-consumed');
    const waterGoalEl = document.getElementById('water-goal');
    const waterPercentageEl = document.getElementById('water-percentage');
    const waterProgressBar = document.getElementById('water-progress-bar');
    const waterPlusBtn = document.getElementById('water-plus');
    const waterMinusBtn = document.getElementById('water-minus');
    
    let currentWater = 4;
    const waterGoal = 8;
    
    function updateWaterTracker() {
      // Update cups visual
      waterCups.forEach((cup, index) => {
        if (index < currentWater) {
          cup.classList.add('filled');
        } else {
          cup.classList.remove('filled');
        }
      });
      
      // Update numbers
      waterConsumedEl.textContent = currentWater;
      const percentage = Math.round((currentWater / waterGoal) * 100);
      waterPercentageEl.textContent = percentage;
      waterProgressBar.style.width = `${percentage}%`;
      
      // Update daily progress in summary
      updateDailyProgress();
    }
    
    // Add cup
    waterPlusBtn.addEventListener('click', () => {
      if (currentWater < waterGoal) {
        currentWater++;
        updateWaterTracker();
      }
    });
    
    // Remove cup
    waterMinusBtn.addEventListener('click', () => {
      if (currentWater > 0) {
        currentWater--;
        updateWaterTracker();
      }
    });
    
    // Click on individual cups
    waterCups.forEach(cup => {
      cup.addEventListener('click', () => {
        const cupNumber = parseInt(cup.getAttribute('data-cup'));
        currentWater = cupNumber;
        updateWaterTracker();
      });
    });
    
    // Exercise Tracker Functionality
    const addExerciseBtn = document.getElementById('add-exercise');
    const exerciseMinutesEl = document.getElementById('exercise-minutes');
    const exerciseGoalEl = document.getElementById('exercise-goal');
    const exercisePercentageEl = document.getElementById('exercise-percentage');
    const exerciseProgressBar = document.getElementById('exercise-progress-bar');
    
    let currentExercise = 30;
    const exerciseGoal = 60;
    
    addExerciseBtn.addEventListener('click', () => {
      const durationInput = document.querySelector('input[type="number"]');
      const duration = parseInt(durationInput.value) || 15;
      
      currentExercise = Math.min(currentExercise + duration, exerciseGoal);
      exerciseMinutesEl.textContent = currentExercise;
      
      const percentage = Math.round((currentExercise / exerciseGoal) * 100);
      exercisePercentageEl.textContent = percentage;
      exerciseProgressBar.style.width = `${percentage}%`;
      
      // Update daily progress in summary
      updateDailyProgress();
      
      // Show success message
      alert(`Added ${duration} minutes of exercise to your tracker!`);
    });
    
    // Sleep Tracker Functionality
    const saveSleepBtn = document.getElementById('save-sleep');
    const sleepHoursEl = document.getElementById('sleep-hours');
    const sleepGoalEl = document.getElementById('sleep-goal');
    const sleepPercentageEl = document.getElementById('sleep-percentage');
    const sleepProgressBar = document.getElementById('sleep-progress-bar');
    const sleepQualityBtns = document.querySelectorAll('.sleep-quality-btn');
    
    let sleepQuality = 4;
    
    sleepQualityBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        sleepQuality = parseInt(btn.getAttribute('data-rating'));
        
        // Update active state
        sleepQualityBtns.forEach(b => {
          if (parseInt(b.getAttribute('data-rating')) <= sleepQuality) {
            b.classList.add('bg-teal-100', 'text-teal-800');
            b.classList.remove('bg-gray-200', 'text-gray-500');
          } else {
            b.classList.remove('bg-teal-100', 'text-teal-800');
            b.classList.add('bg-gray-200', 'text-gray-500');
          }
        });
      });
    });
    
    saveSleepBtn.addEventListener('click', () => {
      const bedtimeInput = document.querySelector('input[type="time"]:first-of-type');
      const wakeupInput = document.querySelector('input[type="time"]:last-of-type');
      
      // Calculate sleep duration (simplified)
      const bedtime = new Date(`2000-01-01T${bedtimeInput.value}:00`);
      const wakeup = new Date(`2000-01-01T${wakeupInput.value}:00`);
      
      // Handle overnight
      if (wakeup < bedtime) {
        wakeup.setDate(wakeup.getDate() + 1);
      }
      
      const diffMs = wakeup - bedtime;
      const diffHours = diffMs / (1000 * 60 * 60);
      const roundedHours = Math.round(diffHours * 10) / 10; // Round to 1 decimal
      
      sleepHoursEl.textContent = roundedHours;
      
      const percentage = Math.round((roundedHours / 8) * 100);
      sleepPercentageEl.textContent = percentage;
      sleepProgressBar.style.width = `${percentage}%`;
      
      // Update daily progress in summary
      updateDailyProgress();
      
      // Show success message
      alert(`Saved sleep data: ${roundedHours} hours with quality rating ${sleepQuality}/5`);
    });
    
    // Habit Tracker Functionality
    const habitDays = document.querySelectorAll('.habit-day');
    
    habitDays.forEach(day => {
      day.addEventListener('click', function() {
        if (this.classList.contains('active')) {
          const dot = this.querySelector('.w-8.h-8.rounded-full');
          if (dot.classList.contains('bg-gray-200')) {
            dot.classList.remove('bg-gray-200');
            dot.classList.add('bg-teal-500', 'text-white');
            dot.innerHTML = '<i class="fas fa-check text-xs"></i>';
          } else {
            dot.classList.remove('bg-teal-500', 'text-white');
            dot.classList.add('bg-gray-200');
            dot.innerHTML = '';
          }
          
          // Update daily progress in summary
          updateDailyProgress();
        }
      });
    });
    
    // Update daily progress circle
    function updateDailyProgress() {
      // Simplified calculation - in real app would track all habits
      const waterProgress = currentWater / waterGoal;
      const exerciseProgress = currentExercise / exerciseGoal;
      const sleepProgress = parseFloat(sleepHoursEl.textContent) / 8;
      
      // Average of the three (weighted equally in this example)
      const overallProgress = (waterProgress + exerciseProgress + sleepProgress) / 3;
      const percentage = Math.round(overallProgress * 100);
      
      // Update the progress ring
      const circle = document.querySelector('.progress-ring__circle');
      circle.style.strokeDashoffset = 100 - percentage;
      
      // Update the percentage text
      document.querySelector('.absolute.inset-0 div').textContent = `${percentage}%`;
    }
  </script>

</body>
</html>