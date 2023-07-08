document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: 'bootstrap5',
    initialView: 'dayGridMonth',
    height: 600,
    events: 'fetchEvents.php',
    
    eventClick: function(info) {
      info.jsEvent.preventDefault();
      
      // change the border color
      info.el.style.borderColor = '#7b0d0d';
      
      Swal.fire({
        title: info.event.title,
        icon: 'info',
        html:'<p class="text-primary">'+info.event.extendedProps.description+'</p><a href="'+info.event.url+'">Visit event page</a>',
        showCloseButton: true,
        cancelButtonText: 'Close',

      })
    }
  });

  calendar.render();
});