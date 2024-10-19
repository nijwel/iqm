<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

<div class="print_area">
    <div class="">
    	<div class="row">
	    	@for ($i = 0; $i < $qty; $i++)
	    		<div class="col-6 mt-3">
	    			{!! DNS1D::getBarcodeHTML($data->product_code, 'CODABAR') !!}
	    			<p style="margin-left: 100px;"># {{ $data->product_code }}</p>
	    		</div>
	        @endfor
        </div>
    </div>
</div>