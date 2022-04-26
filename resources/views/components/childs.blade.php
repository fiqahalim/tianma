 {{-- Level 15 --}}
 @if($childUser->childUsers->count())
     @foreach($childUser->childUsers as $childUser)
         @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
             <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
             </option>
         @endif

         {{-- Level 16 --}}
         @if($childUser->childUsers->count())
            @foreach($childUser->childUsers as $childUser)
                 @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                    <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                    </option>
                @endif

                {{-- Level 17 --}}
                @if($childUser->childUsers->count())
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                            </option>
                        @endif

                        {{-- Level 18 --}}
                        @if($childUser->childUsers->count())
                            @foreach($childUser->childUsers as $childUser)
                                @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                    <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                    </option>
                                @endif

                                {{-- Level 19 --}}
                                @if($childUser->childUsers->count())
                                    @foreach($childUser->childUsers as $childUser)
                                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                            <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                            </option>
                                        @endif

                                        {{-- Level 20 --}}
                                        @if($childUser->childUsers->count())
                                            @foreach($childUser->childUsers as $childUser)
                                                @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                    <option value="{{ $childUser->id }}" {{ old('parent_id') == $childUser->id ? 'selected' : '' }}>{{ $childUser->agent_code }}
                                                    </option>
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
