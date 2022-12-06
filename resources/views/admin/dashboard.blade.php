@extends('admin.layouts.Admin-master')


@section('content')

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type ="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo(json_encode($goodmovie)); ?>);

        var options = {
          chart: {
            title: 'Top 10 Movie Good Review',
            
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {
        var data = google.visualization.arrayToDataTable(<?php echo(json_encode($badmovieshow)); ?>);

        var options = {
          chart: {
            title: 'Top 10 Movie Bad Review',
           
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material2'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {
        var data = google.visualization.arrayToDataTable(<?php echo(json_encode($topcommulist)); ?>);

        var options = {
          chart: {
            title: 'Top 6 Trending',
           
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material3'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
      
    
</script>

    
     <!-- Widgets  -->
     <div class="row">
        
        <div class="col-lg-4 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-2">
                            <i class="pe-7s-film"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count"> {{$allMovie}} </span></div>
                                <div class="stat-heading">Movie</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-3">
                            <i class="pe-7s-comment"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{$allComment}}</span></div>
                                <div class="stat-heading">Comment</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7s-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">{{$allUser}}</span></div>
                                <div class="stat-heading">Clients</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Widgets -->

    <!-- Calender Chart Weather  -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                
                <div class="card-body">
                    <!-- <h4 class="box-title">Chandler</h4> -->
                    
                        
                    <div id="barchart_material" style="height: 500px;width: 100%;"></div>
                    
                </div>
            </div><!-- /.card -->
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="card">
                
                <div class="card-body">
                    <!-- <h4 class="box-title">Chandler</h4> -->
                    <div id="barchart_material2" style="height: 500px;width: 100%;"></div>
                    
                </div>
            </div><!-- /.card -->
        </div>
        <div class="col-md-12 col-lg-12">
            <div class="card">
                
                <div class="card-body">
                    <!-- <h4 class="box-title">Chandler</h4> -->
                    <div id="barchart_material3" style="height: 500px;width: 100%;"></div>
                    
                </div>
            </div><!-- /.card -->
        </div>
    </div>
    <!-- /Calender Chart Weather -->

    <!-- Modal - Calendar - Add New Event -->
    <div class="modal fade none-border" id="event-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add New Event</strong></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                    <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /#event-modal -->
    <!-- Modal - Calendar - Add Category -->
    <div class="modal fade none-border" id="add-category">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add a category </strong></h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Category Name</label>
                                <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Choose Category Color</label>
                                <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                    <option value="success">Success</option>
                                    <option value="danger">Danger</option>
                                    <option value="info">Info</option>
                                    <option value="pink">Pink</option>
                                    <option value="primary">Primary</option>
                                    <option value="warning">Warning</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
<!-- /#add-category -->
    

    
    
  
@endsection