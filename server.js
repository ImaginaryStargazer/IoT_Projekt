const WS = require('ws');
const PORT = process.env.PORT || 8080;
const wss = new WS.Server({
  port: PORT
}, () => console.log(`Server sa spustil na porte: ${PORT}`))

let connectedDeviceData = {
    connecting: true,
    number: 0,
}

const errHandle = (err) => {
  if(err) throw err
}

wss.on("error", (err) => {
    errHandle(err);
})


wss.on("connection", (socket) => {

    connectedDeviceData.number++;
    sendBroadCast(JSON.stringify(connectedDeviceData))


    socket.on("close", () => {
        
        connectedDeviceData.number--;
        sendBroadCast(JSON.stringify(connectedDeviceData))
    })

    socket.on("message", (data, isBinary) => {
        sendBroadCast(data, isBinary)
    })
})


function sendBroadCast(data,isBinary) {

    wss.clients.forEach(function each(client) {

        if (client.readyState === WS.OPEN) {
            client.send(data, { binary: isBinary });
        }
    })
}