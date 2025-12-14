<x-app>
    <x-slot:title>Manajemen Admin</x-slot:title>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Manajemen Admin</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th style="width:20px">No</th>

                                    <th>Name</th>
                                    <th>Email</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($users as $item) --}}
                                    <tr>
                                        <td>ee</td>
                                        <td>ee</td>
                                        <td>ee</td>
                                    </tr>
                                {{-- @endforeach --}}
                            </tbody>

                        </table>
                    </div>
                </div>
                <!-- end cardaa -->
            </div> <!-- end col -->
        </div>
    </div>


</x-app>
