//DATE PICKER STUFF
$(document).ready(function(){
    $( "#return-date, .return-date" ).datepicker({
        dateFormat: "dd-mm-yy"
    });
    $('.size-details li').on('click', function() {
        var $size = $(this);
        $('.size-details li.active').removeClass('active');
        $size.addClass('active');
        setDatePicker();
    });
    $('.cart-size-details li').on('click', function() {
        var $size = $(this);
        $('.cart-size-details li.active').removeClass('active');
        $size.addClass('active');
        setDatePicker();
    });
    $('#add-to-cart').on('click', function() {
        $('form#add-to-cart-form').submit();
    });
    $('.update-cart-button').on('click', function() {
        $this = $(this);
        $updateCart = $this.parents('tr');
        $('#product-index').val($updateCart.find('.cart-index').val());
        $('#product-size').val($updateCart.find('li.active > input').val());
        $('#product-del-date').val($updateCart.find('.delivery-date').val());
        $('#product-return-date').val($updateCart.find('.return-date').val());
        $('#product-id').val($updateCart.find('.cart-product-id').val());
        $('form#update-cart-form').submit();
    });
    setDatePicker();

    // var holidays = ['2016-01-01'];
    // reservedList.push.apply(reservedList, holidays);
    function setDatePicker() {
        $("#delivery-date").datepicker({
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

    function disableCartDates($container) {
        var reservedCarttList = [];
        var bookedDates = $container.find('.bookedDates').val();
        var reserved = JSON.parse(bookedDates);
        var size = $container.find('.cart-size-details li.active > input').val();
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
                    reservedCarttList.push(item);
                });
            }
        }
        return reservedCarttList;
    }
    function setCartDatePicker($container) {
        $container.find(".delivery-date").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: 0,
            maxDate: "+4m",
            onSelect: function(text, obj) {
                var returnDate = 4;
                var currentDate = $container.find('.delivery-date').datepicker("getDate") ;
                currentDate.setDate(currentDate.getDate('d/m/y') + returnDate - 1);
                $container.find('.return-date').datepicker('setDate', currentDate);
                // $('#product-size').val($('.size-details li.active > input').val());
                // $('#product-del-date').val($("#delivery-date").val());
                // $('#product-return-date').val($('#return-date').val());
                // $('#add-to-cart').removeAttr('disabled')
            },
            beforeShowDay: function(date) {
                //This is called for each day in the date picker.
                // i.e this loops through each date in the current calendar and parses in the 'date' of it here.
                // console.log("A DATE " + date);
                //if(date.getDay() == 6 || date.getDay() == 0) return true;
                var reservedList = disableCartDates($container);
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date); //Then format it
                return [ reservedList.indexOf(string) == -1 ]; //Check if the array specified hsa this day, if it does, disable it.
            }
        });
    }
    // Cart
    $('.editCart').on('click', function() {
        var $editLink = $(this);
        setCartDatePicker($editLink.parents('.main-details').next());
        $editLink.parents('.main-details').next().toggleClass('c--hide', 1000, "linear" );
    });
});
