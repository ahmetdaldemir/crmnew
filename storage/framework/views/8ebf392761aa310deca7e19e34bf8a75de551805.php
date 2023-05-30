<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Müşteriler /</span> <?php if(isset($customers)): ?> <?php echo e($customers->name); ?> <?php endif; ?></h4>
        <div class="card  mb-4">
            <h5 class="card-header">Müşteri Bilgileri</h5>
            <form action="<?php echo e(route('customer.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" <?php if(isset($customers)): ?> value="<?php echo e($customers->id); ?>" <?php endif; ?> />
            <div class="card-body">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                            <?php if(isset($customers)): ?> src="<?php echo e($customers->image); ?>" <?php else: ?> src="<?php echo e(asset('assets/img/identity.jpg')); ?>" <?php endif; ?>
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Kimlik / Passport Ön Yüzü</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input
                                    type="file"
                                    id="upload"
                                    class="account-file-input"
                                    hidden
                                    accept="image/png, image/jpeg"
                                    name="image"
                                />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                <i class="bx bx-reset d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="firstname" class="form-label">İsim</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="firstname"
                                    name="firstname"
                                    <?php if(isset($customers)): ?> value="<?php echo e($customers->firstname); ?>" <?php endif; ?>
                                    autofocus required
                                />
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="lastname" class="form-label">Soyisim</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="lastname"
                                    name="lastname"
                                    <?php if(isset($customers)): ?> value="<?php echo e($customers->lastname); ?>" <?php endif; ?>
                                    autofocus required
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">TC Kimlik / Passport No</label>
                                <input class="form-control" type="text" name="tc" id="tc" <?php if(isset($customers)): ?> value="<?php echo e($customers->tc); ?>" <?php endif; ?> maxlength="13" required />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="email"
                                    name="email"
                                    <?php if(isset($customers)): ?> value="<?php echo e($customers->email); ?>" <?php endif; ?>
                                    placeholder="john.doe@example.com"
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Iban</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="organization"
                                    name="iban"
                                    <?php if(isset($customers)): ?> value="<?php echo e($customers->iban); ?>" <?php endif; ?>
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Telefon 1</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">TR (+90)</span>
                                    <input
                                        type="text"
                                        id="phoneNumber"
                                        name="phone1"
                                        class="form-control"
                                        <?php if(isset($customers)): ?> value="<?php echo e($customers->phone1); ?>" <?php endif; ?>
                                        required
                                    />
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Telefon 2</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">TR (+90)</span>
                                    <input
                                        type="text"
                                        id="phoneNumber"
                                        name="phone2"
                                        class="form-control"
                                        <?php if(isset($customers)): ?> value="<?php echo e($customers->phone2); ?>" <?php endif; ?>
                                    />
                                </div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">Adres</label>
                                <textarea class="form-control"  id="address"  name="address"><?php if(isset($customers)): ?>  <?php echo e($customers->address); ?>  <?php endif; ?></textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Not</label>
                                <textarea class="form-control"  id="note" name="note"><?php if(isset($customers)): ?> <?php echo e($customers->note); ?>  <?php endif; ?></textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">İl</label>
                                <input class="form-control" type="text" id="city" name="city" <?php if(isset($customers)): ?> value="<?php echo e($customers->city); ?>" <?php endif; ?> />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">İlçe</label>
                                <input class="form-control" type="text" id="district" name="district" <?php if(isset($customers)): ?> value="<?php echo e($customers->district); ?>" <?php endif; ?> />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="zipCode" class="form-label">Şube</label>
                                <select id="seller" name="seller_id" class="select2 form-select">
                                    <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option  <?php if(isset($customers)): ?> <?php echo e($customers->hasSeller($seller->id) ? 'selected' : ''); ?> <?php endif; ?>  value="<?php echo e($seller->id); ?>"><?php echo e($seller->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="zipCode" class="form-label">Firma Türü</label>
                                <select id="seller" name="company_type" class="select2 form-select">
                                  <option value="sahis">Şahıs</option>
                                  <option value="firma">Firma</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="zipCode" class="form-label">Web Sitesi</label>
                                <input
                                    type="text"
                                    id="web_sites"
                                    name="web_sites"
                                    class="form-control"

                                />
                            </div>
                        </div>
                </div>
                <!-- /Account -->

                <hr class="my-5">
                <div>
                    <button type="submit" class="btn btn-danger btn-buy-now">Kaydet</button>
                </div>
            </div>
            </form>
        </div>
        <hr class="my-5">
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-js'); ?>
    <script src="<?php echo e(asset('assets/js/pages-account-settings-account.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/customer/form.blade.php ENDPATH**/ ?>