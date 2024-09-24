require('./bootstrap');

import { createApp } from 'vue'

import MyToDoList from './components/MyToDoList.vue';

export const eventBus = createApp(MyToDoList)

createApp(MyToDoList).mount('#app')