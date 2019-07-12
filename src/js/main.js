$(document).ready(function () {
    function initMap() {
        var opt = {
            center: {lat: 34.101511, lng: -118.343705},
            zoom: 16
        };
        var map = new google.maps.Map(document.getElementById("map"), opt);
        var marker = new google.maps.Marker({
            position: opt.center,
            map: map
        });
        var infowindow = new google.maps.InfoWindow({
            content: "7060 Hollywood Blvd, Los Angeles, CA"
        });
        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }
        initMap();
    $('#datepicker').datepicker({
        endDate: "0d",
        autoclose: true,
    });
    var country = 'CA';
    $('#phone-number').mask(phoneMask[country]);
    $.mask.definitions['*'] = "[0-9]";
    $('body').on('change', '#country', function () {
        //console.log($('#country option:selected').val());
        var country = $('#country option:selected').val();
        $('#phone-number').mask(phoneMask[country]);
    });
});
