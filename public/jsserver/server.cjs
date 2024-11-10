const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const cors = require('cors');

const app = express();

const corsOptions ={
    origin:'https://lifechat.hu:3000', 
    credentials:true,            //access-control-allow-credentials:true
    optionSuccessStatus:200
}

/*
const corsOptions ={
    origin:'http://127.0.0.1:8000', 
    credentials:true,            //access-control-allow-credentials:true
    optionSuccessStatus:200
}*/

app.use(cors(corsOptions)); // Engedélyezés minden eredethez


const server = http.createServer(app);
const io = socketIo(server);

io.on('connection', (socket) => {
    console.log('Új felhasználó csatlakozott: ' + socket.id);

    socket.on('chatmessage', (msg) => {
        io.emit('chatmessage', "Teszt özenet"); // Mindenkinek elküldi az üzenetet
    });

    socket.on('disconnect', () => {
        console.log('Felhasználó desconnektálódott: ' + socket.id);
    });
});

server.listen(3000, () => {
    console.log('Szerver a 3000-es porton fut!');
});
