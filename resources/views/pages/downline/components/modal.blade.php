<div aria-hidden="true" aria-labelledby="userDetailsModalTitle" class="modal fade" id="userDetailsModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalTitle">
                    My Details
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
                                    {{ trans('cruds.ranking.myRanking') }}
                                </th>
                                <td>
                                    {{ Auth::user()->ranking_id ?? 'Not Available' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.ref_name') }}
                                </th>
                                <td>
                                    {{ $parent[0]->agent_code ?? 'Not Available' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.team') }}
                                </th>
                                <td>
                                    {{ isset($team[0]) ? $team[0]->name : 'Not Available' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
