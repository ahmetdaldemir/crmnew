
<div class="modal fade" id="smsModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Yeni Mesaj Gönder</h3>
                </div>
                <form action="javascript():;" method="post" id="smsForm" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id"/>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-9">
                                <select class="form-control">
                                    <?php $__currentLoopData = $sms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->display_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button onclick="smsSend()" type="button" class="btn btn-danger btn-buy-now">Gönder</button>
                            </div>
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
<?php /**PATH /home/u529018053/domains/phonehospital.com.tr/public_html/crm/resources/views/components/smsmodal.blade.php ENDPATH**/ ?>