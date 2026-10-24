<?php $__env->startSection('titulo', 'Formulário de Materiais'); ?>

<?php $__env->startSection('conteudo'); ?>

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

<?php
    $action = !empty($data->id)
        ? route('materiais.update', $data->id)
        : route('materiais.store');
?>

<div style="text-align: center; margin-bottom: 20px;">

    <h4 style="color: #6d3f36;
               font-family: Georgia, serif;
               font-weight: bold;
               margin-bottom: 8px;">
        <?php echo e(!empty($data->id) ? 'EDITAR MATERIAL' : 'CADASTRAR MATERIAL'); ?>

    </h4>

    <p style="color: #555;
              font-size: 13px;
              margin-bottom: 0;">
        Informe os dados do material para cadastrar no estoque.
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

    <div class="mb-3">

        <label for="nome_material"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Nome do material
        </label>

        <input type="text"
               name="nome_material"
               id="nome_material"
               required
               maxlength="255"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('nome_material', $data->nome_material ?? '')); ?>">

    </div>

    <div class="mb-3">

        <label for="marca_material"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Marca
        </label>

        <input type="text"
               name="marca_material"
               id="marca_material"
               required
               maxlength="255"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('marca_material', $data->marca_material ?? '')); ?>">

    </div>

    <div class="mb-3">

        <label for="tipo_material"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Tipo de material
        </label>

        <input type="text"
               name="tipo_material"
               id="tipo_material"
               required
               maxlength="255"
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('tipo_material', $data->tipo_material ?? '')); ?>">

    </div>

    <div class="mb-3">

        <label for="valor_unitario"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Valor unitário (R$)
        </label>

        <input type="number"
               name="valor_unitario"
               id="valor_unitario"
               min="0"
               step="0.01"
               required
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('valor_unitario', $data->valor_unitario ?? '')); ?>">

    </div>

    <div class="mb-3">

        <label for="qtd_estoque"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Quantidade em estoque
        </label>

        <input type="number"
               name="qtd_estoque"
               id="qtd_estoque"
               min="0"
               step="1"
               required
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('qtd_estoque', $data->qtd_estoque ?? 0)); ?>">

    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger" style="font-size: 13px;">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $erro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($erro); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mt-3">

        <button type="submit"
                class="btn"
                style="background-color: #e88da5;
                       border: none;
                       border-radius: 20px;
                       color: white;
                       padding: 8px 30px;
                       font-size: 13px;">
            <?php echo e(!empty($data->id) ? 'Salvar alterações' : 'Salvar'); ?>

        </button>

        <a href="<?php echo e(route('materiais.index')); ?>"
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

<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/material/form.blade.php ENDPATH**/ ?>