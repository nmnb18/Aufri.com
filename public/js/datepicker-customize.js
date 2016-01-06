

//DATE PICKER STUFF
$(document).ready(function(){
    $( "#return-date" ).datepicker({
        dateFormat: "dd-mm-yy"
    });
    $('.size-details li').on('click', function() {
        var $size = $(this);
        $('.size-details li.active').removeClass('active');
        $size.addClass('active');
        setDatePicker();
    });
    $('#add-to-cart').on('click', function() {
        $('form#add-to-cart-form').submit();
    });
    setDatePicker();

    // var holidays = ['2016-01-01'];
    // reservedList.push.apply(reservedList, holidays);
    function setDatePicker() {
        $( "#delivery-date" ).datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            maxDate: "+4m",
            onSelect: function(text, obj) {
                var returnDate = 4;
                var currentDate = $("#delivery-date").datepicker("getDate") ;
                currentDate.setDate(currentDate.getDate('d/m/y') + returnDate - 1);
                $('#return-date').datepicker('setDate', currentDate);
                $('#product-size').val($('.size-details li.active > input').val());
                $('#product-del-date').val($("#delivery-date").val());
                $('#product-return-date').val($('#return-date').val());
                $('#add-to-cart').removeAttr('disabled')
            },
            beforeShowDay: function(date) {
                //This is called for each day in the date picker.
                // i.e this loops through each date in the current calendar and parses in the 'date' of it here.
                // console.log("A DATE " + date);
                //if(date.getDay() == 6 || date.getDay() == 0) return true;
                var reservedList = disableDates();
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date); //Then format it
                return [ reservedList.indexOf(string) == -1 ]; //Check if the array specified hsa this day, if it does, disable it.
            }
        });
    }

    function disableDates() {
        var reservedList = [];
        var reserved = JSON.parse($('#bookedDates').val());
        var size = $('.size-details li.active > input').val();
        if(size == "S") {
            reserved = reserved.S;
        } else if(size == "M") {
            reserved = reserved.M
        } else if(size == "L") {
            reserved = reserved.L;
        } else if(size == "XL") {
            reserved = reserved.XL;
        } else if(size == "XXL") {
            reserved = reserved.XXL;
        }
            //  alert(size);
        if(reserved != 0) {
            if(typeof reserved !== 'undefined') { //if array isn't empty
                //reservedList = reserved[size].split(',');
                reserved.forEach(function(item) {
                    reservedList.push(item);
                });
            }
        }
        return reservedList;
    }
});