<template>
	<div class="modal fade" id="user_modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						{{ `${is_create ? 'Crear' : 'Actualizar'} Usuario` }}
					</h5>
					<button
						type="button"
						class="btn-close"
						data-bs-dismiss="modal"
						aria-label="Close"
					></button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="storeUser">
						<div class="mb-3">
							<label for="document_id" class="form-label">Documento</label>
							<input
								type="text"
								class="form-control"
								id="document_id"
								v-model="user.document_id"
							/>
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Nombre</label>
							<input type="text" class="form-control" id="name" v-model="user.name" />
						</div>
						<div class="mb-3">
							<label for="last_name" class="form-label">Apellido</label>
							<input
								type="text"
								class="form-control"
								id="last_name"
								v-model="user.last_name"
							/>
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">email</label>
							<input
								type="email"
								class="form-control"
								id="email"
								v-model="user.email"
							/>
						</div>
						<div class="mb-3">
							<label for="address" class="form-label">Direccion</label>
							<input
								type="text"
								class="form-control"
								id="address"
								v-model="user.address"
							/>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Contraseña</label>
							<input
								type="password"
								class="form-control"
								id="password"
								v-model="user.password"
							/>
						</div>
						<div class="mb-3">
							<label for="password_confirmation" class="form-label"
								>Repetir Contraseña</label
							>
							<input
								type="password"
								class="form-control"
								id="password_confirmation"
								v-model="user.password_confirmation"
							/>
						</div>
						<hr />
						<section class="d-flex justify-content-end">
							<button
								type="button"
								class="btn btn-secondary me-1"
								data-bs-dismiss="modal"
							>
								Cerrar
							</button>
							<button type="submit" class="btn btn-primary me-1">
								{{ `${is_create ? 'Crear' : 'Actualizar'} Usuario` }}
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
				user: {}
			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {},
			async storeUser() {
				try {
					if (this.is_create) {
						await axios.post('Users/SaveUser', this.user)
					} else {
						await axios.put(`Users/UpdateUser/${this.user.id}`, this.user)
					}
					Swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Usuario Creado'
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
