import Vue from 'vue'
import VueRouter from 'vue-router'

import App from '../App.vue'
import UserApp from '../UserApp.vue'
import Top from '../views/Top.vue'
import Contact from '../views/Contact.vue'

import AdminApp from '../AdminApp.vue'
import EditNews from '../views/EditNews.vue'
import ReleasedNews from '../views/ReleasedNews.vue'
import OtherSettings from '../views/OtherSettings.vue'

import Login from '../views/Login.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'App',
    component: App,
    children: [
      {
        path: '/top',
        name: 'UserApp',
        component: UserApp,
        children: [
          {
            path: '/top',
            name: 'Top',
            component: Top
          },
          {
            path: '/contact',
            name: 'Contact',
            component: Contact
          },
          {
            path: '/about',
            name: 'About',
            // route level code-splitting
            // this generates a separate chunk (about.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
          }
        ]
      },
      {
        path: '/admin',
        name: 'AdminApp',
        component: AdminApp,
        children: [
          {
            path: '/admin/editNews',
            name: 'EditNews',
            component: EditNews
          },
          {
            path: '/admin/releasedNews',
            name: 'ReleasedNews',
            component: ReleasedNews
          },
          {
            path: '/admin/otherSettings',
            name: 'OtherSettings',
            component: OtherSettings
          }
        ]
      },
      {
        path: '/admin/login',
        name: 'Login',
        component: Login,
      }
    ]
  }
]

const router = new VueRouter({
  routes
})

export default router
