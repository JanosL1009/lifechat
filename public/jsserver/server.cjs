const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const cors = require('cors');

const app = express();

const corsOptions ={
    origin:'http://127.0.0.1:3000', 
    credentials:true,            //access-control-allow-credentials:true
    optionSuccessStatus:200
}

/*
const corsOptions ={
    origin:'https://demo.lifechat.hu:3000', 
    credentials:true,            //access-control-allow-credentials:true
    optionSuccessStatus:200
}*/

app.use(cors(corsOptions)); // Engedélyezés minden eredethez


const server = http.createServer(app);
const io = socketIo(server);

io.on('connection', (socket) => {
    console.log('Új felhasználó csatlakozott: ' + socket.id);
      let  msg = "Hello it vagy?";
    // Chat üzenet fogadása és továbbítása minden csatlakozott kliensnek
    socket.on('chatmessage', (msg) => {
        console.log('Új üzenet:', msg);
        io.emit('chatmessage', msg);  // Mindenkinek elküldi a chat üzenetet
    });

    socket.on('disconnect', () => {
        console.log('Felhasználó desconnektálódott: ' + socket.id);
    });
});

server.listen(3000, () => {
    console.log('Szerver a 3000-es porton fut!');
});