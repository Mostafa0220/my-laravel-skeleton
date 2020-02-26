@extends('admin.layouts.master')
@section('title')
    Categories
    <a href="#" class="btn btn-outline-primary " id="add-item" data-action="add-item"> <i class="fa fa-plus"></i> Add
        New </a>
@endsection
@section('content')
    <!-- LARGE MODAL -->
    <div id="edit-modal" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">

                {!! Form::open([ 'route' => 'admin.categories.store', 'method' => 'POST', 'id' => 'modal-edit-form' ]) !!}
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit Category</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20" style="width:600px">

                    <div class="container">@include('admin.categories._form') </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
    <div class="section-wrapper">


        <div class="table-responsive">
            <table id="tree-table" class="table table-hover table-bordered mg-b-0">
                <thead>
                <tr>

                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($parentCategories as $category)
                    <tr data-tt-id="{{$category->id}}" class="data-row">

                        <td data-column="name" class="name">{{$category->name}}</td>
                        <td>
                            <?php
                            $data = [
                                'delete_url' => route('admin.categories.destroy', $category->id),
                                'edit_button' => [
                                    'item_id' => $category->id,
                                    'item_description' => $category->description,
                                    'parent_id' => $category->parent_id
                                ]
                            ];
                            ?>
                            @include('admin.components.action-buttons-table', $data)
                        </td>
                    </tr>
                    @if(count($category->subcategory))
                        @include('admin.categories.subCategoryList',['subcategories' => $category->subcategory, 'dataParent' => $category->id , 'dataLevel' => 1])
                    @endif
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection



@push('styles')

@endpush

@push('scripts')

    <link rel="stylesheet" href="{{  asset('/css/jquery.treetable.css') }}">
    <script src="{{ asset('/js/jquery.treetable.js') }}"></script>
    <link rel="stylesheet" href="{{  asset('/css/alertify.min.css') }}">
    <link rel="stylesheet" href="{{  asset('/css/alertify-themes/bootstrap.min.css') }}">
    <script src="{{ asset('/js/alertify.min.js') }}"></script>
    <script>
        $("#tree-table").treetable({expandable: false});
        $('.select2-show-search').select2({
            minimumResultsForSearch: ''
        });
        $(document).ready(function () {
            /**
             * for showing edit item popup
             */

            $(document).on('click', ".edit-item", function () {
                $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

                var options = {
                    'backdrop': 'static'
                };
                $('#edit-modal').modal(options)
            })
            $(document).on('click', "#add-item", function () {
                $(this).addClass('add-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

                var options = {
                    'backdrop': 'static'
                };
                $('#edit-modal').modal(options)
            })
            // on modal show
            $('#edit-modal').on('show.bs.modal', function () {

                var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
                //Check the action is edit(in case of edit category only)
                if (el.length) {
                    var row = el.closest(".data-row");

                    // get the data
                    var id = el.data('item-id');
                    var name = row.children(".name").text();
                    var description = el.data("item-description");
                    var parent_id = el.data('parent-id');

                    var url = '{{ route("admin.categories.update", ":id") }}';
                    url = url.replace(':id', id);
                    $('#modal-edit-form').attr('action', url);

                    // fill the data in the input fields
                    $("#modal-input-id").val(id);
                    $("#modal-input-name").val(name);
                    $("#modal-input-description").val(description);

                    $("#modal-input-parent-id").val(parent_id);
                    $("#modal-input-form-method").val("PUT");
                }


            })

            // on modal hide
            $('#edit-modal').on('hide.bs.modal', function () {
                $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
                $("#edit-form").trigger("reset");
            })
        })

        $(".deleteData").on("click", function (event) {
            event.preventDefault();

//override defaults
            alertify.defaults.transition = "slide";
            alertify.defaults.theme.ok = "btn btn-danger";
            alertify.defaults.theme.cancel = "btn btn-primary";

            alertify.confirm("Are you sure you want to delete?", function (e) {
                if (e) {
                    $("#delete-form").submit()
                    return true;
                } else {
                    return false;
                }
            }).set({title: "Warrning!"}, {labels: {ok: 'Delete!', cancel: 'Cancel'}});
        });
    </script>
@endpush





