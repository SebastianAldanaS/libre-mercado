<template>
	<table class="table">
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
				<td>
					<button class="btn btn-warning me-2">Editar</button>
					<button class="btn btn-danger">Eliminar</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: ['users_data'],
		data() {
			return {
				users: []
			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {
				this.users = [...this.users_data]
			}
		}
	}
</script>
