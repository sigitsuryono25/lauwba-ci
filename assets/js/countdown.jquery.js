(function ($) {
	'use strict';
	$.fn.countdown = function (options) {
		return $.fn.countdown.begin(this, $.extend({
			year: 2016, // YYYY Format
			month: 1, // 1-12
			day: 1, // 1-31
			hour: 0, // 24 hour format 0-23
			minute: 0, // 0-59
			second: 0, // 0-59
			timezone: -6, // http://en.wikipedia.org/wiki/List_of_tz_database_time_zones
			labels: true, // If false days hours seconds and monutes labels will not be created
			onFinish: function () { }  // Executes client side when timer is zero
		}, options));
	};

	$.fn.countdown.begin = function (parent, settings) {

		// Define Variables
		var timespan, start, end;

		// Define Target Date/time
		end = new Date(settings.year, settings.month - 1, settings.day, settings.hour, settings.minute, settings.second);

		// Converts Local Timezone to Target Timezone
		start = $.fn.countdown.convertTimezone(settings.timezone);

		// Defines countdown data
		timespan = $.fn.countdown.getTimeRemaining(start, end, settings);

		// Check if the script has run before
		if (!settings.init) {

			// Create elements
			$.each(timespan, function (k, v) {
				// Define variables being used
				var container, wrapper, time, label;

				// Create elements container
				container = $('<div/>').addClass('col-2 d-flex justify-content-center').attr('id', k);

				// Create wrapper element
				wrapper = $('<div/>').addClass('wrapper');

				// Create time element
				time = $('<span/>').addClass('time').text(v < 10 ? '0' + v : v.toLocaleString());

				if (settings.labels) {
					// Create label element
					label = $('<span/>').addClass('label text-capitalize').text((v === 1 ? $.fn.countdown.singularize(k) : k));

					// Add everything to container element
					container.append(wrapper.append(time).append(label));
				} else {
					container.append(wrapper.append(time));
				}

				// Add elements to parent element
				if(k != "detik"){
			        parent.append(container.addClass('animated rotateIn')).append("<div class='col-1 px-1'> <span class='titik-dua'>:</span><span class='label'>&nbsp;</span> </div>");
				}else{
				    parent.append(container.addClass('animated rotateIn'));
				}
				// for(var x = 0; x < 1; x++){
				//     p.append("<div class='col-1'> : </div>");
				// }
			});

			// Tell the script that it has already been run
			settings.init = true;
		} else {
			// Update each element
			$.each(timespan, function (k, v) {
				$('.time', '#' + k).text(v < 10 ? '0' + v : v.toLocaleString());
				$('.label', '#' + k).text((v === 1 ? $.fn.countdown.singularize(k) : k));
			});
		}

		// Check if target date has beeen reached
		if (settings.target_reached) {

			// Executes function once timer reaches zero
			settings.onFinish();

		} else {

			// Updates the time every second for the visitor
			setTimeout(function () {
				$.fn.countdown.begin(parent, settings);
			}, 1000);
		}
	};

	// Removes the trailing S in days hours minutes seconds
	$.fn.countdown.singularize = function (str) {
		return str.substr(0, str.length - 1);
	};

	// Converts local timezone to target timezone
	$.fn.countdown.convertTimezone = function (timezone) {
		var now, local_time, local_offset, utc;
		now = new Date();
		local_time = now.getTime();
		local_offset = now.getTimezoneOffset() * 60000;
		utc = local_time + local_offset;
		return new Date(utc + (3600000 * timezone));
	};

	// Returns time remaining data for view
	$.fn.countdown.getTimeRemaining = function (start, end, settings) {
		var timeleft, remaining;
		remaining = {};
		timeleft = (end.getTime() - start.getTime());
		timeleft = (timeleft < 0 ? 0 : timeleft);

		// Check if target date has been reached
		if (timeleft === 0) {
			settings.target_reached = true;
		}

		// Built return object
		remaining.hari = Math.floor(timeleft / (24 * 60 * 60 * 1000));
		remaining.jam = Math.floor((timeleft / (24 * 60 * 60 * 1000) - remaining.hari) * 24);
		remaining.menit = Math.floor(((timeleft / (24 * 60 * 60 * 1000) - remaining.hari) * 24 - remaining.jam) * 60);
		remaining.detik = Math.floor(timeleft / 1000 % 60);
		return remaining;
	};
}(jQuery));