<h5 class="my-3 mt-4">EMERGENCY CONTACT INFORMATION</h5>
<div class="form-row">
    @if(isset($corAddr))
    @forelse($corAddr as $v => $contactPerson)
        <table class="table table-bordered table-sm text-center">
            <thead>
                <tr class="table-light">
                    <th>
                        Name
                    </th>
                    <th>
                        Contact Number
                    </th>
                    <th>
                        Relationships
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($contactPerson->contactPersons as $cp)
                @if($cp->cperson_name > 0)
                    <tr data-entry-id="{{ $cp->id }}">
                        <td>
                            {{ $cp->cperson_name }}
                        </td>
                        <td>
                            {{ $cp->cperson_no }}
                        </td>
                        <td>
                            {{ $cp->relationships }}
                        </td>
                    </tr>
                @endif
                @empty
                @endforelse
            </tbody>
        </table>
    @empty
        <div class="form-group col-md-4">
            <span>
                <i>No information available</i>
            </span>
        </div>
    @endforelse
    @endif
</div>
<hr>
