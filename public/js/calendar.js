   // календари
   $('#calendar-1').bitroidCalendarEv({
	lang: "ru",
	sundayFirst: false,
	years: "2010-2030",
	showEventBlock: true,
	events : [
		{
			day : "03",
			month : "02",
			year : "2017",
			event_description : "Описание события",
			event_title : "Заголовок для события",
			event_body : "Описание для события"
		},
		{
			day : "03",
			month : "02",
			year : "2017",
			event_description : "Описание события 2",
			event_body : "Событие 2!"
		},
		{
			day : "20",
			month : "02",
			year : "2017",
			event_description : "Описание события",
			event_body : "Событие!"
		},
		{
			day : "07",
			month : "10",
			year : "2023",
			event_description : "1",
			event_body : "Событие!"
		},
		{
			day : "07",
			month : "10",
			year : "2023",
			event_description : "2",
			event_body : "12:00-13:00"
		},
		{
			day : "07",
			month : "10",
			year : "2023",
			event_description : "3",
			event_body : "13:00-21:00"
		},
        {
			day : "08",
			month : "10",
			year : "2023",
			event_description : "1",
			event_body : "13:00-21:00"
		}
	],
	containers : {
		events : ".calendarev-events-container"
	}
});