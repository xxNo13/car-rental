import {createRouter, createWebHistory} from 'vue-router'
import Dashboard from './components/Dashboard.vue';
import AllCars from './components/Admin/AllCars.vue';
import AddCar from './components/Admin/AddCar.vue';
import EditCar from './components/Admin/EditCar.vue';
import CarSingle from './components/CarSingle.vue';
import NotFound from './components/NotFound.vue';


export const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'admin-cars',
            path: '/admin/',
            component: AllCars
        },
        {
            name: 'car-add',
            path: '/admin/add',
            component: AddCar
        },
        {
            name: 'car-edit',
            path: '/admin/edit/:id',
            component: EditCar
        },
        {
            name: 'dashboard',
            path: '/',
            component: Dashboard
        },
        {
            name: 'car-single',
            path: '/car/:id',
            component: CarSingle
        },
        {
            name: 'notFound',
            path: '/:notFound',
            component: NotFound
        }
    ]
});