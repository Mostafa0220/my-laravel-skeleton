<div class="form-group">
    {!! Form::hidden('id', old('id'), [ 'class' => 'form-control','id' => 'modal-input-id' ]) !!}
    <input name="_method" type="hidden" value="POST" id="modal-input-form-method">
    <label> Name </label>
    {!! Form::text('name', old('name'), [ 'class' => 'form-control','id' => 'modal-input-name' ]) !!}
</div>
<div class="form-group">
    <label> Description </label>
    {!! Form::text('description', old('description'), [ 'class' => 'form-control','id' => 'modal-input-description' ]) !!}
</div>
<div class="form-group">
    <label> Parent Category </label>{{-- select2-show-search --}}<br/>
    {!! Form::select('parent_id', $allcategories, old('parent_id'), [ 'placeholder' => 'Choose one','class' => 'form-control ','id' => 'modal-input-parent-id' ]) !!}
</div>
