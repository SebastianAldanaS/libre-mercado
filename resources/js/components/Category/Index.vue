<template>
	<div class="card mx-5 my-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Categorias</h2>
			<button @click="openModal" class="btn btn-primary">Crear Categoria</button>
		</div>
		<div class="card-body">
			<section class="table-responsive" v-if="load">
				<table-component :categories_data="categories" />
			</section>
		</div>
		<section>
			<modal v-show="load_modal" />
		</section>
	</div>
</template>

<script>
	import TableComponent from './Table.vue'
	import Modal from './Modal.vue'

	export default {
		props: [],
		components: {
			TableComponent,
			Modal
		},
		data() {
			return {
				categories: [],
				load: false,
				load_modal: false,
				modal: null
			}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				this.getCategories()
			},
			async getCategories() {
				try {
					const { data } = await axios.get('GetAllCategories')
					this.categories = data.categories
					this.load = true
				} catch (error) {
					console.error(error)
				}
			},
			openModal() {
				this.load_modal = true

				setTimeout(() => {
					this.modal = new bootstrap.Modal(document.getElementById('category_modal'), {
						keyboard: false
					})
					this.modal.show()
				}, 200)
			}
		}
	}
</script>
