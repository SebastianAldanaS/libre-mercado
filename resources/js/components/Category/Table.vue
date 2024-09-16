<template>
	<table class="table" id="categoryTable" @click="getEvent">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</template>

<script>
	export default {
		data() {
			return {
				categories: [],
				datatable: {}
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				this.mountDataTable()
			},
			mountDataTable() {
				this.datatable = $('#categoryTable').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: '/Categories/GetAllCategoriesDataTable'
					},
					columns: [
						{ data: 'name', name: 'name' },
						{ data: 'action', name: 'action', orderable: false, searchable: false }
					],
					order: [
						[0, 'asc'] // Ordenar por la columna 'name' de forma ascendente
					]
				})
			},
			async getCategories() {
				try {
					this.load = false
					const { data } = await axios.get('/Categories/GetAllCategories')
					this.categories = data.categories
					this.load = true
				} catch (error) {
					console.error(error)
				}
				this.mountDataTable()
			},
			getEvent(event) {
				const button = event.target
				if (button.getAttribute('role') == 'edit') {
					this.getCategory(button.getAttribute('data-id'))
				}
				if (button.getAttribute('role') == 'delete') {
					this.deleteCategory(button.getAttribute('data-id'))
				}
			},
			async getCategory(category_id) {
				try {
					const { data } = await axios.get(`/Categories/GetACategory/${category_id}`)
					this.$parent.editCategory(data.category)
				} catch (error) {
					console.error(error)
					swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Algo salió mal'
					})
				}
			},
			async deleteCategory(category_id) {
				try {
					const result = await swal.fire({
						title: '¿Estás seguro de eliminar la categoría?',
						text: 'Esto no se puede deshacer',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Sí, eliminarla'
					})

					if (!result.isConfirmed) return
					this.datatable.destroy()
					await axios.delete(`/Categories/DeleteCategory/${category_id}`)
					this.index()
					swal.fire('Eliminada', 'La categoría ha sido eliminada', 'success')
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
