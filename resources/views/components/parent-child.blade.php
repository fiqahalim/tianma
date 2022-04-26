@foreach($users as $user)
{{-- Level 1 --}}
    @if($user->approved == 1 && (!is_null($user->agent_code)))
        <option value="{{ $user->id }}" {{ old('parent_id') == $user->id ? 'selected' : '' }}>{{ $user->agent_code }}</option>
    @endif

    {{-- Level 2 --}}
    @if($user->childUsers->count())
        @foreach($user->childUsers as $childUser)
            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                </option>
            @endif

            {{-- Level 3 --}}
            @if($childUser->childUsers->count())
                @foreach($childUser->childUsers as $childUser)
                    @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                        <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                        </option>
                    @endif

                    {{-- Level 4 --}}
                    @if($childUser->childUsers->count())
                        @foreach($childUser->childUsers as $childUser)
                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                </option>
                            @endif

                            {{-- Level 5 --}}
                            @if($childUser->childUsers->count())
                                @foreach($childUser->childUsers as $childUser)
                                    @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                        <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                        </option>
                                    @endif

                                    {{-- Level 6 --}}
                                    @if($childUser->childUsers->count())
                                        @foreach($childUser->childUsers as $childUser)
                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                                </option>
                                            @endif

                                            {{-- Level 7 --}}
                                            @if($childUser->childUsers->count())
                                                @foreach($childUser->childUsers as $childUser)
                                                    @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                        <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                                        </option>
                                                    @endif

                                                    {{-- Level 8 and ups --}}
                                                    @include('components.child-child')
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
