import axios from "axios";
import Cookies from "js-cookie";

// state
const state = {
    user: null,
    token: Cookies.get("token"),
    isLogged: false
}

// getters
const getters = {
    user: state => state.user,
    token: state => state.token,
    check: state => state.isLogged,
}

// mutations
const mutations = {
    login(state) {
        state.isLogged = false;
    },
    login_success(state, { token }) {
        state.token = token;
        state.isLogged = true;
        Cookies.set("token", token, 365 );
    },
    login_failed(state, { error }) {

        state.isLogged = false;
    },
    fatch_user_success(state, { user }) {
        state.user = user.data;
        state.isLogged = true;
    },
    fatch_user_failure(state) {
        state.token = null;
        Cookies.remove("token");
        state.isLogged = false;
    },
    logout(state) {
        state.user = null;
        state.token = null;
        Cookies.remove("token");
        state.isLogged = false;
    }
};

// actions
const actions = {
    login({commit}) {
        commit('login');
    },  logout({commit}) {
        commit('logout');
    },
    async fetchUser({commit}) {
        try {
            const { data } = await axios.get('/api/user')
            commit('fatch_user_success', {user: data} )
        } catch (error) {
            commit('fatch_user_failure')
        }
    }
}

export default  {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}