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
									class="card-img-top product-image"
									alt="Producto"
								/>
							</div>
							<div class="col-md-10">
								<div class="product-details">
									<div class="product-name">{{ car.product.name }}</div>
									<div class="product-price-stock">
										<span class="detail-label">Precio:</span>
										{{ car.product.price }} |
										<span class="detail-label">Stock:</span>
										{{ car.product.stock }} |
										<span class="detail-label">Total:</span>
										{{ (car.product.price * car.quantity).toFixed(2) }}
										<div class="col-md-10 d-flex justify-content-end">
											<select
												class="quantity"
												@change="
													updateCarQuantity(car.id, $event.target.value)
												"
											>
												<option
													v-for="quantity in availableQuantities(
														car.product.stock
													)"
													:value="quantity"
													:selected="quantity === car.quantity"
												>
													{{ quantity }}
												</option>
											</select>

											<button
												class="btn btn-danger"
												@click="removeFromCart(car.id)"
											>
												Eliminar
											</button>
										</div>
									</div>
								</div>
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
				return total.toFixed(2)
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
			availableQuantities(stock) {
				return Array.from({ length: stock }, (_, index) => index + 1)
			},
			updateCarQuantity(carId, newQuantity) {
				const car = this.customerCars.find(car => car.id === carId)
				if (car) {
					const stock = car.product.stock
					const updatedQuantity = Math.min(newQuantity, stock)
					const productData = {
						quantity: updatedQuantity
					}

					axios
						.put(`/api/Cars/UpdateCarQuantity/${carId}`, productData)
						.then(() => {
							this.getCustomerCars()
						})
						.catch(error => {
							console.error(error)
						})
				}
			},
			removeFromCart(carId) {
				axios
					.delete(`/api/Cars/DeleteCarProduct/${carId}`)
					.then(() => {
						this.getCustomerCars()
					})
					.catch(error => {
						console.error(error)
					})
			}
		}
	}
</script>
