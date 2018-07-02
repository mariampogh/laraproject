$(document).ready(function(){



    $(".edit").click(function(){
  		var id = $(this).attr('data-id');
  		var name = $(".name"+id).text();
  		$(".hidden_id").val(id);
  		$(".edit_name").val(name);
  	})

    $(".delete").click(function(){
    		var id = $(this).attr('data-id');
    		$(".hidden_id").val(id);
    	})


    $('.productTable').DataTable();

    $(".editTr").click(function(){
  		var id = $(this).attr('data-id');
      var name = $(".name"+id).text();
  		$(".hidden_id").val(id);
      $(".edit_name").val(name);
  	})


    $(".categoryToggle").click(function(){
      var id = $(this).attr('data-id');
            $(".fadeOut"+id).toggle();
        });
  




})
