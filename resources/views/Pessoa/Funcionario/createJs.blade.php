<script>
window.onload = function(){ 
    cadastraEndereco();
    /*
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#cadastrarFuncionario").on('click', function(){            
            var nome                = $('#nome').val();
            var cpf                 = $('#cpf').val();
            var rg                  = $('#rg').val();
            var salario             = $('#salario').val();
            var nascimento          = $('#nascimento').val();
            var cargo               = $('#cargo').val();
            var endereco_principal  = $('#endereco_principal').val(); 
            var empresa_id          = $('#empresa_id').val();
            var usuario_id          = $('#usuario_id').val(); 
            var token               = $("input[type=hidden][name=_token]").val();
            //endereço
            var rua                 = $('#rua').val();
            var numero              = $('#numero').val();
            var bairro              = $('#bairro').val();
            var cep                 = $('#cep').val();
            var complemento         = $('#complemento').val();
            var estado              = $('#estado').val();
            var cidade              = $('#cidade').val();
            var empresa_id          = $('#empresa_id').val();
            var usuario_id          = $('#usuario_id').val();

            
            $.ajax({
                type:"post",
                url:"{!! URL::to('cliente/salvar') !!}",
                dataType: 'JSON',
                data: {
                    "nome": nome,
                    "cpf":cpf,
                    "data_cadastro":data_cadastro,
                    "endereco_principal":endereco_principal,
                    "empresa_id":empresa_id,
                    "usuario_id":usuario_id,
                    '_token': token,
                    'endereco':{
                                'rua':rua,         
                                'numero':numero,    
                                'bairro':bairro,      
                                'cep':cep ,        
                                'complemento':complemento, 
                                'estado':estado,      
                                'cidade':cidade,      
                                'empresa_id':empresa_id,
                                'usuario_id':usuario_id
                    }
                },
                success:function(data){                                 
                    alert('Cliente Cadastrado com sucesso');
                        $(".removeEstados").each(function() {
                            $(this).remove();
                        });
                        $(".removeCidades").each(function() {
                            $(this).remove();
                        });                       
                                              
                        for(var i = 0; i < data.estados.length; i++){
                            $('#estado').append("<option class='removeEstados' value="+data.estados[i].id+">"+data.estados[i].sigla+" - "+data.estados[i].nome+"</option>");
                        }
                        $(".removeEndereco").each(function() {
                            $(this).remove();
                        });
                        $('#nome').val("");
                        $('#cpf').val("");   

                        $('#rua').val("");      
                        $('#numero').val("");
                        $('#bairro').val("");
                        $('#cep').val("");
                        $('#complemento').val("");                 
                },
                error:function(){                   
                    alert("erro");
                },
            });             
        });
    });*/    
}
</script>