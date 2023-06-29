<template>
	<div class="modal fade" id="product_modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						{{ `${is_create ? 'Crear' : 'Actualizar'} Produto` }}
					</h5>
					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="storeProduct">
						<div class="mb-3">
							<label for="name" class="form-label">Nombre</label>
							<input
								type="text"
								class="form-control"
								id="name"
								v-model="product.name"
							/>
						</div>
						<div class="mb-3">
							<label for="description" class="form-label">Descripcion</label>
							<textarea
								class="form-control"
								id="description"
								rows="3"
								v-model="product.description"
							></textarea>
						</div>
						<div class="mb-3">
							<label for="stock" class="form-label">Stock</label>
							<input
								type="number"
								class="form-control"
								id="stock"
								v-model="product.stock"
							/>
						</div>
						<div class="mb-3">
							<label for="price" class="form-label">Precio</label>
							<input
								type="float"
								class="form-control"
								id="price"
								v-model="product.price"
							/>
						</div>

						<!--ID del vendedor automatico-->
						<div class="mb-3">
							<label for="seller_id" class="form-label">Vendedor</label>
							<input
								type="number"
								class="form-control"
								id="seller_id"
								v-model="product.seller_id"
							/>
						</div>

						<div class="mb-3">
							<label for="category" class="form-label">Categorias</label>

							<v-select
								id="category"
								:options="categories"
								v-model="product.category_id"
								:reduce="category => category.id"
								label="name"
								:clearable="false"
							>
							</v-select>
						</div>

						<hr />
						<section class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary me-1">
								{{ `${is_create ? 'Crear' : 'Actualizar'} ` }}
							</button>
							<button
								type="button"
								class="btn btn-secondary me-1"
								data-bs-dismiss="modal"
							>
								Cancelar
							</button>
						</section>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Swal from 'sweetalert2'

	export default {
		data() {
			return {
				is_create: true,
				categories: [],
				product: {}
			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {
				this.getCategories()
			},
			async getCategories() {
				const { data } = await axios.get('/api/Categories/GetAllCategories')
				this.categories = data.categories
			},
			async storeProduct() {
				try {
					if (this.is_create) {
						await axios.post('api/Products/SaveProduct', this.product)
					} else {
						await axios.put(
							`api/Products/UpdateProduct/${this.product.id}`,
							this.product
						)
					}
					Swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Producto publicado'
					})
					this.$parent.closeModal()
				} catch (error) {
					console.error(error)
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salio mal'
					})
				}
			}
		}
	}
</script>
