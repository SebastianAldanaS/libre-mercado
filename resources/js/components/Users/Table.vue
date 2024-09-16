<template>
	<table class="table" id="userTable">
		<thead>
			<tr>
				<th>Documento</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>email</th>
				<th>direccion</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(user, index) in users" :key="index">
				<th>{{ user.document_id }}</th>
				<td>{{ user.name }}</td>
				<td>{{ user.last_name }}</td>
				<td>{{ user.email }}</td>
				<td>{{ user.address }}</td>
				<td style="display: flex; justify-content: flex-end">
					<button class="btn btn-warning mx-2" @click="getUser(user.id)">Editar</button>
					<button class="btn btn-danger" @click="handleDeleteUser(user)">Eliminar</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	import axios from 'axios'

	export default {
		props: ['users_data', 'handleDeleteUser'],
		data() {
			return {
				users: []
			}
		},
		created() {
			this.index()
		},
		mounted() {
			$('#userTable').DataTable({})
		},
		methods: {
			index() {
				this.users = [...this.users_data]
			},
			async getUser(user_id) {
				try {
					const { data } = await axios.get(`Users/GetAnUser/${user_id}`)
					this.$parent.editUser(data.user)
				} catch (error) {
					console.error(error)
				}
			},
			async deleteUser(user) {
				try {
					await this.handleDeleteUser(user) // Llama a la función handleDeleteUser pasada como prop
					swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'Usuario Eliminado'
					})
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
