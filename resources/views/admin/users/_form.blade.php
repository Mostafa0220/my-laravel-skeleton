<div class="form-group">
    <label> Name </label>
    {!! Form::text('name', old('name'), [ 'class' => 'form-control' ]) !!}
</div>
<div class="form-group">
    <label> Email </label>
    {!! Form::text('email', old('email'), [ 'class' => 'form-control' ]) !!}
</div>
<div class="form-group">
    <label> Password </label>
    {!! Form::password('password', [ 'class' => 'form-control' ]) !!}
</div>
<div class="form-group">
    <label> Assign Role </label>
    {!! Form::select('role_id', $roles, old('role_id'), [ 'class' => 'form-control' ]) !!}
</div>
<div class="form-group">
    <label> Avatar </label>
    {!! Form::File('avatar', [ 'class' => 'form-control','id' => 'avatar' ]) !!}
</div>
<div class="media">
    @if($user->avatar) 
        <img src="{{ asset('storage/app/avatars/' .$user->avatar) }}" id="preview"  style="max-height:120px;margin-bottom:50px" class="img-responsive center-block">
    @else
        <img src="{{ asset('images/avatars/admins/admins.png') }}"  id="preview"  style="max-height:120px;margin-bottom:50px" class="img-responsive center-block">
    @endif
</div>      
   

<div class="form-group">
    <button class="btn btn-primary"> Save </button>
</div>
@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
            
        $('#avatar').change(function() {
            readURL(this);
        });

    </script>
@endpush