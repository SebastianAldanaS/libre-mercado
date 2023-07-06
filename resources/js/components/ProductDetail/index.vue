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
					<div class="col-md-4">
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
							<button @click="addToCart" class="btn btn-primary">
								Añadir a Carrito
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			userId: {
				type: Number,
				required: true
			}
		},
		data() {
			return {
				product: {},
				loading: true
			}
		},
		mounted() {
			const params = new URLSearchParams(window.location.search)
			const productId = params.get('productId')
			if (productId) {
				axios
					.get(`/api/Products/GetAProduct/${productId}`)
					.then(response => {
						this.product = response.data.product
						this.loading = false
					})
					.catch(error => {
						console.error(error)
						this.loading = false
					})
			} else {
				// Manejar el caso en que no se proporciona el productId
			}
		},
		methods: {
			addToCart() {
				const productData = {
					customer_id: this.userId, // Aquí debes proporcionar el ID del cliente actual
					product_id: this.product.id,
					product_price: this.product.price,
					quantity: 1 // Puedes ajustar la cantidad según tus necesidades
				}

				axios
					.post('/api/Cars/CreateCar', productData)
					.then(response => {
						swal.fire({
							icon: 'success',
							title: 'Felicidades',
							text: 'Producto Añadido al carrito'
						})
						console.log(response.data)
					})
					.catch(error => {
						// Aquí puedes manejar el error en caso de que ocurra
						console.error(error)
					})
			}
		}
	}
</script>
