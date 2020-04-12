@push('js')
<script type="text/javascript">
$('.datepicker').datepicker({
	rtl:'{{ session('lang')=='ar'?true:false }}',
	language:'{{ session('lang') }}',
	format:'yyyy-mm-dd',
	autoclose:false,
	todayBtn:true,
	clearBtn:true
});
$(document).on('change','.status',function(){
	var status = $('.status option:selected').val();
	if(status == 'refused')
	{
		$('.reason').removeClass('hidden');
	}else{
		$('.reason').addClass('hidden');
	}
});


</script>
@endpush
<div id="product_setting" class="tab-pane fade">
	<h3> {{ trans('admin.product_setting') }} </h3>
	<div class="form-group  col-md-3 col-lg-3 col-sm-3 col-xs-12">
		{!! Form::label('price',trans('admin.price')) !!}
		{!! Form::text('price',$product->price,['class'=>'form-control','placeholder'=>trans('admin.price')]) !!}
	</div>
	<div class="form-group  col-md-3 col-lg-3 col-sm-3 col-xs-12 ">
		{!! Form::label('stock',trans('admin.stock')) !!}
		{!! Form::text('stock',$product->stock,['class'=>'form-control','placeholder'=>trans('admin.stock')]) !!}
	</div>
	<div class="form-group col-md-3 col-lg-3 col-sm-3 col-xs-12">
		{!! Form::label('start_at',trans('admin.start_at')) !!}
		{!! Form::text('start_at',$product->start_at,['class'=>'form-control datepicker','autocomplete'=>'off','placeholder'=>trans('admin.start_at')]) !!}
	</div>
	<div class="form-group col-md-3 col-lg-3 col-sm-3 col-xs-12">
		{!! Form::label('end_at',trans('admin.end_at')) !!}
		{!! Form::text('end_at',$product->end_at,['class'=>'form-control datepicker','placeholder'=>trans('admin.end_at'),'autocomplete'=>'off']) !!}
	</div>
	<div class="clearfix"></div>
	<hr />
	<div class="form-group  col-md-4 col-lg-4 col-sm-4 col-xs-12">
		{!! Form::label('price_offer',trans('admin.price_offer')) !!}
		{!! Form::text('price_offer',$product->price_offer,['class'=>'form-control','placeholder'=>trans('admin.price_offer')]) !!}
	</div>
	<div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
		{!! Form::label('start_offer_at',trans('admin.start_offer_at')) !!}
		{!! Form::text('start_offer_at',$product->start_offer_at,['class'=>'form-control datepicker','placeholder'=>trans('admin.start_offer_at'),'autocomplete'=>'off']) !!}
	</div>
	<div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
		{!! Form::label('end_offer_at',trans('admin.end_offer_at')) !!}
		{!! Form::text('end_offer_at',$product->end_offer_at,['class'=>'form-control datepicker','placeholder'=>trans('admin.end_offer_at'),'autocomplete'=>'off']) !!}
	</div>
	<div class="clearfix"></div>
		<hr />
	<div class="form-group">
		{!! Form::label('status',trans('admin.status')) !!}
		{!! Form::select('status',['pending'=>trans('admin.pending'), 'refused'=>trans('admin.refused'), 'active'=>trans('admin.active')],$product->status,['class'=>'form-control status','placeholder'=>trans('admin.status')]) !!}
	</div>
	<div class="form-group reason {{ $product->status != 'refused'?'hidden':'' }}">
		{!! Form::label('reason',trans('admin.refused_reason')) !!}
		{!! Form::textarea('reason',$product->reason,['class'=>'form-control','placeholder'=>trans('admin.refused_reason')]) !!}
	</div>
</div>
