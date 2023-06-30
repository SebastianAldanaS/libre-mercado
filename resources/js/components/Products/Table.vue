<template>
	<table class="table">
		<thead>
			<tr>
				<th>Categoria</th>
				<th>Vendedor</th>
				<th>Nombre</th>
				<th>Stock</th>
				<th>Precio</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(product, index) in products" :key="index">
				<th>{{ product.category.name }}</th>
				<td>{{ product.seller.name }}</td>
				<td>{{ product.name }}</td>
				<td>{{ product.stock }}</td>
				<td>{{ product.price }}</td>
				<td>
					<button class="btn btn-warning me-2" @click="getProduct(product.id)">
						Editar
					</button>
					<button class="btn btn-danger" @click="deletProduct(product.id)">
						Eliminar
					</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props: ['products_data'],
		data() {
			return {
				products: []
			}
		},
		created() {
			this.index()
		},
		methods: {
			index() {
				this.products = [...this.products_data]
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
					await axios.delete(`Products/DeleteAProduct/${product_id}`)
					this.$parent.getProducts()
					swal.fire('Eliminado!', 'El producto fue eliminado', 'success')
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
