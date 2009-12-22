var GRPN; if(!GRPN) GRPN = {};

GRPN.countdown = function (opts) {
    this.init(opts)
    return this;
};
GRPN.countdown.prototype = {
  init: function(opts) {
    this.targetTime = opts.targetDate;
    this.periods = ["days", "hours", "minutes", "seconds"];
    this.lengths = ["86400","3600","60","1"];
    this.timer = {};
    this.domContainer = 'groupon_widget';
    this.dom = {
      days: 'grpn_days_remaining',
      hours: 'grpn_hours_remaining',
      minutes: 'grpn_minutes_remaining',
      seconds: 'grpn_seconds_remaining'
    }
    var self = this;
    window.onunload = function() {
      self.destroy();
    }
    return self;
  },
  
  tick: function(){
    var now = new Date().getTime();
    var difference = (this.targetTime - now)/1000;
    var time_hash = {};
    for(var j = 0; j < this.lengths.length; j++) {
      if(difference >= this.lengths[j]){
        time_hash[this.periods[j]] = Math.floor(difference / this.lengths[j]);
        difference = (difference % this.lengths[j]);
      }
      else{
        time_hash[this.periods[j]] = 0;
      }
    }
    this.update(time_hash);
    return time_hash;
  },
  
  start: function() {
    var self = this;
    this.timer = setInterval(function(){ self.tick(); }, 1000);
    return self;
  },
  
  stop: function() {
    clearInterval(this.timer);
    return self;
  },
  
  update: function(time_hash) {
    var $ = this.$;
    $(this.dom.days).innerHTML = time_hash.days;
    $(this.dom.hours).innerHTML = time_hash.hours;
    $(this.dom.minutes).innerHTML = time_hash.minutes;
    $(this.dom.seconds).innerHTML = time_hash.seconds;
    return this;
  },
  
  destroy: function() {
    clearInterval(this.timer);
    this.targetTime = null;
  },
  
  $: function(id){
    return document.getElementById(id);
  }
}
