<template lang="">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
            <li class="breadcrumb-item active" aria-current="page">{{ car.car_brand }} - {{ car.car_model }}</li>
        </ol>
    </nav>

    <div class="mx-auto text-center">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" v-for="image in car.car_images" :key="image.id">
                    <img class="d-block w-100 rounded" style="height: 650px;" :src="'/storage/' + image.image_url">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <h1 class="mt-3">{{ car.car_brand }} - {{ car.car_model }}</h1>
        <h6>{{ car.plate_number }}</h6> 
    </div>
</template>

<script>
    export default {
        data() {
            return {
                car: {}
            }
        },
        created() {
            this.axios
                .get(`/api/cars/${this.$route.params.id}`)
                .then(response => {
                    this.car = response.data
                })
        },
    }
</script>

<style lang="">
    
</style>