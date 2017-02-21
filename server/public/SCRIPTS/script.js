function refresh()
{
    $.get('index.php?ajax&page=listMessage', function(html)
    {
        $('.js_list').html(html);
        // $('#js_list').scrollTop($('#js_list')[0].scrollHeight);
          // var wtf    = $('.js_list');
          // var height = wtf[0].scrollHeight;
          // wtf.scrollTop(height);
    });
    $.get('index.php?ajax&page=footer', function(html)
    {
        $('.js_footer').html(html);
    });
}

function scrollToBottom() {
    $('.js_list').scrollTop($('.js_list')[0].scrollHeight);
}

$('document').ready(function(){ 
 
    $('.js_list').change(function() {
        // scrollToBottom();
        $('.js_list').scrollTop($('.js_list')[0].scrollHeight);
    });

    $('.js_form').submit(function(info)
    {
        info.defaultPrevented();
        var message = $('.js_in').val();
        $.post('messages', {content:message,action:"create_message"}, function()
        {
            $('.js_in').val('').focus();
            refresh();
            scrollToBottom();
        });
        return false;
    });

    $('.js_more').click(function()
    {
        $.post('messages', {action:"more_message"}, function()
        {
            refresh();
        });
        return false;
    });
    
    setInterval(function()
    {
        // refresh();
    },5000);

 
});

// $(window).scroll(function(){
//     if ($(this).scrollTop() > 100) {
//         $('.scrollup').fadeIn();
//     } else {
//         $('.scrollup').fadeOut();
//     }
// }); 

// $('.scrollup').click(function(){
//     $("html, body").animate({ scrollTop: 0 }, 600);
//     return false;
// });