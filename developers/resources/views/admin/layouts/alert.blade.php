<div class="form-group">
    @if(Session::has('flashMessage'))  
        <script type="text/javascript">
          $(document).ready(function() {
              $.notify({
                message: '{!! session('flashMessage') !!}'
              },{
                type: '{!! session('flashType') !!}'
              });
          });
        </script>              
    @endif 
</div>