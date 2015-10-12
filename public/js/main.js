$(document).ready(function() {


    //**********Reject Itnry Function********//
    rejectItnryFunction();
    sendMail();

    //******Pagination Functions************//
    nextArrowAction();
    prevArrowAction();

    //****FAQ functions initialization*******//
    faqCountrySearch();
    faqSearch();
    faqAction();
    faqSearchAction();

    //****Attraction functions initialization*******//
    getAttractioName();
    getAttractionAjaxPagination();
    attractionSortChange();
    attractionAutoCompleteSearch();


    //****Tour functions initialization*******//
    getTourName();
    getTourAjaxPagination();
    tourSortChange();
    tourAutoCompleteSearch();

    //****City functions initialization*******//
    cityLatLang();
    getStageCityList();
    refreshCity();
    getCityAjaxPagination();
    removeCityImage();

    //********Testimonials initialization**********//
    getTestimonialsAjaxPagination();

    //***********User functions initialization*******//
    getUserAjaxPagination();

    //********* Itinerary functions*****************//
    getItineraryAjaxPagination();
    getTourAttractionList();
    activityChange();
    getSearchPagination();
    searchItinerary();
    setCityValue();
    getOverview();

    $('.stageDetailFields').each(function() {
        var countryVal = $(this).find('#country').val();
        var city = $(this).find('.cityOverview');
        var citySelected = $(this).find('.cityOverview option:selected').val();
        getCityList(countryVal, city, citySelected);

    });
    // Change event itinerary sort
    $('#itinerarySortSelect').change(function() {
        var pageNo = 1;
        itinerarySort(this.value, pageNo);
        rejectItnryFunction();

    });
    //Add more Functionality
    var num = 1;
    var count;
    count = $(".childCount > div").length;
    $('#addStageDetails').click(function() {
        count = parseFloat(count) + 1;
        $('#addStageDetails').each(function() {
            $("#stageDetailFields0").clone().insertBefore($("#addStageDetails")).addClass("newField" + num).append('<a href="#" class="remove' + count + '">Remove</a>');
            ;
            $(".newField" + num + " " + "input").val("");
            $(".newField" + num + " " + "textarea").val("");
            $(".newField" + num).children("div").find('.country').val('');
            $(".newField" + num).children("div").find('.city').val('');
            $(".stageVal").append('<option value="' + (count) + '">' + count + '</option>');
            num++;

            $('.remove' + count).click(function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                $('.stageVal option[value="' + (count) + '"]').remove();
                count = parseFloat(count) - 1;
            });


        });
        getStageCityList();
        setCityValue();
    });


    $('#addStageAttractions').click(function() {

        $('#addStageAttractions').each(function() {
            var length = $('.stageAttractionFields ').length;
            $("#stageAttractionFields0").clone().insertBefore($("#addStageAttractions")).addClass("newAttrField" + num).attr('id', 'stageAttractionFields' + length).append('<a href="#" class="lPd20 removeDetails">Remove</a>');
            ;
            $(".newAttrField" + num + " " + "input").val("");
            $(".newAttrField" + num + " " + "textarea").val("");
            $(".newAttrField" + num).children('div').find('.activityType').find('option:selected').attr('selected', false);
            $(".newAttrField" + num).children('div').find('.bs-example').find('.attrName').attr('id', 'attrNamId' + length);
            $(".newAttrField" + num).children('div').find('.visitTime').val("09:00");
            $(".newAttrField" + num).children('div').find('.durationTime').val("1");
            num++;
            getTourAttractionList();
            activityChange();
        });
        $('.removeDetails').click(function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
        });


    });

    // changeAttractionType();


});

function activityChange() {
    $('.activityType').change(function() {
        if ($(this).val() == "Activity" || $(this).val() == "Information") {
            $(this).parent('div').next('div').find('.attrName').prop('readonly', true);
        } else {
            $(this).parent('div').next('div').find('.attrName').prop('readonly', false);
        }
        if ($('.activityVal ').val() == null) {
            alert('Please select Day# activity first.');
        }
        getTourAttractionList();
    });
}
function getStageCityList() {
    $('.country').change(function() {
        var countryVal = $(this).val();
        var city = $(this).parent().next().find('.cityOverview');
        getCityList(countryVal, city);
        getOverview();
    });
}
// Ajax function to sort itinerary list
// Function call in admin view itinerary module
function itinerarySort(sortValue, pageNo) {
    $.post("/itinerary-sort-ajax", {itnrySortValue: sortValue, pageNo: pageNo}, function(data) {
        $('#itineraryContent').empty();
        $('#itineraryContent').append(data);
        getItineraryAjaxPagination();
        refreshPagination(pageNo);
        rejectItnryFunction();

    });
}
//get tours and attraction on autocomplete
function getTourAttractionList() {

    $('.stageAttractionFields').each(function() {

        var activityType = $(this).find('.activityType option:selected').val();
        var activityVal = $(this).find('.activityVal option:selected').val();
        var countryId = $('.dayNo[value="' + activityVal + '"]').parent().next().find("select").val();
        var cityId = $('.dayNo[value="' + activityVal + '"]').parent().next().next().find("select").val();
        if (activityVal == 0) {
            alert('Please select Day# Activity First');
            return false;
        }
        var id = $(this).find('.attrName').attr('id');
        $('input#' + id).off();
        $('input#' + id).data('typeahead', (data = null));
        if (activityType == 'Information' || activityType == 'Activity') {
            //$(this).find('.attrName').val("");
            $(this).find('.attrName').prop('readonly', true);
        }
        else {
            $(this).find('.attrName').prop('readonly', false);
            $.ajax({
                type: "POST",
                url: '/getattrtourlist',
                data: ({activityType: activityType, activityVal: activityVal, countryId: countryId, cityId: cityId}),
                success: function(data) {
                    $('input#' + id).typeahead({
                        local: data.data
                    });
                },
                error: function() {
                    alert('Error occured');
                }
            });
        }

    });
}
//get citylist for country change
function getCityList(countryVal, city, selectedVal) {

    $.post("/get-city-ajax", {countryValue: countryVal}, function(data) {
        $(city).html('');
        if (data.data.length > 0) {
            $(city).append('<option value=' + 0 + '>' + 'Select City' + '</option>');
            for (var cityList = 0; cityList < data.data.length; cityList++) {
                var selected = '';
                if (data.data[cityList].tpodCityId == selectedVal) {
                    var selected = 'selected';
                }
                $(city).append('<option value="' + data.data[cityList].tpodCityId + '"' + selected + '>' + data.data[cityList].tpodCityName + '</option>');
            }
        } else {
            $(city).append('<option value=' + 0 + '>' + 'Select City' + '</option>');
        }
    });
}
//fetch next 9 result onclick of pagination link
function getItineraryAjaxPagination() {
    var itineraryNextPage = $('#itineraryContent').children('div').children('ul').children('li').find('.nextPage');
    $(itineraryNextPage).click(function() {
        $('.pagination li.active').removeClass('active');
        $(this).parent('li').addClass('active');
        var pageNo = $(this).text();
        var sortValue = $('#itinerarySortSelect').val();
        itinerarySort(sortValue, pageNo)
    })
}
// Function for search itinerary by Destination
function itinerarySearchDestination(destinationName, pageNo) {

    $.get("/itinerarySearch/" + destinationName + "/" + pageNo, function(data) {
        $('#itineraryContent').empty();
        $('#itineraryContent').append(data);
        getSearchPagination()
    });
}
function getSearchPagination() {
    $('.nextPage').click(function() {
        var pageNo = $(this).text();
        var destination = $('#itnrSearchDestination').val();
        itinerarySearchDestination(destination, pageNo);
        $(this).parent('li').addClass('active');
    })
}
//Function for itinerary search admin
function searchItinerary() {
    $('#itnrSearchBtn').click(function() {
        var destinationArray = $('#itnrSearchDestination').val().split(',');
        if ($('#itnrSearchDestination').val() == '') {
            alert('Please enter Destination');
            return false;
        } else if (destinationArray.length > 1) {
            alert('You can enter only 1 destinations');
            $('#itnrSearchDestination').val('');
            return false;
        }
        else {
            var pageNo = 1;
            itinerarySearchDestination($('#itnrSearchDestination').val(), pageNo);
        }
    });
}
// Function for search itinerary by Destination
function itinerarySearchDestination(destinationName, pageNo) {
    $.post("/itinerarySearch", {destinationName: destinationName, pageNo: pageNo}, function(data) {
        $('#itineraryContent').empty();
        $('#itineraryContent').append(data);
        getSearchPagination()
    });

}
//function to get featured itineraries
function isFeaturedItinerary(itnryId) {
    if ($("#featured" + itnryId).is(':checked')) {
        var checked = 1;
        $.get("/set-featured-ajax/" + itnryId + "/" + checked, function(data) {
            if (data.row > 9) {
                 $('.itnry-msg-success').addClass('hidden');
                 $('.itnry-msg').addClass('hidden');
                alert('You can select upto 10 featured itineraries');
                $("#featured" + itnryId).prop('checked', false);
                return false;
            }else{
                $('.itnry-msg').addClass('hidden');
                $('.itnry-msg-success').removeClass('hidden');
                $('.itnry-msg-success').children('ul').children('li').html(data.message);
            }
        });
    } else {
        var checked = 0;
        $.get("/set-featured-ajax/" + itnryId + "/" + checked, function(data) {

            if (data.row < 6) {
                $('.itnry-msg-success').addClass('hidden');
                 $('.itnry-msg').addClass('hidden');
                alert('You have to select atleast 5 featured itineraries');
                $("#featured" + itnryId).prop('checked', true);
                return false;
            }else{
                $('.itnry-msg-success').addClass('hidden');
                $('.itnry-msg').removeClass('hidden');
                $('.itnry-msg').children('ul').children('li').html(data.message);
            }
        });
    }
}
function setCityValue() {
    $('.dayNo').change(function() {
        var value = $(this).val();
        $(this).attr('value', value);
        getTourAttractionList();
    })
}
function getOverview() {
    $('.cityOverview').change(function() {
        var cityId = $(this).val();
        var content = $(this).parent().siblings('.cityOverviewContent');
        if (cityId != 0) {
            $.post("/get-city-overview", {cityId: cityId}, function(data) {
                $(content).html('<textarea maxlength="5000" name="stage-details[]" class="form-control user-success" value="">' + data.data + '</textarea>');
            });
        } else {
            $(content).html('<textarea maxlength="5000" name="stage-details[]" class="form-control user-success" value="">' + '' + '</textarea>');
        }
    });
}

//***********************************Attraction Module **********************************//
// Ajax function to sort attraction list
function atttractionSort(sortValue, pageNo) {
    $.post("/attraction-sort-ajax", {attrSortValue: sortValue, attrName: null, pageNo: pageNo}, function(data) {
        $('#displayContentAttraction').empty();
        $('#displayContentAttraction').append(data);
        getAttractionAjaxPagination();
        refreshPagination(pageNo);

    });
}

// Ajax function for search attraction by name
function attractionSearchName(attrName) {
    if (attrName == '') {
        alert("Please enter attraction name");
        return false;
    } else {
        $.post("/attraction-sort-ajax", {attrSortValue: null, attrName: attrName}, function(data) {
            $('#displayContentAttraction').empty();
            $('#displayContentAttraction').append(data);
        });

    }
}

// Function to get attraction list for autocomplete
function getAttractioName() {
    var attraction = [];
    $('.attractionListHide').each(function() {
        var attrName = $(this).find('.attrName').text();
        attraction.push(attrName);
    });
    // Autocomplete attraction name text box
    $('input.typeahead').typeahead({
        local: attraction
    });
}



// Ajax function for delete attraction 
function deteteAttraction(attrId) {
    var currentPage = $('.currentPageNo').val();
    if (currentPage == '') {
        currentPage = 1;
    }
    var cityValue = $('#citySort').val();
    $.post("/attraction-delete-ajax", {attrId: attrId}, function(data) {

        if (data.data == "deleted successfully") {
            $(".removeAttraction" + attrId).remove();

        } else {
            $('.attraction').removeClass('hidden');
            $('.attraction').children('ul').children('li').html(data.data);
        }
        atttractionSort(cityValue, currentPage);
        refreshPagination(currentPage);

    });
}
//function to show alert before deleting an attraction
function deleteAttractionAlert(attrId) {

    var confirm_action = confirm('Are you sure?');
    if (confirm_action === false) {
        return false;
    } else {
        deteteAttraction(attrId);
    }
}
//function to trigger attarctionsort function onclick of next button of pagination
function getAttractionAjaxPagination() {
    var attractionNextPage = $('#displayContentAttraction').children('div').children('ul').children('li').find('.nextPage');
    $(attractionNextPage).click(function() {
        $('.attraction').addClass('hidden');
        $('.attraction').children('ul').children('li').html('');
        var pageNo = $(this).text();
        var cityValue = $('#citySort').val();
        atttractionSort(cityValue, pageNo);
    })
}
function attractionSortChange() {
    // Change city attraction sort
    $('#citySort').change(function() {
        var pageNo = 1;
        atttractionSort(this.value, pageNo);
    });
}
function attractionAutoCompleteSearch() {
    //Function for attraction search admin
    $('#attrSearchBtn').click(function() {
        attractionSearchName($('#attrAutoComplete').val());
    });
}
//****************************Tour Module *******************************//

//function to trigger tourSort function onclick of next button of pagination
function getTourAjaxPagination() {
    var tourNextPage = $('#displayContentTour').children('div').children('ul').children('li').find('.nextPage');
    $(tourNextPage).click(function() {
        $('.tour').addClass('hidden');
        $('.tour').children('ul').children('li').html('');
        var pageNo = $(this).text();
        var cityValue = $('#tourSort').val();
        tourSort(cityValue, pageNo);

    });
}
// Ajax function to sort tour list
function tourSort(sortValue, pageNo) {
    $.post("/tour-sort-ajax", {tourSortValue: sortValue, tourName: null, pageNo: pageNo}, function(data) {
        $('#displayContentTour').empty();
        $('#displayContentTour').append(data);
        getTourAjaxPagination();
        refreshPagination(pageNo);
    });
}
// Function to get tour list for autocomplete
function getTourName() {
    var tour = [];
    $('.tourListHide').each(function() {
        var tourName = $(this).find('.tourName').text();
        tour.push(tourName)
    });
    // Autocomplete tour name text box
    $('input#tourAutoComplete').typeahead({
        local: tour
    });
}
// Ajax function for delete tour 
function deteteTour(tourId) {
    var currentPage = $('.currentPageNo').val();
    if (currentPage == '') {
        currentPage = 1;
    }
    var cityValue = $('#tourSort').val();
    $.post("/tour-delete-ajax", {tourId: tourId}, function(data) {
        if (data.data == "deleted successfully") {
            $(".removeTour" + tourId).remove();
        } else {
            $('.tour').removeClass('hidden');
            $('.tour').children('ul').children('li').html(data.data);
        }

        tourSort(cityValue, currentPage);
        refreshPagination(currentPage);
    });
}

// Ajax function for search tour by name onclick of search button
function tourSearchName(tourName) {
    if (tourName == '') {
        alert("Please enter tour name");
        return false;
    } else {
        $.post("/tour-sort-ajax", {tourSortValue: null, tourName: tourName}, function(data) {
            $('#displayContentTour').empty();
            $('#displayContentTour').append(data);
        });
    }
}

//function to show alert before deleting a tour
function deleteTourAlert(tourId) {
    var confirm_action = confirm('Are you sure?');
    if (confirm_action === false) {
        return false;
    } else {
        deteteTour(tourId);
    }
}

//function to show result filtered by city
function tourSortChange() {
    $('#tourSort').change(function() {
        var pageNo = 1;
        tourSort(this.value, pageNo);
    });
}
function tourAutoCompleteSearch() {
    //Function for tour search admin
    $('#tourSearchBtn').click(function() {
        tourSearchName($('#tourAutoComplete').val());
    });
}

//**********************FAQ Module*************************//
// function to change city by country name
function  faqCountrySearch() {
    $('.countrySearch').change(function() {
        var countryVal = $(this).val();
        var city = $(this).parent().parent().next().find('#citySearch');
        getCityList(countryVal, city);

    });
}
// function to search faq by city and country name
function faqSearch() {
    $('.search').click(function() {
        var countryVal = $('.countrySearch').val();
        var cityVal = $('#citySearch').val();
        if (countryVal == "Select Country") {
            $('.countryError').children('ul').text('Please select Country');
            return false;
        }
        else if (cityVal == 0) {
            $('.cityError').children('ul').text('Please select City');
            return false;
        }

    })
}
function faqSearchAction() {
    $('.searchFaq').click(function() {
        var value = $(this).val();
        if (value == 'searchCountry') {
            $('.countrySearch').prop('disabled', false);
            $('#citySearch').prop('disabled', true);
            $('#citySearch').attr('id', '');
        } else {
            $(".countrySearch option").prop("selected", false);
            $('.citySearch').attr('id', 'citySearch');
            $('#citySearch').prop('disabled', false);
            $('.countrySearch').prop('disabled', false);

        }

    })
}
function faqAction() {
    $('.faq').click(function() {
        var value = $(this).val();
        if (value == 'country') {
            $('.countryDisabled').prop('disabled', false);
            $(".cityDisabled option").val("selected", false);
            $('.cityDisabled').prop('disabled', true);
            $('.cityDisabled').attr('id', '');

        } else {
            $(".countryDisabled option").prop("selected", false);
            $('.cityDisabled').attr('id', 'city');
            $('.cityDisabled').prop('disabled', false);
            $('.countryDisabled').prop('disabled', false);

        }
    })

}

//******************City Module**************************//
// Ajax call to fill latitude and longitude 
function cityLatLang() {
    $('#city').change(function() {
        $('#latitude').val('');
        $('#longitude').val('');
        var cityVal = $(this).val();
        $.post("/get-latlang-ajax", {cityValue: cityVal}, function(data) {
            $('#latitude').val(data.data.lattitude);
            $('#longitude').val(data.data.longitude);
        });
    });
}
//function to show alert before deleting city
function deleteCityAlert(cityId) {
    var confirm_action = confirm('Are you sure?');
    if (confirm_action === false) {
        return false;
    } else {
        deteteCity(cityId);
    }
}
//function to call citySorting function  on change of country dropdown
function refreshCity() {
    $('#refreshCity').change(function() {
        var pageNo = 1;
        citySorting(this.value, pageNo);
    });
}
//function to refresh cityList 
function  citySorting(countryId, pageNo) {
    $.post("/city-sort-ajax", {countryId: countryId, pageNo: pageNo}, function(data) {
        $('#displayContentCity').empty();
        $('#displayContentCity').append(data);
        getCityAjaxPagination();
        refreshPagination(pageNo);

    });

}
// Ajax function for delete tour 
function deteteCity(cityId) {
    var currentPage = $('.currentPageNo').val();
    if (currentPage == '') {
        currentPage = 1;
    }
    var countryValue = $('#refreshCity').val();
    $.post("/city-delete-ajax", {cityId: cityId}, function(data) {
        if (data.status == 0) {
            $('.city-msg').removeClass('hidden');
            $('.city-msg').children('ul').children('li').html('Please uncheck suggested city and then delete');
            return false;
            
        } else if (data.status == 1) {
            $('.city-msg').removeClass('hidden');
            $('.city-msg').children('ul').children('li').html("City is bind with some Attraction/Tour/FAQ");
            return false;
           
        } else {
            $('.city-msg').addClass('hidden');
            $(".removeCity" + cityId).remove();
            citySorting(countryValue, currentPage);
            refreshPagination(currentPage);
        }
    });
}

//function to trigger citySorting function onclick of next button of pagination
function getCityAjaxPagination() {
    var cityNextPage = $('#displayContentCity').children('div').children('ul').children('li').find('.nextPage');
    $(cityNextPage).click(function() {
        $('.pagination li.active').removeClass('active');
        $(this).parent('li').addClass('active');
        var pageNo = $(this).text();
        var countryValue = $('#refreshCity').val();
        citySorting(countryValue, pageNo);

    });
}
function removeCityImage() {
    $('.removeImage').click(function() {
        var imgId = $(this).attr('id');
        $.post("/delete-city-image", {imgId: imgId}, function(data) {
            $(".removeImage" + imgId).remove();
        });
    });
}

//***********User Module******************//
function getUserAjaxPagination() {
    var userNextPage = $('#userContent').children('div').children('ul').children('li').find('.nextPage');
    $(userNextPage).click(function() {
        $('.pagination li.active').removeClass('active');
        $(this).parent('li').addClass('active');
        var pageNo = $(this).text();
        userResultPagination(pageNo);


    });
}

function userResultPagination(pageNo) {
    $.post("/user-sort-ajax", {pageNo: pageNo}, function(data) {
        $('#userContent').empty();
        $('#userContent').append(data);
        getUserAjaxPagination();
        refreshPagination(pageNo)

    });
}
//**********************Pagination ******************************//
function nextArrowAction() {
    var pageCount = $('.pageCount').val();
    $('.arrow').click(function() {
        $('.prevArrow').parent('li').removeClass("disabled");
        var nextPageNo = $(this).parent('li').prev('li').text();
        if (nextPageNo.trim() == pageCount) {
            $(this).parent('li').addClass('disabled');
        } else {
            $('.pagination li').map(function() {
                var currentPageNo = $(this).find('.nextPage').text();
                $(this).find('.nextPage').text(parseInt(currentPageNo) + 5);
            });
        }
    });
}
function prevArrowAction() {
    $('.prevArrow').click(function() {
        var prevPageNo = $(this).parent('li').next('li').children('a').text();
        if (prevPageNo == 1) {
            $(this).parent('li').addClass('disabled');
        } else {
            $('.pagination li').map(function() {
                var currentPageNo = $(this).find('.nextPage').text();
                $(this).find('.nextPage').text(parseInt(currentPageNo) - 5);
            });
        }
    });
    function getUserAjaxPagination() {
        var userNextPage = $('#userContent').children('div').children('ul').children('li').find('.nextPage');
        $(userNextPage).click(function() {
            $('.pagination li.active').removeClass('active');
            $(this).parent('li').addClass('active');
            var pageNo = $(this).text();
            userResultPagination(pageNo);


        });
    }

}
function refreshPagination(pageNo) {
    if (pageNo > 10) {
        $('.pagination li').map(function() {
            var currentPageNo = $(this).find('.nextPage').text();
            $(this).find('.nextPage').text(parseInt(currentPageNo) + (pageNo - 10));
        });
    }
    if ($('.nextPage').text = pageNo) {
        $("a.nextPage:contains('" + pageNo + "')").parent('li').addClass('active');
    }

    nextArrowAction();
    prevArrowAction();
}
//*********************Testimonial Function******************//

function deteteTestimonials(testimonialsId) {
    var currentPage = $('.currentPageNo').val();
    if (currentPage == '') {
        currentPage = 1;
    }
    $.post("/testimonials-delete-ajax", {testimonialsId: testimonialsId}, function(data) {
        if (data.data == "deleted successfully") {
            $('.remove' + testimonialsId).remove();
        } else {
            $('.testimonial').removeClass('hidden');
            $('.testimonial').children('ul').children('li').html(data.data);
        }
        testimonialResultPagination(currentPage);
        refreshPagination(currentPage);
    });
}

function deteteTestimonialsAlert(testimonialsId) {

    var confirm_action = confirm('Are you sure?');
    if (confirm_action === false) {
        return false;
    } else {
        deteteTestimonials(testimonialsId);
    }

}
function getTestimonialsAjaxPagination() {
    var testimonialsNextPage = $('#testimonialContent').children('div').children('ul').children('li').find('.nextPage');
    $(testimonialsNextPage).click(function() {
        $('.pagination li.active').removeClass('active');
        $(this).parent('li').addClass('active');
        var pageNo = $(this).text();
        testimonialResultPagination(pageNo);


    });
}
function testimonialResultPagination(pageNo) {
    $.post("/testimonials-ajax", {pageNo: pageNo}, function(data) {
        $('#testimonialContent').empty();
        $('#testimonialContent').append(data);
        getTestimonialsAjaxPagination();
        refreshPagination(pageNo);

    });
}
//************Send MAil function ***********//
function sendMail() {
    $('.sendReview').click(function() {
        var itnryId = $(this).attr('id');
        var text = $(this).parent('div').parent('div').find('.reviews').val();
        if (text == '') {
            alert("Please enter comments");
            return false;
        } else {
            rejectItinerary(itnryId, text);
        }
    });
}
function rejectItinerary(itnryId, text) {
    $.post("/itinerary-reject-ajax", {itnryId: itnryId, text: text}, function(data) {
        $('.removeItnry' + itnryId).remove();

    });

}
function rejectItnryFunction() {
    $('.rejectBtn').click(function() {
        $('.reviews').val('');
        var id = $(this).attr('data-id');
        $('.sendReview').attr('id', id);
    })
}
function viewItnryReview(itnryId) {
    $('.closeReview').attr('id', itnryId);
    $.post("/itinerary-view-review", {itnryId: itnryId}, function(data) {
        $('#' + itnryId).text(data.data);
    });

}
