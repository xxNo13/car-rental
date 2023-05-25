<template lang="">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{name: 'admin-cars'}">Admin Dashboard</router-link></li>
            <li class="breadcrumb-item active" aria-current="page">{{ car.car_brand }} - {{ car.car_model }}</li>
        </ol>
    </nav>

    <div>
        <h1>Edit Cars</h1>

        <div class="mx-auto w-50">
            <form @submit.prevent="updateCar">
                <div class="form-group">
                    <label for="car_images">Car Images</label>
                    <input type="file" class="form-control" id="car_images" name="car_images" placeholder="Car Brand" v-on:change="addImage" multiple>
                </div>
                <div class="d-flex gap-3 mt-3">
                    <div class="position-relative" v-for="image in car.car_images" :key="image.id">
                        <img :src="'/storage/' + image.image_url" class="rounded" style="width: 100px; height: 100px;">
                        <a href="#" class="position-absolute top-0 end-0 border-0 rounded" style="background: rgba(255,255,255,0.5)" @click="deleteImage(image.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="rgb(255, 0, 0)" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="car_brand">Car Brand</label>
                    <input type="text" class="form-control" id="car_brand" name="car_brand" placeholder="Car Brand" v-model="car.car_brand">
                </div>
                <div class="form-group">
                    <label for="car_model">Car Model</label>
                    <input type="text" class="form-control" id="car_model" name="car_model" placeholder="Car Brand" v-model="car.car_model">
                </div>
                <div class="form-group">
                    <label for="plate_number">Plate Number</label>
                    <input type="text" class="form-control" id="plate_number" name="plate_number" placeholder="Car Brand" v-model="car.plate_number">
                </div>
                <button type="submit" class="btn btn-primary my-2 mx-auto">Update Car</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                car: {},
                images: []
            }
        },
        created() {
            this.carInit()
        },
        methods: {
            carInit() {
                this.axios.get(`/api/cars/${this.$route.params.id}/edit`)
                    .then((response) => {
                        this.car = response.data;
                    })
            },
            updateCar() {
                const formData = new FormData;
                formData.set('car_brand', this.car.car_brand);
                formData.set('car_model', this.car.car_model);
                formData.set('plate_number', this.car.plate_number);

                for (let i = 0; i < this.images.length; i++) {
                    formData.append('images[]', this.images[i]);
                }

                this.axios
                    .post(`/api/cars/${this.$route.params.id}`, formData)
                    .then((response) => {
                        this.$router.push({name: 'admin-cars'});
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            addImage(e) {
                this.images = e.target.files;
                console.log(this.images);
            },
            deleteImage(id) {
                this.axios
                    .delete(`/api/cars/images/${id}`)
                    .then(response => {
                        this.carInit()
                    });
            }
        },
    }
</script>

<style lang="">
    
</style>