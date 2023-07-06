<template>
	<div class="card my-5 mx-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Carrito</h2>
		</div>
		<div class="card-body">
			<div v-if="customerCars.length === 0" class="text-center">El carrito está vacío</div>
			<div v-else>
				<ul class="list-group list-group-flush">
					<li v-for="car in groupedCars" :key="car.product.id" class="list-group-item">
						<div class="row">
							<div class="col-md-2">
								<img
									:src="
										car.product.image
											? '/storage/images/' + car.product.image
											: 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png'
									"
									class="card-img-top"
									alt="Producto"
								/>
							</div>
							<div class="col-md-6">
								<div>{{ car.product.name }}</div>
								<div>Precio: {{ car.product.price }}</div>
								<div>Stock: {{ car.product.stock }}</div>
							</div>
							<div class="d-flex align-items-center justify-content-end">
								<button
									@click="deleteCarProduct(car.id)"
									class="btn btn-sm btn-secondary me-2"
								>
									-
								</button>
								<div class="me-2">{{ car.quantity }}</div>
								<button
									@click="addToCart(car.product.id)"
									class="btn btn-sm btn-secondary me-2"
								>
									+
								</button>
							</div>
						</div>
					</li>
				</ul>
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
				customerCars: []
			}
		},
		mounted() {
			this.getCustomerCars()
		},
		computed: {
			groupedCars() {
				const grouped = {}
				this.customerCars.forEach(car => {
					const productId = car.product.id
					if (!grouped[productId]) {
						grouped[productId] = { ...car }
					} else {
						grouped[productId].quantity += car.quantity
					}
				})
				return Object.values(grouped)
			}
		},
		methods: {
			getCustomerCars() {
				axios
					.get(`/api/Cars/GetAllCarsByUser/${this.userId}`)
					.then(response => {
						this.customerCars = response.data.customer_cars
					})
					.catch(error => {
						console.error(error)
					})
			},
			deleteCarProduct(carId) {
				axios
					.delete(`/api/Cars/DeleteCarProduct/${carId}`)
					.then(response => {
						// Actualizar la lista de productos del carrito después de eliminar el producto
						this.getCustomerCars()
						// Mostrar un mensaje de éxito o realizar otras acciones necesarias
						console.log(response.data)
					})
					.catch(error => {
						// Manejar el error en caso de que ocurra
						console.error(error)
					})
			},
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
