@push('js')
<!-- Trigger the modal with a button -->

<script type="text/javascript">
$(document).ready(function(){

  $('#jstree').jstree({
    "core" : {
      'data' : {!! load_dep($product->department_id) !!},
      "themes" : {
        "variant" : "large"
      }
    },
    "checkbox" : {
      "keep_selected_style" : true
    },
    "plugins" : [ "wholerow" ]//checkbox
  });

});

 $('#jstree').on('changed.jstree',function(e,data){
    var i , j , r = [];
    var  name = [];
    for(i=0,j = data.selected.length;i < j;i++)
    {
        r.push(data.instance.get_node(data.selected[i]).id);
    }

    var department = r.join(', ');
    $('.department_id').val(department);

    $.ajax({
      url:"{{ aurl('load/wight/size') }}",
      dataType:'html',
      type:'post',
      data:{_token:'{{ csrf_token() }}',dep_id:department,product_id:'{{ $product->id }}'},
      success: function(data)
      {
        $('.size_weight').html(data);
        $('.info_data').removeClass('hidden');
      }
    });
});

</script>
@endpush
 <div id="department" class="tab-pane fade">
      <h3>{{ trans('admin.department') }}</h3>

      <div id="jstree"></div>
      <input type="hidden" name="department_id" class="department_id">

 </div>
