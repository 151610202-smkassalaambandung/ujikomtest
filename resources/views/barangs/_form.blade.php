<div class="form-group{{ $errors->has('cover') ?'has-error':''}}">
	{!!Form::label('cover','Gambar',['class'=>'col-md-2 control-label'])!!}
	<div class="col-md-4">
		{!! Form::file('cover')!!}
		@if (isset($barang) && $barang->cover)
		<p>
		{!! Html::image(asset('img/'.$barang->cover), null, ['class'=>'img-rounded img-responsive']) !!}
	    </p>
	    @endif
        {!! $errors->first('cover','<p class="help-block">:message</p>')!!}
		</div>
</div>

<div class="form-group{{ $errors->has('nama_barang') ?'has-error':''}}">
	{!!Form::label('nama_barang','Barang',['class'=>'col-md-2 control-label'])!!}
	<div class="col-md-4">
		{!! Form::text('nama_barang',null,['class'=>'form-control'])!!}
		{!! $errors->first('nama_barang','<p class="help-block">:message</p>')!!}
	</div>
</div>
<div class="form-group {!! $errors->has('modeli_id') ? 'has-error':'' !!}">
    {!! Form::label('modeli_id','Model', ['class'=>'col-md-2 control-label'])!!}
    <div class="col-md-4">
         {!! Form::select('modeli_id',["=>"]+App\Modeli::pluck('nama','id')->all(), null, ['class'=>'form-control','placeholder'=>'Pilih Model'])!!}
         {!! $errors->first('modeli_id', '<p class="help-block">:message</p>')!!}
   </div>
 </div>
 <div class="form-group{{ $errors->has('jumlah_barang') ? 'has-error':''}}">
    {!! Form::label('jumlah_barang','Jumlah', ['class'=>'col-md-2 control-label'])!!}
    <div class="col-md-4">
         {!! Form::number('jumlah_barang',null,['class'=>'form-control','min'=>1])!!}
         {!! $errors->first('jumlah_barang', '<p class="help-block">:message</p>')!!}
   </div>
 </div>
 <div class="form-group{{ $errors->has('harga') ? 'has-error':''}}">
    {!! Form::label('harga','Harga', ['class'=>'col-md-2 control-label'])!!}
    <div class="col-md-4">
         {!! Form::number('harga',null,['class'=>'form-control','min'=>1])!!}
         {!! $errors->first('harga', '<p class="help-block">:message</p>')!!}
   </div>
 </div>



<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan',['class'=>'btn btn-primary'])!!}
	</div>
</div>
