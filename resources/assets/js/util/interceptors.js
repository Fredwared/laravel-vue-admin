import axios from 'axios';
import store from '../store';
import { Message } from 'element-ui';
import { keys, has } from 'lodash';


axios.interceptors.request.use(
    config => {
        console.log(store.getters.authToken);
        if (store.getters.authToken) {
            config.headers.common['Authorization'] = 'Bearer ' + store.getters.authToken;
        }

        return config;
    },
    error => Promise.reject(error)
);

axios.interceptors.response.use(
    response => response,
    error => {
        const  response  = error.response.data;

        if ( response.status_code >= 500 ) {
            Message({
                type: 'error',
                message: response.message
            });
        } else if ( response.status_code == 422) {
            const keyGroup = keys(response.errors);
            Message({
                type: 'error',
                message: response.errors[keyGroup[0]][0]
            });
        } else {
            const statusCodeAndMessage =　{
                    400 : '令牌无效',
                    401 : '令牌过期',
                    402 : '缺少令牌',
                    404 : '找不到内容',
                    411 : '用户名或密码错误',
                    412 : '找不到用户',
            };

            let message = response.message;

            if (has(statusCodeAndMessage, response.status_code)) {
                message = statusCodeAndMessage[response.status_code];
            }

            Message({
                type: 'error',
                message: message
            });
        }

        return Promise.reject(error);
    }
);