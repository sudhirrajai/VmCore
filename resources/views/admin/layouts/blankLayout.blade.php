@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset


@extends('admin.layouts.commonMaster')

@section('layoutContent')
<!-- Content -->
@yield('content')
<!--/ Content -->
@endsection
