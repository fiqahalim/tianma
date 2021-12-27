<tr data-entry-id="{{ $user->id }}">
    <td>
        
    </td>
    <td>
        {{ $user->id ?? '' }}
    </td>
    <td>
        {{ $user->name ?? '' }}
    </td>
    <td>
        {{ App\Models\User::ID_TYPE_SELECT[$user->id_type] ?? '' }}
    </td>
    <td>
        {{ $user->id_number ?? '' }}
    </td>
    <td>
        {{ $user->email ?? '' }}
    </td>
    <td>
        {{ $user->username ?? '' }}
    </td>
    <td>
        <span style="display:none">{{ $user->approved ?? '' }}</span>
        <input type="checkbox" disabled="disabled" {{ $user->approved ? 'checked' : '' }}>
    </td>
    <td>
        <span style="display:none">{{ $user->verified ?? '' }}</span>
        <input type="checkbox" disabled="disabled" {{ $user->verified ? 'checked' : '' }}>
    </td>
    <td>
        {{ $user->contact_no ?? '' }}
    </td>
    <td>
        {{ $user->agent_code ?? '' }}
    </td>
    <td>
        {{ $user->parent->name ?? '' }}
    </td>
    <td>
        @foreach($user->roles as $key => $item)
            <span class="badge badge-info">{{ $item->title }}</span>
        @endforeach
    </td>
    <td>
        @can('user_show')
            <a class="btn btn-xs btn-primary" href="{{ route('admin.users.show', $user->id) }}">
                {{ trans('global.view') }}
            </a>
        @endcan

        @can('user_edit')
            <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}">
                {{ trans('global.edit') }}
            </a>
        @endcan

        @can('user_delete')
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
            </form>
        @endcan
    </td>
</tr>
