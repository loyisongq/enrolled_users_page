$(document).ready(function(){
    $('#enrolled-users-list').after('<div id="nav-list"></div>'); // adddiv id nav after closing enrolled-users-list
    var divShow = 9;
    var divsTotal = $('#enrolled-users-list  .holder').length;
    console.log(divsTotal);
    var numPages = divsTotal/divShow;
    console.log(numPages);
    for(i = 0;i < numPages;i++) {
        var pageNum = i + 1;
        $('#nav-list').append('<a href="#" rel="'+i+'">'+pageNum+'</a> ');
    }
    $('#enrolled-users-list  .holder').hide();
    $('#enrolled-users-list  .holder').slice(0, divShow).show();
    $('#nav-list a:first').addClass('active');
    $('#nav-list a').bind('click', function(){

        $('#nav-list a').removeClass('active');
        $(this).addClass('active');
        var currPage = $(this).attr('rel');
        var startItem = currPage * divShow;
        var endItem = startItem + divShow;
        $('#enrolled-users-list .holder').css('opacity','0.0').hide().slice(startItem, endItem).
        css('display','block').animate({opacity:1}, 300);
    });
});