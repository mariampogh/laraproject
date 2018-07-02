@include('header')


<div class="container" style="margin-top:50px;">
  <div>
    <h2>Admin email and password</h2>
    <div>m@m.m  ,   mariam</div>
  </div>
<div style="font-size:30px;color:#e2a453">CATEGORIES</div>
            @foreach($categoryAndProduct as $catProd)

                  <div class = "categoryToggle" data-id = "{{$catProd->id}}" >
                    <a><h2>{{$catProd->name}}</h2>
                      <img src="/uploads/categories/{{$catProd->image}}" class="img-thumbnail"  width="304" height="236">
                    </a>
                  </div>
              <div style ="overflow:hidden; border:1px solid #9d9b99;display:none" class = "fadeOut{{$catProd->id}}">
                <div class= "text-center">
                  <h2>Products</h2>
                </div  >
                  @foreach($catProd->products as $prod)
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
            @endforeach

</div>







@include('footer1')
