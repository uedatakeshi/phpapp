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

var enq = new Vue({
  delimiters: ['${', '}'],
  el: '#enqForm',
  data: {
    name: ''
  },
  methods: {
      kakunin: function(event) {
          alert('hello' + this.name);
      }
  }
});

enq.kakunin();
//console.log(enq);
