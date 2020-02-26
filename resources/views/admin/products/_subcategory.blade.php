@foreach ($categories as $category)
    <option
        value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
        @for ($i = $spaces; $i < 0; $i--)
        &nbsp;
        @endfor
        {{ $category->name }}</option>
    @if ($category->subcategory)
        @include('admin.products._subcategory',['categories'=>$category->subcategory,'spaces'=>$spaces*2])
    @endif
@endforeach

