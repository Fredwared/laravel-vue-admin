<template>
    <div id="app">
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
    export default {
        name: 'app'
    }
</script>

<style lang="scss">
    body {
        margin: 0px;
        padding:0px;
        font-size: 14px;
        -webkit-font-smoothing: antialiased;
    }

    #app {
        position: absolute;
        top: 0;
        bottom:0;
        width: 100%;
    }

    .el-submenu [class^=fa] {
        vertical-align: baseline;
        margin-right: 10px;
        font-size: 18px;
    }

    .el-menu-item [class^=fa] {
        vertical-align: baseline;
        margin-right: 10px;
        font-size: 18px;
    }

    .toolbar {
        background: #f2f2f2;
        padding: 10px;
        margin: 10px 0;
        .el-from-item {
            margin-bottom: 10px;
        }
    }

    .fa-enter-active,
    .fa-leave-active {
        transition: all .2s ease;
    }

    .fade-enter,
    .fade-leave-active {
        opacity: 0;
    }
</style>