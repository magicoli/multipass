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

jQuery(document).ready(function ($) {
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
    var locale = data.locale;
    var resTitle = data.resTitle; // var events = data['events'];
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
      eventClick: function (data) {
        data.jsEvent.preventDefault(); // don't let the browser navigate

        var event = data.event;
        console.log(event);
        $('<div>' + event.extendedProps.description + '</div>').dialog({
          modal: true,
          // dialogClass: "no-close",
          title: event.title,
          // showText: false,
          closeText: 'closeText ' + event.description,
          width: 'auto',
          buttons: {
            'Details': function () {
              window.open(data.event.url, '_self');
            } // 'View': function() {
            // 	document.open(data.event.viewUrl);
            // },
            // Close: function() {
            // 	$( this ).dialog( "close" );
            // },

          }
        });
      },
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
  }
});
}();
/******/ })()
;
//# sourceMappingURL=fullcalendar.js.map