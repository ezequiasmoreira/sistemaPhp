@extends("Template.app")
@section("content")
<div class="container">
    <h2>Editar cliente</h2>
    <form action= {{url('cliente/atualizar')}} method="Post">
        {{ csrf_field()}}
        <input type="hidden" id= "cliente_id" name="id" value="<?php echo $cliente->id ?>" class="btn btn-default">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" value='<?php echo $cliente->nome ?>' name="nome" required>
        </div>
        <div class="form-group">
            <label for="cpf">Cpf:</label>
            <input type="text" class="form-control" id="cpf" value='<?php echo $cliente->cpf ?>' name="cpf" required="">
        </div>
        <div class="form-group">
            <label for="data_cadastro">Data:</label>
            <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" value="<?php  echo date('Y-m-d');?>" readonly >
        </div> 
        <div class="form-group">
            <label for="endereco_principal">Endereço principal:</label>
            <select name="endereco_principal" class="form-control" id="endereco_principal" style="width:85%; float: left;">
                <?php
                    foreach ($enderecos as $endereco){?>
                    <option class="removeEnderecos"value="<?php echo $endereco->id ?>"
                        <?php echo($endereco->id == $cliente->endereco_principal)?"selected":"";?>>
                        <?php echo $endereco->rua." - ".$endereco->numero.' - '.$endereco->cep ?>
                    </option>
                <?php }?>
            </select>
            <button  id="btnModal"type="button" title="Cadastrar endereço  para este cliente"class="form-control" style="width:15%; float: rigth; display:none;" data-toggle="modal" data-target="#myModal">
            Adicionar  </button> 
                <label <input style="float:left; ; width:82%; text-align:right;">Adicionar Endereços:</label>
               <input style="float:left; width:5%;" type="checkbox" value="1" id="check1"  name="mostrarBotao">
            
            
            </div>  
        </div>        
        <div class="form-group">
            <input type="hidden" class="form-control" id="empresa_id" value="<?php echo session()->get('empresa_id') ?>" name="empresa_id">
        </div>
        <div class="form-group">
            <input type="hidden" class="form-control" id="usuario_id" value="<?php echo session()->get('usuario_id') ?>" name="usuario_id">
        </div>
        
        <div class="form-group" style="width:100%; float:left; margin-left:14%; ">
            <input type="submit" value="Alterar cliente" class="btn">
        <a href= {{url('cliente/'.$cliente->id.'/excluir')}} class="btn excluir">Excluir</a>
        </div>
        </form>
</div>
@include('localizacao.endereco.modalCadastro') 
@endsection


<script  type="text/javascript" >

function cadastrarEndereco(){
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
            var token               = $("input[type=hidden][name=_token]").val();
            
            var rua                 = $('#rua').val();
            var numero              = $('#numero').val();
            var bairro              = $('#bairro').val();
            var cep                 = $('#cep').val();
            var complemento         = $('#complemento').val();
            var estado              = $('#estado').val();
            var cidade              = $('#cidade').val();
            var empresa_id          = $('#empresa_id').val();
            var usuario_id          = $('#usuario_id').val();
            var cliente_id          = $('#cliente_id').val();
            
            if (($('#nome').val() == "")){
                alert("nome obrigatório");
                $('#nome').focus();
                return false;
            }
            if (($('#cpf').val() == "")){
                alert("cpf obrigatório");
                $('#cpf').focus();
                return false;
            }
            if (($('#rua').val() == "")){
                alert("rua obrigatório");
                $('#rua').focus();
                return false;
            }
            if (($('#numero').val() == "")){
                alert("numero obrigatório");
                $('#numero').focus();
                return false;
            }
            if (($('#bairro').val() == "")){
                alert("bairro obrigatório");
                $('#bairro').focus();
                return false;
            }
            if (($('#cep').val() == "")){
                alert("cep obrigatório");
                $('#cep').focus();
                return false;
            }
            if (($('#estado').val() == "0")){
                alert("estado obrigatório");
                $('#estado').focus();
                return false;
            }
            $.ajax ({
                type:"post",
                url:"{!! URL::to('endereco/salvar-json') !!}",
                dataType: 'JSON',
                data: {                    
                        '_token': token,                    
                        'rua':rua,         
                        'numero':numero,    
                        'bairro':bairro,      
                        'cep':cep ,        
                        'complemento':complemento, 
                        'estado':estado,      
                        'cidade':cidade,      
                        'empresa_id':empresa_id,
                        'usuario_id':usuario_id,
                        'cliente_id':cliente_id
                    
                },
                success:function(data){                                 
                    alert('endereço cadastrado com sucesso');
                        //$('#endereco_principal').append("<option class='removeEndereco' value="+data.endereco.id+">"+data.endereco.rua+","+data.endereco.numero+"</option>");
                        $(".removeEstados").each(function() {
                            $(this).remove();
                        });
                        $(".removeCidades").each(function() {
                            $(this).remove();
                        });  
                        $(".removeEnderecos").each(function() {
                            $(this).remove();
                        });                     
                                              
                        for(var i = 0; i < data.estados.length; i++){
                            $('#estado').append("<option class='removeEstados' value="+data.estados[i].id+">"+data.estados[i].sigla+" - "+data.estados[i].nome+"</option>");
                        }
                        for(var i = 0; i < data.enderecos.length; i++){
                            $('#endereco_principal').append("<option class='removeEnderecos' value="+data.enderecos[i].id+">"+data.enderecos[i].rua + " - "+data.enderecos[i].numero+"</option>");
                        }
                                                  

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

}
window.onload = function(){

    $("#check1").click(function(e) { 
        if($(this).is(':checked')) {  
            $("#btnModal").show();
            $(".modal-footer").append("<option id='cadastrarEndereco' onclick='cadastrarEndereco()' class='btn btn-default'>Cadastrar</option>");                 
        }else{
            $("#btnModal").hide();
        }
    });



    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $("#estado").on('change', function(){
            
            var estado  = $('#estado').val();
            var token   = $("input[type=hidden][name=_token]").val();
            
            $.ajax ({
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
    //valida endereço
    
     
}
</script>