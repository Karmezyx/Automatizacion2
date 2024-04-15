<?php

// Define el token de acceso de tu bot de Telegram
$telegram_token = '7185890305:AAGD8XhflCtjFbtfr8w8wdYNrTRAG5tr5Nk';

// Obtiene la actualización del bot de Telegram
$update = json_decode(file_get_contents('php://input'), TRUE);

// Verifica si la actualización es válida
if(isset($update) && !empty($update)){
    // Obtiene el mensaje del usuario
    $message = $update['message'];
    
    // Obtiene el texto del mensaje
    $text = $message['text'];
    
    // Verifica el texto del mensaje y responde en consecuencia
    switch($text){
        case '/start':
            sendMessage($message['chat']['id'], '¡Hola! ¿En qué puedo ayudarte?');
            break;
        case 'Pasillo 1':
            sendMessage($message['chat']['id'], 'En el Pasillo 1 encontrarás: Carne, Queso, Jamón');
            break;
        case 'Pasillo 2':
            sendMessage($message['chat']['id'], 'En el Pasillo 2 encontrarás: Leche, Yogurth, Cereal');
            break;
        case 'Pasillo 3':
            sendMessage($message['chat']['id'], 'En el Pasillo 3 encontrarás: Bebidas, Jugos');
            break;
        case 'Pasillo 4':
            sendMessage($message['chat']['id'], 'En el Pasillo 4 encontrarás: Pan, Pasteles, Tortas');
            break;
        case 'Pasillo 5':
            sendMessage($message['chat']['id'], 'En el Pasillo 5 encontrarás: Detergente, Lavaloza');
            break;
        default:
            sendMessage($message['chat']['id'], 'Lo siento, no entendí tu pregunta.');
            break;
    }
}

// Función para enviar mensajes al usuario a través del bot de Telegram
function sendMessage($chat_id, $message){
    global $telegram_token;
    $url = 'https://api.telegram.org/bot' . $telegram_token . '/sendMessage';
    $data = array('chat_id' => $chat_id, 'text' => $message);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}

?>