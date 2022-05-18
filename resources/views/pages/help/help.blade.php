@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li aria-current="page" class="breadcrumb-item active">
            {{ trans('global.helps') }}
        </li>
    </ol>
</nav>

@can('admin_only')
    <div class="content">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne" data-target="#collapseOne" data-toggle="collapse">
                    <h2 class="mb-0">
                        <button aria-controls="collapseOne" aria-expanded="false" class="btn" data-target="#collapseOne" data-toggle="collapse" type="button">
                            <strong>How To Import or Export Products Files?</strong>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="headingOne" class="collapse" data-parent="#accordionExample" id="collapseOne">
                    <div class="card-body">
                        <ol>
                            <strong>
                                <li>Export/Download Files</li>
                            </strong>
                            <p class="mt-2">
                                This example to show how to export or download your preferable files. Go to <b><em>Product Management > Products</em></b>. You should able to view the product table. On the top table columns, there are a few selection types you might see <em>(e.g.: Copy, CSV, Excel, PDF or Print)</em>.
                            </p>
                            <p class="mb-3 mt-3">
                                <img src="/images/help/product_help_one.png" class="img-fluid img-thumbnail mx-auto d-block">
                            </p>
                            <p class="mt-2">
                                Beside the selection type, you can see there are two (2) button which is <b><em>Select all</em></b> and <b><em>Deselect all</em></b>. The <b><em>"Select all"</em></b> button allow you to select all existing data to be downloaded. Optional, you can also choose only selected data you want by clicking the checkbox button besides <em>ID column</em>.
                            </p>
                            <p class="mt-2 mb-5">
                                Once you have clicked any of the selection types, it will automatically download the files with exisiting information for you.
                            </p>
                            <strong>
                                <li>Export/Download Files</li>
                            </strong>
                            <p class="mt-2">
                                This example to show how to import Excel file to your Products menu. This is the fastest ways instead of create one by one product. Firstly, go to <b><em>Product Management > Products</em></b>, you should able to view the product table. On the top table, there are two (2) buttons which is <b><em>"Add Product"</em></b> and <b><em>"Excel Import"</em></b>.<br>
                                <ul>
                                    <li>
                                        <b>Add Product</b>: Create a new product, <em>(allow you to create one product at one time)</em>
                                    </li>
                                    <li>
                                        <b>Excel Import</b>: Allow you to import bulk data using excel format file
                                    </li>
                                </ul>
                            </p>
                            <p class="mt-2">
                                To import Excel file, you need to click the <b><em>"Excel Import"</em></b> button. Once, you clicked the button, it should prompt message to upload your preferrable file <i>(only one file to uploaded)</i>. <b>You need to make sure the box was ticked for file contains header row</b>. After you have done choose file, you can proceed by clicked the <b>"Import Excel"</b>. Refer example below:
                            </p>
                            <p class="mb-3 mt-3">
                                <img src="/images/help/product_help.png" class="img-fluid img-thumbnail mx-auto d-block">
                                <img src="/images/help/product_export.png" class="img-fluid img-thumbnail mx-auto d-block mt-3">
                            </p>
                            <p class="mt-2">
                                By now, you should able to see all the data you have imported.
                            </p>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo" data-target="#collapseTwo" data-toggle="collapse">
                    <h2 class="mb-0">
                        <button aria-controls="collapseTwo" aria-expanded="false" class="btn collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button">
                            <strong>How To View Agent's Hierarchy?</strong>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionExample" id="collapseTwo">
                    <div class="card-body">
                        <p class="mt-2">
                            This example to show how to view agent's hierarchy. Go to <b><em>User Management > Hierarchy</em></b>.
                        </p>
                        <p class="mb-3 mt-3">
                            <img src="/images/help/user_hierarchy.png" class="img-fluid img-thumbnail mx-auto d-block mt-3">
                        </p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree" data-target="#collapseThree" data-toggle="collapse">
                    <h2 class="mb-0">
                        <button aria-controls="collapseThree" aria-expanded="false" class="btn collapsed" data-target="#collapseThree" data-toggle="collapse" type="button">
                            <strong>How To Update Installment Payment?</strong>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordionExample" id="collapseThree">
                    <div class="card-body">
                        Coming soon...
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="content">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne" data-target="#collapseOne" data-toggle="collapse">
                    <h2 class="mb-0">
                        <button aria-controls="collapseOne" aria-expanded="false" class="btn" data-target="#collapseOne" data-toggle="collapse" type="button">
                            <strong>Collapse Group Item #1</strong>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="headingOne" class="collapse" data-parent="#accordionExample" id="collapseOne">
                    <div class="card-body">
                        Coming soon...
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo" data-target="#collapseTwo" data-toggle="collapse">
                    <h2 class="mb-0">
                        <button aria-controls="collapseTwo" aria-expanded="false" class="btn collapsed" data-target="#collapseTwo" data-toggle="collapse" type="button">
                            <strong>Collapsible Group Item #2</strong>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionExample" id="collapseTwo">
                    <div class="card-body">
                        Coming soon...
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree" data-target="#collapseThree" data-toggle="collapse">
                    <h2 class="mb-0">
                        <button aria-controls="collapseThree" aria-expanded="false" class="btn collapsed" data-target="#collapseThree" data-toggle="collapse" type="button">
                            <strong>Collapsible Group Item #3</strong>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </button>
                    </h2>
                </div>
                <div aria-labelledby="headingThree" class="collapse" data-parent="#accordionExample" id="collapseThree">
                    <div class="card-body">
                        Coming soon...
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan
@endsection

@section('scripts')
@parent
@endsection
