// // import { FullCalendar } from '@fullcalendar/core';
// // import timelinePlugin from '@fullcalendar/resource-timeline';
// // import allLocales from '@fullcalendar/core/locales-all';
import './plugin.scss';
//
jQuery.ajax(
	{
		type: 'post',
		url: ajaxurl,
		data: {action: 'feed_events'},
		error: function(err){
			console.log( err );
		},
		success: function (data)
		{
			init_calendar( data );
		}
	}
)

function init_calendar(json){
	const data = JSON.parse(json);
	var resources = data.resources;
	var events = data.events;
	var locale = data.locale;
	// var events = data['events'];
	// var resources = jsondata['resources'];
	console.log( resources );
	var calendarEl = document.getElementById( 'calendar' );
	var calendar   = new FullCalendar.Calendar(
		calendarEl,
		{
			schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
			// plugins: [ timelinePlugin ],
		  initialView: 'resourceTimelineMonth',
			// locales: allLocales,
			locale: locale,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: ''
			},
			// dayHeaderFormat: 'D',
			expandRows: false,
			nowIndicator: true,
			height: 'auto',
			resources: resources,
			resourceAreaWidth: '15rem',
			events: events,
			slotLabelFormat: [
				{ weekday: 'short' }, // top level of text
				{ day: 'numeric' } // lower level of text
			],
			eventPositioned( view, element ) {
				displayBookings();
			},
		}
	);
	calendar.render();
	document.getElementById( 'calendar-placeholder' ).style.display = 'none';
}

// document.addEventListener('DOMContentLoaded', function() {
// 	var calendarEl = document.getElementById('calendar');
// 	var calendar = new FullCalendar.Calendar(calendarEl, {
// 		initialView: 'dayGridMonth'
// 	});
// 	calendar.render();
// });

// document.addEventListener(
// 	'DOMContentLoaded',
// 	function() {
// 		var calendarEl = document.getElementById( 'calendar' );
// 		var calendar   = new FullCalendar.Calendar(
// 			calendarEl,
// 			{
// 				// plugins: [ 'dayGrid' ],
// 				schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
// 				// defaultView: 'timelineMonth',
// 				initialView: 'resourceTimelineMonth',
// 				defaultDate: '2022-09-07',
// 				header: {
// 					left: 'prev,next today',
// 					center: 'title',
// 				},
// 				resources: [
// 					{
// 						id: 1,
// 						title: 'Main',
// 						children: [
// 							{
// 								id: 11,
// 								title: 'Gite 1',
// 							},
// 							{
// 								id: 12,
// 								title: 'Gite 2',
// 							},
// 						]
// 					},
// 					{
// 						id: 2,
// 						title: 'Options',
// 						children: [
// 							{
// 								id: 21,
// 								title: 'Option 1',
// 							},
// 						]
// 					},
// 				],
// 				events: [
// 					// [
// 					// 	'room1' :
// 						{
// 							title : 'event1',
// 							start : '2022-09-27',
// 							resourceId : 11,
// 						},
// 						{
// 							title : 'event2',
// 							start : '2022-09-15',
// 							end : '2022-09-17',
// 							resourceId : 12,
// 						},
// 						{
// 							title : 'event3',
// 							start : '2022-09-09T12:30:00',
// 							allDay : false,
// 							resourceId : 21,
// 						}
// 					// ]
// 				]
// 			}
// 		);
// 		calendar.render();
// 	}
// );
