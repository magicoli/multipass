// document.addEventListener('DOMContentLoaded', function() {
// var calendarEl = document.getElementById('calendar');
// var calendar = new FullCalendar.Calendar(calendarEl, {
// initialView: 'dayGridMonth'
// });
// calendar.render();
// });


document.addEventListener(
	'DOMContentLoaded',
	function() {
		var calendarEl = document.getElementById( 'calendar' );
		var calendar   = new FullCalendar.Calendar(
			calendarEl,
			{
				schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
				// plugins: ['daygrid'],
				defaultView: 'dayGridMonth',
				defaultDate: '2022-09-07',
				header: {
					left: 'prev,next today',
					center: 'title',
				},
				events: [
				{
					title : 'event1',
					start : '2022-09-27'
				},
				{
					title : 'event2',
					start : '2022-09-15',
					end : '2022-09-17'
				},
				{
					title : 'event3',
					start : '2022-09-09T12:30:00',
					allDay : false // will make the time show
				}
				]
			}
		);
		calendar.render();
	}
);
