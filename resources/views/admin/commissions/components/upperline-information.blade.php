<table class="table table-light table-bordered">
    <thead>
        <tr class="table-primary">
            <th></th>
            <th>Commission Received Date</th>
            <th>Upperline Agent Ranking</th>
            <th>Upperline Agent Name</th>
            <th>Upperline Agent Code</th>
            <th>Upperline Agency Code</th>
            <th>Point Value (PV) Claimed</th>
            <th>Upperline Commission Percentage(%)</th>
            <th>Upperline First Month Commissions Received</th>
            <th>Upperline Commissions Received <i>(per Installment)</i></th>
            <th>Upperline Total Commission</th>
            <th>Upperline Monthly Spin Off Overriding</th>
        </tr>
    </thead>
    <tbody>
        {{-- 1st Parent --}}
        <tr>
            <td></td>
            <td>
                {{ strtoupper(Carbon\Carbon::parse($dates)->format('d/M/Y H:i:s')) }}
            </td>
            <td>
                @if($order->createdBy->parent->ranking_id == 1)
                SD
                @elseif($order->createdBy->parent->ranking_id == 2)
                DSD
                @elseif($order->createdBy->parent->ranking_id == 3)
                BDD A
                @elseif($order->createdBy->parent->ranking_id == 4)
                BDD B
                @else
                CBDD
                @endif
            </td>
            <td>{{ strtoupper($order->createdBy->parent->name) }}</td>
            <td>
                {{ strtoupper($order->createdBy->parent->agent_code) }}
            </td>
            <td>
                {{ strtoupper($order->createdBy->parent->agency_code ?? 'No Information') }}
            </td>
            <td>
                {{ strtoupper($order->commissions->balance_pv ?? '') }}
            </td>
            <td>
                @if($order->createdBy->parent->ranking_id == 1)
                16%
                @elseif($order->createdBy->parent->ranking_id == 2 && $order->createdBy->parent->ranking_id == 4)
                4%
                @elseif($order->createdBy->parent->ranking_id == 3)
                2%
                @else
                0.5%
                @endif
            </td>
            <td>
                RM{{ number_format($order->createdBy->parent->commissions->mo_overriding_comm ?? '') }}
            </td>
            <td>
                RM{{ number_format($order->createdBy->parent->commissions->mo_overriding_comm ?? '') }}
            </td>
            <td>
                RM{{ number_format($order->createdBy->parent->commissions()->sum('mo_overriding_comm') ?? '') }}
            </td>
            <td>
                RM{{ number_format($order->createdBy->parent->commissions->mo_spin_off ?? '0') }}
            </td>
        </tr>

        {{-- 2nd Parent --}}
        @if(isset($order->createdBy->parent->parent) && !empty($order->createdBy->parent->parent))
        <tr>
            <td></td>
            <td>
                {{ strtoupper(Carbon\Carbon::parse($order->commissions->created_at)->format('d/M/Y H:i:s')) }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->ranking_id == 1)
                SD
                @elseif($order->createdBy->parent->parent->ranking_id == 2)
                DSD
                @elseif($order->createdBy->parent->parent->ranking_id == 3)
                BDD A
                @elseif($order->createdBy->parent->parent->ranking_id == 4)
                BDD B
                @else
                CBDD
                @endif
                @endif
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->name) ? $order->createdBy->parent->parent->name : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->agent_code) ? $order->createdBy->parent->parent->agent_code : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->agency_code) ? $order->createdBy->parent->parent->agency_code : 'No Information') }}
            </td>
            <td>
                {{ number_format(isset($order->commissions->balance_pv) ? $order->commissions->balance_pv : '') }}
            </td>
            <td>
                @if($order->createdBy->parent->parent->ranking_id == 1)
                16%
                @elseif($order->createdBy->parent->parent->ranking_id == 2)
                4%
                @elseif($order->createdBy->parent->parent->ranking_id == 3)
                2%
                @elseif($order->createdBy->parent->parent->ranking_id == 4)
                4%
                @else
                0.5%
                @endif
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->commissions()->sum('mo_overriding_comm') : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->commissions->mo_spin_off) ? $order->createdBy->parent->parent->commissions->mo_spin_off : '0') }}
            </td>
        </tr>
        @endif

        {{-- 3rd Parent --}}
        @if(isset($order->createdBy->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent))
        <tr>
            <td></td>
            <td>
                {{ strtoupper(Carbon\Carbon::parse($order->commissions->created_at)->format('d/M/Y H:i:s')) }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->ranking_id == 1)
                SD
                @elseif($order->createdBy->parent->parent->parent->ranking_id == 2)
                DSD
                @elseif($order->createdBy->parent->parent->parent->ranking_id == 3)
                BDD A
                @elseif($order->createdBy->parent->parent->parent->ranking_id == 4)
                BDD B
                @else
                CBDD
                @endif
                @endif
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->name) ? $order->createdBy->parent->parent->parent->name : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->agent_code : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->agency_code : 'No Information') }}
            </td>
            <td>
                {{ number_format(isset($order->commissions->balance_pv) ? $order->commissions->balance_pv : '') }}
            </td>
            <td>
                @if($order->createdBy->parent->parent->parent->ranking_id == 1)
                16%
                @elseif($order->createdBy->parent->parent->parent->ranking_id == 2)
                4%
                @elseif($order->createdBy->parent->parent->parent->ranking_id == 3)
                2%
                @elseif($order->createdBy->parent->parent->parent->ranking_id == 4)
                4%
                @else
                0.5%
                @endif
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->commissions->mo_spin_off) ? $order->createdBy->parent->parent->parent->commissions->mo_spin_off : '0') }}
            </td>
        </tr>
        @endif

        {{-- 4th Parent --}}
        @if(isset($order->createdBy->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent))
        <tr>
            <td></td>
            <td>
                {{ strtoupper(Carbon\Carbon::parse($order->commissions->created_at)->format('d/M/Y H:i:s')) }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->ranking_id == 1)
                SD
                @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 2)
                DSD
                @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 3)
                BDD A
                @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 4)
                BDD B
                @else
                CBDD
                @endif
                @endif
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->name) ? $order->createdBy->parent->parent->parent->parent->name : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->agent_code : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->agency_code : 'No Information') }}
            </td>
            <td>
                {{ number_format(isset($order->commissions->balance_pv) ? $order->commissions->balance_pv : '') }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->ranking_id == 1)
                16%
                @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 2)
                4$
                @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 3)
                2%
                @elseif($order->createdBy->parent->parent->parent->parent->ranking_id == 4)
                4%
                @else
                0.5%
                @endif
                @endif
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->commissions->mo_spin_off) ? $order->createdBy->parent->parent->parent->parent->commissions->mo_spin_off : '0') }}
            </td>
        </tr>
        @endif

        {{-- 5th Parent --}}
        @if(isset($order->createdBy->parent->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent->parent))
        <tr>
            <td></td>
            <td>
                {{ strtoupper(Carbon\Carbon::parse($order->commissions->created_at)->format('d/M/Y H:i:s')) }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 1)
                SD
                @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 2)
                DSD
                @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 3)
                BDD A
                @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 4)
                BDD B
                @else
                CBDD
                @endif
                @endif
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->name) ? $order->createdBy->parent->parent->parent->parent->parent->name : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->parent->agent_code : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->parent->agency_code : 'No Information') }}
            </td>
            <td>
                {{ number_format(isset($order->commissions->balance_pv) ? $order->commissions->balance_pv : '') }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 1)
                16%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 2)
                4%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 3)
                2%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->ranking_id == 4)
                4%
                @else
                0.5%
                @endif
                @endif
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->commissions->mo_spin_off) ? $order->createdBy->parent->parent->parent->parent->parent->commissions->mo_spin_off : '0') }}
            </td>
        </tr>
        @endif

        {{-- 6th Parent --}}
        @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent->parent->parent))
        <tr>
            <td></td>
            <td>
                {{ strtoupper(Carbon\Carbon::parse($order->commissions->created_at)->format('d/M/Y H:i:s')) }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                SD
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                DSD
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                BDD A
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                BDD B
                @else
                CBDD
                @endif
                @endif
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->name) ? $order->createdBy->parent->parent->parent->parent->parent->parent->name : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->agent_code : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->agency_code : 'No Information') }}
            </td>
            <td>
                {{ number_format(isset($order->commissions->balance_pv) ? $order->commissions->balance_pv : '') }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                16%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                4%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                2%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                4%
                @else
                0.5%
                @endif
                @endif
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->commissions->mo_spin_off) ? $order->createdBy->parent->parent->parent->parent->parent->parent->commissions->mo_spin_off : '0') }}
            </td>
        </tr>
        @endif

        {{-- 7th Parent --}}
        @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent->parent->parent->parent))
        <tr>
            <td></td>
            <td>
                {{ strtoupper(Carbon\Carbon::parse($order->commissions->created_at)->format('d/M/Y H:i:s')) }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                SD
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                DSD
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                BDD A
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                BDD B
                @else
                CBDD
                @endif
                @endif
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->name) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->name : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->agent_code : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->agency_code : 'No Information') }}
            </td>
            <td>
                {{ number_format(isset($order->commissions->balance_pv) ? $order->commissions->balance_pv : '') }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                16%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                4%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                2%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                4%
                @else
                0.5%
                @endif
                @endif
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions->mo_spin_off) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->commissions->mo_spin_off : '0') }}
            </td>
        </tr>
        @endif

        {{-- 8th Parent --}}
        @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent) && !empty($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent))
        <tr>
            <td></td>
            <td>
                {{ strtoupper(Carbon\Carbon::parse($order->commissions->created_at)->format('d/M/Y H:i:s')) }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                SD
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                DSD
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                BDD A
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                BDD B
                @else
                CBDD
                @endif
                @endif
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->name) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->name : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->agent_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->agent_code : '') }}
            </td>
            <td>
                {{ strtoupper(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->agency_code) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->agency_code : 'No Information') }}
            </td>
            <td>
                {{ number_format(isset($order->commissions->balance_pv) ? $order->commissions->balance_pv : '') }}
            </td>
            <td>
                @if(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id))
                @if($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 1)
                16%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 2)
                4%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 3)
                2%
                @elseif($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->ranking_id == 4)
                4%
                @else
                0.5%
                @endif
                @endif
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions->mo_overriding_comm) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions()->sum('mo_overriding_comm') : '') }}
            </td>
            <td>
                RM{{ number_format(isset($order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions->mo_spin_off) ? $order->createdBy->parent->parent->parent->parent->parent->parent->parent->parent->commissions->mo_spin_off : '0') }}
            </td>
        </tr>
        @endif
    </tbody>
</table>
