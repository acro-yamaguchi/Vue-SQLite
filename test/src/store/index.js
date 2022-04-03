import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
      id: "",
      token: ""
    },
    mutations: {
      updateUser(state, data) {
        state.id = data.id;
        state.token = data.token;
      }
    },
    actions: {
      auth(context, data) {
        context.commit('updateUser', data);
      }
    },
})
