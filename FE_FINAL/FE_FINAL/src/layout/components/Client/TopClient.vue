<template>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <div class="logo-wrapper">
                    <img src="https://files02.duytan.edu.vn/svruploads/dtu-duytan/upload/images/logoDT-70.png"
                        alt="logo icon" width="40" height="40">
                </div>
                <div class="brand-text">
                    <span class="brand-name" style="color: brown;">Clinic</span>
                    <span class="brand-subtitle" style="color: dimgray;">Healthcare Excellence</span>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1">
                    <li class="nav-item">
                        <router-link class="nav-link px-3 py-2" to="/">
                            <i class="fas fa-home"></i>
                            <span>Trang chủ</span>
                        </router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3 py-2" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-stethoscope"></i>
                            <span>Dịch vụ</span>
                        </a>
                        <ul class="dropdown-menu animate-dropdown">
                            <li>
                                <router-link class="dropdown-item" to="/chuyen-khoa">
                                    <i class="fas fa-hospital-alt"></i>Chuyên khoa
                                </router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" to="/bac-si">
                                    <i class="fas fa-user-md"></i>Đội ngũ bác sĩ
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link px-3 py-2" to="/tin-tuc">
                            <i class="fas fa-newspaper"></i>
                            <span>Tin tức</span>
                        </router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-3 py-2" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-info-circle"></i>
                            <span>Thông tin</span>
                        </a>
                        <ul class="dropdown-menu animate-dropdown">
                            <li>
                                <router-link class="dropdown-item" to="/gioi-thieu">
                                    <i class="fas fa-hospital-user"></i>Giới thiệu
                                </router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" to="/chinh-sach">
                                    <i class="fas fa-shield-alt"></i>Chính sách & Quy định
                                </router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" to="/lien-he">
                                    <i class="fas fa-envelope"></i>Liên hệ
                                </router-link>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- User Dropdown khi đã đăng nhập -->
                <div v-if="isLoggedIn" class="user-box dropdown">
                    <a class="user-dropdown-toggle d-flex align-items-center gap-2" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-avatar-wrapper">
                            <img :src="userProfile.hinh_anh || '../../../assets/images/avatars/avatar-1.png'"
                                class="user-avatar" alt="user avatar">
                            <span class="user-status"></span>
                        </div>
                        <div class="user-info d-none d-lg-block">
                            <p class="user-name mb-0">{{ userProfile.ho_ten || 'Người dùng' }}</p>
                            <small class="user-email">{{ userProfile.email || '' }}</small>
                        </div>
                        <i class="fas fa-chevron-down ms-1 d-none d-lg-block"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                        <li class="dropdown-header">
                            <div class="d-flex align-items-center gap-3">
                                <img :src="userProfile.hinh_anh || '../../../assets/images/avatars/avatar-1.png'"
                                    class="rounded-circle" width="48" height="48" alt="avatar">
                                <div>
                                    <div class="fw-semibold">{{ userProfile.ho_ten || 'Người dùng' }}</div>
                                    <small class="text-muted">{{ userProfile.email || '' }}</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <router-link to="/profile" class="dropdown-item">
                                <i class="fas fa-user-circle text-primary"></i>
                                <span>Thông tin cá nhân</span>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/lich-hen-cua-toi" class="dropdown-item">
                                <i class="fas fa-calendar-alt text-success"></i>
                                <span>Lịch hẹn của tôi</span>
                            </router-link>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item logout-item" href="javascript:;" @click="logout()">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item logout-item" href="javascript:;" @click="logoutAll()">
                                <i class="fas fa-door-open"></i>
                                <span>Đăng xuất tất cả</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Buttons khi chưa đăng nhập -->
                <div v-else class="auth-buttons d-flex gap-2">
                    <router-link to="/dang-ky">
                        <button class="btn btn-outline-custom">
                            <i class="fas fa-user-plus"></i>
                            <span>Đăng ký</span>
                        </button>
                    </router-link>
                    <router-link to="/login">
                        <button class="btn btn-custom">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Đăng nhập</span>
                        </button>
                    </router-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import baseRequestBenhNhan from '../../../core/baseRequestBenhNhan';

export default {
    data() {
        return {
            isLoggedIn: false,
            userProfile: {
                ho_ten: '',
                email: '',
                hinh_anh: ''
            }
        }
    },
    mounted() {
        this.checkLoginStatus();
    },
    methods: {
        checkLoginStatus() {
            const token = localStorage.getItem('token_benh_nhan');
            if (token) {
                this.isLoggedIn = true;
                this.loadUserProfile();
            } else {
                this.isLoggedIn = false;
            }
        },
        loadUserProfile() {
            baseRequestBenhNhan.get('benh-nhan/profile/data', {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_benh_nhan"),
                },
            })
                .then(res => {
                    if (res.data.status) {
                        this.userProfile = res.data.data;
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        },
        logout() {
            baseRequestBenhNhan.post('benh-nhan/logout', {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_benh_nhan"),
                },
            })
                .then(res => {
                    if (res.data.status) {
                        this.isLoggedIn = false;
                        localStorage.removeItem('token_benh_nhan');
                        localStorage.removeItem('ho_ten_benh_nhan');
                        this.$toast.success(res.data.message);
                        this.$router.push('/');
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        },
        logoutAll() {
            baseRequestBenhNhan.post('benh-nhan/logout-all', {
                headers: {
                    Authorization: "Bearer " + localStorage.getItem("token_benh_nhan"),
                },
            })
                .then(res => {
                    if (res.data.status) {
                        this.isLoggedIn = false;
                        localStorage.removeItem('token_benh_nhan');
                        localStorage.removeItem('ho_ten_benh_nhan');
                        this.$toast.success(res.data.message);
                        this.$router.push('/');
                    }
                })
                .catch((err) => {
                    const listErr = err.response.data.errors;
                    Object.values(listErr).forEach((error) => {
                        this.$toast.error(error[0]);
                    });
                });
        }
    },
    watch: {
        '$route'() {
            this.checkLoginStatus();
        }
    }
}
</script>

<style scoped>
:root {
    --primary-color: #A4312E;
    --primary-light: #c73e3a;
    --primary-dark: #8a2826;
    --secondary-color: #2c3e50;
    --text-dark: #2c3e50;
    --text-muted: #6c757d;
    --border-radius: 12px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.navbar {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    backdrop-filter: blur(10px);
    padding: 0.75rem 0;
}

/* Logo Styling */
.navbar-brand {
    transition: var(--transition);
}

.navbar-brand:hover {
    transform: translateY(-2px);
}

.logo-wrapper {
    position: relative;
}

.logo-wrapper img {
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(164, 49, 46, 0.2);
    transition: var(--transition);
}

.navbar-brand:hover .logo-wrapper img {
    box-shadow: 0 6px 16px rgba(164, 49, 46, 0.3);
    transform: rotate(5deg);
}

.brand-text {
    display: flex;
    flex-direction: column;
}

.brand-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    letter-spacing: -0.5px;
    line-height: 1.2;
}

.brand-subtitle {
    font-size: 0.7rem;
    color: var(--text-muted);
    font-weight: 500;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

/* Navigation Links */
.navbar-nav .nav-link {
    position: relative;
    color: var(--text-dark);
    font-weight: 500;
    border-radius: 8px;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
}

.navbar-nav .nav-link i {
    font-size: 1rem;
    transition: var(--transition);
}

.navbar-nav .nav-link span {
    position: relative;
}

.navbar-nav .nav-link::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--primary-color), var(--primary-light));
    transform: translateX(-50%);
    transition: var(--transition);
    border-radius: 2px;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.router-link-active {
    color: var(--primary-color);
    background: rgba(164, 49, 46, 0.05);
}

.navbar-nav .nav-link:hover::before,
.navbar-nav .nav-link.router-link-active::before {
    width: 60%;
}

.navbar-nav .nav-link:hover i,
.navbar-nav .nav-link.router-link-active i {
    transform: translateY(-2px);
}

/* Dropdown Menu */
.dropdown-menu {
    border: none;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
    border-radius: var(--border-radius);
    padding: 0.5rem;
    margin-top: 0.5rem;
    min-width: 220px;
}

.animate-dropdown {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 12px;
    color: var(--text-dark);
    font-weight: 500;
}

.dropdown-item i {
    width: 20px;
    font-size: 1rem;
    transition: var(--transition);
}

.dropdown-item:hover {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: white;
    transform: translateX(5px);
}

.dropdown-item:hover i {
    color: white !important;
    transform: scale(1.1);
}

.dropdown-item.router-link-active {
    background: rgba(164, 49, 46, 0.1);
    color: var(--primary-color);
}

/* User Dropdown */
.user-dropdown-toggle {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    background: rgba(164, 49, 46, 0.05);
    border: 2px solid transparent;
    transition: var(--transition);
    text-decoration: none;
}

.user-dropdown-toggle:hover {
    background: rgba(164, 49, 46, 0.1);
    border-color: var(--primary-color);
}

.user-avatar-wrapper {
    position: relative;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--primary-color);
    transition: var(--transition);
}

.user-dropdown-toggle:hover .user-avatar {
    box-shadow: 0 4px 12px rgba(164, 49, 46, 0.3);
    transform: scale(1.05);
}

.user-status {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 10px;
    height: 10px;
    background: #10b981;
    border: 2px solid white;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {

    0%,
    100% {
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
    }

    50% {
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0);
    }
}

.user-info {
    text-align: left;
}

.user-name {
    font-weight: 600;
    color: var(--text-dark);
    font-size: 0.95rem;
}

.user-email {
    color: var(--text-muted);
    font-size: 0.8rem;
}

.user-dropdown {
    min-width: 280px;
}

.dropdown-header {
    padding: 1rem;
    background: linear-gradient(135deg, rgba(164, 49, 46, 0.05), rgba(164, 49, 46, 0.1));
    border-radius: 8px;
    margin-bottom: 0.5rem;
}

.logout-item {
    color: #dc3545 !important;
}

.logout-item:hover {
    background: linear-gradient(135deg, #dc3545, #c82333) !important;
}

/* Auth Buttons */
.auth-buttons .btn {
    padding: 0.6rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: var(--transition);
    border: 2px solid;
}

.btn-outline-custom {
    color: var(--primary-color);
    border-color: var(--primary-color);
    background: transparent;
}

.btn-outline-custom:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(164, 49, 46, 0.3);
}

.btn-custom {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    color: white;
    border-color: var(--primary-color);
}

.btn-custom:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(164, 49, 46, 0.4);
}

/* Navbar Toggler */
.navbar-toggler {
    padding: 0.5rem;
    border-radius: 8px;
    transition: var(--transition);
}

.navbar-toggler:hover {
    background: rgba(164, 49, 46, 0.1);
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 3px rgba(164, 49, 46, 0.2);
}

/* Responsive */
@media (max-width: 991.98px) {
    .navbar-nav {
        padding: 1rem 0;
    }

    .navbar-nav .nav-link {
        padding: 0.75rem 1rem;
        margin: 0.25rem 0;
    }

    .auth-buttons {
        padding: 1rem 0;
        flex-direction: column;
        width: 100%;
    }

    .auth-buttons .btn {
        width: 100%;
        justify-content: center;
    }

    .user-dropdown-toggle {
        justify-content: space-between;
        width: 100%;
    }

    .brand-subtitle {
        display: none;
    }
}

@media (max-width: 575.98px) {
    .brand-name {
        font-size: 1.25rem;
    }

    .logo-wrapper img {
        width: 36px;
        height: 36px;
    }
}
</style>