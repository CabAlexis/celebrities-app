import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';

import ProfilesList from '../components/profiles/List.vue';

const app = createApp({
    components: {
        ProfilesList
    }
});

app.mount('#app');
