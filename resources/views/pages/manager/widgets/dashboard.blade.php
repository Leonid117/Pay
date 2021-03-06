{{-- Extends layout --}}
@extends('pages.manager.dashboard')

{{-- Content --}}
@section('content-widget')
    <div class="card card-custom card-stretch gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0">
            <h3 class="card-title font-weight-bolder text-dark">Пользователи</h3>
            <div class="card-toolbar">
                <a href="{{ route('add_user') }}" class="btn btn-primary mr-2">Создать пользователя</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body pt-2">
        @foreach(Auth::user()->companyUsers()->withPermissionInvisible()->get() as $user)
            <!--begin::Item-->
                <div class="d-flex align-items-center mb-10" id="user-id-{{ $user->id }}">
                    <!--begin::Symbol-->
                    <div class="symbol symbol-40 symbol-light-success mr-5">
                        <span class="symbol-label">
                            <img src="{{ asset('media/svg/avatars/009-boy-4.svg') }}"
                                 class="h-75 align-self-end" alt="">
                        </span>
                    </div>
                    <!--end::Symbol-->
                    <!--begin::Text-->
                    <div class="d-flex flex-column flex-grow-1 font-weight-bold">
                        <a href="{{ route('user_cards', $user->id) }}" class="text-dark text-hover-primary mb-1 font-size-lg">
                            {{ $user->fullname }}
                        </a>
                        <span class="text-muted" id="user-role-id-{{ $user->id }}">{{ $user->role->name }}</span>
                    </div>
                    <span style="width: 122px;">
                        <span class="label label-lg font-weight-bold  label-light-primary label-inline">
                            {{ $user->cards()->whereActive()->count() }}
                        </span>
                    </span>
                    <!--end::Text-->
                    <!--begin::Dropdown-->
                    <style>
                        .plus-permissions {
                            /*list-style-type: "+ ";*/
                            color: #00b300;
                        }
                    </style>

                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" data-html="true" data-placement="left"
                        data-original-title="">
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
                                @foreach(Auth::user()->getRolesListForPermissions() as $role)
                                    <li class="navi-item tooltip-dark" data-theme="success"
                                        data-toggle="tooltip" data-html="true" data-placement="right"
                                        data-original-title=
                                        "
                                            @foreach($role->permissions()->get() as $permission)
                                                <span class='plus-permissions'>+ {{$permission->name }}</span><br>
                                            @endforeach
                                        ">
                                        <span class="navi-link">
                                            <span class="navi-text roleEvent"
                                                  data-role-id="{{ $role->id }}"
                                                  data-user-id="{{ $user->id }}">
                                                <span class="label label-xl label-inline label-light-info">
                                                    {{ $role->name }}
                                                </span>
                                            </span>
                                        </span>
                                    </li>
                                @endforeach
                                <li class="navi-separator mt-3 opacity-70"></li>
{{--                                <li class="navi-footer py-4">--}}
{{--                                    <a class="btn btn-clean font-weight-bold btn-sm" href="#">--}}
{{--                                        <i class="ki ki-plus icon-sm"></i>Add new</a>--}}
{{--                                </li>--}}
                            </ul>
                            <!--end::Navigation-->
                        </div>
                    </div>

                    <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" data-html="true" data-placement="left"
                         data-original-title="">
                        <a href="#" class="btn btn-hover-light-danger btn-sm btn-icon btn-delete-ajax"
                           aria-haspopup="true" aria-expanded="false"
                           data-user-id="{{ $user->id }}">
                            <i class="fas fa-trash text-danger"></i>
                        </a>
                    </div>
                    <!--end::Dropdown-->
                </div>
                <!--end::Item-->
            @endforeach
        </div>
        <!--end::Body-->
    </div>
@endsection

@section('scripts')
    <script>
        $('.btn-delete-ajax').on('click', function () {
            let userId = $(this).attr("data-user-id");
            console.log(userId);
            $.ajax({
                type:'post',
                url:'{{ route('user_delete') }}',
                dataType: "json",
                data:{
                    '_token':$('meta[name="csrf-token"]').attr('content'),
                    'user_id': userId,
                },
                success: function (data) {
                    console.log(data);
                    div = $('#user-id-'+ data.user_id);
                    div.html('')
                    sendNotification()
                },
                error: function () {
                    sendNotification()
                }
            });
            // let roleId = $(this).attr("data-role-id");
        });
        $('.roleEvent').on('click', function () {
            let userId = $(this).attr("data-user-id");
            let roleId = $(this).attr("data-role-id");
            $.ajax({
                type:'post',
                url:'{{ route('role_update') }}',
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
@endsection
