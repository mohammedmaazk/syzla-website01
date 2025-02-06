@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30 text-center">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div>
                            <img src="{{ getImage(getFilePath('userProfile') . '/' . @$order->user->image, getFileSize('userProfile')) }}" alt="@lang('Profile Image')" class="b-radius--10">
                        </div>
                        <div class="mt-15">
                            <h4>{{ @$order->user->fullname }}</h4>
                            <p>{{ @$order->user->email }}</p>
                            <span class="text--small">@lang('Joined At')
                                <strong>{{ showDateTime(@$order->user->created_at, 'd M, Y h:i A') }}</strong>
                            </span>
                            <a href="{{ route('admin.users.notification.single', $order->user->id) }}" class="btn btn-outline--primary btn-sm mt-15"><i class="las la-paper-plane"></i> @lang('Send Notification')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            @include('admin.partials.order_details')
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.orders.index') }}" />
@endpush
