<template>
  <div class="main-container">
    <div class="container py-5">
      <div class="row justify-content-center">
        <!-- Header -->
        <div class="col-12 text-center mb-5">
          <h2 class="page-title">
            <i class="fas fa-search me-2"></i>
            Tra cứu phiếu đặt lịch
          </h2>
          <p class="page-subtitle">Nhập mã đặt lịch để xem thông tin chi tiết</p>
        </div>

        <div class="col-lg-10">
          <div class="row g-4">
            <!-- Form tìm kiếm -->
            <div class="col-lg-4">
              <div class="search-card">
                <div class="search-header">
                  <i class="fas fa-search"></i>
                  <h5>Tìm kiếm</h5>
                </div>
                <div class="search-body">
                  <div class="form-group">
                    <label>Mã đặt lịch</label>
                    <input type="text" class="form-control" v-model="search.ma_dat_lich"
                      placeholder="Nhập mã đặt lịch..." @keyup.enter="timKiem" />
                  </div>
                  <button class="btn-search" @click="timKiem" :disabled="loading">
                    <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                    <i v-else class="fas fa-search me-2"></i>
                    {{ loading ? 'Đang tìm...' : 'Tìm kiếm' }}
                  </button>
                </div>
              </div>
            </div>

            <!-- Kết quả -->
            <div class="col-lg-8">
              <!-- Không tìm thấy -->
              <div v-if="status === 0" class="result-card error">
                <div class="result-icon">
                  <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h5>Không tìm thấy kết quả</h5>
                <p>Vui lòng kiểm tra lại mã đặt lịch</p>
              </div>

              <!-- Thông tin phiếu -->
              <div v-if="status === 1" class="result-card success">
                <div class="card-header">
                  <div class="header-info">
                    <h4>
                      <i class="fas fa-file-medical me-2"></i>
                      Phiếu đặt lịch
                    </h4>
                    <span class="code ">{{ phieu.ma_dat_lich }}</span>
                  </div>
                  <span class="payment-status" :class="phieu.is_thanh_toan === 1 ? 'paid' : 'unpaid'">
                    <i :class="phieu.is_thanh_toan === 1 ? 'fas fa-check-circle' : 'fas fa-clock'" class="me-1"></i>
                    {{ phieu.is_thanh_toan === 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                  </span>
                </div>

                <div class="card-body">
                  <div class="row g-4">
                    <div class="col-md-6">
                      <div class="info-section">
                        <h6><i class="fas fa-info-circle me-2"></i>Thông tin lịch hẹn</h6>
                        <div class="info-list">
                          <div class="info-item">
                            <span class="label">Thời gian:</span>
                            <span class="value">{{ phieu.thoi_gian_bat_dau }} - {{ phieu.thoi_gian_ket_thuc }}</span>
                          </div>
                          <div class="info-item">
                            <span class="label">Chuyên khoa:</span>
                            <span class="value">{{ phieu.ten_chuyen_khoa || 'Chưa xác định' }}</span>
                          </div>
                          <div class="info-item">
                            <span class="label">Phòng khám:</span>
                            <span class="value">{{ phieu.ten_phong_kham || 'Chưa phân phòng' }}</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="info-section">
                        <h6><i class="fas fa-users me-2"></i>Thông tin người liên quan</h6>
                        <div class="info-list">
                          <div class="info-item">
                            <span class="label">Bệnh nhân:</span>
                            <span class="value highlight">{{ phieu.ten_benh_nhan }}</span>
                          </div>
                          <div class="info-item">
                            <span class="label">Bác sĩ:</span>
                            <span class="value highlight">{{ phieu.ten_bac_si }}</span>
                          </div>
                          <div class="info-item">
                            <span class="label">Lý do khám:</span>
                            <span class="value">{{ phieu.ly_do_kham || 'Không có ghi chú' }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Loading -->
              <div v-if="loading && status === null" class="result-card loading">
                <div class="loading-spinner">
                  <div class="spinner-border"></div>
                </div>
                <h5>Đang tìm kiếm...</h5>
                <p>Vui lòng chờ trong giây lát</p>
              </div>

              <!-- Trạng thái ban đầu -->
              <div v-if="status === null && !loading" class="result-card empty">
                <div class="result-icon">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <h5>Sẵn sàng tra cứu</h5>
                <p>Nhập mã đặt lịch để bắt đầu tìm kiếm</p>
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
.main-container {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  min-height: 100vh;
}

.page-title {
  color: white;
  font-weight: 600;
  font-size: 2.2rem;
  margin-bottom: 0.5rem;
}

.page-subtitle {
  color: rgba(255, 255, 255, 0.8);
  font-size: 1.1rem;
  margin: 0;
}

/* Search Card */
.search-card {
  background: white;
  border-radius: 16px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.search-header {
  background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
  color: white;
  padding: 1.5rem;
  text-align: center;
}

.search-header i {
  font-size: 2rem;
  margin-bottom: 0.5rem;
  display: block;
}

.search-header h5 {
  margin: 0;
  font-weight: 600;
}

.search-body {
  padding: 2rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  font-weight: 600;
  color: #333;
  margin-bottom: 0.5rem;
  display: block;
}

.form-control {
  border: 2px solid #e1e5e9;
  border-radius: 12px;
  padding: 12px 16px;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.form-control:focus {
  border-color: #4facfe;
  box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
  outline: none;
}

.btn-search {
  background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
  color: white;
  border: none;
  border-radius: 12px;
  padding: 12px 24px;
  font-weight: 600;
  width: 100%;
  transition: all 0.3s ease;
  cursor: pointer;
}

.btn-search:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
}

.btn-search:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

/* Result Cards */
.result-card {
  background: white;
  border-radius: 16px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  min-height: 200px;
}

.result-card.empty,
.result-card.error,
.result-card.loading {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 3rem 2rem;
  text-align: center;
}

.result-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
  opacity: 0.6;
}

.result-card.empty .result-icon {
  color: #6c757d;
}

.result-card.error .result-icon {
  color: #dc3545;
}

.loading-spinner {
  margin-bottom: 1rem;
}

.loading-spinner .spinner-border {
  width: 3rem;
  height: 3rem;
  color: #4facfe;
}

/* Success Card */
.result-card.success .card-header {
  background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
  color: white;
  padding: 1.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header-info h4 {
  margin: 0 0 0.25rem 0;
  font-weight: 600;
}

.code {
  font-family: 'Courier New', monospace;
  font-size: 0.9rem;
  opacity: 0.9;
}

.payment-status {
  padding: 8px 16px;
  border-radius: 20px;
  font-size: 0.85rem;
  font-weight: 600;
}

.payment-status.paid {
  background: rgba(255, 255, 255, 0.2);
  color: white;
}

.payment-status.unpaid {
  background: #ffc107;
  color: #212529;
}

.card-body {
  padding: 2rem;
}

.info-section {
  height: 100%;
}

.info-section h6 {
  color: #333;
  font-weight: 600;
  margin-bottom: 1rem;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #f8f9fa;
}

.info-list {
  space-y: 1rem;
}

.info-item {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 1rem;
  padding: 0.75rem 0;
}

.info-item .label {
  color: #6c757d;
  font-weight: 500;
  min-width: 100px;
  flex-shrink: 0;
}

.info-item .value {
  color: #333;
  font-weight: 600;
  text-align: right;
  flex: 1;
}

.info-item .value.highlight {
  color: #4facfe;
}

/* Responsive */
@media (max-width: 768px) {
  .page-title {
    font-size: 1.8rem;
  }

  .search-body {
    padding: 1.5rem;
  }

  .card-body {
    padding: 1.5rem;
  }

  .info-item {
    flex-direction: column;
    align-items: flex-start;
  }

  .info-item .value {
    text-align: left;
    margin-top: 0.25rem;
  }
}
</style>