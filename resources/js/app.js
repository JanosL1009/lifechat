import './bootstrap';

import { io } from 'socket.io-client';

const socket = io('http://localhost:3000');



// Üzenetek fogadása
socket.on('chat message', (msg) => {
    console.log('Új üzenet:', msg);
});

