import './bootstrap'
import { createApp } from 'vue'

//Components
import ProductsList from './components/Products/Index.vue'
import UsersList from './components/Users/Index.vue'
import ShowcaseComponent from './components/Showcase/Index.vue'

const app = createApp({
	components: {
		ProductsList,
		UsersList,
		ShowcaseComponent
	}
})

app.mount('#app')
