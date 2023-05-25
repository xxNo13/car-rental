<template>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1>This is Admin Dashboard</h1>
            <div class="d-flex gap-2">
                <router-link :to="{name: 'car-add'}" class="btn btn-primary">Add Car</router-link>
            </div>
        </div>
        <table class="table text-center align-middle">
            <thead>
                <tr>
                    <th>Car Images</th>
                    <th>Car Brand</th>
                    <th>Car Model</th>
                    <th>Plate Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="car in cars" :key="car.id">
                    <td>
                        <div class="d-flex gap-2 align-items-center justify-content-center">
                            <div v-for="image in car.car_images" :key="image.id">
                                <img :src="'/storage/' + image.image_url" class="rounded" style="width: 50px; height: 50px;">
                            </div>
                        </div>
                    </td>
                    <td>{{ car.car_brand }}</td>
                    <td>{{ car.car_model }}</td>
                    <td>{{ car.plate_number }}</td>
                    <td>
                        <div class="d-flex gap-2 align-items-center justify-content-center">
                            <router-link :to="{name: 'car-edit', params: { id: car.id }}" class="btn btn-success">Edit</router-link>
                            <button class="btn btn-danger" @click="deletePost(car.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cars: []
            }
        },
        created() {
            this.axios.get('/api/cars')
                .then(response => {
                    this.cars = response.data
                });
        },
        methods: {
            deletePost(id) {
                this.axios.delete(`/api/cars/${id}`)
                    .then(response => {
                        let i = this.cars.map(item => item.id).indexOf(id);
                        this.cars.splice(i, 1);
                    })
            }
        },
    }
</script>

<style lang="">
    
</style>