@include('header')

<div class="container">
  {!! $error !!}
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style ="margin-bottom:2%"><span class="glyphicon glyphicon-plus"> Add product</button>

<!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

  <!-- Modal content-->

      <div class="modal-content">
        <div class="modal-header modalHeader">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Product</h4>
        </div>
        <div class="modal-body">
		          <form action="/addProduct/{{$cat_id}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

			          <div class="form-group ">
		              <input type="text" class="form-control  modalInput" placeholder="Product" name = "product" value = "">
	              </div>
                <div class="modalInput">
                  <label class="fileContainer" style="margin-bottom:0">
                      <span class="fa fa-camera"></span>
                      <input type="file" class = "modalInput" name = "image"/>
                    </label>
                </div>

			          <button type="submit" class="btn btn-default addButton" name = "submit" value ="a">Add</button>
		         </form>

      </div>

    </div>

    </div>
  </div>



<div class="modal fade" id="myModal1" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header noBorder">
						<h4 class="modal-title text-center"><span class="glyphicon glyphicon-trash deleteIcon"></span></h4>
					</div>
					<div class="modal-body" style="overflow:hidden">
            <form action="/deleteProduct/{{$cat_id}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type = "hidden" class = "hidden_id" name = "id">
              <button type="submit" class="btn btn-danger yes col-sm-6 roundedZero">Delete</button>
              <button type="button" class="btn btn-info col-sm-6 roundedZero" data-dismiss="modal">Cancel</button>
            </form>
					</div>
				</div>

			</div>
		</div>

    <div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->

      <div class="modal-content">
        <div class="modal-header modalHeader">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit</h4>
        </div>

        <div class="modal-body">
          
        		<form action="/editProduct" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type = "hidden"  name = "cat_id" value = "{{$cat_id}}">
              <input type = "hidden" class = "hidden_id" name = "id">
              <div class="form-group ">
                <input type="text" class="form-control  modalInput edit_name" placeholder="Product" name = "name" value = "">
              </div>
              <div class="modalInput">
                <label class="fileContainer" style="margin-bottom:0">
                    <span class="fa fa-camera"></span>
                    <input type="file" class = "modalInput" name = "image"/>
                  </label>
              </div>

        			<button type="submit" class="btn btn-default addButton" name = "submit">Edit</button>
        		</form>

        </div>
      </div>

    </div>
    </div>



<div class="table-responsive">
<table class="table productTable table-hover">
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
						<td><img src = "/uploads/products/{{$prd->image}}" style = "width:10%; height:10%; overflow:hidden"></td>
						<td>

								<button type="button" class="btn btn-info btn-lg editTr" data-toggle="modal" data-target="#myModal2" data-id= "{{$prd->id}}">
									<span class="glyphicon glyphicon-edit"></span>
								</button>

						</td>
						<td>
							<button type="button" class="btn btn-danger btn-lg delete" data-toggle="modal" data-target="#myModal1" data-id= "{{$prd->id}}">
								<span class="glyphicon glyphicon-remove-circle"></span>
							</button>
						</td>
					</tr>
			@endforeach
    </tbody>
  </table>
</div>
</div>

  @include('footer1')
