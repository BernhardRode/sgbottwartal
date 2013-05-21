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

  $('#calendar').fullCalendar
    ignoreTimezone:
      true
    header:
      left: 'prev,next today'
      center: 'title'
      right: 'month,agendaWeek,agendaDay'
    editable: false
    cache: false
    events:
      url: '/api/sgb/get_events'
    eventClick: (calEvent, jsEvent, view) =>
      time = moment( calEvent.start ).format('LLLL')
      #time = time.fromNow()
      title = calEvent.title
      $('#event-title').html title
      content  = ''
      content += '<p><i class="icon-time"></i> '+time+'</p>'
      if calEvent.url
        content += '<p><a href="'+calEvent.url+'" target="_blank">'
        content += '<i class="icon-link"></i> '+calEvent.url
        content += '</a></p>'
      content += '<p>'+calEvent.excerpt+'</p>'
      if calEvent.city and calEvent.street
        content += '<a href="https://maps.google.de/maps?q='+calEvent.city+', '+calEvent.street+'&z=16" target="_blank">'
        content += '<i class="icon-map-marker"></i> '+calEvent.city+', '+calEvent.street
        content += '</a>'

      $('#event-content').html content
      $('#event-modal').modal 'toggle'

    loading: (bool) =>
      if bool then $('#loading').show() else $('#loading').hide()

  #CFInstall.check
  #  mode: "overlay"
  #  destination: "http://sg-bottwartal.de"

  # $('.gallery-item').click (evt) ->
  #   evt.preventDefault()
  #   evt.stopPropagation()
  #   src = $(@).find('a').attr 'href'
  #   title = $(@).find('a').attr 'title'
  #   $('#image-viewer img').attr 'src',src
  #   $('#image-viewer img').attr 'title', title

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

  # jmpressOpts =
  #   animation :
  #     transitionDuration : '0.8s'

  # $( '#jms-slideshow' ).jmslideshow( $.extend( true, { jmpressOpts : jmpressOpts }, { autoplay  : true, bgColorSpeed: '0.8s', arrows : false } ) )
  # $( '#jms-slideshow' ).jmslideshow();

  $('body').hide()
  $('body').removeClass 'hidden'
  $('body').fadeIn()