<template>
	<div class="card my-5 mx-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Libros</h2>
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
				load: false
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
					this.products = data.products
					this.load = true
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
