import './bootstrap'
import { createApp } from 'vue'

import vSelect from 'vue-select'

//Components
import ProductsList from './components/Products/Index.vue'
import UsersList from './components/Users/Index.vue'
import ShowcaseComponent from './components/Showcase/Index.vue'
import ShowCategoryComponent from './components/ShowCategory/Index.vue'
import ProductDetail from './components/ProductDetail/index.vue'

const app = createApp({
	components: {
		ProductsList,
		UsersList,
		ShowcaseComponent,
		ShowCategoryComponent,
		ProductDetail
	}
})

app.component('v-select', vSelect)
app.mount('#app')
