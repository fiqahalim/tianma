<h5 class="my-3">INTENDED USER INFORMATION</h5>
<div class="form-row">
    @if(isset($corAddr))
    @forelse($corAddr as $v => $contactPerson)
    @forelse($contactPerson->contactPersons as $cp)
    <div class="form-group col-md-4">
        <label for="cperson_name">{{ trans('cruds.customer.fields.full_name') }}</label>
        <input class="form-control" id="cperson_name" type="name" value="{{ old('cperson_name', $cp->cperson_name) }}" readonly>
    </div>
    <div class="form-group col-md-4">
        <label for="cid_number">{{ trans('cruds.customer.fields.id_number') }}</label>
        <input class="form-control" id="cid_number" type="text" value="{{ old('cid_number', $cp->cid_number) }}" readonly>
    </div>
    <div class="form-group col-md-4">
        <label for="relationships">Relationships</label>
        <input class="form-control" id="relationships" type="text" value="{{ old('relationships', $cp->relationships) }}" readonly>
    </div>
    @empty
    <div class="form-group col-md-4">
        <span>
            <i>No information available</i>
        </span>
    </div>
    @endforelse
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
