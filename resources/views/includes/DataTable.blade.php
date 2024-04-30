<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.flash.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

    <style>
        /* DataTable Styling */
        .dataTables_wrapper {
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .dataTables_length label {
            font-size: 0.875rem;
            color: #4B5563;
            font-weight: normal;
            margin-bottom: 0;
        }

        .dataTables_length select {
            height: 36px;
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #D1D5DB;
            background-color: #F3F4F6;
            color: #4B5563;
            min-width: 100px;
            /* Adjust width as needed */
        }

        .dataTables_filter label {
            font-size: 0.875rem;
            color: #4B5563;
            font-weight: normal;
            margin-bottom: 0;
        }

        .dataTables_filter input[type="search"] {
            height: 36px;
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #D1D5DB;
            background-color: #F3F4F6;
            color: #4B5563;
        }

        .dataTables_info {
            font-size: 0.875rem;
            color: #4B5563;
        }

        .dataTables_paginate {
            font-size: 0.875rem;
            color: #4B5563;
        }

        /* DataTable Buttons Styling */
        .buttons-collection {
            margin-top: 0.75rem;
        }

        .buttons-collection .dt-buttons {
            display: flex;
            flex-wrap: wrap;
        }

        .buttons-collection .dt-buttons button {
            background-color: #4F46E5 !important;
            border-radius: 0.375rem !important;
            border: none !important;
            color: #FFFFFF !important;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            padding: 0.5rem 1rem !important;
            font-size: 0.875rem !important;
            transition: background-color 0.3s ease;
        }

        .buttons-collection .dt-buttons button:hover {
            background-color: #4338CA !important;
            color: #FFFFFF !important;
        }

        /* Responsive DataTable Styling */
        @media (max-width: 768px) {

            .dataTables_length label,
            .dataTables_filter label {
                font-size: 0.75rem;
            }

            .dataTables_length select,
            .dataTables_filter input[type="search"] {
                height: 32px !important;
                padding: 0.25rem !important;
                font-size: 0.75rem !important;
            }

            .buttons-collection .dt-buttons button {
                font-size: 0.75rem !important;
            }
        }

        /* Table Header Styling */
        #DataTable thead th {
            background-color: #F3F4F6 !important;
            border-bottom: 2px solid #D1D5DB !important;
            color: #4B5563 !important;
            font-weight: bold !important;
            text-align: left !important;
            border-top-left-radius: 0.5rem !important;
            border-top-right-radius: 0.5rem !important;
        }

        /* Table Row Styling */
        #DataTable tbody td {
            background-color: #FFFFFF !important;
            border-bottom: 1px solid #D1D5DB !important;
            color: #4B5563 !important;
            padding: 1rem !important;
        }

        /* Odd Row Background */
        #DataTable tbody tr:nth-child(odd) {
            background-color: #F3F4F6 !important;
        }

        /* Even Row Background */
        #DataTable tbody tr:nth-child(even) {
            background-color: #FFFFFF !important;
        }

        /* Hover Effect on Rows */
        #DataTable tbody tr:hover {
            background-color: #E5E7EB !important;
        }

        /* Remove border-bottom from the last row */
        #DataTable tbody tr:last-child td {
            border-bottom: none !important;
        }

        /* Button color change */
        .buttons-collection .dt-buttons button {
            background-color: #5877a1 !important;
        }

        .buttons-collection .dt-buttons button:hover {
            background-color: #4F46E5 !important;
        }
    </style>
</head>

<script>
    $(document).ready(function() {
        var table = $('#DataTable').DataTable({
            responsive: true,
            dom: '<"datatable-header"Blf>rt<"datatable-footer"ip>',
            buttons: [{
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    className: 'text-white py-2 px-4 rounded-md mr-2',
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'text-white py-2 px-4 rounded-md mr-2',
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'text-white py-2 px-4 rounded-md mr-2',
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    className: 'text-white py-2 px-4 rounded-md mr-2',
                }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    previous: '<i class="fas fa-angle-left"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>'
                }
            }
        });
    });
</script>
