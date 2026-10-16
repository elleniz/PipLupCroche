

<?php $__env->startSection('titulo', 'Formulário de Vagas'); ?>

<?php $__env->startSection('conteudo'); ?>

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    <?php

        if (!empty($data->id)) {
            $action = route('vaga.update', $data->id);
        } else {
            $action = route('vaga.store');
        }

    ?>


    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">

            <?php echo e(!empty($data->id) ? 'EDITAR VAGA' : 'CADASTRAR VAGA'); ?>


        </h4>

        <p style="color: #555;
                  font-size: 13px;
                  margin-bottom: 0;">

            <?php echo e(!empty($data->id)
                ? 'Edite os dados da vaga de trabalho'
                : 'Cadastre uma nova vaga de trabalho'); ?>


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

            <label for="usuario_id"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Funcionário
            </label>

            <select name="usuario_id"
                    id="usuario_id"
                    class="form-select"
                    style="border: 1px solid #ccc;
                           border-radius: 5px;
                           font-size: 13px;
                           height: 40px;
                           padding: 7px 12px;">

                <option value="">
                    Vaga em aberto
                </option>

                <?php $__currentLoopData = $funcionarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $funcionario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($funcionario->id); ?>"
                        <?php echo e(old('usuario_id', $data->usuario_id ?? '') == $funcionario->id ? 'selected' : ''); ?>>

                        <?php echo e($funcionario->nome); ?>


                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            <?php $__errorArgs = ['usuario_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                <div style="color: #c90045;
                            font-size: 12px;
                            margin-top: 5px;">

                    <?php echo e($message); ?>


                </div>

            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        </div>




        <div class="mb-3">

            <label for="funcao"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Função / Cargo
            </label>

            <input type="text"
                   name="funcao"
                   id="funcao"
                   class="form-control"
                   placeholder="Ex: Artesã, Vendedora..."
                   value="<?php echo e(old('funcao', $data->funcao ?? '')); ?>"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;">

            <?php $__errorArgs = ['funcao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                <div style="color: #c90045;
                            font-size: 12px;
                            margin-top: 5px;">

                    <?php echo e($message); ?>


                </div>

            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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
                   placeholder="Ex: 8.000,00"
                   class="form-control"
                   value="<?php echo e(old('salario', !empty($data->salario) ? number_format($data->salario, 2, ',', '.') : '')); ?>"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;">

            <?php $__errorArgs = ['salario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                <div style="color: #c90045;
                            font-size: 12px;
                            margin-top: 5px;">

                    <?php echo e($message); ?>


                </div>

            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        </div>


  <!-- ESCALA -->
<div class="mb-3">
    <label class="form-label">Escala</label>

    <select name="escala" class="form-select" required>
        <option value="">Selecione a escala</option>

        <option value="5x2"
            <?php echo e(old('escala', $data->escala ?? '') == '5x2' ? 'selected' : ''); ?>>
            5x2
        </option>

        <option value="6x1"
            <?php echo e(old('escala', $data->escala ?? '') == '6x1' ? 'selected' : ''); ?>>
            6x1
        </option>

        <option value="12x36"
            <?php echo e(old('escala', $data->escala ?? '') == '12x36' ? 'selected' : ''); ?>>
            12x36
        </option>

        <option value="4x3"
            <?php echo e(old('escala', $data->escala ?? '') == '4x3' ? 'selected' : ''); ?>>
            4x3
        </option>
    </select>
</div>


<!-- JORNADA -->
<div class="mb-3">
    <label class="form-label">Jornada de Trabalho</label>

    <select name="jornada_trabalho" class="form-select" required>
        <option value="">Selecione a jornada</option>

        <option value="4 horas por dia"
            <?php echo e(old('jornada_trabalho', $data->jornada_trabalho ?? '') == '4 horas por dia' ? 'selected' : ''); ?>>
            4 horas por dia
        </option>

        <option value="6 horas por dia"
            <?php echo e(old('jornada_trabalho', $data->jornada_trabalho ?? '') == '6 horas por dia' ? 'selected' : ''); ?>>
            6 horas por dia
        </option>

        <option value="8 horas por dia"
            <?php echo e(old('jornada_trabalho', $data->jornada_trabalho ?? '') == '8 horas por dia' ? 'selected' : ''); ?>>
            8 horas por dia
        </option>

        <option value="44 horas semanais"
            <?php echo e(old('jornada_trabalho', $data->jornada_trabalho ?? '') == '44 horas semanais' ? 'selected' : ''); ?>>
            44 horas semanais
        </option>
    </select>
</div>


<!-- TURNO -->
<div class="mb-3">
    <label class="form-label">Turno</label>

    <select name="turno" class="form-select" required>
        <option value="">Selecione o turno</option>

        <option value="Manhã"
            <?php echo e(old('turno', $data->turno ?? '') == 'Manhã' ? 'selected' : ''); ?>>
            Manhã
        </option>

        <option value="Tarde"
            <?php echo e(old('turno', $data->turno ?? '') == 'Tarde' ? 'selected' : ''); ?>>
            Tarde
        </option>

        <option value="Noite"
            <?php echo e(old('turno', $data->turno ?? '') == 'Noite' ? 'selected' : ''); ?>>
            Noite
        </option>

        <option value="Integral"
            <?php echo e(old('turno', $data->turno ?? '') == 'Integral' ? 'selected' : ''); ?>>
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
            </label>

            <input type="text"
                   name="tempo_profissao"
                   id="tempo_profissao"
                   class="form-control"
                   placeholder="Ex: 5 anos"
                   value="<?php echo e(old('tempo_profissao', $data->tempo_profissao ?? '')); ?>"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;">

            <?php $__errorArgs = ['tempo_profissao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                <div style="color: #c90045;
                            font-size: 12px;
                            margin-top: 5px;">

                    <?php echo e($message); ?>


                </div>

            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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


            <a href="<?php echo e(route('vaga.list')); ?>"
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/vaga/form.blade.php ENDPATH**/ ?>
