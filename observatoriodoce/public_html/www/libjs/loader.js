//—Copyright (c) 2007 wollzelle GmbH, (http://www.wollzelle.com). All Rights Reserved.

var Loader = {
  _assets: $H({}),
  _checkInterval: null,
  _options: {},
  _update: function() {
    var allLoaded = true;
    Loader._assets.each(function(a){
      try{
      if(!a[1].complete && a[1].image.complete) {
        a[1].complete = true;
        a[1].completed_at = new Date().getTime();;
        a[1].options.each(function(o){
          if(o.onComplete) o.onComplete(a[0]);
        });
      }
      if(!a[1].complete && !a[1].image.complete) allLoaded = false;
      }catch(e){ alert(Object.inspect(e)) }
    });
    if(allLoaded) {
      clearInterval(Loader._checkInterval);
      Loader._checkInterval = null;
      if(Loader._options && Loader._options.onComplete) Loader._options.onComplete();
      Loader._options = null;
    }
  },
  initialize: function() {
    var options = arguments[0] || {};
    Loader._options = options;
  },
  cacheOrLoad: function(url) {
    var options = arguments[1] || {};
    if(this.isLoaded(url)) {
      if(options.onComplete) options.onComplete();
    } else {
      this.load(url, options);
    }
  },
  load: function(url) {
    var options = arguments[1] || {};
    
    if(!Loader._assets[url]){
      var a = {};
      a.image = new Image();
      a.image.src = url;
      a.complete = false;
      a.options  = [];
      a.options.push(options);
      a.loaded_at = new Date().getTime();
      Loader._assets[url] = a;
      if(!Loader._checkInterval) Loader._checkInterval = setInterval(Loader._update,10);
    } else {
      Loader._assets[url].options.push(options);
      if(options.onComplete) options.onComplete();
    }
  },
  stats: function(url) {
    return (Loader._assets[url]._complete ?
      (Loader._assets[url]._completed_at - Loader._assets[url]._loaded_at) : null);
  },
  isQueued: function(url) {
    return !!(Loader._assets[url]);
  },
  isLoaded: function(url) {
    return (Loader._assets[url] && Loader._assets[url].complete);
  },
  reset: function() {
    Loader._assets = $H({});
  }
};