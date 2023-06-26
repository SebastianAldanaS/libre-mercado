<template>
	<div class="card my-5 mx-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Usuarios</h2>
			<a class="btn btn-primary">Crear Usuario</a>
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
	</div>
</template>

<script>
	import TableComponent from './Table.vue'

	export default {
		props: [],
		components: {
			TableComponent
		},
		data() {
			return {
				users: [],
				load: false
			}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				await this.getUsers()
			},
			async getUsers() {
				try {
					const { data } = await axios.get('/api/Users/GetAllUsers')
					this.users = data.users
					this.load = true
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
