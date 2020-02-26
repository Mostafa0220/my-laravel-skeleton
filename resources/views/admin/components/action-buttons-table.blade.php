@if( isset( $delete_url ) )
    <form action="{!! $delete_url!!}" method="post" id="delete-form">
        @endif
        @if( isset( $edit_url ) )

            <a href="{!! empty( $edit_url ) ? 'javascript:void(0)' : $edit_url !!}"
               class="{!! empty( $edit_url ) ? 'disabled' : 'edit-item' !!} btn btn-outline-warning " title="Edit"
               data-button="edit"><i class="icon ion-edit"></i></a>

        @endif
        @if( isset( $edit_button ) )

            <button type="button" class="edit-item btn btn-outline-warning" title="Edit" data-button="edit"
                    @if(isset($edit_button['item_id']))
                    data-item-id="{{ $edit_button['item_id'] }}"
                    @endif
                    @if(isset($edit_button['item_description']))
                    data-item-description="{{ $edit_button['item_description'] }}"
                    @endif
                    @if(isset($edit_button['parent_id']))
                    data-parent-id="{{ $edit_button['parent_id'] }}"
                @endif
            >
                <i class="icon ion-edit"></i>
            </button>

        @endif
        @if( isset( $show_url ) )
            <a href="{!! empty( $show_url ) ? 'javascript:void(0)' : $show_url !!}"
               class="{!! empty( $show_url ) ? 'disabled' : '' !!} btn btn-outline-secondary " title="Detail"
               data-button="edit">
                <i class="icon ion-search"></i>
                <!-- <i class="fa fa-search"></i> -->
            </a>
        @endif
        @if( isset( $delete_url ) )
        <!--
        <a href="javascript:void(0)" id="deleteData" class="deleteData {!! empty( $delete_url ) ? 'disabled' : '' !!} btn btn-outline-danger " title="Delete" data-href="{!! empty( $delete_url ) ? 'javascript:void(0)' : $delete_url !!}" data-button="delete">
        <i class="icon ion-trash-a"></i>
        </a>
    -->

            @csrf
            @method('DELETE')
            <button class="deleteData {!! empty( $delete_url ) ? 'disabled' : '' !!} btn btn-outline-danger"
                    type="button"><i class="icon ion-trash-a"></i></button>
    </form>
@endif
