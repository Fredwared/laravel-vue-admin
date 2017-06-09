webpackJsonp([6],{

/***/ 120:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(129)

var Component = __webpack_require__(39)(
  /* script */
  __webpack_require__(122),
  /* template */
  __webpack_require__(126),
  /* scopeId */
  "data-v-35f6ecfc",
  /* cssModules */
  null
)
Component.options.__file = "/home/echo/code/dev/resources/assets/js/components/Login.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] Login.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-35f6ecfc", Component.options)
  } else {
    hotAPI.reload("data-v-35f6ecfc", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 122:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; //
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var _api = __webpack_require__(42);

var _api2 = _interopRequireDefault(_api);

var _vuex = __webpack_require__(41);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
    data: function data() {
        return {
            logining: false,
            ruleForm2: {
                username: '',
                password: ''
            },
            rules2: {
                username: [{ required: true, message: '请输入账号', trigger: 'blur' }],
                password: [{ required: true, message: '请输入密码', trigger: 'blur' }, { min: 6, max: 100, message: '密码长度太短', 'trigger': 'blur' }]
            }
        };
    },

    methods: _extends({}, (0, _vuex.mapActions)(['setToken', 'setUser']), {
        handleSubmit: function handleSubmit() {
            var _this2 = this;

            var _this = this;
            this.$refs.ruleForm2.validate(function (valid) {
                if (valid) {
                    _this2.logining = true;
                    _api2.default.login(_this2.ruleForm2).then(function (res) {
                        _this.logining = false;
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
                    });
                }
            });
        }
    })
};

/***/ }),

/***/ 124:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(18)();
exports.push([module.i, "\n.login[data-v-35f6ecfc] {\n  border-radius: 5px;\n  background-clip: padding-box;\n  margin: 180px auto;\n  width: 350px;\n  padding: 35px 35px 15px 35px;\n  background: #fff;\n  border: 1px solid #eaeaea;\n  box-shadow: 0 0 25px #cac6c6;\n}\n.login .login_title[data-v-35f6ecfc] {\n    margin: 0px auto 40px auto;\n    text-align: center;\n    color: #505458;\n    font-size: 20px;\n}\n", ""]);

/***/ }),

/***/ 126:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('el-form', {
    ref: "ruleForm2",
    staticClass: "login",
    attrs: {
      "model": _vm.ruleForm2,
      "rules": _vm.rules2,
      "label-position": "left",
      "label-width": "0px"
    }
  }, [_c('h5', {
    staticClass: "login_title"
  }, [_vm._v("管理后台登录")]), _vm._v(" "), _c('el-form-item', {
    attrs: {
      "prop": "username"
    }
  }, [_c('el-input', {
    attrs: {
      "type": "text",
      "auto-complete": "off",
      "placeholder": "用户名"
    },
    model: {
      value: (_vm.ruleForm2.username),
      callback: function($$v) {
        _vm.ruleForm2.username = $$v
      },
      expression: "ruleForm2.username"
    }
  })], 1), _vm._v(" "), _c('el-form-item', {
    attrs: {
      "prop": "password"
    }
  }, [_c('el-input', {
    attrs: {
      "type": "password",
      "auto-complete": "off",
      "placeholder": "密码"
    },
    model: {
      value: (_vm.ruleForm2.password),
      callback: function($$v) {
        _vm.ruleForm2.password = $$v
      },
      expression: "ruleForm2.password"
    }
  })], 1), _vm._v(" "), _c('el-form-item', {
    staticStyle: {
      "width": "100%"
    }
  }, [_c('el-button', {
    staticStyle: {
      "width": "100%"
    },
    attrs: {
      "type": "primary",
      "loading": _vm.logining
    },
    nativeOn: {
      "click": function($event) {
        $event.preventDefault();
        _vm.handleSubmit($event)
      }
    }
  }, [_vm._v("登录")])], 1)], 1)
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-35f6ecfc", module.exports)
  }
}

/***/ }),

/***/ 129:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(124);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(40)("45766a1c", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-35f6ecfc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../node_modules/sass-loader/lib/loader.js!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Login.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"id\":\"data-v-35f6ecfc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../node_modules/sass-loader/lib/loader.js!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Login.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});