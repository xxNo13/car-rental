<template>
    <div>
        <h1>Dashboard</h1>

        <div class="row">
            <div class="col-md-3 col-sm-6" v-for="car in cars" :key="car.id">
                <div class="card my-2">
                    <div v-for="image in car.car_images.slice(0, 1)" :key="image.id">
                        <img style="height: 150px;" class="card-img-top" :src="'/storage/' + image.image_url" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ car.car_brand }}</h5>
                        <p class="card-text">{{ car.car_model }}</p>
                        <p class="card-text">{{ car.plate_number }}</p>
                        <router-link :to="{name: 'car-single', params: { id: car.id }}" class="btn btn-primary">View</router-link>
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
                cars: []
            }
        },
        created() {
            this.axios.get('/api/cars')
                .then(response => {
                    this.cars = response.data
                });
        }
    }
</script>

<style lang="">
    
</style>