<?php $__env->startSection('content-widget'); ?>
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">Пользователи</h3>
            <div class="card-toolbar">
                <a href="<?php echo e(route('add_user')); ?>" class="btn btn-primary mr-2">Создать пользователя</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2">
        <?php $__currentLoopData = Auth::user()->companyUsers()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--begin::Item-->
                <div class="d-flex align-items-center mb-10">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-success mr-5">
                        <span class="symbol-label">
                            <img src="<?php echo e(asset('media/svg/avatars/009-boy-4.svg')); ?>"
                                 class="h-75 align-self-end" alt="">
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <a href="<?php echo e(route('user_cards', $user->id)); ?>" class="text-dark text-hover-primary mb-1 font-size-lg">
                            <?php echo e($user->fullname); ?>

                        </a>
                        <span class="text-muted" id="user-role-id-<?php echo e($user->id); ?>"><?php echo e($user->role->name); ?></span>
                    </div>
                    <span style="width: 122px;">
                        <span class="label label-lg font-weight-bold  label-light-primary label-inline">
                            <?php echo e($user->cards()->count()); ?>

                        </span>
                    </span>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Быстрые действия">
                        <a href="#" class="btn btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ki ki-bold-more-hor"></i>
                        </a>
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right" style="">
                            <!--begin::Navigation-->
                            <ul class="navi navi-hover">
                                <li class="navi-header font-weight-bold py-4">
                                    <span class="font-size-lg">Роли:</span>
                                    <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Нажмите, чтобы узнать больше..."></i>
                                </li>
                                <li class="navi-separator mb-3 opacity-70"></li>
                                <?php $__currentLoopData = Auth::user()->getRolesListForPermissions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="navi-item">
                                        <span class="navi-link">
                                            <span class="navi-text roleEvent"
                                                  data-role-id="<?php echo e($role->id); ?>"
                                                  data-user-id="<?php echo e($user->id); ?>">
                                                <span class="label label-xl label-inline label-light-success">
                                                    <?php echo e($role->name); ?>

                                                </span>
                                            </span>
                                        </span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li class="navi-separator mt-3 opacity-70"></li>




                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <!--end::Body-->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $('.roleEvent').on('click', function () {
            let userId = $(this).attr("data-user-id");
            let roleId = $(this).attr("data-role-id");
            $.ajax({
                type:'post',
                url:'<?php echo e(route('role_update')); ?>',
                dataType: "json",
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'user_id': userId,
                    'role_id': roleId
                },
                success: function (data) {
                    console.log(data);
                    div = $('#user-role-id-'+ data.user_id);
                    div.html(data.role)
                    sendNotification()
                },
                error: function () {
                    sendNotification()
                }
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.manager.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hd\PhpstormProjects\pay\resources\views/pages/manager/widgets/dashboard.blade.php ENDPATH**/ ?>