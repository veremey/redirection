import { useEffect } from "react"
import { initRedirection, redirect, email } from "../helpers/main"

export const Redirection = () => {
	useEffect(() => {
		console.log(redirect, " | ", email) // TODO: for test
		redirect && email && initRedirection()
	}, [])

	return (
		<button className='redirect' onClick={() => initRedirection()}>
			Hello `{redirect}`
		</button>
	)
}
