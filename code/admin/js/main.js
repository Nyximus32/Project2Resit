$(document).ready(function(){
    $('.menu-btn').click(function(){
        $('.sidebar').css({
            'width': '70px',
            'font-size': '20px',
            'margin-top': '-5px'
        });
        $('.text-link').hide();
       $('.close-btn').show();
       $('.menu-btn').hide();
    });
    $('.close-btn').click(function (){
        $('.sidebar').css({
            'width' : '300px',
            'font-size': '16px'
        });
        $('.text-link').show();
        $('.close-btn').hide();
        $('.menu-btn').show();
    });
});