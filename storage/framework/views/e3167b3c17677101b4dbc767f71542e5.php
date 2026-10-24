<?php $__env->startSection('titulo', 'Formulário de Itens de Venda'); ?>

<?php $__env->startSection('conteudo'); ?>

<div class="container-fluid"
     style="background-color: #fffaf6;
            min-height: 100%;
            padding: 35px 40px;">

<?php
    $action = !empty($data->id)
        ? route('item_venda.update', $data->id)
        : route('item_venda.store');
?>

<div style="text-align: center; margin-bottom: 20px;">

    <h4 style="color: #6d3f36;
               font-family: Georgia, serif;
               font-weight: bold;
               margin-bottom: 8px;">
        CADASTRAR ITEM DE PEDIDO
    </h4>

    <p style="color: #555;
              font-size: 13px;
              margin-bottom: 0;">
        Vincule um produto a um venda e informe a quantidade
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

        <label for="venda_id"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Venda
        </label>

        <select name="venda_id"
                id="venda_id"
                class="form-select"
                required
                style="border: 1px solid #ccc;
                       border-radius: 5px;
                       font-size: 13px;
                       height: 40px;
                       padding: 7px 12px;">

            <option value="">Selecione um venda</option>

            <?php $__currentLoopData = $vendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($venda->id); ?>"
                    <?php echo e(old('venda_id', $data->venda_id ?? '') == $venda->id ? 'selected' : ''); ?>>

                    Venda #<?php echo e($venda->id); ?>


                </option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

    </div>

    <div class="mb-3">

        <label for="produto_id"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Produto
        </label>

        <select name="produto_id"
                id="produto_id"
                class="form-select"
                required
                style="border: 1px solid #ccc;
                       border-radius: 5px;
                       font-size: 13px;
                       height: 40px;
                       padding: 7px 12px;">

            <option value="">Selecione um produto</option>

            <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <option value="<?php echo e($produto->id); ?>"
                    <?php echo e(old('produto_id', $data->produto_id ?? '') == $produto->id ? 'selected' : ''); ?>>

                    <?php echo e($produto->nome); ?>


                </option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

    </div>

    <div class="mb-3">

        <label for="quantidade"
               class="form-label"
               style="color: #555;
                      font-size: 13px;
                      font-weight: 500;">
            Quantidade
        </label>

        <input type="number"
               name="quantidade"
               id="quantidade"
               min="1"
               required
               class="form-control"
               style="border: 1px solid #ccc;
                      border-radius: 5px;
                      font-size: 13px;
                      height: 40px;
                      padding: 7px 12px;"
               value="<?php echo e(old('quantidade', $data->quantidade ?? 1)); ?>">

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

        <a href="<?php echo e(url('item_venda')); ?>"
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

<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/item_venda/form.blade.php ENDPATH**/ ?>