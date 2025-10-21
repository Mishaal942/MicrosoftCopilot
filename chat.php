<?php
session_start();
error_reporting(0);

// Initialize
if (!isset($_SESSION['all_chats'])) {
    $_SESSION['all_chats'] = [];
}

if (!isset($_SESSION['current_chat_id'])) {
    $_SESSION['current_chat_id'] = uniqid('chat_');
    $_SESSION['all_chats'][$_SESSION['current_chat_id']] = [
        'title' => 'New Chat',
        'messages' => [],
        'created' => date('Y-m-d H:i:s')
    ];
}

// New chat
if (isset($_POST['new_chat'])) {
    $_SESSION['current_chat_id'] = uniqid('chat_');
    $_SESSION['all_chats'][$_SESSION['current_chat_id']] = [
        'title' => 'New Chat',
        'messages' => [],
        'created' => date('Y-m-d H:i:s')
    ];
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Switch chat
if (isset($_GET['chat_id']) && isset($_SESSION['all_chats'][$_GET['chat_id']])) {
    $_SESSION['current_chat_id'] = $_GET['chat_id'];
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Delete chat
if (isset($_POST['delete_chat'])) {
    $chatId = $_POST['delete_chat'];
    if (isset($_SESSION['all_chats'][$chatId])) {
        unset($_SESSION['all_chats'][$chatId]);
        if ($_SESSION['current_chat_id'] === $chatId) {
            if (count($_SESSION['all_chats']) > 0) {
                $_SESSION['current_chat_id'] = array_key_first($_SESSION['all_chats']);
            } else {
                $_SESSION['current_chat_id'] = uniqid('chat_');
                $_SESSION['all_chats'][$_SESSION['current_chat_id']] = [
                    'title' => 'New Chat',
                    'messages' => [],
                    'created' => date('Y-m-d H:i:s')
                ];
            }
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// AI Response - Concise & Smart
function getAIResponse($userMessage) {
    $msg = strtolower(trim($userMessage));
    
    // Greetings
    if (preg_match('/\b(hi|hello|hey|salam|assalam)\b/i', $msg)) {
        return "👋 Hello! Main aapka AI assistant hoon. Pakistan, cricket, sports, countries, technology - sab kuch pooch sakte hain!";
    }
    
    // Pakistan
    if (preg_match('/\b(pakistan|pak)\b/i', $msg)) {
        return "🇵🇰 **Pakistan:**\n\n• Capital: Islamabad\n• Largest City: Karachi (20M+)\n• Population: 240M+\n• Founded: 14 Aug 1947\n• Founder: Quaid-e-Azam\n• Famous: K2 (8,611m), Indus River\n• Cities: Lahore, Karachi, Multan, Peshawar\n• Languages: Urdu, Punjabi, Sindhi, Pashto";
    }
    
    // Cricket
    if (preg_match('/\b(cricket|psl|babar|shaheen)\b/i', $msg)) {
        return "🏏 **Pakistan Cricket:**\n\n• 🏆 World Cup 1992 (Imran Khan)\n• 🏆 T20 WC 2009, CT 2017\n• Captain: Babar Azam\n• Stars: Shaheen Afridi, Rizwan\n• Legends: Wasim, Waqar, Shoaib\n• PSL: 6 teams (Karachi, Lahore, Islamabad, etc.)";
    }
    
    // Sports
    if (preg_match('/\b(sport|football|hockey|tennis)\b/i', $msg)) {
        return "⚽ **Sports:**\n\n• Cricket: Pakistan 1992 WC winners\n• Football: FIFA WC 2022 - Argentina\n• Hockey: Pakistan 4 Olympic golds\n• Tennis: Grand Slams (Wimbledon, US Open)\n• Olympics: Every 4 years\n• Basketball: NBA (Lakers, Bulls)";
    }
    
    // Languages
    if (preg_match('/\b(language|urdu|english|arabic)\b/i', $msg)) {
        return "🗣️ **Languages:**\n\n• English: 1.5B speakers\n• Chinese: 1.1B\n• Hindi: 600M\n• Spanish: 550M\n• Arabic: 420M\n• Urdu: 230M\n• French: 280M\n\n7,000+ languages worldwide!";
    }
    
    // Countries
    if (preg_match('/\b(countr|usa|china|india|saudi|uae)\b/i', $msg)) {
        return "🌍 **Countries:**\n\n• USA: 50 states, Tech hub\n• China: 1.42B people, Great Wall\n• India: 1.43B, Taj Mahal\n• Saudi: Makkah, Madinah\n• UAE: Dubai - Burj Khalifa\n• Japan: Tokyo, Tech leader\n\n195 countries total!";
    }
    
    // Cities
    if (preg_match('/\b(cit|karachi|lahore|islamabad|multan|tokyo|dubai)\b/i', $msg)) {
        return "🏙️ **Cities:**\n\n• Karachi: 20M (Economic hub)\n• Lahore: Cultural capital\n• Islamabad: Pakistan's capital\n• Multan: City of Saints\n• Tokyo: Largest metro (39M)\n• Dubai: Burj Khalifa (828m)\n• New York: The Big Apple";
    }
    
    // Animals
    if (preg_match('/\b(animal|dog|cat|lion|tiger|markhor)\b/i', $msg)) {
        return "🦁 **Animals:**\n\n• Largest: Blue Whale (200 tons)\n• Fastest: Cheetah (120 km/h)\n• Pakistan: Markhor (national)\n• Pets: Dogs (900M), Cats (600M)\n• Endangered: Tigers, Pandas\n• Smart: Dolphins, Elephants";
    }
    
    // Social Media
    if (preg_match('/\b(social|facebook|instagram|tiktok|youtube|whatsapp)\b/i', $msg)) {
        return "📱 **Social Media:**\n\n• Facebook: 3B+ users\n• YouTube: 2.5B\n• WhatsApp: 2B+\n• Instagram: 2B\n• TikTok: 1B+\n• X (Twitter): 550M\n• LinkedIn: 900M";
    }
    
    // Technology
    if (preg_match('/\b(tech|ai|phone|iphone|computer|microsoft|apple|google)\b/i', $msg)) {
        return "💻 **Technology:**\n\n• Apple: iPhone, MacBook\n• Microsoft: Windows, AI Copilot\n• Google: Search, Android\n• AI: ChatGPT, Claude, Gemini\n• Phones: iPhone 15, Samsung S24\n• Gaming: PS5, Xbox";
    }
    
    // Science & Space
    if (preg_match('/\b(science|space|nasa|planet|mars)\b/i', $msg)) {
        return "🚀 **Space:**\n\n• Solar System: 8 planets\n• Earth: Only life\n• Moon Landing: 1969\n• Mars: Red planet\n• NASA: Space leader\n• SpaceX: Reusable rockets\n• James Webb Telescope";
    }
    
    // History
    if (preg_match('/\b(history|1947|war|independence)\b/i', $msg)) {
        return "📜 **History:**\n\n• Pakistan: 14 Aug 1947\n• Quaid-e-Azam: Founder\n• WWII: 1939-1945\n• Ancient: Egypt, Greece, Rome\n• Mughal Empire: India\n• Cold War: USA vs USSR";
    }
    
    // Food
    if (preg_match('/\b(food|biryani|pizza|burger)\b/i', $msg)) {
        return "🍕 **Food:**\n\n• Pakistani: Biryani, Nihari, Karahi\n• Italian: Pizza, Pasta\n• American: Burger, Fries\n• Japanese: Sushi\n• Mexican: Tacos\n• Sweets: Gulab Jamun, Jalebi";
    }
    
    // Entertainment
    if (preg_match('/\b(movie|music|hollywood|bollywood)\b/i', $msg)) {
        return "🎬 **Entertainment:**\n\n• Hollywood: Marvel, Avatar\n• Bollywood: SRK, Salman\n• Music: Taylor Swift, Drake, BTS\n• Pakistani: Atif, Rahat, Coke Studio\n• Netflix: Streaming leader";
    }
    
    // Education
    if (preg_match('/\b(education|university|study)\b/i', $msg)) {
        return "📚 **Education:**\n\n• Top Unis: Harvard, Oxford, MIT\n• Pakistan: LUMS, NUST, FAST\n• Online: Coursera, Udemy\n• Skills: Programming, AI\n• Degrees: Bachelor, Master, PhD";
    }
    
    // Health
    if (preg_match('/\b(health|fitness|gym|exercise)\b/i', $msg)) {
        return "💪 **Health:**\n\n• Exercise: 30min daily\n• Diet: Balanced nutrition\n• Water: 8 glasses/day\n• Sleep: 7-9 hours\n• Workouts: Gym, Yoga, Running\n• Mental health important";
    }
    
    // Money
    if (preg_match('/\b(money|dollar|rupee|crypto)\b/i', $msg)) {
        return "💰 **Money:**\n\n• Currencies: USD, EUR, PKR\n• Richest: Elon Musk ($250B)\n• Crypto: Bitcoin, Ethereum\n• Stock: NYSE, NASDAQ\n• Banks: World Bank, IMF";
    }
    
    // Weather
    if (preg_match('/\b(weather|mountain|k2|everest)\b/i', $msg)) {
        return "🌦️ **Geography:**\n\n• Everest: 8,849m (Highest)\n• K2: 8,611m (Pakistan)\n• Rivers: Indus, Nile, Amazon\n• Deserts: Sahara, Thar\n• Climates: Tropical, Desert, Polar";
    }
    
    // Time
    if (preg_match('/\b(time|date|today)\b/i', $msg)) {
        return "⏰ **Time:**\n\n• Today: " . date('l, F j, Y') . "\n• Time: " . date('h:i A') . "\n• Year: 2025\n• 24 time zones worldwide";
    }
    
    // Default
    return "🤖 **I'm AI Copilot!**\n\nAsk me about:\n✅ Pakistan & Cricket\n✅ Sports & Countries\n✅ Technology & AI\n✅ Animals & Nature\n✅ Food & Entertainment\n✅ Education & Health\n\nType: 'Pakistan', 'Cricket', 'Technology', etc.";
}

// Process message
if (isset($_POST['msg']) && !empty(trim($_POST['msg']))) {
    $userMsg = trim($_POST['msg']);
    $botReply = getAIResponse($userMsg);
    
    $_SESSION['all_chats'][$_SESSION['current_chat_id']]['messages'][] = [
        'type' => 'user', 
        'message' => $userMsg, 
        'time' => date('H:i')
    ];
    $_SESSION['all_chats'][$_SESSION['current_chat_id']]['messages'][] = [
        'type' => 'bot', 
        'message' => $botReply, 
        'time' => date('H:i')
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microsoft Copilot - AI Assistant</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .app-container {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: #fff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .logo::before {
            content: '🤖';
            font-size: 28px;
        }

        .new-chat-btn {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .new-chat-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .new-chat-btn::before {
            content: '✨';
        }

        .chat-list {
            padding: 8px;
            flex: 1;
            overflow-y: auto;
        }

        .chat-list::-webkit-scrollbar {
            width: 4px;
        }

        .chat-list::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 2px;
        }

        .chat-item {
            padding: 10px 12px;
            margin-bottom: 4px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .chat-item:hover {
            background: #f3f4f6;
        }

        .chat-item.active {
            background: #e0e7ff;
        }

        .chat-item-content {
            flex: 1;
            min-width: 0;
        }

        .chat-item-title {
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .chat-item-date {
            font-size: 11px;
            color: #9ca3af;
        }

        .delete-btn {
            background: none;
            border: none;
            color: #ef4444;
            cursor: pointer;
            font-size: 16px;
            opacity: 0;
            transition: opacity 0.2s;
            padding: 4px;
        }

        .chat-item:hover .delete-btn {
            opacity: 1;
        }

        /* Main Chat Area */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #fff;
        }

        .chat-header {
            padding: 16px 24px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }

        .status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #6b7280;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
            scroll-behavior: smooth;
        }

        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        .chat-messages::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }

        .message {
            margin-bottom: 20px;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message-content {
            max-width: 70%;
            padding: 12px 16px;
            border-radius: 12px;
            line-height: 1.5;
            font-size: 14px;
            word-wrap: break-word;
            white-space: pre-line;
        }

        .message-time {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 4px;
        }

        .user .message-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 4px;
        }

        .user .message-time {
            text-align: right;
        }

        .bot .message-content {
            background: #f3f4f6;
            color: #1f2937;
            margin-right: auto;
            border-bottom-left-radius: 4px;
            border: 1px solid #e5e7eb;
        }

        .bot .message-time {
            text-align: left;
        }

        .welcome {
            text-align: center;
            padding: 60px 20px;
        }

        .welcome h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .welcome p {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 32px;
        }

        .suggestions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            max-width: 800px;
            margin: 0 auto;
        }

        .suggestion {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
        }

        .suggestion:hover {
            background: #f3f4f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .suggestion strong {
            display: block;
            font-size: 24px;
            margin-bottom: 6px;
        }

        .suggestion span {
            font-size: 13px;
            color: #6b7280;
        }

        /* Input Area */
        .input-area {
            padding: 16px 24px;
            border-top: 1px solid #e5e7eb;
            background: #fff;
        }

        .input-wrapper {
            display: flex;
            gap: 12px;
            max-width: 900px;
            margin: 0 auto;
        }

        input[type="text"] {
            flex: 1;
            padding: 12px 18px;
            border: 1px solid #e5e7eb;
            border-radius: 24px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        input[type="text"]:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .send-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 24px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }

        .send-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -260px;
                height: 100vh;
                z-index: 100;
                transition: left 0.3s;
            }

            .sidebar.open {
                left: 0;
            }

            .message-content {
                max-width: 85%;
            }

            .suggestions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="app-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">Copilot</div>
            <form method="post">
                <button type="submit" name="new_chat" class="new-chat-btn">New chat</button>
            </form>
        </div>
        
        <div class="chat-list">
            <?php 
            $chats = array_reverse($_SESSION['all_chats'], true);
            foreach ($chats as $chatId => $chat): 
                $isActive = $chatId === $_SESSION['current_chat_id'];
                $chatTitle = !empty($chat['messages']) ? substr($chat['messages'][0]['message'], 0, 25) . '...' : 'New Chat';
                $chatDate = date('M j', strtotime($chat['created']));
            ?>
                <div class="chat-item <?php echo $isActive ? 'active' : ''; ?>" onclick="window.location.href='?chat_id=<?php echo $chatId; ?>'">
                    <div class="chat-item-content">
                        <div class="chat-item-title"><?php echo htmlspecialchars($chatTitle); ?></div>
                        <div class="chat-item-date"><?php echo $chatDate; ?></div>
                    </div>
                    <form method="post" onclick="event.stopPropagation()">
                        <button type="submit" name="delete_chat" value="<?php echo $chatId; ?>" class="delete-btn">🗑️</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Main Chat -->
    <div class="main-area">
        <div class="chat-header">
            <div class="chat-title">🤖 AI Copilot</div>
            <div class="status">
                <span class="status-dot"></span>
                Online
            </div>
        </div>

        <div class="chat-messages" id="chatMessages">
            <?php 
            $currentChat = $_SESSION['all_chats'][$_SESSION['current_chat_id']];
            if (empty($currentChat['messages'])): 
            ?>
                <div class="welcome">
                    <h2>👋 Hello! How can I help?</h2>
                    <p>Ask me anything about the world</p>
                    <div class="suggestions">
                        <div class="suggestion">
                            <strong>🇵🇰</strong>
                            <span>Pakistan Info</span>
                        </div>
                        <div class="suggestion">
                            <strong>🏏</strong>
                            <span>Cricket Stats</span>
                        </div>
                        <div class="suggestion">
                            <strong>🌍</strong>
                            <span>Countries</span>
                        </div>
                        <div class="suggestion">
                            <strong>📱</strong>
                            <span>Technology</span>
                        </div>
                        <div class="suggestion">
                            <strong>🦁</strong>
                            <span>Animals</span>
                        </div>
                        <div class="suggestion">
                            <strong>⚽</strong>
                            <span>Sports</span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($currentChat['messages'] as $chat): ?>
                    <div class="message <?php echo $chat['type']; ?>">
                        <div class="message-content">
                            <?php echo nl2br(htmlspecialchars($chat['message'])); ?>
                        </div>
                        <div class="message-time"><?php echo $chat['time']; ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="input-area">
            <form method="post" class="input-wrapper">
                <input type="text" name="msg" placeholder="Ask me anything..." required autocomplete="off">
                <button type="submit" class="send-btn">Send 🚀</button>
            </form>
        </div>
    </div>
</div>

<script>
    const chatMessages = document.getElementById('chatMessages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
</script>

</body>
</html>
