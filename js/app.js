( function() {
    var wall = new freewall("#freewall");
    wall.reset({
        selector: '.brick',
        animate: false,
        cellW: 350,
        cellH: 'auto',
        onResize: function() {
            wall.fitWidth();
        }
    });
    var images = wall.container.find('.brick');
    images.find('img').load(function() {
        wall.fitWidth();
    });
    wall.fitWidth();
})();
