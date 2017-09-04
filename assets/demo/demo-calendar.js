// // Demo for FullCalendar with Drag/Drop internal

$(document).ready(function() {



	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var calendar = $('#calendar-drag').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: [
			{
				title: 'All Day Event',
				start: new Date(y, m, 8),
				backgroundColor: Utility.getBrandColor('primary')
			},
			{
				title: 'Long Event',
				start: new Date(y, m, d-5),
				end: new Date(y, m, d-2),
				backgroundColor: Utility.getBrandColor('lime')
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d-3, 16, 0),
				allDay: false,
				backgroundColor: Utility.getBrandColor('inverse')
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: new Date(y, m, d+4, 16, 0),
				allDay: false,
				backgroundColor: Utility.getBrandColor('inverse')
			},
			{
				title: 'Meeting',
				start: new Date(y, m, d, 10, 30),
				allDay: false,
				backgroundColor: Utility.getBrandColor('info')
			},
			{
				title: 'Lunch',
				start: new Date(y, m, d, 12, 0),
				end: new Date(y, m, d, 14, 0),
				allDay: false,
				backgroundColor: Utility.getBrandColor('midnightblue')
			},
			{
				title: 'Birthday Party',
				start: new Date(y, m, d+1, 19, 0),
				end: new Date(y, m, d+1, 22, 30),
				allDay: false,
				backgroundColor: Utility.getBrandColor('purple')
			},
			{
				title: 'Click for Google',
				start: new Date(y, m, 28),
				end: new Date(y, m, 29),
				url: 'http://google.com/',
				backgroundColor: Utility.getBrandColor('warning')
			}
		],
		buttonText: {
			today:    'Today',
			month:    'Month',
			week:     'Week',
			day:      'Day'
		},
		buttonIcons: { //multiple fa class because it will then output .fc-icon-fa.fa.fa-...
		    prev: 'fa fa fa-angle-left',
		    next: 'fa fa fa-angle-right',
		    prevYear: 'fa fa fa-angle-double-left',
		    nextYear: 'fa fa fa-angle-double-left'
		}
	});













// // Demo for FullCalendar with Drag/Drop external


	/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events .external-event').each(function() {

		// store data so the calendar knows to render an event upon drop
		$(this).data('event', {
			title: $.trim($(this).text()), // use the element's text as the event title
			stick: true // maintain when user navigates (see docs on the renderEvent method)
		});

		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});

	});


	/* initialize the calendar
	-----------------------------------------------------------------*/

	$('#calendar-external').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		defaultView: 'agendaWeek',
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar
		drop: function() {
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		},
		buttonIcons: { //multiple fa class because it will then output .fc-icon-fa.fa.fa-...
		    prev: 'fa fa fa-angle-left',
		    next: 'fa fa fa-angle-right',
		    prevYear: 'fa fa fa-angle-double-left',
		    nextYear: 'fa fa fa-angle-double-left'
		}
	});

});
