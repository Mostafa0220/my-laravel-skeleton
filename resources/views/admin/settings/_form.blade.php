<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#main" data-toggle="tab">Main Configs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#mail" data-toggle="tab">Email Configs</a>
            </li>

        </ul>
    </div><!-- card-header -->

    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="main">
                <div class="form-group">
                    <label> App Title </label>
                    {!! Form::text('app_title', $configs['app_title'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Company Name </label>
                    {!! Form::text('company_name', $configs['company_name'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Company Phones </label>
                    {!! Form::text('company_phones', $configs['company_phones'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Company Address </label>
                    {!! Form::text('company_address', $configs['company_address'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Company Info Emails </label>
                    {!! Form::text('company_info_emails', $configs['company_info_emails'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Fax </label>
                    {!! Form::text('fax', $configs['fax'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> About </label>
                    {!! Form::textarea('about', $configs['about'], [ 'class' => 'form-control','id' => 'about' ]) !!}
                </div>
                <div class="form-group">
                    <label> Privacy </label>
                    {!! Form::textarea('privacy', $configs['privacy'], [ 'class' => 'form-control','id' => 'privacy' ]) !!}
                </div>
                <div class="form-group">
                    <label> Policy </label>
                    {!! Form::textarea('policy', $configs['policy'], [ 'class' => 'form-control','id' => 'policy' ]) !!}
                </div>
                <div class="form-group">
                    <label> Terms </label>
                    {!! Form::textarea('terms', $configs['terms'], [ 'class' => 'form-control','id' => 'terms' ]) !!}
                </div>
                <div class="form-group">
                    <label> Login Message </label>
                    {!! Form::textarea('login_message', $configs['login_message'], [ 'class' => 'form-control','id' => 'login_message' ]) !!}
                </div>
                <div class="form-group">
                    <label> Login Welcome </label>
                    {!! Form::textarea('login_welcome', $configs['login_welcome'], [ 'class' => 'form-control','id' => 'login_welcome' ]) !!}
                </div>
                <div class="form-group">
                    <label> Logo </label>
                    {!! Form::File('logo', [ 'class' => 'form-control','id' => 'logo' ]) !!}
                    {!! $configs['logo'] !!}
                </div>
                <div class="form-group">
                    <label> FavIcon </label>
                    {!! Form::File('favicon', [ 'class' => 'form-control','id' => 'favicon' ]) !!}
                    {!! $configs['favicon'] !!}

                </div>

            </div><!-- tab-pane -->
            <div class="tab-pane" id="mail">
                <div class="form-group">
                    <label> Host </label>
                    {!! Form::text('host', $configs['host'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Username </label>
                    {!! Form::text('username', $configs['username'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Password </label>
                    {!! Form::text('password', $configs['password'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Encryption Type </label>
                    {!! Form::text('encryption_type', $configs['encryption_type'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> From Name </label>
                    {!! Form::text('from_name', $configs['from_name'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> From Email </label>
                    {!! Form::text('from_email', $configs['from_email'], [ 'class' => 'form-control' ]) !!}
                </div>
                <div class="form-group">
                    <label> Port </label>
                    {!! Form::text('port', $configs['port'], [ 'class' => 'form-control' ]) !!}
                </div>


            </div><!-- tab-pane -->

        </div><!-- tab-content -->
    </div><!-- card-body -->
</div>


<div class="form-group">
    <button class="btn btn-primary"> Save</button>
</div>
@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#avatar').change(function () {
            readURL(this);
        });

    </script>
@endpush
