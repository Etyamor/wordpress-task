jQuery(document).ready(function ($) {

    function getStarsRating(){
        $('.rating').each(function () {
            $(this).rateYo({
                maxValue: 10,
                readOnly: true,
                starWidth: "20px",
                rating: $(this).data('rating')
            })
        })
    }
    getStarsRating();

    $(document).on('click', '#load_more', function (e) {
        e.preventDefault;
        var button = $(this),
            data = {
                'action': 'loadmore',
                'query': loadmore_params.posts,
                'page' : loadmore_params.current_page
            };
        $.ajax({
            url : loadmore_params.ajaxurl,
            data : data,
            type : 'POST',
            beforeSend : function ( xhr ) {
                button.text('Loading...');
            },
            success : function( data ){
                if( data ) {
                    button.text('More Items');
                    $("#items .row").append(data);
                    getStarsRating()
                    loadmore_params.current_page++;
                    if ( loadmore_params.current_page == loadmore_params.max_page )
                        button.remove();
                } else {
                    button.remove();
                }
            }
        });
    });

    var addParam = function(url, param, value) {
        param = encodeURIComponent(param);
        var a = document.createElement('a');
        param += (value ? "=" + encodeURIComponent(value) : "");
        a.href = url;
        a.search += (a.search ? "&" : "") + param;
        return a.href;
    }

    var addOrReplaceParam = function(url, param, value) {
        param = encodeURIComponent(param);
        var r = "([&?]|&amp;)" + param + "\\b(?:=(?:[^&#]*))*";
        var a = document.createElement('a');
        var regex = new RegExp(r);
        var str = param + (value ? "=" + encodeURIComponent(value) : "");
        a.href = url;
        var q = a.search.replace(regex, "$1"+str);
        if (q === a.search) {
            a.search += (a.search ? "&" : "") + str;
        } else {
            a.search = q;
        }
        return a.href;
    }

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        location.search
            .substr(1)
            .split("&")
            .forEach(function (item) {
                tmp = item.split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            });
        return result;
    }

    $(document).on('change', 'select[name="orderby"]', function () {
        window.history.pushState('','', addOrReplaceParam(window.location.href, 'orderby', $(this).val()));
        var data = {
            'action': 'orderby',
        };
        var urlParams = new URLSearchParams(window.location.search);
        for(var pair of urlParams.entries()) {
            data[pair[0]] = pair[1];
        }
        $.ajax({
            url : loadmore_params.ajaxurl,
            data : data,
            type : 'GET',
            beforeSend : function () {
                $("#items").remove();
            },
            success : function( data ) {
                if (data) {
                    $("#posts").append(data);
                    getStarsRating()
                }
            }
        });
    });

    $('select[name="orderby"]').each(function () {
        $(this).val(findGetParameter('orderby'));
    })

    $(document).on('change', '#filters input', function () {
        var get = $('#filter-form').serialize();
        var start = '?';
        if(findGetParameter('orderby')) {
            start = '?orderby=' + findGetParameter('orderby') + '&';
        }
        var newUrl =  start + get;
        window.history.pushState('','', newUrl);
        var data = {
            'action': 'orderby',
        };
        var urlParams = new URLSearchParams(window.location.search);
        for(var pair of urlParams.entries()) {
            data[pair[0]] = pair[1];
        }
        $.ajax({
            url : loadmore_params.ajaxurl,
            data : data,
            type : 'GET',
            beforeSend : function () {
                $("#items").remove();
            },
            success : function( data ) {
                if (data) {
                    $("#posts").append(data);
                    getStarsRating()
                }
            }
        });
    })

})