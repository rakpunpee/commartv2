var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');
var mysql = require("mysql");
var requestIp = require('request-ip');

connectionsArray = [];
var con = mysql.createConnection({
    host: "172.18.0.155",
    user: "jib999",
    password: "jibxtranet999*",
    database: "setspec"
});
server.listen(2560);
var POLLING_INTERVAL = 2000,
pollingTimer;

con.connect(function(err) {
    if (err) {
        console.log('Error connecting to Db');
        return;
    }
    console.log('Connection To MySQL Server.');
});


var pollingLoop = function() {

    sql1 = "SELECT * FROM stock_CPU ORDER BY brand ASC";
    con.query(sql1, function(error, results, fields) {
        if (error) throw error;
        var cpu = [];
        cpu.push(results);
        if (connectionsArray.length) {
           // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
           updateSockets({
            cpu: cpu
        }, "requestQuery1");
       } else {
        console.log('Not Client Connected?');
    }

});

    sql2 = "SELECT * FROM stock_mainboard ORDER BY brand ASC";
    con.query(sql2, function(error, results, fields) {
        if (error) throw error;
        var mainboard = [];
        mainboard.push(results);
        if (connectionsArray.length) {
           // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
            updateSockets({
                mainboard: mainboard
            }, "requestQuery2");
        } else {
            console.log('Not Client Connected?');
        }

    });
    sql3 = "SELECT * FROM stock_RAM ORDER BY brand ASC";
    con.query(sql3, function(error, results, fields) {
        if (error) throw error;
        var ram = [];
        ram.push(results);
        if (connectionsArray.length) {
           // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
            updateSockets({
                ram: ram
            }, "requestQuery3");
        } else {
            console.log('Not Client Connected?');
        }

    });
    sql4 = "SELECT * FROM stock_hddinternal ORDER BY brand DESC";
    con.query(sql4, function(error, results, fields) {
        if (error) throw error;
        var hdd = [];
        hdd.push(results);
        if (connectionsArray.length) {
           // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
            updateSockets({
                hdd: hdd
            }, "requestQuery4");
        } else {
            console.log('Not Client Connected?');
        }

    });
    sql5 = "SELECT * FROM stock_vga ORDER BY brand DESC";
    con.query(sql5, function(error, results, fields) {
        if (error) throw error;
        var vga = [];
        vga.push(results);
        if (connectionsArray.length) {
           // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
            updateSockets({
                vga: vga
            }, "requestQuery5");
        } else {
            console.log('Not Client Connected?');
        }
    });
     sql6 = "SELECT * FROM stock_soundcard ORDER BY brand DESC";
        con.query(sql6, function(error, results, fields) {
            if (error) throw error;
            var sound = [];
            sound.push(results);
            if (connectionsArray.length) {
               // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                updateSockets({
                    sound: sound
                }, "requestQuery6");
            } else {
                console.log('Not Client Connected?');
            }
        });
     sql7 = "SELECT * FROM stock_dvdrom ORDER BY brand DESC";
        con.query(sql7, function(error, results, fields) {
            if (error) throw error;
            var dvd = [];
            dvd.push(results);
            if (connectionsArray.length){
                //pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                updateSockets({
                    dvd: dvd
                }, "requestQuery7");
            } else {
                console.log('Not Client Connected?');
            }
        });
     sql8 = "SELECT * FROM stock_case ORDER BY brand DESC";
            con.query(sql8, function(error, results, fields) {
                if (error) throw error;
                var casepc = [];
                casepc.push(results);
                if (connectionsArray.length){
                   // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                    updateSockets({
                        casepc: casepc
                    }, "requestQuery8");
                } else {
                    console.log('Not Client Connected?');
                }
            });
     sql9 = "SELECT * FROM stock_monitor ORDER BY brand DESC";
            con.query(sql9, function(error, results, fields) {
                if (error) throw error;
                var monitor = [];
                monitor.push(results);
                if (connectionsArray.length){
                   // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                    updateSockets({
                        monitor: monitor
                    }, "requestQuery9");
                } else {
                    console.log('Not Client Connected?');
                }
            });
     sql10 = "SELECT * FROM stock_keyboard ORDER BY brand DESC";
            con.query(sql10, function(error, results, fields) {
                if (error) throw error;
                var keyboard = [];
                keyboard.push(results);
                if (connectionsArray.length){
                   // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                    updateSockets({
                        keyboard: keyboard
                    }, "requestQuery10");
                } else {
                    console.log('Not Client Connected?');
                }
            });
    sql11 = "SELECT * FROM stock_mouse ORDER BY brand DESC";
            con.query(sql11, function(error, results, fields) {
                if (error) throw error;
                var mouse = [];
                mouse.push(results);
                if (connectionsArray.length){
                   // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                    updateSockets({
                        mouse: mouse
                    }, "requestQuery11");
                } else {
                    console.log('Not Client Connected?');
                }
            });
    sql12 = "SELECT * FROM stock_gaming ORDER BY brand DESC";
            con.query(sql12, function(error, results, fields) {
                if (error) throw error;
                var gaming = [];
                gaming.push(results);
                if (connectionsArray.length){
                   // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                    updateSockets({
                        gaming: gaming
                    }, "requestQuery12");
                } else {
                    console.log('Not Client Connected?');
                }
            });
    sql13 = "SELECT * FROM stock_ssd ORDER BY brand DESC";
            con.query(sql13, function(error, results, fields) {
                if (error) throw error;
                var ssd = [];
                ssd.push(results);
                if (connectionsArray.length){
                    // pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                    updateSockets({
                        ssd: ssd
                    }, "requestQuery13");
                } else {
                    console.log('Not Client Connected?');
                }
            });
      sql14 = "SELECT * FROM stock_powersub ORDER BY brand DESC";
            con.query(sql14, function(error, results, fields) {
                if (error) throw error;
                var power = [];
                power.push(results);
                if (connectionsArray.length){
                    pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
                    updateSockets({
                        power: power
                    }, "requestQuery14");
                } else {
                    console.log('Not Client Connected?');
                }
            });        

};


// creating a new websocket to keep the content updated without any AJAX request
io.sockets.on('connection', function(socket) {
    var socketId = socket.id;
    var clientIp = socket.request.connection.remoteAddress;
    console.log('[' + connectionsArray.length + ']New Client is Connected!' + clientIp);
    if (!connectionsArray.length) {

        pollingLoop();

    }
    socket.on('disconnect', function() {
        var socketIndex = connectionsArray.indexOf(socket);
        console.log(clientIp + '>>Client = %s  LogOut', socketIndex);
        if (~socketIndex) {
            connectionsArray.splice(socketIndex, 1);
        }
    });
    connectionsArray.push(socket);
});

var updateSockets = function(data, messager) {
    data.time = new Date();
    connectionsArray.forEach(function(tmpSocket) {
        tmpSocket.volatile.emit(messager, data);
    });
};

