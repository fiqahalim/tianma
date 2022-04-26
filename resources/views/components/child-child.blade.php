{{-- Level 8 --}}
@if($childUser->childUsers->count())
    @foreach($childUser->childUsers as $childUser)
        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
            <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
            </option>
        @endif

        {{-- Level 9 --}}
        @if($childUser->childUsers->count())
            @foreach($childUser->childUsers as $childUser)
                @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                    <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                    </option>
                @endif

                {{-- Level 10 --}}
                @if($childUser->childUsers->count())
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                            </option>
                        @endif

                        {{-- Level 11 --}}
                        @if($childUser->childUsers->count())
                            @foreach($childUser->childUsers as $childUser)
                                @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                    <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                    </option>
                                @endif

                                {{-- Level 12 --}}
                                @if($childUser->childUsers->count())
                                    @foreach($childUser->childUsers as $childUser)
                                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                            <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                            </option>
                                        @endif

                                        {{-- Level 13 --}}
                                        @if($childUser->childUsers->count())
                                            @foreach($childUser->childUsers as $childUser)
                                                @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                    <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                                    </option>
                                                @endif

                                                {{-- Level 14 --}}
                                                @if($childUser->childUsers->count())
                                                    @foreach($childUser->childUsers as $childUser)
                                                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                            <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                                            </option>
                                                        @endif

                                                        {{-- Level 15 and ups --}}
                                                        @include('components.childs')
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endif
    @endforeach
@endif
