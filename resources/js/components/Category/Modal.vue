<template>
	<div class="modal fade" id="category_modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						{{ `${is_create ? 'Crear' : 'Actualizar'} Categoría` }}
					</h5>
					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="storeCategory">
						<div class="mb-3">
							<label for="name" class="form-label">Nombre</label>
							<input
								type="text"
								class="form-control"
								id="name"
								v-model="category.name"
							/>
						</div>

						<!-- Otros campos de categoría aquí -->

						<hr />
						<section class="d-flex justify-content-end">
							<button type="submit" class="btn btn-primary me-1">
								{{ `${is_create ? 'Crear' : 'Actualizar'}` }}
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
	export default {
		props: ['category_data'],
		data() {
			return {
				is_create: true,
				category: {}
			}
		},
		created() {
			this.setCategory()
		},
		methods: {
			setCategory() {
				if (!this.category_data) return
				this.category = { ...this.category_data }
				this.is_create = false
			},
			async storeCategory() {
				try {
					if (this.is_create) {
						await axios.post('/Categories/SaveCategory', this.category)
					} else {
						await axios.post(
							`/Categories/UpdateCategory/${this.category.id}`,
							this.category
						)
					}
					swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Categoría guardada'
					})
					this.$parent.closeModal()
				} catch (error) {
					console.error(error)
					swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salió mal'
					})
				}
			}
		}
	}
</script>
