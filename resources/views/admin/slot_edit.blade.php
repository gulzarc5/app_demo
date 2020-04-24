@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
          <div class="x_title">
              <h2>Change Mobile Number</h2>
              <div class="clearfix"></div>
          </div>
            <div>
                @if (Session::has('message'))
                    <div class="alert alert-success" >{{ Session::get('message') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" >{{ Session::get('error') }}</div>
                @endif
            </div>
          <div>
              <div class="x_content">
                @if (isset($slot_data) && !empty($slot_data))                  
                
                {{ Form::open(['method' => 'post','route'=>'admin.user_update']) }}
                  <input type="hidden" name="id" value="{{$slot_data->id}}">
                    <div class="well" style="overflow: auto">
                      <div class="form-row mb-10">
                          <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-row">
                                <div class="col-sm-6">
                                  <label class="control-label">Mobile Number</label>
                                  <input type="text" value="{{$slot_data->mobile}}" name="mobile" id="swidth" class="form-control" placeholder="Slot Number" required="">
                                </div>
                            </div> 
                          </div>
                    </div>
                    </div>                  
                    <div class="form-group">    	            	
                        {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
                    </div>
                {{ Form::close() }}

                @endif
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
 @endsection