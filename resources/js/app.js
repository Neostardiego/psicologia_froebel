require('./bootstrap');
import Vue from 'vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import Axios from 'axios'
import lang from 'element-ui/lib/locale/lang/es'
import locale from 'element-ui/lib/locale'

locale.use(lang)
//Vue.use(ElementUI)
Vue.use(ElementUI, {size: 'small'})
Vue.prototype.$eventHub = new Vue()
Vue.prototype.$http = Axios

//Cuenta
  
 Vue.component('citas-index', require('./views/citas/index.vue').default);
 //Vue.component('perfil-index', require('./views/users/perfil.vue').default);

 //Vue.component('padron-index', require('./views/padron/index.vue').default);
//auto update
//Vue.component('system-update', require('./views/system/update/index.vue'));

const app = new Vue({
    el: '#main-wrapper'
});
