@if(count($user->childUsers))
    <ol>
        {{-- Childs --}}
        @foreach($user->childUsers as $childUser)
            @php
                $totalComms = $childUser->commissions()->sum('mo_overriding_comm');
            @endphp
            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                <li class="sub-menu">
                    <div>
                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="60" height="60">
                        <div class="mt-2">
                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Name: {{ $childUser->name }}, Total Commission: {{ $totalComms }}">
                                {{ $childUser->agent_code }}
                            </span>
                        </div>
                        <i id="child-item1" class="fas fa-plus-circle"></i>
                    </div>

                    {{-- Sub Level 1 of Childs --}}
                    @if(count($childUser->childUsers))
                        <ol>
                            @foreach($childUser->childUsers as $childUser)
                                <li class="child-menu1">
                                    <div>
                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="60" height="60">
                                        <div class="mt-2">
                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Name: {{ $childUser->name }}, Total Commission: RM{{ $totalComms }}">
                                                {{ $childUser->agent_code }}
                                            </span>
                                        </div>
                                        <i id="child-item2" class="fas fa-plus-circle"></i>
                                    </div>

                                    {{-- Sub Level 2 of Childs --}}
                                    <ol>
                                        @foreach($childUser->childUsers as $childUser)
                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                <li class="child-menu2">
                                                    <div>
                                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="60" height="60">
                                                        <div class="mt-2">
                                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Name: {{ $childUser->name }}, Total Commission: RM{{ $totalComms }}">
                                                                {{ $childUser->agent_code }}
                                                            </span>
                                                        </div>
                                                        <i id="child-item3" class="fas fa-plus-circle"></i>
                                                    </div>

                                                    {{-- Sub Level 3 of Childs --}}
                                                    <ol>
                                                        @foreach($childUser->childUsers as $childUser)
                                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                                <li class="child-menu3">
                                                                    <div>
                                                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="60" height="60">
                                                                        <div class="mt-2">
                                                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Name: {{ $childUser->name }}, Total Commission: RM{{ $totalComms }}">
                                                                                {{ $childUser->agent_code }}
                                                                            </span>
                                                                        </div>
                                                                        <i id="child-item4" class="fas fa-plus-circle"></i>
                                                                    </div>

                                                                    {{-- Sub Level 4 of Childs --}}
                                                                    <ol>
                                                                        @foreach($childUser->childUsers as $childUser)
                                                                            @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                                                                                <li class="child-menu4">
                                                                                    <div>
                                                                                        <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="60" height="60">
                                                                                        <div class="mt-2">
                                                                                            <span aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Name: {{ $childUser->name }}, Total Commission: RM{{ $totalComms }}">
                                                                                                {{ $childUser->agent_code }}
                                                                                            </span>
                                                                                        </div>
                                                                                        <i id="child-item5" class="fas fa-plus-circle"></i>
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
