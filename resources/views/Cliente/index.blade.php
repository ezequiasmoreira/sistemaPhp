
@extends("Template.app")
@section("content")
<div class="base-home">
    <h1 class="titulo">
        <strong>Lista de clientes</strong>
    </h1>
    <a href= {{url("cliente/novo")}} class="btn add">Adicionar cliente</a>
    <input type="text" id="busca" class="form-control" style="width:50%; float:left;"> 
    <button  class="btn btn-default" id="filtro" style="width:10%; float:left;" >Pesquisar</button> 
    <div class="table-overflow" style="max-height:500;overflow-y:auto; margin-top:1%">     
    {{ csrf_field()}}
        <div class="tabela">
            <table cellpadding="0" cellspacing="0" >
                <thead>
                    <tr >
                        <th  width="5%">cod</th>
                        <th  width="50%">nome</th>
                        <th  width="5%">cpf</th>
                        <th  width="10%">ação</th>
                    </tr>
                </thead>
                <tbody id="adicionaTr">
                    @foreach ($clientes as $cliente)
                    <tr class="removeTr">
                        <td> {{$cliente->id}} </td>
                        <td> {{$cliente->nome}}</td>
                        <td align="center"> {{$cliente->cpf}} </td>
                        <td align="center">
                            <a href= '<?php echo "cliente/".$cliente->id."/editar" ?>'  class="btn editar">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<script>
window.onload=function(){
   $('#filtro').on('click',function(){
        pesquisar();  
   });
}
function pesquisar(){
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
            
        var busca  = $('#busca').val();
        var token   = $("input[type=hidden][name=_token]").val();
        
        $.ajax({
            type:"post",
            url:"{!! URL::to('cliente/retorna-clientes') !!}",
            dataType: 'JSON',
            data: {
                "busca": busca, 
                '_token': token
            },
            success:function(data){
                $(".removeTr").each(function() {
                    $(this).remove();
                });  
                for(var i = 0; i < data.length; i++){
                    $('#adicionaTr').append("<tr class='removeTr'><td>" 
                        + data[i].id +   "</td><td>" 
                        + data[i].nome + "</td><td align='center'>"
                        + data[i].cpf +  "</td><td align='center'><a href= 'cliente/"
                        + data[i].id + "/editar'  class='btn editar'>Editar</a></td></tr>"
                    );
                    }
            
            },
            error:function(){                    
                    alert("Ocorreu algum problema entre em contato como suporte");                    
            },
        });
    });
      
    
}

</script>
