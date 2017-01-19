var print = require("./print");
print("Hello webpack!!");

var Vue = require('../node_modules/vue/dist/vue.js');
var demo = new Vue({
  delimiters: ['${', '}'],
  el: '#demo',
  data: {
    message: 'Hello Vue.js!'
  }
});

console.log(demo);
