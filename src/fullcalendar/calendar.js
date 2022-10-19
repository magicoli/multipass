// // import { FullCalendar } from '@fullcalendar/core';
// // import timelinePlugin from '@fullcalendar/resource-timeline';
// // import allLocales from '@fullcalendar/core/locales-all';
import { __ } from '@wordpress/i18n';
import './calendar.scss';

jQuery( document ).ready(
	function($) {
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
			const data    = JSON.parse( json );
			var resources = data.resources;
			var events    = data.events;
			var locale    = data.locale;
			var resTitle  = data.resTitle;
			// var events = data['events'];
			// var resources = jsondata['resources'];
			console.log( resources );
			var calendarEl = document.getElementById( 'mltp-calendar' );
			var calendar   = new FullCalendar.Calendar(
				calendarEl,
				{
					schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
					// plugins: [ timelinePlugin ],
					initialView: 'resourceTimelineMonth',
					// locales: allLocales,
					locale: locale,
					// customButtons: {
					// myCustomButton: {
					// text: 'Custom Button',
					// click: function() {
					// alert('clicked the custom button!');
					// }
					// }
					// },
					headerToolbar: {
						start: 'title',
						center: '',
						end: 'prevYear,prev today next,nextYear',
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
					// Display the modal.
					// You could fill in the start and end fields based on the parameters
					// $('.modal').modal('show');
					//
					// },
					eventClick: function(data) {
						const { __, _e } = wp.i18n;
						var event        = data.event;
						var stringEdit   = __( 'Edit' );

						data.jsEvent.preventDefault(); // don't let the browser navigate

						// $( '<div id="dialog-' + event.id + '">' + event.extendedProps.modal + '</div>' ).dialog(
						$( '<div id="dialog">' + event.extendedProps.modal + '</div>' ).dialog(
							{
								modal: true,
								draggable: false,
								resizable: false,
								open: function () {
									$( '.ui-widget-overlay' ).on(
										'click',
										function () {
											$( this ).parents( "body" ).find( ".ui-dialog-content" ).dialog( "close" );
										}
									)
								},
								hide: { effect: "fade", duration: 300 },
								show: { effect: "fade", duration: 300 },
								title: event.title,
								// showText: false,
								// closeText : 'Close',
								width: 'auto',
								minWidth: 560,
								maxWidth: $( window ).width(),
								height: $( window ).height() - $( '#wpcontent' ).position().top,
								// minWidth: '500',
								position: {
									my: "right top",
									at: "right top",
									of: window,
									within: "#wpcontent",
									// collision: "fit",
								},
								buttons: [
								// {
								// text: __('View', 'multipass'),
								// icon: "ui-icon-pencil",
								// icons: { primary: "ui-icon-pencil" },
								// click: function() {
								// window.open(data.event.url, '_self');
								// $( this ).dialog( "close" );
								// }
								// },
								// {
								// text: __('Close Window', 'multipass'),
								// icon: "ui-icon-close",
								// icons: { primary: "ui-icon-closethick" },
								// click: function() {
								// $( this ).dialog( "close" );
								// }
								// },
								],
							}
						);
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
			document.getElementById( 'mltp-placeholder' ).style.display = 'none';
		}

	}
);
