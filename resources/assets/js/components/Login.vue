<template>
    <el-form :model="ruleForm2" :rules="rules2" ref="ruleForm2" label-position="left" label-width="0px" class="login">
        <h5 class="login_title">管理后台登录</h5>
        <el-form-item prop="username">
            <el-input type="text" v-model="ruleForm2.username" auto-complete="off" placeholder="用户名"></el-input>
        </el-form-item>
        <el-form-item prop="password">
            <el-input type="password" v-model="ruleForm2.password" auto-complete="off" placeholder="密码"></el-input>
        </el-form-item>
        <el-form-item style="width: 100%">
            <el-button type="primary" style="width: 100%" @click.native.prevent="handleSubmit" :loading="logining">登录</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import api from '../util/api';
    import { mapActions } from 'vuex';

    export default {
        data() {
            return {
                logining: false,
                ruleForm2: {
                    username: '',
                    password: ''
                },
                rules2: {
                    username: [
                        { required: true, message: '请输入账号', trigger: 'blur' },
                    ],
                    password: [
                        { required: true, message: '请输入密码', trigger: 'blur' },
                        { min: 6, max: 100, message: '密码长度太短', 'trigger': 'blur' }
                    ]
                }
            }
        },
        methods: {
            ...mapActions(['setToken', 'setUser']),

            handleSubmit() {
                let _this = this;
                this.$refs.ruleForm2.validate((valid) => {
                    if (valid) {
                        this.logining = true;
                        api.login(this.ruleForm2).then(function(res) {
                            _this.logining= false;
                            if (res.status_code == 200) {
                                _this.setToken(res.data.token);
                                _this.setUser(res.data.user);
                                _this.$message({
                                    message: '欢迎回来, ' + res.data.user.name,
                                    type: 'success'
                                });
                                _this.$router.push({ path: '/index' });
                            }
                        }).catch(function () {
                            _this.logining = false;
                        })
                    }
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .login {
        border-radius: 5px;
        background-clip: padding-box;
        margin: 180px auto;
        width: 350px;
        padding: 35px 35px 15px 35px;
        background: #fff;
        border: 1px solid #eaeaea;
        box-shadow: 0 0 25px #cac6c6;
        .login_title {
            margin: 0px auto 40px auto;
            text-align: center;
            color: #505458;
            font-size: 20px;
        }
    }
</style>