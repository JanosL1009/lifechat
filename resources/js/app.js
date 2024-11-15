import './bootstrap';

import { io } from 'socket.io-client';
/*
const socket = io('https://lifechat.hu');
*/
console.log('Klien js elindult.');
const socket = io('http://localhost:3000');

// Üzenetek fogadása és megjelenítése
socket.on('chatmessage', (msg) => {
    console.log('Új üzenet:', msg);
    sendMessage('Ez tök jó');
    // Például hozzáadhatod az üzenetet a HTML DOM-hoz
    const chatBox = document.getElementById('chat-box');
    if (chatBox) {
        const messageElement = document.createElement('p');
        messageElement.textContent = msg;
        chatBox.appendChild(messageElement);
    }
});

// Üzenet küldése a szervernek
function sendMessage(message) {
    socket.emit('chatmessage', message);  // Üzenet küldése a szervernek
}
