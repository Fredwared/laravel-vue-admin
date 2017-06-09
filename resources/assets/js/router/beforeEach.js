import store from '../store';

const beforeEach = (to, from, next) => {
    const auth = to.meta.auth;

    if (auth) {
        store.dispatch('checkUserToken')
            .then(() => {
                next();
            })
            .catch(() => {
                next({ name: 'login' });
            })
    } else {
        store.dispatch('checkUserToken')
            .then(() => {
                next({ name: 'index' });
            })
            .catch(() => {
                next();
            })
    }
};

export default beforeEach