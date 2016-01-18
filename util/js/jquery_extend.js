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

jQuery.fn.slideRight = function ($el) {
        var self = this;
        self.css("left", parseInt(self.css("left")) + parseInt(self.css("width"))  + 30 + "px");
}

jQuery.fn.attachSearchBox = function ($el) {
        var self = this;
        $el.css("left", self.position().left);
        $el.css("right", self.position().right);
}