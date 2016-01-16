FX  = function () {
    this.wireMouseoverSound = function($el, pathToFile) {
        $el.mouseover(playSound(pathToFile));
    },
    
    this.wireClickSound = function ($el, pathToFile) {
        $el.click(playSound(pathToFile))
    },
    
}