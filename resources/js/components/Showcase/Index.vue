<template>
	<div>
		<div v-for="category in categories" :key="category.id">
			<index-category :categoryId="category.id" />
		</div>
	</div>
</template>

<script>
	import IndexCategory from './IndexCategory.vue'

	export default {
		components: {
			IndexCategory
		},
		data() {
			return {
				categories: []
			}
		},
		created() {
			this.getCategories()
		},
		methods: {
			async getCategories() {
				try {
					const response = await axios.get('/api/Categories/GetAllCategories')
					this.categories = response.data.categories
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
