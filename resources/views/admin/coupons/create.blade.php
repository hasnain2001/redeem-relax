@extends('admin.master')
@section('title')
    Create | Coupons
@endsection
@section('main-content')
<style>

</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Coupon</h1>
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
      <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
<form name="CreateCoupon" id="CreateCoupon" method="POST" action="{{ route('admin.coupon.store') }}">
                                @csrf
                            <label for="name">Coupon Name <span class="text-danger">*</span></label>
           <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" cols="20" rows="3" style="resize: none;">{{ old('description') }}</textarea>


                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="toggleCodeCheckbox" onchange="toggleCodeInput(this)">
                            <label class="form-check-label" for="toggleCodeCheckbox">Enable Code Input</label>
                        </div>
                        
                        <div class="form-group" id="codeInputGroup" style="display: none;">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" id="code" >
                        </div>
                                        
                        
                        <div class="form-group">
                            <label for="destination_url">Destination URL <span class="text-danger">*</span></label>
                            <input type="url" class="form-control" name="destination_url" id="destination_url" required>
                        </div>

                     <div class="form-group">

</div>

                        <div class="form-group">
                            <label for="ending_date">Ending Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="ending_date" id="ending_date" required>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="lang">Language <span class="text-danger">*</span></label>
                        
                                <select name="language_id" id="language_id" class="form-control"required>
                                <option disabled selected>--Select Langs--</option>
                                @foreach ($langs as $lang)
                                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="top_coupons">Top Coupons Code <span class="text-danger">*</span></label><br>
                            <input type="radio" name="top_coupons" id="top_0" value="0" onclick="updateTopCoupons(0)">
                            <label for="top_0">0</label>

                            <input type="radio" name="top_coupons" id="top_1" value="1" onclick="updateTopCoupons(1)">
                            <label for="top_1">1</label>

                            <input type="radio" name="top_coupons" id="top_2" value="2" onclick="updateTopCoupons(2)">
                            <label for="top_2">2</label>

                            <input type="radio" name="top_coupons" id="top_3" value="3" onclick="updateTopCoupons(3)">
                            <label for="top_3">3</label>

                            <input type="radio" name="top_coupons" id="top_4" value="4" onclick="updateTopCoupons(4)">
                            <label for="top_4">4</label>

                            <input type="radio" name="top_coupons" id="top_5" value="5" onclick="updateTopCoupons(5)">
                            <label for="top_5">5</label>
                        </div>
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label><br>
                            <input type="radio" name="status" id="enable" value="enable" required>&nbsp;<label for="enable">Enable</label>
                            <input type="radio" name="status" id="disable" value="disable" required>&nbsp;<label for="disable">Disable</label>
                        </div>
                        <div class="form-group">
                            <label for="store">Store <span class="text-danger">*</span></label>
                            <select name="store" id="store" class="form-control" required >
                                <option value="" disabled selected>--Select Store--</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->slug }}">{{ $store->slug }}</option>
                                @endforeach
                            </select>
                        </div>
 <div class="form-group">
  <label for="authentication">Authentication</label><br>
  
  <input type="radio" name="authentication" id="never_expire" value="never_expire">
  <label for="never_expire">Never Expire</label>
  
  <input type="radio" name="authentication" id="featured" value="featured">
  <label for="featured">Featured</label>
  
  <input type="radio" name="authentication" id="free_shipping" value="free_shipping">
  <label for="free_shipping">Free Shipping</label>
  
  <input type="radio" name="authentication" id="coupon_code" value="coupon_code">
  <label for="coupon_code">Coupon Code</label>
  
  <input type="radio" name="authentication" id="top_deals" value="top_deals">
  <label for="top_deals">Top Deals</label>
  
  <input type="radio" name="authentication" id="valentine" value="valentine">
  <label for="valentine">Valentine</label>
  
  <input type="radio" name="authentication" id="other" value="other">
  <label for="other">Other</label>
  
  <input type="text" name="authentication_other" id="authentication_other" placeholder="Specify other" style="display: none;">
</div>
                          
                         
                          
                     
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.coupon') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>

</div>

    </section>
</div>
    <script>
  const radios = document.querySelectorAll('input[name="authentication"]');
  const otherInput = document.getElementById('authentication_other');

  radios.forEach(radio => {
    radio.addEventListener('change', function() {
      if (this.id === 'other') {
        otherInput.style.display = 'inline';
      } else {
        otherInput.style.display = 'none';
        otherInput.value = ''; // Clear input when "Other" is not selected
      }
    });
  });
    function toggleCodeInput(checkboxElement) {
        const codeInputGroup = document.getElementById('codeInputGroup');
        
        if (checkboxElement.checked) {
            codeInputGroup.style.display = 'block'; // Show the input field
        } else {
            codeInputGroup.style.display = 'none'; // Hide the input field
        }
    }
</script>


@endsection
