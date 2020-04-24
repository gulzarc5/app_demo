@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
  <div class="row">

    <div class="col-md-12">
      <div class="x_panel">
          <div class="x_title">
              <h2>Add Image</h2>
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
                {{ Form::open(['method' => 'post','route'=>'admin.image_insert', 'enctype'=>'multipart/form-data']) }}
                    <div class="well" style="overflow: auto">
                      <div class="form-row mb-10">
                        <div class="form-group" id="size-div">
                          <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                            <div class="form-row">
                                
                                <div class="col-sm-6" >
                                  <label class="col-sm-6 control-label">Numbers</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required="">
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">                                  
                                  <label class="col-sm-6 control-label">Image</label>
                                    <input type="file" name="image" class="form-control" placeholder="Number" required="">
                                    @if($errors->has('image'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>    
                          </div>
                        </div>
                    </div>
                    </div>                  
                    <div class="form-group">    	            	
                        {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}  
                    </div>
                {{ Form::close() }}
              </div>
          </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>Images List</h2>
            <div class="clearfix"></div>
        </div>
        <div>
          <div class="x_content">
            <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr>
                    <th>SL No.</th>
                    <th>name</th>
                    <th>image</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody class="form-text-element">
                  @if (isset($images) && !empty($images))
                    @php
                        $count = 1;
                    @endphp
                      @foreach ($images as $item)
                        <tr>
                          <td>{{$count++}}</td>
                          <td>{{$item->name}}</td>
                        <td><img src="{{asset('images/thumb/'.$item->image.'')}}" alt="" style="height: 136px;"></td>
                          <td>
                          <a class="btn btn-danger" href="{{route('admin.slot_delete',['slot_id'=>$item->id])}}">Delete</a>
                          </td>
                        </tr>
                      @endforeach
                  @endif
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>Users</h2>
            <div class="clearfix"></div>
        </div>
        <div>
          <div class="x_content">
            <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr>
                    <th>SL No.</th>
                    <th>name</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody class="form-text-element">
                  @if (isset($users) && !empty($users))
                    @php
                        $count = 1;
                    @endphp
                      @foreach ($users as $item)
                        <tr>
                          <td>{{$count++}}</td>
                          <td>{{$item->name}}</td>
                          <td>{{$item->mobile}}</td>
                          <td>
                          <a class="btn btn-info" href="{{route('admin.user_edit',['id'=>$item->id])}}">Change Mobile Number</a>
                          </td>
                        </tr>
                      @endforeach
                  @endif
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
 @endsection

 @section('script')
     <script>
       var count = 1;
       function addMoreSlot() {
        var html = '<div class="col-md-6 col-sm-12 col-xs-12 mb-3" id="slotdiv'+count+'">'+
          '<div class="form-row">'+
            '<label class="col-sm-12 control-label">Numbers</label>'+
            '<div class="col-sm-2" style="width:150px;">'+
               ' <input type="text" name="slot[]" id="swidth" class="form-control" placeholder="Slot Number" required="">'+
            '</div>'+

            '<div class="col-sm-2" style="width:150px;">'+
               ' <input type="text" name="numbers[]" id="sheigth" class="form-control" placeholder="Number" required="">'+
            '</div>'+
            '</div>    '+
            '<button type="button" class="btn btn-danger" id="addsize" name="addsize" onclick="removeSlot('+count+')">+ Remove </button> '+
          '</div>';
          $("#size-div").append(html);
          count++;
       }

       function removeSlot(id) {
         $("#slotdiv"+id).remove();
       }
     </script>
 @endsection