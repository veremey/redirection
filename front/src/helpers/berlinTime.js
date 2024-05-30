const dateNow = new Date()

const berlinTimeFormat = new Intl.DateTimeFormat("de-DE", {
	timeZone: "Europe/Berlin",
	year: "numeric",
	month: "2-digit",
	day: "2-digit",
	hour: "2-digit",
	minute: "2-digit",
	second: "2-digit",
})

export const berlinTime = berlinTimeFormat.format(dateNow)
