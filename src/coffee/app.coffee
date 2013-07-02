$ = jQuery
$ ->

  # initialize = (lat,lon) ->
    # latlng = new google.maps.LatLng(lat,lon)
    # options =
    #   zoom:17
    #   center:latlng
    #   mapTypeId:google.maps.MapTypeId.ROADMAP
    # service = new google.maps.places.PlacesService(map)

    # logo = new google.maps.Marker
    #   position: latlng
    #   map: map
    # $('#map').removeClass 'loading'

  codeAddress = (address) ->
    google.maps.visualRefresh = true
    geocoder = new google.maps.Geocoder()
    geocoder.geocode
      'address': address
      (results, status) ->
        if status is google.maps.GeocoderStatus.OK and results.length > 0
          # vp = results[0].geometry.viewport
          # latlng = results[0].geometry.location

          options =
            zoom:17
            center:results[0].geometry.location
            mapTypeId:google.maps.MapTypeId.ROADMAP

          map = new google.maps.Map document.getElementById("map"), options

          marker = new google.maps.Marker
            map: map
            position: results[0].geometry.location    

          request = 
            location: results[0].geometry.location
            radius: '200'

          service = new google.maps.places.PlacesService map
          service.nearbySearch request, ( results, status, pagination ) ->
            for result in results
              console.log result.vicinity
            

        else
          #alert "Geocode was not successful for the following reason: " + status
          $('#map').hide()

  if $('#map-sponsor').length > 0
    $('#map').fadeIn()
    $('#map').addClass 'loading'
    address = $('#map').data 'address'
    gm = codeAddress address

  svgeezy.init('nocheck', 'png');
  $('a[rel=tooltip]').tooltip()
  moment.lang 'de'

  if $('#calendar').length > 0
    $('#calendar').fullCalendar
      monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember']
      monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dez']
      dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag']
      dayNamesShort: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa']
      firstDay: 1
      buttonText:
        prev:     '&lsaquo;'
        next:     '&rsaquo;'
        prevYear: '&laquo;'
        nextYear: '&raquo;'
        today:    'Heute'
        month:    'Monat'
        week:     'Woche'
        day:      'Tag'
      timeFormat: 'H:mm'
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
        type: 'GET'
        success: ( response, status ) -> 
          console.log 'success',response
          return response.events
        error: (  ) -> 
          console.log 'error'
      eventClick: (calEvent, jsEvent, view) =>
        #console.log calEvent, jsEvent, view
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

  # jmpressOpts =
  #   animation :
  #     transitionDuration : '0.8s'

  # $( '#jms-slideshow' ).jmslideshow( $.extend( true, { jmpressOpts : jmpressOpts }, { autoplay  : true, bgColorSpeed: '0.8s', arrows : false } ) )
  # $( '#jms-slideshow' ).jmslideshow();

  $('body').hide()
  $('body').removeClass 'hidden'
  $('.carousel').carousel()
  $('body').fadeIn()