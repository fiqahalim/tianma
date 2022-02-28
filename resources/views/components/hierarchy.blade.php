<i id="menu-item" class="fas fa-plus-circle" onclick="myFunction()"></i>
@if(count($user->childUsers))
    {{-- Level 1 --}}
    <ul>
        @foreach($user->childUsers as $childUser)
            <li>
                <div class="sub-menu">
                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                    <div class="mt-2">
                        <span>{{ $childUser->agent_code }}</span>
                    </div>
                </div>

                {{-- Level 2 --}}
                @if(count($childUser->childUsers))
                <i id="child-item1" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu1">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu1 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 3 --}}
                @if(!empty($childUser) && count($childUser->childUsers))
                <i id="child-item2" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu2">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu2 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 4 --}}
                @if(!empty($childUser) && count($childUser->childUsers))
                <i id="child-item3" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu3">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu3 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 5 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item4" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu4">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu4 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 6 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item5" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu5">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu5 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 7 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item6" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu6">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu6 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 8 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item7" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu7">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu7 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 9 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item8" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu8">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu8 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 10 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item9" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu9">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu9 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 11 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item10" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu10">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu10 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 12 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item11" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu11">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu11 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 13 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item12" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu12">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu12 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 14 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item12" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu12">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu12 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif

                {{-- Level 15 --}}
                @if(!empty($childUser) && $childUser->childUsers->count())
                <i id="child-item12" class="fas fa-plus-circle"></i>
                <ul>
                    @foreach($childUser->childUsers as $childUser)
                        @if($childUser->approved == 1 && (!is_null($childUser->agent_code)))
                            <li>
                                <div class="child-menu12">
                                    <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$childUser->avatar) ?? '/images/avatar.png' }}" width="80">
                                    <div class="child-menu12 mt-2">
                                        <span>{{ $childUser->agent_code }}</span>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
                @endif
            </li>
        @endforeach
    </ul>
@endif
