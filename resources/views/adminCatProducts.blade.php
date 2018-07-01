@include('header')

<div class="container">

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ավելացնել դասընթաց</button>

<!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

  <!-- Modal content-->

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Product</h4>
        </div>
        <div class="modal-body">
          <div style = "width:500px; margin: 50px auto; overflow:hidden;">
		          <form action="/addProduct/{{$cat_id}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

			          <div class="form-group">
		              <label>Product</label>
		              <input type="text" class="form-control"  name = "product" value = "">
	              </div>
          			<div class="form-group">
          				<label>Image</label>
          				<input type="file" class="form-control" name = "image">
          			</div>
			          <button type="submit" class="btn btn-default" name = "submit" value ="a">Add</button>
		         </form>
	        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

    </div>
  </div>



<div class="modal fade" id="myModal1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Delete?:</h4>
					</div>
					<div class="modal-body">
            <form action="/deleteProduct/{{$cat_id}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type = "hidden" class = "hidden_id" name = "id">

              <button type="submit" class="btn btn-default yes">Այո</button>
  						<button type="button" class="btn btn-default" data-dismiss="modal">Ոչ</button>
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
    		<form action="/editProduct" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type = "hidden"  name = "cat_id" value = "{{$cat_id}}">
          <input type = "hidden" class = "hidden_id" name = "id">
    			<div class="form-group">
    				<label>Product</label>
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
    </div>



<div class="table-responsive">
<table class="table productTable">
		<thead>
		  <tr>
			<th scope="col">Product</th>
      <th scope="col">Image</th>
      <th scope="col">Edit</th>
			<th scope="col">Delete</th>
		  </tr>
		</thead>
		<tbody>


		    @foreach($products as $prd)
					<tr >
            <td class ="name{{$prd->id}}"> {{$prd->product}}</td>
						<td><img src = "/uploads/products/{{$prd->image}}" style = "width:150px; height:200px; overflow:hidden"></td>
						<td>

								<button type="button" class="btn btn-info btn-lg editTr" data-toggle="modal" data-target="#myModal2" data-id= "{{$prd->id}}">
									<span class="glyphicon glyphicon-edit"></span>
								</button>

						</td>
						<td>
							<button type="button" class="btn btn-info btn-lg delete" data-toggle="modal" data-target="#myModal1" data-id= "{{$prd->id}}">
								<span class="glyphicon glyphicon-remove-circle"></span>
							</button>
						</td>
					</tr>
			@endforeach
    </tbody>
  </table>
</div>
</div>

  @include('footer')
