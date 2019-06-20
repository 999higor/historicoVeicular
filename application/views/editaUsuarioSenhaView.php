<div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Alterar senha para o usuário <b><?php echo $this->session->userdata('nome');?></b></div>
      <div class="card-body">
      <form method="post" action="<?php echo base_url();?>index.php/UsuarioController/AlterarSenha">
         <input value="<?php echo $this->session->userdata('id');?>" name="id" hidden>             
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="password" id="novaSenha" class="form-control" name="novaSenha" placeholder="Senha" required>
                            <label for="novaSenha">Digite a nova senha</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="password" id="confirmaNovaSenha" class="form-control" placeholder="Confirmar senha" name="confirmaNovaSenha" required>
                            <label for="confirmaNovaSenha">Confirmar a nova senha</label>
                            <span class="class-danger" id='error'></span>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-4">
                        <input type="checkbox" id="cbConfirma">Confirmar alteração
                    </div>
                    <div class="col-md-8">
                        <div class="form-label-group">
                            <input type="password" id="senhaAtual" class="form-control" placeholder="Senha atual" name="senhaAtual" required>
                            <label for="senhaAtual">Digite a senha atual</label>
                        </div>   
                    </div>
                </div>         
            </div>
            <hr>
            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <input class="btn btn-primary btn-block" type="submit" value="Enviar" name="input" class="text-center">   
        </form>
    </div>
  </div>
</div>

<script>
    /* Desabilita o campo senhaAtual e desmarca o checkbox */
     $(document).ready(function(){
        $('#cbConfirma').prop('checked', false);
        $('#senhaAtual').prop('disabled', true);
    });

    /* Função para habilitar o campo de senha */
    $(document).ready(function(){
        $('#cbConfirma').click(function(){
            if($(this).prop("checked") == true){
                $('#senhaAtual').prop('disabled', false);
            }
            else if($(this).prop("checked") == false){
                $('#senhaAtual').prop('disabled', true);
            }
        });
    });

     /* Quando os inputs 'password' e 'confirmPassword' são digitados faz a verificação se eles são iguais */
     $('#novaSenha, #confirmaNovaSenha').on('keyup', function () {
            if ($('#novaSenha').val() != $('#confirmaNovaSenha').val()) {
                /* se forem diferentes desabilita o botão e mostra alerta */
                $('#error').html('As senhas precisam ser idênticas.').css('color', 'red');
                $('#btn').prop('disabled', true);
            }else{
                /*se forem iguais retira o alerta e habilita o  botão de enviar */
                $('#error').html('').css('color', 'green');
                $('#btn').prop('disabled', false);
            } 
        });
</script>


