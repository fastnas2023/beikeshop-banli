@extends('layout.master')

@section('body-class', 'page-login')

@push('header')
  <script src="{{ asset('vendor/vue/2.7/vue' . (!config('app.debug') ? '.min' : '') . '.js') }}"></script>
  <script src="{{ asset('vendor/element-ui/index.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('vendor/element-ui/index.css') }}">
@endpush

@section('content')
<div class="bg-dark section-dark text-light pb-5" style="min-height: 100vh;">
  @if (!request('iframe'))
    <x-shop-breadcrumb type="static" value="login.index" :is-full="true" />
  @endif

  <div class="{{ request('iframe') ? 'container-fluid form-iframe mt-5' : 'container' }}" id="page-login" v-cloak style="padding-top: 40px;">
    @if (!request('iframe'))
      @hookwrapper('account.login.heading')
      <div class="hero-content pb-3 pb-lg-5 text-center mt-4"><h1 class="hero-heading fw-bold">{{ __('shop/login.index') }}</h1></div>
      @endhookwrapper
    @endif

    <div class="login-wrap mx-auto" style="max-width: 500px;">
      <div class="card glass-card shadow-sm mb-4 bg-dark bg-opacity-75 border-secondary text-light">
        <div class="card-header border-secondary p-0">
          <ul class="nav nav-tabs nav-fill border-secondary" id="loginTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active bg-transparent text-light border-0 py-3 fw-bold" :class="{ 'text-primary border-bottom border-primary border-2': activeTab === 'login' }" @click="activeTab = 'login'" type="button" role="tab">{{ __('shop/login.login') }}</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link bg-transparent text-light border-0 py-3 fw-bold" :class="{ 'text-primary border-bottom border-primary border-2': activeTab === 'register' }" @click="activeTab = 'register'" type="button" role="tab">{{ __('shop/login.new') }}</button>
            </li>
          </ul>
        </div>
        
        <div class="card-body p-4">
          <!-- Login Form -->
          <div v-show="activeTab === 'login'">
            <el-form ref="loginForm" :model="loginForm" :rules="loginRules" :inline-message="true" class="dark-form">
              @hookwrapper('account.login.email')
              <el-form-item label="{{ __('shop/login.email') }}" prop="email">
                <el-input @keyup.enter.native="checkedBtnLogin('loginForm')" v-model="loginForm.email" placeholder="{{ __('shop/login.email_address') }}"></el-input>
              </el-form-item>
              @endhookwrapper

              @hookwrapper('account.login.password')
              <el-form-item label="{{ __('shop/login.password') }}" prop="password">
                <el-input @keyup.enter.native="checkedBtnLogin('loginForm')" type="password" v-model="loginForm.password" placeholder="{{ __('shop/login.password') }}"></el-input>
              </el-form-item>
              @endhookwrapper

              @hook('account.login.password.after')

              @hookwrapper('account.login.forget_password')
              @if (!request('iframe'))
                <div class="text-end mt-2 mb-4">
                  <a class="text-white-50 text-decoration-none forgotten-link" href="{{ shop_route('forgotten.index') }}"><i class="bi bi-question-circle"></i> {{ __('shop/login.forget_password') }}</a>
                </div>
              @endif
              @endhookwrapper

              @hookwrapper('account.login.new.login')
              <div class="mt-4 mb-3">
                <button type="button" @click="checkedBtnLogin('loginForm')" class="btn btn-neon btn-lg w-100 fw-bold"><i class="bi bi-box-arrow-in-right"></i> {{ __('shop/login.login') }}</button>
              </div>
              @endhookwrapper
            </el-form>

            @if($social_buttons)
              <div class="social-wrap mt-4 pt-4 border-top border-secondary text-center">
                <div class="text-white-50 mb-3 small">{{ __('shop/login.third_party_logins') }}</div>
                <div class="d-flex justify-content-center gap-2">
                  @foreach($social_buttons as $button)
                    {!! $button !!}
                  @endforeach
                </div>
              </div>
            @endif
          </div>

          <!-- Register Form -->
          <div v-show="activeTab === 'register'">
            <el-form ref="registerForm" :model="registerForm" :rules="registeRules" class="dark-form">
              @hookwrapper('account.login.new.email')
              <el-form-item label="{{ __('shop/login.email') }}" prop="email">
                <el-input @keyup.enter.native="checkedBtnLogin('registerForm')" v-model="registerForm.email" placeholder="{{ __('shop/login.email_address') }}"></el-input>
              </el-form-item>
              @endhookwrapper

              @hookwrapper('account.login.new.password')
              <el-form-item label="{{ __('shop/login.password') }}" prop="password">
                <el-input @keyup.enter.native="checkedBtnLogin('registerForm')" type="password" v-model="registerForm.password" placeholder="{{ __('shop/login.password') }}"></el-input>
              </el-form-item>
              @endhookwrapper

              @hook('account.login.new.confirm_password.bottom')

              @hookwrapper('account.login.new.register')
              <div class="mt-5 mb-3">
                <button type="button" @click="checkedBtnLogin('registerForm')" class="btn btn-neon btn-lg w-100 fw-bold"><i class="bi bi-person"></i> {{ __('shop/login.register') }}</button>
              </div>
              @endhookwrapper
            </el-form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('add-scripts')
  <style>
    .dark-form .el-input__inner {
      background-color: rgba(255,255,255,0.05);
      border: 1px solid rgba(255,255,255,0.1);
      color: #fff;
    }
    .dark-form .el-input__inner:focus {
      border-color: var(--bs-primary);
      background-color: rgba(255,255,255,0.1);
    }
    .dark-form .el-form-item__label {
      color: rgba(255,255,255,0.8);
    }
  </style>
  <script>
    let app = new Vue({
      el: '#page-login',

      data: {
        activeTab: 'login',
        loginForm: {
          email: '',
          password: '',
        },

        registerForm: {
          email: '',
          password: '',
          password_confirmation: '',
        },

        loginRules: {
          email: [
            {required: true, message: '{{ __('shop/login.enter_email') }}', trigger: 'change'},
            {type: 'email', message: '{{ __('shop/login.email_err') }}', trigger: 'change'},
          ],
          password: [
            {required: true, message: '{{ __('shop/login.enter_password')}}', trigger: 'change'}
          ]
        },

        registeRules: {
          email: [
            {required: true, message: '{{ __('shop/login.enter_email') }}', trigger: 'change'},
            {type: 'email', message: '{{ __('shop/login.email_err') }}', trigger: 'change'},
          ],
          password: [
            {required: true, message: '{{ __('shop/login.enter_password')}}', trigger: 'change'}
          ],
        },
        @stack('login.vue.data')
      },

      beforeMount () {
        @hook('shop.login.vue.beforeMount')
      },

      methods: {
        checkedBtnLogin(form) {
          let _data = this.loginForm, url = '/login'

          if (form == 'registerForm') {
            _data = this.registerForm, url = '/register'
            this.registerForm.password_confirmation = this.registerForm.password
          }

          this.$refs['loginForm'].clearValidate();
          this.$refs['registerForm'].clearValidate();

          this.$refs[form].validate((valid) => {
            if (!valid) {
              layer.msg('{{ __('shop/login.check_form') }}', () => {})
              return;
            }

            $http.post(url, _data, {hmsg: true}).then((res) => {
              layer.msg(res.message)
              @if (!request('iframe'))
                location = "{{ shop_route('account.index') }}"
              @else
                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                setTimeout(() => {
                  parent.layer.close(index); //再执行关闭
                  parent.window.location.reload()
                }, 400);
              @endif
            }).catch((err) => {
              if (err.response.data.data && err.response.data.data.error == 'password') {
                layer.msg(err.response.data.message, ()=>{})
                return
              }

              layer.alert(err.response.data.message, {title: '{{ __('common.text_hint') }}', btn: ['{{ __('common.confirm') }}'], skin: 'login-alert'})
            })
          });
        },
        @stack('login.vue.method')
      },

      @hook('shop.login.vue.options')
    })

    @hook('account.login.form.js.after')

    // 监听第三方登录成功回调的页面 postMessage 消息，关闭当前窗口
    window.addEventListener('message', function (event) {
      if (event.data.type == 'social_callback' && event.data.data == 'close_window') {
        if (window.name) {
          var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
          parent.layer.close(index); //再执行关闭
          parent.window.location.reload()
        }
      }
    }, false);
  </script>
@endpush
