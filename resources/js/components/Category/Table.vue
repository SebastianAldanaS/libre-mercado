<template>
	<table class="table" id="productTable" @click="getEvent">
		<thead>
			<tr>
				<th>Nombre</th>
				<th class="d-flex justify-content-end mx-5">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(category, index) in categories" :key="category.id">
				<td>{{ category.name }}</td>
				<td class="d-flex justify-content-end">
					<button class="btn btn-warning mx-2">Editar</button>
					<button class="btn btn-danger">Eliminar</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: ['categories_data'],
		data() {
			return {
				categories: []
			}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				this.categories = { ...this.categories_data }
			}
		}
	}
</script>
