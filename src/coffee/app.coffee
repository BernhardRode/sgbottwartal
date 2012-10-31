$ = jQuery
$ ->
  $('#navbar-affixed').slideUp()

  $('[data-spy="scroll"]').each ->
    spy = $(this).scrollspy('refresh')
    console.log 'hit',spy