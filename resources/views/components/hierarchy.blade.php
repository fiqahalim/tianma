<button type="button" id="child-item1" class="btn btn-outline-info btn-sm mb-3">Show All</button>
@if(count($user->childUsers))
    <ol>
        {{-- Childs --}}
        @foreach($user->childUsers as $childUser)
            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                <li class="sub-menu">
                    <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                    </span>
                    <div>
                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                            {{ $childUser->agent_code }}
                        </span>
                    </div>

                    {{-- Sub Level 1 of Childs --}}
                    @if(count($childUser->childUsers))
                        <ol class="child-menu1">
                            @foreach($childUser->childUsers as $childUser)
                                <li>
                                    <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                    </span>
                                    <div>
                                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                                            {{ $childUser->agent_code }}
                                        </span>
                                    </div>
                                    {{-- <i id="child-item2" class="fas fa-plus-circle"></i> --}}

                                    {{-- Sub Level 2 of Childs --}}
                                    <ol>
                                        @foreach($childUser->childUsers as $childUser)
                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                <li class="child-menu2">
                                                    <div>
                                                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                                                            <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                                        </span>
                                                        <div class="mt-2">
                                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                                                                {{ $childUser->agent_code }}
                                                            </span>
                                                        </div>
                                                        {{-- <i id="child-item3" class="fas fa-plus-circle"></i> --}}
                                                    </div>

                                                    {{-- Sub Level 3 of Childs --}}
                                                    <ol>
                                                        @foreach($childUser->childUsers as $childUser)
                                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                                <li class="child-menu3">
                                                                    <div>
                                                                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                                                                            <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                                                        </span>
                                                                        <div class="mt-2">
                                                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                                                                                {{ $childUser->agent_code }}
                                                                            </span>
                                                                        </div>
                                                                       {{--  <i id="child-item4" class="fas fa-plus-circle"></i> --}}
                                                                    </div>

                                                                    {{-- Sub Level 4 of Childs --}}
                                                                    <ol>
                                                                        @foreach($childUser->childUsers as $childUser)
                                                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                                                <li class="child-menu4">
                                                                                    <div>
                                                                                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                                                                                            <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                                                                        </span>
                                                                                        <div class="mt-2">
                                                                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totas }}, Ranking: {{ $childUser->rankings->category }}">
                                                                                                {{ $childUser->agent_code }}
                                                                                            </span>
                                                                                        </div>
                                                                                        {{-- <i id="child-item5" class="fas fa-plus-circle"></i> --}}
                                                                                    </div>

                                                                                    {{-- Sub Level 5 onwards --}}
                                                                                    @include('components.child-hierarchy')
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ol>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ol>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </li>
            @endif
        @endforeach
    </ol>
@endif
