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
<p class="bh-footer-desc">Nha sach online voi nhieu dau sach chat luong ve phat trien ban than, kinh doanh va khoa hoc.</p>
<div class="bh-footer-contact">
<p><i class="fa-solid fa-location-dot"></i> TP Ho Chi Minh, Viet Nam</p>
<p><i class="fa-solid fa-envelope"></i> support@bookhaven.vn</p>
<p><i class="fa-solid fa-phone"></i> 1900 1234</p>
</div>
</div>

<div class="col-lg-2 col-md-6">
<h6 class="bh-footer-title">Lien ket nhanh</h6>
<ul class="bh-footer-links">
<li><a href="<?php echo e($basePath); ?>index.php">Trang chu</a></li>
<li><a href="<?php echo e($basePath); ?>shop.php">Cua hang</a></li>
<li><a href="<?php echo e($basePath); ?>cart/cart.php">Gio hang</a></li>
<li><a href="<?php echo e($basePath); ?>my-orders.php">Don hang</a></li>
</ul>
</div>

<div class="col-lg-3 col-md-6">
<h6 class="bh-footer-title">Ho tro khach hang</h6>
<ul class="bh-footer-links">
<li><a href="#">Huong dan mua hang</a></li>
<li><a href="#">Chinh sach doi tra</a></li>
<li><a href="#">Dieu khoan su dung</a></li>
<li><a href="#">Chinh sach bao mat</a></li>
</ul>
<div class="bh-working-time">
<p class="mb-1"><strong>Gio ho tro:</strong></p>
<p class="mb-0">08:00 - 22:00 (T2 - CN)</p>
</div>
</div>

<div class="col-lg-3 col-md-6">
<h6 class="bh-footer-title">Ket noi va thanh toan</h6>
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
<p class="mb-0">&copy; 2026 BookHaven. All rights reserved.</p>
<p class="mb-0">Made for LTW report demo</p>
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
