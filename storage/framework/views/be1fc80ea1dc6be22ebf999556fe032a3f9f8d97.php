<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
              <span class="app-brand-logo demo">
               <?php echo $__env->make('layouts.components.logo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="<?php echo e(route('home')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Anasayfa</div>
            </a>
        </li>

        <!-- Layouts -->


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Stok İşlemleri</span>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('stockcard.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Stok Kartları</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('invoice.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Faturalar</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('sale.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Satış</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('transfer.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Sevk <b style="color: #f00">(<?php echo e(sevkcount()); ?>)</b></div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Raporlar</div>
            </a>
        </li>
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Muhasebe İşlemleri</span></li>
        <li class="menu-item">
            <a href="<?php echo e(route('safe.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Kasa</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('bank.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Banka</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('customer.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Müşteriler</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('brand.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Markalar</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('category.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Kategoriler</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('color.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Renkler</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('accounting_category.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Muhasebe Kategorileri</div>
            </a>
        </li>
        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Teknik Servis İşlemleri</span></li>
        <li class="menu-item">
            <a href="<?php echo e(route('technical_service.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Teknik Servis</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Raporlar</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Kullanıcı İşlemleri</span></li>
        <li class="menu-item">
            <a href="<?php echo e(route('user.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Kullanıcılar</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Log</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('role.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Roller</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Yetkiler</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Ayarlar</span></li>
        <li class="menu-item">
            <a href="<?php echo e(route('company.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Firmalar</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('seller.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Şubeler</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('warehouse.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Depolar</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('reason.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Nedenler</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo e(route('fakeproduct.index')); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Fake Ürünler</div>
            </a>
        </li>
    </ul>
</aside>
<?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/layouts/components/aside.blade.php ENDPATH**/ ?>