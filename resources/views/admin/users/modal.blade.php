<div aria-hidden="true" aria-labelledby="userDetailsModalTitle" class="modal fade" id="userDetailsModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalTitle">
                    {{ $user->name }} Details
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">
                        ×
                    </span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.id') }}
                                </th>
                                <td>
                                    {{ $user->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.id_type') }}
                                </th>
                                <td>
                                    {{ App\Models\User::ID_TYPE_SELECT[$user->id_type] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.id_number') }}
                                </th>
                                <td>
                                    {{ $user->id_number }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.username') }}
                                </th>
                                <td>
                                    {{ $user->username }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.approved') }}
                                </th>
                                <td>
                                    <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.verified') }}
                                </th>
                                <td>
                                    <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.contact_no') }}
                                </th>
                                <td>
                                    {{ $user->contact_no }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.agent_code') }}
                                </th>
                                <td>
                                    {{ $user->agent_code }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.ref_name') }}
                                </th>
                                <td>
                                    {{ $user->parent->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.team') }}
                                </th>
                                <td>
                                    {{ $user->team->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.roles') }}
                                </th>
                                <td>
                                    @foreach($user->roles as $key => $roles)
                                        <span class="label label-info">{{ $roles->title }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
