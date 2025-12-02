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
  <title>Community - WellnessConnect</title>
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
    .community-card {
      transition: all 0.3s ease;
    }
    .community-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .chat-message {
      max-width: 80%;
    }
    .chat-message.sent {
      margin-left: auto;
      background-color: #0d9488;
      color: white;
      border-radius: 18px 18px 0 18px;
    }
    .chat-message.received {
      margin-right: auto;
      background-color: #f0fdfa;
      border-radius: 18px 18px 18px 0;
    }
    #habit-form {
      transition: all 0.3s ease;
    }
    #habit-form.collapsed {
      max-height: 0;
      opacity: 0;
      overflow: hidden;
      margin-bottom: 0;
      padding: 0;
    }
    #chat-messages {
      scroll-behavior: smooth;
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
    <h1 class="text-4xl font-bold text-teal-800 mb-6">Community Hub</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Left Column - Community Chat -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-md p-6 community-card">
          <div class="flex items-center mb-6">
            <div class="bg-teal-600 text-white p-3 rounded-full mr-4">
              <i class="fas fa-comments text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-teal-800">Wellness Chat</h2>
          </div>
          
          <div id="chat-messages" class="mb-6 space-y-3 max-h-96 overflow-y-auto p-2">
            <!-- Chat messages will be loaded here -->
          </div>
          
          <div class="bg-teal-50 rounded-lg p-4 mb-4">
            <div class="flex">
              <input type="text" id="chat-input" placeholder="Type your message..." class="flex-grow p-3 rounded-l-lg border border-teal-300 focus:outline-none focus:ring-2 focus:ring-teal-500">
              <button id="send-btn" class="px-6 py-3 bg-teal-600 text-white rounded-r-lg hover:bg-teal-700 transition-colors">
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </div>
          
          <div class="flex justify-between text-sm text-teal-600">
            <div>
              <i class="fas fa-info-circle mr-1"></i>
              <span>Messages are saved in your browser</span>
            </div>
            <button id="clear-chat" class="text-teal-600 hover:text-teal-800 transition-colors">
              <i class="fas fa-trash-alt mr-1"></i>
              <span>Clear Chat</span>
            </button>
          </div>
        </div>
      </div>
      
      <!-- Right Column - Habit Sharing -->
      <div class="lg:col-span-1">
        <!-- Share Your Habit -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 community-card">
          <div class="flex items-center mb-4">
            <div class="bg-teal-600 text-white p-3 rounded-full mr-4">
              <i class="fas fa-share-alt text-xl"></i>
            </div>
            <h2 class="text-xl font-bold text-teal-800">Share Your Habit</h2>
          </div>
          
          <button id="toggle-habit-form" class="w-full mb-4 px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
            <i class="fas fa-plus mr-2"></i> Share a Habit
          </button>
          
          <div id="habit-form" class="collapsed">
            <div class="mb-4">
              <label for="habit-name" class="block text-sm font-medium text-teal-700 mb-1">Habit Name</label>
              <input type="text" id="habit-name" class="w-full p-2 border border-teal-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" placeholder="e.g., Morning meditation">
            </div>
            
            <div class="mb-4">
              <label for="habit-category" class="block text-sm font-medium text-teal-700 mb-1">Category</label>
              <select id="habit-category" class="w-full p-2 border border-teal-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                <option value="exercise">Exercise</option>
                <option value="nutrition">Nutrition</option>
                <option value="sleep">Sleep</option>
                <option value="mindfulness">Mindfulness</option>
                <option value="productivity">Productivity</option>
                <option value="other">Other</option>
              </select>
            </div>
            
            <div class="mb-4">
              <label for="habit-description" class="block text-sm font-medium text-teal-700 mb-1">Description</label>
              <textarea id="habit-description" rows="3" class="w-full p-2 border border-teal-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" placeholder="How has this habit helped you?"></textarea>
            </div>
            
            <div class="flex justify-between">
              <button id="cancel-habit" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Cancel
              </button>
              <button id="submit-habit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                Share Habit
              </button>
            </div>
          </div>
        </div>
        
        <!-- Community Habits -->
        <div class="bg-white rounded-xl shadow-md p-6 community-card">
          <div class="flex items-center mb-6">
            <div class="bg-teal-600 text-white p-3 rounded-full mr-4">
              <i class="fas fa-users text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-teal-800">Community Habits</h2>
          </div>
          
          <div id="community-habits" class="space-y-4">
            <!-- Sample habits - in a real app these would be loaded from a database -->
            <div class="bg-teal-50 rounded-lg p-4">
              <div class="flex items-start">
                <div class="bg-teal-100 p-2 rounded-full mr-3">
                  <i class="fas fa-running text-teal-600"></i>
                </div>
                <div>
                  <h3 class="font-bold text-teal-800">10k Steps Daily</h3>
                  <p class="text-sm text-teal-600 mb-2">Posted by Alex</p>
                  <p class="text-teal-700">"Walking 10,000 steps daily has improved my energy levels and helped me maintain a healthy weight."</p>
                  <div class="mt-3 flex items-center text-sm text-teal-600">
                    <i class="fas fa-heart mr-1"></i>
                    <span class="mr-3">24 likes</span>
                    <i class="fas fa-comment mr-1"></i>
                    <span>5 comments</span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="bg-teal-50 rounded-lg p-4">
              <div class="flex items-start">
                <div class="bg-teal-100 p-2 rounded-full mr-3">
                  <i class="fas fa-apple-alt text-teal-600"></i>
                </div>
                <div>
                  <h3 class="font-bold text-teal-800">Vegetable Smoothies</h3>
                  <p class="text-sm text-teal-600 mb-2">Posted by Sam</p>
                  <p class="text-teal-700">"Starting my day with a green smoothie ensures I get my veggies in early and keeps me full until lunch."</p>
                  <div class="mt-3 flex items-center text-sm text-teal-600">
                    <i class="fas fa-heart mr-1"></i>
                    <span class="mr-3">18 likes</span>
                    <i class="fas fa-comment mr-1"></i>
                    <span>3 comments</span>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="bg-teal-50 rounded-lg p-4">
              <div class="flex items-start">
                <div class="bg-teal-100 p-2 rounded-full mr-3">
                  <i class="fas fa-bed text-teal-600"></i>
                </div>
                <div>
                  <h3 class="font-bold text-teal-800">No Screens After 9pm</h3>
                  <p class="text-sm text-teal-600 mb-2">Posted by Jordan</p>
                  <p class="text-teal-700">"Turning off all screens an hour before bed has dramatically improved my sleep quality."</p>
                  <div class="mt-3 flex items-center text-sm text-teal-600">
                    <i class="fas fa-heart mr-1"></i>
                    <span class="mr-3">32 likes</span>
                    <i class="fas fa-comment mr-1"></i>
                    <span>7 comments</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <button id="load-more-habits" class="mt-6 w-full px-4 py-2 bg-teal-100 text-teal-800 rounded-lg hover:bg-teal-200 transition-colors">
            <i class="fas fa-sync-alt mr-2"></i> Load More Habits
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
    // DOM Elements
    const chatMessages = document.getElementById('chat-messages');
    const chatInput = document.getElementById('chat-input');
    const sendBtn = document.getElementById('send-btn');
    const clearChatBtn = document.getElementById('clear-chat');
    const toggleHabitFormBtn = document.getElementById('toggle-habit-form');
    const habitForm = document.getElementById('habit-form');
    const cancelHabitBtn = document.getElementById('cancel-habit');
    const submitHabitBtn = document.getElementById('submit-habit');
    const communityHabits = document.getElementById('community-habits');
    const loadMoreHabitsBtn = document.getElementById('load-more-habits');
    
    // Load saved messages from localStorage
    function loadMessages() {
      const savedMessages = localStorage.getItem('wellnessConnectChat');
      if (savedMessages) {
        const messages = JSON.parse(savedMessages);
        chatMessages.innerHTML = '';
        messages.forEach(msg => {
          addMessageToChat(msg.text, msg.sender, msg.timestamp);
        });
        scrollToBottom();
      }
    }
    
    // Save message to localStorage
    function saveMessage(text, sender) {
      const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
      const message = { text, sender, timestamp };
      
      let messages = [];
      const savedMessages = localStorage.getItem('wellnessConnectChat');
      if (savedMessages) {
        messages = JSON.parse(savedMessages);
      }
      
      messages.push(message);
      localStorage.setItem('wellnessConnectChat', JSON.stringify(messages));
      
      return timestamp;
    }
    
    // Add message to chat UI
    function addMessageToChat(text, sender, timestamp) {
      const messageDiv = document.createElement('div');
      messageDiv.classList.add('chat-message', 'p-3', 'mb-2', sender === 'me' ? 'sent' : 'received');
      
      const messageText = document.createElement('p');
      messageText.textContent = text;
      
      const messageMeta = document.createElement('div');
      messageMeta.classList.add('text-xs', 'mt-1', 'opacity-80');
      messageMeta.textContent = sender === 'me' ? `You at ${timestamp}` : `Community at ${timestamp}`;
      
      messageDiv.appendChild(messageText);
      messageDiv.appendChild(messageMeta);
      chatMessages.appendChild(messageDiv);
    }
    
    // Scroll to bottom of chat
    function scrollToBottom() {
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Clear chat history
    function clearChat() {
      localStorage.removeItem('wellnessConnectChat');
      chatMessages.innerHTML = '';
      
      // Add a system message
      const systemMsg = document.createElement('div');
      systemMsg.classList.add('text-center', 'text-sm', 'text-teal-600', 'py-2');
      systemMsg.textContent = 'Chat history cleared. Start a new conversation!';
      chatMessages.appendChild(systemMsg);
    }
    
    // Toggle habit form visibility
    function toggleHabitForm() {
      habitForm.classList.toggle('collapsed');
      toggleHabitFormBtn.innerHTML = habitForm.classList.contains('collapsed') ? 
        '<i class="fas fa-plus mr-2"></i> Share a Habit' : 
        '<i class="fas fa-minus mr-2"></i> Hide Form';
    }
    
    // Submit new habit
    function submitHabit() {
      const name = document.getElementById('habit-name').value;
      const category = document.getElementById('habit-category').value;
      const description = document.getElementById('habit-description').value;
      
      if (!name || !description) {
        alert('Please fill in all fields');
        return;
      }
      
      // In a real app, this would be saved to a database
      const habitDiv = document.createElement('div');
      habitDiv.classList.add('bg-teal-50', 'rounded-lg', 'p-4');
      
      const categoryIcons = {
        exercise: 'running',
        nutrition: 'apple-alt',
        sleep: 'bed',
        mindfulness: 'spa',
        productivity: 'tasks',
        other: 'star'
      };
      
      habitDiv.innerHTML = `
        <div class="flex items-start">
          <div class="bg-teal-100 p-2 rounded-full mr-3">
            <i class="fas fa-${categoryIcons[category]} text-teal-600"></i>
          </div>
          <div>
            <h3 class="font-bold text-teal-800">${name}</h3>
            <p class="text-sm text-teal-600 mb-2">Posted by You</p>
            <p class="text-teal-700">"${description}"</p>
            <div class="mt-3 flex items-center text-sm text-teal-600">
              <i class="fas fa-heart mr-1"></i>
              <span class="mr-3">0 likes</span>
              <i class="fas fa-comment mr-1"></i>
              <span>0 comments</span>
            </div>
          </div>
        </div>
      `;
      
      // Add to top of community habits
      communityHabits.insertBefore(habitDiv, communityHabits.firstChild);
      
      // Reset form
      document.getElementById('habit-name').value = '';
      document.getElementById('habit-description').value = '';
      toggleHabitForm();
      
      // Show success message
      const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
      addMessageToChat(`I just shared my "${name}" habit with the community!`, 'me', timestamp);
      scrollToBottom();
      
      // Save to localStorage (in a real app this would go to a database)
      const habits = JSON.parse(localStorage.getItem('communityHabits') || '[]');
      habits.unshift({
        name,
        category,
        description,
        user: '<?php echo htmlspecialchars($user['username']); ?>',
        timestamp: new Date().toISOString()
      });
      localStorage.setItem('communityHabits', JSON.stringify(habits));
    }
    
    // Event Listeners
    sendBtn.addEventListener('click', () => {
      const message = chatInput.value.trim();
      if (message) {
        const timestamp = saveMessage(message, 'me');
        addMessageToChat(message, 'me', timestamp);
        chatInput.value = '';
        scrollToBottom();
        
        // Simulate community response (in a real app this would be from other users)
        setTimeout(() => {
          const responses = [
            "That's a great point! I've found that helpful too.",
            "Thanks for sharing! I'll try that.",
            "Interesting perspective. How long have you been doing this?",
            "Welcome to the community! 😊",
            "Has anyone else tried this approach?"
          ];
          const randomResponse = responses[Math.floor(Math.random() * responses.length)];
          const timestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
          saveMessage(randomResponse, 'community');
          addMessageToChat(randomResponse, 'community', timestamp);
          scrollToBottom();
        }, 1000 + Math.random() * 2000);
      }
    });
    
    chatInput.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        sendBtn.click();
      }
    });
    
    clearChatBtn.addEventListener('click', () => {
      if (confirm('Are you sure you want to clear the chat history?')) {
        clearChat();
      }
    });
    
    toggleHabitFormBtn.addEventListener('click', toggleHabitForm);
    cancelHabitBtn.addEventListener('click', toggleHabitForm);
    submitHabitBtn.addEventListener('click', submitHabit);
    
    loadMoreHabitsBtn.addEventListener('click', () => {
      // In a real app, this would load more habits from a database
      const moreHabits = [
        {
          name: "Daily Gratitude Journal",
          category: "mindfulness",
          description: "Writing down 3 things I'm grateful for each morning sets a positive tone for my day.",
          user: "Taylor"
        },
        {
          name: "Meal Prepping Sundays",
          category: "nutrition",
          description: "Spending 2 hours on Sunday preparing meals for the week saves me time and helps me eat healthier.",
          user: "Casey"
        }
      ];
      
      moreHabits.forEach(habit => {
        const habitDiv = document.createElement('div');
        habitDiv.classList.add('bg-teal-50', 'rounded-lg', 'p-4', 'mt-4');
        
        const categoryIcons = {
          exercise: 'running',
          nutrition: 'apple-alt',
          sleep: 'bed',
          mindfulness: 'spa',
          productivity: 'tasks',
          other: 'star'
        };
        
        habitDiv.innerHTML = `
          <div class="flex items-start">
            <div class="bg-teal-100 p-2 rounded-full mr-3">
              <i class="fas fa-${categoryIcons[habit.category]} text-teal-600"></i>
            </div>
            <div>
              <h3 class="font-bold text-teal-800">${habit.name}</h3>
              <p class="text-sm text-teal-600 mb-2">Posted by ${habit.user}</p>
              <p class="text-teal-700">"${habit.description}"</p>
              <div class="mt-3 flex items-center text-sm text-teal-600">
                <i class="fas fa-heart mr-1"></i>
                <span class="mr-3">${Math.floor(Math.random() * 20)} likes</span>
                <i class="fas fa-comment mr-1"></i>
                <span>${Math.floor(Math.random() * 10)} comments</span>
              </div>
            </div>
          </div>
        `;
        
        communityHabits.appendChild(habitDiv);
      });
      
      loadMoreHabitsBtn.textContent = 'No more habits to load';
      loadMoreHabitsBtn.disabled = true;
    });
    
    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
      loadMessages();
      
      // Add welcome message if chat is empty
      if (chatMessages.children.length === 0) {
        const welcomeMsg = document.createElement('div');
        welcomeMsg.classList.add('text-center', 'text-sm', 'text-teal-600', 'py-4');
        welcomeMsg.innerHTML = '<i class="fas fa-comments mr-2"></i> Welcome to the WellnessConnect community! Start chatting below.';
        chatMessages.appendChild(welcomeMsg);
      }
      
      // Load any saved habits from localStorage
      const savedHabits = JSON.parse(localStorage.getItem('communityHabits') || []);
      if (savedHabits.length > 0) {
        // In a real app, these would be loaded from a database with proper pagination
        savedHabits.slice(0, 3).forEach(habit => {
          const habitDiv = document.createElement('div');
          habitDiv.classList.add('bg-teal-50', 'rounded-lg', 'p-4', 'mt-4');
          
          const categoryIcons = {
            exercise: 'running',
            nutrition: 'apple-alt',
            sleep: 'bed',
            mindfulness: 'spa',
            productivity: 'tasks',
            other: 'star'
          };
          
          habitDiv.innerHTML = `
            <div class="flex items-start">
              <div class="bg-teal-100 p-2 rounded-full mr-3">
                <i class="fas fa-${categoryIcons[habit.category]} text-teal-600"></i>
              </div>
              <div>
                <h3 class="font-bold text-teal-800">${habit.name}</h3>
                <p class="text-sm text-teal-600 mb-2">Posted by ${habit.user}</p>
                <p class="text-teal-700">"${habit.description}"</p>
                <div class="mt-3 flex items-center text-sm text-teal-600">
                  <i class="fas fa-heart mr-1"></i>
                  <span class="mr-3">${Math.floor(Math.random() * 20)} likes</span>
                  <i class="fas fa-comment mr-1"></i>
                  <span>${Math.floor(Math.random() * 10)} comments</span>
                </div>
              </div>
            </div>
          `;
          
          communityHabits.appendChild(habitDiv);
        });
      }
    });
  </script>
</body>
</html>