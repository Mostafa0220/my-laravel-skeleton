@if( isset( $delete_url ) )
<form action="{!! $delete_url!!}" method="post">
@endif
@if( isset( $edit_url ) )
<a href="{!! empty( $edit_url ) ? 'javascript:void(0)' : $edit_url !!}" class="{!! empty( $edit_url ) ? 'disabled' : '' !!} btn btn-outline-warning " title="Edit" data-button="edit">
    <i class="icon ion-edit"></i>
    <!-- <i class="fa fa-edit"></i> -->
</a>
@endif
@if( isset( $show_url ) )
<a href="{!! empty( $show_url ) ? 'javascript:void(0)' : $show_url !!}" class="{!! empty( $show_url ) ? 'disabled' : '' !!} btn btn-outline-secondary " title="Detail" data-button="edit">
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
        <button  id="deleteData" class="deleteData {!! empty( $delete_url ) ? 'disabled' : '' !!} btn btn-outline-danger" type="submit"><i class="icon ion-trash-a"></i></button>
    </form>
@endif
