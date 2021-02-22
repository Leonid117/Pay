@if(isset($permission) and \Illuminate\Support\Facades\Auth::user()->hasPermission($permission['title']))
{{--@isset()--}}
    <div class="d-flex align-items-center pb-9">
        <!--begin::Symbol-->
        <div class="symbol symbol-45 symbol-light mr-4">
        <span class="symbol-label">
            <span class="svg-icon svg-icon-2x svg-icon-dark-50">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->
                {{ \App\Classes\Theme\Metronic::getSVG('media/svg/icons/'.$svg) }}
            <!--end::Svg Icon-->
            </span>
        </span>
        </div>
        <!--end::Symbol-->
        <!--begin::Text-->
        <div class="d-flex flex-column flex-grow-1">
            <a href="{{ $route }}"
               class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                {{ $title }}
            </a>
            <span class="text-muted font-weight-bold">{{ $description }}</span>
        </div>
        <!--end::Text-->
        @isset($count)
        <!--begin::label-->
            <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{ $count }}</span>
            <!--end::label-->
        @endisset
    </div>
@endisset


@section('scripts')
    <script src="{{ asset('js/pages/custom/profile/profile.js') }}" type="text/javascript"></script>
@endsection