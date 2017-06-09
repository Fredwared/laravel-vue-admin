import axios from 'axios';

const API_ROOT = '/api/v1';

export default ({
    // 登录
    login: function (params) {
        return axios.post(API_ROOT + '/login', params).then(res => res.data);
    },

    logout: function () {
        return axios.post(API_ROOT + '/logout').then(res => res.data);
    },

    me: function () {
        return axios.get(API_ROOT + '/me').then(res => res.data);
    },

    refreshToken: function(params) {
        return axios.post(API_ROOT + '/token/refresh', params).then(res => res.data);
    }
})