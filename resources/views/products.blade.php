
@include('header')


<div class="container" style="margin-top:50px;">
  {!! $search !!}
                  @foreach($products as $prod)
                        <div>

                          <a href="">

                                <div class="col-md-4 col-sm-4">
                                  <div class="team" data-id ="{{$prod->id}}">

                                    <div class = "img-border">
                                      <img src="/uploads/products/{{$prod->image}}"  class="img-responsive img-thumbnail" alt="...">
                                    </div>
                                      <br>
                                      <h4>{{$prod->product}} </h4>

                                      <hr>

                                  </div>
                                </div>

                          </a>

                        </div>
                     @endforeach

</div>







@include('footer1')
