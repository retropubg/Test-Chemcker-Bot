<?php

$botToken = "8048311747:AAGyGx8dCxU3zsDsct5Hd6T6Ign5G6gVq6Y";
$website = "https://api.telegram.org/bot" . $botToken;

// Obtener la actualización de Telegram
$update = file_get_contents('php://input');

// Verificar si la entrada es válida
if (!$update) {
    error_log("Error: No se recibió ninguna actualización.");
    exit;
}

$update = json_decode($update, true);

// Registrar la actualización para depuración
error_log(print_r($update, true));

if ($update !== null) {
    // Manejo de callback queries
    if (isset($update["callback_query"])) {
        $cchatid2 = $update["callback_query"]["message"]["chat"]["id"] ?? 'Unknown';
        $cmessage_id2 = $update["callback_query"]["message"]["message_id"] ?? 'Unknown';
        $cdata2 = $update["callback_query"]["data"] ?? 'Unknown';
    }
    
    // Manejo de mensajes
    if (isset($update["message"])) {
        $chatId = $update["message"]["chat"]["id"] ?? null;
        $firstname = $update["message"]["from"]["first_name"] ?? 'Usuario';
        $message = $update["message"]["text"] ?? '';

        // Verifica si el mensaje es válido antes de responder
        if ($chatId && !empty($message)) {
            $responseText = "Hola, $firstname! Recibí tu mensaje: \"$message\"";

            // Enviar respuesta al usuario
            $sendMessageUrl = "$website/sendMessage?chat_id=$chatId&text=" . urlencode($responseText);
            file_get_contents($sendMessageUrl);
        }
    }
} else {
    error_log("Error: La actualización de Telegram es nula.");
}

?>
