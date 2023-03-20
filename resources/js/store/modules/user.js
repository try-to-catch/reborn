export default {
    namespaced: true,
    state: {
        user: {}
    },
    getters: {
        getUser: (state) => state.user
    },
    mutations:{
        setUser(state, user){
            state.user = user;
        }
    },
    actions:{
        setUser({commit}, user) {
            commit('setUser', user)
        }
    }
}
