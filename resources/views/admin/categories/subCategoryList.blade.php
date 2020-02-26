@foreach($subcategories as $subcategory)
    <tr data-tt-id="{{$subcategory->id}}" data-tt-parent-id="{{$dataParent}}" class="data-row">

        <td data-column="name" class="name">{{$subcategory->name}}</td>
        <td>
            <?php
            $data = [
                'delete_url' => route('admin.categories.destroy', $subcategory->id),
                'edit_button' => [
                    'item_id' => $subcategory->id,
                    'item_description' => $subcategory->description,
                    'parent_id' => $subcategory->parent_id
                ]
            ];
            ?>
            @include('admin.components.action-buttons-table', $data)
        </td>
    </tr>
    @if(count($subcategory->subcategory))
        @include('admin.categories.subCategoryList',['subcategories' => $subcategory->subcategory, 'dataParent' => $subcategory->id, 'dataLevel' => $dataLevel ])
    @endif
@endforeach
