<template>
	<div>
		<div class="card my-5 mx-5" v-if="load && products.length > 0">
			<div class="card-header d-flex justify-content-between">
				<h2 class="h2">{{ categoryName }}</h2>
				<button
					class="btn"
					style="font-style: italic; font-family: 'Pacifico', cursive; font-weight: bold"
					@click="redirectToProductPage"
				>
					Ver más Categorias
				</button>
			</div>
			<div class="card-body">
				<section class="table-responsive">
					<table-component :products_data="products" />
				</section>
			</div>
		</div>
		<div v-else-if="load && products.length === 0"></div>
		<div v-else class="d-flex justify-content-center my-3">
			<div class="spinner-border text-primary" role="status">
				<span class="visually-hidden">Loading...</span>
			</div>
		</div>
	</div>
</template>

<script>
	import TableComponent from './Table.vue'

	export default {
		props: {
			categoryId: {
				type: Number,
				required: true
			}
		},
		components: {
			TableComponent
		},
		data() {
			return {
				products: [],
				load: false,
				categoryName: ''
			}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				await this.getProducts()
			},
			async getProducts() {
				try {
					const { data } = await axios.get(
						`/api/Products/GetProductsByCategory/${this.categoryId}`
					)
					const products = data.products.slice(0, 4) // Obtener solo 4 productos
					if (products.length > 0) {
						this.products = products // Almacenar los productos en el array
						this.categoryName = products[0].category.name // Obtener el nombre de la categoría
					}
					this.load = true
				} catch (error) {
					console.error(error)
				}
			},
			redirectToProductPage() {
				window.location.href = 'http://localhost:8020/Categories'
			}
		}
	}
</script>
