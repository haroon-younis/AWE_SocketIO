var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');

var redis = new Redis();

redis.subscribe('test-channel');

redis.on('message', function(channel, message) {
    // when message is recived then console log
    message = JSON.parse(message);

    // event will be UserSignedUp as set in the data array in web.php
    io.emit(channel + ':' + message.event, message.data);

    console.log(message.data.username);
});

server.listen(3000);
