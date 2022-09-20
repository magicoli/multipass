/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@fullcalendar/common/main.js":
/*!***************************************************!*\
  !*** ./node_modules/@fullcalendar/common/main.js ***!
  \***************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "BASE_OPTION_DEFAULTS": function() { return /* binding */ BASE_OPTION_DEFAULTS; },
/* harmony export */   "BASE_OPTION_REFINERS": function() { return /* binding */ BASE_OPTION_REFINERS; },
/* harmony export */   "BaseComponent": function() { return /* binding */ BaseComponent; },
/* harmony export */   "BgEvent": function() { return /* binding */ BgEvent; },
/* harmony export */   "CalendarApi": function() { return /* binding */ CalendarApi; },
/* harmony export */   "CalendarContent": function() { return /* binding */ CalendarContent; },
/* harmony export */   "CalendarDataManager": function() { return /* binding */ CalendarDataManager; },
/* harmony export */   "CalendarDataProvider": function() { return /* binding */ CalendarDataProvider; },
/* harmony export */   "CalendarRoot": function() { return /* binding */ CalendarRoot; },
/* harmony export */   "Component": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.Component; },
/* harmony export */   "ContentHook": function() { return /* binding */ ContentHook; },
/* harmony export */   "CustomContentRenderContext": function() { return /* binding */ CustomContentRenderContext; },
/* harmony export */   "DateComponent": function() { return /* binding */ DateComponent; },
/* harmony export */   "DateEnv": function() { return /* binding */ DateEnv; },
/* harmony export */   "DateProfileGenerator": function() { return /* binding */ DateProfileGenerator; },
/* harmony export */   "DayCellContent": function() { return /* binding */ DayCellContent; },
/* harmony export */   "DayCellRoot": function() { return /* binding */ DayCellRoot; },
/* harmony export */   "DayHeader": function() { return /* binding */ DayHeader; },
/* harmony export */   "DaySeriesModel": function() { return /* binding */ DaySeriesModel; },
/* harmony export */   "DayTableModel": function() { return /* binding */ DayTableModel; },
/* harmony export */   "DelayedRunner": function() { return /* binding */ DelayedRunner; },
/* harmony export */   "ElementDragging": function() { return /* binding */ ElementDragging; },
/* harmony export */   "ElementScrollController": function() { return /* binding */ ElementScrollController; },
/* harmony export */   "Emitter": function() { return /* binding */ Emitter; },
/* harmony export */   "EventApi": function() { return /* binding */ EventApi; },
/* harmony export */   "EventRoot": function() { return /* binding */ EventRoot; },
/* harmony export */   "EventSourceApi": function() { return /* binding */ EventSourceApi; },
/* harmony export */   "Fragment": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.Fragment; },
/* harmony export */   "Interaction": function() { return /* binding */ Interaction; },
/* harmony export */   "MoreLinkRoot": function() { return /* binding */ MoreLinkRoot; },
/* harmony export */   "MountHook": function() { return /* binding */ MountHook; },
/* harmony export */   "NamedTimeZoneImpl": function() { return /* binding */ NamedTimeZoneImpl; },
/* harmony export */   "NowIndicatorRoot": function() { return /* binding */ NowIndicatorRoot; },
/* harmony export */   "NowTimer": function() { return /* binding */ NowTimer; },
/* harmony export */   "PositionCache": function() { return /* binding */ PositionCache; },
/* harmony export */   "RefMap": function() { return /* binding */ RefMap; },
/* harmony export */   "RenderHook": function() { return /* binding */ RenderHook; },
/* harmony export */   "ScrollController": function() { return /* binding */ ScrollController; },
/* harmony export */   "ScrollResponder": function() { return /* binding */ ScrollResponder; },
/* harmony export */   "Scroller": function() { return /* binding */ Scroller; },
/* harmony export */   "SegHierarchy": function() { return /* binding */ SegHierarchy; },
/* harmony export */   "SimpleScrollGrid": function() { return /* binding */ SimpleScrollGrid; },
/* harmony export */   "Slicer": function() { return /* binding */ Slicer; },
/* harmony export */   "Splitter": function() { return /* binding */ Splitter; },
/* harmony export */   "StandardEvent": function() { return /* binding */ StandardEvent; },
/* harmony export */   "TableDateCell": function() { return /* binding */ TableDateCell; },
/* harmony export */   "TableDowCell": function() { return /* binding */ TableDowCell; },
/* harmony export */   "Theme": function() { return /* binding */ Theme; },
/* harmony export */   "ViewApi": function() { return /* binding */ ViewApi; },
/* harmony export */   "ViewContextType": function() { return /* binding */ ViewContextType; },
/* harmony export */   "ViewRoot": function() { return /* binding */ ViewRoot; },
/* harmony export */   "WeekNumberRoot": function() { return /* binding */ WeekNumberRoot; },
/* harmony export */   "WindowScrollController": function() { return /* binding */ WindowScrollController; },
/* harmony export */   "addDays": function() { return /* binding */ addDays; },
/* harmony export */   "addDurations": function() { return /* binding */ addDurations; },
/* harmony export */   "addMs": function() { return /* binding */ addMs; },
/* harmony export */   "addWeeks": function() { return /* binding */ addWeeks; },
/* harmony export */   "allowContextMenu": function() { return /* binding */ allowContextMenu; },
/* harmony export */   "allowSelection": function() { return /* binding */ allowSelection; },
/* harmony export */   "applyMutationToEventStore": function() { return /* binding */ applyMutationToEventStore; },
/* harmony export */   "applyStyle": function() { return /* binding */ applyStyle; },
/* harmony export */   "applyStyleProp": function() { return /* binding */ applyStyleProp; },
/* harmony export */   "asCleanDays": function() { return /* binding */ asCleanDays; },
/* harmony export */   "asRoughMinutes": function() { return /* binding */ asRoughMinutes; },
/* harmony export */   "asRoughMs": function() { return /* binding */ asRoughMs; },
/* harmony export */   "asRoughSeconds": function() { return /* binding */ asRoughSeconds; },
/* harmony export */   "binarySearch": function() { return /* binding */ binarySearch; },
/* harmony export */   "buildClassNameNormalizer": function() { return /* binding */ buildClassNameNormalizer; },
/* harmony export */   "buildEntryKey": function() { return /* binding */ buildEntryKey; },
/* harmony export */   "buildEventApis": function() { return /* binding */ buildEventApis; },
/* harmony export */   "buildEventRangeKey": function() { return /* binding */ buildEventRangeKey; },
/* harmony export */   "buildHashFromArray": function() { return /* binding */ buildHashFromArray; },
/* harmony export */   "buildIsoString": function() { return /* binding */ buildIsoString; },
/* harmony export */   "buildNavLinkAttrs": function() { return /* binding */ buildNavLinkAttrs; },
/* harmony export */   "buildSegCompareObj": function() { return /* binding */ buildSegCompareObj; },
/* harmony export */   "buildSegTimeText": function() { return /* binding */ buildSegTimeText; },
/* harmony export */   "collectFromHash": function() { return /* binding */ collectFromHash; },
/* harmony export */   "combineEventUis": function() { return /* binding */ combineEventUis; },
/* harmony export */   "compareByFieldSpec": function() { return /* binding */ compareByFieldSpec; },
/* harmony export */   "compareByFieldSpecs": function() { return /* binding */ compareByFieldSpecs; },
/* harmony export */   "compareNumbers": function() { return /* binding */ compareNumbers; },
/* harmony export */   "compareObjs": function() { return /* binding */ compareObjs; },
/* harmony export */   "computeEarliestSegStart": function() { return /* binding */ computeEarliestSegStart; },
/* harmony export */   "computeEdges": function() { return /* binding */ computeEdges; },
/* harmony export */   "computeFallbackHeaderFormat": function() { return /* binding */ computeFallbackHeaderFormat; },
/* harmony export */   "computeHeightAndMargins": function() { return /* binding */ computeHeightAndMargins; },
/* harmony export */   "computeInnerRect": function() { return /* binding */ computeInnerRect; },
/* harmony export */   "computeRect": function() { return /* binding */ computeRect; },
/* harmony export */   "computeSegDraggable": function() { return /* binding */ computeSegDraggable; },
/* harmony export */   "computeSegEndResizable": function() { return /* binding */ computeSegEndResizable; },
/* harmony export */   "computeSegStartResizable": function() { return /* binding */ computeSegStartResizable; },
/* harmony export */   "computeShrinkWidth": function() { return /* binding */ computeShrinkWidth; },
/* harmony export */   "computeSmallestCellWidth": function() { return /* binding */ computeSmallestCellWidth; },
/* harmony export */   "computeVisibleDayRange": function() { return /* binding */ computeVisibleDayRange; },
/* harmony export */   "config": function() { return /* binding */ config; },
/* harmony export */   "constrainPoint": function() { return /* binding */ constrainPoint; },
/* harmony export */   "createAriaClickAttrs": function() { return /* binding */ createAriaClickAttrs; },
/* harmony export */   "createContext": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createContext; },
/* harmony export */   "createDuration": function() { return /* binding */ createDuration; },
/* harmony export */   "createElement": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement; },
/* harmony export */   "createEmptyEventStore": function() { return /* binding */ createEmptyEventStore; },
/* harmony export */   "createEventInstance": function() { return /* binding */ createEventInstance; },
/* harmony export */   "createEventUi": function() { return /* binding */ createEventUi; },
/* harmony export */   "createFormatter": function() { return /* binding */ createFormatter; },
/* harmony export */   "createPlugin": function() { return /* binding */ createPlugin; },
/* harmony export */   "createPortal": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createPortal; },
/* harmony export */   "createRef": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createRef; },
/* harmony export */   "diffDates": function() { return /* binding */ diffDates; },
/* harmony export */   "diffDayAndTime": function() { return /* binding */ diffDayAndTime; },
/* harmony export */   "diffDays": function() { return /* binding */ diffDays; },
/* harmony export */   "diffPoints": function() { return /* binding */ diffPoints; },
/* harmony export */   "diffWeeks": function() { return /* binding */ diffWeeks; },
/* harmony export */   "diffWholeDays": function() { return /* binding */ diffWholeDays; },
/* harmony export */   "diffWholeWeeks": function() { return /* binding */ diffWholeWeeks; },
/* harmony export */   "disableCursor": function() { return /* binding */ disableCursor; },
/* harmony export */   "elementClosest": function() { return /* binding */ elementClosest; },
/* harmony export */   "elementMatches": function() { return /* binding */ elementMatches; },
/* harmony export */   "enableCursor": function() { return /* binding */ enableCursor; },
/* harmony export */   "eventTupleToStore": function() { return /* binding */ eventTupleToStore; },
/* harmony export */   "filterEventStoreDefs": function() { return /* binding */ filterEventStoreDefs; },
/* harmony export */   "filterHash": function() { return /* binding */ filterHash; },
/* harmony export */   "findDirectChildren": function() { return /* binding */ findDirectChildren; },
/* harmony export */   "findElements": function() { return /* binding */ findElements; },
/* harmony export */   "flexibleCompare": function() { return /* binding */ flexibleCompare; },
/* harmony export */   "flushSync": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.flushSync; },
/* harmony export */   "formatDate": function() { return /* binding */ formatDate; },
/* harmony export */   "formatDayString": function() { return /* binding */ formatDayString; },
/* harmony export */   "formatIsoTimeString": function() { return /* binding */ formatIsoTimeString; },
/* harmony export */   "formatRange": function() { return /* binding */ formatRange; },
/* harmony export */   "getAllowYScrolling": function() { return /* binding */ getAllowYScrolling; },
/* harmony export */   "getCanVGrowWithinCell": function() { return /* binding */ getCanVGrowWithinCell; },
/* harmony export */   "getClippingParents": function() { return /* binding */ getClippingParents; },
/* harmony export */   "getDateMeta": function() { return /* binding */ getDateMeta; },
/* harmony export */   "getDayClassNames": function() { return /* binding */ getDayClassNames; },
/* harmony export */   "getDefaultEventEnd": function() { return /* binding */ getDefaultEventEnd; },
/* harmony export */   "getElRoot": function() { return /* binding */ getElRoot; },
/* harmony export */   "getElSeg": function() { return /* binding */ getElSeg; },
/* harmony export */   "getEntrySpanEnd": function() { return /* binding */ getEntrySpanEnd; },
/* harmony export */   "getEventClassNames": function() { return /* binding */ getEventClassNames; },
/* harmony export */   "getEventTargetViaRoot": function() { return /* binding */ getEventTargetViaRoot; },
/* harmony export */   "getIsRtlScrollbarOnLeft": function() { return /* binding */ getIsRtlScrollbarOnLeft; },
/* harmony export */   "getRectCenter": function() { return /* binding */ getRectCenter; },
/* harmony export */   "getRelevantEvents": function() { return /* binding */ getRelevantEvents; },
/* harmony export */   "getScrollGridClassNames": function() { return /* binding */ getScrollGridClassNames; },
/* harmony export */   "getScrollbarWidths": function() { return /* binding */ getScrollbarWidths; },
/* harmony export */   "getSectionClassNames": function() { return /* binding */ getSectionClassNames; },
/* harmony export */   "getSectionHasLiquidHeight": function() { return /* binding */ getSectionHasLiquidHeight; },
/* harmony export */   "getSegAnchorAttrs": function() { return /* binding */ getSegAnchorAttrs; },
/* harmony export */   "getSegMeta": function() { return /* binding */ getSegMeta; },
/* harmony export */   "getSlotClassNames": function() { return /* binding */ getSlotClassNames; },
/* harmony export */   "getStickyFooterScrollbar": function() { return /* binding */ getStickyFooterScrollbar; },
/* harmony export */   "getStickyHeaderDates": function() { return /* binding */ getStickyHeaderDates; },
/* harmony export */   "getUnequalProps": function() { return /* binding */ getUnequalProps; },
/* harmony export */   "getUniqueDomId": function() { return /* binding */ getUniqueDomId; },
/* harmony export */   "globalLocales": function() { return /* binding */ globalLocales; },
/* harmony export */   "globalPlugins": function() { return /* binding */ globalPlugins; },
/* harmony export */   "greatestDurationDenominator": function() { return /* binding */ greatestDurationDenominator; },
/* harmony export */   "groupIntersectingEntries": function() { return /* binding */ groupIntersectingEntries; },
/* harmony export */   "guid": function() { return /* binding */ guid; },
/* harmony export */   "hasBgRendering": function() { return /* binding */ hasBgRendering; },
/* harmony export */   "hasShrinkWidth": function() { return /* binding */ hasShrinkWidth; },
/* harmony export */   "identity": function() { return /* binding */ identity; },
/* harmony export */   "interactionSettingsStore": function() { return /* binding */ interactionSettingsStore; },
/* harmony export */   "interactionSettingsToStore": function() { return /* binding */ interactionSettingsToStore; },
/* harmony export */   "intersectRanges": function() { return /* binding */ intersectRanges; },
/* harmony export */   "intersectRects": function() { return /* binding */ intersectRects; },
/* harmony export */   "intersectSpans": function() { return /* binding */ intersectSpans; },
/* harmony export */   "isArraysEqual": function() { return /* binding */ isArraysEqual; },
/* harmony export */   "isColPropsEqual": function() { return /* binding */ isColPropsEqual; },
/* harmony export */   "isDateSelectionValid": function() { return /* binding */ isDateSelectionValid; },
/* harmony export */   "isDateSpansEqual": function() { return /* binding */ isDateSpansEqual; },
/* harmony export */   "isInt": function() { return /* binding */ isInt; },
/* harmony export */   "isInteractionValid": function() { return /* binding */ isInteractionValid; },
/* harmony export */   "isMultiDayRange": function() { return /* binding */ isMultiDayRange; },
/* harmony export */   "isPropsEqual": function() { return /* binding */ isPropsEqual; },
/* harmony export */   "isPropsValid": function() { return /* binding */ isPropsValid; },
/* harmony export */   "isValidDate": function() { return /* binding */ isValidDate; },
/* harmony export */   "joinSpans": function() { return /* binding */ joinSpans; },
/* harmony export */   "listenBySelector": function() { return /* binding */ listenBySelector; },
/* harmony export */   "mapHash": function() { return /* binding */ mapHash; },
/* harmony export */   "memoize": function() { return /* binding */ memoize; },
/* harmony export */   "memoizeArraylike": function() { return /* binding */ memoizeArraylike; },
/* harmony export */   "memoizeHashlike": function() { return /* binding */ memoizeHashlike; },
/* harmony export */   "memoizeObjArg": function() { return /* binding */ memoizeObjArg; },
/* harmony export */   "mergeEventStores": function() { return /* binding */ mergeEventStores; },
/* harmony export */   "multiplyDuration": function() { return /* binding */ multiplyDuration; },
/* harmony export */   "padStart": function() { return /* binding */ padStart; },
/* harmony export */   "parseBusinessHours": function() { return /* binding */ parseBusinessHours; },
/* harmony export */   "parseClassNames": function() { return /* binding */ parseClassNames; },
/* harmony export */   "parseDragMeta": function() { return /* binding */ parseDragMeta; },
/* harmony export */   "parseEventDef": function() { return /* binding */ parseEventDef; },
/* harmony export */   "parseFieldSpecs": function() { return /* binding */ parseFieldSpecs; },
/* harmony export */   "parseMarker": function() { return /* binding */ parse; },
/* harmony export */   "pointInsideRect": function() { return /* binding */ pointInsideRect; },
/* harmony export */   "preventContextMenu": function() { return /* binding */ preventContextMenu; },
/* harmony export */   "preventDefault": function() { return /* binding */ preventDefault; },
/* harmony export */   "preventSelection": function() { return /* binding */ preventSelection; },
/* harmony export */   "rangeContainsMarker": function() { return /* binding */ rangeContainsMarker; },
/* harmony export */   "rangeContainsRange": function() { return /* binding */ rangeContainsRange; },
/* harmony export */   "rangesEqual": function() { return /* binding */ rangesEqual; },
/* harmony export */   "rangesIntersect": function() { return /* binding */ rangesIntersect; },
/* harmony export */   "refineEventDef": function() { return /* binding */ refineEventDef; },
/* harmony export */   "refineProps": function() { return /* binding */ refineProps; },
/* harmony export */   "removeElement": function() { return /* binding */ removeElement; },
/* harmony export */   "removeExact": function() { return /* binding */ removeExact; },
/* harmony export */   "render": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.render; },
/* harmony export */   "renderChunkContent": function() { return /* binding */ renderChunkContent; },
/* harmony export */   "renderFill": function() { return /* binding */ renderFill; },
/* harmony export */   "renderMicroColGroup": function() { return /* binding */ renderMicroColGroup; },
/* harmony export */   "renderScrollShim": function() { return /* binding */ renderScrollShim; },
/* harmony export */   "requestJson": function() { return /* binding */ requestJson; },
/* harmony export */   "sanitizeShrinkWidth": function() { return /* binding */ sanitizeShrinkWidth; },
/* harmony export */   "setElSeg": function() { return /* binding */ setElSeg; },
/* harmony export */   "setRef": function() { return /* binding */ setRef; },
/* harmony export */   "sliceEventStore": function() { return /* binding */ sliceEventStore; },
/* harmony export */   "sliceEvents": function() { return /* binding */ sliceEvents; },
/* harmony export */   "sortEventSegs": function() { return /* binding */ sortEventSegs; },
/* harmony export */   "startOfDay": function() { return /* binding */ startOfDay; },
/* harmony export */   "translateRect": function() { return /* binding */ translateRect; },
/* harmony export */   "triggerDateSelect": function() { return /* binding */ triggerDateSelect; },
/* harmony export */   "unmountComponentAtNode": function() { return /* reexport safe */ _vdom_js__WEBPACK_IMPORTED_MODULE_1__.unmountComponentAtNode; },
/* harmony export */   "unpromisify": function() { return /* binding */ unpromisify; },
/* harmony export */   "version": function() { return /* binding */ version; },
/* harmony export */   "whenTransitionDone": function() { return /* binding */ whenTransitionDone; },
/* harmony export */   "wholeDivideDurations": function() { return /* binding */ wholeDivideDurations; }
/* harmony export */ });
/* harmony import */ var _main_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./main.css */ "./node_modules/@fullcalendar/common/main.css");
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _vdom_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./vdom.js */ "./node_modules/@fullcalendar/common/vdom.js");
/*!
FullCalendar v5.11.3
Docs & License: https://fullcalendar.io/
(c) 2022 Adam Shaw
*/






// no public types yet. when there are, export from:
// import {} from './api-type-deps'
var EventSourceApi = /** @class */ (function () {
    function EventSourceApi(context, internalEventSource) {
        this.context = context;
        this.internalEventSource = internalEventSource;
    }
    EventSourceApi.prototype.remove = function () {
        this.context.dispatch({
            type: 'REMOVE_EVENT_SOURCE',
            sourceId: this.internalEventSource.sourceId,
        });
    };
    EventSourceApi.prototype.refetch = function () {
        this.context.dispatch({
            type: 'FETCH_EVENT_SOURCES',
            sourceIds: [this.internalEventSource.sourceId],
            isRefetch: true,
        });
    };
    Object.defineProperty(EventSourceApi.prototype, "id", {
        get: function () {
            return this.internalEventSource.publicId;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventSourceApi.prototype, "url", {
        get: function () {
            return this.internalEventSource.meta.url;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventSourceApi.prototype, "format", {
        get: function () {
            return this.internalEventSource.meta.format; // TODO: bad. not guaranteed
        },
        enumerable: false,
        configurable: true
    });
    return EventSourceApi;
}());

function removeElement(el) {
    if (el.parentNode) {
        el.parentNode.removeChild(el);
    }
}
// Querying
// ----------------------------------------------------------------------------------------------------------------
function elementClosest(el, selector) {
    if (el.closest) {
        return el.closest(selector);
        // really bad fallback for IE
        // from https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
    }
    if (!document.documentElement.contains(el)) {
        return null;
    }
    do {
        if (elementMatches(el, selector)) {
            return el;
        }
        el = (el.parentElement || el.parentNode);
    } while (el !== null && el.nodeType === 1);
    return null;
}
function elementMatches(el, selector) {
    var method = el.matches || el.matchesSelector || el.msMatchesSelector;
    return method.call(el, selector);
}
// accepts multiple subject els
// returns a real array. good for methods like forEach
// TODO: accept the document
function findElements(container, selector) {
    var containers = container instanceof HTMLElement ? [container] : container;
    var allMatches = [];
    for (var i = 0; i < containers.length; i += 1) {
        var matches = containers[i].querySelectorAll(selector);
        for (var j = 0; j < matches.length; j += 1) {
            allMatches.push(matches[j]);
        }
    }
    return allMatches;
}
// accepts multiple subject els
// only queries direct child elements // TODO: rename to findDirectChildren!
function findDirectChildren(parent, selector) {
    var parents = parent instanceof HTMLElement ? [parent] : parent;
    var allMatches = [];
    for (var i = 0; i < parents.length; i += 1) {
        var childNodes = parents[i].children; // only ever elements
        for (var j = 0; j < childNodes.length; j += 1) {
            var childNode = childNodes[j];
            if (!selector || elementMatches(childNode, selector)) {
                allMatches.push(childNode);
            }
        }
    }
    return allMatches;
}
// Style
// ----------------------------------------------------------------------------------------------------------------
var PIXEL_PROP_RE = /(top|left|right|bottom|width|height)$/i;
function applyStyle(el, props) {
    for (var propName in props) {
        applyStyleProp(el, propName, props[propName]);
    }
}
function applyStyleProp(el, name, val) {
    if (val == null) {
        el.style[name] = '';
    }
    else if (typeof val === 'number' && PIXEL_PROP_RE.test(name)) {
        el.style[name] = val + "px";
    }
    else {
        el.style[name] = val;
    }
}
// Event Handling
// ----------------------------------------------------------------------------------------------------------------
// if intercepting bubbled events at the document/window/body level,
// and want to see originating element (the 'target'), use this util instead
// of `ev.target` because it goes within web-component boundaries.
function getEventTargetViaRoot(ev) {
    var _a, _b;
    return (_b = (_a = ev.composedPath) === null || _a === void 0 ? void 0 : _a.call(ev)[0]) !== null && _b !== void 0 ? _b : ev.target;
}
// Shadow DOM consuderations
// ----------------------------------------------------------------------------------------------------------------
function getElRoot(el) {
    return el.getRootNode ? el.getRootNode() : document;
}
// Unique ID for DOM attribute
var guid$1 = 0;
function getUniqueDomId() {
    guid$1 += 1;
    return 'fc-dom-' + guid$1;
}

// Stops a mouse/touch event from doing it's native browser action
function preventDefault(ev) {
    ev.preventDefault();
}
// Event Delegation
// ----------------------------------------------------------------------------------------------------------------
function buildDelegationHandler(selector, handler) {
    return function (ev) {
        var matchedChild = elementClosest(ev.target, selector);
        if (matchedChild) {
            handler.call(matchedChild, ev, matchedChild);
        }
    };
}
function listenBySelector(container, eventType, selector, handler) {
    var attachedHandler = buildDelegationHandler(selector, handler);
    container.addEventListener(eventType, attachedHandler);
    return function () {
        container.removeEventListener(eventType, attachedHandler);
    };
}
function listenToHoverBySelector(container, selector, onMouseEnter, onMouseLeave) {
    var currentMatchedChild;
    return listenBySelector(container, 'mouseover', selector, function (mouseOverEv, matchedChild) {
        if (matchedChild !== currentMatchedChild) {
            currentMatchedChild = matchedChild;
            onMouseEnter(mouseOverEv, matchedChild);
            var realOnMouseLeave_1 = function (mouseLeaveEv) {
                currentMatchedChild = null;
                onMouseLeave(mouseLeaveEv, matchedChild);
                matchedChild.removeEventListener('mouseleave', realOnMouseLeave_1);
            };
            // listen to the next mouseleave, and then unattach
            matchedChild.addEventListener('mouseleave', realOnMouseLeave_1);
        }
    });
}
// Animation
// ----------------------------------------------------------------------------------------------------------------
var transitionEventNames = [
    'webkitTransitionEnd',
    'otransitionend',
    'oTransitionEnd',
    'msTransitionEnd',
    'transitionend',
];
// triggered only when the next single subsequent transition finishes
function whenTransitionDone(el, callback) {
    var realCallback = function (ev) {
        callback(ev);
        transitionEventNames.forEach(function (eventName) {
            el.removeEventListener(eventName, realCallback);
        });
    };
    transitionEventNames.forEach(function (eventName) {
        el.addEventListener(eventName, realCallback); // cross-browser way to determine when the transition finishes
    });
}
// ARIA workarounds
// ----------------------------------------------------------------------------------------------------------------
function createAriaClickAttrs(handler) {
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ onClick: handler }, createAriaKeyboardAttrs(handler));
}
function createAriaKeyboardAttrs(handler) {
    return {
        tabIndex: 0,
        onKeyDown: function (ev) {
            if (ev.key === 'Enter' || ev.key === ' ') {
                handler(ev);
                ev.preventDefault(); // if space, don't scroll down page
            }
        },
    };
}

var guidNumber = 0;
function guid() {
    guidNumber += 1;
    return String(guidNumber);
}
/* FullCalendar-specific DOM Utilities
----------------------------------------------------------------------------------------------------------------------*/
// Make the mouse cursor express that an event is not allowed in the current area
function disableCursor() {
    document.body.classList.add('fc-not-allowed');
}
// Returns the mouse cursor to its original look
function enableCursor() {
    document.body.classList.remove('fc-not-allowed');
}
/* Selection
----------------------------------------------------------------------------------------------------------------------*/
function preventSelection(el) {
    el.classList.add('fc-unselectable');
    el.addEventListener('selectstart', preventDefault);
}
function allowSelection(el) {
    el.classList.remove('fc-unselectable');
    el.removeEventListener('selectstart', preventDefault);
}
/* Context Menu
----------------------------------------------------------------------------------------------------------------------*/
function preventContextMenu(el) {
    el.addEventListener('contextmenu', preventDefault);
}
function allowContextMenu(el) {
    el.removeEventListener('contextmenu', preventDefault);
}
function parseFieldSpecs(input) {
    var specs = [];
    var tokens = [];
    var i;
    var token;
    if (typeof input === 'string') {
        tokens = input.split(/\s*,\s*/);
    }
    else if (typeof input === 'function') {
        tokens = [input];
    }
    else if (Array.isArray(input)) {
        tokens = input;
    }
    for (i = 0; i < tokens.length; i += 1) {
        token = tokens[i];
        if (typeof token === 'string') {
            specs.push(token.charAt(0) === '-' ?
                { field: token.substring(1), order: -1 } :
                { field: token, order: 1 });
        }
        else if (typeof token === 'function') {
            specs.push({ func: token });
        }
    }
    return specs;
}
function compareByFieldSpecs(obj0, obj1, fieldSpecs) {
    var i;
    var cmp;
    for (i = 0; i < fieldSpecs.length; i += 1) {
        cmp = compareByFieldSpec(obj0, obj1, fieldSpecs[i]);
        if (cmp) {
            return cmp;
        }
    }
    return 0;
}
function compareByFieldSpec(obj0, obj1, fieldSpec) {
    if (fieldSpec.func) {
        return fieldSpec.func(obj0, obj1);
    }
    return flexibleCompare(obj0[fieldSpec.field], obj1[fieldSpec.field])
        * (fieldSpec.order || 1);
}
function flexibleCompare(a, b) {
    if (!a && !b) {
        return 0;
    }
    if (b == null) {
        return -1;
    }
    if (a == null) {
        return 1;
    }
    if (typeof a === 'string' || typeof b === 'string') {
        return String(a).localeCompare(String(b));
    }
    return a - b;
}
/* String Utilities
----------------------------------------------------------------------------------------------------------------------*/
function padStart(val, len) {
    var s = String(val);
    return '000'.substr(0, len - s.length) + s;
}
function formatWithOrdinals(formatter, args, fallbackText) {
    if (typeof formatter === 'function') {
        return formatter.apply(void 0, args);
    }
    if (typeof formatter === 'string') { // non-blank string
        return args.reduce(function (str, arg, index) { return (str.replace('$' + index, arg || '')); }, formatter);
    }
    return fallbackText;
}
/* Number Utilities
----------------------------------------------------------------------------------------------------------------------*/
function compareNumbers(a, b) {
    return a - b;
}
function isInt(n) {
    return n % 1 === 0;
}
/* FC-specific DOM dimension stuff
----------------------------------------------------------------------------------------------------------------------*/
function computeSmallestCellWidth(cellEl) {
    var allWidthEl = cellEl.querySelector('.fc-scrollgrid-shrink-frame');
    var contentWidthEl = cellEl.querySelector('.fc-scrollgrid-shrink-cushion');
    if (!allWidthEl) {
        throw new Error('needs fc-scrollgrid-shrink-frame className'); // TODO: use const
    }
    if (!contentWidthEl) {
        throw new Error('needs fc-scrollgrid-shrink-cushion className');
    }
    return cellEl.getBoundingClientRect().width - allWidthEl.getBoundingClientRect().width + // the cell padding+border
        contentWidthEl.getBoundingClientRect().width;
}

var DAY_IDS = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
// Adding
function addWeeks(m, n) {
    var a = dateToUtcArray(m);
    a[2] += n * 7;
    return arrayToUtcDate(a);
}
function addDays(m, n) {
    var a = dateToUtcArray(m);
    a[2] += n;
    return arrayToUtcDate(a);
}
function addMs(m, n) {
    var a = dateToUtcArray(m);
    a[6] += n;
    return arrayToUtcDate(a);
}
// Diffing (all return floats)
// TODO: why not use ranges?
function diffWeeks(m0, m1) {
    return diffDays(m0, m1) / 7;
}
function diffDays(m0, m1) {
    return (m1.valueOf() - m0.valueOf()) / (1000 * 60 * 60 * 24);
}
function diffHours(m0, m1) {
    return (m1.valueOf() - m0.valueOf()) / (1000 * 60 * 60);
}
function diffMinutes(m0, m1) {
    return (m1.valueOf() - m0.valueOf()) / (1000 * 60);
}
function diffSeconds(m0, m1) {
    return (m1.valueOf() - m0.valueOf()) / 1000;
}
function diffDayAndTime(m0, m1) {
    var m0day = startOfDay(m0);
    var m1day = startOfDay(m1);
    return {
        years: 0,
        months: 0,
        days: Math.round(diffDays(m0day, m1day)),
        milliseconds: (m1.valueOf() - m1day.valueOf()) - (m0.valueOf() - m0day.valueOf()),
    };
}
// Diffing Whole Units
function diffWholeWeeks(m0, m1) {
    var d = diffWholeDays(m0, m1);
    if (d !== null && d % 7 === 0) {
        return d / 7;
    }
    return null;
}
function diffWholeDays(m0, m1) {
    if (timeAsMs(m0) === timeAsMs(m1)) {
        return Math.round(diffDays(m0, m1));
    }
    return null;
}
// Start-Of
function startOfDay(m) {
    return arrayToUtcDate([
        m.getUTCFullYear(),
        m.getUTCMonth(),
        m.getUTCDate(),
    ]);
}
function startOfHour(m) {
    return arrayToUtcDate([
        m.getUTCFullYear(),
        m.getUTCMonth(),
        m.getUTCDate(),
        m.getUTCHours(),
    ]);
}
function startOfMinute(m) {
    return arrayToUtcDate([
        m.getUTCFullYear(),
        m.getUTCMonth(),
        m.getUTCDate(),
        m.getUTCHours(),
        m.getUTCMinutes(),
    ]);
}
function startOfSecond(m) {
    return arrayToUtcDate([
        m.getUTCFullYear(),
        m.getUTCMonth(),
        m.getUTCDate(),
        m.getUTCHours(),
        m.getUTCMinutes(),
        m.getUTCSeconds(),
    ]);
}
// Week Computation
function weekOfYear(marker, dow, doy) {
    var y = marker.getUTCFullYear();
    var w = weekOfGivenYear(marker, y, dow, doy);
    if (w < 1) {
        return weekOfGivenYear(marker, y - 1, dow, doy);
    }
    var nextW = weekOfGivenYear(marker, y + 1, dow, doy);
    if (nextW >= 1) {
        return Math.min(w, nextW);
    }
    return w;
}
function weekOfGivenYear(marker, year, dow, doy) {
    var firstWeekStart = arrayToUtcDate([year, 0, 1 + firstWeekOffset(year, dow, doy)]);
    var dayStart = startOfDay(marker);
    var days = Math.round(diffDays(firstWeekStart, dayStart));
    return Math.floor(days / 7) + 1; // zero-indexed
}
// start-of-first-week - start-of-year
function firstWeekOffset(year, dow, doy) {
    // first-week day -- which january is always in the first week (4 for iso, 1 for other)
    var fwd = 7 + dow - doy;
    // first-week day local weekday -- which local weekday is fwd
    var fwdlw = (7 + arrayToUtcDate([year, 0, fwd]).getUTCDay() - dow) % 7;
    return -fwdlw + fwd - 1;
}
// Array Conversion
function dateToLocalArray(date) {
    return [
        date.getFullYear(),
        date.getMonth(),
        date.getDate(),
        date.getHours(),
        date.getMinutes(),
        date.getSeconds(),
        date.getMilliseconds(),
    ];
}
function arrayToLocalDate(a) {
    return new Date(a[0], a[1] || 0, a[2] == null ? 1 : a[2], // day of month
    a[3] || 0, a[4] || 0, a[5] || 0);
}
function dateToUtcArray(date) {
    return [
        date.getUTCFullYear(),
        date.getUTCMonth(),
        date.getUTCDate(),
        date.getUTCHours(),
        date.getUTCMinutes(),
        date.getUTCSeconds(),
        date.getUTCMilliseconds(),
    ];
}
function arrayToUtcDate(a) {
    // according to web standards (and Safari), a month index is required.
    // massage if only given a year.
    if (a.length === 1) {
        a = a.concat([0]);
    }
    return new Date(Date.UTC.apply(Date, a));
}
// Other Utils
function isValidDate(m) {
    return !isNaN(m.valueOf());
}
function timeAsMs(m) {
    return m.getUTCHours() * 1000 * 60 * 60 +
        m.getUTCMinutes() * 1000 * 60 +
        m.getUTCSeconds() * 1000 +
        m.getUTCMilliseconds();
}

function createEventInstance(defId, range, forcedStartTzo, forcedEndTzo) {
    return {
        instanceId: guid(),
        defId: defId,
        range: range,
        forcedStartTzo: forcedStartTzo == null ? null : forcedStartTzo,
        forcedEndTzo: forcedEndTzo == null ? null : forcedEndTzo,
    };
}

var hasOwnProperty = Object.prototype.hasOwnProperty;
// Merges an array of objects into a single object.
// The second argument allows for an array of property names who's object values will be merged together.
function mergeProps(propObjs, complexPropsMap) {
    var dest = {};
    if (complexPropsMap) {
        for (var name_1 in complexPropsMap) {
            var complexObjs = [];
            // collect the trailing object values, stopping when a non-object is discovered
            for (var i = propObjs.length - 1; i >= 0; i -= 1) {
                var val = propObjs[i][name_1];
                if (typeof val === 'object' && val) { // non-null object
                    complexObjs.unshift(val);
                }
                else if (val !== undefined) {
                    dest[name_1] = val; // if there were no objects, this value will be used
                    break;
                }
            }
            // if the trailing values were objects, use the merged value
            if (complexObjs.length) {
                dest[name_1] = mergeProps(complexObjs);
            }
        }
    }
    // copy values into the destination, going from last to first
    for (var i = propObjs.length - 1; i >= 0; i -= 1) {
        var props = propObjs[i];
        for (var name_2 in props) {
            if (!(name_2 in dest)) { // if already assigned by previous props or complex props, don't reassign
                dest[name_2] = props[name_2];
            }
        }
    }
    return dest;
}
function filterHash(hash, func) {
    var filtered = {};
    for (var key in hash) {
        if (func(hash[key], key)) {
            filtered[key] = hash[key];
        }
    }
    return filtered;
}
function mapHash(hash, func) {
    var newHash = {};
    for (var key in hash) {
        newHash[key] = func(hash[key], key);
    }
    return newHash;
}
function arrayToHash(a) {
    var hash = {};
    for (var _i = 0, a_1 = a; _i < a_1.length; _i++) {
        var item = a_1[_i];
        hash[item] = true;
    }
    return hash;
}
function buildHashFromArray(a, func) {
    var hash = {};
    for (var i = 0; i < a.length; i += 1) {
        var tuple = func(a[i], i);
        hash[tuple[0]] = tuple[1];
    }
    return hash;
}
function hashValuesToArray(obj) {
    var a = [];
    for (var key in obj) {
        a.push(obj[key]);
    }
    return a;
}
function isPropsEqual(obj0, obj1) {
    if (obj0 === obj1) {
        return true;
    }
    for (var key in obj0) {
        if (hasOwnProperty.call(obj0, key)) {
            if (!(key in obj1)) {
                return false;
            }
        }
    }
    for (var key in obj1) {
        if (hasOwnProperty.call(obj1, key)) {
            if (obj0[key] !== obj1[key]) {
                return false;
            }
        }
    }
    return true;
}
function getUnequalProps(obj0, obj1) {
    var keys = [];
    for (var key in obj0) {
        if (hasOwnProperty.call(obj0, key)) {
            if (!(key in obj1)) {
                keys.push(key);
            }
        }
    }
    for (var key in obj1) {
        if (hasOwnProperty.call(obj1, key)) {
            if (obj0[key] !== obj1[key]) {
                keys.push(key);
            }
        }
    }
    return keys;
}
function compareObjs(oldProps, newProps, equalityFuncs) {
    if (equalityFuncs === void 0) { equalityFuncs = {}; }
    if (oldProps === newProps) {
        return true;
    }
    for (var key in newProps) {
        if (key in oldProps && isObjValsEqual(oldProps[key], newProps[key], equalityFuncs[key])) ;
        else {
            return false;
        }
    }
    // check for props that were omitted in the new
    for (var key in oldProps) {
        if (!(key in newProps)) {
            return false;
        }
    }
    return true;
}
/*
assumed "true" equality for handler names like "onReceiveSomething"
*/
function isObjValsEqual(val0, val1, comparator) {
    if (val0 === val1 || comparator === true) {
        return true;
    }
    if (comparator) {
        return comparator(val0, val1);
    }
    return false;
}
function collectFromHash(hash, startIndex, endIndex, step) {
    if (startIndex === void 0) { startIndex = 0; }
    if (step === void 0) { step = 1; }
    var res = [];
    if (endIndex == null) {
        endIndex = Object.keys(hash).length;
    }
    for (var i = startIndex; i < endIndex; i += step) {
        var val = hash[i];
        if (val !== undefined) { // will disregard undefined for sparse arrays
            res.push(val);
        }
    }
    return res;
}

function parseRecurring(refined, defaultAllDay, dateEnv, recurringTypes) {
    for (var i = 0; i < recurringTypes.length; i += 1) {
        var parsed = recurringTypes[i].parse(refined, dateEnv);
        if (parsed) {
            var allDay = refined.allDay;
            if (allDay == null) {
                allDay = defaultAllDay;
                if (allDay == null) {
                    allDay = parsed.allDayGuess;
                    if (allDay == null) {
                        allDay = false;
                    }
                }
            }
            return {
                allDay: allDay,
                duration: parsed.duration,
                typeData: parsed.typeData,
                typeId: i,
            };
        }
    }
    return null;
}
function expandRecurring(eventStore, framingRange, context) {
    var dateEnv = context.dateEnv, pluginHooks = context.pluginHooks, options = context.options;
    var defs = eventStore.defs, instances = eventStore.instances;
    // remove existing recurring instances
    // TODO: bad. always expand events as a second step
    instances = filterHash(instances, function (instance) { return !defs[instance.defId].recurringDef; });
    for (var defId in defs) {
        var def = defs[defId];
        if (def.recurringDef) {
            var duration = def.recurringDef.duration;
            if (!duration) {
                duration = def.allDay ?
                    options.defaultAllDayEventDuration :
                    options.defaultTimedEventDuration;
            }
            var starts = expandRecurringRanges(def, duration, framingRange, dateEnv, pluginHooks.recurringTypes);
            for (var _i = 0, starts_1 = starts; _i < starts_1.length; _i++) {
                var start = starts_1[_i];
                var instance = createEventInstance(defId, {
                    start: start,
                    end: dateEnv.add(start, duration),
                });
                instances[instance.instanceId] = instance;
            }
        }
    }
    return { defs: defs, instances: instances };
}
/*
Event MUST have a recurringDef
*/
function expandRecurringRanges(eventDef, duration, framingRange, dateEnv, recurringTypes) {
    var typeDef = recurringTypes[eventDef.recurringDef.typeId];
    var markers = typeDef.expand(eventDef.recurringDef.typeData, {
        start: dateEnv.subtract(framingRange.start, duration),
        end: framingRange.end,
    }, dateEnv);
    // the recurrence plugins don't guarantee that all-day events are start-of-day, so we have to
    if (eventDef.allDay) {
        markers = markers.map(startOfDay);
    }
    return markers;
}

var INTERNAL_UNITS = ['years', 'months', 'days', 'milliseconds'];
var PARSE_RE = /^(-?)(?:(\d+)\.)?(\d+):(\d\d)(?::(\d\d)(?:\.(\d\d\d))?)?/;
// Parsing and Creation
function createDuration(input, unit) {
    var _a;
    if (typeof input === 'string') {
        return parseString(input);
    }
    if (typeof input === 'object' && input) { // non-null object
        return parseObject(input);
    }
    if (typeof input === 'number') {
        return parseObject((_a = {}, _a[unit || 'milliseconds'] = input, _a));
    }
    return null;
}
function parseString(s) {
    var m = PARSE_RE.exec(s);
    if (m) {
        var sign = m[1] ? -1 : 1;
        return {
            years: 0,
            months: 0,
            days: sign * (m[2] ? parseInt(m[2], 10) : 0),
            milliseconds: sign * ((m[3] ? parseInt(m[3], 10) : 0) * 60 * 60 * 1000 + // hours
                (m[4] ? parseInt(m[4], 10) : 0) * 60 * 1000 + // minutes
                (m[5] ? parseInt(m[5], 10) : 0) * 1000 + // seconds
                (m[6] ? parseInt(m[6], 10) : 0) // ms
            ),
        };
    }
    return null;
}
function parseObject(obj) {
    var duration = {
        years: obj.years || obj.year || 0,
        months: obj.months || obj.month || 0,
        days: obj.days || obj.day || 0,
        milliseconds: (obj.hours || obj.hour || 0) * 60 * 60 * 1000 + // hours
            (obj.minutes || obj.minute || 0) * 60 * 1000 + // minutes
            (obj.seconds || obj.second || 0) * 1000 + // seconds
            (obj.milliseconds || obj.millisecond || obj.ms || 0), // ms
    };
    var weeks = obj.weeks || obj.week;
    if (weeks) {
        duration.days += weeks * 7;
        duration.specifiedWeeks = true;
    }
    return duration;
}
// Equality
function durationsEqual(d0, d1) {
    return d0.years === d1.years &&
        d0.months === d1.months &&
        d0.days === d1.days &&
        d0.milliseconds === d1.milliseconds;
}
function asCleanDays(dur) {
    if (!dur.years && !dur.months && !dur.milliseconds) {
        return dur.days;
    }
    return 0;
}
// Simple Math
function addDurations(d0, d1) {
    return {
        years: d0.years + d1.years,
        months: d0.months + d1.months,
        days: d0.days + d1.days,
        milliseconds: d0.milliseconds + d1.milliseconds,
    };
}
function subtractDurations(d1, d0) {
    return {
        years: d1.years - d0.years,
        months: d1.months - d0.months,
        days: d1.days - d0.days,
        milliseconds: d1.milliseconds - d0.milliseconds,
    };
}
function multiplyDuration(d, n) {
    return {
        years: d.years * n,
        months: d.months * n,
        days: d.days * n,
        milliseconds: d.milliseconds * n,
    };
}
// Conversions
// "Rough" because they are based on average-case Gregorian months/years
function asRoughYears(dur) {
    return asRoughDays(dur) / 365;
}
function asRoughMonths(dur) {
    return asRoughDays(dur) / 30;
}
function asRoughDays(dur) {
    return asRoughMs(dur) / 864e5;
}
function asRoughMinutes(dur) {
    return asRoughMs(dur) / (1000 * 60);
}
function asRoughSeconds(dur) {
    return asRoughMs(dur) / 1000;
}
function asRoughMs(dur) {
    return dur.years * (365 * 864e5) +
        dur.months * (30 * 864e5) +
        dur.days * 864e5 +
        dur.milliseconds;
}
// Advanced Math
function wholeDivideDurations(numerator, denominator) {
    var res = null;
    for (var i = 0; i < INTERNAL_UNITS.length; i += 1) {
        var unit = INTERNAL_UNITS[i];
        if (denominator[unit]) {
            var localRes = numerator[unit] / denominator[unit];
            if (!isInt(localRes) || (res !== null && res !== localRes)) {
                return null;
            }
            res = localRes;
        }
        else if (numerator[unit]) {
            // needs to divide by something but can't!
            return null;
        }
    }
    return res;
}
function greatestDurationDenominator(dur) {
    var ms = dur.milliseconds;
    if (ms) {
        if (ms % 1000 !== 0) {
            return { unit: 'millisecond', value: ms };
        }
        if (ms % (1000 * 60) !== 0) {
            return { unit: 'second', value: ms / 1000 };
        }
        if (ms % (1000 * 60 * 60) !== 0) {
            return { unit: 'minute', value: ms / (1000 * 60) };
        }
        if (ms) {
            return { unit: 'hour', value: ms / (1000 * 60 * 60) };
        }
    }
    if (dur.days) {
        if (dur.specifiedWeeks && dur.days % 7 === 0) {
            return { unit: 'week', value: dur.days / 7 };
        }
        return { unit: 'day', value: dur.days };
    }
    if (dur.months) {
        return { unit: 'month', value: dur.months };
    }
    if (dur.years) {
        return { unit: 'year', value: dur.years };
    }
    return { unit: 'millisecond', value: 0 };
}

// timeZoneOffset is in minutes
function buildIsoString(marker, timeZoneOffset, stripZeroTime) {
    if (stripZeroTime === void 0) { stripZeroTime = false; }
    var s = marker.toISOString();
    s = s.replace('.000', '');
    if (stripZeroTime) {
        s = s.replace('T00:00:00Z', '');
    }
    if (s.length > 10) { // time part wasn't stripped, can add timezone info
        if (timeZoneOffset == null) {
            s = s.replace('Z', '');
        }
        else if (timeZoneOffset !== 0) {
            s = s.replace('Z', formatTimeZoneOffset(timeZoneOffset, true));
        }
        // otherwise, its UTC-0 and we want to keep the Z
    }
    return s;
}
// formats the date, but with no time part
// TODO: somehow merge with buildIsoString and stripZeroTime
// TODO: rename. omit "string"
function formatDayString(marker) {
    return marker.toISOString().replace(/T.*$/, '');
}
// TODO: use Date::toISOString and use everything after the T?
function formatIsoTimeString(marker) {
    return padStart(marker.getUTCHours(), 2) + ':' +
        padStart(marker.getUTCMinutes(), 2) + ':' +
        padStart(marker.getUTCSeconds(), 2);
}
function formatTimeZoneOffset(minutes, doIso) {
    if (doIso === void 0) { doIso = false; }
    var sign = minutes < 0 ? '-' : '+';
    var abs = Math.abs(minutes);
    var hours = Math.floor(abs / 60);
    var mins = Math.round(abs % 60);
    if (doIso) {
        return sign + padStart(hours, 2) + ":" + padStart(mins, 2);
    }
    return "GMT" + sign + hours + (mins ? ":" + padStart(mins, 2) : '');
}

// TODO: new util arrayify?
function removeExact(array, exactVal) {
    var removeCnt = 0;
    var i = 0;
    while (i < array.length) {
        if (array[i] === exactVal) {
            array.splice(i, 1);
            removeCnt += 1;
        }
        else {
            i += 1;
        }
    }
    return removeCnt;
}
function isArraysEqual(a0, a1, equalityFunc) {
    if (a0 === a1) {
        return true;
    }
    var len = a0.length;
    var i;
    if (len !== a1.length) { // not array? or not same length?
        return false;
    }
    for (i = 0; i < len; i += 1) {
        if (!(equalityFunc ? equalityFunc(a0[i], a1[i]) : a0[i] === a1[i])) {
            return false;
        }
    }
    return true;
}

function memoize(workerFunc, resEquality, teardownFunc) {
    var currentArgs;
    var currentRes;
    return function () {
        var newArgs = [];
        for (var _i = 0; _i < arguments.length; _i++) {
            newArgs[_i] = arguments[_i];
        }
        if (!currentArgs) {
            currentRes = workerFunc.apply(this, newArgs);
        }
        else if (!isArraysEqual(currentArgs, newArgs)) {
            if (teardownFunc) {
                teardownFunc(currentRes);
            }
            var res = workerFunc.apply(this, newArgs);
            if (!resEquality || !resEquality(res, currentRes)) {
                currentRes = res;
            }
        }
        currentArgs = newArgs;
        return currentRes;
    };
}
function memoizeObjArg(workerFunc, resEquality, teardownFunc) {
    var _this = this;
    var currentArg;
    var currentRes;
    return function (newArg) {
        if (!currentArg) {
            currentRes = workerFunc.call(_this, newArg);
        }
        else if (!isPropsEqual(currentArg, newArg)) {
            if (teardownFunc) {
                teardownFunc(currentRes);
            }
            var res = workerFunc.call(_this, newArg);
            if (!resEquality || !resEquality(res, currentRes)) {
                currentRes = res;
            }
        }
        currentArg = newArg;
        return currentRes;
    };
}
function memoizeArraylike(// used at all?
workerFunc, resEquality, teardownFunc) {
    var _this = this;
    var currentArgSets = [];
    var currentResults = [];
    return function (newArgSets) {
        var currentLen = currentArgSets.length;
        var newLen = newArgSets.length;
        var i = 0;
        for (; i < currentLen; i += 1) {
            if (!newArgSets[i]) { // one of the old sets no longer exists
                if (teardownFunc) {
                    teardownFunc(currentResults[i]);
                }
            }
            else if (!isArraysEqual(currentArgSets[i], newArgSets[i])) {
                if (teardownFunc) {
                    teardownFunc(currentResults[i]);
                }
                var res = workerFunc.apply(_this, newArgSets[i]);
                if (!resEquality || !resEquality(res, currentResults[i])) {
                    currentResults[i] = res;
                }
            }
        }
        for (; i < newLen; i += 1) {
            currentResults[i] = workerFunc.apply(_this, newArgSets[i]);
        }
        currentArgSets = newArgSets;
        currentResults.splice(newLen); // remove excess
        return currentResults;
    };
}
function memoizeHashlike(workerFunc, resEquality, teardownFunc) {
    var _this = this;
    var currentArgHash = {};
    var currentResHash = {};
    return function (newArgHash) {
        var newResHash = {};
        for (var key in newArgHash) {
            if (!currentResHash[key]) {
                newResHash[key] = workerFunc.apply(_this, newArgHash[key]);
            }
            else if (!isArraysEqual(currentArgHash[key], newArgHash[key])) {
                if (teardownFunc) {
                    teardownFunc(currentResHash[key]);
                }
                var res = workerFunc.apply(_this, newArgHash[key]);
                newResHash[key] = (resEquality && resEquality(res, currentResHash[key]))
                    ? currentResHash[key]
                    : res;
            }
            else {
                newResHash[key] = currentResHash[key];
            }
        }
        currentArgHash = newArgHash;
        currentResHash = newResHash;
        return newResHash;
    };
}

var EXTENDED_SETTINGS_AND_SEVERITIES = {
    week: 3,
    separator: 0,
    omitZeroMinute: 0,
    meridiem: 0,
    omitCommas: 0,
};
var STANDARD_DATE_PROP_SEVERITIES = {
    timeZoneName: 7,
    era: 6,
    year: 5,
    month: 4,
    day: 2,
    weekday: 2,
    hour: 1,
    minute: 1,
    second: 1,
};
var MERIDIEM_RE = /\s*([ap])\.?m\.?/i; // eats up leading spaces too
var COMMA_RE = /,/g; // we need re for globalness
var MULTI_SPACE_RE = /\s+/g;
var LTR_RE = /\u200e/g; // control character
var UTC_RE = /UTC|GMT/;
var NativeFormatter = /** @class */ (function () {
    function NativeFormatter(formatSettings) {
        var standardDateProps = {};
        var extendedSettings = {};
        var severity = 0;
        for (var name_1 in formatSettings) {
            if (name_1 in EXTENDED_SETTINGS_AND_SEVERITIES) {
                extendedSettings[name_1] = formatSettings[name_1];
                severity = Math.max(EXTENDED_SETTINGS_AND_SEVERITIES[name_1], severity);
            }
            else {
                standardDateProps[name_1] = formatSettings[name_1];
                if (name_1 in STANDARD_DATE_PROP_SEVERITIES) { // TODO: what about hour12? no severity
                    severity = Math.max(STANDARD_DATE_PROP_SEVERITIES[name_1], severity);
                }
            }
        }
        this.standardDateProps = standardDateProps;
        this.extendedSettings = extendedSettings;
        this.severity = severity;
        this.buildFormattingFunc = memoize(buildFormattingFunc);
    }
    NativeFormatter.prototype.format = function (date, context) {
        return this.buildFormattingFunc(this.standardDateProps, this.extendedSettings, context)(date);
    };
    NativeFormatter.prototype.formatRange = function (start, end, context, betterDefaultSeparator) {
        var _a = this, standardDateProps = _a.standardDateProps, extendedSettings = _a.extendedSettings;
        var diffSeverity = computeMarkerDiffSeverity(start.marker, end.marker, context.calendarSystem);
        if (!diffSeverity) {
            return this.format(start, context);
        }
        var biggestUnitForPartial = diffSeverity;
        if (biggestUnitForPartial > 1 && // the two dates are different in a way that's larger scale than time
            (standardDateProps.year === 'numeric' || standardDateProps.year === '2-digit') &&
            (standardDateProps.month === 'numeric' || standardDateProps.month === '2-digit') &&
            (standardDateProps.day === 'numeric' || standardDateProps.day === '2-digit')) {
            biggestUnitForPartial = 1; // make it look like the dates are only different in terms of time
        }
        var full0 = this.format(start, context);
        var full1 = this.format(end, context);
        if (full0 === full1) {
            return full0;
        }
        var partialDateProps = computePartialFormattingOptions(standardDateProps, biggestUnitForPartial);
        var partialFormattingFunc = buildFormattingFunc(partialDateProps, extendedSettings, context);
        var partial0 = partialFormattingFunc(start);
        var partial1 = partialFormattingFunc(end);
        var insertion = findCommonInsertion(full0, partial0, full1, partial1);
        var separator = extendedSettings.separator || betterDefaultSeparator || context.defaultSeparator || '';
        if (insertion) {
            return insertion.before + partial0 + separator + partial1 + insertion.after;
        }
        return full0 + separator + full1;
    };
    NativeFormatter.prototype.getLargestUnit = function () {
        switch (this.severity) {
            case 7:
            case 6:
            case 5:
                return 'year';
            case 4:
                return 'month';
            case 3:
                return 'week';
            case 2:
                return 'day';
            default:
                return 'time'; // really?
        }
    };
    return NativeFormatter;
}());
function buildFormattingFunc(standardDateProps, extendedSettings, context) {
    var standardDatePropCnt = Object.keys(standardDateProps).length;
    if (standardDatePropCnt === 1 && standardDateProps.timeZoneName === 'short') {
        return function (date) { return (formatTimeZoneOffset(date.timeZoneOffset)); };
    }
    if (standardDatePropCnt === 0 && extendedSettings.week) {
        return function (date) { return (formatWeekNumber(context.computeWeekNumber(date.marker), context.weekText, context.weekTextLong, context.locale, extendedSettings.week)); };
    }
    return buildNativeFormattingFunc(standardDateProps, extendedSettings, context);
}
function buildNativeFormattingFunc(standardDateProps, extendedSettings, context) {
    standardDateProps = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, standardDateProps); // copy
    extendedSettings = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, extendedSettings); // copy
    sanitizeSettings(standardDateProps, extendedSettings);
    standardDateProps.timeZone = 'UTC'; // we leverage the only guaranteed timeZone for our UTC markers
    var normalFormat = new Intl.DateTimeFormat(context.locale.codes, standardDateProps);
    var zeroFormat; // needed?
    if (extendedSettings.omitZeroMinute) {
        var zeroProps = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, standardDateProps);
        delete zeroProps.minute; // seconds and ms were already considered in sanitizeSettings
        zeroFormat = new Intl.DateTimeFormat(context.locale.codes, zeroProps);
    }
    return function (date) {
        var marker = date.marker;
        var format;
        if (zeroFormat && !marker.getUTCMinutes()) {
            format = zeroFormat;
        }
        else {
            format = normalFormat;
        }
        var s = format.format(marker);
        return postProcess(s, date, standardDateProps, extendedSettings, context);
    };
}
function sanitizeSettings(standardDateProps, extendedSettings) {
    // deal with a browser inconsistency where formatting the timezone
    // requires that the hour/minute be present.
    if (standardDateProps.timeZoneName) {
        if (!standardDateProps.hour) {
            standardDateProps.hour = '2-digit';
        }
        if (!standardDateProps.minute) {
            standardDateProps.minute = '2-digit';
        }
    }
    // only support short timezone names
    if (standardDateProps.timeZoneName === 'long') {
        standardDateProps.timeZoneName = 'short';
    }
    // if requesting to display seconds, MUST display minutes
    if (extendedSettings.omitZeroMinute && (standardDateProps.second || standardDateProps.millisecond)) {
        delete extendedSettings.omitZeroMinute;
    }
}
function postProcess(s, date, standardDateProps, extendedSettings, context) {
    s = s.replace(LTR_RE, ''); // remove left-to-right control chars. do first. good for other regexes
    if (standardDateProps.timeZoneName === 'short') {
        s = injectTzoStr(s, (context.timeZone === 'UTC' || date.timeZoneOffset == null) ?
            'UTC' : // important to normalize for IE, which does "GMT"
            formatTimeZoneOffset(date.timeZoneOffset));
    }
    if (extendedSettings.omitCommas) {
        s = s.replace(COMMA_RE, '').trim();
    }
    if (extendedSettings.omitZeroMinute) {
        s = s.replace(':00', ''); // zeroFormat doesn't always achieve this
    }
    // ^ do anything that might create adjacent spaces before this point,
    // because MERIDIEM_RE likes to eat up loading spaces
    if (extendedSettings.meridiem === false) {
        s = s.replace(MERIDIEM_RE, '').trim();
    }
    else if (extendedSettings.meridiem === 'narrow') { // a/p
        s = s.replace(MERIDIEM_RE, function (m0, m1) { return m1.toLocaleLowerCase(); });
    }
    else if (extendedSettings.meridiem === 'short') { // am/pm
        s = s.replace(MERIDIEM_RE, function (m0, m1) { return m1.toLocaleLowerCase() + "m"; });
    }
    else if (extendedSettings.meridiem === 'lowercase') { // other meridiem transformers already converted to lowercase
        s = s.replace(MERIDIEM_RE, function (m0) { return m0.toLocaleLowerCase(); });
    }
    s = s.replace(MULTI_SPACE_RE, ' ');
    s = s.trim();
    return s;
}
function injectTzoStr(s, tzoStr) {
    var replaced = false;
    s = s.replace(UTC_RE, function () {
        replaced = true;
        return tzoStr;
    });
    // IE11 doesn't include UTC/GMT in the original string, so append to end
    if (!replaced) {
        s += " " + tzoStr;
    }
    return s;
}
function formatWeekNumber(num, weekText, weekTextLong, locale, display) {
    var parts = [];
    if (display === 'long') {
        parts.push(weekTextLong);
    }
    else if (display === 'short' || display === 'narrow') {
        parts.push(weekText);
    }
    if (display === 'long' || display === 'short') {
        parts.push(' ');
    }
    parts.push(locale.simpleNumberFormat.format(num));
    if (locale.options.direction === 'rtl') { // TODO: use control characters instead?
        parts.reverse();
    }
    return parts.join('');
}
// Range Formatting Utils
// 0 = exactly the same
// 1 = different by time
// and bigger
function computeMarkerDiffSeverity(d0, d1, ca) {
    if (ca.getMarkerYear(d0) !== ca.getMarkerYear(d1)) {
        return 5;
    }
    if (ca.getMarkerMonth(d0) !== ca.getMarkerMonth(d1)) {
        return 4;
    }
    if (ca.getMarkerDay(d0) !== ca.getMarkerDay(d1)) {
        return 2;
    }
    if (timeAsMs(d0) !== timeAsMs(d1)) {
        return 1;
    }
    return 0;
}
function computePartialFormattingOptions(options, biggestUnit) {
    var partialOptions = {};
    for (var name_2 in options) {
        if (!(name_2 in STANDARD_DATE_PROP_SEVERITIES) || // not a date part prop (like timeZone)
            STANDARD_DATE_PROP_SEVERITIES[name_2] <= biggestUnit) {
            partialOptions[name_2] = options[name_2];
        }
    }
    return partialOptions;
}
function findCommonInsertion(full0, partial0, full1, partial1) {
    var i0 = 0;
    while (i0 < full0.length) {
        var found0 = full0.indexOf(partial0, i0);
        if (found0 === -1) {
            break;
        }
        var before0 = full0.substr(0, found0);
        i0 = found0 + partial0.length;
        var after0 = full0.substr(i0);
        var i1 = 0;
        while (i1 < full1.length) {
            var found1 = full1.indexOf(partial1, i1);
            if (found1 === -1) {
                break;
            }
            var before1 = full1.substr(0, found1);
            i1 = found1 + partial1.length;
            var after1 = full1.substr(i1);
            if (before0 === before1 && after0 === after1) {
                return {
                    before: before0,
                    after: after0,
                };
            }
        }
    }
    return null;
}

function expandZonedMarker(dateInfo, calendarSystem) {
    var a = calendarSystem.markerToArray(dateInfo.marker);
    return {
        marker: dateInfo.marker,
        timeZoneOffset: dateInfo.timeZoneOffset,
        array: a,
        year: a[0],
        month: a[1],
        day: a[2],
        hour: a[3],
        minute: a[4],
        second: a[5],
        millisecond: a[6],
    };
}

function createVerboseFormattingArg(start, end, context, betterDefaultSeparator) {
    var startInfo = expandZonedMarker(start, context.calendarSystem);
    var endInfo = end ? expandZonedMarker(end, context.calendarSystem) : null;
    return {
        date: startInfo,
        start: startInfo,
        end: endInfo,
        timeZone: context.timeZone,
        localeCodes: context.locale.codes,
        defaultSeparator: betterDefaultSeparator || context.defaultSeparator,
    };
}

/*
TODO: fix the terminology of "formatter" vs "formatting func"
*/
/*
At the time of instantiation, this object does not know which cmd-formatting system it will use.
It receives this at the time of formatting, as a setting.
*/
var CmdFormatter = /** @class */ (function () {
    function CmdFormatter(cmdStr) {
        this.cmdStr = cmdStr;
    }
    CmdFormatter.prototype.format = function (date, context, betterDefaultSeparator) {
        return context.cmdFormatter(this.cmdStr, createVerboseFormattingArg(date, null, context, betterDefaultSeparator));
    };
    CmdFormatter.prototype.formatRange = function (start, end, context, betterDefaultSeparator) {
        return context.cmdFormatter(this.cmdStr, createVerboseFormattingArg(start, end, context, betterDefaultSeparator));
    };
    return CmdFormatter;
}());

var FuncFormatter = /** @class */ (function () {
    function FuncFormatter(func) {
        this.func = func;
    }
    FuncFormatter.prototype.format = function (date, context, betterDefaultSeparator) {
        return this.func(createVerboseFormattingArg(date, null, context, betterDefaultSeparator));
    };
    FuncFormatter.prototype.formatRange = function (start, end, context, betterDefaultSeparator) {
        return this.func(createVerboseFormattingArg(start, end, context, betterDefaultSeparator));
    };
    return FuncFormatter;
}());

function createFormatter(input) {
    if (typeof input === 'object' && input) { // non-null object
        return new NativeFormatter(input);
    }
    if (typeof input === 'string') {
        return new CmdFormatter(input);
    }
    if (typeof input === 'function') {
        return new FuncFormatter(input);
    }
    return null;
}

// base options
// ------------
var BASE_OPTION_REFINERS = {
    navLinkDayClick: identity,
    navLinkWeekClick: identity,
    duration: createDuration,
    bootstrapFontAwesome: identity,
    buttonIcons: identity,
    customButtons: identity,
    defaultAllDayEventDuration: createDuration,
    defaultTimedEventDuration: createDuration,
    nextDayThreshold: createDuration,
    scrollTime: createDuration,
    scrollTimeReset: Boolean,
    slotMinTime: createDuration,
    slotMaxTime: createDuration,
    dayPopoverFormat: createFormatter,
    slotDuration: createDuration,
    snapDuration: createDuration,
    headerToolbar: identity,
    footerToolbar: identity,
    defaultRangeSeparator: String,
    titleRangeSeparator: String,
    forceEventDuration: Boolean,
    dayHeaders: Boolean,
    dayHeaderFormat: createFormatter,
    dayHeaderClassNames: identity,
    dayHeaderContent: identity,
    dayHeaderDidMount: identity,
    dayHeaderWillUnmount: identity,
    dayCellClassNames: identity,
    dayCellContent: identity,
    dayCellDidMount: identity,
    dayCellWillUnmount: identity,
    initialView: String,
    aspectRatio: Number,
    weekends: Boolean,
    weekNumberCalculation: identity,
    weekNumbers: Boolean,
    weekNumberClassNames: identity,
    weekNumberContent: identity,
    weekNumberDidMount: identity,
    weekNumberWillUnmount: identity,
    editable: Boolean,
    viewClassNames: identity,
    viewDidMount: identity,
    viewWillUnmount: identity,
    nowIndicator: Boolean,
    nowIndicatorClassNames: identity,
    nowIndicatorContent: identity,
    nowIndicatorDidMount: identity,
    nowIndicatorWillUnmount: identity,
    showNonCurrentDates: Boolean,
    lazyFetching: Boolean,
    startParam: String,
    endParam: String,
    timeZoneParam: String,
    timeZone: String,
    locales: identity,
    locale: identity,
    themeSystem: String,
    dragRevertDuration: Number,
    dragScroll: Boolean,
    allDayMaintainDuration: Boolean,
    unselectAuto: Boolean,
    dropAccept: identity,
    eventOrder: parseFieldSpecs,
    eventOrderStrict: Boolean,
    handleWindowResize: Boolean,
    windowResizeDelay: Number,
    longPressDelay: Number,
    eventDragMinDistance: Number,
    expandRows: Boolean,
    height: identity,
    contentHeight: identity,
    direction: String,
    weekNumberFormat: createFormatter,
    eventResizableFromStart: Boolean,
    displayEventTime: Boolean,
    displayEventEnd: Boolean,
    weekText: String,
    weekTextLong: String,
    progressiveEventRendering: Boolean,
    businessHours: identity,
    initialDate: identity,
    now: identity,
    eventDataTransform: identity,
    stickyHeaderDates: identity,
    stickyFooterScrollbar: identity,
    viewHeight: identity,
    defaultAllDay: Boolean,
    eventSourceFailure: identity,
    eventSourceSuccess: identity,
    eventDisplay: String,
    eventStartEditable: Boolean,
    eventDurationEditable: Boolean,
    eventOverlap: identity,
    eventConstraint: identity,
    eventAllow: identity,
    eventBackgroundColor: String,
    eventBorderColor: String,
    eventTextColor: String,
    eventColor: String,
    eventClassNames: identity,
    eventContent: identity,
    eventDidMount: identity,
    eventWillUnmount: identity,
    selectConstraint: identity,
    selectOverlap: identity,
    selectAllow: identity,
    droppable: Boolean,
    unselectCancel: String,
    slotLabelFormat: identity,
    slotLaneClassNames: identity,
    slotLaneContent: identity,
    slotLaneDidMount: identity,
    slotLaneWillUnmount: identity,
    slotLabelClassNames: identity,
    slotLabelContent: identity,
    slotLabelDidMount: identity,
    slotLabelWillUnmount: identity,
    dayMaxEvents: identity,
    dayMaxEventRows: identity,
    dayMinWidth: Number,
    slotLabelInterval: createDuration,
    allDayText: String,
    allDayClassNames: identity,
    allDayContent: identity,
    allDayDidMount: identity,
    allDayWillUnmount: identity,
    slotMinWidth: Number,
    navLinks: Boolean,
    eventTimeFormat: createFormatter,
    rerenderDelay: Number,
    moreLinkText: identity,
    moreLinkHint: identity,
    selectMinDistance: Number,
    selectable: Boolean,
    selectLongPressDelay: Number,
    eventLongPressDelay: Number,
    selectMirror: Boolean,
    eventMaxStack: Number,
    eventMinHeight: Number,
    eventMinWidth: Number,
    eventShortHeight: Number,
    slotEventOverlap: Boolean,
    plugins: identity,
    firstDay: Number,
    dayCount: Number,
    dateAlignment: String,
    dateIncrement: createDuration,
    hiddenDays: identity,
    monthMode: Boolean,
    fixedWeekCount: Boolean,
    validRange: identity,
    visibleRange: identity,
    titleFormat: identity,
    eventInteractive: Boolean,
    // only used by list-view, but languages define the value, so we need it in base options
    noEventsText: String,
    viewHint: identity,
    navLinkHint: identity,
    closeHint: String,
    timeHint: String,
    eventHint: String,
    moreLinkClick: identity,
    moreLinkClassNames: identity,
    moreLinkContent: identity,
    moreLinkDidMount: identity,
    moreLinkWillUnmount: identity,
};
// do NOT give a type here. need `typeof BASE_OPTION_DEFAULTS` to give real results.
// raw values.
var BASE_OPTION_DEFAULTS = {
    eventDisplay: 'auto',
    defaultRangeSeparator: ' - ',
    titleRangeSeparator: ' \u2013 ',
    defaultTimedEventDuration: '01:00:00',
    defaultAllDayEventDuration: { day: 1 },
    forceEventDuration: false,
    nextDayThreshold: '00:00:00',
    dayHeaders: true,
    initialView: '',
    aspectRatio: 1.35,
    headerToolbar: {
        start: 'title',
        center: '',
        end: 'today prev,next',
    },
    weekends: true,
    weekNumbers: false,
    weekNumberCalculation: 'local',
    editable: false,
    nowIndicator: false,
    scrollTime: '06:00:00',
    scrollTimeReset: true,
    slotMinTime: '00:00:00',
    slotMaxTime: '24:00:00',
    showNonCurrentDates: true,
    lazyFetching: true,
    startParam: 'start',
    endParam: 'end',
    timeZoneParam: 'timeZone',
    timeZone: 'local',
    locales: [],
    locale: '',
    themeSystem: 'standard',
    dragRevertDuration: 500,
    dragScroll: true,
    allDayMaintainDuration: false,
    unselectAuto: true,
    dropAccept: '*',
    eventOrder: 'start,-duration,allDay,title',
    dayPopoverFormat: { month: 'long', day: 'numeric', year: 'numeric' },
    handleWindowResize: true,
    windowResizeDelay: 100,
    longPressDelay: 1000,
    eventDragMinDistance: 5,
    expandRows: false,
    navLinks: false,
    selectable: false,
    eventMinHeight: 15,
    eventMinWidth: 30,
    eventShortHeight: 30,
};
// calendar listeners
// ------------------
var CALENDAR_LISTENER_REFINERS = {
    datesSet: identity,
    eventsSet: identity,
    eventAdd: identity,
    eventChange: identity,
    eventRemove: identity,
    windowResize: identity,
    eventClick: identity,
    eventMouseEnter: identity,
    eventMouseLeave: identity,
    select: identity,
    unselect: identity,
    loading: identity,
    // internal
    _unmount: identity,
    _beforeprint: identity,
    _afterprint: identity,
    _noEventDrop: identity,
    _noEventResize: identity,
    _resize: identity,
    _scrollRequest: identity,
};
// calendar-specific options
// -------------------------
var CALENDAR_OPTION_REFINERS = {
    buttonText: identity,
    buttonHints: identity,
    views: identity,
    plugins: identity,
    initialEvents: identity,
    events: identity,
    eventSources: identity,
};
var COMPLEX_OPTION_COMPARATORS = {
    headerToolbar: isMaybeObjectsEqual,
    footerToolbar: isMaybeObjectsEqual,
    buttonText: isMaybeObjectsEqual,
    buttonHints: isMaybeObjectsEqual,
    buttonIcons: isMaybeObjectsEqual,
    dateIncrement: isMaybeObjectsEqual,
};
function isMaybeObjectsEqual(a, b) {
    if (typeof a === 'object' && typeof b === 'object' && a && b) { // both non-null objects
        return isPropsEqual(a, b);
    }
    return a === b;
}
// view-specific options
// ---------------------
var VIEW_OPTION_REFINERS = {
    type: String,
    component: identity,
    buttonText: String,
    buttonTextKey: String,
    dateProfileGeneratorClass: identity,
    usesMinMaxTime: Boolean,
    classNames: identity,
    content: identity,
    didMount: identity,
    willUnmount: identity,
};
// util funcs
// ----------------------------------------------------------------------------------------------------
function mergeRawOptions(optionSets) {
    return mergeProps(optionSets, COMPLEX_OPTION_COMPARATORS);
}
function refineProps(input, refiners) {
    var refined = {};
    var extra = {};
    for (var propName in refiners) {
        if (propName in input) {
            refined[propName] = refiners[propName](input[propName]);
        }
    }
    for (var propName in input) {
        if (!(propName in refiners)) {
            extra[propName] = input[propName];
        }
    }
    return { refined: refined, extra: extra };
}
function identity(raw) {
    return raw;
}

function parseEvents(rawEvents, eventSource, context, allowOpenRange) {
    var eventStore = createEmptyEventStore();
    var eventRefiners = buildEventRefiners(context);
    for (var _i = 0, rawEvents_1 = rawEvents; _i < rawEvents_1.length; _i++) {
        var rawEvent = rawEvents_1[_i];
        var tuple = parseEvent(rawEvent, eventSource, context, allowOpenRange, eventRefiners);
        if (tuple) {
            eventTupleToStore(tuple, eventStore);
        }
    }
    return eventStore;
}
function eventTupleToStore(tuple, eventStore) {
    if (eventStore === void 0) { eventStore = createEmptyEventStore(); }
    eventStore.defs[tuple.def.defId] = tuple.def;
    if (tuple.instance) {
        eventStore.instances[tuple.instance.instanceId] = tuple.instance;
    }
    return eventStore;
}
// retrieves events that have the same groupId as the instance specified by `instanceId`
// or they are the same as the instance.
// why might instanceId not be in the store? an event from another calendar?
function getRelevantEvents(eventStore, instanceId) {
    var instance = eventStore.instances[instanceId];
    if (instance) {
        var def_1 = eventStore.defs[instance.defId];
        // get events/instances with same group
        var newStore = filterEventStoreDefs(eventStore, function (lookDef) { return isEventDefsGrouped(def_1, lookDef); });
        // add the original
        // TODO: wish we could use eventTupleToStore or something like it
        newStore.defs[def_1.defId] = def_1;
        newStore.instances[instance.instanceId] = instance;
        return newStore;
    }
    return createEmptyEventStore();
}
function isEventDefsGrouped(def0, def1) {
    return Boolean(def0.groupId && def0.groupId === def1.groupId);
}
function createEmptyEventStore() {
    return { defs: {}, instances: {} };
}
function mergeEventStores(store0, store1) {
    return {
        defs: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, store0.defs), store1.defs),
        instances: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, store0.instances), store1.instances),
    };
}
function filterEventStoreDefs(eventStore, filterFunc) {
    var defs = filterHash(eventStore.defs, filterFunc);
    var instances = filterHash(eventStore.instances, function (instance) { return (defs[instance.defId] // still exists?
    ); });
    return { defs: defs, instances: instances };
}
function excludeSubEventStore(master, sub) {
    var defs = master.defs, instances = master.instances;
    var filteredDefs = {};
    var filteredInstances = {};
    for (var defId in defs) {
        if (!sub.defs[defId]) { // not explicitly excluded
            filteredDefs[defId] = defs[defId];
        }
    }
    for (var instanceId in instances) {
        if (!sub.instances[instanceId] && // not explicitly excluded
            filteredDefs[instances[instanceId].defId] // def wasn't filtered away
        ) {
            filteredInstances[instanceId] = instances[instanceId];
        }
    }
    return {
        defs: filteredDefs,
        instances: filteredInstances,
    };
}

function normalizeConstraint(input, context) {
    if (Array.isArray(input)) {
        return parseEvents(input, null, context, true); // allowOpenRange=true
    }
    if (typeof input === 'object' && input) { // non-null object
        return parseEvents([input], null, context, true); // allowOpenRange=true
    }
    if (input != null) {
        return String(input);
    }
    return null;
}

function parseClassNames(raw) {
    if (Array.isArray(raw)) {
        return raw;
    }
    if (typeof raw === 'string') {
        return raw.split(/\s+/);
    }
    return [];
}

// TODO: better called "EventSettings" or "EventConfig"
// TODO: move this file into structs
// TODO: separate constraint/overlap/allow, because selection uses only that, not other props
var EVENT_UI_REFINERS = {
    display: String,
    editable: Boolean,
    startEditable: Boolean,
    durationEditable: Boolean,
    constraint: identity,
    overlap: identity,
    allow: identity,
    className: parseClassNames,
    classNames: parseClassNames,
    color: String,
    backgroundColor: String,
    borderColor: String,
    textColor: String,
};
var EMPTY_EVENT_UI = {
    display: null,
    startEditable: null,
    durationEditable: null,
    constraints: [],
    overlap: null,
    allows: [],
    backgroundColor: '',
    borderColor: '',
    textColor: '',
    classNames: [],
};
function createEventUi(refined, context) {
    var constraint = normalizeConstraint(refined.constraint, context);
    return {
        display: refined.display || null,
        startEditable: refined.startEditable != null ? refined.startEditable : refined.editable,
        durationEditable: refined.durationEditable != null ? refined.durationEditable : refined.editable,
        constraints: constraint != null ? [constraint] : [],
        overlap: refined.overlap != null ? refined.overlap : null,
        allows: refined.allow != null ? [refined.allow] : [],
        backgroundColor: refined.backgroundColor || refined.color || '',
        borderColor: refined.borderColor || refined.color || '',
        textColor: refined.textColor || '',
        classNames: (refined.className || []).concat(refined.classNames || []), // join singular and plural
    };
}
// TODO: prevent against problems with <2 args!
function combineEventUis(uis) {
    return uis.reduce(combineTwoEventUis, EMPTY_EVENT_UI);
}
function combineTwoEventUis(item0, item1) {
    return {
        display: item1.display != null ? item1.display : item0.display,
        startEditable: item1.startEditable != null ? item1.startEditable : item0.startEditable,
        durationEditable: item1.durationEditable != null ? item1.durationEditable : item0.durationEditable,
        constraints: item0.constraints.concat(item1.constraints),
        overlap: typeof item1.overlap === 'boolean' ? item1.overlap : item0.overlap,
        allows: item0.allows.concat(item1.allows),
        backgroundColor: item1.backgroundColor || item0.backgroundColor,
        borderColor: item1.borderColor || item0.borderColor,
        textColor: item1.textColor || item0.textColor,
        classNames: item0.classNames.concat(item1.classNames),
    };
}

var EVENT_NON_DATE_REFINERS = {
    id: String,
    groupId: String,
    title: String,
    url: String,
    interactive: Boolean,
};
var EVENT_DATE_REFINERS = {
    start: identity,
    end: identity,
    date: identity,
    allDay: Boolean,
};
var EVENT_REFINERS = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, EVENT_NON_DATE_REFINERS), EVENT_DATE_REFINERS), { extendedProps: identity });
function parseEvent(raw, eventSource, context, allowOpenRange, refiners) {
    if (refiners === void 0) { refiners = buildEventRefiners(context); }
    var _a = refineEventDef(raw, context, refiners), refined = _a.refined, extra = _a.extra;
    var defaultAllDay = computeIsDefaultAllDay(eventSource, context);
    var recurringRes = parseRecurring(refined, defaultAllDay, context.dateEnv, context.pluginHooks.recurringTypes);
    if (recurringRes) {
        var def = parseEventDef(refined, extra, eventSource ? eventSource.sourceId : '', recurringRes.allDay, Boolean(recurringRes.duration), context);
        def.recurringDef = {
            typeId: recurringRes.typeId,
            typeData: recurringRes.typeData,
            duration: recurringRes.duration,
        };
        return { def: def, instance: null };
    }
    var singleRes = parseSingle(refined, defaultAllDay, context, allowOpenRange);
    if (singleRes) {
        var def = parseEventDef(refined, extra, eventSource ? eventSource.sourceId : '', singleRes.allDay, singleRes.hasEnd, context);
        var instance = createEventInstance(def.defId, singleRes.range, singleRes.forcedStartTzo, singleRes.forcedEndTzo);
        return { def: def, instance: instance };
    }
    return null;
}
function refineEventDef(raw, context, refiners) {
    if (refiners === void 0) { refiners = buildEventRefiners(context); }
    return refineProps(raw, refiners);
}
function buildEventRefiners(context) {
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, EVENT_UI_REFINERS), EVENT_REFINERS), context.pluginHooks.eventRefiners);
}
/*
Will NOT populate extendedProps with the leftover properties.
Will NOT populate date-related props.
*/
function parseEventDef(refined, extra, sourceId, allDay, hasEnd, context) {
    var def = {
        title: refined.title || '',
        groupId: refined.groupId || '',
        publicId: refined.id || '',
        url: refined.url || '',
        recurringDef: null,
        defId: guid(),
        sourceId: sourceId,
        allDay: allDay,
        hasEnd: hasEnd,
        interactive: refined.interactive,
        ui: createEventUi(refined, context),
        extendedProps: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, (refined.extendedProps || {})), extra),
    };
    for (var _i = 0, _a = context.pluginHooks.eventDefMemberAdders; _i < _a.length; _i++) {
        var memberAdder = _a[_i];
        (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(def, memberAdder(refined));
    }
    // help out EventApi from having user modify props
    Object.freeze(def.ui.classNames);
    Object.freeze(def.extendedProps);
    return def;
}
function parseSingle(refined, defaultAllDay, context, allowOpenRange) {
    var allDay = refined.allDay;
    var startMeta;
    var startMarker = null;
    var hasEnd = false;
    var endMeta;
    var endMarker = null;
    var startInput = refined.start != null ? refined.start : refined.date;
    startMeta = context.dateEnv.createMarkerMeta(startInput);
    if (startMeta) {
        startMarker = startMeta.marker;
    }
    else if (!allowOpenRange) {
        return null;
    }
    if (refined.end != null) {
        endMeta = context.dateEnv.createMarkerMeta(refined.end);
    }
    if (allDay == null) {
        if (defaultAllDay != null) {
            allDay = defaultAllDay;
        }
        else {
            // fall back to the date props LAST
            allDay = (!startMeta || startMeta.isTimeUnspecified) &&
                (!endMeta || endMeta.isTimeUnspecified);
        }
    }
    if (allDay && startMarker) {
        startMarker = startOfDay(startMarker);
    }
    if (endMeta) {
        endMarker = endMeta.marker;
        if (allDay) {
            endMarker = startOfDay(endMarker);
        }
        if (startMarker && endMarker <= startMarker) {
            endMarker = null;
        }
    }
    if (endMarker) {
        hasEnd = true;
    }
    else if (!allowOpenRange) {
        hasEnd = context.options.forceEventDuration || false;
        endMarker = context.dateEnv.add(startMarker, allDay ?
            context.options.defaultAllDayEventDuration :
            context.options.defaultTimedEventDuration);
    }
    return {
        allDay: allDay,
        hasEnd: hasEnd,
        range: { start: startMarker, end: endMarker },
        forcedStartTzo: startMeta ? startMeta.forcedTzo : null,
        forcedEndTzo: endMeta ? endMeta.forcedTzo : null,
    };
}
function computeIsDefaultAllDay(eventSource, context) {
    var res = null;
    if (eventSource) {
        res = eventSource.defaultAllDay;
    }
    if (res == null) {
        res = context.options.defaultAllDay;
    }
    return res;
}

/* Date stuff that doesn't belong in datelib core
----------------------------------------------------------------------------------------------------------------------*/
// given a timed range, computes an all-day range that has the same exact duration,
// but whose start time is aligned with the start of the day.
function computeAlignedDayRange(timedRange) {
    var dayCnt = Math.floor(diffDays(timedRange.start, timedRange.end)) || 1;
    var start = startOfDay(timedRange.start);
    var end = addDays(start, dayCnt);
    return { start: start, end: end };
}
// given a timed range, computes an all-day range based on how for the end date bleeds into the next day
// TODO: give nextDayThreshold a default arg
function computeVisibleDayRange(timedRange, nextDayThreshold) {
    if (nextDayThreshold === void 0) { nextDayThreshold = createDuration(0); }
    var startDay = null;
    var endDay = null;
    if (timedRange.end) {
        endDay = startOfDay(timedRange.end);
        var endTimeMS = timedRange.end.valueOf() - endDay.valueOf(); // # of milliseconds into `endDay`
        // If the end time is actually inclusively part of the next day and is equal to or
        // beyond the next day threshold, adjust the end to be the exclusive end of `endDay`.
        // Otherwise, leaving it as inclusive will cause it to exclude `endDay`.
        if (endTimeMS && endTimeMS >= asRoughMs(nextDayThreshold)) {
            endDay = addDays(endDay, 1);
        }
    }
    if (timedRange.start) {
        startDay = startOfDay(timedRange.start); // the beginning of the day the range starts
        // If end is within `startDay` but not past nextDayThreshold, assign the default duration of one day.
        if (endDay && endDay <= startDay) {
            endDay = addDays(startDay, 1);
        }
    }
    return { start: startDay, end: endDay };
}
// spans from one day into another?
function isMultiDayRange(range) {
    var visibleRange = computeVisibleDayRange(range);
    return diffDays(visibleRange.start, visibleRange.end) > 1;
}
function diffDates(date0, date1, dateEnv, largeUnit) {
    if (largeUnit === 'year') {
        return createDuration(dateEnv.diffWholeYears(date0, date1), 'year');
    }
    if (largeUnit === 'month') {
        return createDuration(dateEnv.diffWholeMonths(date0, date1), 'month');
    }
    return diffDayAndTime(date0, date1); // returns a duration
}

function parseRange(input, dateEnv) {
    var start = null;
    var end = null;
    if (input.start) {
        start = dateEnv.createMarker(input.start);
    }
    if (input.end) {
        end = dateEnv.createMarker(input.end);
    }
    if (!start && !end) {
        return null;
    }
    if (start && end && end < start) {
        return null;
    }
    return { start: start, end: end };
}
// SIDE-EFFECT: will mutate ranges.
// Will return a new array result.
function invertRanges(ranges, constraintRange) {
    var invertedRanges = [];
    var start = constraintRange.start; // the end of the previous range. the start of the new range
    var i;
    var dateRange;
    // ranges need to be in order. required for our date-walking algorithm
    ranges.sort(compareRanges);
    for (i = 0; i < ranges.length; i += 1) {
        dateRange = ranges[i];
        // add the span of time before the event (if there is any)
        if (dateRange.start > start) { // compare millisecond time (skip any ambig logic)
            invertedRanges.push({ start: start, end: dateRange.start });
        }
        if (dateRange.end > start) {
            start = dateRange.end;
        }
    }
    // add the span of time after the last event (if there is any)
    if (start < constraintRange.end) { // compare millisecond time (skip any ambig logic)
        invertedRanges.push({ start: start, end: constraintRange.end });
    }
    return invertedRanges;
}
function compareRanges(range0, range1) {
    return range0.start.valueOf() - range1.start.valueOf(); // earlier ranges go first
}
function intersectRanges(range0, range1) {
    var start = range0.start, end = range0.end;
    var newRange = null;
    if (range1.start !== null) {
        if (start === null) {
            start = range1.start;
        }
        else {
            start = new Date(Math.max(start.valueOf(), range1.start.valueOf()));
        }
    }
    if (range1.end != null) {
        if (end === null) {
            end = range1.end;
        }
        else {
            end = new Date(Math.min(end.valueOf(), range1.end.valueOf()));
        }
    }
    if (start === null || end === null || start < end) {
        newRange = { start: start, end: end };
    }
    return newRange;
}
function rangesEqual(range0, range1) {
    return (range0.start === null ? null : range0.start.valueOf()) === (range1.start === null ? null : range1.start.valueOf()) &&
        (range0.end === null ? null : range0.end.valueOf()) === (range1.end === null ? null : range1.end.valueOf());
}
function rangesIntersect(range0, range1) {
    return (range0.end === null || range1.start === null || range0.end > range1.start) &&
        (range0.start === null || range1.end === null || range0.start < range1.end);
}
function rangeContainsRange(outerRange, innerRange) {
    return (outerRange.start === null || (innerRange.start !== null && innerRange.start >= outerRange.start)) &&
        (outerRange.end === null || (innerRange.end !== null && innerRange.end <= outerRange.end));
}
function rangeContainsMarker(range, date) {
    return (range.start === null || date >= range.start) &&
        (range.end === null || date < range.end);
}
// If the given date is not within the given range, move it inside.
// (If it's past the end, make it one millisecond before the end).
function constrainMarkerToRange(date, range) {
    if (range.start != null && date < range.start) {
        return range.start;
    }
    if (range.end != null && date >= range.end) {
        return new Date(range.end.valueOf() - 1);
    }
    return date;
}

/*
Specifying nextDayThreshold signals that all-day ranges should be sliced.
*/
function sliceEventStore(eventStore, eventUiBases, framingRange, nextDayThreshold) {
    var inverseBgByGroupId = {};
    var inverseBgByDefId = {};
    var defByGroupId = {};
    var bgRanges = [];
    var fgRanges = [];
    var eventUis = compileEventUis(eventStore.defs, eventUiBases);
    for (var defId in eventStore.defs) {
        var def = eventStore.defs[defId];
        var ui = eventUis[def.defId];
        if (ui.display === 'inverse-background') {
            if (def.groupId) {
                inverseBgByGroupId[def.groupId] = [];
                if (!defByGroupId[def.groupId]) {
                    defByGroupId[def.groupId] = def;
                }
            }
            else {
                inverseBgByDefId[defId] = [];
            }
        }
    }
    for (var instanceId in eventStore.instances) {
        var instance = eventStore.instances[instanceId];
        var def = eventStore.defs[instance.defId];
        var ui = eventUis[def.defId];
        var origRange = instance.range;
        var normalRange = (!def.allDay && nextDayThreshold) ?
            computeVisibleDayRange(origRange, nextDayThreshold) :
            origRange;
        var slicedRange = intersectRanges(normalRange, framingRange);
        if (slicedRange) {
            if (ui.display === 'inverse-background') {
                if (def.groupId) {
                    inverseBgByGroupId[def.groupId].push(slicedRange);
                }
                else {
                    inverseBgByDefId[instance.defId].push(slicedRange);
                }
            }
            else if (ui.display !== 'none') {
                (ui.display === 'background' ? bgRanges : fgRanges).push({
                    def: def,
                    ui: ui,
                    instance: instance,
                    range: slicedRange,
                    isStart: normalRange.start && normalRange.start.valueOf() === slicedRange.start.valueOf(),
                    isEnd: normalRange.end && normalRange.end.valueOf() === slicedRange.end.valueOf(),
                });
            }
        }
    }
    for (var groupId in inverseBgByGroupId) { // BY GROUP
        var ranges = inverseBgByGroupId[groupId];
        var invertedRanges = invertRanges(ranges, framingRange);
        for (var _i = 0, invertedRanges_1 = invertedRanges; _i < invertedRanges_1.length; _i++) {
            var invertedRange = invertedRanges_1[_i];
            var def = defByGroupId[groupId];
            var ui = eventUis[def.defId];
            bgRanges.push({
                def: def,
                ui: ui,
                instance: null,
                range: invertedRange,
                isStart: false,
                isEnd: false,
            });
        }
    }
    for (var defId in inverseBgByDefId) {
        var ranges = inverseBgByDefId[defId];
        var invertedRanges = invertRanges(ranges, framingRange);
        for (var _a = 0, invertedRanges_2 = invertedRanges; _a < invertedRanges_2.length; _a++) {
            var invertedRange = invertedRanges_2[_a];
            bgRanges.push({
                def: eventStore.defs[defId],
                ui: eventUis[defId],
                instance: null,
                range: invertedRange,
                isStart: false,
                isEnd: false,
            });
        }
    }
    return { bg: bgRanges, fg: fgRanges };
}
function hasBgRendering(def) {
    return def.ui.display === 'background' || def.ui.display === 'inverse-background';
}
function setElSeg(el, seg) {
    el.fcSeg = seg;
}
function getElSeg(el) {
    return el.fcSeg ||
        el.parentNode.fcSeg || // for the harness
        null;
}
// event ui computation
function compileEventUis(eventDefs, eventUiBases) {
    return mapHash(eventDefs, function (eventDef) { return compileEventUi(eventDef, eventUiBases); });
}
function compileEventUi(eventDef, eventUiBases) {
    var uis = [];
    if (eventUiBases['']) {
        uis.push(eventUiBases['']);
    }
    if (eventUiBases[eventDef.defId]) {
        uis.push(eventUiBases[eventDef.defId]);
    }
    uis.push(eventDef.ui);
    return combineEventUis(uis);
}
function sortEventSegs(segs, eventOrderSpecs) {
    var objs = segs.map(buildSegCompareObj);
    objs.sort(function (obj0, obj1) { return compareByFieldSpecs(obj0, obj1, eventOrderSpecs); });
    return objs.map(function (c) { return c._seg; });
}
// returns a object with all primitive props that can be compared
function buildSegCompareObj(seg) {
    var eventRange = seg.eventRange;
    var eventDef = eventRange.def;
    var range = eventRange.instance ? eventRange.instance.range : eventRange.range;
    var start = range.start ? range.start.valueOf() : 0; // TODO: better support for open-range events
    var end = range.end ? range.end.valueOf() : 0; // "
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, eventDef.extendedProps), eventDef), { id: eventDef.publicId, start: start,
        end: end, duration: end - start, allDay: Number(eventDef.allDay), _seg: seg });
}
function computeSegDraggable(seg, context) {
    var pluginHooks = context.pluginHooks;
    var transformers = pluginHooks.isDraggableTransformers;
    var _a = seg.eventRange, def = _a.def, ui = _a.ui;
    var val = ui.startEditable;
    for (var _i = 0, transformers_1 = transformers; _i < transformers_1.length; _i++) {
        var transformer = transformers_1[_i];
        val = transformer(val, def, ui, context);
    }
    return val;
}
function computeSegStartResizable(seg, context) {
    return seg.isStart && seg.eventRange.ui.durationEditable && context.options.eventResizableFromStart;
}
function computeSegEndResizable(seg, context) {
    return seg.isEnd && seg.eventRange.ui.durationEditable;
}
function buildSegTimeText(seg, timeFormat, context, defaultDisplayEventTime, // defaults to true
defaultDisplayEventEnd, // defaults to true
startOverride, endOverride) {
    var dateEnv = context.dateEnv, options = context.options;
    var displayEventTime = options.displayEventTime, displayEventEnd = options.displayEventEnd;
    var eventDef = seg.eventRange.def;
    var eventInstance = seg.eventRange.instance;
    if (displayEventTime == null) {
        displayEventTime = defaultDisplayEventTime !== false;
    }
    if (displayEventEnd == null) {
        displayEventEnd = defaultDisplayEventEnd !== false;
    }
    var wholeEventStart = eventInstance.range.start;
    var wholeEventEnd = eventInstance.range.end;
    var segStart = startOverride || seg.start || seg.eventRange.range.start;
    var segEnd = endOverride || seg.end || seg.eventRange.range.end;
    var isStartDay = startOfDay(wholeEventStart).valueOf() === startOfDay(segStart).valueOf();
    var isEndDay = startOfDay(addMs(wholeEventEnd, -1)).valueOf() === startOfDay(addMs(segEnd, -1)).valueOf();
    if (displayEventTime && !eventDef.allDay && (isStartDay || isEndDay)) {
        segStart = isStartDay ? wholeEventStart : segStart;
        segEnd = isEndDay ? wholeEventEnd : segEnd;
        if (displayEventEnd && eventDef.hasEnd) {
            return dateEnv.formatRange(segStart, segEnd, timeFormat, {
                forcedStartTzo: startOverride ? null : eventInstance.forcedStartTzo,
                forcedEndTzo: endOverride ? null : eventInstance.forcedEndTzo,
            });
        }
        return dateEnv.format(segStart, timeFormat, {
            forcedTzo: startOverride ? null : eventInstance.forcedStartTzo, // nooooo, same
        });
    }
    return '';
}
function getSegMeta(seg, todayRange, nowDate) {
    var segRange = seg.eventRange.range;
    return {
        isPast: segRange.end < (nowDate || todayRange.start),
        isFuture: segRange.start >= (nowDate || todayRange.end),
        isToday: todayRange && rangeContainsMarker(todayRange, segRange.start),
    };
}
function getEventClassNames(props) {
    var classNames = ['fc-event'];
    if (props.isMirror) {
        classNames.push('fc-event-mirror');
    }
    if (props.isDraggable) {
        classNames.push('fc-event-draggable');
    }
    if (props.isStartResizable || props.isEndResizable) {
        classNames.push('fc-event-resizable');
    }
    if (props.isDragging) {
        classNames.push('fc-event-dragging');
    }
    if (props.isResizing) {
        classNames.push('fc-event-resizing');
    }
    if (props.isSelected) {
        classNames.push('fc-event-selected');
    }
    if (props.isStart) {
        classNames.push('fc-event-start');
    }
    if (props.isEnd) {
        classNames.push('fc-event-end');
    }
    if (props.isPast) {
        classNames.push('fc-event-past');
    }
    if (props.isToday) {
        classNames.push('fc-event-today');
    }
    if (props.isFuture) {
        classNames.push('fc-event-future');
    }
    return classNames;
}
function buildEventRangeKey(eventRange) {
    return eventRange.instance
        ? eventRange.instance.instanceId
        : eventRange.def.defId + ":" + eventRange.range.start.toISOString();
    // inverse-background events don't have specific instances. TODO: better solution
}
function getSegAnchorAttrs(seg, context) {
    var _a = seg.eventRange, def = _a.def, instance = _a.instance;
    var url = def.url;
    if (url) {
        return { href: url };
    }
    var emitter = context.emitter, options = context.options;
    var eventInteractive = options.eventInteractive;
    if (eventInteractive == null) {
        eventInteractive = def.interactive;
        if (eventInteractive == null) {
            eventInteractive = Boolean(emitter.hasHandlers('eventClick'));
        }
    }
    // mock what happens in EventClicking
    if (eventInteractive) {
        // only attach keyboard-related handlers because click handler is already done in EventClicking
        return createAriaKeyboardAttrs(function (ev) {
            emitter.trigger('eventClick', {
                el: ev.target,
                event: new EventApi(context, def, instance),
                jsEvent: ev,
                view: context.viewApi,
            });
        });
    }
    return {};
}

var STANDARD_PROPS = {
    start: identity,
    end: identity,
    allDay: Boolean,
};
function parseDateSpan(raw, dateEnv, defaultDuration) {
    var span = parseOpenDateSpan(raw, dateEnv);
    var range = span.range;
    if (!range.start) {
        return null;
    }
    if (!range.end) {
        if (defaultDuration == null) {
            return null;
        }
        range.end = dateEnv.add(range.start, defaultDuration);
    }
    return span;
}
/*
TODO: somehow combine with parseRange?
Will return null if the start/end props were present but parsed invalidly.
*/
function parseOpenDateSpan(raw, dateEnv) {
    var _a = refineProps(raw, STANDARD_PROPS), standardProps = _a.refined, extra = _a.extra;
    var startMeta = standardProps.start ? dateEnv.createMarkerMeta(standardProps.start) : null;
    var endMeta = standardProps.end ? dateEnv.createMarkerMeta(standardProps.end) : null;
    var allDay = standardProps.allDay;
    if (allDay == null) {
        allDay = (startMeta && startMeta.isTimeUnspecified) &&
            (!endMeta || endMeta.isTimeUnspecified);
    }
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ range: {
            start: startMeta ? startMeta.marker : null,
            end: endMeta ? endMeta.marker : null,
        }, allDay: allDay }, extra);
}
function isDateSpansEqual(span0, span1) {
    return rangesEqual(span0.range, span1.range) &&
        span0.allDay === span1.allDay &&
        isSpanPropsEqual(span0, span1);
}
// the NON-DATE-RELATED props
function isSpanPropsEqual(span0, span1) {
    for (var propName in span1) {
        if (propName !== 'range' && propName !== 'allDay') {
            if (span0[propName] !== span1[propName]) {
                return false;
            }
        }
    }
    // are there any props that span0 has that span1 DOESN'T have?
    // both have range/allDay, so no need to special-case.
    for (var propName in span0) {
        if (!(propName in span1)) {
            return false;
        }
    }
    return true;
}
function buildDateSpanApi(span, dateEnv) {
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, buildRangeApi(span.range, dateEnv, span.allDay)), { allDay: span.allDay });
}
function buildRangeApiWithTimeZone(range, dateEnv, omitTime) {
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, buildRangeApi(range, dateEnv, omitTime)), { timeZone: dateEnv.timeZone });
}
function buildRangeApi(range, dateEnv, omitTime) {
    return {
        start: dateEnv.toDate(range.start),
        end: dateEnv.toDate(range.end),
        startStr: dateEnv.formatIso(range.start, { omitTime: omitTime }),
        endStr: dateEnv.formatIso(range.end, { omitTime: omitTime }),
    };
}
function fabricateEventRange(dateSpan, eventUiBases, context) {
    var res = refineEventDef({ editable: false }, context);
    var def = parseEventDef(res.refined, res.extra, '', // sourceId
    dateSpan.allDay, true, // hasEnd
    context);
    return {
        def: def,
        ui: compileEventUi(def, eventUiBases),
        instance: createEventInstance(def.defId, dateSpan.range),
        range: dateSpan.range,
        isStart: true,
        isEnd: true,
    };
}

function triggerDateSelect(selection, pev, context) {
    context.emitter.trigger('select', (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, buildDateSpanApiWithContext(selection, context)), { jsEvent: pev ? pev.origEvent : null, view: context.viewApi || context.calendarApi.view }));
}
function triggerDateUnselect(pev, context) {
    context.emitter.trigger('unselect', {
        jsEvent: pev ? pev.origEvent : null,
        view: context.viewApi || context.calendarApi.view,
    });
}
function buildDateSpanApiWithContext(dateSpan, context) {
    var props = {};
    for (var _i = 0, _a = context.pluginHooks.dateSpanTransforms; _i < _a.length; _i++) {
        var transform = _a[_i];
        (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(props, transform(dateSpan, context));
    }
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(props, buildDateSpanApi(dateSpan, context.dateEnv));
    return props;
}
// Given an event's allDay status and start date, return what its fallback end date should be.
// TODO: rename to computeDefaultEventEnd
function getDefaultEventEnd(allDay, marker, context) {
    var dateEnv = context.dateEnv, options = context.options;
    var end = marker;
    if (allDay) {
        end = startOfDay(end);
        end = dateEnv.add(end, options.defaultAllDayEventDuration);
    }
    else {
        end = dateEnv.add(end, options.defaultTimedEventDuration);
    }
    return end;
}

// applies the mutation to ALL defs/instances within the event store
function applyMutationToEventStore(eventStore, eventConfigBase, mutation, context) {
    var eventConfigs = compileEventUis(eventStore.defs, eventConfigBase);
    var dest = createEmptyEventStore();
    for (var defId in eventStore.defs) {
        var def = eventStore.defs[defId];
        dest.defs[defId] = applyMutationToEventDef(def, eventConfigs[defId], mutation, context);
    }
    for (var instanceId in eventStore.instances) {
        var instance = eventStore.instances[instanceId];
        var def = dest.defs[instance.defId]; // important to grab the newly modified def
        dest.instances[instanceId] = applyMutationToEventInstance(instance, def, eventConfigs[instance.defId], mutation, context);
    }
    return dest;
}
function applyMutationToEventDef(eventDef, eventConfig, mutation, context) {
    var standardProps = mutation.standardProps || {};
    // if hasEnd has not been specified, guess a good value based on deltas.
    // if duration will change, there's no way the default duration will persist,
    // and thus, we need to mark the event as having a real end
    if (standardProps.hasEnd == null &&
        eventConfig.durationEditable &&
        (mutation.startDelta || mutation.endDelta)) {
        standardProps.hasEnd = true; // TODO: is this mutation okay?
    }
    var copy = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, eventDef), standardProps), { ui: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, eventDef.ui), standardProps.ui) });
    if (mutation.extendedProps) {
        copy.extendedProps = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, copy.extendedProps), mutation.extendedProps);
    }
    for (var _i = 0, _a = context.pluginHooks.eventDefMutationAppliers; _i < _a.length; _i++) {
        var applier = _a[_i];
        applier(copy, mutation, context);
    }
    if (!copy.hasEnd && context.options.forceEventDuration) {
        copy.hasEnd = true;
    }
    return copy;
}
function applyMutationToEventInstance(eventInstance, eventDef, // must first be modified by applyMutationToEventDef
eventConfig, mutation, context) {
    var dateEnv = context.dateEnv;
    var forceAllDay = mutation.standardProps && mutation.standardProps.allDay === true;
    var clearEnd = mutation.standardProps && mutation.standardProps.hasEnd === false;
    var copy = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, eventInstance);
    if (forceAllDay) {
        copy.range = computeAlignedDayRange(copy.range);
    }
    if (mutation.datesDelta && eventConfig.startEditable) {
        copy.range = {
            start: dateEnv.add(copy.range.start, mutation.datesDelta),
            end: dateEnv.add(copy.range.end, mutation.datesDelta),
        };
    }
    if (mutation.startDelta && eventConfig.durationEditable) {
        copy.range = {
            start: dateEnv.add(copy.range.start, mutation.startDelta),
            end: copy.range.end,
        };
    }
    if (mutation.endDelta && eventConfig.durationEditable) {
        copy.range = {
            start: copy.range.start,
            end: dateEnv.add(copy.range.end, mutation.endDelta),
        };
    }
    if (clearEnd) {
        copy.range = {
            start: copy.range.start,
            end: getDefaultEventEnd(eventDef.allDay, copy.range.start, context),
        };
    }
    // in case event was all-day but the supplied deltas were not
    // better util for this?
    if (eventDef.allDay) {
        copy.range = {
            start: startOfDay(copy.range.start),
            end: startOfDay(copy.range.end),
        };
    }
    // handle invalid durations
    if (copy.range.end < copy.range.start) {
        copy.range.end = getDefaultEventEnd(eventDef.allDay, copy.range.start, context);
    }
    return copy;
}

// no public types yet. when there are, export from:
// import {} from './api-type-deps'
var ViewApi = /** @class */ (function () {
    function ViewApi(type, getCurrentData, dateEnv) {
        this.type = type;
        this.getCurrentData = getCurrentData;
        this.dateEnv = dateEnv;
    }
    Object.defineProperty(ViewApi.prototype, "calendar", {
        get: function () {
            return this.getCurrentData().calendarApi;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ViewApi.prototype, "title", {
        get: function () {
            return this.getCurrentData().viewTitle;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ViewApi.prototype, "activeStart", {
        get: function () {
            return this.dateEnv.toDate(this.getCurrentData().dateProfile.activeRange.start);
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ViewApi.prototype, "activeEnd", {
        get: function () {
            return this.dateEnv.toDate(this.getCurrentData().dateProfile.activeRange.end);
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ViewApi.prototype, "currentStart", {
        get: function () {
            return this.dateEnv.toDate(this.getCurrentData().dateProfile.currentRange.start);
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ViewApi.prototype, "currentEnd", {
        get: function () {
            return this.dateEnv.toDate(this.getCurrentData().dateProfile.currentRange.end);
        },
        enumerable: false,
        configurable: true
    });
    ViewApi.prototype.getOption = function (name) {
        return this.getCurrentData().options[name]; // are the view-specific options
    };
    return ViewApi;
}());

var EVENT_SOURCE_REFINERS = {
    id: String,
    defaultAllDay: Boolean,
    url: String,
    format: String,
    events: identity,
    eventDataTransform: identity,
    // for any network-related sources
    success: identity,
    failure: identity,
};
function parseEventSource(raw, context, refiners) {
    if (refiners === void 0) { refiners = buildEventSourceRefiners(context); }
    var rawObj;
    if (typeof raw === 'string') {
        rawObj = { url: raw };
    }
    else if (typeof raw === 'function' || Array.isArray(raw)) {
        rawObj = { events: raw };
    }
    else if (typeof raw === 'object' && raw) { // not null
        rawObj = raw;
    }
    if (rawObj) {
        var _a = refineProps(rawObj, refiners), refined = _a.refined, extra = _a.extra;
        var metaRes = buildEventSourceMeta(refined, context);
        if (metaRes) {
            return {
                _raw: raw,
                isFetching: false,
                latestFetchId: '',
                fetchRange: null,
                defaultAllDay: refined.defaultAllDay,
                eventDataTransform: refined.eventDataTransform,
                success: refined.success,
                failure: refined.failure,
                publicId: refined.id || '',
                sourceId: guid(),
                sourceDefId: metaRes.sourceDefId,
                meta: metaRes.meta,
                ui: createEventUi(refined, context),
                extendedProps: extra,
            };
        }
    }
    return null;
}
function buildEventSourceRefiners(context) {
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, EVENT_UI_REFINERS), EVENT_SOURCE_REFINERS), context.pluginHooks.eventSourceRefiners);
}
function buildEventSourceMeta(raw, context) {
    var defs = context.pluginHooks.eventSourceDefs;
    for (var i = defs.length - 1; i >= 0; i -= 1) { // later-added plugins take precedence
        var def = defs[i];
        var meta = def.parseMeta(raw);
        if (meta) {
            return { sourceDefId: i, meta: meta };
        }
    }
    return null;
}

function reduceCurrentDate(currentDate, action) {
    switch (action.type) {
        case 'CHANGE_DATE':
            return action.dateMarker;
        default:
            return currentDate;
    }
}
function getInitialDate(options, dateEnv) {
    var initialDateInput = options.initialDate;
    // compute the initial ambig-timezone date
    if (initialDateInput != null) {
        return dateEnv.createMarker(initialDateInput);
    }
    return getNow(options.now, dateEnv); // getNow already returns unzoned
}
function getNow(nowInput, dateEnv) {
    if (typeof nowInput === 'function') {
        nowInput = nowInput();
    }
    if (nowInput == null) {
        return dateEnv.createNowMarker();
    }
    return dateEnv.createMarker(nowInput);
}

var CalendarApi = /** @class */ (function () {
    function CalendarApi() {
    }
    CalendarApi.prototype.getCurrentData = function () {
        return this.currentDataManager.getCurrentData();
    };
    CalendarApi.prototype.dispatch = function (action) {
        return this.currentDataManager.dispatch(action);
    };
    Object.defineProperty(CalendarApi.prototype, "view", {
        get: function () { return this.getCurrentData().viewApi; } // for public API
        ,
        enumerable: false,
        configurable: true
    });
    CalendarApi.prototype.batchRendering = function (callback) {
        callback();
    };
    CalendarApi.prototype.updateSize = function () {
        this.trigger('_resize', true);
    };
    // Options
    // -----------------------------------------------------------------------------------------------------------------
    CalendarApi.prototype.setOption = function (name, val) {
        this.dispatch({
            type: 'SET_OPTION',
            optionName: name,
            rawOptionValue: val,
        });
    };
    CalendarApi.prototype.getOption = function (name) {
        return this.currentDataManager.currentCalendarOptionsInput[name];
    };
    CalendarApi.prototype.getAvailableLocaleCodes = function () {
        return Object.keys(this.getCurrentData().availableRawLocales);
    };
    // Trigger
    // -----------------------------------------------------------------------------------------------------------------
    CalendarApi.prototype.on = function (handlerName, handler) {
        var currentDataManager = this.currentDataManager;
        if (currentDataManager.currentCalendarOptionsRefiners[handlerName]) {
            currentDataManager.emitter.on(handlerName, handler);
        }
        else {
            console.warn("Unknown listener name '" + handlerName + "'");
        }
    };
    CalendarApi.prototype.off = function (handlerName, handler) {
        this.currentDataManager.emitter.off(handlerName, handler);
    };
    // not meant for public use
    CalendarApi.prototype.trigger = function (handlerName) {
        var _a;
        var args = [];
        for (var _i = 1; _i < arguments.length; _i++) {
            args[_i - 1] = arguments[_i];
        }
        (_a = this.currentDataManager.emitter).trigger.apply(_a, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([handlerName], args));
    };
    // View
    // -----------------------------------------------------------------------------------------------------------------
    CalendarApi.prototype.changeView = function (viewType, dateOrRange) {
        var _this = this;
        this.batchRendering(function () {
            _this.unselect();
            if (dateOrRange) {
                if (dateOrRange.start && dateOrRange.end) { // a range
                    _this.dispatch({
                        type: 'CHANGE_VIEW_TYPE',
                        viewType: viewType,
                    });
                    _this.dispatch({
                        type: 'SET_OPTION',
                        optionName: 'visibleRange',
                        rawOptionValue: dateOrRange,
                    });
                }
                else {
                    var dateEnv = _this.getCurrentData().dateEnv;
                    _this.dispatch({
                        type: 'CHANGE_VIEW_TYPE',
                        viewType: viewType,
                        dateMarker: dateEnv.createMarker(dateOrRange),
                    });
                }
            }
            else {
                _this.dispatch({
                    type: 'CHANGE_VIEW_TYPE',
                    viewType: viewType,
                });
            }
        });
    };
    // Forces navigation to a view for the given date.
    // `viewType` can be a specific view name or a generic one like "week" or "day".
    // needs to change
    CalendarApi.prototype.zoomTo = function (dateMarker, viewType) {
        var state = this.getCurrentData();
        var spec;
        viewType = viewType || 'day'; // day is default zoom
        spec = state.viewSpecs[viewType] || this.getUnitViewSpec(viewType);
        this.unselect();
        if (spec) {
            this.dispatch({
                type: 'CHANGE_VIEW_TYPE',
                viewType: spec.type,
                dateMarker: dateMarker,
            });
        }
        else {
            this.dispatch({
                type: 'CHANGE_DATE',
                dateMarker: dateMarker,
            });
        }
    };
    // Given a duration singular unit, like "week" or "day", finds a matching view spec.
    // Preference is given to views that have corresponding buttons.
    CalendarApi.prototype.getUnitViewSpec = function (unit) {
        var _a = this.getCurrentData(), viewSpecs = _a.viewSpecs, toolbarConfig = _a.toolbarConfig;
        var viewTypes = [].concat(toolbarConfig.header ? toolbarConfig.header.viewsWithButtons : [], toolbarConfig.footer ? toolbarConfig.footer.viewsWithButtons : []);
        var i;
        var spec;
        for (var viewType in viewSpecs) {
            viewTypes.push(viewType);
        }
        for (i = 0; i < viewTypes.length; i += 1) {
            spec = viewSpecs[viewTypes[i]];
            if (spec) {
                if (spec.singleUnit === unit) {
                    return spec;
                }
            }
        }
        return null;
    };
    // Current Date
    // -----------------------------------------------------------------------------------------------------------------
    CalendarApi.prototype.prev = function () {
        this.unselect();
        this.dispatch({ type: 'PREV' });
    };
    CalendarApi.prototype.next = function () {
        this.unselect();
        this.dispatch({ type: 'NEXT' });
    };
    CalendarApi.prototype.prevYear = function () {
        var state = this.getCurrentData();
        this.unselect();
        this.dispatch({
            type: 'CHANGE_DATE',
            dateMarker: state.dateEnv.addYears(state.currentDate, -1),
        });
    };
    CalendarApi.prototype.nextYear = function () {
        var state = this.getCurrentData();
        this.unselect();
        this.dispatch({
            type: 'CHANGE_DATE',
            dateMarker: state.dateEnv.addYears(state.currentDate, 1),
        });
    };
    CalendarApi.prototype.today = function () {
        var state = this.getCurrentData();
        this.unselect();
        this.dispatch({
            type: 'CHANGE_DATE',
            dateMarker: getNow(state.calendarOptions.now, state.dateEnv),
        });
    };
    CalendarApi.prototype.gotoDate = function (zonedDateInput) {
        var state = this.getCurrentData();
        this.unselect();
        this.dispatch({
            type: 'CHANGE_DATE',
            dateMarker: state.dateEnv.createMarker(zonedDateInput),
        });
    };
    CalendarApi.prototype.incrementDate = function (deltaInput) {
        var state = this.getCurrentData();
        var delta = createDuration(deltaInput);
        if (delta) { // else, warn about invalid input?
            this.unselect();
            this.dispatch({
                type: 'CHANGE_DATE',
                dateMarker: state.dateEnv.add(state.currentDate, delta),
            });
        }
    };
    // for external API
    CalendarApi.prototype.getDate = function () {
        var state = this.getCurrentData();
        return state.dateEnv.toDate(state.currentDate);
    };
    // Date Formatting Utils
    // -----------------------------------------------------------------------------------------------------------------
    CalendarApi.prototype.formatDate = function (d, formatter) {
        var dateEnv = this.getCurrentData().dateEnv;
        return dateEnv.format(dateEnv.createMarker(d), createFormatter(formatter));
    };
    // `settings` is for formatter AND isEndExclusive
    CalendarApi.prototype.formatRange = function (d0, d1, settings) {
        var dateEnv = this.getCurrentData().dateEnv;
        return dateEnv.formatRange(dateEnv.createMarker(d0), dateEnv.createMarker(d1), createFormatter(settings), settings);
    };
    CalendarApi.prototype.formatIso = function (d, omitTime) {
        var dateEnv = this.getCurrentData().dateEnv;
        return dateEnv.formatIso(dateEnv.createMarker(d), { omitTime: omitTime });
    };
    // Date Selection / Event Selection / DayClick
    // -----------------------------------------------------------------------------------------------------------------
    // this public method receives start/end dates in any format, with any timezone
    // NOTE: args were changed from v3
    CalendarApi.prototype.select = function (dateOrObj, endDate) {
        var selectionInput;
        if (endDate == null) {
            if (dateOrObj.start != null) {
                selectionInput = dateOrObj;
            }
            else {
                selectionInput = {
                    start: dateOrObj,
                    end: null,
                };
            }
        }
        else {
            selectionInput = {
                start: dateOrObj,
                end: endDate,
            };
        }
        var state = this.getCurrentData();
        var selection = parseDateSpan(selectionInput, state.dateEnv, createDuration({ days: 1 }));
        if (selection) { // throw parse error otherwise?
            this.dispatch({ type: 'SELECT_DATES', selection: selection });
            triggerDateSelect(selection, null, state);
        }
    };
    // public method
    CalendarApi.prototype.unselect = function (pev) {
        var state = this.getCurrentData();
        if (state.dateSelection) {
            this.dispatch({ type: 'UNSELECT_DATES' });
            triggerDateUnselect(pev, state);
        }
    };
    // Public Events API
    // -----------------------------------------------------------------------------------------------------------------
    CalendarApi.prototype.addEvent = function (eventInput, sourceInput) {
        if (eventInput instanceof EventApi) {
            var def = eventInput._def;
            var instance = eventInput._instance;
            var currentData = this.getCurrentData();
            // not already present? don't want to add an old snapshot
            if (!currentData.eventStore.defs[def.defId]) {
                this.dispatch({
                    type: 'ADD_EVENTS',
                    eventStore: eventTupleToStore({ def: def, instance: instance }), // TODO: better util for two args?
                });
                this.triggerEventAdd(eventInput);
            }
            return eventInput;
        }
        var state = this.getCurrentData();
        var eventSource;
        if (sourceInput instanceof EventSourceApi) {
            eventSource = sourceInput.internalEventSource;
        }
        else if (typeof sourceInput === 'boolean') {
            if (sourceInput) { // true. part of the first event source
                eventSource = hashValuesToArray(state.eventSources)[0];
            }
        }
        else if (sourceInput != null) { // an ID. accepts a number too
            var sourceApi = this.getEventSourceById(sourceInput); // TODO: use an internal function
            if (!sourceApi) {
                console.warn("Could not find an event source with ID \"" + sourceInput + "\""); // TODO: test
                return null;
            }
            eventSource = sourceApi.internalEventSource;
        }
        var tuple = parseEvent(eventInput, eventSource, state, false);
        if (tuple) {
            var newEventApi = new EventApi(state, tuple.def, tuple.def.recurringDef ? null : tuple.instance);
            this.dispatch({
                type: 'ADD_EVENTS',
                eventStore: eventTupleToStore(tuple),
            });
            this.triggerEventAdd(newEventApi);
            return newEventApi;
        }
        return null;
    };
    CalendarApi.prototype.triggerEventAdd = function (eventApi) {
        var _this = this;
        var emitter = this.getCurrentData().emitter;
        emitter.trigger('eventAdd', {
            event: eventApi,
            relatedEvents: [],
            revert: function () {
                _this.dispatch({
                    type: 'REMOVE_EVENTS',
                    eventStore: eventApiToStore(eventApi),
                });
            },
        });
    };
    // TODO: optimize
    CalendarApi.prototype.getEventById = function (id) {
        var state = this.getCurrentData();
        var _a = state.eventStore, defs = _a.defs, instances = _a.instances;
        id = String(id);
        for (var defId in defs) {
            var def = defs[defId];
            if (def.publicId === id) {
                if (def.recurringDef) {
                    return new EventApi(state, def, null);
                }
                for (var instanceId in instances) {
                    var instance = instances[instanceId];
                    if (instance.defId === def.defId) {
                        return new EventApi(state, def, instance);
                    }
                }
            }
        }
        return null;
    };
    CalendarApi.prototype.getEvents = function () {
        var currentData = this.getCurrentData();
        return buildEventApis(currentData.eventStore, currentData);
    };
    CalendarApi.prototype.removeAllEvents = function () {
        this.dispatch({ type: 'REMOVE_ALL_EVENTS' });
    };
    // Public Event Sources API
    // -----------------------------------------------------------------------------------------------------------------
    CalendarApi.prototype.getEventSources = function () {
        var state = this.getCurrentData();
        var sourceHash = state.eventSources;
        var sourceApis = [];
        for (var internalId in sourceHash) {
            sourceApis.push(new EventSourceApi(state, sourceHash[internalId]));
        }
        return sourceApis;
    };
    CalendarApi.prototype.getEventSourceById = function (id) {
        var state = this.getCurrentData();
        var sourceHash = state.eventSources;
        id = String(id);
        for (var sourceId in sourceHash) {
            if (sourceHash[sourceId].publicId === id) {
                return new EventSourceApi(state, sourceHash[sourceId]);
            }
        }
        return null;
    };
    CalendarApi.prototype.addEventSource = function (sourceInput) {
        var state = this.getCurrentData();
        if (sourceInput instanceof EventSourceApi) {
            // not already present? don't want to add an old snapshot
            if (!state.eventSources[sourceInput.internalEventSource.sourceId]) {
                this.dispatch({
                    type: 'ADD_EVENT_SOURCES',
                    sources: [sourceInput.internalEventSource],
                });
            }
            return sourceInput;
        }
        var eventSource = parseEventSource(sourceInput, state);
        if (eventSource) { // TODO: error otherwise?
            this.dispatch({ type: 'ADD_EVENT_SOURCES', sources: [eventSource] });
            return new EventSourceApi(state, eventSource);
        }
        return null;
    };
    CalendarApi.prototype.removeAllEventSources = function () {
        this.dispatch({ type: 'REMOVE_ALL_EVENT_SOURCES' });
    };
    CalendarApi.prototype.refetchEvents = function () {
        this.dispatch({ type: 'FETCH_EVENT_SOURCES', isRefetch: true });
    };
    // Scroll
    // -----------------------------------------------------------------------------------------------------------------
    CalendarApi.prototype.scrollToTime = function (timeInput) {
        var time = createDuration(timeInput);
        if (time) {
            this.trigger('_scrollRequest', { time: time });
        }
    };
    return CalendarApi;
}());

var EventApi = /** @class */ (function () {
    // instance will be null if expressing a recurring event that has no current instances,
    // OR if trying to validate an incoming external event that has no dates assigned
    function EventApi(context, def, instance) {
        this._context = context;
        this._def = def;
        this._instance = instance || null;
    }
    /*
    TODO: make event struct more responsible for this
    */
    EventApi.prototype.setProp = function (name, val) {
        var _a, _b;
        if (name in EVENT_DATE_REFINERS) {
            console.warn('Could not set date-related prop \'name\'. Use one of the date-related methods instead.');
            // TODO: make proper aliasing system?
        }
        else if (name === 'id') {
            val = EVENT_NON_DATE_REFINERS[name](val);
            this.mutate({
                standardProps: { publicId: val }, // hardcoded internal name
            });
        }
        else if (name in EVENT_NON_DATE_REFINERS) {
            val = EVENT_NON_DATE_REFINERS[name](val);
            this.mutate({
                standardProps: (_a = {}, _a[name] = val, _a),
            });
        }
        else if (name in EVENT_UI_REFINERS) {
            var ui = EVENT_UI_REFINERS[name](val);
            if (name === 'color') {
                ui = { backgroundColor: val, borderColor: val };
            }
            else if (name === 'editable') {
                ui = { startEditable: val, durationEditable: val };
            }
            else {
                ui = (_b = {}, _b[name] = val, _b);
            }
            this.mutate({
                standardProps: { ui: ui },
            });
        }
        else {
            console.warn("Could not set prop '" + name + "'. Use setExtendedProp instead.");
        }
    };
    EventApi.prototype.setExtendedProp = function (name, val) {
        var _a;
        this.mutate({
            extendedProps: (_a = {}, _a[name] = val, _a),
        });
    };
    EventApi.prototype.setStart = function (startInput, options) {
        if (options === void 0) { options = {}; }
        var dateEnv = this._context.dateEnv;
        var start = dateEnv.createMarker(startInput);
        if (start && this._instance) { // TODO: warning if parsed bad
            var instanceRange = this._instance.range;
            var startDelta = diffDates(instanceRange.start, start, dateEnv, options.granularity); // what if parsed bad!?
            if (options.maintainDuration) {
                this.mutate({ datesDelta: startDelta });
            }
            else {
                this.mutate({ startDelta: startDelta });
            }
        }
    };
    EventApi.prototype.setEnd = function (endInput, options) {
        if (options === void 0) { options = {}; }
        var dateEnv = this._context.dateEnv;
        var end;
        if (endInput != null) {
            end = dateEnv.createMarker(endInput);
            if (!end) {
                return; // TODO: warning if parsed bad
            }
        }
        if (this._instance) {
            if (end) {
                var endDelta = diffDates(this._instance.range.end, end, dateEnv, options.granularity);
                this.mutate({ endDelta: endDelta });
            }
            else {
                this.mutate({ standardProps: { hasEnd: false } });
            }
        }
    };
    EventApi.prototype.setDates = function (startInput, endInput, options) {
        if (options === void 0) { options = {}; }
        var dateEnv = this._context.dateEnv;
        var standardProps = { allDay: options.allDay };
        var start = dateEnv.createMarker(startInput);
        var end;
        if (!start) {
            return; // TODO: warning if parsed bad
        }
        if (endInput != null) {
            end = dateEnv.createMarker(endInput);
            if (!end) { // TODO: warning if parsed bad
                return;
            }
        }
        if (this._instance) {
            var instanceRange = this._instance.range;
            // when computing the diff for an event being converted to all-day,
            // compute diff off of the all-day values the way event-mutation does.
            if (options.allDay === true) {
                instanceRange = computeAlignedDayRange(instanceRange);
            }
            var startDelta = diffDates(instanceRange.start, start, dateEnv, options.granularity);
            if (end) {
                var endDelta = diffDates(instanceRange.end, end, dateEnv, options.granularity);
                if (durationsEqual(startDelta, endDelta)) {
                    this.mutate({ datesDelta: startDelta, standardProps: standardProps });
                }
                else {
                    this.mutate({ startDelta: startDelta, endDelta: endDelta, standardProps: standardProps });
                }
            }
            else { // means "clear the end"
                standardProps.hasEnd = false;
                this.mutate({ datesDelta: startDelta, standardProps: standardProps });
            }
        }
    };
    EventApi.prototype.moveStart = function (deltaInput) {
        var delta = createDuration(deltaInput);
        if (delta) { // TODO: warning if parsed bad
            this.mutate({ startDelta: delta });
        }
    };
    EventApi.prototype.moveEnd = function (deltaInput) {
        var delta = createDuration(deltaInput);
        if (delta) { // TODO: warning if parsed bad
            this.mutate({ endDelta: delta });
        }
    };
    EventApi.prototype.moveDates = function (deltaInput) {
        var delta = createDuration(deltaInput);
        if (delta) { // TODO: warning if parsed bad
            this.mutate({ datesDelta: delta });
        }
    };
    EventApi.prototype.setAllDay = function (allDay, options) {
        if (options === void 0) { options = {}; }
        var standardProps = { allDay: allDay };
        var maintainDuration = options.maintainDuration;
        if (maintainDuration == null) {
            maintainDuration = this._context.options.allDayMaintainDuration;
        }
        if (this._def.allDay !== allDay) {
            standardProps.hasEnd = maintainDuration;
        }
        this.mutate({ standardProps: standardProps });
    };
    EventApi.prototype.formatRange = function (formatInput) {
        var dateEnv = this._context.dateEnv;
        var instance = this._instance;
        var formatter = createFormatter(formatInput);
        if (this._def.hasEnd) {
            return dateEnv.formatRange(instance.range.start, instance.range.end, formatter, {
                forcedStartTzo: instance.forcedStartTzo,
                forcedEndTzo: instance.forcedEndTzo,
            });
        }
        return dateEnv.format(instance.range.start, formatter, {
            forcedTzo: instance.forcedStartTzo,
        });
    };
    EventApi.prototype.mutate = function (mutation) {
        var instance = this._instance;
        if (instance) {
            var def = this._def;
            var context_1 = this._context;
            var eventStore_1 = context_1.getCurrentData().eventStore;
            var relevantEvents = getRelevantEvents(eventStore_1, instance.instanceId);
            var eventConfigBase = {
                '': {
                    display: '',
                    startEditable: true,
                    durationEditable: true,
                    constraints: [],
                    overlap: null,
                    allows: [],
                    backgroundColor: '',
                    borderColor: '',
                    textColor: '',
                    classNames: [],
                },
            };
            relevantEvents = applyMutationToEventStore(relevantEvents, eventConfigBase, mutation, context_1);
            var oldEvent = new EventApi(context_1, def, instance); // snapshot
            this._def = relevantEvents.defs[def.defId];
            this._instance = relevantEvents.instances[instance.instanceId];
            context_1.dispatch({
                type: 'MERGE_EVENTS',
                eventStore: relevantEvents,
            });
            context_1.emitter.trigger('eventChange', {
                oldEvent: oldEvent,
                event: this,
                relatedEvents: buildEventApis(relevantEvents, context_1, instance),
                revert: function () {
                    context_1.dispatch({
                        type: 'RESET_EVENTS',
                        eventStore: eventStore_1,
                    });
                },
            });
        }
    };
    EventApi.prototype.remove = function () {
        var context = this._context;
        var asStore = eventApiToStore(this);
        context.dispatch({
            type: 'REMOVE_EVENTS',
            eventStore: asStore,
        });
        context.emitter.trigger('eventRemove', {
            event: this,
            relatedEvents: [],
            revert: function () {
                context.dispatch({
                    type: 'MERGE_EVENTS',
                    eventStore: asStore,
                });
            },
        });
    };
    Object.defineProperty(EventApi.prototype, "source", {
        get: function () {
            var sourceId = this._def.sourceId;
            if (sourceId) {
                return new EventSourceApi(this._context, this._context.getCurrentData().eventSources[sourceId]);
            }
            return null;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "start", {
        get: function () {
            return this._instance ?
                this._context.dateEnv.toDate(this._instance.range.start) :
                null;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "end", {
        get: function () {
            return (this._instance && this._def.hasEnd) ?
                this._context.dateEnv.toDate(this._instance.range.end) :
                null;
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "startStr", {
        get: function () {
            var instance = this._instance;
            if (instance) {
                return this._context.dateEnv.formatIso(instance.range.start, {
                    omitTime: this._def.allDay,
                    forcedTzo: instance.forcedStartTzo,
                });
            }
            return '';
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "endStr", {
        get: function () {
            var instance = this._instance;
            if (instance && this._def.hasEnd) {
                return this._context.dateEnv.formatIso(instance.range.end, {
                    omitTime: this._def.allDay,
                    forcedTzo: instance.forcedEndTzo,
                });
            }
            return '';
        },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "id", {
        // computable props that all access the def
        // TODO: find a TypeScript-compatible way to do this at scale
        get: function () { return this._def.publicId; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "groupId", {
        get: function () { return this._def.groupId; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "allDay", {
        get: function () { return this._def.allDay; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "title", {
        get: function () { return this._def.title; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "url", {
        get: function () { return this._def.url; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "display", {
        get: function () { return this._def.ui.display || 'auto'; } // bad. just normalize the type earlier
        ,
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "startEditable", {
        get: function () { return this._def.ui.startEditable; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "durationEditable", {
        get: function () { return this._def.ui.durationEditable; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "constraint", {
        get: function () { return this._def.ui.constraints[0] || null; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "overlap", {
        get: function () { return this._def.ui.overlap; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "allow", {
        get: function () { return this._def.ui.allows[0] || null; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "backgroundColor", {
        get: function () { return this._def.ui.backgroundColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "borderColor", {
        get: function () { return this._def.ui.borderColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "textColor", {
        get: function () { return this._def.ui.textColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "classNames", {
        // NOTE: user can't modify these because Object.freeze was called in event-def parsing
        get: function () { return this._def.ui.classNames; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(EventApi.prototype, "extendedProps", {
        get: function () { return this._def.extendedProps; },
        enumerable: false,
        configurable: true
    });
    EventApi.prototype.toPlainObject = function (settings) {
        if (settings === void 0) { settings = {}; }
        var def = this._def;
        var ui = def.ui;
        var _a = this, startStr = _a.startStr, endStr = _a.endStr;
        var res = {};
        if (def.title) {
            res.title = def.title;
        }
        if (startStr) {
            res.start = startStr;
        }
        if (endStr) {
            res.end = endStr;
        }
        if (def.publicId) {
            res.id = def.publicId;
        }
        if (def.groupId) {
            res.groupId = def.groupId;
        }
        if (def.url) {
            res.url = def.url;
        }
        if (ui.display && ui.display !== 'auto') {
            res.display = ui.display;
        }
        // TODO: what about recurring-event properties???
        // TODO: include startEditable/durationEditable/constraint/overlap/allow
        if (settings.collapseColor && ui.backgroundColor && ui.backgroundColor === ui.borderColor) {
            res.color = ui.backgroundColor;
        }
        else {
            if (ui.backgroundColor) {
                res.backgroundColor = ui.backgroundColor;
            }
            if (ui.borderColor) {
                res.borderColor = ui.borderColor;
            }
        }
        if (ui.textColor) {
            res.textColor = ui.textColor;
        }
        if (ui.classNames.length) {
            res.classNames = ui.classNames;
        }
        if (Object.keys(def.extendedProps).length) {
            if (settings.collapseExtendedProps) {
                (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(res, def.extendedProps);
            }
            else {
                res.extendedProps = def.extendedProps;
            }
        }
        return res;
    };
    EventApi.prototype.toJSON = function () {
        return this.toPlainObject();
    };
    return EventApi;
}());
function eventApiToStore(eventApi) {
    var _a, _b;
    var def = eventApi._def;
    var instance = eventApi._instance;
    return {
        defs: (_a = {}, _a[def.defId] = def, _a),
        instances: instance
            ? (_b = {}, _b[instance.instanceId] = instance, _b) : {},
    };
}
function buildEventApis(eventStore, context, excludeInstance) {
    var defs = eventStore.defs, instances = eventStore.instances;
    var eventApis = [];
    var excludeInstanceId = excludeInstance ? excludeInstance.instanceId : '';
    for (var id in instances) {
        var instance = instances[id];
        var def = defs[instance.defId];
        if (instance.instanceId !== excludeInstanceId) {
            eventApis.push(new EventApi(context, def, instance));
        }
    }
    return eventApis;
}

var calendarSystemClassMap = {};
function registerCalendarSystem(name, theClass) {
    calendarSystemClassMap[name] = theClass;
}
function createCalendarSystem(name) {
    return new calendarSystemClassMap[name]();
}
var GregorianCalendarSystem = /** @class */ (function () {
    function GregorianCalendarSystem() {
    }
    GregorianCalendarSystem.prototype.getMarkerYear = function (d) {
        return d.getUTCFullYear();
    };
    GregorianCalendarSystem.prototype.getMarkerMonth = function (d) {
        return d.getUTCMonth();
    };
    GregorianCalendarSystem.prototype.getMarkerDay = function (d) {
        return d.getUTCDate();
    };
    GregorianCalendarSystem.prototype.arrayToMarker = function (arr) {
        return arrayToUtcDate(arr);
    };
    GregorianCalendarSystem.prototype.markerToArray = function (marker) {
        return dateToUtcArray(marker);
    };
    return GregorianCalendarSystem;
}());
registerCalendarSystem('gregory', GregorianCalendarSystem);

var ISO_RE = /^\s*(\d{4})(-?(\d{2})(-?(\d{2})([T ](\d{2}):?(\d{2})(:?(\d{2})(\.(\d+))?)?(Z|(([-+])(\d{2})(:?(\d{2}))?))?)?)?)?$/;
function parse(str) {
    var m = ISO_RE.exec(str);
    if (m) {
        var marker = new Date(Date.UTC(Number(m[1]), m[3] ? Number(m[3]) - 1 : 0, Number(m[5] || 1), Number(m[7] || 0), Number(m[8] || 0), Number(m[10] || 0), m[12] ? Number("0." + m[12]) * 1000 : 0));
        if (isValidDate(marker)) {
            var timeZoneOffset = null;
            if (m[13]) {
                timeZoneOffset = (m[15] === '-' ? -1 : 1) * (Number(m[16] || 0) * 60 +
                    Number(m[18] || 0));
            }
            return {
                marker: marker,
                isTimeUnspecified: !m[6],
                timeZoneOffset: timeZoneOffset,
            };
        }
    }
    return null;
}

var DateEnv = /** @class */ (function () {
    function DateEnv(settings) {
        var timeZone = this.timeZone = settings.timeZone;
        var isNamedTimeZone = timeZone !== 'local' && timeZone !== 'UTC';
        if (settings.namedTimeZoneImpl && isNamedTimeZone) {
            this.namedTimeZoneImpl = new settings.namedTimeZoneImpl(timeZone);
        }
        this.canComputeOffset = Boolean(!isNamedTimeZone || this.namedTimeZoneImpl);
        this.calendarSystem = createCalendarSystem(settings.calendarSystem);
        this.locale = settings.locale;
        this.weekDow = settings.locale.week.dow;
        this.weekDoy = settings.locale.week.doy;
        if (settings.weekNumberCalculation === 'ISO') {
            this.weekDow = 1;
            this.weekDoy = 4;
        }
        if (typeof settings.firstDay === 'number') {
            this.weekDow = settings.firstDay;
        }
        if (typeof settings.weekNumberCalculation === 'function') {
            this.weekNumberFunc = settings.weekNumberCalculation;
        }
        this.weekText = settings.weekText != null ? settings.weekText : settings.locale.options.weekText;
        this.weekTextLong = (settings.weekTextLong != null ? settings.weekTextLong : settings.locale.options.weekTextLong) || this.weekText;
        this.cmdFormatter = settings.cmdFormatter;
        this.defaultSeparator = settings.defaultSeparator;
    }
    // Creating / Parsing
    DateEnv.prototype.createMarker = function (input) {
        var meta = this.createMarkerMeta(input);
        if (meta === null) {
            return null;
        }
        return meta.marker;
    };
    DateEnv.prototype.createNowMarker = function () {
        if (this.canComputeOffset) {
            return this.timestampToMarker(new Date().valueOf());
        }
        // if we can't compute the current date val for a timezone,
        // better to give the current local date vals than UTC
        return arrayToUtcDate(dateToLocalArray(new Date()));
    };
    DateEnv.prototype.createMarkerMeta = function (input) {
        if (typeof input === 'string') {
            return this.parse(input);
        }
        var marker = null;
        if (typeof input === 'number') {
            marker = this.timestampToMarker(input);
        }
        else if (input instanceof Date) {
            input = input.valueOf();
            if (!isNaN(input)) {
                marker = this.timestampToMarker(input);
            }
        }
        else if (Array.isArray(input)) {
            marker = arrayToUtcDate(input);
        }
        if (marker === null || !isValidDate(marker)) {
            return null;
        }
        return { marker: marker, isTimeUnspecified: false, forcedTzo: null };
    };
    DateEnv.prototype.parse = function (s) {
        var parts = parse(s);
        if (parts === null) {
            return null;
        }
        var marker = parts.marker;
        var forcedTzo = null;
        if (parts.timeZoneOffset !== null) {
            if (this.canComputeOffset) {
                marker = this.timestampToMarker(marker.valueOf() - parts.timeZoneOffset * 60 * 1000);
            }
            else {
                forcedTzo = parts.timeZoneOffset;
            }
        }
        return { marker: marker, isTimeUnspecified: parts.isTimeUnspecified, forcedTzo: forcedTzo };
    };
    // Accessors
    DateEnv.prototype.getYear = function (marker) {
        return this.calendarSystem.getMarkerYear(marker);
    };
    DateEnv.prototype.getMonth = function (marker) {
        return this.calendarSystem.getMarkerMonth(marker);
    };
    // Adding / Subtracting
    DateEnv.prototype.add = function (marker, dur) {
        var a = this.calendarSystem.markerToArray(marker);
        a[0] += dur.years;
        a[1] += dur.months;
        a[2] += dur.days;
        a[6] += dur.milliseconds;
        return this.calendarSystem.arrayToMarker(a);
    };
    DateEnv.prototype.subtract = function (marker, dur) {
        var a = this.calendarSystem.markerToArray(marker);
        a[0] -= dur.years;
        a[1] -= dur.months;
        a[2] -= dur.days;
        a[6] -= dur.milliseconds;
        return this.calendarSystem.arrayToMarker(a);
    };
    DateEnv.prototype.addYears = function (marker, n) {
        var a = this.calendarSystem.markerToArray(marker);
        a[0] += n;
        return this.calendarSystem.arrayToMarker(a);
    };
    DateEnv.prototype.addMonths = function (marker, n) {
        var a = this.calendarSystem.markerToArray(marker);
        a[1] += n;
        return this.calendarSystem.arrayToMarker(a);
    };
    // Diffing Whole Units
    DateEnv.prototype.diffWholeYears = function (m0, m1) {
        var calendarSystem = this.calendarSystem;
        if (timeAsMs(m0) === timeAsMs(m1) &&
            calendarSystem.getMarkerDay(m0) === calendarSystem.getMarkerDay(m1) &&
            calendarSystem.getMarkerMonth(m0) === calendarSystem.getMarkerMonth(m1)) {
            return calendarSystem.getMarkerYear(m1) - calendarSystem.getMarkerYear(m0);
        }
        return null;
    };
    DateEnv.prototype.diffWholeMonths = function (m0, m1) {
        var calendarSystem = this.calendarSystem;
        if (timeAsMs(m0) === timeAsMs(m1) &&
            calendarSystem.getMarkerDay(m0) === calendarSystem.getMarkerDay(m1)) {
            return (calendarSystem.getMarkerMonth(m1) - calendarSystem.getMarkerMonth(m0)) +
                (calendarSystem.getMarkerYear(m1) - calendarSystem.getMarkerYear(m0)) * 12;
        }
        return null;
    };
    // Range / Duration
    DateEnv.prototype.greatestWholeUnit = function (m0, m1) {
        var n = this.diffWholeYears(m0, m1);
        if (n !== null) {
            return { unit: 'year', value: n };
        }
        n = this.diffWholeMonths(m0, m1);
        if (n !== null) {
            return { unit: 'month', value: n };
        }
        n = diffWholeWeeks(m0, m1);
        if (n !== null) {
            return { unit: 'week', value: n };
        }
        n = diffWholeDays(m0, m1);
        if (n !== null) {
            return { unit: 'day', value: n };
        }
        n = diffHours(m0, m1);
        if (isInt(n)) {
            return { unit: 'hour', value: n };
        }
        n = diffMinutes(m0, m1);
        if (isInt(n)) {
            return { unit: 'minute', value: n };
        }
        n = diffSeconds(m0, m1);
        if (isInt(n)) {
            return { unit: 'second', value: n };
        }
        return { unit: 'millisecond', value: m1.valueOf() - m0.valueOf() };
    };
    DateEnv.prototype.countDurationsBetween = function (m0, m1, d) {
        // TODO: can use greatestWholeUnit
        var diff;
        if (d.years) {
            diff = this.diffWholeYears(m0, m1);
            if (diff !== null) {
                return diff / asRoughYears(d);
            }
        }
        if (d.months) {
            diff = this.diffWholeMonths(m0, m1);
            if (diff !== null) {
                return diff / asRoughMonths(d);
            }
        }
        if (d.days) {
            diff = diffWholeDays(m0, m1);
            if (diff !== null) {
                return diff / asRoughDays(d);
            }
        }
        return (m1.valueOf() - m0.valueOf()) / asRoughMs(d);
    };
    // Start-Of
    // these DON'T return zoned-dates. only UTC start-of dates
    DateEnv.prototype.startOf = function (m, unit) {
        if (unit === 'year') {
            return this.startOfYear(m);
        }
        if (unit === 'month') {
            return this.startOfMonth(m);
        }
        if (unit === 'week') {
            return this.startOfWeek(m);
        }
        if (unit === 'day') {
            return startOfDay(m);
        }
        if (unit === 'hour') {
            return startOfHour(m);
        }
        if (unit === 'minute') {
            return startOfMinute(m);
        }
        if (unit === 'second') {
            return startOfSecond(m);
        }
        return null;
    };
    DateEnv.prototype.startOfYear = function (m) {
        return this.calendarSystem.arrayToMarker([
            this.calendarSystem.getMarkerYear(m),
        ]);
    };
    DateEnv.prototype.startOfMonth = function (m) {
        return this.calendarSystem.arrayToMarker([
            this.calendarSystem.getMarkerYear(m),
            this.calendarSystem.getMarkerMonth(m),
        ]);
    };
    DateEnv.prototype.startOfWeek = function (m) {
        return this.calendarSystem.arrayToMarker([
            this.calendarSystem.getMarkerYear(m),
            this.calendarSystem.getMarkerMonth(m),
            m.getUTCDate() - ((m.getUTCDay() - this.weekDow + 7) % 7),
        ]);
    };
    // Week Number
    DateEnv.prototype.computeWeekNumber = function (marker) {
        if (this.weekNumberFunc) {
            return this.weekNumberFunc(this.toDate(marker));
        }
        return weekOfYear(marker, this.weekDow, this.weekDoy);
    };
    // TODO: choke on timeZoneName: long
    DateEnv.prototype.format = function (marker, formatter, dateOptions) {
        if (dateOptions === void 0) { dateOptions = {}; }
        return formatter.format({
            marker: marker,
            timeZoneOffset: dateOptions.forcedTzo != null ?
                dateOptions.forcedTzo :
                this.offsetForMarker(marker),
        }, this);
    };
    DateEnv.prototype.formatRange = function (start, end, formatter, dateOptions) {
        if (dateOptions === void 0) { dateOptions = {}; }
        if (dateOptions.isEndExclusive) {
            end = addMs(end, -1);
        }
        return formatter.formatRange({
            marker: start,
            timeZoneOffset: dateOptions.forcedStartTzo != null ?
                dateOptions.forcedStartTzo :
                this.offsetForMarker(start),
        }, {
            marker: end,
            timeZoneOffset: dateOptions.forcedEndTzo != null ?
                dateOptions.forcedEndTzo :
                this.offsetForMarker(end),
        }, this, dateOptions.defaultSeparator);
    };
    /*
    DUMB: the omitTime arg is dumb. if we omit the time, we want to omit the timezone offset. and if we do that,
    might as well use buildIsoString or some other util directly
    */
    DateEnv.prototype.formatIso = function (marker, extraOptions) {
        if (extraOptions === void 0) { extraOptions = {}; }
        var timeZoneOffset = null;
        if (!extraOptions.omitTimeZoneOffset) {
            if (extraOptions.forcedTzo != null) {
                timeZoneOffset = extraOptions.forcedTzo;
            }
            else {
                timeZoneOffset = this.offsetForMarker(marker);
            }
        }
        return buildIsoString(marker, timeZoneOffset, extraOptions.omitTime);
    };
    // TimeZone
    DateEnv.prototype.timestampToMarker = function (ms) {
        if (this.timeZone === 'local') {
            return arrayToUtcDate(dateToLocalArray(new Date(ms)));
        }
        if (this.timeZone === 'UTC' || !this.namedTimeZoneImpl) {
            return new Date(ms);
        }
        return arrayToUtcDate(this.namedTimeZoneImpl.timestampToArray(ms));
    };
    DateEnv.prototype.offsetForMarker = function (m) {
        if (this.timeZone === 'local') {
            return -arrayToLocalDate(dateToUtcArray(m)).getTimezoneOffset(); // convert "inverse" offset to "normal" offset
        }
        if (this.timeZone === 'UTC') {
            return 0;
        }
        if (this.namedTimeZoneImpl) {
            return this.namedTimeZoneImpl.offsetForArray(dateToUtcArray(m));
        }
        return null;
    };
    // Conversion
    DateEnv.prototype.toDate = function (m, forcedTzo) {
        if (this.timeZone === 'local') {
            return arrayToLocalDate(dateToUtcArray(m));
        }
        if (this.timeZone === 'UTC') {
            return new Date(m.valueOf()); // make sure it's a copy
        }
        if (!this.namedTimeZoneImpl) {
            return new Date(m.valueOf() - (forcedTzo || 0));
        }
        return new Date(m.valueOf() -
            this.namedTimeZoneImpl.offsetForArray(dateToUtcArray(m)) * 1000 * 60);
    };
    return DateEnv;
}());

var globalLocales = [];

var MINIMAL_RAW_EN_LOCALE = {
    code: 'en',
    week: {
        dow: 0,
        doy: 4, // 4 days need to be within the year to be considered the first week
    },
    direction: 'ltr',
    buttonText: {
        prev: 'prev',
        next: 'next',
        prevYear: 'prev year',
        nextYear: 'next year',
        year: 'year',
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day',
        list: 'list',
    },
    weekText: 'W',
    weekTextLong: 'Week',
    closeHint: 'Close',
    timeHint: 'Time',
    eventHint: 'Event',
    allDayText: 'all-day',
    moreLinkText: 'more',
    noEventsText: 'No events to display',
};
var RAW_EN_LOCALE = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, MINIMAL_RAW_EN_LOCALE), { 
    // Includes things we don't want other locales to inherit,
    // things that derive from other translatable strings.
    buttonHints: {
        prev: 'Previous $0',
        next: 'Next $0',
        today: function (buttonText, unit) {
            return (unit === 'day')
                ? 'Today'
                : "This " + buttonText;
        },
    }, viewHint: '$0 view', navLinkHint: 'Go to $0', moreLinkHint: function (eventCnt) {
        return "Show " + eventCnt + " more event" + (eventCnt === 1 ? '' : 's');
    } });
function organizeRawLocales(explicitRawLocales) {
    var defaultCode = explicitRawLocales.length > 0 ? explicitRawLocales[0].code : 'en';
    var allRawLocales = globalLocales.concat(explicitRawLocales);
    var rawLocaleMap = {
        en: RAW_EN_LOCALE,
    };
    for (var _i = 0, allRawLocales_1 = allRawLocales; _i < allRawLocales_1.length; _i++) {
        var rawLocale = allRawLocales_1[_i];
        rawLocaleMap[rawLocale.code] = rawLocale;
    }
    return {
        map: rawLocaleMap,
        defaultCode: defaultCode,
    };
}
function buildLocale(inputSingular, available) {
    if (typeof inputSingular === 'object' && !Array.isArray(inputSingular)) {
        return parseLocale(inputSingular.code, [inputSingular.code], inputSingular);
    }
    return queryLocale(inputSingular, available);
}
function queryLocale(codeArg, available) {
    var codes = [].concat(codeArg || []); // will convert to array
    var raw = queryRawLocale(codes, available) || RAW_EN_LOCALE;
    return parseLocale(codeArg, codes, raw);
}
function queryRawLocale(codes, available) {
    for (var i = 0; i < codes.length; i += 1) {
        var parts = codes[i].toLocaleLowerCase().split('-');
        for (var j = parts.length; j > 0; j -= 1) {
            var simpleId = parts.slice(0, j).join('-');
            if (available[simpleId]) {
                return available[simpleId];
            }
        }
    }
    return null;
}
function parseLocale(codeArg, codes, raw) {
    var merged = mergeProps([MINIMAL_RAW_EN_LOCALE, raw], ['buttonText']);
    delete merged.code; // don't want this part of the options
    var week = merged.week;
    delete merged.week;
    return {
        codeArg: codeArg,
        codes: codes,
        week: week,
        simpleNumberFormat: new Intl.NumberFormat(codeArg),
        options: merged,
    };
}

function formatDate(dateInput, options) {
    if (options === void 0) { options = {}; }
    var dateEnv = buildDateEnv$1(options);
    var formatter = createFormatter(options);
    var dateMeta = dateEnv.createMarkerMeta(dateInput);
    if (!dateMeta) { // TODO: warning?
        return '';
    }
    return dateEnv.format(dateMeta.marker, formatter, {
        forcedTzo: dateMeta.forcedTzo,
    });
}
function formatRange(startInput, endInput, options) {
    var dateEnv = buildDateEnv$1(typeof options === 'object' && options ? options : {}); // pass in if non-null object
    var formatter = createFormatter(options);
    var startMeta = dateEnv.createMarkerMeta(startInput);
    var endMeta = dateEnv.createMarkerMeta(endInput);
    if (!startMeta || !endMeta) { // TODO: warning?
        return '';
    }
    return dateEnv.formatRange(startMeta.marker, endMeta.marker, formatter, {
        forcedStartTzo: startMeta.forcedTzo,
        forcedEndTzo: endMeta.forcedTzo,
        isEndExclusive: options.isEndExclusive,
        defaultSeparator: BASE_OPTION_DEFAULTS.defaultRangeSeparator,
    });
}
// TODO: more DRY and optimized
function buildDateEnv$1(settings) {
    var locale = buildLocale(settings.locale || 'en', organizeRawLocales([]).map); // TODO: don't hardcode 'en' everywhere
    return new DateEnv((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ timeZone: BASE_OPTION_DEFAULTS.timeZone, calendarSystem: 'gregory' }, settings), { locale: locale }));
}

var DEF_DEFAULTS = {
    startTime: '09:00',
    endTime: '17:00',
    daysOfWeek: [1, 2, 3, 4, 5],
    display: 'inverse-background',
    classNames: 'fc-non-business',
    groupId: '_businessHours', // so multiple defs get grouped
};
/*
TODO: pass around as EventDefHash!!!
*/
function parseBusinessHours(input, context) {
    return parseEvents(refineInputs(input), null, context);
}
function refineInputs(input) {
    var rawDefs;
    if (input === true) {
        rawDefs = [{}]; // will get DEF_DEFAULTS verbatim
    }
    else if (Array.isArray(input)) {
        // if specifying an array, every sub-definition NEEDS a day-of-week
        rawDefs = input.filter(function (rawDef) { return rawDef.daysOfWeek; });
    }
    else if (typeof input === 'object' && input) { // non-null object
        rawDefs = [input];
    }
    else { // is probably false
        rawDefs = [];
    }
    rawDefs = rawDefs.map(function (rawDef) { return ((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, DEF_DEFAULTS), rawDef)); });
    return rawDefs;
}

function pointInsideRect(point, rect) {
    return point.left >= rect.left &&
        point.left < rect.right &&
        point.top >= rect.top &&
        point.top < rect.bottom;
}
// Returns a new rectangle that is the intersection of the two rectangles. If they don't intersect, returns false
function intersectRects(rect1, rect2) {
    var res = {
        left: Math.max(rect1.left, rect2.left),
        right: Math.min(rect1.right, rect2.right),
        top: Math.max(rect1.top, rect2.top),
        bottom: Math.min(rect1.bottom, rect2.bottom),
    };
    if (res.left < res.right && res.top < res.bottom) {
        return res;
    }
    return false;
}
function translateRect(rect, deltaX, deltaY) {
    return {
        left: rect.left + deltaX,
        right: rect.right + deltaX,
        top: rect.top + deltaY,
        bottom: rect.bottom + deltaY,
    };
}
// Returns a new point that will have been moved to reside within the given rectangle
function constrainPoint(point, rect) {
    return {
        left: Math.min(Math.max(point.left, rect.left), rect.right),
        top: Math.min(Math.max(point.top, rect.top), rect.bottom),
    };
}
// Returns a point that is the center of the given rectangle
function getRectCenter(rect) {
    return {
        left: (rect.left + rect.right) / 2,
        top: (rect.top + rect.bottom) / 2,
    };
}
// Subtracts point2's coordinates from point1's coordinates, returning a delta
function diffPoints(point1, point2) {
    return {
        left: point1.left - point2.left,
        top: point1.top - point2.top,
    };
}

var canVGrowWithinCell;
function getCanVGrowWithinCell() {
    if (canVGrowWithinCell == null) {
        canVGrowWithinCell = computeCanVGrowWithinCell();
    }
    return canVGrowWithinCell;
}
function computeCanVGrowWithinCell() {
    // for SSR, because this function is call immediately at top-level
    // TODO: just make this logic execute top-level, immediately, instead of doing lazily
    if (typeof document === 'undefined') {
        return true;
    }
    var el = document.createElement('div');
    el.style.position = 'absolute';
    el.style.top = '0px';
    el.style.left = '0px';
    el.innerHTML = '<table><tr><td><div></div></td></tr></table>';
    el.querySelector('table').style.height = '100px';
    el.querySelector('div').style.height = '100%';
    document.body.appendChild(el);
    var div = el.querySelector('div');
    var possible = div.offsetHeight > 0;
    document.body.removeChild(el);
    return possible;
}

var EMPTY_EVENT_STORE = createEmptyEventStore(); // for purecomponents. TODO: keep elsewhere
var Splitter = /** @class */ (function () {
    function Splitter() {
        this.getKeysForEventDefs = memoize(this._getKeysForEventDefs);
        this.splitDateSelection = memoize(this._splitDateSpan);
        this.splitEventStore = memoize(this._splitEventStore);
        this.splitIndividualUi = memoize(this._splitIndividualUi);
        this.splitEventDrag = memoize(this._splitInteraction);
        this.splitEventResize = memoize(this._splitInteraction);
        this.eventUiBuilders = {}; // TODO: typescript protection
    }
    Splitter.prototype.splitProps = function (props) {
        var _this = this;
        var keyInfos = this.getKeyInfo(props);
        var defKeys = this.getKeysForEventDefs(props.eventStore);
        var dateSelections = this.splitDateSelection(props.dateSelection);
        var individualUi = this.splitIndividualUi(props.eventUiBases, defKeys); // the individual *bases*
        var eventStores = this.splitEventStore(props.eventStore, defKeys);
        var eventDrags = this.splitEventDrag(props.eventDrag);
        var eventResizes = this.splitEventResize(props.eventResize);
        var splitProps = {};
        this.eventUiBuilders = mapHash(keyInfos, function (info, key) { return _this.eventUiBuilders[key] || memoize(buildEventUiForKey); });
        for (var key in keyInfos) {
            var keyInfo = keyInfos[key];
            var eventStore = eventStores[key] || EMPTY_EVENT_STORE;
            var buildEventUi = this.eventUiBuilders[key];
            splitProps[key] = {
                businessHours: keyInfo.businessHours || props.businessHours,
                dateSelection: dateSelections[key] || null,
                eventStore: eventStore,
                eventUiBases: buildEventUi(props.eventUiBases[''], keyInfo.ui, individualUi[key]),
                eventSelection: eventStore.instances[props.eventSelection] ? props.eventSelection : '',
                eventDrag: eventDrags[key] || null,
                eventResize: eventResizes[key] || null,
            };
        }
        return splitProps;
    };
    Splitter.prototype._splitDateSpan = function (dateSpan) {
        var dateSpans = {};
        if (dateSpan) {
            var keys = this.getKeysForDateSpan(dateSpan);
            for (var _i = 0, keys_1 = keys; _i < keys_1.length; _i++) {
                var key = keys_1[_i];
                dateSpans[key] = dateSpan;
            }
        }
        return dateSpans;
    };
    Splitter.prototype._getKeysForEventDefs = function (eventStore) {
        var _this = this;
        return mapHash(eventStore.defs, function (eventDef) { return _this.getKeysForEventDef(eventDef); });
    };
    Splitter.prototype._splitEventStore = function (eventStore, defKeys) {
        var defs = eventStore.defs, instances = eventStore.instances;
        var splitStores = {};
        for (var defId in defs) {
            for (var _i = 0, _a = defKeys[defId]; _i < _a.length; _i++) {
                var key = _a[_i];
                if (!splitStores[key]) {
                    splitStores[key] = createEmptyEventStore();
                }
                splitStores[key].defs[defId] = defs[defId];
            }
        }
        for (var instanceId in instances) {
            var instance = instances[instanceId];
            for (var _b = 0, _c = defKeys[instance.defId]; _b < _c.length; _b++) {
                var key = _c[_b];
                if (splitStores[key]) { // must have already been created
                    splitStores[key].instances[instanceId] = instance;
                }
            }
        }
        return splitStores;
    };
    Splitter.prototype._splitIndividualUi = function (eventUiBases, defKeys) {
        var splitHashes = {};
        for (var defId in eventUiBases) {
            if (defId) { // not the '' key
                for (var _i = 0, _a = defKeys[defId]; _i < _a.length; _i++) {
                    var key = _a[_i];
                    if (!splitHashes[key]) {
                        splitHashes[key] = {};
                    }
                    splitHashes[key][defId] = eventUiBases[defId];
                }
            }
        }
        return splitHashes;
    };
    Splitter.prototype._splitInteraction = function (interaction) {
        var splitStates = {};
        if (interaction) {
            var affectedStores_1 = this._splitEventStore(interaction.affectedEvents, this._getKeysForEventDefs(interaction.affectedEvents));
            // can't rely on defKeys because event data is mutated
            var mutatedKeysByDefId = this._getKeysForEventDefs(interaction.mutatedEvents);
            var mutatedStores_1 = this._splitEventStore(interaction.mutatedEvents, mutatedKeysByDefId);
            var populate = function (key) {
                if (!splitStates[key]) {
                    splitStates[key] = {
                        affectedEvents: affectedStores_1[key] || EMPTY_EVENT_STORE,
                        mutatedEvents: mutatedStores_1[key] || EMPTY_EVENT_STORE,
                        isEvent: interaction.isEvent,
                    };
                }
            };
            for (var key in affectedStores_1) {
                populate(key);
            }
            for (var key in mutatedStores_1) {
                populate(key);
            }
        }
        return splitStates;
    };
    return Splitter;
}());
function buildEventUiForKey(allUi, eventUiForKey, individualUi) {
    var baseParts = [];
    if (allUi) {
        baseParts.push(allUi);
    }
    if (eventUiForKey) {
        baseParts.push(eventUiForKey);
    }
    var stuff = {
        '': combineEventUis(baseParts),
    };
    if (individualUi) {
        (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(stuff, individualUi);
    }
    return stuff;
}

function getDateMeta(date, todayRange, nowDate, dateProfile) {
    return {
        dow: date.getUTCDay(),
        isDisabled: Boolean(dateProfile && !rangeContainsMarker(dateProfile.activeRange, date)),
        isOther: Boolean(dateProfile && !rangeContainsMarker(dateProfile.currentRange, date)),
        isToday: Boolean(todayRange && rangeContainsMarker(todayRange, date)),
        isPast: Boolean(nowDate ? (date < nowDate) : todayRange ? (date < todayRange.start) : false),
        isFuture: Boolean(nowDate ? (date > nowDate) : todayRange ? (date >= todayRange.end) : false),
    };
}
function getDayClassNames(meta, theme) {
    var classNames = [
        'fc-day',
        "fc-day-" + DAY_IDS[meta.dow],
    ];
    if (meta.isDisabled) {
        classNames.push('fc-day-disabled');
    }
    else {
        if (meta.isToday) {
            classNames.push('fc-day-today');
            classNames.push(theme.getClass('today'));
        }
        if (meta.isPast) {
            classNames.push('fc-day-past');
        }
        if (meta.isFuture) {
            classNames.push('fc-day-future');
        }
        if (meta.isOther) {
            classNames.push('fc-day-other');
        }
    }
    return classNames;
}
function getSlotClassNames(meta, theme) {
    var classNames = [
        'fc-slot',
        "fc-slot-" + DAY_IDS[meta.dow],
    ];
    if (meta.isDisabled) {
        classNames.push('fc-slot-disabled');
    }
    else {
        if (meta.isToday) {
            classNames.push('fc-slot-today');
            classNames.push(theme.getClass('today'));
        }
        if (meta.isPast) {
            classNames.push('fc-slot-past');
        }
        if (meta.isFuture) {
            classNames.push('fc-slot-future');
        }
    }
    return classNames;
}

var DAY_FORMAT = createFormatter({ year: 'numeric', month: 'long', day: 'numeric' });
var WEEK_FORMAT = createFormatter({ week: 'long' });
function buildNavLinkAttrs(context, dateMarker, viewType, isTabbable) {
    if (viewType === void 0) { viewType = 'day'; }
    if (isTabbable === void 0) { isTabbable = true; }
    var dateEnv = context.dateEnv, options = context.options, calendarApi = context.calendarApi;
    var dateStr = dateEnv.format(dateMarker, viewType === 'week' ? WEEK_FORMAT : DAY_FORMAT);
    if (options.navLinks) {
        var zonedDate = dateEnv.toDate(dateMarker);
        var handleInteraction = function (ev) {
            var customAction = viewType === 'day' ? options.navLinkDayClick :
                viewType === 'week' ? options.navLinkWeekClick : null;
            if (typeof customAction === 'function') {
                customAction.call(calendarApi, dateEnv.toDate(dateMarker), ev);
            }
            else {
                if (typeof customAction === 'string') {
                    viewType = customAction;
                }
                calendarApi.zoomTo(dateMarker, viewType);
            }
        };
        return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ title: formatWithOrdinals(options.navLinkHint, [dateStr, zonedDate], dateStr), 'data-navlink': '' }, (isTabbable
            ? createAriaClickAttrs(handleInteraction)
            : { onClick: handleInteraction }));
    }
    return { 'aria-label': dateStr };
}

var _isRtlScrollbarOnLeft = null;
function getIsRtlScrollbarOnLeft() {
    if (_isRtlScrollbarOnLeft === null) {
        _isRtlScrollbarOnLeft = computeIsRtlScrollbarOnLeft();
    }
    return _isRtlScrollbarOnLeft;
}
function computeIsRtlScrollbarOnLeft() {
    var outerEl = document.createElement('div');
    applyStyle(outerEl, {
        position: 'absolute',
        top: -1000,
        left: 0,
        border: 0,
        padding: 0,
        overflow: 'scroll',
        direction: 'rtl',
    });
    outerEl.innerHTML = '<div></div>';
    document.body.appendChild(outerEl);
    var innerEl = outerEl.firstChild;
    var res = innerEl.getBoundingClientRect().left > outerEl.getBoundingClientRect().left;
    removeElement(outerEl);
    return res;
}

var _scrollbarWidths;
function getScrollbarWidths() {
    if (!_scrollbarWidths) {
        _scrollbarWidths = computeScrollbarWidths();
    }
    return _scrollbarWidths;
}
function computeScrollbarWidths() {
    var el = document.createElement('div');
    el.style.overflow = 'scroll';
    el.style.position = 'absolute';
    el.style.top = '-9999px';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    var res = computeScrollbarWidthsForEl(el);
    document.body.removeChild(el);
    return res;
}
// WARNING: will include border
function computeScrollbarWidthsForEl(el) {
    return {
        x: el.offsetHeight - el.clientHeight,
        y: el.offsetWidth - el.clientWidth,
    };
}

function computeEdges(el, getPadding) {
    if (getPadding === void 0) { getPadding = false; }
    var computedStyle = window.getComputedStyle(el);
    var borderLeft = parseInt(computedStyle.borderLeftWidth, 10) || 0;
    var borderRight = parseInt(computedStyle.borderRightWidth, 10) || 0;
    var borderTop = parseInt(computedStyle.borderTopWidth, 10) || 0;
    var borderBottom = parseInt(computedStyle.borderBottomWidth, 10) || 0;
    var badScrollbarWidths = computeScrollbarWidthsForEl(el); // includes border!
    var scrollbarLeftRight = badScrollbarWidths.y - borderLeft - borderRight;
    var scrollbarBottom = badScrollbarWidths.x - borderTop - borderBottom;
    var res = {
        borderLeft: borderLeft,
        borderRight: borderRight,
        borderTop: borderTop,
        borderBottom: borderBottom,
        scrollbarBottom: scrollbarBottom,
        scrollbarLeft: 0,
        scrollbarRight: 0,
    };
    if (getIsRtlScrollbarOnLeft() && computedStyle.direction === 'rtl') { // is the scrollbar on the left side?
        res.scrollbarLeft = scrollbarLeftRight;
    }
    else {
        res.scrollbarRight = scrollbarLeftRight;
    }
    if (getPadding) {
        res.paddingLeft = parseInt(computedStyle.paddingLeft, 10) || 0;
        res.paddingRight = parseInt(computedStyle.paddingRight, 10) || 0;
        res.paddingTop = parseInt(computedStyle.paddingTop, 10) || 0;
        res.paddingBottom = parseInt(computedStyle.paddingBottom, 10) || 0;
    }
    return res;
}
function computeInnerRect(el, goWithinPadding, doFromWindowViewport) {
    if (goWithinPadding === void 0) { goWithinPadding = false; }
    var outerRect = doFromWindowViewport ? el.getBoundingClientRect() : computeRect(el);
    var edges = computeEdges(el, goWithinPadding);
    var res = {
        left: outerRect.left + edges.borderLeft + edges.scrollbarLeft,
        right: outerRect.right - edges.borderRight - edges.scrollbarRight,
        top: outerRect.top + edges.borderTop,
        bottom: outerRect.bottom - edges.borderBottom - edges.scrollbarBottom,
    };
    if (goWithinPadding) {
        res.left += edges.paddingLeft;
        res.right -= edges.paddingRight;
        res.top += edges.paddingTop;
        res.bottom -= edges.paddingBottom;
    }
    return res;
}
function computeRect(el) {
    var rect = el.getBoundingClientRect();
    return {
        left: rect.left + window.pageXOffset,
        top: rect.top + window.pageYOffset,
        right: rect.right + window.pageXOffset,
        bottom: rect.bottom + window.pageYOffset,
    };
}
function computeClippedClientRect(el) {
    var clippingParents = getClippingParents(el);
    var rect = el.getBoundingClientRect();
    for (var _i = 0, clippingParents_1 = clippingParents; _i < clippingParents_1.length; _i++) {
        var clippingParent = clippingParents_1[_i];
        var intersection = intersectRects(rect, clippingParent.getBoundingClientRect());
        if (intersection) {
            rect = intersection;
        }
        else {
            return null;
        }
    }
    return rect;
}
function computeHeightAndMargins(el) {
    return el.getBoundingClientRect().height + computeVMargins(el);
}
function computeVMargins(el) {
    var computed = window.getComputedStyle(el);
    return parseInt(computed.marginTop, 10) +
        parseInt(computed.marginBottom, 10);
}
// does not return window
function getClippingParents(el) {
    var parents = [];
    while (el instanceof HTMLElement) { // will stop when gets to document or null
        var computedStyle = window.getComputedStyle(el);
        if (computedStyle.position === 'fixed') {
            break;
        }
        if ((/(auto|scroll)/).test(computedStyle.overflow + computedStyle.overflowY + computedStyle.overflowX)) {
            parents.push(el);
        }
        el = el.parentNode;
    }
    return parents;
}

// given a function that resolves a result asynchronously.
// the function can either call passed-in success and failure callbacks,
// or it can return a promise.
// if you need to pass additional params to func, bind them first.
function unpromisify(func, success, failure) {
    // guard against success/failure callbacks being called more than once
    // and guard against a promise AND callback being used together.
    var isResolved = false;
    var wrappedSuccess = function () {
        if (!isResolved) {
            isResolved = true;
            success.apply(this, arguments); // eslint-disable-line prefer-rest-params
        }
    };
    var wrappedFailure = function () {
        if (!isResolved) {
            isResolved = true;
            if (failure) {
                failure.apply(this, arguments); // eslint-disable-line prefer-rest-params
            }
        }
    };
    var res = func(wrappedSuccess, wrappedFailure);
    if (res && typeof res.then === 'function') {
        res.then(wrappedSuccess, wrappedFailure);
    }
}

var Emitter = /** @class */ (function () {
    function Emitter() {
        this.handlers = {};
        this.thisContext = null;
    }
    Emitter.prototype.setThisContext = function (thisContext) {
        this.thisContext = thisContext;
    };
    Emitter.prototype.setOptions = function (options) {
        this.options = options;
    };
    Emitter.prototype.on = function (type, handler) {
        addToHash(this.handlers, type, handler);
    };
    Emitter.prototype.off = function (type, handler) {
        removeFromHash(this.handlers, type, handler);
    };
    Emitter.prototype.trigger = function (type) {
        var args = [];
        for (var _i = 1; _i < arguments.length; _i++) {
            args[_i - 1] = arguments[_i];
        }
        var attachedHandlers = this.handlers[type] || [];
        var optionHandler = this.options && this.options[type];
        var handlers = [].concat(optionHandler || [], attachedHandlers);
        for (var _a = 0, handlers_1 = handlers; _a < handlers_1.length; _a++) {
            var handler = handlers_1[_a];
            handler.apply(this.thisContext, args);
        }
    };
    Emitter.prototype.hasHandlers = function (type) {
        return Boolean((this.handlers[type] && this.handlers[type].length) ||
            (this.options && this.options[type]));
    };
    return Emitter;
}());
function addToHash(hash, type, handler) {
    (hash[type] || (hash[type] = []))
        .push(handler);
}
function removeFromHash(hash, type, handler) {
    if (handler) {
        if (hash[type]) {
            hash[type] = hash[type].filter(function (func) { return func !== handler; });
        }
    }
    else {
        delete hash[type]; // remove all handler funcs for this type
    }
}

/*
Records offset information for a set of elements, relative to an origin element.
Can record the left/right OR the top/bottom OR both.
Provides methods for querying the cache by position.
*/
var PositionCache = /** @class */ (function () {
    function PositionCache(originEl, els, isHorizontal, isVertical) {
        this.els = els;
        var originClientRect = this.originClientRect = originEl.getBoundingClientRect(); // relative to viewport top-left
        if (isHorizontal) {
            this.buildElHorizontals(originClientRect.left);
        }
        if (isVertical) {
            this.buildElVerticals(originClientRect.top);
        }
    }
    // Populates the left/right internal coordinate arrays
    PositionCache.prototype.buildElHorizontals = function (originClientLeft) {
        var lefts = [];
        var rights = [];
        for (var _i = 0, _a = this.els; _i < _a.length; _i++) {
            var el = _a[_i];
            var rect = el.getBoundingClientRect();
            lefts.push(rect.left - originClientLeft);
            rights.push(rect.right - originClientLeft);
        }
        this.lefts = lefts;
        this.rights = rights;
    };
    // Populates the top/bottom internal coordinate arrays
    PositionCache.prototype.buildElVerticals = function (originClientTop) {
        var tops = [];
        var bottoms = [];
        for (var _i = 0, _a = this.els; _i < _a.length; _i++) {
            var el = _a[_i];
            var rect = el.getBoundingClientRect();
            tops.push(rect.top - originClientTop);
            bottoms.push(rect.bottom - originClientTop);
        }
        this.tops = tops;
        this.bottoms = bottoms;
    };
    // Given a left offset (from document left), returns the index of the el that it horizontally intersects.
    // If no intersection is made, returns undefined.
    PositionCache.prototype.leftToIndex = function (leftPosition) {
        var _a = this, lefts = _a.lefts, rights = _a.rights;
        var len = lefts.length;
        var i;
        for (i = 0; i < len; i += 1) {
            if (leftPosition >= lefts[i] && leftPosition < rights[i]) {
                return i;
            }
        }
        return undefined; // TODO: better
    };
    // Given a top offset (from document top), returns the index of the el that it vertically intersects.
    // If no intersection is made, returns undefined.
    PositionCache.prototype.topToIndex = function (topPosition) {
        var _a = this, tops = _a.tops, bottoms = _a.bottoms;
        var len = tops.length;
        var i;
        for (i = 0; i < len; i += 1) {
            if (topPosition >= tops[i] && topPosition < bottoms[i]) {
                return i;
            }
        }
        return undefined; // TODO: better
    };
    // Gets the width of the element at the given index
    PositionCache.prototype.getWidth = function (leftIndex) {
        return this.rights[leftIndex] - this.lefts[leftIndex];
    };
    // Gets the height of the element at the given index
    PositionCache.prototype.getHeight = function (topIndex) {
        return this.bottoms[topIndex] - this.tops[topIndex];
    };
    return PositionCache;
}());

/* eslint max-classes-per-file: "off" */
/*
An object for getting/setting scroll-related information for an element.
Internally, this is done very differently for window versus DOM element,
so this object serves as a common interface.
*/
var ScrollController = /** @class */ (function () {
    function ScrollController() {
    }
    ScrollController.prototype.getMaxScrollTop = function () {
        return this.getScrollHeight() - this.getClientHeight();
    };
    ScrollController.prototype.getMaxScrollLeft = function () {
        return this.getScrollWidth() - this.getClientWidth();
    };
    ScrollController.prototype.canScrollVertically = function () {
        return this.getMaxScrollTop() > 0;
    };
    ScrollController.prototype.canScrollHorizontally = function () {
        return this.getMaxScrollLeft() > 0;
    };
    ScrollController.prototype.canScrollUp = function () {
        return this.getScrollTop() > 0;
    };
    ScrollController.prototype.canScrollDown = function () {
        return this.getScrollTop() < this.getMaxScrollTop();
    };
    ScrollController.prototype.canScrollLeft = function () {
        return this.getScrollLeft() > 0;
    };
    ScrollController.prototype.canScrollRight = function () {
        return this.getScrollLeft() < this.getMaxScrollLeft();
    };
    return ScrollController;
}());
var ElementScrollController = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ElementScrollController, _super);
    function ElementScrollController(el) {
        var _this = _super.call(this) || this;
        _this.el = el;
        return _this;
    }
    ElementScrollController.prototype.getScrollTop = function () {
        return this.el.scrollTop;
    };
    ElementScrollController.prototype.getScrollLeft = function () {
        return this.el.scrollLeft;
    };
    ElementScrollController.prototype.setScrollTop = function (top) {
        this.el.scrollTop = top;
    };
    ElementScrollController.prototype.setScrollLeft = function (left) {
        this.el.scrollLeft = left;
    };
    ElementScrollController.prototype.getScrollWidth = function () {
        return this.el.scrollWidth;
    };
    ElementScrollController.prototype.getScrollHeight = function () {
        return this.el.scrollHeight;
    };
    ElementScrollController.prototype.getClientHeight = function () {
        return this.el.clientHeight;
    };
    ElementScrollController.prototype.getClientWidth = function () {
        return this.el.clientWidth;
    };
    return ElementScrollController;
}(ScrollController));
var WindowScrollController = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(WindowScrollController, _super);
    function WindowScrollController() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    WindowScrollController.prototype.getScrollTop = function () {
        return window.pageYOffset;
    };
    WindowScrollController.prototype.getScrollLeft = function () {
        return window.pageXOffset;
    };
    WindowScrollController.prototype.setScrollTop = function (n) {
        window.scroll(window.pageXOffset, n);
    };
    WindowScrollController.prototype.setScrollLeft = function (n) {
        window.scroll(n, window.pageYOffset);
    };
    WindowScrollController.prototype.getScrollWidth = function () {
        return document.documentElement.scrollWidth;
    };
    WindowScrollController.prototype.getScrollHeight = function () {
        return document.documentElement.scrollHeight;
    };
    WindowScrollController.prototype.getClientHeight = function () {
        return document.documentElement.clientHeight;
    };
    WindowScrollController.prototype.getClientWidth = function () {
        return document.documentElement.clientWidth;
    };
    return WindowScrollController;
}(ScrollController));

var Theme = /** @class */ (function () {
    function Theme(calendarOptions) {
        if (this.iconOverrideOption) {
            this.setIconOverride(calendarOptions[this.iconOverrideOption]);
        }
    }
    Theme.prototype.setIconOverride = function (iconOverrideHash) {
        var iconClassesCopy;
        var buttonName;
        if (typeof iconOverrideHash === 'object' && iconOverrideHash) { // non-null object
            iconClassesCopy = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, this.iconClasses);
            for (buttonName in iconOverrideHash) {
                iconClassesCopy[buttonName] = this.applyIconOverridePrefix(iconOverrideHash[buttonName]);
            }
            this.iconClasses = iconClassesCopy;
        }
        else if (iconOverrideHash === false) {
            this.iconClasses = {};
        }
    };
    Theme.prototype.applyIconOverridePrefix = function (className) {
        var prefix = this.iconOverridePrefix;
        if (prefix && className.indexOf(prefix) !== 0) { // if not already present
            className = prefix + className;
        }
        return className;
    };
    Theme.prototype.getClass = function (key) {
        return this.classes[key] || '';
    };
    Theme.prototype.getIconClass = function (buttonName, isRtl) {
        var className;
        if (isRtl && this.rtlIconClasses) {
            className = this.rtlIconClasses[buttonName] || this.iconClasses[buttonName];
        }
        else {
            className = this.iconClasses[buttonName];
        }
        if (className) {
            return this.baseIconClass + " " + className;
        }
        return '';
    };
    Theme.prototype.getCustomButtonIconClass = function (customButtonProps) {
        var className;
        if (this.iconOverrideCustomButtonOption) {
            className = customButtonProps[this.iconOverrideCustomButtonOption];
            if (className) {
                return this.baseIconClass + " " + this.applyIconOverridePrefix(className);
            }
        }
        return '';
    };
    return Theme;
}());
Theme.prototype.classes = {};
Theme.prototype.iconClasses = {};
Theme.prototype.baseIconClass = '';
Theme.prototype.iconOverridePrefix = '';

var ScrollResponder = /** @class */ (function () {
    function ScrollResponder(execFunc, emitter, scrollTime, scrollTimeReset) {
        var _this = this;
        this.execFunc = execFunc;
        this.emitter = emitter;
        this.scrollTime = scrollTime;
        this.scrollTimeReset = scrollTimeReset;
        this.handleScrollRequest = function (request) {
            _this.queuedRequest = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, _this.queuedRequest || {}, request);
            _this.drain();
        };
        emitter.on('_scrollRequest', this.handleScrollRequest);
        this.fireInitialScroll();
    }
    ScrollResponder.prototype.detach = function () {
        this.emitter.off('_scrollRequest', this.handleScrollRequest);
    };
    ScrollResponder.prototype.update = function (isDatesNew) {
        if (isDatesNew && this.scrollTimeReset) {
            this.fireInitialScroll(); // will drain
        }
        else {
            this.drain();
        }
    };
    ScrollResponder.prototype.fireInitialScroll = function () {
        this.handleScrollRequest({
            time: this.scrollTime,
        });
    };
    ScrollResponder.prototype.drain = function () {
        if (this.queuedRequest && this.execFunc(this.queuedRequest)) {
            this.queuedRequest = null;
        }
    };
    return ScrollResponder;
}());

var ViewContextType = (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createContext)({}); // for Components
function buildViewContext(viewSpec, viewApi, viewOptions, dateProfileGenerator, dateEnv, theme, pluginHooks, dispatch, getCurrentData, emitter, calendarApi, registerInteractiveComponent, unregisterInteractiveComponent) {
    return {
        dateEnv: dateEnv,
        options: viewOptions,
        pluginHooks: pluginHooks,
        emitter: emitter,
        dispatch: dispatch,
        getCurrentData: getCurrentData,
        calendarApi: calendarApi,
        viewSpec: viewSpec,
        viewApi: viewApi,
        dateProfileGenerator: dateProfileGenerator,
        theme: theme,
        isRtl: viewOptions.direction === 'rtl',
        addResizeHandler: function (handler) {
            emitter.on('_resize', handler);
        },
        removeResizeHandler: function (handler) {
            emitter.off('_resize', handler);
        },
        createScrollResponder: function (execFunc) {
            return new ScrollResponder(execFunc, emitter, createDuration(viewOptions.scrollTime), viewOptions.scrollTimeReset);
        },
        registerInteractiveComponent: registerInteractiveComponent,
        unregisterInteractiveComponent: unregisterInteractiveComponent,
    };
}

/* eslint max-classes-per-file: off */
var PureComponent = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(PureComponent, _super);
    function PureComponent() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    PureComponent.prototype.shouldComponentUpdate = function (nextProps, nextState) {
        if (this.debug) {
            // eslint-disable-next-line no-console
            console.log(getUnequalProps(nextProps, this.props), getUnequalProps(nextState, this.state));
        }
        return !compareObjs(this.props, nextProps, this.propEquality) ||
            !compareObjs(this.state, nextState, this.stateEquality);
    };
    // HACK for freakin' React StrictMode
    PureComponent.prototype.safeSetState = function (newState) {
        if (!compareObjs(this.state, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, this.state), newState), this.stateEquality)) {
            this.setState(newState);
        }
    };
    PureComponent.addPropsEquality = addPropsEquality;
    PureComponent.addStateEquality = addStateEquality;
    PureComponent.contextType = ViewContextType;
    return PureComponent;
}(_vdom_js__WEBPACK_IMPORTED_MODULE_1__.Component));
PureComponent.prototype.propEquality = {};
PureComponent.prototype.stateEquality = {};
var BaseComponent = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(BaseComponent, _super);
    function BaseComponent() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    BaseComponent.contextType = ViewContextType;
    return BaseComponent;
}(PureComponent));
function addPropsEquality(propEquality) {
    var hash = Object.create(this.prototype.propEquality);
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(hash, propEquality);
    this.prototype.propEquality = hash;
}
function addStateEquality(stateEquality) {
    var hash = Object.create(this.prototype.stateEquality);
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(hash, stateEquality);
    this.prototype.stateEquality = hash;
}
// use other one
function setRef(ref, current) {
    if (typeof ref === 'function') {
        ref(current);
    }
    else if (ref) {
        // see https://github.com/facebook/react/issues/13029
        ref.current = current;
    }
}

/*
an INTERACTABLE date component

PURPOSES:
- hook up to fg, fill, and mirror renderers
- interface for dragging and hits
*/
var DateComponent = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(DateComponent, _super);
    function DateComponent() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.uid = guid();
        return _this;
    }
    // Hit System
    // -----------------------------------------------------------------------------------------------------------------
    DateComponent.prototype.prepareHits = function () {
    };
    DateComponent.prototype.queryHit = function (positionLeft, positionTop, elWidth, elHeight) {
        return null; // this should be abstract
    };
    // Pointer Interaction Utils
    // -----------------------------------------------------------------------------------------------------------------
    DateComponent.prototype.isValidSegDownEl = function (el) {
        return !this.props.eventDrag && // HACK
            !this.props.eventResize && // HACK
            !elementClosest(el, '.fc-event-mirror');
    };
    DateComponent.prototype.isValidDateDownEl = function (el) {
        return !elementClosest(el, '.fc-event:not(.fc-bg-event)') &&
            !elementClosest(el, '.fc-more-link') && // a "more.." link
            !elementClosest(el, 'a[data-navlink]') && // a clickable nav link
            !elementClosest(el, '.fc-popover'); // hack
    };
    return DateComponent;
}(BaseComponent));

// TODO: easier way to add new hooks? need to update a million things
function createPlugin(input) {
    return {
        id: guid(),
        deps: input.deps || [],
        reducers: input.reducers || [],
        isLoadingFuncs: input.isLoadingFuncs || [],
        contextInit: [].concat(input.contextInit || []),
        eventRefiners: input.eventRefiners || {},
        eventDefMemberAdders: input.eventDefMemberAdders || [],
        eventSourceRefiners: input.eventSourceRefiners || {},
        isDraggableTransformers: input.isDraggableTransformers || [],
        eventDragMutationMassagers: input.eventDragMutationMassagers || [],
        eventDefMutationAppliers: input.eventDefMutationAppliers || [],
        dateSelectionTransformers: input.dateSelectionTransformers || [],
        datePointTransforms: input.datePointTransforms || [],
        dateSpanTransforms: input.dateSpanTransforms || [],
        views: input.views || {},
        viewPropsTransformers: input.viewPropsTransformers || [],
        isPropsValid: input.isPropsValid || null,
        externalDefTransforms: input.externalDefTransforms || [],
        viewContainerAppends: input.viewContainerAppends || [],
        eventDropTransformers: input.eventDropTransformers || [],
        componentInteractions: input.componentInteractions || [],
        calendarInteractions: input.calendarInteractions || [],
        themeClasses: input.themeClasses || {},
        eventSourceDefs: input.eventSourceDefs || [],
        cmdFormatter: input.cmdFormatter,
        recurringTypes: input.recurringTypes || [],
        namedTimeZonedImpl: input.namedTimeZonedImpl,
        initialView: input.initialView || '',
        elementDraggingImpl: input.elementDraggingImpl,
        optionChangeHandlers: input.optionChangeHandlers || {},
        scrollGridImpl: input.scrollGridImpl || null,
        contentTypeHandlers: input.contentTypeHandlers || {},
        listenerRefiners: input.listenerRefiners || {},
        optionRefiners: input.optionRefiners || {},
        propSetHandlers: input.propSetHandlers || {},
    };
}
function buildPluginHooks(pluginDefs, globalDefs) {
    var isAdded = {};
    var hooks = {
        reducers: [],
        isLoadingFuncs: [],
        contextInit: [],
        eventRefiners: {},
        eventDefMemberAdders: [],
        eventSourceRefiners: {},
        isDraggableTransformers: [],
        eventDragMutationMassagers: [],
        eventDefMutationAppliers: [],
        dateSelectionTransformers: [],
        datePointTransforms: [],
        dateSpanTransforms: [],
        views: {},
        viewPropsTransformers: [],
        isPropsValid: null,
        externalDefTransforms: [],
        viewContainerAppends: [],
        eventDropTransformers: [],
        componentInteractions: [],
        calendarInteractions: [],
        themeClasses: {},
        eventSourceDefs: [],
        cmdFormatter: null,
        recurringTypes: [],
        namedTimeZonedImpl: null,
        initialView: '',
        elementDraggingImpl: null,
        optionChangeHandlers: {},
        scrollGridImpl: null,
        contentTypeHandlers: {},
        listenerRefiners: {},
        optionRefiners: {},
        propSetHandlers: {},
    };
    function addDefs(defs) {
        for (var _i = 0, defs_1 = defs; _i < defs_1.length; _i++) {
            var def = defs_1[_i];
            if (!isAdded[def.id]) {
                isAdded[def.id] = true;
                addDefs(def.deps);
                hooks = combineHooks(hooks, def);
            }
        }
    }
    if (pluginDefs) {
        addDefs(pluginDefs);
    }
    addDefs(globalDefs);
    return hooks;
}
function buildBuildPluginHooks() {
    var currentOverrideDefs = [];
    var currentGlobalDefs = [];
    var currentHooks;
    return function (overrideDefs, globalDefs) {
        if (!currentHooks || !isArraysEqual(overrideDefs, currentOverrideDefs) || !isArraysEqual(globalDefs, currentGlobalDefs)) {
            currentHooks = buildPluginHooks(overrideDefs, globalDefs);
        }
        currentOverrideDefs = overrideDefs;
        currentGlobalDefs = globalDefs;
        return currentHooks;
    };
}
function combineHooks(hooks0, hooks1) {
    return {
        reducers: hooks0.reducers.concat(hooks1.reducers),
        isLoadingFuncs: hooks0.isLoadingFuncs.concat(hooks1.isLoadingFuncs),
        contextInit: hooks0.contextInit.concat(hooks1.contextInit),
        eventRefiners: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.eventRefiners), hooks1.eventRefiners),
        eventDefMemberAdders: hooks0.eventDefMemberAdders.concat(hooks1.eventDefMemberAdders),
        eventSourceRefiners: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.eventSourceRefiners), hooks1.eventSourceRefiners),
        isDraggableTransformers: hooks0.isDraggableTransformers.concat(hooks1.isDraggableTransformers),
        eventDragMutationMassagers: hooks0.eventDragMutationMassagers.concat(hooks1.eventDragMutationMassagers),
        eventDefMutationAppliers: hooks0.eventDefMutationAppliers.concat(hooks1.eventDefMutationAppliers),
        dateSelectionTransformers: hooks0.dateSelectionTransformers.concat(hooks1.dateSelectionTransformers),
        datePointTransforms: hooks0.datePointTransforms.concat(hooks1.datePointTransforms),
        dateSpanTransforms: hooks0.dateSpanTransforms.concat(hooks1.dateSpanTransforms),
        views: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.views), hooks1.views),
        viewPropsTransformers: hooks0.viewPropsTransformers.concat(hooks1.viewPropsTransformers),
        isPropsValid: hooks1.isPropsValid || hooks0.isPropsValid,
        externalDefTransforms: hooks0.externalDefTransforms.concat(hooks1.externalDefTransforms),
        viewContainerAppends: hooks0.viewContainerAppends.concat(hooks1.viewContainerAppends),
        eventDropTransformers: hooks0.eventDropTransformers.concat(hooks1.eventDropTransformers),
        calendarInteractions: hooks0.calendarInteractions.concat(hooks1.calendarInteractions),
        componentInteractions: hooks0.componentInteractions.concat(hooks1.componentInteractions),
        themeClasses: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.themeClasses), hooks1.themeClasses),
        eventSourceDefs: hooks0.eventSourceDefs.concat(hooks1.eventSourceDefs),
        cmdFormatter: hooks1.cmdFormatter || hooks0.cmdFormatter,
        recurringTypes: hooks0.recurringTypes.concat(hooks1.recurringTypes),
        namedTimeZonedImpl: hooks1.namedTimeZonedImpl || hooks0.namedTimeZonedImpl,
        initialView: hooks0.initialView || hooks1.initialView,
        elementDraggingImpl: hooks0.elementDraggingImpl || hooks1.elementDraggingImpl,
        optionChangeHandlers: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.optionChangeHandlers), hooks1.optionChangeHandlers),
        scrollGridImpl: hooks1.scrollGridImpl || hooks0.scrollGridImpl,
        contentTypeHandlers: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.contentTypeHandlers), hooks1.contentTypeHandlers),
        listenerRefiners: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.listenerRefiners), hooks1.listenerRefiners),
        optionRefiners: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.optionRefiners), hooks1.optionRefiners),
        propSetHandlers: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, hooks0.propSetHandlers), hooks1.propSetHandlers),
    };
}

var StandardTheme = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(StandardTheme, _super);
    function StandardTheme() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    return StandardTheme;
}(Theme));
StandardTheme.prototype.classes = {
    root: 'fc-theme-standard',
    tableCellShaded: 'fc-cell-shaded',
    buttonGroup: 'fc-button-group',
    button: 'fc-button fc-button-primary',
    buttonActive: 'fc-button-active',
};
StandardTheme.prototype.baseIconClass = 'fc-icon';
StandardTheme.prototype.iconClasses = {
    close: 'fc-icon-x',
    prev: 'fc-icon-chevron-left',
    next: 'fc-icon-chevron-right',
    prevYear: 'fc-icon-chevrons-left',
    nextYear: 'fc-icon-chevrons-right',
};
StandardTheme.prototype.rtlIconClasses = {
    prev: 'fc-icon-chevron-right',
    next: 'fc-icon-chevron-left',
    prevYear: 'fc-icon-chevrons-right',
    nextYear: 'fc-icon-chevrons-left',
};
StandardTheme.prototype.iconOverrideOption = 'buttonIcons'; // TODO: make TS-friendly
StandardTheme.prototype.iconOverrideCustomButtonOption = 'icon';
StandardTheme.prototype.iconOverridePrefix = 'fc-icon-';

function compileViewDefs(defaultConfigs, overrideConfigs) {
    var hash = {};
    var viewType;
    for (viewType in defaultConfigs) {
        ensureViewDef(viewType, hash, defaultConfigs, overrideConfigs);
    }
    for (viewType in overrideConfigs) {
        ensureViewDef(viewType, hash, defaultConfigs, overrideConfigs);
    }
    return hash;
}
function ensureViewDef(viewType, hash, defaultConfigs, overrideConfigs) {
    if (hash[viewType]) {
        return hash[viewType];
    }
    var viewDef = buildViewDef(viewType, hash, defaultConfigs, overrideConfigs);
    if (viewDef) {
        hash[viewType] = viewDef;
    }
    return viewDef;
}
function buildViewDef(viewType, hash, defaultConfigs, overrideConfigs) {
    var defaultConfig = defaultConfigs[viewType];
    var overrideConfig = overrideConfigs[viewType];
    var queryProp = function (name) { return ((defaultConfig && defaultConfig[name] !== null) ? defaultConfig[name] :
        ((overrideConfig && overrideConfig[name] !== null) ? overrideConfig[name] : null)); };
    var theComponent = queryProp('component');
    var superType = queryProp('superType');
    var superDef = null;
    if (superType) {
        if (superType === viewType) {
            throw new Error('Can\'t have a custom view type that references itself');
        }
        superDef = ensureViewDef(superType, hash, defaultConfigs, overrideConfigs);
    }
    if (!theComponent && superDef) {
        theComponent = superDef.component;
    }
    if (!theComponent) {
        return null; // don't throw a warning, might be settings for a single-unit view
    }
    return {
        type: viewType,
        component: theComponent,
        defaults: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, (superDef ? superDef.defaults : {})), (defaultConfig ? defaultConfig.rawOptions : {})),
        overrides: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, (superDef ? superDef.overrides : {})), (overrideConfig ? overrideConfig.rawOptions : {})),
    };
}

/* eslint max-classes-per-file: off */
// NOTE: in JSX, you should always use this class with <HookProps> arg. otherwise, will default to any???
var RenderHook = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(RenderHook, _super);
    function RenderHook() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.rootElRef = (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.handleRootEl = function (el) {
            setRef(_this.rootElRef, el);
            if (_this.props.elRef) {
                setRef(_this.props.elRef, el);
            }
        };
        return _this;
    }
    RenderHook.prototype.render = function () {
        var _this = this;
        var props = this.props;
        var hookProps = props.hookProps;
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(MountHook, { hookProps: hookProps, didMount: props.didMount, willUnmount: props.willUnmount, elRef: this.handleRootEl }, function (rootElRef) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ContentHook, { hookProps: hookProps, content: props.content, defaultContent: props.defaultContent, backupElRef: _this.rootElRef }, function (innerElRef, innerContent) { return props.children(rootElRef, normalizeClassNames(props.classNames, hookProps), innerElRef, innerContent); })); }));
    };
    return RenderHook;
}(BaseComponent));
// TODO: rename to be about function, not default. use in above type
// for forcing rerender of components that use the ContentHook
var CustomContentRenderContext = (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createContext)(0);
function ContentHook(props) {
    return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(CustomContentRenderContext.Consumer, null, function (renderId) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ContentHookInner, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ renderId: renderId }, props))); }));
}
var ContentHookInner = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ContentHookInner, _super);
    function ContentHookInner() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.innerElRef = (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        return _this;
    }
    ContentHookInner.prototype.render = function () {
        return this.props.children(this.innerElRef, this.renderInnerContent());
    };
    ContentHookInner.prototype.componentDidMount = function () {
        this.updateCustomContent();
    };
    ContentHookInner.prototype.componentDidUpdate = function () {
        this.updateCustomContent();
    };
    ContentHookInner.prototype.componentWillUnmount = function () {
        if (this.customContentInfo && this.customContentInfo.destroy) {
            this.customContentInfo.destroy();
        }
    };
    ContentHookInner.prototype.renderInnerContent = function () {
        var customContentInfo = this.customContentInfo; // only populated if using non-[p]react node(s)
        var innerContent = this.getInnerContent();
        var meta = this.getContentMeta(innerContent);
        // initial run, or content-type changing? (from vue -> react for example)
        if (!customContentInfo || customContentInfo.contentKey !== meta.contentKey) {
            // clearing old value
            if (customContentInfo) {
                if (customContentInfo.destroy) {
                    customContentInfo.destroy();
                }
                customContentInfo = this.customContentInfo = null;
            }
            // assigning new value
            if (meta.contentKey) {
                customContentInfo = this.customContentInfo = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ contentKey: meta.contentKey, contentVal: innerContent[meta.contentKey] }, meta.buildLifecycleFuncs());
            }
            // updating
        }
        else if (customContentInfo) {
            customContentInfo.contentVal = innerContent[meta.contentKey];
        }
        return customContentInfo
            ? [] // signal that something was specified
            : innerContent; // assume a [p]react vdom node. use it
    };
    ContentHookInner.prototype.getInnerContent = function () {
        var props = this.props;
        var innerContent = normalizeContent(props.content, props.hookProps);
        if (innerContent === undefined) { // use the default
            innerContent = normalizeContent(props.defaultContent, props.hookProps);
        }
        return innerContent == null ? null : innerContent; // convert undefined to null (better for React)
    };
    ContentHookInner.prototype.getContentMeta = function (innerContent) {
        var contentTypeHandlers = this.context.pluginHooks.contentTypeHandlers;
        var contentKey = '';
        var buildLifecycleFuncs = null;
        if (innerContent) { // allowed to be null, for convenience to caller
            for (var searchKey in contentTypeHandlers) {
                if (innerContent[searchKey] !== undefined) {
                    contentKey = searchKey;
                    buildLifecycleFuncs = contentTypeHandlers[searchKey];
                    break;
                }
            }
        }
        return { contentKey: contentKey, buildLifecycleFuncs: buildLifecycleFuncs };
    };
    ContentHookInner.prototype.updateCustomContent = function () {
        if (this.customContentInfo) { // for non-[p]react
            this.customContentInfo.render(this.innerElRef.current || this.props.backupElRef.current, // the element to render into
            this.customContentInfo.contentVal);
        }
    };
    return ContentHookInner;
}(BaseComponent));
var MountHook = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(MountHook, _super);
    function MountHook() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.handleRootEl = function (rootEl) {
            _this.rootEl = rootEl;
            if (_this.props.elRef) {
                setRef(_this.props.elRef, rootEl);
            }
        };
        return _this;
    }
    MountHook.prototype.render = function () {
        return this.props.children(this.handleRootEl);
    };
    MountHook.prototype.componentDidMount = function () {
        var callback = this.props.didMount;
        if (callback) {
            callback((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, this.props.hookProps), { el: this.rootEl }));
        }
    };
    MountHook.prototype.componentWillUnmount = function () {
        var callback = this.props.willUnmount;
        if (callback) {
            callback((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, this.props.hookProps), { el: this.rootEl }));
        }
    };
    return MountHook;
}(BaseComponent));
function buildClassNameNormalizer() {
    var currentGenerator;
    var currentHookProps;
    var currentClassNames = [];
    return function (generator, hookProps) {
        if (!currentHookProps || !isPropsEqual(currentHookProps, hookProps) || generator !== currentGenerator) {
            currentGenerator = generator;
            currentHookProps = hookProps;
            currentClassNames = normalizeClassNames(generator, hookProps);
        }
        return currentClassNames;
    };
}
function normalizeClassNames(classNames, hookProps) {
    if (typeof classNames === 'function') {
        classNames = classNames(hookProps);
    }
    return parseClassNames(classNames);
}
function normalizeContent(input, hookProps) {
    if (typeof input === 'function') {
        return input(hookProps, _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement); // give the function the vdom-creation func
    }
    return input;
}

var ViewRoot = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ViewRoot, _super);
    function ViewRoot() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.normalizeClassNames = buildClassNameNormalizer();
        return _this;
    }
    ViewRoot.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var options = context.options;
        var hookProps = { view: context.viewApi };
        var customClassNames = this.normalizeClassNames(options.viewClassNames, hookProps);
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(MountHook, { hookProps: hookProps, didMount: options.viewDidMount, willUnmount: options.viewWillUnmount, elRef: props.elRef }, function (rootElRef) { return props.children(rootElRef, ["fc-" + props.viewSpec.type + "-view", 'fc-view'].concat(customClassNames)); }));
    };
    return ViewRoot;
}(BaseComponent));

function parseViewConfigs(inputs) {
    return mapHash(inputs, parseViewConfig);
}
function parseViewConfig(input) {
    var rawOptions = typeof input === 'function' ?
        { component: input } :
        input;
    var component = rawOptions.component;
    if (rawOptions.content) {
        component = createViewHookComponent(rawOptions);
        // TODO: remove content/classNames/didMount/etc from options?
    }
    return {
        superType: rawOptions.type,
        component: component,
        rawOptions: rawOptions,
    };
}
function createViewHookComponent(options) {
    return function (viewProps) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ViewContextType.Consumer, null, function (context) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ViewRoot, { viewSpec: context.viewSpec }, function (viewElRef, viewClassNames) {
        var hookProps = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, viewProps), { nextDayThreshold: context.options.nextDayThreshold });
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(RenderHook, { hookProps: hookProps, classNames: options.classNames, content: options.content, didMount: options.didMount, willUnmount: options.willUnmount, elRef: viewElRef }, function (rootElRef, customClassNames, innerElRef, innerContent) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: viewClassNames.concat(customClassNames).join(' '), ref: rootElRef }, innerContent)); }));
    })); })); };
}

function buildViewSpecs(defaultInputs, optionOverrides, dynamicOptionOverrides, localeDefaults) {
    var defaultConfigs = parseViewConfigs(defaultInputs);
    var overrideConfigs = parseViewConfigs(optionOverrides.views);
    var viewDefs = compileViewDefs(defaultConfigs, overrideConfigs);
    return mapHash(viewDefs, function (viewDef) { return buildViewSpec(viewDef, overrideConfigs, optionOverrides, dynamicOptionOverrides, localeDefaults); });
}
function buildViewSpec(viewDef, overrideConfigs, optionOverrides, dynamicOptionOverrides, localeDefaults) {
    var durationInput = viewDef.overrides.duration ||
        viewDef.defaults.duration ||
        dynamicOptionOverrides.duration ||
        optionOverrides.duration;
    var duration = null;
    var durationUnit = '';
    var singleUnit = '';
    var singleUnitOverrides = {};
    if (durationInput) {
        duration = createDurationCached(durationInput);
        if (duration) { // valid?
            var denom = greatestDurationDenominator(duration);
            durationUnit = denom.unit;
            if (denom.value === 1) {
                singleUnit = durationUnit;
                singleUnitOverrides = overrideConfigs[durationUnit] ? overrideConfigs[durationUnit].rawOptions : {};
            }
        }
    }
    var queryButtonText = function (optionsSubset) {
        var buttonTextMap = optionsSubset.buttonText || {};
        var buttonTextKey = viewDef.defaults.buttonTextKey;
        if (buttonTextKey != null && buttonTextMap[buttonTextKey] != null) {
            return buttonTextMap[buttonTextKey];
        }
        if (buttonTextMap[viewDef.type] != null) {
            return buttonTextMap[viewDef.type];
        }
        if (buttonTextMap[singleUnit] != null) {
            return buttonTextMap[singleUnit];
        }
        return null;
    };
    var queryButtonTitle = function (optionsSubset) {
        var buttonHints = optionsSubset.buttonHints || {};
        var buttonKey = viewDef.defaults.buttonTextKey; // use same key as text
        if (buttonKey != null && buttonHints[buttonKey] != null) {
            return buttonHints[buttonKey];
        }
        if (buttonHints[viewDef.type] != null) {
            return buttonHints[viewDef.type];
        }
        if (buttonHints[singleUnit] != null) {
            return buttonHints[singleUnit];
        }
        return null;
    };
    return {
        type: viewDef.type,
        component: viewDef.component,
        duration: duration,
        durationUnit: durationUnit,
        singleUnit: singleUnit,
        optionDefaults: viewDef.defaults,
        optionOverrides: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, singleUnitOverrides), viewDef.overrides),
        buttonTextOverride: queryButtonText(dynamicOptionOverrides) ||
            queryButtonText(optionOverrides) || // constructor-specified buttonText lookup hash takes precedence
            viewDef.overrides.buttonText,
        buttonTextDefault: queryButtonText(localeDefaults) ||
            viewDef.defaults.buttonText ||
            queryButtonText(BASE_OPTION_DEFAULTS) ||
            viewDef.type,
        // not DRY
        buttonTitleOverride: queryButtonTitle(dynamicOptionOverrides) ||
            queryButtonTitle(optionOverrides) ||
            viewDef.overrides.buttonHint,
        buttonTitleDefault: queryButtonTitle(localeDefaults) ||
            viewDef.defaults.buttonHint ||
            queryButtonTitle(BASE_OPTION_DEFAULTS),
        // will eventually fall back to buttonText
    };
}
// hack to get memoization working
var durationInputMap = {};
function createDurationCached(durationInput) {
    var json = JSON.stringify(durationInput);
    var res = durationInputMap[json];
    if (res === undefined) {
        res = createDuration(durationInput);
        durationInputMap[json] = res;
    }
    return res;
}

var DateProfileGenerator = /** @class */ (function () {
    function DateProfileGenerator(props) {
        this.props = props;
        this.nowDate = getNow(props.nowInput, props.dateEnv);
        this.initHiddenDays();
    }
    /* Date Range Computation
    ------------------------------------------------------------------------------------------------------------------*/
    // Builds a structure with info about what the dates/ranges will be for the "prev" view.
    DateProfileGenerator.prototype.buildPrev = function (currentDateProfile, currentDate, forceToValid) {
        var dateEnv = this.props.dateEnv;
        var prevDate = dateEnv.subtract(dateEnv.startOf(currentDate, currentDateProfile.currentRangeUnit), // important for start-of-month
        currentDateProfile.dateIncrement);
        return this.build(prevDate, -1, forceToValid);
    };
    // Builds a structure with info about what the dates/ranges will be for the "next" view.
    DateProfileGenerator.prototype.buildNext = function (currentDateProfile, currentDate, forceToValid) {
        var dateEnv = this.props.dateEnv;
        var nextDate = dateEnv.add(dateEnv.startOf(currentDate, currentDateProfile.currentRangeUnit), // important for start-of-month
        currentDateProfile.dateIncrement);
        return this.build(nextDate, 1, forceToValid);
    };
    // Builds a structure holding dates/ranges for rendering around the given date.
    // Optional direction param indicates whether the date is being incremented/decremented
    // from its previous value. decremented = -1, incremented = 1 (default).
    DateProfileGenerator.prototype.build = function (currentDate, direction, forceToValid) {
        if (forceToValid === void 0) { forceToValid = true; }
        var props = this.props;
        var validRange;
        var currentInfo;
        var isRangeAllDay;
        var renderRange;
        var activeRange;
        var isValid;
        validRange = this.buildValidRange();
        validRange = this.trimHiddenDays(validRange);
        if (forceToValid) {
            currentDate = constrainMarkerToRange(currentDate, validRange);
        }
        currentInfo = this.buildCurrentRangeInfo(currentDate, direction);
        isRangeAllDay = /^(year|month|week|day)$/.test(currentInfo.unit);
        renderRange = this.buildRenderRange(this.trimHiddenDays(currentInfo.range), currentInfo.unit, isRangeAllDay);
        renderRange = this.trimHiddenDays(renderRange);
        activeRange = renderRange;
        if (!props.showNonCurrentDates) {
            activeRange = intersectRanges(activeRange, currentInfo.range);
        }
        activeRange = this.adjustActiveRange(activeRange);
        activeRange = intersectRanges(activeRange, validRange); // might return null
        // it's invalid if the originally requested date is not contained,
        // or if the range is completely outside of the valid range.
        isValid = rangesIntersect(currentInfo.range, validRange);
        return {
            // constraint for where prev/next operations can go and where events can be dragged/resized to.
            // an object with optional start and end properties.
            validRange: validRange,
            // range the view is formally responsible for.
            // for example, a month view might have 1st-31st, excluding padded dates
            currentRange: currentInfo.range,
            // name of largest unit being displayed, like "month" or "week"
            currentRangeUnit: currentInfo.unit,
            isRangeAllDay: isRangeAllDay,
            // dates that display events and accept drag-n-drop
            // will be `null` if no dates accept events
            activeRange: activeRange,
            // date range with a rendered skeleton
            // includes not-active days that need some sort of DOM
            renderRange: renderRange,
            // Duration object that denotes the first visible time of any given day
            slotMinTime: props.slotMinTime,
            // Duration object that denotes the exclusive visible end time of any given day
            slotMaxTime: props.slotMaxTime,
            isValid: isValid,
            // how far the current date will move for a prev/next operation
            dateIncrement: this.buildDateIncrement(currentInfo.duration),
            // pass a fallback (might be null) ^
        };
    };
    // Builds an object with optional start/end properties.
    // Indicates the minimum/maximum dates to display.
    // not responsible for trimming hidden days.
    DateProfileGenerator.prototype.buildValidRange = function () {
        var input = this.props.validRangeInput;
        var simpleInput = typeof input === 'function'
            ? input.call(this.props.calendarApi, this.nowDate)
            : input;
        return this.refineRange(simpleInput) ||
            { start: null, end: null }; // completely open-ended
    };
    // Builds a structure with info about the "current" range, the range that is
    // highlighted as being the current month for example.
    // See build() for a description of `direction`.
    // Guaranteed to have `range` and `unit` properties. `duration` is optional.
    DateProfileGenerator.prototype.buildCurrentRangeInfo = function (date, direction) {
        var props = this.props;
        var duration = null;
        var unit = null;
        var range = null;
        var dayCount;
        if (props.duration) {
            duration = props.duration;
            unit = props.durationUnit;
            range = this.buildRangeFromDuration(date, direction, duration, unit);
        }
        else if ((dayCount = this.props.dayCount)) {
            unit = 'day';
            range = this.buildRangeFromDayCount(date, direction, dayCount);
        }
        else if ((range = this.buildCustomVisibleRange(date))) {
            unit = props.dateEnv.greatestWholeUnit(range.start, range.end).unit;
        }
        else {
            duration = this.getFallbackDuration();
            unit = greatestDurationDenominator(duration).unit;
            range = this.buildRangeFromDuration(date, direction, duration, unit);
        }
        return { duration: duration, unit: unit, range: range };
    };
    DateProfileGenerator.prototype.getFallbackDuration = function () {
        return createDuration({ day: 1 });
    };
    // Returns a new activeRange to have time values (un-ambiguate)
    // slotMinTime or slotMaxTime causes the range to expand.
    DateProfileGenerator.prototype.adjustActiveRange = function (range) {
        var _a = this.props, dateEnv = _a.dateEnv, usesMinMaxTime = _a.usesMinMaxTime, slotMinTime = _a.slotMinTime, slotMaxTime = _a.slotMaxTime;
        var start = range.start, end = range.end;
        if (usesMinMaxTime) {
            // expand active range if slotMinTime is negative (why not when positive?)
            if (asRoughDays(slotMinTime) < 0) {
                start = startOfDay(start); // necessary?
                start = dateEnv.add(start, slotMinTime);
            }
            // expand active range if slotMaxTime is beyond one day (why not when negative?)
            if (asRoughDays(slotMaxTime) > 1) {
                end = startOfDay(end); // necessary?
                end = addDays(end, -1);
                end = dateEnv.add(end, slotMaxTime);
            }
        }
        return { start: start, end: end };
    };
    // Builds the "current" range when it is specified as an explicit duration.
    // `unit` is the already-computed greatestDurationDenominator unit of duration.
    DateProfileGenerator.prototype.buildRangeFromDuration = function (date, direction, duration, unit) {
        var _a = this.props, dateEnv = _a.dateEnv, dateAlignment = _a.dateAlignment;
        var start;
        var end;
        var res;
        // compute what the alignment should be
        if (!dateAlignment) {
            var dateIncrement = this.props.dateIncrement;
            if (dateIncrement) {
                // use the smaller of the two units
                if (asRoughMs(dateIncrement) < asRoughMs(duration)) {
                    dateAlignment = greatestDurationDenominator(dateIncrement).unit;
                }
                else {
                    dateAlignment = unit;
                }
            }
            else {
                dateAlignment = unit;
            }
        }
        // if the view displays a single day or smaller
        if (asRoughDays(duration) <= 1) {
            if (this.isHiddenDay(start)) {
                start = this.skipHiddenDays(start, direction);
                start = startOfDay(start);
            }
        }
        function computeRes() {
            start = dateEnv.startOf(date, dateAlignment);
            end = dateEnv.add(start, duration);
            res = { start: start, end: end };
        }
        computeRes();
        // if range is completely enveloped by hidden days, go past the hidden days
        if (!this.trimHiddenDays(res)) {
            date = this.skipHiddenDays(date, direction);
            computeRes();
        }
        return res;
    };
    // Builds the "current" range when a dayCount is specified.
    DateProfileGenerator.prototype.buildRangeFromDayCount = function (date, direction, dayCount) {
        var _a = this.props, dateEnv = _a.dateEnv, dateAlignment = _a.dateAlignment;
        var runningCount = 0;
        var start = date;
        var end;
        if (dateAlignment) {
            start = dateEnv.startOf(start, dateAlignment);
        }
        start = startOfDay(start);
        start = this.skipHiddenDays(start, direction);
        end = start;
        do {
            end = addDays(end, 1);
            if (!this.isHiddenDay(end)) {
                runningCount += 1;
            }
        } while (runningCount < dayCount);
        return { start: start, end: end };
    };
    // Builds a normalized range object for the "visible" range,
    // which is a way to define the currentRange and activeRange at the same time.
    DateProfileGenerator.prototype.buildCustomVisibleRange = function (date) {
        var props = this.props;
        var input = props.visibleRangeInput;
        var simpleInput = typeof input === 'function'
            ? input.call(props.calendarApi, props.dateEnv.toDate(date))
            : input;
        var range = this.refineRange(simpleInput);
        if (range && (range.start == null || range.end == null)) {
            return null;
        }
        return range;
    };
    // Computes the range that will represent the element/cells for *rendering*,
    // but which may have voided days/times.
    // not responsible for trimming hidden days.
    DateProfileGenerator.prototype.buildRenderRange = function (currentRange, currentRangeUnit, isRangeAllDay) {
        return currentRange;
    };
    // Compute the duration value that should be added/substracted to the current date
    // when a prev/next operation happens.
    DateProfileGenerator.prototype.buildDateIncrement = function (fallback) {
        var dateIncrement = this.props.dateIncrement;
        var customAlignment;
        if (dateIncrement) {
            return dateIncrement;
        }
        if ((customAlignment = this.props.dateAlignment)) {
            return createDuration(1, customAlignment);
        }
        if (fallback) {
            return fallback;
        }
        return createDuration({ days: 1 });
    };
    DateProfileGenerator.prototype.refineRange = function (rangeInput) {
        if (rangeInput) {
            var range = parseRange(rangeInput, this.props.dateEnv);
            if (range) {
                range = computeVisibleDayRange(range);
            }
            return range;
        }
        return null;
    };
    /* Hidden Days
    ------------------------------------------------------------------------------------------------------------------*/
    // Initializes internal variables related to calculating hidden days-of-week
    DateProfileGenerator.prototype.initHiddenDays = function () {
        var hiddenDays = this.props.hiddenDays || []; // array of day-of-week indices that are hidden
        var isHiddenDayHash = []; // is the day-of-week hidden? (hash with day-of-week-index -> bool)
        var dayCnt = 0;
        var i;
        if (this.props.weekends === false) {
            hiddenDays.push(0, 6); // 0=sunday, 6=saturday
        }
        for (i = 0; i < 7; i += 1) {
            if (!(isHiddenDayHash[i] = hiddenDays.indexOf(i) !== -1)) {
                dayCnt += 1;
            }
        }
        if (!dayCnt) {
            throw new Error('invalid hiddenDays'); // all days were hidden? bad.
        }
        this.isHiddenDayHash = isHiddenDayHash;
    };
    // Remove days from the beginning and end of the range that are computed as hidden.
    // If the whole range is trimmed off, returns null
    DateProfileGenerator.prototype.trimHiddenDays = function (range) {
        var start = range.start, end = range.end;
        if (start) {
            start = this.skipHiddenDays(start);
        }
        if (end) {
            end = this.skipHiddenDays(end, -1, true);
        }
        if (start == null || end == null || start < end) {
            return { start: start, end: end };
        }
        return null;
    };
    // Is the current day hidden?
    // `day` is a day-of-week index (0-6), or a Date (used for UTC)
    DateProfileGenerator.prototype.isHiddenDay = function (day) {
        if (day instanceof Date) {
            day = day.getUTCDay();
        }
        return this.isHiddenDayHash[day];
    };
    // Incrementing the current day until it is no longer a hidden day, returning a copy.
    // DOES NOT CONSIDER validRange!
    // If the initial value of `date` is not a hidden day, don't do anything.
    // Pass `isExclusive` as `true` if you are dealing with an end date.
    // `inc` defaults to `1` (increment one day forward each time)
    DateProfileGenerator.prototype.skipHiddenDays = function (date, inc, isExclusive) {
        if (inc === void 0) { inc = 1; }
        if (isExclusive === void 0) { isExclusive = false; }
        while (this.isHiddenDayHash[(date.getUTCDay() + (isExclusive ? inc : 0) + 7) % 7]) {
            date = addDays(date, inc);
        }
        return date;
    };
    return DateProfileGenerator;
}());

function reduceViewType(viewType, action) {
    switch (action.type) {
        case 'CHANGE_VIEW_TYPE':
            viewType = action.viewType;
    }
    return viewType;
}

function reduceDynamicOptionOverrides(dynamicOptionOverrides, action) {
    var _a;
    switch (action.type) {
        case 'SET_OPTION':
            return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, dynamicOptionOverrides), (_a = {}, _a[action.optionName] = action.rawOptionValue, _a));
        default:
            return dynamicOptionOverrides;
    }
}

function reduceDateProfile(currentDateProfile, action, currentDate, dateProfileGenerator) {
    var dp;
    switch (action.type) {
        case 'CHANGE_VIEW_TYPE':
            return dateProfileGenerator.build(action.dateMarker || currentDate);
        case 'CHANGE_DATE':
            return dateProfileGenerator.build(action.dateMarker);
        case 'PREV':
            dp = dateProfileGenerator.buildPrev(currentDateProfile, currentDate);
            if (dp.isValid) {
                return dp;
            }
            break;
        case 'NEXT':
            dp = dateProfileGenerator.buildNext(currentDateProfile, currentDate);
            if (dp.isValid) {
                return dp;
            }
            break;
    }
    return currentDateProfile;
}

function initEventSources(calendarOptions, dateProfile, context) {
    var activeRange = dateProfile ? dateProfile.activeRange : null;
    return addSources({}, parseInitialSources(calendarOptions, context), activeRange, context);
}
function reduceEventSources(eventSources, action, dateProfile, context) {
    var activeRange = dateProfile ? dateProfile.activeRange : null; // need this check?
    switch (action.type) {
        case 'ADD_EVENT_SOURCES': // already parsed
            return addSources(eventSources, action.sources, activeRange, context);
        case 'REMOVE_EVENT_SOURCE':
            return removeSource(eventSources, action.sourceId);
        case 'PREV': // TODO: how do we track all actions that affect dateProfile :(
        case 'NEXT':
        case 'CHANGE_DATE':
        case 'CHANGE_VIEW_TYPE':
            if (dateProfile) {
                return fetchDirtySources(eventSources, activeRange, context);
            }
            return eventSources;
        case 'FETCH_EVENT_SOURCES':
            return fetchSourcesByIds(eventSources, action.sourceIds ? // why no type?
                arrayToHash(action.sourceIds) :
                excludeStaticSources(eventSources, context), activeRange, action.isRefetch || false, context);
        case 'RECEIVE_EVENTS':
        case 'RECEIVE_EVENT_ERROR':
            return receiveResponse(eventSources, action.sourceId, action.fetchId, action.fetchRange);
        case 'REMOVE_ALL_EVENT_SOURCES':
            return {};
        default:
            return eventSources;
    }
}
function reduceEventSourcesNewTimeZone(eventSources, dateProfile, context) {
    var activeRange = dateProfile ? dateProfile.activeRange : null; // need this check?
    return fetchSourcesByIds(eventSources, excludeStaticSources(eventSources, context), activeRange, true, context);
}
function computeEventSourcesLoading(eventSources) {
    for (var sourceId in eventSources) {
        if (eventSources[sourceId].isFetching) {
            return true;
        }
    }
    return false;
}
function addSources(eventSourceHash, sources, fetchRange, context) {
    var hash = {};
    for (var _i = 0, sources_1 = sources; _i < sources_1.length; _i++) {
        var source = sources_1[_i];
        hash[source.sourceId] = source;
    }
    if (fetchRange) {
        hash = fetchDirtySources(hash, fetchRange, context);
    }
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, eventSourceHash), hash);
}
function removeSource(eventSourceHash, sourceId) {
    return filterHash(eventSourceHash, function (eventSource) { return eventSource.sourceId !== sourceId; });
}
function fetchDirtySources(sourceHash, fetchRange, context) {
    return fetchSourcesByIds(sourceHash, filterHash(sourceHash, function (eventSource) { return isSourceDirty(eventSource, fetchRange, context); }), fetchRange, false, context);
}
function isSourceDirty(eventSource, fetchRange, context) {
    if (!doesSourceNeedRange(eventSource, context)) {
        return !eventSource.latestFetchId;
    }
    return !context.options.lazyFetching ||
        !eventSource.fetchRange ||
        eventSource.isFetching || // always cancel outdated in-progress fetches
        fetchRange.start < eventSource.fetchRange.start ||
        fetchRange.end > eventSource.fetchRange.end;
}
function fetchSourcesByIds(prevSources, sourceIdHash, fetchRange, isRefetch, context) {
    var nextSources = {};
    for (var sourceId in prevSources) {
        var source = prevSources[sourceId];
        if (sourceIdHash[sourceId]) {
            nextSources[sourceId] = fetchSource(source, fetchRange, isRefetch, context);
        }
        else {
            nextSources[sourceId] = source;
        }
    }
    return nextSources;
}
function fetchSource(eventSource, fetchRange, isRefetch, context) {
    var options = context.options, calendarApi = context.calendarApi;
    var sourceDef = context.pluginHooks.eventSourceDefs[eventSource.sourceDefId];
    var fetchId = guid();
    sourceDef.fetch({
        eventSource: eventSource,
        range: fetchRange,
        isRefetch: isRefetch,
        context: context,
    }, function (res) {
        var rawEvents = res.rawEvents;
        if (options.eventSourceSuccess) {
            rawEvents = options.eventSourceSuccess.call(calendarApi, rawEvents, res.xhr) || rawEvents;
        }
        if (eventSource.success) {
            rawEvents = eventSource.success.call(calendarApi, rawEvents, res.xhr) || rawEvents;
        }
        context.dispatch({
            type: 'RECEIVE_EVENTS',
            sourceId: eventSource.sourceId,
            fetchId: fetchId,
            fetchRange: fetchRange,
            rawEvents: rawEvents,
        });
    }, function (error) {
        console.warn(error.message, error);
        if (options.eventSourceFailure) {
            options.eventSourceFailure.call(calendarApi, error);
        }
        if (eventSource.failure) {
            eventSource.failure(error);
        }
        context.dispatch({
            type: 'RECEIVE_EVENT_ERROR',
            sourceId: eventSource.sourceId,
            fetchId: fetchId,
            fetchRange: fetchRange,
            error: error,
        });
    });
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, eventSource), { isFetching: true, latestFetchId: fetchId });
}
function receiveResponse(sourceHash, sourceId, fetchId, fetchRange) {
    var _a;
    var eventSource = sourceHash[sourceId];
    if (eventSource && // not already removed
        fetchId === eventSource.latestFetchId) {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, sourceHash), (_a = {}, _a[sourceId] = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, eventSource), { isFetching: false, fetchRange: fetchRange }), _a));
    }
    return sourceHash;
}
function excludeStaticSources(eventSources, context) {
    return filterHash(eventSources, function (eventSource) { return doesSourceNeedRange(eventSource, context); });
}
function parseInitialSources(rawOptions, context) {
    var refiners = buildEventSourceRefiners(context);
    var rawSources = [].concat(rawOptions.eventSources || []);
    var sources = []; // parsed
    if (rawOptions.initialEvents) {
        rawSources.unshift(rawOptions.initialEvents);
    }
    if (rawOptions.events) {
        rawSources.unshift(rawOptions.events);
    }
    for (var _i = 0, rawSources_1 = rawSources; _i < rawSources_1.length; _i++) {
        var rawSource = rawSources_1[_i];
        var source = parseEventSource(rawSource, context, refiners);
        if (source) {
            sources.push(source);
        }
    }
    return sources;
}
function doesSourceNeedRange(eventSource, context) {
    var defs = context.pluginHooks.eventSourceDefs;
    return !defs[eventSource.sourceDefId].ignoreRange;
}

function reduceEventStore(eventStore, action, eventSources, dateProfile, context) {
    switch (action.type) {
        case 'RECEIVE_EVENTS': // raw
            return receiveRawEvents(eventStore, eventSources[action.sourceId], action.fetchId, action.fetchRange, action.rawEvents, context);
        case 'ADD_EVENTS': // already parsed, but not expanded
            return addEvent(eventStore, action.eventStore, // new ones
            dateProfile ? dateProfile.activeRange : null, context);
        case 'RESET_EVENTS':
            return action.eventStore;
        case 'MERGE_EVENTS': // already parsed and expanded
            return mergeEventStores(eventStore, action.eventStore);
        case 'PREV': // TODO: how do we track all actions that affect dateProfile :(
        case 'NEXT':
        case 'CHANGE_DATE':
        case 'CHANGE_VIEW_TYPE':
            if (dateProfile) {
                return expandRecurring(eventStore, dateProfile.activeRange, context);
            }
            return eventStore;
        case 'REMOVE_EVENTS':
            return excludeSubEventStore(eventStore, action.eventStore);
        case 'REMOVE_EVENT_SOURCE':
            return excludeEventsBySourceId(eventStore, action.sourceId);
        case 'REMOVE_ALL_EVENT_SOURCES':
            return filterEventStoreDefs(eventStore, function (eventDef) { return (!eventDef.sourceId // only keep events with no source id
            ); });
        case 'REMOVE_ALL_EVENTS':
            return createEmptyEventStore();
        default:
            return eventStore;
    }
}
function receiveRawEvents(eventStore, eventSource, fetchId, fetchRange, rawEvents, context) {
    if (eventSource && // not already removed
        fetchId === eventSource.latestFetchId // TODO: wish this logic was always in event-sources
    ) {
        var subset = parseEvents(transformRawEvents(rawEvents, eventSource, context), eventSource, context);
        if (fetchRange) {
            subset = expandRecurring(subset, fetchRange, context);
        }
        return mergeEventStores(excludeEventsBySourceId(eventStore, eventSource.sourceId), subset);
    }
    return eventStore;
}
function transformRawEvents(rawEvents, eventSource, context) {
    var calEachTransform = context.options.eventDataTransform;
    var sourceEachTransform = eventSource ? eventSource.eventDataTransform : null;
    if (sourceEachTransform) {
        rawEvents = transformEachRawEvent(rawEvents, sourceEachTransform);
    }
    if (calEachTransform) {
        rawEvents = transformEachRawEvent(rawEvents, calEachTransform);
    }
    return rawEvents;
}
function transformEachRawEvent(rawEvents, func) {
    var refinedEvents;
    if (!func) {
        refinedEvents = rawEvents;
    }
    else {
        refinedEvents = [];
        for (var _i = 0, rawEvents_1 = rawEvents; _i < rawEvents_1.length; _i++) {
            var rawEvent = rawEvents_1[_i];
            var refinedEvent = func(rawEvent);
            if (refinedEvent) {
                refinedEvents.push(refinedEvent);
            }
            else if (refinedEvent == null) {
                refinedEvents.push(rawEvent);
            } // if a different falsy value, do nothing
        }
    }
    return refinedEvents;
}
function addEvent(eventStore, subset, expandRange, context) {
    if (expandRange) {
        subset = expandRecurring(subset, expandRange, context);
    }
    return mergeEventStores(eventStore, subset);
}
function rezoneEventStoreDates(eventStore, oldDateEnv, newDateEnv) {
    var defs = eventStore.defs;
    var instances = mapHash(eventStore.instances, function (instance) {
        var def = defs[instance.defId];
        if (def.allDay || def.recurringDef) {
            return instance; // isn't dependent on timezone
        }
        return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, instance), { range: {
                start: newDateEnv.createMarker(oldDateEnv.toDate(instance.range.start, instance.forcedStartTzo)),
                end: newDateEnv.createMarker(oldDateEnv.toDate(instance.range.end, instance.forcedEndTzo)),
            }, forcedStartTzo: newDateEnv.canComputeOffset ? null : instance.forcedStartTzo, forcedEndTzo: newDateEnv.canComputeOffset ? null : instance.forcedEndTzo });
    });
    return { defs: defs, instances: instances };
}
function excludeEventsBySourceId(eventStore, sourceId) {
    return filterEventStoreDefs(eventStore, function (eventDef) { return eventDef.sourceId !== sourceId; });
}
// QUESTION: why not just return instances? do a general object-property-exclusion util
function excludeInstances(eventStore, removals) {
    return {
        defs: eventStore.defs,
        instances: filterHash(eventStore.instances, function (instance) { return !removals[instance.instanceId]; }),
    };
}

function reduceDateSelection(currentSelection, action) {
    switch (action.type) {
        case 'UNSELECT_DATES':
            return null;
        case 'SELECT_DATES':
            return action.selection;
        default:
            return currentSelection;
    }
}

function reduceSelectedEvent(currentInstanceId, action) {
    switch (action.type) {
        case 'UNSELECT_EVENT':
            return '';
        case 'SELECT_EVENT':
            return action.eventInstanceId;
        default:
            return currentInstanceId;
    }
}

function reduceEventDrag(currentDrag, action) {
    var newDrag;
    switch (action.type) {
        case 'UNSET_EVENT_DRAG':
            return null;
        case 'SET_EVENT_DRAG':
            newDrag = action.state;
            return {
                affectedEvents: newDrag.affectedEvents,
                mutatedEvents: newDrag.mutatedEvents,
                isEvent: newDrag.isEvent,
            };
        default:
            return currentDrag;
    }
}

function reduceEventResize(currentResize, action) {
    var newResize;
    switch (action.type) {
        case 'UNSET_EVENT_RESIZE':
            return null;
        case 'SET_EVENT_RESIZE':
            newResize = action.state;
            return {
                affectedEvents: newResize.affectedEvents,
                mutatedEvents: newResize.mutatedEvents,
                isEvent: newResize.isEvent,
            };
        default:
            return currentResize;
    }
}

function parseToolbars(calendarOptions, calendarOptionOverrides, theme, viewSpecs, calendarApi) {
    var header = calendarOptions.headerToolbar ? parseToolbar(calendarOptions.headerToolbar, calendarOptions, calendarOptionOverrides, theme, viewSpecs, calendarApi) : null;
    var footer = calendarOptions.footerToolbar ? parseToolbar(calendarOptions.footerToolbar, calendarOptions, calendarOptionOverrides, theme, viewSpecs, calendarApi) : null;
    return { header: header, footer: footer };
}
function parseToolbar(sectionStrHash, calendarOptions, calendarOptionOverrides, theme, viewSpecs, calendarApi) {
    var sectionWidgets = {};
    var viewsWithButtons = [];
    var hasTitle = false;
    for (var sectionName in sectionStrHash) {
        var sectionStr = sectionStrHash[sectionName];
        var sectionRes = parseSection(sectionStr, calendarOptions, calendarOptionOverrides, theme, viewSpecs, calendarApi);
        sectionWidgets[sectionName] = sectionRes.widgets;
        viewsWithButtons.push.apply(viewsWithButtons, sectionRes.viewsWithButtons);
        hasTitle = hasTitle || sectionRes.hasTitle;
    }
    return { sectionWidgets: sectionWidgets, viewsWithButtons: viewsWithButtons, hasTitle: hasTitle };
}
/*
BAD: querying icons and text here. should be done at render time
*/
function parseSection(sectionStr, calendarOptions, // defaults+overrides, then refined
calendarOptionOverrides, // overrides only!, unrefined :(
theme, viewSpecs, calendarApi) {
    var isRtl = calendarOptions.direction === 'rtl';
    var calendarCustomButtons = calendarOptions.customButtons || {};
    var calendarButtonTextOverrides = calendarOptionOverrides.buttonText || {};
    var calendarButtonText = calendarOptions.buttonText || {};
    var calendarButtonHintOverrides = calendarOptionOverrides.buttonHints || {};
    var calendarButtonHints = calendarOptions.buttonHints || {};
    var sectionSubstrs = sectionStr ? sectionStr.split(' ') : [];
    var viewsWithButtons = [];
    var hasTitle = false;
    var widgets = sectionSubstrs.map(function (buttonGroupStr) { return (buttonGroupStr.split(',').map(function (buttonName) {
        if (buttonName === 'title') {
            hasTitle = true;
            return { buttonName: buttonName };
        }
        var customButtonProps;
        var viewSpec;
        var buttonClick;
        var buttonIcon; // only one of these will be set
        var buttonText; // "
        var buttonHint;
        // ^ for the title="" attribute, for accessibility
        if ((customButtonProps = calendarCustomButtons[buttonName])) {
            buttonClick = function (ev) {
                if (customButtonProps.click) {
                    customButtonProps.click.call(ev.target, ev, ev.target); // TODO: use Calendar this context?
                }
            };
            (buttonIcon = theme.getCustomButtonIconClass(customButtonProps)) ||
                (buttonIcon = theme.getIconClass(buttonName, isRtl)) ||
                (buttonText = customButtonProps.text);
            buttonHint = customButtonProps.hint || customButtonProps.text;
        }
        else if ((viewSpec = viewSpecs[buttonName])) {
            viewsWithButtons.push(buttonName);
            buttonClick = function () {
                calendarApi.changeView(buttonName);
            };
            (buttonText = viewSpec.buttonTextOverride) ||
                (buttonIcon = theme.getIconClass(buttonName, isRtl)) ||
                (buttonText = viewSpec.buttonTextDefault);
            var textFallback = viewSpec.buttonTextOverride ||
                viewSpec.buttonTextDefault;
            buttonHint = formatWithOrdinals(viewSpec.buttonTitleOverride ||
                viewSpec.buttonTitleDefault ||
                calendarOptions.viewHint, [textFallback, buttonName], // view-name = buttonName
            textFallback);
        }
        else if (calendarApi[buttonName]) { // a calendarApi method
            buttonClick = function () {
                calendarApi[buttonName]();
            };
            (buttonText = calendarButtonTextOverrides[buttonName]) ||
                (buttonIcon = theme.getIconClass(buttonName, isRtl)) ||
                (buttonText = calendarButtonText[buttonName]); // everything else is considered default
            if (buttonName === 'prevYear' || buttonName === 'nextYear') {
                var prevOrNext = buttonName === 'prevYear' ? 'prev' : 'next';
                buttonHint = formatWithOrdinals(calendarButtonHintOverrides[prevOrNext] ||
                    calendarButtonHints[prevOrNext], [
                    calendarButtonText.year || 'year',
                    'year',
                ], calendarButtonText[buttonName]);
            }
            else {
                buttonHint = function (navUnit) { return formatWithOrdinals(calendarButtonHintOverrides[buttonName] ||
                    calendarButtonHints[buttonName], [
                    calendarButtonText[navUnit] || navUnit,
                    navUnit,
                ], calendarButtonText[buttonName]); };
            }
        }
        return { buttonName: buttonName, buttonClick: buttonClick, buttonIcon: buttonIcon, buttonText: buttonText, buttonHint: buttonHint };
    })); });
    return { widgets: widgets, viewsWithButtons: viewsWithButtons, hasTitle: hasTitle };
}

var eventSourceDef$2 = {
    ignoreRange: true,
    parseMeta: function (refined) {
        if (Array.isArray(refined.events)) {
            return refined.events;
        }
        return null;
    },
    fetch: function (arg, success) {
        success({
            rawEvents: arg.eventSource.meta,
        });
    },
};
var arrayEventSourcePlugin = createPlugin({
    eventSourceDefs: [eventSourceDef$2],
});

var eventSourceDef$1 = {
    parseMeta: function (refined) {
        if (typeof refined.events === 'function') {
            return refined.events;
        }
        return null;
    },
    fetch: function (arg, success, failure) {
        var dateEnv = arg.context.dateEnv;
        var func = arg.eventSource.meta;
        unpromisify(func.bind(null, buildRangeApiWithTimeZone(arg.range, dateEnv)), function (rawEvents) {
            success({ rawEvents: rawEvents }); // needs an object response
        }, failure);
    },
};
var funcEventSourcePlugin = createPlugin({
    eventSourceDefs: [eventSourceDef$1],
});

function requestJson(method, url, params, successCallback, failureCallback) {
    method = method.toUpperCase();
    var body = null;
    if (method === 'GET') {
        url = injectQueryStringParams(url, params);
    }
    else {
        body = encodeParams(params);
    }
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    if (method !== 'GET') {
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 400) {
            var parsed = false;
            var res = void 0;
            try {
                res = JSON.parse(xhr.responseText);
                parsed = true;
            }
            catch (err) {
                // will handle parsed=false
            }
            if (parsed) {
                successCallback(res, xhr);
            }
            else {
                failureCallback('Failure parsing JSON', xhr);
            }
        }
        else {
            failureCallback('Request failed', xhr);
        }
    };
    xhr.onerror = function () {
        failureCallback('Request failed', xhr);
    };
    xhr.send(body);
}
function injectQueryStringParams(url, params) {
    return url +
        (url.indexOf('?') === -1 ? '?' : '&') +
        encodeParams(params);
}
function encodeParams(params) {
    var parts = [];
    for (var key in params) {
        parts.push(encodeURIComponent(key) + "=" + encodeURIComponent(params[key]));
    }
    return parts.join('&');
}

var JSON_FEED_EVENT_SOURCE_REFINERS = {
    method: String,
    extraParams: identity,
    startParam: String,
    endParam: String,
    timeZoneParam: String,
};

var eventSourceDef = {
    parseMeta: function (refined) {
        if (refined.url && (refined.format === 'json' || !refined.format)) {
            return {
                url: refined.url,
                format: 'json',
                method: (refined.method || 'GET').toUpperCase(),
                extraParams: refined.extraParams,
                startParam: refined.startParam,
                endParam: refined.endParam,
                timeZoneParam: refined.timeZoneParam,
            };
        }
        return null;
    },
    fetch: function (arg, success, failure) {
        var meta = arg.eventSource.meta;
        var requestParams = buildRequestParams(meta, arg.range, arg.context);
        requestJson(meta.method, meta.url, requestParams, function (rawEvents, xhr) {
            success({ rawEvents: rawEvents, xhr: xhr });
        }, function (errorMessage, xhr) {
            failure({ message: errorMessage, xhr: xhr });
        });
    },
};
var jsonFeedEventSourcePlugin = createPlugin({
    eventSourceRefiners: JSON_FEED_EVENT_SOURCE_REFINERS,
    eventSourceDefs: [eventSourceDef],
});
function buildRequestParams(meta, range, context) {
    var dateEnv = context.dateEnv, options = context.options;
    var startParam;
    var endParam;
    var timeZoneParam;
    var customRequestParams;
    var params = {};
    startParam = meta.startParam;
    if (startParam == null) {
        startParam = options.startParam;
    }
    endParam = meta.endParam;
    if (endParam == null) {
        endParam = options.endParam;
    }
    timeZoneParam = meta.timeZoneParam;
    if (timeZoneParam == null) {
        timeZoneParam = options.timeZoneParam;
    }
    // retrieve any outbound GET/POST data from the options
    if (typeof meta.extraParams === 'function') {
        // supplied as a function that returns a key/value object
        customRequestParams = meta.extraParams();
    }
    else {
        // probably supplied as a straight key/value object
        customRequestParams = meta.extraParams || {};
    }
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(params, customRequestParams);
    params[startParam] = dateEnv.formatIso(range.start);
    params[endParam] = dateEnv.formatIso(range.end);
    if (dateEnv.timeZone !== 'local') {
        params[timeZoneParam] = dateEnv.timeZone;
    }
    return params;
}

var SIMPLE_RECURRING_REFINERS = {
    daysOfWeek: identity,
    startTime: createDuration,
    endTime: createDuration,
    duration: createDuration,
    startRecur: identity,
    endRecur: identity,
};

var recurring = {
    parse: function (refined, dateEnv) {
        if (refined.daysOfWeek || refined.startTime || refined.endTime || refined.startRecur || refined.endRecur) {
            var recurringData = {
                daysOfWeek: refined.daysOfWeek || null,
                startTime: refined.startTime || null,
                endTime: refined.endTime || null,
                startRecur: refined.startRecur ? dateEnv.createMarker(refined.startRecur) : null,
                endRecur: refined.endRecur ? dateEnv.createMarker(refined.endRecur) : null,
            };
            var duration = void 0;
            if (refined.duration) {
                duration = refined.duration;
            }
            if (!duration && refined.startTime && refined.endTime) {
                duration = subtractDurations(refined.endTime, refined.startTime);
            }
            return {
                allDayGuess: Boolean(!refined.startTime && !refined.endTime),
                duration: duration,
                typeData: recurringData, // doesn't need endTime anymore but oh well
            };
        }
        return null;
    },
    expand: function (typeData, framingRange, dateEnv) {
        var clippedFramingRange = intersectRanges(framingRange, { start: typeData.startRecur, end: typeData.endRecur });
        if (clippedFramingRange) {
            return expandRanges(typeData.daysOfWeek, typeData.startTime, clippedFramingRange, dateEnv);
        }
        return [];
    },
};
var simpleRecurringEventsPlugin = createPlugin({
    recurringTypes: [recurring],
    eventRefiners: SIMPLE_RECURRING_REFINERS,
});
function expandRanges(daysOfWeek, startTime, framingRange, dateEnv) {
    var dowHash = daysOfWeek ? arrayToHash(daysOfWeek) : null;
    var dayMarker = startOfDay(framingRange.start);
    var endMarker = framingRange.end;
    var instanceStarts = [];
    while (dayMarker < endMarker) {
        var instanceStart 
        // if everyday, or this particular day-of-week
        = void 0;
        // if everyday, or this particular day-of-week
        if (!dowHash || dowHash[dayMarker.getUTCDay()]) {
            if (startTime) {
                instanceStart = dateEnv.add(dayMarker, startTime);
            }
            else {
                instanceStart = dayMarker;
            }
            instanceStarts.push(instanceStart);
        }
        dayMarker = addDays(dayMarker, 1);
    }
    return instanceStarts;
}

var changeHandlerPlugin = createPlugin({
    optionChangeHandlers: {
        events: function (events, context) {
            handleEventSources([events], context);
        },
        eventSources: handleEventSources,
    },
});
/*
BUG: if `event` was supplied, all previously-given `eventSources` will be wiped out
*/
function handleEventSources(inputs, context) {
    var unfoundSources = hashValuesToArray(context.getCurrentData().eventSources);
    var newInputs = [];
    for (var _i = 0, inputs_1 = inputs; _i < inputs_1.length; _i++) {
        var input = inputs_1[_i];
        var inputFound = false;
        for (var i = 0; i < unfoundSources.length; i += 1) {
            if (unfoundSources[i]._raw === input) {
                unfoundSources.splice(i, 1); // delete
                inputFound = true;
                break;
            }
        }
        if (!inputFound) {
            newInputs.push(input);
        }
    }
    for (var _a = 0, unfoundSources_1 = unfoundSources; _a < unfoundSources_1.length; _a++) {
        var unfoundSource = unfoundSources_1[_a];
        context.dispatch({
            type: 'REMOVE_EVENT_SOURCE',
            sourceId: unfoundSource.sourceId,
        });
    }
    for (var _b = 0, newInputs_1 = newInputs; _b < newInputs_1.length; _b++) {
        var newInput = newInputs_1[_b];
        context.calendarApi.addEventSource(newInput);
    }
}

function handleDateProfile(dateProfile, context) {
    context.emitter.trigger('datesSet', (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, buildRangeApiWithTimeZone(dateProfile.activeRange, context.dateEnv)), { view: context.viewApi }));
}

function handleEventStore(eventStore, context) {
    var emitter = context.emitter;
    if (emitter.hasHandlers('eventsSet')) {
        emitter.trigger('eventsSet', buildEventApis(eventStore, context));
    }
}

/*
this array is exposed on the root namespace so that UMD plugins can add to it.
see the rollup-bundles script.
*/
var globalPlugins = [
    arrayEventSourcePlugin,
    funcEventSourcePlugin,
    jsonFeedEventSourcePlugin,
    simpleRecurringEventsPlugin,
    changeHandlerPlugin,
    createPlugin({
        isLoadingFuncs: [
            function (state) { return computeEventSourcesLoading(state.eventSources); },
        ],
        contentTypeHandlers: {
            html: buildHtmlRenderer,
            domNodes: buildDomNodeRenderer,
        },
        propSetHandlers: {
            dateProfile: handleDateProfile,
            eventStore: handleEventStore,
        },
    }),
];
function buildHtmlRenderer() {
    var currentEl = null;
    var currentHtml = '';
    function render(el, html) {
        if (el !== currentEl || html !== currentHtml) {
            el.innerHTML = html;
        }
        currentEl = el;
        currentHtml = html;
    }
    function destroy() {
        currentEl.innerHTML = '';
        currentEl = null;
        currentHtml = '';
    }
    return { render: render, destroy: destroy };
}
function buildDomNodeRenderer() {
    var currentEl = null;
    var currentDomNodes = [];
    function render(el, domNodes) {
        var newDomNodes = Array.prototype.slice.call(domNodes);
        if (el !== currentEl || !isArraysEqual(currentDomNodes, newDomNodes)) {
            // append first, remove second (for scroll resetting)
            for (var _i = 0, newDomNodes_1 = newDomNodes; _i < newDomNodes_1.length; _i++) {
                var newNode = newDomNodes_1[_i];
                el.appendChild(newNode);
            }
            destroy();
        }
        currentEl = el;
        currentDomNodes = newDomNodes;
    }
    function destroy() {
        currentDomNodes.forEach(removeElement);
        currentDomNodes = [];
        currentEl = null;
    }
    return { render: render, destroy: destroy };
}

var DelayedRunner = /** @class */ (function () {
    function DelayedRunner(drainedOption) {
        this.drainedOption = drainedOption;
        this.isRunning = false;
        this.isDirty = false;
        this.pauseDepths = {};
        this.timeoutId = 0;
    }
    DelayedRunner.prototype.request = function (delay) {
        this.isDirty = true;
        if (!this.isPaused()) {
            this.clearTimeout();
            if (delay == null) {
                this.tryDrain();
            }
            else {
                this.timeoutId = setTimeout(// NOT OPTIMAL! TODO: look at debounce
                this.tryDrain.bind(this), delay);
            }
        }
    };
    DelayedRunner.prototype.pause = function (scope) {
        if (scope === void 0) { scope = ''; }
        var pauseDepths = this.pauseDepths;
        pauseDepths[scope] = (pauseDepths[scope] || 0) + 1;
        this.clearTimeout();
    };
    DelayedRunner.prototype.resume = function (scope, force) {
        if (scope === void 0) { scope = ''; }
        var pauseDepths = this.pauseDepths;
        if (scope in pauseDepths) {
            if (force) {
                delete pauseDepths[scope];
            }
            else {
                pauseDepths[scope] -= 1;
                var depth = pauseDepths[scope];
                if (depth <= 0) {
                    delete pauseDepths[scope];
                }
            }
            this.tryDrain();
        }
    };
    DelayedRunner.prototype.isPaused = function () {
        return Object.keys(this.pauseDepths).length;
    };
    DelayedRunner.prototype.tryDrain = function () {
        if (!this.isRunning && !this.isPaused()) {
            this.isRunning = true;
            while (this.isDirty) {
                this.isDirty = false;
                this.drained(); // might set isDirty to true again
            }
            this.isRunning = false;
        }
    };
    DelayedRunner.prototype.clear = function () {
        this.clearTimeout();
        this.isDirty = false;
        this.pauseDepths = {};
    };
    DelayedRunner.prototype.clearTimeout = function () {
        if (this.timeoutId) {
            clearTimeout(this.timeoutId);
            this.timeoutId = 0;
        }
    };
    DelayedRunner.prototype.drained = function () {
        if (this.drainedOption) {
            this.drainedOption();
        }
    };
    return DelayedRunner;
}());

var TaskRunner = /** @class */ (function () {
    function TaskRunner(runTaskOption, drainedOption) {
        this.runTaskOption = runTaskOption;
        this.drainedOption = drainedOption;
        this.queue = [];
        this.delayedRunner = new DelayedRunner(this.drain.bind(this));
    }
    TaskRunner.prototype.request = function (task, delay) {
        this.queue.push(task);
        this.delayedRunner.request(delay);
    };
    TaskRunner.prototype.pause = function (scope) {
        this.delayedRunner.pause(scope);
    };
    TaskRunner.prototype.resume = function (scope, force) {
        this.delayedRunner.resume(scope, force);
    };
    TaskRunner.prototype.drain = function () {
        var queue = this.queue;
        while (queue.length) {
            var completedTasks = [];
            var task = void 0;
            while ((task = queue.shift())) {
                this.runTask(task);
                completedTasks.push(task);
            }
            this.drained(completedTasks);
        } // keep going, in case new tasks were added in the drained handler
    };
    TaskRunner.prototype.runTask = function (task) {
        if (this.runTaskOption) {
            this.runTaskOption(task);
        }
    };
    TaskRunner.prototype.drained = function (completedTasks) {
        if (this.drainedOption) {
            this.drainedOption(completedTasks);
        }
    };
    return TaskRunner;
}());

// Computes what the title at the top of the calendarApi should be for this view
function buildTitle(dateProfile, viewOptions, dateEnv) {
    var range;
    // for views that span a large unit of time, show the proper interval, ignoring stray days before and after
    if (/^(year|month)$/.test(dateProfile.currentRangeUnit)) {
        range = dateProfile.currentRange;
    }
    else { // for day units or smaller, use the actual day range
        range = dateProfile.activeRange;
    }
    return dateEnv.formatRange(range.start, range.end, createFormatter(viewOptions.titleFormat || buildTitleFormat(dateProfile)), {
        isEndExclusive: dateProfile.isRangeAllDay,
        defaultSeparator: viewOptions.titleRangeSeparator,
    });
}
// Generates the format string that should be used to generate the title for the current date range.
// Attempts to compute the most appropriate format if not explicitly specified with `titleFormat`.
function buildTitleFormat(dateProfile) {
    var currentRangeUnit = dateProfile.currentRangeUnit;
    if (currentRangeUnit === 'year') {
        return { year: 'numeric' };
    }
    if (currentRangeUnit === 'month') {
        return { year: 'numeric', month: 'long' }; // like "September 2014"
    }
    var days = diffWholeDays(dateProfile.currentRange.start, dateProfile.currentRange.end);
    if (days !== null && days > 1) {
        // multi-day range. shorter, like "Sep 9 - 10 2014"
        return { year: 'numeric', month: 'short', day: 'numeric' };
    }
    // one day. longer, like "September 9 2014"
    return { year: 'numeric', month: 'long', day: 'numeric' };
}

// in future refactor, do the redux-style function(state=initial) for initial-state
// also, whatever is happening in constructor, have it happen in action queue too
var CalendarDataManager = /** @class */ (function () {
    function CalendarDataManager(props) {
        var _this = this;
        this.computeOptionsData = memoize(this._computeOptionsData);
        this.computeCurrentViewData = memoize(this._computeCurrentViewData);
        this.organizeRawLocales = memoize(organizeRawLocales);
        this.buildLocale = memoize(buildLocale);
        this.buildPluginHooks = buildBuildPluginHooks();
        this.buildDateEnv = memoize(buildDateEnv);
        this.buildTheme = memoize(buildTheme);
        this.parseToolbars = memoize(parseToolbars);
        this.buildViewSpecs = memoize(buildViewSpecs);
        this.buildDateProfileGenerator = memoizeObjArg(buildDateProfileGenerator);
        this.buildViewApi = memoize(buildViewApi);
        this.buildViewUiProps = memoizeObjArg(buildViewUiProps);
        this.buildEventUiBySource = memoize(buildEventUiBySource, isPropsEqual);
        this.buildEventUiBases = memoize(buildEventUiBases);
        this.parseContextBusinessHours = memoizeObjArg(parseContextBusinessHours);
        this.buildTitle = memoize(buildTitle);
        this.emitter = new Emitter();
        this.actionRunner = new TaskRunner(this._handleAction.bind(this), this.updateData.bind(this));
        this.currentCalendarOptionsInput = {};
        this.currentCalendarOptionsRefined = {};
        this.currentViewOptionsInput = {};
        this.currentViewOptionsRefined = {};
        this.currentCalendarOptionsRefiners = {};
        this.getCurrentData = function () { return _this.data; };
        this.dispatch = function (action) {
            _this.actionRunner.request(action); // protects against recursive calls to _handleAction
        };
        this.props = props;
        this.actionRunner.pause();
        var dynamicOptionOverrides = {};
        var optionsData = this.computeOptionsData(props.optionOverrides, dynamicOptionOverrides, props.calendarApi);
        var currentViewType = optionsData.calendarOptions.initialView || optionsData.pluginHooks.initialView;
        var currentViewData = this.computeCurrentViewData(currentViewType, optionsData, props.optionOverrides, dynamicOptionOverrides);
        // wire things up
        // TODO: not DRY
        props.calendarApi.currentDataManager = this;
        this.emitter.setThisContext(props.calendarApi);
        this.emitter.setOptions(currentViewData.options);
        var currentDate = getInitialDate(optionsData.calendarOptions, optionsData.dateEnv);
        var dateProfile = currentViewData.dateProfileGenerator.build(currentDate);
        if (!rangeContainsMarker(dateProfile.activeRange, currentDate)) {
            currentDate = dateProfile.currentRange.start;
        }
        var calendarContext = {
            dateEnv: optionsData.dateEnv,
            options: optionsData.calendarOptions,
            pluginHooks: optionsData.pluginHooks,
            calendarApi: props.calendarApi,
            dispatch: this.dispatch,
            emitter: this.emitter,
            getCurrentData: this.getCurrentData,
        };
        // needs to be after setThisContext
        for (var _i = 0, _a = optionsData.pluginHooks.contextInit; _i < _a.length; _i++) {
            var callback = _a[_i];
            callback(calendarContext);
        }
        // NOT DRY
        var eventSources = initEventSources(optionsData.calendarOptions, dateProfile, calendarContext);
        var initialState = {
            dynamicOptionOverrides: dynamicOptionOverrides,
            currentViewType: currentViewType,
            currentDate: currentDate,
            dateProfile: dateProfile,
            businessHours: this.parseContextBusinessHours(calendarContext),
            eventSources: eventSources,
            eventUiBases: {},
            eventStore: createEmptyEventStore(),
            renderableEventStore: createEmptyEventStore(),
            dateSelection: null,
            eventSelection: '',
            eventDrag: null,
            eventResize: null,
            selectionConfig: this.buildViewUiProps(calendarContext).selectionConfig,
        };
        var contextAndState = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, calendarContext), initialState);
        for (var _b = 0, _c = optionsData.pluginHooks.reducers; _b < _c.length; _b++) {
            var reducer = _c[_b];
            (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(initialState, reducer(null, null, contextAndState));
        }
        if (computeIsLoading(initialState, calendarContext)) {
            this.emitter.trigger('loading', true); // NOT DRY
        }
        this.state = initialState;
        this.updateData();
        this.actionRunner.resume();
    }
    CalendarDataManager.prototype.resetOptions = function (optionOverrides, append) {
        var props = this.props;
        props.optionOverrides = append
            ? (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, props.optionOverrides), optionOverrides) : optionOverrides;
        this.actionRunner.request({
            type: 'NOTHING',
        });
    };
    CalendarDataManager.prototype._handleAction = function (action) {
        var _a = this, props = _a.props, state = _a.state, emitter = _a.emitter;
        var dynamicOptionOverrides = reduceDynamicOptionOverrides(state.dynamicOptionOverrides, action);
        var optionsData = this.computeOptionsData(props.optionOverrides, dynamicOptionOverrides, props.calendarApi);
        var currentViewType = reduceViewType(state.currentViewType, action);
        var currentViewData = this.computeCurrentViewData(currentViewType, optionsData, props.optionOverrides, dynamicOptionOverrides);
        // wire things up
        // TODO: not DRY
        props.calendarApi.currentDataManager = this;
        emitter.setThisContext(props.calendarApi);
        emitter.setOptions(currentViewData.options);
        var calendarContext = {
            dateEnv: optionsData.dateEnv,
            options: optionsData.calendarOptions,
            pluginHooks: optionsData.pluginHooks,
            calendarApi: props.calendarApi,
            dispatch: this.dispatch,
            emitter: emitter,
            getCurrentData: this.getCurrentData,
        };
        var currentDate = state.currentDate, dateProfile = state.dateProfile;
        if (this.data && this.data.dateProfileGenerator !== currentViewData.dateProfileGenerator) { // hack
            dateProfile = currentViewData.dateProfileGenerator.build(currentDate);
        }
        currentDate = reduceCurrentDate(currentDate, action);
        dateProfile = reduceDateProfile(dateProfile, action, currentDate, currentViewData.dateProfileGenerator);
        if (action.type === 'PREV' || // TODO: move this logic into DateProfileGenerator
            action.type === 'NEXT' || // "
            !rangeContainsMarker(dateProfile.currentRange, currentDate)) {
            currentDate = dateProfile.currentRange.start;
        }
        var eventSources = reduceEventSources(state.eventSources, action, dateProfile, calendarContext);
        var eventStore = reduceEventStore(state.eventStore, action, eventSources, dateProfile, calendarContext);
        var isEventsLoading = computeEventSourcesLoading(eventSources); // BAD. also called in this func in computeIsLoading
        var renderableEventStore = (isEventsLoading && !currentViewData.options.progressiveEventRendering) ?
            (state.renderableEventStore || eventStore) : // try from previous state
            eventStore;
        var _b = this.buildViewUiProps(calendarContext), eventUiSingleBase = _b.eventUiSingleBase, selectionConfig = _b.selectionConfig; // will memoize obj
        var eventUiBySource = this.buildEventUiBySource(eventSources);
        var eventUiBases = this.buildEventUiBases(renderableEventStore.defs, eventUiSingleBase, eventUiBySource);
        var newState = {
            dynamicOptionOverrides: dynamicOptionOverrides,
            currentViewType: currentViewType,
            currentDate: currentDate,
            dateProfile: dateProfile,
            eventSources: eventSources,
            eventStore: eventStore,
            renderableEventStore: renderableEventStore,
            selectionConfig: selectionConfig,
            eventUiBases: eventUiBases,
            businessHours: this.parseContextBusinessHours(calendarContext),
            dateSelection: reduceDateSelection(state.dateSelection, action),
            eventSelection: reduceSelectedEvent(state.eventSelection, action),
            eventDrag: reduceEventDrag(state.eventDrag, action),
            eventResize: reduceEventResize(state.eventResize, action),
        };
        var contextAndState = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, calendarContext), newState);
        for (var _i = 0, _c = optionsData.pluginHooks.reducers; _i < _c.length; _i++) {
            var reducer = _c[_i];
            (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(newState, reducer(state, action, contextAndState)); // give the OLD state, for old value
        }
        var wasLoading = computeIsLoading(state, calendarContext);
        var isLoading = computeIsLoading(newState, calendarContext);
        // TODO: use propSetHandlers in plugin system
        if (!wasLoading && isLoading) {
            emitter.trigger('loading', true);
        }
        else if (wasLoading && !isLoading) {
            emitter.trigger('loading', false);
        }
        this.state = newState;
        if (props.onAction) {
            props.onAction(action);
        }
    };
    CalendarDataManager.prototype.updateData = function () {
        var _a = this, props = _a.props, state = _a.state;
        var oldData = this.data;
        var optionsData = this.computeOptionsData(props.optionOverrides, state.dynamicOptionOverrides, props.calendarApi);
        var currentViewData = this.computeCurrentViewData(state.currentViewType, optionsData, props.optionOverrides, state.dynamicOptionOverrides);
        var data = this.data = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ viewTitle: this.buildTitle(state.dateProfile, currentViewData.options, optionsData.dateEnv), calendarApi: props.calendarApi, dispatch: this.dispatch, emitter: this.emitter, getCurrentData: this.getCurrentData }, optionsData), currentViewData), state);
        var changeHandlers = optionsData.pluginHooks.optionChangeHandlers;
        var oldCalendarOptions = oldData && oldData.calendarOptions;
        var newCalendarOptions = optionsData.calendarOptions;
        if (oldCalendarOptions && oldCalendarOptions !== newCalendarOptions) {
            if (oldCalendarOptions.timeZone !== newCalendarOptions.timeZone) {
                // hack
                state.eventSources = data.eventSources = reduceEventSourcesNewTimeZone(data.eventSources, state.dateProfile, data);
                state.eventStore = data.eventStore = rezoneEventStoreDates(data.eventStore, oldData.dateEnv, data.dateEnv);
            }
            for (var optionName in changeHandlers) {
                if (oldCalendarOptions[optionName] !== newCalendarOptions[optionName]) {
                    changeHandlers[optionName](newCalendarOptions[optionName], data);
                }
            }
        }
        if (props.onData) {
            props.onData(data);
        }
    };
    CalendarDataManager.prototype._computeOptionsData = function (optionOverrides, dynamicOptionOverrides, calendarApi) {
        // TODO: blacklist options that are handled by optionChangeHandlers
        var _a = this.processRawCalendarOptions(optionOverrides, dynamicOptionOverrides), refinedOptions = _a.refinedOptions, pluginHooks = _a.pluginHooks, localeDefaults = _a.localeDefaults, availableLocaleData = _a.availableLocaleData, extra = _a.extra;
        warnUnknownOptions(extra);
        var dateEnv = this.buildDateEnv(refinedOptions.timeZone, refinedOptions.locale, refinedOptions.weekNumberCalculation, refinedOptions.firstDay, refinedOptions.weekText, pluginHooks, availableLocaleData, refinedOptions.defaultRangeSeparator);
        var viewSpecs = this.buildViewSpecs(pluginHooks.views, optionOverrides, dynamicOptionOverrides, localeDefaults);
        var theme = this.buildTheme(refinedOptions, pluginHooks);
        var toolbarConfig = this.parseToolbars(refinedOptions, optionOverrides, theme, viewSpecs, calendarApi);
        return {
            calendarOptions: refinedOptions,
            pluginHooks: pluginHooks,
            dateEnv: dateEnv,
            viewSpecs: viewSpecs,
            theme: theme,
            toolbarConfig: toolbarConfig,
            localeDefaults: localeDefaults,
            availableRawLocales: availableLocaleData.map,
        };
    };
    // always called from behind a memoizer
    CalendarDataManager.prototype.processRawCalendarOptions = function (optionOverrides, dynamicOptionOverrides) {
        var _a = mergeRawOptions([
            BASE_OPTION_DEFAULTS,
            optionOverrides,
            dynamicOptionOverrides,
        ]), locales = _a.locales, locale = _a.locale;
        var availableLocaleData = this.organizeRawLocales(locales);
        var availableRawLocales = availableLocaleData.map;
        var localeDefaults = this.buildLocale(locale || availableLocaleData.defaultCode, availableRawLocales).options;
        var pluginHooks = this.buildPluginHooks(optionOverrides.plugins || [], globalPlugins);
        var refiners = this.currentCalendarOptionsRefiners = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, BASE_OPTION_REFINERS), CALENDAR_LISTENER_REFINERS), CALENDAR_OPTION_REFINERS), pluginHooks.listenerRefiners), pluginHooks.optionRefiners);
        var extra = {};
        var raw = mergeRawOptions([
            BASE_OPTION_DEFAULTS,
            localeDefaults,
            optionOverrides,
            dynamicOptionOverrides,
        ]);
        var refined = {};
        var currentRaw = this.currentCalendarOptionsInput;
        var currentRefined = this.currentCalendarOptionsRefined;
        var anyChanges = false;
        for (var optionName in raw) {
            if (optionName !== 'plugins') { // because plugins is special-cased
                if (raw[optionName] === currentRaw[optionName] ||
                    (COMPLEX_OPTION_COMPARATORS[optionName] &&
                        (optionName in currentRaw) &&
                        COMPLEX_OPTION_COMPARATORS[optionName](currentRaw[optionName], raw[optionName]))) {
                    refined[optionName] = currentRefined[optionName];
                }
                else if (refiners[optionName]) {
                    refined[optionName] = refiners[optionName](raw[optionName]);
                    anyChanges = true;
                }
                else {
                    extra[optionName] = currentRaw[optionName];
                }
            }
        }
        if (anyChanges) {
            this.currentCalendarOptionsInput = raw;
            this.currentCalendarOptionsRefined = refined;
        }
        return {
            rawOptions: this.currentCalendarOptionsInput,
            refinedOptions: this.currentCalendarOptionsRefined,
            pluginHooks: pluginHooks,
            availableLocaleData: availableLocaleData,
            localeDefaults: localeDefaults,
            extra: extra,
        };
    };
    CalendarDataManager.prototype._computeCurrentViewData = function (viewType, optionsData, optionOverrides, dynamicOptionOverrides) {
        var viewSpec = optionsData.viewSpecs[viewType];
        if (!viewSpec) {
            throw new Error("viewType \"" + viewType + "\" is not available. Please make sure you've loaded all neccessary plugins");
        }
        var _a = this.processRawViewOptions(viewSpec, optionsData.pluginHooks, optionsData.localeDefaults, optionOverrides, dynamicOptionOverrides), refinedOptions = _a.refinedOptions, extra = _a.extra;
        warnUnknownOptions(extra);
        var dateProfileGenerator = this.buildDateProfileGenerator({
            dateProfileGeneratorClass: viewSpec.optionDefaults.dateProfileGeneratorClass,
            duration: viewSpec.duration,
            durationUnit: viewSpec.durationUnit,
            usesMinMaxTime: viewSpec.optionDefaults.usesMinMaxTime,
            dateEnv: optionsData.dateEnv,
            calendarApi: this.props.calendarApi,
            slotMinTime: refinedOptions.slotMinTime,
            slotMaxTime: refinedOptions.slotMaxTime,
            showNonCurrentDates: refinedOptions.showNonCurrentDates,
            dayCount: refinedOptions.dayCount,
            dateAlignment: refinedOptions.dateAlignment,
            dateIncrement: refinedOptions.dateIncrement,
            hiddenDays: refinedOptions.hiddenDays,
            weekends: refinedOptions.weekends,
            nowInput: refinedOptions.now,
            validRangeInput: refinedOptions.validRange,
            visibleRangeInput: refinedOptions.visibleRange,
            monthMode: refinedOptions.monthMode,
            fixedWeekCount: refinedOptions.fixedWeekCount,
        });
        var viewApi = this.buildViewApi(viewType, this.getCurrentData, optionsData.dateEnv);
        return { viewSpec: viewSpec, options: refinedOptions, dateProfileGenerator: dateProfileGenerator, viewApi: viewApi };
    };
    CalendarDataManager.prototype.processRawViewOptions = function (viewSpec, pluginHooks, localeDefaults, optionOverrides, dynamicOptionOverrides) {
        var raw = mergeRawOptions([
            BASE_OPTION_DEFAULTS,
            viewSpec.optionDefaults,
            localeDefaults,
            optionOverrides,
            viewSpec.optionOverrides,
            dynamicOptionOverrides,
        ]);
        var refiners = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, BASE_OPTION_REFINERS), CALENDAR_LISTENER_REFINERS), CALENDAR_OPTION_REFINERS), VIEW_OPTION_REFINERS), pluginHooks.listenerRefiners), pluginHooks.optionRefiners);
        var refined = {};
        var currentRaw = this.currentViewOptionsInput;
        var currentRefined = this.currentViewOptionsRefined;
        var anyChanges = false;
        var extra = {};
        for (var optionName in raw) {
            if (raw[optionName] === currentRaw[optionName] ||
                (COMPLEX_OPTION_COMPARATORS[optionName] &&
                    COMPLEX_OPTION_COMPARATORS[optionName](raw[optionName], currentRaw[optionName]))) {
                refined[optionName] = currentRefined[optionName];
            }
            else {
                if (raw[optionName] === this.currentCalendarOptionsInput[optionName] ||
                    (COMPLEX_OPTION_COMPARATORS[optionName] &&
                        COMPLEX_OPTION_COMPARATORS[optionName](raw[optionName], this.currentCalendarOptionsInput[optionName]))) {
                    if (optionName in this.currentCalendarOptionsRefined) { // might be an "extra" prop
                        refined[optionName] = this.currentCalendarOptionsRefined[optionName];
                    }
                }
                else if (refiners[optionName]) {
                    refined[optionName] = refiners[optionName](raw[optionName]);
                }
                else {
                    extra[optionName] = raw[optionName];
                }
                anyChanges = true;
            }
        }
        if (anyChanges) {
            this.currentViewOptionsInput = raw;
            this.currentViewOptionsRefined = refined;
        }
        return {
            rawOptions: this.currentViewOptionsInput,
            refinedOptions: this.currentViewOptionsRefined,
            extra: extra,
        };
    };
    return CalendarDataManager;
}());
function buildDateEnv(timeZone, explicitLocale, weekNumberCalculation, firstDay, weekText, pluginHooks, availableLocaleData, defaultSeparator) {
    var locale = buildLocale(explicitLocale || availableLocaleData.defaultCode, availableLocaleData.map);
    return new DateEnv({
        calendarSystem: 'gregory',
        timeZone: timeZone,
        namedTimeZoneImpl: pluginHooks.namedTimeZonedImpl,
        locale: locale,
        weekNumberCalculation: weekNumberCalculation,
        firstDay: firstDay,
        weekText: weekText,
        cmdFormatter: pluginHooks.cmdFormatter,
        defaultSeparator: defaultSeparator,
    });
}
function buildTheme(options, pluginHooks) {
    var ThemeClass = pluginHooks.themeClasses[options.themeSystem] || StandardTheme;
    return new ThemeClass(options);
}
function buildDateProfileGenerator(props) {
    var DateProfileGeneratorClass = props.dateProfileGeneratorClass || DateProfileGenerator;
    return new DateProfileGeneratorClass(props);
}
function buildViewApi(type, getCurrentData, dateEnv) {
    return new ViewApi(type, getCurrentData, dateEnv);
}
function buildEventUiBySource(eventSources) {
    return mapHash(eventSources, function (eventSource) { return eventSource.ui; });
}
function buildEventUiBases(eventDefs, eventUiSingleBase, eventUiBySource) {
    var eventUiBases = { '': eventUiSingleBase };
    for (var defId in eventDefs) {
        var def = eventDefs[defId];
        if (def.sourceId && eventUiBySource[def.sourceId]) {
            eventUiBases[defId] = eventUiBySource[def.sourceId];
        }
    }
    return eventUiBases;
}
function buildViewUiProps(calendarContext) {
    var options = calendarContext.options;
    return {
        eventUiSingleBase: createEventUi({
            display: options.eventDisplay,
            editable: options.editable,
            startEditable: options.eventStartEditable,
            durationEditable: options.eventDurationEditable,
            constraint: options.eventConstraint,
            overlap: typeof options.eventOverlap === 'boolean' ? options.eventOverlap : undefined,
            allow: options.eventAllow,
            backgroundColor: options.eventBackgroundColor,
            borderColor: options.eventBorderColor,
            textColor: options.eventTextColor,
            color: options.eventColor,
            // classNames: options.eventClassNames // render hook will handle this
        }, calendarContext),
        selectionConfig: createEventUi({
            constraint: options.selectConstraint,
            overlap: typeof options.selectOverlap === 'boolean' ? options.selectOverlap : undefined,
            allow: options.selectAllow,
        }, calendarContext),
    };
}
function computeIsLoading(state, context) {
    for (var _i = 0, _a = context.pluginHooks.isLoadingFuncs; _i < _a.length; _i++) {
        var isLoadingFunc = _a[_i];
        if (isLoadingFunc(state)) {
            return true;
        }
    }
    return false;
}
function parseContextBusinessHours(calendarContext) {
    return parseBusinessHours(calendarContext.options.businessHours, calendarContext);
}
function warnUnknownOptions(options, viewName) {
    for (var optionName in options) {
        console.warn("Unknown option '" + optionName + "'" +
            (viewName ? " for view '" + viewName + "'" : ''));
    }
}

// TODO: move this to react plugin?
var CalendarDataProvider = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(CalendarDataProvider, _super);
    function CalendarDataProvider(props) {
        var _this = _super.call(this, props) || this;
        _this.handleData = function (data) {
            if (!_this.dataManager) { // still within initial run, before assignment in constructor
                // eslint-disable-next-line react/no-direct-mutation-state
                _this.state = data; // can't use setState yet
            }
            else {
                _this.setState(data);
            }
        };
        _this.dataManager = new CalendarDataManager({
            optionOverrides: props.optionOverrides,
            calendarApi: props.calendarApi,
            onData: _this.handleData,
        });
        return _this;
    }
    CalendarDataProvider.prototype.render = function () {
        return this.props.children(this.state);
    };
    CalendarDataProvider.prototype.componentDidUpdate = function (prevProps) {
        var newOptionOverrides = this.props.optionOverrides;
        if (newOptionOverrides !== prevProps.optionOverrides) { // prevent recursive handleData
            this.dataManager.resetOptions(newOptionOverrides);
        }
    };
    return CalendarDataProvider;
}(_vdom_js__WEBPACK_IMPORTED_MODULE_1__.Component));

// HELPERS
/*
if nextDayThreshold is specified, slicing is done in an all-day fashion.
you can get nextDayThreshold from context.nextDayThreshold
*/
function sliceEvents(props, allDay) {
    return sliceEventStore(props.eventStore, props.eventUiBases, props.dateProfile.activeRange, allDay ? props.nextDayThreshold : null).fg;
}

var NamedTimeZoneImpl = /** @class */ (function () {
    function NamedTimeZoneImpl(timeZoneName) {
        this.timeZoneName = timeZoneName;
    }
    return NamedTimeZoneImpl;
}());

var SegHierarchy = /** @class */ (function () {
    function SegHierarchy() {
        // settings
        this.strictOrder = false;
        this.allowReslicing = false;
        this.maxCoord = -1; // -1 means no max
        this.maxStackCnt = -1; // -1 means no max
        this.levelCoords = []; // ordered
        this.entriesByLevel = []; // parallel with levelCoords
        this.stackCnts = {}; // TODO: use better technique!?
    }
    SegHierarchy.prototype.addSegs = function (inputs) {
        var hiddenEntries = [];
        for (var _i = 0, inputs_1 = inputs; _i < inputs_1.length; _i++) {
            var input = inputs_1[_i];
            this.insertEntry(input, hiddenEntries);
        }
        return hiddenEntries;
    };
    SegHierarchy.prototype.insertEntry = function (entry, hiddenEntries) {
        var insertion = this.findInsertion(entry);
        if (this.isInsertionValid(insertion, entry)) {
            this.insertEntryAt(entry, insertion);
            return 1;
        }
        return this.handleInvalidInsertion(insertion, entry, hiddenEntries);
    };
    SegHierarchy.prototype.isInsertionValid = function (insertion, entry) {
        return (this.maxCoord === -1 || insertion.levelCoord + entry.thickness <= this.maxCoord) &&
            (this.maxStackCnt === -1 || insertion.stackCnt < this.maxStackCnt);
    };
    // returns number of new entries inserted
    SegHierarchy.prototype.handleInvalidInsertion = function (insertion, entry, hiddenEntries) {
        if (this.allowReslicing && insertion.touchingEntry) {
            return this.splitEntry(entry, insertion.touchingEntry, hiddenEntries);
        }
        hiddenEntries.push(entry);
        return 0;
    };
    SegHierarchy.prototype.splitEntry = function (entry, barrier, hiddenEntries) {
        var partCnt = 0;
        var splitHiddenEntries = [];
        var entrySpan = entry.span;
        var barrierSpan = barrier.span;
        if (entrySpan.start < barrierSpan.start) {
            partCnt += this.insertEntry({
                index: entry.index,
                thickness: entry.thickness,
                span: { start: entrySpan.start, end: barrierSpan.start },
            }, splitHiddenEntries);
        }
        if (entrySpan.end > barrierSpan.end) {
            partCnt += this.insertEntry({
                index: entry.index,
                thickness: entry.thickness,
                span: { start: barrierSpan.end, end: entrySpan.end },
            }, splitHiddenEntries);
        }
        if (partCnt) {
            hiddenEntries.push.apply(hiddenEntries, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([{
                    index: entry.index,
                    thickness: entry.thickness,
                    span: intersectSpans(barrierSpan, entrySpan), // guaranteed to intersect
                }], splitHiddenEntries));
            return partCnt;
        }
        hiddenEntries.push(entry);
        return 0;
    };
    SegHierarchy.prototype.insertEntryAt = function (entry, insertion) {
        var _a = this, entriesByLevel = _a.entriesByLevel, levelCoords = _a.levelCoords;
        if (insertion.lateral === -1) {
            // create a new level
            insertAt(levelCoords, insertion.level, insertion.levelCoord);
            insertAt(entriesByLevel, insertion.level, [entry]);
        }
        else {
            // insert into existing level
            insertAt(entriesByLevel[insertion.level], insertion.lateral, entry);
        }
        this.stackCnts[buildEntryKey(entry)] = insertion.stackCnt;
    };
    SegHierarchy.prototype.findInsertion = function (newEntry) {
        var _a = this, levelCoords = _a.levelCoords, entriesByLevel = _a.entriesByLevel, strictOrder = _a.strictOrder, stackCnts = _a.stackCnts;
        var levelCnt = levelCoords.length;
        var candidateCoord = 0;
        var touchingLevel = -1;
        var touchingLateral = -1;
        var touchingEntry = null;
        var stackCnt = 0;
        for (var trackingLevel = 0; trackingLevel < levelCnt; trackingLevel += 1) {
            var trackingCoord = levelCoords[trackingLevel];
            // if the current level is past the placed entry, we have found a good empty space and can stop.
            // if strictOrder, keep finding more lateral intersections.
            if (!strictOrder && trackingCoord >= candidateCoord + newEntry.thickness) {
                break;
            }
            var trackingEntries = entriesByLevel[trackingLevel];
            var trackingEntry = void 0;
            var searchRes = binarySearch(trackingEntries, newEntry.span.start, getEntrySpanEnd); // find first entry after newEntry's end
            var lateralIndex = searchRes[0] + searchRes[1]; // if exact match (which doesn't collide), go to next one
            while ( // loop through entries that horizontally intersect
            (trackingEntry = trackingEntries[lateralIndex]) && // but not past the whole entry list
                trackingEntry.span.start < newEntry.span.end // and not entirely past newEntry
            ) {
                var trackingEntryBottom = trackingCoord + trackingEntry.thickness;
                // intersects into the top of the candidate?
                if (trackingEntryBottom > candidateCoord) {
                    candidateCoord = trackingEntryBottom;
                    touchingEntry = trackingEntry;
                    touchingLevel = trackingLevel;
                    touchingLateral = lateralIndex;
                }
                // butts up against top of candidate? (will happen if just intersected as well)
                if (trackingEntryBottom === candidateCoord) {
                    // accumulate the highest possible stackCnt of the trackingEntries that butt up
                    stackCnt = Math.max(stackCnt, stackCnts[buildEntryKey(trackingEntry)] + 1);
                }
                lateralIndex += 1;
            }
        }
        // the destination level will be after touchingEntry's level. find it
        var destLevel = 0;
        if (touchingEntry) {
            destLevel = touchingLevel + 1;
            while (destLevel < levelCnt && levelCoords[destLevel] < candidateCoord) {
                destLevel += 1;
            }
        }
        // if adding to an existing level, find where to insert
        var destLateral = -1;
        if (destLevel < levelCnt && levelCoords[destLevel] === candidateCoord) {
            destLateral = binarySearch(entriesByLevel[destLevel], newEntry.span.end, getEntrySpanEnd)[0];
        }
        return {
            touchingLevel: touchingLevel,
            touchingLateral: touchingLateral,
            touchingEntry: touchingEntry,
            stackCnt: stackCnt,
            levelCoord: candidateCoord,
            level: destLevel,
            lateral: destLateral,
        };
    };
    // sorted by levelCoord (lowest to highest)
    SegHierarchy.prototype.toRects = function () {
        var _a = this, entriesByLevel = _a.entriesByLevel, levelCoords = _a.levelCoords;
        var levelCnt = entriesByLevel.length;
        var rects = [];
        for (var level = 0; level < levelCnt; level += 1) {
            var entries = entriesByLevel[level];
            var levelCoord = levelCoords[level];
            for (var _i = 0, entries_1 = entries; _i < entries_1.length; _i++) {
                var entry = entries_1[_i];
                rects.push((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, entry), { levelCoord: levelCoord }));
            }
        }
        return rects;
    };
    return SegHierarchy;
}());
function getEntrySpanEnd(entry) {
    return entry.span.end;
}
function buildEntryKey(entry) {
    return entry.index + ':' + entry.span.start;
}
// returns groups with entries sorted by input order
function groupIntersectingEntries(entries) {
    var merges = [];
    for (var _i = 0, entries_2 = entries; _i < entries_2.length; _i++) {
        var entry = entries_2[_i];
        var filteredMerges = [];
        var hungryMerge = {
            span: entry.span,
            entries: [entry],
        };
        for (var _a = 0, merges_1 = merges; _a < merges_1.length; _a++) {
            var merge = merges_1[_a];
            if (intersectSpans(merge.span, hungryMerge.span)) {
                hungryMerge = {
                    entries: merge.entries.concat(hungryMerge.entries),
                    span: joinSpans(merge.span, hungryMerge.span),
                };
            }
            else {
                filteredMerges.push(merge);
            }
        }
        filteredMerges.push(hungryMerge);
        merges = filteredMerges;
    }
    return merges;
}
function joinSpans(span0, span1) {
    return {
        start: Math.min(span0.start, span1.start),
        end: Math.max(span0.end, span1.end),
    };
}
function intersectSpans(span0, span1) {
    var start = Math.max(span0.start, span1.start);
    var end = Math.min(span0.end, span1.end);
    if (start < end) {
        return { start: start, end: end };
    }
    return null;
}
// general util
// ---------------------------------------------------------------------------------------------------------------------
function insertAt(arr, index, item) {
    arr.splice(index, 0, item);
}
function binarySearch(a, searchVal, getItemVal) {
    var startIndex = 0;
    var endIndex = a.length; // exclusive
    if (!endIndex || searchVal < getItemVal(a[startIndex])) { // no items OR before first item
        return [0, 0];
    }
    if (searchVal > getItemVal(a[endIndex - 1])) { // after last item
        return [endIndex, 0];
    }
    while (startIndex < endIndex) {
        var middleIndex = Math.floor(startIndex + (endIndex - startIndex) / 2);
        var middleVal = getItemVal(a[middleIndex]);
        if (searchVal < middleVal) {
            endIndex = middleIndex;
        }
        else if (searchVal > middleVal) {
            startIndex = middleIndex + 1;
        }
        else { // equal!
            return [middleIndex, 1];
        }
    }
    return [startIndex, 0];
}

var Interaction = /** @class */ (function () {
    function Interaction(settings) {
        this.component = settings.component;
        this.isHitComboAllowed = settings.isHitComboAllowed || null;
    }
    Interaction.prototype.destroy = function () {
    };
    return Interaction;
}());
function parseInteractionSettings(component, input) {
    return {
        component: component,
        el: input.el,
        useEventCenter: input.useEventCenter != null ? input.useEventCenter : true,
        isHitComboAllowed: input.isHitComboAllowed || null,
    };
}
function interactionSettingsToStore(settings) {
    var _a;
    return _a = {},
        _a[settings.component.uid] = settings,
        _a;
}
// global state
var interactionSettingsStore = {};

/*
An abstraction for a dragging interaction originating on an event.
Does higher-level things than PointerDragger, such as possibly:
- a "mirror" that moves with the pointer
- a minimum number of pixels or other criteria for a true drag to begin

subclasses must emit:
- pointerdown
- dragstart
- dragmove
- pointerup
- dragend
*/
var ElementDragging = /** @class */ (function () {
    function ElementDragging(el, selector) {
        this.emitter = new Emitter();
    }
    ElementDragging.prototype.destroy = function () {
    };
    ElementDragging.prototype.setMirrorIsVisible = function (bool) {
        // optional if subclass doesn't want to support a mirror
    };
    ElementDragging.prototype.setMirrorNeedsRevert = function (bool) {
        // optional if subclass doesn't want to support a mirror
    };
    ElementDragging.prototype.setAutoScrollEnabled = function (bool) {
        // optional
    };
    return ElementDragging;
}());

// TODO: get rid of this in favor of options system,
// tho it's really easy to access this globally rather than pass thru options.
var config = {};

/*
Information about what will happen when an external element is dragged-and-dropped
onto a calendar. Contains information for creating an event.
*/
var DRAG_META_REFINERS = {
    startTime: createDuration,
    duration: createDuration,
    create: Boolean,
    sourceId: String,
};
function parseDragMeta(raw) {
    var _a = refineProps(raw, DRAG_META_REFINERS), refined = _a.refined, extra = _a.extra;
    return {
        startTime: refined.startTime || null,
        duration: refined.duration || null,
        create: refined.create != null ? refined.create : true,
        sourceId: refined.sourceId,
        leftoverProps: extra,
    };
}

var ToolbarSection = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ToolbarSection, _super);
    function ToolbarSection() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ToolbarSection.prototype.render = function () {
        var _this = this;
        var children = this.props.widgetGroups.map(function (widgetGroup) { return _this.renderWidgetGroup(widgetGroup); });
        return _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['div', { className: 'fc-toolbar-chunk' }], children));
    };
    ToolbarSection.prototype.renderWidgetGroup = function (widgetGroup) {
        var props = this.props;
        var theme = this.context.theme;
        var children = [];
        var isOnlyButtons = true;
        for (var _i = 0, widgetGroup_1 = widgetGroup; _i < widgetGroup_1.length; _i++) {
            var widget = widgetGroup_1[_i];
            var buttonName = widget.buttonName, buttonClick = widget.buttonClick, buttonText = widget.buttonText, buttonIcon = widget.buttonIcon, buttonHint = widget.buttonHint;
            if (buttonName === 'title') {
                isOnlyButtons = false;
                children.push((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("h2", { className: "fc-toolbar-title", id: props.titleId }, props.title));
            }
            else {
                var isPressed = buttonName === props.activeButton;
                var isDisabled = (!props.isTodayEnabled && buttonName === 'today') ||
                    (!props.isPrevEnabled && buttonName === 'prev') ||
                    (!props.isNextEnabled && buttonName === 'next');
                var buttonClasses = ["fc-" + buttonName + "-button", theme.getClass('button')];
                if (isPressed) {
                    buttonClasses.push(theme.getClass('buttonActive'));
                }
                children.push((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("button", { type: "button", title: typeof buttonHint === 'function' ? buttonHint(props.navUnit) : buttonHint, disabled: isDisabled, "aria-pressed": isPressed, className: buttonClasses.join(' '), onClick: buttonClick }, buttonText || (buttonIcon ? (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: buttonIcon }) : '')));
            }
        }
        if (children.length > 1) {
            var groupClassName = (isOnlyButtons && theme.getClass('buttonGroup')) || '';
            return _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['div', { className: groupClassName }], children));
        }
        return children[0];
    };
    return ToolbarSection;
}(BaseComponent));

var Toolbar = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(Toolbar, _super);
    function Toolbar() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    Toolbar.prototype.render = function () {
        var _a = this.props, model = _a.model, extraClassName = _a.extraClassName;
        var forceLtr = false;
        var startContent;
        var endContent;
        var sectionWidgets = model.sectionWidgets;
        var centerContent = sectionWidgets.center;
        if (sectionWidgets.left) {
            forceLtr = true;
            startContent = sectionWidgets.left;
        }
        else {
            startContent = sectionWidgets.start;
        }
        if (sectionWidgets.right) {
            forceLtr = true;
            endContent = sectionWidgets.right;
        }
        else {
            endContent = sectionWidgets.end;
        }
        var classNames = [
            extraClassName || '',
            'fc-toolbar',
            forceLtr ? 'fc-toolbar-ltr' : '',
        ];
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: classNames.join(' ') },
            this.renderSection('start', startContent || []),
            this.renderSection('center', centerContent || []),
            this.renderSection('end', endContent || [])));
    };
    Toolbar.prototype.renderSection = function (key, widgetGroups) {
        var props = this.props;
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ToolbarSection, { key: key, widgetGroups: widgetGroups, title: props.title, navUnit: props.navUnit, activeButton: props.activeButton, isTodayEnabled: props.isTodayEnabled, isPrevEnabled: props.isPrevEnabled, isNextEnabled: props.isNextEnabled, titleId: props.titleId }));
    };
    return Toolbar;
}(BaseComponent));

// TODO: do function component?
var ViewContainer = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ViewContainer, _super);
    function ViewContainer() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.state = {
            availableWidth: null,
        };
        _this.handleEl = function (el) {
            _this.el = el;
            setRef(_this.props.elRef, el);
            _this.updateAvailableWidth();
        };
        _this.handleResize = function () {
            _this.updateAvailableWidth();
        };
        return _this;
    }
    ViewContainer.prototype.render = function () {
        var _a = this, props = _a.props, state = _a.state;
        var aspectRatio = props.aspectRatio;
        var classNames = [
            'fc-view-harness',
            (aspectRatio || props.liquid || props.height)
                ? 'fc-view-harness-active' // harness controls the height
                : 'fc-view-harness-passive', // let the view do the height
        ];
        var height = '';
        var paddingBottom = '';
        if (aspectRatio) {
            if (state.availableWidth !== null) {
                height = state.availableWidth / aspectRatio;
            }
            else {
                // while waiting to know availableWidth, we can't set height to *zero*
                // because will cause lots of unnecessary scrollbars within scrollgrid.
                // BETTER: don't start rendering ANYTHING yet until we know container width
                // NOTE: why not always use paddingBottom? Causes height oscillation (issue 5606)
                paddingBottom = (1 / aspectRatio) * 100 + "%";
            }
        }
        else {
            height = props.height || '';
        }
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { "aria-labelledby": props.labeledById, ref: this.handleEl, className: classNames.join(' '), style: { height: height, paddingBottom: paddingBottom } }, props.children));
    };
    ViewContainer.prototype.componentDidMount = function () {
        this.context.addResizeHandler(this.handleResize);
    };
    ViewContainer.prototype.componentWillUnmount = function () {
        this.context.removeResizeHandler(this.handleResize);
    };
    ViewContainer.prototype.updateAvailableWidth = function () {
        if (this.el && // needed. but why?
            this.props.aspectRatio // aspectRatio is the only height setting that needs availableWidth
        ) {
            this.setState({ availableWidth: this.el.offsetWidth });
        }
    };
    return ViewContainer;
}(BaseComponent));

/*
Detects when the user clicks on an event within a DateComponent
*/
var EventClicking = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(EventClicking, _super);
    function EventClicking(settings) {
        var _this = _super.call(this, settings) || this;
        _this.handleSegClick = function (ev, segEl) {
            var component = _this.component;
            var context = component.context;
            var seg = getElSeg(segEl);
            if (seg && // might be the <div> surrounding the more link
                component.isValidSegDownEl(ev.target)) {
                // our way to simulate a link click for elements that can't be <a> tags
                // grab before trigger fired in case trigger trashes DOM thru rerendering
                var hasUrlContainer = elementClosest(ev.target, '.fc-event-forced-url');
                var url = hasUrlContainer ? hasUrlContainer.querySelector('a[href]').href : '';
                context.emitter.trigger('eventClick', {
                    el: segEl,
                    event: new EventApi(component.context, seg.eventRange.def, seg.eventRange.instance),
                    jsEvent: ev,
                    view: context.viewApi,
                });
                if (url && !ev.defaultPrevented) {
                    window.location.href = url;
                }
            }
        };
        _this.destroy = listenBySelector(settings.el, 'click', '.fc-event', // on both fg and bg events
        _this.handleSegClick);
        return _this;
    }
    return EventClicking;
}(Interaction));

/*
Triggers events and adds/removes core classNames when the user's pointer
enters/leaves event-elements of a component.
*/
var EventHovering = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(EventHovering, _super);
    function EventHovering(settings) {
        var _this = _super.call(this, settings) || this;
        // for simulating an eventMouseLeave when the event el is destroyed while mouse is over it
        _this.handleEventElRemove = function (el) {
            if (el === _this.currentSegEl) {
                _this.handleSegLeave(null, _this.currentSegEl);
            }
        };
        _this.handleSegEnter = function (ev, segEl) {
            if (getElSeg(segEl)) { // TODO: better way to make sure not hovering over more+ link or its wrapper
                _this.currentSegEl = segEl;
                _this.triggerEvent('eventMouseEnter', ev, segEl);
            }
        };
        _this.handleSegLeave = function (ev, segEl) {
            if (_this.currentSegEl) {
                _this.currentSegEl = null;
                _this.triggerEvent('eventMouseLeave', ev, segEl);
            }
        };
        _this.removeHoverListeners = listenToHoverBySelector(settings.el, '.fc-event', // on both fg and bg events
        _this.handleSegEnter, _this.handleSegLeave);
        return _this;
    }
    EventHovering.prototype.destroy = function () {
        this.removeHoverListeners();
    };
    EventHovering.prototype.triggerEvent = function (publicEvName, ev, segEl) {
        var component = this.component;
        var context = component.context;
        var seg = getElSeg(segEl);
        if (!ev || component.isValidSegDownEl(ev.target)) {
            context.emitter.trigger(publicEvName, {
                el: segEl,
                event: new EventApi(context, seg.eventRange.def, seg.eventRange.instance),
                jsEvent: ev,
                view: context.viewApi,
            });
        }
    };
    return EventHovering;
}(Interaction));

var CalendarContent = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(CalendarContent, _super);
    function CalendarContent() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.buildViewContext = memoize(buildViewContext);
        _this.buildViewPropTransformers = memoize(buildViewPropTransformers);
        _this.buildToolbarProps = memoize(buildToolbarProps);
        _this.headerRef = (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.footerRef = (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.interactionsStore = {};
        // eslint-disable-next-line
        _this.state = {
            viewLabelId: getUniqueDomId(),
        };
        // Component Registration
        // -----------------------------------------------------------------------------------------------------------------
        _this.registerInteractiveComponent = function (component, settingsInput) {
            var settings = parseInteractionSettings(component, settingsInput);
            var DEFAULT_INTERACTIONS = [
                EventClicking,
                EventHovering,
            ];
            var interactionClasses = DEFAULT_INTERACTIONS.concat(_this.props.pluginHooks.componentInteractions);
            var interactions = interactionClasses.map(function (TheInteractionClass) { return new TheInteractionClass(settings); });
            _this.interactionsStore[component.uid] = interactions;
            interactionSettingsStore[component.uid] = settings;
        };
        _this.unregisterInteractiveComponent = function (component) {
            var listeners = _this.interactionsStore[component.uid];
            if (listeners) {
                for (var _i = 0, listeners_1 = listeners; _i < listeners_1.length; _i++) {
                    var listener = listeners_1[_i];
                    listener.destroy();
                }
                delete _this.interactionsStore[component.uid];
            }
            delete interactionSettingsStore[component.uid];
        };
        // Resizing
        // -----------------------------------------------------------------------------------------------------------------
        _this.resizeRunner = new DelayedRunner(function () {
            _this.props.emitter.trigger('_resize', true); // should window resizes be considered "forced" ?
            _this.props.emitter.trigger('windowResize', { view: _this.props.viewApi });
        });
        _this.handleWindowResize = function (ev) {
            var options = _this.props.options;
            if (options.handleWindowResize &&
                ev.target === window // avoid jqui events
            ) {
                _this.resizeRunner.request(options.windowResizeDelay);
            }
        };
        return _this;
    }
    /*
    renders INSIDE of an outer div
    */
    CalendarContent.prototype.render = function () {
        var props = this.props;
        var toolbarConfig = props.toolbarConfig, options = props.options;
        var toolbarProps = this.buildToolbarProps(props.viewSpec, props.dateProfile, props.dateProfileGenerator, props.currentDate, getNow(props.options.now, props.dateEnv), // TODO: use NowTimer????
        props.viewTitle);
        var viewVGrow = false;
        var viewHeight = '';
        var viewAspectRatio;
        if (props.isHeightAuto || props.forPrint) {
            viewHeight = '';
        }
        else if (options.height != null) {
            viewVGrow = true;
        }
        else if (options.contentHeight != null) {
            viewHeight = options.contentHeight;
        }
        else {
            viewAspectRatio = Math.max(options.aspectRatio, 0.5); // prevent from getting too tall
        }
        var viewContext = this.buildViewContext(props.viewSpec, props.viewApi, props.options, props.dateProfileGenerator, props.dateEnv, props.theme, props.pluginHooks, props.dispatch, props.getCurrentData, props.emitter, props.calendarApi, this.registerInteractiveComponent, this.unregisterInteractiveComponent);
        var viewLabelId = (toolbarConfig.header && toolbarConfig.header.hasTitle)
            ? this.state.viewLabelId
            : '';
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ViewContextType.Provider, { value: viewContext },
            toolbarConfig.header && ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(Toolbar, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ ref: this.headerRef, extraClassName: "fc-header-toolbar", model: toolbarConfig.header, titleId: viewLabelId }, toolbarProps))),
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ViewContainer, { liquid: viewVGrow, height: viewHeight, aspectRatio: viewAspectRatio, labeledById: viewLabelId },
                this.renderView(props),
                this.buildAppendContent()),
            toolbarConfig.footer && ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(Toolbar, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ ref: this.footerRef, extraClassName: "fc-footer-toolbar", model: toolbarConfig.footer, titleId: "" }, toolbarProps)))));
    };
    CalendarContent.prototype.componentDidMount = function () {
        var props = this.props;
        this.calendarInteractions = props.pluginHooks.calendarInteractions
            .map(function (CalendarInteractionClass) { return new CalendarInteractionClass(props); });
        window.addEventListener('resize', this.handleWindowResize);
        var propSetHandlers = props.pluginHooks.propSetHandlers;
        for (var propName in propSetHandlers) {
            propSetHandlers[propName](props[propName], props);
        }
    };
    CalendarContent.prototype.componentDidUpdate = function (prevProps) {
        var props = this.props;
        var propSetHandlers = props.pluginHooks.propSetHandlers;
        for (var propName in propSetHandlers) {
            if (props[propName] !== prevProps[propName]) {
                propSetHandlers[propName](props[propName], props);
            }
        }
    };
    CalendarContent.prototype.componentWillUnmount = function () {
        window.removeEventListener('resize', this.handleWindowResize);
        this.resizeRunner.clear();
        for (var _i = 0, _a = this.calendarInteractions; _i < _a.length; _i++) {
            var interaction = _a[_i];
            interaction.destroy();
        }
        this.props.emitter.trigger('_unmount');
    };
    CalendarContent.prototype.buildAppendContent = function () {
        var props = this.props;
        var children = props.pluginHooks.viewContainerAppends.map(function (buildAppendContent) { return buildAppendContent(props); });
        return _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([_vdom_js__WEBPACK_IMPORTED_MODULE_1__.Fragment, {}], children));
    };
    CalendarContent.prototype.renderView = function (props) {
        var pluginHooks = props.pluginHooks;
        var viewSpec = props.viewSpec;
        var viewProps = {
            dateProfile: props.dateProfile,
            businessHours: props.businessHours,
            eventStore: props.renderableEventStore,
            eventUiBases: props.eventUiBases,
            dateSelection: props.dateSelection,
            eventSelection: props.eventSelection,
            eventDrag: props.eventDrag,
            eventResize: props.eventResize,
            isHeightAuto: props.isHeightAuto,
            forPrint: props.forPrint,
        };
        var transformers = this.buildViewPropTransformers(pluginHooks.viewPropsTransformers);
        for (var _i = 0, transformers_1 = transformers; _i < transformers_1.length; _i++) {
            var transformer = transformers_1[_i];
            (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(viewProps, transformer.transform(viewProps, props));
        }
        var ViewComponent = viewSpec.component;
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ViewComponent, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, viewProps)));
    };
    return CalendarContent;
}(PureComponent));
function buildToolbarProps(viewSpec, dateProfile, dateProfileGenerator, currentDate, now, title) {
    // don't force any date-profiles to valid date profiles (the `false`) so that we can tell if it's invalid
    var todayInfo = dateProfileGenerator.build(now, undefined, false); // TODO: need `undefined` or else INFINITE LOOP for some reason
    var prevInfo = dateProfileGenerator.buildPrev(dateProfile, currentDate, false);
    var nextInfo = dateProfileGenerator.buildNext(dateProfile, currentDate, false);
    return {
        title: title,
        activeButton: viewSpec.type,
        navUnit: viewSpec.singleUnit,
        isTodayEnabled: todayInfo.isValid && !rangeContainsMarker(dateProfile.currentRange, now),
        isPrevEnabled: prevInfo.isValid,
        isNextEnabled: nextInfo.isValid,
    };
}
// Plugin
// -----------------------------------------------------------------------------------------------------------------
function buildViewPropTransformers(theClasses) {
    return theClasses.map(function (TheClass) { return new TheClass(); });
}

var CalendarRoot = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(CalendarRoot, _super);
    function CalendarRoot() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.state = {
            forPrint: false,
        };
        _this.handleBeforePrint = function () {
            _this.setState({ forPrint: true });
        };
        _this.handleAfterPrint = function () {
            _this.setState({ forPrint: false });
        };
        return _this;
    }
    CalendarRoot.prototype.render = function () {
        var props = this.props;
        var options = props.options;
        var forPrint = this.state.forPrint;
        var isHeightAuto = forPrint || options.height === 'auto' || options.contentHeight === 'auto';
        var height = (!isHeightAuto && options.height != null) ? options.height : '';
        var classNames = [
            'fc',
            forPrint ? 'fc-media-print' : 'fc-media-screen',
            "fc-direction-" + options.direction,
            props.theme.getClass('root'),
        ];
        if (!getCanVGrowWithinCell()) {
            classNames.push('fc-liquid-hack');
        }
        return props.children(classNames, height, isHeightAuto, forPrint);
    };
    CalendarRoot.prototype.componentDidMount = function () {
        var emitter = this.props.emitter;
        emitter.on('_beforeprint', this.handleBeforePrint);
        emitter.on('_afterprint', this.handleAfterPrint);
    };
    CalendarRoot.prototype.componentWillUnmount = function () {
        var emitter = this.props.emitter;
        emitter.off('_beforeprint', this.handleBeforePrint);
        emitter.off('_afterprint', this.handleAfterPrint);
    };
    return CalendarRoot;
}(BaseComponent));

// Computes a default column header formatting string if `colFormat` is not explicitly defined
function computeFallbackHeaderFormat(datesRepDistinctDays, dayCnt) {
    // if more than one week row, or if there are a lot of columns with not much space,
    // put just the day numbers will be in each cell
    if (!datesRepDistinctDays || dayCnt > 10) {
        return createFormatter({ weekday: 'short' }); // "Sat"
    }
    if (dayCnt > 1) {
        return createFormatter({ weekday: 'short', month: 'numeric', day: 'numeric', omitCommas: true }); // "Sat 11/12"
    }
    return createFormatter({ weekday: 'long' }); // "Saturday"
}

var CLASS_NAME = 'fc-col-header-cell'; // do the cushion too? no
function renderInner$1(hookProps) {
    return hookProps.text;
}

var TableDateCell = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(TableDateCell, _super);
    function TableDateCell() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TableDateCell.prototype.render = function () {
        var _a = this.context, dateEnv = _a.dateEnv, options = _a.options, theme = _a.theme, viewApi = _a.viewApi;
        var props = this.props;
        var date = props.date, dateProfile = props.dateProfile;
        var dayMeta = getDateMeta(date, props.todayRange, null, dateProfile);
        var classNames = [CLASS_NAME].concat(getDayClassNames(dayMeta, theme));
        var text = dateEnv.format(date, props.dayHeaderFormat);
        // if colCnt is 1, we are already in a day-view and don't need a navlink
        var navLinkAttrs = (!dayMeta.isDisabled && props.colCnt > 1)
            ? buildNavLinkAttrs(this.context, date)
            : {};
        var hookProps = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ date: dateEnv.toDate(date), view: viewApi }, props.extraHookProps), { text: text }), dayMeta);
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(RenderHook, { hookProps: hookProps, classNames: options.dayHeaderClassNames, content: options.dayHeaderContent, defaultContent: renderInner$1, didMount: options.dayHeaderDidMount, willUnmount: options.dayHeaderWillUnmount }, function (rootElRef, customClassNames, innerElRef, innerContent) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("th", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ ref: rootElRef, role: "columnheader", className: classNames.concat(customClassNames).join(' '), "data-date": !dayMeta.isDisabled ? formatDayString(date) : undefined, colSpan: props.colSpan }, props.extraDataAttrs),
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-scrollgrid-sync-inner" }, !dayMeta.isDisabled && ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("a", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ ref: innerElRef, className: [
                    'fc-col-header-cell-cushion',
                    props.isSticky ? 'fc-sticky' : '',
                ].join(' ') }, navLinkAttrs), innerContent))))); }));
    };
    return TableDateCell;
}(BaseComponent));

var WEEKDAY_FORMAT = createFormatter({ weekday: 'long' });
var TableDowCell = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(TableDowCell, _super);
    function TableDowCell() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TableDowCell.prototype.render = function () {
        var props = this.props;
        var _a = this.context, dateEnv = _a.dateEnv, theme = _a.theme, viewApi = _a.viewApi, options = _a.options;
        var date = addDays(new Date(259200000), props.dow); // start with Sun, 04 Jan 1970 00:00:00 GMT
        var dateMeta = {
            dow: props.dow,
            isDisabled: false,
            isFuture: false,
            isPast: false,
            isToday: false,
            isOther: false,
        };
        var classNames = [CLASS_NAME].concat(getDayClassNames(dateMeta, theme), props.extraClassNames || []);
        var text = dateEnv.format(date, props.dayHeaderFormat);
        var hookProps = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ // TODO: make this public?
            date: date }, dateMeta), { view: viewApi }), props.extraHookProps), { text: text });
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(RenderHook, { hookProps: hookProps, classNames: options.dayHeaderClassNames, content: options.dayHeaderContent, defaultContent: renderInner$1, didMount: options.dayHeaderDidMount, willUnmount: options.dayHeaderWillUnmount }, function (rootElRef, customClassNames, innerElRef, innerContent) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("th", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ ref: rootElRef, role: "columnheader", className: classNames.concat(customClassNames).join(' '), colSpan: props.colSpan }, props.extraDataAttrs),
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-scrollgrid-sync-inner" },
                (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("a", { "aria-label": dateEnv.format(date, WEEKDAY_FORMAT), className: [
                        'fc-col-header-cell-cushion',
                        props.isSticky ? 'fc-sticky' : '',
                    ].join(' '), ref: innerElRef }, innerContent)))); }));
    };
    return TableDowCell;
}(BaseComponent));

var NowTimer = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(NowTimer, _super);
    function NowTimer(props, context) {
        var _this = _super.call(this, props, context) || this;
        _this.initialNowDate = getNow(context.options.now, context.dateEnv);
        _this.initialNowQueriedMs = new Date().valueOf();
        _this.state = _this.computeTiming().currentState;
        return _this;
    }
    NowTimer.prototype.render = function () {
        var _a = this, props = _a.props, state = _a.state;
        return props.children(state.nowDate, state.todayRange);
    };
    NowTimer.prototype.componentDidMount = function () {
        this.setTimeout();
    };
    NowTimer.prototype.componentDidUpdate = function (prevProps) {
        if (prevProps.unit !== this.props.unit) {
            this.clearTimeout();
            this.setTimeout();
        }
    };
    NowTimer.prototype.componentWillUnmount = function () {
        this.clearTimeout();
    };
    NowTimer.prototype.computeTiming = function () {
        var _a = this, props = _a.props, context = _a.context;
        var unroundedNow = addMs(this.initialNowDate, new Date().valueOf() - this.initialNowQueriedMs);
        var currentUnitStart = context.dateEnv.startOf(unroundedNow, props.unit);
        var nextUnitStart = context.dateEnv.add(currentUnitStart, createDuration(1, props.unit));
        var waitMs = nextUnitStart.valueOf() - unroundedNow.valueOf();
        // there is a max setTimeout ms value (https://stackoverflow.com/a/3468650/96342)
        // ensure no longer than a day
        waitMs = Math.min(1000 * 60 * 60 * 24, waitMs);
        return {
            currentState: { nowDate: currentUnitStart, todayRange: buildDayRange(currentUnitStart) },
            nextState: { nowDate: nextUnitStart, todayRange: buildDayRange(nextUnitStart) },
            waitMs: waitMs,
        };
    };
    NowTimer.prototype.setTimeout = function () {
        var _this = this;
        var _a = this.computeTiming(), nextState = _a.nextState, waitMs = _a.waitMs;
        this.timeoutId = setTimeout(function () {
            _this.setState(nextState, function () {
                _this.setTimeout();
            });
        }, waitMs);
    };
    NowTimer.prototype.clearTimeout = function () {
        if (this.timeoutId) {
            clearTimeout(this.timeoutId);
        }
    };
    NowTimer.contextType = ViewContextType;
    return NowTimer;
}(_vdom_js__WEBPACK_IMPORTED_MODULE_1__.Component));
function buildDayRange(date) {
    var start = startOfDay(date);
    var end = addDays(start, 1);
    return { start: start, end: end };
}

var DayHeader = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(DayHeader, _super);
    function DayHeader() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.createDayHeaderFormatter = memoize(createDayHeaderFormatter);
        return _this;
    }
    DayHeader.prototype.render = function () {
        var context = this.context;
        var _a = this.props, dates = _a.dates, dateProfile = _a.dateProfile, datesRepDistinctDays = _a.datesRepDistinctDays, renderIntro = _a.renderIntro;
        var dayHeaderFormat = this.createDayHeaderFormatter(context.options.dayHeaderFormat, datesRepDistinctDays, dates.length);
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(NowTimer, { unit: "day" }, function (nowDate, todayRange) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { role: "row" },
            renderIntro && renderIntro('day'),
            dates.map(function (date) { return (datesRepDistinctDays ? ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(TableDateCell, { key: date.toISOString(), date: date, dateProfile: dateProfile, todayRange: todayRange, colCnt: dates.length, dayHeaderFormat: dayHeaderFormat })) : ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(TableDowCell, { key: date.getUTCDay(), dow: date.getUTCDay(), dayHeaderFormat: dayHeaderFormat }))); }))); }));
    };
    return DayHeader;
}(BaseComponent));
function createDayHeaderFormatter(explicitFormat, datesRepDistinctDays, dateCnt) {
    return explicitFormat || computeFallbackHeaderFormat(datesRepDistinctDays, dateCnt);
}

var DaySeriesModel = /** @class */ (function () {
    function DaySeriesModel(range, dateProfileGenerator) {
        var date = range.start;
        var end = range.end;
        var indices = [];
        var dates = [];
        var dayIndex = -1;
        while (date < end) { // loop each day from start to end
            if (dateProfileGenerator.isHiddenDay(date)) {
                indices.push(dayIndex + 0.5); // mark that it's between indices
            }
            else {
                dayIndex += 1;
                indices.push(dayIndex);
                dates.push(date);
            }
            date = addDays(date, 1);
        }
        this.dates = dates;
        this.indices = indices;
        this.cnt = dates.length;
    }
    DaySeriesModel.prototype.sliceRange = function (range) {
        var firstIndex = this.getDateDayIndex(range.start); // inclusive first index
        var lastIndex = this.getDateDayIndex(addDays(range.end, -1)); // inclusive last index
        var clippedFirstIndex = Math.max(0, firstIndex);
        var clippedLastIndex = Math.min(this.cnt - 1, lastIndex);
        // deal with in-between indices
        clippedFirstIndex = Math.ceil(clippedFirstIndex); // in-between starts round to next cell
        clippedLastIndex = Math.floor(clippedLastIndex); // in-between ends round to prev cell
        if (clippedFirstIndex <= clippedLastIndex) {
            return {
                firstIndex: clippedFirstIndex,
                lastIndex: clippedLastIndex,
                isStart: firstIndex === clippedFirstIndex,
                isEnd: lastIndex === clippedLastIndex,
            };
        }
        return null;
    };
    // Given a date, returns its chronolocial cell-index from the first cell of the grid.
    // If the date lies between cells (because of hiddenDays), returns a floating-point value between offsets.
    // If before the first offset, returns a negative number.
    // If after the last offset, returns an offset past the last cell offset.
    // Only works for *start* dates of cells. Will not work for exclusive end dates for cells.
    DaySeriesModel.prototype.getDateDayIndex = function (date) {
        var indices = this.indices;
        var dayOffset = Math.floor(diffDays(this.dates[0], date));
        if (dayOffset < 0) {
            return indices[0] - 1;
        }
        if (dayOffset >= indices.length) {
            return indices[indices.length - 1] + 1;
        }
        return indices[dayOffset];
    };
    return DaySeriesModel;
}());

var DayTableModel = /** @class */ (function () {
    function DayTableModel(daySeries, breakOnWeeks) {
        var dates = daySeries.dates;
        var daysPerRow;
        var firstDay;
        var rowCnt;
        if (breakOnWeeks) {
            // count columns until the day-of-week repeats
            firstDay = dates[0].getUTCDay();
            for (daysPerRow = 1; daysPerRow < dates.length; daysPerRow += 1) {
                if (dates[daysPerRow].getUTCDay() === firstDay) {
                    break;
                }
            }
            rowCnt = Math.ceil(dates.length / daysPerRow);
        }
        else {
            rowCnt = 1;
            daysPerRow = dates.length;
        }
        this.rowCnt = rowCnt;
        this.colCnt = daysPerRow;
        this.daySeries = daySeries;
        this.cells = this.buildCells();
        this.headerDates = this.buildHeaderDates();
    }
    DayTableModel.prototype.buildCells = function () {
        var rows = [];
        for (var row = 0; row < this.rowCnt; row += 1) {
            var cells = [];
            for (var col = 0; col < this.colCnt; col += 1) {
                cells.push(this.buildCell(row, col));
            }
            rows.push(cells);
        }
        return rows;
    };
    DayTableModel.prototype.buildCell = function (row, col) {
        var date = this.daySeries.dates[row * this.colCnt + col];
        return {
            key: date.toISOString(),
            date: date,
        };
    };
    DayTableModel.prototype.buildHeaderDates = function () {
        var dates = [];
        for (var col = 0; col < this.colCnt; col += 1) {
            dates.push(this.cells[0][col].date);
        }
        return dates;
    };
    DayTableModel.prototype.sliceRange = function (range) {
        var colCnt = this.colCnt;
        var seriesSeg = this.daySeries.sliceRange(range);
        var segs = [];
        if (seriesSeg) {
            var firstIndex = seriesSeg.firstIndex, lastIndex = seriesSeg.lastIndex;
            var index = firstIndex;
            while (index <= lastIndex) {
                var row = Math.floor(index / colCnt);
                var nextIndex = Math.min((row + 1) * colCnt, lastIndex + 1);
                segs.push({
                    row: row,
                    firstCol: index % colCnt,
                    lastCol: (nextIndex - 1) % colCnt,
                    isStart: seriesSeg.isStart && index === firstIndex,
                    isEnd: seriesSeg.isEnd && (nextIndex - 1) === lastIndex,
                });
                index = nextIndex;
            }
        }
        return segs;
    };
    return DayTableModel;
}());

var Slicer = /** @class */ (function () {
    function Slicer() {
        this.sliceBusinessHours = memoize(this._sliceBusinessHours);
        this.sliceDateSelection = memoize(this._sliceDateSpan);
        this.sliceEventStore = memoize(this._sliceEventStore);
        this.sliceEventDrag = memoize(this._sliceInteraction);
        this.sliceEventResize = memoize(this._sliceInteraction);
        this.forceDayIfListItem = false; // hack
    }
    Slicer.prototype.sliceProps = function (props, dateProfile, nextDayThreshold, context) {
        var extraArgs = [];
        for (var _i = 4; _i < arguments.length; _i++) {
            extraArgs[_i - 4] = arguments[_i];
        }
        var eventUiBases = props.eventUiBases;
        var eventSegs = this.sliceEventStore.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([props.eventStore, eventUiBases, dateProfile, nextDayThreshold], extraArgs));
        return {
            dateSelectionSegs: this.sliceDateSelection.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([props.dateSelection, eventUiBases, context], extraArgs)),
            businessHourSegs: this.sliceBusinessHours.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([props.businessHours, dateProfile, nextDayThreshold, context], extraArgs)),
            fgEventSegs: eventSegs.fg,
            bgEventSegs: eventSegs.bg,
            eventDrag: this.sliceEventDrag.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([props.eventDrag, eventUiBases, dateProfile, nextDayThreshold], extraArgs)),
            eventResize: this.sliceEventResize.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([props.eventResize, eventUiBases, dateProfile, nextDayThreshold], extraArgs)),
            eventSelection: props.eventSelection,
        }; // TODO: give interactionSegs?
    };
    Slicer.prototype.sliceNowDate = function (// does not memoize
    date, context) {
        var extraArgs = [];
        for (var _i = 2; _i < arguments.length; _i++) {
            extraArgs[_i - 2] = arguments[_i];
        }
        return this._sliceDateSpan.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([{ range: { start: date, end: addMs(date, 1) }, allDay: false },
            {},
            context], extraArgs));
    };
    Slicer.prototype._sliceBusinessHours = function (businessHours, dateProfile, nextDayThreshold, context) {
        var extraArgs = [];
        for (var _i = 4; _i < arguments.length; _i++) {
            extraArgs[_i - 4] = arguments[_i];
        }
        if (!businessHours) {
            return [];
        }
        return this._sliceEventStore.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([expandRecurring(businessHours, computeActiveRange(dateProfile, Boolean(nextDayThreshold)), context),
            {},
            dateProfile,
            nextDayThreshold], extraArgs)).bg;
    };
    Slicer.prototype._sliceEventStore = function (eventStore, eventUiBases, dateProfile, nextDayThreshold) {
        var extraArgs = [];
        for (var _i = 4; _i < arguments.length; _i++) {
            extraArgs[_i - 4] = arguments[_i];
        }
        if (eventStore) {
            var rangeRes = sliceEventStore(eventStore, eventUiBases, computeActiveRange(dateProfile, Boolean(nextDayThreshold)), nextDayThreshold);
            return {
                bg: this.sliceEventRanges(rangeRes.bg, extraArgs),
                fg: this.sliceEventRanges(rangeRes.fg, extraArgs),
            };
        }
        return { bg: [], fg: [] };
    };
    Slicer.prototype._sliceInteraction = function (interaction, eventUiBases, dateProfile, nextDayThreshold) {
        var extraArgs = [];
        for (var _i = 4; _i < arguments.length; _i++) {
            extraArgs[_i - 4] = arguments[_i];
        }
        if (!interaction) {
            return null;
        }
        var rangeRes = sliceEventStore(interaction.mutatedEvents, eventUiBases, computeActiveRange(dateProfile, Boolean(nextDayThreshold)), nextDayThreshold);
        return {
            segs: this.sliceEventRanges(rangeRes.fg, extraArgs),
            affectedInstances: interaction.affectedEvents.instances,
            isEvent: interaction.isEvent,
        };
    };
    Slicer.prototype._sliceDateSpan = function (dateSpan, eventUiBases, context) {
        var extraArgs = [];
        for (var _i = 3; _i < arguments.length; _i++) {
            extraArgs[_i - 3] = arguments[_i];
        }
        if (!dateSpan) {
            return [];
        }
        var eventRange = fabricateEventRange(dateSpan, eventUiBases, context);
        var segs = this.sliceRange.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([dateSpan.range], extraArgs));
        for (var _a = 0, segs_1 = segs; _a < segs_1.length; _a++) {
            var seg = segs_1[_a];
            seg.eventRange = eventRange;
        }
        return segs;
    };
    /*
    "complete" seg means it has component and eventRange
    */
    Slicer.prototype.sliceEventRanges = function (eventRanges, extraArgs) {
        var segs = [];
        for (var _i = 0, eventRanges_1 = eventRanges; _i < eventRanges_1.length; _i++) {
            var eventRange = eventRanges_1[_i];
            segs.push.apply(segs, this.sliceEventRange(eventRange, extraArgs));
        }
        return segs;
    };
    /*
    "complete" seg means it has component and eventRange
    */
    Slicer.prototype.sliceEventRange = function (eventRange, extraArgs) {
        var dateRange = eventRange.range;
        // hack to make multi-day events that are being force-displayed as list-items to take up only one day
        if (this.forceDayIfListItem && eventRange.ui.display === 'list-item') {
            dateRange = {
                start: dateRange.start,
                end: addDays(dateRange.start, 1),
            };
        }
        var segs = this.sliceRange.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([dateRange], extraArgs));
        for (var _i = 0, segs_2 = segs; _i < segs_2.length; _i++) {
            var seg = segs_2[_i];
            seg.eventRange = eventRange;
            seg.isStart = eventRange.isStart && seg.isStart;
            seg.isEnd = eventRange.isEnd && seg.isEnd;
        }
        return segs;
    };
    return Slicer;
}());
/*
for incorporating slotMinTime/slotMaxTime if appropriate
TODO: should be part of DateProfile!
TimelineDateProfile already does this btw
*/
function computeActiveRange(dateProfile, isComponentAllDay) {
    var range = dateProfile.activeRange;
    if (isComponentAllDay) {
        return range;
    }
    return {
        start: addMs(range.start, dateProfile.slotMinTime.milliseconds),
        end: addMs(range.end, dateProfile.slotMaxTime.milliseconds - 864e5), // 864e5 = ms in a day
    };
}

// high-level segmenting-aware tester functions
// ------------------------------------------------------------------------------------------------------------------------
function isInteractionValid(interaction, dateProfile, context) {
    var instances = interaction.mutatedEvents.instances;
    for (var instanceId in instances) {
        if (!rangeContainsRange(dateProfile.validRange, instances[instanceId].range)) {
            return false;
        }
    }
    return isNewPropsValid({ eventDrag: interaction }, context); // HACK: the eventDrag props is used for ALL interactions
}
function isDateSelectionValid(dateSelection, dateProfile, context) {
    if (!rangeContainsRange(dateProfile.validRange, dateSelection.range)) {
        return false;
    }
    return isNewPropsValid({ dateSelection: dateSelection }, context);
}
function isNewPropsValid(newProps, context) {
    var calendarState = context.getCurrentData();
    var props = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ businessHours: calendarState.businessHours, dateSelection: '', eventStore: calendarState.eventStore, eventUiBases: calendarState.eventUiBases, eventSelection: '', eventDrag: null, eventResize: null }, newProps);
    return (context.pluginHooks.isPropsValid || isPropsValid)(props, context);
}
function isPropsValid(state, context, dateSpanMeta, filterConfig) {
    if (dateSpanMeta === void 0) { dateSpanMeta = {}; }
    if (state.eventDrag && !isInteractionPropsValid(state, context, dateSpanMeta, filterConfig)) {
        return false;
    }
    if (state.dateSelection && !isDateSelectionPropsValid(state, context, dateSpanMeta, filterConfig)) {
        return false;
    }
    return true;
}
// Moving Event Validation
// ------------------------------------------------------------------------------------------------------------------------
function isInteractionPropsValid(state, context, dateSpanMeta, filterConfig) {
    var currentState = context.getCurrentData();
    var interaction = state.eventDrag; // HACK: the eventDrag props is used for ALL interactions
    var subjectEventStore = interaction.mutatedEvents;
    var subjectDefs = subjectEventStore.defs;
    var subjectInstances = subjectEventStore.instances;
    var subjectConfigs = compileEventUis(subjectDefs, interaction.isEvent ?
        state.eventUiBases :
        { '': currentState.selectionConfig });
    if (filterConfig) {
        subjectConfigs = mapHash(subjectConfigs, filterConfig);
    }
    // exclude the subject events. TODO: exclude defs too?
    var otherEventStore = excludeInstances(state.eventStore, interaction.affectedEvents.instances);
    var otherDefs = otherEventStore.defs;
    var otherInstances = otherEventStore.instances;
    var otherConfigs = compileEventUis(otherDefs, state.eventUiBases);
    for (var subjectInstanceId in subjectInstances) {
        var subjectInstance = subjectInstances[subjectInstanceId];
        var subjectRange = subjectInstance.range;
        var subjectConfig = subjectConfigs[subjectInstance.defId];
        var subjectDef = subjectDefs[subjectInstance.defId];
        // constraint
        if (!allConstraintsPass(subjectConfig.constraints, subjectRange, otherEventStore, state.businessHours, context)) {
            return false;
        }
        // overlap
        var eventOverlap = context.options.eventOverlap;
        var eventOverlapFunc = typeof eventOverlap === 'function' ? eventOverlap : null;
        for (var otherInstanceId in otherInstances) {
            var otherInstance = otherInstances[otherInstanceId];
            // intersect! evaluate
            if (rangesIntersect(subjectRange, otherInstance.range)) {
                var otherOverlap = otherConfigs[otherInstance.defId].overlap;
                // consider the other event's overlap. only do this if the subject event is a "real" event
                if (otherOverlap === false && interaction.isEvent) {
                    return false;
                }
                if (subjectConfig.overlap === false) {
                    return false;
                }
                if (eventOverlapFunc && !eventOverlapFunc(new EventApi(context, otherDefs[otherInstance.defId], otherInstance), // still event
                new EventApi(context, subjectDef, subjectInstance))) {
                    return false;
                }
            }
        }
        // allow (a function)
        var calendarEventStore = currentState.eventStore; // need global-to-calendar, not local to component (splittable)state
        for (var _i = 0, _a = subjectConfig.allows; _i < _a.length; _i++) {
            var subjectAllow = _a[_i];
            var subjectDateSpan = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, dateSpanMeta), { range: subjectInstance.range, allDay: subjectDef.allDay });
            var origDef = calendarEventStore.defs[subjectDef.defId];
            var origInstance = calendarEventStore.instances[subjectInstanceId];
            var eventApi = void 0;
            if (origDef) { // was previously in the calendar
                eventApi = new EventApi(context, origDef, origInstance);
            }
            else { // was an external event
                eventApi = new EventApi(context, subjectDef); // no instance, because had no dates
            }
            if (!subjectAllow(buildDateSpanApiWithContext(subjectDateSpan, context), eventApi)) {
                return false;
            }
        }
    }
    return true;
}
// Date Selection Validation
// ------------------------------------------------------------------------------------------------------------------------
function isDateSelectionPropsValid(state, context, dateSpanMeta, filterConfig) {
    var relevantEventStore = state.eventStore;
    var relevantDefs = relevantEventStore.defs;
    var relevantInstances = relevantEventStore.instances;
    var selection = state.dateSelection;
    var selectionRange = selection.range;
    var selectionConfig = context.getCurrentData().selectionConfig;
    if (filterConfig) {
        selectionConfig = filterConfig(selectionConfig);
    }
    // constraint
    if (!allConstraintsPass(selectionConfig.constraints, selectionRange, relevantEventStore, state.businessHours, context)) {
        return false;
    }
    // overlap
    var selectOverlap = context.options.selectOverlap;
    var selectOverlapFunc = typeof selectOverlap === 'function' ? selectOverlap : null;
    for (var relevantInstanceId in relevantInstances) {
        var relevantInstance = relevantInstances[relevantInstanceId];
        // intersect! evaluate
        if (rangesIntersect(selectionRange, relevantInstance.range)) {
            if (selectionConfig.overlap === false) {
                return false;
            }
            if (selectOverlapFunc && !selectOverlapFunc(new EventApi(context, relevantDefs[relevantInstance.defId], relevantInstance), null)) {
                return false;
            }
        }
    }
    // allow (a function)
    for (var _i = 0, _a = selectionConfig.allows; _i < _a.length; _i++) {
        var selectionAllow = _a[_i];
        var fullDateSpan = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, dateSpanMeta), selection);
        if (!selectionAllow(buildDateSpanApiWithContext(fullDateSpan, context), null)) {
            return false;
        }
    }
    return true;
}
// Constraint Utils
// ------------------------------------------------------------------------------------------------------------------------
function allConstraintsPass(constraints, subjectRange, otherEventStore, businessHoursUnexpanded, context) {
    for (var _i = 0, constraints_1 = constraints; _i < constraints_1.length; _i++) {
        var constraint = constraints_1[_i];
        if (!anyRangesContainRange(constraintToRanges(constraint, subjectRange, otherEventStore, businessHoursUnexpanded, context), subjectRange)) {
            return false;
        }
    }
    return true;
}
function constraintToRanges(constraint, subjectRange, // for expanding a recurring constraint, or expanding business hours
otherEventStore, // for if constraint is an even group ID
businessHoursUnexpanded, // for if constraint is 'businessHours'
context) {
    if (constraint === 'businessHours') {
        return eventStoreToRanges(expandRecurring(businessHoursUnexpanded, subjectRange, context));
    }
    if (typeof constraint === 'string') { // an group ID
        return eventStoreToRanges(filterEventStoreDefs(otherEventStore, function (eventDef) { return eventDef.groupId === constraint; }));
    }
    if (typeof constraint === 'object' && constraint) { // non-null object
        return eventStoreToRanges(expandRecurring(constraint, subjectRange, context));
    }
    return []; // if it's false
}
// TODO: move to event-store file?
function eventStoreToRanges(eventStore) {
    var instances = eventStore.instances;
    var ranges = [];
    for (var instanceId in instances) {
        ranges.push(instances[instanceId].range);
    }
    return ranges;
}
// TODO: move to geom file?
function anyRangesContainRange(outerRanges, innerRange) {
    for (var _i = 0, outerRanges_1 = outerRanges; _i < outerRanges_1.length; _i++) {
        var outerRange = outerRanges_1[_i];
        if (rangeContainsRange(outerRange, innerRange)) {
            return true;
        }
    }
    return false;
}

var VISIBLE_HIDDEN_RE = /^(visible|hidden)$/;
var Scroller = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(Scroller, _super);
    function Scroller() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.handleEl = function (el) {
            _this.el = el;
            setRef(_this.props.elRef, el);
        };
        return _this;
    }
    Scroller.prototype.render = function () {
        var props = this.props;
        var liquid = props.liquid, liquidIsAbsolute = props.liquidIsAbsolute;
        var isAbsolute = liquid && liquidIsAbsolute;
        var className = ['fc-scroller'];
        if (liquid) {
            if (liquidIsAbsolute) {
                className.push('fc-scroller-liquid-absolute');
            }
            else {
                className.push('fc-scroller-liquid');
            }
        }
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: this.handleEl, className: className.join(' '), style: {
                overflowX: props.overflowX,
                overflowY: props.overflowY,
                left: (isAbsolute && -(props.overcomeLeft || 0)) || '',
                right: (isAbsolute && -(props.overcomeRight || 0)) || '',
                bottom: (isAbsolute && -(props.overcomeBottom || 0)) || '',
                marginLeft: (!isAbsolute && -(props.overcomeLeft || 0)) || '',
                marginRight: (!isAbsolute && -(props.overcomeRight || 0)) || '',
                marginBottom: (!isAbsolute && -(props.overcomeBottom || 0)) || '',
                maxHeight: props.maxHeight || '',
            } }, props.children));
    };
    Scroller.prototype.needsXScrolling = function () {
        if (VISIBLE_HIDDEN_RE.test(this.props.overflowX)) {
            return false;
        }
        // testing scrollWidth>clientWidth is unreliable cross-browser when pixel heights aren't integers.
        // much more reliable to see if children are taller than the scroller, even tho doesn't account for
        // inner-child margins and absolute positioning
        var el = this.el;
        var realClientWidth = this.el.getBoundingClientRect().width - this.getYScrollbarWidth();
        var children = el.children;
        for (var i = 0; i < children.length; i += 1) {
            var childEl = children[i];
            if (childEl.getBoundingClientRect().width > realClientWidth) {
                return true;
            }
        }
        return false;
    };
    Scroller.prototype.needsYScrolling = function () {
        if (VISIBLE_HIDDEN_RE.test(this.props.overflowY)) {
            return false;
        }
        // testing scrollHeight>clientHeight is unreliable cross-browser when pixel heights aren't integers.
        // much more reliable to see if children are taller than the scroller, even tho doesn't account for
        // inner-child margins and absolute positioning
        var el = this.el;
        var realClientHeight = this.el.getBoundingClientRect().height - this.getXScrollbarWidth();
        var children = el.children;
        for (var i = 0; i < children.length; i += 1) {
            var childEl = children[i];
            if (childEl.getBoundingClientRect().height > realClientHeight) {
                return true;
            }
        }
        return false;
    };
    Scroller.prototype.getXScrollbarWidth = function () {
        if (VISIBLE_HIDDEN_RE.test(this.props.overflowX)) {
            return 0;
        }
        return this.el.offsetHeight - this.el.clientHeight; // only works because we guarantee no borders. TODO: add to CSS with important?
    };
    Scroller.prototype.getYScrollbarWidth = function () {
        if (VISIBLE_HIDDEN_RE.test(this.props.overflowY)) {
            return 0;
        }
        return this.el.offsetWidth - this.el.clientWidth; // only works because we guarantee no borders. TODO: add to CSS with important?
    };
    return Scroller;
}(BaseComponent));

/*
TODO: somehow infer OtherArgs from masterCallback?
TODO: infer RefType from masterCallback if provided
*/
var RefMap = /** @class */ (function () {
    function RefMap(masterCallback) {
        var _this = this;
        this.masterCallback = masterCallback;
        this.currentMap = {};
        this.depths = {};
        this.callbackMap = {};
        this.handleValue = function (val, key) {
            var _a = _this, depths = _a.depths, currentMap = _a.currentMap;
            var removed = false;
            var added = false;
            if (val !== null) {
                // for bug... ACTUALLY: can probably do away with this now that callers don't share numeric indices anymore
                removed = (key in currentMap);
                currentMap[key] = val;
                depths[key] = (depths[key] || 0) + 1;
                added = true;
            }
            else {
                depths[key] -= 1;
                if (!depths[key]) {
                    delete currentMap[key];
                    delete _this.callbackMap[key];
                    removed = true;
                }
            }
            if (_this.masterCallback) {
                if (removed) {
                    _this.masterCallback(null, String(key));
                }
                if (added) {
                    _this.masterCallback(val, String(key));
                }
            }
        };
    }
    RefMap.prototype.createRef = function (key) {
        var _this = this;
        var refCallback = this.callbackMap[key];
        if (!refCallback) {
            refCallback = this.callbackMap[key] = function (val) {
                _this.handleValue(val, String(key));
            };
        }
        return refCallback;
    };
    // TODO: check callers that don't care about order. should use getAll instead
    // NOTE: this method has become less valuable now that we are encouraged to map order by some other index
    // TODO: provide ONE array-export function, buildArray, which fails on non-numeric indexes. caller can manipulate and "collect"
    RefMap.prototype.collect = function (startIndex, endIndex, step) {
        return collectFromHash(this.currentMap, startIndex, endIndex, step);
    };
    RefMap.prototype.getAll = function () {
        return hashValuesToArray(this.currentMap);
    };
    return RefMap;
}());

function computeShrinkWidth(chunkEls) {
    var shrinkCells = findElements(chunkEls, '.fc-scrollgrid-shrink');
    var largestWidth = 0;
    for (var _i = 0, shrinkCells_1 = shrinkCells; _i < shrinkCells_1.length; _i++) {
        var shrinkCell = shrinkCells_1[_i];
        largestWidth = Math.max(largestWidth, computeSmallestCellWidth(shrinkCell));
    }
    return Math.ceil(largestWidth); // <table> elements work best with integers. round up to ensure contents fits
}
function getSectionHasLiquidHeight(props, sectionConfig) {
    return props.liquid && sectionConfig.liquid; // does the section do liquid-height? (need to have whole scrollgrid liquid-height as well)
}
function getAllowYScrolling(props, sectionConfig) {
    return sectionConfig.maxHeight != null || // if its possible for the height to max out, we might need scrollbars
        getSectionHasLiquidHeight(props, sectionConfig); // if the section is liquid height, it might condense enough to require scrollbars
}
// TODO: ONLY use `arg`. force out internal function to use same API
function renderChunkContent(sectionConfig, chunkConfig, arg, isHeader) {
    var expandRows = arg.expandRows;
    var content = typeof chunkConfig.content === 'function' ?
        chunkConfig.content(arg) :
        (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)('table', {
            role: 'presentation',
            className: [
                chunkConfig.tableClassName,
                sectionConfig.syncRowHeights ? 'fc-scrollgrid-sync-table' : '',
            ].join(' '),
            style: {
                minWidth: arg.tableMinWidth,
                width: arg.clientWidth,
                height: expandRows ? arg.clientHeight : '', // css `height` on a <table> serves as a min-height
            },
        }, arg.tableColGroupNode, (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(isHeader ? 'thead' : 'tbody', {
            role: 'presentation',
        }, typeof chunkConfig.rowContent === 'function'
            ? chunkConfig.rowContent(arg)
            : chunkConfig.rowContent));
    return content;
}
function isColPropsEqual(cols0, cols1) {
    return isArraysEqual(cols0, cols1, isPropsEqual);
}
function renderMicroColGroup(cols, shrinkWidth) {
    var colNodes = [];
    /*
    for ColProps with spans, it would have been great to make a single <col span="">
    HOWEVER, Chrome was getting messing up distributing the width to <td>/<th> elements with colspans.
    SOLUTION: making individual <col> elements makes Chrome behave.
    */
    for (var _i = 0, cols_1 = cols; _i < cols_1.length; _i++) {
        var colProps = cols_1[_i];
        var span = colProps.span || 1;
        for (var i = 0; i < span; i += 1) {
            colNodes.push((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("col", { style: {
                    width: colProps.width === 'shrink' ? sanitizeShrinkWidth(shrinkWidth) : (colProps.width || ''),
                    minWidth: colProps.minWidth || '',
                } }));
        }
    }
    return _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['colgroup', {}], colNodes));
}
function sanitizeShrinkWidth(shrinkWidth) {
    /* why 4? if we do 0, it will kill any border, which are needed for computeSmallestCellWidth
    4 accounts for 2 2-pixel borders. TODO: better solution? */
    return shrinkWidth == null ? 4 : shrinkWidth;
}
function hasShrinkWidth(cols) {
    for (var _i = 0, cols_2 = cols; _i < cols_2.length; _i++) {
        var col = cols_2[_i];
        if (col.width === 'shrink') {
            return true;
        }
    }
    return false;
}
function getScrollGridClassNames(liquid, context) {
    var classNames = [
        'fc-scrollgrid',
        context.theme.getClass('table'),
    ];
    if (liquid) {
        classNames.push('fc-scrollgrid-liquid');
    }
    return classNames;
}
function getSectionClassNames(sectionConfig, wholeTableVGrow) {
    var classNames = [
        'fc-scrollgrid-section',
        "fc-scrollgrid-section-" + sectionConfig.type,
        sectionConfig.className, // used?
    ];
    if (wholeTableVGrow && sectionConfig.liquid && sectionConfig.maxHeight == null) {
        classNames.push('fc-scrollgrid-section-liquid');
    }
    if (sectionConfig.isSticky) {
        classNames.push('fc-scrollgrid-section-sticky');
    }
    return classNames;
}
function renderScrollShim(arg) {
    return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-scrollgrid-sticky-shim", style: {
            width: arg.clientWidth,
            minWidth: arg.tableMinWidth,
        } }));
}
function getStickyHeaderDates(options) {
    var stickyHeaderDates = options.stickyHeaderDates;
    if (stickyHeaderDates == null || stickyHeaderDates === 'auto') {
        stickyHeaderDates = options.height === 'auto' || options.viewHeight === 'auto';
    }
    return stickyHeaderDates;
}
function getStickyFooterScrollbar(options) {
    var stickyFooterScrollbar = options.stickyFooterScrollbar;
    if (stickyFooterScrollbar == null || stickyFooterScrollbar === 'auto') {
        stickyFooterScrollbar = options.height === 'auto' || options.viewHeight === 'auto';
    }
    return stickyFooterScrollbar;
}

var SimpleScrollGrid = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(SimpleScrollGrid, _super);
    function SimpleScrollGrid() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.processCols = memoize(function (a) { return a; }, isColPropsEqual); // so we get same `cols` props every time
        // yucky to memoize VNodes, but much more efficient for consumers
        _this.renderMicroColGroup = memoize(renderMicroColGroup);
        _this.scrollerRefs = new RefMap();
        _this.scrollerElRefs = new RefMap(_this._handleScrollerEl.bind(_this));
        _this.state = {
            shrinkWidth: null,
            forceYScrollbars: false,
            scrollerClientWidths: {},
            scrollerClientHeights: {},
        };
        // TODO: can do a really simple print-view. dont need to join rows
        _this.handleSizing = function () {
            _this.safeSetState((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ shrinkWidth: _this.computeShrinkWidth() }, _this.computeScrollerDims()));
        };
        return _this;
    }
    SimpleScrollGrid.prototype.render = function () {
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var sectionConfigs = props.sections || [];
        var cols = this.processCols(props.cols);
        var microColGroupNode = this.renderMicroColGroup(cols, state.shrinkWidth);
        var classNames = getScrollGridClassNames(props.liquid, context);
        if (props.collapsibleWidth) {
            classNames.push('fc-scrollgrid-collapsible');
        }
        // TODO: make DRY
        var configCnt = sectionConfigs.length;
        var configI = 0;
        var currentConfig;
        var headSectionNodes = [];
        var bodySectionNodes = [];
        var footSectionNodes = [];
        while (configI < configCnt && (currentConfig = sectionConfigs[configI]).type === 'header') {
            headSectionNodes.push(this.renderSection(currentConfig, microColGroupNode, true));
            configI += 1;
        }
        while (configI < configCnt && (currentConfig = sectionConfigs[configI]).type === 'body') {
            bodySectionNodes.push(this.renderSection(currentConfig, microColGroupNode, false));
            configI += 1;
        }
        while (configI < configCnt && (currentConfig = sectionConfigs[configI]).type === 'footer') {
            footSectionNodes.push(this.renderSection(currentConfig, microColGroupNode, true));
            configI += 1;
        }
        // firefox bug: when setting height on table and there is a thead or tfoot,
        // the necessary height:100% on the liquid-height body section forces the *whole* table to be taller. (bug #5524)
        // use getCanVGrowWithinCell as a way to detect table-stupid firefox.
        // if so, use a simpler dom structure, jam everything into a lone tbody.
        var isBuggy = !getCanVGrowWithinCell();
        var roleAttrs = { role: 'rowgroup' };
        return (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)('table', {
            role: 'grid',
            className: classNames.join(' '),
            style: { height: props.height },
        }, Boolean(!isBuggy && headSectionNodes.length) && _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['thead', roleAttrs], headSectionNodes)), Boolean(!isBuggy && bodySectionNodes.length) && _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['tbody', roleAttrs], bodySectionNodes)), Boolean(!isBuggy && footSectionNodes.length) && _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['tfoot', roleAttrs], footSectionNodes)), isBuggy && _vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['tbody', roleAttrs], headSectionNodes), bodySectionNodes), footSectionNodes)));
    };
    SimpleScrollGrid.prototype.renderSection = function (sectionConfig, microColGroupNode, isHeader) {
        if ('outerContent' in sectionConfig) {
            return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(_vdom_js__WEBPACK_IMPORTED_MODULE_1__.Fragment, { key: sectionConfig.key }, sectionConfig.outerContent));
        }
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { key: sectionConfig.key, role: "presentation", className: getSectionClassNames(sectionConfig, this.props.liquid).join(' ') }, this.renderChunkTd(sectionConfig, microColGroupNode, sectionConfig.chunk, isHeader)));
    };
    SimpleScrollGrid.prototype.renderChunkTd = function (sectionConfig, microColGroupNode, chunkConfig, isHeader) {
        if ('outerContent' in chunkConfig) {
            return chunkConfig.outerContent;
        }
        var props = this.props;
        var _a = this.state, forceYScrollbars = _a.forceYScrollbars, scrollerClientWidths = _a.scrollerClientWidths, scrollerClientHeights = _a.scrollerClientHeights;
        var needsYScrolling = getAllowYScrolling(props, sectionConfig); // TODO: do lazily. do in section config?
        var isLiquid = getSectionHasLiquidHeight(props, sectionConfig);
        // for `!props.liquid` - is WHOLE scrollgrid natural height?
        // TODO: do same thing in advanced scrollgrid? prolly not b/c always has horizontal scrollbars
        var overflowY = !props.liquid ? 'visible' :
            forceYScrollbars ? 'scroll' :
                !needsYScrolling ? 'hidden' :
                    'auto';
        var sectionKey = sectionConfig.key;
        var content = renderChunkContent(sectionConfig, chunkConfig, {
            tableColGroupNode: microColGroupNode,
            tableMinWidth: '',
            clientWidth: (!props.collapsibleWidth && scrollerClientWidths[sectionKey] !== undefined) ? scrollerClientWidths[sectionKey] : null,
            clientHeight: scrollerClientHeights[sectionKey] !== undefined ? scrollerClientHeights[sectionKey] : null,
            expandRows: sectionConfig.expandRows,
            syncRowHeights: false,
            rowSyncHeights: [],
            reportRowHeightChange: function () { },
        }, isHeader);
        return (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(isHeader ? 'th' : 'td', {
            ref: chunkConfig.elRef,
            role: 'presentation',
        }, (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-scroller-harness" + (isLiquid ? ' fc-scroller-harness-liquid' : '') },
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(Scroller, { ref: this.scrollerRefs.createRef(sectionKey), elRef: this.scrollerElRefs.createRef(sectionKey), overflowY: overflowY, overflowX: !props.liquid ? 'visible' : 'hidden' /* natural height? */, maxHeight: sectionConfig.maxHeight, liquid: isLiquid, liquidIsAbsolute // because its within a harness
                : true }, content)));
    };
    SimpleScrollGrid.prototype._handleScrollerEl = function (scrollerEl, key) {
        var section = getSectionByKey(this.props.sections, key);
        if (section) {
            setRef(section.chunk.scrollerElRef, scrollerEl);
        }
    };
    SimpleScrollGrid.prototype.componentDidMount = function () {
        this.handleSizing();
        this.context.addResizeHandler(this.handleSizing);
    };
    SimpleScrollGrid.prototype.componentDidUpdate = function () {
        // TODO: need better solution when state contains non-sizing things
        this.handleSizing();
    };
    SimpleScrollGrid.prototype.componentWillUnmount = function () {
        this.context.removeResizeHandler(this.handleSizing);
    };
    SimpleScrollGrid.prototype.computeShrinkWidth = function () {
        return hasShrinkWidth(this.props.cols)
            ? computeShrinkWidth(this.scrollerElRefs.getAll())
            : 0;
    };
    SimpleScrollGrid.prototype.computeScrollerDims = function () {
        var scrollbarWidth = getScrollbarWidths();
        var _a = this, scrollerRefs = _a.scrollerRefs, scrollerElRefs = _a.scrollerElRefs;
        var forceYScrollbars = false;
        var scrollerClientWidths = {};
        var scrollerClientHeights = {};
        for (var sectionKey in scrollerRefs.currentMap) {
            var scroller = scrollerRefs.currentMap[sectionKey];
            if (scroller && scroller.needsYScrolling()) {
                forceYScrollbars = true;
                break;
            }
        }
        for (var _i = 0, _b = this.props.sections; _i < _b.length; _i++) {
            var section = _b[_i];
            var sectionKey = section.key;
            var scrollerEl = scrollerElRefs.currentMap[sectionKey];
            if (scrollerEl) {
                var harnessEl = scrollerEl.parentNode; // TODO: weird way to get this. need harness b/c doesn't include table borders
                scrollerClientWidths[sectionKey] = Math.floor(harnessEl.getBoundingClientRect().width - (forceYScrollbars
                    ? scrollbarWidth.y // use global because scroller might not have scrollbars yet but will need them in future
                    : 0));
                scrollerClientHeights[sectionKey] = Math.floor(harnessEl.getBoundingClientRect().height);
            }
        }
        return { forceYScrollbars: forceYScrollbars, scrollerClientWidths: scrollerClientWidths, scrollerClientHeights: scrollerClientHeights };
    };
    return SimpleScrollGrid;
}(BaseComponent));
SimpleScrollGrid.addStateEquality({
    scrollerClientWidths: isPropsEqual,
    scrollerClientHeights: isPropsEqual,
});
function getSectionByKey(sections, key) {
    for (var _i = 0, sections_1 = sections; _i < sections_1.length; _i++) {
        var section = sections_1[_i];
        if (section.key === key) {
            return section;
        }
    }
    return null;
}

var EventRoot = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(EventRoot, _super);
    function EventRoot() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.elRef = (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        return _this;
    }
    EventRoot.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var options = context.options;
        var seg = props.seg;
        var eventRange = seg.eventRange;
        var ui = eventRange.ui;
        var hookProps = {
            event: new EventApi(context, eventRange.def, eventRange.instance),
            view: context.viewApi,
            timeText: props.timeText,
            textColor: ui.textColor,
            backgroundColor: ui.backgroundColor,
            borderColor: ui.borderColor,
            isDraggable: !props.disableDragging && computeSegDraggable(seg, context),
            isStartResizable: !props.disableResizing && computeSegStartResizable(seg, context),
            isEndResizable: !props.disableResizing && computeSegEndResizable(seg),
            isMirror: Boolean(props.isDragging || props.isResizing || props.isDateSelecting),
            isStart: Boolean(seg.isStart),
            isEnd: Boolean(seg.isEnd),
            isPast: Boolean(props.isPast),
            isFuture: Boolean(props.isFuture),
            isToday: Boolean(props.isToday),
            isSelected: Boolean(props.isSelected),
            isDragging: Boolean(props.isDragging),
            isResizing: Boolean(props.isResizing),
        };
        var standardClassNames = getEventClassNames(hookProps).concat(ui.classNames);
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(RenderHook, { hookProps: hookProps, classNames: options.eventClassNames, content: options.eventContent, defaultContent: props.defaultContent, didMount: options.eventDidMount, willUnmount: options.eventWillUnmount, elRef: this.elRef }, function (rootElRef, customClassNames, innerElRef, innerContent) { return props.children(rootElRef, standardClassNames.concat(customClassNames), innerElRef, innerContent, hookProps); }));
    };
    EventRoot.prototype.componentDidMount = function () {
        setElSeg(this.elRef.current, this.props.seg);
    };
    /*
    need to re-assign seg to the element if seg changes, even if the element is the same
    */
    EventRoot.prototype.componentDidUpdate = function (prevProps) {
        var seg = this.props.seg;
        if (seg !== prevProps.seg) {
            setElSeg(this.elRef.current, seg);
        }
    };
    return EventRoot;
}(BaseComponent));

// should not be a purecomponent
var StandardEvent = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(StandardEvent, _super);
    function StandardEvent() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    StandardEvent.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var seg = props.seg;
        var timeFormat = context.options.eventTimeFormat || props.defaultTimeFormat;
        var timeText = buildSegTimeText(seg, timeFormat, context, props.defaultDisplayEventTime, props.defaultDisplayEventEnd);
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(EventRoot, { seg: seg, timeText: timeText, disableDragging: props.disableDragging, disableResizing: props.disableResizing, defaultContent: props.defaultContent || renderInnerContent$1, isDragging: props.isDragging, isResizing: props.isResizing, isDateSelecting: props.isDateSelecting, isSelected: props.isSelected, isPast: props.isPast, isFuture: props.isFuture, isToday: props.isToday }, function (rootElRef, classNames, innerElRef, innerContent, hookProps) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("a", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ className: props.extraClassNames.concat(classNames).join(' '), style: {
                borderColor: hookProps.borderColor,
                backgroundColor: hookProps.backgroundColor,
            }, ref: rootElRef }, getSegAnchorAttrs(seg, context)),
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-event-main", ref: innerElRef, style: { color: hookProps.textColor } }, innerContent),
            hookProps.isStartResizable &&
                (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-event-resizer fc-event-resizer-start" }),
            hookProps.isEndResizable &&
                (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-event-resizer fc-event-resizer-end" }))); }));
    };
    return StandardEvent;
}(BaseComponent));
function renderInnerContent$1(innerProps) {
    return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-event-main-frame" },
        innerProps.timeText && ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-event-time" }, innerProps.timeText)),
        (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-event-title-container" },
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-event-title fc-sticky" }, innerProps.event.title || (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(_vdom_js__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, "\u00A0")))));
}

var NowIndicatorRoot = function (props) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ViewContextType.Consumer, null, function (context) {
    var options = context.options;
    var hookProps = {
        isAxis: props.isAxis,
        date: context.dateEnv.toDate(props.date),
        view: context.viewApi,
    };
    return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(RenderHook, { hookProps: hookProps, classNames: options.nowIndicatorClassNames, content: options.nowIndicatorContent, didMount: options.nowIndicatorDidMount, willUnmount: options.nowIndicatorWillUnmount }, props.children));
})); };

var DAY_NUM_FORMAT = createFormatter({ day: 'numeric' });
var DayCellContent = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(DayCellContent, _super);
    function DayCellContent() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    DayCellContent.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var options = context.options;
        var hookProps = refineDayCellHookProps({
            date: props.date,
            dateProfile: props.dateProfile,
            todayRange: props.todayRange,
            showDayNumber: props.showDayNumber,
            extraProps: props.extraHookProps,
            viewApi: context.viewApi,
            dateEnv: context.dateEnv,
        });
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ContentHook, { hookProps: hookProps, content: options.dayCellContent, defaultContent: props.defaultContent }, props.children));
    };
    return DayCellContent;
}(BaseComponent));
function refineDayCellHookProps(raw) {
    var date = raw.date, dateEnv = raw.dateEnv;
    var dayMeta = getDateMeta(date, raw.todayRange, null, raw.dateProfile);
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ date: dateEnv.toDate(date), view: raw.viewApi }, dayMeta), { dayNumberText: raw.showDayNumber ? dateEnv.format(date, DAY_NUM_FORMAT) : '' }), raw.extraProps);
}

var DayCellRoot = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(DayCellRoot, _super);
    function DayCellRoot() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.refineHookProps = memoizeObjArg(refineDayCellHookProps);
        _this.normalizeClassNames = buildClassNameNormalizer();
        return _this;
    }
    DayCellRoot.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var options = context.options;
        var hookProps = this.refineHookProps({
            date: props.date,
            dateProfile: props.dateProfile,
            todayRange: props.todayRange,
            showDayNumber: props.showDayNumber,
            extraProps: props.extraHookProps,
            viewApi: context.viewApi,
            dateEnv: context.dateEnv,
        });
        var classNames = getDayClassNames(hookProps, context.theme).concat(hookProps.isDisabled
            ? [] // don't use custom classNames if disabled
            : this.normalizeClassNames(options.dayCellClassNames, hookProps));
        var dataAttrs = hookProps.isDisabled ? {} : {
            'data-date': formatDayString(props.date),
        };
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(MountHook, { hookProps: hookProps, didMount: options.dayCellDidMount, willUnmount: options.dayCellWillUnmount, elRef: props.elRef }, function (rootElRef) { return props.children(rootElRef, classNames, dataAttrs, hookProps.isDisabled); }));
    };
    return DayCellRoot;
}(BaseComponent));

function renderFill(fillType) {
    return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-" + fillType }));
}
var BgEvent = function (props) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(EventRoot, { defaultContent: renderInnerContent, seg: props.seg /* uselesss i think */, timeText: "", disableDragging: true, disableResizing: true, isDragging: false, isResizing: false, isDateSelecting: false, isSelected: false, isPast: props.isPast, isFuture: props.isFuture, isToday: props.isToday }, function (rootElRef, classNames, innerElRef, innerContent, hookProps) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: rootElRef, className: ['fc-bg-event'].concat(classNames).join(' '), style: {
        backgroundColor: hookProps.backgroundColor,
    } }, innerContent)); })); };
function renderInnerContent(props) {
    var title = props.event.title;
    return title && ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-event-title" }, props.event.title));
}

var WeekNumberRoot = function (props) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ViewContextType.Consumer, null, function (context) {
    var dateEnv = context.dateEnv, options = context.options;
    var date = props.date;
    var format = options.weekNumberFormat || props.defaultFormat;
    var num = dateEnv.computeWeekNumber(date); // TODO: somehow use for formatting as well?
    var text = dateEnv.format(date, format);
    var hookProps = { num: num, text: text, date: date };
    return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(RenderHook, { hookProps: hookProps, classNames: options.weekNumberClassNames, content: options.weekNumberContent, defaultContent: renderInner, didMount: options.weekNumberDidMount, willUnmount: options.weekNumberWillUnmount }, props.children));
})); };
function renderInner(innerProps) {
    return innerProps.text;
}

var PADDING_FROM_VIEWPORT = 10;
var Popover = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(Popover, _super);
    function Popover() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.state = {
            titleId: getUniqueDomId(),
        };
        _this.handleRootEl = function (el) {
            _this.rootEl = el;
            if (_this.props.elRef) {
                setRef(_this.props.elRef, el);
            }
        };
        // Triggered when the user clicks *anywhere* in the document, for the autoHide feature
        _this.handleDocumentMouseDown = function (ev) {
            // only hide the popover if the click happened outside the popover
            var target = getEventTargetViaRoot(ev);
            if (!_this.rootEl.contains(target)) {
                _this.handleCloseClick();
            }
        };
        _this.handleDocumentKeyDown = function (ev) {
            if (ev.key === 'Escape') {
                _this.handleCloseClick();
            }
        };
        _this.handleCloseClick = function () {
            var onClose = _this.props.onClose;
            if (onClose) {
                onClose();
            }
        };
        return _this;
    }
    Popover.prototype.render = function () {
        var _a = this.context, theme = _a.theme, options = _a.options;
        var _b = this, props = _b.props, state = _b.state;
        var classNames = [
            'fc-popover',
            theme.getClass('popover'),
        ].concat(props.extraClassNames || []);
        return (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createPortal)((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ id: props.id, className: classNames.join(' '), "aria-labelledby": state.titleId }, props.extraAttrs, { ref: this.handleRootEl }),
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: 'fc-popover-header ' + theme.getClass('popoverHeader') },
                (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: "fc-popover-title", id: state.titleId }, props.title),
                (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: 'fc-popover-close ' + theme.getIconClass('close'), title: options.closeHint, onClick: this.handleCloseClick })),
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: 'fc-popover-body ' + theme.getClass('popoverContent') }, props.children)), props.parentEl);
    };
    Popover.prototype.componentDidMount = function () {
        document.addEventListener('mousedown', this.handleDocumentMouseDown);
        document.addEventListener('keydown', this.handleDocumentKeyDown);
        this.updateSize();
    };
    Popover.prototype.componentWillUnmount = function () {
        document.removeEventListener('mousedown', this.handleDocumentMouseDown);
        document.removeEventListener('keydown', this.handleDocumentKeyDown);
    };
    Popover.prototype.updateSize = function () {
        var isRtl = this.context.isRtl;
        var _a = this.props, alignmentEl = _a.alignmentEl, alignGridTop = _a.alignGridTop;
        var rootEl = this.rootEl;
        var alignmentRect = computeClippedClientRect(alignmentEl);
        if (alignmentRect) {
            var popoverDims = rootEl.getBoundingClientRect();
            // position relative to viewport
            var popoverTop = alignGridTop
                ? elementClosest(alignmentEl, '.fc-scrollgrid').getBoundingClientRect().top
                : alignmentRect.top;
            var popoverLeft = isRtl ? alignmentRect.right - popoverDims.width : alignmentRect.left;
            // constrain
            popoverTop = Math.max(popoverTop, PADDING_FROM_VIEWPORT);
            popoverLeft = Math.min(popoverLeft, document.documentElement.clientWidth - PADDING_FROM_VIEWPORT - popoverDims.width);
            popoverLeft = Math.max(popoverLeft, PADDING_FROM_VIEWPORT);
            var origin_1 = rootEl.offsetParent.getBoundingClientRect();
            applyStyle(rootEl, {
                top: popoverTop - origin_1.top,
                left: popoverLeft - origin_1.left,
            });
        }
    };
    return Popover;
}(BaseComponent));

var MorePopover = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(MorePopover, _super);
    function MorePopover() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.handleRootEl = function (rootEl) {
            _this.rootEl = rootEl;
            if (rootEl) {
                _this.context.registerInteractiveComponent(_this, {
                    el: rootEl,
                    useEventCenter: false,
                });
            }
            else {
                _this.context.unregisterInteractiveComponent(_this);
            }
        };
        return _this;
    }
    MorePopover.prototype.render = function () {
        var _a = this.context, options = _a.options, dateEnv = _a.dateEnv;
        var props = this.props;
        var startDate = props.startDate, todayRange = props.todayRange, dateProfile = props.dateProfile;
        var title = dateEnv.format(startDate, options.dayPopoverFormat);
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(DayCellRoot, { date: startDate, dateProfile: dateProfile, todayRange: todayRange, elRef: this.handleRootEl }, function (rootElRef, dayClassNames, dataAttrs) { return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(Popover, { elRef: rootElRef, id: props.id, title: title, extraClassNames: ['fc-more-popover'].concat(dayClassNames), extraAttrs: dataAttrs /* TODO: make these time-based when not whole-day? */, parentEl: props.parentEl, alignmentEl: props.alignmentEl, alignGridTop: props.alignGridTop, onClose: props.onClose },
            (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(DayCellContent, { date: startDate, dateProfile: dateProfile, todayRange: todayRange }, function (innerElRef, innerContent) { return (innerContent &&
                (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-more-popover-misc", ref: innerElRef }, innerContent)); }),
            props.children)); }));
    };
    MorePopover.prototype.queryHit = function (positionLeft, positionTop, elWidth, elHeight) {
        var _a = this, rootEl = _a.rootEl, props = _a.props;
        if (positionLeft >= 0 && positionLeft < elWidth &&
            positionTop >= 0 && positionTop < elHeight) {
            return {
                dateProfile: props.dateProfile,
                dateSpan: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ allDay: true, range: {
                        start: props.startDate,
                        end: props.endDate,
                    } }, props.extraDateSpan),
                dayEl: rootEl,
                rect: {
                    left: 0,
                    top: 0,
                    right: elWidth,
                    bottom: elHeight,
                },
                layer: 1, // important when comparing with hits from other components
            };
        }
        return null;
    };
    return MorePopover;
}(DateComponent));

var MoreLinkRoot = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(MoreLinkRoot, _super);
    function MoreLinkRoot() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.linkElRef = (0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.state = {
            isPopoverOpen: false,
            popoverId: getUniqueDomId(),
        };
        _this.handleClick = function (ev) {
            var _a = _this, props = _a.props, context = _a.context;
            var moreLinkClick = context.options.moreLinkClick;
            var date = computeRange(props).start;
            function buildPublicSeg(seg) {
                var _a = seg.eventRange, def = _a.def, instance = _a.instance, range = _a.range;
                return {
                    event: new EventApi(context, def, instance),
                    start: context.dateEnv.toDate(range.start),
                    end: context.dateEnv.toDate(range.end),
                    isStart: seg.isStart,
                    isEnd: seg.isEnd,
                };
            }
            if (typeof moreLinkClick === 'function') {
                moreLinkClick = moreLinkClick({
                    date: date,
                    allDay: Boolean(props.allDayDate),
                    allSegs: props.allSegs.map(buildPublicSeg),
                    hiddenSegs: props.hiddenSegs.map(buildPublicSeg),
                    jsEvent: ev,
                    view: context.viewApi,
                });
            }
            if (!moreLinkClick || moreLinkClick === 'popover') {
                _this.setState({ isPopoverOpen: true });
            }
            else if (typeof moreLinkClick === 'string') { // a view name
                context.calendarApi.zoomTo(date, moreLinkClick);
            }
        };
        _this.handlePopoverClose = function () {
            _this.setState({ isPopoverOpen: false });
        };
        return _this;
    }
    MoreLinkRoot.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, state = _a.state;
        return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(ViewContextType.Consumer, null, function (context) {
            var viewApi = context.viewApi, options = context.options, calendarApi = context.calendarApi;
            var moreLinkText = options.moreLinkText;
            var moreCnt = props.moreCnt;
            var range = computeRange(props);
            var text = typeof moreLinkText === 'function' // TODO: eventually use formatWithOrdinals
                ? moreLinkText.call(calendarApi, moreCnt)
                : "+" + moreCnt + " " + moreLinkText;
            var title = formatWithOrdinals(options.moreLinkHint, [moreCnt], text);
            var hookProps = {
                num: moreCnt,
                shortText: "+" + moreCnt,
                text: text,
                view: viewApi,
            };
            return ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(_vdom_js__WEBPACK_IMPORTED_MODULE_1__.Fragment, null,
                Boolean(props.moreCnt) && ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(RenderHook, { elRef: _this.linkElRef, hookProps: hookProps, classNames: options.moreLinkClassNames, content: options.moreLinkContent, defaultContent: props.defaultContent || renderMoreLinkInner, didMount: options.moreLinkDidMount, willUnmount: options.moreLinkWillUnmount }, function (rootElRef, customClassNames, innerElRef, innerContent) { return props.children(rootElRef, ['fc-more-link'].concat(customClassNames), innerElRef, innerContent, _this.handleClick, title, state.isPopoverOpen, state.isPopoverOpen ? state.popoverId : ''); })),
                state.isPopoverOpen && ((0,_vdom_js__WEBPACK_IMPORTED_MODULE_1__.createElement)(MorePopover, { id: state.popoverId, startDate: range.start, endDate: range.end, dateProfile: props.dateProfile, todayRange: props.todayRange, extraDateSpan: props.extraDateSpan, parentEl: _this.parentEl, alignmentEl: props.alignmentElRef.current, alignGridTop: props.alignGridTop, onClose: _this.handlePopoverClose }, props.popoverContent()))));
        }));
    };
    MoreLinkRoot.prototype.componentDidMount = function () {
        this.updateParentEl();
    };
    MoreLinkRoot.prototype.componentDidUpdate = function () {
        this.updateParentEl();
    };
    MoreLinkRoot.prototype.updateParentEl = function () {
        if (this.linkElRef.current) {
            this.parentEl = elementClosest(this.linkElRef.current, '.fc-view-harness');
        }
    };
    return MoreLinkRoot;
}(BaseComponent));
function renderMoreLinkInner(props) {
    return props.text;
}
function computeRange(props) {
    if (props.allDayDate) {
        return {
            start: props.allDayDate,
            end: addDays(props.allDayDate, 1),
        };
    }
    var hiddenSegs = props.hiddenSegs;
    return {
        start: computeEarliestSegStart(hiddenSegs),
        end: computeLatestSegEnd(hiddenSegs),
    };
}
function computeEarliestSegStart(segs) {
    return segs.reduce(pickEarliestStart).eventRange.range.start;
}
function pickEarliestStart(seg0, seg1) {
    return seg0.eventRange.range.start < seg1.eventRange.range.start ? seg0 : seg1;
}
function computeLatestSegEnd(segs) {
    return segs.reduce(pickLatestEnd).eventRange.range.end;
}
function pickLatestEnd(seg0, seg1) {
    return seg0.eventRange.range.end > seg1.eventRange.range.end ? seg0 : seg1;
}

// exports
// --------------------------------------------------------------------------------------------------
var version = '5.11.3'; // important to type it, so .d.ts has generic string


//# sourceMappingURL=main.js.map


/***/ }),

/***/ "./node_modules/@fullcalendar/common/vdom.js":
/*!***************************************************!*\
  !*** ./node_modules/@fullcalendar/common/vdom.js ***!
  \***************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Component": function() { return /* binding */ Component; },
/* harmony export */   "Fragment": function() { return /* binding */ Fragment; },
/* harmony export */   "createContext": function() { return /* binding */ createContext; },
/* harmony export */   "createElement": function() { return /* binding */ createElement; },
/* harmony export */   "createPortal": function() { return /* binding */ createPortal; },
/* harmony export */   "createRef": function() { return /* binding */ createRef; },
/* harmony export */   "flushSync": function() { return /* binding */ flushSync; },
/* harmony export */   "render": function() { return /* binding */ render; },
/* harmony export */   "unmountComponentAtNode": function() { return /* binding */ unmountComponentAtNode; }
/* harmony export */ });
/// <reference types="@fullcalendar/core-preact" />
if (typeof FullCalendarVDom === 'undefined') {
    throw new Error('Please import the top-level fullcalendar lib before attempting to import a plugin.');
}
var Component = FullCalendarVDom.Component;
var createElement = FullCalendarVDom.createElement;
var render = FullCalendarVDom.render;
var createRef = FullCalendarVDom.createRef;
var Fragment = FullCalendarVDom.Fragment;
var createContext = FullCalendarVDom.createContext;
var createPortal = FullCalendarVDom.createPortal;
var flushSync = FullCalendarVDom.flushSync;
var unmountComponentAtNode = FullCalendarVDom.unmountComponentAtNode;
/* eslint-enable */




/***/ }),

/***/ "./node_modules/@fullcalendar/premium-common/main.js":
/*!***********************************************************!*\
  !*** ./node_modules/@fullcalendar/premium-common/main.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @fullcalendar/common */ "./node_modules/@fullcalendar/common/main.js");
/*!
FullCalendar Scheduler v5.11.3
Docs & License: https://fullcalendar.io/scheduler
(c) 2022 Adam Shaw
*/


var RELEASE_DATE = '2022-08-23'; // for Scheduler
var UPGRADE_WINDOW = 365 + 7; // days. 1 week leeway, for tz shift reasons too
var INVALID_LICENSE_URL = 'http://fullcalendar.io/docs/schedulerLicenseKey#invalid';
var OUTDATED_LICENSE_URL = 'http://fullcalendar.io/docs/schedulerLicenseKey#outdated';
var PRESET_LICENSE_KEYS = [
    'GPL-My-Project-Is-Open-Source',
    'CC-Attribution-NonCommercial-NoDerivatives',
];
var CSS = {
    position: 'absolute',
    zIndex: 99999,
    bottom: '1px',
    left: '1px',
    background: '#eee',
    borderColor: '#ddd',
    borderStyle: 'solid',
    borderWidth: '1px 1px 0 0',
    padding: '2px 4px',
    fontSize: '12px',
    borderTopRightRadius: '3px',
};
function buildLicenseWarning(context) {
    var key = context.options.schedulerLicenseKey;
    var currentUrl = typeof window !== 'undefined' ? window.location.href : '';
    if (!isImmuneUrl(currentUrl)) {
        var status_1 = processLicenseKey(key);
        if (status_1 !== 'valid') {
            return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", { className: "fc-license-message", style: CSS }, (status_1 === 'outdated') ? ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Fragment, null,
                'Your license key is too old to work with this version. ',
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", { href: OUTDATED_LICENSE_URL }, "More Info"))) : ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Fragment, null,
                'Your license key is invalid. ',
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", { href: INVALID_LICENSE_URL }, "More Info")))));
        }
    }
    return null;
}
/*
This decryption is not meant to be bulletproof. Just a way to remind about an upgrade.
*/
function processLicenseKey(key) {
    if (PRESET_LICENSE_KEYS.indexOf(key) !== -1) {
        return 'valid';
    }
    var parts = (key || '').match(/^(\d+)-fcs-(\d+)$/);
    if (parts && (parts[1].length === 10)) {
        var purchaseDate = new Date(parseInt(parts[2], 10) * 1000);
        var releaseDate = new Date(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.config.mockSchedulerReleaseDate || RELEASE_DATE);
        if ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.isValidDate)(releaseDate)) { // token won't be replaced in dev mode
            var minPurchaseDate = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.addDays)(releaseDate, -UPGRADE_WINDOW);
            if (minPurchaseDate < purchaseDate) {
                return 'valid';
            }
            return 'outdated';
        }
    }
    return 'invalid';
}
function isImmuneUrl(url) {
    return /\w+:\/\/fullcalendar\.io\/|\/examples\/[\w-]+\.html$/.test(url);
}

var OPTION_REFINERS = {
    schedulerLicenseKey: String,
};

var main = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createPlugin)({
    optionRefiners: OPTION_REFINERS,
    viewContainerAppends: [buildLicenseWarning],
});

/* harmony default export */ __webpack_exports__["default"] = (main);
//# sourceMappingURL=main.js.map


/***/ }),

/***/ "./node_modules/@fullcalendar/resource-common/main.js":
/*!************************************************************!*\
  !*** ./node_modules/@fullcalendar/resource-common/main.js ***!
  \************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AbstractResourceDayTableModel": function() { return /* binding */ AbstractResourceDayTableModel; },
/* harmony export */   "DEFAULT_RESOURCE_ORDER": function() { return /* binding */ DEFAULT_RESOURCE_ORDER; },
/* harmony export */   "DayResourceTableModel": function() { return /* binding */ DayResourceTableModel; },
/* harmony export */   "ResourceApi": function() { return /* binding */ ResourceApi; },
/* harmony export */   "ResourceDayHeader": function() { return /* binding */ ResourceDayHeader; },
/* harmony export */   "ResourceDayTableModel": function() { return /* binding */ ResourceDayTableModel; },
/* harmony export */   "ResourceLabelRoot": function() { return /* binding */ ResourceLabelRoot; },
/* harmony export */   "ResourceSplitter": function() { return /* binding */ ResourceSplitter; },
/* harmony export */   "VResourceJoiner": function() { return /* binding */ VResourceJoiner; },
/* harmony export */   "VResourceSplitter": function() { return /* binding */ VResourceSplitter; },
/* harmony export */   "buildResourceFields": function() { return /* binding */ buildResourceFields; },
/* harmony export */   "buildRowNodes": function() { return /* binding */ buildRowNodes; },
/* harmony export */   "flattenResources": function() { return /* binding */ flattenResources; },
/* harmony export */   "getPublicId": function() { return /* binding */ getPublicId; },
/* harmony export */   "isGroupsEqual": function() { return /* binding */ isGroupsEqual; }
/* harmony export */ });
/* harmony import */ var _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @fullcalendar/common */ "./node_modules/@fullcalendar/common/main.js");
/* harmony import */ var _fullcalendar_premium_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @fullcalendar/premium-common */ "./node_modules/@fullcalendar/premium-common/main.js");
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/*!
FullCalendar Scheduler v5.11.3
Docs & License: https://fullcalendar.io/scheduler
(c) 2022 Adam Shaw
*/




function massageEventDragMutation(eventMutation, hit0, hit1) {
    var resource0 = hit0.dateSpan.resourceId;
    var resource1 = hit1.dateSpan.resourceId;
    if (resource0 && resource1 &&
        resource0 !== resource1) {
        eventMutation.resourceMutation = {
            matchResourceId: resource0,
            setResourceId: resource1,
        };
    }
}
/*
TODO: all this would be much easier if we were using a hash!
*/
function applyEventDefMutation(eventDef, mutation, context) {
    var resourceMutation = mutation.resourceMutation;
    if (resourceMutation && computeResourceEditable(eventDef, context)) {
        var index = eventDef.resourceIds.indexOf(resourceMutation.matchResourceId);
        if (index !== -1) {
            var resourceIds = eventDef.resourceIds.slice(); // copy
            resourceIds.splice(index, 1); // remove
            if (resourceIds.indexOf(resourceMutation.setResourceId) === -1) { // not already in there
                resourceIds.push(resourceMutation.setResourceId); // add
            }
            eventDef.resourceIds = resourceIds;
        }
    }
}
/*
HACK
TODO: use EventUi system instead of this
*/
function computeResourceEditable(eventDef, context) {
    var resourceEditable = eventDef.resourceEditable;
    if (resourceEditable == null) {
        var source = eventDef.sourceId && context.getCurrentData().eventSources[eventDef.sourceId];
        if (source) {
            resourceEditable = source.extendedProps.resourceEditable; // used the Source::extendedProps hack
        }
        if (resourceEditable == null) {
            resourceEditable = context.options.eventResourceEditable;
            if (resourceEditable == null) {
                resourceEditable = context.options.editable; // TODO: use defaults system instead
            }
        }
    }
    return resourceEditable;
}
function transformEventDrop(mutation, context) {
    var resourceMutation = mutation.resourceMutation;
    if (resourceMutation) {
        var calendarApi = context.calendarApi;
        return {
            oldResource: calendarApi.getResourceById(resourceMutation.matchResourceId),
            newResource: calendarApi.getResourceById(resourceMutation.setResourceId),
        };
    }
    return {
        oldResource: null,
        newResource: null,
    };
}

var ResourceDataAdder = /** @class */ (function () {
    function ResourceDataAdder() {
        this.filterResources = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(filterResources);
    }
    ResourceDataAdder.prototype.transform = function (viewProps, calendarProps) {
        if (calendarProps.viewSpec.optionDefaults.needsResourceData) {
            return {
                resourceStore: this.filterResources(calendarProps.resourceStore, calendarProps.options.filterResourcesWithEvents, calendarProps.eventStore, calendarProps.dateProfile.activeRange),
                resourceEntityExpansions: calendarProps.resourceEntityExpansions,
            };
        }
        return null;
    };
    return ResourceDataAdder;
}());
function filterResources(resourceStore, doFilterResourcesWithEvents, eventStore, activeRange) {
    if (doFilterResourcesWithEvents) {
        var instancesInRange = filterEventInstancesInRange(eventStore.instances, activeRange);
        var hasEvents_1 = computeHasEvents(instancesInRange, eventStore.defs);
        (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(hasEvents_1, computeAncestorHasEvents(hasEvents_1, resourceStore));
        return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.filterHash)(resourceStore, function (resource, resourceId) { return hasEvents_1[resourceId]; });
    }
    return resourceStore;
}
function filterEventInstancesInRange(eventInstances, activeRange) {
    return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.filterHash)(eventInstances, function (eventInstance) { return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.rangesIntersect)(eventInstance.range, activeRange); });
}
function computeHasEvents(eventInstances, eventDefs) {
    var hasEvents = {};
    for (var instanceId in eventInstances) {
        var instance = eventInstances[instanceId];
        for (var _i = 0, _a = eventDefs[instance.defId].resourceIds; _i < _a.length; _i++) {
            var resourceId = _a[_i];
            hasEvents[resourceId] = true;
        }
    }
    return hasEvents;
}
/*
mark resources as having events if any of their ancestors have them
NOTE: resourceStore might not have all the resources that hasEvents{} has keyed
*/
function computeAncestorHasEvents(hasEvents, resourceStore) {
    var res = {};
    for (var resourceId in hasEvents) {
        var resource = void 0;
        while ((resource = resourceStore[resourceId])) {
            resourceId = resource.parentId; // now functioning as the parentId
            if (resourceId) {
                res[resourceId] = true;
            }
            else {
                break;
            }
        }
    }
    return res;
}
/*
for making sure events that have editable resources are always draggable in resource views
*/
function transformIsDraggable(val, eventDef, eventUi, context) {
    if (!val) {
        var state = context.getCurrentData();
        var viewSpec = state.viewSpecs[state.currentViewType];
        if (viewSpec.optionDefaults.needsResourceData) {
            if (computeResourceEditable(eventDef, context)) {
                return true;
            }
        }
    }
    return val;
}

// for when non-resource view should be given EventUi info (for event coloring/constraints based off of resource data)
var ResourceEventConfigAdder = /** @class */ (function () {
    function ResourceEventConfigAdder() {
        this.buildResourceEventUis = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(buildResourceEventUis, _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.isPropsEqual);
        this.injectResourceEventUis = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(injectResourceEventUis);
    }
    ResourceEventConfigAdder.prototype.transform = function (viewProps, calendarProps) {
        if (!calendarProps.viewSpec.optionDefaults.needsResourceData) {
            return {
                eventUiBases: this.injectResourceEventUis(viewProps.eventUiBases, viewProps.eventStore.defs, this.buildResourceEventUis(calendarProps.resourceStore)),
            };
        }
        return null;
    };
    return ResourceEventConfigAdder;
}());
function buildResourceEventUis(resourceStore) {
    return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.mapHash)(resourceStore, function (resource) { return resource.ui; });
}
function injectResourceEventUis(eventUiBases, eventDefs, resourceEventUis) {
    return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.mapHash)(eventUiBases, function (eventUi, defId) {
        if (defId) { // not the '' key
            return injectResourceEventUi(eventUi, eventDefs[defId], resourceEventUis);
        }
        return eventUi;
    });
}
function injectResourceEventUi(origEventUi, eventDef, resourceEventUis) {
    var parts = [];
    // first resource takes precedence, which fights with the ordering of combineEventUis, thus the unshifts
    for (var _i = 0, _a = eventDef.resourceIds; _i < _a.length; _i++) {
        var resourceId = _a[_i];
        if (resourceEventUis[resourceId]) {
            parts.unshift(resourceEventUis[resourceId]);
        }
    }
    parts.unshift(origEventUi);
    return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.combineEventUis)(parts);
}

var defs = []; // TODO: use plugin system
function registerResourceSourceDef(def) {
    defs.push(def);
}
function getResourceSourceDef(id) {
    return defs[id];
}
function getResourceSourceDefs() {
    return defs;
}

// TODO: make this a plugin-able parser
// TODO: success/failure
var RESOURCE_SOURCE_REFINERS = {
    id: String,
    // for array. TODO: move to resource-array
    resources: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    // for json feed. TODO: move to resource-json-feed
    url: String,
    method: String,
    startParam: String,
    endParam: String,
    timeZoneParam: String,
    extraParams: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
};
function parseResourceSource(input) {
    var inputObj;
    if (typeof input === 'string') {
        inputObj = { url: input };
    }
    else if (typeof input === 'function' || Array.isArray(input)) {
        inputObj = { resources: input };
    }
    else if (typeof input === 'object' && input) { // non-null object
        inputObj = input;
    }
    if (inputObj) {
        var _a = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.refineProps)(inputObj, RESOURCE_SOURCE_REFINERS), refined = _a.refined, extra = _a.extra;
        warnUnknownProps(extra);
        var metaRes = buildResourceSourceMeta(refined);
        if (metaRes) {
            return {
                _raw: input,
                sourceId: (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.guid)(),
                sourceDefId: metaRes.sourceDefId,
                meta: metaRes.meta,
                publicId: refined.id || '',
                isFetching: false,
                latestFetchId: '',
                fetchRange: null,
            };
        }
    }
    return null;
}
function buildResourceSourceMeta(refined) {
    var defs = getResourceSourceDefs();
    for (var i = defs.length - 1; i >= 0; i -= 1) { // later-added plugins take precedence
        var def = defs[i];
        var meta = def.parseMeta(refined);
        if (meta) {
            return { meta: meta, sourceDefId: i };
        }
    }
    return null;
}
function warnUnknownProps(props) {
    for (var propName in props) {
        console.warn("Unknown resource prop '" + propName + "'");
    }
}

function reduceResourceSource(source, action, context) {
    var options = context.options, dateProfile = context.dateProfile;
    if (!source || !action) {
        return createSource(options.initialResources || options.resources, dateProfile.activeRange, options.refetchResourcesOnNavigate, context);
    }
    switch (action.type) {
        case 'RESET_RESOURCE_SOURCE':
            return createSource(action.resourceSourceInput, dateProfile.activeRange, options.refetchResourcesOnNavigate, context);
        case 'PREV': // TODO: how do we track all actions that affect dateProfile :(
        case 'NEXT':
        case 'CHANGE_DATE':
        case 'CHANGE_VIEW_TYPE':
            return handleRangeChange(source, dateProfile.activeRange, options.refetchResourcesOnNavigate, context);
        case 'RECEIVE_RESOURCES':
        case 'RECEIVE_RESOURCE_ERROR':
            return receiveResponse(source, action.fetchId, action.fetchRange);
        case 'REFETCH_RESOURCES':
            return fetchSource(source, dateProfile.activeRange, context);
        default:
            return source;
    }
}
function createSource(input, activeRange, refetchResourcesOnNavigate, context) {
    if (input) {
        var source = parseResourceSource(input);
        source = fetchSource(source, refetchResourcesOnNavigate ? activeRange : null, context);
        return source;
    }
    return null;
}
function handleRangeChange(source, activeRange, refetchResourcesOnNavigate, context) {
    if (refetchResourcesOnNavigate &&
        !doesSourceIgnoreRange(source) &&
        (!source.fetchRange || !(0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.rangesEqual)(source.fetchRange, activeRange))) {
        return fetchSource(source, activeRange, context);
    }
    return source;
}
function doesSourceIgnoreRange(source) {
    return Boolean(getResourceSourceDef(source.sourceDefId).ignoreRange);
}
function fetchSource(source, fetchRange, context) {
    var sourceDef = getResourceSourceDef(source.sourceDefId);
    var fetchId = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.guid)();
    sourceDef.fetch({
        resourceSource: source,
        range: fetchRange,
        context: context,
    }, function (res) {
        context.dispatch({
            type: 'RECEIVE_RESOURCES',
            fetchId: fetchId,
            fetchRange: fetchRange,
            rawResources: res.rawResources,
        });
    }, function (error) {
        context.dispatch({
            type: 'RECEIVE_RESOURCE_ERROR',
            fetchId: fetchId,
            fetchRange: fetchRange,
            error: error,
        });
    });
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, source), { isFetching: true, latestFetchId: fetchId });
}
function receiveResponse(source, fetchId, fetchRange) {
    if (fetchId === source.latestFetchId) {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, source), { isFetching: false, fetchRange: fetchRange });
    }
    return source;
}

var PRIVATE_ID_PREFIX = '_fc:';
var RESOURCE_REFINERS = {
    id: String,
    parentId: String,
    children: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    title: String,
    businessHours: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    extendedProps: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    // event-ui
    eventEditable: Boolean,
    eventStartEditable: Boolean,
    eventDurationEditable: Boolean,
    eventConstraint: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    eventOverlap: Boolean,
    eventAllow: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    eventClassNames: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.parseClassNames,
    eventBackgroundColor: String,
    eventBorderColor: String,
    eventTextColor: String,
    eventColor: String,
};
/*
needs a full store so that it can populate children too
*/
function parseResource(raw, parentId, store, context) {
    if (parentId === void 0) { parentId = ''; }
    var _a = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.refineProps)(raw, RESOURCE_REFINERS), refined = _a.refined, extra = _a.extra;
    var resource = {
        id: refined.id || (PRIVATE_ID_PREFIX + (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.guid)()),
        parentId: refined.parentId || parentId,
        title: refined.title || '',
        businessHours: refined.businessHours ? (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.parseBusinessHours)(refined.businessHours, context) : null,
        ui: (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createEventUi)({
            editable: refined.eventEditable,
            startEditable: refined.eventStartEditable,
            durationEditable: refined.eventDurationEditable,
            constraint: refined.eventConstraint,
            overlap: refined.eventOverlap,
            allow: refined.eventAllow,
            classNames: refined.eventClassNames,
            backgroundColor: refined.eventBackgroundColor,
            borderColor: refined.eventBorderColor,
            textColor: refined.eventTextColor,
            color: refined.eventColor,
        }, context),
        extendedProps: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, extra), refined.extendedProps),
    };
    // help out ResourceApi from having user modify props
    Object.freeze(resource.ui.classNames);
    Object.freeze(resource.extendedProps);
    if (store[resource.id]) ;
    else {
        store[resource.id] = resource;
        if (refined.children) {
            for (var _i = 0, _b = refined.children; _i < _b.length; _i++) {
                var childInput = _b[_i];
                parseResource(childInput, resource.id, store, context);
            }
        }
    }
    return resource;
}
/*
TODO: use this in more places
*/
function getPublicId(id) {
    if (id.indexOf(PRIVATE_ID_PREFIX) === 0) {
        return '';
    }
    return id;
}

function reduceResourceStore(store, action, source, context) {
    if (!store || !action) {
        return {};
    }
    switch (action.type) {
        case 'RECEIVE_RESOURCES':
            return receiveRawResources(store, action.rawResources, action.fetchId, source, context);
        case 'ADD_RESOURCE':
            return addResource(store, action.resourceHash);
        case 'REMOVE_RESOURCE':
            return removeResource(store, action.resourceId);
        case 'SET_RESOURCE_PROP':
            return setResourceProp(store, action.resourceId, action.propName, action.propValue);
        case 'SET_RESOURCE_EXTENDED_PROP':
            return setResourceExtendedProp(store, action.resourceId, action.propName, action.propValue);
        default:
            return store;
    }
}
function receiveRawResources(existingStore, inputs, fetchId, source, context) {
    if (source.latestFetchId === fetchId) {
        var nextStore = {};
        for (var _i = 0, inputs_1 = inputs; _i < inputs_1.length; _i++) {
            var input = inputs_1[_i];
            parseResource(input, '', nextStore, context);
        }
        return nextStore;
    }
    return existingStore;
}
function addResource(existingStore, additions) {
    // TODO: warn about duplicate IDs
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, existingStore), additions);
}
function removeResource(existingStore, resourceId) {
    var newStore = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, existingStore);
    delete newStore[resourceId];
    // promote children
    for (var childResourceId in newStore) { // a child, *maybe* but probably not
        if (newStore[childResourceId].parentId === resourceId) {
            newStore[childResourceId] = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, newStore[childResourceId]), { parentId: '' });
        }
    }
    return newStore;
}
function setResourceProp(existingStore, resourceId, name, value) {
    var _a, _b;
    var existingResource = existingStore[resourceId];
    // TODO: sanitization
    if (existingResource) {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, existingStore), (_a = {}, _a[resourceId] = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, existingResource), (_b = {}, _b[name] = value, _b)), _a));
    }
    return existingStore;
}
function setResourceExtendedProp(existingStore, resourceId, name, value) {
    var _a, _b;
    var existingResource = existingStore[resourceId];
    if (existingResource) {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, existingStore), (_a = {}, _a[resourceId] = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, existingResource), { extendedProps: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, existingResource.extendedProps), (_b = {}, _b[name] = value, _b)) }), _a));
    }
    return existingStore;
}

function reduceResourceEntityExpansions(expansions, action) {
    var _a;
    if (!expansions || !action) {
        return {};
    }
    switch (action.type) {
        case 'SET_RESOURCE_ENTITY_EXPANDED':
            return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, expansions), (_a = {}, _a[action.id] = action.isExpanded, _a));
        default:
            return expansions;
    }
}

function reduceResources(state, action, context) {
    var resourceSource = reduceResourceSource(state && state.resourceSource, action, context);
    var resourceStore = reduceResourceStore(state && state.resourceStore, action, resourceSource, context);
    var resourceEntityExpansions = reduceResourceEntityExpansions(state && state.resourceEntityExpansions, action);
    return {
        resourceSource: resourceSource,
        resourceStore: resourceStore,
        resourceEntityExpansions: resourceEntityExpansions,
    };
}

var EVENT_REFINERS = {
    resourceId: String,
    resourceIds: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceEditable: Boolean,
};
function generateEventDefResourceMembers(refined) {
    return {
        resourceIds: ensureStringArray(refined.resourceIds)
            .concat(refined.resourceId ? [refined.resourceId] : []),
        resourceEditable: refined.resourceEditable,
    };
}
function ensureStringArray(items) {
    return (items || []).map(function (item) { return String(item); });
}

function transformDateSelectionJoin(hit0, hit1) {
    var resourceId0 = hit0.dateSpan.resourceId;
    var resourceId1 = hit1.dateSpan.resourceId;
    if (resourceId0 && resourceId1) {
        return { resourceId: resourceId0 };
    }
    return null;
}

var ResourceApi = /** @class */ (function () {
    function ResourceApi(_context, _resource) {
        this._context = _context;
        this._resource = _resource;
    }
    ResourceApi.prototype.setProp = function (name, value) {
        var oldResource = this._resource;
        this._context.dispatch({
            type: 'SET_RESOURCE_PROP',
            resourceId: oldResource.id,
            propName: name,
            propValue: value,
        });
        this.sync(oldResource);
    };
    ResourceApi.prototype.setExtendedProp = function (name, value) {
        var oldResource = this._resource;
        this._context.dispatch({
            type: 'SET_RESOURCE_EXTENDED_PROP',
            resourceId: oldResource.id,
            propName: name,
            propValue: value,
        });
        this.sync(oldResource);
    };
    ResourceApi.prototype.sync = function (oldResource) {
        var context = this._context;
        var resourceId = oldResource.id;
        // TODO: what if dispatch didn't complete synchronously?
        this._resource = context.getCurrentData().resourceStore[resourceId];
        context.emitter.trigger('resourceChange', {
            oldResource: new ResourceApi(context, oldResource),
            resource: this,
            revert: function () {
                var _a;
                context.dispatch({
                    type: 'ADD_RESOURCE',
                    resourceHash: (_a = {},
                        _a[resourceId] = oldResource,
                        _a),
                });
            },
        });
    };
    ResourceApi.prototype.remove = function () {
        var context = this._context;
        var internalResource = this._resource;
        var resourceId = internalResource.id;
        context.dispatch({
            type: 'REMOVE_RESOURCE',
            resourceId: resourceId,
        });
        context.emitter.trigger('resourceRemove', {
            resource: this,
            revert: function () {
                var _a;
                context.dispatch({
                    type: 'ADD_RESOURCE',
                    resourceHash: (_a = {},
                        _a[resourceId] = internalResource,
                        _a),
                });
            },
        });
    };
    ResourceApi.prototype.getParent = function () {
        var context = this._context;
        var parentId = this._resource.parentId;
        if (parentId) {
            return new ResourceApi(context, context.getCurrentData().resourceSource[parentId]);
        }
        return null;
    };
    ResourceApi.prototype.getChildren = function () {
        var thisResourceId = this._resource.id;
        var context = this._context;
        var resourceStore = context.getCurrentData().resourceStore;
        var childApis = [];
        for (var resourceId in resourceStore) {
            if (resourceStore[resourceId].parentId === thisResourceId) {
                childApis.push(new ResourceApi(context, resourceStore[resourceId]));
            }
        }
        return childApis;
    };
    /*
    this is really inefficient!
    TODO: make EventApi::resourceIds a hash or keep an index in the Calendar's state
    */
    ResourceApi.prototype.getEvents = function () {
        var thisResourceId = this._resource.id;
        var context = this._context;
        var _a = context.getCurrentData().eventStore, defs = _a.defs, instances = _a.instances;
        var eventApis = [];
        for (var instanceId in instances) {
            var instance = instances[instanceId];
            var def = defs[instance.defId];
            if (def.resourceIds.indexOf(thisResourceId) !== -1) { // inefficient!!!
                eventApis.push(new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.EventApi(context, def, instance));
            }
        }
        return eventApis;
    };
    Object.defineProperty(ResourceApi.prototype, "id", {
        get: function () { return getPublicId(this._resource.id); },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "title", {
        get: function () { return this._resource.title; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventConstraint", {
        get: function () { return this._resource.ui.constraints[0] || null; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventOverlap", {
        get: function () { return this._resource.ui.overlap; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventAllow", {
        get: function () { return this._resource.ui.allows[0] || null; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventBackgroundColor", {
        get: function () { return this._resource.ui.backgroundColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventBorderColor", {
        get: function () { return this._resource.ui.borderColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventTextColor", {
        get: function () { return this._resource.ui.textColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventClassNames", {
        // NOTE: user can't modify these because Object.freeze was called in event-def parsing
        get: function () { return this._resource.ui.classNames; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "extendedProps", {
        get: function () { return this._resource.extendedProps; },
        enumerable: false,
        configurable: true
    });
    ResourceApi.prototype.toPlainObject = function (settings) {
        if (settings === void 0) { settings = {}; }
        var internal = this._resource;
        var ui = internal.ui;
        var publicId = this.id;
        var res = {};
        if (publicId) {
            res.id = publicId;
        }
        if (internal.title) {
            res.title = internal.title;
        }
        if (settings.collapseEventColor && ui.backgroundColor && ui.backgroundColor === ui.borderColor) {
            res.eventColor = ui.backgroundColor;
        }
        else {
            if (ui.backgroundColor) {
                res.eventBackgroundColor = ui.backgroundColor;
            }
            if (ui.borderColor) {
                res.eventBorderColor = ui.borderColor;
            }
        }
        if (ui.textColor) {
            res.eventTextColor = ui.textColor;
        }
        if (ui.classNames.length) {
            res.eventClassNames = ui.classNames;
        }
        if (Object.keys(internal.extendedProps).length) {
            if (settings.collapseExtendedProps) {
                (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(res, internal.extendedProps);
            }
            else {
                res.extendedProps = internal.extendedProps;
            }
        }
        return res;
    };
    ResourceApi.prototype.toJSON = function () {
        return this.toPlainObject();
    };
    return ResourceApi;
}());
function buildResourceApis(resourceStore, context) {
    var resourceApis = [];
    for (var resourceId in resourceStore) {
        resourceApis.push(new ResourceApi(context, resourceStore[resourceId]));
    }
    return resourceApis;
}

_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.CalendarApi.prototype.addResource = function (input, scrollTo) {
    var _a;
    var _this = this;
    if (scrollTo === void 0) { scrollTo = true; }
    var currentState = this.getCurrentData();
    var resourceHash;
    var resource;
    if (input instanceof ResourceApi) {
        resource = input._resource;
        resourceHash = (_a = {}, _a[resource.id] = resource, _a);
    }
    else {
        resourceHash = {};
        resource = parseResource(input, '', resourceHash, currentState);
    }
    this.dispatch({
        type: 'ADD_RESOURCE',
        resourceHash: resourceHash,
    });
    if (scrollTo) {
        // TODO: wait til dispatch completes somehow
        this.trigger('_scrollRequest', { resourceId: resource.id });
    }
    var resourceApi = new ResourceApi(currentState, resource);
    currentState.emitter.trigger('resourceAdd', {
        resource: resourceApi,
        revert: function () {
            _this.dispatch({
                type: 'REMOVE_RESOURCE',
                resourceId: resource.id,
            });
        },
    });
    return resourceApi;
};
_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.CalendarApi.prototype.getResourceById = function (id) {
    id = String(id);
    var currentState = this.getCurrentData(); // eslint-disable-line react/no-this-in-sfc
    if (currentState.resourceStore) { // guard against calendar with no resource functionality
        var rawResource = currentState.resourceStore[id];
        if (rawResource) {
            return new ResourceApi(currentState, rawResource);
        }
    }
    return null;
};
_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.CalendarApi.prototype.getResources = function () {
    var currentState = this.getCurrentData();
    var resourceStore = currentState.resourceStore;
    var resourceApis = [];
    if (resourceStore) { // guard against calendar with no resource functionality
        for (var resourceId in resourceStore) {
            resourceApis.push(new ResourceApi(currentState, resourceStore[resourceId]));
        }
    }
    return resourceApis;
};
_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.CalendarApi.prototype.getTopLevelResources = function () {
    var currentState = this.getCurrentData();
    var resourceStore = currentState.resourceStore;
    var resourceApis = [];
    if (resourceStore) { // guard against calendar with no resource functionality
        for (var resourceId in resourceStore) {
            if (!resourceStore[resourceId].parentId) {
                resourceApis.push(new ResourceApi(currentState, resourceStore[resourceId]));
            }
        }
    }
    return resourceApis;
};
_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.CalendarApi.prototype.refetchResources = function () {
    this.dispatch({
        type: 'REFETCH_RESOURCES',
    });
};
function transformDatePoint(dateSpan, context) {
    return dateSpan.resourceId ?
        { resource: context.calendarApi.getResourceById(dateSpan.resourceId) } :
        {};
}
function transformDateSpan(dateSpan, context) {
    return dateSpan.resourceId ?
        { resource: context.calendarApi.getResourceById(dateSpan.resourceId) } :
        {};
}

/*
splits things BASED OFF OF which resources they are associated with.
creates a '' entry which is when something has NO resource.
*/
var ResourceSplitter = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ResourceSplitter, _super);
    function ResourceSplitter() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceSplitter.prototype.getKeyInfo = function (props) {
        return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ '': {} }, props.resourceStore);
    };
    ResourceSplitter.prototype.getKeysForDateSpan = function (dateSpan) {
        return [dateSpan.resourceId || ''];
    };
    ResourceSplitter.prototype.getKeysForEventDef = function (eventDef) {
        var resourceIds = eventDef.resourceIds;
        if (!resourceIds.length) {
            return [''];
        }
        return resourceIds;
    };
    return ResourceSplitter;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Splitter));

function isPropsValidWithResources(combinedProps, context) {
    var splitter = new ResourceSplitter();
    var sets = splitter.splitProps((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, combinedProps), { resourceStore: context.getCurrentData().resourceStore }));
    for (var resourceId in sets) {
        var props = sets[resourceId];
        // merge in event data from the non-resource segment
        if (resourceId && sets['']) { // current segment is not the non-resource one, and there IS a non-resource one
            props = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, props), { eventStore: (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.mergeEventStores)(sets[''].eventStore, props.eventStore), eventUiBases: (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, sets[''].eventUiBases), props.eventUiBases) });
        }
        if (!(0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.isPropsValid)(props, context, { resourceId: resourceId }, filterConfig.bind(null, resourceId))) {
            return false;
        }
    }
    return true;
}
function filterConfig(resourceId, config) {
    return (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, config), { constraints: filterConstraints(resourceId, config.constraints) });
}
function filterConstraints(resourceId, constraints) {
    return constraints.map(function (constraint) {
        var defs = constraint.defs;
        if (defs) { // we are dealing with an EventStore
            // if any of the events define constraints to resources that are NOT this resource,
            // then this resource is unconditionally prohibited, which is what a `false` value does.
            for (var defId in defs) {
                var resourceIds = defs[defId].resourceIds;
                if (resourceIds.length && resourceIds.indexOf(resourceId) === -1) { // TODO: use a hash?!!! (for other reasons too)
                    return false;
                }
            }
        }
        return constraint;
    });
}

function transformExternalDef(dateSpan) {
    return dateSpan.resourceId ?
        { resourceId: dateSpan.resourceId } :
        {};
}

_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.EventApi.prototype.getResources = function () {
    var calendarApi = this._context.calendarApi;
    return this._def.resourceIds.map(function (resourceId) { return calendarApi.getResourceById(resourceId); });
};
_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.EventApi.prototype.setResources = function (resources) {
    var resourceIds = [];
    // massage resources -> resourceIds
    for (var _i = 0, resources_1 = resources; _i < resources_1.length; _i++) {
        var resource = resources_1[_i];
        var resourceId = null;
        if (typeof resource === 'string') {
            resourceId = resource;
        }
        else if (typeof resource === 'number') {
            resourceId = String(resource);
        }
        else if (resource instanceof ResourceApi) {
            resourceId = resource.id; // guaranteed to always have an ID. hmmm
        }
        else {
            console.warn('unknown resource type: ' + resource);
        }
        if (resourceId) {
            resourceIds.push(resourceId);
        }
    }
    this.mutate({
        standardProps: {
            resourceIds: resourceIds,
        },
    });
};

var optionChangeHandlers = {
    resources: handleResources,
};
function handleResources(newSourceInput, context) {
    var oldSourceInput = context.getCurrentData().resourceSource._raw;
    if (oldSourceInput !== newSourceInput) {
        context.dispatch({
            type: 'RESET_RESOURCE_SOURCE',
            resourceSourceInput: newSourceInput,
        });
    }
}

var DEFAULT_RESOURCE_ORDER = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.parseFieldSpecs)('id,title');
function handleResourceStore(resourceStore, calendarData) {
    var emitter = calendarData.emitter;
    if (emitter.hasHandlers('resourcesSet')) {
        emitter.trigger('resourcesSet', buildResourceApis(resourceStore, calendarData));
    }
}

var OPTION_REFINERS = {
    initialResources: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resources: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    eventResourceEditable: Boolean,
    refetchResourcesOnNavigate: Boolean,
    resourceOrder: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.parseFieldSpecs,
    filterResourcesWithEvents: Boolean,
    resourceGroupField: String,
    resourceAreaWidth: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceAreaColumns: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourcesInitiallyExpanded: Boolean,
    datesAboveResources: Boolean,
    needsResourceData: Boolean,
    resourceAreaHeaderClassNames: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceAreaHeaderContent: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceAreaHeaderDidMount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceAreaHeaderWillUnmount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceGroupLabelClassNames: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceGroupLabelContent: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceGroupLabelDidMount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceGroupLabelWillUnmount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceLabelClassNames: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceLabelContent: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceLabelDidMount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceLabelWillUnmount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceLaneClassNames: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceLaneContent: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceLaneDidMount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceLaneWillUnmount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceGroupLaneClassNames: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceGroupLaneContent: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceGroupLaneDidMount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceGroupLaneWillUnmount: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
};
var LISTENER_REFINERS = {
    resourcesSet: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceAdd: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceChange: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
    resourceRemove: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.identity,
};

registerResourceSourceDef({
    ignoreRange: true,
    parseMeta: function (refined) {
        if (Array.isArray(refined.resources)) {
            return refined.resources;
        }
        return null;
    },
    fetch: function (arg, successCallback) {
        successCallback({
            rawResources: arg.resourceSource.meta,
        });
    },
});

registerResourceSourceDef({
    parseMeta: function (refined) {
        if (typeof refined.resources === 'function') {
            return refined.resources;
        }
        return null;
    },
    fetch: function (arg, success, failure) {
        var dateEnv = arg.context.dateEnv;
        var func = arg.resourceSource.meta;
        var publicArg = arg.range ? {
            start: dateEnv.toDate(arg.range.start),
            end: dateEnv.toDate(arg.range.end),
            startStr: dateEnv.formatIso(arg.range.start),
            endStr: dateEnv.formatIso(arg.range.end),
            timeZone: dateEnv.timeZone,
        } : {};
        // TODO: make more dry with EventSourceFunc
        // TODO: accept a response?
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.unpromisify)(func.bind(null, publicArg), function (rawResources) {
            success({ rawResources: rawResources }); // needs an object response
        }, failure);
    },
});

registerResourceSourceDef({
    parseMeta: function (refined) {
        if (refined.url) {
            return {
                url: refined.url,
                method: (refined.method || 'GET').toUpperCase(),
                extraParams: refined.extraParams,
            };
        }
        return null;
    },
    fetch: function (arg, successCallback, failureCallback) {
        var meta = arg.resourceSource.meta;
        var requestParams = buildRequestParams(meta, arg.range, arg.context);
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.requestJson)(meta.method, meta.url, requestParams, function (rawResources, xhr) {
            successCallback({ rawResources: rawResources, xhr: xhr });
        }, function (message, xhr) {
            failureCallback({ message: message, xhr: xhr });
        });
    },
});
// TODO: somehow consolidate with event json feed
function buildRequestParams(meta, range, context) {
    var dateEnv = context.dateEnv, options = context.options;
    var startParam;
    var endParam;
    var timeZoneParam;
    var customRequestParams;
    var params = {};
    if (range) {
        startParam = meta.startParam;
        if (startParam == null) {
            startParam = options.startParam;
        }
        endParam = meta.endParam;
        if (endParam == null) {
            endParam = options.endParam;
        }
        timeZoneParam = meta.timeZoneParam;
        if (timeZoneParam == null) {
            timeZoneParam = options.timeZoneParam;
        }
        params[startParam] = dateEnv.formatIso(range.start);
        params[endParam] = dateEnv.formatIso(range.end);
        if (dateEnv.timeZone !== 'local') {
            params[timeZoneParam] = dateEnv.timeZone;
        }
    }
    // retrieve any outbound GET/POST data from the options
    if (typeof meta.extraParams === 'function') {
        // supplied as a function that returns a key/value object
        customRequestParams = meta.extraParams();
    }
    else {
        // probably supplied as a straight key/value object
        customRequestParams = meta.extraParams || {};
    }
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(params, customRequestParams);
    return params;
}

// TODO: not used for Spreadsheet. START USING. difficult because of col-specific rendering props
function ResourceLabelRoot(props) {
    return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.ViewContextType.Consumer, null, function (context) {
        var options = context.options;
        var hookProps = {
            resource: new ResourceApi(context, props.resource),
            date: props.date ? context.dateEnv.toDate(props.date) : null,
            view: context.viewApi,
        };
        var dataAttrs = {
            'data-resource-id': props.resource.id,
            'data-date': props.date ? (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.formatDayString)(props.date) : undefined,
        };
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.RenderHook, { hookProps: hookProps, classNames: options.resourceLabelClassNames, content: options.resourceLabelContent, defaultContent: renderInnerContent, didMount: options.resourceLabelDidMount, willUnmount: options.resourceLabelWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return props.children(rootElRef, classNames, // TODO: pass in 'fc-resource' ?
        dataAttrs, innerElRef, innerContent); }));
    }));
}
function renderInnerContent(props) {
    return props.resource.title || props.resource.id;
}

var ResourceCell = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ResourceCell, _super);
    function ResourceCell() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceCell.prototype.render = function () {
        var props = this.props;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(ResourceLabelRoot, { resource: props.resource, date: props.date }, function (elRef, customClassNames, dataAttrs, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("th", (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ ref: elRef, role: "columnheader", className: ['fc-col-header-cell', 'fc-resource'].concat(customClassNames).join(' '), colSpan: props.colSpan }, dataAttrs),
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", { className: "fc-scrollgrid-sync-inner" },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", { className: [
                        'fc-col-header-cell-cushion',
                        props.isSticky ? 'fc-sticky' : '',
                    ].join(' '), ref: innerElRef }, innerContent)))); }));
    };
    return ResourceCell;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.BaseComponent));

var ResourceDayHeader = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ResourceDayHeader, _super);
    function ResourceDayHeader() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.buildDateFormat = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(buildDateFormat);
        return _this;
    }
    ResourceDayHeader.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var dateFormat = this.buildDateFormat(context.options.dayHeaderFormat, props.datesRepDistinctDays, props.dates.length);
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.NowTimer, { unit: "day" }, function (nowDate, todayRange) {
            if (props.dates.length === 1) {
                return _this.renderResourceRow(props.resources, props.dates[0]);
            }
            if (context.options.datesAboveResources) {
                return _this.renderDayAndResourceRows(props.dates, dateFormat, todayRange, props.resources);
            }
            return _this.renderResourceAndDayRows(props.resources, props.dates, dateFormat, todayRange);
        }));
    };
    ResourceDayHeader.prototype.renderResourceRow = function (resources, date) {
        var resourceCells = resources.map(function (resource) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(ResourceCell, { key: resource.id, resource: resource, colSpan: 1, date: date })); });
        return this.buildTr(resourceCells, 'resources');
    };
    ResourceDayHeader.prototype.renderDayAndResourceRows = function (dates, dateFormat, todayRange, resources) {
        var dateCells = [];
        var resourceCells = [];
        for (var _i = 0, dates_1 = dates; _i < dates_1.length; _i++) {
            var date = dates_1[_i];
            dateCells.push(this.renderDateCell(date, dateFormat, todayRange, resources.length, null, true));
            for (var _a = 0, resources_1 = resources; _a < resources_1.length; _a++) {
                var resource = resources_1[_a];
                resourceCells.push((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(ResourceCell, { key: resource.id + ':' + date.toISOString(), resource: resource, colSpan: 1, date: date }));
            }
        }
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Fragment, null,
            this.buildTr(dateCells, 'day'),
            this.buildTr(resourceCells, 'resources')));
    };
    ResourceDayHeader.prototype.renderResourceAndDayRows = function (resources, dates, dateFormat, todayRange) {
        var resourceCells = [];
        var dateCells = [];
        for (var _i = 0, resources_2 = resources; _i < resources_2.length; _i++) {
            var resource = resources_2[_i];
            resourceCells.push((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(ResourceCell, { key: resource.id, resource: resource, colSpan: dates.length, isSticky: true }));
            for (var _a = 0, dates_2 = dates; _a < dates_2.length; _a++) {
                var date = dates_2[_a];
                dateCells.push(this.renderDateCell(date, dateFormat, todayRange, 1, resource));
            }
        }
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Fragment, null,
            this.buildTr(resourceCells, 'resources'),
            this.buildTr(dateCells, 'day')));
    };
    // a cell with date text. might have a resource associated with it
    ResourceDayHeader.prototype.renderDateCell = function (date, dateFormat, todayRange, colSpan, resource, isSticky) {
        var props = this.props;
        var keyPostfix = resource ? ":" + resource.id : '';
        var extraHookProps = resource ? { resource: new ResourceApi(this.context, resource) } : {};
        var extraDataAttrs = resource ? { 'data-resource-id': resource.id } : {};
        return props.datesRepDistinctDays ? ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.TableDateCell, { key: date.toISOString() + keyPostfix, date: date, dateProfile: props.dateProfile, todayRange: todayRange, colCnt: props.dates.length * props.resources.length, dayHeaderFormat: dateFormat, colSpan: colSpan, isSticky: isSticky, extraHookProps: extraHookProps, extraDataAttrs: extraDataAttrs })) : ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.TableDowCell // we can't leverage the pure-componentness becausae the extra* props are new every time :(
        , { key: date.getUTCDay() + keyPostfix, dow: date.getUTCDay(), dayHeaderFormat: dateFormat, colSpan: colSpan, isSticky: isSticky, extraHookProps: extraHookProps, extraDataAttrs: extraDataAttrs }));
    };
    ResourceDayHeader.prototype.buildTr = function (cells, key) {
        var renderIntro = this.props.renderIntro;
        if (!cells.length) {
            cells = [(0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("td", { key: 0 }, "\u00A0")];
        }
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", { key: key, role: "row" },
            renderIntro && renderIntro(key),
            cells));
    };
    return ResourceDayHeader;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.BaseComponent));
function buildDateFormat(dayHeaderFormat, datesRepDistinctDays, dayCnt) {
    return dayHeaderFormat || (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.computeFallbackHeaderFormat)(datesRepDistinctDays, dayCnt);
}

var ResourceIndex = /** @class */ (function () {
    function ResourceIndex(resources) {
        var indicesById = {};
        var ids = [];
        for (var i = 0; i < resources.length; i += 1) {
            var id = resources[i].id;
            ids.push(id);
            indicesById[id] = i;
        }
        this.ids = ids;
        this.indicesById = indicesById;
        this.length = resources.length;
    }
    return ResourceIndex;
}());

var AbstractResourceDayTableModel = /** @class */ (function () {
    function AbstractResourceDayTableModel(dayTableModel, resources, context) {
        this.dayTableModel = dayTableModel;
        this.resources = resources;
        this.context = context;
        this.resourceIndex = new ResourceIndex(resources);
        this.rowCnt = dayTableModel.rowCnt;
        this.colCnt = dayTableModel.colCnt * resources.length;
        this.cells = this.buildCells();
    }
    AbstractResourceDayTableModel.prototype.buildCells = function () {
        var _a = this, rowCnt = _a.rowCnt, dayTableModel = _a.dayTableModel, resources = _a.resources;
        var rows = [];
        for (var row = 0; row < rowCnt; row += 1) {
            var rowCells = [];
            for (var dateCol = 0; dateCol < dayTableModel.colCnt; dateCol += 1) {
                for (var resourceCol = 0; resourceCol < resources.length; resourceCol += 1) {
                    var resource = resources[resourceCol];
                    var extraHookProps = { resource: new ResourceApi(this.context, resource) };
                    var extraDataAttrs = { 'data-resource-id': resource.id };
                    var extraClassNames = ['fc-resource'];
                    var extraDateSpan = { resourceId: resource.id };
                    var date = dayTableModel.cells[row][dateCol].date;
                    rowCells[this.computeCol(dateCol, resourceCol)] = {
                        key: resource.id + ':' + date.toISOString(),
                        date: date,
                        extraHookProps: extraHookProps,
                        extraDataAttrs: extraDataAttrs,
                        extraClassNames: extraClassNames,
                        extraDateSpan: extraDateSpan,
                    };
                }
            }
            rows.push(rowCells);
        }
        return rows;
    };
    return AbstractResourceDayTableModel;
}());

/*
resources over dates
*/
var ResourceDayTableModel = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ResourceDayTableModel, _super);
    function ResourceDayTableModel() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceDayTableModel.prototype.computeCol = function (dateI, resourceI) {
        return resourceI * this.dayTableModel.colCnt + dateI;
    };
    /*
    all date ranges are intact
    */
    ResourceDayTableModel.prototype.computeColRanges = function (dateStartI, dateEndI, resourceI) {
        return [
            {
                firstCol: this.computeCol(dateStartI, resourceI),
                lastCol: this.computeCol(dateEndI, resourceI),
                isStart: true,
                isEnd: true,
            },
        ];
    };
    return ResourceDayTableModel;
}(AbstractResourceDayTableModel));

/*
dates over resources
*/
var DayResourceTableModel = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(DayResourceTableModel, _super);
    function DayResourceTableModel() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    DayResourceTableModel.prototype.computeCol = function (dateI, resourceI) {
        return dateI * this.resources.length + resourceI;
    };
    /*
    every single day is broken up
    */
    DayResourceTableModel.prototype.computeColRanges = function (dateStartI, dateEndI, resourceI) {
        var segs = [];
        for (var i = dateStartI; i <= dateEndI; i += 1) {
            var col = this.computeCol(i, resourceI);
            segs.push({
                firstCol: col,
                lastCol: col,
                isStart: i === dateStartI,
                isEnd: i === dateEndI,
            });
        }
        return segs;
    };
    return DayResourceTableModel;
}(AbstractResourceDayTableModel));

var NO_SEGS = []; // for memoizing
var VResourceJoiner = /** @class */ (function () {
    function VResourceJoiner() {
        this.joinDateSelection = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(this.joinSegs);
        this.joinBusinessHours = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(this.joinSegs);
        this.joinFgEvents = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(this.joinSegs);
        this.joinBgEvents = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(this.joinSegs);
        this.joinEventDrags = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(this.joinInteractions);
        this.joinEventResizes = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoize)(this.joinInteractions);
    }
    /*
    propSets also has a '' key for things with no resource
    */
    VResourceJoiner.prototype.joinProps = function (propSets, resourceDayTable) {
        var dateSelectionSets = [];
        var businessHoursSets = [];
        var fgEventSets = [];
        var bgEventSets = [];
        var eventDrags = [];
        var eventResizes = [];
        var eventSelection = '';
        var keys = resourceDayTable.resourceIndex.ids.concat(['']); // add in the all-resource key
        for (var _i = 0, keys_1 = keys; _i < keys_1.length; _i++) {
            var key = keys_1[_i];
            var props = propSets[key];
            dateSelectionSets.push(props.dateSelectionSegs);
            businessHoursSets.push(key ? props.businessHourSegs : NO_SEGS); // don't include redundant all-resource businesshours
            fgEventSets.push(key ? props.fgEventSegs : NO_SEGS); // don't include fg all-resource segs
            bgEventSets.push(props.bgEventSegs);
            eventDrags.push(props.eventDrag);
            eventResizes.push(props.eventResize);
            eventSelection = eventSelection || props.eventSelection;
        }
        return {
            dateSelectionSegs: this.joinDateSelection.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([resourceDayTable], dateSelectionSets)),
            businessHourSegs: this.joinBusinessHours.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([resourceDayTable], businessHoursSets)),
            fgEventSegs: this.joinFgEvents.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([resourceDayTable], fgEventSets)),
            bgEventSegs: this.joinBgEvents.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([resourceDayTable], bgEventSets)),
            eventDrag: this.joinEventDrags.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([resourceDayTable], eventDrags)),
            eventResize: this.joinEventResizes.apply(this, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)([resourceDayTable], eventResizes)),
            eventSelection: eventSelection,
        };
    };
    VResourceJoiner.prototype.joinSegs = function (resourceDayTable) {
        var segGroups = [];
        for (var _i = 1; _i < arguments.length; _i++) {
            segGroups[_i - 1] = arguments[_i];
        }
        var resourceCnt = resourceDayTable.resources.length;
        var transformedSegs = [];
        for (var i = 0; i < resourceCnt; i += 1) {
            for (var _a = 0, _b = segGroups[i]; _a < _b.length; _a++) {
                var seg = _b[_a];
                transformedSegs.push.apply(transformedSegs, this.transformSeg(seg, resourceDayTable, i));
            }
            for (var _c = 0, _d = segGroups[resourceCnt]; _c < _d.length; _c++) { // one beyond. the all-resource
                var seg = _d[_c];
                transformedSegs.push.apply(// one beyond. the all-resource
                transformedSegs, this.transformSeg(seg, resourceDayTable, i));
            }
        }
        return transformedSegs;
    };
    /*
    for expanding non-resource segs to all resources.
    only for public use.
    no memoizing.
    */
    VResourceJoiner.prototype.expandSegs = function (resourceDayTable, segs) {
        var resourceCnt = resourceDayTable.resources.length;
        var transformedSegs = [];
        for (var i = 0; i < resourceCnt; i += 1) {
            for (var _i = 0, segs_1 = segs; _i < segs_1.length; _i++) {
                var seg = segs_1[_i];
                transformedSegs.push.apply(transformedSegs, this.transformSeg(seg, resourceDayTable, i));
            }
        }
        return transformedSegs;
    };
    VResourceJoiner.prototype.joinInteractions = function (resourceDayTable) {
        var interactions = [];
        for (var _i = 1; _i < arguments.length; _i++) {
            interactions[_i - 1] = arguments[_i];
        }
        var resourceCnt = resourceDayTable.resources.length;
        var affectedInstances = {};
        var transformedSegs = [];
        var anyInteractions = false;
        var isEvent = false;
        for (var i = 0; i < resourceCnt; i += 1) {
            var interaction = interactions[i];
            if (interaction) {
                anyInteractions = true;
                for (var _a = 0, _b = interaction.segs; _a < _b.length; _a++) {
                    var seg = _b[_a];
                    transformedSegs.push.apply(transformedSegs, this.transformSeg(seg, resourceDayTable, i));
                }
                (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)(affectedInstances, interaction.affectedInstances);
                isEvent = isEvent || interaction.isEvent;
            }
            if (interactions[resourceCnt]) { // one beyond. the all-resource
                for (var _c = 0, _d = interactions[resourceCnt].segs; _c < _d.length; _c++) {
                    var seg = _d[_c];
                    transformedSegs.push.apply(transformedSegs, this.transformSeg(seg, resourceDayTable, i));
                }
            }
        }
        if (anyInteractions) {
            return {
                affectedInstances: affectedInstances,
                segs: transformedSegs,
                isEvent: isEvent,
            };
        }
        return null;
    };
    return VResourceJoiner;
}());

/*
TODO: just use ResourceHash somehow? could then use the generic ResourceSplitter
*/
var VResourceSplitter = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(VResourceSplitter, _super);
    function VResourceSplitter() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    VResourceSplitter.prototype.getKeyInfo = function (props) {
        var resourceDayTableModel = props.resourceDayTableModel;
        var hash = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.mapHash)(resourceDayTableModel.resourceIndex.indicesById, function (i) { return resourceDayTableModel.resources[i]; }); // :(
        hash[''] = {};
        return hash;
    };
    VResourceSplitter.prototype.getKeysForDateSpan = function (dateSpan) {
        return [dateSpan.resourceId || ''];
    };
    VResourceSplitter.prototype.getKeysForEventDef = function (eventDef) {
        var resourceIds = eventDef.resourceIds;
        if (!resourceIds.length) {
            return [''];
        }
        return resourceIds;
    };
    return VResourceSplitter;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Splitter));

/*
doesn't accept grouping
*/
function flattenResources(resourceStore, orderSpecs) {
    return buildRowNodes(resourceStore, [], orderSpecs, false, {}, true)
        .map(function (node) { return node.resource; });
}
function buildRowNodes(resourceStore, groupSpecs, orderSpecs, isVGrouping, expansions, expansionDefault) {
    var complexNodes = buildHierarchy(resourceStore, isVGrouping ? -1 : 1, groupSpecs, orderSpecs);
    var flatNodes = [];
    flattenNodes(complexNodes, flatNodes, isVGrouping, [], 0, expansions, expansionDefault);
    return flatNodes;
}
function flattenNodes(complexNodes, res, isVGrouping, rowSpans, depth, expansions, expansionDefault) {
    for (var i = 0; i < complexNodes.length; i += 1) {
        var complexNode = complexNodes[i];
        var group = complexNode.group;
        if (group) {
            if (isVGrouping) {
                var firstRowIndex = res.length;
                var rowSpanIndex = rowSpans.length;
                flattenNodes(complexNode.children, res, isVGrouping, rowSpans.concat(0), depth, expansions, expansionDefault);
                if (firstRowIndex < res.length) {
                    var firstRow = res[firstRowIndex];
                    var firstRowSpans = firstRow.rowSpans = firstRow.rowSpans.slice();
                    firstRowSpans[rowSpanIndex] = res.length - firstRowIndex;
                }
            }
            else {
                var id = group.spec.field + ':' + group.value;
                var isExpanded = expansions[id] != null ? expansions[id] : expansionDefault;
                res.push({ id: id, group: group, isExpanded: isExpanded });
                if (isExpanded) {
                    flattenNodes(complexNode.children, res, isVGrouping, rowSpans, depth + 1, expansions, expansionDefault);
                }
            }
        }
        else if (complexNode.resource) {
            var id = complexNode.resource.id;
            var isExpanded = expansions[id] != null ? expansions[id] : expansionDefault;
            res.push({
                id: id,
                rowSpans: rowSpans,
                depth: depth,
                isExpanded: isExpanded,
                hasChildren: Boolean(complexNode.children.length),
                resource: complexNode.resource,
                resourceFields: complexNode.resourceFields,
            });
            if (isExpanded) {
                flattenNodes(complexNode.children, res, isVGrouping, rowSpans, depth + 1, expansions, expansionDefault);
            }
        }
    }
}
function buildHierarchy(resourceStore, maxDepth, groupSpecs, orderSpecs) {
    var resourceNodes = buildResourceNodes(resourceStore, orderSpecs);
    var builtNodes = [];
    for (var resourceId in resourceNodes) {
        var resourceNode = resourceNodes[resourceId];
        if (!resourceNode.resource.parentId) {
            insertResourceNode(resourceNode, builtNodes, groupSpecs, 0, maxDepth, orderSpecs);
        }
    }
    return builtNodes;
}
function buildResourceNodes(resourceStore, orderSpecs) {
    var nodeHash = {};
    for (var resourceId in resourceStore) {
        var resource = resourceStore[resourceId];
        nodeHash[resourceId] = {
            resource: resource,
            resourceFields: buildResourceFields(resource),
            children: [],
        };
    }
    for (var resourceId in resourceStore) {
        var resource = resourceStore[resourceId];
        if (resource.parentId) {
            var parentNode = nodeHash[resource.parentId];
            if (parentNode) {
                insertResourceNodeInSiblings(nodeHash[resourceId], parentNode.children, orderSpecs);
            }
        }
    }
    return nodeHash;
}
function insertResourceNode(resourceNode, nodes, groupSpecs, depth, maxDepth, orderSpecs) {
    if (groupSpecs.length && (maxDepth === -1 || depth <= maxDepth)) {
        var groupNode = ensureGroupNodes(resourceNode, nodes, groupSpecs[0]);
        insertResourceNode(resourceNode, groupNode.children, groupSpecs.slice(1), depth + 1, maxDepth, orderSpecs);
    }
    else {
        insertResourceNodeInSiblings(resourceNode, nodes, orderSpecs);
    }
}
function ensureGroupNodes(resourceNode, nodes, groupSpec) {
    var groupValue = resourceNode.resourceFields[groupSpec.field];
    var groupNode;
    var newGroupIndex;
    // find an existing group that matches, or determine the position for a new group
    if (groupSpec.order) {
        for (newGroupIndex = 0; newGroupIndex < nodes.length; newGroupIndex += 1) {
            var node = nodes[newGroupIndex];
            if (node.group) {
                var cmp = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.flexibleCompare)(groupValue, node.group.value) * groupSpec.order;
                if (cmp === 0) {
                    groupNode = node;
                    break;
                }
                else if (cmp < 0) {
                    break;
                }
            }
        }
    }
    else { // the groups are unordered
        for (newGroupIndex = 0; newGroupIndex < nodes.length; newGroupIndex += 1) {
            var node = nodes[newGroupIndex];
            if (node.group && groupValue === node.group.value) {
                groupNode = node;
                break;
            }
        }
    }
    if (!groupNode) {
        groupNode = {
            group: {
                value: groupValue,
                spec: groupSpec,
            },
            children: [],
        };
        nodes.splice(newGroupIndex, 0, groupNode);
    }
    return groupNode;
}
function insertResourceNodeInSiblings(resourceNode, siblings, orderSpecs) {
    var i;
    for (i = 0; i < siblings.length; i += 1) {
        var cmp = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.compareByFieldSpecs)(siblings[i].resourceFields, resourceNode.resourceFields, orderSpecs); // TODO: pass in ResourceApi?
        if (cmp > 0) { // went 1 past. insert at i
            break;
        }
    }
    siblings.splice(i, 0, resourceNode);
}
function buildResourceFields(resource) {
    var obj = (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({}, resource.extendedProps), resource.ui), resource);
    delete obj.ui;
    delete obj.extendedProps;
    return obj;
}
function isGroupsEqual(group0, group1) {
    return group0.spec === group1.spec && group0.value === group1.value;
}

var main = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createPlugin)({
    deps: [
        _fullcalendar_premium_common__WEBPACK_IMPORTED_MODULE_1__["default"],
    ],
    reducers: [
        reduceResources,
    ],
    isLoadingFuncs: [
        function (state) { return state.resourceSource && state.resourceSource.isFetching; },
    ],
    eventRefiners: EVENT_REFINERS,
    eventDefMemberAdders: [generateEventDefResourceMembers],
    isDraggableTransformers: [transformIsDraggable],
    eventDragMutationMassagers: [massageEventDragMutation],
    eventDefMutationAppliers: [applyEventDefMutation],
    dateSelectionTransformers: [transformDateSelectionJoin],
    datePointTransforms: [transformDatePoint],
    dateSpanTransforms: [transformDateSpan],
    viewPropsTransformers: [ResourceDataAdder, ResourceEventConfigAdder],
    isPropsValid: isPropsValidWithResources,
    externalDefTransforms: [transformExternalDef],
    eventDropTransformers: [transformEventDrop],
    optionChangeHandlers: optionChangeHandlers,
    optionRefiners: OPTION_REFINERS,
    listenerRefiners: LISTENER_REFINERS,
    propSetHandlers: { resourceStore: handleResourceStore },
});

/* harmony default export */ __webpack_exports__["default"] = (main);

//# sourceMappingURL=main.js.map


/***/ }),

/***/ "./node_modules/@fullcalendar/resource-timeline/main.js":
/*!**************************************************************!*\
  !*** ./node_modules/@fullcalendar/resource-timeline/main.js ***!
  \**************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ResourceTimelineLane": function() { return /* binding */ ResourceTimelineLane; },
/* harmony export */   "ResourceTimelineView": function() { return /* binding */ ResourceTimelineView; },
/* harmony export */   "SpreadsheetRow": function() { return /* binding */ SpreadsheetRow; }
/* harmony export */ });
/* harmony import */ var _main_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./main.css */ "./node_modules/@fullcalendar/resource-timeline/main.css");
/* harmony import */ var _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @fullcalendar/common */ "./node_modules/@fullcalendar/common/main.js");
/* harmony import */ var _fullcalendar_premium_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @fullcalendar/premium-common */ "./node_modules/@fullcalendar/premium-common/main.js");
/* harmony import */ var _fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @fullcalendar/timeline */ "./node_modules/@fullcalendar/timeline/main.js");
/* harmony import */ var _fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @fullcalendar/resource-common */ "./node_modules/@fullcalendar/resource-common/main.js");
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _fullcalendar_scrollgrid__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @fullcalendar/scrollgrid */ "./node_modules/@fullcalendar/scrollgrid/main.js");
/*!
FullCalendar Scheduler v5.11.3
Docs & License: https://fullcalendar.io/scheduler
(c) 2022 Adam Shaw
*/









/*
Renders the DOM responsible for the subrow expander area,
as well as the space before it (used to align expanders of similar depths)
*/
function ExpanderIcon(_a) {
    var depth = _a.depth, hasChildren = _a.hasChildren, isExpanded = _a.isExpanded, onExpanderClick = _a.onExpanderClick;
    var nodes = [];
    for (var i = 0; i < depth; i += 1) {
        nodes.push((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: "fc-icon" }));
    }
    var iconClassNames = ['fc-icon'];
    if (hasChildren) {
        if (isExpanded) {
            iconClassNames.push('fc-icon-minus-square');
        }
        else {
            iconClassNames.push('fc-icon-plus-square');
        }
    }
    nodes.push((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: 'fc-datagrid-expander' + (hasChildren ? '' : ' fc-datagrid-expander-placeholder'), onClick: onExpanderClick },
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: iconClassNames.join(' ') })));
    return _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__spreadArray)([_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, {}], nodes));
}

function refineHookProps$1(raw) {
    return {
        resource: new _fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.ResourceApi(raw.context, raw.resource),
        fieldValue: raw.fieldValue,
        view: raw.context.viewApi,
    };
}

var SpreadsheetIndividualCellInner = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(SpreadsheetIndividualCellInner, _super);
    function SpreadsheetIndividualCellInner() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    SpreadsheetIndividualCellInner.prototype.render = function () {
        var props = this.props;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.ContentHook, { hookProps: props.hookProps, content: props.colSpec.cellContent, defaultContent: renderResourceInner }, function (innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: "fc-datagrid-cell-main", ref: innerElRef }, innerContent)); }));
    };
    return SpreadsheetIndividualCellInner;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
function renderResourceInner(hookProps) {
    return hookProps.fieldValue || (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, "\u00A0");
}

// worth making a PureComponent? (because of innerHeight)
var SpreadsheetIndividualCell = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(SpreadsheetIndividualCell, _super);
    function SpreadsheetIndividualCell() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.refineHookProps = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoizeObjArg)(refineHookProps$1);
        _this.normalizeClassNames = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.buildClassNameNormalizer)();
        _this.onExpanderClick = function (ev) {
            var props = _this.props;
            if (props.hasChildren) {
                _this.context.dispatch({
                    type: 'SET_RESOURCE_ENTITY_EXPANDED',
                    id: props.resource.id,
                    isExpanded: !props.isExpanded,
                });
            }
        };
        return _this;
    }
    SpreadsheetIndividualCell.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var colSpec = props.colSpec;
        var hookProps = this.refineHookProps({
            resource: props.resource,
            fieldValue: props.fieldValue,
            context: context,
        });
        var customClassNames = this.normalizeClassNames(colSpec.cellClassNames, hookProps);
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.MountHook, { hookProps: hookProps, didMount: colSpec.cellDidMount, willUnmount: colSpec.cellWillUnmount }, function (rootElRef) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("td", { ref: rootElRef, role: "gridcell", "data-resource-id": props.resource.id, className: [
                'fc-datagrid-cell',
                'fc-resource',
            ].concat(customClassNames).join(' ') },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-frame", style: { height: props.innerHeight } },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-cushion fc-scrollgrid-sync-inner" },
                    colSpec.isMain && ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(ExpanderIcon, { depth: props.depth, hasChildren: props.hasChildren, isExpanded: props.isExpanded, onExpanderClick: _this.onExpanderClick })),
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(SpreadsheetIndividualCellInner, { hookProps: hookProps, colSpec: colSpec }))))); }));
    };
    return SpreadsheetIndividualCell;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

// for VERTICAL cell grouping, in spreadsheet area
var SpreadsheetGroupCell = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(SpreadsheetGroupCell, _super);
    function SpreadsheetGroupCell() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    SpreadsheetGroupCell.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var colSpec = props.colSpec;
        var hookProps = {
            groupValue: props.fieldValue,
            view: context.viewApi,
        };
        // a grouped cell. no data that is specific to this specific resource
        // `colSpec` is for the group. a GroupSpec :(
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RenderHook, { hookProps: hookProps, classNames: colSpec.cellClassNames, content: colSpec.cellContent, defaultContent: renderGroupInner, didMount: colSpec.cellDidMount, willUnmount: colSpec.cellWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return (
        // TODO: make data-attr with group value?
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("td", { ref: rootElRef, role: "gridcell", rowSpan: props.rowSpan, className: ['fc-datagrid-cell', 'fc-resource-group'].concat(classNames).join(' ') },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-frame fc-datagrid-cell-frame-liquid" },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-cushion fc-sticky", ref: innerElRef }, innerContent)))); }));
    };
    return SpreadsheetGroupCell;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
function renderGroupInner(hookProps) {
    return hookProps.groupValue || (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, "\u00A0");
}

var SpreadsheetRow = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(SpreadsheetRow, _super);
    function SpreadsheetRow() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    SpreadsheetRow.prototype.render = function () {
        var props = this.props;
        var resource = props.resource, rowSpans = props.rowSpans, depth = props.depth;
        var resourceFields = (0,_fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.buildResourceFields)(resource); // slightly inefficient. already done up the call stack
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { role: "row" }, props.colSpecs.map(function (colSpec, i) {
            var rowSpan = rowSpans[i];
            if (rowSpan === 0) { // not responsible for group-based rows. VRowGroup is
                return null;
            }
            if (rowSpan == null) {
                rowSpan = 1;
            }
            var fieldValue = colSpec.field ? resourceFields[colSpec.field] :
                (resource.title || (0,_fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.getPublicId)(resource.id));
            if (rowSpan > 1) {
                return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(SpreadsheetGroupCell, { key: i, colSpec: colSpec, fieldValue: fieldValue, rowSpan: rowSpan }));
            }
            return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(SpreadsheetIndividualCell, { key: i, colSpec: colSpec, resource: resource, fieldValue: fieldValue, depth: depth, hasChildren: props.hasChildren, isExpanded: props.isExpanded, innerHeight: props.innerHeight }));
        })));
    };
    return SpreadsheetRow;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
SpreadsheetRow.addPropsEquality({
    rowSpans: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.isArraysEqual,
});

// for HORIZONTAL cell grouping, in spreadsheet area
var SpreadsheetGroupRow = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(SpreadsheetGroupRow, _super);
    function SpreadsheetGroupRow() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.innerInnerRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.onExpanderClick = function () {
            var props = _this.props;
            _this.context.dispatch({
                type: 'SET_RESOURCE_ENTITY_EXPANDED',
                id: props.id,
                isExpanded: !props.isExpanded,
            });
        };
        return _this;
    }
    SpreadsheetGroupRow.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var hookProps = { groupValue: props.group.value, view: context.viewApi };
        var spec = props.group.spec;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { role: "row" },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RenderHook, { hookProps: hookProps, classNames: spec.labelClassNames, content: spec.labelContent, defaultContent: renderCellInner, didMount: spec.labelDidMount, willUnmount: spec.labelWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("th", { ref: rootElRef, 
                // ARIA TODO: not really a columnheader
                // extremely tedious to make this aria-compliant,
                // to assign multiple headers to each cell
                // https://www.w3.org/WAI/tutorials/tables/multi-level/
                role: "columnheader", scope: "colgroup", colSpan: props.spreadsheetColCnt, className: [
                    'fc-datagrid-cell',
                    'fc-resource-group',
                    context.theme.getClass('tableCellShaded'),
                ].concat(classNames).join(' ') },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-frame", style: { height: props.innerHeight } },
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-cushion fc-scrollgrid-sync-inner", ref: _this.innerInnerRef },
                        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(ExpanderIcon, { depth: 0, hasChildren: true, isExpanded: props.isExpanded, onExpanderClick: _this.onExpanderClick }),
                        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: "fc-datagrid-cell-main", ref: innerElRef }, innerContent))))); })));
    };
    return SpreadsheetGroupRow;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
SpreadsheetGroupRow.addPropsEquality({
    group: _fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.isGroupsEqual,
});
function renderCellInner(hookProps) {
    return hookProps.groupValue || (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, "\u00A0");
}

var SPREADSHEET_COL_MIN_WIDTH = 20;
var SpreadsheetHeader = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(SpreadsheetHeader, _super);
    function SpreadsheetHeader() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.resizerElRefs = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RefMap(_this._handleColResizerEl.bind(_this));
        _this.colDraggings = {};
        return _this;
    }
    SpreadsheetHeader.prototype.render = function () {
        var _this = this;
        var _a = this.props, colSpecs = _a.colSpecs, superHeaderRendering = _a.superHeaderRendering, rowInnerHeights = _a.rowInnerHeights;
        var hookProps = { view: this.context.viewApi };
        var rowNodes = [];
        rowInnerHeights = rowInnerHeights.slice(); // copy, because we're gonna pop
        if (superHeaderRendering) {
            var rowInnerHeight_1 = rowInnerHeights.shift();
            rowNodes.push((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { key: "row-super", role: "row" },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RenderHook, { hookProps: hookProps, classNames: superHeaderRendering.headerClassNames, content: superHeaderRendering.headerContent, didMount: superHeaderRendering.headerDidMount, willUnmount: superHeaderRendering.headerWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("th", { ref: rootElRef, role: "columnheader", scope: "colgroup", colSpan: colSpecs.length, className: [
                        'fc-datagrid-cell',
                        'fc-datagrid-cell-super',
                    ].concat(classNames).join(' ') },
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-frame", style: { height: rowInnerHeight_1 } },
                        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-cushion fc-scrollgrid-sync-inner", ref: innerElRef }, innerContent)))); })));
        }
        var rowInnerHeight = rowInnerHeights.shift();
        rowNodes.push((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { key: "row", role: "row" }, colSpecs.map(function (colSpec, i) {
            var isLastCol = i === (colSpecs.length - 1);
            // need empty inner div for abs positioning for resizer
            return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RenderHook, { key: i, hookProps: hookProps, classNames: colSpec.headerClassNames, content: colSpec.headerContent, didMount: colSpec.headerDidMount, willUnmount: colSpec.headerWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("th", { ref: rootElRef, role: "columnheader", className: ['fc-datagrid-cell'].concat(classNames).join(' ') },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-frame", style: { height: rowInnerHeight } },
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-cushion fc-scrollgrid-sync-inner" },
                        colSpec.isMain && ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: "fc-datagrid-expander fc-datagrid-expander-placeholder" },
                            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: "fc-icon" }))),
                        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("span", { className: "fc-datagrid-cell-main", ref: innerElRef }, innerContent)),
                    !isLastCol &&
                        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-datagrid-cell-resizer", ref: _this.resizerElRefs.createRef(i) })))); }));
        })));
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, rowNodes));
    };
    SpreadsheetHeader.prototype._handleColResizerEl = function (resizerEl, index) {
        var colDraggings = this.colDraggings;
        if (!resizerEl) {
            var dragging = colDraggings[index];
            if (dragging) {
                dragging.destroy();
                delete colDraggings[index];
            }
        }
        else {
            var dragging = this.initColResizing(resizerEl, parseInt(index, 10));
            if (dragging) {
                colDraggings[index] = dragging;
            }
        }
    };
    SpreadsheetHeader.prototype.initColResizing = function (resizerEl, index) {
        var _a = this.context, pluginHooks = _a.pluginHooks, isRtl = _a.isRtl;
        var onColWidthChange = this.props.onColWidthChange;
        var ElementDraggingImpl = pluginHooks.elementDraggingImpl;
        if (ElementDraggingImpl) {
            var dragging = new ElementDraggingImpl(resizerEl);
            var startWidth_1; // of just the single column
            var currentWidths_1; // of all columns
            dragging.emitter.on('dragstart', function () {
                var allCells = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.findElements)((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.elementClosest)(resizerEl, 'tr'), 'th');
                currentWidths_1 = allCells.map(function (cellEl) { return (cellEl.getBoundingClientRect().width); });
                startWidth_1 = currentWidths_1[index];
            });
            dragging.emitter.on('dragmove', function (pev) {
                currentWidths_1[index] = Math.max(startWidth_1 + pev.deltaX * (isRtl ? -1 : 1), SPREADSHEET_COL_MIN_WIDTH);
                if (onColWidthChange) {
                    onColWidthChange(currentWidths_1.slice()); // send a copy since currentWidths continues to be mutated
                }
            });
            dragging.setAutoScrollEnabled(false); // because gets weird with auto-scrolling time area
            return dragging;
        }
        return null;
    };
    return SpreadsheetHeader;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var ResourceTimelineLaneMisc = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(ResourceTimelineLaneMisc, _super);
    function ResourceTimelineLaneMisc() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceTimelineLaneMisc.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var hookProps = { resource: new _fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.ResourceApi(context, props.resource) }; // just easier to make directly
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.ContentHook, { hookProps: hookProps, content: context.options.resourceLaneContent }, function (innerElRef, innerContent) { return (innerContent && // TODO: test how this would interfere with height
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-lane-misc", ref: innerElRef }, innerContent)); }));
    };
    return ResourceTimelineLaneMisc;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var ResourceTimelineLane = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(ResourceTimelineLane, _super);
    function ResourceTimelineLane() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.refineHookProps = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoizeObjArg)(refineHookProps);
        _this.normalizeClassNames = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.buildClassNameNormalizer)();
        _this.handleHeightChange = function (innerEl, isStable) {
            if (_this.props.onHeightChange) {
                _this.props.onHeightChange(
                // would want to use own <tr> ref, but not guaranteed to be ready when this fires
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.elementClosest)(innerEl, 'tr'), isStable);
            }
        };
        return _this;
    }
    ResourceTimelineLane.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var options = context.options;
        var hookProps = this.refineHookProps({ resource: props.resource, context: context });
        var customClassNames = this.normalizeClassNames(options.resourceLaneClassNames, hookProps);
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { ref: props.elRef },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.MountHook, { hookProps: hookProps, didMount: options.resourceLaneDidMount, willUnmount: options.resourceLaneWillUnmount }, function (rootElRef) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("td", { ref: rootElRef, className: ['fc-timeline-lane', 'fc-resource'].concat(customClassNames).join(' '), "data-resource-id": props.resource.id },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-lane-frame", style: { height: props.innerHeight } },
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(ResourceTimelineLaneMisc, { resource: props.resource }),
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__.TimelineLane, { dateProfile: props.dateProfile, tDateProfile: props.tDateProfile, nowDate: props.nowDate, todayRange: props.todayRange, nextDayThreshold: props.nextDayThreshold, businessHours: props.businessHours, eventStore: props.eventStore, eventUiBases: props.eventUiBases, dateSelection: props.dateSelection, eventSelection: props.eventSelection, eventDrag: props.eventDrag, eventResize: props.eventResize, timelineCoords: props.timelineCoords, onHeightChange: _this.handleHeightChange, resourceId: props.resource.id })))); }))); // important NOT to do liquid-height. dont want to shrink height smaller than content
    };
    return ResourceTimelineLane;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
function refineHookProps(raw) {
    return {
        resource: new _fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.ResourceApi(raw.context, raw.resource),
    };
}

/*
parallels the SpreadsheetGroupRow
*/
var DividerRow = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(DividerRow, _super);
    function DividerRow() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    DividerRow.prototype.render = function () {
        var _this = this;
        var props = this.props;
        var renderingHooks = this.props.renderingHooks;
        var hookProps = { groupValue: props.groupValue, view: this.context.viewApi };
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { ref: props.elRef },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RenderHook, { hookProps: hookProps, classNames: renderingHooks.laneClassNames, content: renderingHooks.laneContent, didMount: renderingHooks.laneDidMount, willUnmount: renderingHooks.laneWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("td", { ref: rootElRef, className: [
                    'fc-timeline-lane',
                    'fc-resource-group',
                    _this.context.theme.getClass('tableCellShaded'),
                ].concat(classNames).join(' ') },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { style: { height: props.innerHeight }, ref: innerElRef }, innerContent))); })));
    };
    return DividerRow;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var ResourceTimelineLanesBody = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(ResourceTimelineLanesBody, _super);
    function ResourceTimelineLanesBody() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceTimelineLanesBody.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var rowElRefs = props.rowElRefs, innerHeights = props.innerHeights;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tbody", null, props.rowNodes.map(function (node, index) {
            if (node.group) {
                return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(DividerRow, { key: node.id, elRef: rowElRefs.createRef(node.id), groupValue: node.group.value, renderingHooks: node.group.spec, innerHeight: innerHeights[index] || '' }));
            }
            if (node.resource) {
                var resource = node.resource;
                return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(ResourceTimelineLane, (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__assign)({ key: node.id, elRef: rowElRefs.createRef(node.id) }, props.splitProps[resource.id], { resource: resource, dateProfile: props.dateProfile, tDateProfile: props.tDateProfile, nowDate: props.nowDate, todayRange: props.todayRange, nextDayThreshold: context.options.nextDayThreshold, businessHours: resource.businessHours || props.fallbackBusinessHours, innerHeight: innerHeights[index] || '', timelineCoords: props.slatCoords, onHeightChange: props.onRowHeightChange })));
            }
            return null;
        })));
    };
    return ResourceTimelineLanesBody;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var ResourceTimelineLanes = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(ResourceTimelineLanes, _super);
    function ResourceTimelineLanes() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.rootElRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.rowElRefs = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RefMap();
        return _this;
    }
    ResourceTimelineLanes.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("table", { ref: this.rootElRef, "aria-hidden": true, className: 'fc-scrollgrid-sync-table ' + context.theme.getClass('table'), style: {
                minWidth: props.tableMinWidth,
                width: props.clientWidth,
                height: props.minHeight,
            } },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(ResourceTimelineLanesBody, { rowElRefs: this.rowElRefs, rowNodes: props.rowNodes, dateProfile: props.dateProfile, tDateProfile: props.tDateProfile, nowDate: props.nowDate, todayRange: props.todayRange, splitProps: props.splitProps, fallbackBusinessHours: props.fallbackBusinessHours, slatCoords: props.slatCoords, innerHeights: props.innerHeights, onRowHeightChange: props.onRowHeightChange })));
    };
    ResourceTimelineLanes.prototype.componentDidMount = function () {
        this.updateCoords();
    };
    ResourceTimelineLanes.prototype.componentDidUpdate = function () {
        this.updateCoords();
    };
    ResourceTimelineLanes.prototype.componentWillUnmount = function () {
        if (this.props.onRowCoords) {
            this.props.onRowCoords(null);
        }
    };
    ResourceTimelineLanes.prototype.updateCoords = function () {
        var props = this.props;
        if (props.onRowCoords && props.clientWidth !== null) { // a populated clientWidth means sizing has stabilized
            this.props.onRowCoords(new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.PositionCache(this.rootElRef.current, collectRowEls(this.rowElRefs.currentMap, props.rowNodes), false, true));
        }
    };
    return ResourceTimelineLanes;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
function collectRowEls(elMap, rowNodes) {
    return rowNodes.map(function (rowNode) { return elMap[rowNode.id]; });
}

var ResourceTimelineGrid = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(ResourceTimelineGrid, _super);
    function ResourceTimelineGrid() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.computeHasResourceBusinessHours = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(computeHasResourceBusinessHours);
        _this.resourceSplitter = new _fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.ResourceSplitter(); // doesn't let it do businessHours tho
        _this.bgSlicer = new _fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__.TimelineLaneSlicer();
        _this.slatsRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)(); // needed for Hit creation :(
        _this.state = {
            slatCoords: null,
        };
        _this.handleEl = function (el) {
            if (el) {
                _this.context.registerInteractiveComponent(_this, { el: el });
            }
            else {
                _this.context.unregisterInteractiveComponent(_this);
            }
        };
        _this.handleSlatCoords = function (slatCoords) {
            _this.setState({ slatCoords: slatCoords });
            if (_this.props.onSlatCoords) {
                _this.props.onSlatCoords(slatCoords);
            }
        };
        _this.handleRowCoords = function (rowCoords) {
            _this.rowCoords = rowCoords;
            if (_this.props.onRowCoords) {
                _this.props.onRowCoords(rowCoords);
            }
        };
        return _this;
    }
    ResourceTimelineGrid.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var dateProfile = props.dateProfile, tDateProfile = props.tDateProfile;
        var timerUnit = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.greatestDurationDenominator)(tDateProfile.slotDuration).unit;
        var hasResourceBusinessHours = this.computeHasResourceBusinessHours(props.rowNodes);
        var splitProps = this.resourceSplitter.splitProps(props);
        var bgLaneProps = splitProps[''];
        var bgSlicedProps = this.bgSlicer.sliceProps(bgLaneProps, dateProfile, tDateProfile.isTimeScale ? null : props.nextDayThreshold, context, // wish we didn't need to pass in the rest of these args...
        dateProfile, context.dateProfileGenerator, tDateProfile, context.dateEnv);
        // WORKAROUND: make ignore slatCoords when out of sync with dateProfile
        var slatCoords = state.slatCoords && state.slatCoords.dateProfile === props.dateProfile ? state.slatCoords : null;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: this.handleEl, className: [
                'fc-timeline-body',
                props.expandRows ? 'fc-timeline-body-expandrows' : '',
            ].join(' '), style: { minWidth: props.tableMinWidth } },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.NowTimer, { unit: timerUnit }, function (nowDate, todayRange) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null,
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__.TimelineSlats, { ref: _this.slatsRef, dateProfile: dateProfile, tDateProfile: tDateProfile, nowDate: nowDate, todayRange: todayRange, clientWidth: props.clientWidth, tableColGroupNode: props.tableColGroupNode, tableMinWidth: props.tableMinWidth, onCoords: _this.handleSlatCoords, onScrollLeftRequest: props.onScrollLeftRequest }),
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__.TimelineLaneBg, { businessHourSegs: hasResourceBusinessHours ? null : bgSlicedProps.businessHourSegs, bgEventSegs: bgSlicedProps.bgEventSegs, timelineCoords: slatCoords, 
                    // empty array will result in unnecessary rerenders?
                    eventResizeSegs: (bgSlicedProps.eventResize ? bgSlicedProps.eventResize.segs : []), dateSelectionSegs: bgSlicedProps.dateSelectionSegs, nowDate: nowDate, todayRange: todayRange }),
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(ResourceTimelineLanes, { rowNodes: props.rowNodes, dateProfile: dateProfile, tDateProfile: props.tDateProfile, nowDate: nowDate, todayRange: todayRange, splitProps: splitProps, fallbackBusinessHours: hasResourceBusinessHours ? props.businessHours : null, clientWidth: props.clientWidth, minHeight: props.expandRows ? props.clientHeight : '', tableMinWidth: props.tableMinWidth, innerHeights: props.rowInnerHeights, slatCoords: slatCoords, onRowCoords: _this.handleRowCoords, onRowHeightChange: props.onRowHeightChange }),
                (context.options.nowIndicator && slatCoords && slatCoords.isDateInRange(nowDate)) && ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-now-indicator-container" },
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.NowIndicatorRoot, { isAxis: false, date: nowDate }, function (rootElRef, classNames, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: rootElRef, className: ['fc-timeline-now-indicator-line'].concat(classNames).join(' '), style: (0,_fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__.coordToCss)(slatCoords.dateToCoord(nowDate), context.isRtl) }, innerContent)); }))))); })));
    };
    // Hit System
    // ------------------------------------------------------------------------------------------
    ResourceTimelineGrid.prototype.queryHit = function (positionLeft, positionTop) {
        var rowCoords = this.rowCoords;
        var rowIndex = rowCoords.topToIndex(positionTop);
        if (rowIndex != null) {
            var resource = this.props.rowNodes[rowIndex].resource;
            if (resource) { // not a group
                var slatHit = this.slatsRef.current.positionToHit(positionLeft);
                if (slatHit) {
                    return {
                        dateProfile: this.props.dateProfile,
                        dateSpan: {
                            range: slatHit.dateSpan.range,
                            allDay: slatHit.dateSpan.allDay,
                            resourceId: resource.id,
                        },
                        rect: {
                            left: slatHit.left,
                            right: slatHit.right,
                            top: rowCoords.tops[rowIndex],
                            bottom: rowCoords.bottoms[rowIndex],
                        },
                        dayEl: slatHit.dayEl,
                        layer: 0,
                    };
                }
            }
        }
        return null;
    };
    return ResourceTimelineGrid;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.DateComponent));
function computeHasResourceBusinessHours(rowNodes) {
    for (var _i = 0, rowNodes_1 = rowNodes; _i < rowNodes_1.length; _i++) {
        var node = rowNodes_1[_i];
        var resource = node.resource;
        if (resource && resource.businessHours) {
            return true;
        }
    }
    return false;
}

var MIN_RESOURCE_AREA_WIDTH = 30; // definitely bigger than scrollbars
// RENAME?
var ResourceTimelineViewLayout = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(ResourceTimelineViewLayout, _super);
    function ResourceTimelineViewLayout() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.scrollGridRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.timeBodyScrollerElRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.spreadsheetHeaderChunkElRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.rootElRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.ensureScrollGridResizeId = 0;
        _this.state = {
            resourceAreaWidthOverride: null,
        };
        /*
        ghetto debounce. don't race with ScrollGrid's resizing delay. solves #6140
        */
        _this.ensureScrollGridResize = function () {
            if (_this.ensureScrollGridResizeId) {
                clearTimeout(_this.ensureScrollGridResizeId);
            }
            _this.ensureScrollGridResizeId = setTimeout(function () {
                _this.scrollGridRef.current.handleSizing(false);
            }, _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.config.SCROLLGRID_RESIZE_INTERVAL + 1);
        };
        return _this;
    }
    ResourceTimelineViewLayout.prototype.render = function () {
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var options = context.options;
        var stickyHeaderDates = !props.forPrint && (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getStickyHeaderDates)(options);
        var stickyFooterScrollbar = !props.forPrint && (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getStickyFooterScrollbar)(options);
        var sections = [
            {
                type: 'header',
                key: 'header',
                syncRowHeights: true,
                isSticky: stickyHeaderDates,
                chunks: [
                    {
                        key: 'datagrid',
                        elRef: this.spreadsheetHeaderChunkElRef,
                        // TODO: allow the content to specify this. have general-purpose 'content' with obj with keys
                        tableClassName: 'fc-datagrid-header',
                        rowContent: props.spreadsheetHeaderRows,
                    },
                    {
                        key: 'divider',
                        outerContent: ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("td", { role: "presentation", className: 'fc-resource-timeline-divider ' + context.theme.getClass('tableCellShaded') })),
                    },
                    {
                        key: 'timeline',
                        content: props.timeHeaderContent,
                    },
                ],
            },
            {
                type: 'body',
                key: 'body',
                syncRowHeights: true,
                liquid: true,
                expandRows: Boolean(options.expandRows),
                chunks: [
                    {
                        key: 'datagrid',
                        tableClassName: 'fc-datagrid-body',
                        rowContent: props.spreadsheetBodyRows,
                    },
                    {
                        key: 'divider',
                        outerContent: ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("td", { role: "presentation", className: 'fc-resource-timeline-divider ' + context.theme.getClass('tableCellShaded') })),
                    },
                    {
                        key: 'timeline',
                        scrollerElRef: this.timeBodyScrollerElRef,
                        content: props.timeBodyContent,
                    },
                ],
            },
        ];
        if (stickyFooterScrollbar) {
            sections.push({
                type: 'footer',
                key: 'footer',
                isSticky: true,
                chunks: [
                    {
                        key: 'datagrid',
                        content: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.renderScrollShim,
                    },
                    {
                        key: 'divider',
                        outerContent: ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("td", { role: "presentation", className: 'fc-resource-timeline-divider ' + context.theme.getClass('tableCellShaded') })),
                    },
                    {
                        key: 'timeline',
                        content: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.renderScrollShim,
                    },
                ],
            });
        }
        var resourceAreaWidth = state.resourceAreaWidthOverride != null
            ? state.resourceAreaWidthOverride
            : options.resourceAreaWidth;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_scrollgrid__WEBPACK_IMPORTED_MODULE_5__.ScrollGrid, { ref: this.scrollGridRef, elRef: this.rootElRef, liquid: !props.isHeightAuto && !props.forPrint, collapsibleWidth: false, colGroups: [
                { cols: props.spreadsheetCols, width: resourceAreaWidth },
                { cols: [] },
                { cols: props.timeCols },
            ], sections: sections }));
    };
    ResourceTimelineViewLayout.prototype.forceTimeScroll = function (left) {
        var scrollGrid = this.scrollGridRef.current;
        scrollGrid.forceScrollLeft(2, left); // 2 = the time area
    };
    ResourceTimelineViewLayout.prototype.forceResourceScroll = function (top) {
        var scrollGrid = this.scrollGridRef.current;
        scrollGrid.forceScrollTop(1, top); // 1 = the body
    };
    ResourceTimelineViewLayout.prototype.getResourceScroll = function () {
        var timeBodyScrollerEl = this.timeBodyScrollerElRef.current;
        return timeBodyScrollerEl.scrollTop;
    };
    // Resource Area Resizing
    // ------------------------------------------------------------------------------------------
    // NOTE: a callback Ref for the resizer was firing multiple times with same elements (Preact)
    // that's why we use spreadsheetResizerElRef instead
    ResourceTimelineViewLayout.prototype.componentDidMount = function () {
        this.initSpreadsheetResizing();
    };
    ResourceTimelineViewLayout.prototype.componentWillUnmount = function () {
        this.destroySpreadsheetResizing();
    };
    ResourceTimelineViewLayout.prototype.initSpreadsheetResizing = function () {
        var _this = this;
        var _a = this.context, isRtl = _a.isRtl, pluginHooks = _a.pluginHooks;
        var ElementDraggingImpl = pluginHooks.elementDraggingImpl;
        var spreadsheetHeadEl = this.spreadsheetHeaderChunkElRef.current;
        if (ElementDraggingImpl) {
            var rootEl_1 = this.rootElRef.current;
            var dragging = this.spreadsheetResizerDragging = new ElementDraggingImpl(rootEl_1, '.fc-resource-timeline-divider');
            var dragStartWidth_1;
            var viewWidth_1;
            dragging.emitter.on('dragstart', function () {
                dragStartWidth_1 = spreadsheetHeadEl.getBoundingClientRect().width;
                viewWidth_1 = rootEl_1.getBoundingClientRect().width;
            });
            dragging.emitter.on('dragmove', function (pev) {
                var newWidth = dragStartWidth_1 + pev.deltaX * (isRtl ? -1 : 1);
                newWidth = Math.max(newWidth, MIN_RESOURCE_AREA_WIDTH);
                newWidth = Math.min(newWidth, viewWidth_1 - MIN_RESOURCE_AREA_WIDTH);
                // scrollgrid will ignore resize requests if there are too many :|
                _this.setState({
                    resourceAreaWidthOverride: newWidth,
                }, _this.ensureScrollGridResize);
            });
            dragging.setAutoScrollEnabled(false); // because gets weird with auto-scrolling time area
        }
    };
    ResourceTimelineViewLayout.prototype.destroySpreadsheetResizing = function () {
        if (this.spreadsheetResizerDragging) {
            this.spreadsheetResizerDragging.destroy();
        }
    };
    return ResourceTimelineViewLayout;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var ResourceTimelineView = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_6__.__extends)(ResourceTimelineView, _super);
    function ResourceTimelineView(props, context) {
        var _this = _super.call(this, props, context) || this;
        _this.processColOptions = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(processColOptions);
        _this.buildTimelineDateProfile = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(_fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__.buildTimelineDateProfile);
        _this.hasNesting = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(hasNesting);
        _this.buildRowNodes = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(_fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.buildRowNodes);
        _this.layoutRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.rowNodes = [];
        _this.renderedRowNodes = [];
        _this.buildRowIndex = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(buildRowIndex);
        _this.handleSlatCoords = function (slatCoords) {
            _this.setState({ slatCoords: slatCoords });
        };
        _this.handleRowCoords = function (rowCoords) {
            _this.rowCoords = rowCoords;
            _this.scrollResponder.update(false); // TODO: could eliminate this if rowCoords lived in state
        };
        _this.handleMaxCushionWidth = function (slotCushionMaxWidth) {
            _this.setState({
                slotCushionMaxWidth: Math.ceil(slotCushionMaxWidth), // for less rerendering TODO: DRY
            });
        };
        // Scrolling
        // ------------------------------------------------------------------------------------------------------------------
        // this is useful for scrolling prev/next dates while resource is scrolled down
        _this.handleScrollLeftRequest = function (scrollLeft) {
            var layout = _this.layoutRef.current;
            layout.forceTimeScroll(scrollLeft);
        };
        _this.handleScrollRequest = function (request) {
            var rowCoords = _this.rowCoords;
            var layout = _this.layoutRef.current;
            var rowId = request.rowId || request.resourceId;
            if (rowCoords) {
                if (rowId) {
                    var rowIdToIndex = _this.buildRowIndex(_this.renderedRowNodes);
                    var index = rowIdToIndex[rowId];
                    if (index != null) {
                        var scrollTop = (request.fromBottom != null ?
                            rowCoords.bottoms[index] - request.fromBottom : // pixels from bottom edge
                            rowCoords.tops[index] // just use top edge
                        );
                        layout.forceResourceScroll(scrollTop);
                    }
                }
                return true;
            }
            return null;
        };
        // Resource INDIVIDUAL-Column Area Resizing
        // ------------------------------------------------------------------------------------------
        _this.handleColWidthChange = function (colWidths) {
            _this.setState({
                spreadsheetColWidths: colWidths,
            });
        };
        _this.state = {
            resourceAreaWidth: context.options.resourceAreaWidth,
            spreadsheetColWidths: [],
        };
        return _this;
    }
    ResourceTimelineView.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var options = context.options, viewSpec = context.viewSpec;
        var _b = this.processColOptions(context.options), superHeaderRendering = _b.superHeaderRendering, groupSpecs = _b.groupSpecs, orderSpecs = _b.orderSpecs, isVGrouping = _b.isVGrouping, colSpecs = _b.colSpecs;
        var tDateProfile = this.buildTimelineDateProfile(props.dateProfile, context.dateEnv, options, context.dateProfileGenerator);
        var rowNodes = this.rowNodes = this.buildRowNodes(props.resourceStore, groupSpecs, orderSpecs, isVGrouping, props.resourceEntityExpansions, options.resourcesInitiallyExpanded);
        var extraClassNames = [
            'fc-resource-timeline',
            this.hasNesting(rowNodes) ? '' : 'fc-resource-timeline-flat',
            'fc-timeline',
            options.eventOverlap === false ? 'fc-timeline-overlap-disabled' : 'fc-timeline-overlap-enabled',
        ];
        var slotMinWidth = options.slotMinWidth;
        var slatCols = (0,_fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__.buildSlatCols)(tDateProfile, slotMinWidth || this.computeFallbackSlotMinWidth(tDateProfile));
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.ViewRoot, { viewSpec: viewSpec }, function (rootElRef, classNames) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: rootElRef, className: extraClassNames.concat(classNames).join(' ') },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(ResourceTimelineViewLayout, { ref: _this.layoutRef, forPrint: props.forPrint, isHeightAuto: props.isHeightAuto, spreadsheetCols: buildSpreadsheetCols(colSpecs, state.spreadsheetColWidths, ''), spreadsheetHeaderRows: function (contentArg) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(SpreadsheetHeader // TODO: rename to SpreadsheetHeaderRows
                , { superHeaderRendering: superHeaderRendering, colSpecs: colSpecs, onColWidthChange: _this.handleColWidthChange, rowInnerHeights: contentArg.rowSyncHeights })); }, spreadsheetBodyRows: function (contentArg) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, _this.renderSpreadsheetRows(rowNodes, colSpecs, contentArg.rowSyncHeights))); }, timeCols: slatCols, timeHeaderContent: function (contentArg) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__.TimelineHeader, { clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, tableMinWidth: contentArg.tableMinWidth, tableColGroupNode: contentArg.tableColGroupNode, dateProfile: props.dateProfile, tDateProfile: tDateProfile, slatCoords: state.slatCoords, rowInnerHeights: contentArg.rowSyncHeights, onMaxCushionWidth: slotMinWidth ? null : _this.handleMaxCushionWidth })); }, timeBodyContent: function (contentArg) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(ResourceTimelineGrid, { dateProfile: props.dateProfile, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, tableMinWidth: contentArg.tableMinWidth, tableColGroupNode: contentArg.tableColGroupNode, expandRows: contentArg.expandRows, tDateProfile: tDateProfile, rowNodes: rowNodes, businessHours: props.businessHours, dateSelection: props.dateSelection, eventStore: props.eventStore, eventUiBases: props.eventUiBases, eventSelection: props.eventSelection, eventDrag: props.eventDrag, eventResize: props.eventResize, resourceStore: props.resourceStore, nextDayThreshold: context.options.nextDayThreshold, rowInnerHeights: contentArg.rowSyncHeights, onSlatCoords: _this.handleSlatCoords, onRowCoords: _this.handleRowCoords, onScrollLeftRequest: _this.handleScrollLeftRequest, onRowHeightChange: contentArg.reportRowHeightChange })); } }))); }));
    };
    ResourceTimelineView.prototype.renderSpreadsheetRows = function (nodes, colSpecs, rowSyncHeights) {
        return nodes.map(function (node, index) {
            if (node.group) {
                return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(SpreadsheetGroupRow, { key: node.id, id: node.id, spreadsheetColCnt: colSpecs.length, isExpanded: node.isExpanded, group: node.group, innerHeight: rowSyncHeights[index] || '' }));
            }
            if (node.resource) {
                return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(SpreadsheetRow, { key: node.id, colSpecs: colSpecs, rowSpans: node.rowSpans, depth: node.depth, isExpanded: node.isExpanded, hasChildren: node.hasChildren, resource: node.resource, innerHeight: rowSyncHeights[index] || '' }));
            }
            return null;
        });
    };
    ResourceTimelineView.prototype.componentDidMount = function () {
        this.renderedRowNodes = this.rowNodes;
        this.scrollResponder = this.context.createScrollResponder(this.handleScrollRequest);
    };
    ResourceTimelineView.prototype.getSnapshotBeforeUpdate = function () {
        if (!this.props.forPrint) { // because print-view is always zero?
            return { resourceScroll: this.queryResourceScroll() };
        }
        return {};
    };
    ResourceTimelineView.prototype.componentDidUpdate = function (prevProps, prevState, snapshot) {
        this.renderedRowNodes = this.rowNodes;
        this.scrollResponder.update(prevProps.dateProfile !== this.props.dateProfile);
        if (snapshot.resourceScroll) {
            this.handleScrollRequest(snapshot.resourceScroll); // TODO: this gets triggered too often
        }
    };
    ResourceTimelineView.prototype.componentWillUnmount = function () {
        this.scrollResponder.detach();
    };
    ResourceTimelineView.prototype.computeFallbackSlotMinWidth = function (tDateProfile) {
        return Math.max(30, ((this.state.slotCushionMaxWidth || 0) / tDateProfile.slotsPerLabel));
    };
    ResourceTimelineView.prototype.queryResourceScroll = function () {
        var _a = this, rowCoords = _a.rowCoords, renderedRowNodes = _a.renderedRowNodes;
        if (rowCoords) {
            var layout = this.layoutRef.current;
            var trBottoms = rowCoords.bottoms;
            var scrollTop = layout.getResourceScroll();
            var scroll_1 = {};
            for (var i = 0; i < trBottoms.length; i += 1) {
                var rowNode = renderedRowNodes[i];
                var elBottom = trBottoms[i] - scrollTop; // from the top of the scroller
                if (elBottom > 0) {
                    scroll_1.rowId = rowNode.id;
                    scroll_1.fromBottom = elBottom;
                    break;
                }
            }
            return scroll_1;
        }
        return null;
    };
    return ResourceTimelineView;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
ResourceTimelineView.addStateEquality({
    spreadsheetColWidths: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.isArraysEqual,
});
function buildRowIndex(rowNodes) {
    var rowIdToIndex = {};
    for (var i = 0; i < rowNodes.length; i += 1) {
        rowIdToIndex[rowNodes[i].id] = i;
    }
    return rowIdToIndex;
}
function buildSpreadsheetCols(colSpecs, forcedWidths, fallbackWidth) {
    if (fallbackWidth === void 0) { fallbackWidth = ''; }
    return colSpecs.map(function (colSpec, i) { return ({
        className: colSpec.isMain ? 'fc-main-col' : '',
        width: forcedWidths[i] || colSpec.width || fallbackWidth,
    }); });
}
function hasNesting(nodes) {
    for (var _i = 0, nodes_1 = nodes; _i < nodes_1.length; _i++) {
        var node = nodes_1[_i];
        if (node.group) {
            return true;
        }
        if (node.resource) {
            if (node.hasChildren) {
                return true;
            }
        }
    }
    return false;
}
function processColOptions(options) {
    var allColSpecs = options.resourceAreaColumns || [];
    var superHeaderRendering = null;
    if (!allColSpecs.length) {
        allColSpecs.push({
            headerClassNames: options.resourceAreaHeaderClassNames,
            headerContent: options.resourceAreaHeaderContent || 'Resources',
            headerDidMount: options.resourceAreaHeaderDidMount,
            headerWillUnmount: options.resourceAreaHeaderWillUnmount,
        });
    }
    else if (options.resourceAreaHeaderContent) { // weird way to determine if content
        superHeaderRendering = {
            headerClassNames: options.resourceAreaHeaderClassNames,
            headerContent: options.resourceAreaHeaderContent,
            headerDidMount: options.resourceAreaHeaderDidMount,
            headerWillUnmount: options.resourceAreaHeaderWillUnmount,
        };
    }
    var plainColSpecs = [];
    var groupColSpecs = []; // part of the colSpecs, but filtered out in order to put first
    var groupSpecs = [];
    var isVGrouping = false;
    for (var _i = 0, allColSpecs_1 = allColSpecs; _i < allColSpecs_1.length; _i++) {
        var colSpec = allColSpecs_1[_i];
        if (colSpec.group) {
            groupColSpecs.push((0,tslib__WEBPACK_IMPORTED_MODULE_6__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_6__.__assign)({}, colSpec), { cellClassNames: colSpec.cellClassNames || options.resourceGroupLabelClassNames, cellContent: colSpec.cellContent || options.resourceGroupLabelContent, cellDidMount: colSpec.cellDidMount || options.resourceGroupLabelDidMount, cellWillUnmount: colSpec.cellWillUnmount || options.resourceGroupLaneWillUnmount }));
        }
        else {
            plainColSpecs.push(colSpec);
        }
    }
    // BAD: mutates a user-supplied option
    var mainColSpec = plainColSpecs[0];
    mainColSpec.isMain = true;
    mainColSpec.cellClassNames = mainColSpec.cellClassNames || options.resourceLabelClassNames;
    mainColSpec.cellContent = mainColSpec.cellContent || options.resourceLabelContent;
    mainColSpec.cellDidMount = mainColSpec.cellDidMount || options.resourceLabelDidMount;
    mainColSpec.cellWillUnmount = mainColSpec.cellWillUnmount || options.resourceLabelWillUnmount;
    if (groupColSpecs.length) {
        groupSpecs = groupColSpecs;
        isVGrouping = true;
    }
    else {
        var hGroupField = options.resourceGroupField;
        if (hGroupField) {
            groupSpecs.push({
                field: hGroupField,
                labelClassNames: options.resourceGroupLabelClassNames,
                labelContent: options.resourceGroupLabelContent,
                labelDidMount: options.resourceGroupLabelDidMount,
                labelWillUnmount: options.resourceGroupLabelWillUnmount,
                laneClassNames: options.resourceGroupLaneClassNames,
                laneContent: options.resourceGroupLaneContent,
                laneDidMount: options.resourceGroupLaneDidMount,
                laneWillUnmount: options.resourceGroupLaneWillUnmount,
            });
        }
    }
    var allOrderSpecs = options.resourceOrder || _fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__.DEFAULT_RESOURCE_ORDER;
    var plainOrderSpecs = [];
    for (var _a = 0, allOrderSpecs_1 = allOrderSpecs; _a < allOrderSpecs_1.length; _a++) {
        var orderSpec = allOrderSpecs_1[_a];
        var isGroup = false;
        for (var _b = 0, groupSpecs_1 = groupSpecs; _b < groupSpecs_1.length; _b++) {
            var groupSpec = groupSpecs_1[_b];
            if (groupSpec.field === orderSpec.field) {
                groupSpec.order = orderSpec.order; // -1, 0, 1
                isGroup = true;
                break;
            }
        }
        if (!isGroup) {
            plainOrderSpecs.push(orderSpec);
        }
    }
    return {
        superHeaderRendering: superHeaderRendering,
        isVGrouping: isVGrouping,
        groupSpecs: groupSpecs,
        colSpecs: groupColSpecs.concat(plainColSpecs),
        orderSpecs: plainOrderSpecs,
    };
}

var main = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createPlugin)({
    deps: [
        _fullcalendar_premium_common__WEBPACK_IMPORTED_MODULE_2__["default"],
        _fullcalendar_resource_common__WEBPACK_IMPORTED_MODULE_4__["default"],
        _fullcalendar_timeline__WEBPACK_IMPORTED_MODULE_3__["default"],
    ],
    initialView: 'resourceTimelineDay',
    views: {
        resourceTimeline: {
            type: 'timeline',
            component: ResourceTimelineView,
            needsResourceData: true,
            resourceAreaWidth: '30%',
            resourcesInitiallyExpanded: true,
            eventResizableFromStart: true, // TODO: not DRY with this same setting in the main timeline config
        },
        resourceTimelineDay: {
            type: 'resourceTimeline',
            duration: { days: 1 },
        },
        resourceTimelineWeek: {
            type: 'resourceTimeline',
            duration: { weeks: 1 },
        },
        resourceTimelineMonth: {
            type: 'resourceTimeline',
            duration: { months: 1 },
        },
        resourceTimelineYear: {
            type: 'resourceTimeline',
            duration: { years: 1 },
        },
    },
});

/* harmony default export */ __webpack_exports__["default"] = (main);

//# sourceMappingURL=main.js.map


/***/ }),

/***/ "./node_modules/@fullcalendar/scrollgrid/main.js":
/*!*******************************************************!*\
  !*** ./node_modules/@fullcalendar/scrollgrid/main.js ***!
  \*******************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ScrollGrid": function() { return /* binding */ ScrollGrid; },
/* harmony export */   "setScrollFromLeftEdge": function() { return /* binding */ setScrollFromLeftEdge; }
/* harmony export */ });
/* harmony import */ var _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @fullcalendar/common */ "./node_modules/@fullcalendar/common/main.js");
/* harmony import */ var _fullcalendar_premium_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @fullcalendar/premium-common */ "./node_modules/@fullcalendar/premium-common/main.js");
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/*!
FullCalendar Scheduler v5.11.3
Docs & License: https://fullcalendar.io/scheduler
(c) 2022 Adam Shaw
*/




var WHEEL_EVENT_NAMES = 'wheel mousewheel DomMouseScroll MozMousePixelScroll'.split(' ');
/*
ALSO, with the ability to disable touch
*/
var ScrollListener = /** @class */ (function () {
    function ScrollListener(el) {
        var _this = this;
        this.el = el;
        this.emitter = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Emitter();
        this.isScrolling = false;
        this.isTouching = false; // user currently has finger down?
        this.isRecentlyWheeled = false;
        this.isRecentlyScrolled = false;
        this.wheelWaiter = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.DelayedRunner(this._handleWheelWaited.bind(this));
        this.scrollWaiter = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.DelayedRunner(this._handleScrollWaited.bind(this));
        // Handlers
        // ----------------------------------------------------------------------------------------------
        this.handleScroll = function () {
            _this.startScroll();
            _this.emitter.trigger('scroll', _this.isRecentlyWheeled, _this.isTouching);
            _this.isRecentlyScrolled = true;
            _this.scrollWaiter.request(500);
        };
        // will fire *before* the scroll event is fired (might not cause a scroll)
        this.handleWheel = function () {
            _this.isRecentlyWheeled = true;
            _this.wheelWaiter.request(500);
        };
        // will fire *before* the scroll event is fired (might not cause a scroll)
        this.handleTouchStart = function () {
            _this.isTouching = true;
        };
        this.handleTouchEnd = function () {
            _this.isTouching = false;
            // if the user ended their touch, and the scroll area wasn't moving,
            // we consider this to be the end of the scroll.
            if (!_this.isRecentlyScrolled) {
                _this.endScroll(); // won't fire if already ended
            }
        };
        el.addEventListener('scroll', this.handleScroll);
        el.addEventListener('touchstart', this.handleTouchStart, { passive: true });
        el.addEventListener('touchend', this.handleTouchEnd);
        for (var _i = 0, WHEEL_EVENT_NAMES_1 = WHEEL_EVENT_NAMES; _i < WHEEL_EVENT_NAMES_1.length; _i++) {
            var eventName = WHEEL_EVENT_NAMES_1[_i];
            el.addEventListener(eventName, this.handleWheel);
        }
    }
    ScrollListener.prototype.destroy = function () {
        var el = this.el;
        el.removeEventListener('scroll', this.handleScroll);
        el.removeEventListener('touchstart', this.handleTouchStart, { passive: true });
        el.removeEventListener('touchend', this.handleTouchEnd);
        for (var _i = 0, WHEEL_EVENT_NAMES_2 = WHEEL_EVENT_NAMES; _i < WHEEL_EVENT_NAMES_2.length; _i++) {
            var eventName = WHEEL_EVENT_NAMES_2[_i];
            el.removeEventListener(eventName, this.handleWheel);
        }
    };
    // Start / Stop
    // ----------------------------------------------------------------------------------------------
    ScrollListener.prototype.startScroll = function () {
        if (!this.isScrolling) {
            this.isScrolling = true;
            this.emitter.trigger('scrollStart', this.isRecentlyWheeled, this.isTouching);
        }
    };
    ScrollListener.prototype.endScroll = function () {
        if (this.isScrolling) {
            this.emitter.trigger('scrollEnd');
            this.isScrolling = false;
            this.isRecentlyScrolled = true;
            this.isRecentlyWheeled = false;
            this.scrollWaiter.clear();
            this.wheelWaiter.clear();
        }
    };
    ScrollListener.prototype._handleScrollWaited = function () {
        this.isRecentlyScrolled = false;
        // only end the scroll if not currently touching.
        // if touching, the scrolling will end later, on touchend.
        if (!this.isTouching) {
            this.endScroll(); // won't fire if already ended
        }
    };
    ScrollListener.prototype._handleWheelWaited = function () {
        this.isRecentlyWheeled = false;
    };
    return ScrollListener;
}());

// TODO: assume the el has no borders?
function getScrollCanvasOrigin(scrollEl) {
    var rect = scrollEl.getBoundingClientRect();
    var edges = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.computeEdges)(scrollEl); // TODO: pass in isRtl?
    return {
        left: rect.left + edges.borderLeft + edges.scrollbarLeft - getScrollFromLeftEdge(scrollEl),
        top: rect.top + edges.borderTop - scrollEl.scrollTop,
    };
}
function getScrollFromLeftEdge(el) {
    var scrollLeft = el.scrollLeft;
    var computedStyles = window.getComputedStyle(el); // TODO: pass in isRtl instead?
    if (computedStyles.direction === 'rtl') {
        switch (getRtlScrollSystem()) {
            case 'negative':
                scrollLeft *= -1; // convert to 'reverse'. fall through...
            case 'reverse': // scrollLeft is distance between scrollframe's right edge scrollcanvas's right edge
                scrollLeft = el.scrollWidth - scrollLeft - el.clientWidth;
        }
    }
    return scrollLeft;
}
function setScrollFromLeftEdge(el, scrollLeft) {
    var computedStyles = window.getComputedStyle(el); // TODO: pass in isRtl instead?
    if (computedStyles.direction === 'rtl') {
        switch (getRtlScrollSystem()) {
            case 'reverse':
                scrollLeft = el.scrollWidth - scrollLeft;
                break;
            case 'negative':
                scrollLeft = -(el.scrollWidth - scrollLeft);
                break;
        }
    }
    el.scrollLeft = scrollLeft;
}
// Horizontal Scroll System Detection
// ----------------------------------------------------------------------------------------------
var _rtlScrollSystem;
function getRtlScrollSystem() {
    return _rtlScrollSystem || (_rtlScrollSystem = detectRtlScrollSystem());
}
function detectRtlScrollSystem() {
    var el = document.createElement('div');
    el.style.position = 'absolute';
    el.style.top = '-1000px';
    el.style.width = '1px';
    el.style.height = '1px';
    el.style.overflow = 'scroll';
    el.style.direction = 'rtl';
    el.style.fontSize = '100px';
    el.innerHTML = 'A';
    document.body.appendChild(el);
    var system;
    if (el.scrollLeft > 0) {
        system = 'positive'; // scroll is a positive number from the left edge
    }
    else {
        el.scrollLeft = 1;
        if (el.scrollLeft > 0) {
            system = 'reverse'; // scroll is a positive number from the right edge
        }
        else {
            system = 'negative'; // scroll is a negative number from the right edge
        }
    }
    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.removeElement)(el);
    return system;
}

var IS_MS_EDGE = typeof navigator !== 'undefined' && /Edge/.test(navigator.userAgent); // TODO: what about Chromeum-based Edge?
var STICKY_SELECTOR = '.fc-sticky';
/*
useful beyond the native position:sticky for these reasons:
- support in IE11
- nice centering support

REQUIREMENT: fc-sticky elements, if the fc-sticky className is taken away, should NOT have relative or absolute positioning.
This is because we attach the coords with JS, and the VDOM might take away the fc-sticky class but doesn't know kill the positioning.

TODO: don't query text-align:center. isn't compatible with flexbox centering. instead, check natural X coord within parent container
*/
var StickyScrolling = /** @class */ (function () {
    function StickyScrolling(scrollEl, isRtl) {
        var _this = this;
        this.scrollEl = scrollEl;
        this.isRtl = isRtl;
        this.usingRelative = null;
        this.updateSize = function () {
            var scrollEl = _this.scrollEl;
            var els = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.findElements)(scrollEl, STICKY_SELECTOR);
            var elGeoms = _this.queryElGeoms(els);
            var viewportWidth = scrollEl.clientWidth;
            var viewportHeight = scrollEl.clientHeight;
            if (_this.usingRelative) {
                var elDestinations = _this.computeElDestinations(elGeoms, viewportWidth); // read before prepPositioning
                assignRelativePositions(els, elGeoms, elDestinations, viewportWidth, viewportHeight);
            }
            else {
                assignStickyPositions(els, elGeoms, viewportWidth);
            }
        };
        this.usingRelative =
            !getStickySupported() || // IE11
                // https://stackoverflow.com/questions/56835658/in-microsoft-edge-sticky-positioning-doesnt-work-when-combined-with-dir-rtl
                (IS_MS_EDGE && isRtl);
        if (this.usingRelative) {
            this.listener = new ScrollListener(scrollEl);
            this.listener.emitter.on('scrollEnd', this.updateSize);
        }
    }
    StickyScrolling.prototype.destroy = function () {
        if (this.listener) {
            this.listener.destroy();
        }
    };
    StickyScrolling.prototype.queryElGeoms = function (els) {
        var _a = this, scrollEl = _a.scrollEl, isRtl = _a.isRtl;
        var canvasOrigin = getScrollCanvasOrigin(scrollEl);
        var elGeoms = [];
        for (var _i = 0, els_1 = els; _i < els_1.length; _i++) {
            var el = els_1[_i];
            var parentBound = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.translateRect)((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.computeInnerRect)(el.parentNode, true, true), // weird way to call this!!!
            -canvasOrigin.left, -canvasOrigin.top);
            var elRect = el.getBoundingClientRect();
            var computedStyles = window.getComputedStyle(el);
            var textAlign = window.getComputedStyle(el.parentNode).textAlign; // ask the parent
            var naturalBound = null;
            if (textAlign === 'start') {
                textAlign = isRtl ? 'right' : 'left';
            }
            else if (textAlign === 'end') {
                textAlign = isRtl ? 'left' : 'right';
            }
            if (computedStyles.position !== 'sticky') {
                naturalBound = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.translateRect)(elRect, -canvasOrigin.left - (parseFloat(computedStyles.left) || 0), // could be 'auto'
                -canvasOrigin.top - (parseFloat(computedStyles.top) || 0));
            }
            elGeoms.push({
                parentBound: parentBound,
                naturalBound: naturalBound,
                elWidth: elRect.width,
                elHeight: elRect.height,
                textAlign: textAlign,
            });
        }
        return elGeoms;
    };
    // only for IE
    StickyScrolling.prototype.computeElDestinations = function (elGeoms, viewportWidth) {
        var scrollEl = this.scrollEl;
        var viewportTop = scrollEl.scrollTop;
        var viewportLeft = getScrollFromLeftEdge(scrollEl);
        var viewportRight = viewportLeft + viewportWidth;
        return elGeoms.map(function (elGeom) {
            var elWidth = elGeom.elWidth, elHeight = elGeom.elHeight, parentBound = elGeom.parentBound, naturalBound = elGeom.naturalBound;
            var destLeft; // relative to canvas topleft
            var destTop; // "
            switch (elGeom.textAlign) {
                case 'left':
                    destLeft = viewportLeft;
                    break;
                case 'right':
                    destLeft = viewportRight - elWidth;
                    break;
                case 'center':
                    destLeft = (viewportLeft + viewportRight) / 2 - elWidth / 2; /// noooo, use half-width insteadddddddd
                    break;
            }
            destLeft = Math.min(destLeft, parentBound.right - elWidth);
            destLeft = Math.max(destLeft, parentBound.left);
            destTop = viewportTop;
            destTop = Math.min(destTop, parentBound.bottom - elHeight);
            destTop = Math.max(destTop, naturalBound.top); // better to use natural top for upper bound
            return { left: destLeft, top: destTop };
        });
    };
    return StickyScrolling;
}());
function assignRelativePositions(els, elGeoms, elDestinations, viewportWidth, viewportHeight) {
    els.forEach(function (el, i) {
        var _a = elGeoms[i], naturalBound = _a.naturalBound, parentBound = _a.parentBound;
        var parentWidth = parentBound.right - parentBound.left;
        var parentHeight = parentBound.bottom - parentBound.bottom;
        var left;
        var top;
        if (parentWidth > viewportWidth ||
            parentHeight > viewportHeight) {
            left = elDestinations[i].left - naturalBound.left;
            top = elDestinations[i].top - naturalBound.top;
        }
        else { // if parent container can be completely in view, we don't need stickiness
            left = '';
            top = '';
        }
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.applyStyle)(el, {
            position: 'relative',
            left: left,
            right: -left,
            top: top,
        });
    });
}
function assignStickyPositions(els, elGeoms, viewportWidth) {
    els.forEach(function (el, i) {
        var _a = elGeoms[i], textAlign = _a.textAlign, elWidth = _a.elWidth, parentBound = _a.parentBound;
        var parentWidth = parentBound.right - parentBound.left;
        var left;
        if (textAlign === 'center' &&
            parentWidth > viewportWidth) {
            left = (viewportWidth - elWidth) / 2;
        }
        else { // if parent container can be completely in view, we don't need stickiness
            left = '';
        }
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.applyStyle)(el, {
            left: left,
            right: left,
            top: 0,
        });
    });
}
var _isStickySupported;
function getStickySupported() {
    if (_isStickySupported == null) {
        _isStickySupported = computeStickySupported();
    }
    return _isStickySupported;
}
function computeStickySupported() {
    var el = document.createElement('div');
    el.style.position = 'sticky';
    document.body.appendChild(el);
    var val = window.getComputedStyle(el).position;
    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.removeElement)(el);
    return val === 'sticky';
}

var ClippedScroller = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ClippedScroller, _super);
    function ClippedScroller() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.elRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createRef)();
        _this.state = {
            xScrollbarWidth: 0,
            yScrollbarWidth: 0,
        };
        _this.handleScroller = function (scroller) {
            _this.scroller = scroller;
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.setRef)(_this.props.scrollerRef, scroller);
        };
        _this.handleSizing = function () {
            var props = _this.props;
            if (props.overflowY === 'scroll-hidden') {
                _this.setState({ yScrollbarWidth: _this.scroller.getYScrollbarWidth() });
            }
            if (props.overflowX === 'scroll-hidden') {
                _this.setState({ xScrollbarWidth: _this.scroller.getXScrollbarWidth() });
            }
        };
        return _this;
    }
    ClippedScroller.prototype.render = function () {
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var isScrollbarOnLeft = context.isRtl && (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getIsRtlScrollbarOnLeft)();
        var overcomeLeft = 0;
        var overcomeRight = 0;
        var overcomeBottom = 0;
        if (props.overflowX === 'scroll-hidden') {
            overcomeBottom = state.xScrollbarWidth;
        }
        if (props.overflowY === 'scroll-hidden') {
            if (state.yScrollbarWidth != null) {
                if (isScrollbarOnLeft) {
                    overcomeLeft = state.yScrollbarWidth;
                }
                else {
                    overcomeRight = state.yScrollbarWidth;
                }
            }
        }
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", { ref: this.elRef, className: 'fc-scroller-harness' + (props.liquid ? ' fc-scroller-harness-liquid' : '') },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Scroller, { ref: this.handleScroller, elRef: this.props.scrollerElRef, overflowX: props.overflowX === 'scroll-hidden' ? 'scroll' : props.overflowX, overflowY: props.overflowY === 'scroll-hidden' ? 'scroll' : props.overflowY, overcomeLeft: overcomeLeft, overcomeRight: overcomeRight, overcomeBottom: overcomeBottom, maxHeight: typeof props.maxHeight === 'number'
                    ? (props.maxHeight + (props.overflowX === 'scroll-hidden' ? state.xScrollbarWidth : 0))
                    : '', liquid: props.liquid, liquidIsAbsolute: true }, props.children)));
    };
    ClippedScroller.prototype.componentDidMount = function () {
        this.handleSizing();
        this.context.addResizeHandler(this.handleSizing);
    };
    ClippedScroller.prototype.componentDidUpdate = function (prevProps) {
        if (!(0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.isPropsEqual)(prevProps, this.props)) { // an external change?
            this.handleSizing();
        }
    };
    ClippedScroller.prototype.componentWillUnmount = function () {
        this.context.removeResizeHandler(this.handleSizing);
    };
    ClippedScroller.prototype.needsXScrolling = function () {
        return this.scroller.needsXScrolling();
    };
    ClippedScroller.prototype.needsYScrolling = function () {
        return this.scroller.needsYScrolling();
    };
    return ClippedScroller;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.BaseComponent));

var ScrollSyncer = /** @class */ (function () {
    function ScrollSyncer(isVertical, scrollEls) {
        var _this = this;
        this.isVertical = isVertical;
        this.scrollEls = scrollEls;
        this.isPaused = false;
        this.scrollListeners = scrollEls.map(function (el) { return _this.bindScroller(el); });
    }
    ScrollSyncer.prototype.destroy = function () {
        for (var _i = 0, _a = this.scrollListeners; _i < _a.length; _i++) {
            var scrollListener = _a[_i];
            scrollListener.destroy();
        }
    };
    ScrollSyncer.prototype.bindScroller = function (el) {
        var _this = this;
        var _a = this, scrollEls = _a.scrollEls, isVertical = _a.isVertical;
        var scrollListener = new ScrollListener(el);
        var onScroll = function (isWheel, isTouch) {
            if (!_this.isPaused) {
                if (!_this.masterEl || (_this.masterEl !== el && (isWheel || isTouch))) {
                    _this.assignMaster(el);
                }
                if (_this.masterEl === el) { // dealing with current
                    for (var _i = 0, scrollEls_1 = scrollEls; _i < scrollEls_1.length; _i++) {
                        var otherEl = scrollEls_1[_i];
                        if (otherEl !== el) {
                            if (isVertical) {
                                otherEl.scrollTop = el.scrollTop;
                            }
                            else {
                                otherEl.scrollLeft = el.scrollLeft;
                            }
                        }
                    }
                }
            }
        };
        var onScrollEnd = function () {
            if (_this.masterEl === el) {
                _this.masterEl = null;
            }
        };
        scrollListener.emitter.on('scroll', onScroll);
        scrollListener.emitter.on('scrollEnd', onScrollEnd);
        return scrollListener;
    };
    ScrollSyncer.prototype.assignMaster = function (el) {
        this.masterEl = el;
        for (var _i = 0, _a = this.scrollListeners; _i < _a.length; _i++) {
            var scrollListener = _a[_i];
            if (scrollListener.el !== el) {
                scrollListener.endScroll(); // to prevent residual scrolls from reclaiming master
            }
        }
    };
    /*
    will normalize the scrollLeft value
    */
    ScrollSyncer.prototype.forceScrollLeft = function (scrollLeft) {
        this.isPaused = true;
        for (var _i = 0, _a = this.scrollListeners; _i < _a.length; _i++) {
            var listener = _a[_i];
            setScrollFromLeftEdge(listener.el, scrollLeft);
        }
        this.isPaused = false;
    };
    ScrollSyncer.prototype.forceScrollTop = function (top) {
        this.isPaused = true;
        for (var _i = 0, _a = this.scrollListeners; _i < _a.length; _i++) {
            var listener = _a[_i];
            listener.el.scrollTop = top;
        }
        this.isPaused = false;
    };
    return ScrollSyncer;
}());

/*
TODO: make <ScrollGridSection> subcomponent
NOTE: doesn't support collapsibleWidth (which is sortof a hack anyway)
*/
var ScrollGrid = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__extends)(ScrollGrid, _super);
    function ScrollGrid() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.compileColGroupStats = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoizeArraylike)(compileColGroupStat, isColGroupStatsEqual);
        _this.renderMicroColGroups = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoizeArraylike)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.renderMicroColGroup); // yucky to memoize VNodes, but much more efficient for consumers
        _this.clippedScrollerRefs = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.RefMap();
        // doesn't hold non-scrolling els used just for padding
        _this.scrollerElRefs = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.RefMap(_this._handleScrollerEl.bind(_this));
        _this.chunkElRefs = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.RefMap(_this._handleChunkEl.bind(_this));
        _this.stickyScrollings = [];
        _this.scrollSyncersBySection = {};
        _this.scrollSyncersByColumn = {};
        // for row-height-syncing
        _this.rowUnstableMap = new Map(); // no need to groom. always self-cancels
        _this.rowInnerMaxHeightMap = new Map();
        _this.anyRowHeightsChanged = false;
        _this.recentSizingCnt = 0;
        _this.state = {
            shrinkWidths: [],
            forceYScrollbars: false,
            forceXScrollbars: false,
            scrollerClientWidths: {},
            scrollerClientHeights: {},
            sectionRowMaxHeights: [],
        };
        _this.handleSizing = function (isForcedResize, sectionRowMaxHeightsChanged) {
            if (!_this.allowSizing()) {
                return;
            }
            if (!sectionRowMaxHeightsChanged) { // something else changed, probably external
                _this.anyRowHeightsChanged = true;
            }
            var otherState = {};
            // if reacting to self-change of sectionRowMaxHeightsChanged, or not stable, don't do anything
            if (isForcedResize || (!sectionRowMaxHeightsChanged && !_this.rowUnstableMap.size)) {
                otherState.sectionRowMaxHeights = _this.computeSectionRowMaxHeights();
            }
            _this.setState((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__assign)({ shrinkWidths: _this.computeShrinkWidths() }, _this.computeScrollerDims()), otherState), function () {
                if (!_this.rowUnstableMap.size) {
                    _this.updateStickyScrolling(); // needs to happen AFTER final positioning committed to DOM
                }
            });
        };
        _this.handleRowHeightChange = function (rowEl, isStable) {
            var _a = _this, rowUnstableMap = _a.rowUnstableMap, rowInnerMaxHeightMap = _a.rowInnerMaxHeightMap;
            if (!isStable) {
                rowUnstableMap.set(rowEl, true);
            }
            else {
                rowUnstableMap.delete(rowEl);
                var innerMaxHeight = getRowInnerMaxHeight(rowEl);
                if (!rowInnerMaxHeightMap.has(rowEl) || rowInnerMaxHeightMap.get(rowEl) !== innerMaxHeight) {
                    rowInnerMaxHeightMap.set(rowEl, innerMaxHeight);
                    _this.anyRowHeightsChanged = true;
                }
                if (!rowUnstableMap.size && _this.anyRowHeightsChanged) {
                    _this.anyRowHeightsChanged = false;
                    _this.setState({
                        sectionRowMaxHeights: _this.computeSectionRowMaxHeights(),
                    });
                }
            }
        };
        return _this;
    }
    ScrollGrid.prototype.render = function () {
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var shrinkWidths = state.shrinkWidths;
        var colGroupStats = this.compileColGroupStats(props.colGroups.map(function (colGroup) { return [colGroup]; }));
        var microColGroupNodes = this.renderMicroColGroups(colGroupStats.map(function (stat, i) { return [stat.cols, shrinkWidths[i]]; }));
        var classNames = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getScrollGridClassNames)(props.liquid, context);
        var _b = this.getDims(); _b[0]; _b[1];
        // TODO: make DRY
        var sectionConfigs = props.sections;
        var configCnt = sectionConfigs.length;
        var configI = 0;
        var currentConfig;
        var headSectionNodes = [];
        var bodySectionNodes = [];
        var footSectionNodes = [];
        while (configI < configCnt && (currentConfig = sectionConfigs[configI]).type === 'header') {
            headSectionNodes.push(this.renderSection(currentConfig, configI, colGroupStats, microColGroupNodes, state.sectionRowMaxHeights, true));
            configI += 1;
        }
        while (configI < configCnt && (currentConfig = sectionConfigs[configI]).type === 'body') {
            bodySectionNodes.push(this.renderSection(currentConfig, configI, colGroupStats, microColGroupNodes, state.sectionRowMaxHeights, false));
            configI += 1;
        }
        while (configI < configCnt && (currentConfig = sectionConfigs[configI]).type === 'footer') {
            footSectionNodes.push(this.renderSection(currentConfig, configI, colGroupStats, microColGroupNodes, state.sectionRowMaxHeights, true));
            configI += 1;
        }
        var isBuggy = !(0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getCanVGrowWithinCell)(); // see NOTE in SimpleScrollGrid
        var roleAttrs = { role: 'rowgroup' };
        return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)('table', {
            ref: props.elRef,
            role: 'grid',
            className: classNames.join(' '),
        }, renderMacroColGroup(colGroupStats, shrinkWidths), Boolean(!isBuggy && headSectionNodes.length) && _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['thead', roleAttrs], headSectionNodes)), Boolean(!isBuggy && bodySectionNodes.length) && _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['tbody', roleAttrs], bodySectionNodes)), Boolean(!isBuggy && footSectionNodes.length) && _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['tfoot', roleAttrs], footSectionNodes)), isBuggy && _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)((0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['tbody', roleAttrs], headSectionNodes), bodySectionNodes), footSectionNodes)));
    };
    ScrollGrid.prototype.renderSection = function (sectionConfig, sectionIndex, colGroupStats, microColGroupNodes, sectionRowMaxHeights, isHeader) {
        var _this = this;
        if ('outerContent' in sectionConfig) {
            return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Fragment, { key: sectionConfig.key }, sectionConfig.outerContent));
        }
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("tr", { key: sectionConfig.key, role: "presentation", className: (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getSectionClassNames)(sectionConfig, this.props.liquid).join(' ') }, sectionConfig.chunks.map(function (chunkConfig, i) { return _this.renderChunk(sectionConfig, sectionIndex, colGroupStats[i], microColGroupNodes[i], chunkConfig, i, (sectionRowMaxHeights[sectionIndex] || [])[i] || [], isHeader); })));
    };
    ScrollGrid.prototype.renderChunk = function (sectionConfig, sectionIndex, colGroupStat, microColGroupNode, chunkConfig, chunkIndex, rowHeights, isHeader) {
        if ('outerContent' in chunkConfig) {
            return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.Fragment, { key: chunkConfig.key }, chunkConfig.outerContent));
        }
        var state = this.state;
        var scrollerClientWidths = state.scrollerClientWidths, scrollerClientHeights = state.scrollerClientHeights;
        var _a = this.getDims(), sectionCnt = _a[0], chunksPerSection = _a[1];
        var index = sectionIndex * chunksPerSection + chunkIndex;
        var sideScrollIndex = (!this.context.isRtl || (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getIsRtlScrollbarOnLeft)()) ? chunksPerSection - 1 : 0;
        var isVScrollSide = chunkIndex === sideScrollIndex;
        var isLastSection = sectionIndex === sectionCnt - 1;
        var forceXScrollbars = isLastSection && state.forceXScrollbars; // NOOOO can result in `null`
        var forceYScrollbars = isVScrollSide && state.forceYScrollbars; // NOOOO can result in `null`
        var allowXScrolling = colGroupStat && colGroupStat.allowXScrolling; // rename?
        var allowYScrolling = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getAllowYScrolling)(this.props, sectionConfig); // rename? do in section func?
        var chunkVGrow = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getSectionHasLiquidHeight)(this.props, sectionConfig); // do in section func?
        var expandRows = sectionConfig.expandRows && chunkVGrow;
        var tableMinWidth = (colGroupStat && colGroupStat.totalColMinWidth) || '';
        var content = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.renderChunkContent)(sectionConfig, chunkConfig, {
            tableColGroupNode: microColGroupNode,
            tableMinWidth: tableMinWidth,
            clientWidth: scrollerClientWidths[index] !== undefined ? scrollerClientWidths[index] : null,
            clientHeight: scrollerClientHeights[index] !== undefined ? scrollerClientHeights[index] : null,
            expandRows: expandRows,
            syncRowHeights: Boolean(sectionConfig.syncRowHeights),
            rowSyncHeights: rowHeights,
            reportRowHeightChange: this.handleRowHeightChange,
        }, isHeader);
        var overflowX = forceXScrollbars ? (isLastSection ? 'scroll' : 'scroll-hidden') :
            !allowXScrolling ? 'hidden' :
                (isLastSection ? 'auto' : 'scroll-hidden');
        var overflowY = forceYScrollbars ? (isVScrollSide ? 'scroll' : 'scroll-hidden') :
            !allowYScrolling ? 'hidden' :
                (isVScrollSide ? 'auto' : 'scroll-hidden');
        // it *could* be possible to reduce DOM wrappers by only doing a ClippedScroller when allowXScrolling or allowYScrolling,
        // but if these values were to change, the inner components would be unmounted/remounted because of the parent change.
        content = ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(ClippedScroller, { ref: this.clippedScrollerRefs.createRef(index), scrollerElRef: this.scrollerElRefs.createRef(index), overflowX: overflowX, overflowY: overflowY, liquid: chunkVGrow, maxHeight: sectionConfig.maxHeight }, content));
        return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)(isHeader ? 'th' : 'td', {
            key: chunkConfig.key,
            ref: this.chunkElRefs.createRef(index),
            role: 'presentation',
        }, content);
    };
    ScrollGrid.prototype.componentDidMount = function () {
        this.getStickyScrolling = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoizeArraylike)(initStickyScrolling, null, destroyStickyScrolling);
        this.getScrollSyncersBySection = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoizeHashlike)(initScrollSyncer.bind(this, true), null, destroyScrollSyncer);
        this.getScrollSyncersByColumn = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.memoizeHashlike)(initScrollSyncer.bind(this, false), null, destroyScrollSyncer);
        this.updateScrollSyncers();
        this.handleSizing(false);
        this.context.addResizeHandler(this.handleSizing);
    };
    ScrollGrid.prototype.componentDidUpdate = function (prevProps, prevState) {
        this.updateScrollSyncers();
        // TODO: need better solution when state contains non-sizing things
        this.handleSizing(false, prevState.sectionRowMaxHeights !== this.state.sectionRowMaxHeights);
    };
    ScrollGrid.prototype.componentWillUnmount = function () {
        this.context.removeResizeHandler(this.handleSizing);
        this.destroyStickyScrolling();
        this.destroyScrollSyncers();
    };
    ScrollGrid.prototype.allowSizing = function () {
        var now = new Date();
        if (!this.lastSizingDate ||
            now.valueOf() > this.lastSizingDate.valueOf() + _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.config.SCROLLGRID_RESIZE_INTERVAL) {
            this.lastSizingDate = now;
            this.recentSizingCnt = 0;
            return true;
        }
        return (this.recentSizingCnt += 1) <= 10;
    };
    ScrollGrid.prototype.computeShrinkWidths = function () {
        var _this = this;
        var colGroupStats = this.compileColGroupStats(this.props.colGroups.map(function (colGroup) { return [colGroup]; }));
        var _a = this.getDims(), sectionCnt = _a[0], chunksPerSection = _a[1];
        var cnt = sectionCnt * chunksPerSection;
        var shrinkWidths = [];
        colGroupStats.forEach(function (colGroupStat, i) {
            if (colGroupStat.hasShrinkCol) {
                var chunkEls = _this.chunkElRefs.collect(i, cnt, chunksPerSection); // in one col
                shrinkWidths[i] = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.computeShrinkWidth)(chunkEls);
            }
        });
        return shrinkWidths;
    };
    // has the side effect of grooming rowInnerMaxHeightMap
    // TODO: somehow short-circuit if there are no new height changes
    ScrollGrid.prototype.computeSectionRowMaxHeights = function () {
        var newHeightMap = new Map();
        var _a = this.getDims(), sectionCnt = _a[0], chunksPerSection = _a[1];
        var sectionRowMaxHeights = [];
        for (var sectionI = 0; sectionI < sectionCnt; sectionI += 1) {
            var sectionConfig = this.props.sections[sectionI];
            var assignableHeights = []; // chunk, row
            if (sectionConfig && sectionConfig.syncRowHeights) {
                var rowHeightsByChunk = [];
                for (var chunkI = 0; chunkI < chunksPerSection; chunkI += 1) {
                    var index = sectionI * chunksPerSection + chunkI;
                    var rowHeights = [];
                    var chunkEl = this.chunkElRefs.currentMap[index];
                    if (chunkEl) {
                        rowHeights = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.findElements)(chunkEl, '.fc-scrollgrid-sync-table tr').map(function (rowEl) {
                            var max = getRowInnerMaxHeight(rowEl);
                            newHeightMap.set(rowEl, max);
                            return max;
                        });
                    }
                    else {
                        rowHeights = [];
                    }
                    rowHeightsByChunk.push(rowHeights);
                }
                var rowCnt = rowHeightsByChunk[0].length;
                var isEqualRowCnt = true;
                for (var chunkI = 1; chunkI < chunksPerSection; chunkI += 1) {
                    var isOuterContent = sectionConfig.chunks[chunkI] && sectionConfig.chunks[chunkI].outerContent !== undefined; // can be null
                    if (!isOuterContent && rowHeightsByChunk[chunkI].length !== rowCnt) { // skip outer content
                        isEqualRowCnt = false;
                        break;
                    }
                }
                if (!isEqualRowCnt) {
                    var chunkHeightSums = [];
                    for (var chunkI = 0; chunkI < chunksPerSection; chunkI += 1) {
                        chunkHeightSums.push(sumNumbers(rowHeightsByChunk[chunkI]) + rowHeightsByChunk[chunkI].length);
                    }
                    var maxTotalSum = Math.max.apply(Math, chunkHeightSums);
                    for (var chunkI = 0; chunkI < chunksPerSection; chunkI += 1) {
                        var rowInChunkCnt = rowHeightsByChunk[chunkI].length;
                        var rowInChunkTotalHeight = maxTotalSum - rowInChunkCnt; // subtract border
                        // height of non-first row. we do this to avoid rounding, because it's unreliable within a table
                        var rowInChunkHeightOthers = Math.floor(rowInChunkTotalHeight / rowInChunkCnt);
                        // whatever is leftover goes to the first row
                        var rowInChunkHeightFirst = rowInChunkTotalHeight - rowInChunkHeightOthers * (rowInChunkCnt - 1);
                        var rowInChunkHeights = [];
                        var row = 0;
                        if (row < rowInChunkCnt) {
                            rowInChunkHeights.push(rowInChunkHeightFirst);
                            row += 1;
                        }
                        while (row < rowInChunkCnt) {
                            rowInChunkHeights.push(rowInChunkHeightOthers);
                            row += 1;
                        }
                        assignableHeights.push(rowInChunkHeights);
                    }
                }
                else {
                    for (var chunkI = 0; chunkI < chunksPerSection; chunkI += 1) {
                        assignableHeights.push([]);
                    }
                    for (var row = 0; row < rowCnt; row += 1) {
                        var rowHeightsAcrossChunks = [];
                        for (var chunkI = 0; chunkI < chunksPerSection; chunkI += 1) {
                            var h = rowHeightsByChunk[chunkI][row];
                            if (h != null) { // protect against outerContent
                                rowHeightsAcrossChunks.push(h);
                            }
                        }
                        var maxHeight = Math.max.apply(Math, rowHeightsAcrossChunks);
                        for (var chunkI = 0; chunkI < chunksPerSection; chunkI += 1) {
                            assignableHeights[chunkI].push(maxHeight);
                        }
                    }
                }
            }
            sectionRowMaxHeights.push(assignableHeights);
        }
        this.rowInnerMaxHeightMap = newHeightMap;
        return sectionRowMaxHeights;
    };
    ScrollGrid.prototype.computeScrollerDims = function () {
        var scrollbarWidth = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getScrollbarWidths)();
        var _a = this.getDims(), sectionCnt = _a[0], chunksPerSection = _a[1];
        var sideScrollI = (!this.context.isRtl || (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.getIsRtlScrollbarOnLeft)()) ? chunksPerSection - 1 : 0;
        var lastSectionI = sectionCnt - 1;
        var currentScrollers = this.clippedScrollerRefs.currentMap;
        var scrollerEls = this.scrollerElRefs.currentMap;
        var forceYScrollbars = false;
        var forceXScrollbars = false;
        var scrollerClientWidths = {};
        var scrollerClientHeights = {};
        for (var sectionI = 0; sectionI < sectionCnt; sectionI += 1) { // along edge
            var index = sectionI * chunksPerSection + sideScrollI;
            var scroller = currentScrollers[index];
            if (scroller && scroller.needsYScrolling()) {
                forceYScrollbars = true;
                break;
            }
        }
        for (var chunkI = 0; chunkI < chunksPerSection; chunkI += 1) { // along last row
            var index = lastSectionI * chunksPerSection + chunkI;
            var scroller = currentScrollers[index];
            if (scroller && scroller.needsXScrolling()) {
                forceXScrollbars = true;
                break;
            }
        }
        for (var sectionI = 0; sectionI < sectionCnt; sectionI += 1) {
            for (var chunkI = 0; chunkI < chunksPerSection; chunkI += 1) {
                var index = sectionI * chunksPerSection + chunkI;
                var scrollerEl = scrollerEls[index];
                if (scrollerEl) {
                    // TODO: weird way to get this. need harness b/c doesn't include table borders
                    var harnessEl = scrollerEl.parentNode;
                    scrollerClientWidths[index] = Math.floor(harnessEl.getBoundingClientRect().width - ((chunkI === sideScrollI && forceYScrollbars)
                        ? scrollbarWidth.y // use global because scroller might not have scrollbars yet but will need them in future
                        : 0));
                    scrollerClientHeights[index] = Math.floor(harnessEl.getBoundingClientRect().height - ((sectionI === lastSectionI && forceXScrollbars)
                        ? scrollbarWidth.x // use global because scroller might not have scrollbars yet but will need them in future
                        : 0));
                }
            }
        }
        return { forceYScrollbars: forceYScrollbars, forceXScrollbars: forceXScrollbars, scrollerClientWidths: scrollerClientWidths, scrollerClientHeights: scrollerClientHeights };
    };
    ScrollGrid.prototype.updateStickyScrolling = function () {
        var isRtl = this.context.isRtl;
        var argsByKey = this.scrollerElRefs.getAll().map(function (scrollEl) { return [scrollEl, isRtl]; });
        var stickyScrollings = this.getStickyScrolling(argsByKey);
        stickyScrollings.forEach(function (stickyScrolling) { return stickyScrolling.updateSize(); });
        this.stickyScrollings = stickyScrollings;
    };
    ScrollGrid.prototype.destroyStickyScrolling = function () {
        this.stickyScrollings.forEach(destroyStickyScrolling);
    };
    ScrollGrid.prototype.updateScrollSyncers = function () {
        var _a = this.getDims(), sectionCnt = _a[0], chunksPerSection = _a[1];
        var cnt = sectionCnt * chunksPerSection;
        var scrollElsBySection = {};
        var scrollElsByColumn = {};
        var scrollElMap = this.scrollerElRefs.currentMap;
        for (var sectionI = 0; sectionI < sectionCnt; sectionI += 1) {
            var startIndex = sectionI * chunksPerSection;
            var endIndex = startIndex + chunksPerSection;
            scrollElsBySection[sectionI] = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.collectFromHash)(scrollElMap, startIndex, endIndex, 1); // use the filtered
        }
        for (var col = 0; col < chunksPerSection; col += 1) {
            scrollElsByColumn[col] = this.scrollerElRefs.collect(col, cnt, chunksPerSection); // DON'T use the filtered
        }
        this.scrollSyncersBySection = this.getScrollSyncersBySection(scrollElsBySection);
        this.scrollSyncersByColumn = this.getScrollSyncersByColumn(scrollElsByColumn);
    };
    ScrollGrid.prototype.destroyScrollSyncers = function () {
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.mapHash)(this.scrollSyncersBySection, destroyScrollSyncer);
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.mapHash)(this.scrollSyncersByColumn, destroyScrollSyncer);
    };
    ScrollGrid.prototype.getChunkConfigByIndex = function (index) {
        var chunksPerSection = this.getDims()[1];
        var sectionI = Math.floor(index / chunksPerSection);
        var chunkI = index % chunksPerSection;
        var sectionConfig = this.props.sections[sectionI];
        return sectionConfig && sectionConfig.chunks[chunkI];
    };
    ScrollGrid.prototype.forceScrollLeft = function (col, scrollLeft) {
        var scrollSyncer = this.scrollSyncersByColumn[col];
        if (scrollSyncer) {
            scrollSyncer.forceScrollLeft(scrollLeft);
        }
    };
    ScrollGrid.prototype.forceScrollTop = function (sectionI, scrollTop) {
        var scrollSyncer = this.scrollSyncersBySection[sectionI];
        if (scrollSyncer) {
            scrollSyncer.forceScrollTop(scrollTop);
        }
    };
    ScrollGrid.prototype._handleChunkEl = function (chunkEl, key) {
        var chunkConfig = this.getChunkConfigByIndex(parseInt(key, 10));
        if (chunkConfig) { // null if section disappeared. bad, b/c won't null-set the elRef
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.setRef)(chunkConfig.elRef, chunkEl);
        }
    };
    ScrollGrid.prototype._handleScrollerEl = function (scrollerEl, key) {
        var chunkConfig = this.getChunkConfigByIndex(parseInt(key, 10));
        if (chunkConfig) { // null if section disappeared. bad, b/c won't null-set the elRef
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.setRef)(chunkConfig.scrollerElRef, scrollerEl);
        }
    };
    ScrollGrid.prototype.getDims = function () {
        var sectionCnt = this.props.sections.length;
        var chunksPerSection = sectionCnt ? this.props.sections[0].chunks.length : 0;
        return [sectionCnt, chunksPerSection];
    };
    return ScrollGrid;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.BaseComponent));
ScrollGrid.addStateEquality({
    shrinkWidths: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.isArraysEqual,
    scrollerClientWidths: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.isPropsEqual,
    scrollerClientHeights: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.isPropsEqual,
});
function sumNumbers(numbers) {
    var sum = 0;
    for (var _i = 0, numbers_1 = numbers; _i < numbers_1.length; _i++) {
        var n = numbers_1[_i];
        sum += n;
    }
    return sum;
}
function getRowInnerMaxHeight(rowEl) {
    var innerHeights = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.findElements)(rowEl, '.fc-scrollgrid-sync-inner').map(getElHeight);
    if (innerHeights.length) {
        return Math.max.apply(Math, innerHeights);
    }
    return 0;
}
function getElHeight(el) {
    return el.offsetHeight; // better to deal with integers, for rounding, for PureComponent
}
function renderMacroColGroup(colGroupStats, shrinkWidths) {
    var children = colGroupStats.map(function (colGroupStat, i) {
        var width = colGroupStat.width;
        if (width === 'shrink') {
            width = colGroupStat.totalColWidth + (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.sanitizeShrinkWidth)(shrinkWidths[i]) + 1; // +1 for border :(
        }
        return ( // eslint-disable-next-line react/jsx-key
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement)("col", { style: { width: width } }));
    });
    return _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createElement.apply(void 0, (0,tslib__WEBPACK_IMPORTED_MODULE_2__.__spreadArray)(['colgroup', {}], children));
}
function compileColGroupStat(colGroupConfig) {
    var totalColWidth = sumColProp(colGroupConfig.cols, 'width'); // excludes "shrink"
    var totalColMinWidth = sumColProp(colGroupConfig.cols, 'minWidth');
    var hasShrinkCol = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.hasShrinkWidth)(colGroupConfig.cols);
    var allowXScrolling = colGroupConfig.width !== 'shrink' && Boolean(totalColWidth || totalColMinWidth || hasShrinkCol);
    return {
        hasShrinkCol: hasShrinkCol,
        totalColWidth: totalColWidth,
        totalColMinWidth: totalColMinWidth,
        allowXScrolling: allowXScrolling,
        cols: colGroupConfig.cols,
        width: colGroupConfig.width,
    };
}
function sumColProp(cols, propName) {
    var total = 0;
    for (var _i = 0, cols_1 = cols; _i < cols_1.length; _i++) {
        var col = cols_1[_i];
        var val = col[propName];
        if (typeof val === 'number') {
            total += val * (col.span || 1);
        }
    }
    return total;
}
var COL_GROUP_STAT_EQUALITY = {
    cols: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.isColPropsEqual,
};
function isColGroupStatsEqual(stat0, stat1) {
    return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.compareObjs)(stat0, stat1, COL_GROUP_STAT_EQUALITY);
}
// for memoizers...
function initScrollSyncer(isVertical) {
    var scrollEls = [];
    for (var _i = 1; _i < arguments.length; _i++) {
        scrollEls[_i - 1] = arguments[_i];
    }
    return new ScrollSyncer(isVertical, scrollEls);
}
function destroyScrollSyncer(scrollSyncer) {
    scrollSyncer.destroy();
}
function initStickyScrolling(scrollEl, isRtl) {
    return new StickyScrolling(scrollEl, isRtl);
}
function destroyStickyScrolling(stickyScrolling) {
    stickyScrolling.destroy();
}

var main = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.createPlugin)({
    deps: [
        _fullcalendar_premium_common__WEBPACK_IMPORTED_MODULE_1__["default"],
    ],
    scrollGridImpl: ScrollGrid,
});
_fullcalendar_common__WEBPACK_IMPORTED_MODULE_0__.config.SCROLLGRID_RESIZE_INTERVAL = 500;

/* harmony default export */ __webpack_exports__["default"] = (main);

//# sourceMappingURL=main.js.map


/***/ }),

/***/ "./node_modules/@fullcalendar/timeline/main.js":
/*!*****************************************************!*\
  !*** ./node_modules/@fullcalendar/timeline/main.js ***!
  \*****************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "TimelineCoords": function() { return /* binding */ TimelineCoords; },
/* harmony export */   "TimelineHeader": function() { return /* binding */ TimelineHeader; },
/* harmony export */   "TimelineHeaderRows": function() { return /* binding */ TimelineHeaderRows; },
/* harmony export */   "TimelineLane": function() { return /* binding */ TimelineLane; },
/* harmony export */   "TimelineLaneBg": function() { return /* binding */ TimelineLaneBg; },
/* harmony export */   "TimelineLaneSlicer": function() { return /* binding */ TimelineLaneSlicer; },
/* harmony export */   "TimelineSlats": function() { return /* binding */ TimelineSlats; },
/* harmony export */   "TimelineView": function() { return /* binding */ TimelineView; },
/* harmony export */   "buildSlatCols": function() { return /* binding */ buildSlatCols; },
/* harmony export */   "buildTimelineDateProfile": function() { return /* binding */ buildTimelineDateProfile; },
/* harmony export */   "coordToCss": function() { return /* binding */ coordToCss; },
/* harmony export */   "coordsToCss": function() { return /* binding */ coordsToCss; }
/* harmony export */ });
/* harmony import */ var _main_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./main.css */ "./node_modules/@fullcalendar/timeline/main.css");
/* harmony import */ var _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @fullcalendar/common */ "./node_modules/@fullcalendar/common/main.js");
/* harmony import */ var _fullcalendar_premium_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @fullcalendar/premium-common */ "./node_modules/@fullcalendar/premium-common/main.js");
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _fullcalendar_scrollgrid__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @fullcalendar/scrollgrid */ "./node_modules/@fullcalendar/scrollgrid/main.js");
/*!
FullCalendar Scheduler v5.11.3
Docs & License: https://fullcalendar.io/scheduler
(c) 2022 Adam Shaw
*/







var MIN_AUTO_LABELS = 18; // more than `12` months but less that `24` hours
var MAX_AUTO_SLOTS_PER_LABEL = 6; // allows 6 10-min slots in an hour
var MAX_AUTO_CELLS = 200; // allows 4-days to have a :30 slot duration
_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.config.MAX_TIMELINE_SLOTS = 1000;
// potential nice values for slot-duration and interval-duration
var STOCK_SUB_DURATIONS = [
    { years: 1 },
    { months: 1 },
    { days: 1 },
    { hours: 1 },
    { minutes: 30 },
    { minutes: 15 },
    { minutes: 10 },
    { minutes: 5 },
    { minutes: 1 },
    { seconds: 30 },
    { seconds: 15 },
    { seconds: 10 },
    { seconds: 5 },
    { seconds: 1 },
    { milliseconds: 500 },
    { milliseconds: 100 },
    { milliseconds: 10 },
    { milliseconds: 1 },
];
function buildTimelineDateProfile(dateProfile, dateEnv, allOptions, dateProfileGenerator) {
    var tDateProfile = {
        labelInterval: allOptions.slotLabelInterval,
        slotDuration: allOptions.slotDuration,
    };
    validateLabelAndSlot(tDateProfile, dateProfile, dateEnv); // validate after computed grid duration
    ensureLabelInterval(tDateProfile, dateProfile, dateEnv);
    ensureSlotDuration(tDateProfile, dateProfile, dateEnv);
    var input = allOptions.slotLabelFormat;
    var rawFormats = Array.isArray(input) ? input :
        (input != null) ? [input] :
            computeHeaderFormats(tDateProfile, dateProfile, dateEnv, allOptions);
    tDateProfile.headerFormats = rawFormats.map(function (rawFormat) { return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createFormatter)(rawFormat); });
    tDateProfile.isTimeScale = Boolean(tDateProfile.slotDuration.milliseconds);
    var largeUnit = null;
    if (!tDateProfile.isTimeScale) {
        var slotUnit = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.greatestDurationDenominator)(tDateProfile.slotDuration).unit;
        if (/year|month|week/.test(slotUnit)) {
            largeUnit = slotUnit;
        }
    }
    tDateProfile.largeUnit = largeUnit;
    tDateProfile.emphasizeWeeks =
        (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.asCleanDays)(tDateProfile.slotDuration) === 1 &&
            currentRangeAs('weeks', dateProfile, dateEnv) >= 2 &&
            !allOptions.businessHours;
    /*
    console.log('label interval =', timelineView.labelInterval.humanize())
    console.log('slot duration =', timelineView.slotDuration.humanize())
    console.log('header formats =', timelineView.headerFormats)
    console.log('isTimeScale', timelineView.isTimeScale)
    console.log('largeUnit', timelineView.largeUnit)
    */
    var rawSnapDuration = allOptions.snapDuration;
    var snapDuration;
    var snapsPerSlot;
    if (rawSnapDuration) {
        snapDuration = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createDuration)(rawSnapDuration);
        snapsPerSlot = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.wholeDivideDurations)(tDateProfile.slotDuration, snapDuration);
        // ^ TODO: warning if not whole?
    }
    if (snapsPerSlot == null) {
        snapDuration = tDateProfile.slotDuration;
        snapsPerSlot = 1;
    }
    tDateProfile.snapDuration = snapDuration;
    tDateProfile.snapsPerSlot = snapsPerSlot;
    // more...
    var timeWindowMs = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.asRoughMs)(dateProfile.slotMaxTime) - (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.asRoughMs)(dateProfile.slotMinTime);
    // TODO: why not use normalizeRange!?
    var normalizedStart = normalizeDate(dateProfile.renderRange.start, tDateProfile, dateEnv);
    var normalizedEnd = normalizeDate(dateProfile.renderRange.end, tDateProfile, dateEnv);
    // apply slotMinTime/slotMaxTime
    // TODO: View should be responsible.
    if (tDateProfile.isTimeScale) {
        normalizedStart = dateEnv.add(normalizedStart, dateProfile.slotMinTime);
        normalizedEnd = dateEnv.add((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.addDays)(normalizedEnd, -1), dateProfile.slotMaxTime);
    }
    tDateProfile.timeWindowMs = timeWindowMs;
    tDateProfile.normalizedRange = { start: normalizedStart, end: normalizedEnd };
    var slotDates = [];
    var date = normalizedStart;
    while (date < normalizedEnd) {
        if (isValidDate(date, tDateProfile, dateProfile, dateProfileGenerator)) {
            slotDates.push(date);
        }
        date = dateEnv.add(date, tDateProfile.slotDuration);
    }
    tDateProfile.slotDates = slotDates;
    // more...
    var snapIndex = -1;
    var snapDiff = 0; // index of the diff :(
    var snapDiffToIndex = [];
    var snapIndexToDiff = [];
    date = normalizedStart;
    while (date < normalizedEnd) {
        if (isValidDate(date, tDateProfile, dateProfile, dateProfileGenerator)) {
            snapIndex += 1;
            snapDiffToIndex.push(snapIndex);
            snapIndexToDiff.push(snapDiff);
        }
        else {
            snapDiffToIndex.push(snapIndex + 0.5);
        }
        date = dateEnv.add(date, tDateProfile.snapDuration);
        snapDiff += 1;
    }
    tDateProfile.snapDiffToIndex = snapDiffToIndex;
    tDateProfile.snapIndexToDiff = snapIndexToDiff;
    tDateProfile.snapCnt = snapIndex + 1; // is always one behind
    tDateProfile.slotCnt = tDateProfile.snapCnt / tDateProfile.snapsPerSlot;
    // more...
    tDateProfile.isWeekStarts = buildIsWeekStarts(tDateProfile, dateEnv);
    tDateProfile.cellRows = buildCellRows(tDateProfile, dateEnv);
    tDateProfile.slotsPerLabel = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.wholeDivideDurations)(tDateProfile.labelInterval, tDateProfile.slotDuration);
    return tDateProfile;
}
/*
snaps to appropriate unit
*/
function normalizeDate(date, tDateProfile, dateEnv) {
    var normalDate = date;
    if (!tDateProfile.isTimeScale) {
        normalDate = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.startOfDay)(normalDate);
        if (tDateProfile.largeUnit) {
            normalDate = dateEnv.startOf(normalDate, tDateProfile.largeUnit);
        }
    }
    return normalDate;
}
/*
snaps to appropriate unit
*/
function normalizeRange(range, tDateProfile, dateEnv) {
    if (!tDateProfile.isTimeScale) {
        range = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.computeVisibleDayRange)(range);
        if (tDateProfile.largeUnit) {
            var dayRange = range; // preserve original result
            range = {
                start: dateEnv.startOf(range.start, tDateProfile.largeUnit),
                end: dateEnv.startOf(range.end, tDateProfile.largeUnit),
            };
            // if date is partially through the interval, or is in the same interval as the start,
            // make the exclusive end be the *next* interval
            if (range.end.valueOf() !== dayRange.end.valueOf() || range.end <= range.start) {
                range = {
                    start: range.start,
                    end: dateEnv.add(range.end, tDateProfile.slotDuration),
                };
            }
        }
    }
    return range;
}
function isValidDate(date, tDateProfile, dateProfile, dateProfileGenerator) {
    if (dateProfileGenerator.isHiddenDay(date)) {
        return false;
    }
    if (tDateProfile.isTimeScale) {
        // determine if the time is within slotMinTime/slotMaxTime, which may have wacky values
        var day = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.startOfDay)(date);
        var timeMs = date.valueOf() - day.valueOf();
        var ms = timeMs - (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.asRoughMs)(dateProfile.slotMinTime); // milliseconds since slotMinTime
        ms = ((ms % 86400000) + 86400000) % 86400000; // make negative values wrap to 24hr clock
        return ms < tDateProfile.timeWindowMs; // before the slotMaxTime?
    }
    return true;
}
function validateLabelAndSlot(tDateProfile, dateProfile, dateEnv) {
    var currentRange = dateProfile.currentRange;
    // make sure labelInterval doesn't exceed the max number of cells
    if (tDateProfile.labelInterval) {
        var labelCnt = dateEnv.countDurationsBetween(currentRange.start, currentRange.end, tDateProfile.labelInterval);
        if (labelCnt > _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.config.MAX_TIMELINE_SLOTS) {
            console.warn('slotLabelInterval results in too many cells');
            tDateProfile.labelInterval = null;
        }
    }
    // make sure slotDuration doesn't exceed the maximum number of cells
    if (tDateProfile.slotDuration) {
        var slotCnt = dateEnv.countDurationsBetween(currentRange.start, currentRange.end, tDateProfile.slotDuration);
        if (slotCnt > _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.config.MAX_TIMELINE_SLOTS) {
            console.warn('slotDuration results in too many cells');
            tDateProfile.slotDuration = null;
        }
    }
    // make sure labelInterval is a multiple of slotDuration
    if (tDateProfile.labelInterval && tDateProfile.slotDuration) {
        var slotsPerLabel = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.wholeDivideDurations)(tDateProfile.labelInterval, tDateProfile.slotDuration);
        if (slotsPerLabel === null || slotsPerLabel < 1) {
            console.warn('slotLabelInterval must be a multiple of slotDuration');
            tDateProfile.slotDuration = null;
        }
    }
}
function ensureLabelInterval(tDateProfile, dateProfile, dateEnv) {
    var currentRange = dateProfile.currentRange;
    var labelInterval = tDateProfile.labelInterval;
    if (!labelInterval) {
        // compute based off the slot duration
        // find the largest label interval with an acceptable slots-per-label
        var input = void 0;
        if (tDateProfile.slotDuration) {
            for (var _i = 0, STOCK_SUB_DURATIONS_1 = STOCK_SUB_DURATIONS; _i < STOCK_SUB_DURATIONS_1.length; _i++) {
                input = STOCK_SUB_DURATIONS_1[_i];
                var tryLabelInterval = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createDuration)(input);
                var slotsPerLabel = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.wholeDivideDurations)(tryLabelInterval, tDateProfile.slotDuration);
                if (slotsPerLabel !== null && slotsPerLabel <= MAX_AUTO_SLOTS_PER_LABEL) {
                    labelInterval = tryLabelInterval;
                    break;
                }
            }
            // use the slot duration as a last resort
            if (!labelInterval) {
                labelInterval = tDateProfile.slotDuration;
            }
            // compute based off the view's duration
            // find the largest label interval that yields the minimum number of labels
        }
        else {
            for (var _a = 0, STOCK_SUB_DURATIONS_2 = STOCK_SUB_DURATIONS; _a < STOCK_SUB_DURATIONS_2.length; _a++) {
                input = STOCK_SUB_DURATIONS_2[_a];
                labelInterval = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createDuration)(input);
                var labelCnt = dateEnv.countDurationsBetween(currentRange.start, currentRange.end, labelInterval);
                if (labelCnt >= MIN_AUTO_LABELS) {
                    break;
                }
            }
        }
        tDateProfile.labelInterval = labelInterval;
    }
    return labelInterval;
}
function ensureSlotDuration(tDateProfile, dateProfile, dateEnv) {
    var currentRange = dateProfile.currentRange;
    var slotDuration = tDateProfile.slotDuration;
    if (!slotDuration) {
        var labelInterval = ensureLabelInterval(tDateProfile, dateProfile, dateEnv); // will compute if necessary
        // compute based off the label interval
        // find the largest slot duration that is different from labelInterval, but still acceptable
        for (var _i = 0, STOCK_SUB_DURATIONS_3 = STOCK_SUB_DURATIONS; _i < STOCK_SUB_DURATIONS_3.length; _i++) {
            var input = STOCK_SUB_DURATIONS_3[_i];
            var trySlotDuration = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createDuration)(input);
            var slotsPerLabel = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.wholeDivideDurations)(labelInterval, trySlotDuration);
            if (slotsPerLabel !== null && slotsPerLabel > 1 && slotsPerLabel <= MAX_AUTO_SLOTS_PER_LABEL) {
                slotDuration = trySlotDuration;
                break;
            }
        }
        // only allow the value if it won't exceed the view's # of slots limit
        if (slotDuration) {
            var slotCnt = dateEnv.countDurationsBetween(currentRange.start, currentRange.end, slotDuration);
            if (slotCnt > MAX_AUTO_CELLS) {
                slotDuration = null;
            }
        }
        // use the label interval as a last resort
        if (!slotDuration) {
            slotDuration = labelInterval;
        }
        tDateProfile.slotDuration = slotDuration;
    }
    return slotDuration;
}
function computeHeaderFormats(tDateProfile, dateProfile, dateEnv, allOptions) {
    var format1;
    var format2;
    var labelInterval = tDateProfile.labelInterval;
    var unit = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.greatestDurationDenominator)(labelInterval).unit;
    var weekNumbersVisible = allOptions.weekNumbers;
    var format0 = (format1 = (format2 = null));
    // NOTE: weekNumber computation function wont work
    if ((unit === 'week') && !weekNumbersVisible) {
        unit = 'day';
    }
    switch (unit) {
        case 'year':
            format0 = { year: 'numeric' }; // '2015'
            break;
        case 'month':
            if (currentRangeAs('years', dateProfile, dateEnv) > 1) {
                format0 = { year: 'numeric' }; // '2015'
            }
            format1 = { month: 'short' }; // 'Jan'
            break;
        case 'week':
            if (currentRangeAs('years', dateProfile, dateEnv) > 1) {
                format0 = { year: 'numeric' }; // '2015'
            }
            format1 = { week: 'narrow' }; // 'Wk4'
            break;
        case 'day':
            if (currentRangeAs('years', dateProfile, dateEnv) > 1) {
                format0 = { year: 'numeric', month: 'long' }; // 'January 2014'
            }
            else if (currentRangeAs('months', dateProfile, dateEnv) > 1) {
                format0 = { month: 'long' }; // 'January'
            }
            if (weekNumbersVisible) {
                format1 = { week: 'short' }; // 'Wk 4'
            }
            format2 = { weekday: 'narrow', day: 'numeric' }; // 'Su 9'
            break;
        case 'hour':
            if (weekNumbersVisible) {
                format0 = { week: 'short' }; // 'Wk 4'
            }
            if (currentRangeAs('days', dateProfile, dateEnv) > 1) {
                format1 = { weekday: 'short', day: 'numeric', month: 'numeric', omitCommas: true }; // Sat 4/7
            }
            format2 = {
                hour: 'numeric',
                minute: '2-digit',
                omitZeroMinute: true,
                meridiem: 'short',
            };
            break;
        case 'minute':
            // sufficiently large number of different minute cells?
            if (((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.asRoughMinutes)(labelInterval) / 60) >= MAX_AUTO_SLOTS_PER_LABEL) {
                format0 = {
                    hour: 'numeric',
                    meridiem: 'short',
                };
                format1 = function (params) { return (':' + (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.padStart)(params.date.minute, 2) // ':30'
                ); };
            }
            else {
                format0 = {
                    hour: 'numeric',
                    minute: 'numeric',
                    meridiem: 'short',
                };
            }
            break;
        case 'second':
            // sufficiently large number of different second cells?
            if (((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.asRoughSeconds)(labelInterval) / 60) >= MAX_AUTO_SLOTS_PER_LABEL) {
                format0 = { hour: 'numeric', minute: '2-digit', meridiem: 'lowercase' }; // '8:30 PM'
                format1 = function (params) { return (':' + (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.padStart)(params.date.second, 2) // ':30'
                ); };
            }
            else {
                format0 = { hour: 'numeric', minute: '2-digit', second: '2-digit', meridiem: 'lowercase' }; // '8:30:45 PM'
            }
            break;
        case 'millisecond':
            format0 = { hour: 'numeric', minute: '2-digit', second: '2-digit', meridiem: 'lowercase' }; // '8:30:45 PM'
            format1 = function (params) { return ('.' + (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.padStart)(params.millisecond, 3)); };
            break;
    }
    return [].concat(format0 || [], format1 || [], format2 || []);
}
// Compute the number of the give units in the "current" range.
// Won't go more precise than days.
// Will return `0` if there's not a clean whole interval.
function currentRangeAs(unit, dateProfile, dateEnv) {
    var range = dateProfile.currentRange;
    var res = null;
    if (unit === 'years') {
        res = dateEnv.diffWholeYears(range.start, range.end);
    }
    else if (unit === 'months') {
        res = dateEnv.diffWholeMonths(range.start, range.end);
    }
    else if (unit === 'weeks') {
        res = dateEnv.diffWholeMonths(range.start, range.end);
    }
    else if (unit === 'days') {
        res = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.diffWholeDays)(range.start, range.end);
    }
    return res || 0;
}
function buildIsWeekStarts(tDateProfile, dateEnv) {
    var slotDates = tDateProfile.slotDates, emphasizeWeeks = tDateProfile.emphasizeWeeks;
    var prevWeekNumber = null;
    var isWeekStarts = [];
    for (var _i = 0, slotDates_1 = slotDates; _i < slotDates_1.length; _i++) {
        var slotDate = slotDates_1[_i];
        var weekNumber = dateEnv.computeWeekNumber(slotDate);
        var isWeekStart = emphasizeWeeks && (prevWeekNumber !== null) && (prevWeekNumber !== weekNumber);
        prevWeekNumber = weekNumber;
        isWeekStarts.push(isWeekStart);
    }
    return isWeekStarts;
}
function buildCellRows(tDateProfile, dateEnv) {
    var slotDates = tDateProfile.slotDates;
    var formats = tDateProfile.headerFormats;
    var cellRows = formats.map(function () { return []; }); // indexed by row,col
    var slotAsDays = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.asCleanDays)(tDateProfile.slotDuration);
    var guessedSlotUnit = slotAsDays === 7 ? 'week' :
        slotAsDays === 1 ? 'day' :
            null;
    // specifically for navclicks
    var rowUnitsFromFormats = formats.map(function (format) { return (format.getLargestUnit ? format.getLargestUnit() : null); });
    // builds cellRows and slotCells
    for (var i = 0; i < slotDates.length; i += 1) {
        var date = slotDates[i];
        var isWeekStart = tDateProfile.isWeekStarts[i];
        for (var row = 0; row < formats.length; row += 1) {
            var format = formats[row];
            var rowCells = cellRows[row];
            var leadingCell = rowCells[rowCells.length - 1];
            var isLastRow = row === formats.length - 1;
            var isSuperRow = formats.length > 1 && !isLastRow; // more than one row and not the last
            var newCell = null;
            var rowUnit = rowUnitsFromFormats[row] || (isLastRow ? guessedSlotUnit : null);
            if (isSuperRow) {
                var text = dateEnv.format(date, format);
                if (!leadingCell || (leadingCell.text !== text)) {
                    newCell = buildCellObject(date, text, rowUnit);
                }
                else {
                    leadingCell.colspan += 1;
                }
            }
            else if (!leadingCell ||
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.isInt)(dateEnv.countDurationsBetween(tDateProfile.normalizedRange.start, date, tDateProfile.labelInterval))) {
                var text = dateEnv.format(date, format);
                newCell = buildCellObject(date, text, rowUnit);
            }
            else {
                leadingCell.colspan += 1;
            }
            if (newCell) {
                newCell.weekStart = isWeekStart;
                rowCells.push(newCell);
            }
        }
    }
    return cellRows;
}
function buildCellObject(date, text, rowUnit) {
    return { date: date, text: text, rowUnit: rowUnit, colspan: 1, isWeekStart: false };
}

var TimelineHeaderThInner = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineHeaderThInner, _super);
    function TimelineHeaderThInner() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TimelineHeaderThInner.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.ContentHook, { hookProps: props.hookProps, content: context.options.slotLabelContent, defaultContent: renderInnerContent }, function (innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("a", (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({ ref: innerElRef, className: 'fc-timeline-slot-cushion fc-scrollgrid-sync-inner' + (props.isSticky ? ' fc-sticky' : '') }, props.navLinkAttrs), innerContent)); }));
    };
    return TimelineHeaderThInner;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
function renderInnerContent(props) {
    return props.text;
}
function refineHookProps(input) {
    return {
        level: input.level,
        date: input.dateEnv.toDate(input.dateMarker),
        view: input.viewApi,
        text: input.text,
    };
}

var TimelineHeaderTh = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineHeaderTh, _super);
    function TimelineHeaderTh() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.refineHookProps = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoizeObjArg)(refineHookProps);
        _this.normalizeClassNames = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.buildClassNameNormalizer)();
        _this.buildCellNavLinkAttrs = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(buildCellNavLinkAttrs);
        return _this;
    }
    TimelineHeaderTh.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var dateEnv = context.dateEnv, options = context.options;
        var cell = props.cell, dateProfile = props.dateProfile, tDateProfile = props.tDateProfile;
        // the cell.rowUnit is f'd
        // giving 'month' for a 3-day view
        // workaround: to infer day, do NOT time
        var dateMeta = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getDateMeta)(cell.date, props.todayRange, props.nowDate, dateProfile);
        var classNames = ['fc-timeline-slot', 'fc-timeline-slot-label'].concat(cell.rowUnit === 'time' // TODO: so slot classnames for week/month/bigger. see note above about rowUnit
            ? (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getSlotClassNames)(dateMeta, context.theme)
            : (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getDayClassNames)(dateMeta, context.theme));
        if (cell.isWeekStart) {
            classNames.push('fc-timeline-slot-em');
        }
        var hookProps = this.refineHookProps({
            level: props.rowLevel,
            dateMarker: cell.date,
            text: cell.text,
            dateEnv: context.dateEnv,
            viewApi: context.viewApi,
        });
        var customClassNames = this.normalizeClassNames(options.slotLabelClassNames, hookProps);
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.MountHook, { hookProps: hookProps, didMount: options.slotLabelDidMount, willUnmount: options.slotLabelWillUnmount }, function (rootElRef) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("th", { ref: rootElRef, className: classNames.concat(customClassNames).join(' '), "data-date": dateEnv.formatIso(cell.date, { omitTime: !tDateProfile.isTimeScale, omitTimeZoneOffset: true }), colSpan: cell.colspan },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-slot-frame", style: { height: props.rowInnerHeight } },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineHeaderThInner, { hookProps: hookProps, isSticky: props.isSticky, navLinkAttrs: _this.buildCellNavLinkAttrs(context, cell.date, cell.rowUnit) })))); }));
    };
    return TimelineHeaderTh;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
function buildCellNavLinkAttrs(context, cellDate, rowUnit) {
    return (rowUnit && rowUnit !== 'time')
        ? (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.buildNavLinkAttrs)(context, cellDate, rowUnit)
        : {};
}

var TimelineHeaderRows = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineHeaderRows, _super);
    function TimelineHeaderRows() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TimelineHeaderRows.prototype.render = function () {
        var _a = this.props, dateProfile = _a.dateProfile, tDateProfile = _a.tDateProfile, rowInnerHeights = _a.rowInnerHeights, todayRange = _a.todayRange, nowDate = _a.nowDate;
        var cellRows = tDateProfile.cellRows;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, cellRows.map(function (rowCells, rowLevel) {
            var isLast = rowLevel === cellRows.length - 1;
            var isChrono = tDateProfile.isTimeScale && isLast; // the final row, with times?
            var classNames = [
                'fc-timeline-header-row',
                isChrono ? 'fc-timeline-header-row-chrono' : '',
            ];
            return ( // eslint-disable-next-line react/no-array-index-key
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", { key: rowLevel, className: classNames.join(' ') }, rowCells.map(function (cell) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineHeaderTh, { key: cell.date.toISOString(), cell: cell, rowLevel: rowLevel, dateProfile: dateProfile, tDateProfile: tDateProfile, todayRange: todayRange, nowDate: nowDate, rowInnerHeight: rowInnerHeights && rowInnerHeights[rowLevel], isSticky: !isLast })); })));
        })));
    };
    return TimelineHeaderRows;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var TimelineCoords = /** @class */ (function () {
    function TimelineCoords(slatRootEl, // okay to expose?
    slatEls, dateProfile, tDateProfile, dateEnv, isRtl) {
        this.slatRootEl = slatRootEl;
        this.dateProfile = dateProfile;
        this.tDateProfile = tDateProfile;
        this.dateEnv = dateEnv;
        this.isRtl = isRtl;
        this.outerCoordCache = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.PositionCache(slatRootEl, slatEls, true, // isHorizontal
        false);
        // for the inner divs within the slats
        // used for event rendering and scrollTime, to disregard slat border
        this.innerCoordCache = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.PositionCache(slatRootEl, (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.findDirectChildren)(slatEls, 'div'), true, // isHorizontal
        false);
    }
    TimelineCoords.prototype.isDateInRange = function (date) {
        return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.rangeContainsMarker)(this.dateProfile.currentRange, date);
    };
    // results range from negative width of area to 0
    TimelineCoords.prototype.dateToCoord = function (date) {
        var tDateProfile = this.tDateProfile;
        var snapCoverage = this.computeDateSnapCoverage(date);
        var slotCoverage = snapCoverage / tDateProfile.snapsPerSlot;
        var slotIndex = Math.floor(slotCoverage);
        slotIndex = Math.min(slotIndex, tDateProfile.slotCnt - 1);
        var partial = slotCoverage - slotIndex;
        var _a = this, innerCoordCache = _a.innerCoordCache, outerCoordCache = _a.outerCoordCache;
        if (this.isRtl) {
            return outerCoordCache.originClientRect.width - (outerCoordCache.rights[slotIndex] -
                (innerCoordCache.getWidth(slotIndex) * partial));
        }
        return (outerCoordCache.lefts[slotIndex] +
            (innerCoordCache.getWidth(slotIndex) * partial));
    };
    TimelineCoords.prototype.rangeToCoords = function (range) {
        return {
            start: this.dateToCoord(range.start),
            end: this.dateToCoord(range.end),
        };
    };
    TimelineCoords.prototype.durationToCoord = function (duration) {
        var _a = this, dateProfile = _a.dateProfile, tDateProfile = _a.tDateProfile, dateEnv = _a.dateEnv, isRtl = _a.isRtl;
        var coord = 0;
        if (dateProfile) {
            var date = dateEnv.add(dateProfile.activeRange.start, duration);
            if (!tDateProfile.isTimeScale) {
                date = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.startOfDay)(date);
            }
            coord = this.dateToCoord(date);
            // hack to overcome the left borders of non-first slat
            if (!isRtl && coord) {
                coord += 1;
            }
        }
        return coord;
    };
    TimelineCoords.prototype.coordFromLeft = function (coord) {
        if (this.isRtl) {
            return this.outerCoordCache.originClientRect.width - coord;
        }
        return coord;
    };
    // returned value is between 0 and the number of snaps
    TimelineCoords.prototype.computeDateSnapCoverage = function (date) {
        return computeDateSnapCoverage(date, this.tDateProfile, this.dateEnv);
    };
    return TimelineCoords;
}());
// returned value is between 0 and the number of snaps
function computeDateSnapCoverage(date, tDateProfile, dateEnv) {
    var snapDiff = dateEnv.countDurationsBetween(tDateProfile.normalizedRange.start, date, tDateProfile.snapDuration);
    if (snapDiff < 0) {
        return 0;
    }
    if (snapDiff >= tDateProfile.snapDiffToIndex.length) {
        return tDateProfile.snapCnt;
    }
    var snapDiffInt = Math.floor(snapDiff);
    var snapCoverage = tDateProfile.snapDiffToIndex[snapDiffInt];
    if ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.isInt)(snapCoverage)) { // not an in-between value
        snapCoverage += snapDiff - snapDiffInt; // add the remainder
    }
    else {
        // a fractional value, meaning the date is not visible
        // always round up in this case. works for start AND end dates in a range.
        snapCoverage = Math.ceil(snapCoverage);
    }
    return snapCoverage;
}
function coordToCss(hcoord, isRtl) {
    if (hcoord === null) {
        return { left: '', right: '' };
    }
    if (isRtl) {
        return { right: hcoord, left: '' };
    }
    return { left: hcoord, right: '' };
}
function coordsToCss(hcoords, isRtl) {
    if (!hcoords) {
        return { left: '', right: '' };
    }
    if (isRtl) {
        return { right: hcoords.start, left: -hcoords.end };
    }
    return { left: hcoords.start, right: -hcoords.end };
}

var TimelineHeader = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineHeader, _super);
    function TimelineHeader() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.rootElRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        return _this;
    }
    TimelineHeader.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        // TODO: very repetitive
        // TODO: make part of tDateProfile?
        var timerUnit = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.greatestDurationDenominator)(props.tDateProfile.slotDuration).unit;
        // WORKAROUND: make ignore slatCoords when out of sync with dateProfile
        var slatCoords = props.slatCoords && props.slatCoords.dateProfile === props.dateProfile ? props.slatCoords : null;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.NowTimer, { unit: timerUnit }, function (nowDate, todayRange) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-header", ref: _this.rootElRef },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("table", { "aria-hidden": true, className: "fc-scrollgrid-sync-table", style: { minWidth: props.tableMinWidth, width: props.clientWidth } },
                props.tableColGroupNode,
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tbody", null,
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineHeaderRows, { dateProfile: props.dateProfile, tDateProfile: props.tDateProfile, nowDate: nowDate, todayRange: todayRange, rowInnerHeights: props.rowInnerHeights }))),
            context.options.nowIndicator && (
            // need to have a container regardless of whether the current view has a visible now indicator
            // because apparently removal of the element resets the scroll for some reasons (issue #5351).
            // this issue doesn't happen for the timeline body however (
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-now-indicator-container" }, (slatCoords && slatCoords.isDateInRange(nowDate)) && ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.NowIndicatorRoot, { isAxis: true, date: nowDate }, function (rootElRef, classNames, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: rootElRef, className: ['fc-timeline-now-indicator-arrow'].concat(classNames).join(' '), style: coordToCss(slatCoords.dateToCoord(nowDate), context.isRtl) }, innerContent)); })))))); }));
    };
    TimelineHeader.prototype.componentDidMount = function () {
        this.updateSize();
    };
    TimelineHeader.prototype.componentDidUpdate = function () {
        this.updateSize();
    };
    TimelineHeader.prototype.updateSize = function () {
        if (this.props.onMaxCushionWidth) {
            this.props.onMaxCushionWidth(this.computeMaxCushionWidth());
        }
    };
    TimelineHeader.prototype.computeMaxCushionWidth = function () {
        return Math.max.apply(Math, (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.findElements)(this.rootElRef.current, '.fc-timeline-header-row:last-child .fc-timeline-slot-cushion').map(function (el) { return el.getBoundingClientRect().width; }));
    };
    return TimelineHeader;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var TimelineSlatCell = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineSlatCell, _super);
    function TimelineSlatCell() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TimelineSlatCell.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        var dateEnv = context.dateEnv, options = context.options, theme = context.theme;
        var date = props.date, tDateProfile = props.tDateProfile, isEm = props.isEm;
        var dateMeta = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getDateMeta)(props.date, props.todayRange, props.nowDate, props.dateProfile);
        var classNames = ['fc-timeline-slot', 'fc-timeline-slot-lane'];
        var dataAttrs = { 'data-date': dateEnv.formatIso(date, { omitTimeZoneOffset: true, omitTime: !tDateProfile.isTimeScale }) };
        var hookProps = (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)((0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({ date: dateEnv.toDate(props.date) }, dateMeta), { view: context.viewApi });
        if (isEm) {
            classNames.push('fc-timeline-slot-em');
        }
        if (tDateProfile.isTimeScale) {
            classNames.push((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.isInt)(dateEnv.countDurationsBetween(tDateProfile.normalizedRange.start, props.date, tDateProfile.labelInterval)) ?
                'fc-timeline-slot-major' :
                'fc-timeline-slot-minor');
        }
        classNames.push.apply(classNames, (props.isDay
            ? (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getDayClassNames)(dateMeta, theme)
            : (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getSlotClassNames)(dateMeta, theme)));
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RenderHook, { hookProps: hookProps, classNames: options.slotLaneClassNames, content: options.slotLaneContent, didMount: options.slotLaneDidMount, willUnmount: options.slotLaneWillUnmount, elRef: props.elRef }, function (rootElRef, customClassNames, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("td", (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({ ref: rootElRef, className: classNames.concat(customClassNames).join(' ') }, dataAttrs),
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: innerElRef }, innerContent))); }));
    };
    return TimelineSlatCell;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var TimelineSlatsBody = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineSlatsBody, _super);
    function TimelineSlatsBody() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TimelineSlatsBody.prototype.render = function () {
        var props = this.props;
        var tDateProfile = props.tDateProfile, cellElRefs = props.cellElRefs;
        var slotDates = tDateProfile.slotDates, isWeekStarts = tDateProfile.isWeekStarts;
        var isDay = !tDateProfile.isTimeScale && !tDateProfile.largeUnit;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tbody", null,
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("tr", null, slotDates.map(function (slotDate, i) {
                var key = slotDate.toISOString();
                return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineSlatCell, { key: key, elRef: cellElRefs.createRef(key), date: slotDate, dateProfile: props.dateProfile, tDateProfile: tDateProfile, nowDate: props.nowDate, todayRange: props.todayRange, isEm: isWeekStarts[i], isDay: isDay }));
            }))));
    };
    return TimelineSlatsBody;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var TimelineSlats = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineSlats, _super);
    function TimelineSlats() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.rootElRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.cellElRefs = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RefMap();
        _this.handleScrollRequest = function (request) {
            var onScrollLeftRequest = _this.props.onScrollLeftRequest;
            var coords = _this.coords;
            if (onScrollLeftRequest && coords) {
                if (request.time) {
                    var scrollLeft = coords.coordFromLeft(coords.durationToCoord(request.time));
                    onScrollLeftRequest(scrollLeft);
                }
                return true;
            }
            return null; // best?
        };
        return _this;
    }
    TimelineSlats.prototype.render = function () {
        var _a = this, props = _a.props, context = _a.context;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-slots", ref: this.rootElRef },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("table", { "aria-hidden": true, className: context.theme.getClass('table'), style: {
                    minWidth: props.tableMinWidth,
                    width: props.clientWidth,
                } },
                props.tableColGroupNode,
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineSlatsBody, { cellElRefs: this.cellElRefs, dateProfile: props.dateProfile, tDateProfile: props.tDateProfile, nowDate: props.nowDate, todayRange: props.todayRange }))));
    };
    TimelineSlats.prototype.componentDidMount = function () {
        this.updateSizing();
        this.scrollResponder = this.context.createScrollResponder(this.handleScrollRequest);
    };
    TimelineSlats.prototype.componentDidUpdate = function (prevProps) {
        this.updateSizing();
        this.scrollResponder.update(prevProps.dateProfile !== this.props.dateProfile);
    };
    TimelineSlats.prototype.componentWillUnmount = function () {
        this.scrollResponder.detach();
        if (this.props.onCoords) {
            this.props.onCoords(null);
        }
    };
    TimelineSlats.prototype.updateSizing = function () {
        var _a = this, props = _a.props, context = _a.context;
        if (props.clientWidth !== null && // is sizing stable?
            this.scrollResponder
        // ^it's possible to have clientWidth immediately after mount (when returning from print view), but w/o scrollResponder
        ) {
            var rootEl = this.rootElRef.current;
            if (rootEl.offsetWidth) { // not hidden by css
                this.coords = new TimelineCoords(this.rootElRef.current, collectCellEls(this.cellElRefs.currentMap, props.tDateProfile.slotDates), props.dateProfile, props.tDateProfile, context.dateEnv, context.isRtl);
                if (props.onCoords) {
                    props.onCoords(this.coords);
                }
                this.scrollResponder.update(false); // TODO: wouldn't have to do this if coords were in state
            }
        }
    };
    TimelineSlats.prototype.positionToHit = function (leftPosition) {
        var outerCoordCache = this.coords.outerCoordCache;
        var _a = this.context, dateEnv = _a.dateEnv, isRtl = _a.isRtl;
        var tDateProfile = this.props.tDateProfile;
        var slatIndex = outerCoordCache.leftToIndex(leftPosition);
        if (slatIndex != null) {
            // somewhat similar to what TimeGrid does. consolidate?
            var slatWidth = outerCoordCache.getWidth(slatIndex);
            var partial = isRtl ?
                (outerCoordCache.rights[slatIndex] - leftPosition) / slatWidth :
                (leftPosition - outerCoordCache.lefts[slatIndex]) / slatWidth;
            var localSnapIndex = Math.floor(partial * tDateProfile.snapsPerSlot);
            var start = dateEnv.add(tDateProfile.slotDates[slatIndex], (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.multiplyDuration)(tDateProfile.snapDuration, localSnapIndex));
            var end = dateEnv.add(start, tDateProfile.snapDuration);
            return {
                dateSpan: {
                    range: { start: start, end: end },
                    allDay: !this.props.tDateProfile.isTimeScale,
                },
                dayEl: this.cellElRefs.currentMap[slatIndex],
                left: outerCoordCache.lefts[slatIndex],
                right: outerCoordCache.rights[slatIndex],
            };
        }
        return null;
    };
    return TimelineSlats;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
function collectCellEls(elMap, slotDates) {
    return slotDates.map(function (slotDate) {
        var key = slotDate.toISOString();
        return elMap[key];
    });
}

function computeSegHCoords(segs, minWidth, timelineCoords) {
    var hcoords = [];
    if (timelineCoords) {
        for (var _i = 0, segs_1 = segs; _i < segs_1.length; _i++) {
            var seg = segs_1[_i];
            var res = timelineCoords.rangeToCoords(seg);
            var start = Math.round(res.start); // for barely-overlapping collisions
            var end = Math.round(res.end); //
            if (end - start < minWidth) {
                end = start + minWidth;
            }
            hcoords.push({ start: start, end: end });
        }
    }
    return hcoords;
}
function computeFgSegPlacements(segs, segHCoords, // might not have for every seg
eventInstanceHeights, // might not have for every seg
moreLinkHeights, // might not have for every more-link
strictOrder, maxStackCnt) {
    var segInputs = [];
    var crudePlacements = []; // when we don't know dims
    for (var i = 0; i < segs.length; i += 1) {
        var seg = segs[i];
        var instanceId = seg.eventRange.instance.instanceId;
        var height = eventInstanceHeights[instanceId];
        var hcoords = segHCoords[i];
        if (height && hcoords) {
            segInputs.push({
                index: i,
                span: hcoords,
                thickness: height,
            });
        }
        else {
            crudePlacements.push({
                seg: seg,
                hcoords: hcoords,
                top: null,
            });
        }
    }
    var hierarchy = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.SegHierarchy();
    if (strictOrder != null) {
        hierarchy.strictOrder = strictOrder;
    }
    if (maxStackCnt != null) {
        hierarchy.maxStackCnt = maxStackCnt;
    }
    var hiddenEntries = hierarchy.addSegs(segInputs);
    var hiddenPlacements = hiddenEntries.map(function (entry) { return ({
        seg: segs[entry.index],
        hcoords: entry.span,
        top: null,
    }); });
    var hiddenGroups = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.groupIntersectingEntries)(hiddenEntries);
    var moreLinkInputs = [];
    var moreLinkCrudePlacements = [];
    var extractSeg = function (entry) { return segs[entry.index]; };
    for (var i = 0; i < hiddenGroups.length; i += 1) {
        var hiddenGroup = hiddenGroups[i];
        var sortedSegs = hiddenGroup.entries.map(extractSeg);
        var height = moreLinkHeights[(0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.buildIsoString)((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.computeEarliestSegStart)(sortedSegs))]; // not optimal :(
        if (height != null) {
            // NOTE: the hiddenGroup's spanStart/spanEnd are already computed by rangeToCoords. computed during input.
            moreLinkInputs.push({
                index: segs.length + i,
                thickness: height,
                span: hiddenGroup.span,
            });
        }
        else {
            moreLinkCrudePlacements.push({
                seg: sortedSegs,
                hcoords: hiddenGroup.span,
                top: null,
            });
        }
    }
    // add more-links into the hierarchy, but don't limit
    hierarchy.maxStackCnt = -1;
    hierarchy.addSegs(moreLinkInputs);
    var visibleRects = hierarchy.toRects();
    var visiblePlacements = [];
    var maxHeight = 0;
    for (var _i = 0, visibleRects_1 = visibleRects; _i < visibleRects_1.length; _i++) {
        var rect = visibleRects_1[_i];
        var segIndex = rect.index;
        visiblePlacements.push({
            seg: segIndex < segs.length
                ? segs[segIndex] // a real seg
                : hiddenGroups[segIndex - segs.length].entries.map(extractSeg),
            hcoords: rect.span,
            top: rect.levelCoord,
        });
        maxHeight = Math.max(maxHeight, rect.levelCoord + rect.thickness);
    }
    return [
        visiblePlacements.concat(crudePlacements, hiddenPlacements, moreLinkCrudePlacements),
        maxHeight,
    ];
}

var TimelineLaneBg = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineLaneBg, _super);
    function TimelineLaneBg() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TimelineLaneBg.prototype.render = function () {
        var props = this.props;
        var highlightSeg = [].concat(props.eventResizeSegs, props.dateSelectionSegs);
        return props.timelineCoords && ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-bg" },
            this.renderSegs(props.businessHourSegs || [], props.timelineCoords, 'non-business'),
            this.renderSegs(props.bgEventSegs || [], props.timelineCoords, 'bg-event'),
            this.renderSegs(highlightSeg, props.timelineCoords, 'highlight')));
    };
    TimelineLaneBg.prototype.renderSegs = function (segs, timelineCoords, fillType) {
        var _a = this.props, todayRange = _a.todayRange, nowDate = _a.nowDate;
        var isRtl = this.context.isRtl;
        var segHCoords = computeSegHCoords(segs, 0, timelineCoords);
        var children = segs.map(function (seg, i) {
            var hcoords = segHCoords[i];
            var hStyle = coordsToCss(hcoords, isRtl);
            return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { key: (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.buildEventRangeKey)(seg.eventRange), className: "fc-timeline-bg-harness", style: hStyle }, fillType === 'bg-event' ?
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BgEvent, (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({ seg: seg }, (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getSegMeta)(seg, todayRange, nowDate))) :
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.renderFill)(fillType)));
        });
        return (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, children);
    };
    return TimelineLaneBg;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var TimelineLaneSlicer = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineLaneSlicer, _super);
    function TimelineLaneSlicer() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TimelineLaneSlicer.prototype.sliceRange = function (origRange, dateProfile, dateProfileGenerator, tDateProfile, dateEnv) {
        var normalRange = normalizeRange(origRange, tDateProfile, dateEnv);
        var segs = [];
        // protect against when the span is entirely in an invalid date region
        if (computeDateSnapCoverage(normalRange.start, tDateProfile, dateEnv)
            < computeDateSnapCoverage(normalRange.end, tDateProfile, dateEnv)) {
            // intersect the footprint's range with the grid's range
            var slicedRange = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.intersectRanges)(normalRange, tDateProfile.normalizedRange);
            if (slicedRange) {
                segs.push({
                    start: slicedRange.start,
                    end: slicedRange.end,
                    isStart: slicedRange.start.valueOf() === normalRange.start.valueOf()
                        && isValidDate(slicedRange.start, tDateProfile, dateProfile, dateProfileGenerator),
                    isEnd: slicedRange.end.valueOf() === normalRange.end.valueOf()
                        && isValidDate((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.addMs)(slicedRange.end, -1), tDateProfile, dateProfile, dateProfileGenerator),
                });
            }
        }
        return segs;
    };
    return TimelineLaneSlicer;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Slicer));

var DEFAULT_TIME_FORMAT = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createFormatter)({
    hour: 'numeric',
    minute: '2-digit',
    omitZeroMinute: true,
    meridiem: 'narrow',
});
var TimelineEvent = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineEvent, _super);
    function TimelineEvent() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    TimelineEvent.prototype.render = function () {
        var props = this.props;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.StandardEvent, (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({}, props, { extraClassNames: ['fc-timeline-event', 'fc-h-event'], defaultTimeFormat: DEFAULT_TIME_FORMAT, defaultDisplayEventTime: !props.isTimeScale })));
    };
    return TimelineEvent;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var TimelineLaneMoreLink = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineLaneMoreLink, _super);
    function TimelineLaneMoreLink() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.rootElRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        return _this;
    }
    TimelineLaneMoreLink.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var hiddenSegs = props.hiddenSegs, elRef = props.elRef, placement = props.placement, resourceId = props.resourceId;
        var top = placement.top, hcoords = placement.hcoords;
        var isVisible = hcoords && top !== null;
        var hStyle = coordsToCss(hcoords, context.isRtl);
        var extraDateSpan = resourceId ? { resourceId: resourceId } : {};
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.MoreLinkRoot, { allDayDate: null, moreCnt: hiddenSegs.length, allSegs: hiddenSegs, hiddenSegs: hiddenSegs, alignmentElRef: this.rootElRef, dateProfile: props.dateProfile, todayRange: props.todayRange, extraDateSpan: extraDateSpan, popoverContent: function () { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, hiddenSegs.map(function (seg) {
                var instanceId = seg.eventRange.instance.instanceId;
                return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { key: instanceId, style: { visibility: props.isForcedInvisible[instanceId] ? 'hidden' : '' } },
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineEvent, (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({ isTimeScale: props.isTimeScale, seg: seg, isDragging: false, isResizing: false, isDateSelecting: false, isSelected: instanceId === props.eventSelection }, (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getSegMeta)(seg, props.todayRange, props.nowDate)))));
            }))); } }, function (rootElRef, classNames, innerElRef, innerContent, handleClick, title, isExpanded, popoverId) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("a", { ref: function (el) {
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.setRef)(rootElRef, el); // for MoreLinkRoot
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.setRef)(elRef, el); // for props props
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.setRef)(_this.rootElRef, el); // for this component
            }, className: ['fc-timeline-more-link'].concat(classNames).join(' '), style: (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({ visibility: isVisible ? '' : 'hidden', top: top || 0 }, hStyle), onClick: handleClick, title: title, "aria-expanded": isExpanded, "aria-controls": popoverId },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: innerElRef, className: "fc-timeline-more-link-inner fc-sticky" }, innerContent))); }));
    };
    return TimelineLaneMoreLink;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));

var TimelineLane = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineLane, _super);
    function TimelineLane() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.slicer = new TimelineLaneSlicer();
        _this.sortEventSegs = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.sortEventSegs);
        _this.harnessElRefs = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RefMap();
        _this.moreElRefs = new _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.RefMap();
        _this.innerElRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        // TODO: memoize event positioning
        _this.state = {
            eventInstanceHeights: {},
            moreLinkHeights: {},
        };
        return _this;
    }
    TimelineLane.prototype.render = function () {
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var options = context.options;
        var dateProfile = props.dateProfile, tDateProfile = props.tDateProfile;
        var slicedProps = this.slicer.sliceProps(props, dateProfile, tDateProfile.isTimeScale ? null : props.nextDayThreshold, context, // wish we didn't have to pass in the rest of the args...
        dateProfile, context.dateProfileGenerator, tDateProfile, context.dateEnv);
        var mirrorSegs = (slicedProps.eventDrag ? slicedProps.eventDrag.segs : null) ||
            (slicedProps.eventResize ? slicedProps.eventResize.segs : null) ||
            [];
        var fgSegs = this.sortEventSegs(slicedProps.fgEventSegs, options.eventOrder);
        var fgSegHCoords = computeSegHCoords(fgSegs, options.eventMinWidth, props.timelineCoords);
        var _b = computeFgSegPlacements(fgSegs, fgSegHCoords, state.eventInstanceHeights, state.moreLinkHeights, options.eventOrderStrict, options.eventMaxStack), fgPlacements = _b[0], fgHeight = _b[1];
        var isForcedInvisible = // TODO: more convenient
         (slicedProps.eventDrag ? slicedProps.eventDrag.affectedInstances : null) ||
            (slicedProps.eventResize ? slicedProps.eventResize.affectedInstances : null) ||
            {};
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null,
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineLaneBg, { businessHourSegs: slicedProps.businessHourSegs, bgEventSegs: slicedProps.bgEventSegs, timelineCoords: props.timelineCoords, eventResizeSegs: slicedProps.eventResize ? slicedProps.eventResize.segs : [] /* bad new empty array? */, dateSelectionSegs: slicedProps.dateSelectionSegs, nowDate: props.nowDate, todayRange: props.todayRange }),
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-events fc-scrollgrid-sync-inner", ref: this.innerElRef, style: { height: fgHeight } },
                this.renderFgSegs(fgPlacements, isForcedInvisible, false, false, false),
                this.renderFgSegs(buildMirrorPlacements(mirrorSegs, props.timelineCoords, fgPlacements), {}, Boolean(slicedProps.eventDrag), Boolean(slicedProps.eventResize), false))));
    };
    TimelineLane.prototype.componentDidMount = function () {
        this.updateSize();
    };
    TimelineLane.prototype.componentDidUpdate = function (prevProps, prevState) {
        if (prevProps.eventStore !== this.props.eventStore || // external thing changed?
            prevProps.timelineCoords !== this.props.timelineCoords || // external thing changed?
            prevState.moreLinkHeights !== this.state.moreLinkHeights // HACK. see addStateEquality
        ) {
            this.updateSize();
        }
    };
    TimelineLane.prototype.updateSize = function () {
        var props = this.props;
        var timelineCoords = props.timelineCoords;
        var innerEl = this.innerElRef.current;
        if (props.onHeightChange) {
            props.onHeightChange(innerEl, false);
        }
        if (timelineCoords) {
            this.setState({
                eventInstanceHeights: (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.mapHash)(this.harnessElRefs.currentMap, function (harnessEl) { return (Math.round(harnessEl.getBoundingClientRect().height)); }),
                moreLinkHeights: (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.mapHash)(this.moreElRefs.currentMap, function (moreEl) { return (Math.round(moreEl.getBoundingClientRect().height)); }),
            }, function () {
                if (props.onHeightChange) {
                    props.onHeightChange(innerEl, true);
                }
            });
        }
        // hack
        if (props.syncParentMinHeight) {
            innerEl.parentElement.style.minHeight = innerEl.style.height;
        }
    };
    TimelineLane.prototype.renderFgSegs = function (segPlacements, isForcedInvisible, isDragging, isResizing, isDateSelecting) {
        var _a = this, harnessElRefs = _a.harnessElRefs, moreElRefs = _a.moreElRefs, props = _a.props, context = _a.context;
        var isMirror = isDragging || isResizing || isDateSelecting;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null, segPlacements.map(function (segPlacement) {
            var seg = segPlacement.seg, hcoords = segPlacement.hcoords, top = segPlacement.top;
            if (Array.isArray(seg)) { // a more-link
                var isoStr = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.buildIsoString)((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.computeEarliestSegStart)(seg));
                return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineLaneMoreLink, { key: 'm:' + isoStr /* "m" for "more" */, elRef: moreElRefs.createRef(isoStr), hiddenSegs: seg, placement: segPlacement, dateProfile: props.dateProfile, nowDate: props.nowDate, todayRange: props.todayRange, isTimeScale: props.tDateProfile.isTimeScale, eventSelection: props.eventSelection, resourceId: props.resourceId, isForcedInvisible: isForcedInvisible }));
            }
            var instanceId = seg.eventRange.instance.instanceId;
            var isVisible = isMirror || Boolean(!isForcedInvisible[instanceId] && hcoords && top !== null);
            var hStyle = coordsToCss(hcoords, context.isRtl);
            return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { key: 'e:' + instanceId /* "e" for "event" */, ref: isMirror ? null : harnessElRefs.createRef(instanceId), className: "fc-timeline-event-harness", style: (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({ visibility: isVisible ? '' : 'hidden', top: top || 0 }, hStyle) },
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineEvent, (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({ isTimeScale: props.tDateProfile.isTimeScale, seg: seg, isDragging: isDragging, isResizing: isResizing, isDateSelecting: isDateSelecting, isSelected: instanceId === props.eventSelection /* TODO: bad for mirror? */ }, (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getSegMeta)(seg, props.todayRange, props.nowDate)))));
        })));
    };
    return TimelineLane;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.BaseComponent));
TimelineLane.addStateEquality({
    eventInstanceHeights: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.isPropsEqual,
    moreLinkHeights: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.isPropsEqual,
});
function buildMirrorPlacements(mirrorSegs, timelineCoords, fgPlacements) {
    if (!mirrorSegs.length || !timelineCoords) {
        return [];
    }
    var topsByInstanceId = buildAbsoluteTopHash(fgPlacements); // TODO: cache this at first render?
    return mirrorSegs.map(function (seg) { return ({
        seg: seg,
        hcoords: timelineCoords.rangeToCoords(seg),
        top: topsByInstanceId[seg.eventRange.instance.instanceId],
    }); });
}
function buildAbsoluteTopHash(placements) {
    var topsByInstanceId = {};
    for (var _i = 0, placements_1 = placements; _i < placements_1.length; _i++) {
        var placement = placements_1[_i];
        var seg = placement.seg;
        if (!Array.isArray(seg)) { // doesn't represent a more-link
            topsByInstanceId[seg.eventRange.instance.instanceId] = placement.top;
        }
    }
    return topsByInstanceId;
}

var TimelineGrid = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineGrid, _super);
    function TimelineGrid() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.slatsRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.state = {
            coords: null,
        };
        _this.handeEl = function (el) {
            if (el) {
                _this.context.registerInteractiveComponent(_this, { el: el });
            }
            else {
                _this.context.unregisterInteractiveComponent(_this);
            }
        };
        _this.handleCoords = function (coords) {
            _this.setState({ coords: coords });
            if (_this.props.onSlatCoords) {
                _this.props.onSlatCoords(coords);
            }
        };
        return _this;
    }
    TimelineGrid.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var options = context.options;
        var dateProfile = props.dateProfile, tDateProfile = props.tDateProfile;
        var timerUnit = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.greatestDurationDenominator)(tDateProfile.slotDuration).unit;
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-body", ref: this.handeEl, style: {
                minWidth: props.tableMinWidth,
                height: props.clientHeight,
                width: props.clientWidth,
            } },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.NowTimer, { unit: timerUnit }, function (nowDate, todayRange) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.Fragment, null,
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineSlats, { ref: _this.slatsRef, dateProfile: dateProfile, tDateProfile: tDateProfile, nowDate: nowDate, todayRange: todayRange, clientWidth: props.clientWidth, tableColGroupNode: props.tableColGroupNode, tableMinWidth: props.tableMinWidth, onCoords: _this.handleCoords, onScrollLeftRequest: props.onScrollLeftRequest }),
                (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineLane, { dateProfile: dateProfile, tDateProfile: props.tDateProfile, nowDate: nowDate, todayRange: todayRange, nextDayThreshold: options.nextDayThreshold, businessHours: props.businessHours, eventStore: props.eventStore, eventUiBases: props.eventUiBases, dateSelection: props.dateSelection, eventSelection: props.eventSelection, eventDrag: props.eventDrag, eventResize: props.eventResize, timelineCoords: state.coords, syncParentMinHeight: true }),
                (options.nowIndicator && state.coords && state.coords.isDateInRange(nowDate)) && ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { className: "fc-timeline-now-indicator-container" },
                    (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.NowIndicatorRoot, { isAxis: false, date: nowDate }, function (rootElRef, classNames, innerElRef, innerContent) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: rootElRef, className: ['fc-timeline-now-indicator-line'].concat(classNames).join(' '), style: coordToCss(state.coords.dateToCoord(nowDate), context.isRtl) }, innerContent)); }))))); })));
    };
    // Hit System
    // ------------------------------------------------------------------------------------------
    TimelineGrid.prototype.queryHit = function (positionLeft, positionTop, elWidth, elHeight) {
        var slats = this.slatsRef.current;
        var slatHit = slats.positionToHit(positionLeft);
        if (slatHit) {
            return {
                dateProfile: this.props.dateProfile,
                dateSpan: slatHit.dateSpan,
                rect: {
                    left: slatHit.left,
                    right: slatHit.right,
                    top: 0,
                    bottom: elHeight,
                },
                dayEl: slatHit.dayEl,
                layer: 0,
            };
        }
        return null;
    };
    return TimelineGrid;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.DateComponent));

var TimelineView = /** @class */ (function (_super) {
    (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__extends)(TimelineView, _super);
    function TimelineView() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.buildTimelineDateProfile = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.memoize)(buildTimelineDateProfile);
        _this.scrollGridRef = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createRef)();
        _this.state = {
            slatCoords: null,
            slotCushionMaxWidth: null,
        };
        _this.handleSlatCoords = function (slatCoords) {
            _this.setState({ slatCoords: slatCoords });
        };
        _this.handleScrollLeftRequest = function (scrollLeft) {
            var scrollGrid = _this.scrollGridRef.current;
            scrollGrid.forceScrollLeft(0, scrollLeft);
        };
        _this.handleMaxCushionWidth = function (slotCushionMaxWidth) {
            _this.setState({
                slotCushionMaxWidth: Math.ceil(slotCushionMaxWidth), // for less rerendering TODO: DRY
            });
        };
        return _this;
    }
    TimelineView.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, state = _a.state, context = _a.context;
        var options = context.options;
        var stickyHeaderDates = !props.forPrint && (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getStickyHeaderDates)(options);
        var stickyFooterScrollbar = !props.forPrint && (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.getStickyFooterScrollbar)(options);
        var tDateProfile = this.buildTimelineDateProfile(props.dateProfile, context.dateEnv, options, context.dateProfileGenerator);
        var extraClassNames = [
            'fc-timeline',
            options.eventOverlap === false ? 'fc-timeline-overlap-disabled' : '',
        ];
        var slotMinWidth = options.slotMinWidth;
        var slatCols = buildSlatCols(tDateProfile, slotMinWidth || this.computeFallbackSlotMinWidth(tDateProfile));
        var sections = [
            {
                type: 'header',
                key: 'header',
                isSticky: stickyHeaderDates,
                chunks: [{
                        key: 'timeline',
                        content: function (contentArg) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineHeader, { dateProfile: props.dateProfile, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, tableMinWidth: contentArg.tableMinWidth, tableColGroupNode: contentArg.tableColGroupNode, tDateProfile: tDateProfile, slatCoords: state.slatCoords, onMaxCushionWidth: slotMinWidth ? null : _this.handleMaxCushionWidth })); },
                    }],
            },
            {
                type: 'body',
                key: 'body',
                liquid: true,
                chunks: [{
                        key: 'timeline',
                        content: function (contentArg) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(TimelineGrid, (0,tslib__WEBPACK_IMPORTED_MODULE_4__.__assign)({}, props, { clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, tableMinWidth: contentArg.tableMinWidth, tableColGroupNode: contentArg.tableColGroupNode, tDateProfile: tDateProfile, onSlatCoords: _this.handleSlatCoords, onScrollLeftRequest: _this.handleScrollLeftRequest }))); },
                    }],
            },
        ];
        if (stickyFooterScrollbar) {
            sections.push({
                type: 'footer',
                key: 'footer',
                isSticky: true,
                chunks: [{
                        key: 'timeline',
                        content: _fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.renderScrollShim,
                    }],
            });
        }
        return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.ViewRoot, { viewSpec: context.viewSpec }, function (rootElRef, classNames) { return ((0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)("div", { ref: rootElRef, className: extraClassNames.concat(classNames).join(' ') },
            (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createElement)(_fullcalendar_scrollgrid__WEBPACK_IMPORTED_MODULE_3__.ScrollGrid, { ref: _this.scrollGridRef, liquid: !props.isHeightAuto && !props.forPrint, collapsibleWidth: false, colGroups: [
                    { cols: slatCols },
                ], sections: sections }))); }));
    };
    TimelineView.prototype.computeFallbackSlotMinWidth = function (tDateProfile) {
        return Math.max(30, ((this.state.slotCushionMaxWidth || 0) / tDateProfile.slotsPerLabel));
    };
    return TimelineView;
}(_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.DateComponent));
function buildSlatCols(tDateProfile, slotMinWidth) {
    return [{
            span: tDateProfile.slotCnt,
            minWidth: slotMinWidth || 1, // needs to be a non-zero number to trigger horizontal scrollbars!??????
        }];
}

var main = (0,_fullcalendar_common__WEBPACK_IMPORTED_MODULE_1__.createPlugin)({
    deps: [
        _fullcalendar_premium_common__WEBPACK_IMPORTED_MODULE_2__["default"],
    ],
    initialView: 'timelineDay',
    views: {
        timeline: {
            component: TimelineView,
            usesMinMaxTime: true,
            eventResizableFromStart: true, // how is this consumed for TimelineView tho?
        },
        timelineDay: {
            type: 'timeline',
            duration: { days: 1 },
        },
        timelineWeek: {
            type: 'timeline',
            duration: { weeks: 1 },
        },
        timelineMonth: {
            type: 'timeline',
            duration: { months: 1 },
        },
        timelineYear: {
            type: 'timeline',
            duration: { years: 1 },
        },
    },
});

/* harmony default export */ __webpack_exports__["default"] = (main);

//# sourceMappingURL=main.js.map


/***/ }),

/***/ "./node_modules/@fullcalendar/common/main.css":
/*!****************************************************!*\
  !*** ./node_modules/@fullcalendar/common/main.css ***!
  \****************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/@fullcalendar/resource-timeline/main.css":
/*!***************************************************************!*\
  !*** ./node_modules/@fullcalendar/resource-timeline/main.css ***!
  \***************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/@fullcalendar/timeline/main.css":
/*!******************************************************!*\
  !*** ./node_modules/@fullcalendar/timeline/main.css ***!
  \******************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/fullcalendar/plugin.scss":
/*!**************************************!*\
  !*** ./src/fullcalendar/plugin.scss ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/tslib/tslib.es6.js":
/*!*****************************************!*\
  !*** ./node_modules/tslib/tslib.es6.js ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "__assign": function() { return /* binding */ __assign; },
/* harmony export */   "__asyncDelegator": function() { return /* binding */ __asyncDelegator; },
/* harmony export */   "__asyncGenerator": function() { return /* binding */ __asyncGenerator; },
/* harmony export */   "__asyncValues": function() { return /* binding */ __asyncValues; },
/* harmony export */   "__await": function() { return /* binding */ __await; },
/* harmony export */   "__awaiter": function() { return /* binding */ __awaiter; },
/* harmony export */   "__classPrivateFieldGet": function() { return /* binding */ __classPrivateFieldGet; },
/* harmony export */   "__classPrivateFieldIn": function() { return /* binding */ __classPrivateFieldIn; },
/* harmony export */   "__classPrivateFieldSet": function() { return /* binding */ __classPrivateFieldSet; },
/* harmony export */   "__createBinding": function() { return /* binding */ __createBinding; },
/* harmony export */   "__decorate": function() { return /* binding */ __decorate; },
/* harmony export */   "__exportStar": function() { return /* binding */ __exportStar; },
/* harmony export */   "__extends": function() { return /* binding */ __extends; },
/* harmony export */   "__generator": function() { return /* binding */ __generator; },
/* harmony export */   "__importDefault": function() { return /* binding */ __importDefault; },
/* harmony export */   "__importStar": function() { return /* binding */ __importStar; },
/* harmony export */   "__makeTemplateObject": function() { return /* binding */ __makeTemplateObject; },
/* harmony export */   "__metadata": function() { return /* binding */ __metadata; },
/* harmony export */   "__param": function() { return /* binding */ __param; },
/* harmony export */   "__read": function() { return /* binding */ __read; },
/* harmony export */   "__rest": function() { return /* binding */ __rest; },
/* harmony export */   "__spread": function() { return /* binding */ __spread; },
/* harmony export */   "__spreadArray": function() { return /* binding */ __spreadArray; },
/* harmony export */   "__spreadArrays": function() { return /* binding */ __spreadArrays; },
/* harmony export */   "__values": function() { return /* binding */ __values; }
/* harmony export */ });
/******************************************************************************
Copyright (c) Microsoft Corporation.

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
***************************************************************************** */
/* global Reflect, Promise */

var extendStatics = function(d, b) {
    extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (Object.prototype.hasOwnProperty.call(b, p)) d[p] = b[p]; };
    return extendStatics(d, b);
};

function __extends(d, b) {
    if (typeof b !== "function" && b !== null)
        throw new TypeError("Class extends value " + String(b) + " is not a constructor or null");
    extendStatics(d, b);
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
}

var __assign = function() {
    __assign = Object.assign || function __assign(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
        }
        return t;
    }
    return __assign.apply(this, arguments);
}

function __rest(s, e) {
    var t = {};
    for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0)
        t[p] = s[p];
    if (s != null && typeof Object.getOwnPropertySymbols === "function")
        for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) {
            if (e.indexOf(p[i]) < 0 && Object.prototype.propertyIsEnumerable.call(s, p[i]))
                t[p[i]] = s[p[i]];
        }
    return t;
}

function __decorate(decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
}

function __param(paramIndex, decorator) {
    return function (target, key) { decorator(target, key, paramIndex); }
}

function __metadata(metadataKey, metadataValue) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(metadataKey, metadataValue);
}

function __awaiter(thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
}

function __generator(thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g;
    return g = { next: verb(0), "throw": verb(1), "return": verb(2) }, typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (_) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
}

var __createBinding = Object.create ? (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    var desc = Object.getOwnPropertyDescriptor(m, k);
    if (!desc || ("get" in desc ? !m.__esModule : desc.writable || desc.configurable)) {
        desc = { enumerable: true, get: function() { return m[k]; } };
    }
    Object.defineProperty(o, k2, desc);
}) : (function(o, m, k, k2) {
    if (k2 === undefined) k2 = k;
    o[k2] = m[k];
});

function __exportStar(m, o) {
    for (var p in m) if (p !== "default" && !Object.prototype.hasOwnProperty.call(o, p)) __createBinding(o, m, p);
}

function __values(o) {
    var s = typeof Symbol === "function" && Symbol.iterator, m = s && o[s], i = 0;
    if (m) return m.call(o);
    if (o && typeof o.length === "number") return {
        next: function () {
            if (o && i >= o.length) o = void 0;
            return { value: o && o[i++], done: !o };
        }
    };
    throw new TypeError(s ? "Object is not iterable." : "Symbol.iterator is not defined.");
}

function __read(o, n) {
    var m = typeof Symbol === "function" && o[Symbol.iterator];
    if (!m) return o;
    var i = m.call(o), r, ar = [], e;
    try {
        while ((n === void 0 || n-- > 0) && !(r = i.next()).done) ar.push(r.value);
    }
    catch (error) { e = { error: error }; }
    finally {
        try {
            if (r && !r.done && (m = i["return"])) m.call(i);
        }
        finally { if (e) throw e.error; }
    }
    return ar;
}

/** @deprecated */
function __spread() {
    for (var ar = [], i = 0; i < arguments.length; i++)
        ar = ar.concat(__read(arguments[i]));
    return ar;
}

/** @deprecated */
function __spreadArrays() {
    for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
    for (var r = Array(s), k = 0, i = 0; i < il; i++)
        for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
            r[k] = a[j];
    return r;
}

function __spreadArray(to, from, pack) {
    if (pack || arguments.length === 2) for (var i = 0, l = from.length, ar; i < l; i++) {
        if (ar || !(i in from)) {
            if (!ar) ar = Array.prototype.slice.call(from, 0, i);
            ar[i] = from[i];
        }
    }
    return to.concat(ar || Array.prototype.slice.call(from));
}

function __await(v) {
    return this instanceof __await ? (this.v = v, this) : new __await(v);
}

function __asyncGenerator(thisArg, _arguments, generator) {
    if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
    var g = generator.apply(thisArg, _arguments || []), i, q = [];
    return i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i;
    function verb(n) { if (g[n]) i[n] = function (v) { return new Promise(function (a, b) { q.push([n, v, a, b]) > 1 || resume(n, v); }); }; }
    function resume(n, v) { try { step(g[n](v)); } catch (e) { settle(q[0][3], e); } }
    function step(r) { r.value instanceof __await ? Promise.resolve(r.value.v).then(fulfill, reject) : settle(q[0][2], r); }
    function fulfill(value) { resume("next", value); }
    function reject(value) { resume("throw", value); }
    function settle(f, v) { if (f(v), q.shift(), q.length) resume(q[0][0], q[0][1]); }
}

function __asyncDelegator(o) {
    var i, p;
    return i = {}, verb("next"), verb("throw", function (e) { throw e; }), verb("return"), i[Symbol.iterator] = function () { return this; }, i;
    function verb(n, f) { i[n] = o[n] ? function (v) { return (p = !p) ? { value: __await(o[n](v)), done: n === "return" } : f ? f(v) : v; } : f; }
}

function __asyncValues(o) {
    if (!Symbol.asyncIterator) throw new TypeError("Symbol.asyncIterator is not defined.");
    var m = o[Symbol.asyncIterator], i;
    return m ? m.call(o) : (o = typeof __values === "function" ? __values(o) : o[Symbol.iterator](), i = {}, verb("next"), verb("throw"), verb("return"), i[Symbol.asyncIterator] = function () { return this; }, i);
    function verb(n) { i[n] = o[n] && function (v) { return new Promise(function (resolve, reject) { v = o[n](v), settle(resolve, reject, v.done, v.value); }); }; }
    function settle(resolve, reject, d, v) { Promise.resolve(v).then(function(v) { resolve({ value: v, done: d }); }, reject); }
}

function __makeTemplateObject(cooked, raw) {
    if (Object.defineProperty) { Object.defineProperty(cooked, "raw", { value: raw }); } else { cooked.raw = raw; }
    return cooked;
};

var __setModuleDefault = Object.create ? (function(o, v) {
    Object.defineProperty(o, "default", { enumerable: true, value: v });
}) : function(o, v) {
    o["default"] = v;
};

function __importStar(mod) {
    if (mod && mod.__esModule) return mod;
    var result = {};
    if (mod != null) for (var k in mod) if (k !== "default" && Object.prototype.hasOwnProperty.call(mod, k)) __createBinding(result, mod, k);
    __setModuleDefault(result, mod);
    return result;
}

function __importDefault(mod) {
    return (mod && mod.__esModule) ? mod : { default: mod };
}

function __classPrivateFieldGet(receiver, state, kind, f) {
    if (kind === "a" && !f) throw new TypeError("Private accessor was defined without a getter");
    if (typeof state === "function" ? receiver !== state || !f : !state.has(receiver)) throw new TypeError("Cannot read private member from an object whose class did not declare it");
    return kind === "m" ? f : kind === "a" ? f.call(receiver) : f ? f.value : state.get(receiver);
}

function __classPrivateFieldSet(receiver, state, value, kind, f) {
    if (kind === "m") throw new TypeError("Private method is not writable");
    if (kind === "a" && !f) throw new TypeError("Private accessor was defined without a setter");
    if (typeof state === "function" ? receiver !== state || !f : !state.has(receiver)) throw new TypeError("Cannot write private member to an object whose class did not declare it");
    return (kind === "a" ? f.call(receiver, value) : f ? f.value = value : state.set(receiver, value)), value;
}

function __classPrivateFieldIn(state, receiver) {
    if (receiver === null || (typeof receiver !== "object" && typeof receiver !== "function")) throw new TypeError("Cannot use 'in' operator on non-object");
    return typeof state === "function" ? receiver === state : state.has(receiver);
}


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
/*!************************************!*\
  !*** ./src/fullcalendar/plugin.js ***!
  \************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _fullcalendar_resource_timeline__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @fullcalendar/resource-timeline */ "./node_modules/@fullcalendar/resource-timeline/main.js");
/* harmony import */ var _plugin_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./plugin.scss */ "./src/fullcalendar/plugin.scss");
// import { Calendar } from '@fullcalendar/core';


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

function init_calendar(events) {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
    // plugins: [ 'dayGrid' ],
    // defaultView: 'dayGridMonth',
    plugins: [_fullcalendar_resource_timeline__WEBPACK_IMPORTED_MODULE_0__["default"]],
    initialView: 'viewTimelineDays',
    header: {
      left: 'prev,next today',
      center: 'title',
      right: ''
    },
    expandRows: false,
    nowIndicator: true,
    views: {
      viewTimelineDays: {
        type: 'resourceTimeline',
        duration: {
          days: 28
        },
        // buttonText: '2 Years',
        slotDuration: {
          days: 1
        }
      }
    },
    events: events,

    eventPositioned(view, element) {
      displayBookings();
    }

  });
  calendar.render();
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
// 				defaultView: 'timelineMonth',
// 				defaultDate: '2022-09-07',
// 				header: {
// 					left: 'prev,next today',
// 					center: 'title',
// 				},
// 				events: [
// 					{
// 						title : 'event1',
// 						start : '2022-09-27'
// 					},
// 					{
// 						title : 'event2',
// 						start : '2022-09-15',
// 						end : '2022-09-17'
// 					},
// 					{
// 						title : 'event3',
// 						start : '2022-09-09T12:30:00',
// 						allDay : false // will make the time show
// 					}
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