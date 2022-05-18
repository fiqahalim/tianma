<ol>
    @foreach($childUser->childUsers as $childUser)
    @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
    <li class="child-menu5">
        <div>
            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
            </span>
            <div class="mt-2">
                <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                    {{ $childUser->agent_code }}
                </span>
            </div>
            {{-- <i id="child-item6" class="fas fa-plus-circle"></i> --}}
        </div>

        {{-- Sub level 6 of child --}}
        <ol>
            @foreach($childUser->childUsers as $childUser)
            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
            <li class="child-menu6">
                <div>
                    <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
            </span>
                    <div class="mt-2">
                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                            {{ $childUser->agent_code }}
                        </span>
                    </div>
                    {{-- <i id="child-item7" class="fas fa-plus-circle"></i> --}}
                </div>

                {{-- Sub level 7 --}}
                <ol>
                    @foreach($childUser->childUsers as $childUser)
                    @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                    <li class="child-menu7">
                        <div>
                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                            </span>
                            <div class="mt-2">
                                <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                    {{ $childUser->agent_code }}
                                </span>
                            </div>
                            {{-- <i id="child-item8" class="fas fa-plus-circle"></i> --}}
                        </div>

                        {{-- Sub level 8 --}}
                        <ol>
                            @foreach($childUser->childUsers as $childUser)
                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li class="child-menu8">
                                <div>
                                    <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                    </span>
                                    <div class="mt-2">
                                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                            {{ $childUser->agent_code }}
                                        </span>
                                    </div>
                                    {{-- <i id="child-item9" class="fas fa-plus-circle"></i> --}}
                                </div>

                                {{-- Sub level 9 --}}
                                <ol>
                                    @foreach($childUser->childUsers as $childUser)
                                    @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                    <li class="child-menu9">
                                        <div>
                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                                <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                            </span>
                                            <div class="mt-2">
                                                <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                                    {{ $childUser->agent_code }}
                                                </span>
                                            </div>
                                            {{-- <i id="child-item10" class="fas fa-plus-circle"></i> --}}
                                        </div>

                                        {{-- Sub level 10 --}}
                                        <ol>
                                            @foreach($childUser->childUsers as $childUser)
                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                            <li class="child-menu10">
                                                <div>
                                                    <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                                    </span>
                                                    <div class="mt-2">
                                                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                                            {{ $childUser->agent_code }}
                                                        </span>
                                                    </div>
                                                    {{-- <i id="child-item11" class="fas fa-plus-circle"></i> --}}
                                                </div>

                                                {{-- Sub level 11 --}}
                                                <ol>
                                                    @foreach($childUser->childUsers as $childUser)
                                                    @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                    <li class="child-menu11">
                                                        <div>
                                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                                                <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                                            </span>
                                                            <div class="mt-2">
                                                                <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                                                    {{ $childUser->agent_code }}
                                                                </span>
                                                            </div>
                                                            {{-- <i id="child-item12" class="fas fa-plus-circle"></i> --}}
                                                        </div>

                                                        {{-- Sub level 12 --}}
                                                        <ol>
                                                            @foreach($childUser->childUsers as $childUser)
                                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                            <li class="child-menu12">
                                                                <div>
                                                                    <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="25" height="25">
                                                                    </span>
                                                                    <div class="mt-2">
                                                                        <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Agent Name: {{ $childUser->name }}, Agency Code: {{ $childUser->agency_code ? $childUser->agency_code : 'Not Available Yet' }}, Total Sales: RM{{ $totalComms }}, Ranking: {{ $childUser->rankings->category }}">
                                                                            {{ $childUser->agent_code }}
                                                                        </span>
                                                                    </div>
                                                                    {{-- <i id="child-item13" class="fas fa-plus-circle"></i> --}}
                                                                </div>
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
            @endif
            @endforeach
        </ol>
    </li>
    @endif
    @endforeach
</ol>
