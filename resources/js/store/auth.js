import { reactive } from 'vue';
import router from '../router/app';

export const authStore = reactive({
    isAuthenticated: false,

    async checkAuth() {
        try {
            const token = localStorage.getItem('token');
            if (token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                await axios.get('/api/user');
                this.isAuthenticated = true;
            }
        } catch (error) {
            console.log(error);
            this.isAuthenticated = false;
        }
    },

    async login(body) {
        try {
            const response = await axios.post('/api/login', body);
            const token = response.data.token;
            localStorage.setItem('token', token);
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            this.isAuthenticated = true;
            router.push('/');
        } catch (error) {
            throw new Error('Invalid credentials');
        }
    },

    async logout() {
        await axios.post('/api/logout');
        localStorage.removeItem('token');
        this.isAuthenticated = false;
        router.push('/login');
    }
});
