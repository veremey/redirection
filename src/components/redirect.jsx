import { useEffect } from "react"
import { initRedirection, redirect } from "../helpers/main"

export const Redirection = () => {
	useEffect(() => {
		console.log(redirect) // TODO: for test
		initRedirection()
	}, [])

	return (
		<button className='redirect' onClick={() => initRedirection()}>
			Hello `{redirect}`
		</button>
	)
}
