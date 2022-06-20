@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ trans('cruds.customer.title') }} Management</li>
        <li class="breadcrumb-item">{{ trans('cruds.customer.title') }}</li>
        <li class="breadcrumb-item active" aria-current="page">View Deceased Person</li>
    </ol>
</nav>

    <div style="margin-bottom: 10px;" class="row text-right">
        <div class="col-lg-12">
            <div class="page-tools">
                <div class="action-buttons">
                    {{-- <a class="btn btn-primary mx-1px text-95" href="#">
                        Tax Invoice
                    </a> --}}
                    <a class="btn bg-white btn-light mx-1px text-95 print-window" href="#" data-title="Print">
                        <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                        Print
                    </a>
                </div>
            </div>
        </div>
    </div>

<div class="card">
    <div class="card-header font-weight-bold">
        {{ trans('global.show') }} Deceased Person Information
    </div>

    <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                Sub Code
                            </th>
                            <td>
                                {{ $decease_person->id }}
                            </td>
                            <th>
                                Decease Name
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_name ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Ref No
                            </th>
                            <td>
                                {{ strtoupper($decease_person->ref_no ?? '') }}
                            </td>
                            <th>
                                Decease ID/Passport No.
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_id_number ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Bury Cert
                            </th>
                            <td>
                                {{ strtoupper($decease_person->bury_cert ?? '') }}
                            </td>
                            <th>
                                Decease Born Date
                            </th>
                            <td>
                                {{ $decease_person->birth_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Cremation Cert
                            </th>
                            <td>
                                {{ strtoupper($decease_person->cremation_cert ?? '') }}
                            </td>
                            <th>
                                Decease Chinese Name
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_chinese_name ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Casket
                            </th>
                            <td>
                                {{ strtoupper($decease_person->casket ?? '') }}
                            </td>
                            <th>
                                Decease Gender
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_gender ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                5 Grains Date and Time
                            </th>
                            <td>
                                {{ $decease_person->grain_date }}
                            </td>
                            <th>
                                Decease Religion
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_religion ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Decease National
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_national ?? '') }}
                            </td>
                            <th>
                                Decease Marital
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_maritial ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Bury/Exercise Date and Time
                            </th>
                            <td>
                                {{ $decease_person->bury_date }}
                            </td>
                            <th>
                                Decease Dialect
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_dialect ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Issue Address 1
                            </th>
                            <td>
                                {{ strtoupper($decease_person->issue_address_1 ?? '') }}
                            </td>
                            <th>
                                Death Chinese Birth
                            </th>
                            <td>
                                {{ $decease_person->chinese_birth_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Issue Address 2
                            </th>
                            <td>
                                {{ strtoupper($decease_person->issue_address_2 ?? '') }} {{ strtoupper($decease_person->issue_postcode ?? '') }} {{ strtoupper($decease_person->issue_city ?? '') }} {{ strtoupper($decease_person->issue_state ?? '') }} {{ strtoupper($decease_person->issue_country ?? '') }}
                            </td>
                            <th>
                                Decease Income
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_income) }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Funeral Address 1
                            </th>
                            <td>
                                {{ strtoupper($decease_person->funeral_address_1 ?? '') }}
                            </td>
                            <th>
                                Decease Occupation
                            </th>
                            <td>
                                {{ strtoupper($decease_person->decease_occupation) }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Funeral Address 2
                            </th>
                            <td>
                                {{ strtoupper($decease_person->funeral_address_2 ?? '') }} {{ strtoupper($decease_person->funeral_postcode ?? '') }} {{ strtoupper($decease_person->funeral_city ?? '') }} {{ strtoupper($decease_person->funeral_state ?? '') }} {{ strtoupper($decease_person->funeral_country ?? '') }}
                            </td>
                            <th>
                                Mailing Flag
                            </th>
                            <td>
                                {{ strtoupper($decease_person->miling_flag ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Bury Created By
                            </th>
                            <td>
                                {{ strtoupper($decease_person->created_by ?? '') }}
                            </td>
                            <th>
                                Open Niche
                            </th>
                            <td>
                                {{ strtoupper($decease_person->open_niche ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Bury Created On
                            </th>
                            <td>
                                {{ Carbon\Carbon::parse($decease_person->created_at)->format('d/m/Y H:i:s') }}
                            </td>
                            <th>
                                Undertaker
                            </th>
                            <td>
                                {{ strtoupper($decease_person->undertaker ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Remark
                            </th>
                            <td>
                                {{ strtoupper($decease_person->remark ?? '') }}
                            </td>
                            <th>
                                Lot ID
                            </th>
                            <td>
                                {{ json_encode($decease_person->lotID->seats ?? '') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Attachments</th>
                            <td>
                                @foreach($decease_person->document_file as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <th>
                                Decease Item Elements
                            </th>
                            <td>
                                {{ strtoupper($decease_person->item_elements->name ?? '') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.decease-people.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
</div>
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ mix('/css/pages/invoice.css') }}"  media="screen,projection"/>
    <link href="{{ mix('/css/pages/invoice.css') }}" rel="stylesheet" media="print" type="text/css">
@endsection

@section('scripts')
<script>
    $('.print-window').click(function() {
    window.print();
    });
</script>
@endsection
