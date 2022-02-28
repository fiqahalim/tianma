<i id="menu-item" class="fas fa-plus-circle" onclick="myFunction()"></i>
{{-- Level 1 --}}
@if(!empty($user) && count($user))
    <ul>
        <li>
            <div class="sub-menu">
                <img class="rounded-circle mt-2" src="{{ asset('/images/profile/' .$user) ?? '/images/avatar.png' }}" width="80">
                <div class="mt-2">
                    <span>{{ $user->agent_code }}</span>
                </div>
            </div>
        </li>
    </ul>
@endif
