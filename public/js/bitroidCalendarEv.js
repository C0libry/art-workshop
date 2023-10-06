// CalendarEv by Bitroid
// version 1.0.0, build: 1
// Copyright © 2017 Bitroid | bitroid.ru
// licensed under MIT license.
//
// Project page:    http://bitroid.ru/plugins/CalendarEv/
// GitHub page:     https://github.com/bitroidhub/CalendarEv/
//
// =====================================================================================================================

(function( $ ) {

	try {
        var timeNow = moment();
    } catch(e){
        alert("Can't find Moment.js, please read the ion.calendar description.");
        throw new Error("Can't find Moment.js library");
    }

    var methods = {
        init: function(options){
            var settings = $.extend({
                    lang: "en",
                    mondayFirst: true,
                    years: "10",
                    format: "",
                    startDate: "",
                    hideArrows: false,
                    onClick: null,
                    onReady: null,
                    clickable: true,
                    events : [],
                    containers : {
                        events : ".calendarev-events-container"
                    },
                    showEventBlock: false
                }, options),
                html, i;


            return this.each(function(){
                var $calendar = $(this);

                //prevent overwrite
                if($calendar.data("isActive")) {
                    return;
                }
                $calendar.data("isActive", true);



                var $prev,
                    $next,
                    $month,
                    $year,
                    $day,

                    timeSelected,
                    timeNowLocal = moment(timeNow.locale(settings.lang)),
                    timeForWork,
                    weekFirstDay,
                    weekLastDay,
                    monthLastDay,

                    tempYears,
                    fromYear,
                    toYear,
                    firstStart = true;



                // public methods
                this.updateData = function(options){
                    settings = $.extend(settings, options);
                    removeHTML();
                };



                // private methods
                var removeHTML = function(){
                    $prev.off();
                    $next.off();
                    $month.off();
                    $year.off();
                    $calendar.empty();

                    prepareData();
                    prepareCalendar();
                };

                var prepareData = function(){
                    // start date
                    if(settings.startDate) {
                        if(settings.format.indexOf("L") >= 0) {
                            timeSelected = moment(settings.startDate, "YYYY.MM.DD").locale(settings.lang);
                        } else {
                            timeSelected = moment(settings.startDate, settings.format).locale(settings.lang);
                        }
                    }


                    // years diapason
                    settings.years = settings.years.toString();
                    tempYears = settings.years.split("-");
                    if(tempYears.length === 1) {
                        fromYear = moment().subtract(tempYears[0], "years").format("YYYY");
                        toYear = moment().format("YYYY");
                    } else if(tempYears.length === 2){
                        fromYear = tempYears[0];
                        toYear = tempYears[1];
                    }
                    fromYear = parseInt(fromYear);
                    toYear = parseInt(toYear);

                    if(toYear < timeNowLocal.format("YYYY")) {
                        timeNowLocal.year(toYear).month(11);
                    }
                    if(fromYear > timeNowLocal.format("YYYY")) {
                        timeNowLocal.year(fromYear).month(0);
                    }
                };

                var prepareCalendar = function(){
                    timeForWork = moment(timeNowLocal);

                    weekFirstDay = parseInt(timeForWork.startOf("month").format("d"));
                    weekLastDay = parseInt(timeForWork.endOf("month").format("d"));
                    monthLastDay = parseInt(timeForWork.endOf("month").format("D"));

                    html  = '<div class="calendarev-container-calendar">';
                    html += '<div class="calendarev-calendar-head">';
                    html += '<span class="prev">&#8592;</span>';
                    html += '<span class="next">&#8594;</span>';
                    html += '<div class="calendarev-selects">';

                    // head month
                    html += '<select class="calendarev-month">';
                    for(i = 0; i < 12; i++){
                        if(i === parseInt(timeNowLocal.format("M")) - 1){
                            html += '<option value="' + i + '" selected="selected">' + timeForWork.month(i).format("MMMM") + '</option>';
                        } else {
                            html += '<option value="' + i + '">' + timeForWork.month(i).format("MMMM") + '</option>';
                        }
                    }
                    html += '</select>';

                    // head year
                    html += '<select class="calendarev-years">';
                    for(i = fromYear; i <= toYear; i++){
                        if(i === parseInt(timeNowLocal.format("YYYY"))){
                            html += '<option value="' + i + '" selected="selected">' + i + '</option>';
                        } else {
                            html += '<option value="' + i + '">' + i + '</option>';
                        }
                    }
                    html += '</select></div>';

                    html += '</div>';

                    if(settings.sundayFirst) {

                        // week
                        html += '<table class="calendarev-calendar-body"><tr>';
                        for(i = 0; i < 7; i++) {
                            html += '<th>' + timeForWork.day(i).format("dd") + '</th>';
                        }
                        html += '</tr>';

                        // month
                        html += '<tr>';
                        // empty days
                        for(i = 0; i < weekFirstDay; i++) {
                            html += '<td class="calendarev-day-empty">&nbsp;</td>';
                        }
                        // days
                        for(i = 1; i <= monthLastDay; i++) {

                        	var classevent = "";
                        	var eventhtml = "";
                        	var	dataevent = new Array();
                        	if (settings.events != null && settings.showEventBlock) {
                        		var day_event = moment(timeNow.locale(settings.lang));
                        		$(settings.events).each(function(index, key){
                        			day_event = parseInt(key.day) + "." + parseInt(key.month) + "." + parseInt(key.year);
                        			if (day_event == moment(timeNowLocal).date(i).format("D.M.YYYY")) {
                        				classevent = "calendarev-day-event";
                        				eventhtml += key.event_description + "<br>";
                        				dataevent.push(index);
                        			}
                        		})
                        	}

                            // current day
                            if(moment(timeNowLocal).date(i).format("D.M.YYYY") === timeNow.format("D.M.YYYY")) {
                            	if (eventhtml != "") {
                                	html += '<td class="calendarev-day calendarev-day-current '+classevent+'" data-event="'+dataevent+'">' + i + '<span class="event-popup">' + eventhtml + '</span></td>';
                                }	else {
                                	html += '<td class="calendarev-day calendarev-day-current '+classevent+'">' + i + '</td>';
                            	}
                            } else if(timeSelected && moment(timeNowLocal).date(i).format("D.M.YYYY") === timeSelected.format("D.M.YYYY")) {
                            	if (eventhtml != "") {
                            		html += '<td class="calendarev-day calendarev-day-selected '+classevent+'" data-event="'+dataevent+'">' + i + '<span class="event-popup">' + eventhtml + '</span></td>';
                            	}	else {
	                                html += '<td class="calendarev-day calendarev-day-selected '+classevent+'">' + i + '</td>';
	                            }
                            } else {
                            	if (eventhtml != "") {
                            		html += '<td class="calendarev-day '+classevent+'" data-event="'+dataevent+'">' + i + '<span class="event-popup">' + eventhtml + '</span></td>';
                            	}	else {
                                	html += '<td class="calendarev-day '+classevent+'">' + i + '</td>';
                                }
                            }

                            // new week - new line
                            if((weekFirstDay + i) / 7 === Math.floor((weekFirstDay + i) / 7)) {
                                html += '</tr><tr>';
                            }
                        }
                        // empty days
                        for(i = weekLastDay; i < 6; i++) {
                            html += '<td class="calendarev-day-empty">&nbsp;</td>';
                        }
                        html += '</tr></table>';

                        if (settings.showEventBlock) {
                        	html += '<div class="calendarev-events-container"></div>';
                        }

                    } else {

                        // week
                        html += '<table class="calendarev-calendar-body"><tr>';
                        for(i = 1; i < 8; i++) {
                            if(i < 7) {
                                html += '<th>' + timeForWork.day(i).format("dd") + '</th>';
                            } else {
                                html += '<th>' + timeForWork.day(0).format("dd") + '</th>';
                            }
                        }
                        html += '</tr>';

                        // days
                        html += '<tr>';

                        // empty days
                        if(weekFirstDay > 0) {
                            weekFirstDay = weekFirstDay - 1;
                        } else {
                            weekFirstDay = 6;
                        }
                        for(i = 0; i < weekFirstDay; i++) {
                            html += '<td class="calendarev-day-empty">&nbsp;</td>';
                        }


                        for(i = 1; i <= monthLastDay; i++) {

                        	var classevent = "";
                        	var eventhtml = "";
                        	var	dataevent = new Array();
                        	if (settings.events != null) {
                        		var day_event = moment(timeNow.locale(settings.lang));
                        		$(settings.events).each(function(index, key){
                        			day_event = parseInt(key.day) + "." + parseInt(key.month) + "." + parseInt(key.year);
                        			if (day_event == moment(timeNowLocal).date(i).format("D.M.YYYY")) {
                        				classevent = "calendarev-day-event";
                        				eventhtml += key.event_description + "<br>";
                        				dataevent.push(index);
                        			}
                        		})
                        	}

                            // current day
                            if(moment(timeNowLocal).date(i).format("D.M.YYYY") === timeNow.format("D.M.YYYY")) {
                                if (eventhtml != "") {
                                	html += '<td class="calendarev-day calendarev-day-current '+classevent+'" data-event="'+dataevent+'">' + i + '<span class="event-popup">' + eventhtml + '</span></td>';
                                }	else {
                                	html += '<td class="calendarev-day calendarev-day-current '+classevent+'">' + i + '</td>';
                                }
                            } else if(timeSelected && moment(timeNowLocal).date(i).format("D.M.YYYY") === timeSelected.format("D.M.YYYY")) {
                            	if (eventhtml != "") {
                            		html += '<td class="calendarev-day calendarev-day-selected '+classevent+'" data-event="'+dataevent+'">' + i + '<span class="event-popup">' + eventhtml + '</span></td>';
                            	}	else {
                                	html += '<td class="calendarev-day calendarev-day-selected '+classevent+'">' + i + '</td>';
                            	}
                            } else {
                            	if (eventhtml != "") {
                            		html += '<td class="calendarev-day '+classevent+'" data-event="'+dataevent+'">' + i + '<span class="event-popup">' + eventhtml + '</span></td>';
                            	}	else {
                                	html += '<td class="calendarev-day '+classevent+'">' + i + '</td>';
                            	}
                            }

                            // new week - new line
                            if((weekFirstDay + i) / 7 === Math.floor((weekFirstDay + i) / 7)) {
                                html += '</tr><tr>';
                            }
                        }
                        // empty days
                        if(weekLastDay < 1) {
                            weekLastDay = 7;
                        }
                        for(i = weekLastDay - 1; i < 6; i++) {
                            html += '<td class="calendarev-day-empty">&nbsp;</td>';
                        }
                        html += '</tr></table>';

                        if (settings.showEventBlock) {
                        	html += '<div class="calendarev-events-container"></div>';
                        }
                    }

                    html += '</div>';


                    placeCalendar();
                };

                var placeCalendar = function(){
                    $calendar.html(html);

                    $prev = $calendar.find(".calendarev-calendar-head .prev");
                    $next = $calendar.find(".calendarev-calendar-head .next");
                    $month = $calendar.find(".calendarev-month");
                    $year = $calendar.find(".calendarev-years");
                    $day = $calendar.find(".calendarev-day");
                    $events = $calendar.find(".calendarev-day-event");
                    $events_container = $(document).find(settings.containers.events);

                    if(settings.hideArrows) {
                        $prev[0].style.display = "none";
                        $next[0].style.display = "none";
                    } else {
                        $prev.on("click", function(e){
                            e.preventDefault();
                            timeNowLocal.subtract(1, "months");
                            if(parseInt(timeNowLocal.format("YYYY")) < fromYear) {
                                timeNowLocal.add(1, "months");
                            }
                            removeHTML();
                        });
                        $next.on("click", function(e){
                            e.preventDefault();
                            timeNowLocal.add(1, "months");
                            if(parseInt(timeNowLocal.format("YYYY")) > toYear) {
                                timeNowLocal.subtract(1,"months");
                            }
                            removeHTML();
                        });
                    }

                    $month.on("change", function(e){
                        e.preventDefault();
                        var toMonth = $(this).prop("value");
                        timeNowLocal.month(parseInt(toMonth));
                        removeHTML();
                    });
                    $year.on("change", function(e){
                        e.preventDefault();
                        var toYear = $(this).prop("value");
                        timeNowLocal.year(parseInt(toYear));
                        removeHTML();
                    });

                    if(settings.clickable) {
                        $day.on("click", function(e){
                            e.preventDefault();
                            var toDay = $(this).text();
                            timeNowLocal.date(parseInt(toDay));
                            timeSelected = moment(timeNowLocal);
                            if(settings.format.indexOf("L") >= 0) {
                                settings.startDate = timeSelected.format("YYYY-MM-DD");
                            } else {
                                settings.startDate = timeSelected.format(settings.format);
                            }
                            if (settings.showEventBlock) {
                                $day.removeClass('calendarev-day-selected');
                                $(this).addClass('calendarev-day-selected');
                                $events_container.html('');
                            }
                             // trigger callback function
                            if(typeof settings.onClick === "function") {
                                if(settings.format) {
                                    if(settings.format === "moment") {
                                        settings.onClick.call(this, timeSelected);
                                    } else {
                                        settings.onClick.call(this, timeSelected.format(settings.format));
                                    }
                                } else {
                                    settings.onClick.call(this, timeSelected.format());
                                }
                            }
                        });
                    }

                    if (settings.showEventBlock) {
                        $events.on("click", function(e){
                            e.preventDefault();
                            var dataevent = $(this).attr('data-event').split(',');
                            htmltext = "";
                            for (var i = 0; i <= dataevent.length - 1; i++) {
                                var eventblock = settings.events[dataevent[i]];
                                if (i != 0)  htmltext += '</div>';
                                htmltext += '<div class="event-block">';
                                if (eventblock.event_title != undefined && eventblock.event_title != "") {
                                    htmltext += "<h3>"+eventblock.event_title+"</h3>";
                                }
                                if (eventblock.event_body != undefined && eventblock.event_body != "") {
                                    htmltext += "<article>"+eventblock.event_body+"</article>";
                                }
                            }
                            $events_container.html(htmltext);
                        });
                    }

                    // trigger onReady function
                    if(typeof settings.onReady === "function") {
                        if(settings.format) {
                            if(settings.format === "moment") {
                                settings.onReady.call(this, timeNowLocal);
                            } else {
                                settings.onReady.call(this, timeNowLocal.format(settings.format));
                            }
                        } else {
                            settings.onReady.call(this, timeNowLocal.format());
                        }
                    }

                    // go to startDate
                    if(settings.startDate && firstStart) {
                        firstStart = false;
                        timeNowLocal.year(parseInt(timeSelected.format("YYYY")));
                        timeNowLocal.month(parseInt(timeSelected.format("M") - 1));
                        removeHTML();
                    }
                };



                // yarrr!
                prepareData();
                prepareCalendar();
            });
        },
        update: function(options){
            return this.each(function(){
                this.updateData(options);
            });
        }
    };
     
    $.fn.bitroidCalendarEv = function(method){
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist for jQuery.bitroidCalendarEv');
        }
    };
})(jQuery);



