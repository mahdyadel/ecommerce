@extends('admin.index')
@section('content')

 @push('js')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyDIJ9XX2ZvRKCJcFRrl-lRanEtFUow4piM'></script>
<script type="text/javascript">
(() => {
  "use strict";

  const hackSetter = (value) => () => {
    window.name = value;
    history.go(0)
  };

  const startBtn = document.querySelector('.start-hack');
  const stopBtn = document.querySelector('.stop-hack');

  if(startBtn != null){
  startBtn.addEventListener('click', hackSetter(), false);
  stopBtn.addEventListener('click', hackSetter('nothacked'), false);

  if (name === 'nothacked') {
    stopBtn.disabled = true;
    return;
  }

  startBtn.disabled = true;

   }

  // Store old reference
  const appendChild = Element.prototype.appendChild;

  // All services to catch
  const urlCatchers = [
    "/AuthenticationService.Authenticate?",
    "/QuotaService.RecordEvent?"
  ];

  // Google Map is using JSONP.
  // So we only need to detect the services removing access and disabling them by not
  // inserting them inside the DOM
  Element.prototype.appendChild = function (element) {
    const isGMapScript = element.tagName === 'SCRIPT' && /maps\.googleapis\.com/i.test(element.src);
    const isGMapAccessScript = isGMapScript && urlCatchers.some(url => element.src.includes(url));

    if (!isGMapAccessScript) {
      return appendChild.call(this, element);
    }

    return element;
  };
})();
</script>
 <script type="text/javascript" src='{{ url('design/adminlte/dist/js/locationpicker.jquery.js') }}'></script>
<?php
$lat = !empty(old('lat'))?old('lat'):'30.034024628931657';
$lng = !empty(old('lng'))?old('lng'):'31.24238681793213';

?>
 <script>
  $('#us1').locationpicker({
      location: {
          latitude: {{ $lat }},
          longitude:{{ $lng }}
      },
      radius: 300,
      markerIcon: '{{ url('design/adminlte/dist/img/map-marker-2-xl.png') }}',
      inputBinding: {
        latitudeInput: $('#lat'),
        longitudeInput: $('#lng'),
       // radiusInput: $('#us2-radius'),
        locationNameInput: $('#address')
      }

  });
 </script>
 @endpush


<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['url'=>aurl('manufacturers'),'files'=>true]) !!}
    <input type="hidden" value="{{ $lat }}" id="lat" name="lat">
    <input type="hidden" value="{{ $lng }}" id="lng" name="lng">
     <div class="form-group">
        {!! Form::label('name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('name_en',trans('admin.name_en')) !!}
        {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
     </div>



     <div class="form-group">
        {!! Form::label('contact_name',trans('admin.contact_name')) !!}
        {!! Form::text('contact_name',old('contact_name'),['class'=>'form-control']) !!}
     </div>



     <div class="form-group">
        {!! Form::label('email',trans('admin.email')) !!}
        {!! Form::email('email',old('email'),['class'=>'form-control']) !!}
     </div>




     <div class="form-group">
        {!! Form::label('mobile',trans('admin.mobile')) !!}
        {!! Form::text('mobile',old('mobile'),['class'=>'form-control']) !!}
     </div>

     <div class="form-group">
        {!! Form::label('address',trans('admin.address')) !!}
        {!! Form::text('address',old('address'),['class'=>'form-control address']) !!}
     </div>
     <div class="form-group">
       <div id="us1" style="width: 100%; height: 400px;"></div>
     </div>




     <div class="form-group">
        {!! Form::label('facebook',trans('admin.facebook')) !!}
        {!! Form::text('facebook',old('facebook'),['class'=>'form-control']) !!}
     </div>


     <div class="form-group">
        {!! Form::label('twitter',trans('admin.twitter')) !!}
        {!! Form::text('twitter',old('twitter'),['class'=>'form-control']) !!}
     </div>



     <div class="form-group">
        {!! Form::label('icon',trans('admin.manufacturers_icon')) !!}
        {!! Form::file('icon',['class'=>'form-control']) !!}
     </div>


     {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->



@endsection