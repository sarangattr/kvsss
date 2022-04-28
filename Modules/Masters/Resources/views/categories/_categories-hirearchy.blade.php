@foreach ($categories as $category)
    @php $hCaregory = ''; @endphp
    @if(isset($name))
        @if (old($name) == $category->id)
            @php $hCaregory = 'selected'; @endphp
        @endif
    @endif
    <option @if($category->id == $id) selected @endif  {{$hCaregory}} value="{{ $category->id }}">{{$dashes}}{{ $category->name }}</option>
    @if(count($category->children))
        @php $newDashes = $dashes . '-' @endphp
        @include('masters::categories._categories-hirearchy', ['categories'=>$category->children, 'dashes'=>$newDashes,'id' => $id])
    @endif
@endforeach
 