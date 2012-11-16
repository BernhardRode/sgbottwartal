$ = jQuery
$ ->
  svgeezy.init('nocheck', 'png');
  $('a[rel=tooltip]').tooltip()

  if $('#map').length > 0 then $('#carousel').carousel()

  $('#calendar').fullCalendar
    header:
      left: 'prev,next today'
      center: 'title'
      right: 'month,agendaWeek,agendaDay'
    editable: false
    events: 
      url: '/api/sgb/get_events'
    loading: (bool) -> if bool then $('#loading').show() else $('#loading').hide()

  #CFInstall.check
  #  mode: "overlay"
  #  destination: "http://sg-bottwartal.de"


  if $('#map').length > 0
    $('#map').fadeIn()
    $('#map').addClass 'loading'
    initialize = (lat,lon) ->
      latlng = new google.maps.LatLng(lat,lon)
      options =
        zoom:17
        center:latlng
        mapTypeId:google.maps.MapTypeId.ROADMAP
      map = new google.maps.Map document.getElementById("map"), options

      logo = new google.maps.Marker
        position: latlng
        map: map
      $('#map').removeClass 'loading'
    geoDecode = ->
      osmUrl = 'http://nominatim.openstreetmap.org/search?format=json&limit=1&addressdetails=0&q='
      address = $('#map').data 'address'
      $.getJSON osmUrl+address, (data) ->
        data = data[0]
        if data.lat and data.lon
          initialize data.lat, data.lon
        else
          initialize '49.0468363', '9.3072926'
    gm = geoDecode()