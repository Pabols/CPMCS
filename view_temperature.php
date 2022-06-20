<?php include_once('layouts/header.php'); ?>
<?php include_once('layouts/top-navigation.php'); ?>
<?php include_once('layouts/main-navigation.php'); ?>
<!-- Main content -->
<div class="content-wrapper">

    <!-- Main navbar -->
    <div class="navbar navbar-expand-lg navbar-light navbar-static">
        <div class="d-flex flex-1 d-lg-none">
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-transmission"></i>
            </button>
        </div>

        <div class="d-flex justify-content-end align-items-center flex-1 flex-lg-0 order-1 order-lg-2">

        </div>
    </div>
    <!-- /main navbar -->


    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content d-sm-flex">
            <div class="page-title">
                <h4><span class="font-weight-semibold text-uppercase">Temperature of <?=get_name($_GET['accounts_id'])?>
                    </span></h4>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">
        <!-- Form layouts -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="fullcalendar-basic"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /form layouts -->

    </div>
    <!-- /content area -->
    <?php include_once('layouts/footer.php'); ?>
    <?php include_once('layouts/scripts.php'); ?>
    <script>
    /* ------------------------------------------------------------------------------
     *
     *  # Fullcalendar basic options
     *
     *  Demo JS code for extra_fullcalendar_views.html and extra_fullcalendar_styling.html pages
     *
     * ---------------------------------------------------------------------------- */


    // Setup module
    // ------------------------------

    const FullCalendarBasic = function() {


        //
        // Setup module components
        //

        // Basic calendar
        const _componentFullCalendarBasic = function() {
            if (typeof FullCalendar == 'undefined') {
                console.warn('Warning - Fullcalendar files are not loaded.');
                return;
            }

            // Add demo events
            // ------------------------------

            // Default events
            const events = [
                <?php foreach(get_temperatures($_GET['accounts_id']) as $row): ?> {
                    title: '<?=$row['temperature']?> °C',
                    start: '<?=date('Y-m-d',strtotime($row['date']))?>'
                },
                <?php endforeach; ?>
            ];



            // Initialization
            // ------------------------------

            //
            // Basic view
            //

            // Define element
            const calendarBasicViewElement = document.querySelector('.fullcalendar-basic');

            // Initialize
            if (calendarBasicViewElement) {
                const calendarBasicViewInit = new FullCalendar.Calendar(calendarBasicViewElement, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth'
                    },
                    nowIndicator: true,
                    events: events
                });

                // Init
                calendarBasicViewInit.render();

                // Resize calendar when sidebar toggler is clicked
                $('.sidebar-control').on('click', function() {
                    calendarBasicViewInit.updateSize();
                });
            }


            //
            // Agenda view
            //

            // Define element
            const calendarAgendaViewElement = document.querySelector('.fullcalendar-agenda');

            // Initialize
            if (calendarAgendaViewElement) {
                const calendarAgendaViewInit = new FullCalendar.Calendar(calendarAgendaViewElement, {
                    initialDate: '2020-09-12',
                    initialView: 'timeGridWeek',
                    nowIndicator: true,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'timeGridWeek,timeGridDay'
                    },
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    selectable: true,
                    selectMirror: true,
                    dayMaxEvents: true, // allow "more" link when too many events
                    direction: document.dir == 'rtl' ? 'rtl' : 'ltr',
                    events: events
                });

                // Init
                calendarAgendaViewInit.render();

                // Resize calendar when sidebar toggler is clicked
                $('.sidebar-control').on('click', function() {
                    calendarAgendaViewInit.updateSize();
                });
            }


            //
            // List view
            //

            // Define element
            const calendarListViewElement = document.querySelector('.fullcalendar-list');

            // Initialize
            if (calendarListViewElement) {
                const calendarListViewInit = new FullCalendar.Calendar(calendarListViewElement, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'listDay,listWeek,listMonth'
                    },

                    // Customize the button names,
                    // otherwise they'd all just say "list"
                    views: {
                        listDay: {
                            buttonText: 'Day'
                        },
                        listWeek: {
                            buttonText: 'Week'
                        },
                        listMonth: {
                            buttonText: 'Month'
                        }
                    },
                    initialView: 'listWeek',
                    initialDate: '2020-09-12',
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    height: 'auto',
                    dayMaxEvents: true, // allow "more" link when too many events
                    direction: document.dir == 'rtl' ? 'rtl' : 'ltr',
                    events: events
                });

                // Init
                calendarListViewInit.render();

                // Resize calendar when sidebar toggler is clicked
                $('.sidebar-control').on('click', function() {
                    calendarListViewInit.updateSize();
                });
            }
        };


        //
        // Return objects assigned to module
        //

        return {
            init: function() {
                _componentFullCalendarBasic();
            }
        }
    }();


    // Initialize module
    // ------------------------------

    document.addEventListener('DOMContentLoaded', function() {
        FullCalendarBasic.init();
    });
    </script>