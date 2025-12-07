<template>
  <div class="container-fluid py-5"
    style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh;">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-11">
        <!-- Header -->
        <div class="text-center mb-5">
          <h2 class="fw-bold text-primary mb-3">
            <i class="fas fa-search-plus me-2"></i>
            Tra Cứu Phiếu Đặt Lịch Khám
          </h2>
          <p class="text-muted lead">Nhập mã đặt lịch để tra cứu thông tin chi tiết</p>
        </div>

        <div class="row g-4">
          <!-- Khung tìm kiếm -->
          <div class="col-lg-5">
            <div class="card border-0 shadow-lg h-100" style="border-radius: 20px;">
              <div class="card-body p-4">
                <div class="text-center mb-4">
                  <div
                    class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                    style="width: 80px; height: 80px;">
                    <i class="fas fa-search text-primary fs-1"></i>
                  </div>
                  <h4 class="card-title text-primary fw-bold mb-2">Tìm Kiếm Phiếu</h4>
                  <p class="text-muted small">Nhập mã đặt lịch để tra cứu</p>
                </div>

                <div class="mb-4">
                  <label class="form-label fw-semibold text-dark">
                    <i class="fas fa-barcode me-2"></i>Mã đặt lịch
                  </label>
                  <div class="input-group input-group-lg">
                    <span class="input-group-text bg-light border-0">
                      <i class="fas fa-hashtag text-primary"></i>
                    </span>
                    <input type="text" class="form-control border-0 shadow-sm" v-model="search.ma_dat_lich"
                      placeholder="Ví dụ: DL001234" style="border-radius: 0 15px 15px 0 !important;"
                      @keyup.enter="timKiem" />
                  </div>
                </div>

                <button class="btn btn-primary btn-lg w-100 py-3 shadow-sm" @click="timKiem" :disabled="loading"
                  style="border-radius: 15px; font-weight: 600;">
                  <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                  <i v-else class="fas fa-search me-2"></i>
                  {{ loading ? 'Đang tìm kiếm...' : 'Tìm Kiếm Ngay' }}
                </button>
              </div>
            </div>
          </div>

          <!-- Kết quả -->
          <div class="col-lg-7">
            <!-- Không tìm thấy -->
            <div v-if="status === 0" class="card border-0 shadow-lg" style="border-radius: 20px;">
              <div class="card-body text-center py-5">
                <div class="mb-4">
                  <i class="fas fa-search-minus text-danger" style="font-size: 4rem; opacity: 0.7;"></i>
                </div>
                <h4 class="text-danger fw-bold mb-3">Không Tìm Thấy Kết Quả</h4>
                <p class="text-muted mb-4">Vui lòng kiểm tra lại mã đặt lịch và thử lại</p>
                <div class="alert alert-light border-0 d-inline-block">
                  <i class="fas fa-info-circle me-2"></i>
                  Đảm bảo mã đặt lịch được nhập chính xác
                </div>
              </div>
            </div>

            <!-- Thông tin phiếu -->
            <div v-if="status === 1" class="card border-0 shadow-lg" style="border-radius: 20px;">
              <!-- Header Card -->
              <div class="card-header border-0 text-white position-relative overflow-hidden"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px 20px 0 0 !important; padding: 2rem;">
                <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
                  <i class="fas fa-calendar-check" style="font-size: 8rem; transform: rotate(-15deg);"></i>
                </div>
                <div class="row align-items-center position-relative">
                  <div class="col">
                    <h3 class="mb-2 fw-bold">
                      <i class="fas fa-file-medical me-2"></i>
                      Thông Tin Phiếu Đặt Lịch
                    </h3>
                    <p class="mb-0 opacity-90">Mã: {{ phieu.ma_dat_lich }}</p>
                  </div>
                  <div class="col-auto">
                    <span class="badge fs-6 px-3 py-2"
                      :class="phieu.is_thanh_toan === 1 ? 'bg-success' : 'bg-warning text-dark'"
                      style="border-radius: 25px;">
                      <i :class="phieu.is_thanh_toan === 1 ? 'fas fa-check-circle' : 'fas fa-clock'" class="me-1"></i>
                      {{ phieu.is_thanh_toan === 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                    </span>
                  </div>
                </div>
              </div>

              <div class="card-body p-4">
                <div class="row g-4">
                  <!-- Cột trái -->
                  <div class="col-md-6">
                    <div class="bg-light rounded-4 p-4 h-100">
                      <h5 class="text-primary fw-bold mb-4">
                        <i class="fas fa-info-circle me-2"></i>Thông Tin Cơ Bản
                      </h5>

                      <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                          <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-hashtag text-primary"></i>
                          </div>
                          <div>
                            <small class="text-muted fw-semibold">Mã đặt lịch</small>
                            <div class="fw-bold fs-6">{{ phieu.ma_dat_lich }}</div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                          <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-clock text-info"></i>
                          </div>
                          <div>
                            <small class="text-muted fw-semibold">Thời gian khám</small>
                            <div class="fw-bold fs-6">
                              {{ phieu.thoi_gian_bat_dau }} - {{ phieu.thoi_gian_ket_thuc }}
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                          <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-stethoscope text-success"></i>
                          </div>
                          <div>
                            <small class="text-muted fw-semibold">Chuyên khoa</small>
                            <div class="fw-bold fs-6">{{ phieu.ten_chuyen_khoa || 'Chưa xác định' }}</div>
                          </div>
                        </div>
                      </div>

                      <div>
                        <div class="d-flex align-items-center mb-2">
                          <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-door-open text-warning"></i>
                          </div>
                          <div>
                            <small class="text-muted fw-semibold">Phòng khám</small>
                            <div class="fw-bold fs-6">{{ phieu.ten_phong_kham || 'Chưa phân phòng' }}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Cột phải -->
                  <div class="col-md-6">
                    <div class="bg-light rounded-4 p-4 h-100">
                      <h5 class="text-primary fw-bold mb-4">
                        <i class="fas fa-users me-2"></i>Thông Tin Liên Quan
                      </h5>

                      <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                          <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-user text-primary"></i>
                          </div>
                          <div>
                            <small class="text-muted fw-semibold">Bệnh nhân</small>
                            <div class="fw-bold fs-6 text-primary">{{ phieu.ten_benh_nhan }}</div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                          <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-user-md text-success"></i>
                          </div>
                          <div>
                            <small class="text-muted fw-semibold">Bác sĩ phụ trách</small>
                            <div class="fw-bold fs-6 text-success">{{ phieu.ten_bac_si }}</div>
                          </div>
                        </div>
                      </div>

                      <div class="mb-4">
                        <div class="d-flex align-items-start mb-2">
                          <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-notes-medical text-info"></i>
                          </div>
                          <div class="flex-grow-1">
                            <small class="text-muted fw-semibold">Lý do khám</small>
                            <div class="fw-bold fs-6">
                              {{ phieu.ly_do_kham || 'Không có ghi chú đặc biệt' }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Footer actions -->
                <div class="row mt-4">
                  <div class="col-12">
                    <div class="bg-primary bg-opacity-5 rounded-4 p-3 text-center">
                      <small class="text-muted">
                        <i class="fas fa-shield-alt me-1"></i>
                        Thông tin được bảo mật và chỉ dùng cho mục đích tra cứu
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Loading -->
            <div v-if="loading && status === null" class="card border-0 shadow-lg" style="border-radius: 20px;">
              <div class="card-body text-center py-5">
                <div class="spinner-border text-primary mb-4" style="width: 4rem; height: 4rem;"></div>
                <h4 class="fw-bold text-primary mb-2">Đang Tìm Kiếm...</h4>
                <p class="text-muted">Vui lòng chờ trong giây lát</p>
                <div class="progress mx-auto" style="width: 200px; height: 6px;">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: 100%">
                  </div>
                </div>
              </div>
            </div>

            <!-- Placeholder khi chưa tìm kiếm -->
            <div v-if="status === null && !loading" class="card border-0 shadow-lg" style="border-radius: 20px;">
              <div class="card-body text-center py-5">
                <div class="mb-4">
                  <i class="fas fa-calendar-alt text-primary" style="font-size: 4rem; opacity: 0.3;"></i>
                </div>
                <h4 class="text-muted fw-bold mb-3">Sẵn Sàng Tra Cứu</h4>
                <p class="text-muted mb-0">Nhập mã đặt lịch bên trái để bắt đầu tìm kiếm</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import baseRequestAdmin from "../../../core/baseRequestAdmin";

export default {
  data() {
    return {
      search: { ma_dat_lich: "" },
      status: null,
      phieu: {},
      loading: false,
    };
  },
  methods: {
    timKiem() {
      if (!this.search.ma_dat_lich.trim()) {
        this.$toast && this.$toast.error("Vui lòng nhập mã đặt lịch");
        return;
      }
      this.loading = true;
      this.status = null;
      baseRequestAdmin
        .post("admin/kiem-tra-phieu-dat-lich", this.search)
        .then((res) => {
          if (res.data.status) {
            this.phieu = res.data.data;
            this.status = 1;
            this.search.ma_dat_lich = "";
            this.$toast && this.$toast.success(res.data.message);
          } else {
            this.status = 0;
            this.$toast && this.$toast.error(res.data.message);
          }
        })
        .catch((err) => {
          this.status = 0;
          try {
            const list = Object.values(err.response.data.errors);
            list.forEach((v) => this.$toast && this.$toast.error(v[0]));
          } catch (e) {
            this.$toast && this.$toast.error(err.response.data.message);
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>

<style scoped>
.card {
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
}

.btn {
  transition: all 0.3s ease;
}

.btn:hover {
  transform: translateY(-2px);
}

.form-control:focus {
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
  border-color: #86b7fe;
}

.progress-bar {
  animation: progress-animation 2s infinite;
}

@keyframes progress-animation {
  0% {
    width: 0%;
  }

  50% {
    width: 100%;
  }

  100% {
    width: 0%;
  }
}
</style>