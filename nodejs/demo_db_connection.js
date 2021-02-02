sql = require('mysql');

var con = sql.createConnection({
  host: "localhost",
  user: "web",
  password: "password"
});

con.connect(function(err) {
  if (err) throw err;


  console.log("Connected!");
});
