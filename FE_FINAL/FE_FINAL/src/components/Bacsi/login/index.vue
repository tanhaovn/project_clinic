<template>
  <div class="container active d-flex align-items-center justify-content-center min-vh-100">

    <div class="login-container p-4 shadow rounded bg-white" style="max-width: 420px; width: 100%;">

      <!-- SVG Yeti -->
<div class="text-center mb-4">
  <svg
    class="yeti"
    viewBox="0 0 200 200"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
    width="180"
    height="180"
  >
    <!-- đầu -->
    <circle cx="100" cy="100" r="70" fill="#87CEFA" stroke="#2b2b2b" stroke-width="3" />

    <!-- tai -->
    <circle cx="40" cy="70" r="18" fill="#87CEFA" stroke="#2b2b2b" stroke-width="2" />
    <circle cx="160" cy="70" r="18" fill="#87CEFA" stroke="#2b2b2b" stroke-width="2" />

    <!-- sừng -->
    <path d="M30 50 C20 20, 60 20, 50 55" fill="none" stroke="#333" stroke-width="4" stroke-linecap="round" />
    <path d="M170 50 C180 20, 140 20, 150 55" fill="none" stroke="#333" stroke-width="4" stroke-linecap="round" />

    <!-- mũ bác sĩ -->
    <g id="doctorHat">
      <rect x="72" y="24" width="56" height="14" rx="7" fill="#ffffff" stroke="#2b2b2b" stroke-width="2" />
      <rect x="60" y="36" width="80" height="26" rx="8" fill="#ffffff" stroke="#2b2b2b" stroke-width="2" />
      <circle cx="100" cy="49" r="9" fill="#e6f4ff" stroke="#2b2b2b" stroke-width="1.5" />
      <path d="M100 43 V55" stroke="#1d9bf0" stroke-width="2" stroke-linecap="round" />
      <path d="M94 49 H106" stroke="#1d9bf0" stroke-width="2" stroke-linecap="round" />
    </g>

    <!-- mắt -->
    <circle id="eyeLeft" cx="75" cy="95" r="15" fill="#fff" stroke="#2b2b2b" stroke-width="2" />
    <circle id="eyeRight" cx="125" cy="95" r="15" fill="#fff" stroke="#2b2b2b" stroke-width="2" />

    <!-- con ngươi -->
    <g id="pupils">
      <circle id="pupilLeft" class="pupil" cx="75" cy="95" r="6" fill="#000" />
      <circle id="pupilRight" class="pupil" cx="125" cy="95" r="6" fill="#000" />
    </g>

    <!-- miệng -->
    <path d="M75 130 Q100 150 125 130" stroke="#2b2b2b" stroke-width="3" fill="none" />

    <!-- răng nanh -->
    <path d="M85 130 L90 145 L95 130Z" fill="#fff" stroke="#2b2b2b" stroke-width="1" />
    <path d="M115 130 L110 145 L105 130Z" fill="#fff" stroke="#2b2b2b" stroke-width="1" />

    <!-- khẩu trang -->
    <g id="maskLogin">
      <path
        d="M64 118
           Q100 106 136 118
           Q140 130 136 144
           Q100 156 64 144
           Q60 132 64 118 Z"
        fill="#f9feff"
        stroke="#2b2b2b"
        stroke-width="2"
      />

      <path
        d="M66 120
           Q100 110 134 120
           Q138 130 134 142
           Q100 152 66 142
           Q62 132 66 120 Z"
        fill="none"
        stroke="#9ed5ff"
        stroke-width="1.5"
      />

      <!-- nếp khẩu trang -->
      <path d="M70 126 Q100 118 130 126" stroke="#c2e7ff" stroke-width="2" stroke-linecap="round" />
      <path d="M70 134 Q100 126 130 134" stroke="#c2e7ff" stroke-width="2" stroke-linecap="round" />
      <path d="M70 142 Q100 134 130 142" stroke="#c2e7ff" stroke-width="2" stroke-linecap="round" />

      <!-- đường may -->
      <path d="M68 121 Q64 132 68 143" stroke="#d0e9ff" stroke-width="1.3" stroke-dasharray="3 2" />
      <path d="M132 121 Q136 132 132 143" stroke="#d0e9ff" stroke-width="1.3" stroke-dasharray="3 2" />

      <!-- dây khẩu trang -->
      <path
        d="M64 126 Q54 120 48 110 Q44 102 40 88"
        fill="none"
        stroke="#2b2b2b"
        stroke-width="2"
        stroke-linecap="round"
      />
      <path
        d="M136 126 Q146 120 152 110 Q156 102 160 88"
        fill="none"
        stroke="#2b2b2b"
        stroke-width="2"
        stroke-linecap="round"
      />
    </g>

    <!-- tay -->
    <g id="handLeft" class="hand" transform="translate(0,60)">
      <ellipse cx="65" cy="100" rx="28" ry="20" fill="#fff" stroke="#2b2b2b" stroke-width="2" />
    </g>
    <g id="handRight" class="hand" transform="translate(0,60)">
      <ellipse cx="135" cy="100" rx="28" ry="20" fill="#fff" stroke="#2b2b2b" stroke-width="2" />
    </g>
  </svg>
</div>

      <!-- TIÊU ĐỀ -->
      <div class="text-center mb-4">
        <h3 class="fw-bold text-primary">Welcome, Doctor!</h3>
      </div>

      <!-- FORM -->
      <form @submit.prevent="DangNhap">

        <!-- Email -->
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input
            v-model="user.email"
            type="email"
            class="form-control"
            placeholder="doctor@email.com"
            required
          />
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label class="form-label">Mật khẩu</label>
          <div class="input-group">
            <input
              v-model="user.password"
              :type="showPassword ? 'text' : 'password'"
              class="form-control border-end-0"
              placeholder="Nhập mật khẩu..."
              required
            />
            <span class="input-group-text bg-transparent" @click="showPassword = !showPassword" style="cursor: pointer;">
              <i class="bx" :class="showPassword ? 'bx-hide' : 'bx-show'"></i>
            </span>
          </div>
        </div>

        <!-- Quên mật khẩu -->
        <div class="text-end mb-3">
          <router-link to="/bac-si/quen-mat-khau" class="btn btn-link px-0">
            Quên mật khẩu?
          </router-link>
        </div>

        <!-- Nút Đăng nhập -->
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-lock-open me-1"></i> Đăng nhập
          </button>
        </div>

      </form>

    </div>
  </div>
</template>

<script>
import baseRequestBacsi from '../../../core/baseRequestBacsi';

export default {
  data() {
    return {
      user: {
        email: '',
        password: ''
      },
      showPassword: false,
    };
  },
  methods: {
    DangNhap() {
      baseRequestBacsi.post('bac-si/login', this.user)
        .then((res) => {
          if (res.data.status) {
            this.$toast.success(res.data.message);
            this.user = {};
            localStorage.setItem('token_bac_si', res.data.token);
            this.$router.push('/bac-si/quan-ly-benh-nhan');
          } else {
            this.$toast.error(res.data.message);
          }
        })
        .catch((err) => {
          const listErr = err.response.data.errors;
          Object.values(listErr).forEach((error) => {
            this.$toast.error(error[0]);
          });
        });
    },
  },
};
</script>
