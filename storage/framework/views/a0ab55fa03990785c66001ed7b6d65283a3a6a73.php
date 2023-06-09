<div class="modal fade" id="editUser" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Yeni Müşteri Ekle</h3>
                </div>
                <form action="javascript():;" method="post" id="customerForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id"/>
                    <div class="card-body">
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                                <img
                                    src="<?php echo e(asset('assets/img/identity.jpg')); ?>"
                                    alt="user-avatar"
                                    class="d-block rounded"
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
                                    <!-- div class="container-fluid" id='camcam'>
                                        <a class='btn btn-block btn-primary text-white' id='open'> Open cam</a>
                                        <div class="row">
                                            <div class="col-md- offset-1">
                                                <div id="wrap">
                                                    <div id='cont'>
                                                        <div id="vid" class='son' >
                                                            <video id='video'></video>
                                                        </div>
                                                        <div id="capture" class='son'>
                                                            <canvas id='canvas'></canvas>
                                                            <canvas id='blank' style='display:none;'></canvas>
                                                        </div>

                                                        <div id="control">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-4"><a id='retake' class='btn btn-block m-1 hov'><i class="fas fa-sync-alt"></i></a></div>
                                                                    <div class="col-md-4"><a id='snap' class='btn btn-block m-1 hov'><i class="fas fa-camera"></i></a></div>
                                                                    <div class="col-md-4"><a id='close' class='btn btn-block m-1 hov'><i class="fas fa-times"></i></a></div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div -->
                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0"/>
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <label for="firstname" class="form-label">İsim</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="firstname"
                                        name="firstname"
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
                                        autofocus required
                                    />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">TC Kimlik / Passport No</label>
                                    <input class="form-control" type="text" name="tc" id="tc" maxlength="13" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input
                                        class="form-control"
                                        type="text"
                                        id="email"
                                        name="email"
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

                                        />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">Adres</label>
                                    <textarea class="form-control" id="address" name="address"></textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zipCode" class="form-label">Not</label>
                                    <textarea class="form-control" id="note" name="note"></textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">İl</label>
                                    <select id="city" name="city" class="select2 form-select" onchange="getTown(this.value)">
                                        <?php $__currentLoopData = $citys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zipCode" class="form-label">İlçe</label>
                                    <select id="district" name="district" class="select2 form-select"></select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="zipCode" class="form-label">Şube</label>
                                    <select id="seller" name="seller_id" class="select2 form-select">
                                        <?php $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($seller->id); ?>"><?php echo e($seller->name); ?></option>
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
                                        id="phoneNumber"
                                        name="web_sites"
                                        class="form-control"
                                    />
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        <div>
                            <button ng-click="customerSave()" type="button" class="btn btn-danger btn-buy-now">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('custom-css'); ?>
    <style>
        #cont{
            position: relative;

        }
        .son{
            position: absolute;
            top:0;
            left:0;

        }




        #control{
            position:absolute;

            left:0;

            z-index: 50;
            background: HoneyDew ;
            opacity:0.7;
            color:#fff;
            text-align: center;

        }
        #snap{
            background-color: dimgray ;

        }
        #retake{
            background-color: coral ;

        }

        #close{
            background-color: lightcoral ;

        }
        .hov{
            opacity:.8;
            transition: all .5s;
        }
        .hov:hover{
            opacity:1;

            font-weight: bolder;
        }
        /*#canvas{
          z-index: 1;
        }
        #video{
          z-index: 3;
        }*/

        html:not([dir=rtl]) .modal-simple .btn-close {
            right: -2rem;
        }

        html:not([dir=rtl]) .modal .btn-close {
            transform: translate(23px, -25px);
        }

        .modal-simple .btn-close {
            position: absolute;
            top: -2rem;
        }

        .modal .btn-close {
            background-color: #fff;
            border-radius: 0.5rem;
            opacity: 1;
            padding: 0.635rem;
            box-shadow: 0 0.125rem 0.25rem rgb(161 172 184 / 40%);
            transition: all .23s ease .1s;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/components/customermodal.blade.php ENDPATH**/ ?>