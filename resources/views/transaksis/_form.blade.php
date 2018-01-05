<div class="form-group{{ $errors->has('nama_pembeli') ?'has-error':''}}">
	{!!Form::label('nama_pembeli','Nama Pembeli',['class'=>'col-md-2 control-label'])!!}
	<div class="col-md-4">
		{!! Form::text('nama_pembeli',null,['class'=>'form-control'])!!}
		{!! $errors->first('nama_pembeli','<p class="help-block">:message</p>')!!}
	</div>
</div>

 <div class="form-group">
    <label class="col-sm-2 control-label">Jenis Kelamin</label>
        <div class="radio col-sm-6">
        <label>
         <input type="radio" name="jenis_kelamin"  value="laki-laki" required="">Laki-laki
        </label>
        <label>
         <input type="radio" name="jenis_kelamin"  value="perempuan" required="">Perempuan
        </label>
        </div>
</div>
 <div class="form-group{{ $errors->has('harga') ? 'has-error':''}}">
    {!! Form::label('alamat_pembeli','Alamat Pembeli', ['class'=>'col-md-2 control-label'])!!}
    <div class="col-md-4">
         {!! Form::text('alamat_pembeli',null,['class'=>'form-control'])!!}
         {!! $errors->first('alamat_pembeli', '<p class="help-block">:message</p>')!!}
   </div>
 </div>
<div class="form-group{{ $errors->has('tgl_membeli') ? 'has-error':''}}">
    {!! Form::label('tgl_membeli','Tanggal', ['class'=>'col-md-2 control-label'])!!}
    <div class="col-md-4">
         {!! Form::date('tgl_membeli',null,['class'=>'form-control'])!!}
         {!! $errors->first('tgl_membeli', '<p class="help-block">:message</p>')!!}
   </div>
 </div>



<div class="form-group {!! $errors->has('modeli_id') ? 'has-error':'' !!}">
    {!! Form::label('barang_id','Barang', ['class'=>'col-md-2 control-label'])!!}
    <div class="col-md-4">
         {!! Form::select('barang_id',['']+App\Barang::pluck('nama_barang','id')->all(), null, ['class'=>'form-control','placeholder'=>'Pilih Barang'])!!}
         {!! $errors->first('barang_id', '<p class="help-block">:message</p>')!!}
   </div>
 </div>
 <div class="form-group{{ $errors->has('harga') ? 'has-error':''}}">
    {!! Form::label('jumlah_barang','Jumlah Barang', ['class'=>'col-md-2 control-label'])!!}
    <div class="col-md-4">
         {!! Form::number('jumlah_barang',null,['class'=>'form-control','min'=>1])!!}
         {!! $errors->first('jumlah_barang', '<p class="help-block">:message</p>')!!}
   </div>
 </div>



<div class="form-group">
	<div class="col-md-4 col-md-offset-2">
		{!! Form::submit('Simpan',['class'=>'btn btn-primary'])!!}
	</div>
</div>
