$(document).ready(function(){
    var spoilers = $("ul.spoiler");
    spoilers.each(function(){
        var list = this.find("ul").not(this.find("ul"))
    });
});
