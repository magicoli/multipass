/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/fullcalendar/plugin.scss":
/*!**************************************!*\
  !*** ./src/fullcalendar/plugin.scss ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!************************************!*\
  !*** ./src/fullcalendar/plugin.js ***!
  \************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _plugin_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./plugin.scss */ "./src/fullcalendar/plugin.scss");
// // import { FullCalendar } from '@fullcalendar/core';
// // import timelinePlugin from '@fullcalendar/resource-timeline';
// // import allLocales from '@fullcalendar/core/locales-all';
 //

jQuery.ajax({
  type: 'post',
  url: ajaxurl,
  data: {
    action: 'feed_events'
  },
  error: function (err) {
    console.log(err);
  },
  success: function (data) {
    init_calendar(data);
  }
});

function init_calendar(json) {
  const data = JSON.parse(json);
  var resources = data.resources;
  var events = data.events;
  var locale = data.locale; // var events = data['events'];
  // var resources = jsondata['resources'];

  console.log(resources);
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
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
    events: events,
    slotLabelFormat: [{
      weekday: 'short'
    }, // top level of text
    {
      day: 'numeric'
    } // lower level of text
    ],

    eventPositioned(view, element) {
      displayBookings();
    }

  });
  calendar.render();
  document.getElementById('calendar-placeholder').style.display = 'none';
} // document.addEventListener('DOMContentLoaded', function() {
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
}();
/******/ })()
;
//# sourceMappingURL=fullcalendar.js.map