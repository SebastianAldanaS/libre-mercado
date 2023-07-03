<template>
	<div class="card my-5 mx-5">
		<div class="card-header d-flex justify-content-between">
			<h2>{{ selectedCategoryName }}</h2>
			<div>
				<v-select
					:options="categories"
					:reduce="category => category.id"
					label="name"
					:clearable="false"
					style="width: 10rem"
					v-model="selectedCategoryId"
				></v-select>
			</div>
			<button class="btn btn-primary ms-2 d-flex justify" @click="reloadProducts">
				Mostrar
			</button>
		</div>
		<div class="card-body">
			<section class="table-responsive" v-if="load">
				<table-component :products_data="products" />
			</section>
			<!--Load-->
			<section v-else class="d-flex justify-content-center my-3">
				<div class="spinner-border text-primary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</section>
		</div>
	</div>
</template>

<script>
	import TableComponent from './Table.vue'

	export default {
		components: {
			TableComponent
		},
		data() {
			return {
				products: [],
				load: false,
				categories: [],
				selectedCategoryId: 9,
				selectedCategoryName: ''
			}
		},
		created() {
			this.index()
		},
		watch: {
			selectedCategoryId: {
				immediate: true,
				handler() {
					this.getProducts()
					this.setSelectedCategoryName()
				}
			}
		},
		methods: {
			async index() {
				await this.getCategories()
				await this.getProducts()
			},
			async getCategories() {
				try {
					const { data } = await axios.get('/api/Categories/GetAllCategories')
					this.categories = data.categories
				} catch (error) {
					console.error(error)
				}
			},
			async getProducts() {
				try {
					const { data } = await axios.get(
						`/api/Products/GetProductsByCategory/${this.selectedCategoryId}`
					)
					this.products = data.products
					this.load = true
				} catch (error) {
					console.error(error)
				}
			},
			setSelectedCategoryName() {
				const category = this.categories.find(
					category => category.id === this.selectedCategoryId
				)
				this.selectedCategoryName = category ? category.name : ''
			},
			reloadProducts() {
				this.load = false
				this.getProducts()
			}
		}
	}
</script>
