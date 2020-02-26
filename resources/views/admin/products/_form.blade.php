
<div class="form-group">
    <label for="category_id">Category</label>


{!! Form::select('category_id', $categories, old('category_id'), [ 'class' => 'form-control' ,'placeholder' => 'Select a Category']) !!}

</div>
<div class="form-group">
    <label>Product Name</label>
    {!! Form::text('name', old('name'), [ 'class' => 'form-control','placeholder' => 'Enter Product Name' ]) !!}

</div>
<div class="form-group">
    <label>Product Description</label>
    {!! Form::textarea('description', old('description'), [ 'class' => 'form-control','placeholder' => 'Enter Description' ]) !!}
    
</div>
<div class="form-group">
    <label for="exampleFormControlFile1">Product Image</label>
    <input name="image" type="file" class="form-control-file" id="image">
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit"/>
</div>
</form>
