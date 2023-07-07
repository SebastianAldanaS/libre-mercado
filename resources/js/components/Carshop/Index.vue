<template>
	<div class="card my-5 mx-5">
		<div class="card-header d-flex justify-content-between">
			<h2>Carrito</h2>
			<div class="total-price">Total del carrito: {{ totalPrice }}</div>
		</div>
		<div class="card-body">
			<div v-if="customerCars.length === 0" class="text-center">El carrito está vacío</div>
			<div v-else>
				<ul class="list-group list-group-flush">
					<li v-for="car in groupedCars" :key="car.product.id" class="list-group-item">
						<div class="row align-items-center">
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
								<div class="product-name">{{ car.product.name }}</div>
								<div class="product-details">
									<span class="detail-label">Precio:</span>
									{{ car.product.price }} |
									<span class="detail-label">Stock:</span>
									{{ car.product.stock }} |
									<span class="detail-label">Total:</span>
									{{ car.product.price * car.quantity }}
								</div>
							</div>
							<div class="col-md-4 d-flex align-items-center justify-content-end">
								<button
									@click="decrementQuantity(car.product.id, car.quantity, car.id)"
									class="btn btn-sm btn-secondary"
								>
									-
								</button>
								<div class="quantity">{{ car.quantity }}</div>
								<button
									@click="
										incrementQuantity(
											car.product.id,
											car.quantity,
											car.product.stock
										)
									"
									class="btn btn-sm btn-secondary"
									:disabled="car.quantity >= car.product.stock"
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
			},
			totalPrice() {
				let total = 0
				this.customerCars.forEach(car => {
					total += car.product.price * car.quantity
				})
				return total
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
			incrementQuantity(productId, currentQuantity, stock) {
				if (currentQuantity < stock) {
					const car = this.customerCars.find(car => car.product.id === productId)
					if (car) {
						const increment = 1
						const productData = {
							quantity: currentQuantity + increment
						}

						axios
							.put(`/api/Cars/UpdateCarQuantity/${car.id}`, productData)
							.then(() => {
								swal.fire({
									icon: 'success',
									title: 'Felicidades',
									text: 'Producto añadido al carrito'
								})
								this.getCustomerCars()
							})
							.catch(error => {
								console.error(error)
							})
					}
				}
			},
			decrementQuantity(productId, currentQuantity, carId) {
				if (currentQuantity <= 1) {
					axios
						.delete(`/api/Cars/DeleteCarProduct/${carId}`)
						.then(() => {
							// Eliminar el producto del arreglo de customerCars en lugar de volver a obtenerlo desde la API
							const carIndex = this.customerCars.findIndex(car => car.id === carId)
							if (carIndex !== -1) {
								this.customerCars.splice(carIndex, 1)
							}
						})
						.catch(error => {
							// Manejar el error en caso de que ocurra
							console.error(error)
						})
				}
				if (currentQuantity > 1) {
					const car = this.customerCars.find(car => car.product.id === productId)
					if (car) {
						const decrement = 1
						const productData = {
							quantity: currentQuantity - decrement
						}

						axios
							.put(`/api/Cars/UpdateCarQuantity/${car.id}`, productData)
							.then(() => {
								swal.fire({
									icon: 'success',
									title: 'Felicidades',
									text: 'Producto actualizado en el carrito'
								})
								this.getCustomerCars()
							})
							.catch(error => {
								console.error(error)
							})
					}
				}
			}
		}
	}
</script>
