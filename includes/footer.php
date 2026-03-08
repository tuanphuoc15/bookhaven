<?php
if (!isset($basePath)) {
    $basePath = "";
}
?>
<footer class="bh-footer mt-5">
<div class="container">
<div class="row g-4 bh-footer-top">
<div class="col-lg-4 col-md-6">
<h4 class="bh-footer-brand">BookHaven</h4>
<p class="bh-footer-desc">Nhà sách online với nhiều đầu sách chất lượng về phát triển bản thân, kinh doanh và khoa học.</p>
<div class="bh-footer-contact">
<p><i class="fa-solid fa-location-dot"></i> TP Hồ Chí Minh, Việt Nam</p>
<p><i class="fa-solid fa-envelope"></i> support@bookhaven.vn</p>
<p><i class="fa-solid fa-phone"></i> 1900 1234</p>
</div>
</div>

<div class="col-lg-2 col-md-6">
<h6 class="bh-footer-title">Liên kết nhanh</h6>
<ul class="bh-footer-links">
<li><a href="<?php echo e($basePath); ?>index.php">Trang chủ</a></li>
<li><a href="<?php echo e($basePath); ?>shop.php">Cửa hàng</a></li>
<li><a href="<?php echo e($basePath); ?>cart/cart.php">Giỏ hàng</a></li>
<li><a href="<?php echo e($basePath); ?>my-orders.php">Đơn hàng</a></li>
</ul>
</div>

<div class="col-lg-3 col-md-6">
<h6 class="bh-footer-title">Hỗ trợ khách hàng</h6>
<ul class="bh-footer-links">
<li><a href="#">Hướng dẫn mua hàng</a></li>
<li><a href="#">Chính sách đổi trả</a></li>
<li><a href="#">Điều khoản sử dụng</a></li>
<li><a href="#">Chính sách bảo mật</a></li>
</ul>
<div class="bh-working-time">
<p class="mb-1"><strong>Giờ hỗ trợ:</strong></p>
<p class="mb-0">08:00 - 22:00 (T2 - CN)</p>
</div>
</div>

<div class="col-lg-3 col-md-6">
<h6 class="bh-footer-title">Kết nối và thanh toán</h6>
<div class="bh-social mb-3">
<a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
<a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
<a href="#" aria-label="Youtube"><i class="fab fa-youtube"></i></a>
<a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
</div>
<div class="bh-payment">
<img src="<?php echo e($basePath); ?>assets/images/payments/visa.png" alt="Visa">
<img src="<?php echo e($basePath); ?>assets/images/payments/mastercard.png" alt="Mastercard">
<img src="<?php echo e($basePath); ?>assets/images/payments/momo.png" alt="MoMo">
<img src="<?php echo e($basePath); ?>assets/images/payments/vnpay.png" alt="VNPay">
</div>
</div>
</div>

<hr class="bh-footer-divider">

<div class="bh-footer-bottom">
<p class="mb-0">&copy; 2026 BookHaven. Bản quyền thuộc BookHaven.</p>
<p class="mb-0">Bản demo báo cáo môn Lập trình Web</p>
</div>
</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
  const revealEls = document.querySelectorAll('.reveal-on-scroll');
  if (!revealEls.length) return;

  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  revealEls.forEach((el) => io.observe(el));
})();
</script>
</body>
</html>