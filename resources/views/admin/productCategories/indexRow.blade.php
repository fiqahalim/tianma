<tr data-entry-id="{{ $productCategory->id }}">
    <td>
        
    </td>
    {{-- <td>
        {{ $productCategory->id ?? '' }}
    </td> --}}
    <td>
        {{ $prefix ?? '' }} {{ $productCategory->name ?? '' }}
    </td>
    <td>
        {{ $productCategory->description ?? '' }}
    </td>
    {{-- <td>
        @if($productCategory->photo)
            <a href="{{ $productCategory->photo->getUrl() }}" target="_blank">
                <img src="{{ $productCategory->photo->getUrl('thumb') }}" width="50px" height="50px">
            </a>
        @endif
    </td> --}}
    {{-- <td>
        {{ $productCategory->slug ?? '' }}
    </td> --}}
    <td>
        {{ $productCategory->parentCategory->name ?? '' }}
    </td>
    <td>
        @can('product_category_show')
            <a class="btn btn-xs btn-primary" href="{{ route('admin.product-categories.show', $productCategory->id) }}">
                <i class="fas fa-eye"></i>
            </a>
        @endcan

        @can('product_category_edit')
            <a class="btn btn-xs btn-info" href="{{ route('admin.product-categories.edit', $productCategory->id) }}">
                <i class="fas fa-pencil-alt"></i>
            </a>
        @endcan

        @can('product_category_delete')
            <form action="{{ route('admin.product-categories.destroy', $productCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-xs btn-danger">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        @endcan
    </td>
</tr>
