<ul class="list-group" id="categories">
    @foreach($frontCategories as $parentCategory)
        <li class="list-group-item" data-id="{{ $parentCategory->id }}">
            <i class="fa fa-arrow-right"></i>
            <span class="font-weight-bolder">
                {{ $parentCategory->name }} ({{ $parentCategory->products_count }})
            </span>
        </li>

        @if($parentCategory->childCategories->count())
            <div class="list-second-level" data-id="{{ $parentCategory->id }}" style="display:none;">
                @foreach($parentCategory->childCategories as $category)
                    <li class="list-group-item" data-id="{{ $category->id }}">
                        <i class="fa fa-arrow-right"></i>
                        <a href="{{ route('admin.category', [$parentCategory, $category]) }}" class="font-weight-bolder">
                            {{ $category->name }} ({{ $category->products_count }})
                        </a>
                    </li>

                    {{-- @if($category->childCategories->count())
                        <div class="list-third-level" data-id="{{ $category->id }}" style="display:none;">
                            @foreach($category->childCategories as $childCategory)
                                <a class="list-group-item{{ $loop->last ? ' mb-1' : '' }}" data-id="{{ $childCategory->id }}" href="{{ route('admin.category', [$parentCategory, $category, $childCategory->name]) }}">
                                    {{ $childCategory->name }} ({{ $childCategory->products_count }})
                                </a>
                            @endforeach
                        </div>
                    @endif --}}
                @endforeach
            </div>
        @endif
    @endforeach
</ul>
