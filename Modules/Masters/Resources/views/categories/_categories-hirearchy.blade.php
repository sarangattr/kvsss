@foreach ($categories as $category)
    @php $hCaregory = ''; @endphp
    

    <option value="{{ $category->parent_category }}">{{$dashes}}{{ $category->name }}</option>
    @if(count($category->children))
        @php $newDashes = $dashes . '-' @endphp
        @include('masters::categories._categories-hirearchy', ['categories'=>$category->children, 'dashes'=>$newDashes])
    @endif
@endforeach
 