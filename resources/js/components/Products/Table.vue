<template>
	<table class="table" id="productTable" @click="getEvent">
		<thead>
			<tr>
				<th>Categoria</th>
				<th>Nombre</th>
				<th>Stock</th>
				<th>Precio</th>
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
				products: [],
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
				this.datatable = $('#productTable').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: '/Products/GetAllProductsDataTable'
					},
					columns: [
						{ data: 'category.name', name: 'category.name', searchable: false },
						{ data: 'name', name: 'name' },
						{ data: 'stock', name: 'stock' },
						{ data: 'price', name: 'price' },
						{ data: 'action', name: 'action', orderable: false, searchable: false }
					],
					order: [
						[1, 'asc'] // Ordenar por la columna 'sellers.name' de forma ascendente
					]
				})
			},
			async getProducts() {
				try {
					this.load = false
					const { data } = await axios.get('Products/GetAllProducts')
					this.products = data.products
					this.load = true
				} catch (error) {
					console.error(error)
				}
				this.mountDataTable()
			},
			getEvent(event) {
				const button = event.target
				if (button.getAttribute('role') == 'edit') {
					this.getProduct(button.getAttribute('data-id'))
				}
				if (button.getAttribute('role') == 'delete') {
					this.deletProduct(button.getAttribute('data-id'))
				}
			},
			async getProduct(product_id) {
				try {
					const { data } = await axios.get(`Products/GetAProduct/${product_id}`)
					this.$parent.editProduct(data.product)
				} catch (error) {
					console.error(error)
				}
			},
			async deletProduct(product_id) {
				try {
					const result = await swal.fire({
						title: 'Estas seguro de eliminar el producto?',
						text: 'Esto no puede ser revertido',
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Si, eliminalo!'
					})

					if (!result.isConfirmed) return
					this.datatable.destroy()
					await axios.delete(`Products/DeleteAProduct/${product_id}`)
					this.index()
					swal.fire('Eliminado!', 'El producto fue eliminado', 'success')
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
