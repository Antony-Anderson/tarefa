//import Login from './Pages/Login/Login.vue';
import Tarefa from './Pages/Tarefa/Index.vue';
import Perfil from './Pages/Perfil/Index.vue';
import Pomodoro from './Pages/Pomodoro/Index.vue';

function beforeEnter(next){
    let token = localStorage.getItem('token');
    if(!token) {
      window.location.href = window.location.origin+"/login";
    } else {
        next()
    }
}

const routes = [
    {
      path: "/",
      component: Tarefa,
      beforeEnter: (to, from, next) => beforeEnter(next)
    },
    {
      path: "/tarefas",
      name: "Tarefa",
      component: Tarefa,
      beforeEnter: (to, from, next) => beforeEnter(next)
    },
    {
      path: "/perfil",
      name: "Perfil",
      component: Perfil,
      beforeEnter: (to, from, next) => beforeEnter(next)
    },
    {
      path: "/pomodoro",
      name: "Pomodoro",
      component: Pomodoro,
      beforeEnter: (to, from, next) => beforeEnter(next)
    },

];

export default routes;
