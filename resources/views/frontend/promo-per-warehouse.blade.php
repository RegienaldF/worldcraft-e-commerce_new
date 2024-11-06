<table class="table table-bordered" style="max-width: 360px;">
    <thead>
        <tr>
            <th colspan="2">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        Enjoy a discount based on your pickup location
                    </div>
                    <div>
                        <button class="btn btn-sm btn-transparent dropdown-toggle p-0" type="button"
                            data-toggle="collapse" data-target="#discountTableBody" aria-expanded="false"
                            aria-controls="discountTableBody">

                        </button>
                    </div>
                </div>
            </th>
        </tr>
    </thead>
    <tbody id="discountTableBody" class="collapse show">
        @foreach($warehouse_promo_discount as $item)
            <tr>
                <td>{{ $item['warehouse_location'] }}</td>
                <td class="discount">{{ $item['promo_discount'] }}% OFF</td>
            </tr>
        @endforeach
    </tbody>
</table>
