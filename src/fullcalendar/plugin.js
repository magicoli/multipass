// // import { FullCalendar } from '@fullcalendar/core';
// // import timelinePlugin from '@fullcalendar/resource-timeline';
// // import allLocales from '@fullcalendar/core/locales-all';
import './plugin.scss';

jQuery(document).ready(function($) {
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
		var resTitle = data.resTitle;
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
				nowIndicator: true,
				height: 'auto',
				// expandRows: true,
				resources: resources,
				resourceOrder: 'mp_order',
				resourceAreaWidth: '15rem',
				resourceAreaHeaderContent: resTitle,
				events: events,
				selectable: true,
				selectHelper: true,
				// select: function(start, end) {
				// 		// Display the modal.
				// 		// You could fill in the start and end fields based on the parameters
				// 		$('.modal').modal('show');
				//
				// },
				eventClick: function(data) {
					data.jsEvent.preventDefault(); // don't let the browser navigate
					var event = data.event;

					$('<div>').html = 'html text';
					$('<div>').dialog({
						modal: true,
						classes: {
							"ui-dialog": "highlight"
						},
						title: event.title,
						text : '<p>' + event.description + '</p>',
						showText: false,
						closeText : 'closeText ' + event.description,
						width: 'auto',
						buttons: {
							'Edit': function() {
								window.open(data.event.url);
							},
							Close: function() {
								$( this ).dialog( "close" );
							},
						}
					});
				},
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

});
