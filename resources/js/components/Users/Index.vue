<template>
	<div class="card my-5 mx-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Usuarios</h2>
			<button @click="openModal" class="btn btn-primary">Crear Usuario</button>
		</div>
		<div class="card-body">
			<section class="table-responsive" v-if="load">
				<TableComponent
					ref="table"
					:users_data="users"
					:handleDeleteUser="confirmDeleteUser"
				/>
			</section>
			<!--Load-->
			<section v-else class="d-flex justify-content-center my-3">
				<div class="spinner-border text-primary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</section>
		</div>
		<section v-if="load_modal">
			<Modal :user_data="user" @close-modal="closeModal" />
		</section>
	</div>
</template>

<script>
	import TableComponent from './Table.vue'
	import Modal from './Modal.vue'

	export default {
		components: {
			TableComponent,
			Modal
		},
		data() {
			return {
				users: [],
				load: false,
				load_modal: false,
				modal: null,
				user: null
			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {
				this.getUsers()
				this.setUser()
			},
			setUser() {
				if (!this.user_data) return
				this.user = { ...this.user_data }
				this.is_create = false
			},
			async getUsers() {
				try {
					this.load = false
					const { data } = await axios.get('Users/GetAllUsers')
					this.users = data.users
					this.load = true
				} catch (error) {
					console.error(error)
				}
			},
			openModal() {
				this.load_modal = true

				setTimeout(() => {
					this.modal = new bootstrap.Modal(document.getElementById('user_modal'), {
						keyboard: false
					})
					this.modal.show()
					const modal = document.getElementById('user_modal')
					modal.addEventListener('hidden.bs.modal', () => {
						this.load_modal = false
						this.user = null
					})
				}, 200)
			},
			closeUserModal() {
				this.modal.hide()
				this.getUsers()
			},
			editUser(user) {
				this.user = user
				this.openModal()
			},
			confirmDeleteUser(user) {
				swal.fire({
					title: '¿Estás seguro?',
					text: 'Esta acción eliminará el usuario de forma permanente',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sí, eliminar',
					cancelButtonText: 'Cancelar'
				}).then(result => {
					if (result.isConfirmed) {
						this.deleteUser(user)
					}
				})
			},
			async deleteUser(user) {
				try {
					await this.handleDeleteUser(user) // Llama a la función handleDeleteUser del componente padre
					swal.fire({
						icon: 'success',
						title: 'Usuario eliminado',
						text: 'El usuario ha sido eliminado correctamente.'
					})
				} catch (error) {
					console.error(error)
				}
			},
			handleDeleteUser(user) {
				// Hacer la petición para eliminar el usuario
				axios
					.delete(`Users/DeleteAUser/${user.id}`)
					.then(response => {
						// Usuario eliminado correctamente
						// Realizar las acciones necesarias después de eliminar el usuario
						swal.fire({
							icon: 'success',
							title: 'Usuario eliminado',
							text: 'El usuario ha sido eliminado correctamente.'
						})

						// Actualizar la lista de usuarios
						this.getUsers()
					})
					.catch(error => {
						// Error al eliminar el usuario
						console.error(error)
						swal.fire({
							icon: 'error',
							title: 'Error',
							text: 'Ha ocurrido un error al eliminar el usuario.'
						})
					})
			},
			closeModal() {
				this.modal.hide()
				this.$refs.table.index()
			}
		}
	}
</script>
