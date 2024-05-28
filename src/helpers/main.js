import { supabase } from "./server"
import { berlinTime } from "./berlinTime"

const currentUrl = window.location.href
const url = new URL(currentUrl)
const params = new URLSearchParams(url.search)
const entries = params.entries()

let paramsObject = {}
for (let [key, value] of entries) {
	paramsObject[key] = value
}

paramsObject.date = berlinTime

const { email, redirect } = paramsObject

;(async () => {
	const idata = {
		email,
		redirectedTo: redirect,
		berlinTime,
	}

	const { data, error } = await supabase.from("emailChecker").insert([idata])

	if (error) {
		console.error("Error:", error)
	}

	if (data) {
		console.log("Success:", data)
	}
})()

window.location.replace(`${redirect}`)
