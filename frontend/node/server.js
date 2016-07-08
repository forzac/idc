var http = require('http');
var config = require('./config');
var client = require('socket.io').listen(config.get('socket:port')).sockets;
var s = http.createServer();
var url = [];
var urlstring = "";
var qwe;

s.on('request', function(request, response) {
    response.writeHead(200);
    var data = '';
    request.on('data', function(chunk) {
        data += chunk.toString();
        var arr = data.split(['&']);
        var id = arr[0].split(['=']);
        id = id[1];
        var type = arr[1].split(['=']);
        type = type[1];
        url.push("http://front1.org/" + type + "?mode=edit&" + type + "_id=" + id);
    });
    request.on('end', function() {
        response.end();
    });
});

var idss;
client.on('connection', function(socket){
    socket.id = "123";
    idss = socket.id;
    console.log(socket.id);
    socket.on('test', function(data){
        qwe = data.data;
        //console.log(qwe);
    });
    if(url.length >0 ){
        for(var i = 0 ;i < url.length; i++){
            //socket.emit('output', url[i]);
        }
        //url = [];
    }
    s.on('request', function(request, response) {
        response.writeHead(200);
        var data = '';
        request.on('data', function(chunk) {
            data += chunk.toString();
            var arr = data.split(['&']);
            var id = arr[0].split(['=']);
            id = id[1];
            var type = arr[1].split(['=']);
            type = type[1];
            urlstring = "http://front1.org/" + type + "?mode=edit&" + type + "_id=" + id;
            console.log(idss);
            console.log(urlstring);
            socket.broadcast.to(idss).emit('output', urlstring);
            //socket.emit('output', urlstring);
        });
        request.on('end', function() {
            response.end();
        });
    });
    socket.on('disconnect', function () {
        console.log(qwe);
        urlstring = "";
        url = [];
        console.log('user disconnected');
    });
});



s.listen(config.get('port'));
console.log('OK');