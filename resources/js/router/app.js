import { createRouter, createWebHistory } from 'vue-router';

import HomeView from '../views/HomeView.vue';
import BookView from '../views/BookView.vue';
import AddBookView from '../views/AddBookView.vue';
import ReviewView from '../views/ReviewView.vue';
import AddReview from '../views/AddReview.vue';
import LoginView from '../views/LoginView.vue';
import NotFoundView from '../views/NotFoundView.vue';
import RegisterView from '../views/RegisterView.vue';

const router = createRouter({
    history: createWebHistory("/"),
    routes: [
        {
            path: "/",
            name: 'home',
            component: HomeView
        },
        {
            path: "/book",
            name: 'addBook',
            component: AddBookView,
        },
        {
            path: "/book/:id",
            name: 'book',
            component: BookView,
        },
        {
            path: "/book/:id/review",
            name: "AddReview",
            component: AddReview,
        },
        {
            path: "/book/:id/review/:reviewId",
            name: "review",
            component: ReviewView,
        },
        {
            path: "/login",
            name: 'login',
            component: LoginView,
        },
        {
            path: "/register",
            name: 'register',
            component: RegisterView,
        },
        {
            path: "/:catchAll(.*)",
            name: "not-found",
            component: NotFoundView
        }
    ]
})

export default router
