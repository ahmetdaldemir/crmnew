<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Stok Kart /</span> <?php if(isset($stockcards)): ?>
                <?php echo e($stockcards->name); ?>

            <?php endif; ?></h4>
        <form action="<?php echo e(route('stockcard.store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" <?php if(isset($stockcards)): ?> value="<?php echo e($stockcards->id); ?>" <?php endif; ?> />
            <div class="card">
                <h5 class="card-header">Stok Kart Bilgileri</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-md-8 col-sm-9 col-12 fv-plugins-icon-container">
                            <label for="defaultFormControlInput" class="form-label">Stok Adı</label>
                            <input type="text" class="form-control" id="name" <?php if(isset($stockcards)): ?> value="<?php echo e($stockcards->name); ?>" <?php endif; ?>  name="name" aria-describedby="name">
                            <div id="name" class="form-text">
                                <select name="fakeproduct" class="form-select select2">
                                    <option value="">Seçiniz</option>
                                    <?php $__currentLoopData = $fakeproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fakeproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($fakeproduct->name); ?>"><?php echo e($fakeproduct->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-5 col-12 fv-plugins-icon-container">
                            <label for="defaultFormControlInput" class="form-label">Barkod</label>
                            <input type="text" class="form-control" id="barcode"
                                   <?php if(isset($stockcards)): ?> value="<?php echo e($stockcards->barcode); ?>" <?php endif; ?>  name="barcode"
                                   aria-describedby="barcode">
                            <div id="barcode" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-5 col-12 fv-plugins-icon-container">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku"
                                   <?php if(isset($stockcards)): ?> value="<?php echo e($stockcards->sku); ?>" <?php endif; ?>  name="sku"
                                   aria-describedby="sku">
                            <div id="sku" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-3 col-sm-6 col-12 fv-plugins-icon-container">
                            <label for="defaultFormControlInput" class="form-label">Stok Takibi</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="tracking" id="flexSwitchCheckChecked"/>
                            </div>
                            <div id="name" class="form-text">
                                We'll never share your details with anyone else.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4  mb-4">
                <h5 class="card-header">Stok Ayarları</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Stok Takip Miktarı</label>
                                <input type="text" class="form-control" id="tracking_quantity"
                                       <?php if(isset($stockcards)): ?> value="<?php echo e($stockcards->tracking_quantity); ?>"
                                       <?php endif; ?>  name="tracking_quantity"
                                       aria-describedby="tracking_quantity">
                                <div id="tracking_quantity" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>

                            <div>
                                <label for="defaultFormControlInput" class="form-label">Kategori</label>
                                <select name="category_id" class="form-control">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if(isset($stockcards)): ?>
                                                    <?php echo e($stockcards->hasCategory($category->id) ? 'selected' : ''); ?>

                                                <?php endif; ?>  value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div id="category_id" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="brand_id" class="form-label">Marka</label>
                                <select name="brand_id" id="brand_id" onchange="getVersion(this.value)" class="form-control" required>
                                    <option value="">Seçiniz</option>
                                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option  <?php if(isset($stockcards) and ($brand->id == $stockcards->brand_id)): ?>  selected  <?php endif; ?> value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div id="brand_id" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Model</label>
                                <select name="version_id[]"  <?php if(isset($stockcards)): ?> <?php if(!is_null($stockcards->version_id)): ?> data-version="<?php echo e(implode(",",$stockcards->version_id)); ?>" <?php endif; ?>  <?php endif; ?> id="version_id"  class="form-control select2" required multiple></select>
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Birim</label>
                                <select name="unit_id" class="form-control">
                                    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if(isset($stockcards)): ?>
                                                    <?php echo e($stockcards->hasSeller($key) ? 'selected' : ''); ?>

                                                <?php endif; ?>  value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div id="unit_id" class="form-text">
                                    We'll never share your details with anyone else.
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">

                    </div>
                    <hr class="my-5">
                    <div>
                        <button type="submit" class="btn btn-danger btn-buy-now">Kaydet</button>
                    </div>
                </div>
            </div>
        </form>
        <hr class="my-5">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
<script>
    "use strict";!function(){var e=document.querySelectorAll(".invoice-item-price"),t=document.querySelectorAll(".invoice-item-qty"),n=document.querySelectorAll(".date-picker");e&&e.forEach(function(e){new Cleave(e,{delimiter:"",numeral:!0})}),t&&t.forEach(function(e){new Cleave(e,{delimiter:"",numeral:!0})}),n&&n.forEach(function(e){e.flatpickr({monthSelectorType:"static"})})}(),$(function(){var n,o,a,i,l,r,e=$(".btn-apply-changes"),t=$(".source-item"),c={"App Design":"Designed UI kit & app pages.","App Customization":"Customization & Bug Fixes.","ABC Template":"Bootstrap 4 admin template.","App Development":"Native App Development."};function p(e,t){e.closest(".repeater-wrapper").find(t).text(e.val())}$(document).on("click",".tax-select",function(e){e.stopPropagation()}),e.length&&$(document).on("click",".btn-apply-changes",function(e){var t=$(this);l=t.closest(".dropdown-menu").find("#taxInput1"),r=t.closest(".dropdown-menu").find("#taxInput2"),i=t.closest(".dropdown-menu").find("#discountInput"),o=t.closest(".repeater-wrapper").find(".tax-1"),a=t.closest(".repeater-wrapper").find(".tax-2"),n=$(".discount"),null!==l.val()&&p(l,o),null!==r.val()&&p(r,a),i.val().length&&t.closest(".repeater-wrapper").find(n).text(i.val()+"%")}),t.length&&(t.on("submit",function(e){e.preventDefault()}),t.repeater({show:function(){$(this).slideDown(),[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function(e){return new bootstrap.Tooltip(e)})},hide:function(e){$(this).slideUp()}})),$(document).on("change",".item-details",function(){var e=$(this),t=c[e.val()];e.next("textarea").length?e.next("textarea").val(t):e.after('<textarea class="form-control" rows="2">'+t+"</textarea>")})});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/stockcard/form.blade.php ENDPATH**/ ?>