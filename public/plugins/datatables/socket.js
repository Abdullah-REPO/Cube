// socket creating
let socket;

// toggle socket functions
function toggleSocket() {
    if (document.getElementById("socket").checked) {
        SocketOn();
    } else {
        SocketOff();
    }
}

// socket connecting
function SocketOn() {
    socket = new WebSocket("ws://192.168.43.235/");
    socket.onopen = function (e) {
        getElementById(connect).innerHTML("connected-192.168.43.235 ");
    };

    // messages detecting & recognizing
    socket.onmessage = function (event) {
        let data = event.data;
        console.log(data);
        // cases of messages
        if (data.includes("IP")) {
            document.getElementById("ip").innerHTML = data;
        } else if (data.includes("Test")) {
            // Not Req.
        } else {
            document.getElementById("myInput").value = data;
        }
    };
}

// socket disconnecting
function SocketOff() {
    socket.close();
    socket.onclose = function (event) {
        if (event.wasClean) {
            alert(`[close] Connection closed cleanly`);
        } else {
            alert("[close] Connection died");
        }
    };
    socket.onerror = function (error) {
        alert(`[error] ${error.message}`);
    };
    document.getElementById("ip").innerHTML = "IP : UNKNOWN";
    document.getElementById("weight").innerHTML = "off";
    document.getElementById("AddedWeight").innerHTML = "Added Weights : ";
}

// send for ip
function aIP() {
    socket.send("ip");
}

// testing send
function test() {
    socket.send("test");
}

window.addEventListener(
    "beforeunload",
    function (e) {
        SocketOff();
    },
    false
);
