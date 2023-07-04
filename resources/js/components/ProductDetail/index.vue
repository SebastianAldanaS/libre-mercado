<template>
	<div class="container my-5">
		<div v-if="loading" class="text-center">Cargando...</div>
		<div v-else class="card">
			<div class="card-header">
				<h1>
					<b>{{ product.name }}</b>
				</h1>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<img
							:src="
								product.image
									? '/storage/images/' + product.image
									: 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png'
							"
							class="card-img-top"
							alt="Producto"
						/>
					</div>
					<div class="col-md-6">
						<div class="d-flex justify-content-center flex-wrap my-5">
							<b class="m-2">Descripción:</b>
						</div>
						<div class="d-flex justify-content-center flex-wrap my-5">
							<p class="mb-0">{{ product.description }}</p>
						</div>

						<hr />
						<div class="d-flex justify-content-center flex-wrap my-5">
							<b class="">Stock disponible: {{ product.stock }} Unidades</b>
						</div>
						<hr />
						<div class="my-5">
							<b class="mb-0" style="font-size: 25px">Precio: ${{ product.price }}</b>
						</div>
						<div class="mt-3 d-flex justify-content-center flex-wrap my-5">
							<a href="#" class="btn btn-primary">Añadir a Carrito</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				product: {},
				loading: true
			}
		},
		mounted() {
			axios
				.get('/api/Products/GetAProduct/1')
				.then(response => {
					this.product = response.data.product
					this.loading = false
				})
				.catch(error => {
					console.error(error)
					this.loading = false
				})
		}
	}
</script>
