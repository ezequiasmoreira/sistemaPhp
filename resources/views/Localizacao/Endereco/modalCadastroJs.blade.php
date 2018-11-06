<script>
function cadastraEndereco(){

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $("#estado").on('change', function(){
            
            var estado  = $('#estado').val();
            var token   = $("input[type=hidden][name=_token]").val();
            
            $.ajax({
                type:"post",
                url:"{!! URL::to('cliente/retorna-cidade') !!}",
                dataType: 'JSON',
                data: {
                    "estado_id": estado, 
                    '_token': token
                },
                success:function(data){  
                    $(".removeCidades").each(function() {
                        $(this).remove();
                    });
                    for (var i = 0; i < data.length; i++) { 
                        var id      = data[i].id;
                        var nome    = data[i].nome;                                          
                        $('#cidade').append("<option class='removeCidades' value="+id+">"+nome+"</option>");                   
                    }
                },
                error:function(){                    
                        alert("Ocorreu algum problema entre em contato como suporte");                    
                },
            });
       });
    });   
    

}
</script>