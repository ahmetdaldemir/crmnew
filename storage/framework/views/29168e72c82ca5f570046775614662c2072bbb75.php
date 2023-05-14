<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Stok Kartları /</span> Stok Kart Hareketleri</h4>

        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Hareket Formu</h5>
                <div class="card-body">
                    <form method="post" id="stockmovementform" class="form-repeater" action="javascript();">
                        <input name="stock_card_id" value="<?php echo e($stock_card_id); ?>" type="hidden">
                        <div data-repeater-list="group_a">
                            <div style="    border: 1px solid #ccc;padding: 10px;margin-top: 5px" data-repeater-item="">
                                <div class="row">
                                    <div class="mb-3 col-lg-3 col-xl-1 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-1">Müşteri</label>
                                        <select name="type" id="form-repeater-1-1" class="form-select">
                                            <option value="2">Giriş</option>
                                            <option value="1">Çıkış</option>
                                            <option value="0">Sevk</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-3 col-xl-1 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-1">Tip</label>
                                        <select name="type" id="form-repeater-1-1" class="form-select">
                                            <option value="2">Giriş</option>
                                            <option value="1">Çıkış</option>
                                            <option value="0">Sevk</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Seri No</label>
                                        <input name="serial" type="text" id="form-repeater-1-4" class="form-control" placeholder="············">
                                    </div>
                                    <div class="mb-3 col-lg-3 col-xl-1 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-2">Adet</label>
                                        <input type="number" name="quantity" id="form-repeater-1-2" class="form-control" value="1" min="1">
                                    </div>
                                    <div class="mb-3 col-lg-3 col-xl-1 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-3">KDV</label>
                                        <select name="tax" id="form-repeater-1-3" class="form-select">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="8">8</option>
                                            <option value="18">18</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Maliyet</label>
                                        <input name="cost_price" type="text" id="form-repeater-1-4" class="form-control" placeholder="············">
                                    </div>
                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Destekli Maliyet</label>
                                        <input name="base_cost_price" type="text" id="form-repeater-1-4" class="form-control" placeholder="············">
                                    </div>
                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Satış Fiyatı</label>
                                        <input name="sale_price" type="text" id="form-repeater-1-4" class="form-control" placeholder="············">
                                    </div>
                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Şube</label>
                                        <select name="seller_id" class="form-control">
                                            <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($stockcards)): ?>
                                                            <?php echo e($stockcards->hasSeller($seller->id) ? 'selected' : ''); ?>

                                                        <?php endif; ?>  value="<?php echo e($seller->id); ?>"><?php echo e($seller->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Depo</label>
                                        <select name="warehouse_id" class="form-control">
                                            <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($stockcards)): ?>
                                                            <?php echo e($stockcards->hasWarehouse($warehouse->id) ? 'selected' : ''); ?>

                                                        <?php endif; ?>  value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Renk</label>
                                        <select name="color_id" class="form-control">
                                            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($stockcards)): ?>
                                                            <?php echo e($stockcards->hasColor($color->id) ? 'selected' : ''); ?>

                                                        <?php endif; ?>  value="<?php echo e($color->id); ?>"><?php echo e($color->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Neden</label>
                                        <select name="reason_id" class="form-control">
                                            <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($stockcards)): ?>
                                                            <?php echo e($stockcards->hasReason($reason->id) ? 'selected' : ''); ?>

                                                        <?php endif; ?>  value="<?php echo e($reason->id); ?>"><?php echo e($reason->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-lg-4 col-xl-2 col-12 mb-0">
                                        <label class="form-label" for="form-repeater-1-4">Açıklama</label>
                                       <input name="description" class="form-control" type="text" />
                                    </div>
                                    <div class="mb-3 col-lg-12 col-xl-1 col-12 d-flex align-items-center mb-0">
                                        <button class="btn btn-label-danger mt-4" data-repeater-delete="">
                                            <i class="bx bx-x me-1"></i>
                                            <span class="align-middle">Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-0 mt-4">
                            <button type="button" class="btn btn-primary" data-repeater-create="">
                                <i class="bx bx-plus me-1"></i>
                                <span class="align-middle">Yeni Hareket Ekle</span>
                            </button>
                        </div>
                        <hr class="my-5">
                        <button onclick="saveStockMovement('add_movement')" class="btn btn-danger">
                            <i class="bx bx-plus-medical me-1"></i>
                            <span class="align-middle">Tüm Hareketleri Kaydet</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <hr class="my-5">


        <div class="card">
            <div class="card-header">
                <a href="<?php echo e(route('stockcard.create')); ?>" class="btn btn-primary float-end">Yeni Stok Kartı Ekle</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Stok Adı</th>
                        <th>SKU</th>
                        <th>Barkod</th>
                        <th>Serial</th>
                        <th>Adet</th>
                        <th>Şube</th>
                        <th>Depo</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><strong><?php echo e($movement->stock->name); ?></strong></td>
                            <td><strong><?php echo e($movement->stock->sku); ?></strong></td>
                            <td><strong><?php echo e($movement->stock->barcode); ?></strong></td>
                            <td><strong><?php echo e($movement->serial_number); ?></strong></td>
                            <td><strong><?php echo e($movement->quantity); ?></strong></td>
                            <td><strong><?php echo e($movement->seller->name); ?></strong></td>
                            <td><strong><?php echo e($movement->warehouse->name); ?></strong></td>
                            <td>
                                <a href="<?php echo e(route('stockcard.showmovemnet',['id' => 1])); ?>"
                                   class="btn btn-icon btn-success">
                                    <span class="bx bxl-edge"></span>
                                </a>
                                <a href="<?php echo e(route('stockcard.edit',['id' => 1])); ?>"
                                   class="btn btn-icon btn-primary">
                                    <span class="bx bx-edit-alt"></span>
                                </a>
                                <a href="<?php echo e(route('stockcard.delete',['id' => 1])); ?>"
                                   class="btn btn-icon btn-danger">
                                    <span class="bx bxs-trash"></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-5">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
    <script src="<?php echo e(asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/forms-extras.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/stockcard/movement.blade.php ENDPATH**/ ?>