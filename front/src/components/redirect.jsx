import { useEffect } from "react"
import { initRedirection, redirect, email } from "../helpers/main"

export const Redirection = () => {
	useEffect(() => {
		redirect && email && initRedirection().then(window.location.replace(redirect))
	}, [])

	return (
		<button className='redirect' onClick={() => initRedirection()}>
			Hello `{redirect}`
		</button>
	)
}
