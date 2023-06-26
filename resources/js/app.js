import './bootstrap'
import { createApp } from 'vue'

//Components
import ExampleComponent from './components/ExampleComponent.vue'
import ProductsList from './components/Products/Index.vue'
import Navbar from './components/Navbar.vue'

const app = createApp({
	components: {
		ExampleComponent,
		ProductsList,
		Navbar
	}
})

app.mount('#app')
