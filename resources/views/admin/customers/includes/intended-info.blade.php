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
                        {{ trans('cruds.customer.fields.id_number') }}
                    </th>
                    <th>
                        Relationships
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($contactPerson->contactPersons as $cp)
                    <tr data-entry-id="{{ $cp->id }}">
                        <td>
                            {{ $cp->cperson_name ?? 'No Information Available' }}
                        </td>
                        <td>
                            {{ $cp->cid_number ?? '' }}
                        </td>
                        <td>
                            {{ $cp->relationships ?? ''}}
                        </td>
                    </tr>
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
