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
          <circle cx="100" cy="100" r="70" fill="#87CEFA" stroke="#2b2b2b" stroke-width="3" />
          <circle cx="40" cy="70" r="18" fill="#87CEFA" stroke="#2b2b2b" stroke-width="2" />
          <circle cx="160" cy="70" r="18" fill="#87CEFA" stroke="#2b2b2b" stroke-width="2" />
          <path d="M30 50 C20 20, 60 20, 50 55" fill="none" stroke="#333" stroke-width="4" stroke-linecap="round" />
          <path d="M170 50 C180 20, 140 20, 150 55" fill="none" stroke="#333" stroke-width="4" stroke-linecap="round" />
          <circle cx="75" cy="95" r="15" fill="#fff" stroke="#2b2b2b" stroke-width="2" />
          <circle cx="125" cy="95" r="15" fill="#fff" stroke="#2b2b2b" stroke-width="2" />
          <circle cx="75" cy="95" r="6" fill="#000" />
          <circle cx="125" cy="95" r="6" fill="#000" />
          <path d="M75 130 Q100 150 125 130" stroke="#2b2b2b" stroke-width="3" fill="none" />
          <path d="M85 130 L90 145 L95 130Z" fill="#fff" stroke="#2b2b2b" stroke-width="1" />
          <path d="M115 130 L110 145 L105 130Z" fill="#fff" stroke="#2b2b2b" stroke-width="1" />
        </svg>
      </div>

      <!-- TIÊU ĐỀ -->
      <div class="text-center mb-4">
        <h3 class="fw-bold text-primary">Đăng ký Bác sĩ</h3>
      </div>

      <!-- FORM -->
      <form @submit.prevent="dangky">

        <!-- Email -->
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input
            v-model="dangKyForm.email"
            type="email"
            class="form-control"
            placeholder="doctor@example.com"
            required
          />
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label class="form-label">Mật khẩu</label>
          <div class="input-group">
            <input
              v-model="dangKyForm.password"
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

        <!-- Re-password -->
        <div class="mb-3">
          <label class="form-label">Nhập lại mật khẩu</label>
          <div class="input-group">
            <input
              v-model="dangKyForm.re_password"
              :type="showPassword ? 'text' : 'password'"
              class="form-control border-end-0"
              placeholder="Nhập lại mật khẩu..."
              required
            />
          </div>
        </div>

        <!-- Full name -->
        <div class="mb-3">
          <label class="form-label">Họ và tên</label>
          <input
            v-model="dangKyForm.ho_ten"
            type="text"
            class="form-control"
            required
          />
        </div>

        <!-- Phone -->
        <div class="mb-3">
          <label class="form-label">Số điện thoại</label>
          <input
            v-model="dangKyForm.so_dien_thoai"
            type="text"
            class="form-control"
            required
          />
        </div>

        <!-- Address -->
        <div class="mb-3">
          <label class="form-label">Địa chỉ</label>
          <input
            v-model="dangKyForm.dia_chi"
            type="text"
            class="form-control"
            required
          />
        </div>

        <!-- Date + Gender -->
        <div class="row">
          <div class="col-6 mb-3">
            <label class="form-label">Ngày sinh</label>
            <input v-model="dangKyForm.ngay_sinh" type="date" class="form-control" required />
          </div>

          <div class="col-6 mb-3">
            <label class="form-label">Giới tính</label>
            <select v-model="dangKyForm.gioi_tinh" class="form-control" required>
              <option value="0">Nam</option>
              <option value="1">Nữ</option>
            </select>
          </div>
        </div>

        <!-- Link to login -->
        <div class="text-center mb-3">
          Đã có tài khoản?
          <router-link to="/bac-si/login">Đăng nhập</router-link>
        </div>

        <!-- Submit -->
        <div class="d-grid">
          <button class="btn btn-primary" type="submit">
            Đăng ký
          </button>
        </div>

      </form>

    </div>
  </div>
</template>

<script>
import baseRequestBacsi from "../../../core/baseRequestBacsi";

export default {
  data() {
    return {
      dangKyForm: {
        email: "",
        password: "",
        re_password: "",
        ho_ten: "",
        so_dien_thoai: "",
        ngay_sinh: "",
        gioi_tinh: "",
        dia_chi: "",
      },
      showPassword: false,
    };
  },

  methods: {
    dangky() {
      baseRequestBacsi
        .post("bac-si/register", this.dangKyForm)
        .then((response) => {
          if (response.data.status) {
            this.$toast.success(response.data.message);
            this.$router.push("/bac-si/login");
          } else {
            this.$toast.error(response.data.message);
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
