@include('header')
<div class="container">
    <div class="row justify-content-center">
      <!-- Trigger the modal with a button -->
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add category</button>

    <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

      <!-- Modal content-->

          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Add category</h4>
            </div>
            <div class="modal-body">
    		          <form action="/addCategory" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    			          <div class="form-group">
    		              <label>Name</label>
    		              <input type="text" class="form-control"  name = "name" value = "">
    	              </div>
              			<div class="form-group">
              				<label>Image</label>
              				<input type="file" class="form-control" name = "image">
              			</div>

    			          <button type="submit" class="btn btn-default" name = "submit">Add</button>
    		         </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>

        </div>
      </div>



    <div class="modal fade" id="myModal1" role="dialog">
    			<div class="modal-dialog">
    				<div class="modal-content">
    					<div class="modal-header">
    						<button type="button" class="close" data-dismiss="modal">&times;</button>
    						<h4 class="modal-title">Delete?</h4>
    					</div>
    					<div class="modal-body">
                <form action="/deleteCategory" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type = "hidden" class = "hidden_id" name = "id">

                  <button type="submit" class="btn btn-default yes">Yes</button>
      						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </form>
    					</div>
    				</div>

    			</div>
    		</div>

        <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->

          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
              <div style = "width:500px; margin: 50px auto; overflow:hidden;">
        		<form action="/editCategory" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type = "hidden" class = "hidden_id" name = "id">
        			<div class="form-group">
        				<label>Name</label>
        				<input type="text" class="form-control edit_name"  name = "name" value = "">
        			</div>
        			<div class="form-group">
        				<label>Image</label>
        				<input type="file" class="form-control" name = "image" value="Null">
        			</div>

        			<button type="submit" class="btn btn-default" name = "submit">Edit</button>
        		</form>
        	</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
          </div>

        </div>
        </div>



    <div class="table-responsive">
    <table class="table" >
    		<thead>
    		  <tr>
    			<th>Name</th>
          <th>Image</th>
          <th>Edit</th>
    			<th>Delete</th>
    		  </tr>
    		</thead>
    		<tbody>


    		    @foreach($categories as $cat)
    					<tr>
    						<td class ="name{{$cat->id}}"><a href="/adminCatProducts/{{$cat->id}}" > {{$cat->name}}</a></td>
    						<td><img src = "/uploads/categories/{{$cat->image}}" style = "width:150px; height:150px; overflow:hidden"></td>
    						<td>

    								<button type="button" class="btn btn-info btn-lg edit" data-toggle="modal" data-target="#myModal2" data-id= "{{$cat->id}}">
    									<span class="glyphicon glyphicon-edit"></span>
    								</button>

    						</td>
    						<td>
    							<button type="button" class="btn btn-info btn-lg delete" data-toggle="modal" data-target="#myModal1" name = "cat_id" data-id= "{{$cat->id}}">
    								<span class="glyphicon glyphicon-remove-circle"></span>
    							</button>
    						</td>
    					</tr>
    			@endforeach
        </tbody>
      </table>
    </div>
    </div>
</div>
@include('footer')
