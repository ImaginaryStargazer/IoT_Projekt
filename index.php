<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>IoT Projekt</title>
</head>
<body>

    <header class="headerContainer">
        <h1>Ovládanie pinov</h1>
    </header>

    <div class="infoWrapper">
        <p>Počet pripojených zariadení:</p><h1 id="numberOfDevices">0</h1>
    </div>

    <div class="buttonsContainer">

        <div>

            <div class="buttonWrapper">
                <input id="6" type="submit" class="togglePinButton" name="6" value="Vypnuté">
                <p class="deviceStateText">Zásuvka</p>
            </div>

            <div class="buttonWrapper">
                <input id="13" type="submit" class="togglePinButton" name="13" value="Vypnuté">
                <p class="deviceStateText">Zásuvka</p>
            </div>

            <div class="buttonWrapper">
                <input id="19" type="submit" class="togglePinButton" name="19" value="Vypnuté">
                <p class="deviceStateText">Svetlo</p>
            </div>

            <div class="buttonWrapper">
                <input id="26" type="submit" class="togglePinButton" name="26" value="Vypnuté">
                <p class="deviceStateText">Svetlo</p>
            </div>
        </div>
    </div>

    <footer class="createdByContainer">
        <h2>Vytvorili:</h2>
        <h3>Patrik Navarčík, Kristian Toman, Martin Rajecký, Nikita Kyslyi, Samuel Gonščák, Šimon Dujnič, Zalán Pavlík, Jakub Šauša</h3>
    </footer>

    <script>



        function fetchPinData() {

            
            fetch("readGPIO.php", {
                cache: "no-cache",
                headers: {
                    "Content-Type": "text/plain;charset=UTF-8",
                    
                },
            }) 
            .then(response => response.json())
            .then(data => {

                for(let i = 0; i < buttons.length; i++) {


                    if(data[i] == 1) {
                        buttons[i].style.backgroundColor = "green";
                        buttons[i].value = "Zapnuté";
                    } else {
                        buttons[i].style.backgroundColor = "rgb(138, 19, 39)";
                        buttons[i].value = "Vypnuté";
                    }
                }
                

            })
            .catch(error => {
                console.error("Nastala chyba!")
            })
        }

                
        // Zavoláme pri prvom načítaní stránky

        fetchPinData();

    </script>
    <script src="socket.js"></script>

    
</body>
</html>