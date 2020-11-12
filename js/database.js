const Client = require("@replit/database");
const client = new Client();
await Client.set("key", "value");
let key = await Client.get("key");
console.log(key);