<?php

$botToken =  "7633669044:AAHiS9PWSZkyZeHdTA6m8-6PYNf9DKitfvQ";
$website = "https://api.telegram.org/bot".$botToken;
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

// Log the incoming update for debugging
error_log(print_r($update, true));

if ($update !== null) {
    if (isset($update["callback_query"])) {
        $cchatid2 = $update["callback_query"]["message"]["chat"]["id"] ?? 'Unknown';
        $cmessage_id2 = $update["callback_query"]["message"]["message_id"] ?? 'Unknown';
        $cdata2 = $update["callback_query"]["data"] ?? 'Unknown';
    }
    
    if (isset($update["message"])) {
        $username = $update["message"]["from"]["username"] ?? 'Unknown';
        $chatId = $update["message"]["chat"]["id"] ?? 'Unknown';
        $chatusername = $update["message"]["chat"]["username"] ?? 'Unknown';
        $chatname = $update["message"]["chat"]["title"] ?? 'Unknown';
        $gId = $update["message"]["from"]["id"] ?? 'Unknown';
        $userId = $update["message"]["from"]["id"] ?? 'Unknown';
        $firstname = $update["message"]["from"]["first_name"] ?? 'Unknown';
        $message = $update["message"]["text"] ?? 'Unknown';
        $new_chat_member = $update["message"]["new_chat_member"] ?? null;
        
        if ($new_chat_member) {
            $newusername = $new_chat_member["username"] ?? 'Unknown';
            $newgId = $new_chat_member["id"] ?? 'Unknown';
            $newfirstname = $new_chat_member["first_name"] ?? 'Unknown';
        }

        $message_id = $update["message"]["message_id"] ?? 'Unknown';
        $r_id = $update["message"]["reply_to_message"] ?? null;
        
        if ($r_id) {
            $r_userId = $r_id["from"]["id"] ?? 'Unknown';
            $r_firstname = $r_id["from"]["first_name"] ?? 'Unknown';
            $r_username = $r_id["from"]["username"] ?? 'Unknown';
            $r_msg_id = $r_id["message_id"] ?? 'Unknown';
            $r_msg = $r_id["text"] ?? 'Unknown';
        }
        
        $sender_chat = $update["message"]["sender_chat"]["type"] ?? 'Unknown';
    }
} else {
    error_log('Invalid JSON input');
    exit;
}

?>
