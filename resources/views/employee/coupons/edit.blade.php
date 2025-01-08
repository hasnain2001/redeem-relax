@extends('employee.master')
@section('title')
    Update
@endsection
@section('main-content')

<style>
    input, textarea {
        font-weight: bold; /* Makes the text bold */
        color: #333; /* Dark color for text, adjust as needed */
    }

    label {
        font-weight: bold; /* Makes the label text bold */
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Coupon</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>{{ session('success') }}</b>
                </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form name="UpdateCoupon" id="UpdateCoupon" method="POST" action="{{ route('employee.coupon.update', $coupons->id) }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Coupon Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $coupons->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="5" style="resize: none;">{{ $coupons->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" class="form-control" name="code" id="code" value="{{ $coupons->code }}">
                                </div>
                                <div class="form-group">
                                    <label for="destination_url">Destination URL <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control" name="destination_url" id="destination_url" value="{{ $coupons->destination_url }}">
                                </div>
                                <div class="form-group">
                                    <label for="ending_date">Ending Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="ending_date" id="ending_date"
                                           value="{{ \Carbon\Carbon::parse($coupons->ending_date)->format('Y-m-d') }}">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label><br>
                                    <input type="radio" name="status" id="enable" {{ $coupons->status == 'enable' ? 'checked' : '' }} value="enable">&nbsp;<label for="enable">Enable</label>
                                    <input type="radio" name="status" id="disable" {{ $coupons->status == 'disable' ? 'checked' : '' }} value="disable">&nbsp;<label for="disable">Disable</label>
                                </div>
                                <div class="form-group">
                                    <label for="top_coupons">Top Coupon <span class="text-danger">*</span></label><br>

                                    <input type="radio" name="top_coupons" id="top_0" value="0"
                                        onclick="updateTopCoupons(0)"
                                        {{ $coupons->top_coupons == 0 ? 'checked' : '' }}>
                                    <label for="top_0">0</label>

                                    <input type="radio" name="top_coupons" id="top_1" value="1"
                                        onclick="updateTopCoupons(1)"
                                        {{ $coupons->top_coupons == 1 ? 'checked' : '' }}>
                                    <label for="top_1">1</label>

                                    <input type="radio" name="top_coupons" id="top_2" value="2"
                                        onclick="updateTopCoupons(2)"
                                        {{ $coupons->top_coupons == 2 ? 'checked' : '' }}>
                                    <label for="top_2">2</label>

                                    <input type="radio" name="top_coupons" id="top_3" value="3"
                                        onclick="updateTopCoupons(3)"
                                        {{ $coupons->top_coupons == 3 ? 'checked' : '' }}>
                                    <label for="top_3">3</label>

                                    <input type="radio" name="top_coupons" id="top_4" value="4"
                                        onclick="updateTopCoupons(4)"
                                        {{ $coupons->top_coupons == 4 ? 'checked' : '' }}>
                                    <label for="top_4">4</label>

                                    <input type="radio" name="top_coupons" id="top_5" value="5"
                                        onclick="updateTopCoupons(5)"
                                        {{ $coupons->top_coupons == 5 ? 'checked' : '' }}>
                                    <label for="top_5">5</label>
                                </div>

                                <input type="hidden" name="top_coupons_hidden" id="top_coupons_hidden">

                                {{-- <div class="form-group">
                                    <label for="authentication">Authentication</label><br>
                                    <input type="checkbox" name="authentication[]" {{ (is_array($coupons->authentication) && in_array('never_expire', $coupons->authentication)) ? 'checked' : '' }} id="never_expire" value="never_expire">&nbsp;<label for="never_expire">Never Expire</label><br>
                                    <input type="checkbox" name="authentication[]" {{ (is_array($coupons->authentication) && in_array('featured', $coupons->authentication)) ? 'checked' : '' }} id="featured" value="featured">&nbsp;<label for="featured">Featured</label><br>
                                    <input type="checkbox" name="authentication[]" {{ (is_array($coupons->authentication) && in_array('free_shipping', $coupons->authentication)) ? 'checked' : '' }} id="free_shipping" value="free_shipping">&nbsp;<label for="free_shipping">Free Shipping</label><br>
                                    <input type="checkbox" name="authentication[]" {{ (is_array($coupons->authentication) && in_array('coupon_code', $coupons->authentication)) ? 'checked' : '' }} id="coupon_code" value="coupon_code">&nbsp;<label for="coupon_code">Coupon Code</label><br>
                                    <input type="checkbox" name="authentication[]" {{ (is_array($coupons->authentication) && in_array('top_deals', $coupons->authentication)) ? 'checked' : '' }} id="top_deals" value="top_deals">&nbsp;<label for="top_deals">Top Deals</label><br>
                                    <input type="checkbox" name="authentication[]" {{ (is_array($coupons->authentication) && in_array('valentine', $coupons->authentication)) ? 'checked' : '' }} id="valentine" value="valentine">&nbsp;<label for="valentine">Valentine</label>
                                </div> --}}
                                <div class="form-group">
                                    <label for="store">Store <span class="text-danger">*</span></label>
                                    <select name="store" id="store" class="form-control fw-bold">
                                        <option value="" disabled selected>{{ $coupons->store }}</option>
                                        @foreach($stores as $store)
                                            <option value="{{ $store->slug }}">{{ $store->slug }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="lang">Language <span class="text-danger">*</span></label>
                                    <select name="language_id" id="lang" class="form-control" required>
                                        <option disabled selected>--Select Langs--</option>
                                        <option value="" disabled selected>{{ $coupons->language->code ?? '--Select Langs--' }}</option>
                                        @foreach ($langs as $lang)
                                            <option value="{{ $lang->id }}">{{ $lang->code }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('employee.coupon') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
