import './bootstrap';
import router from './routes';

if (document.querySelector(".alert"))  {
    setTimeout(function() {
        document.querySelector(".alert").style.opacity = 0;
        document.querySelector(".alert").style.top = "-25px";
        setTimeout(function() {
            document.querySelector(".alert").style.visibility = 'hidden';
        }, 1000);
    }, 4500)
}

new Vue({
    el: '#app',
    router // router: router
});