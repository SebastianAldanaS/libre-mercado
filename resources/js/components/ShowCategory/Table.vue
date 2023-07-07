<template>
	<th></th>
	<table class="table">
		<tbody>
			<section class="d-flex justify-content-center flex-wrap">
				<div
					class="card-product mx-2 my-2"
					style="width: 16rem"
					v-for="(product, index) in products"
					:key="index"
				>
					<div class="card-body-categories">
						<img
							:src="
								product.image
									? '/storage/images/' + product.image
									: 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png'
							"
							class="card-img-top"
							alt="Producto"
						/>
						<h5 class="card-title">
							<b>{{ product.name }}</b>
						</h5>
						<p class="card-text">{{ product.description }}</p>
						<p v-if="product.stock !== undefined" class="card-text">
							Stock: {{ product.stock }}
						</p>
						<p>Precio: ${{ product.price }}</p>
						<td>
							<a href="#" class="btn btn-primary">Añadir a Carrito</a>
						</td>
					</div>
				</div>
			</section>
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
				this.products = this.products_data.filter(product => product.stock > 0)
			}
		}
	}
</script>
