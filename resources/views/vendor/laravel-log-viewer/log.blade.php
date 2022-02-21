<x-app-layout>
        <div class="flex">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                @if (!$logs)
                    <div>
                        Log file >50M, please download it.
                    </div>
                @else
                    <table id="table-log" class="bg-white min-w-full leading-normal" >
                        <thead>
                        <tr class="bg-gray-200 border-b-2 border-gray-300 text-left text-xs text-gray-600 uppercase ">
                        @if ($standardFormat)
                                <th scope="col" class="px-5 py-3">Level</th>
                                <th scope="col" class="px-5 py-3">Context</th>
                                <th scope="col" class="px-5 py-3">Date</th>
                            @else
                                <th scope="col" class="px-5 py-3">Line number</th>
                            @endif
                            <th scope="col" class="px-5 py-3">Content</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($logs as $key => $log)
                            <tr class="hover:bg-gray-200" data-display="stack{{{$key}}}">
                                @if ($standardFormat)
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm text-{{{$log['level_class']}}}">
                                        <span class="fa fa-{{{$log['level_img']}}}" aria-hidden="true"></span>&nbsp;&nbsp;{{$log['level']}}
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 text-sm">{{$log['context']}}</td>
                                @endif
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">{{{$log['date']}}}</td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    @if ($log['stack'])
                                        <button type="button"
                                                class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                                                data-display="stack{{{$key}}}">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    @endif
                                    {{{$log['text']}}}
                                    @if (isset($log['in_file']))
                                        <br/>{{{$log['in_file']}}}
                                    @endif
                                    @if ($log['stack'])
                                        <div class="stack" id="stack{{{$key}}}"
                                             style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @endif
                </div>
                <div class="p-3">
                    @if($current_file)
                        <a href="?dl={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                            <span class="fa fa-download"></span> Download file
                        </a>
                        -
                        <a id="clean-log" href="?clean={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                            <span class="fa fa-sync"></span> Clean file
                        </a>
                        -
                        <a id="delete-log" href="?del={{ \Illuminate\Support\Facades\Crypt::encrypt($current_file) }}{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                            <span class="fa fa-trash"></span> Delete file
                        </a>
                        @if(count($files) > 1)
                            -
                            <a id="delete-all-log" href="?delall=true{{ ($current_folder) ? '&f=' . \Illuminate\Support\Facades\Crypt::encrypt($current_folder) : '' }}">
                                <span class="fa fa-trash-alt"></span> Delete all files
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    <!-- jQuery for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- FontAwesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.table-container tr').on('click', function () {
                $('#' + $(this).data('display')).toggle();
            });
            $('#table-log').DataTable({
                "order": [$('#table-log').data('orderingIndex'), 'desc'],
                "stateSave": true,
                "stateSaveCallback": function (settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function (settings) {
                    let data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });
            $('#delete-log, #clean-log, #delete-all-log').click(function () {
                return confirm('Are you sure?');
            });
        });
    </script>
</x-app-layout>
