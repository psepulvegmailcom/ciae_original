var Gallery = {
  initialize: function() {
    this.gallery      = $('gallery');
    this.image        = $('gallery_image');
    this.closeButton  = $('gallery_close');
    this.isOpen       = false;
    
    var actuators = $$('.enlargeable').concat($$('.magnifier'));
    actuators.each(function(image) {
      Event.observe(image, 'click', function(event) {
        var e = Event.element(event).hasClassName('magnifier') ? Event.element(event).previous('img') : Event.element(event);
        this.open(e.src.gsub('.gif','')+'-big.png');
      }.bind(this));
    }.bind(this));

    this.closeButton.observe('click', this.close.bindAsEventListener(this));
    this.eventDocumentClick = this.closeOnDocumentClick.bindAsEventListener(this);

  },

  open: function(imageSource) {
    if (!this.isOpen) {
      Loader.load(imageSource, {
        onComplete: function() {
          if (Prototype.Browser.IE) {
            this.image.src = '/images/blank.gif';
            this.image.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+imageSource+"', sizingMethod='scale');";
          }
          else {
            this.image.src = imageSource;
          }
          Position.prepare(); // current middle of viewport
          var top = Position.getPageSize().window.height/2 + Position.deltaY;

          this.gallery.setStyle({ 
            top: top + 'px'
          });
          
          this.gallery.show();
          
          this.gallery.morph('margin:-283px 0 0 -408px; width:816px; height:566px;', {
            duration:0.8,
            transition: this.wobble.bind(this),
            afterFinish: function() { 
              this.closeButton.show();
              Event.observe(document, 'click', this.eventDocumentClick);
            }.bind(this)
          });
          
          this.isOpen = true;  
        }.bind(this)
      });
    }
  },
  
  close: function() {
    if (this.isOpen) {
      this.closeButton.hide();
      
      this.gallery.morph('width:1px; height:1px; margin:0px;', {
        duration:0.4,
        afterFinish: function() { this.gallery.hide(); }.bind(this)
      });
        
      Event.stopObserving(document, 'click', this.eventDocumentClick);
      this.isOpen = false;
    }
  },
  
  closeOnDocumentClick: function(event) {
    var e = Event.element(event);
    if (e == this.gallery || e.descendantOf(this.gallery))
      return;
    else
      this.close();
  },
  
  wobble: function(pos) {
    if (pos < (1/2.75)) {
      return (7.5625*pos*pos);
    } else if (pos < (2/2.75)) {
      return (7.5625*(pos-=(1.5/2.75))*pos + .75);
    } else if (pos < (2.5/2.75)) {
      return (7.5625*(pos-=(2.25/2.75))*pos + .9375);
    } else {
      return (7.5625*(pos-=(2.625/2.75))*pos + .984375);
    }
  }
  
}

var RocketColumns = {
	initialize: function() {
	  $$('.rocket_col').each(function(col) {
	    var colWidth = (Prototype.Browser.IE) ? '260px' : '240px';
	    col.makeClipping().setStyle({width:colWidth, height:'900px'});	      
	  });
	  (3).times(function(i){
      i++;
      $('organize_'+i,'deliver_'+i).invoke('setStyle', { visibility:'visible' });
      $('organize_'+i+'_content','deliver_'+i+'_content').invoke('setStyle', {top:'2000px', position:'relative'});
      $('overview_'+i).setStyle({ zIndex:1000 });
    });
    $('page_header_organize','page_header_deliver').invoke('setStyle', {marginLeft:'-450px', display:'block', opacity:0});
    this.currentSection = 'overview';
	},
  showSection: function(event, section) {
    if(section == this.currentSection) return;
    $$('ul#choose_os li a').invoke('removeClassName','active');
    $('tablink_'+section).addClassName('active');
    this.hideCurrentSection();
    if(section == 'overview') {
      $('container').morph('height:1800px', { duration:0.7 });
    } else {
      $('container').morph('height:1450px', { duration:0.7 });
    }
    this.flyIn(section+'_1_content', 0.5);
    this.flyIn(section+'_2_content', 0.2);
    this.flyIn(section+'_3_content', 0.6);
    if(section == 'overview') $('mini_features', 'footnotes_overview').invoke('appear', {delay:1.0});
    if(section == 'deliver') $('get_started_box', 'footnotes_deliver').invoke('appear', {delay:1.0});
    this.changeHeader(section);
    this.changeKicker(section);
    this.currentSection = section;
  },
  flyOut: function(element) {
    element = $(element);
    var delay = arguments[1] || 0;
    element.setStyle({
      position:'relative'
    }).morph('top:-1000px', {
      duration:1.2, 
      delay:delay
    });
    $$('.rocket_col').invoke('setStyle', { zIndex:1 });
  },
  flyIn: function(element) {
    element = $(element)
    element.setStyle({
      top:'900px'
    });
    var delay = arguments[1] || 0;
    element.morph('top:0px', {
      duration:1.2, 
      delay:delay
    });
    element.up().setStyle({ zIndex:1000 });
  },
  hideCurrentSection: function() {
    if(this.currentSection == 'overview') $('mini_features', 'footnotes_overview').invoke('fade');
    if(this.currentSection == 'deliver') $('get_started_box', 'footnotes_deliver').invoke('fade');
    this.flyOut(this.currentSection+'_1_content', 0.2);
    this.flyOut(this.currentSection+'_2_content');
    this.flyOut(this.currentSection+'_3_content', 0.3);
  },
  changeHeader: function(section) {
    //$('page_header_'+section).appear({ delay: 2.0, duration: 1.0 });
    //$('page_header_'+this.currentSection).hide({ delay: 2.0, duration: 0.7 });
    new Effect.Opacity('page_header_'+section, {from:0.001, to:0.999, delay:2.0, duration:1.0});
    new Effect.Opacity('page_header_'+this.currentSection, {from:0.999, to:0.001, delay:2.0, duration:0.7});
  },
  changeKicker: function(section) {
    $$('div#kicker_left a').invoke('removeClassName', 'active');
    $('kickerlink_'+section).addClassName('active');
  }
}

Position.getPageSize = function() {
  var xScroll, yScroll;

  if (window.scrollMaxX) {  
    xScroll = window.innerWidth  + window.scrollMaxX;
    yScroll = window.innerHeight + window.scrollMaxY;
  } else {
    xScroll = document.body.scrollWidth;
    yScroll = document.body.scrollHeight;
  } 
  
  var windowWidth, windowHeight;
  if (self.innerHeight) { // all except Explorer
    windowWidth = self.innerWidth;
    windowHeight = self.innerHeight;
  } else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
    windowWidth = document.documentElement.clientWidth;
    windowHeight = document.documentElement.clientHeight;
  } else if (document.body) { // other Explorers
    windowWidth = document.body.clientWidth;
    windowHeight = document.body.clientHeight;
  }
  // for small pages with total height less then height of the viewport
  pageHeight = Math.max(windowHeight, yScroll);

  // for small pages with total width less then width of the viewport
  pageWidth = Math.max(windowWidth, xScroll);

  return { page: { width: pageWidth, height: pageHeight }, window: { width: windowWidth, height: windowHeight } };
}


Event.observe(window, 'load', function() {
	RocketColumns.initialize();
	Gallery.initialize();
});

