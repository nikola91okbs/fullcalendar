<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<div id="calendar"></div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

            {{-- boostrap modal library --}}
            {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            {{-- fullcalendar.io required libraries --}}
            <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
            <script>
                //  submit modal on Enter
                $('#createModal').keydown(function(e){
                   if(e.keyCode == 13){
                     $('#event_create').click();
                   }
                });

                // modal functions
                $(document).ready(function() {
                    let searchParams = new URLSearchParams(window.location.search);

                    var token = '';
                    if (searchParams.has('token')) {
                        token = searchParams.get('token');
                    }

                    // page is now ready, initialize the calendar...
                    $('#calendar').fullCalendar({
                        // put your options and callbacks here
                        selectable: true,
                        editable: true,
                        defaultView: 'month',
                        firstDay: 1,
                        displayEventTime: false,
                        events : [
                            @foreach($events as $event)
                            {
                                title : '{{ $event->description }}',
                                allday : true,
                                start : '{{ $event->date }}',
                            },
                            @endforeach
                        ],
                        //  on selecting the date, show the window for edit
                        select: function (info) {
                            // alert(info);
                            //  fetch event
                            $('#delete').hide();
                            $('#description').val('');
                            $('#date').val(info);
                            $('#event_create').val('Create');

                            info = moment(info).format('YYYY-MM-DD');

                            $.ajax({type: "POST", beforeSend: function(request) { request.setRequestHeader("Authorization", "Bearer " + token); }, url: '/api/fetchEvent/' + info, success: function( result ) {
                                if (result) {
                                    $('#description').val(result);
                                    $('#event_create').val('Update');
                                    $('#delete').show();
                                }
                            }});


                            $('#date').val(info);
                            $('#createModal').modal();

                            $('#createModal').on('shown.bs.modal', function () {
                                $('#description').focus();
                            })  
                        }
                    });

                    //  event on the submit of the edit
                    $('#event_create').click(function(e) {
                        e.preventDefault();
                        var data = {
                            description: $('#description').val(),
                            date: $('#date').val(),
                        };

                        $.ajax({type: "POST", beforeSend: function(request) { request.setRequestHeader("Authorization", "Bearer " + token); }, url: '/api/ajaxUpdate', data: data, processData: true, success: function( result ) {
                            refreshTheCalendar();
                        }});
                    });

                    //  event on the delete button
                    $('#delete').click(function(e) {
                        e.preventDefault();

                        $.ajax({type: "POST", beforeSend: function(request) { request.setRequestHeader("Authorization", "Bearer " + token); }, url: '/api/deleteEvent/' + $('#date').val(), success: function( result ) {
                            refreshTheCalendar();
                        }});
                    });

                    //  refresh the calendar
                    function refreshTheCalendar() {
                        // window.location.href = '/home?token=' + token;

                        $.ajax({url: '/calendar', method: 'GET', beforeSend: function (request) {
                            request.setRequestHeader("Authorization", "Bearer " + token);
                        },
                        success: function (result) {
                            //  hide the window for edit
                            $('#createModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            //  re-load the calenar
                            $('#calendar1').html(result);
                        }});
                    }
                });
            </script>