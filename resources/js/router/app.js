import { createRouter, createWebHistory } from 'vue-router';
import { authStore } from '../store/auth';

import HomeView from '../views/HomeView.vue';
import NotFoundView from '../views/NotFoundView.vue';
// Books
import BookView from '../views/BookView.vue'
import AddBookView from '../views/AddBookView.vue';
// Reviews
import ReviewView from '../views/ReviewView.vue';
import AddReview from '../views/AddReview.vue';
// Auth
import LoginView from '../views/LoginView.vue';
import RegisterView from '../views/RegisterView.vue';



const router = createRouter({
    history: createWebHistory("/"),
    routes: [
        {
            path: "/",
            name: 'home',
            component: HomeView,
            meta: { requiresAuth: true },
        },
        {
            path: "/book",
            name: 'addBook',
            component: AddBookView,
            meta: { requiresAuth: true },
        },
        {
            path: "/book/:id",
            name: 'book',
            component: BookView,
            meta: { requiresAuth: true },
        },
        {
            path: "/book/:id/review",
            name: "AddReview",
            component: AddReview,
            meta: { requiresAuth: true },
        },
        {
            path: "/book/:id/review/:reviewId",
            name: "review",
            component: ReviewView,
            meta: { requiresAuth: true },
        },
        {
            path: "/login",
            name: 'login',
            component: LoginView,
            meta: { requiresNotAuth: true },
        },
        {
            path: "/register",
            name: 'register',
            component: RegisterView,
            meta: { requiresNotAuth: true },
        },
        {
            path: "/:catchAll(.*)",
            name: "not-found",
            component: NotFoundView
        }
    ]
})

router.beforeEach((to, _, next) => {
    if (to.meta.requiresAuth && !authStore.isAuthenticated) next('/login');
    else if (to.meta.requiresNotAuth && authStore.isAuthenticated) next('/');
    else next();
 });

export default router
