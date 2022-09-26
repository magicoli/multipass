/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/fullcalendar/calendar.scss":
/*!****************************************!*\
  !*** ./src/fullcalendar/calendar.scss ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ (function(module) {

module.exports = window["wp"]["i18n"];

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
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
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
/*!**************************************!*\
  !*** ./src/fullcalendar/calendar.js ***!
  \**************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _calendar_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./calendar.scss */ "./src/fullcalendar/calendar.scss");
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
        const {
          __,
          _e
        } = wp.i18n;
        var event = data.event;

        var stringEdit = __('Edit');

        data.jsEvent.preventDefault(); // don't let the browser navigate

        console.log(event);
        $('<div>' + event.extendedProps.modal + '</div>').dialog({
          modal: true,
          // dialogClass: "no-close",
          title: event.title,
          // showText: false,
          closeText: 'closeText ' + event.description,
          width: 'auto',
          buttons: [{
            text: __('Calendar', 'multipass'),
            icon: "ui-icon-heart",
            click: function () {
              $(this).dialog("close");
            }
          }, {
            text: __('Close Window', 'multipass'),
            icon: "ui-icon-heart",
            click: function () {
              $(this).dialog("close");
            }
          }] // stringEdit: function() {
          // 	window.open(data.event.url, '_self');
          // },
          // Close: function() {
          // 	$( this ).dialog( "close" );
          // },

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
//# sourceMappingURL=calendar.js.map