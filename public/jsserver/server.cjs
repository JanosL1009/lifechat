const express = require('express');
const http = require('http');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server);

io.on('connection', (socket) => {
    console.log('Új felhasználó csatlakozott: ' + socket.id);

    socket.on('chat message', (msg) => {
        io.emit('chat message', msg); // Mindenkinek elküldi az üzenetet
    });

    socket.on('disconnect', () => {
        console.log('Felhasználó desconnektálódott: ' + socket.id);
    });
});

server.listen(3000, () => {
    console.log('Szerver a 3000-es porton fut!');
});
