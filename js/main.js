/**
 * Created by Bionic on 09.07.2017.
 */

// carousel hover dropdown
jQuery(function($) {
    $('.dropdown').on('mouseenter mouseleave', function () {
        $(this).toggleClass("show");
    });
});

// jQuery posts loader
jQuery(function($){
    var btn = $('.btn-next');
    btn.click(function(){
        $(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
        var data = {
            'action': 'loadmore',
            'query': true_posts,
            'page' : current_page
        };
        $.ajax({
            url:ajaxurl, // обработчик
            data:data, // данные
            type:'POST', // тип запроса
            success:function(data){
                if( data ) {
                    btn.text('Далее').before(data); // вставляем новые посты
                    current_page++; // увеличиваем номер страницы на единицу
                    if (current_page == max_pages) btn.remove(); // если последняя страница, удаляем кнопку
                } else {
                    btn.remove(); // если мы дошли до последней страницы постов, скроем кнопку
                }
            }
        });
    });
});