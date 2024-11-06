<div class="row">
    @foreach($addresses as $key => $address)
        <div class="col-md-12 mb-3">
            {{-- {{ $key }} --}}
            <label class="aiz-megabox d-block bg-white mb-0 shadow p-3 mb-5 bg-body rounded" onclick="updateShippingAddress(`{{ $address->id }}`)">
                {{-- <input type="radio" name="address_id" class="address_id" value="{{ $address->id }}" @if((Session::has('changed_address') && Session::get('changed_address') == true && $address->id == Session::get('delivery_address')['id'])) checked @endif required> --}}
                <input type="radio" name="address_id" class="address_id" value="{{ $address->id }}" @if(Session::get('delivery_address')['id'] == $address->id) checked @endif required>
                <span class="d-flex p-3 aiz-megabox-elem">
                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                    <span class="flex-grow-1 pl-3 text-left">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="fw-600 shipping-address-text fs-16">{{ strtoupper($address->full_name) }}</span>
                            </div>
                            <div onclick="editAddress(`{{ $address->id }}`)">
                                <span class="fw-600 shipping-address-text fs-16">Edit</span>
                            </div>
                        </div>
                        <div>
                            <span class="fw-600 shipping-address-text fs-14">{{ $address->phone }}</span>
                        </div>
                        <div>
                            <span class="fw-500 shipping-address-text fs-14">{{ $address->street }}, {{ $address->barangay->brgyDesc }}, {{ $address->city->citymunDesc }}, {{ $address->province->provDesc }}, {{ $address->zip_code }}</span>
                        </div>
                        @if($address->is_default == 1)
                            <div>
                                <span class="badge badge-secondary px-4">Default</span>
                            </div>
                        @endif
                    </span>
                </span>
            </label>
        </div>
    @endforeach
</div>
