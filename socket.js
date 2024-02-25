
const ws = new WebSocket('ws://127.0.0.1:8080');

// Nájdi všetky tlačidlá a po kliknutí zmeň hodnotu a pošli request na server

const buttons = document.querySelectorAll(".togglePinButton");
            
buttons.forEach(button  => {
    button.onclick = () => {

        if(button.value == "Vypnuté") {
            button.style.backgroundColor = "green";
            button.value = "Zapnuté";
            sendAJAXrequest(button.name, button.value);


        } else if(button.value == "Zapnuté") {
            button.style.backgroundColor = "rgb(138, 19, 39)";
            button.value = "Vypnuté";
            sendAJAXrequest(button.name, button.value);
        }
    }
})


function sendAJAXrequest(pin, state) {
    const xhr = new XMLHttpRequest();
    let data = JSON.stringify({pin: pin, state: state});
            
    xhr.open("POST", "updateGPIO.php", true);
    xhr.send(data);

    ws.send(data);
}



ws.onmessage = (message) => {

    let parsedData = JSON.parse(message.data);

    if(parsedData.connecting) {

        let numberText = document.getElementById("numberOfDevices");
        numberText.innerText = parsedData.number;

    } else {

        let button = document.getElementById(parsedData.pin);

        button.value = parsedData.state;
    
        if(button.value == "Zapnuté") {
            button.style.backgroundColor = "green";
    
        } else if(button.value == "Vypnuté") {
            button.style.backgroundColor = "rgb(138, 19, 39)";
        }
    }
}

    