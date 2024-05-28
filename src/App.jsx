import "./App.css"
import { Redirection } from "./components/redirect"

function App() {
	console.log(import.meta.env.VITE_SUPABASE_URL, " >>>>>>>")
	return (
		<>
			<h1>Wir möchten Sie auf eine andere Seite weiterleiten </h1>
			<p>
				<Redirection />
			</p>
		</>
	)
}

export default App
