import './bootstrap';

import { io } from 'socket.io-client';

const socket = io();

//const socket = io('https://demo.lifechat.hu:3000');

// Üzenetek fogadása
socket.on('chatmessage', (msg) => {
    console.log('Új üzenet:', msg);
});

