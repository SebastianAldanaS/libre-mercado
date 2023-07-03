<template>
	<div class="card my-5 mx-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Usuarios</h2>
			<button @click="openModal" class="btn btn-primary">Crear Usuario</button>
		</div>
		<div class="card-body">
			<section class="table-responsive" v-if="load">
				<table-component :users_data="users" />
			</section>
			<!--Load-->
			<section v-else class="d-flex justify-content-center my-3">
				<div class="spinner-border text-primary" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</section>
		</div>
		<section v-if="load_modal">
			<modal :user_data="user" />
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
			closeModal() {
				this.modal.hide()
				this.getUsers()
			},
			editUser(user) {
				this.user = user
				this.openModal()
			}
		}
	}
</script>
