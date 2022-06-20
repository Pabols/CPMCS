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
                <h4><span class="font-weight-semibold">Dashboard</span></h4>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0">
        <!-- Form layouts -->
        <div class="row">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    

                    <div class="col-md-3">
                        <div class="card card-body ">
                            <div class="media">
                                <div class="mr-3 align-self-center" id="c-count-header">
                                    <i class="icon-users icon-3x"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=user_counting(1)?></h3>
                                    <span class="text-uppercase text-whitefont-size-sm ">Student</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-body ">
                            <div class="media">
                                <div class="mr-3 align-self-center" id="c-count-header">
                                    <i class="icon-users icon-3x"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=user_counting(2)?></h3>
                                    <span class="text-uppercase font-size-sm">Teacher</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-body ">
                            <div class="media">
                                <div class="mr-3 align-self-center" id="c-count-header">
                                    <i class="icon-users icon-3x"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=user_counting(3)?></h3>
                                    <span class="text-uppercase font-size-sm">Staff</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-body ">
                            <div class="media">
                                <div class="mr-3 align-self-center" id="c-count-header">
                                    <i class="icon-users icon-3x"></i>
                                </div>

                                <div class="media-body text-right">
                                    <h3 class="font-weight-semibold mb-0"><?=user_counting(4)?></h3>
                                    <span class="text-uppercase font-size-sm">Visitor</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 ">

                <!-- Horizontal form -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">
                            <div class="row justify-content-center">
                            <div class="col-md-1 bg bg-primary text-white text-uppercase">Student</div>
                            <div class="col-md-1 bg bg-success text-white text-uppercase">Teacher</div>
                            <div class="col-md-1 bg bg-warning text-white text-uppercase">Staff</div>
                            <div class="col-md-1 bg bg-danger text-white text-uppercase">Visitor</div>
                            </div>
                        </h5>
                    </div>
                    
                    <div class="card-body">
                        <div class="fullcalendar-basic"></div>
                    </div>
                </div>
                <!-- /horizotal form -->
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
                <?php foreach(get_all_temperatures() as $row): ?> {
                    title: '<?=$row['temperature']?>°C <?=get_name(encode($row['accounts_id']))?>',
                    start: '<?=date('Y-m-d',strtotime($row['date']))?>',
                    color: '<?=get_color(encode($row['accounts_id']))?>'
                    
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
                    nowIndicator: true,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth'
                    },
                    nowIndicator: true,
                    dayMaxEvents: true, // allow "more" link when too many events
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
                    events: events,
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