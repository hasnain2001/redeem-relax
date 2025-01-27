@extends('admin.master')
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
    .form-group-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px; /* Adjust spacing between "Status" and "Top Coupon" groups */
    align-items: flex-start;
}

.radio-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Adjust spacing between individual radio buttons */
    align-items: center;
}

.radio-container input[type="radio"] {
    margin-right: 5px; /* Adjust spacing between radio button and its label */
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
            <form name="UpdateCoupon" id="UpdateCoupon" method="POST" action="{{ route('admin.coupon.update', $coupons->id) }}">
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
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="toggleCodeCheckbox" onchange="toggleCodeInput(this)">
                                    <label class="form-check-label" for="toggleCodeCheckbox">Enable Code Input</label>
                                </div>
                                <div class="form-group" id="codeInputGroup" style="display: none;">
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
                                <div class="form-group-container">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label><br>
                                        <div class="radio-container">
                                            <input type="radio" name="status" id="enable" {{ $coupons->status == 'enable' ? 'checked' : '' }} value="enable">
                                            <label for="enable">Enable</label>
                                            <input type="radio" name="status" id="disable" {{ $coupons->status == 'disable' ? 'checked' : '' }} value="disable">
                                            <label for="disable">Disable</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="top_coupons">Top Coupon <span class="text-danger">*</span></label><br>
                                        <div class="radio-container">
                                            @for ($i = 0; $i <= 5; $i++)
                                                <input type="radio" name="top_coupons" id="top_{{ $i }}" value="{{ $i }}" onclick="updateTopCoupons({{ $i }})"
                                                    {{ $coupons->top_coupons == $i ? 'checked' : '' }}>
                                                <label for="top_{{ $i }}">{{ $i }}</label>
                                            @endfor
                                            <input type="hidden" name="top_coupons_hidden" id="top_coupons_hidden">
                                        </div>
                                    </div>
                                </div>
                                
                              
                                <div class="form-group d-inline ">
                                    <label for="authentication">Authentication</label><br>
                                    
                                    <input type="radio" name="authentication" 
                                           {{ ($coupons->authentication === 'neverexpire') ? 'checked' : '' }} 
                                           id="neverexpire" value="neverexpire">&nbsp;
                                    <label for="neverexpire">Never Expire</label><br>
                                                                         <input type="radio" name="authentication" 
                                           {{ ($coupons->authentication === 'featured') ? 'checked' : '' }} 
                                           id="featured" value="featured">&nbsp;
                                    <label for="featured">Featured</label><br>
                                    
                                    <input type="radio" name="authentication" 
                                           {{ ($coupons->authentication === 'free shipping') ? 'checked' : '' }} 
                                           id="free_shipping" value="free shipping">&nbsp;
                                    <label for="free_shipping">Free Shipping</label><br>
                                    
                                    <input type="radio" name="authentication" 
                                           {{ ($coupons->authentication === 'coupon code') ? 'checked' : '' }} 
                                           id="coupon code" value="coupon code">&nbsp;
                                    <label for="coupon code">Coupon Code</label><br>
                                    
                                    <input type="radio" name="authentication" 
                                           {{ ($coupons->authentication === 'top deals') ? 'checked' : '' }} 
                                           id="top deals" value="top deals">&nbsp;
                                    <label for="top deals">Top Deals</label><br>
                                    
                                    <input type="radio" name="authentication" 
                                           {{ ($coupons->authentication === 'valentine') ? 'checked' : '' }} 
                                           id="valentine" value="valentine">&nbsp;
                                    <label for="valentine">Valentine</label>
                           
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="toggleOtherCheckbox" onchange="toggleOtherInput(this)">
                                        <label class="form-check-label" for="toggleOtherCheckbox">Other</label>
                                    </div>
                                    <div class="form-group" id="otherInputGroup" style="display: none;">
                                        <label for="otherAuthentication">Authentication</label>
                                        <input type="text" class="form-control" name="authentication" id="otherAuthentication" value="{{ $coupons->authentication }}">
                                    </div>
                                    
 
                                </div>
                                
                                
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

    function toggleOtherInput(checkboxElement) {
    const otherInputGroup = document.getElementById('otherInputGroup');
    
    if (checkboxElement.checked) {
        otherInputGroup.style.display = 'block'; // Show the input field
    } else {
        otherInputGroup.style.display = 'none'; // Hide the input field
    }
}

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
