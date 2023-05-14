<?php $__env->startSection('content'); ?>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ayarlar /</span> Ayar listesi</h4>

        <div class="card">
            <div class="card-body">
                <form method="post" action="<?php echo e(route('settings.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row g-3">

                        <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="panel-heading">
                                <h4 class="panel-title" style="float: left;width: 50%">
                                    <?php echo e($setting->display_name); ?> <code>setting('<?php echo e($setting->category); ?>.<?php echo e($setting->key); ?>

                                        ')</code>
                                </h4>
                                <div class="panel-actions" style="width: 30%;float: right;text-align: right;">
                                    <i class="bx bxs-trash" data-id="<?php echo e($setting->id); ?>"
                                       data-display-key="<?php echo e($setting->category); ?>.<?php echo e($setting->key); ?>"
                                       data-display-name="<?php echo e($setting->display_name); ?>"></i>
                                </div>
                            </div>
                            <div class="panel-body no-padding-left-right row">
                                <div class="col-md-10 no-padding-left-right">
                                    <?php if($setting->type == "text_area"): ?>
                                        <textarea class="form-control"
                                                  name="<?php echo e($setting->category); ?>.<?php echo e($setting->key); ?>"><?php echo e($setting->value); ?></textarea>
                                    <?php endif; ?>
                                    <?php if($setting->type == "text"): ?>
                                        <input type="text" class="form-control"
                                               name="<?php echo e($setting->category); ?>.<?php echo e($setting->key); ?>" value="<?php echo e($setting->value); ?>">
                                    <?php endif; ?>
                                    <?php if($setting->type == "image"): ?>
                                        <input type="file" class="form-control"
                                               name="<?php echo e($setting->category); ?>.<?php echo e($setting->key); ?>" value="">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2 no-padding-left-right">
                                    <select class="form-control group_select" name="<?php echo e($setting->category); ?>.category"
                                            data-select2-id="25" tabindex="-1" aria-hidden="true">
                                        <option <?php if($setting->category == 'site'): ?> selected <?php endif; ?> value="Site">Site
                                        </option>
                                        <option <?php if($setting->category == 'admin'): ?> selected <?php endif; ?> value="Admin">Admin
                                        </option>
                                        <option <?php if($setting->category == 'sms'): ?> selected <?php endif; ?> value="Admin">SMS
                                        </option>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="col-md-2">
                        <button style="    margin: 27px 0 0;" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix mt-4"></div>

        <div class="card">
            <div class="card-body">
                <form method="post" action="<?php echo e(route('settings.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-lg-12 mx-auto">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label" for="key">Key</label>
                                <input type="text" id="key" class="form-control" name="key">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="value">Value</label>
                                <input type="text" id="display_name" class="form-control" name="display_name">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="type">Tip</label>
                                <select name="type" class="form-control" required="required">
                                    <option value="">Choose Type</option>
                                    <option value="text">Text Box</option>
                                    <option value="text_area">Text Area</option>
                                    <option value="rich_text_box">Rich Textbox</option>
                                    <option value="markdown_editor">Markdown Editor</option>
                                    <option value="code_editor">Code Editor</option>
                                    <option value="checkbox">Check Box</option>
                                    <option value="radio_btn">Radio Button</option>
                                    <option value="select_dropdown">Select Dropdown</option>
                                    <option value="file">File</option>
                                    <option value="image">Image</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="pincode">Kategori</label>
                                <select class="form-control" name="category">
                                    <option value="sms">SMS</option>
                                    <option value="site">Site</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button style="    margin: 27px 0 0;" class="btn btn-success">Kaydet</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr class="my-5">
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/module/settings/index.blade.php ENDPATH**/ ?>