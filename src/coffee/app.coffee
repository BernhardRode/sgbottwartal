$ = jQuery
$ ->
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

  geoDecode = (address) ->
    osmUrl = 'http://nominatim.openstreetmap.org/search?format=json&limit=1&addressdetails=0&q='
    $.getJSON osmUrl+address, (data) ->
      console.log 'data',data
      if data and data[0] then data = data[0]
      if data and data.lat and data.lon
        initialize data.lat, data.lon
      else
        $('#map').hide();

  svgeezy.init('nocheck', 'png');
  $('a[rel=tooltip]').tooltip()
  moment.lang 'de'

  if $('#carousel').length > 0 then $('#carousel').carousel()

  $('#calendar').fullCalendar
    ignoreTimezone:
      true
    header:
      left: 'prev,next today'
      center: 'title'
      right: 'month,agendaWeek,agendaDay'
    editable: false
    events:
      url: '/api/sgb/get_events'
    eventClick: (calEvent, jsEvent, view) =>
      time = moment( calEvent.start )
      time = time.fromNow()
      title = calEvent.title+' <small>'+time+'</small>'
      $('#event-title').html title
      content  = ''
      content += '<h1 class="muted">'+calEvent.originalEvent.Heim+' - '+calEvent.originalEvent.Gast+'</h1>'
      content += '<strong>'+calEvent.originalEvent.Hallenname+' ('+calEvent.originalEvent.Hallennummer+')</strong><br/>'
      content += '<strong>Adresse:</strong> '+calEvent.originalEvent.Strasse+', '+calEvent.originalEvent.Plz+ ', '+calEvent.originalEvent.Ort+'<br/>'
      content += '<strong>Bemerkung:</strong><br/>'+calEvent.originalEvent.Haftmittel
      console.log calEvent
      $('#event-content').html content
      $('#event-modal').modal 'toggle'

      address = calEvent.originalEvent.Strasse+', '+calEvent.originalEvent.Plz+', '+calEvent.originalEvent.Ort+', Deutschland'
      $('#map').fadeIn()
      $('#map').addClass 'loading'
      gm = geoDecode address

    loading: (bool) =>
      if bool then $('#loading').show() else $('#loading').hide()

  #CFInstall.check
  #  mode: "overlay"
  #  destination: "http://sg-bottwartal.de"

  $('.gallery-item').click (evt) ->
    evt.preventDefault()
    evt.stopPropagation()
    src = $(@).find('a').attr 'href'
    title = $(@).find('a').attr 'title'
    $('#image-viewer img').attr 'src',src
    $('#image-viewer img').attr 'title', title

  if $('#masonry').length > 0
    $('#tags a').click (evt) ->
      evt.preventDefault()
      evt.stopPropagation()
      tag = evt.currentTarget.innerText
      $('#masonry').hide()
      $('#masonry .box').shuffle()
      $('#masonry .box').each (index) ->
        $(this).hide()
        tags = $(this).data('tags').split ','
        i = $.inArray tag, tags
        if tag is 'Alle' then i = 0
        if i is -1
         $(this).hide()
        else
         $(this).show()

      $('#masonry').fadeIn()

  if $('#map-sponsor').length > 0
    $('#map').fadeIn()
    $('#map').addClass 'loading'
    address = $('#map').data 'address'
    gm = geoDecode address

  $('body').hide()
  $('body').removeClass 'hidden'
  $('body').fadeIn()