<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kích hoạt tài khoản bác sĩ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2c5aa0 0%, #1e3a8a 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        .header .subtitle {
            margin: 10px 0 0 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
            line-height: 1.8;
        }
        .success-box {
            background-color: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .success-box .icon {
            font-size: 48px;
            color: #0c5460;
            margin-bottom: 15px;
        }
        .success-box h3 {
            color: #0c5460;
            margin: 0 0 10px 0;
            font-size: 20px;
        }
        .success-box p {
            color: #0c5460;
            margin: 0;
            font-size: 16px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #2c5aa0 0%, #1e3a8a 100%);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(44, 90, 160, 0.4);
        }
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 90, 160, 0.6);
        }
        .info-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .info-section h4 {
            color: #495057;
            margin: 0 0 15px 0;
            font-size: 16px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #6c757d;
        }
        .info-value {
            color: #495057;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
            color: #6c757d;
            font-size: 14px;
        }
        .footer .contact-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
        .footer .contact-info a {
            color: #2c5aa0;
            text-decoration: none;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }
        .warning .icon {
            font-size: 20px;
            margin-right: 10px;
        }
        .features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 20px 0;
        }
        .feature-item {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border-left: 4px solid #2c5aa0;
        }
        .feature-item .icon {
            font-size: 24px;
            margin-bottom: 10px;
            display: block;
        }
        .feature-item h5 {
            margin: 0 0 5px 0;
            color: #2c5aa0;
            font-size: 14px;
        }
        .feature-item p {
            margin: 0;
            font-size: 12px;
            color: #6c757d;
        }
        @media (max-width: 600px) {
            .container {
                margin: 0;
                border-radius: 0;
            }
            .content {
                padding: 20px;
            }
            .header {
                padding: 20px;
            }
            .header h1 {
                font-size: 24px;
            }
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>👨‍⚕️ Hệ thống Quản lý Phòng khám</h1>
            <p class="subtitle">Kích hoạt tài khoản bác sĩ</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Xin chào Bác sĩ <strong>{{ $data['ho_ten'] }}</strong>! 👋
            </div>

            <div class="success-box">
                <div class="icon">✅</div>
                <h3>Đăng ký thành công!</h3>
                <p>Tài khoản bác sĩ của bạn đã được tạo thành công trong hệ thống</p>
            </div>

            <div class="message">
                <p>Chào mừng bạn đến với đội ngũ y bác sĩ của chúng tôi! Cảm ơn bạn đã tin tưởng và gia nhập hệ thống quản lý phòng khám. Để hoàn tất quá trình đăng ký và bắt đầu sử dụng các tính năng dành cho bác sĩ, vui lòng kích hoạt tài khoản bằng cách nhấn vào nút bên dưới.</p>
            </div>

            <div style="text-align: center;">
                <a href="{{ $data['link'] }}" class="cta-button">
                    🔗 Kích hoạt tài khoản ngay
                </a>
            </div>

            <div class="info-section">
                <h4>📋 Thông tin tài khoản bác sĩ</h4>
                <div class="info-item">
                    <span class="info-label">Họ và tên:</span>
                    <span class="info-value">BS. {{ $data['ho_ten'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Chuyên khoa:</span>
                    <span class="info-value">{{ $data['chuyen_khoa'] ?? 'Đang cập nhật' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Trạng thái:</span>
                    <span class="info-value">Chờ kích hoạt</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Ngày đăng ký:</span>
                    <span class="info-value">{{ date('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-item">
                    <span class="icon">📅</span>
                    <h5>Quản lý lịch làm việc</h5>
                    <p>Thiết lập và quản lý lịch khám bệnh</p>
                </div>
                <div class="feature-item">
                    <span class="icon">👥</span>
                    <h5>Quản lý bệnh nhân</h5>
                    <p>Xem thông tin và lịch sử bệnh nhân</p>
                </div>
                <div class="feature-item">
                    <span class="icon">📊</span>
                    <h5>Báo cáo thống kê</h5>
                    <p>Theo dõi hiệu suất và báo cáo</p>
                </div>
                <div class="feature-item">
                    <span class="icon">🔔</span>
                    <h5>Thông báo</h5>
                    <p>Nhận thông báo về lịch hẹn mới</p>
                </div>
            </div>

            <div class="warning">
                <span class="icon">⚠️</span>
                <strong>Lưu ý quan trọng:</strong> Link kích hoạt sẽ hết hạn sau 24 giờ. Nếu bạn không kích hoạt trong thời gian này, vui lòng liên hệ với quản trị viên để được hỗ trợ.
            </div>

            <div class="message">
                <p>Sau khi kích hoạt tài khoản, bạn có thể:</p>
                <ul style="color: #555; margin: 15px 0;">
                    <li>Thiết lập lịch làm việc và thời gian khám bệnh</li>
                    <li>Xem danh sách bệnh nhân đã đặt lịch</li>
                    <li>Quản lý hồ sơ bệnh án và ghi chú khám bệnh</li>
                    <li>Xem báo cáo thống kê và hiệu suất làm việc</li>
                    <li>Nhận thông báo về lịch hẹn mới và thay đổi</li>
                    <li>Cập nhật thông tin cá nhân và chuyên môn</li>
                </ul>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Hệ thống Quản lý Phòng khám</strong></p>
            <p>Chúng tôi cam kết hỗ trợ bác sĩ trong việc cung cấp dịch vụ y tế chất lượng cao</p>

            <div class="contact-info">
                <p>📞 Hotline: 1900-xxxx | 📧 Email: thuthaor120608@gmail.com</p>
                <p>🌐 Website: <a href="#">www.thuthaor120608.com</a></p>
                <p>📍 Địa chỉ: 01 Hoàng Minh Thảo,Hoà Khánh Nam,Liên Chiểu, Đà Nẵng</p>
            </div>

            <p style="margin-top: 20px; font-size: 12px; color: #adb5bd;">
                Email này được gửi tự động, vui lòng không trả lời trực tiếp.
            </p>
        </div>
    </div>
</body>
</html>
