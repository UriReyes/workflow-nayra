require('./bootstrap');

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
Alpine.start();

window.Swal = Swal;

// //Renderizar otros componentes de vue
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// const app = new Vue({
//     el: '#app-vue',
// });
