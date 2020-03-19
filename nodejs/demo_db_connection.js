sql = require('mysql');

var con = sql.createConnection({
  host: "192.155.88.98",
  user: "web",
  password: "930492hudfalknsd32048"
});

con.connect(function(err) {
  if (err) throw err;


  console.log("Connected!");
});
