var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);
users = [];
connections = [];




server.listen(process.env.PORT || 3000,()=>{
    console.log('Server started on port 5000');
});

app.get('/', (req,res) => {
    res.sendFile(__dirname + '/index.html');
});

io.sockets.on('connection', (socket)=>{
    connections.push(socket);
    console.log("Connections: %s sockets connected", connections.length);

    // Dissconect
    socket.on('disconnect', (data)=>{
        connections.splice(connections.indexOf(socket), 1);
        console.log('Disconnected: %s sockets conencted', connections.length);
    })
    // send message
    socket.on('send message', (data)=>{
        console.log(data);
        io.sockets.emit('new message',{msg:data});
    });
});