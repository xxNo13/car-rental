<template lang="">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{name: 'admin-cars'}">Admin Dashboard</router-link></li>
            <li class="breadcrumb-item active" aria-current="page">Add Car</li>
        </ol>
    </nav>

    <div>
        <h1>Add Car</h1>

        <div class="mx-auto w-50">
            <form @submit.prevent="addCar">
                <div class="form-group">
                    <label for="car_images">Car Images</label>
                    <input type="file" class="form-control" id="car_images" name="car_images" placeholder="Car Brand" v-on:change="addImage" multiple>
                </div>
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
                <button type="submit" class="btn btn-primary my-2 mx-auto">Add Car</button>
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
        methods: {
            addCar() {
                const formData = new FormData;
                formData.set('car_brand', this.car.car_brand);
                formData.set('car_model', this.car.car_model);
                formData.set('plate_number', this.car.plate_number);

                for (let i = 0; i < this.images.length; i++) {
                    formData.append('images[]', this.images[i]);
                }
                
                this.axios
                    .post('/api/cars', formData)
                    .then((response) => {
                        this.$router.push({name: 'admin-cars'});
                    })
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            addImage(e) {
                this.images = e.target.files;
                console.log(this.images);
            }
        },
    }
</script>

<style lang="">
    
</style>