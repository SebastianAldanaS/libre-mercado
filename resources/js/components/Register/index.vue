<template>
	<section class="">
		<div class="card-register my-3">
			<h2 class="h2">Registro</h2>
			<form @submit.prevent="storeUser" class="my-5">
				<div class="form-group">
					<label for="document_id">Documento</label>
					<input
						type="text"
						class="form-control"
						id="document_id"
						v-model="user.document_id"
					/>
					<div class="text-danger" v-if="errors && errors.document_id">
						{{ errors.document_id[0] }}
					</div>
				</div>
				<div class="form-group">
					<label for="name">Nombre</label>
					<input type="text" class="form-control" id="name" v-model="user.name" />
					<div class="text-danger" v-if="errors && errors.name">
						{{ errors.name[0] }}
					</div>
				</div>
				<div class="form-group">
					<label for="last_name">Apellido</label>
					<input
						type="text"
						class="form-control"
						id="last_name"
						v-model="user.last_name"
					/>
					<div class="text-danger" v-if="errors && errors.last_name">
						{{ errors.last_name[0] }}
					</div>
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" v-model="user.email" />
					<div class="text-danger" v-if="errors && errors.email">
						{{ errors.email[0] }}
					</div>
				</div>
				<div class="form-group">
					<label for="address">Dirección</label>
					<input type="text" class="form-control" id="address" v-model="user.address" />
					<div class="text-danger" v-if="errors && errors.address">
						{{ errors.address[0] }}
					</div>
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input
						type="password"
						class="form-control"
						id="password"
						v-model="user.password"
					/>
					<div class="text-danger" v-if="errors && errors.password">
						{{ errors.password[0] }}
					</div>
				</div>
				<div class="form-group">
					<label for="password_confirmation">Confirmar Contraseña</label>
					<input
						type="password"
						class="form-control"
						id="password_confirmation"
						v-model="user.password_confirmation"
					/>
				</div>
				<button type="submit" style="background-color: #ff5722" class="btn btn-primary">
					Crear
				</button>
			</form>
		</div>
	</section>
</template>

<script>
	import axios from 'axios'

	export default {
		data() {
			return {
				user: {
					name: '',
					email: '',
					password: '',
					password_confirmation: ''
				},
				errors: {}
			}
		},
		methods: {
			async storeUser() {
				try {
					this.user.role = 2
					await axios.post('Users/SaveUser', this.user)
					// Acciones después de crear el usuario
					swal.fire({
						icon: 'success',
						title: '¡Felicidades!',
						text: 'Usuario creado exitosamente.'
					})
					// Limpiar el formulario
					this.user = {
						name: '',
						email: '',
						password: '',
						password_confirmation: ''
					}
				} catch (error) {
					console.error(error)
					if (error.response && error.response.status == 422) {
						console.log(error.response.data)
						this.errors = error.response.data.errors
					}
				}
			}
		}
	}
</script>
