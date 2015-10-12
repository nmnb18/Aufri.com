function isSuggestedCity(cityId) {
    if ($("#suggested" + cityId).is(':checked')) {
        var checked = 4;
        $.get("/set-suggested-ajax/" + cityId + "/" + checked, function(data) {
            if (data.row > 11) {
                 $('.city-msg-success').addClass('hidden');
                 $('.city-msg').addClass('hidden');
                alert('You can select upto 12 cities');
                $("#suggested" + cityId).attr('checked', false);

            } else {
                $('.city-msg').addClass('hidden');
                $('.city-msg-success').removeClass('hidden');
                $('.city-msg-success').children('ul').children('li').html(data.message);
            }
        });
    } else {
        var checked = 5;
        $.get("/set-suggested-ajax/" + cityId + "/" + checked, function(data) {
            if (data.row < 5) {
                 $('.city-msg-success').addClass('hidden');
                 $('.city-msg').addClass('hidden');
                alert('You have to select atleast 4 suggested cities');
                $("#suggested" + cityId).prop('checked', true);
            } else {
                $('.city-msg-success').addClass('hidden');
                $('.city-msg').removeClass('hidden');
                $('.city-msg').children('ul').children('li').html(data.message);
            }
        });
    }
}