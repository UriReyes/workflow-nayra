require('./app');
window.Vue = require('vue').default;

// Modeler App renderizada y adaptada desde Vue CLI
import i18next from 'i18next';
import VueI18Next from '@panter/vue-i18next';
import ModelerApp from './modeler/ModelerApp.vue';
import BootstrapVue from 'bootstrap-vue';
import './modeler/setup/initialLoad';
import translations from '@/setup/translations.json';
import * as VueDeepSet from 'vue-deepset';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import ScreenBuilder from '@processmaker/screen-builder';
import Multiselect from '@processmaker/vue-multiselect/src/Multiselect';

import '@fortawesome/fontawesome-free/css/all.min.css';
import Toasted from 'vue-toasted';

Vue.use(Toasted, {
    iconPack: 'fontawesome' // set your iconPack, defaults to material. material|fontawesome|custom-class
});
Vue.use(BootstrapVue);
Vue.use(VueDeepSet);
Vue.use(VueI18Next);
Vue.use(ScreenBuilder);
Vue.component('Multiselect', Multiselect);

Vue.config.productionTip = false;

i18next.init({
    lng: 'en',
    resources: { en: { translation: translations } },
});
Vue.mixin({ i18n: new VueI18Next(i18next) });

new Vue({
    render: h => h(ModelerApp),
}).$mount('#app');
window.ProcessMaker.EventBus.$on('modeler-change', () => {
    console.log('The diagram has changed');
});