

<?php $__env->startSection('titulo', 'Formulário de Usuários'); ?>

<?php $__env->startSection('conteudo'); ?>

<div class="container-fluid"
    style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    <?php

        if (!empty($data->id)) {
            $action = route('usuario.update', $data->id);
        } else {
            $action = route('usuario.store');
        }

    ?>


    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                font-family: Georgia, serif;
                font-weight: bold;
                margin-bottom: 8px;">
            CADASTRAR USUÁRIO
        </h4>

        <p style="color: #555;
                font-size: 13px;
                margin-bottom: 0;">
            Cadastre um novo usuário
        </p>

    </div>


    <form action="<?php echo e($action); ?>"
        method="post"
        class="p-4"
        style="background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 6px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.12);
                max-width: 650px;
                width: 100%;
                margin: 0 auto;">

        <?php echo csrf_field(); ?>

        <?php if(!empty($data->id)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>


        <input type="hidden"
            name="id"
            value="<?php echo e(old('id', $data->id ?? '')); ?>">


        

        <div class="mb-3">

            <label for="nome"
                class="form-label"
                style="color: #555;
                        font-size: 13px;
                        font-weight: 500;">
                Nome
            </label>

            <input type="text"
                name="nome"
                id="nome"
                maxlength="200"
                class="form-control"
                style="border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 13px;
                        height: 40px;
                        padding: 7px 12px;"
                value="<?php echo e(old('nome', $data->nome ?? '')); ?>">

        </div>


        

        <div class="mb-3">

            <label for="cpf"
                class="form-label"
                style="color: #555;
                        font-size: 13px;
                        font-weight: 500;">
                CPF
            </label>

            <input type="text"
                name="cpf"
                id="cpf"
                maxlength="14"
                class="form-control"
                style="border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 13px;
                        height: 40px;
                        padding: 7px 12px;"
                value="<?php echo e(old('cpf', $data->cpf ?? '')); ?>">

        </div>


        

        <div class="mb-3">

            <label for="telefone"
                class="form-label"
                style="color: #555;
                        font-size: 13px;
                        font-weight: 500;">
                Telefone
            </label>

            <input type="text"
                name="telefone"
                id="telefone"
                maxlength="20"
                class="form-control"
                style="border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 13px;
                        height: 40px;
                        padding: 7px 12px;"
                value="<?php echo e(old('telefone', $data->telefone ?? '')); ?>">

        </div>


        

        <div class="mb-3">

            <label for="email"
                class="form-label"
                style="color: #555;
                        font-size: 13px;
                        font-weight: 500;">
                E-mail
            </label>

            <input type="email"
                name="email"
                id="email"
                maxlength="100"
                class="form-control"
                style="border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 13px;
                        height: 40px;
                        padding: 7px 12px;"
                value="<?php echo e(old('email', $data->email ?? '')); ?>">

        </div>


        

        <div class="mb-3">

            <label for="endereco"
                class="form-label"
                style="color: #555;
                        font-size: 13px;
                        font-weight: 500;">
                Endereço
            </label>

            <input type="text"
                name="endereco"
                id="endereco"
                maxlength="500"
                class="form-control"
                style="border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 13px;
                        height: 40px;
                        padding: 7px 12px;"
                value="<?php echo e(old('endereco', $data->endereco ?? '')); ?>">

        </div>


        

        <div class="mb-3">

            <label for="data_nascimento"
                class="form-label"
                style="color: #555;
                        font-size: 13px;
                        font-weight: 500;">
                Data de nascimento
            </label>

            <input type="date"
                name="data_nascimento"
                id="data_nascimento"
                class="form-control"
                style="border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 13px;
                        height: 40px;
                        padding: 7px 12px;"
                value="<?php echo e(old('data_nascimento', $data->data_nascimento ?? '')); ?>">

        </div>


        

        <div class="mb-3">

            <label for="tipo"
                class="form-label"
                style="color: #555;
                        font-size: 13px;
                        font-weight: 500;">
                Tipo
            </label>

            <select name="tipo"
                    id="tipo"
                    class="form-select"
                    style="border: 1px solid #ccc;
                        border-radius: 5px;
                        font-size: 13px;
                        height: 40px;
                        padding: 7px 12px;">

                <option value="">
                    Selecione o tipo
                </option>

                <option value="CLIENTE"
                        <?php echo e(old('tipo', $data->tipo ?? '') == 'CLIENTE' ? 'selected' : ''); ?>>
                    CLIENTE
                </option>

                <option value="FUNCIONARIO"
                        <?php echo e(old('tipo', $data->tipo ?? '') == 'FUNCIONARIO' ? 'selected' : ''); ?>>
                    FUNCIONÁRIO
                </option>

            </select>

        </div>


        

        <div id="dadosVaga"
            style="display: none;
                    border-top: 1px solid #ddd;
                    margin-top: 20px;
                    padding-top: 20px;">

            <h5 style="color: #6d3f36;
                    font-family: Georgia, serif;
                    font-weight: bold;
                    font-size: 16px;
                    margin-bottom: 20px;">
                Dados da Vaga
            </h5>


            

            <div class="mb-3">

                <label class="form-label"
                    style="color: #555;
                            font-size: 13px;
                            font-weight: 500;">
                    Vaga
                </label>

                <div>

                    <label style="font-size: 13px; margin-right: 20px;">

                        <input type="radio"
                            name="tipo_vaga"
                            value="nova"
                            id="vagaNova"
                            <?php echo e(old('tipo_vaga', !isset($data->vaga) ? 'nova' : 'existente') == 'nova' ? 'checked' : ''); ?>>

                        Criar nova vaga

                    </label>


                    <label style="font-size: 13px;">

                        <input type="radio"
                            name="tipo_vaga"
                            value="existente"
                            id="vagaExistente"
                            <?php echo e(old('tipo_vaga', isset($data->vaga) ? 'existente' : '') == 'existente' ? 'checked' : ''); ?>>

                        Selecionar vaga existente

                    </label>

                </div>

            </div>


            

            <div id="selecionarVaga"
                class="mb-3"
                style="display: none;">

                <label for="vaga_id"
                    class="form-label"
                    style="color: #555;
                            font-size: 13px;
                            font-weight: 500;">
                    Selecione uma vaga em aberto
                </label>

                <select name="vaga_id"
                        id="vaga_id"
                        class="form-select"
                        style="border: 1px solid #ccc;
                            border-radius: 5px;
                            font-size: 13px;
                            height: 40px;
                            padding: 7px 12px;">

                    <option value="">
                        Selecione a vaga
                    </option>

                    <?php $__currentLoopData = $vagas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vaga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($vaga->id); ?>"
                            data-funcao="<?php echo e($vaga->funcao); ?>"
                            data-salario="<?php echo e($vaga->salario); ?>"
                            data-escala="<?php echo e($vaga->escala); ?>"
                            data-jornada="<?php echo e($vaga->jornada_trabalho); ?>"
                            data-turno="<?php echo e($vaga->turno); ?>"
                            data-tempo="<?php echo e($vaga->tempo_profissao); ?>"
                            <?php echo e(old('vaga_id', $data->vaga->id ?? '') == $vaga->id ? 'selected' : ''); ?>>

                            <?php echo e($vaga->funcao); ?>

                            - R$ <?php echo e(number_format($vaga->salario, 2, ',', '.')); ?>


                        </option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

            </div>


            

            <div class="mb-3">

                <label for="funcao"
                    class="form-label"
                    style="color: #555;
                            font-size: 13px;
                            font-weight: 500;">
                    Função
                </label>

                <select name="funcao"
                        id="funcao"
                        class="form-select"
                        style="border: 1px solid #ccc;
                            border-radius: 5px;
                            font-size: 13px;
                            height: 40px;
                            padding: 7px 12px;">

                    <option value="">
                        Selecione a função
                    </option>

                    <option value="Contabilidade"
                        <?php echo e(old('funcao', $data->vaga->funcao ?? '') == 'Contabilidade' ? 'selected' : ''); ?>>
                        Contabilidade
                    </option>

                    <option value="Embalador"
                        <?php echo e(old('funcao', $data->vaga->funcao ?? '') == 'Embalador' ? 'selected' : ''); ?>>
                        Embalador
                    </option>

                    <option value="Marketing"
                        <?php echo e(old('funcao', $data->vaga->funcao ?? '') == 'Marketing' ? 'selected' : ''); ?>>
                        Marketing
                    </option>

                    <option value="Produção"
                        <?php echo e(old('funcao', $data->vaga->funcao ?? '') == 'Produção' ? 'selected' : ''); ?>>
                        Produção
                    </option>

                </select>

            </div>


            

            <div class="mb-3">

                <label for="salario"
                    class="form-label"
                    style="color: #555;
                            font-size: 13px;
                            font-weight: 500;">
                    Salário
                </label>

                <input type="text"
                    name="salario"
                    id="salario"
                    maxlength="10"
                    placeholder="Ex: 8000,00"
                    class="form-control"
                    style="border: 1px solid #ccc;
                            border-radius: 5px;
                            font-size: 13px;
                            height: 40px;
                            padding: 7px 12px;"
                    value="<?php echo e(old('salario', $data->vaga->salario ?? '')); ?>">

            </div>


            

            <div class="mb-3">

                <label for="escala"
                    class="form-label"
                    style="color: #555;
                            font-size: 13px;
                            font-weight: 500;">
                    Escala
                </label>

                <select name="escala"
                        id="escala"
                        class="form-select"
                        style="border: 1px solid #ccc;
                            border-radius: 5px;
                            font-size: 13px;
                            height: 40px;
                            padding: 7px 12px;">

                    <option value="">
                        Selecione a escala
                    </option>

                    <option value="5x2"
                        <?php echo e(old('escala', $data->vaga->escala ?? '') == '5x2' ? 'selected' : ''); ?>>
                        5x2
                    </option>

                    <option value="6x1"
                        <?php echo e(old('escala', $data->vaga->escala ?? '') == '6x1' ? 'selected' : ''); ?>>
                        6x1
                    </option>

                    <option value="12x36"
                        <?php echo e(old('escala', $data->vaga->escala ?? '') == '12x36' ? 'selected' : ''); ?>>
                        12x36
                    </option>

                    <option value="4x3"
                        <?php echo e(old('escala', $data->vaga->escala ?? '') == '4x3' ? 'selected' : ''); ?>>
                        4x3
                    </option>

                </select>

            </div>


            

            <div class="mb-3">

                <label for="jornada_trabalho"
                    class="form-label"
                    style="color: #555;
                            font-size: 13px;
                            font-weight: 500;">
                    Jornada de trabalho
                </label>

                <select name="jornada_trabalho"
                        id="jornada_trabalho"
                        class="form-select"
                        style="border: 1px solid #ccc;
                            border-radius: 5px;
                            font-size: 13px;
                            height: 40px;
                            padding: 7px 12px;">

                    <option value="">
                        Selecione a jornada
                    </option>

                    <option value="4 horas por dia"
                        <?php echo e(old('jornada_trabalho', $data->vaga->jornada_trabalho ?? '') == '4 horas por dia' ? 'selected' : ''); ?>>
                        4 horas por dia
                    </option>

                    <option value="6 horas por dia"
                        <?php echo e(old('jornada_trabalho', $data->vaga->jornada_trabalho ?? '') == '6 horas por dia' ? 'selected' : ''); ?>>
                        6 horas por dia
                    </option>

                    <option value="8 horas por dia"
                        <?php echo e(old('jornada_trabalho', $data->vaga->jornada_trabalho ?? '') == '8 horas por dia' ? 'selected' : ''); ?>>
                        8 horas por dia
                    </option>

                    <option value="44 horas semanais"
                        <?php echo e(old('jornada_trabalho', $data->vaga->jornada_trabalho ?? '') == '44 horas semanais' ? 'selected' : ''); ?>>
                        44 horas semanais
                    </option>

                </select>

            </div>


            

            <div class="mb-3">

                <label for="turno"
                    class="form-label"
                    style="color: #555;
                            font-size: 13px;
                            font-weight: 500;">
                    Turno
                </label>

                <select name="turno"
                        id="turno"
                        class="form-select"
                        style="border: 1px solid #ccc;
                            border-radius: 5px;
                            font-size: 13px;
                            height: 40px;
                            padding: 7px 12px;">

                    <option value="">
                        Selecione o turno
                    </option>

                    <option value="Manhã"
                        <?php echo e(old('turno', $data->vaga->turno ?? '') == 'Manhã' ? 'selected' : ''); ?>>
                        Manhã
                    </option>

                    <option value="Tarde"
                        <?php echo e(old('turno', $data->vaga->turno ?? '') == 'selected' ? 'selected' : ''); ?>>
                        Tarde
                    </option>

                    <option value="Noite"
                        <?php echo e(old('turno', $data->vaga->turno ?? '') == 'selected' ? 'selected' : ''); ?>>
                        Noite
                    </option>

                    <option value="Integral"
                        <?php echo e(old('turno', $data->vaga->turno ?? '') == 'selected' ? 'selected' : ''); ?>>
                        Integral
                    </option>

                </select>

            </div>


            

            <div class="mb-3">

                <label for="tempo_profissao"
                    class="form-label"
                    style="color: #555;
                            font-size: 13px;
                            font-weight: 500;">
                    Tempo de profissão
                    <span style="color: #999;">(opcional)</span>
                </label>

                <input type="text"
                    name="tempo_profissao"
                    id="tempo_profissao"
                    maxlength="20"
                    class="form-control"
                    style="border: 1px solid #ccc;
                            border-radius: 5px;
                            font-size: 13px;
                            height: 40px;
                            padding: 7px 12px;"
                    value="<?php echo e(old('tempo_profissao', $data->vaga->tempo_profissao ?? '')); ?>">

            </div>

        </div>


        

        <div class="d-flex justify-content-between mt-3">

            <button type="submit"
                    class="btn"
                    style="background-color: #e88da5;
                        border: none;
                        border-radius: 20px;
                        color: white;
                        padding: 8px 30px;
                        font-size: 13px;">
                Salvar
            </button>


            <a href="<?php echo e(route('usuario.list')); ?>"
            class="btn"
            style="background-color: #c90045;
                    border: none;
                    border-radius: 20px;
                    color: white;
                    padding: 8px 30px;
                    font-size: 13px;">
                Voltar
            </a>

        </div>

    </form>

</div>


<script>
    function mostrarDadosVaga() {

        let tipo = document.getElementById('tipo').value;
        let dadosVaga = document.getElementById('dadosVaga');

        if (tipo === 'FUNCIONARIO') {

            dadosVaga.style.display = 'block';
            mostrarOpcaoVaga();

        } else {

            dadosVaga.style.display = 'none';

        }
    }


    function mostrarOpcaoVaga() {

        let nova = document.getElementById('vagaNova').checked;

        let selecionarVaga = document.getElementById('selecionarVaga');

        let funcao = document.getElementById('funcao');
        let salario = document.getElementById('salario');
        let escala = document.getElementById('escala');
        let jornada = document.getElementById('jornada_trabalho');
        let turno = document.getElementById('turno');
        let tempo = document.getElementById('tempo_profissao');

        /*
         * Pega as divs que envolvem cada campo
         */
        let divFuncao = funcao.closest('.mb-3');
        let divSalario = salario.closest('.mb-3');
        let divEscala = escala.closest('.mb-3');
        let divJornada = jornada.closest('.mb-3');
        let divTurno = turno.closest('.mb-3');
        let divTempo = tempo.closest('.mb-3');


        if (nova) {

            /*
             * CRIAR NOVA VAGA
             */

            selecionarVaga.style.display = 'none';

            divFuncao.style.display = 'block';
            divSalario.style.display = 'block';
            divEscala.style.display = 'block';
            divJornada.style.display = 'block';
            divTurno.style.display = 'block';
            divTempo.style.display = 'block';

            funcao.disabled = false;
            salario.readOnly = false;
            escala.disabled = false;
            jornada.disabled = false;
            turno.disabled = false;
            tempo.readOnly = false;

            /*
             * Limpa os dados da vaga selecionada
             */
            funcao.value = '';
            salario.value = '';
            escala.value = '';
            jornada.value = '';
            turno.value = '';
            tempo.value = '';

            document.getElementById('vaga_id').value = '';

        } else {

            /*
             * SELECIONAR VAGA EXISTENTE
             */

            /*
             * Mostra SOMENTE o select
             */
            selecionarVaga.style.display = 'block';

            /*
             * Esconde todos os campos da vaga
             */
            divFuncao.style.display = 'none';
            divSalario.style.display = 'none';
            divEscala.style.display = 'none';
            divJornada.style.display = 'none';
            divTurno.style.display = 'none';
            divTempo.style.display = 'none';

            /*
             * Deixa os campos bloqueados
             */
            funcao.disabled = true;
            salario.readOnly = true;
            escala.disabled = true;
            jornada.disabled = true;
            turno.disabled = true;
            tempo.readOnly = true;

            /*
             * Limpa os campos
             */
            funcao.value = '';
            salario.value = '';
            escala.value = '';
            jornada.value = '';
            turno.value = '';
            tempo.value = '';
        }
    }


    function preencherVaga() {

        let select = document.getElementById('vaga_id');

        let funcao = document.getElementById('funcao');
        let salario = document.getElementById('salario');
        let escala = document.getElementById('escala');
        let jornada = document.getElementById('jornada_trabalho');
        let turno = document.getElementById('turno');

        /*
         * Pega as divs dos campos
         */
        let divFuncao = funcao.closest('.mb-3');
        let divSalario = salario.closest('.mb-3');
        let divEscala = escala.closest('.mb-3');
        let divJornada = jornada.closest('.mb-3');
        let divTurno = turno.closest('.mb-3');


        /*
         * Se nenhuma vaga foi selecionada,
         * mantém somente o select aparecendo.
         */
        if (!select.value) {

            divFuncao.style.display = 'none';
            divSalario.style.display = 'none';
            divEscala.style.display = 'none';
            divJornada.style.display = 'none';
            divTurno.style.display = 'none';

            return;
        }


        /*
         * Vaga foi selecionada.
         * Agora mostra os dados da vaga.
         */
        divFuncao.style.display = 'block';
        divSalario.style.display = 'block';
        divEscala.style.display = 'block';
        divJornada.style.display = 'block';
        divTurno.style.display = 'block';


        let opcao = select.options[select.selectedIndex];


        /*
         * Preenche os dados da vaga
         */
        funcao.value = opcao.dataset.funcao;

        salario.value = opcao.dataset.salario;

        escala.value = opcao.dataset.escala;

        jornada.value = opcao.dataset.jornada;

        turno.value = opcao.dataset.turno;


        /*
         * Mantém os dados somente para visualização
         */
        funcao.disabled = true;
        salario.readOnly = true;
        escala.disabled = true;
        jornada.disabled = true;
        turno.disabled = true;
    }


    /*
     * Quando muda o tipo do usuário
     */
    document.getElementById('tipo').addEventListener(
        'change',
        mostrarDadosVaga
    );


    /*
     * Quando escolhe criar nova vaga
     * ou selecionar uma existente
     */
    document.getElementById('vagaNova').addEventListener(
        'change',
        mostrarOpcaoVaga
    );

    document.getElementById('vagaExistente').addEventListener(
        'change',
        mostrarOpcaoVaga
    );


    /*
     * Quando seleciona uma vaga
     */
    document.getElementById('vaga_id').addEventListener(
        'change',
        preencherVaga
    );


    /*
     * Inicializa a tela
     */
    mostrarDadosVaga();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/usuario/form.blade.php ENDPATH**/ ?>