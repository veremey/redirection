import { defineConfig } from "vite"
import react from "@vitejs/plugin-react"
import dotenv from "dotenv"

// https://vitejs.dev/config/
export default defineConfig({
	plugins: [react()],
	define: {
		// env variable
		"process.env.VITE_SUPABASE_URL": JSON.stringify(process.env.VITE_SUPABASE_URL),
		"process.env.VITE_SUPABASE_ANON_KEY": JSON.stringify(
			process.env.VITE_SUPABASE_ANON_KEY
		),
	},
})
