var jquery_extend_script = $('script[src*=jquery_extend]'); // or better regexp to get the file name..

var site_root = jquery_extend_script.attr('site_root');   
if (typeof site_root === "undefined" ) {
   var site_root = 'horrieinternational/';
}

// from http://stackoverflow.com/questions/210717/using-jquery-to-center-a-div-on-the-screen
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}

jQuery.fn.mouseOverSound = function(pathToFile) {
        this.mouseover(function() {
            playSound(pathToFile);
        });
}

jQuery.fn.clickSound = function (pathToFile) {
        this.click(function() {
            playSound(pathToFile);
        });
}

jQuery.fn.fadeSlide = function ($el, direction) {
        var $self = this;
       
        var currentPosition = parseInt($self.css("left"))
        var slideDistance = direction === "left" ? -$el.outerWidth() : $el.outerWidth();
        
        if(direction === "right") {
            $self.css("display", "block");
            $self.animate({ opacity: 0 }, 0);
        }
        
        $self.animate({ 'left' :  currentPosition + slideDistance + "px", opacity: direction === "right" ? 1 : 0 }, 1000, function() {});
        playSound(site_root + "sound/stonedrag1.mp3");
}
jQuery.fn.attachSearchBox = function ($el) {
        var $self = this;
        $el.css("left", parseInt($self.position().left));
}

jQuery.fn.resizeTo = function ($el) {
    var $self = this;
    var overhang = 140;
    $self.css("width", parseInt($el.css("width")) + overhang + "px");
}