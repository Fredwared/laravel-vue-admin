<template>
    <el-row class="container">
        <el-col :span="24" class="header">
            <el-col :span="10" class="logo" :class="collapsed　?　'logo_width--collapse'　:　'logo_width'">
                {{collapsed　?　''　:　logo}}
            </el-col>
            <el-col :span="10">
                <div class="tools" @click.prevent="collapse">
                    <i class="fa fa-align-justify"></i>
                </div>
            </el-col>
            <el-col :span="4" class="user_info">
                <el-dropdown trigger="click">
                    <span class="el-dropdown-link user_info--inner"><img :src="user.avatar ? user.avatar : '/images/default_avatar.jpg'" /> {{ user.name }}</span>
                    <el-dropdown-menu slot="dropdown">
                        <el-dropdown-item>我的消息</el-dropdown-item>
                        <el-dropdown-item>设置</el-dropdown-item>
                        <el-dropdown-item divided @click.native="logout">退出登录</el-dropdown-item>
                    </el-dropdown-menu>
                </el-dropdown>
            </el-col>
        </el-col>
        <el-col :span="24" class="main">
            <aside :class=" collapsed? 'menu--collapsed' : 'menu--expanded' ">
                <el-menu :default-active="$route.path"
                         class="el-menu-vertical-demo"
                         unique-opened router
                         v-show="!collapsed"
                >
                    <template v-for="(item, index) in $router.options.routes" v-if="!item.hidden">
                        <el-submenu :index="index + ''" v-if="!item.leaf">
                            <template slot="title">
                                <i :class="item.icon"></i>{{ item.title }}
                            </template>
                            <el-menu-item v-for="child in item.children" :index="child.path" :key="child.path" v-if="!child.hidden">
                                {{ child.title }}
                            </el-menu-item>
                        </el-submenu>
                        <el-menu-item v-if="item.leaf && item.children.length > 0" :index="item.children[0].path">
                            <i :class="item.icon"></i>{{ item.children[0].title }}
                        </el-menu-item>
                    </template>
                </el-menu>

                <!--折叠-->
                <ul class="el-menu el-menu-vertical collapsed">
                    <li v-for="(item, index) in $router.options.routes" v-if="!item.hidden" class="el-submenu item">
                        <template v-if="!item.leaf">
                            <div class="el-submenu__title" style="padding-left: 20px;"
                                 @mouseover="showMenu(index, true)"
                                 @mouseout="showMenu(index, false)"
                            >
                                <i :class="item.icon"></i>
                            </div>
                            <ul class="el-menu submenu"
                                :class="'submenu-hook-'+ index"
                                @mouseover="showMenu(index, true)"
                                @mouseout="showMenu(index, false)"
                            >
                                <li v-for="child in item.children"
                                    v-if="!child.hidden"
                                    :key="child.path"
                                    class="el-menu-item"
                                    style="padding-left: 40px"
                                    :class="$route.path == child.path ? 'is-active' : '' "
                                    @click="$router.push(child.path)"
                                >
                                    {{ child.title }}
                                </li>
                            </ul>
                        </template>
                        <template v-else>
                            <li class="el-submenu">
                                <div class="el-submenu__title el-menu-item" style="height: 56px;line-height: 56px;padding: 0 20px"
                                     :class="$route.path == item.children[0].path ? 'is-active' : ''"
                                     @click="$router.push(item.children[0].path)"
                                >
                                    <i :class="item.icon"></i>
                                </div>
                            </li>
                        </template>
                    </li>
                </ul>
            </aside>

            <section class="content">
                <div class="grid-content bg-purple-light">
                    <el-col :span="24" class="content--wrapper">
                        <transition name="fade" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </el-col>
                </div>
            </section>
        </el-col>
    </el-row>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import api from '../util/api';

    export default {
        data() {
            return {
                collapsed: false,
                logo: '一点学车',
            }
        },

        methods: {
            ...mapActions(['reset']),

            collapse: function () {
                this.collapsed = !this.collapsed;
            },

            showMenu: function(index, status) {
                this.$refs.menuCollapsed.getElementsByClassName('submenu-hook-' + index).style.disaply = status ? 'block' : 'none';
            },

            logout: function() {
                const _this = this;
                api.logout().then((res) => {
                    _this.reset();
                    _this.$message('退出成功');
                    _this.$router.push({ path: '/login' });
                }).catch(() => {
                    _this.reset();
                    _this.$router.push({ path: '/login' });
                });
            }
        },

        computed: {
            ...mapGetters({
                user: 'authUser'
            })
        }
    }
</script>

<style scoped lang="scss">

    .container {
        position: absolute;
        top: 0px;
        bottom: 0px;
        width: 100%;
        .header {
            height: 60px;
            line-height: 60px;
            background: #20a0ff;
            color:#fff;
            .user_info {
                text-align: right;
                padding-right: 35px;
                float: right;
                .user_info--inner {
                    cursor: pointer;
                    color:#fff;
                    img {
                        width: 40px;
                        height: 40px;
                        border-radius: 20px;
                        margin: 10px 0px 10px 10px;
                        float: right;
                    }
                }
            }
            .logo {
                height:60px;
                font-size: 22px;
                padding-left:20px;
                padding-right:20px;
                border-color: rgba(238,241,146,0.3);
                border-right-width: 1px;
                border-right-style: solid;
                img {
                    width: 40px;
                    float: left;
                    margin: 10px 10px 10px 18px;
                }
            }
            .logo_width{
                width:230px;
            }
            .logo_width--collapse{
                width:60px
            }
            .tools{
                padding: 0px 23px;
                width:14px;
                height: 60px;
                line-height: 60px;
                cursor: pointer;
            }
        }
        .main {
            display: flex;
            position: absolute;
            top: 60px;
            bottom: 0px;
            overflow: hidden;
            aside {
                flex:0 0 230px;
                width: 230px;
                .el-menu{
                    height: 100%;
                }
                .collapsed{
                    width:60px;
                    .item{
                        position: relative;
                    }
                    .submenu{
                        position:absolute;
                        top:0px;
                        left:60px;
                        z-index:99999;
                        height:auto;
                        display:none;
                    }

                }
            }
            .menu--collapsed{
                flex:0 0 60px;
                width: 60px;
            }
            .menu--expanded{
                flex:0 0 230px;
                width: 230px;
            }
            .content {
                flex:1;
                overflow-y: scroll;
                padding: 20px;
                .content--wrapper {
                    background-color: #fff;
                    box-sizing: border-box;
                }
            }
        }
    }
</style>