import localforage from 'localforage'
import { isEmpty, isObject } from 'lodash';
import { userTokenKey, refreshTokenBefore } from '../config';
import api from '../util/api';

const state =  {
    user: {},
    token: {}
};

const mutations = {
    SET_USER(state, value) {
        state.user = value;
    },
    SET_TOKEN(state, value) {
        state.token = value;
    }
};

const actions = {
    setToken( { commit }, payload ) {
        const token = isEmpty(payload) ? {} : payload;

        commit('SET_TOKEN', token);

        if (token) {
            localforage.setItem(userTokenKey, token);
        }
    },

    setUser( { commit }, user ) {
        commit('SET_USER', user);
    },

    checkTokenExpired({ dispatch }, token) {
        if (isObject(token)) {
            let currentTime = new Date().getTime();

            if (token.ttl > currentTime) {
                //剩余一分钟的情况下刷新token
                if (token.ttl - currentTime < refreshTokenBefore) {
                    return dispatch('refreshToken', token.token);
                }
                console.log('Token unexpired');
                return Promise.resolve('Token unexpired');
            } else {
                //在token已过期的情况下刷新
                return dispatch('refreshToken', token.token);
            }
        }else {
            return Promise.reject('Token expired');
        }
    },

    checkUserToken( { dispatch, state } ) {
        if (!isEmpty(state.token)) {
            return dispatch('checkTokenExpired', state.token)
        }

        return localforage.getItem(userTokenKey)
            .then((token) => {
                if (isEmpty(token)) {
                    return Promise.reject('No token');
                }

                return dispatch('checkTokenExpired', token).then( (res) => {
                    dispatch('setToken', token);
                    console.log('Check localStorage token ok');
                    return dispatch('loadUser');
                }).catch( () => {
                    return Promise.reject('Token expired');
                });
            })
    },

    loadUser( { dispatch } ) {
        return api.me().then( (res) => {
            dispatch('setUser', res.data.user);
            console.log('load user success');
            return Promise.resolve('load user success');
        }).catch( () => {
            dispatch('reset');
            return Promise.reject('load user fail');
        });
    },

    refreshToken( { dispatch }, token) {
        api.refreshToken({token:token}).then( (res) => {
            dispatch('setToken', res.data);
            console.log("Refresh token success");
            return Promise.resolve("Refresh token success");
        } ).catch( () => {
            dispatch('reset');
            return Promise.reject('Refresh token fail');
        });
    },

    reset({ dispatch }) {
        dispatch('setUser', {});
        dispatch('setToken', {});
        localforage.removeItem(userTokenKey);
        return Promise.resolve('Reset user success');
    }
};

const getters = {
    authUser: state => state.user,
    authToken: state => state.token.token
};

export default {
    state,
    mutations,
    getters,
    actions,
}
