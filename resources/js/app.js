import './bootstrap';
import { createApp } from 'vue';
import App from './src/App.vue';
import _ from 'lodash';

createApp(App).use(_).mount('#app');
