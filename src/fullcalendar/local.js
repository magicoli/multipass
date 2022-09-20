// $.ajax(
// 	{
// 		type: 'post',
// 		url: ajaxurl,
// 		data: {action: 'feed_events'},
// 		error: function(err){
// 			console.log( err );
// 		},
// 		success: function (data)
// 		{
// 			init_calendar( data );
// 		}
// 	}
// )
//
// function init_calendar(events){
// 	var calendarEl = document.getElementById( 'calendar' );
// 	var calendar   = new FullCalendar.Calendar(
// 		calendarEl,
// 		{
// 			plugins: [ 'dayGrid' ],
// 			defaultView: 'dayGridMonth',
// 			header: {
// 				left: 'prev,next today',
// 				center: 'title',
// 				right: ''
// 			},
// 			events: events,
// 			eventPositioned( view, element ) {
// 				displayBookings();
// 			},
// 		}
// 	);
// 	calendar.render();
// }

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
				// plugins: [ 'dayGrid' ],
				schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
				defaultView: 'timelineMonth',
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
