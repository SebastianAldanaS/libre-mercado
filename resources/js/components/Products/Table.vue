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
					<button class="btn btn-warning me-2">Editar</button>
					<button class="btn btn-danger">Eliminar</button>
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
			}
		}
	}
</script>
