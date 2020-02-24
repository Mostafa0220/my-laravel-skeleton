@extends('admin.layouts.master')
@section('title')
Users
<div class="container">
    <form action="{{ route('admin.users.import') }}" id="import-form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4"><input type="file" name="file" id="import-btn"  class="filestyle"></div>
            <div class="col-md-4"><a class="btn btn-outline-warning" href="{!! route('admin.users.export', ['type' => 'xlsx']) !!}"><i class='icon ion-upload'></i>  Export </a></div>
            <div class="col-md-4"><a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary "> <i class="fa fa-plus"></i> Add New </a></div>
        </div>
    </form>
</div>



@endsection

@section('content')

<div class="section-wrapper">
    @component('admin.components.datatables', [
        'name' => 'data-tables',
        'thead' => [  __('Name'), __('Email'), __('State'), __('Created at'), __('Action') ],
        'options' => [
            'processing' => true,
            'serverSide' => true,
            'ajax' => route('admin.users.index'),
            'columns' => [
                ['data' => 'name'],
                ['data' => 'email'],
                ['data' => 'state'],
                ['data' => 'created_at'],
                ['data' => 'action', 'class' => 'text-right'],
            ]
        ]
    ])
    @endcomponent

</div>
@endsection
@push('scripts')
    <script src="{{ asset('/js/bootstrap-filestyle.min.js') }}"></script>
    <script type="text/javascript">

        $('#import-btn').filestyle({
            badge: true,
            input : false,
            btnClass : 'btn-outline-success',
            htmlIcon : '<i class="icon ion-arrow-down-a"></i> ',
            text : ' Import',
            onChange: function (param) {
                    $('#import-form').submit();

				}
        });

    </script>
@endpush
