export default [
    {
        path: '/login',
        name:'login',
        meta: { auth:false },
        hidden: true,
        component: resolve => require(['../components/Login.vue'], resolve),
    },
    {
        path: '',
        hidden: true,
        redirect: '/index'
    },
    //懒加载
    //首页
    {
        path: '/',
        meta: { auth:true },
        component: resolve => require(['../layouts/Admin.vue'], resolve),
        leaf: true,
        icon: 'fa fa-home',
        children: [
            {
                path: '/index',
                name: 'index',
                meta: { auth:true },
                title: '首页',
                component: resolve => require(['../components/Index.vue'], resolve),
            }
        ]
    },
    //用户
    {
        path: '/',
        meta: { auth:true },
        component: resolve => require(['../layouts/Admin.vue'], resolve),
        icon: 'fa fa-home',
        title: '系统用户',
        children: [
            {
                path: '/user',
                name: 'user',
                meta: { auth:true },
                title: '用户',
                component: resolve => require(['../components/user/Index.vue'], resolve),
            }
        ]
    }
];