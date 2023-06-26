import './bootstrap'
import { createApp } from 'vue'

//Components
import ExampleComponent from './components/ExampleComponent.vue'
import ProductsList from './components/Products/Index.vue'
import UsersList from './components/Users/Index.vue'

const app = createApp({
	components: {
		ExampleComponent,
		ProductsList,
		UsersList
	}
})

app.mount('#app')
