

<?php $__env->startSection('titulo', 'Formulário de categorias'); ?>

<?php $__env->startSection('conteudo'); ?>

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

    <div style="text-align: center; margin-bottom: 20px;">

        <h4 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   margin-bottom: 8px;">
            FORMULÁRIO CATEGORIAS
        </h4>

        <p style="color: #555;
                  font-size: 13px;
                  margin-bottom: 0;">
            Cadastre uma nova categoria
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




        <?php if($errors->any()): ?>

            <div class="alert alert-danger"
                 style="font-size: 13px;">

                <ul style="margin-bottom: 0;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($erro); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

            </div>

        <?php endif; ?>




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
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="<?php echo e(old('nome', $data->nome ?? '')); ?>">

        </div>




        <div class="mb-3">

            <label for="descricao"
                   class="form-label"
                   style="color: #555;
                          font-size: 13px;
                          font-weight: 500;">
                Descrição
            </label>

            <input type="text"
                   name="descricao"
                   id="descricao"
                   class="form-control"
                   style="border: 1px solid #ccc;
                          border-radius: 5px;
                          font-size: 13px;
                          height: 40px;
                          padding: 7px 12px;"
                   value="<?php echo e(old('descricao', $data->descricao ?? '')); ?>">

        </div>




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
                    style="border: 1px solid #d8b7b7;">

                <option value="">Selecione o tipo</option>

                <option value="brinco"
                    <?php echo e(old('tipo', $data->tipo ?? '') == 'brinco' ? 'selected' : ''); ?>>
                    Brinco
                </option>

                <option value="decoracao-quarto"
                    <?php echo e(old('tipo', $data->tipo ?? '') == 'decoracao-quarto' ? 'selected' : ''); ?>>
                    Decoração de Quarto
                </option>

                <option value="tiara"
                    <?php echo e(old('tipo', $data->tipo ?? '') == 'tiara' ? 'selected' : ''); ?>>
                    Acessório - tiara
                </option>

                <option value="Cropped"
                    <?php echo e(old('tipo', $data->tipo ?? '') == 'Cropped' ? 'selected' : ''); ?>>
                    Roupa - cropped
                </option>

                <option value="Bonecos"
                    <?php echo e(old('tipo', $data->tipo ?? '') == 'Bonecos' ? 'selected' : ''); ?>>
                    Bonecos
                </option>

                <option value="acessorio pequeno"
                    <?php echo e(old('tipo', $data->tipo ?? '') == 'acessorio pequeno' ? 'selected' : ''); ?>>
                    Acessório pequeno
                </option>


                <option value="utilitário"
                    <?php echo e(old('tipo', $data->tipo ?? '') == 'utilitário' ? 'selected' : ''); ?>>
                    Utilitário
                </option>

                <option value="outros"
                    <?php echo e(old('tipo', $data->tipo ?? '') == 'outros' ? 'selected' : ''); ?>>
                    Outros
                </option>


            </select>

            <?php $__errorArgs = ['tipo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1" style="font-size: 13px;">
                    <?php echo e($message); ?>

                </div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>




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

            <a href="<?php echo e(route('categoria.list')); ?>"
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
        </div>

    </form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/categoria/form.blade.php ENDPATH**/ ?>
