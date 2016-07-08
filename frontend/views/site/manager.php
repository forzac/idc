<script src="http://localhost:8080/socket.io/socket.io.js"></script>
<div id='url'></div>
<script>
    (function(){
        var socket = io.connect('http://localhost:8080');
        if(socket !== undefined){
            socket.on('output', function(data){
                console.log(data);
                var message = document.getElementById('url');
                var textnode = document.createTextNode(data);
                var node = document.createElement("a");
                node.appendChild(textnode);
                node.href = data;
                message.appendChild(node);
                message.appendChild(document.createElement("br"))
            });
            socket.emit('test', {data: 'dasd'});
        }
    })();
</script>